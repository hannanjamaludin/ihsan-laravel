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
                                <input type="text" id="child_full_name" class="form-control" placeholder="Sila isikan nama penuh anak" value="{{ old('child_full_name', isset($form_data['child_full_name']) ? $form_data['child_full_name'] : '' ) }}" name="child_full_name" required>
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <div class="col-4 pl-1">
                                <label class="form-label" for="ic_no">No. MyKid</label>                        
                                <input type="text" id="ic_no" class="form-control" placeholder="XXXXXX-XX-XXXX" value="{{ old('ic_no', isset($form_data['ic_no']) ? $form_data['ic_no'] : '' ) }}" name="ic_no" required>
                            </div>
                            <div class="col-4 pl-1">
                                <label class="form-label" for="dob">Tarikh Lahir</label>                        
                                <input type="date" id="dob" class="form-control" placeholder="" value="{{ old('dob', isset($form_data['dob']) ? $form_data['dob'] : '' ) }}" name = "dob" required>
                            </div>
                            <div class="col-4 pl-1">
                                <label class="form-label" for="gender">Jantina</label>                        
                                {{-- <input type="text" id="gender" class="form-control" placeholder="" required name = "gender"> --}}
                                <select class="form-select" id="gender" name="gender">
                                    <option selected="" disabled {{ empty($form_data['gender']) ? 'selected' : '' }}>Sila pilih jantina</option>
                                    <option value="lelaki" {{ isset($form_data['gender']) && $form_data['gender'] == 'lelaki' ? 'selected' : '' }}>Lelaki</option>
                                    <option value="perempuan" {{ isset($form_data['gender']) && $form_data['gender'] == 'perempuan' ? 'selected' : '' }}>Perempuan</option>                                </select>
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <div class="col-6 pl-1">
                                <div class="form-group">
                                    <label class="form-label">Adik-beradik (Anak ke Berapa)</label>                            
                                    <input type="text" id="siblings" class="form-control" placeholder="Contoh: 1/3" value="{{ old('siblings', isset($form_data['siblings']) ? $form_data['siblings'] : '' ) }}" name = "siblings" required>
                                </div>
                            </div>
                            <div class="col-6 pl-1">
                                <div class="form-group">
                                    <label class="form-label">Alahan</label>                            
                                    <input type="text" id="allergy" class="form-control" placeholder="Nyatakan jika ada" value="{{ old('allergy', isset($form_data['allergy']) ? $form_data['allergy'] : '' ) }}" name = "allergy">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <div class="col-6 pl-1">
                                <div class="form-group">
                                    <label class="form-label">Kelainan Upaya</label>                            
                                    <input type="text" id="disability" class="form-control" placeholder="Nyatakan jika ada" value="{{ old('disability', isset($form_data['disability']) ? $form_data['disability'] : '' ) }}" name = "disability">
                                </div>
                            </div>
                            <div class="col-6 pl-1">
                                <div class="form-group">
                                    <label class="form-label">Penyakit Kronik</label>                            
                                    <input type="text" id="illness" class="form-control" placeholder="Nyatakan jika ada" value="{{ old('illness', isset($form_data['illness']) ? $form_data['illness'] : '' ) }}" name = "illness">                                
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <div class="col-12 pl-1">
                                <div class="form-group">
                                    <label class="form-label">Masalah Kesihatan & Pembelajaran</label>                            
                                    <input type="text" id="study" class="form-control" placeholder="Nyatakan jika ada" value="{{ old('study', isset($form_data['study']) ? $form_data['study'] : '' ) }}" name = "study">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <div class="col-12 pl-1">
                                <div class="form-group">
                                    <label class="form-label">Alamat Rumah</label>
                                    <input type="text" id="address1" class="form-control" placeholder="" value="{{ old('address1', isset($form_data['address1']) ? $form_data['address1'] : '' ) }}" name = "address1" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mt-1">
                            <div class="col-4 pl-1">
                                <div class="form-group">
                                    <input type="text" id="state" class="form-control" placeholder="Negeri" value="{{ old('state', isset($form_data['state']) ? $form_data['state'] : '' ) }}" name = "state" required>
                                    {{-- <select class="form-select" id="state" name="state" required>
                                        <option selected="" disabled>Sila pilih negeri</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}" selected="selected">{{ $state->state }}</option>
                                        @endforeach
                                    </select>     --}}
                                </div>
                            </div>
                            <div class="col-4 pl-1">
                                <div class="form-group">
                                    <input type="text" id="district" class="form-control" placeholder="Daerah" value="{{ old('district', isset($form_data['district']) ? $form_data['district'] : '' ) }}" name = "district" required>
                                    {{-- <select class="form-select" id="district" name="district" required>
                                        <option selected="" disabled>Sila pilih daerah</option>
                                        @foreach ($districts as $district)
                                            <option value="{{ $district->id }}">{{ $district->district }}</option>
                                        @endforeach
                                    </select>     --}}
                                </div>
                            </div>
                            <div class="col-4 pl-1">
                                <div class="form-group">
                                    <input type="text" id="postcode" class="form-control" placeholder="Poskod" value="{{ old('postcode', isset($form_data['postcode']) ? $form_data['postcode'] : '' ) }}" name = "postcode" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <div class="col-4 pl-1">
                                <label class="form-label" for="branch_id">Pakej</label>
                                <select class="form-select" id="branch_id" name="branch_id" required>
                                    <option selected="" {{ empty($form_data['branch_id']) ? 'selected' : '' }}>Sila pilih pakej</option>
                                    @foreach($branch as $br)
                                        <option value="{{ $br->id }}" {{ isset($form_data['branch_id']) && $form_data['branch_id'] == $br->id ? 'selected' : '' }}>{{ $br->branch_name }}</option>
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
                                    <input type="text" id="mom_full_name" class="form-control" placeholder="" value="{{ old('mom_full_name', isset($form_data['mom_full_name']) ? $form_data['mom_full_name'] : '' ) }}" name = "mom_full_name" required>
                                </div>
                            </div>
                            <div class="col-6 pl-1">
                                <div class="form-group">
                                    <label class="form-label">Pekerjaan</label>                            
                                    <input type="text" id="mom_job" class="form-control" placeholder="" value="{{ old('mom_job', isset($form_data['mom_job']) ? $form_data['mom_job'] : '' ) }}" name = "mom_job" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row mt-3">
                            <div class="col-6 pl-1">
                                <div class="form-group">
                                    <label class="form-label">Alamat E-mel</label>                            
                                    <input type="text" id="mom_email" class="form-control" placeholder="" value="{{ old('mom_email', isset($form_data['mom_email']) ? $form_data['mom_email'] : '' ) }}" name = "mom_email" required>
                                </div>
                            </div>
                            <div class="col-6 pl-1">
                                <div class="form-group">
                                    <label class="form-label">No. Telefon</label>                            
                                    <input type="text" id="mom_phone_no" class="form-control" placeholder="" value="{{ old('mom_phone_no', isset($form_data['mom_phone_no']) ? $form_data['mom_phone_no'] : '' ) }}" name = "mom_phone_no" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <div class="col-12 pl-1">
                                <div class="form-group">
                                    <label class="form-label">Alamat Pejabat</label>
                                    <input type="text" id="m_office_address" class="form-control" placeholder="" value="{{ old('m_office_address', isset($form_data['m_office_address']) ? $form_data['m_office_address'] : '' ) }}" name = "m_office_address" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mt-1">
                            <div class="col-4 pl-1">
                                <div class="form-group">
                                    <input type="text" id="m_office_state" class="form-control" placeholder="Negeri" value="{{ old('m_office_state', isset($form_data['m_office_state']) ? $form_data['m_office_state'] : '' ) }}" name = "m_office_state" required>
                                    {{-- <select class="form-select" id="m_office_state" name="m_office_state" required>
                                        <option selected="" disabled>Sila pilih negeri</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->state }}">{{ $state->state }}</option>
                                        @endforeach
                                    </select>     --}}
                                </div>
                            </div>
                            <div class="col-4 pl-1">
                                <div class="form-group">
                                    <input type="text" id="m_office_district" class="form-control" placeholder="Daerah" value="{{ old('m_office_district', isset($form_data['m_office_district']) ? $form_data['m_office_district'] : '' ) }}" name = "m_office_district" required>
                                    {{-- <select class="form-select" id="m_office_district" name="m_office_district" required>
                                        <option selected="" disabled>Sila pilih daerah</option>
                                        @foreach ($districts as $district)
                                            <option value="{{ $district->id }}">{{ $district->district }}</option>
                                        @endforeach
                                    </select>     --}}
                                </div>
                            </div>
                            <div class="col-4 pl-1">
                                <div class="form-group">
                                    <input type="text" id="m_office_postcode" class="form-control" placeholder="Poskod" value="{{ old('m_office_postcode', isset($form_data['m_office_postcode']) ? $form_data['m_office_postcode'] : '' ) }}" name = "m_office_postcode" required>
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
                                <input type="text" id="mom_staff_no" class="form-control" placeholder="ID Staff" value="{{ old('mom_staff_no', isset($form_data['mom_staff_no']) ? $form_data['mom_staff_no'] : '' ) }}" name = "mom_staff_no">
                            </div>
                        </div>
    
                        <div class="form-group row mt-1 d-none" id="utmStudent_mom">
                            <div class="col-md-4 pl-1">
                                <input type="text" id="mom_student_no" class="form-control" placeholder="No. Matrik" value="{{ old('mom_student_no', isset($form_data['mom_student_no']) ? $form_data['mom_student_no'] : '' ) }}" name = "mom_student_no">
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
                                    <input type="text" id="dad_full_name" class="form-control" placeholder="" value="{{ old('dad_full_name', isset($form_data['dad_full_name']) ? $form_data['dad_full_name'] : '' ) }}" name = "dad_full_name" required>
                                </div>
                            </div>
                            <div class="col-6 pl-1">
                                <div class="form-group">
                                    <label class="form-label">Pekerjaan</label>                            
                                    <input type="text" id="dad_job" class="form-control" placeholder="" value="{{ old('dad_job', isset($form_data['dad_job']) ? $form_data['dad_job'] : '' ) }}" name = "dad_job" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row mt-3">
                            <div class="col-6 pl-1">
                                <div class="form-group">
                                    <label class="form-label">Alamat E-mel</label>                            
                                    <input type="text" id="dad_email" class="form-control" placeholder="" value="{{ old('dad_email', isset($form_data['dad_email']) ? $form_data['dad_email'] : '' ) }}" name = "dad_email" required>
                                </div>
                            </div>
                            <div class="col-6 pl-1">
                                <div class="form-group">
                                    <label class="form-label">No. Telefon</label>                            
                                    <input type="text" id="dad_phone_no" class="form-control" placeholder="" value="{{ old('dad_phone_no', isset($form_data['dad_phone_no']) ? $form_data['dad_phone_no'] : '' ) }}" name = "dad_phone_no" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <div class="col-12 pl-1">
                                <div class="form-group">
                                    <label class="form-label">Alamat Pejabat</label>
                                    <input type="text" id="d_office_address" class="form-control" placeholder="" value="{{ old('d_office_address', isset($form_data['d_office_address']) ? $form_data['d_office_address'] : '' ) }}" name = "d_office_address" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mt-1">
                            <div class="col-4 pl-1">
                                <div class="form-group">
                                    <input type="text" id="d_office_state" class="form-control" placeholder="Negeri" value="{{ old('d_office_state', isset($form_data['d_office_state']) ? $form_data['d_office_state'] : '' ) }}" name = "d_office_state" required>
                                    {{-- <select class="form-select" id="d_office_state" name="d_office_state" required>
                                        <option selected="" disabled>Sila pilih negeri</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}">{{ $state->state }}</option>
                                        @endforeach
                                    </select>     --}}
                                </div>
                            </div>
                            <div class="col-4 pl-1">
                                <div class="form-group">
                                    <input type="text" id="d_office_district" class="form-control" placeholder="Daerah" value="{{ old('d_office_district', isset($form_data['d_office_district']) ? $form_data['d_office_district'] : '' ) }}" name = "d_office_district" required>
                                    {{-- <select class="form-select" id="d_office_district" name="d_office_district" required>
                                        <option selected="" disabled>Sila pilih daerah</option>
                                        @foreach ($districts as $district)
                                            <option value="{{ $district->id }}">{{ $district->district }}</option>
                                        @endforeach
                                    </select>     --}}
                                </div>
                            </div>
                            <div class="col-4 pl-1">
                                <div class="form-group">
                                    <input type="text" id="d_office_postcode" class="form-control" placeholder="Poskod" value="{{ old('d_office_postcode', isset($form_data['d_office_postcode']) ? $form_data['d_office_postcode'] : '' ) }}" name = "d_office_postcode" required>
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
                                <input type="text" id="dad_staff_no" class="form-control" placeholder="ID Staff" value="{{ old('dad_staff_no', isset($form_data['dad_staff_no']) ? $form_data['dad_staff_no'] : '' ) }}" name = "dad_staff_no">
                            </div>
                        </div>
    
                        <div class="form-group row mt-1 d-none" id="utmStudent_dad">
                            <div class="col-md-4 pl-1">
                                <input type="text" id="dad_student_no" class="form-control" placeholder="No. Matrik" value="{{ old('dad_student_no', isset($form_data['dad_student_no']) ? $form_data['dad_student_no'] : '' ) }}" name = "dad_student_no">
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

