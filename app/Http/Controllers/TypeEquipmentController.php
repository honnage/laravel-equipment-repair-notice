<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\TypeEquipment;
use App\Models\Category;
use App\Models\Equipment;

class TypeEquipmentController extends Controller
{
    public function index()
    {
        $typeEquipment = TypeEquipment::orderBy('id', 'desc')->get();
        return view('admin.type-equipment.index', compact('typeEquipment'));
    }

    public function create()
    {
        $categories = Category::orderBy('name', 'DESC')->get();
        return view('admin.type-equipment.form',  compact('categories'));
    }

    public function store(Request $request){
      
        $request->validate([
            'name'=>'required|unique:type_equipment|max:191',
            'category_id'=>'required',
        ],
        [
            'name.required'=>"กรุณาป้อนประเภทครุภัณฑ์",
            'name.max'=>"ห้ามป้อนเกิน 191 ตัวอักษร",
            'name.unique'=>"มีข้มูลประเภทครุภัณฑ์นี้ในฐานข้อมูลแล้ว",
            'category_id.required'=>"กรุณาเลือกหมวดหมู่ครุภัณฑ์",
        ]);
        $typeEquipment = new TypeEquipment;
        $typeEquipment->name = $request->name;
        $typeEquipment->category_id = $request->category_id;
        $typeEquipment->user_id_created = Auth::user()->id;
        $typeEquipment->user_id_updated = Auth::user()->id;
        $typeEquipment->save();
        return redirect('/type/all')->with('success','บันทึกข้อมูลเรียบร้อย');
    }

    public function edit($id)
    {
        $typeEquipment = TypeEquipment::find($id);
        $categories = Category::orderBy('name', 'DESC')->get();
        return view('admin.type-equipment.form', compact('typeEquipment', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required|unique:type_equipment|max:191',
        ],
        [
            'name.required'=>"กรุณาป้อนประเภทครุภัณฑ์",
            'name.max'=>"ห้ามป้อนเกิน 191 ตัวอักษร",
            'name.unique'=>"มีข้มูลประเภทครุภัณฑ์นี้ในฐานข้อมูลแล้ว"
        ]);
        // TypeEquipment::find($id)->update($request->all());
        TypeEquipment::find($id)->update([
            'name'=>$request->name,
            'user_id_updated'=> Auth::user()->id
        ]);
        return redirect('/type/all')->with('success','อัพเดทข้อมูลเรียบร้อย');
    }


    public function destroy($id)
    {
        $typeEquipment = TypeEquipment::find($id);
        if($typeEquipment->equipment->count() > 0){
            Session()->flash('error','ไม่สามารถลบได้เนื่องจากมีประเภทครุภัณฑ์นี้ใช้งานอยู่');
            return redirect()->back();
        }
        TypeEquipment::find($id)->delete();
        return redirect('/type/all')->with('success','ลบข้อมูลเรียบร้อย');
    }

    public function query($id){
        $typeEquipment = TypeEquipment::find($id);
        $query = Equipment::where('type_equipment_id', $id)->get();
        return view('admin.type-equipment.query', compact('query', 'typeEquipment'));
    }
}
