@extends('layouts.index')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <div class="d-flex justify-content-between mt-4">
                <div class=" flex-row-reverse  ">
                    <h1 class="text-left">เพิ่มข้อมูล แจ้งซ่อมครุภัณฑ์ </h1>
                </div>
            </div>

            {{-- <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">จำนวนรายการทั้งหมด</li>
            </ol> --}}

            <br>
            <div class=" mb-4">
                <form action="{{isset($Category)?"/category/update/$Category->id":route('addTransaction') }}" method="post">
                    {{csrf_field()}}
                    <div class="row">
                        
                        <div class="col-md-4"> {{-- left  --}}
                            <div class="row align-items-center form-group ">
                                <div class="col-sm-12">
                                    <label for="user_id">รหัสผู้แจ้งซ่อม <span style="color: red">*</span></label>
                                    @error('user_id')
                                        <label>
                                            <span class="text-danger">{{$message}}</span>
                                        </label>
                                    @enderror
                                </div>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control col-sm-6"  name="user_id" value="{{isset($Category)?"$Category->user_id":''}}" >
                                </div>
                            </div>

                            <div class="row align-items-center form-group mt-4">
                                <div class="col-sm-12">
                                    <label for="problem">อาการหรือปัญหา <span style="color: red">*</span></label>
                                    @error('problem')
                                        <label>
                                            <span class="text-danger">{{$message}}</span>
                                        </label>
                                    @enderror
                                </div>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control col-sm-6"  name="problem" value="{{isset($Category)?"$Category->problem":''}}" >
                                </div>
                            </div>

                            <div class="row align-items-center form-group mt-4">
                                <div class="col-sm-12">
                                    <label for="set_at">วันที่กำหนดส่งคืน <span style="color: red">*</span></label>
                                    @error('set_at')
                                        <label>
                                            <span class="text-danger">{{$message}}</span>
                                        </label>
                                    @enderror
                                </div>
                                <div class="col-sm-12">
                                    <input type="date" class="form-control col-sm-6"  name="set_at" value="{{isset($Category)?"$Category->set_at":''}}" >          
                                </div>
                            </div>

                            <div class="row align-items-center form-group mt-4">
                                <div class="col-sm-12">
                                    <label for="fileImage">ไฟล์</label>
                                    @error('fileImage')
                                        <label>
                                            <span class="text-danger">{{$message}}</span>
                                        </label>
                                    @enderror
                                </div>
                                <div class="col-sm-12">
                                    <input type="file" class="form-control col-sm-6"  name="fileImage" value="{{isset($Category)?"$Category->fileImage":''}}" >         
                                </div>
                            </div>

                            <div class="row align-items-center form-group mt-4">
                                <div class="col-sm-12">
                                    <label for="guaranty">ประกัน</label>
                                    @error('guaranty')
                                        <label>
                                            <span class="text-danger">{{$message}}</span>
                                        </label>
                                    @enderror
                                </div>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control col-sm-6"  name="guaranty" value="{{isset($Category)?"$Category->guaranty":''}}" >
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="row align-items-center form-group ">
                                <div class="col-sm-12">
                                    <label for="code">รหัสการแจ้งซ่อม <span style="color: red">*</span></label>
                                    @error('code')
                                        <label>
                                            <span class="text-danger">{{$message}}</span>
                                        </label>
                                    @enderror
                                </div>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control col-sm-6"  name="code" value="{{isset($Category)?"$Category->code":''}}" >
                                </div>
                            </div>

                            <div class="row align-items-center form-group mt-4">
                                <div class="col-sm-12">
                                    <label for="equipment_id">รหัสครุภัณฑ์ <span style="color: red">*</span></label>
                                    @error('equipment_id')
                                        <label>
                                            <span class="text-danger">{{$message}}</span>
                                        </label>
                                    @enderror
                                </div>
                                <div class="col-sm-12">
                                    <select class="form-control" name="equipment_id">
                                        @if (isset($Equipment))
                                            <option value="" style="color:red;">--- กรุณาเลือกหมวดหมู่ --- </option>
                                        @endif
    
                                        @foreach($Equipment as $row)
                                            <option value="{{$row->id}}"
                                                {{-- @if(isset($TypeEquipment))
                                                    @if($TypeEquipment->category_id == $row->id)
                                                        selected
                                                    @endif
                                                @endif --}}
                                            >{{$row->name}} / {{$row->TypeEquipment->name}} - {{$row->TypeEquipment->category->name}} </option>
                                        @endforeach
                                    </select>
                                    {{-- <input type="text" class="form-control col-sm-6"  name="equipment_id" value="{{isset($Category)?"$Category->equipment_id":''}}" > --}}
                                </div>
                            </div>

                            <div class="row align-items-center form-group mt-4">
                                <div class="col-sm-12">
                                    <label for="status">สถานะ <span style="color: red">*</span></label>
                                    @error('status')
                                        <label>
                                            <span class="text-danger">{{$message}}</span>
                                        </label>
                                    @enderror
                                </div>
                                <div class="col-sm-12">
                                    <select class="form-control"  name="status">
                                        <option value="แจ้งซ่อม">แจ้งซ่อม</option>
                                        <option value="ยกเลิก">ยกเลิก</option>
                                        <option value="กำลังซ่อม">กำลังซ่อม</option>
                                        <option value="เรียบร้อย">เรียบร้อย</option>
                                      </select>
                                    {{-- <input type="text" class="form-control col-sm-6"  name="status" value="{{isset($Category)?"$Category->status":''}}" > --}}
                                </div>
                            </div>

                            <div class="row align-items-center form-group mt-4">
                                <div class="col-sm-12">
                                    <label for="details">รายละเอียด <span style="color: red">*</span></label>
                                    @error('details')
                                        <label>
                                            <span class="text-danger">{{$message}}</span>
                                        </label>
                                    @enderror
                                </div>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control col-sm-6"  name="details" value="{{isset($Category)?"$Category->details":''}}" >
                                </div>
                            </div>

                            <div class="row align-items-center form-group mt-4">
                                <div class="col-sm-12">
                                    <label for="price">ราคา</label>
                                    @error('price')
                                        <label>
                                            <span class="text-danger">{{$message}}</span>
                                        </label>
                                    @enderror
                                </div>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control col-sm-6"  name="price" value="{{isset($Category)?"$Category->price":''}}" >     
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 d-flex flex-row-reverse bd-highlight mt-4">
                        <input type="submit" name="submit" value="{{isset($Category)? "แก้ไข":"เพิ่มข้อมูล"}}" class="{{isset($Category)? "btn btn-warning col-sm-2":"btn btn-success col-sm-2"}}">
                        &nbsp;&nbsp;
                        <button class="btn btn-secondary col-sm-1" type="reset">ยกเลิก</button>      
                    </div>
                </form>
            </div>
          
        </div>
    </main>
    

@endsection