$(document).ready(function() {
    loadSelectedRadioButton('mom');
    loadSelectedRadioButton('dad');

    // Call the handleRadioChange function for mom's and dad's sections
    handleRadioChange('mom');
    handleRadioChange('dad');

    var selectedMom = localStorage.getItem('selectedRadioButton_mom');
    var selectedDad = localStorage.getItem('selectedRadioButton_dad');

    if (selectedMom !== null) {
        $('input[name="inlineRadioOptions_mom"][value="' + selectedMom + '"]').prop('checked', true);
    } else {
        $('input[name="inlineRadioOptions_mom"][value="none_mom"]').prop('checked', true);
    }

    if (selectedDad !== null) {
        $('input[name="inlineRadioOptions_dad"][value="' + selectedDad + '"]').prop('checked', true);
    } else {
        $('input[name="inlineRadioOptions_dad"][value="none_dad"]').prop('checked', true);
    }
});

// Function to add or remove input box when radio button is clicked for a specific section
function handleRadioChange(section) {
    $('input[name="inlineRadioOptions_' + section + '"]').on('change', function() {
        var selectedValue = $(this).val();
        var staffSelector = '#utmStaff_' + section;
        var studentSelector = '#utmStudent_' + section;

        if (selectedValue === 'none_' + section) {
            $(staffSelector).addClass('d-none');
            $(studentSelector).addClass('d-none');
            $(staffSelector + ' input, ' + studentSelector + ' input').removeAttr('required');
        } else {
            if (selectedValue === 'staff_' + section) {
                $(staffSelector).removeClass('d-none');
                $(studentSelector).addClass('d-none');
                $(staffSelector + ' input').attr('required', true);
            } else if (selectedValue === 'student_' + section) {
                $(studentSelector).removeClass('d-none');
                $(staffSelector).addClass('d-none');
                $(studentSelector + ' input').attr('required', true);
            }
        }

        saveSelectedRadioButton(section);
    });
}

