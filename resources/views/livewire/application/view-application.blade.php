<div>
    <div class="text-center text-primary">
        <!-- Profile Picture -->
        {{-- <img src="" class="rounded-circle mb-3" style="width: 100px; height: 100px;" alt="Profile Picture"> --}}
        <div class="rounded-circle mx-auto mb-3 bg-secondary shadow-lg" style="width: 100px; height: 100px; display: flex; justify-content: center; align-items: center;">
            <i class="fas fa-user" style="font-size: 50px;"></i>
        </div>
        <h5 class="card-title text-primary">Lisa Sofea binti Mohammad Aqeel</h5>
        <div class="card-text">4 Tahun</div>
        <div class="card-text">Tadika Ihsan</div>
        <div class="badge bg-warning mt-3" style="background-color: var(--custom-warning-color);">Staff UTM</div>
        <ul class="nav nav-pills justify-content-center mt-3">
            <li class="nav-item">
                <button type="button" class="btn btn-info rounded-circle me-3 px-3" style="background-color: var(--custom-info-color); border:none;" 
                 title="Maklumat murid" data-bs-toggle="modal" data-bs-target="#modalStudentDetails">
                    <i class="fas fa-info text-light"></i>
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="btn btn-success rounded-circle me-3" style="background-color: var(--custom-success-color); border:none" title="Terima Permohonan">
                    <i class="fas fa-check"></i>
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="btn btn-danger rounded-circle" style="background-color: var(--custom-danger-color); border:none" title="Tolak permohonan">
                    <i class="fas fa-times"></i>
                </button>
            </li>
        </ul>
    </div>

    {{-- Modal Student's Details --}}
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
                        {{-- <table class="table table-sm table-bordered mb-0 pb-0">
                            <tbody>
                                <tr>
                                    <th class="text-end me-1">Nama:</th>
                                    <td class="text-start me-1">Lisa Sofea binti Mohammad Aqeel</td>
                                </tr>
                                <tr>
                                    <th class="text-end me-1">Umur:</th>
                                    <td class="text-start me-1">4 Tahun</td>
                                </tr>
                                <tr>
                                    <th class="text-end me-1">MyKid:</th>
                                    <td class="text-start me-1">200717-01-3282</td>
                                </tr>
                                <tr>
                                    <th class="text-end me-1">Jantina:</th>
                                    <td class="text-start me-1">Perempuan</td>
                                </tr>
                                <tr>
                                    <th class="text-end me-1">Adik-beradik:</th>
                                    <td class="text-start me-1">2/3</td>
                                </tr>
                                <tr>
                                    <th class="text-end me-1">Alahan:</th>
                                    <td class="text-start me-1">-</td>
                                </tr>
                                <tr>
                                    <th class="text-end me-1">Kelainan Upaya:</th>
                                    <td class="text-start me-1">-</td>
                                </tr>
                                <tr>
                                    <th class="text-end me-1">Masalah Kesihatan & Pembelajaran:</th>
                                    <td class="text-start me-1">-</td>
                                </tr>
                                <tr>
                                    <th class="text-end me-1">Penyakit Kronik:</th>
                                    <td class="text-start me-1">-</td>
                                </tr>
                                <tr>
                                    <th class="text-end me-1">Alamat Rumah:</th>
                                    <td class="text-start me-1">1749, Jalan Toh Kee Kah, Taman Perdana, 71000, Port Dickson, Negeri Sembilan</td>
                                </tr>
                                <tr>
                                    <th class="text-end me-1">Pakej:</th>
                                    <td class="text-start me-1">Tadika Ihsan</td>
                                </tr>
                            </tbody>
                        </table> --}}
                        <div class="card mb-4 mx-3">
                            <div class="card-header py-1 bg-primary text-light d-flex flex-row justify-content-between card-header-divider">
                                <div class="col">
                                    <h5 class="card-title mt-2">Maklumat Anak</h5>
                                </div>
                                <div class="col-auto">
                                    <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#child" aria-expanded="true" title="Collapse">
                                        <i class="fas fa-chevron-down text-light"></i>
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
                                            <input type="text" id="full_name" class="form-control" value="Lisa Sofea binti Mohammad Aqeel" placeholder="Sila isikan nama penuh anak" required name="full_name" disabled>
                                        </div>
                                    </div>
                
                                    <div class="form-group row mt-4">
                                        <div class="col-4 pl-1">
                                            <label class="form-label" for="ic_no">No. MyKid</label>                        
                                            <input type="text" id="ic_no" class="form-control" value="200717-01-3282" placeholder="XXXXXX-XX-XXXX" required name="ic_no" disabled>
                                        </div>
                                        <div class="col-4 pl-1">
                                            <label class="form-label" for="dob">Tarikh Lahir</label>                        
                                            <input type="date" id="dob" class="form-control"  value="17/07/2020" placeholder="" required name = "dob" disabled>
                                        </div>
                                        <div class="col-4 pl-1">
                                            <label class="form-label" for="gender">Jantina</label>                        
                                            <input type="text" id="gender" class="form-control" value="Perempuan" placeholder="" required name = "gender" disabled>
                                            {{-- <select class="form-select" id="gender">
                                                <option value="Perempuan" selected disabled>Perempuan</option>
                                            </select> --}}
                                        </div>
                                    </div>
                
                                    <div class="form-group row mt-4">
                                        <div class="col-6 pl-1">
                                            <div class="form-group">
                                                <label class="form-label">Adik-beradik (Anak ke Berapa)</label>                            
                                                <input type="text" id="siblings" class="form-control" value="1/3" placeholder="Contoh: 1/3" required name = "siblings" disabled>
                                            </div>
                                        </div>
                                        <div class="col-6 pl-1">
                                            <div class="form-group">
                                                <label class="form-label">Alahan</label>                            
                                                <input type="text" id="allergy" class="form-control" value="-" placeholder="Nyatakan jika ada" required name = "allergy" disabled>
                                            </div>
                                        </div>
                                    </div>
                
                                    <div class="form-group row mt-4">
                                        <div class="col-6 pl-1">
                                            <div class="form-group">
                                                <label class="form-label">Kelainan Upaya</label>                            
                                                <input type="text" id="disability" class="form-control" value="-" placeholder="Nyatakan jika ada" required name = "disability" disabled>
                                            </div>
                                        </div>
                                        <div class="col-6 pl-1">
                                            <div class="form-group">
                                                <label class="form-label">Penyakit Kronik</label>                            
                                                <input type="text" id="illness" class="form-control" value="-" placeholder="Nyatakan jika ada" required name = "illness" disabled>                                
                                            </div>
                                        </div>
                                    </div>
                
                                    <div class="form-group row mt-4">
                                        <div class="col-12 pl-1">
                                            <div class="form-group">
                                                <label class="form-label">Masalah Kesihatan & Pembelajaran</label>                            
                                                <input type="text" id="study" class="form-control" value="-" placeholder="Nyatakan jika ada" required name = "study" disabled>
                                            </div>
                                        </div>
                                    </div>
                
                                    <div class="form-group row mt-4">
                                        <div class="col-12 pl-1">
                                            <div class="form-group">
                                                <label class="form-label">Alamat Rumah</label>
                                                <input type="text" id="address1" class="form-control" value="1749, Jalan Toh Kee Kah, Taman Perdana" placeholder="" required name = "address1" disabled>
                                            </div>
                                        </div>
                                    </div>
                
                                    <div class="form-group row mt-1">
                                        <div class="col-4 pl-1">
                                            <div class="form-group">
                                                <input type="text" id="state" class="form-control" value="Johor" placeholder="Negeri" required name = "state" disabled>
                                                {{-- <select class="form-select" id="state">
                                                    <option selected="" value="Johor" disabled></option>
                                                </select>     --}}
                                            </div>
                                        </div>
                                        <div class="col-4 pl-1">
                                            <div class="form-group">
                                                <input type="text" id="district" class="form-control" value="Johor Bahru" placeholder="Daerah" required name = "district" disabled>
                                                {{-- <select class="form-select" id="district">
                                                    <option selected="" value="Johor Bahru" disabled></option>
                                                </select>     --}}
                                            </div>
                                        </div>
                                        <div class="col-4 pl-1">
                                            <div class="form-group">
                                                <input type="text" id="postcode" class="form-control" value="81310" placeholder="Poskod" required name = "postcode" disabled>
                                            </div>
                                        </div>
                                    </div>
                
                                    <div class="form-group row mt-4">
                                        <div class="col-4 pl-1">
                                            <label class="form-label" for="branch_id">Pakej</label>
                                            <input type="text" id="district" class="form-control" value="Tadika Ihsan" placeholder="Daerah" required name = "district" disabled>
                                            {{-- <select class="select2 form-control" id="branch_id" name="branch_id">
                                                <option selected="Tadika Ihsan" disabled></option> --}}
                                                {{-- @foreach($designations as $designation)
                                                <option value="{{$designation->id}}">{{$designation->designation}}</option>
                                                @endforeach --}}
                                            {{-- </select> --}}
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
                                                <input type="text" id="full_name" class="form-control" value="Shafikha binti Saari" placeholder="" required name = "full_name" disabled>
                                            </div>
                                        </div>
                                        <div class="col-6 pl-1">
                                            <div class="form-group">
                                                <label class="form-label">Pekerjaan</label>                            
                                                <input type="text" id="job" class="form-control" value="Pensyarah" placeholder="" required name = "job" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row mt-4">
                                        <div class="col-6 pl-1">
                                            <div class="form-group">
                                                <label class="form-label">Alamat E-mel</label>                            
                                                <input type="text" id="email" class="form-control" value="shafikha@gmail.com" placeholder="" required name = "email" disabled>
                                            </div>
                                        </div>
                                        <div class="col-6 pl-1">
                                            <div class="form-group">
                                                <label class="form-label">No. Telefon</label>                            
                                                <input type="text" id="phone_no" class="form-control" value="011-56418890" placeholder="" required name = "phone_no" disabled>
                                            </div>
                                        </div>
                                    </div>
                
                                    <div class="form-group row mt-4">
                                        <div class="col-12 pl-1">
                                            <div class="form-group">
                                                <label class="form-label">Alamat Pejabat</label>
                                                <input type="text" id="address" class="form-control" value="Universiti Teknologi Malaysia, " placeholder="" required name = "address" disabled>
                                            </div>
                                        </div>
                                    </div>
                
                                    <div class="form-group row mt-1">
                                        <div class="col-4 pl-1">
                                            <div class="form-group">
                                                <input type="text" id="state" class="form-control" value="Johor" placeholder="Negeri" required name = "state" disabled>
                                                {{-- <select class="form-select" id="state">
                                                    <option selected="" disabled>Sila pilih negeri</option>
                                                    <option value="1">Johor</option>
                                                </select>     --}}
                                            </div>
                                        </div>
                                        <div class="col-4 pl-1">
                                            <div class="form-group">
                                                <input type="text" id="district" class="form-control" value="Johor Bahru" placeholder="Daerah" required name = "district" disabled>
                                                {{-- <select class="form-select" id="district">
                                                    <option selected="" disabled>Sila pilih daerah</option>
                                                    <option value="2">Johor Bahru</option>
                                                </select>     --}}
                                            </div>
                                        </div>
                                        <div class="col-4 pl-1">
                                            <div class="form-group">
                                                <input type="text" id="postcode" class="form-control" value="81310" placeholder="Poskod" required name = "postcode" disabled>
                                            </div>
                                        </div>
                                    </div>
                
                                    <div class="form-group row mt-4">
                                        <div class="col-md-6">
                                            <div class="container d-flex align-items-center justify-content-start m-0 p-0">
                                                <div class="badge bg-warning me-3" style="background-color: var(--custom-warning-color);">Staff UTM</div>
                                                <input type="text" id="staff_no" class="form-control" value="UTM21011323" placeholder="ID Staff" required name="staff_no" disabled>
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
                                                <input type="text" id="full_name" class="form-control" value="Mohammad Aqeel bin Jamaludin" placeholder="" required name = "full_name" disabled>
                                            </div>
                                        </div>
                                        <div class="col-6 pl-1">
                                            <div class="form-group">
                                                <label class="form-label">Pekerjaan</label>                            
                                                <input type="text" id="job" class="form-control" value="Doktor" placeholder="" required name = "job" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row mt-4">
                                        <div class="col-6 pl-1">
                                            <div class="form-group">
                                                <label class="form-label">Alamat E-mel</label>                            
                                                <input type="text" id="email" class="form-control" value="aqeeljamal@gmail.com" placeholder="" required name = "email" disabled>
                                            </div>
                                        </div>
                                        <div class="col-6 pl-1">
                                            <div class="form-group">
                                                <label class="form-label">No. Telefon</label>                            
                                                <input type="text" id="phone_no" class="form-control" value="011-49903221" placeholder="" required name = "phone_no" disabled>
                                            </div>
                                        </div>
                                    </div>
                
                                    <div class="form-group row mt-4">
                                        <div class="col-12 pl-1">
                                            <div class="form-group">
                                                <label class="form-label">Alamat Pejabat</label>
                                                <input type="text" id="address" class="form-control" value="Klinik Kesihatan Kulai" placeholder="" required name = "address" disabled>
                                            </div>
                                        </div>
                                    </div>
                
                                    <div class="form-group row mt-1">
                                        <div class="col-4 pl-1">
                                            <div class="form-group">
                                                <input type="text" id="state" class="form-control" value="Johor" placeholder="Negeri" required name = "state" disabled>
                                                {{-- <select class="form-select" id="state">
                                                    <option selected="" disabled>Sila pilih negeri</option>
                                                    <option value="1">Johor</option>
                                                </select>     --}}
                                            </div>
                                        </div>
                                        <div class="col-4 pl-1">
                                            <div class="form-group">
                                                <input type="text" id="district" class="form-control" value="Kulai" placeholder="Daerah" required name = "district" disabled>
                                                {{-- <select class="form-select" id="district">
                                                    <option selected="" disabled>Sila pilih daerah</option>
                                                    <option value="2">Johor Bahru</option>
                                                </select>     --}}
                                            </div>
                                        </div>
                                        <div class="col-4 pl-1">
                                            <div class="form-group">
                                                <input type="text" id="postcode" class="form-control" value="81300" placeholder="Poskod" required name = "postcode" disabled>
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
