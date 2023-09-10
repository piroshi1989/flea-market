<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\AdminRequest;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function storeAdmin(AdminRequest $request)
    {
        $store = new User;
        $store->role = $request->role;
        $store->name = $request->name;
        $store->email = $request->email;
        $store->password = Hash::make($request->password);
        $store->postcode = $request->postcode;
        $store->address = $request->address;
        $store->building_name = $request->building_name;
        $store->save();

        return redirect('/management')->with('message', '管理者を作成しました');
    }
}