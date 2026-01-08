@extends('layouts.admin')

@section('title', 'Buat Pengumuman')
@section('page-title', 'Buat Pengumuman Baru')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.announcements.index') }}" class="text-green-600 hover:text-green-700 font-medium">
        ← Kembali ke Daftar Pengumuman
    </a>
</div>

<div class="max-w-3xl">
    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <form action="{{ route('admin.announcements.store') }}" method="POST">
            @csrf

            <div class="space-y-6">
                <!-- Title -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Judul Pengumuman <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('title') border-red-500 @enderror"
                        placeholder="Contoh: Pengumuman Hasil Seleksi Tahap 1">
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Type -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Tipe Pengumuman <span class="text-red-500">*</span>
                    </label>
                    <select name="type" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('type') border-red-500 @enderror">
                        <option value="">Pilih Tipe</option>
                        <option value="general" {{ old('type') === 'general' ? 'selected' : '' }}>Umum</option>
                        <option value="acceptance" {{ old('type') === 'acceptance' ? 'selected' : '' }}>Penerimaan</option>
                        <option value="rejection" {{ old('type') === 'rejection' ? 'selected' : '' }}>Informasi/Rejection</option>
                    </select>
                    @error('type')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Content -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Konten Pengumuman <span class="text-red-500">*</span>
                    </label>
                    <textarea name="content" rows="10" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('content') border-red-500 @enderror"
                        placeholder="Tulis isi pengumuman di sini...">{{ old('content') }}</textarea>
                    @error('content')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Published Date -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Tanggal Publikasi (Opsional)
                    </label>
                    <input type="datetime-local" name="published_at" value="{{ old('published_at') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('published_at') border-red-500 @enderror">
                    <p class="text-xs text-gray-500 mt-1">Kosongkan untuk menggunakan waktu saat ini</p>
                    @error('published_at')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Is Active -->
                <div class="flex items-center">
                    <input type="checkbox" name="is_active" id="is_active" value="1" 
                        {{ old('is_active', true) ? 'checked' : '' }}
                        class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                    <label for="is_active" class="ml-2 text-sm text-gray-700">
                        Aktifkan pengumuman (tampilkan di website)
                    </label>
                </div>

                <!-- Actions -->
                <div class="flex justify-end gap-4 pt-4 border-t border-gray-200">
                    <a href="{{ route('admin.announcements.index') }}" 
                       class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition">
                        Publikasikan Pengumuman
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection