@extends('layouts.auth-app')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card mb-4 mx-3">
            <div class="card-header py-1 d-flex flex-row justify-content-between card-header-divider">
                <div class="col">
                    <h5 class="card-title mt-2">Maklumat Anak</h5>
                </div>
                <div class="col-auto">
                    <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#child" aria-expanded="true" title="Collapse">
                        <i class="fas fa-chevron-down text-primary"></i>
                    </button>
                </div>
            </div>

            <div class="collapse multi-collapse show" id="child">
                <div class="card-body px-3 pt-2 pb-4 w-auto">
                        {{-- {{ Form::open(array('url' => 'employeemanagement/employee/store' ,'method' => 'post','enctype'=>'multipart/form-data','class' =>'smart-form')) }} --}}

                    {{-- <div class="form-group row">
                        <div class="col-12 pl-1">
                        <label class="form-label" ><h5>Maklumat Anak</h5></label>
                        </div>
                    </div> --}}

                    <div class="form-group row">
                        <div class="col-12 pl-1">
                            <label class="form-label" for="full_name">Nama Penuh</label>
                            <input type="text" id="full_name" class="form-control" placeholder="Sila isikan nama penuh anak" required name="full_name">
                        </div>
                    </div>

                    <div class="form-group row mt-3">
                        <div class="col-4 pl-1">
                            <label class="form-label" for="ic_no">No. MyKid</label>                        
                            <input type="text" id="ic_no" class="form-control" placeholder="XXXXXX-XX-XXXX" required name="ic_no">
                        </div>
                        <div class="col-4 pl-1">
                            <label class="form-label" for="dob">Tarikh Lahir</label>                        
                            <input type="date" id="dob" class="form-control" placeholder="" required name = "dob">
                        </div>
                        <div class="col-4 pl-1">
                            <label class="form-label" for="gender">Jantina</label>                        
                            {{-- <input type="text" id="gender" class="form-control" placeholder="" required name = "gender"> --}}
                            <select class="form-select" id="gender">
                                <option selected="" disabled>Sila pilih jantina</option>
                                <option value="lelaki">Lelaki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row mt-3">
                        <div class="col-6 pl-1">
                            <div class="form-group">
                                <label class="form-label">Adik-beradik (Anak ke Berapa)</label>                            
                                <input type="text" id="siblings" class="form-control" placeholder="Contoh: 1/3" required name = "siblings">
                            </div>
                        </div>
                        <div class="col-6 pl-1">
                            <div class="form-group">
                                <label class="form-label">Alahan</label>                            
                                <input type="text" id="allergy" class="form-control" placeholder="Nyatakan jika ada" required name = "allergy">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mt-3">
                        <div class="col-6 pl-1">
                            <div class="form-group">
                                <label class="form-label">Kelainan Upaya</label>                            
                                <input type="text" id="disability" class="form-control" placeholder="Nyatakan jika ada" required name = "disability">
                            </div>
                        </div>
                        <div class="col-6 pl-1">
                            <div class="form-group">
                                <label class="form-label">Penyakit Kronik</label>                            
                                <input type="text" id="illness" class="form-control" placeholder="Nyatakan jika ada" required name = "illness">                                
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mt-3">
                        <div class="col-12 pl-1">
                            <div class="form-group">
                                <label class="form-label">Masalah Kesihatan & Pembelajaran</label>                            
                                <input type="text" id="study" class="form-control" placeholder="Nyatakan jika ada" required name = "study">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mt-3">
                        <div class="col-12 pl-1">
                            <div class="form-group">
                                <label class="form-label">Alamat Rumah</label>
                                <input type="text" id="address1" class="form-control" placeholder="" required name = "address1">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mt-1">
                        <div class="col-4 pl-1">
                            <div class="form-group">
                                {{-- <input type="text" id="state" class="form-control" placeholder="Negeri" required name = "state"> --}}
                                <select class="form-select" id="state">
                                    <option selected="" disabled>Sila pilih negeri</option>
                                    <option value="1">Johor</option>
                                </select>    
                            </div>
                        </div>
                        <div class="col-4 pl-1">
                            <div class="form-group">
                                {{-- <input type="text" id="district" class="form-control" placeholder="Daerah" required name = "district"> --}}
                                <select class="form-select" id="district">
                                    <option selected="" disabled>Sila pilih daerah</option>
                                    <option value="2">Johor Bahru</option>
                                </select>    
                            </div>
                        </div>
                        <div class="col-4 pl-1">
                            <div class="form-group">
                                <input type="text" id="postcode" class="form-control" placeholder="Poskod" required name = "postcode">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mt-3">
                        <div class="col-4 pl-1">
                            <label class="form-label" for="branch_id">Pakej</label>
                            <select class="select2 form-control" id="branch_id" name="branch_id">
                                <option selected="">Sila pilih pakej</option>
                                {{-- @foreach($designations as $designation)
                                <option value="{{$designation->id}}">{{$designation->designation}}</option>
                                @endforeach --}}
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4 mx-3">
            <div class="card-header py-1 d-flex flex-row justify-content-between card-header-divider">
                <div class="col">
                    <h5 class="card-title mt-2">Maklumat Ibu</h5>
                </div>
                <div class="col-auto">
                    <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#mom" aria-expanded="true" title="Collapse">
                        <i class="fas fa-chevron-down text-primary"></i>
                    </button>
                </div>
            </div>

            <div class="collapse multi-collapse show" id="mom">
                <div class="card-body px-3 pt-2 pb-4 w-auto">

                    <div class="form-group row mt-3">
                        <div class="col-6 pl-1">
                            <div class="form-group">
                                <label class="form-label">Nama Ibu</label>                            
                                <input type="text" id="full_name" class="form-control" placeholder="" required name = "full_name">
                            </div>
                        </div>
                        <div class="col-6 pl-1">
                            <div class="form-group">
                                <label class="form-label">Pekerjaan</label>                            
                                <input type="text" id="job" class="form-control" placeholder="" required name = "job">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group row mt-3">
                        <div class="col-6 pl-1">
                            <div class="form-group">
                                <label class="form-label">Alamat E-mel</label>                            
                                <input type="text" id="email" class="form-control" placeholder="" required name = "email">
                            </div>
                        </div>
                        <div class="col-6 pl-1">
                            <div class="form-group">
                                <label class="form-label">No. Telefon</label>                            
                                <input type="text" id="phone_no" class="form-control" placeholder="" required name = "phone_no">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mt-3">
                        <div class="col-12 pl-1">
                            <div class="form-group">
                                <label class="form-label">Alamat Pejabat</label>
                                <input type="text" id="address" class="form-control" placeholder="" required name = "address">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mt-1">
                        <div class="col-4 pl-1">
                            <div class="form-group">
                                {{-- <input type="text" id="state" class="form-control" placeholder="Negeri" required name = "state"> --}}
                                <select class="form-select" id="state">
                                    <option selected="" disabled>Sila pilih negeri</option>
                                    <option value="1">Johor</option>
                                </select>    
                            </div>
                        </div>
                        <div class="col-4 pl-1">
                            <div class="form-group">
                                {{-- <input type="text" id="district" class="form-control" placeholder="Daerah" required name = "district"> --}}
                                <select class="form-select" id="district">
                                    <option selected="" disabled>Sila pilih daerah</option>
                                    <option value="2">Johor Bahru</option>
                                </select>    
                            </div>
                        </div>
                        <div class="col-4 pl-1">
                            <div class="form-group">
                                <input type="text" id="postcode" class="form-control" placeholder="Poskod" required name = "postcode">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mt-3">
                        <div class="col-md-12 pl-1">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions_mom" id="staffRadioButton_mom" value="staff_mom">
                                <label class="form-check-label" for="staffRadioButton_mom">Staff UTM</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions_mom" id="studentRadioButton_mom" value="student_mom">
                                <label class="form-check-label" for="studentRadioButton_mom">Pelajar UTM</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions_mom" id="none_mom" value="none_mom" checked>
                                <label class="form-check-label" for="none_mom">Tidak Berkaitan</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group row mt-1 d-none" id="utmStaff_mom">
                        <div class="col-md-4 pl-1">
                            <input type="text" id="staff_no" class="form-control" placeholder="ID Staff" required name = "staff_no">
                        </div>
                    </div>
 
                    <div class="form-group row mt-1 d-none" id="utmStudent_mom">
                        <div class="col-md-4 pl-1">
                            <input type="text" id="student_no" class="form-control" placeholder="No. Matrik" required name = "student_no">
                        </div>
                    </div>
 
                </div>
            </div>
        </div>

        <div class="card mb-4 mx-3">
            <div class="card-header py-1 d-flex flex-row justify-content-between card-header-divider">
                <div class="col">
                    <h5 class="card-title mt-2">Maklumat Bapa</h5>
                </div>
                <div class="col-auto">
                    <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#dad" aria-expanded="true" title="Collapse">
                        <i class="fas fa-chevron-down text-primary"></i>
                    </button>
                </div>
            </div>

            <div class="collapse multi-collapse show" id="dad">
                <div class="card-body px-3 pt-2 pb-4 w-auto">

                    <div class="form-group row mt-3">
                        <div class="col-6 pl-1">
                            <div class="form-group">
                                <label class="form-label">Nama Bapa</label>                            
                                <input type="text" id="full_name" class="form-control" placeholder="" required name = "full_name">
                            </div>
                        </div>
                        <div class="col-6 pl-1">
                            <div class="form-group">
                                <label class="form-label">Pekerjaan</label>                            
                                <input type="text" id="job" class="form-control" placeholder="" required name = "job">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group row mt-3">
                        <div class="col-6 pl-1">
                            <div class="form-group">
                                <label class="form-label">Alamat E-mel</label>                            
                                <input type="text" id="email" class="form-control" placeholder="" required name = "email">
                            </div>
                        </div>
                        <div class="col-6 pl-1">
                            <div class="form-group">
                                <label class="form-label">No. Telefon</label>                            
                                <input type="text" id="phone_no" class="form-control" placeholder="" required name = "phone_no">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mt-3">
                        <div class="col-12 pl-1">
                            <div class="form-group">
                                <label class="form-label">Alamat Pejabat</label>
                                <input type="text" id="address" class="form-control" placeholder="" required name = "address">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mt-1">
                        <div class="col-4 pl-1">
                            <div class="form-group">
                                {{-- <input type="text" id="state" class="form-control" placeholder="Negeri" required name = "state"> --}}
                                <select class="form-select" id="state">
                                    <option selected="" disabled>Sila pilih negeri</option>
                                    <option value="1">Johor</option>
                                </select>    
                            </div>
                        </div>
                        <div class="col-4 pl-1">
                            <div class="form-group">
                                {{-- <input type="text" id="district" class="form-control" placeholder="Daerah" required name = "district"> --}}
                                <select class="form-select" id="district">
                                    <option selected="" disabled>Sila pilih daerah</option>
                                    <option value="2">Johor Bahru</option>
                                </select>    
                            </div>
                        </div>
                        <div class="col-4 pl-1">
                            <div class="form-group">
                                <input type="text" id="postcode" class="form-control" placeholder="Poskod" required name = "postcode">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mt-3">
                        <div class="col-md-12 pl-1">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions_dad" id="staffRadioButton_dad" value="staff_dad">
                                <label class="form-check-label" for="staffRadioButton_dad">Staff UTM</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions_dad" id="studentRadioButton_dad" value="student_dad">
                                <label class="form-check-label" for="studentRadioButton_dad">Pelajar UTM</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions_dad" id="none_dad" value="none_dad" checked>
                                <label class="form-check-label" for="none_dad">Tidak Berkaitan</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group row mt-1 d-none" id="utmStaff_dad">
                        <div class="col-md-4 pl-1">
                            <input type="text" id="staff_no" class="form-control" placeholder="ID Staff" required name = "staff_no">
                        </div>
                    </div>
 
                    <div class="form-group row mt-1 d-none" id="utmStudent_dad">
                        <div class="col-md-4 pl-1">
                            <input type="text" id="student_no" class="form-control" placeholder="No. Matrik" required name = "student_no">
                        </div>
                    </div>
 
                </div>
            </div>
        </div>

        <div class="col-12 d-flex justify-content-end mb-4">
            <a href="{{ url()->previous() }}" class="btn btn-secondary btn-kembali me-3">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn btn-primary btn-hantar me-3">Hantar</button>
        </div>

    </div>
