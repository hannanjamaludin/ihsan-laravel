@extends('layouts.auth-app')
@section('content')

<div class="row">
    <div class="col-12">

        <div class="card mb-4 mx-3">
            <div class="card-header bg-primary">
                <div class="card-title text-light">Senarai Pengguna Applikasi Ihsan</div>
            </div>
            
            <div class="card-body px-3 pt-2 pb-4 w-auto">
                <div class="mt-3 text-center text-primary">
                    <div>
                        <table id="user_list" class="table table-bordered table-hover table-striped w-100">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Alamat E-mel</th>
                                    <th>Jenis Pengguna</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
            {{-- <livewire:application.view-application /> --}}
        </div>
    </div>
</div>

@endsection

@section('js')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        var table = $('#user_list').DataTable({
            'processing': true,
                'scrollX': true,
                'scrollable': true,
                'searchable': true,
                'ajax': {
                    'url': "{{ route('pengguna.datatable_user_list') }}",
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
                        data: 'name'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'user_type',
                        render: function(data, type, row) {
                            return type === 'display' ? $('<div/>').html(data).text() : data;
                        }
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
                    "infoFiltered": "(filtered from _MAX_ total kemasukan)",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Seterusnya",
                        "previous": "Sebelumnya"
                    },
                    "emptyTable": "Tiada pendaftaran baharu"
                }


        });
    })
</script>

@endsection

@section('css')
<style>
    .active>.page-link, .page-link.active {
        background-color: #703232;
        border-color: #703232;
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