<div class="card pb-4">
    <div class="col-3 mb-3 px-3 pt-2">
        <label for="dateInput" class="form-label">Pilih Tarikh:</label>
        <input type="date" id="dateInput" class="form-control" wire:model="selectedDate" max="{{ \Carbon\Carbon::today()->format('Y-m-d') }}">
    </div>

    <div class="card-body px-3 pt-2 pb-4 w-auto">
        <h3 class="text-primary">{{ $class->age }} {{ $class->class_name }}</h3>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th class="bg-secondary fst-italic">Kelas:</th>
                    <td class="bg-light">{{ $class->age }} {{ $class->class_name }}</td>
                </tr>
                <tr>
                    <th class="bg-secondary fst-italic">Bilangan Murid:</th>
                    <td class="bg-light">{{ $class->total_students }}</td>
                </tr>
                <tr>
                    <th class="bg-secondary fst-italic">Tarikh:</th>
                    <td class="bg-light">{{ $selectedDate }}</td>
                </tr>
                <tr>
                    <th class="bg-secondary fst-italic">Kehadiran:</th>
                    <td class="bg-light">{{ count($presentStudents) }}/{{ $class->total_students }}</td>
                </tr>
            </tbody>
        </table>

        @if ($attendance->isNotEmpty())
            <form wire:submit.prevent="submitForm" class="px-2">
        
                {{-- Class Activity --}}
                <h5 class="mt-4">Aktiviti</h5>
                <div class="form-group row mt-2 align-items-center">
                    <div class="col-1">
                        <label class="form-label" for="subject">Subjek:</label>
                    </div>
                    <div class="col-11">
                        <select class="form-select" id="subject" name="subject" wire:model="subject" required {{ $tadika_activity ? 'disabled' : '' }}>
                            <option value="">Sila pilih subjek</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->full_name }}</option>
                            @endforeach
                        </select>    
                    </div>
                </div>
                <div class="form-group row mt-3 align-items-center">
                    <div class="col-1">
                        <label class="form-label" for="learning">Pelajaran:</label>
                    </div>
                    <div class="col-11">
                        <input type="text" id="learning" class="form-control" placeholder="Nyatakan pelajaran dalam subjek ini" wire:model="learning" required {{ $tadika_activity ? 'disabled' : '' }}>
                    </div>
                </div>
                <div class="form-group row mt-3 mb-4 align-items-center">
                    <div class="col-1">
                        <label class="form-label" for="activity">Aktiviti:</label>
                    </div>
                    <div class="col-11">
                        <input type="text" id="activity" class="form-control" placeholder="Nyatakan aktiviti jika ada" wire:model="activity" value="" required {{ $tadika_activity ? 'disabled' : '' }}>
                    </div>
                </div>

                {{-- Individual Performance --}}
                <div class="col">
                    <div class="row align-items-center">
                        @if (session()->has('message'))
                            <div class="alert alert-warning mt-2">
                                {{ session('message') }}
                            </div>
                        @endif
            
                        <div class="col-auto">
                            <h5 class="mt-2">Prestasi Individu</h5>
                        </div>
                        <div class="col-auto pt-1 ms-0 ps-0">
                            <span class="text-muted text-sm text-normal fst-italic">(Jika ada)</span>
                        </div>
                    </div>
                </div>
                <div class="form-group row mt-2 align-items-center">
                    <div class="col-1">
                        <label class="form-label" for="student_id">Nama:</label>
                    </div>
                    <div class="col-11">
                        <select class="form-select" id="student_id" name="student_id" wire:model="student_id">
                            <option value="">Sila pilih murid</option>
                            @foreach ($presentStudents as $student)
                                <option value="{{ $student->student->id }}">{{ $student->student->full_name }}</option>
                            @endforeach
                        </select>    

                    </div>
                </div>
                <div class="form-group row mt-3 align-items-center">
                    <div class="col-1">
                        <label class="form-label" for="comment">Komen:</label>
                    </div>
                    <div class="col-11">
                        <input type="text" id="comment" class="form-control" placeholder="Nyatakan prestasi murid" wire:model="comment">
                    </div>
                </div>

                <div class="col-12 d-flex justify-content-end my-4">
                    <button type="submit" class="btn btn-primary btn-hantar">Hantar</button>
                </div>
            </form>
            
            {{-- Summary for submitted activity --}}
            @if ($tadika_activity)
                <div>
                    <hr class="mt-3"></hr>
                    @if ($students->isNotEmpty())
                        <div class="row row-cols-1 row-cols-md-2 g-4 px-3">
                            @foreach ($students as $student)
                                <div class="col">
                                    <div class="card" style="background-color: #e9ecef">
                                        <div class="card-body px-3 pt-2 w-auto">
                                            <div class="text-primary fw-bold">{{ $student->student->full_name }}</div>
                                            <div class="text-dark">{{ $student->comment }}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                            <div class="fst-italic text-center text-primary">Tiada prestasi murid dihantar</div>
                        <hr/>
                    @endif
                </div>
            @endif
        @else
            <div class="fw-bold text-primary text-center pt-4">Sila isi kehadiran murid terlebih dahulu</div>
        @endif
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('livewire:load', function() {
        @this.on('formSubmitted', (type, message) => {
            Swal.fire({
                icon: type,
                title: 'Berjaya!',
                text: message,
                confirmButtonColor: '#703232'
            });
        });
    });
</script>
