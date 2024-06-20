@extends('layouts.auth-app')
@section('content')

<div class="row mt-4">
    <div class="col-12">
        <!-- Breadcrumb Navigation -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mx-3">
                <li class="breadcrumb-item text-primary"><a href="{{ route('kelas.kelas') }}" class="text-primary" style="text-decoration: none">Pengurusan Murid</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $class->age }} {{ $class->class_name }}</li>
            </ol>
        </nav>

        <div class="col-12 d-flex justify-content-end mb-4">
            <a href="#" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                <i class="fa fa-plus"></i> Tambah Murid
            </a>
        </div>

        <div class="card mb-4 mx-3">
            <div class="card-header bg-primary">
                <div class="card-title text-light">{{ $class->age }} {{ $class->class_name }}</div>
            </div>
            
            <div class="card-body px-3 pt-2 pb-4 w-auto">
                <div class="mt-3 text-center text-primary">
                    <div>
                        <table id="student_list" class="table table-bordered table-hover table-striped w-100">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th style="white-space: nowrap !important;">Nama</th>
                                    <th>Jantina</th>
                                    <th>Umur</th>
                                    <th>Tarikh Masuk</th>
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
<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-light">
                <h5 class="modal-title" id="addStudentModalLabel">Senarai nama murid</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <table id="modal_student_list" class="table table-bordered table-striped table-hover w-100">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Jantina</th>
                            <th>Umur</th>
                            <th>Tarikh Masuk</th>
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
        var table = $('#student_list').DataTable({
            'processing': true,
                'scrollX': true,
                'scrollable': true,
                'searchable': true,
                'ajax': {
                    'url': "{{ route('kelas.datatable_student_list') }}",
                    'dataType': 'json',
                    'type': 'GET',
                    'data': {
                        'class_id': {{ $class->id }}
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
                        data: 'gender'
                    },
                    {
                        data: 'age'
                    },
                    {
                        data: 'enroll_date'
                    },
                    {
                        data: 'action'
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
                    "emptyTable": "Tiada murid"
                }
        });

        $('#addStudentModal').on('shown.bs.modal', function() {
            if ($.fn.DataTable.isDataTable('#modal_student_list')) {
                $('#modal_student_list').DataTable().clear().destroy();
            }

            $('#modal_student_list').DataTable({
                'processing': true,
                'scrollX': true,
                'scrollable': true,
                'searchable': true,
                'ajax': {
                    'url': "{{ route('kelas.datatable_all_student_list') }}",
                    'dataType': 'json',
                    'type': 'GET',
                    'data': {
                        'class_id': {{ $class->id }}
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
                        data: 'gender'
                    },
                    {
                        data: 'age'
                    },
                    {
                        data: 'enroll_date'
                    },
                    {
                        data: 'id',
                        render: function(data, type, row){
                            return '<button class="btn btn-sm btn-primary" onclick="addStudentToClass(' + data + ')">Tambah</button>';
                        }
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
                    "emptyTable": "Tiada murid"
                }
            });
        });
        
    });

    function addStudentToClass(studentId){
        $.ajax({
            url: "{{ route('kelas.add_student_to_class') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                class_id: {{ $class->id }},
                student_id: studentId,
            },
            success: function(response){
                // refresh Datatable
                $('#student_list').DataTable().ajax.reload();
                $('#modal_student_list').DataTable().ajax.reload();
                // Add sweet alert later
            },
            error: function(error){
                console.log(error);
            }
        });
    }

    function removeStudentFromClass(studentId){
        $.ajax({
            url: "{{ route('kelas.remove_student_from_class') }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                class_id: {{ $class->id }},
                student_id: studentId,
            },
            success: function(response){
                // refresh Datatable
                $('#student_list').DataTable().ajax.reload();
                // add sweet alert later
            },
            error: function(error){
                console.error(error);
            }
        });
    }

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

    .dataTables_scrollHeadInner th:nth-child(1) {
        /* width: 200px; Set width for the second column */
        white-space: nowrap; /* Prevent text wrapping */
        width: auto;
    }
</style>
@endsection