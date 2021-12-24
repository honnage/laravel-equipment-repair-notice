<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use App\Models\transaction;
class transactionController extends Controller
{

    public function index()
    {
        $transaction = transaction::paginate(10);
        // return view('admin.department.index', compact('departments','trashDepartments'));
        return view('admin.transaction.index', compact('transaction'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'user_id' => 'required',
                'device_id'=>'required|unique:transactions|max:50',
                'name'=>'required|max:255',
                'problem'=>'required|max:255',
                'category'=>'required',
                'details'=>'required|max:255',
                'status'=>'required',
                'set_at'=>'required',
                'fileImage' => 'mimes:jpg,jpeg,png,pdf',
            ],
            [
                'user_id.required' => "กรุณาป้อนรหัสผู้แจ้งซ่อม",
                'device_id.required' => "กรุณาป้อนรหัสอุปกรณ์",
                'device_id.max' => "ห้ามป้อนเกิน 50 ตัวอักษร",
                'device_id.unique' => "มีข้มูลรหัสอุปกรณ์นี้ในฐานข้อมูลแล้ว",
                'name.required' => "กรุณาป้อนชื่ออุปกรณ์",
                'name.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",
                'problem.required' => "กรุณาป้อนปัญหางานซ่อม",
                'problem.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",
                'category.required' => "กรุณาป้อนหมวดหมู่อุปกรณ์",
                'details.required' => "กรุณาป้อนประเภทงานซ่อม",
                'details.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",
                'status.required' => "กรุณาป้อนสถานะ",
                'set_at.required' => "กรุณาเลือกเวลากำหนดซ่อมแจ้ง",
            ]
        );

        // dd($request->all());

        // เข้ารหัสไฟล์
        if($request->file('fileImage') != null ){
            $fileImage = $request->file('fileImage');
            $name_gen = hexdec(uniqid());
            $img_ext =  strtolower($fileImage->getClientOriginalExtension());
            $img_name = $name_gen . "." . $img_ext;
    
            $upload_location = "file/";
            $full_path = $upload_location . $img_name;

            transaction::insert([
                'user_id' => $request->user_id,
                'device_id' => $request->device_id,
                'name' => $request->name,
                'problem' => $request->problem,
                'category' => $request->category,
                'details' => $request->details,
                'status' => $request->status,
                'note' => $request->note,
                'price' => $request->price,
                'guaranty' => $request->guaranty,
                'set_at' => $request->set_at,
                'fileImage' => $full_path,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            $fileImage->move($upload_location, $img_name);
        }

        transaction::insert([
            'user_id' => $request->user_id,
            'device_id' => $request->device_id,
            'name' => $request->name,
            'problem' => $request->problem,
            'category' => $request->category,
            'details' => $request->details,
            'status' => $request->status,
            'note' => $request->note,
            'price' => $request->price,
            'guaranty' => $request->guaranty,
            'set_at' => $request->set_at,
       
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        return redirect()->back()->with('success', 'บันทึกข้อมูลเรียบร้อย');
    }
}
