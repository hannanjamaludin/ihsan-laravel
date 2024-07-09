<div class="card pb-4">
    <div class="col-3 mb-3 px-3 pt-2">
        <label for="dateInput" class="form-label">Pilih Tarikh:</label>
        <input type="date" id="dateInput" class="form-control" wire:model="selectedDate" max="{{ \Carbon\Carbon::today()->format('Y-m-d') }}">
    </div>

    <div class="card-body px-3 pt-2 pb-4 w-auto">
        <h3 class="text-primary">{{ $room->class_name }}</h3>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th class="bg-secondary fst-italic">Bilik:</th>
                    <td class="bg-light">{{ $room->class_name }}</td>
                </tr>
                <tr>
                    <th class="bg-secondary fst-italic">Bilangan Murid:</th>
                    <td class="bg-light">{{ $room->total_students }}</td>
                </tr>
                <tr>
                    <th class="bg-secondary fst-italic">Tarikh:</th>
                    <td class="bg-light">{{ $selectedDate }}</td>
                </tr>
                <tr>
                    <th class="bg-secondary fst-italic">Kehadiran:</th>
                    <td class="bg-light">{{ count($presentStudents) }}/{{ $room->total_students }}</td>
                </tr>
            </tbody>
        </table>

        @if ($attendance->isNotEmpty())
            <form wire:submit.prevent="submitForm" class="px-2">
                {{-- Room Activity --}}
                <h5 class="mt-4">Aktiviti</h5>
                <div class="form-group row mt-3 align-items-center">
                    <div class="col-1">
                        <label class="form-label" for="activity">Aktiviti:</label>
                    </div>
                    <div class="col-11">
                        <input type="text" id="activity" class="form-control" placeholder="Nyatakan aktiviti pada hari ini" wire:model="activity" 
                        required {{ $existingActivity ? 'disabled' : '' }}>
                    </div>
                </div>
                {{-- Upload media --}}
                <div class="form-group row mt-3 align-items-center">
                    @if ($existingActivity && $existingActivity->path)
                        <div class="">
                            <label class="form-label" for="media">Gambar/Video:</label>    
                            <div class="d-flex align-items-center justify-content-center mb-2">
                                @php
                                    $extension = pathinfo(Storage::url($existingActivity->path), PATHINFO_EXTENSION);
                                @endphp
                                @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                    <img src="{{ Storage::url($existingActivity->path) }}" alt="Image" class="responsive-media">
                                @elseif (in_array($extension, ['mp4', 'webm', 'ogg']))
                                    <video controls class="responsive-media">
                                        <source src="{{ Storage::url($existingActivity->path) }}" type="video/{{ $extension }}">
                                        Pelayar anda tidak menyokong tag video.
                                    </video>
                                @else
                                    <p>Jenis media tidak disokong. Sila cuba format lain.</p>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="col-2">
                            <label class="form-label" for="media">Gambar/Video:</label>
                        </div>
                        <div class="col-10">
                            <input type="file" id="media" class="form-control" wire:model="media">
                            @error('media')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif                      
                </div>

                <h5 class="mt-4">Aktiviti Murid</h5>
                @foreach($presentStudents as $student)
                    @if ($student->student->gender == 'lelaki')
                        <div class="card mt-3 mb-2" style="background-color: #bcd2e964">
                    @else
                        <div class="card mt-3 mb-2" style="background-color: #dac6dd49">
                    @endif
                        <div class="card-body px-3 pt-2 pb-2 w-auto">
                            <div class="form-group row align-items-center">
                                <div class="col-5">
                                    <label class="form-label" for="studentMedia.{{ $student->student->id }}">{{ $student->student->full_name }}</label>
                                </div>
                                <div class="col-7">
                                    @if ($existingStudentMedia[$student->student->id])
                                        <div class="d-flex align-items-center">
                                            <button type="button" class="me-2 btn btn-sm" style="background-color: #bababa74" onclick="window.open('{{ Storage::url($existingStudentMedia[$student->student->id]->path) }}', '_blank')">Papar media</button>
                                            <span class="">{{ basename($existingStudentMedia[$student->student->id]->path) }}</span>
                                        </div>
                                    @else
                                        <input type="file" id="studentMedia.{{ $student->student->id }}" class="form-control form-control-sm" wire:model="studentMedia.{{ $student->student->id }}" {{ $existingStudentMedia[$student->student->id] ? 'disabled' : '' }}>
                                    @endif                                 
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="col-12 d-flex justify-content-end my-4">
                    <button type="submit" class="btn btn-primary btn-hantar">Hantar</button>
                </div>
            </form>
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

<style>
    .responsive-media {
        width: 100%;
        max-width: 100%;
        height: 500px;
        object-fit: contain;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>
