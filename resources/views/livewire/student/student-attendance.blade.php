<div>
    <div class="row">
        <div class="col-md-6">
            <h3>Present</h3>
            @foreach ($presentStudents as $student)
                <div class="card mb-4 mx-3">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">{{ $student->full_name }}</h5>
                        </div>
                        <div>
                            <button wire:click="markAbsent({{ $student->id }})" class="btn btn-danger">Absent</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-6">
            <h3>Absent</h3>
            @foreach ($students as $student)
                @if (!collect($presentStudents)->contains($student->id))
                    <div class="card mb-4 mx-3">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">{{ $student->full_name }}</h5>
                            </div>
                            <div>
                                <button wire:click="markPresent({{ $student->id }})" class="btn btn-success">Present</button>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
