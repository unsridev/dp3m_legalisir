<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function create(Request $request): View|RedirectResponse
    {
        return $request->user()?->can('kelola-legalisir')
            ? to_route('admin.pengajuan.index')
            : view('admin.login');
    }

    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials + ['is_admin' => true])) {
            throw ValidationException::withMessages(['email' => 'Email atau kata sandi admin tidak sesuai.']);
        }

        $request->session()->regenerate();

        return redirect()->intended(route('admin.pengajuan.index'));
    }

    public function confirmLogout(Request $request): View|RedirectResponse
    {
        return $request->user()?->can('kelola-legalisir')
            ? view('admin.logout')
            : to_route('login');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('login', status: 303);
    }
}
