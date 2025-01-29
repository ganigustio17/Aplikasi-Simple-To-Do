<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    function forgotPasswordForm(){
        return view('user.forgot-password');
    }
    function doForgotPasswordForm(Request $request){
        $request->validate([
            'email'=>'required|email:dns,rfc|exists:users,email'
        ],[
            'email.required'=>'Email harus di isi',
            'email.email'=>'Format email tidak valid',
            'email.exists'=>'Email yang anda masukkan tidak terdaftar'
        ]);


        UserVerify::where('email', $request->input('email'))->delete();
        $token = Str::uuid();

        $data = [
            'email'=>$request->input('email'),
            'token'=>$token
        ];

        UserVerify::create($data);

        Mail::send('user.email-reset-password', ['token' => $token], function($message) use ($request){
            $message->to($request->input('email'));
            $message->subject('Reset Password');
        });

        return redirect()->route('forgotpassword')->with('success', 'Email berisikan instruksi reset password sudah dikirimkan, silahkan cek terlebih dahulu')->withInput();

    }

    function resetPassword($token){
        return view('user.reset-password', compact('token'));
    }
    function doResetPassword(Request $request){
        $request->validate([
            'password' => '|required|min:6|max:20',
            'password_confirmation' => 'required|same:password',
           ],[
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.max' => 'Password maksimal 20 karakter',
            'password_confirmation.required' => 'Konfirmasi password wajib diisi',
            'password_confirmation.same' => 'Konfirmasi password tidak sesuai',
           ]);

           $datauser = UserVerify::where('token', $request->input('token'))->first();

           if(!$datauser){
             return redirect()->route('login')->with('success', 'Link token telah kadaluwarsa');
           }

           $email = $datauser->email;
           $data = [
            'password' => bcrypt($request->input('password')),
            'email_verified_at' => Carbon::now()
           ];

           User::where('email', $email)->update($data);
           UserVerify::where('email', $email)->delete();
           return redirect()->route('login')->with('success', 'Password berhasil diubah');
    }
}
