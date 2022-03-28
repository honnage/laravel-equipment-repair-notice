<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;

use Illuminate\Support\Facades\Hash;
use App\Actions\Fortify\PasswordValidationRules;


class UserController extends Controller

{
    use PasswordValidationRules;

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
        if($request->password){
            DB::table('users')
            ->where('id','=',$id)
            ->update([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'gender' => $request->gender,
                'phone' => $request->phone,
                'address' => $request->address,
                'department' => $request->department,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        }else{
            User::find($id)->update($request->all());
        }
       
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

    public function destroy($id)
    {
        $user = User::find($id);
        if($user->Transaction->count() > 0){
            Session()->flash('error','ไม่สามารถลบได้เนื่องจากมีประวัติการทำธุรกรรม');
            return redirect()->back();
        }
        User::find($id)->delete();
        return redirect('/user/all')->with('success','ลบข้อมูลเรียบร้อย');
    }

    public function createUser(){
        return view('admin.user.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'email'=>'required|unique:users|max:255',
            'phone'=>'required|unique:users|max:100|min:10',
            'password' => $this->passwordRules(),
            'firstname'=>'required|max:255',
            'lastname'=>'required|max:255',
            'gender'=>'required',
            'address'=>'required|max:255',
            'department'=>'required|max:255',
        ],
        [
            'email.required'=>"กรุณาป้อนอีเมล",
            'email.max'=>"ห้ามป้อนเกิน 255 ตัวอักษร",
            'email.unique'=>"มีข้มูลอีเมลนี้ในฐานข้อมูลแล้ว",
            'phone.required'=>"กรุณาป้อนเบอร์โทร",
            'phone.max'=>"ห้ามป้อนตัวเลขเกิน 10 ตัวอักษร",
            'phone.min'=>"ต้องป้อนตัวเลข 10 ตัวอักษร",
            'phone.unique'=>"มีข้มูลเบอร์โทรนี้ในฐานข้อมูลแล้ว",
            'firstname.required'=>"กรุณาป้อนชื่อจริง",
            'firstname.max'=>"ห้ามป้อนเกิน 255 ตัวอักษร",
            'lastname.required'=>"กรุณาป้อนนามสกุล",
            'lastname.max'=>"ห้ามป้อนเกิน 255 ตัวอักษร",
            'gender.required'=>"กรุณาเลือกเพศของท่าน",
            'address.required'=>"กรุณาป้อนที่อยู่",
            'address.max'=>"ห้ามป้อนเกิน 255 ตัวอักษร",
            'department.required'=>"กรุณาป้อนตำแหน่ง",
            'department.max'=>"ห้ามป้อนเกิน 255 ตัวอักษร",
        ]);

        $user = new User;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->department = $request->department;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        // 'password' => Hash::make($request->newPassword)

        $user->save();        
        return redirect('/user/all')->with('success', 'บันทึกข้อมูลเรียบร้อย');
    }
}
