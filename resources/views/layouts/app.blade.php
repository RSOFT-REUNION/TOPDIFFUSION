<!DOCTYPE html>
<html>
<head>
    <title>TOPDIFFUSION @yield('title')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content= "RSOFT REUNION x HIVEDROPS" >
    <meta name="description" content="@yield('meta-description')">
    {{-- JS --}}
    <script src="https://cdn.tiny.cloud/1/lkod09hkifz3s8mmskgkohg3ct7wme2fem8v6dm19kpnh89a/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css">
    {{-- PAIEMENT --}}
    @if(\Illuminate\Support\Facades\Config::get('app.env' === 'local'))
        <script src="https://homologation-payment.cdn.payline.com/cdn/scripts/widget-min.js"></script>
        <link rel="stylesheet" href="https://homologation-payment.cdn.payline.com/cdn/styles/widget-min.css">
    @else
        <script src="https://payment.cdn.payline.com/cdn/scripts/widget-min.js"></script>
        <link rel="stylesheet" href="https://payment.cdn.payline.com/cdn/styles/widget-min.css">
    @endif
    {{-- FONT (REDDIT SANS + REDDIT MONO) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Reddit+Sans:ital,wght@0,200..900;1,200..900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    {{-- FONTAWESOME --}}
    <link rel="stylesheet" href="{{ asset('DIST/fontawesome/css/all.min.css') }}">
    <script src="{{ asset('DIST/fontawesome/js/all.min.js') }}"></script>
    {{-- STYLES --}}
    @vite(['resources/css/app.css', 'resources/css/theme.scss'])
</head>
<body>
    @yield('content-app')
    {{-- SCRIPTS --}}
    @yield('content-script')
    @vite(['resources/js/app.js', 'resources/js/functions.js'])
    @livewire('wire-elements-modal')
</body>
</html>
