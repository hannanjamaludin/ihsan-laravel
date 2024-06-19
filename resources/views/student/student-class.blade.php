@extends('layouts.auth-app')
@section('content')

@if ($teacher->branch_id == 1 || $teacher->branch_id == 2)
    <div class="row" id="collection-summary">        
        <div class="col-xl-12">
            <div class="row justify-content-center align-items-center">
            
                @php
                    $icons = [
                        'fa-robot',
                        'fa-puzzle-piece',
                        'fa-cookie-bite',
                        'fa-shapes',
                        'fa-cubes-stacked',
                    ];
                @endphp

                @foreach ($classes as $index => $class)
                    <div class="col-5 col-sm-2 col-md-2 d-flex mb-g">                                            
                        <div class="bg-white rounded p-0 m-0 d-flex flex-column w-100 h-100 js-showcase-icon" style="border: 1px solid #3d5cbc1f; box-shadow: 1px 2px 20px 0px rgb(3 0 71 / 9%);">                                                
                            <div class="rounded-top w-100">                                                    
                                <div class="d-flex align-items-center justify-content-center w-100 pt-3 pb-3 pr-2 pl-2 fa-3x"> 
                                    <i class="text-primary fa {{ $icons[$index % count($icons)] }}"></i>
                                </div>
                                <div class="d-flex flex-column align-items-center justify-content-center">                                    
                                    <span class="fw-300 fs-xs d-block opacity-50"></span>     
                                    <h4 class="fw-bold" id="class{{ $index + 1 }}">{{ $class->total_students }}</h4>
                                </div>                                                                                                                                           
                            </div>                                     
                            <div class="rounded-bottom p-1 w-300 d-flex justify-content-center align-items-center text-center">                                                                         
                                <div class="d-block fw-normal">{{ $class->age }} {{ $class->class_name }}</div>                                                
                            </div>                                            
                        </div>                                        
                    </div>
                @endforeach
                        
            </div>
        </div>
    </div>
@endif

@if ($teacher->branch_id == 1 || $admin)
    <div class="row mt-4">
        <div class="col-12">
        
            <div class="card mb-4 mx-3">
                <div class="card-header bg-primary">
                    <div class="card-title text-light">Pengurusan Bilik Taska Ihsan</div>
                </div>
                
                <div class="card-body px-3 pt-2 pb-4 w-auto">
                    <div class="mt-3 text-center text-primary">
                        <div>
                            <table id="room_list" class="table table-bordered table-hover table-striped w-100">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Bilik</th>
                                        <th>Kapasiti</th>
                                        <th>Jumlah Murid</th>
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
@endif

@if ($teacher->branch_id == 2 || $admin)   
    <div class="row mt-4">
        <div class="col-12">
        
            <div class="card mb-4 mx-3">
                <div class="card-header bg-primary">
                <div class="card-title text-light">Pengurusan Kelas Tadika Ihsan</div>
                </div>
                
                <div class="card-body px-3 pt-2 pb-4 w-auto">
                    <div class="mt-3 text-center text-primary">
                        <div>
                            <table id="class_list" class="table table-bordered table-hover table-striped w-100">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Kelas</th>
                                        <th>Kapasiti</th>
                                        <th>Jumlah Murid</th>
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
@endif

<livewire:staff.edit-class />

@endsection

@section('js')
<script>
    $(document).ready(function () {
        var table = $('#class_list').DataTable({
            'processing': true,
                'scrollX': true,
                'scrollable': true,
                'searchable': true,
                'ajax': {
                    'url': "{{ route('kelas.datatable_class_list') }}",
                    'dataType': 'json',
                    'type': 'GET'
                },
                'columnDefs': [{
                    className: 'dt-left'
                }],
                'columns': [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'class'
                    },
                    {
                        data: 'capacity'
                    },
                    {
                        data: 'total_student',
                        render: function(data, type, row) {
                            return type === 'display' ? $('<div/>').html(data).text() : data;
                        }
                    },
                    {
                        data: 'action',
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
                    // "emptyTable": "Tiada pendaftaran baharu"
                }
        });

        var table2 = $('#room_list').DataTable({
            'processing': true,
                'scrollX': true,
                'scrollable': true,
                'searchable': true,
                'ajax': {
                    'url': "{{ route('kelas.datatable_room_list') }}",
                    'dataType': 'json',
                    'type': 'GET'
                },
                'columnDefs': [{
                    className: 'dt-left'
                }],
                'columns': [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'room'
                    },
                    {
                        data: 'capacity'
                    },
                    {
                        data: 'total_student',
                        render: function(data, type, row) {
                            return type === 'display' ? $('<div/>').html(data).text() : data;
                        }
                    },
                    {
                        data: 'action',
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
                    // "emptyTable": "Tiada pendaftaran baharu"
                }
        });
    });

    document.addEventListener('livewire:load', function () {
        window.livewire.on('openModal', () => {
            $('#modalClassDetails').modal('show');
        });

        window.livewire.on('closeModal', () => {
            $('#modalClassDetails').modal('hide');
        });

        // Listen for the 'classUpdated' event to refresh the DataTable
        window.livewire.on('classUpdated', () => {
            // Reload the DataTable with new data
            $('#class_list').DataTable().ajax.reload();
            $('#room_list').DataTable().ajax.reload();
        });
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

    .progress {
        height: 20px;
        margin-bottom: 0;
    }

    .progress-bar-striped {
        line-height: 20px;
        text-align: center;
    }
</style>
@endsection