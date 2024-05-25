@extends('layouts.auth-app')
@section('content')

<div class="row mt-4">
    <div class="col-12">

        <div class="card mb-4 mx-3">
            <div class="card-header bg-primary">
                @if ($teacher->branch_id == 1)
                    <div class="card-title text-light">Pengurusan Pengasuh Taska Ihsan</div>
                @else
                    <div class="card-title text-light">Pengurusan Guru Tadika Ihsan</div>
                @endif        
            </div>
            
            <div class="card-body px-3 pt-2 pb-4 w-auto">
                <div class="mt-3 text-center text-primary">
                    <div>
                        <table id="teacher_list" class="table table-bordered table-hover table-striped w-100">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>No. Pekerja</th>
                                    <th>No. Telefon</th>
                                    @if ($teacher->branch_id == 1)
                                        <th>Bilik</th>
                                    @else
                                        <th>Kelas</th>
                                    @endif      
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

</div>

{{-- Modal --}}
<div class="modal fade" id="addClassModal" tabindex="-1" aria-labelledby="addClassModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-light">
                @if ($teacher->branch_id == 1)
                    <h5 class="modal-title" id="addClassModalLabel">Senarai Bilik</h5>
                @else
                    <h5 class="modal-title" id="addClassModalLabel">Senarai Kelas</h5>
                @endif
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <table id="modal_class_list" class="table table-bordered table-striped table-hover w-100">
                    <thead>
                        <tr>
                            <th>No.</th>
                            @if ($teacher->branch_id == 1)
                                <th>Bilik</th>
                            @else
                                <th>Kelas</th>
                            @endif
                            <th>Kapasiti</th>
                            <th>Jumlah murid</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection

@section('js')
<script>
$(document).ready(function () {
    var table = $('#teacher_list').DataTable({
        'processing': true,
        'scrollX': true,
        'scrollable': true,
        'searchable': true,
        'ajax': {
            'url': "{{ route('staff.datatable_teacher_list') }}",
            'dataType': 'json',
            'type': 'GET',
            'data': {
                'branch_id': {{ $teacher->branch_id }}
            }
        },
        'columnDefs': [{
            className: 'dt-left'
        }],
        'columns': [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'name' },
            { data: 'staff_no' },
            { data: 'phone_no' },
            { data: 'room_class' },
            { data: 'action' },
        ],
        "language": {
            "search": "Carian:",
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
        }
    });

    function editTeacherClass(teacherId) {
        if ($.fn.DataTable.isDataTable('#modal_class_list')) {
            $('#modal_class_list').DataTable().destroy();
        }

        $('#modal_class_list').DataTable({
            'processing': true,
            'scrollX': true,
            'scrollable': true,
            'searchable': true,
            'ajax': {
                'url': "{{ route('staff.datatable_class_list') }}",
                'dataType': 'json',
                'type': 'GET',
                'data': {
                    'teacher_id': teacherId,
                    'branch_id': {{ $teacher->branch_id }}
                }
            },
            'columnDefs': [{
                className: 'dt-left'
            }],
            'columns': [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'class_room' },
                { data: 'capacity' },
                { data: 'total_students' },
                { data: 'action' }
            ],
            "language": {
                "search": "Carian:",
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
                "emptyTable": "Tiada murid"
            }
        });
        $('#addClassModal').modal('show');
    }

    function assignNewClass(classId, teacherId) {
        // console.log('class id: ', classId, 'teacher id: ', teacherId);
        
        $.ajax({
            url: "{{ route('staff.assign_new_class') }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                class_id: classId,
                teacher_id: teacherId,
            },
            success: function(response) {
                console.log('Success:', response);
                // Refresh Datatable
                $('#teacher_list').DataTable().ajax.reload();
                $('#modal_class_list').DataTable().ajax.reload();
                // Optionally close the modal if you want
                $('#addClassModal').modal('hide');
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    }

    window.editTeacherClass = editTeacherClass;
    window.assignNewClass = assignNewClass;
});
</script>
@endsection

@section('css')
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
@endsection
