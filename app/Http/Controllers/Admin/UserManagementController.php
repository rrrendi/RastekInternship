<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserManagementController extends Controller
{
    /**
     * Display a listing of admin users
     */
    public function index(): View
    {
        $users = User::where('role', 'admin')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new admin
     */
    public function create(): View
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created admin in storage
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'admin',
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Admin baru berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified admin
     */
    public function edit(User $user): View
    {
        if ($user->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified admin in storage
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        if ($user->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $dataToUpdate = [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ];

        if ($request->filled('password')) {
            $dataToUpdate['password'] = Hash::make($validated['password']);
        }

        $user->update($dataToUpdate);

        return redirect()->route('admin.users.index')
            ->with('success', 'Data admin berhasil diperbarui.');
    }

    /**
     * Remove the specified admin from storage
     */
    public function destroy(User $user): RedirectResponse
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        if ($user->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Admin berhasil dihapus.');
    }

    /**
     * Show the change password form
     */
    public function showChangePassword(): View
    {
        return view('admin.users.change-password');
    }

    /**
     * Change password for the currently authenticated admin
     */
    public function changePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Fix: Gunakan update() untuk menghindari warning IDE
        User::where('id', Auth::id())->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Password berhasil diubah.');
    }
}