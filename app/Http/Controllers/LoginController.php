<?php

namespace App\Http\Controllers;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
// use Illuminate\Database\Eloquent\Model\users;
use Illuminate\Http\Request;
use App\Models\dt_products;
use App\Models\users;
use Illuminate\Support\Facades\Hash;
use Auth;



class LoginController extends Controller
{
    public function index(){
        return view('login');
    }
    public function handleLogin(request $request){
       $data =[$request->email,$request->pass];
       $checkEmail=users::where('email',$request->email)->get();
       $pass=$checkEmail[0]['password'];


    //    echo $checkEmail[0]['password'];


       if($request){
           if(isset($checkEmail[0]['email'])){
            if(Hash::check($request->pass, $pass)){
                return redirect()->to('/');
            }else{
               echo "<script>alert('password khong dung!')</script>";
               return redirect()->back();
           }

           }else{
               return redirect()->back();
           }
       }else{
           return redirect()->back();
       }

    }
    public function authLogin(request $request){
        $this->validate($request, [
            'email'=> 'required|max:32',
            'password'=> 'required|max:32|min:6',
          ]);

            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                if(Auth::user()->admin==1)
                {
                    return redirect()->to('/admin');
                }else {

                    return redirect()->to('/');
                }
            }else{
                echo "<script>alert('dang nhap that bai! ')</script>";
                return redirect()->to('/login');
            }
    }
    public function logout(){
        Auth::logout();
        return redirect()->back();
    }

}
