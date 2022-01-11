<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\Transaction;
use App\Models\Equipment;
use PDF;


class TransactionController extends Controller
{
    public function index()
    {
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

        $Translation = Transaction::orderBy('updated_at', 'desc')->get();
        $count_translation = $Translation->count();
        $count_status_notifyRepair = $status_notifyRepair->count();
        $count_status_cancelr = $status_cancelr->count();
        $count_status_beingRepaired = $status_beingRepaired->count();
        $count_status_sussecc = $status_sussecc->count();
        return view('admin.transaction.index', 
        compact('Translation', 'count_translation',
            'status_notifyRepair', 'count_status_notifyRepair', 
            'status_cancelr', 'count_status_cancelr', 
            'status_beingRepaired', 'count_status_beingRepaired', 
            'status_sussecc', 'count_status_sussecc' ));
    }

    public function create()
    {
        $Equipment = Equipment::orderBy('id', 'DESC')->get();
        return view('admin.transaction.form',  compact('Equipment'));
    }

    public function user(){
        return view('transaction.user');
    }

    public function details($id)
    {
        $transaction = Transaction::find($id);
        return view('admin.transaction.details', compact('transaction'));
    }

    public function downloadPDF($id){
        $transaction = Transaction::find($id);
        $view = \View::make('admin.transaction.pdf', compact('transaction'));
        $html = $view->render();
        $pdf = new PDF();
        $pdf::SetTitle('ใบแจ้งซ่อม');
        $pdf::AddPage();
        $pdf::SetFont('freeserif');
        $pdf::WriteHTML($html, true, false, true, false);
        $pdf::Output('report.pdf');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'user_id' => 'required',
                'code' => 'required|unique:transactions|max:191',
                'problem' => 'required|max:191',
                'equipment_id' => 'required',
                'status' => 'required',
                'set_at' => 'required',
                'fileImage' => 'mimes:pdf,png,jpg,jpeg,pdf',
            ],
            [
                'user_id.required' => "กรุณาป้อนรหัสผู้แจ้งซ่อม",
                'code.required' => "กรุณาป้อนรหัสแจ้งซ่อมครุภัณฑ์",
                'code.max' => "ห้ามป้อนเกิน 191 ตัวอักษร",
                'code.unique' => "มีข้มูลรหัสแจ้งซ่อมครุภัณฑ์นี้ในฐานข้อมูลแล้ว",
                'problem.required' => "กรุณาป้อนอาการหรือปัญหา",
                'problem.max' => "ห้ามป้อนเกิน 191 ตัวอักษร",
                'equipment_id.required' => "กรุณาเลือรหัสครุภัณฑ์",
                'status.required' => "กรุณาเลือกสถานะการซ่อม",
                'set_at.required' => "กรุณาเลือกวันที่กำหนดส่งคืน",
                'fileImage.mimes' => "นามสกุลไฟล์ต้องเป็น pdf png jpg jpeg pdf เท่านั้น",
            ]
        );

        $Transaction = new Transaction;
        $Transaction->user_id = $request->user_id;
        $Transaction->code = $request->code;
        $Transaction->problem = $request->problem;
        $Transaction->equipment_id = $request->equipment_id;
        $Transaction->details = $request->details;
        $Transaction->status = $request->status;
        $Transaction->price = $request->price;
        $Transaction->guaranty = $request->guaranty;
        $Transaction->set_at = $request->set_at;
        $Transaction->user_id_created = Auth::user()->id;
        $Transaction->user_id_updated = Auth::user()->id;
      
        if($request->fileImage){
            $file = $request->file('fileImage'); 
            $file_gen = hexdec(uniqid()); 
            $file_ext = strtolower($file->getClientOriginalExtension()); 
            $newFile = time().'-'.$file_gen.".".$file_ext;

            $request->fileImage->move(public_path('file'),  $newFile);
            // $path = $file->storeAs('public/', $newFile);
            $Transaction->fileImage = 'file/'.$newFile;
            $Transaction->type_file = $file_ext;
        }

        $Transaction->save();
        return redirect('/transaction/all')->with('success', 'บันทึกข้อมูลเรียบร้อย');
    }

    public function edit($id)
    {
        $Transaction = Transaction::find($id);
        $Equipment = Equipment::orderBy('id', 'DESC')->get();

       
        return view('admin.transaction.form', compact('Transaction', 'Equipment'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'user_id' => 'required',
                'code' => 'required|max:191',
                'problem' => 'required|max:191',
                'equipment_id' => 'required',
                'status' => 'required',
                'set_at' => 'required',
                'fileImage' => 'mimes:pdf,png,jpg,jpeg,pdf,zip,',
            ],
            [
                'user_id.required' => "กรุณาป้อนรหัสผู้แจ้งซ่อม",
                'code.required' => "กรุณาป้อนรหัสแจ้งซ่อมครุภัณฑ์",
                'code.max' => "ห้ามป้อนเกิน 191 ตัวอักษร",
                'code.unique' => "มีข้มูลรหัสแจ้งซ่อมครุภัณฑ์นี้ในฐานข้อมูลแล้ว",
                'problem.required' => "กรุณาป้อนอาการหรือปัญหา",
                'problem.max' => "ห้ามป้อนเกิน 191 ตัวอักษร",
                'equipment_id.required' => "กรุณาเลือรหัสครุภัณฑ์",
                'status.required' => "กรุณาเลือกสถานะการซ่อม",
                'set_at.required' => "กรุณาเลือกวันที่กำหนดส่งคืน",
                'fileImage.mimes' => "นามสกุลไฟล์ต้องเป็น pdf png jpg jpeg pdf zip เท่านั้น",
            ]
        );
        $transaction = Transaction::find($id);
        if($request->fileImage){
            $file = $request->file('fileImage'); 
            $file_gen = hexdec(uniqid()); 
            $file_ext = strtolower($file->getClientOriginalExtension()); 
            $newFile = time().'-'.$file_gen.".".$file_ext;
    
            $request->fileImage->move(public_path('file'),  $newFile);
            File::delete(public_path($transaction->fileImage));
            $fileImage = 'file/'.$newFile;

            Transaction::find($id)->update([
                'user_id'=>$request->user_id,
                'code'=>$request->code,
                'problem'=>$request->problem,
                'equipment_id'=>$request->equipment_id,
                'status'=>$request->status,
                'set_at'=> $request->set_at,
    
                'details'=> $request->details,
                'guaranty'=> $request->guaranty,
                'price'=> $request->price,
    
                'fileImage'=>  $fileImage,
                'type_file'=>  $file_ext,
                'user_id_updated'=> Auth::user()->id
            ]);
        }

        Transaction::find($id)->update([
            'user_id'=>$request->user_id,
            'code'=>$request->code,
            'problem'=>$request->problem,
            'equipment_id'=>$request->equipment_id,
            'status'=>$request->status,
            'set_at'=> $request->set_at,
            'details'=> $request->details,
            'guaranty'=> $request->guaranty,
            'price'=> $request->price,
            'user_id_updated'=> Auth::user()->id
        ]);
        return redirect('/transaction/all')->with('success', 'อัพเดทข้อมูลเรียบร้อย');
    }


    public function destroy($id)
    {
        $transaction = Transaction::find($id);
        // dd($transaction->fileImage);
        File::delete(public_path($transaction->fileImage));
    
        Transaction::find($id)->delete();
        return redirect('/transaction/all')->with('success', 'ลบข้อมูลเรียบร้อย');
    }

    public function status($id)
    {
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

        $Translation = Transaction::where('status', $id)->orderBy('id', 'desc')->get();
        $count_translation = $Translation->count();
        $count_status_notifyRepair = $status_notifyRepair->count();
        $count_status_cancelr = $status_cancelr->count();
        $count_status_beingRepaired = $status_beingRepaired->count();
        $count_status_sussecc = $status_sussecc->count();
        return view('admin.transaction.query', 
        compact('Translation', 'count_translation', 'id',
            'status_notifyRepair', 'count_status_notifyRepair', 
            'status_cancelr', 'count_status_cancelr', 
            'status_beingRepaired', 'count_status_beingRepaired', 
            'status_sussecc', 'count_status_sussecc'));
    }
    
}