// Function to save the selected radio button value in local storage for a specific section
function saveSelectedRadioButton(section) {
    var selectedValue = $('input[name="inlineRadioOptions_' + section + '"]:checked').val();
    localStorage.setItem('selectedRadioButton_' + section, selectedValue);
}

// Function to retrieve the selected radio button value from local storage and set it as checked for a specific section
function loadSelectedRadioButton(section) {
    var selectedValue = localStorage.getItem('selectedRadioButton_' + section);
    if (selectedValue !== null) {
        $('input[name="inlineRadioOptions_' + section + '"]').removeAttr('checked');
        $('input[name="inlineRadioOptions_' + section + '"][value="' + selectedValue + '"]').prop('checked', true);
    }
}

    // $('#state').on('change', function(e){
    //     var parent_id = e.target.value;
    //     console.log("masuk state onchange " + parent_id);

    //     $.ajax({
    //         url: "{{ route('pendaftaran.daerah') }}",
    //         type: 'POST',
    //         data: {
    //             '_token': '{{ csrf_token() }}',
    //             'id': $('#state').val(),
    //         },
    //         success: function(data){
    //             $('#district').empty();
    //             $('#district').append('<option selected="" disabled>Sila pilih daerah</option>');
    //             $.each(data.listDistricts, function(index, value){
    //                 $('#district').append('<option value="' + value + '">' + index + '</option>');
    //             })
    //         }
    //     })
    // });

</script>
@endsection