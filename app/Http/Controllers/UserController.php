<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;

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
        User::find($id)->update($request->all());
        return redirect('/user/all')->with('success','อัพเดทข้อมูลเรียบร้อย');
    }

    public function query($id){
        $User = User::find($id);
        $query = Transaction::where('user_id', $id)->orderBy('created_at', 'DESC')->get();

        $status_notifyRepair = Transaction::where('user_id', $id)->where('status', 'แจ้งซ่อม')->get();
        $status_beingRepaired = Transaction::where('user_id', $id)->where('status', 'กำลังซ่อม')->get();
        $status_cancelr = Transaction::where('user_id', $id)->where('status', 'ยกเลิก')->get();
        $status_sussecc = Transaction::where('user_id', $id)->where('status', 'เรียบร้อย')->get();
        $count_status_notifyRepair = $status_notifyRepair->count();
        $count_status_beingRepaired = $status_beingRepaired->count();
        $count_status_cancelr = $status_cancelr->count();
        $count_status_sussecc = $status_sussecc->count();
        $count_translation = $query->count();
        return view('admin.user.query', compact('query', 'User', 'count_translation','count_status_notifyRepair', 'count_status_beingRepaired', 'count_status_cancelr', 'count_status_sussecc'));
    }
}
