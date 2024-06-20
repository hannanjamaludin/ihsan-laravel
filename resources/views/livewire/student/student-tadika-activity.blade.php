<div>
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
                <td class="bg-light">{{ $formattedDate }}</td>
            </tr>
            <tr>
                <th class="bg-secondary fst-italic">Kehadiran:</th>
                <td class="bg-light">{{ count($presentStudents) }}/{{ $class->total_students }}</td>
            </tr>
        </tbody>
    </table>

    {{-- <form method="POST" action="{{ route('murid.tadika_simpan', [$class->id, $today]) }}"> --}}
    <form wire:submit.prevent="submitForm">
        {{-- @csrf  --}}

        {{-- Class Activity --}}
        <div class="card mb-4">
            <div class="card-header py-1 d-flex flex-row justify-content-between card-header-divider bg-primary text-light">
                <div class="col">
                    <h5 class="card-title mt-2">Aktiviti</h5>
                </div>
                <div class="col-auto">
                    <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#activity_class" aria-expanded="true" title="Collapse">
                        <i class="fas fa-chevron-down text-light"></i>
                    </button>
                </div>
            </div>
        
            <div class="collapse multi-collapse show" id="activity_class">
                <div class="card-body px-3 pt-2 pb-4 w-auto">
                    <div class="form-group row mt-2 align-items-center">
                        <div class="col-1">
                            <label class="form-label" for="subject">Subjek:</label>
                        </div>
                        <div class="col-11">
                            {{-- <input type="text" id="subject" class="form-control" placeholder="Sila isikan nama subjek" value="" name="subject" required> --}}
                            <select class="form-select" id="subject" wire:model="subject" name="subject" required {{ $submitted ? 'disabled' : '' }}>
                                <option selected="" disabled>Sila pilih subjek</option>
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
                            <input type="text" id="learning" class="form-control" placeholder="Nyatakan pelajaran dalam subjek ini" wire:model="learning" required {{ $submitted ? 'disabled' : '' }}>
                        </div>
                    </div>
                    <div class="form-group row mt-3 align-items-center">
                        <div class="col-1">
                            <label class="form-label" for="activity">Aktiviti:</label>
                        </div>
                        <div class="col-11">
                            <input type="text" id="activity" class="form-control" placeholder="Nyatakan aktiviti jika ada" value="" wire:model="activity" required {{ $submitted ? 'disabled' : '' }}>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Individual Performance --}}
        <div class="card mb-4">
            <div class="card-header py-1 d-flex flex-row justify-content-between card-header-divider bg-primary text-light">
                <div class="col">
                    <h5 class="card-title mt-2">Prestasi Individu</h5>
                </div>
                <div class="col-auto">
                    <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#student_performance" aria-expanded="true" title="Collapse">
                        <i class="fas fa-chevron-down text-light"></i>
                    </button>
                </div>
            </div>
        
            <div class="collapse multi-collapse show" id="student_performance">
                <div class="card-body px-3 pt-2 pb-4 w-auto">
                    <div class="form-group row mt-2 align-items-center">
                        <div class="col-1">
                            <label class="form-label" for="student_name">Nama:</label>
                        </div>
                        <div class="col-11">
                            {{-- <input type="text" id="student_name" class="form-control" placeholder="Sila pilih murid" value="" name="student_name" required> --}}
                            <select class="form-select" id="student_name" wire:model="student_name" name="student_name" {{ $submitted ? 'disabled' : '' }}>
                                <option selected="" disabled>Sila pilih murid</option>
                                {{-- @foreach ($subjects as $district)
                                    <option value="{{ $district->district }}">{{ $district->district }}</option>
                                @endforeach --}}
                            </select>    

                        </div>
                    </div>
                    <div class="form-group row mt-3 align-items-center">
                        <div class="col-1">
                            <label class="form-label" for="comment">Komen:</label>
                        </div>
                        <div class="col-11">
                            <input type="text" id="comment" class="form-control" placeholder="Nyatakan prestasi murid" wire:model="comment" {{ $submitted ? 'disabled' : '' }}>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 d-flex justify-content-end mb-4">
            <button type="submit" class="btn btn-primary btn-hantar" {{ $submitted ? 'disabled' : '' }}>Hantar</button>
        </div>

    </form>
    
    <script>
        Livewire.on('formSubmitted', () => {
            Swal.fire({
                title: 'Success!',
                text: 'Form submitted successfully.',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        });
    </script>
</div>
