<div class="mx-3">
    <div class="d-flex align-items-center">
        <h3 class="text-primary mb-0">{{ $teacher->assignedClass->age }} {{ $teacher->assignedClass->class_name }}</h3>
        <h5 class="text-secondary fst-italic fw-normal mb-0 ms-3">[{{ $date }}]</h5>
    </div>
    <div class="row mt-4">
        <div class="col-12 d-flex align-items-center">
            <div class="fw-bold fs-4">Subjek:</div>
            <div class="fw-normal fs-4 ms-2">
                Sains<i class="fa fa-rocket ms-2"></i>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <label for="pelajaran" class="form-label fw-bold">Pelajaran</label>
            <input type="text" id="pelajaran" class="form-control" placeholder="">
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <div class="fw-bold">Pilih ikon yang berkaitan:</div>
            <div class="d-flex flex-wrap mt-2">
                <!-- Add more icons as needed -->
                <div class="me-2">
                    <button class="btn btn-primary rounded-circle p-3">
                        <i class="fa fa-rocket text-white"></i>
                    </button>
                </div>
                <div class="me-2">
                    <button class="btn btn-primary rounded-circle p-3">
                        <i class="fa fa-flask text-white"></i>
                    </button>
                </div>
                <div class="me-2">
                    <button class="btn btn-primary rounded-circle p-3">
                        <i class="fa fa-book text-white"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <div class="fw-bold">Penerapan Kualiti:</div>
            <div class="d-flex flex-wrap mt-2">
                <!-- Add more icons as needed -->
                <div class="me-2">
                    <input class="btn-check" type="checkbox" id="quality1" value="creativity" autocomplete="off">
                    <label class="btn btn-outline-secondary rounded-circle p-3" for="quality1"><i class="fa fa-lightbulb"></i></label>
                </div>
                <div class="me-2">
                    <input class="btn-check" type="checkbox" id="quality1" value="creativity" autocomplete="off">
                    <label class="btn btn-outline-secondary rounded-circle p-3" for="quality1"><i class="fa fa-check-circle"></i></label>
                </div>
                <div class="me-2">
                    <input class="btn-check" type="checkbox" id="quality1" value="creativity" autocomplete="off">
                    <label class="btn btn-outline-secondary rounded-circle p-3" for="quality1"><i class="fa fa-handshake"></i></label>
                </div>
                <div class="me-2">
                    <input class="btn-check" type="checkbox" id="quality1" value="creativity" autocomplete="off">
                    <label class="btn btn-outline-secondary rounded-circle p-3" for="quality1"><i class="fa fa-users"></i></label>
                </div>
                <div class="me-2">
                    <input class="btn-check" type="checkbox" id="quality1" value="creativity" autocomplete="off">
                    <label class="btn btn-outline-secondary rounded-circle p-3" for="quality1"><i class="fa fa-star"></i></label>
                </div>
                {{-- <div class="me-2">
                    <input class="" autocomplete="off" type="checkbox" id="quality2" value="teamwork">
                    <label class="btn btn-outline-primary" for="quality2">
                        <div class="btn-check rounded-circle p-3">
                            <i class="fa fa-users text-white"></i>
                        </div>
                    </label>
                </div>
                <div class="me-2">
                    <input class="" autocomplete="off" type="checkbox" id="quality3" value="discipline">
                    <label class="btn btn-outline-primary" for="quality3">
                        <div class="btn-check rounded-circle p-3">
                            <i class="fa fa-check-circle text-white"></i>
                        </div>
                    </label>
                </div>
                <div class="me-2">
                    <input class="" autocomplete="off" type="checkbox" id="quality4" value="innovation">
                    <label class="btn btn-outline-primary" for="quality4">
                        <div class="btn-check rounded-circle p-3">
                            <i class="fa fa-lightbulb text-white"></i>
                        </div>
                    </label>
                </div>
                <div class="me-2">
                    <input class="" autocomplete="off" type="checkbox" id="quality5" value="leadership">
                    <label class="btn btn-outline-primary" for="quality5">
                        <div class="btn-check rounded-circle p-3">
                            <i class="fa fa-star text-white"></i>
                        </div>
                    </label>
                </div>
                <div class="me-2">
                    <input class="" autocomplete="off" type="checkbox" id="quality6" value="responsibility">
                    <label class="btn btn-outline-primary" for="quality6">
                        <div class="btn-check rounded-circle p-3">
                            <i class="fa fa-handshake text-white"></i>
                        </div>
                    </label>
                </div> --}}
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <label for="activity-description" class="form-label fw-bold">Aktiviti</label>
            <textarea id="activity-description" class="form-control" rows="3" placeholder="Jelaskan aktiviti yang dilakukan"></textarea>
        </div>
    </div>
</div>
