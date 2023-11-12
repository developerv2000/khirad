<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="msapplication-config" content="{{ asset('msapplication-config.xml') }}">

    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('img/icons/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/icons/favicon-32x32.png') }}">

    {{-- COnfig Safari browser --}}
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('img/icons/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('img/icons/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="167x167" href="{{ asset('img/icons/apple-icon-167x167.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/icons/apple-icon-180x180.png') }}">

    {{-- Hide Safari User Interface Components & Change status bar color --}}
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="#02716A">

    <title>{{$book->title}} — хондани китоб</title>
    <meta name="keywords" content="{{$book->title}}, книги, бесплатные книги, онлайн библиотека, купить книги в Таджикистане, читать книги онлайн"/>

    {{-- Opengraph --}}
    <meta name="description" content="{{ App\Helpers\Helper::generateShareText($book->description) }}">
    <meta property="og:description" content="{{ App\Helpers\Helper::generateShareText($book->description) }}">
    <meta property="og:locale" content="ru_RU" />
    <meta property="og:type" content="object" />
    <meta property="og:title" content="{{ $book->title }}" />
    <meta property="og:site_name" content="Хирад" />
    <meta property="og:image" content="{{ asset('img/books/' . $book->image )}}">
    <meta property="og:image:alt" content="{{ $book->title }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $book->title }}">
    <meta name="twitter:image" content="{{ asset('img/books/' . $book->image) }}">

    <style>
        * {
            box-sizing: border-box;
        }
    body {
        height: 100vh;
        margin: 0;
        padding: 10px;
        background-color: #333;
    }
    .container {
        height: 100%;
        width: 100%;
    }
    .fullscreen {
        background-color: #333;
    }
    </style>
</head>

<body>
    <div class="container" id="container"></div>

    <script>
      window.PDFJS_LOCALE = {
        pdfJsWorker: '{{ asset("plugins/pdf-reader/js/pdf.worker.js") }}',
        pdfJsCMapUrl: '{{ asset("plugins/pdf-reader/cmaps") }}'
      };
    </script>

    <script src="{{ asset('plugins/pdf-reader/js/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/pdf-reader/js/three.min.js') }}"></script>
    <script src="{{ asset('plugins/pdf-reader/js/pdf.min.js') }}"></script>
    <script src="{{ asset('plugins/pdf-reader/js/3dflipbook.min.js') }}"></script>

    <script type="text/javascript">
        $('#container').FlipBook({
            pdf: '{{ asset("books/" . $book->filename) }}',

            controlsProps: {
                actions: {
                    cmdFullScreen: {
                        enabled: true,
                    },
                    cmdBackward: {
                        code: 37,
                    },
                    cmdForward: {
                        code: 39
                    },
                },
            },

            template: {
                sounds: {
                    startFlip: '{{ asset("plugins/pdf-reader/sounds/start-flip.mp3") }}',
                    endFlip: '{{ asset("plugins/pdf-reader/sounds/end-flip.mp3") }}'
                },
                html: '{{ asset("plugins/pdf-reader/templates/default-book-view.html") }}',
                styles: [
                    '{{ asset("plugins/pdf-reader/css/short-black-book-view.css") }}'
                ],
                links: [
                    {
                        rel: 'stylesheet',
                        href: '{{ asset("plugins/pdf-reader/css/font-awesome.min.css") }}'
                    }
                ],
                script: '{{ asset("plugins/pdf-reader/js/default-book-view.js") }}'
            }
        });
    </script>
</body>

</html>
