@extends('layouts.auth-app')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="col-12 d-flex justify-content-end mb-4">
            <a href="{{ url()->previous() }}" class="btn btn-secondary btn-kembali me-3">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>

        <form action="{{ route('pendaftaran.simpan_permohonan') }}" method="POST">
            @csrf
            <!-- Add hidden input fields to store form data -->
            @foreach ($form_data as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
        
            {{-- <div class="card mb-4 mx-3">
                <div class="card-header py-1 d-flex flex-row justify-content-between card-header-divider">
                    <div class="col">
                        <h5 class="card-title mt-2">Adakah anda ingin mendaftar untuk anak yang lain?</h5>
                    </div>
                </div>
                <div class="card-body px-3 pt-2 pb-4 w-auto">
                    <div class="form-group row mt-3">
                        <div class="col-md-12 pl-1">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="yesButton" value="yes">
                                <label class="form-check-label" for="yesButton">Ya</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="noButton" value="no" checked>
                                <label class="form-check-label" for="noButton">Tidak</label>
                            </div>
                        </div>
                    </div>

                </div>
            </div> --}}

            {{-- <div class="card mb-4 mx-3 d-none" id="child_card">
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
                                <label class="form-label" for="full_name">Nama Penuh</label>
                                <input type="text" id="full_name" class="form-control" placeholder="Sila isikan nama penuh anak" name="full_name">
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <div class="col-4 pl-1">
                                <label class="form-label" for="ic_no">No. MyKid</label>                        
                                <input type="text" id="ic_no" class="form-control" placeholder="XXXXXX-XX-XXXX" name="ic_no">
                            </div>
                            <div class="col-4 pl-1">
                                <label class="form-label" for="dob">Tarikh Lahir</label>                        
                                <input type="date" id="dob" class="form-control" placeholder="" name = "dob">
                            </div>
                            <div class="col-4 pl-1">
                                <label class="form-label" for="gender">Jantina</label>                        
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
                                    <input type="text" id="siblings" class="form-control" placeholder="Contoh: 1/3" name = "siblings">
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
                                    <input type="text" id="address1" class="form-control" placeholder="" name = "address1">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mt-1">
                            <div class="col-4 pl-1">
                                <div class="form-group">
                                    <input type="text" id="state" class="form-control" placeholder="Negeri" value="{{ old('state', isset($form_data['state']) ? $form_data['state'] : '' ) }}" name = "state">
                                </div>
                            </div>
                            <div class="col-4 pl-1">
                                <div class="form-group">
                                    <input type="text" id="district" class="form-control" placeholder="Daerah" value="{{ old('district', isset($form_data['district']) ? $form_data['district'] : '' ) }}" name = "district">
                                </div>
                            </div>
                            <div class="col-4 pl-1">
                                <div class="form-group">
                                    <input type="text" id="postcode" class="form-control" placeholder="Poskod" name = "postcode">
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
            </div> --}}

            <div class="card mb-4 mx-3">
                <div class="card-header py-1 d-flex flex-row justify-content-between card-header-divider">
                    <div class="col">
                        <h5 class="card-title mt-2">Pengakuan</h5>
                    </div>
                </div>
                <div class="card-body px-3 pt-2 pb-4 w-auto">
                    <div class="row mt-3">
                        {{-- <div class="col-md-12 pl-1"> --}}
                        <div class="text-primary">
                            Saya mengakui segala maklumat yang saya berikan adalah <b>BENAR</b>. 
                            Sekiranya terdapat sebarang <b>KEPALSUAN/KERAGUAN</b> terhadap maklumat yang saya berikan, 
                            pihak pengurusan berhak untuk <b>MENOLAK</b> permohonan ini.
                        </div>
                        <div class="form-check ms-3 mt-3">
                            <input class="form-check-input" type="checkbox" value="1" id="pengakuan" name="pengakuan" required>
                            <label class="form-check-label" for="pengakuan">Ya/Setuju</label>
                        </div>
                        {{-- </div> --}}
                    </div>

                </div>
            </div>

            <div class="col-12 d-flex justify-content-end mb-4">
                <a href="{{ url()->previous() }}" class="btn btn-secondary btn-kembali me-3">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary btn-hantar me-3">Hantar</button>
            </div>
        </form>

    </div>
</div>

@endsection

@section('js')
<script>

// add or remove input box when radio button is clicked for mom's section
$('input[name="inlineRadioOptions"]').on('change', function() {
        // var selectedValue = $('input[name="inlineRadioOptions"]:checked').val();
        var selectedValue = $(this).val();

        if (selectedValue === 'yes') {
            $('#child_card').removeClass('d-none');
            $('#child_card input, #child_card select').attr('required', 'required');
        } else {
            $('#child_card').addClass('d-none');
            $('#child_card input, #child_card select').removeAttr('required');
        }
    });   

</script>
@endsection