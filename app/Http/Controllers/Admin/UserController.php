<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserLog;
use App\Helpers\UserLogHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $adminSearch = $request->admin_search;
        $userSearch  = $request->user_search;

        $admins = User::where('role', 'admin')
            ->when($adminSearch, function ($query) use ($adminSearch) {
                $query->where(function ($q) use ($adminSearch) {
                    $q->where('name', 'like', "%{$adminSearch}%")
                        ->orWhere('email', 'like', "%{$adminSearch}%")
                        ->orWhere('phone', 'like', "%{$adminSearch}%");
                });
            })
            ->latest()
            ->paginate(5, ['*'], 'admin_page')
            ->appends([
                'admin_search' => $adminSearch,
                'user_search' => $userSearch,
            ]);

        $users = User::where('role', 'user')
            ->when($userSearch, function ($query) use ($userSearch) {
                $query->where(function ($q) use ($userSearch) {
                    $q->where('name', 'like', "%{$userSearch}%")
                        ->orWhere('email', 'like', "%{$userSearch}%")
                        ->orWhere('phone', 'like', "%{$userSearch}%");
                });
            })
            ->latest()
            ->paginate(10, ['*'], 'user_page')
            ->appends([
                'admin_search' => $adminSearch,
                'user_search' => $userSearch,
            ]);

        $totalAdmin = User::where('role', 'admin')->count();
        $totalUser  = User::where('role', 'user')->count();

        $userBaru = User::where('role', 'user')
            ->whereMonth('created_at', now()->month)
            ->count();

        $totalOnline = User::where('last_seen', '>=', now()->subMinutes(2))
            ->count();

        $logs = UserLog::with('user')
            ->where('created_at', '>=', now()->subMinutes(10))
            ->latest()
            ->get();

        return view('admin.pengguna.index', compact(
            'admins',
            'users',
            'totalAdmin',
            'totalUser',
            'totalOnline',
            'userBaru',
            'adminSearch',
            'userSearch'
        ));
    }

    public function create()
    {
        return view('admin.pengguna.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|max:20',
            'address' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            'password' => 'required|min:8|confirmed',
        ]);

        $foto = null;

        if ($request->hasFile('foto')) {

            $foto = $request->file('foto')
                ->store('profile', 'public');
        }

        User::create([

            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'foto' => $foto,
            'role' => 'admin',
            'password' => Hash::make($request->password),

        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'Admin berhasil ditambahkan.');
    }

    public function show(User $user)
    {
        $logs = $user->logs()
            ->latest()
            ->take(15)
            ->get();

        return view(
            'admin.pengguna.show',
            compact(
                'user',
                'logs'
            )
        );
    }

    public function edit(User $user)
    {
        //
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        // Tidak boleh menghapus akun sendiri
        if ($user->id == auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        // Tidak boleh menghapus akun yang sedang online
        if ($user->online_status == 'online') {
            return back()->with('error', 'Pengguna sedang online dan tidak dapat dihapus.');
        }

        // Hapus foto jika ada
        if ($user->foto && \Storage::disk('public')->exists($user->foto)) {
            \Storage::disk('public')->delete($user->foto);
        }

        $user->delete();

        return back()->with('success', 'Pengguna berhasil dihapus.');
    }
}
