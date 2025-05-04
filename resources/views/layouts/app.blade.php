
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Green Generation Kudus' }}</title>

    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    
    @wireUiStyles
    @vite(['resources/css/app.css'])
    @livewireStyles
</head>
<body>
    <x-notifications />
    <div class="bg-green-600 min-h-screen flex items-center justify-center p-4">
        {{ $slot }}       
    </div>
    @livewireScripts
    @wireUiScripts
    <script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>

