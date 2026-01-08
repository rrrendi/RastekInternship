<?php
namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicantController extends Controller
{
    public function create()
    {
        return view('applicant.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:applicants,email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'education_level' => 'required|in:SMK,D3,S1,S2',
            'institution' => 'required|string|max:255',
            'gpa_average' => 'required|numeric|min:0|max:4',
            'birth_date' => 'required|date',
            'birth_place' => 'required|string|max:255',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'cover_letter' => 'required|file|mimes:pdf|max:2048',
            'transcript' => 'required|file|mimes:pdf|max:2048',
            'cv' => 'required|file|mimes:pdf|max:2048',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'id_card' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:1024',
        ]);

        // Validasi khusus untuk rata-rata nilai
        if ($validated['education_level'] === 'SMK' && $validated['gpa_average'] < 75) {
            return back()->withErrors(['gpa_average' => 'Rata-rata rapor SMK minimal 75'])->withInput();
        }
        
        if (in_array($validated['education_level'], ['D3', 'S1', 'S2']) && $validated['gpa_average'] < 3.00) {
            return back()->withErrors(['gpa_average' => 'IPK minimal 3.00'])->withInput();
        }

        // Simpan data pendaftar
        $applicant = Applicant::create($validated);

        // Upload dokumen
        $documents = [
            'cover_letter_path' => $request->file('cover_letter')->store('documents/cover_letters', 'public'),
            'transcript_path' => $request->file('transcript')->store('documents/transcripts', 'public'),
            'cv_path' => $request->file('cv')->store('documents/cvs', 'public'),
        ];

        if ($request->hasFile('photo')) {
            $documents['photo_path'] = $request->file('photo')->store('documents/photos', 'public');
        }

        if ($request->hasFile('id_card')) {
            $documents['id_card_path'] = $request->file('id_card')->store('documents/id_cards', 'public');
        }

        $applicant->documents()->create($documents);

        return redirect()->route('home')->with('success', 'Pendaftaran berhasil! Kami akan menghubungi Anda segera.');
    }

    public function checkStatus(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $applicant = Applicant::where('email', $request->email)->first();

        if (!$applicant) {
            return back()->with('error', 'Email tidak ditemukan dalam database pendaftar.');
        }

        return view('applicant.status', compact('applicant'));
    }
}