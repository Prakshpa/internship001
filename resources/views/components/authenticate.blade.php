<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @fonts

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/authenticate.js'])
        @endif
    <title>Laravel Project</title>
</head>
<body class="bg-blue-400 text-white">
    <div class="min-h-screen items-center justify-center flex flex-col">
        {{$slot}}
    </div>
    @stack('scripts')
</body>
</html>