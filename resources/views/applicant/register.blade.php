@extends('layouts.app')

@section('title', 'Formulir Pendaftaran - RastekInternship')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Formulir Pendaftaran</h1>
            <p class="text-gray-600">Lengkapi data diri dan upload dokumen yang diperlukan</p>
        </div>

        <!-- Form -->
        <form action="{{ route('applicant.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Data Pribadi Section -->
            <div class="border-b border-gray-200 pb-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Data Pribadi</h2>
                
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="full_name" value="{{ old('full_name') }}" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('full_name') border-red-500 @enderror"
                            required>
                        @error('full_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('email') border-red-500 @enderror"
                            required>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nomor Telepon <span class="text-red-500">*</span>
                        </label>
                        <input type="tel" name="phone" value="{{ old('phone') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('phone') border-red-500 @enderror"
                            required>
                        @error('phone')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Jenis Kelamin <span class="text-red-500">*</span>
                        </label>
                        <select name="gender" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('gender') border-red-500 @enderror"
                            required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('gender')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Tempat Lahir <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="birth_place" value="{{ old('birth_place') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('birth_place') border-red-500 @enderror"
                            required>
                        @error('birth_place')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Lahir <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="birth_date" value="{{ old('birth_date') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('birth_date') border-red-500 @enderror"
                            required>
                        @error('birth_date')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Alamat Lengkap <span class="text-red-500">*</span>
                        </label>
                        <textarea name="address" rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('address') border-red-500 @enderror"
                            required>{{ old('address') }}</textarea>
                        @error('address')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Data Pendidikan Section -->
            <div class="border-b border-gray-200 pb-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Data Pendidikan</h2>
                
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Jenjang Pendidikan <span class="text-red-500">*</span>
                        </label>
                        <select name="education_level" id="education_level"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('education_level') border-red-500 @enderror"
                            required onchange="updateGPALabel()">
                            <option value="">Pilih Jenjang</option>
                            <option value="SMK" {{ old('education_level') == 'SMK' ? 'selected' : '' }}>SMK</option>
                            <option value="D3" {{ old('education_level') == 'D3' ? 'selected' : '' }}>D3</option>
                            <option value="S1" {{ old('education_level') == 'S1' ? 'selected' : '' }}>S1</option>
                            <option value="S2" {{ old('education_level') == 'S2' ? 'selected' : '' }}>S2</option>
                        </select>
                        @error('education_level')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Institusi <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="institution" value="{{ old('institution') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('institution') border-red-500 @enderror"
                            required>
                        @error('institution')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2" id="gpa_label">
                            IPK / Rata-rata Nilai <span class="text-red-500">*</span>
                        </label>
                        <input type="number" step="0.01" name="gpa_average" value="{{ old('gpa_average') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('gpa_average') border-red-500 @enderror"
                            required min="0" max="4">
                        <p class="text-xs text-gray-500 mt-1" id="gpa_hint">
                            SMK: Min 75 | Perguruan Tinggi: Min 3.00
                        </p>
                        @error('gpa_average')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Upload Dokumen Section -->
            <div class="border-b border-gray-200 pb-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Upload Dokumen</h2>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Surat Pengantar Instansi <span class="text-red-500">*</span>
                        </label>
                        <input type="file" name="cover_letter" accept=".pdf"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('cover_letter') border-red-500 @enderror"
                            required>
                        <p class="text-xs text-gray-500 mt-1">Format: PDF, Maksimal 2MB</p>
                        @error('cover_letter')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Transkrip Nilai <span class="text-red-500">*</span>
                        </label>
                        <input type="file" name="transcript" accept=".pdf"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('transcript') border-red-500 @enderror"
                            required>
                        <p class="text-xs text-gray-500 mt-1">Format: PDF, Maksimal 2MB</p>
                        @error('transcript')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Curriculum Vitae (CV) <span class="text-red-500">*</span>
                        </label>
                        <input type="file" name="cv" accept=".pdf"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('cv') border-red-500 @enderror"
                            required>
                        <p class="text-xs text-gray-500 mt-1">Format: PDF, Maksimal 2MB</p>
                        @error('cv')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Pas Foto (Opsional)
                        </label>
                        <input type="file" name="photo" accept="image/jpeg,image/png,image/jpg"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('photo') border-red-500 @enderror">
                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, Maksimal 1MB</p>
                        @error('photo')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            KTP (Opsional)
                        </label>
                        <input type="file" name="id_card" accept=".pdf,image/jpeg,image/png,image/jpg"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('id_card') border-red-500 @enderror">
                        <p class="text-xs text-gray-500 mt-1">Format: PDF, JPG, PNG, Maksimal 1MB</p>
                        @error('id_card')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end gap-4">
                <a href="{{ route('home') }}" class="px-6 py-3 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-3 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition">
                    Kirim Pendaftaran
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function updateGPALabel() {
    const eduLevel = document.getElementById('education_level').value;
    const gpaLabel = document.getElementById('gpa_label');
    const gpaHint = document.getElementById('gpa_hint');
    
    if (eduLevel === 'SMK') {
        gpaLabel.innerHTML = 'Rata-rata Rapor <span class="text-red-500">*</span>';
        gpaHint.textContent = 'Minimal 75 (skala 100)';
    } else if (['D3', 'S1', 'S2'].includes(eduLevel)) {
        gpaLabel.innerHTML = 'IPK (Indeks Prestasi Kumulatif) <span class="text-red-500">*</span>';
        gpaHint.textContent = 'Minimal 3.00 (skala 4.00)';
    }
}
</script>
@endsection