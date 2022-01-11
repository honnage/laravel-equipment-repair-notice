@extends('layouts.index')
@section('content')
    <main>
        <div class="container-fluid px-4">
           
            <div class="d-flex justify-content-between mt-4">
                <div class=" flex-row-reverse">
                    @if(isset($typeEquipment))
                        <h1 class="text-left">แก้ไขข้อมูล ประเภทครุภัณฑ์ </h1>
                    @else
                        <h1 class="text-left">เพิ่มข้อมูล ประเภทครุภัณฑ์</h1>
                    @endif
                </div>
            </div>

            {{-- <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">จำนวนรายการทั้งหมด</li>
            </ol> --}}

            <br>
       
            <div class=" mb-4">
                <form action="{{isset($typeEquipment)?"/type/update/$typeEquipment->id":route('addType') }}" method="post">
                    {{csrf_field()}}
                    <div class="row">
                        
                        <div class="col-md-6"> {{-- left  --}}
                            <div class="row align-items-center form-group ">
                                <div class="col-sm-12">
                                    <label for="name">ประเภทครุภัณฑ์ <span style="color: red">*</span></label>
                                    @error('name')
                                        <label>
                                            <span class="text-danger">{{$message}}</span>
                                        </label>
                                    @enderror
                                </div>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control col-sm-6"  name="name" value="{{isset($typeEquipment)?"$typeEquipment->name":''}}" >
                                </div>
                            </div>

                            <div class="form-group my-4">
                                <div class="col-sm-12">
                                    <label for="category_id">หมวดหมู่ <span style="color: red">*</span></label>
                                    @error('category_id')
                                        <label>
                                            <span class="text-danger">{{$message}}</span>
                                        </label>
                                    @enderror
                                </div>
                                <select class="form-control" name="category_id">
                                    @if (!isset($typeEquipment))
                                        <option value="" style="color:red;">--- กรุณาเลือกหมวดหมู่ --- </option>
                                    @endif

                                    @foreach($categories as $row)
                                        <option value="{{$row->id}}"
                                            @if(isset($typeEquipment))
                                                @if($typeEquipment->category_id == $row->id)
                                                    selected
                                                @endif
                                            @endif
                                        >{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>
                    <div class="col-md-6 d-flex flex-row-reverse bd-highlight mt-4">
                        <input type="submit" name="submit" value="{{isset($typeEquipment)? "แก้ไข":"เพิ่มข้อมูล"}}" class="{{isset($typeEquipment)? "btn btn-warning col-sm-2":"btn btn-success col-sm-2"}}">
                        &nbsp;&nbsp;
                        <button class="btn btn-secondary col-sm-2" type="reset">ยกเลิก</button>      
                    </div>
                </form>
            </div>
          
        </div>
    </main>
    

@endsection