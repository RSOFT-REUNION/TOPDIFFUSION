<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Top diffusion</title>
    <!-- METAS -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name= "author" content= "RSOFT REUNION (Brian HOARAU)" >
    <meta name="generator" content="RSOFT CMS (1.0)">
    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/fontawesome/css/brands.min.css') }}">
    <!-- SCRIPTS -->
    <script src="https://cdn.tiny.cloud/1/lkod09hkifz3s8mmskgkohg3ct7wme2fem8v6dm19kpnh89a/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://unpkg.com/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
    <!-- STYLES -->
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/scss/template.scss',
        'resources/scss/component.scss',
        'resources/scss/responsive.scss',
        'resources/js/tinyMCE.js'
    ])
    @livewireStyles
</head>
<body class="antialiased">
    @if($settingGlobal->development_mode == 1)
        <div id="development_box">
            <p><i class="fa-brands fa-dev mr-3"></i>Mode développement</p>
        </div>
    @endif
    @include('components.flash-messages')
    @yield('content-app')
    <!-- SCRIPTS -->
    @vite('resources/js/functions.js')
    @vite('resources/js/clickable.js')
    @yield('meta-script')
    @livewire('livewire-ui-modal')
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script>
</body>
</html>
