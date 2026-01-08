@extends('layouts.app')

@section('title', 'Beranda - RastekInternship Recruitment')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-green-500 to-blue-600 rounded-2xl p-8 md:p-12 mb-8 text-white">
        <div class="max-w-3xl">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Bergabunglah Bersama RastekInternship</h1>
            <p class="text-lg md:text-xl mb-6 text-green-50">
                Kami membuka kesempatan bagi talenta terbaik untuk berkontribusi dalam pengembangan industri farmasi Indonesia.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('applicant.register') }}" class="bg-white text-green-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                    Daftar Sekarang
                </a>
                <a href="{{ route('applicant.check-status') }}" class="bg-green-700 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-800 transition">
                    Cek Status Pendaftaran
                </a>
            </div>
        </div>
    </div>

    <!-- Info Cards -->
    <div class="grid md:grid-cols-3 gap-6 mb-12">
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Pendaftaran Mudah</h3>
            <p class="text-gray-600">Proses pendaftaran online yang simpel dan cepat tanpa perlu login.</p>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Proses Transparan</h3>
            <p class="text-gray-600">Cek status pendaftaran Anda kapan saja dengan mudah.</p>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Respon Cepat</h3>
            <p class="text-gray-600">Tim kami akan segera memproses dan merespon pendaftaran Anda.</p>
        </div>
    </div>

    <!-- Pengumuman Section -->
    @if($announcements->count() > 0)
    <div class="mb-12">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Pengumuman Terbaru</h2>
        </div>

        <div class="space-y-4">
            @foreach($announcements as $announcement)
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition">
                <div class="flex items-start justify-between mb-2">
                    <div class="flex items-center gap-2">
                        @if($announcement->type === 'acceptance')
                        <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">
                            Penerimaan
                        </span>
                        @elseif($announcement->type === 'rejection')
                        <span class="px-3 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-full">
                            Informasi
                        </span>
                        @else
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">
                            Umum
                        </span>
                        @endif
                    </div>
                    <span class="text-sm text-gray-500">
                        {{ $announcement->published_at ? $announcement->published_at->diffForHumans() : $announcement->created_at->diffForHumans() }}
                    </span>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">
                    {{ $announcement->title }}
                </h3>

                <div class="text-gray-700 whitespace-pre-line">
                    {{ Str::limit($announcement->content, 300) }}
                </div>

                @if(strlen($announcement->content) > 300)
                <button
                    class="text-green-600 hover:text-green-700 font-medium mt-2"
                    onclick="showFullAnnouncement(this)"
                    data-content="@json($announcement->content)">
                    Baca Selengkapnya →
                </button>
                @endif

            </div>

            @if(strlen($announcement->content) > 300)
            <script>
                function showFullAnnouncement(button) {
                    alert(button.dataset.content);
                }
            </script>

            @endif
            @endforeach
        </div>
    </div>
    @endif

    <!-- Persyaratan Section -->
    <div class="bg-white rounded-xl p-8 shadow-sm border border-gray-100">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Persyaratan Pendaftaran</h2>

        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <h3 class="font-semibold text-gray-900 mb-3">Dokumen yang Dibutuhkan:</h3>
                <ul class="space-y-2 text-gray-700">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        Surat Pengantar dari Instansi Pendidikan
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        Transkrip Nilai (Format PDF)
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        Curriculum Vitae (CV)
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        Pas Foto & KTP (Opsional)
                    </li>
                </ul>
            </div>

            <div>
                <h3 class="font-semibold text-gray-900 mb-3">Ketentuan Nilai:</h3>
                <ul class="space-y-2 text-gray-700">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-blue-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                        SMK: Minimal rata-rata rapor 75
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-blue-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                        Perguruan Tinggi: Minimal IPK 3.00
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-blue-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                        Semua dokumen dalam format PDF
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-blue-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                        Maksimal ukuran file 2MB per dokumen
                    </li>
                </ul>
            </div>
        </div>

        <div class="mt-8 text-center">
            <a href="{{ route('applicant.register') }}" class="inline-block bg-green-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-green-700 transition">
                Mulai Pendaftaran
            </a>
        </div>
    </div>
</div>
@endsection