@extends('layouts.guest-app')

@section('content')

<div class="py-4 px-5" style="width: 100%; box-sizing: border-box;">
    <div style="position: relative; width: 100%; text-align: center; background-image: url('assets/img/welcome-background.jpeg'); background-size: cover; background-position: center; padding: 50px; border: none; box-sizing: border-box; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">

        <!-- Overlay with transparency -->
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.3);"></div>
    
        <h1 style="position: relative; color: #ffffff; margin-bottom: 1px;">SELAMAT DATANG</h1>
        <h2 style="position: relative;color: #ffffff; line-height: 1; letter-spacing: 2px;">Taska & Tadika Ihsan</h2>
    
    </div>
        
    <div style="display: flex; justify-content: space-between; margin: 20px 0; padding-bottom: 10px;">

        <div class="card col-md-6">
            <div class="card-header bg-primary text-light fw-bold py-3">Nota untuk Ibu Bapa</div>
            <div class="card-body mt-2 mx-4 fw-bold">Ibu bapa yang dihormati, <br/><br/>
                Jika anda adalah ibu bapa yang telah mendaftar di dalam sistem Ihsan, 
                sila klik ‘Log masuk’ untuk meneruskan perkhidmatan. Sekiranya anda adalah pengguna baharu, 
                sila klik ‘Daftar’ untuk mendaftar.
            </div>
        </div>

        <div class="w-auto col-md-6" style="padding: 20px;">

            <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">

                <div class="text-primary fw-bold w-auto">
                    <h3>Taska Ihsan</h3>
                </div>

                <div class="card bg-primary text-light p-2 mx-2 w-50 lh-1">
                    <h3 class="card-title text-center py-0 my-0 fs-1 fw-bold">{{ $taska_capacity }}</h3>
                    <p class="card-text text-center py-0 my-0 fw-light">Kekosongan</p>
                </div>

                <div class="card bg-primary text-light p-2 mx-2 w-50 lh-1">
                    <h3 class="card-title text-center py-0 my-0 fs-1 fw-bold">{{ $taska->active_students }}</h3>
                    <p class="card-text text-center py-0 mt-0 mb-1 fw-light">Murid telah mendaftar</p>
                </div>

            </div>

            <div class="" style="display: flex; justify-content: space-between;">

                <div class="text-primary fw-bold w-auto text-wrap">
                    <h3>Tadika Ihsan</h3>
                </div>

                <div class="card bg-primary text-light p-2 mx-2 w-50 lh-1">
                    <h3 class="card-title text-center py-0 my-0 fs-1 fw-bold">{{ $tadika_capacity }}</h3>
                    <p class="card-text text-center py-0 my-0 fw-light">Kekosongan</p>
                </div>

                <div class="card bg-primary text-light p-2 mx-2 w-50 lh-1">
                    <h3 class="card-title text-center py-0 my-0 fs-1 fw-bold">{{ $tadika->active_students }}</h3>
                    <p class="card-text text-center py-0 mt-0 mb-1 fw-light">Murid telah mendaftar</p>
                </div>

            </div>
        </div>
    </div>

</div>

<div class="botman-bubble" id="botmanBubble">Klik di sini untuk berbual!</div>

@endsection

@section('js')
<script>
    var botmanWidget = {
        frameEndpoint: '/chat',
        introMessage: 'Saya Ihsan Bot, apa yang boleh saya bantu?',
        chatServer: '/botman',
        title: 'Ihsan Bot',
        placeholderText: 'Hantarkan soalan anda...',
        mainColor: '#BABABA',
        bubbleBackground: '#BABABA',
        aboutText: '', // text to display to navigate to botman website 
        bubbleAvatarUrl: 'https://openclipart.org/image/800px/307415',
        desktopHeight: '400px',
        desktopWidth: '350px',
        mobileHeight: '300px',
        mobileWidth: '100%',
        position: 'bottom-right',
    };
</script>
<script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const chatWindow = document.getElementById('messageArea');

        function scrollToBottom() {
            chatWindow.scrollTop = chatWindow.scrollHeight;
        }

        const observer = new MutationObserver(scrollToBottom);
        observer.observe(chatWindow, { childList: true });

        scrollToBottom();
    });
</script>
@endsection