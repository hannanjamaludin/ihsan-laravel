<!doctype html>
<html>

<head>
    <title>Ihsan Bot</title>
    <meta charset="UTF-8">
    <style>
        body,html{ 
            background-color: #f9f9f9;
            font-family: "Ubuntu","Helvetica Neue", Arial, sans-serif;
            font-size: 14px;
            margin: 0;
            padding: 0
        }

        /* Example with !important flag */
        iframe {
            overflow-clip-margin: unset !important; /* or whatever value you want */
            overflow: visible !important; /* or whatever value you want */
        }

        #messageArea{
            overflow-y: auto;
            padding-bottom: 0;
            flex-grow: 1;
            height: calc(100vh - 55px);
        }

        .chat{
            list-style: none;
            background: 0 0;
            padding: 0;
            margin: 0
        }

        .chat li{
            padding: 8px;
            padding: .5rem;
            font-size: 1rem;
            overflow: hidden;
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            color: #000
        }

        .visitor{
            -webkit-box-pack: end;
            -webkit-justify-content: flex-end;
            -ms-flex-pack: end;
            justify-content: flex-end;
            -webkit-box-align: end;
            -webkit-align-items: flex-end;
            -ms-flex-align: end;
            -ms-grid-row-align: flex-end;
            align-items: flex-end
        }

        .visitor .msg{
            -webkit-box-ordinal-group: 2;
            -webkit-order: 1;
            -ms-flex-order: 1;
            order: 1;
            border-top-right-radius: 2px
        }

        .chatbot .msg{
            -webkit-box-ordinal-group: 2;
            -webkit-order: 1;
            -ms-flex-order: 1;
            order: 1;
            border-top-left-radius: 2px
        }

        .msg{
            word-wrap: break-word;
            min-width: 50px;
            max-width: 80%;
            padding: 10px;
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            border-radius: 10px;
            background: #dae1e7
        }

        .msg p{
            margin: 0 0 .2rem 0
        }

        .msg .time{
            font-size: .7rem;
            color: #7d7b7b;
            margin-top: 3px;
            float: right;
            cursor: default;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none
        }

        .textarea{
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            width: 95%;
            height: 55px;
            z-index: 99;
            background-color: #BABABA;
            border: none;
            outline: 0;
            padding-left: 15px;
            padding-right: 15px;
            color: #000;
            font-weight: 300;
            font-size: 1rem;
            line-height: 1.5;
            /* background: rgba(250,250,250,.8) */
            background: #bababaaf
        }

        .textarea: focus{
            background: #fff;
            box-shadow: 0 -6px 12px 0 rgba(235,235,235,.95);
            transition: .4s
        }

        a.banner{
            position: fixed;
            bottom: 5px;
            right: 10px;
            height: 12px;
            z-index: 99;
            outline: 0;
            color: #777;
            font-size: 10px;
            text-align: right;
            font-weight: 200;
            text-decoration: none
        }

        div.loading-dots{
            position: relative
        }

        div.loading-dots .dot{
            display: inline-block;
            width: 8px;
            height: 8px;
            margin-right: 2px;
            border-radius: 50%;
            background: #196eb4;
            animation: blink 1.4s ease-out infinite;
            animation-fill-mode: both
        }

        div.loading-dots .dot: nth-child(2){
            animation-delay: -1.1s
        }

        div.loading-dots .dot: nth-child(3){
            animation-delay: -.9s
        }

        div.loading-dots .dot-grey{
            background: #787878
        }

        div.loading-dots .dot-sm{
            width: 6px;
            height: 6px;
            margin-right: 2px
        }

        div.loading-dots .dot-md{
            width: 12px;
            height: 12px;
            margin-right: 2px
        }

        div.loading-dots .dot-lg{
            width: 16px;
            height: 16px;
            margin-right: 3px
        }

        @keyframes blink{
            0%,100%{opacity: .2}20%{opacity: 1}
        }

        .btn{
            display: block;
            padding: 5px;
            border-radius: 5px;
            margin: 5px;
            min-width: 100px;
            background-color: #408591;
            /* background-color: #703232; */
            cursor: pointer;
            color: #fff;
            text-align: center
        }

    </style>
</head>

<body>
    @php
        \Debugbar::disable();
    @endphp

    <script id="botmanWidget" src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/chat.js'></script>
    {{-- <script>
        if (document.querySelectorAll('.chatbot .msg').value){
            const chatWindow = document.getElementById('messageArea');
            chatWindow.scrollTop = chatWindow.scrollHeight;
        }
    </script> --}}

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
</body>

</html>
