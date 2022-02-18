@extends('layouts.index')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <div class="d-flex justify-content-between mt-4">
                <div class=" flex-row-reverse  ">
                    @if(isset($equipment))
                        <h1 class="text-left">แก้ไขข้อมูล ครุภัณฑ์ </h1>
                    @else
                        <h1 class="text-left">เพิ่มข้อมูล ครุภัณฑ์</h1>
                    @endif
                </div>
              
            </div>

            {{-- <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">จำนวนรายการทั้งหมด</li>
            </ol> --}}

            <br>
     
            <div class=" mb-4">
                <form action="{{isset($equipment)?"/equipment/update/$equipment->id":route('addEquipment') }}" method="post">
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
                                    @if(isset($equipment))
                                        <input type="text" class="form-control col-sm-6"  name="equipment_number" value="{{isset($equipment)?"$equipment->equipment_number":''}}"  readonly>
                                    @else
                                        <input type="text" class="form-control col-sm-6"  name="equipment_number" value="{{isset($equipment)?"$equipment->equipment_number":''}}" >
                                    @endif
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
                                    <input type="text" class="form-control col-sm-6"  name="name" value="{{isset($equipment)?"$equipment->name":''}}" >
                                </div>
                            </div>

                            <div class="row align-items-center form-group mt-4">
                                <div class="col-sm-12">
                                    <label for="purchase_date">วันที่ซื้อ </label>
                                    @error('purchase_date')
                                        <label>
                                            <span class="text-danger">{{$message}}</span>
                                        </label>
                                    @enderror
                                </div>
                                <div class="col-sm-12">
                                    <input type="date" class="form-control col-sm-6"  name="purchase_date" value="{{isset($equipment)?"$equipment->purchase_date":''}}" >
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label for="type_equipment_id">หมู่ครุภัณฑ์ <span style="color: red">*</span></label>
                                    @error('type_equipment_id')
                                        <label>
                                            <span class="text-danger">{{$message}}</span>
                                        </label>
                                    @enderror
                                </div>
                                <select class="form-control" name="type_equipment_id">
                                    @if (!isset($equipment))
                                        <option value="" style="color:red;">--- กรุณาเลือกประเภทครุภัณฑ์ --- </option>
                                    @endif

                                    @foreach($categories as $row)
                                        <option value="{{$row->id}}"
                                            @if(isset($equipment))
                                                @if($equipment->type_equipment_id == $row->id)
                                                    selected
                                                @endif
                                            @endif
                                        > {{$row->name}} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row align-items-center form-group mt-4">
                                <div class="col-sm-12">
                                    <label for="price">ราคา </label>
                                    @error('price')
                                        <label>
                                            <span class="text-danger">{{$message}}</span>
                                        </label>
                                    @enderror
                                </div>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control col-sm-6" required name="price" min="0" value="{{isset($equipment)?"$equipment->price":''}}" step="0.01" title="Currency" 
                                        pattern="^\d+(?:\.\d{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?'inherit':''">
                                </div>
                            </div>

                            <div class="row align-items-center form-group mt-4">
                                <div class="col-sm-12">
                                    <label for="insurance">อายุประกัน </label>
                                    @error('insurance')
                                        <label>
                                            <span class="text-danger">{{$message}}</span>
                                        </label>
                                    @enderror
                                </div>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control col-sm-6"  name="insurance" value="{{isset($equipment)?"$equipment->insurance":''}}" >
                                </div>
                            </div>

                          
                        </div>

                        <div class="col-md-4">
                        </div>

                    </div>
                    <div class="col-md-8 d-flex flex-row-reverse bd-highlight mt-4">
                        <input type="submit" name="submit" value="{{isset($equipment)? "แก้ไข":"เพิ่มข้อมูล"}}" class="{{isset($equipment)? "btn btn-warning col-sm-2":"btn btn-success col-sm-2"}}">
                        &nbsp;&nbsp;
                        <button class="btn btn-secondary col-sm-2" type="reset">ยกเลิก</button>      
                    </div>
                </form>
            </div>
          
        </div>
    </main>
    

@endsection