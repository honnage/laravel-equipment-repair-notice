@extends('layouts.index')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <div class="d-flex justify-content-between mt-4">
                <div class=" flex-row-reverse  ">
                    @if(isset($Category))
                        <h1 class="text-left">แก้ไขข้อมูล หมวดหมู่ครุภัณฑ์ </h1>
                    @else
                        <h1 class="text-left">เพิ่มข้อมูล หมวดหมู่ครุภัณฑ์</h1>
                    @endif
                </div>
            </div>

            {{-- <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">จำนวนรายการทั้งหมด</li>
            </ol> --}}

            <br>
            <div class=" mb-4">
                <form action="{{isset($Category)?"/category/update/$Category->id":route('addCategory') }}" method="post">
                    {{csrf_field()}}
                    <div class="row">
                        
                        <div class="col-md-6"> {{-- left  --}}
                            <div class="row align-items-center form-group ">
                                <div class="col-sm-12">
                                    <label for="name">หมวดหมู่ครุภัณฑ์ <span style="color: red">*</span></label>
                                    @error('name')
                                        <label>
                                            <span class="text-danger">{{$message}}</span>
                                        </label>
                                    @enderror
                                </div>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control col-sm-6"  name="name" value="{{isset($Category)?"$Category->name":''}}" >

                                    <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id }}">
            
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>
                    <div class="col-md-6 d-flex flex-row-reverse bd-highlight mt-4">
                        <input type="submit" name="submit" value="{{isset($Category)? "แก้ไข":"เพิ่มข้อมูล"}}" class="{{isset($Category)? "btn btn-warning col-sm-2":"btn btn-success col-sm-2"}}">
                        &nbsp;&nbsp;
                        <button class="btn btn-secondary col-sm-2" type="reset">ยกเลิก</button>      
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection