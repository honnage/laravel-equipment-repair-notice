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
        // $categories = Category::paginate(10);
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
        if($category->TypeEquipment->count() > 0){
            Session()->flash('error','ไม่สามารถลบได้เนื่องจากมีหมวดหมู่ครุภัณฑ์นี้ใช้งานอยู่');
            return redirect()->back();
        }
        Category::find($id)->delete();
        return redirect('/category/all')->with('success','ลบข้อมูลเรียบร้อย');
    }

    public function query($id){
        $status_notifyRepair = DB::table('transactions')
            ->select('*')
            ->where('status', 'แจ้งซ่อม')
            ->orderBy('id', 'DESC')
            ->get();

        $status_cancelr = DB::table('transactions')
            ->select('*')
            ->where('status', 'ยกเลิก')
            ->orderBy('id', 'DESC')
            ->get();

        $status_beingRepaired = DB::table('transactions')
            ->select('*')
            ->where('status', 'กำลังซ่อม')
            ->orderBy('id', 'DESC')
            ->get();

        $status_sussecc = DB::table('transactions')
            ->select('*')
            ->where('status', 'เรียบร้อย')
            ->orderBy('id', 'DESC')
            ->get();

    
        $count_status_notifyRepair = $status_notifyRepair->count();
        $count_status_cancelr = $status_cancelr->count();
        $count_status_beingRepaired = $status_beingRepaired->count();
        $count_status_sussecc = $status_sussecc->count();

        $Translation = DB::table('categories')
        ->select(
            DB::raw('transactions.id as id'),
            DB::raw('transactions.code as code'),
            DB::raw('transactions.problem as problem'),
            DB::raw('transactions.status as status'),
            DB::raw('transactions.set_at as set_at'),
            DB::raw('users.firstname as firstname'),
            DB::raw('users.lastname as lastname'),  
            DB::raw('equipment.name as name_equipment'),
            DB::raw('type_equipment.name as name_type_equipment'),
            DB::raw('categories.name as name_categories'),
        )
        ->join('type_equipment', 'type_equipment.category_id', '=', 'categories.id')
        ->join('equipment', 'equipment.type_equipment_id', '=', 'type_equipment.id')
        ->join('transactions', 'transactions.equipment_id', '=', 'equipment.id')
        ->join('users', 'users.id', '=', 'transactions.user_id')
        ->where('categories.id', $id)
        // ->groupBy('refNumber', 'machineId')
        // ->having('statusActive', 'Active')
        // ->orderBy('startDate')
        ->get();

        $count_translation = $Translation->count();
        $category = Category::find($id);
        
        return view('admin.transaction.query', compact('category','count_status_notifyRepair', 'count_status_cancelr', 'count_status_beingRepaired', 'count_status_sussecc', 'count_translation', 'Translation'));

    }

    
}
