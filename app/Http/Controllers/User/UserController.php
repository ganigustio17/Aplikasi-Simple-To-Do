<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    function login()
    {
       return view('user.login');
    }
    function doLogin(Request $request)
    {

      $request->validate([
        'email' => 'required|email:refc,dns',
        'password' => 'required|min:8|max:20',
      ],[
        'email.required' => 'Email wajib di isi',
        'email.email' => 'Format mail tidak valid',
        'password.required' => 'Password wajib di isi',
        'password.min' => 'Password minimal 8 karakter',
        'password.max' => 'Password maksimal 20 karakter',
      ]);

      $data = [
        'email' => $request->email,
        'password' => $request->password,
      ];

      $use = ['email' => $request->email];

      $user = User::where($use)->first();
      
      if(Auth::attempt($data)){
        if(Auth::user()->email_verified_at == ''){
          Auth::logout();
          return redirect()->route('login')->withErrors(['email' => 'Email belum terverifikasi, silahkan cek email anda kembali!'])->withInput();
        }else{
        return redirect()->route('todo');
        }
      }elseif(!$user)
      {
        return redirect()->route('login')->withErrors(['email' => 'Email Tidak Terdaftar'])->withInput();
      }else{
        return redirect()->route('login')->withErrors(['password' => 'Password Salah'])->withInput();
      }

    }
    function register()
    {
        return view('user.register');
    }
    function doRegister(Request $request)
    {
        $request->validate([
            'email' => 'required|email:rfc,dns|max:100|unique:users,email',
            'name' => 'required|min:3|max:25',
            'password' => '|required|min:6|max:20',
            'password_confirmation' => 'required|same:password',
           ],[
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.max' => 'Email tidak boleh melebihi 100 karakter',
            'email.unique' => 'Email sudah digunakan oleh pengguna lain',
            'name.required' => 'Nama wajib diisi',
            'name.min' => 'Nama minimal 3 karakter',
            'name.max' => 'Nama maksimal 25 karakter',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.max' => 'Password maksimal 20 karakter',
            'password_confirmation.required' => 'Konfirmasi password wajib diisi',
            'password_confirmation.same' => 'Konfirmasi password tidak sesuai',
           ]);

           $user = new User;
           $user->email = $request->email;
           $user->name = $request->name;
           $user->password = bcrypt($request->password);
           $user->save();

           $cekToken = UserVerify::where('email',  $request->input('email'))->first();

           if($cekToken){
            UserVerify::where('email',  $request->input('email'))->delete();
           }
          
           $token = Str::uuid();
           
           $data = [
            'email' => $request -> input('email'),
            'token' => $token,
           ];

           UserVerify::create($data);

           Mail::send('user.email-verification', ['token' => $token], function($message) use ($request){
            $message->to($request->input('email'));
            $message->subject('Email verification');
           });

           

           if($user){
            return redirect()->route('register')->with('success','Email verifikasi telah dikirimkan, silahkan cek terlebih dahulu!')->withInput();
           }

    }
    function updateData()
    {
        return view('user.update-data');
    }
    function doUpdateData(Request $request)
    {
       $request->validate([
        'name' => 'required|min:3|max:25',
        'password' => 'nullable|string|min:6',
        'password_confirmation' => 'required_with:password|nullable|string|same:password',
       ],[
        'name.required' => 'Nama wajib diisi',
        'name.min' => 'Nama minimal 3 karakter',
        'name.max' => 'Nama maksimal 25 karakter',
        'password.min' => 'Password minimal 6 karakter',
        'password_confirmation.required_with' => 'Konfirmasi password wajib diisi',
        'password_confirmation.same' => 'Konfirmasi password tidak sesuai',
       ]);

       $data = [
        'name' => $request->name,
        'password' => $request->input('password')?bcrypt($request->input('password')):Auth::user()->password,
       ];

       User::where('id', Auth::user()->id)->update($data);

       return redirect()->route('user.update-data')->with('success', 'Data berhasil di update!'); 

       
    }
    function logout()
    {
      Auth::logout();

      return redirect('/user/login');
    }

    function verifyAccount($token)
    {
      $checkuser = UserVerify::where('token', $token)->first();

      if(!is_null($checkuser)){
        $email = $checkuser->email;
         
        $datauser = User::where('email', $email)->first();

        if($datauser->email_verified_at){
               $message = 'Akun anda sudah terverfikasi sebelumnya';
        }else{
          $data = [
            'email_verified_at' => Carbon::now()
          ];

          User::where('email', $email)->update($data);
          Userverify::where('email', $email)->delete($data);
          $message = 'Akun anda sudah terverifikasi , silahkan login!';
        }
        return redirect()->route('login')->with('success', $message);
      }else{
      return redirect()->route('login')->with('success', 'Link token telah kadaluwarsa');
      }
    }
}
