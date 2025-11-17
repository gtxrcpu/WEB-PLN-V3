<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name','Inventaris K3 PLN') }}</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="antialiased bg-white">
  {{-- Full-bleed, no outer border/spacing, no vertical scroll on desktop --}}
  <div class="min-h-screen h-screen overflow-hidden">
    {{ $slot }}
  </div>
</body>
</html>
