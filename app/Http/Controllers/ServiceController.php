<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
        // dd($request->all());

        // เข้ารหัสรุปภาพ
        $service_image = $request->file('service_image');
        $name_gen = hexdec(uniqid());
        $img_ext =  strtolower($service_image->getClientOriginalExtension());
        $img_name = $name_gen.".".$img_ext;
    
        $upload_location = "image/services/";
        $full_path = $upload_location.$img_name;
     
        Service::insert([
            'service_name'=>$request->service_name,
            'service_image'=>$full_path,
            'created_at'=>Carbon::now()
        ]); 
        $service_image->move($upload_location,$img_name);
        return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อย');
    }
}
