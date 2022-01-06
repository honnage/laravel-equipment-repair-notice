<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use App\Models\Transaction;
use App\Models\Equipment;

class TransactionController extends Controller
{
    public function index()
    {
        $Translation = Transaction::orderBy('id', 'desc')->get();
        return view('admin.transaction.index', compact('Translation'));
    }

    public function create()
    {
        $Equipment = Equipment::all();
        return view('admin.transaction.form',  compact('Equipment'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'=>'required',
            'code'=>'required|unique:transactions|max:191',
            'problem'=>'required|max:191',
            'equipment_id'=>'required',
            'status'=>'required',
            'set_at'=>'required',
        ],
        [
            'user_id.required'=>"กรุณาป้อนรหัสผู้แจ้งซ่อม",
            'code.required'=>"กรุณาป้อนรหัสแจ้งซ่อมครุภัณฑ์",
            'code.max'=>"ห้ามป้อนเกิน 191 ตัวอักษร",
            'code.unique'=>"มีข้มูลรหัสแจ้งซ่อมครุภัณฑ์นี้ในฐานข้อมูลแล้ว",
            'problem.required'=>"กรุณาป้อนอาการหรือปัญหา",
            'problem.max'=>"ห้ามป้อนเกิน 191 ตัวอักษร",
            'equipment_id.required'=>"กรุณาเลือรหัสครุภัณฑ์",
            'status.required'=>"กรุณาเลือกสถานะการซ่อม",
            'set_at.required'=>"กรุณาเลือกวันที่กำหนดส่งคืน",
        ]);

        $Transaction = new Transaction;
        $Transaction->user_id = $request->user_id;
        $Transaction->code = $request->code;
        $Transaction->problem = $request->problem;
        $Transaction->equipment_id = $request->equipment_id;
        $Transaction->details = $request->details;
        $Transaction->status = $request->status;
        $Transaction->fileImage = $request->fileImage;
        $Transaction->price = $request->price;
        $Transaction->guaranty = $request->guaranty;
        $Transaction->set_at = $request->set_at;
        $Transaction->user_id_created = Auth::user()->id;
        $Transaction->user_id_updated = Auth::user()->id;
        // dd(  $Transaction );
        $Transaction->save();
        return redirect('/transaction/all')->with('success','บันทึกข้อมูลเรียบร้อย');
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
        Transaction::find($id)->delete();
        return redirect('/transaction/all')->with('success','ลบข้อมูลเรียบร้อย');
    }
}
