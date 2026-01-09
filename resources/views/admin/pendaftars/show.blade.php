@extends('layouts.admin')

@section('title', 'Detail Pendaftar')
@section('page-title', 'Detail Pendaftar')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.pendaftars.index') }}" class="text-green-600 hover:text-green-700 font-medium">
        ← Kembali ke Daftar Pendaftar
    </a>
</div>

<div class="grid lg:grid-cols-3 gap-6">
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Personal Info -->
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Data Pribadi</h3>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="text-sm text-gray-600">Nama Lengkap</label>
                    <p class="font-medium text-gray-900">{{ $pendaftar->full_name }}</p>
                </div>
                <div>
                    <label class="text-sm text-gray-600">Email</label>
                    <p class="font-medium text-gray-900">{{ $pendaftar->email }}</p>
                </div>
                <div>
                    <label class="text-sm text-gray-600">Nomor Telepon</label>
                    <p class="font-medium text-gray-900">{{ $pendaftar->phone }}</p>
                </div>
                <div>
                    <label class="text-sm text-gray-600">Jenis Kelamin</label>
                    <p class="font-medium text-gray-900">{{ $pendaftar->gender }}</p>
                </div>
                <div>
                    <label class="text-sm text-gray-600">Tempat Lahir</label>
                    <p class="font-medium text-gray-900">{{ $pendaftar->birth_place }}</p>
                </div>
                <div>
                    <label class="text-sm text-gray-600">Tanggal Lahir</label>
                    <p class="font-medium text-gray-900">{{ $pendaftar->birth_date->format('d F Y') }}</p>
                </div>
                <div class="md:col-span-2">
                    <label class="text-sm text-gray-600">Alamat</label>
                    <p class="font-medium text-gray-900">{{ $pendaftar->address }}</p>
                </div>
            </div>
        </div>

        <!-- Education Info -->
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Data Pendidikan</h3>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="text-sm text-gray-600">Jenjang Pendidikan</label>
                    <p class="font-medium text-gray-900">{{ $pendaftar->education_level }}</p>
                </div>
                <div>
                    <label class="text-sm text-gray-600">Nama Institusi</label>
                    <p class="font-medium text-gray-900">{{ $pendaftar->institution }}</p>
                </div>
                <div>
                    <label class="text-sm text-gray-600">
                        {{ $pendaftar->education_level === 'SMK' ? 'Rata-rata Rapor' : 'IPK' }}
                    </label>
                    <p class="font-medium text-gray-900">{{ number_format($pendaftar->gpa_average, 2) }}</p>
                </div>
            </div>
        </div>

        <!-- Documents -->
        @if($pendaftar->documents)
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Dokumen</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="font-medium text-gray-900">Surat Pengantar</span>
                    </div>
                    <a href="{{ Storage::url($pendaftar->documents->cover_letter_path) }}" target="_blank"
                       class="text-green-600 hover:text-green-700 font-medium text-sm">
                        Lihat →
                    </a>
                </div>

                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="font-medium text-gray-900">Transkrip Nilai</span>
                    </div>
                    <a href="{{ Storage::url($pendaftar->documents->transcript_path) }}" target="_blank"
                       class="text-green-600 hover:text-green-700 font-medium text-sm">
                        Lihat →
                    </a>
                </div>

                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="font-medium text-gray-900">Curriculum Vitae</span>
                    </div>
                    <a href="{{ Storage::url($pendaftar->documents->cv_path) }}" target="_blank"
                       class="text-green-600 hover:text-green-700 font-medium text-sm">
                        Lihat →
                    </a>
                </div>

                @if($pendaftar->documents->photo_path)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-blue-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                        </svg>
                        <span class="font-medium text-gray-900">Pas Foto</span>
                    </div>
                    <a href="{{ Storage::url($pendaftar->documents->photo_path) }}" target="_blank"
                       class="text-green-600 hover:text-green-700 font-medium text-sm">
                        Lihat →
                    </a>
                </div>
                @endif

                @if($pendaftar->documents->id_card_path)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-purple-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.715-5.349L11 6.477V16h2a1 1 0 110 2H7a1 1 0 110-2h2V6.477L6.237 7.582l1.715 5.349a1 1 0 01-.285 1.05A3.989 3.989 0 015 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L9 4.323V3a1 1 0 011-1z" clip-rule="evenodd"/>
                        </svg>
                        <span class="font-medium text-gray-900">KTP</span>
                    </div>
                    <a href="{{ Storage::url($pendaftar->documents->id_card_path) }}" target="_blank"
                       class="text-green-600 hover:text-green-700 font-medium text-sm">
                        Lihat →
                    </a>
                </div>
                @endif
            </div>
        </div>
        @endif
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Status Card -->
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Update Status</h3>
            
            <form action="{{ route('admin.pendaftars.update-status', $pendaftar) }}" method="POST">
                @csrf
                @method('PATCH')
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status Pendaftar</label>
                    <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        <option value="pending" {{ $pendaftar->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="reviewed" {{ $pendaftar->status === 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                        <option value="accepted" {{ $pendaftar->status === 'accepted' ? 'selected' : '' }}>Diterima</option>
                        <option value="rejected" {{ $pendaftar->status === 'rejected' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Catatan (Opsional)</label>
                    <textarea name="notes" rows="4" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                        placeholder="Tambahkan catatan untuk pendaftar...">{{ $pendaftar->notes }}</textarea>
                </div>

                <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-lg font-medium hover:bg-green-700 transition">
                    Update Status
                </button>
            </form>
        </div>

        <!-- Info Card -->
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi</h3>
            <div class="space-y-3 text-sm">
                <div>
                    <label class="text-gray-600">Status Saat Ini</label>
                    @if($pendaftar->status === 'pending')
                        <p class="font-medium text-yellow-600">Menunggu Review</p>
                    @elseif($pendaftar->status === 'reviewed')
                        <p class="font-medium text-blue-600">Sedang Diproses</p>
                    @elseif($pendaftar->status === 'accepted')
                        <p class="font-medium text-green-600">Diterima</p>
                    @else
                        <p class="font-medium text-red-600">Ditolak</p>
                    @endif
                </div>
                <div>
                    <label class="text-gray-600">Tanggal Pendaftaran</label>
                    <p class="font-medium text-gray-900">{{ $pendaftar->created_at->format('d F Y, H:i') }}</p>
                </div>
                <div>
                    <label class="text-gray-600">Terakhir Diupdate</label>
                    <p class="font-medium text-gray-900">{{ $pendaftar->updated_at->format('d F Y, H:i') }}</p>
                </div>
            </div>
        </div>

        <!-- Delete Card -->
        <div class="bg-white rounded-xl border border-red-200 p-6">
            <h3 class="text-lg font-semibold text-red-600 mb-2">Hapus Pendaftar</h3>
            <p class="text-sm text-gray-600 mb-4">Tindakan ini tidak dapat dibatalkan. Semua data dan dokumen akan dihapus permanen.</p>
            
            <form action="{{ route('admin.pendaftars.destroy', $pendaftar) }}" method="POST" 
                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus pendaftar ini? Tindakan ini tidak dapat dibatalkan.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full bg-red-600 text-white py-2 rounded-lg font-medium hover:bg-red-700 transition">
                    Hapus Pendaftar
                </button>
            </form>
        </div>
    </div>
</div>
@endsection