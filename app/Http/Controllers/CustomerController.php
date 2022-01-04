<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CustomerController extends Controller
{
    public function index(){
        $customers = Customers::paginate(10);
        return view('admin.customer.index', compact('customers'));
    }

    public function store(Request $request){
        $request->validate([
            'firstname'=>'required|max:255',
            'lastname'=>'required|max:255',
            'gender'=>'required',
            'email'=>'required|unique:customers|max:255',
            'phone'=>'required|unique:customers|max:10',
            'address'=>'required|max:255',
        ],
        [
            'firstname.required'=>"กรุณาป้อนชื่อจริง",
            'firstname.max'=>"ห้ามป้อนเกิน 255 ตัวอักษร",
            'lastname.required'=>"กรุณาป้อนชื่อจริง",
            'lastname.max'=>"ห้ามป้อนเกิน 255 ตัวอักษร",
            'gender.required'=>"กรุณาเลือกเพศ",
            'email.required'=>"กรุณาป้อนอีเมล",
            'email.max'=>"ห้ามป้อนเกิน 255 ตัวอักษร",
            'email.unique'=>"มีข้มูลอีเมลนี้ในฐานข้อมูลแล้ว",
            'phone.required'=>"กรุณาป้อนเบอร์โทร",
            'phone.max'=>"ห้ามป้อนเกิน 10 ตัวอักษร",
            'phone.unique'=>"มีข้มูลเบอร์โทรนี้ในฐานข้อมูลแล้ว",
            'address.required'=>"กรุณาป้อนที่อยู่",
            'address.max'=>"ห้ามป้อนเกิน 255 ตัวอักษร",
        ]);

        // Eloquent
        $customers = new Customers;
        $customers->firstname = $request->firstname;
        $customers->lastname = $request->lastname;
        $customers->gender = $request->gender;
        $customers->email = $request->email;
        $customers->phone = $request->phone;
        $customers->address = $request->address;
        $customers->save();

        // Query Builder
        // $data = array();
        // $data["department_name"] = $request->department_name;
        // $data["user_id"] = Auth::user()->id;
        // DB::table('departments')->insert($data);

        return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อย');
    }

    public function edit($id){
        $customers = Customers::paginate(10);
        $customer = Customers::find($id);
        return view('admin.customer.edit', compact('customers','customer'));
    }

    public function update(Request $request, $id){
          $request->validate([
            'firstname'=>'required|max:255',
            'lastname'=>'required|max:255',
            'gender'=>'required',
            'email'=>'required|max:255',
            'phone'=>'required|max:10',
            'address'=>'required|max:255',
        ],
        [
            'firstname.required'=>"กรุณาป้อนชื่อจริง",
            'firstname.max'=>"ห้ามป้อนเกิน 255 ตัวอักษร",
            'lastname.required'=>"กรุณาป้อนนามสกุล",
            'lastname.max'=>"ห้ามป้อนเกิน 255 ตัวอักษร",
            'gender.required'=>"กรุณาเลือกเพศ",
            'email.required'=>"กรุณาป้อนอีเมล",
            'email.max'=>"ห้ามป้อนเกิน 255 ตัวอักษร",
            'phone.required'=>"กรุณาป้อนเบอร์โทร",
            'phone.max'=>"ห้ามป้อนเกิน 10 ตัวอักษร",
            'address.required'=>"กรุณาป้อนที่อยู่",
            'address.max'=>"ห้ามป้อนเกิน 255 ตัวอักษร",
        ]);

        Customers::find($id)->update($request->all());
        return redirect()->route('customer')->with('success','อัปเดตข้อมูลเรียบร้อย');
    }

    public function detail($id){
        $customers = Customers::paginate(10);
        $customer = Customers::find($id);
        return view('admin.customer.detail', compact('customers','customer'));
    }
}
