@extends('admin.layouts.app')

@section('title', 'Moderasi Testimoni')

@section('content')
<h1 class="text-2xl font-bold text-slate-800 mb-6">💬 Moderasi Testimoni</h1>

<div class="space-y-3">
   @forelse ($testimonials as $t)
      <div class="bg-white rounded-xl shadow p-5 flex flex-wrap items-center gap-4 flex-col">
         @if ($t->image)
            <img class="rounded-full w-20 h-auto" 
               src="{{ asset('storage/' . $t->image) }}" 
               alt="{{ $t->name }}"
               onclick="openLightbox(this.src, this.alt)">
         @endif 
         <div class="flex gap-3 items-center">
            <div class="flex-1 min-w-[200px]">
               <p class="font-medium">
                  {{ $t->name }}
                  <span class="text-slate-400 text-sm">{{ $t->role ?? '-' }}</span>
                  <span class="text-yellow-500 text-sm">{{ str_repeat('⭐', $t->rating) }}</span>
               </p>
               <p class="text-sm text-slate-600 italic">{{ $t->content }}</p>
            </div>
   
            <span class="h-fit px-2 py-1 rounded-full text-xs items-center
               {{ $t->is_approved ? 'bg-emerald-100 text-emerald-700' : 'bg-orange-100 text-orange-700' }}">
               {{ $t->is_approved ? 'Tayang' : 'Menunggu' }}
            </span>
         </div>

         <div class="flex gap-3">
            <form action="{{ route('admin.testimonials.update', $t) }}" method="post">
               @csrf
               @method('PATCH')
   
               <input type="hidden" name="is_approved" value="{{ $t->is_approved ? 0 : 1 }}">
               <button class="text-sm {{ $t->is_approved ? 'text-orange-600' : 'text-emerald-600' }} hover:underline">
                  {{ $t->is_approved ? 'Tarik dari website' : 'Setujui dan tayangkan' }}
               </button>
            </form>
   
            <form action="{{ route('admin.testimonials.destroy', $t) }}" method="post"
               onsubmit="return confirm('Hapus testimoni ini?')">
               @csrf
               @method('DELETE')
               <button class="text-sm text-red-600 hover:underline">Hapus</button>
            </form>
         </div>
      </div>
   @empty
      <p class="text-slate-400">Belum ada testimoni.</p>
   @endforelse
</div>

<div class="mt-4">
   {{ $testimonials->links() }}
</div>
@endsection