<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

     protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'name'; // Use 'name' as the username field
    }

    protected function attemptLogin(Request $request)
    {
        $credentials = $request->only('name', 'password');

        // Log entered credentials for debugging
        \Log::info('Attempting login with credentials:', $credentials);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended($this->redirectPath());
        }

        return $this->sendFailedLoginResponse($request);
    }


    


    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect()->back()
            ->withInput($request->only('name', 'remember'))
            ->withErrors([
                'name' => 'These credentials do not match our records.',
            ]);
    }

    protected function authenticated(Request $request, $user)
{
    // Check if the user is not null and has a role
    if ($user && $user->role == 'admin') {
        return redirect('/admin/home');
    } elseif ($user && $user->role == 'cadre') {
        return redirect('/cadre/home');
    }
    elseif ($user && $user->role == 'chef') {
        return redirect('/chef/home');
    }
    elseif ($user && $user->role == 'sg') {
        return redirect('/sg/home');
    }
    else {
        // Handle other roles or no role specified
        return redirect('/');
    }


}

}
