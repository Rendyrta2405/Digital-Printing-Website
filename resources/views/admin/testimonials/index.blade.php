@extends('admin.layout.app')

@section('title', 'Moderasi Testimoni')

@section('content')
@php $card = 'bg-white rounded-2xl border border-slate-200 shadow-sm'; @endphp

<div class="space-y-4">
  @forelse ($testimonials as $t)
    <div class="{{ $card }} p-5 flex flex-col md:flex-row md:items-center gap-4">

      {{-- Avatar: foto atau inisial --}}
      @if ($t->image)
        <img src="{{ asset('storage/' . $t->image) }}" class="w-14 h-14 rounded-full object-cover">
      @else
        <div class="w-14 h-14 rounded-full bg-gradient-to-br from-brand to-cmyk-c text-white flex items-center justify-center font-extrabold text-xl">
          {{ strtoupper(substr($t->name, 0, 1)) }}
        </div>
      @endif

      <div class="flex-1">
        <p class="font-extrabold">
          {{ $t->name }}
          <span class="text-slate-400 text-sm font-semibold">· {{ $t->role ?? '-' }}</span>
        </p>
        <p class="text-amber-500 text-sm mb-1">{{ str_repeat('★', $t->rating) }}</p>
        <p class="text-sm text-slate-600 italic break-all">“{{ $t->content }}”</p>
      </div>

      <div class="flex flex-wrap items-center gap-2">
        <span class="px-3 py-1 rounded-full text-xs font-bold
                     {{ $t->is_approved ? 'bg-emerald-100 text-emerald-600' : 'bg-amber-100 text-amber-600' }}">
          {{ $t->is_approved ? 'Tayang' : 'Menunggu' }}
        </span>

        <form method="POST" action="{{ route('admin.testimonials.update', $t) }}">
          @csrf @method('PATCH')
          <input type="hidden" name="is_approved" value="{{ $t->is_approved ? 0 : 1 }}">
          <button class="px-4 py-2 rounded-xl text-sm font-extrabold border transition
                         {{ $t->is_approved ? 'border-amber-300 text-amber-600 hover:bg-amber-50' : 'border-emerald-300 text-emerald-600 hover:bg-emerald-50' }}">
            {{ $t->is_approved ? 'Tarik' : 'Setujui' }}
          </button>
        </form>

        <form method="POST" action="{{ route('admin.testimonials.destroy', $t) }}"
              onsubmit="return confirm('Hapus testimoni ini?')">
          @csrf @method('DELETE')
          <button class="px-4 py-2 rounded-xl text-sm font-extrabold border border-red-200 text-red-500 hover:bg-red-50">
            Hapus
          </button>
        </form>
      </div>
    </div>
  @empty
    <div class="{{ $card }} p-10 text-center text-slate-400">Belum ada testimoni masuk.</div>
  @endforelse
</div>

<div class="mt-5">{{ $testimonials->links() }}</div>
@endsection