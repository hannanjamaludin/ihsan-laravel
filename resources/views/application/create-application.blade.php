@extends('layouts.auth-app')
@section('content')

<div class="row">
    <div class="col-12">
        <form method="POST" action="{{ route('pendaftaran.store_application_session') }}">
            @csrf 
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

                        <div class="form-group row">
                            <div class="col-12 pl-1">
                                <label class="form-label" for="child_full_name">Nama Penuh</label>
                                <input type="text" id="child_full_name" class="form-control" placeholder="Sila isikan nama penuh anak" required name="full_name">
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
                                <select class="form-select" id="gender" name="gender">
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
                                    <input type="text" id="allergy" class="form-control" placeholder="Nyatakan jika ada" name = "allergy">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <div class="col-6 pl-1">
                                <div class="form-group">
                                    <label class="form-label">Kelainan Upaya</label>                            
                                    <input type="text" id="disability" class="form-control" placeholder="Nyatakan jika ada" name = "disability">
                                </div>
                            </div>
                            <div class="col-6 pl-1">
                                <div class="form-group">
                                    <label class="form-label">Penyakit Kronik</label>                            
                                    <input type="text" id="illness" class="form-control" placeholder="Nyatakan jika ada" name = "illness">                                
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <div class="col-12 pl-1">
                                <div class="form-group">
                                    <label class="form-label">Masalah Kesihatan & Pembelajaran</label>                            
                                    <input type="text" id="study" class="form-control" placeholder="Nyatakan jika ada" name = "study">
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
                                    <select class="form-select" id="state" name="state" required>
                                        <option selected="" disabled>Sila pilih negeri</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}">{{ $state->state }}</option>
                                        @endforeach
                                    </select>    
                                </div>
                            </div>
                            <div class="col-4 pl-1">
                                <div class="form-group">
                                    {{-- <input type="text" id="district" class="form-control" placeholder="Daerah" required name = "district"> --}}
                                    <select class="form-select" id="district" name="district" required>
                                        <option selected="" disabled>Sila pilih daerah</option>
                                        @foreach ($districts as $district)
                                            <option value="{{ $district->id }}">{{ $district->district }}</option>
                                        @endforeach
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
                                <select class="form-select" id="branch_id" name="branch_id" required>
                                    <option selected="">Sila pilih pakej</option>
                                    @foreach($branch as $br)
                                        <option value="{{$br->id}}">{{$br->branch_name}}</option>
                                    @endforeach
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
                                    <input type="text" id="mom_full_name" class="form-control" placeholder="" required name = "mom_full_name">
                                </div>
                            </div>
                            <div class="col-6 pl-1">
                                <div class="form-group">
                                    <label class="form-label">Pekerjaan</label>                            
                                    <input type="text" id="mom_job" class="form-control" placeholder="" required name = "mom_job">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row mt-3">
                            <div class="col-6 pl-1">
                                <div class="form-group">
                                    <label class="form-label">Alamat E-mel</label>                            
                                    <input type="text" id="mom_email" class="form-control" placeholder="" required name = "mom_email">
                                </div>
                            </div>
                            <div class="col-6 pl-1">
                                <div class="form-group">
                                    <label class="form-label">No. Telefon</label>                            
                                    <input type="text" id="mom_phone_no" class="form-control" placeholder="" required name = "mom_phone_no">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <div class="col-12 pl-1">
                                <div class="form-group">
                                    <label class="form-label">Alamat Pejabat</label>
                                    <input type="text" id="m_office_address" class="form-control" placeholder="" required name = "m_office_address">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mt-1">
                            <div class="col-4 pl-1">
                                <div class="form-group">
                                    {{-- <input type="text" id="state" class="form-control" placeholder="Negeri" required name = "state"> --}}
                                    <select class="form-select" id="m_office_state" name="m_office_state" required>
                                        <option selected="" disabled>Sila pilih negeri</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->state }}">{{ $state->state }}</option>
                                        @endforeach
                                    </select>    
                                </div>
                            </div>
                            <div class="col-4 pl-1">
                                <div class="form-group">
                                    {{-- <input type="text" id="district" class="form-control" placeholder="Daerah" required name = "district"> --}}
                                    <select class="form-select" id="m_office_district" name="m_office_district" required>
                                        <option selected="" disabled>Sila pilih daerah</option>
                                        @foreach ($districts as $district)
                                            <option value="{{ $district->id }}">{{ $district->district }}</option>
                                        @endforeach
                                    </select>    
                                </div>
                            </div>
                            <div class="col-4 pl-1">
                                <div class="form-group">
                                    <input type="text" id="m_office_postcode" class="form-control" placeholder="Poskod" required name = "m_office_postcode">
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
                                <input type="text" id="mom_staff_no" class="form-control" placeholder="ID Staff" name = "mom_staff_no">
                            </div>
                        </div>
    
                        <div class="form-group row mt-1 d-none" id="utmStudent_mom">
                            <div class="col-md-4 pl-1">
                                <input type="text" id="mom_student_no" class="form-control" placeholder="No. Matrik" name = "mom_student_no">
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
                                    <input type="text" id="dad_full_name" class="form-control" placeholder="" required name = "dad_full_name">
                                </div>
                            </div>
                            <div class="col-6 pl-1">
                                <div class="form-group">
                                    <label class="form-label">Pekerjaan</label>                            
                                    <input type="text" id="dad_job" class="form-control" placeholder="" required name = "dad_job">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row mt-3">
                            <div class="col-6 pl-1">
                                <div class="form-group">
                                    <label class="form-label">Alamat E-mel</label>                            
                                    <input type="text" id="dad_email" class="form-control" placeholder="" required name = "dad_email">
                                </div>
                            </div>
                            <div class="col-6 pl-1">
                                <div class="form-group">
                                    <label class="form-label">No. Telefon</label>                            
                                    <input type="text" id="dad_phone_no" class="form-control" placeholder="" required name = "dad_phone_no">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <div class="col-12 pl-1">
                                <div class="form-group">
                                    <label class="form-label">Alamat Pejabat</label>
                                    <input type="text" id="d_office_address" class="form-control" placeholder="" required name = "d_office_address">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mt-1">
                            <div class="col-4 pl-1">
                                <div class="form-group">
                                    {{-- <input type="text" id="state" class="form-control" placeholder="Negeri" required name = "state"> --}}
                                    <select class="form-select" id="d_office_state" name="d_office_state" required>
                                        <option selected="" disabled>Sila pilih negeri</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}">{{ $state->state }}</option>
                                        @endforeach
                                    </select>    
                                </div>
                            </div>
                            <div class="col-4 pl-1">
                                <div class="form-group">
                                    {{-- <input type="text" id="district" class="form-control" placeholder="Daerah" required name = "district"> --}}
                                    <select class="form-select" id="d_office_district" name="d_office_district" required>
                                        <option selected="" disabled>Sila pilih daerah</option>
                                        @foreach ($districts as $district)
                                            <option value="{{ $district->id }}">{{ $district->district }}</option>
                                        @endforeach
                                    </select>    
                                </div>
                            </div>
                            <div class="col-4 pl-1">
                                <div class="form-group">
                                    <input type="text" id="d_office_postcode" class="form-control" placeholder="Poskod" required name = "d_office_postcode">
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
                                <input type="text" id="dad_staff_no" class="form-control" placeholder="ID Staff" name = "dad_staff_no">
                            </div>
                        </div>
    
                        <div class="form-group row mt-1 d-none" id="utmStudent_dad">
                            <div class="col-md-4 pl-1">
                                <input type="text" id="dad_student_no" class="form-control" placeholder="No. Matrik" name = "dad_student_no">
                            </div>
                        </div>
    
                    </div>
                </div> 
            </div>

            <div class="col-12 d-flex justify-content-end mb-4">
                <a href="{{ url()->previous() }}" class="btn btn-secondary btn-kembali me-3">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary btn-kembali me-3">
                    Seterusnya <i class="fa fa-arrow-right"></i>
                </button>
                {{-- <button type="submit" class="btn btn-primary btn-hantar me-3">Hantar</button> --}}
            </div>
        </form>

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