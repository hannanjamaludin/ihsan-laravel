    {{-- Modal Student's Details --}}
    <div>
        <div class="modal fade" id="modalStudentDetails" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary">Maklumat Murid</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>

                <div class="modal-body">
                    <div class="row ms-1">
                        <div class="col-3 mx-1">
                            <div class="rounded-circle mx-auto mb-3 bg-secondary shadow-lg" style="width: 200px; height: 200px; display: flex; justify-content: center; align-items: center;">
                                <i class="fas fa-user" style="font-size: 100px;"></i>
                            </div>                
                        </div>
                        <div class="col-8 mx-1">
                            <div class="card mb-4 mx-3">
                                <div class="card-header py-1 bg-primary text-light d-flex flex-row justify-content-between card-header-divider">
                                    <div class="col">
                                        <h5 class="card-title mt-2">Maklumat Murid</h5>
                                    </div>
                                    <div class="col-auto">
                                        <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#child" aria-expanded="true" title="Collapse">
                                            <i class="fas fa-chevron-down text-light"></i>
                                        </button>
                                    </div>
                                </div>
                    
                                <div class="collapse multi-collapse show" id="child">
                                    <div class="card-body px-3 pt-2 pb-4 w-auto">
                    
                                        <div class="form-group row">
                                            <div class="col-12 pl-1">
                                                <label class="form-label" for="full_name">Nama Penuh</label>
                                                <input type="text" id="full_name" class="form-control" value="" placeholder="" required name="full_name" disabled>
                                            </div>
                                        </div>
                    
                                        <div class="form-group row mt-4">
                                            <div class="col-4 pl-1">
                                                <label class="form-label" for="ic_no">No. MyKid</label>                        
                                                <input type="text" id="ic_no" class="form-control" value="" placeholder="" required name="ic_no" disabled>
                                            </div>
                                            <div class="col-4 pl-1">
                                                <label class="form-label" for="dob">Tarikh Lahir</label>                        
                                                <input type="date" id="dob" class="form-control"  value="" placeholder="" required name = "dob" disabled>
                                            </div>
                                            <div class="col-4 pl-1">
                                                <label class="form-label" for="gender">Jantina</label>                        
                                                <input type="text" id="gender" class="form-control" value="" placeholder="" required name = "gender" disabled>
                                            </div>
                                        </div>
                    
                                        <div class="form-group row mt-4">
                                            <div class="col-6 pl-1">
                                                <div class="form-group">
                                                    <label class="form-label">Adik-beradik (Anak ke Berapa)</label>                            
                                                    <input type="text" id="siblings" class="form-control" value="" placeholder="" required name = "siblings" disabled>
                                                </div>
                                            </div>
                                            <div class="col-6 pl-1">
                                                <div class="form-group">
                                                    <label class="form-label">Alahan</label>                            
                                                    <input type="text" id="allergy" class="form-control" value="" placeholder="" required name = "allergy" disabled>
                                                </div>
                                            </div>
                                        </div>
                    
                                        <div class="form-group row mt-4">
                                            <div class="col-6 pl-1">
                                                <div class="form-group">
                                                    <label class="form-label">Kelainan Upaya</label>                            
                                                    <input type="text" id="disability" class="form-control" value="" placeholder="" required name = "disability" disabled>
                                                </div>
                                            </div>
                                            <div class="col-6 pl-1">
                                                <div class="form-group">
                                                    <label class="form-label">Penyakit Kronik</label>                            
                                                    <input type="text" id="illness" class="form-control" value="" placeholder="" required name = "illness" disabled>                                
                                                </div>
                                            </div>
                                        </div>
                    
                                        <div class="form-group row mt-4">
                                            <div class="col-12 pl-1">
                                                <div class="form-group">
                                                    <label class="form-label">Masalah Kesihatan & Pembelajaran</label>                            
                                                    <input type="text" id="study" class="form-control" value="" placeholder="" required name = "study" disabled>
                                                </div>
                                            </div>
                                        </div>
                    
                                        <div class="form-group row mt-4">
                                            <div class="col-12 pl-1">
                                                <div class="form-group">
                                                    <label class="form-label">Alamat Rumah</label>
                                                    <input type="text" id="address1" class="form-control" value="" placeholder="" required name = "address1" disabled>
                                                </div>
                                            </div>
                                        </div>
                    
                                        <div class="form-group row mt-1">
                                            <div class="col-4 pl-1">
                                                <div class="form-group">
                                                    <input type="text" id="state" class="form-control" value="" placeholder="" required name = "state" disabled>
                                                </div>
                                            </div>
                                            <div class="col-4 pl-1">
                                                <div class="form-group">
                                                    <input type="text" id="district" class="form-control" value="" placeholder="" required name = "district" disabled>
                                                </div>
                                            </div>
                                            <div class="col-4 pl-1">
                                                <div class="form-group">
                                                    <input type="text" id="postcode" class="form-control" value="" placeholder="" required name = "postcode" disabled>
                                                </div>
                                            </div>
                                        </div>
                    
                                        <div class="form-group row mt-4">
                                            <div class="col-4 pl-1">
                                                <label class="form-label">Pakej</label>
                                                <input type="text" id="branch_id" class="form-control" value="" placeholder="" required name = "branch_id" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    
                            <div class="card mb-4 mx-3">
                                <div class="card-header py-1 bg-primary text-light d-flex flex-row justify-content-between card-header-divider">
                                    <div class="col">
                                        <h5 class="card-title mt-2">Maklumat Ibu</h5>
                                    </div>
                                    <div class="col-auto">
                                        <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#mom" aria-expanded="true" title="Collapse">
                                            <i class="fas fa-chevron-down text-light"></i>
                                        </button>
                                    </div>
                                </div>
                    
                                <div class="collapse multi-collapse show" id="mom">
                                    <div class="card-body px-3 pt-2 pb-4 w-auto">
                    
                                        <div class="form-group row">
                                            <div class="col-6 pl-1">
                                                <div class="form-group">
                                                    <label class="form-label">Nama Ibu</label>                            
                                                    <input type="text" id="mom_full_name" class="form-control" value="" placeholder="" required name = "mom_full_name" disabled>
                                                </div>
                                            </div>
                                            <div class="col-6 pl-1">
                                                <div class="form-group">
                                                    <label class="form-label">Pekerjaan</label>                            
                                                    <input type="text" id="mom_job" class="form-control" value="" placeholder="" required name = "mom_job" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row mt-4">
                                            <div class="col-6 pl-1">
                                                <div class="form-group">
                                                    <label class="form-label">Alamat E-mel</label>                            
                                                    <input type="text" id="mom_email" class="form-control" value="" placeholder="" required name = "mom_email" disabled>
                                                </div>
                                            </div>
                                            <div class="col-6 pl-1">
                                                <div class="form-group">
                                                    <label class="form-label">No. Telefon</label>                            
                                                    <input type="text" id="mom_phone_no" class="form-control" value="" placeholder="" required name = "mom_phone_no" disabled>
                                                </div>
                                            </div>
                                        </div>
                    
                                        <div class="form-group row mt-4">
                                            <div class="col-12 pl-1">
                                                <div class="form-group">
                                                    <label class="form-label">Alamat Pejabat</label>
                                                    <input type="text" id="m_office_address" class="form-control" value="" placeholder="" required name = "m_office_address" disabled>
                                                </div>
                                            </div>
                                        </div>
                    
                                        <div class="form-group row mt-1">
                                            <div class="col-4 pl-1">
                                                <div class="form-group">
                                                    <input type="text" id="m_office_state" class="form-control" value="" placeholder="" required name = "m_office_state" disabled>
                                                </div>
                                            </div>
                                            <div class="col-4 pl-1">
                                                <div class="form-group">
                                                    <input type="text" id="m_office_district" class="form-control" value="" placeholder="" required name = "m_office_district" disabled>
                                                </div>
                                            </div>
                                            <div class="col-4 pl-1">
                                                <div class="form-group">
                                                    <input type="text" id="m_office_postcode" class="form-control" value="" placeholder="" required name = "m_office_postcode" disabled>
                                                </div>
                                            </div>
                                        </div>
                    
                                        <div class="form-group row mt-4 d-none" id="mom_staff">
                                            <div class="col-md-6">
                                                <div class="container d-flex align-items-center justify-content-start m-0 p-0">
                                                    <div class="badge bg-warning me-3" style="background-color: var(--custom-warning-color);">Staff UTM</div>
                                                    <input type="text" id="mom_staff_no" class="form-control" value="" placeholder="" required name="mom_staff_no" disabled>
                                                </div>                                          
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row mt-4 d-none" id="mom_student">
                                            <div class="col-md-6">
                                                <div class="container d-flex align-items-center justify-content-start m-0 p-0">
                                                    <div class="badge bg-warning me-3" style="background-color: var(--custom-warning-color);">Pelajar UTM</div>
                                                    <input type="text" id="mom_student_no" class="form-control" value="" placeholder="" required name="mom_student_no" disabled>
                                                </div>                                          
                                            </div>
                                        </div>
                                                        
                                    </div>
                                </div>
                            </div>
                    
                            <div class="card mb-4 mx-3">
                                <div class="card-header py-1 bg-primary text-light d-flex flex-row justify-content-between card-header-divider">
                                    <div class="col">
                                        <h5 class="card-title mt-2">Maklumat Bapa</h5>
                                    </div>
                                    <div class="col-auto">
                                        <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#dad" aria-expanded="true" title="Collapse">
                                            <i class="fas fa-chevron-down text-light"></i>
                                        </button>
                                    </div>
                                </div>
                    
                                <div class="collapse multi-collapse show" id="dad">
                                    <div class="card-body px-3 pt-2 pb-4 w-auto">
                    
                                        <div class="form-group row">
                                            <div class="col-6 pl-1">
                                                <div class="form-group">
                                                    <label class="form-label">Nama Bapa</label>                            
                                                    <input type="text" id="dad_full_name" class="form-control" value="" placeholder="" required name = "dad_full_name" disabled>
                                                </div>
                                            </div>
                                            <div class="col-6 pl-1">
                                                <div class="form-group">
                                                    <label class="form-label">Pekerjaan</label>                            
                                                    <input type="text" id="dad_job" class="form-control" value="" placeholder="" required name = "dad_job" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row mt-4">
                                            <div class="col-6 pl-1">
                                                <div class="form-group">
                                                    <label class="form-label">Alamat E-mel</label>                            
                                                    <input type="text" id="dad_email" class="form-control" value="" placeholder="" required name = "dad_email" disabled>
                                                </div>
                                            </div>
                                            <div class="col-6 pl-1">
                                                <div class="form-group">
                                                    <label class="form-label">No. Telefon</label>                            
                                                    <input type="text" id="dad_phone_no" class="form-control" value="" placeholder="" required name = "dad_phone_no" disabled>
                                                </div>
                                            </div>
                                        </div>
                    
                                        <div class="form-group row mt-4">
                                            <div class="col-12 pl-1">
                                                <div class="form-group">
                                                    <label class="form-label">Alamat Pejabat</label>
                                                    <input type="text" id="d_office_address" class="form-control" value="" placeholder="" required name = "d_office_address" disabled>
                                                </div>
                                            </div>
                                        </div>
                    
                                        <div class="form-group row mt-1">
                                            <div class="col-4 pl-1">
                                                <div class="form-group">
                                                    <input type="text" id="d_office_state" class="form-control" value="" placeholder="" required name = "d_office_state" disabled>
                                                </div>
                                            </div>
                                            <div class="col-4 pl-1">
                                                <div class="form-group">
                                                    <input type="text" id="d_office_district" class="form-control" value="" placeholder="" required name = "d_office_district" disabled>
                                                </div>
                                            </div>
                                            <div class="col-4 pl-1">
                                                <div class="form-group">
                                                    <input type="text" id="d_office_postcode" class="form-control" value="" placeholder="" required name = "d_office_postcode" disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row mt-4 d-none" id="dad_staff">
                                            <div class="col-md-6">
                                                <div class="container d-flex align-items-center justify-content-start m-0 p-0">
                                                    <div class="badge bg-warning me-3" style="background-color: var(--custom-warning-color);">Staff UTM</div>
                                                    <input type="text" id="dad_staff_no" class="form-control" value="" placeholder="" required name="dad_staff_no" disabled>
                                                </div>                                          
                                            </div>
                                        </div>
                                        <div class="form-group row mt-4 d-none" id="dad_student">
                                            <div class="col-md-6">
                                                <div class="container d-flex align-items-center justify-content-start m-0 p-0">
                                                    <div class="badge bg-warning me-3" style="background-color: var(--custom-warning-color);">Pelajar UTM</div>
                                                    <input type="text" id="dad_student_no" class="form-control" value="" placeholder="" required name="dad_student_no" disabled>
                                                </div>                                          
                                            </div>
                                        </div>
                                                                            
                                    </div>
                                </div>
                            </div>
                    
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tolak Permohonan</button>
                    <button type="button" class="btn btn-primary">Terima Permohonan</button>
                </div>
                </div>
            </div>

        </div>
    </div>
