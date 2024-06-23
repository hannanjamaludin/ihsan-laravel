<div class="modal fade" id="modalMedia" tabindex="-1" aria-labelledby="modalMediaLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="modalMediaLabel">
                    @if ($mediaType == 'class')
                        {{ $activity->activity ?? '' }} {{ $activity->date ?? '' }}
                    @endif
                    @if ($mediaType == 'student')
                        {{ $activityStudent->activity->activity ?? '' }} {{ $activityStudent->activity->date ?? '' }}
                    @endif
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row ms-1">
                    {{-- Class Media --}}
                    @if ($mediaType == 'class' && $activity)
                        @php
                            $extension = pathinfo(Storage::url($activity->path), PATHINFO_EXTENSION);
                        @endphp
                        @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                            <img src="{{ Storage::url($activity->path) }}" alt="Image" class="responsive-media">
                        @elseif (in_array($extension, ['mp4', 'webm', 'ogg']))
                            <video controls class="responsive-media" id="videoPlayer-{{ $activity->id }}">
                                <source src="{{ Storage::url($activity->path) }}" type="video/{{ $extension }}">
                                Your browser does not support the video tag.
                            </video>
                        @else
                            <p>Unsupported media type.</p>
                        @endif
                    @endif

                    {{-- Student Media --}}
                    @if ($mediaType == 'student' && $activityStudent)
                        @php
                            $extension = pathinfo(Storage::url($activityStudent->path), PATHINFO_EXTENSION);
                        @endphp
                        @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                            <img src="{{ Storage::url($activityStudent->path) }}" alt="Image" class="responsive-media">
                        @elseif (in_array($extension, ['mp4', 'webm', 'ogg']))
                            <video controls class="responsive-media" id="videoPlayer-{{ $activityStudent->id }}">
                                <source src="{{ Storage::url($activityStudent->path) }}" type="video/{{ $extension }}">
                                Your browser does not support the video tag.
                            </video>
                        @else
                            <p>Unsupported media type.</p>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:load', function() {
        window.livewire.on('openModal', () => {
            $('#modalMedia').modal('show');
        });

        $('#modalMedia').on('hidden.bs.modal', function () {
            window.livewire.emit('resetMedia');
            document.querySelectorAll('video').forEach(video => {
                video.pause();
                video.currentTime = 0;
            });
        });
    });
</script>

<style>
    .responsive-media {
        width: 100%;
        max-width: 100%;
        height: auto;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>
