<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function index(){
        $departments = Department::paginate(5);
        $trashDepartments = Department::onlyTrashed()->paginate(1);
        // $departments = DB::table('departments')
        // ->join('users', 'departments.user_id', 'users.id')
        // ->select('departments.*', 'users.name')
        // ->paginate(5);
        return view('admin.department.index', compact('departments','trashDepartments'));
    }
    
    public function store(Request $request){
        $request->validate([
            'department_name'=>'required|unique:departments|max:191'
        ],
        [
            'department_name.required'=>"กรุณาป้อนชื่อแผนก",
            'department_name.max'=>"ห้ามป้อนนเกิน 191 ตัวอักษร",
            'department_name.unique'=>"มีข้มูลแผนกนี้ในฐานข้อมูลแล้ว"
        ]);

        // Eloquent
        $department = new Department;
        $department->department_name = $request->department_name;
        $department->user_id = Auth::user()->id;
        $department->save();

        // Query Builder
        // $data = array();
        // $data["department_name"] = $request->department_name;
        // $data["user_id"] = Auth::user()->id;
        // DB::table('departments')->insert($data);
        return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อย');
    }

    public function edit($id){
        $department = Department::find($id);
        return view('admin.department.edit', compact('department'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'department_name'=>'required|unique:departments|max:191'
        ],
        [
            'department_name.required'=>"กรุณาป้อนชื่อแผนก",
            'department_name.max'=>"ห้ามป้อนนเกิน 191 ตัวอักษร",
            'department_name.unique'=>"มีข้มูลแผนกนี้ในฐานข้อมูลแล้ว"
        ]);
        $update = Department::find($id)->update([
            'department_name'=>$request->department_name,
            'user_id'=>Auth::user()->id
        ]);
        return redirect()->route('department')->with('success','อัพเดดข้อมูลเรียบร้อย');
    }

    public function softdelete($id){
        $delete = Department::find($id)->delete();
        return redirect()->back()->with('success','ลบข้อมูลเรียบร้อย');
    }

    public function restore($id){
        $restore = Department::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success','กู้คืนข้อมูลเรียบร้อย');
    }

    public function delete($id){
        $delete = Department::onlyTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success','ลบถาวรข้อมูลเรียบร้อย');
    }
}
