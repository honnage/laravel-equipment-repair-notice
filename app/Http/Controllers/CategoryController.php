<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class CategoryController extends Controller
{
    public function index(){
        $categories = Category::paginate(10);
        return view('admin.category.index', compact('categories'));
    }

    public function store(Request $request){
        $request->validate([
            'categories_name'=>'required|unique:categories|max:255',
            'categories_image'=>'required|mimes:jpg,jpeg,png',
        ],
        [
            'categories_name.required'=>"กรุณาป้อนชื่อหมวดหมู่",
            'categories_name.max'=>"ห้ามป้อนเกิน 255 ตัวอักษร",
            'categories_name.unique'=>"มีข้มูลชื่อหมวดหมู่นี้ในฐานข้อมูลแล้ว",
            'categories_image.required'=>"กรุณาใส่ภาพประกอบหมวดหมู่"
        ]);

        // เข้ารหัสรุปภาพ
        $categories_image = $request->file('categories_image');
        $name_gen = hexdec(uniqid());
        $img_ext =  strtolower($categories_image->getClientOriginalExtension());
        $img_name = $name_gen.".".$img_ext;
    
        $upload_location = "image/categories/";
        $full_path = $upload_location.$img_name;
     
        Category::insert([
            'categories_name'=>$request->categories_name,
            'categories_image'=>$full_path,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]); 
        $categories_image->move($upload_location,$img_name);
        return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อย');
    }

    public function edit($id){
        $categories = Category::paginate(10);
        $category = Category::find($id);
        return view('admin.category.edit', compact('categories','category'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'categories_name'=>'required|max:255',
        ],
        [
            'categories_name.required'=>"กรุณาป้อนชื่อหมวดหมู่",
            'categories_name.max'=>"ห้ามป้อนเกิน 255 ตัวอักษร",
        ]);

        // เข้ารหัสรุปภาพ
        $categories_image = $request->file('categories_image');

        if( $categories_image){
            $name_gen = hexdec(uniqid());
            $img_ext =  strtolower($categories_image->getClientOriginalExtension());
            $img_name = $name_gen.".".$img_ext;
        
            $upload_location = "image/categories/";
            $full_path = $upload_location.$img_name;

            Category::find($id)->update([
                'categories_name'=>$request->categories_name,
                'categories_image'=>$full_path,
                'updated_at'=>Carbon::now()
            ]); 

            $old_image = $request->old_image;
            unlink($old_image);

            $categories_image->move($upload_location,$img_name);
            return redirect()->route('category')->with('success','อัปเดตภาพข้อมูลเรียบร้อย');
        }else{
            Category::find($id)->update([
                'categories_name'=>$request->categories_name,
                'updated_at'=>Carbon::now()
            ]); 
            return redirect()->route('category')->with('success','อัปเดตข้อมูลเรียบร้อย');
        }
    }
}
