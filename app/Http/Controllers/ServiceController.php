<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function index(){
        $services = Service::paginate(5);
        return view('admin.service.index', compact('services'));
    }

    public function store(Request $request){
        $request->validate([
            'service_name'=>'required|unique:services|max:191',
            'service_image'=>'required|mimes:jpg,jpeg,png',
        ],
        [
            'service_name.required'=>"กรุณาป้อนชื่อบริการ",
            'service_name.max'=>"ห้ามป้อนนเกิน 191 ตัวอักษร",
            'service_name.unique'=>"มีข้มูลบริการนี้ในฐานข้อมูลแล้ว",
            'service_image.required'=>"กรุณาใส่ภาพประกอบบริการ"

        ]);

        // Eloquent
        $department = new Department;
        $department->department_name = $request->department_name;
        $department->user_id = Auth::user()->id;
        $department->save();

        // Query Builder
        // $data = array();
        // $data["department_name"] = $request->department_name;
        // $data["user_id"] = Auth::user()->id;
        // DB::table('departments')->insert($data);
        return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อย');
    }
}
