@extends('layouts.index')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <div class="d-flex justify-content-between mt-4">
                <div class=" flex-row-reverse  ">
                    <h1 class="text-left">ข้อมูล พนักงาน</h1>
                </div>
              
            </div>

            {{-- <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">จำนวนรายการทั้งหมด</li>
            </ol> --}}

            <br>
     
            <div class=" mb-4">
                <form action="{{isset($User)?"/user/update/$User->id":route('addEquipment') }}" method="post">
                    {{csrf_field()}}
                    <div class="row">
                        
                        <div class="col-md-4"> {{-- left  --}}
                            <div class="row align-items-center form-group ">
                                <div class="col-sm-12">
                                    <label for="id">รหัส</label>
                                </div>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control col-sm-6"  name="id" value="{{$User->id}}" readonly>
                                </div>
                            </div>

                            <div class="row align-items-center form-group mt-4">
                                <div class="col-sm-12">
                                    <label for="firstname">ชื่อจริง</label>
                                </div>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control col-sm-6"  name="firstname" value="{{$User->firstname}}" >
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12 mt-4">
                                    <label for="gender">เพศ</label>
                                </div>
                                <select class="form-control" name="gender">
                                    @if($User->gender == "ชาย")
                                        <option value="ชาย">ชาย</option>
                                        <option value="หญิง">หญิง</option>
                                    @else
                                        <option value="หญิง">หญิง</option>
                                        <option value="ชาย">ชาย</option>
                                    @endif
                                </select>
                            </div>

                         
                            <div class="row align-items-center form-group mt-4">
                                <div class="col-sm-12">
                                    <label for="phone">เบอร์โทร</label>
                                </div>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control col-sm-6"  name="phone" value="{{$User->phone}}" >
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="row align-items-center form-group ">
                                <div class="col-sm-12">
                                    <label for="email">อีเมล</label>
                                </div>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control col-sm-6"  name="email" value="{{$User->email}}" readonly>
                                </div>
                            </div>

                            <div class="row align-items-center form-group mt-4">
                                <div class="col-sm-12">
                                    <label for="lastname">นามสกุล</label>
                                </div>
                                <div class="col-sm-12">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control col-sm-6"  name="lastname" value="{{$User->lastname}}" >
                                    </div>
                                </div>
                            </div>

                            <div class="row align-items-center form-group mt-4">
                                <div class="col-sm-12">
                                    <label for="department">ตำแหน่ง</label>
                                </div>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control col-sm-6"  name="department" value="{{$User->department}}" >
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12 mt-4">
                                    <label for="status">สถานะ</label>
                                </div>
                                <select class="form-control" name="status">
                                    @if($User->status == 1 ||  $User->id == 1)
                                        <option value="1">Admin </option>
                                    @else
                                        <option value="0">Employee </option>
                                    @endif

                                    @if($User->status == 1 ||  $User->id == 1)
                                        <option value="0">Employee </option>
                                    @else
                                        <option value="1">Admin </option>
                                        
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="row align-items-center form-group col-md-8 mt-4">
                            <div class="col-sm-12">
                                <label for="address">ที่อยู่</label>
                            </div>
                            <div class="col-sm-12">
                                <input type="text" class="form-control col-sm-6"  name="address" value="{{$User->address}}" >
                            </div>
                        </div>

                        <div class="col-md-4">
                        </div>

                    </div>
                    <div class="col-md-8 d-flex flex-row-reverse bd-highlight mt-4">
                        <input type="submit" name="submit" value="{{isset($User)? "แก้ไข":"เพิ่มข้อมูล"}}" class="{{isset($User)? "btn btn-warning col-sm-2":"btn btn-success col-sm-2"}}">
                        &nbsp;&nbsp;
                        <button class="btn btn-secondary col-sm-1" type="reset">ยกเลิก</button>      
                    </div>
                </form>
            </div>
          
        </div>
    </main>
    

@endsection