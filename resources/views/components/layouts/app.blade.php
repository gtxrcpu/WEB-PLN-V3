<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title ?? 'Inventaris K3 PLN' }}</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="antialiased bg-slate-50 text-slate-900">
  {{-- Topbar --}}
  <header class="sticky top-0 z-40 bg-white/85 backdrop-blur ring-1 ring-slate-200">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
      <div class="flex items-center gap-3">
        <img src="{{ asset('images/logoo.png') }}" alt="PLN" class="h-8 w-auto object-contain">
        <span class="font-semibold">Inventaris K3 PLN — <span class="text-emerald-700">User</span></span>
      </div>

      <div class="hidden md:flex items-center gap-4">
        @php
          $u = auth()->user();
          $avatar = $u?->avatar_path ? asset('storage/'.$u->avatar_path) : null;
          $initial = strtoupper(mb_substr($u?->name ?? 'U', 0, 1));
        @endphp
        <div x-data="{open:false}" class="relative">
          <button @click="open=!open" class="flex items-center gap-2 rounded-xl px-3 py-2 hover:bg-slate-100 transition">
            @if($avatar)
              <img src="{{ $avatar }}" alt="Avatar" class="h-8 w-8 rounded-full object-cover ring-1 ring-slate-200">
            @else
              <div class="h-8 w-8 rounded-full bg-emerald-100 text-emerald-800 grid place-items-center ring-1 ring-emerald-200">{{ $initial }}</div>
            @endif
            <span class="text-sm">{{ $u?->name ?? 'User' }}</span>
          </button>

          <div x-cloak x-show="open" @click.outside="open=false" x-transition
               class="absolute right-0 mt-2 w-60 rounded-xl bg-white shadow-md ring-1 ring-slate-200 p-2">
            <a href="#" class="block rounded-lg px-3 py-2 hover:bg-slate-50 text-slate-700">Profil</a>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="w-full text-left rounded-lg px-3 py-2 hover:bg-rose-50 text-rose-700">Logout</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </header>

  {{-- Page: beri padding bawah agar konten tidak tertutup nav --}}
  <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6
               md:pb-8
               pb-[calc(72px+env(safe-area-inset-bottom))]">
    {{ $slot }}
  </main>

  {{-- Bottom nav (mobile) --}}
  <nav class="md:hidden fixed bottom-0 inset-x-0 z-40 bg-white/95 backdrop-blur
            border-t border-slate-200 shadow-[0_-6px_16px_rgba(2,6,23,0.06)]
            pb-[env(safe-area-inset-bottom)]">
  <div class="grid grid-cols-4 text-[11px] text-slate-600">
    <a href="{{ route('user.dashboard') }}" class="flex flex-col items-center justify-center gap-1 py-3 hover:text-slate-900">
      {{-- Home (biarkan yang lama) --}}
      <svg viewBox="0 0 24 24" class="h-5 w-5"><path d="M3 10.5 12 3l9 7.5V21a1 1 0 0 1-1 1h-5v-7H9v7H4a1 1 0 0 1-1-1v-10.5Z" fill="currentColor"/></svg>
      <span>Home</span>
    </a>

    <a href="{{ route('user.items') }}" class="flex flex-col items-center justify-center gap-1 py-3 hover:text-slate-900">
      {{-- Item (ikon BARU) --}}
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24">
        <path fill="currentColor" fill-rule="evenodd"
              d="M12 1.25c-.605 0-1.162.15-1.771.402c-.589.244-1.273.603-2.124 1.05L6.037 3.787c-1.045.548-1.88.987-2.527 1.418c-.668.447-1.184.917-1.559 1.554c-.374.635-.542 1.323-.623 2.142c-.078.795-.078 1.772-.078 3.002v.194c0 1.23 0 2.207.078 3.002c.081.82.25 1.507.623 2.142c.375.637.89 1.107 1.56 1.554c.645.431 1.481.87 2.526 1.418l2.068 1.085c.851.447 1.535.806 2.124 1.05c.61.252 1.166.402 1.771.402s1.162-.15 1.771-.402c.589-.244 1.273-.603 2.124-1.05l2.068-1.084c1.045-.549 1.88-.988 2.526-1.419c.67-.447 1.185-.917 1.56-1.554c.374-.635.542-1.323.623-2.142c.078-.795.078-1.772.078-3.001v-.196c0-1.229 0-2.206-.078-3.001c-.081-.82-.25-1.507-.623-2.142c-.375-.637-.89-1.107-1.56-1.554c-.645-.431-1.481-.87-2.526-1.418l-2.068-1.085c-.851-.447-1.535-.806-2.124-1.05c-.61-.252-1.166-.402-1.771-.402M8.77 4.046c.89-.467 1.514-.793 2.032-1.007c.504-.209.859-.289 1.198-.289c.34 0 .694.08 1.198.289c.518.214 1.141.54 2.031 1.007l2 1.05c1.09.571 1.855.974 2.428 1.356c.282.189.503.364.683.54l-3.331 1.665l-8.5-4.474zm-1.825.958l-.174.092c-1.09.571-1.855.974-2.427 1.356a4.7 4.7 0 0 0-.683.54L12 11.162l3.357-1.68l-8.206-4.318a.8.8 0 0 1-.206-.16M2.938 8.307c-.05.214-.089.457-.117.74c-.07.714-.071 1.617-.071 2.894v.117c0 1.278 0 2.181.071 2.894c.069.697.2 1.148.423 1.528c.222.377.543.696 1.1 1.068c.572.382 1.337.785 2.427 1.356l2 1.05c.89.467 1.513.793 2.031 1.007q.244.101.448.165v-8.663zm9.812 12.818q.204-.063.448-.164c.518-.214 1.141-.54 2.031-1.007l2-1.05c1.09-.572 1.855-.974 2.428-1.356c.556-.372.877-.691 1.1-1.068c.223-.38.353-.83.422-1.528c.07-.713.071-1.616.071-2.893v-.117c0-1.278 0-2.181-.071-2.894a6 6 0 0 0-.117-.74L17.75 9.963V13a.75.75 0 0 1-1.5 0v-2.286l-3.5 1.75z"
              clip-rule="evenodd"/>
      </svg>
      <span>Item</span>
    </a>

    <form method="POST" action="{{ route('logout') }}" class="flex flex-col items-center justify-center gap-1 py-3">
      @csrf
      <button class="text-rose-700 hover:text-rose-800 flex flex-col items-center">
        {{-- Logout (tetap) --}}
        <svg viewBox="0 0 24 24" class="h-5 w-5"><path d="M9 21H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h3M16 17l5-5-5-5M21 12H9" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        <span>Logout</span>
      </button>
    </form>
  </div>
</nav>

</body>
</html>
