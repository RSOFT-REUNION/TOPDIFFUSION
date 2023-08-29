<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite([
            'resources/css/app.css',
            'resources/scss/template.scss',
            'resources/scss/component.scss',
            'resources/scss/responsive.scss',
        ])
        <title>@yield('title')</title>
    </head>
    <body class="flex flex-rows w-screen h-screen ">
        @yield('message')
    </body>
</html>
