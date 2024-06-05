<div wire:ignore.self class="modal fade" id="modalClassDetails" tabindex="-1" aria-labelledby="modalClassDetailsLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            @if ($class_room <= 5)
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="modalClassDetailsLabel">Maklumat Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row ms-1">
                        <div class="form-group row">
                            <div class="col-6 pl-1">
                                <div class="form-group">
                                    <label class="form-label">Nama Kelas</label>
                                    <input type="text" class="form-control" wire:model="className" disabled>
                                </div>
                            </div>
                            <div class="col-6 pl-1">
                                <div class="form-group">
                                    <label class="form-label">Nama Guru</label>
                                    <input type="text" class="form-control" wire:model="teacher" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mt-1">
                            <div class="col-6 pl-1">
                                <div class="form-group">
                                    <label class="form-label">Kapasiti</label>
                                    <input type="text" class="form-control" wire:model="capacity">
                                </div>
                            </div>
                            <div class="col-6 pl-1">
                                <div class="form-group">
                                    <label class="form-label">Jumlah Murid</label>
                                    <input type="text" class="form-control" wire:model="totalStudents" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <div class="text-muted fst-italic">**Maklumat guru boleh dikemaskini di ruangan "Pengurusan Guru" dan klik pada butang " 
                        <i class="fas fa-eye text-secondary" style="font-size: 10px;"></i> 
                        " bagi pengurusan murid</div>
                    <button type="button" class="btn btn-primary text-light" wire:click="updateClass">Hantar</button>
                </div>
            @else
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="modalClassDetailsLabel">Maklumat Bilik</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row ms-1">
                        <div class="form-group row">
                            <div class="col-6 pl-1">
                                <div class="form-group">
                                    <label class="form-label">Nama Bilik</label>
                                    <input type="text" class="form-control" wire:model="className" disabled>
                                </div>
                            </div>
                            <div class="col-6 pl-1">
                                <div class="form-group">
                                    <label class="form-label">Nama Pengasuh</label>
                                    <input type="text" class="form-control" wire:model="teacher" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mt-1">
                            <div class="col-6 pl-1">
                                <div class="form-group">
                                    <label class="form-label">Kapasiti</label>
                                    <input type="text" class="form-control" wire:model="capacity">
                                </div>
                            </div>
                            <div class="col-6 pl-1">
                                <div class="form-group">
                                    <label class="form-label">Jumlah Kanak-kanak</label>
                                    <input type="text" class="form-control" wire:model="totalStudents" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <div class="text-muted fst-italic">**Maklumat guru boleh dikemaskini di ruangan "Pengurusan Guru" dan klik pada butang " 
                        <i class="fas fa-eye text-secondary" style="font-size: 10px;"></i> 
                        " bagi pengurusan murid</div>
                    <button type="button" class="btn btn-primary text-light" wire:click="updateClass">Hantar</button>
                </div>
            @endif

        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:load', function () {
        window.livewire.on('openModal', () => {
            $('#modalClassDetails').modal('show');
        });

        window.livewire.on('closeModal', () => {
            $('#modalClassDetails').modal('hide');
        });
    });
</script>
