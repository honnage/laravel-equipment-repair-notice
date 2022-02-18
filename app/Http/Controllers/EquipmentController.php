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
use App\Models\Transaction;

class EquipmentController extends Controller
{
    public function index()
    {
        // $equipment = Equipment::orderBy('id', 'desc')->get();
        $equipment = DB::table('equipment')
        ->join('categories','categories.id','=','equipment.type_equipment_id')
        ->select(
            '*',
            'equipment.id as equid',
            'equipment.name as equipment_name',
            'categories.name as category_name')
        ->orderBy('equipment.id', 'DESC')
        ->get();
        return view('admin.equipment.index', compact('equipment'));
    }

    public function create()
    {
        $categories = Category::all();
        // $typeEquipment = TypeEquipment::all();
        $typeEquipment = TypeEquipment::orderBy('category_id', 'DESC')->get();
        return view('admin.equipment.form',  compact('categories','typeEquipment')); 
    }

    public function store(Request $request){
        // dd($request->all());
        $request->validate([
            'name'=>'required|unique:equipment|max:191',
            'equipment_number'=>'required|unique:equipment|max:191',
            // 'purchase_date'=>'required',
            'type_equipment_id'=>'required',
            // 'insurance'=>'required|max:191',
            // 'price'=>'required|max:10',
        ],
        [
            'name.required'=>"กรุณาป้อนชื่อครุภัณฑ์",
            'name.max'=>"ห้ามป้อนเกิน 191 ตัวอักษร",
            'name.unique'=>"มีข้มูลประเภทครุภัณฑ์นี้ในฐานข้อมูลแล้ว",

            'equipment_number.required'=>"กรุณาป้อนหมายเลขครุภัณฑ์",
            'equipment_number.max'=>"ห้ามป้อนเกิน 191 ตัวอักษร",
            'equipment_number.unique'=>"มีข้มูลหมายเลขครุภัณฑ์นี้ในฐานข้อมูลแล้ว",

            // 'purchase_date.required'=>"กรุณาเลือกวันที่ซื้อ",
            'type_equipment_id.required'=>"กรุณาเลือกประเภทครุภัณฑ์",

            // 'insurance.required'=>"กรุณาป้อนอายุประกัน",
            // 'insurance.max'=>"ห้ามป้อนเกิน 191 ตัวอักษร",

            // 'price.required'=>"กรุณาราคาครุภัณฑ์",
            // 'price.max'=>"ห้ามป้อนเกิน 2 ตัวอักษร",
        ]);
      
        $equipment = new Equipment;
        $equipment->name = $request->name;
        $equipment->equipment_number = $request->equipment_number;
        $equipment->purchase_date = $request->purchase_date;
        $equipment->type_equipment_id = $request->type_equipment_id;
        $equipment->insurance = $request->insurance;
        $equipment->price = $request->price;
        $equipment->user_id_created = Auth::user()->id;
        $equipment->user_id_updated = Auth::user()->id;
        $equipment->save();
        return redirect('/equipment/all')->with('success','บันทึกข้อมูลเรียบร้อย');
    }

    public function edit($id)
    {
        $equipment = Equipment::find($id);
        $categories = Category::all();
        $typeEquipment = TypeEquipment::orderBy('category_id', 'DESC')->get();
        return view('admin.equipment.form', compact('equipment', 'categories', 'typeEquipment'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required|max:191',
            'equipment_number'=>'required|max:191',
            // 'purchase_date'=>'required',
            'type_equipment_id'=>'required',
            // 'insurance'=>'required|max:191',
            'price'=>'required|max:10',
        ],
        [
            'name.required'=>"กรุณาป้อนครุภัณฑ์",
            'name.max'=>"ห้ามป้อนเกิน 191 ตัวอักษร",

            'equipment_number.required'=>"กรุณาป้อนหมายเลขครุภัณฑ์",
            'equipment_number.max'=>"ห้ามป้อนเกิน 191 ตัวอักษร",

            // 'purchase_date.required'=>"กรุณาเลือกวันที่ซื้อ",
            'type_equipment_id.required'=>"กรุณาเลือกประเภทครุภัณฑ์",

            // 'insurance.required'=>"กรุณาป้อนอายุประกัน",
            // 'insurance.max'=>"ห้ามป้อนเกิน 191 ตัวอักษร",

            'price.required'=>"กรุณาราคาครุภัณฑ์",
            'price.max'=>"ห้ามป้อนเกิน 2 ตัวอักษร",
        ]);

        // Equipment::find($id)->update($request->all());
        Equipment::find($id)->update([
            'name'=>$request->name,
            'equipment_number'=>$request->equipment_number,
            'purchase_date'=>$request->purchase_date,
            'type_equipment_id'=>$request->type_equipment_id,
            'insurance'=>$request->insurance,
            'price'=>$request->price,
            'user_id_updated'=> Auth::user()->id
        ]);
        return redirect('/equipment/all')->with('success','อัพเดทข้อมูลเรียบร้อย');
    }

    public function destroy($id)
    {
        $equipment = Equipment::find($id);
        if($equipment->Transaction->count() > 0){
            Session()->flash('error','ไม่สามารถลบได้เนื่องจากมีครุภัณฑ์นี้ใช้งานอยู่');
            return redirect()->back();
        }
        Equipment::find($id)->delete();
        return redirect('/equipment/all')->with('success','ลบข้อมูลเรียบร้อย');
    }

    public function query($id){
        $equipment = Equipment::find($id);
        $query = Transaction::where('equipment_id', $id)->orderBy('id', 'DESC')->get();

        $status_notifyRepair = Transaction::where('equipment_id', $id)->where('status', 'แจ้งซ่อม')->get();
        $status_beingRepaired = Transaction::where('equipment_id', $id)->where('status', 'กำลังซ่อม')->get();
        $status_cancelr = Transaction::where('equipment_id', $id)->where('status', 'ยกเลิก')->get();
        $status_sussecc = Transaction::where('equipment_id', $id)->where('status', 'เรียบร้อย')->get();
        $count_status_notifyRepair = $status_notifyRepair->count();
        $count_status_beingRepaired = $status_beingRepaired->count();
        $count_status_cancelr = $status_cancelr->count();
        $count_status_sussecc = $status_sussecc->count();
        $count_translation = $query->count();
        return view('admin.equipment.query', compact('query', 'equipment', 'count_translation','count_status_notifyRepair', 'count_status_beingRepaired', 'count_status_cancelr', 'count_status_sussecc'));
    }
}
