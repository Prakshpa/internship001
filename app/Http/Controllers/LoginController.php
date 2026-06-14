<?php 
namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller{
    public function __invoke(Request $request):RedirectResponse
    {
        $credentials=$request->validate([
            'email'=>['required','email'],
            'password'=>['required','min:8','max:40']
        ]);
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
        return back()->withErrors([
            'error'=>"Invalid email or password"
        ])->onlyInput('email');
    }
}