<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>{{ $title ?? 'Kartu Kendali' }}</title>

  {{-- Asset Tailwind/Vite (tetap gunakan yang sama) --}}
  @vite(['resources/css/app.css','resources/js/app.js'])

  {{-- Setup kertas A4 + reset print --}}
  <style>
    @page { size: A4; margin: 12mm; }

    html, body {
      background: #fff !important;
      color: #0f172a; /* slate-900 */
    }

    /* Pastikan halaman benar-benar polos saat print */
    @media print {
      .print-hide { display: none !important; }
      .sheet-a4, .sheet-a4 * {
        position: static !important;
        inset: auto !important;
        overflow: visible !important;
        box-shadow: none !important;
        background: #fff !important;
      }
      .no-break, .sheet-a4 { break-inside: avoid; page-break-inside: avoid; }
    }

    /* Lebar konten = 210mm agar persis A4 */
    .sheet-a4 { width: 210mm; margin: 0 auto; background: #fff; }
  </style>

  @stack('styles')
</head>
<body class="bg-white">
  {{-- Konten dari view --}}
  @yield('content')

  @stack('scripts')
</body>
</html>
