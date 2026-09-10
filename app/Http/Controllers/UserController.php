<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('company')->latest()->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,petugas,company',
            'company_id' => 'required_if:role,company|nullable|exists:companies,id',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        
        if ($validated['role'] !== 'company') {
            $validated['company_id'] = null;
        }

        User::create($validated);
        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
    }

    public function edit(User $user)
    {
        return view('admin.users.form', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:6',
            'role' => 'required|in:admin,petugas,company',
            'company_id' => 'required_if:role,company|nullable|exists:companies,id',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        if ($validated['role'] !== 'company') {
            $validated['company_id'] = null;
        }

        $user->update($validated);
        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak dapat menghapus akun sendiri');
        }
        
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus');
    }
}
