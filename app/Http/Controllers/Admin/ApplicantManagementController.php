<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicantManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = Applicant::with('documents');

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('full_name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $applicants = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.applicants.index', compact('applicants'));
    }

    public function show(Applicant $applicant)
    {
        $applicant->load('documents');
        return view('admin.applicants.show', compact('applicant'));
    }

    public function updateStatus(Request $request, Applicant $applicant)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,reviewed,accepted,rejected',
            'notes' => 'nullable|string',
        ]);

        $applicant->update($validated);

        return back()->with('success', 'Status pendaftar berhasil diperbarui.');
    }

    public function destroy(Applicant $applicant)
    {
        // Hapus dokumen dari storage
        if ($applicant->documents) {
            Storage::disk('public')->delete([
                $applicant->documents->cover_letter_path,
                $applicant->documents->transcript_path,
                $applicant->documents->cv_path,
                $applicant->documents->photo_path,
                $applicant->documents->id_card_path,
            ]);
        }

        $applicant->delete();

        return redirect()->route('admin.applicants.index')->with('success', 'Data pendaftar berhasil dihapus.');
    }
}