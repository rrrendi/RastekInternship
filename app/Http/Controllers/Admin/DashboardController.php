<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\pendaftar;
use App\Models\Announcement;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_pendaftars' => pendaftar::count(),
            'pending' => pendaftar::where('status', 'pending')->count(),
            'reviewed' => pendaftar::where('status', 'reviewed')->count(),
            'accepted' => pendaftar::where('status', 'accepted')->count(),
            'rejected' => pendaftar::where('status', 'rejected')->count(),
        ];

        $recent_pendaftars = pendaftar::orderBy('created_at', 'desc')->take(10)->get();
        $active_announcements = Announcement::where('is_active', true)->count();

        return view('admin.dashboard', compact('stats', 'recent_pendaftars', 'active_announcements'));
    }
}