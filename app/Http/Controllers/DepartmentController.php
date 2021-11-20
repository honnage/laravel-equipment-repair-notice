<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function index(){
        // $departments = Department::paginate(3);
        $departments = DB::table('departments')
        ->join('users', 'departments.user_id', 'users.id')
        ->select('departments.*', 'users.name')
        ->paginate(2);
        return view('admin.department.index', compact('departments'));
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
}
