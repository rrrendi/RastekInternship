<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use App\Models\Announcement;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_applicants' => Applicant::count(),
            'pending' => Applicant::where('status', 'pending')->count(),
            'reviewed' => Applicant::where('status', 'reviewed')->count(),
            'accepted' => Applicant::where('status', 'accepted')->count(),
            'rejected' => Applicant::where('status', 'rejected')->count(),
        ];

        $recent_applicants = Applicant::orderBy('created_at', 'desc')->take(10)->get();
        $active_announcements = Announcement::where('is_active', true)->count();

        return view('admin.dashboard', compact('stats', 'recent_applicants', 'active_announcements'));
    }
}