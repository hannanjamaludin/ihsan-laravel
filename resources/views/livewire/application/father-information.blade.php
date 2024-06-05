<div>
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
                            @if ($dad !== null)
                                <input type="text" id="dad_full_name" class="form-control" placeholder="" value="{{ old('dad_full_name', isset($form_data['dad_full_name']) ? $form_data['dad_full_name'] : $dad->full_name ) }}" name = "dad_full_name" required>
                            @else
                                <input type="text" id="dad_full_name" class="form-control" placeholder="" value="{{ old('dad_full_name', isset($form_data['dad_full_name']) ? $form_data['dad_full_name'] : '' ) }}" name = "dad_full_name" required>
                            @endif                     
                        </div>
                    </div>
                    <div class="col-6 pl-1">
                        <div class="form-group">
                            <label class="form-label">Pekerjaan</label>     
                            @if ($dad !== null)
                                <input type="text" id="dad_job" class="form-control" placeholder="" value="{{ old('dad_job', isset($form_data['dad_job']) ? $form_data['dad_job'] : $dad->job ) }}" name = "dad_job" required>
                            @else
                                <input type="text" id="dad_job" class="form-control" placeholder="" value="{{ old('dad_job', isset($form_data['dad_job']) ? $form_data['dad_job'] : '' ) }}" name = "dad_job" required>
                            @endif                                        
                        </div>
                    </div>
                </div>
                
                <div class="form-group row mt-3">
                    <div class="col-6 pl-1">
                        <div class="form-group">
                            <label class="form-label">Alamat E-mel</label>      
                            @if ($dad !== null)
                                <input type="text" id="dad_email" class="form-control" placeholder="" value="{{ old('dad_email', isset($form_data['dad_email']) ? $form_data['dad_email'] : $dad->email ) }}" name = "dad_email" required>
                            @else
                                <input type="text" id="dad_email" class="form-control" placeholder="" value="{{ old('dad_email', isset($form_data['dad_email']) ? $form_data['dad_email'] : '' ) }}" name = "dad_email" required>
                            @endif                                       
                        </div>
                    </div>
                    <div class="col-6 pl-1">
                        <div class="form-group">
                            <label class="form-label">No. Telefon</label>           
                            @if ($dad !== null)
                                <input type="text" id="dad_phone_no" class="form-control" placeholder="" value="{{ old('dad_phone_no', isset($form_data['dad_phone_no']) ? $form_data['dad_phone_no'] : $dad->phone_no ) }}" name = "dad_phone_no" required>
                            @else
                                <input type="text" id="dad_phone_no" class="form-control" placeholder="" value="{{ old('dad_phone_no', isset($form_data['dad_phone_no']) ? $form_data['dad_phone_no'] : '' ) }}" name = "dad_phone_no" required>
                            @endif                     
                        </div>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <div class="col-12 pl-1">
                        <div class="form-group">
                            <label class="form-label">Alamat Pejabat</label>
                            @if ($dad !== null)
                                <input type="text" id="d_office_address" class="form-control" placeholder="Alamat Pejabat" value="{{ old('d_office_address', isset($form_data['d_office_address']) ? $form_data['d_office_address'] : $dad->address ) }}" name = "d_office_address" required>
                            @else
                                <input type="text" id="d_office_address" class="form-control" placeholder="Alamat Pejabat" value="{{ old('d_office_address', isset($form_data['d_office_address']) ? $form_data['d_office_address'] : '' ) }}" name = "d_office_address" required>
                            @endif                     
                        </div>
                    </div>
                </div>

                <div class="form-group row mt-1">
                    <div class="col-4 pl-1">
                        <div class="form-group">
                            {{-- @if ($dad !== null)
                                <input type="text" id="d_office_state" class="form-control" placeholder="" value="{{ old('d_office_state', isset($form_data['d_office_state']) ? $form_data['d_office_state'] : $dad->state ) }}" name = "d_office_state" required>
                            @else
                                <input type="text" id="d_office_state" class="form-control" placeholder="" value="{{ old('d_office_state', isset($form_data['d_office_state']) ? $form_data['d_office_state'] : '' ) }}" name = "d_office_state" required>
                            @endif                      --}}
                            <select class="form-select" id="d_office_state" name="d_office_state" wire:model="dOfficeState" required>
                                <option value="">Sila pilih negeri</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->state }}" {{ ($dad !== null && $dad->state === $state->state) ? 'selected' : '' }}>{{ $state->state }}</option>
                                @endforeach
                            </select>    
                        </div>
                    </div>
                    <div class="col-4 pl-1">
                        <div class="form-group">
                            {{-- @if ($dad !== null)
                                <input type="text" id="d_office_district" class="form-control" placeholder="" value="{{ old('d_office_district', isset($form_data['d_office_district']) ? $form_data['d_office_district'] : $dad->district ) }}" name = "d_office_district" required>
                            @else
                                <input type="text" id="d_office_district" class="form-control" placeholder="" value="{{ old('d_office_district', isset($form_data['d_office_district']) ? $form_data['d_office_district'] : '' ) }}" name = "d_office_district" required>
                            @endif                      --}}
                            <select class="form-select" id="d_office_district" name="d_office_district" wire:model="dOfficeDistrict" required>
                                <option value="" selected disabled>Sila pilih daerah</option>
                                @foreach ($districts as $district)
                                    <option value="{{ $district->district }}" {{ ($dad !== null && $dad->district_id === $district->district) ? 'selected' : '' }}>{{ $district->district }}</option>
                                @endforeach
                            </select> 
                        </div>
                    </div>
                    <div class="col-4 pl-1">
                        <div class="form-group">
                            @if ($dad !== null)
                                <input type="text" id="d_office_postcode" class="form-control" placeholder="Poskod" value="{{ old('d_office_postcode', isset($form_data['d_office_postcode']) ? $form_data['d_office_postcode'] : $dad->postcode ) }}" name = "d_office_postcode" required>
                            @else
                                <input type="text" id="d_office_postcode" class="form-control" placeholder="Poskod" value="{{ old('d_office_postcode', isset($form_data['d_office_postcode']) ? $form_data['d_office_postcode'] : '' ) }}" name = "d_office_postcode" required>
                            @endif                     
                        </div>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <div class="col-md-12 pl-1">
                        @if ($dad !== null)
                            <div class="form-check form-check-inline">
                                @if ($dad->staff_no !== null)
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions_dad" id="staffRadioButton_dad" value="staff_dad" checked wire:click="addInputBox('staffRadioButton_dad')">
                                @else
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions_dad" id="staffRadioButton_dad" value="staff_dad" wire:click="addInputBox('staffRadioButton_dad')">
                                @endif
                                <label class="form-check-label" for="staffRadioButton_dad">Staff UTM</label>
                            </div>
                            <div class="form-check form-check-inline">
                                @if ($dad->student_no !== null)
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions_dad" id="studentRadioButton_dad" value="student_dad" checked wire:click="addInputBox('studentRadioButton_dad')">
                                @else
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions_dad" id="studentRadioButton_dad" value="student_dad" wire:click="addInputBox('studentRadioButton_dad')">
                                @endif
                                <label class="form-check-label" for="studentRadioButton_dad">Pelajar UTM</label>
                            </div>
                            <div class="form-check form-check-inline">
                                @if ($dad->staff_no === null && $dad->student_no === null)
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions_dad" id="none_dad" value="none_dad" checked wire:click="removeInputBox">
                                @else
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions_dad" id="none_dad" value="none_dad" wire:click="removeInputBox">
                                @endif
                                <label class="form-check-label" for="none_dad">Tidak Berkaitan</label>
                            </div>
                        @else
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions_dad" id="staffRadioButton_dad" value="staff_dad" wire:click="addInputBox('staffRadioButton_dad')">
                                <label class="form-check-label" for="staffRadioButton_dad">Staff UTM</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions_dad" id="studentRadioButton_dad" value="student_dad" wire:click="addInputBox('studentRadioButton_dad')">
                                <label class="form-check-label" for="studentRadioButton_dad">Pelajar UTM</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions_dad" id="none_dad" value="none_dad" checked wire:click="removeInputBox">
                                <label class="form-check-label" for="none_dad">Tidak Berkaitan</label>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="form-group row mt-1 @if($initialStaffChecked) @else d-none @endif" id="utmStaff_dad">
                    <div class="col-md-4 pl-1">
                        @if ($dad !== null)
                            <input type="text" id="dad_staff_no" class="form-control" placeholder="No. Staff UTM" value="{{ old('dad_staff_no', isset($form_data['dad_staff_no']) ? $form_data['dad_staff_no'] : $dad->staff_no ) }}" name = "dad_staff_no" >
                        @else
                            <input type="text" id="dad_staff_no" class="form-control" placeholder="No. Staff UTM" value="{{ old('dad_staff_no', isset($form_data['dad_staff_no']) ? $form_data['dad_staff_no'] : '' ) }}" name = "dad_staff_no" >
                        @endif                     
                    </div>
                </div>

                <div class="form-group row mt-1 @if($initialStudentChecked) @else d-none @endif" id="utmStudent_dad">
                    <div class="col-md-4 pl-1">
                        @if ($dad !== null)
                            <input type="text" id="dad_student_no" class="form-control" placeholder="No. Matrik" value="{{ old('dad_student_no', isset($form_data['dad_student_no']) ? $form_data['dad_student_no'] : $dad->student_no ) }}" name = "dad_student_no" >
                        @else
                            <input type="text" id="dad_student_no" class="form-control" placeholder="No. Matrik" value="{{ old('dad_student_no', isset($form_data['dad_student_no']) ? $form_data['dad_student_no'] : '' ) }}" name = "dad_student_no" >
                        @endif                     
                    </div>
                </div>

            </div>
        </div> 
    </div>
</div>
