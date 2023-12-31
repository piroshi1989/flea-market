<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SendMailRequest;
use App\Mail\SendNoticeMail;
use App\Models\User;
use App\Models\Category;
use App\Models\Brand;

class SendMailController extends Controller
{


    public function confirmNoticeMail(SendMailRequest $request)
    {
        $emails = $request->all();

        $categories = Category::all();
        $brands = Brand::all();

        $selectedCategory = $request->input('category');
        $selectedBrand = $request->input('brand');

        return view('mail__confirm', compact('emails', 'categories', 'brands','selectedCategory', 'selectedBrand'));
    }

    public function sendNoticeMail(SendMailRequest $request){
        //フォームから受け取ったactionの値を取得
        $action = $request->input('action');

        //フォームから受け取ったactionを除いたinputの値を取得
        $emails = $request->except('action');

        //一般ユーザ
        $users = User::where('role', 0)->get();

        //actionの値で分岐
        if($action !== 'submit'){
            return redirect('/management')
            ->withInput($emails);
        } else {
            foreach($users as $user){
            //入力されたメールアドレスにメールを送信
            \Mail::to($user['email'])->send(new SendNoticeMail($emails));
            //再送信を防ぐためにトークンを再発行
            $request->session()->regenerateToken();
            }
            //送信後はmanagementにredirect
            return redirect('/management')->with('message', 'メールを送信しました');
        }
    }
}