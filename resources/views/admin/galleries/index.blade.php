@extends('admin.layouts.app')

@section('title', 'Manajemen Galeri')

@section('content')
<div class="flex justify-between items-center mb-6">
   <h1 class="text-2xl font-bold text-slate-800">🖼️ Manajemen Galeri</h1>
   <!-- Button trigger modal -->
   <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddModal">
     + Tambah Galeri
   </button>
</div>

<!-- Galeri Dengan Lightbox -->
<section class="py-3 px-3 bg-light overflow-hidden bg-white rounded-xl shadow overflow-x-auto">
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
    @forelse($galleries as $g)
        <div class="col">
            <div class="card h-100 shadow-sm border-0">
                <!-- Wrapper Gambar dengan Rasio 4:3 Seragam -->
                <div class="position-relative overflow-hidden" style="padding-top: 75%; background-color: #f8f9fa;">
                    <img src="{{ asset('storage/' . $g->image) }}" 
                         data-description="{{ $g->description ?? 'Tidak ada deskripsi' }}"
                         class="position-absolute top-0 start-0 w-100 h-100 img-fluid"
                         style="object-fit: cover; cursor: zoom-in;"
                         onclick="openLightbox(this.src, this.dataset.description)"
                         alt="Gambar tidak ditemukan">
                </div>
                
                <!-- Info Deskripsi Gambar -->
                <div class="card-body d-flex flex-column justify-content-between p-3">
                    <p class="card-text text-muted small text-truncate mb-3" title="{{ $g->description }}">
                        {{ $g->description ?? 'Tidak ada deskripsi' }}
                    </p>
                    
                    <!-- Tombol Aksi Kanan & Kiri -->
                    <div class="d-flex justify-content-between align-items-center">
                        <!-- Tombol Edit -->
                        <button type="button" 
                           class="btn btn-sm btn-outline-primary" 
                           data-bs-toggle="modal" 
                           data-bs-target="#EditModal{{ $g->id }}">
                            <i class="bi bi-pencil-square"></i> Edit
                        </button>
                        
                        <!-- Form Hapus -->
                        <form action="{{ route('admin.galleries.destroy', $g) }}" 
                              method="POST" 
                              onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="p-6 w-full text-center text-slate-400">
           <span class="text-2xl">📸</span>
           <br>
           <span>Galeri Anda masih kosong!!</span>
           <br>
           <span>Ayo tambahkan beberapa gambar untuk ditampilkan di website!</span>
        </div>
    @endforelse
</div>

</section>

<!-- Add Modal -->
<div class="modal fade" id="AddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
     <form action="{{ route('admin.galleries.store') }}" method="post" class="form" enctype="multipart/form-data">
        @csrf
       <div class="modal-content">
         <div class="modal-header">
           <h1 class="modal-title fs-5" id="exampleModalLabel">🖼️ Tambah Galeri</h1>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <div class="mb-3">
               <label for="" class="form-label">Input gambar</label>
               <input type="file" name="image" class="form-control" required
                  accept="image/*">
               <p class="text-xs text-slate-500 mt-1">Gambar wajib diisi. Maks 2 MB.</p>
            </div>
            <div class="mb-3">
               <label for="" class="form-label">Tampilkan di website?</label>
               <select name="show_in_web" id="" class="form-select">
                  <option value="1"
                     @selected(old('show_in_web'))>Tampilkan</option>
                  <option value="0"
                     @selected(old('show_in_web'))>Tidak</option>
               </select>
            </div>
            <div class="mb-3">
               <label for="" class="form-label">Deskripsi (opsional)</label>
               <textarea name="description" id="" class="form-control"
                  placeholder="Hasil cetak Banner dengan..">{{ old('description') }}</textarea>
            </div>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
           <button type="submit" class="btn btn-primary">Tambah</button>
         </div>
       </div>
     </form>
  </div>
</div>

<!-- Edit Modal -->
@foreach($galleries as $g)
<div class="modal fade" id="EditModal{{ $g->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
     <form action="{{ route('admin.galleries.update', $g) }}" method="post" class="form" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
       <div class="modal-content">
         <div class="modal-header">
           <h1 class="modal-title fs-5" id="exampleModalLabel">🖼️ Update Galeri</h1>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <div class="">
               <label for="" class="form-label">Gambar sebelumnya</label>
               <img src="{{ asset('storage/' . $g->image) }}"
              class="gallery-img img-fluid rounded-3 mb-3 text-sm max-w-40 max-h-40" 
              alt="Gambar sebelumnya">
            </div>
            <div class="mb-3">
               <label for="" class="form-label">Input gambar</label>
               <input type="file" name="image" id="" class="form-control"
                  accept="image/*">
               <p class="text-xs text-slate-500 mt-1">Kosongkan jika tidak ingin mengganti gambar. Maks 2 MB.</p>
            </div>
            <div class="mb-3">
               <label for="" class="form-label">Tampilkan di website?</label>
               <select name="show_in_web" id="" class="form-select">
                  <option value="1"
                     @selected(old('show_in_web', 
                     $g->show_in_web ?? ''))>Tampilkan</option>
                  <option value="0"
                     @selected(old('show_in_web', 
                     !$g->show_in_web ?? ''))>Tidak</option>
               </select>
            </div>
            <div class="mb-3">
               <label for="" class="form-label">Deskripsi (opsional)</label>
               <textarea name="description" id="" class="form-control"
                  placeholder="Hasil cetak Banner dengan..">{{ old('description', $g->description) }}</textarea>
            </div>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
           <button type="submit" class="btn btn-primary">Update</button>
         </div>
       </div>
     </form>
  </div>
</div>
@endforeach

<div class="mt-4">{{ $galleries->links() }}</div>
@endsection