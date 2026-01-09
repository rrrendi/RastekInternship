@extends('layouts.app')

@section('title', 'Status Pendaftaran')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
        <!-- Status Badge -->
        <div class="text-center mb-8">
            @if($pendaftar->status === 'pending')
                <div class="w-20 h-20 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span class="inline-block px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full font-semibold mb-2">
                    Menunggu Review
                </span>
            @elseif($pendaftar->status === 'reviewed')
                <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span class="inline-block px-4 py-2 bg-blue-100 text-blue-800 rounded-full font-semibold mb-2">
                    Sedang Diproses
                </span>
            @elseif($pendaftar->status === 'accepted')
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span class="inline-block px-4 py-2 bg-green-100 text-green-800 rounded-full font-semibold mb-2">
                    Diterima
                </span>
            @else
                <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </div>
                <span class="inline-block px-4 py-2 bg-red-100 text-red-800 rounded-full font-semibold mb-2">
                    Tidak Lolos Seleksi
                </span>
            @endif
            
            <h1 class="text-3xl font-bold text-gray-900 mt-4">Status Pendaftaran Anda</h1>
        </div>

        <!-- pendaftar Info -->
        <div class="bg-gray-50 rounded-xl p-6 mb-6">
            <h2 class="font-semibold text-gray-900 mb-4">Informasi Pendaftar</h2>
            <div class="grid md:grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-gray-600">Nama Lengkap</p>
                    <p class="font-medium text-gray-900">{{ $pendaftar->full_name }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Email</p>
                    <p class="font-medium text-gray-900">{{ $pendaftar->email }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Nomor Telepon</p>
                    <p class="font-medium text-gray-900">{{ $pendaftar->phone }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Jenjang Pendidikan</p>
                    <p class="font-medium text-gray-900">{{ $pendaftar->education_level }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Institusi</p>
                    <p class="font-medium text-gray-900">{{ $pendaftar->institution }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Tanggal Daftar</p>
                    <p class="font-medium text-gray-900">{{ $pendaftar->created_at->format('d F Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Status Message -->
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 mb-6">
            <h3 class="font-semibold text-blue-900 mb-2">Informasi Status</h3>
            @if($pendaftar->status === 'pending')
                <p class="text-blue-800">
                    Pendaftaran Anda telah diterima dan sedang menunggu untuk direview oleh tim kami. 
                    Mohon menunggu pemberitahuan lebih lanjut melalui email.
                </p>
            @elseif($pendaftar->status === 'reviewed')
                <p class="text-blue-800">
                    Dokumen Anda sedang dalam proses review oleh tim kami. 
                    Kami akan menghubungi Anda segera setelah proses review selesai.
                </p>
            @elseif($pendaftar->status === 'accepted')
                <p class="text-green-800">
                    Selamat! Anda telah lolos seleksi. Tim kami akan segera menghubungi Anda melalui email 
                    untuk informasi tahap selanjutnya.
                </p>
            @else
                <p class="text-red-800">
                    Terima kasih atas minat Anda untuk bergabung dengan RastekInternship. 
                    Mohon maaf, saat ini Anda belum lolos seleksi. Kami mengapresiasi usaha Anda dan 
                    semoga ada kesempatan di masa mendatang.
                </p>
            @endif
        </div>

        <!-- Admin Notes -->
        @if($pendaftar->notes)
        <div class="bg-gray-50 rounded-xl p-6 mb-6">
            <h3 class="font-semibold text-gray-900 mb-2">Catatan dari Admin</h3>
            <p class="text-gray-700 whitespace-pre-line">{{ $pendaftar->notes }}</p>
        </div>
        @endif

        <!-- Actions -->
        <div class="flex justify-center gap-4">
            <a href="{{ route('pendaftar.check-status') }}" class="px-6 py-3 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition">
                Cek Email Lain
            </a>
            <a href="{{ route('home') }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection