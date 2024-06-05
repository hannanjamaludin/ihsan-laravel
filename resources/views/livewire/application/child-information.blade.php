<div>
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
                            <option value="perempuan" {{ isset($form_data['gender']) && $form_data['gender'] == 'perempuan' ? 'selected' : '' }}>Perempuan</option>                                
                        </select>
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
                            <input type="text" id="address1" class="form-control" placeholder="Alamat Rumah" value="{{ old('address1', isset($form_data['address1']) ? $form_data['address1'] : '' ) }}" name = "address1" required>
                        </div>
                    </div>
                </div>

                <div class="form-group row mt-1">
                    <div class="col-4 pl-1">
                        <div class="form-group">
                            {{-- <input type="text" id="state" class="form-control" placeholder="Negeri" value="{{ old('state', isset($form_data['state']) ? $form_data['state'] : '' ) }}" name = "state" required> --}}
                            <select class="form-select" id="state" name="state" wire:model="selectState" required>
                                <option value="">Sila pilih negeri</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->state }}">{{ $state->state }}</option>
                                @endforeach
                            </select>    
                        </div>
                    </div>
                    <div class="col-4 pl-1">
                        <div class="form-group">
                            {{-- <input type="text" id="district" class="form-control" placeholder="Daerah" value="{{ old('district', isset($form_data['district']) ? $form_data['district'] : '' ) }}" name = "district" required> --}}
                            <select class="form-select" id="district" name="district" required>
                                <option selected="" disabled>Sila pilih daerah</option>
                                @foreach ($districts as $district)
                                    <option value="{{ $district->district }}">{{ $district->district }}</option>
                                @endforeach
                            </select>    
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
                    <div class="col-4 pl-1">
                        <label class="form-label" for="enroll_date">Tarikh Masuk</label>                        
                        <input type="date" id="enroll_date" class="form-control" placeholder="" value="{{ old('enroll_date', isset($form_data['enroll_date']) ? $form_data['enroll_date'] : '' ) }}" name = "enroll_date" required>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
