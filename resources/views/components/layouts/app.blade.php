<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Todo app' }}</title>
        @vite('resources/css/app.css')
        <script src="https://code.iconify.design/iconify-icon/3.0.0/iconify-icon.min.js"></script>
    </head>
    <body data-theme="light">
        {{ $slot }}
    </body>
</html>
