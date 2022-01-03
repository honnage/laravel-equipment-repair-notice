<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\TypeEquipment;
use App\Models\Category;


class TypeEquipmentController extends Controller
{
    public function index()
    {
        // $TypeEquipment = TypeEquipment::paginate(10);
        $TypeEquipment = TypeEquipment::all();
        return view('admin.type-equipment.index', compact('TypeEquipment'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.type-equipment.form',  compact('categories'));
    }

    public function store(Request $request){
      
        $request->validate([
            'name'=>'required|unique:type_equipment|max:191',
            'category_id'=>'required'
        ],
        [
            'name.required'=>"กรุณาป้อนประเภทครุภัณฑ์",
            'name.max'=>"ห้ามป้อนนเกิน 191 ตัวอักษร",
            'name.unique'=>"มีข้มูลประเภทครุภัณฑ์นี้ในฐานข้อมูลแล้ว",
            'category_id.required'=>"กรุณาเลือกหมวดหมู่ครุภัณฑ์",
        ]);

        $TypeEquipment = new TypeEquipment;
        $TypeEquipment->name = $request->name;
        $TypeEquipment->category_id = $request->category_id;
        $TypeEquipment->save();
        return redirect('/type/all')->with('success','บันทึกข้อมูลเรียบร้อย');
    }

    public function edit($id)
    {
        $TypeEquipment = TypeEquipment::find($id);
        $categories = Category::all();
        return view('admin.type-equipment.form', compact('TypeEquipment', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required|unique:type_equipment|max:191'
        ],
        [
            'name.required'=>"กรุณาป้อนประเภทครุภัณฑ์",
            'name.max'=>"ห้ามป้อนนเกิน 191 ตัวอักษร",
            'name.unique'=>"มีข้มูลประเภทครุภัณฑ์นี้ในฐานข้อมูลแล้ว"
        ]);

        // dd($request->all());
        TypeEquipment::find($id)->update($request->all());
        return redirect('/type/all')->with('success','อัพเดทข้อมูลเรียบร้อย');
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
        TypeEquipment::find($id)->delete();
        return redirect('/type/all')->with('success','ลบข้อมูลเรียบร้อย');
    }
}
