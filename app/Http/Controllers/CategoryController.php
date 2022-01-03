<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Category;


class CategoryController extends Controller
{
    public function index(){
        $categories = Category::paginate(10);
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.form');
    }

    public function store(Request $request){
      
        $request->validate([
            'name'=>'required|unique:categories|max:191'
        ],
        [
            'name.required'=>"กรุณาป้อนประเภทครุภัณฑ์",
            'name.max'=>"ห้ามป้อนนเกิน 191 ตัวอักษร",
            'name.unique'=>"มีข้มูลประเภทครุภัณฑ์นี้ในฐานข้อมูลแล้ว"
        ]);

        $Category = new Category;
        $Category->name = $request->name;
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
            'name'=>'required|unique:categories|max:191'
        ],
        [
            'name.required'=>"กรุณาป้อนประเภทครุภัณฑ์",
            'name.max'=>"ห้ามป้อนนเกิน 191 ตัวอักษร",
            'name.unique'=>"มีข้มูลประเภทครุภัณฑ์นี้ในฐานข้อมูลแล้ว"
        ]);

        // dd($request->all());
        Category::find($id)->update($request->all());
        return redirect('/category/all')->with('success','อัพเดทข้อมูลเรียบร้อย');
    }

    public function destroy($id)
    {
        // dd($id);
        // $license = LicenseModel::find($id);
        // if($license->asset->count() > 0){
        //     Session()->flash('error','ไม่สามารถลบได้เนื่องจากมีชื่อชิ้นงานใช้งานอยู่');
        //     return redirect()->back();
        // }

        // DB::table('type_equipment')
        // ->where('id','=',$id)
        // ->delete();
        Category::find($id)->delete();
        return redirect('/category/all')->with('success','ลบข้อมูลเรียบร้อย');
    }
}
