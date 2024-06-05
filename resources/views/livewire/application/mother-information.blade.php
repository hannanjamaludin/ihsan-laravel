<div>
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
                            @if ($mom !== null)
                                <input type="text" id="mom_full_name" class="form-control" placeholder="" value="{{ old('mom_full_name', isset($form_data['mom_full_name']) ? $form_data['mom_full_name'] : $mom->full_name ) }}" name = "mom_full_name" required>
                            @else
                                <input type="text" id="mom_full_name" class="form-control" placeholder="" value="{{ old('mom_full_name', isset($form_data['mom_full_name']) ? $form_data['mom_full_name'] : '' ) }}" name = "mom_full_name" required>
                            @endif                     
                        </div>
                    </div>
                    <div class="col-6 pl-1">
                        <div class="form-group">
                            <label class="form-label">Pekerjaan</label>    
                            @if ($mom !== null)
                                <input type="text" id="mom_job" class="form-control" placeholder="" value="{{ old('mom_job', isset($form_data['mom_job']) ? $form_data['mom_job'] : $mom->job ) }}" name = "mom_job" required>
                            @else
                                <input type="text" id="mom_job" class="form-control" placeholder="" value="{{ old('mom_job', isset($form_data['mom_job']) ? $form_data['mom_job'] : '' ) }}" name = "mom_job" required>
                            @endif                     
                        </div>
                    </div>
                </div>
                
                <div class="form-group row mt-3">
                    <div class="col-6 pl-1">
                        <div class="form-group">
                            <label class="form-label">Alamat E-mel</label>   
                            @if ($mom !== null)
                                <input type="text" id="mom_email" class="form-control" placeholder="" value="{{ old('mom_email', isset($form_data['mom_email']) ? $form_data['mom_email'] : $mom->email ) }}" name = "mom_email" required>
                            @else
                                <input type="text" id="mom_email" class="form-control" placeholder="" value="{{ old('mom_email', isset($form_data['mom_email']) ? $form_data['mom_email'] : '' ) }}" name = "mom_email" required>
                            @endif                         
                        </div>
                    </div>
                    <div class="col-6 pl-1">
                        <div class="form-group">
                            <label class="form-label">No. Telefon</label>   
                            @if ($mom !== null)
                                <input type="text" id="mom_phone_no" class="form-control" placeholder="" value="{{ old('mom_phone_no', isset($form_data['mom_phone_no']) ? $form_data['mom_phone_no'] : $mom->phone_no ) }}" name = "mom_phone_no" required>
                            @else                                        
                                <input type="text" id="mom_phone_no" class="form-control" placeholder="" value="{{ old('mom_phone_no', isset($form_data['mom_phone_no']) ? $form_data['mom_phone_no'] : '' ) }}" name = "mom_phone_no" required>
                            @endif                         
                        </div>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <div class="col-12 pl-1">
                        <div class="form-group">
                            <label class="form-label">Alamat Pejabat</label>
                            @if ($mom !== null)
                                <input type="text" id="m_office_address" class="form-control" placeholder="Alamat Pejabat" value="{{ old('m_office_address', isset($form_data['m_office_address']) ? $form_data['m_office_address'] : $mom->address ) }}" name = "m_office_address" required>
                            @else                                        
                                <input type="text" id="m_office_address" class="form-control" placeholder="Alamat Pejabat" value="{{ old('m_office_address', isset($form_data['m_office_address']) ? $form_data['m_office_address'] : '' ) }}" name = "m_office_address" required>
                            @endif                         
                        </div>
                    </div>
                </div>

                <div class="form-group row mt-1">
                    <div class="col-4 pl-1">
                        <div class="form-group">
                            {{-- @if ($mom !== null)
                                <input type="text" id="m_office_state" class="form-control" placeholder="" value="{{ old('m_office_state', isset($form_data['m_office_state']) ? $form_data['m_office_state'] : $mom->state ) }}" name = "m_office_state" required>
                            @else                                        
                                <input type="text" id="m_office_state" class="form-control" placeholder="" value="{{ old('m_office_state', isset($form_data['m_office_state']) ? $form_data['m_office_state'] : '' ) }}" name = "m_office_state" required>
                            @endif                          --}}
                            <select class="form-select" id="m_office_state" name="m_office_state" wire:model="mOfficeState" required>
                                <option value="">Sila pilih negeri</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->state }}" {{ ($mom !== null && $mom->state === $state->state) ? 'selected' : '' }}>{{ $state->state }}</option>
                                @endforeach
                            </select>    
                        </div>
                    </div>
                    <div class="col-4 pl-1">
                        <div class="form-group">
                            {{-- @if ($mom !== null)
                                <input type="text" id="m_office_district" class="form-control" placeholder="" value="{{ old('m_office_district', isset($form_data['m_office_district']) ? $form_data['m_office_district'] : $mom->district ) }}" name = "m_office_district" required>
                            @else                                        
                                <input type="text" id="m_office_district" class="form-control" placeholder="" value="{{ old('m_office_district', isset($form_data['m_office_district']) ? $form_data['m_office_district'] : '' ) }}" name = "m_office_district" required>
                            @endif                          --}}
                            <select class="form-select" id="m_office_district" name="m_office_district" wire:model="mOfficeDistrict" required>
                                <option value="" selected disabled>Sila pilih daerah</option>
                                @foreach ($districts as $district)
                                    <option value="{{ $district->district }}" {{ ($mom !== null && $mom->district === $district->district) ? 'selected' : '' }}>{{ $district->district }}</option>
                                @endforeach
                            </select>    
                        </div>
                    </div>
                    <div class="col-4 pl-1">
                        <div class="form-group">
                            @if ($mom !== null)
                                <input type="text" id="m_office_postcode" class="form-control" placeholder="Poskod" value="{{ old('m_office_postcode', isset($form_data['m_office_postcode']) ? $form_data['m_office_postcode'] : $mom->postcode ) }}" name = "m_office_postcode" required>
                            @else                                        
                                <input type="text" id="m_office_postcode" class="form-control" placeholder="Poskod" value="{{ old('m_office_postcode', isset($form_data['m_office_postcode']) ? $form_data['m_office_postcode'] : '' ) }}" name = "m_office_postcode" required>
                            @endif                         
                        </div>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <div class="col-md-12 pl-1">
                        @if ($mom !== null)
                            <div class="form-check form-check-inline">
                                @if ($mom->staff_no !== null)
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions_mom" id="staffRadioButton_mom" value="staff_mom" checked wire:click="addInputBox('staffRadioButton_mom')">
                                @else
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions_mom" id="staffRadioButton_mom" value="staff_mom" wire:click="addInputBox('staffRadioButton_mom')">
                                @endif
                                <label class="form-check-label" for="staffRadioButton_mom">Staff UTM</label>
                            </div>
                            <div class="form-check form-check-inline">
                                @if ($mom->student_no !== null)
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions_mom" id="studentRadioButton_mom" value="student_mom" checked wire:click="addInputBox('studentRadioButton_mom')">
                                @else
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions_mom" id="studentRadioButton_mom" value="student_mom" wire:click="addInputBox('studentRadioButton_mom')">
                                @endif
                                <label class="form-check-label" for="studentRadioButton_mom">Pelajar UTM</label>
                            </div>
                            <div class="form-check form-check-inline">
                                @if ($mom->staff_no === null && $mom->student_no === null)
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions_mom" id="none_mom" value="none_mom" checked wire:click="removeInputBox">
                                @else
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions_mom" id="none_mom" value="none_mom" wire:click="removeInputBox">
                                @endif
                                <label class="form-check-label" for="none_mom">Tidak Berkaitan</label>
                            </div>
                        @else
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions_mom" id="staffRadioButton_mom" value="staff_mom" wire:click="addInputBox('staffRadioButton_mom')">
                                <label class="form-check-label" for="staffRadioButton_mom">Staff UTM</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions_mom" id="studentRadioButton_mom" value="student_mom" wire:click="addInputBox('studentRadioButton_mom')">
                                <label class="form-check-label" for="studentRadioButton_mom">Pelajar UTM</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions_mom" id="none_mom" value="none_mom" checked wire:click="removeInputBox">
                                <label class="form-check-label" for="none_mom">Tidak Berkaitan</label>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="form-group row mt-1 @if($initialStaffChecked) @else d-none @endif" id="utmStaff_mom">
                    <div class="col-md-4 pl-1">
                        @if ($mom !== null)
                            <input type="text" id="mom_staff_no" class="form-control" placeholder="No. Staff UTM" value="{{ old('mom_staff_no', isset($form_data['mom_staff_no']) ? $form_data['mom_staff_no'] : $mom->staff_no ) }}" name = "mom_staff_no" >
                        @else
                            <input type="text" id="mom_staff_no" class="form-control" placeholder="No. Staff UTM" value="{{ old('mom_staff_no', isset($form_data['mom_staff_no']) ? $form_data['mom_staff_no'] : '' ) }}" name = "mom_staff_no" >
                        @endif                     
                    </div>
                </div>

                <div class="form-group row mt-1 @if($initialStudentChecked) @else d-none @endif" id="utmStudent_mom">
                    <div class="col-md-4 pl-1">
                        @if ($mom !== null)
                            <input type="text" id="mom_student_no" class="form-control" placeholder="No. Matrik" value="{{ old('mom_student_no', isset($form_data['mom_student_no']) ? $form_data['mom_student_no'] : $mom->student_no ) }}" name = "mom_student_no" >
                        @else
                            <input type="text" id="mom_student_no" class="form-control" placeholder="No. Matrik" value="{{ old('mom_student_no', isset($form_data['mom_student_no']) ? $form_data['mom_student_no'] : '' ) }}" name = "mom_student_no" >
                        @endif                     
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
