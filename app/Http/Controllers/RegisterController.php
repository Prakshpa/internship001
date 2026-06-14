<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use PharIo\Manifest\Email;

class RegisterController extends Controller{
    public function __invoke(Request $request):RedirectResponse
    {
        $userData=$request->validate([
            "fname"=>['required','string','max:20','min:2'],
            "mname"=>['nullable',"string","max:50"],
            "lname"=>["required","string","max:20"],
            "dob"=>["required","date"],
            "phone"=>["required","int","min:9700000000","max:9900000000"],
            "address"=>['required','string','max:255','min:3'],
            "gender"=>['required','string','max:10'],
            "email"=>['required','email','max:100','min:10'],
            "password"=>['required','string','min:8','regex:/^[a-zA-Z0-9_ !@#\$%\^\&\*.,\?]+$/'],
            "confirm"=>"required|string|min:8|regex:/^[a-zA-Z0-9_ !@#\$%\^\&\*.,\?]+$/"
        ]);
        if($userData['password'] != $userData['confirm']) throw ValidationException::withMessages(['confirm'=>"Passwords didnot match"]);
        $full_name=trim($userData['fname']).' '.trim($userData['mname']).' '.trim($userData['lname']);
        if(trim($userData['mname'])=="") $full_name=trim($userData['fname']).' '.$userData['lname'];
        try {
            //code...
            $user=User::create([
                "Full Name"=>$full_name,
                "Date of Birth"=>$userData['dob'],
                "Gender"=>$userData['gender'],
                "Mobile No"=>$userData['phone'],
                "Address"=>$userData['address'],
                "Email"=>$userData['email'],
                "password"=>bcrypt($userData['password'])
            ]);
            Auth::login($user,true);
            return redirect()->intended('dashboard');
        } catch (\Throwable $th) {
            if(strpos($th->getMessage(),"Duplicate")) {
                return back()->withErrors([
                    'email'=>"Email address already registered"
                ]);
            }else return back()->withErrors(['error'=>$th->getMessage()]);
        }
    }
}