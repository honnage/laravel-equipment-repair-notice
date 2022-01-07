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
        // $typeEquipment = TypeEquipment::all();
        $typeEquipment = TypeEquipment::orderBy('category_id', 'DESC')->get();
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
            'name.required'=>"กรุณาป้อนชื่อครุภัณฑ์",
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

    public function edit($id)
    {
        $Equipment = Equipment::find($id);
        $categories = Category::all();
        $typeEquipment = TypeEquipment::orderBy('category_id', 'DESC')->get();
        return view('admin.equipment.form', compact('Equipment', 'categories', 'typeEquipment'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required|max:191',
            'equipment_number'=>'required|max:191',
            'purchase_date'=>'required',
            'type_equipment_id'=>'required',
            'insurance'=>'required|max:191',
            'price'=>'required|max:10',
        ],
        [
            'name.required'=>"กรุณาป้อนครุภัณฑ์",
            'name.max'=>"ห้ามป้อนเกิน 191 ตัวอักษร",

            'equipment_number.required'=>"กรุณาป้อนหมายเลขครุภัณฑ์",
            'equipment_number.max'=>"ห้ามป้อนเกิน 191 ตัวอักษร",

            'purchase_date.required'=>"กรุณาเลือกวันที่ซื้อ",
            'type_equipment_id.required'=>"กรุณาเลือกประเภทครุภัณฑ์",

            'insurance.required'=>"กรุณาป้อนอายุประกัน",
            'insurance.max'=>"ห้ามป้อนเกิน 191 ตัวอักษร",

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
        $Equipment = Equipment::find($id);
        if($Equipment->Transaction->count() > 0){
            Session()->flash('error','ไม่สามารถลบได้เนื่องจากมีครุภัณฑ์นี้ใช้งานอยู่');
            return redirect()->back();
        }
        
        TypeEquipment::find($id)->delete();
        return redirect('/type/all')->with('success','ลบข้อมูลเรียบร้อย');
    }

    // public function query($id){
    //     $status_notifyRepair = DB::table('transactions')
    //         ->select('*')
    //         ->where('status', 'แจ้งซ่อม')
    //         ->orderBy('id', 'DESC')
    //         ->get();

    //     $status_cancelr = DB::table('transactions')
    //         ->select('*')
    //         ->where('status', 'ยกเลิก')
    //         ->orderBy('id', 'DESC')
    //         ->get();

    //     $status_beingRepaired = DB::table('transactions')
    //         ->select('*')
    //         ->where('status', 'กำลังซ่อม')
    //         ->orderBy('id', 'DESC')
    //         ->get();

    //     $status_sussecc = DB::table('transactions')
    //         ->select('*')
    //         ->where('status', 'เรียบร้อย')
    //         ->orderBy('id', 'DESC')
    //         ->get();

    
    //     $count_status_notifyRepair = $status_notifyRepair->count();
    //     $count_status_cancelr = $status_cancelr->count();
    //     $count_status_beingRepaired = $status_beingRepaired->count();
    //     $count_status_sussecc = $status_sussecc->count();

    //     $Translation = DB::table('categories')
    //     ->select(
    //         DB::raw('transactions.id as id'),
    //         DB::raw('transactions.code as code'),
    //         DB::raw('transactions.problem as problem'),
    //         DB::raw('transactions.status as status'),
    //         DB::raw('transactions.set_at as set_at'),
    //         DB::raw('users.firstname as firstname'),
    //         DB::raw('users.lastname as lastname'),  
    //         DB::raw('equipment.name as name_equipment'),
    //         DB::raw('type_equipment.name as name_type_equipment'),
    //         DB::raw('categories.name as name_categories'),
    //     )
    //     ->join('type_equipment', 'type_equipment.category_id', '=', 'categories.id')
    //     ->join('equipment', 'equipment.type_equipment_id', '=', 'type_equipment.id')
    //     ->join('transactions', 'transactions.equipment_id', '=', 'equipment.id')
    //     ->join('users', 'users.id', '=', 'transactions.user_id')
    //     ->where('categories.id', $id)
    //     // ->groupBy('refNumber', 'machineId')
    //     // ->having('statusActive', 'Active')
    //     // ->orderBy('startDate')
    //     ->get();

    //     $count_translation = $Translation->count();
    //     $category = Category::find($id);
        
    //     return view('admin.category.query', compact('category','count_status_notifyRepair', 'count_status_cancelr', 'count_status_beingRepaired', 'count_status_sussecc', 'count_translation', 'Translation'));

    // }
}
