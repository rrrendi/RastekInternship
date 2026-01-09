@extends('layouts.admin')

@section('title', 'Edit Admin')
@section('page-title', 'Edit Data Admin')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.users.index') }}" class="text-green-600 hover:text-green-700 font-medium">
        ← Kembali ke Daftar Admin
    </a>
</div>

<div class="max-w-2xl">
    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-sm font-medium text-gray-900 mb-4">Ganti Password (Opsional)</h3>
                    <p class="text-xs text-gray-500 mb-4">Kosongkan jika tidak ingin mengubah password</p>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Password Baru
                            </label>
                            <input type="password" name="password"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('password') border-red-500 @enderror">
                            <p class="text-xs text-gray-500 mt-1">Minimal 8 karakter</p>
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Konfirmasi Password Baru
                            </label>
                            <input type="password" name="password_confirmation"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-4 pt-4 border-t border-gray-200">
                    <a href="{{ route('admin.users.index') }}" 
                       class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>

    @if($user->id !== Auth::id())
    <!-- Form Hapus Admin -->
    <div class="bg-red-50 border border-red-200 rounded-xl p-6 mt-6">
        <h3 class="text-sm font-medium text-red-900 mb-2">Zona Bahaya</h3>
        <p class="text-sm text-red-700 mb-4">
            Menghapus admin ini akan menghilangkan akses mereka secara permanen.
        </p>
        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" 
              onsubmit="return confirm('Apakah Anda yakin ingin menghapus admin ini? Tindakan ini tidak dapat dibatalkan.');">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    class="px-4 py-2 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700 transition">
                Hapus Admin
            </button>
        </form>
    </div>
    @endif
</div>
@endsection