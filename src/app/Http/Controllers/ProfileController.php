<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Brand;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function showProfile(Request $request)
    {
        $userId = Auth::id();
        $user = Auth::user();

        //検索用
        $categories = Category::all();
        $brands = Brand::all();

        $selectedCategory = $request->input('category');
        $selectedBrand = $request->input('brand');

        return view('profile', compact('user', 'categories', 'brands', 'selectedCategory', 'selectedBrand'));
    }

    public function uploadProfileImage(Request $request)
    {
        // ディレクトリ名
        $dir = 'images';

        // アップロードされたファイルを取得
        $uploadedFile = $request->file('image');

        // アップロードされたファイルがある場合
        if ($uploadedFile) {
            // アップロードされたファイル名を取得
            $file_name = $uploadedFile->getClientOriginalName();

            // 取得したファイル名で保存
            $uploadedFile->storeAs('public/' . $dir, $file_name);

            // ファイル情報をDBに保存
            $user = Auth::user();
            $user->image_url = 'storage/' . $dir . '/' . $file_name;
            $user->save();
        }

        return redirect('/mypage/profile')->with('message', 'プロフィール画像を更新しました');
    }

    public function updateProfile(ProfileRequest $request)
    {
        $userId=Auth::id();
        $formType = $request->input('form_type');
        if ($formType === 'profile_form') {
            $form = $request->all();
            unset($form['_token']);
            User::find($userId)->update($form);

            return redirect('/mypage/profile')->with('message', 'プロフィール設定を更新しました');
        }
    }
}