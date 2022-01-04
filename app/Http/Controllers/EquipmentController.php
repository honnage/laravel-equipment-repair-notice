<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Equipment;
use App\Models\Category;
use App\Models\TypeEquipment;

class EquipmentController extends Controller
{
    public function index()
    {
        $Equipment = Equipment::orderBy('id', 'desc')->get();
        return view('admin.equipment.index', compact('Equipment'));
    }

    public function create()
    {
        $categories = Category::all();
        $typeEquipment = TypeEquipment::all();
        return view('admin.equipment.form',  compact('categories','typeEquipment')); 
    }

    public function store(Request $request){
        // dd($request->all());
        $request->validate([
            'name'=>'required|unique:equipment|max:191',
            'equipment_number'=>'required|unique:equipment|max:191',
            'purchase_date'=>'required',
            'type_equipment_id'=>'required',
            'insurance'=>'required|max:191',
            'price'=>'required|max:10',
        ],
        [
            'name.required'=>"กรุณาป้อนครุภัณฑ์",
            'name.max'=>"ห้ามป้อนเกิน 191 ตัวอักษร",
            'name.unique'=>"มีข้มูลประเภทครุภัณฑ์นี้ในฐานข้อมูลแล้ว",

            'equipment_number.required'=>"กรุณาป้อนหมายเลขครุภัณฑ์",
            'equipment_number.max'=>"ห้ามป้อนเกิน 191 ตัวอักษร",
            'equipment_number.unique'=>"มีข้มูลหมายเลขครุภัณฑ์นี้ในฐานข้อมูลแล้ว",

            'purchase_date.required'=>"กรุณาเลือกวันที่ซื้อ",
            'type_equipment_id.required'=>"กรุณาเลือกประเภทครุภัณฑ์",

            'insurance.required'=>"กรุณาป้อนอายุประกัน",
            'insurance.max'=>"ห้ามป้อนเกิน 191 ตัวอักษร",

            'price.required'=>"กรุณาราคาครุภัณฑ์",
            'price.max'=>"ห้ามป้อนเกิน 2 ตัวอักษร",
        ]);
      
        $Equipment = new Equipment;
        $Equipment->name = $request->name;
        $Equipment->equipment_number = $request->equipment_number;
        $Equipment->purchase_date = $request->purchase_date;
        $Equipment->type_equipment_id = $request->type_equipment_id;
        $Equipment->insurance = $request->insurance;
        $Equipment->price = $request->price;
        $Equipment->user_id_created = Auth::user()->id;
        $Equipment->user_id_updated = Auth::user()->id;
        $Equipment->save();
        return redirect('/equipment/all')->with('success','บันทึกข้อมูลเรียบร้อย');
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
