<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BackendAuthenticationController extends Controller
{
    /**
     * Display view contains login for admin
     */
    public function index()
    {
        //
        return view('backend.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(LoginRequest $request)
    {
        $email = $request->email;
        $password = $request->password;
        $remember = $request->remember;

        $permission = DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->select('roles.name', 'users.password')
            ->where([
                ['users.email', $email],
                ['roles.name', 'admin']
            ])
            ->first();

        if ($permission && Hash::check($password, $permission->password)) {
            // redict login success, add session
            Auth::attempt(['email' => $email, 'password' => $password], $remember);
            $request->session()->regenerate();
            return redirect()->route('backend.home');
        }

        return back()->withErrors([
            'email' => 'Tài khoản hoặc mật khẩu không đúng',
        ])->withInput($request->all());
    }

    /**
     * Destroy an authenticated admin session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('backend_auth.index');
    }
}