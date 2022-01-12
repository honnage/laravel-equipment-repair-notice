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

    public function queryStatus($id, $status){
        $status_notifyRepair = DB::table('transactions')
            ->select('*')
            ->where('user_id', $id)
            ->where('status', 'แจ้งซ่อม')
            ->orderBy('id', 'DESC')
            ->get();

        $status_cancelr = DB::table('transactions')
            ->select('*')
            ->where('user_id', $id)
            ->where('status', 'ยกเลิก')
            ->orderBy('id', 'DESC')
            ->get();

        $status_beingRepaired = DB::table('transactions')
            ->select('*')
            ->where('user_id', $id)
            ->where('status', 'กำลังซ่อม')
            ->orderBy('id', 'DESC')
            ->get();

        $status_sussecc = DB::table('transactions')
            ->select('*')
            ->where('user_id', $id)
            ->where('status', 'เรียบร้อย')
            ->orderBy('id', 'DESC')
            ->get();

        $transaction = Transaction::where('user_id', $id)->where('status', $status)->orderBy('id', 'desc')->get();
        $count_translation = $transaction->count();
        $count_status_notifyRepair = $status_notifyRepair->count();
        $count_status_cancelr = $status_cancelr->count();
        $count_status_beingRepaired = $status_beingRepaired->count();
        $count_status_sussecc = $status_sussecc->count();
        return view('admin.transaction.query', 
        compact('transaction', 'count_translation', 'status',
            'status_notifyRepair', 'count_status_notifyRepair', 
            'status_cancelr', 'count_status_cancelr', 
            'status_beingRepaired', 'count_status_beingRepaired', 
            'status_sussecc', 'count_status_sussecc'));
    }
}
