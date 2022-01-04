<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    public function index()
    {
        $User = User::orderBy('id', 'desc')->get();
        return view('admin.user.index', compact('User'));
    }

    public function edit($id)
    {
        $User = User::find($id);
        return view('admin.user.form', compact('User'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        User::find($id)->update($request->all());
        return redirect('/user/all')->with('success','อัพเดทข้อมูลเรียบร้อย');
    }

    


    
}
