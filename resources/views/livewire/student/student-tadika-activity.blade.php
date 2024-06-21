<div class="card pb-4">
    <div class="card-body px-3 pt-2 pb-4 w-auto">
        <h3 class="text-primary">{{ $class->age }} {{ $class->class_name }}</h3>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th class="bg-secondary fst-italic">Kelas:</th>
                    <td class="bg-light">{{ $class->age }} {{ $class->class_name }}</td>
                </tr>
                <tr>
                    <th class="bg-secondary fst-italic">Bilangan Murid:</th>
                    <td class="bg-light">{{ $class->total_students }}</td>
                </tr>
                <tr>
                    <th class="bg-secondary fst-italic">Tarikh:</th>
                    <td class="bg-light">{{ $formattedDate }}</td>
                </tr>
                <tr>
                    <th class="bg-secondary fst-italic">Kehadiran:</th>
                    <td class="bg-light">{{ count($presentStudents) }}/{{ $class->total_students }}</td>
                </tr>
            </tbody>
        </table>
    
        {{-- <form method="POST" action="{{ route('murid.tadika_simpan', [$class->id, $today]) }}"> --}}
        <form wire:submit.prevent="submitForm" class="px-2">
            {{-- @csrf  --}}
    
            {{-- Class Activity --}}
            <h5 class="mt-4">Aktiviti</h5>
            <div class="form-group row mt-2 align-items-center">
                <div class="col-1">
                    <label class="form-label" for="subject">Subjek:</label>
                </div>
                <div class="col-11">
                    {{-- <input type="text" id="subject" class="form-control" placeholder="Sila isikan nama subjek" value="" name="subject" required> --}}
                    <select class="form-select" id="subject" wire:model="subject" name="subject" required {{ $submitted ? 'disabled' : '' }}>
                        <option value="">Sila pilih subjek</option>
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->full_name }}</option>
                        @endforeach
                    </select>    
                </div>
            </div>
            <div class="form-group row mt-3 align-items-center">
                <div class="col-1">
                    <label class="form-label" for="learning">Pelajaran:</label>
                </div>
                <div class="col-11">
                    <input type="text" id="learning" class="form-control" placeholder="Nyatakan pelajaran dalam subjek ini" wire:model="learning" required {{ $submitted ? 'disabled' : '' }}>
                </div>
            </div>
            <div class="form-group row mt-3 align-items-center">
                <div class="col-1">
                    <label class="form-label" for="activity">Aktiviti:</label>
                </div>
                <div class="col-11">
                    <input type="text" id="activity" class="form-control" placeholder="Nyatakan aktiviti jika ada" value="" wire:model="activity" required {{ $submitted ? 'disabled' : '' }}>
                </div>
            </div>

            <div class="col">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <h5 class="mt-4">Prestasi Individu</h5>
                    </div>
                    <div class="col-auto pt-3 ms-0 ps-0">
                        <span class="text-muted text-sm text-normal fst-italic">(Jika ada)</span>
                    </div>
                </div>
            </div>
            <div class="form-group row mt-2 align-items-center">
                <div class="col-1">
                    <label class="form-label" for="student_id">Nama:</label>
                </div>
                <div class="col-11">
                    {{-- <input type="text" id="student_name" class="form-control" placeholder="Sila pilih murid" value="" name="student_name" required> --}}
                    <select class="form-select" id="student_id" wire:model="student_id" name="student_id" {{ $submitted ? 'disabled' : '' }}>
                        <option value="">Sila pilih murid</option>
                        @foreach ($presentStudents as $student)
                            <option value="{{ $student->student->id }}">{{ $student->student->full_name }}</option>
                        @endforeach
                    </select>    

                </div>
            </div>
            <div class="form-group row mt-3 align-items-center">
                <div class="col-1">
                    <label class="form-label" for="comment">Komen:</label>
                </div>
                <div class="col-11">
                    <input type="text" id="comment" class="form-control" placeholder="Nyatakan prestasi murid" wire:model="comment" {{ $submitted ? 'disabled' : '' }}>
                </div>
            </div>

            <div class="col-12 d-flex justify-content-end my-4">
                <button type="submit" class="btn btn-primary btn-hantar" {{ $submitted ? 'disabled' : '' }}>Hantar</button>
            </div>
        </form>
        
        {{-- Summary for submitted activities --}}
        <div>
            @foreach ($submittedActivities as $submittedActivity)
            <hr class="my-5"></hr>
                <div class="col">
                    <h5 class="">Subjek: {{ $submittedActivity->subjects->full_name }}</h5>
                </div>
                <table id="submitted_activity_{{ $submittedActivity->id }}" class="table table-bordered table-hover table-striped w-100 mt-2 submitted_activity">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Murid</th>
                            <th>Komen</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>    
            @endforeach
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Livewire.on('formSubmitted', () => {
            console.log('Submitted');
            Swal.fire({
                title: 'Berjaya!',
                text: 'Aktiviti berjaya disimpan',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#703232'
            });

            initializeDataTables();
        });  
        
        initializeDataTables();

    });
    function initializeDataTables() {
        $('.submitted_activity').each(function () {
            var tableId = $(this).attr('id');
            var activityId = tableId.split('_')[2];

            if (!$.fn.DataTable.isDataTable('#' + tableId)) {
                $('#' + tableId).DataTable({
                    'processing': true,
                        'scrollX': true,
                        'scrollable': true,
                        'searchable': true,
                        'ajax': {
                            'url': "{{ route('murid.datatable_submitted_tadika_activity') }}",
                            'dataType': 'json',
                            'type': 'GET',
                            'data' : {
                                'submittedActivity_id' : activityId,
                            }
                        },
                        'columnDefs': [{
                            className: 'dt-left'
                        }],
                        'columns': [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex',
                            },
                            {
                                data: 'name'
                            },
                            {
                                data: 'comment'
                            },
                            {
                                data: 'action',
                                // render: function(data, type, row) {
                                //     return type === 'display' ? $('<div/>').html(data).text() : data;
                                // }
                            },
                        ],
                        "language": {
                            "search": "Carian:",
                            // "searchPlaceholder": "Custom Search Placeholder",
                            "lengthMenu": "Menunjukkan _MENU_ kemasukan",
                            "info": "Menunjukkan _START_ ke _END_ daripada _TOTAL_ kemasukan",
                            "infoEmpty": "Menunjukkan 0 ke 0 daripada 0 kemasukan",
                            "infoFiltered": "(Ditapis daripada _MAX_ total kemasukan)",
                            "paginate": {
                                "first": "Pertama",
                                "last": "Terakhir",
                                "next": "Seterusnya",
                                "previous": "Sebelumnya"
                            },
                            "emptyTable": "Tiada prestasi murid dihantar"
                        }
            
            
                });

            }
        })
    }

</script>

<style>
    .active>.page-link, .page-link.active {
        background-color: #703232;
        border-color: #703232;
    }

    a.page-link{
        color: #703232;
    }

    .text-center {
        text-align: left !important;
    }

    div.dataTables_wrapper div.dataTables_paginate ul.pagination{
        margin: 15px 0 0 !important;
    }

    div.dataTables_wrapper div.dataTables_filter {
        margin: 0 0 10px !important;
    }

</style>

