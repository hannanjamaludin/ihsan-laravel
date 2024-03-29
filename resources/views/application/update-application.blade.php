@extends('layouts.auth-app')
@section('content')

<div class="row">
    <div class="col-12">

        <div class="card mb-4 mx-3">
            <div class="card-header bg-primary">
                <div class="card-title text-light">Pendaftaran Baharu</div>
            </div>
            
            <div class="card-body px-3 pt-2 pb-4 w-auto">
                <div class="mt-3 text-center text-primary">
                    <div>
                        <table id="application_list" class="table table-bordered table-hover table-striped w-100">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Umur</th>
                                    <th>Cawangan</th>
                                    <th>Ibu / Bapa</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
            <livewire:application.view-application />
        </div>

    </div>
</div>

@endsection

@section('js')

<script type="text/javascript">

    // add a function to open modal (get id from passed variable)
    function display_modal(id) {
        $.ajax({
            'url': '{{ route('pendaftaran.info_pelajar') }}',
            'type': 'GET',
            'data': {
                _token: "{{ csrf_token() }}",
                student_id: id,
            },
            success: function(response){
                console.log(response);
                $('#full_name').val(response.full_name);
                $('#ic_no').val(response.ic_no);
                $('#dob').val(response.dob);
                $('#gender').val(response.gender);
                $('#siblings').val(response.siblings);
                $('#allergy').val(response.allergy);
                $('#disability').val(response.disability);
                $('#illness').val(response.illness);
                $('#study').val(response.study);
                $('#address1').val(response.address1);
                $('#state').val(response.state);
                $('#district').val(response.district);
                $('#postcode').val(response.postcode);
                $('#branch_id').val(response.branch.branch_name);
                
                $('#mom_full_name').val(response.mom.full_name);
                $('#mom_job').val(response.mom.job);
                $('#mom_email').val(response.mom.email);
                $('#mom_phone_no').val(response.mom.phone_no);
                $('#m_office_address').val(response.mom.address);
                $('#m_office_state').val(response.mom.state);
                $('#m_office_district').val(response.mom.district);
                $('#m_office_postcode').val(response.mom.postcode);
                $('#mom_staff_no').val(response.mom.staff_no);
                $('#mom_student_no').val(response.mom.student_no);

                $('#dad_full_name').val(response.dad.full_name);
                $('#dad_job').val(response.dad.job);
                $('#dad_email').val(response.dad.email);
                $('#dad_phone_no').val(response.dad.phone_no);
                $('#d_office_address').val(response.dad.address);
                $('#d_office_state').val(response.dad.state);
                $('#d_office_district').val(response.dad.district);
                $('#d_office_postcode').val(response.dad.postcode);
                $('#dad_staff_no').val(response.dad.staff_no);
                $('#dad_student_no').val(response.dad.student_no);

                if(response.dad.staff_no != null){
                    $('#dad_staff').removeClass('d-none');
                } else {
                    $('#dad_staff').addClass('d-none');
                }

                if(response.mom.staff_no != null){
                    $('#mom_staff').removeClass('d-none');
                } else {
                    $('#mom_staff').addClass('d-none');
                }

                if(response.dad.student_no != null){
                    $('#dad_student').removeClass('d-none');
                } else {
                    $('#dad_student').addClass('d-none');
                }

                if(response.mom.student_no != null){
                    $('#mom_student').removeClass('d-none');
                } else {
                    $('#mom_student').addClass('d-none');
                }

                $('#modalStudentDetails').modal('show');

            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    $(document).ready( function () {
        var table = $('#application_list').DataTable({
            'processing': true,
                'scrollX': true,
                'scrollable': true,
                'searchable': true,
                'ajax': {
                    'url': "{{ route('pendaftaran.datatable_application_list') }}",
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
                        data: 'age'
                    },
                    {
                        data: 'branch'
                    },
                    {
                        data: 'staff_student',
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

        });

        // $(document).on('click', '.btn-info', function() {
        //     var studentId = $(this).data('student_id');
        //     display_modal(studentId);
        // });

    });

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
</style>
@endsection