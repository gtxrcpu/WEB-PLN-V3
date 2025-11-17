@props(['message'=>null,'type'=>'error','ms'=>4000])
@if($message)
<div x-data="{open:true}" x-init="setTimeout(()=>open=false, {{ $ms }})"
     x-show="open" x-transition.opacity
     class="fixed top-4 right-4 z-50 w-[360px] max-w-[90vw]">
  <div class="rounded-xl px-4 py-3 shadow-lg ring-1
              @if($type==='error') bg-rose-50 ring-rose-200 text-rose-800
              @elseif($type==='success') bg-emerald-50 ring-emerald-200 text-emerald-800
              @else bg-slate-50 ring-slate-200 text-slate-800 @endif">
    <div class="flex gap-3">
      <svg class="h-5 w-5 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              d="M12 9v4m0 4h.01M10.29 3.86l-7.5 13A2 2 0 004.5 20h15a2 2 0 001.71-3.14l-7.5-13a2 2 0 00-3.42 0z"/>
      </svg>
      <span class="text-sm leading-6">{{ $message }}</span>
    </div>
  </div>
</div>
@endif
