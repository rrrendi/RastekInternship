<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\pendaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Exports\PendaftarExport;
use Maatwebsite\Excel\Facades\Excel;

class pendaftarManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = pendaftar::with('documents');

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('full_name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $pendaftars = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.pendaftars.index', compact('pendaftars'));
    }

    public function show(pendaftar $pendaftar)
    {
        $pendaftar->load('documents');
        return view('admin.pendaftars.show', compact('pendaftar'));
    }

    public function updateStatus(Request $request, pendaftar $pendaftar)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,reviewed,accepted,rejected',
            'notes' => 'nullable|string',
        ]);

        $pendaftar->update($validated);

        return back()->with('success', 'Status pendaftar berhasil diperbarui.');
    }

    public function destroy(pendaftar $pendaftar)
    {
        if ($pendaftar->documents) {
            Storage::disk('public')->delete([
                $pendaftar->documents->cover_letter_path,
                $pendaftar->documents->transcript_path,
                $pendaftar->documents->cv_path,
                $pendaftar->documents->photo_path,
                $pendaftar->documents->id_card_path,
            ]);
        }

        $pendaftar->delete();

        return redirect()->route('admin.pendaftars.index')->with('success', 'Data pendaftar berhasil dihapus.');
    }

    public function export(Request $request)
    {
        $query = pendaftar::query();

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('full_name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $pendaftars = $query->orderBy('created_at', 'desc')->get();
        $filename = "rekap_data_pendaftar_" . date('Y-m-d_H-i-s') . ".xlsx";

        return Excel::download(new PendaftarExport($pendaftars), $filename);
    }
}