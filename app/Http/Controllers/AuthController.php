<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Display login page.
     * 
     * @return Renderable
     */
    public function login()
    {
        $user = Auth::user();
        if ($user != null) {
            return $this->redirect($user->role);
        }

        return view('auth.login');
    }

    /**
     * Handle account login request
     * 
     * @param LoginRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function authenticate(LoginRequest $request)
    {
        $creds = $request->validated();

        if (!Auth::attempt($creds)) {
            return redirect()->back()->withErrors([
                'password' => 'Kata sandi salah',
            ])->onlyInput('username');
        }

        $user = Auth::getProvider()->retrieveByCredentials($creds);
        Auth::login($user);

        return $this->redirect($user->role);
    }

    /**
     * Log out account user.
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Session::flush();

        Auth::logout();

        return redirect('login');
    }

    /**
     * Redirect user by role.
     *
     * @return \Illuminate\Routing\Redirector
     */
    private function redirect($role)
    {
        switch ($role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'mahasiswa':
                return redirect()->route('mahasiswa.dashboard');
            default:
                return redirect()->back();
        }
    }
}
