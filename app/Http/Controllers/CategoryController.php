<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\TypeEquipment;
use App\Models\Equipment;


class CategoryController extends Controller
{
    public function index(){
        $categories = Category::orderBy('id', 'desc')->get();
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.form');
    }

    public function store(Request $request){
      
        $request->validate([
            'name'=>'required|unique:categories|max:191',
        ],
        [
            'name.required'=>"กรุณาป้อนประเภทครุภัณฑ์",
            'name.max'=>"ห้ามป้อนเกิน 191 ตัวอักษร",
            'name.unique'=>"มีข้มูลประเภทครุภัณฑ์นี้ในฐานข้อมูลแล้ว"
        ]);
        $Category = new Category;
        $Category->name = $request->name;
        $Category->user_id_created = Auth::user()->id;
        $Category->user_id_updated = Auth::user()->id;
        $Category->save();
        return redirect('/category/all')->with('success','บันทึกข้อมูลเรียบร้อย');
    }

    public function edit($id)
    {
        $Category = Category::find($id);
        return view('admin.category.form', compact('Category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required|unique:categories|max:191',
        ],
        [
            'name.required'=>"กรุณาป้อนประเภทครุภัณฑ์",
            'name.max'=>"ห้ามป้อนเกิน 191 ตัวอักษร",
            'name.unique'=>"มีข้มูลประเภทครุภัณฑ์นี้ในฐานข้อมูลแล้ว"
        ]);
        
        // dd($request->user_id);
        // Category::find($id)->update($request->all());
        Category::find($id)->update([
            'name'=>$request->name,
            'user_id_updated'=> Auth::user()->id
        ]);
        return redirect('/category/all')->with('success','อัพเดทข้อมูลเรียบร้อย');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if($category->Equipment->count() > 0){
            Session()->flash('error','ไม่สามารถลบได้เนื่องจากมีหมวดหมู่ครุภัณฑ์นี้ใช้งานอยู่');
            return redirect()->back();
        }
        Category::find($id)->delete();
        return redirect('/category/all')->with('success','ลบข้อมูลเรียบร้อย');
    }


    public function query($id){
        $equipment = Equipment::where('category_id',  $id)->orderBy('id', 'desc')->get();
        return view('admin.category.query', compact('equipment'));
    }

    
}
