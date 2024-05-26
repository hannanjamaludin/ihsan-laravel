@extends('layouts.auth-app')
@section('content')

<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mx-3">
                <li class="breadcrumb-item active"><a href="{{ route('pengguna.index_admin') }}" class="text-primary" style="text-decoration: none">Profil Pengguna</a></li>
            </ol>
        </nav>
        
        <div class="col-12 d-flex justify-content-end mb-4">
            <a href="{{ route('pengguna.penggunaBaru') }}" class="btn btn-primary me-3">
                <i class="fa fa-plus"></i> Pengguna Baharu
            </a>
        </div>

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
                },
            ],
            "language": {
                "search": "Carian:",
                // "searchPlaceholder": "Custom Search Placeholder",
                "lengthMenu": "Menunjukkan _MENU_ kemasukan",
                "info": "Menunjukkan _START_ ke _END_ daripada _TOTAL_ kemasukan",
                "infoEmpty": "Menunjukkan 0 ke 0 daripada 0 kemasukan",
                "infoFiltered": "(ditapis daripada _MAX_ total kemasukan)",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Seterusnya",
                    "previous": "Sebelumnya"
                },
                "emptyTable": "Tiada pendaftaran baharu"
            }
        });


        // console.log("dalam js");

        var successMessage = "{{ session('success_message') }}";

        if (successMessage){
            Swal.fire({
                title: "Berjaya",
                text: successMessage,
                icon: "success",
                timer: 2000,
                confirmButtonColor: "#703232",
            });
        }

    });

    function delete_user(id) {
        Swal.fire({
            title: "Buang Pengguna?",
            text: "Adakah anda pasti untuk membuang pengguna?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#703232",
            cancelButtonColor: "#BABABA",
            confirmButtonText: "Ya, saya pasti",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('pengguna.buang_pengguna') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "user_id": id,
                    },
                    success: function(response){
                        if(response.success){
                            Swal.fire({
                                title: "Pengguna Dibuang",
                                text: "Pengguna telah dibuang",
                                icon: "success",
                                confirmButtonColor: '#703232'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: "Ralat",
                                text: "Pengguna gagal dibuang",
                                icon: "error",
                                confirmButtonColor: '#703232'
                            });           
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log("userid: " + id);
                        Swal.fire({
                            icon: 'error',
                            title: 'Ralat',
                            text: 'Ralat berlaku semasa berkomunikasi dengan server.',
                        });
                    }
                })
            }
        })

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

</style>
@endsection