@extends('layouts.auth-app')
@section('content')

<div class="row">
    
    <div class="col-12 mx-1">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mx-3">
                <li class="breadcrumb-item"><a href="{{ route('murid.aktiviti_anak') }}" class="text-primary" style="text-decoration: none">Aktiviti Anak</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $student->full_name }}</li>
            </ol>
        </nav>

        {{-- student info --}}
        <div class="card mb-4 mx-3">
            <div class="" id="child">
                <div class="card-body px-3 py-4 w-auto">
                    <div class="row mb-2">
                        <div class="col-2 d-flex text-center align-items-center">
                            @if ($student->gender == 'lelaki')
                                <div class="rounded-circle mx-auto shadow-lg" style="background-color: #bcd2e9; width: 75px; height: 75px; display: flex; justify-content: center; align-items: center;">
                                    @if ($student->branch_id == 1)
                                        <i class="fas fa-baby" style="font-size: 40px;"></i>
                                    @else
                                        <i class="fas fa-child" style="font-size: 40px;"></i>
                                    @endif
                                </div>
                            @else
                                <div class="rounded-circle mx-auto shadow-lg" style="background-color: #dac6dd; width: 75px; height: 75px; display: flex; justify-content: center; align-items: center;">
                                    @if ($student->branch_id == 1)
                                        <i class="fas fa-baby" style="font-size: 40px;"></i>
                                    @else
                                        <i class="fas fa-child-dress" style="font-size: 40px;"></i>
                                    @endif
                                </div>
                            @endif
                        </div>
                        <div class="col-10">
                            <div class="text-primary fs-4 fw-bold">{{ $student->full_name }}</div>
                            @if ($student->branch_id == 1)
                                <div class="">Bilik: {{ $student->assignedClass->class_name }}</div>
                            @else
                                <div class="">Kelas: {{ $student->assignedClass->age }} {{ $student->assignedClass->class_name }}</div>
                            @endif
                            <div class="">Guru: {{ $teacher->full_name }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Child Activity --}}
        <div class="card mb-4 mx-3">
            <div class="card-body px-3 py-4 w-auto">
                @if ($student->branch_id == 1)
                    <div>
                        <table id="room_activity" class="table table-bordered table-hover table-striped w-100">
                            <thead>
                                <tr>
                                    <th>Tarikh</th>
                                    <th>Aktiviti</th>
                                    <th>Gambar/Video Kelas</th>
                                    <th>Gambar/video individu</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                @else
                    <div>
                        <table id="class_activity" class="table table-bordered table-hover table-striped w-100">
                            <thead>
                                <tr>
                                    <th>Tarikh</th>
                                    <th>Subjek</th>
                                    <th>Pelajaran</th>
                                    <th>Aktiviti</th>
                                    <th>Komen Guru</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>

{{-- Modal to view media --}}

@endsection

@section('js')
<script>
        $(document).ready(function () {
        var table = $('#room_activity').DataTable({
            'processing': true,
                'scrollX': true,
                'scrollable': true,
                'searchable': true,
                'ajax': {
                    'url': "{{ route('murid.datatable_room_activity') }}",
                    'dataType': 'json',
                    'type': 'GET',
                    'data': {
                        'room_id': {{ $student->class_id }},
                        'student_id': {{ $student->id }},
                    }
                },
                'columnDefs': [{
                    className: 'dt-left'
                }],
                'columns': [
                    {
                        data: 'date'
                    },
                    {
                        data: 'activity'
                    },
                    {
                        data: 'media_class',
                        render: function(data, type, row) {
                            return type === 'display' ? $('<div/>').html(data).text() : data;
                        }
                    },
                    {
                        data: 'media_student',
                        render: function(data, type, row) {
                            return type === 'display' ? $('<div/>').html(data).text() : data;
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
                    // "emptyTable": "Tiada pendaftaran baharu"
                }
        });

        var table2 = $('#class_activity').DataTable({
            'processing': true,
                'scrollX': true,
                'scrollable': true,
                'searchable': true,
                'ajax': {
                    'url': "{{ route('murid.datatable_class_activity') }}",
                    'dataType': 'json',
                    'type': 'GET',
                    'data': {
                        'class_id': {{ $student->class_id }},
                        'student_id': {{ $student->id }},
                    }
                },
                'columnDefs': [{
                    className: 'dt-left'
                }],
                'columns': [
                    {
                        data: 'date'
                    },
                    {
                        data: 'subject'
                    },
                    {
                        data: 'learning',
                        // render: function(data, type, row) {
                        //     return type === 'display' ? $('<div/>').html(data).text() : data;
                        // }
                    },
                    {
                        data: 'activity',
                    },
                    {
                        data: 'comment',
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