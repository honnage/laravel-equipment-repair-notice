@extends('layouts.index')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <div class="d-flex justify-content-between mt-4">
                <div class=" flex-row-reverse  ">
                    <h1 class="text-left">เพิ่มข้อมูล ครุภัณฑ์</h1>
                </div>
              
            </div>

            {{-- <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">จำนวนรายการทั้งหมด</li>
            </ol> --}}

            <br>
     
            <div class=" mb-4">
                <form action="{{isset($Category)?"/category/update/$Category->id":route('addEquipment') }}" method="post">
                    {{csrf_field()}}
                    <div class="row">
                        
                        <div class="col-md-4"> {{-- left  --}}
                            <div class="row align-items-center form-group ">
                                <div class="col-sm-12">
                                    <label for="equipment_number">หมายเลขครุภัณฑ์ <span style="color: red">*</span></label>
                                    @error('equipment_number')
                                        <label>
                                            <span class="text-danger">{{$message}}</span>
                                        </label>
                                    @enderror
                                </div>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control col-sm-6"  name="equipment_number" value="{{isset($Category)?"$Category->equipment_number":''}}" >
                                </div>
                            </div>

                            <div class="row align-items-center form-group mt-4">
                                <div class="col-sm-12">
                                    <label for="name">ชื่อครุภัณฑ์ <span style="color: red">*</span></label>
                                    @error('name')
                                        <label>
                                            <span class="text-danger">{{$message}}</span>
                                        </label>
                                    @enderror
                                </div>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control col-sm-6"  name="name" value="{{isset($Category)?"$Category->name":''}}" >
                                </div>
                            </div>

                            <div class="row align-items-center form-group mt-4">
                                <div class="col-sm-12">
                                    <label for="purchase_date">วันที่ซื้อ <span style="color: red">*</span></label>
                                    @error('purchase_date')
                                        <label>
                                            <span class="text-danger">{{$message}}</span>
                                        </label>
                                    @enderror
                                </div>
                                <div class="col-sm-12">
                                    <input type="date" class="form-control col-sm-6"  name="purchase_date" value="{{isset($Category)?"$Category->purchase_date":''}}" >
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label for="type_equipment_id">ประเภทครุภัณฑ์ <span style="color: red">*</span></label>
                                    @error('type_equipment_id')
                                        <label>
                                            <span class="text-danger">{{$message}}</span>
                                        </label>
                                    @enderror
                                </div>
                                <select class="form-control" name="type_equipment_id">
                                    @if (!isset($TypeEquipment))
                                        <option value="" style="color:red;">--- กรุณาเลือกประเภทครุภัณฑ์ --- </option>
                                    @endif

                                    @foreach($typeEquipment as $row)
                                        <option value="{{$row->id}}"
                                            @if(isset($TypeEquipment))
                                                @if($TypeEquipment->category_id == $TypeEquipment->category_id)
                                                    selected
                                                @endif
                                            @endif
                                        >{{$row->category->name}} | {{$row->name}} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row align-items-center form-group mt-4">
                                <div class="col-sm-12">
                                    <label for="price">ราคา <span style="color: red">*</span></label>
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

                            <div class="row align-items-center form-group mt-4">
                                <div class="col-sm-12">
                                    <label for="insurance">อายุประกัน <span style="color: red">*</span></label>
                                    @error('insurance')
                                        <label>
                                            <span class="text-danger">{{$message}}</span>
                                        </label>
                                    @enderror
                                </div>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control col-sm-6"  name="insurance" value="{{isset($Category)?"$Category->insurance":''}}" >
                                </div>
                            </div>

                          
                        </div>

                        <div class="col-md-4">
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