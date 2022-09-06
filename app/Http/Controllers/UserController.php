<?php

namespace App\Http\Controllers;

use App\Models\User;
use Nette\Utils\Random;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $user ;

    public function __construct(User $user)
    {
        $this->user =$user ;
    }

    public function store(Request $request){
      $request->validate([
        'name'=>'required',
        'email'=>'required|email|unique:users,email',
        'password'=>'required|confirmed'
      ]);
      $user = $this->user->create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>bcrypt($request->password),
        'api_token'=>bcrypt(Str::random(20)),
      ]);
      if($user){
        // Auth::loginUsingId($user->id);
        // return redirect('/home');

        return redirect('login')
        ->with(['success'=>'register is done .. you can login']);
      }
      return redirect()->back()->withErrors('error happend when insert user');
    }


    
    public function auth(Request $request){
        $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
        ]);

        if (Auth::attempt([
            'email'=>$request->email,
            'password'=>$request->password
            ])) {

            return redirect('home');


            dd($request);

            // return redirect('home');

        }

            return redirect()->back()->withErrors("error email or password");

    
        }
    

    
    public function login(){
       return view('auth.login');
    }

    public function register(){
        return view('auth.register');

    }

    public function home(){
      $users = $this->user->where('id',"!=",auth()->id())->get();
        return view ('chat',compact(['users']));
    }
}