</div>

@endsection

@section('js')
<script>

    // add or remove input box when radio button is clicked for mom's section
    $('input[name="inlineRadioOptions_mom"]').on('change', function() {
        var selectedValue = $('input[name="inlineRadioOptions_mom"]:checked').val();

        if (selectedValue === 'none_mom') {
            $('#utmStaff_mom').addClass('d-none');
            $('#utmStudent_mom').addClass('d-none');
        } else {
            if (selectedValue === 'staff_mom') {
                $('#utmStaff_mom').removeClass('d-none');
                $('#utmStudent_mom').addClass('d-none');
            } else if (selectedValue === 'student_mom') {
                $('#utmStudent_mom').removeClass('d-none');
                $('#utmStaff_mom').addClass('d-none');
            }
        }
    });

    // add or remove input box when radio button is clicked for dad's section
    $('input[name="inlineRadioOptions_dad"]').on('change', function() {
        var selectedValue = $('input[name="inlineRadioOptions_dad"]:checked').val();

        if (selectedValue === 'none_dad') {
            $('#utmStaff_dad').addClass('d-none');
            $('#utmStudent_dad').addClass('d-none');
        } else {
            if (selectedValue === 'staff_dad') {
                $('#utmStaff_dad').removeClass('d-none');
                $('#utmStudent_dad').addClass('d-none');
            } else if (selectedValue === 'student_dad') {
                $('#utmStudent_dad').removeClass('d-none');
                $('#utmStaff_dad').addClass('d-none');
            }
        }
    });

</script>
@endsection