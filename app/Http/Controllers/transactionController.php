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
use App\Models\User;
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

        $transaction = Transaction::orderBy('updated_at', 'desc')->get();
        $count_translation = $transaction->count();
        $count_status_notifyRepair = $status_notifyRepair->count();
        $count_status_cancelr = $status_cancelr->count();
        $count_status_beingRepaired = $status_beingRepaired->count();
        $count_status_sussecc = $status_sussecc->count();
        return view('admin.transaction.index', 
        compact('transaction', 'count_translation',
            'status_notifyRepair', 'count_status_notifyRepair', 
            'status_cancelr', 'count_status_cancelr', 
            'status_beingRepaired', 'count_status_beingRepaired', 
            'status_sussecc', 'count_status_sussecc' ));
    }

    public function createByAdmin()
    {
        $equipment = Equipment::orderBy('id', 'DESC')->get();
        $user = User::orderBy('id', 'DESC')->get();
        return view('admin.transaction.form',  compact('equipment','user'));
    }

    public function create()
    {
        $equipment = Equipment::orderBy('id', 'DESC')->get();
        return view('transaction.form',  compact('equipment'));
    }

    public function user(){
        $status_notifyRepair = DB::table('transactions')
            ->select('*')
            ->where('user_id',  Auth::user()->id)
            ->where('status', 'แจ้งซ่อม')
            ->orderBy('id', 'DESC')
            ->get();

        $status_cancelr = DB::table('transactions')
            ->select('*')
            ->where('user_id',  Auth::user()->id)
            ->where('status', 'ยกเลิก')
            ->orderBy('id', 'DESC')
            ->get();

        $status_beingRepaired = DB::table('transactions')
            ->select('*')
            ->where('user_id',  Auth::user()->id)
            ->where('status', 'กำลังซ่อม')
            ->orderBy('id', 'DESC')
            ->get();

        $status_sussecc = DB::table('transactions')
            ->select('*')
            ->where('user_id',  Auth::user()->id)
            ->where('status', 'เรียบร้อย')
            ->orderBy('id', 'DESC')
            ->get();

        $transaction = Transaction::where('user_id', Auth::user()->id)->orderBy('updated_at', 'desc')->get();
        $count_translation = $transaction->count();
        $count_status_notifyRepair = $status_notifyRepair->count();
        $count_status_cancelr = $status_cancelr->count();
        $count_status_beingRepaired = $status_beingRepaired->count();
        $count_status_sussecc = $status_sussecc->count();
        
        return view('transaction.user',
        compact('transaction', 'count_translation',
            'status_notifyRepair', 'count_status_notifyRepair', 
            'status_cancelr', 'count_status_cancelr', 
            'status_beingRepaired', 'count_status_beingRepaired', 
            'status_sussecc', 'count_status_sussecc' ));
    }
    
    public function userDetail($id)
    {
        $transaction = Transaction::find($id);
        return view('transaction.details', compact('transaction'));
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
                'problem' => 'required|max:191',
                'equipment_id' => 'required',
                'fileImage' => 'mimes:pdf,png,jpg,jpeg,pdf',
            ],
            [
                'user_id.required' => "กรุณาป้อนรหัสผู้แจ้งซ่อม",
                'problem.required' => "กรุณาป้อนอาการหรือปัญหา",
                'problem.max' => "ห้ามป้อนเกิน 191 ตัวอักษร",
                'equipment_id.required' => "กรุณาเลือรหัสครุภัณฑ์",
                'fileImage.mimes' => "นามสกุลไฟล์ต้องเป็น pdf png jpg jpeg pdf เท่านั้น",
            ]
        );

        $transaction = new Transaction;
        $transaction->user_id = $request->user_id;
        $transaction->problem = $request->problem;
        $transaction->equipment_id = $request->equipment_id;
        $transaction->details = $request->details;
        $transaction->status = "แจ้งซ่อม";
        $transaction->price = $request->price;
        $transaction->guaranty = $request->guaranty;
        $transaction->set_at = Carbon::now()->addDays(7);
        $transaction->user_id_created = Auth::user()->id;
        $transaction->user_id_updated = Auth::user()->id;
      
        if($request->fileImage){
            $file = $request->file('fileImage'); 
            $file_gen = hexdec(uniqid()); 
            $file_ext = strtolower($file->getClientOriginalExtension()); 
            $newFile = time().'-'.$file_gen.".".$file_ext;

            $request->fileImage->move(public_path('file'),  $newFile);
            $transaction->fileImage = 'file/'.$newFile;
            $transaction->type_file = $file_ext;
        }
        // dd( $transaction);
        $transaction->save();

         if( Auth::user()->id == 1 || Auth::user()->status != 0 ){
            return redirect('/transaction/all')->with('success', 'บันทึกข้อมูลเรียบร้อย');
         }else{
            return redirect('/dashboard')->with('success', 'บันทึกข้อมูลเรียบร้อย');
         }
    }

    public function editByAdmin($id)
    {
        $transaction = Transaction::find($id);
        $user = User::orderBy('id', 'DESC')->get();
        $equipment = Equipment::orderBy('id', 'DESC')->get();
        return view('admin.transaction.form', compact('transaction', 'equipment', 'user'));
    }

    public function edit($id)
    {
        $transaction = Transaction::find($id);
        $equipment = Equipment::orderBy('id', 'DESC')->get();
        return view('transaction.form', compact('transaction', 'equipment'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'user_id' => 'required',
                'problem' => 'required|max:191',
                'fileImage' => 'mimes:pdf,png,jpg,jpeg,pdf,zip,',
            ],
            [
                'user_id.required' => "กรุณาป้อนรหัสผู้แจ้งซ่อม",
                'problem.required' => "กรุณาป้อนอาการหรือปัญหา",
                'problem.max' => "ห้ามป้อนเกิน 191 ตัวอักษร",
                'fileImage.mimes' => "นามสกุลไฟล์ต้องเป็น pdf png jpg jpeg pdf zip เท่านั้น",
            ]
        );
        // dd($request->all());
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

        $transaction = Transaction::where('status', $id)->orderBy('id', 'desc')->get();
        $count_translation = $transaction->count();
        $count_status_notifyRepair = $status_notifyRepair->count();
        $count_status_cancelr = $status_cancelr->count();
        $count_status_beingRepaired = $status_beingRepaired->count();
        $count_status_sussecc = $status_sussecc->count();
        return view('admin.transaction.query', 
        compact('transaction', 'count_translation', 'id',
            'status_notifyRepair', 'count_status_notifyRepair', 
            'status_cancelr', 'count_status_cancelr', 
            'status_beingRepaired', 'count_status_beingRepaired', 
            'status_sussecc', 'count_status_sussecc'));
    }
    
}
