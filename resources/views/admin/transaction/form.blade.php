@extends('layouts.index')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <div class="d-flex justify-content-between mt-4">
                <div class=" flex-row-reverse  ">
                    @if(isset($Transaction))
                        <h1 class="text-left">แก้ไขข้อมูล แจ้งซ่อมครุภัณฑ์ </h1>
                    @else
                        <h1 class="text-left">เพิ่มข้อมูล แจ้งซ่อมครุภัณฑ์ </h1>
                    @endif
                </div>
            </div>

            {{-- <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">จำนวนรายการทั้งหมด</li>
            </ol> --}}

            <br>
            <div class=" mb-4">
                <form action="{{isset($Transaction)?"/transaction/update/$Transaction->id":route('addTransaction') }}" method="post" enctype="multipart/form-data">
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
                                    @if(isset($Transaction))
                                        <input type="text" class="form-control col-sm-6"  name="" value="{{$Transaction->user_id}} | {{$Transaction->User->firstname}} {{$Transaction->User->lastname}}" readonly>
                                        <input type="hidden" class="form-control col-sm-6"  name="user_id"  value="{{isset($Transaction)?"$Transaction->user_id":''}}" >
                                    @else
                                        <input type="text" class="form-control col-sm-6"  name="user_id" value="{{isset($Transaction)?"$Transaction->user_id":''}}" >
                                    @endif
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
                                    <input type="text" class="form-control col-sm-6"  name="problem" value="{{isset($Transaction)?"$Transaction->problem":''}}" >
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
                                    <input type="date" class="form-control col-sm-6"  name="set_at" value="{{isset($Transaction)?"$Transaction->set_at":''}}" >          
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
                                    <input type="number" class="form-control col-sm-6"  name="price" value="{{isset($Transaction)?"$Transaction->price":''}}" >     
                                </div>
                            </div>

                            <div class="row align-items-center form-group mt-4">
                                <div class="col-sm-12">
                                    <label for="fileImage">ไฟล์ </label>
                                    @error('fileImage')
                                        <label>
                                            <span class="text-danger">{{$message}}</span>
                                        </label>
                                    @enderror
                                </div>
                                <div class="col-sm-12">
                                    <input type="file" class="form-control col-sm-6"  name="fileImage" value="{{isset($Transaction)?"$Transaction->fileImage":''}}" >         
                                </div>
                            </div>

                            @if ( isset($Transaction) )
                                @if ($Transaction->fileImage != NULL)
                                    <div class="row align-items-center form-group mt-4">
                                        <div class="col-sm-12">
                                            <label for="guaranty">รูป</label>
                                            @error('fileImage')
                                                <label>
                                                    <span class="text-danger">{{$message}}</span>
                                                </label>
                                            @enderror
                                        </div>
                                    
                                        <img src="{{ asset($Transaction->fileImage) }}" >
                                    </div>
                                @endif
                            @endif
                           
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
                                    @if(isset($Transaction))
                                        <input type="text" class="form-control col-sm-6"  name="code" value="{{isset($Transaction)?"$Transaction->code":''}}" readonly>
                                    @else
                                        <input type="text" class="form-control col-sm-6"  name="code" value="{{isset($Transaction)?"$Transaction->code":''}}" >
                                    @endif
                                </div>
                            </div>

                            <div class="row align-items-center form-group mt-4">
                                <div class="col-sm-12">
                                    <label for="equipment_id">รหัสครุภัณฑ์  <span style="color: red">*</span></label>
                                    @error('equipment_id')
                                        <label>
                                            <span class="text-danger">{{$message}}</span>
                                        </label>
                                    @enderror
                                </div>
                                <div class="col-sm-12">
                                    <select class="form-control" name="equipment_id">
                                        @if (!isset($Transaction))
                                            <option value="" style="color:red;">--- กรุณาเลือกครุภัณฑ์ ---  </option>
                                        @endif

                                        @foreach($Equipment as $row)
                                            <option value="{{$row->id}}"
                                                @if(isset($Transaction))
                                                    @if($Transaction->equipment_id == $row->id)
                                                        selected
                                                    @endif
                                                @endif
                                            > {{$row->equipment_number}} | {{$row->name}} | {{$row->TypeEquipment->name}} / {{$row->TypeEquipment->category->name}} </option>
                                        @endforeach
                                    </select>
                                    {{-- <input type="text" class="form-control col-sm-6"  name="equipment_id" value="{{isset($Transaction)?"$Transaction->equipment_id":''}}" > --}}
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
                                        @if (isset($Transaction))
                                            <option value="{{$Transaction->status}}">{{$Transaction->status}}</option>
                                            @if ($Transaction->status == "แจ้งซ่อม")
                                                <option value="ยกเลิก">ยกเลิก</option>
                                                <option value="กำลังซ่อม">กำลังซ่อม</option>
                                                <option value="เรียบร้อย">เรียบร้อย</option>
                                            @elseif ($Transaction->status == "ยกเลิก")
                                                <option value="แจ้งซ่อม">แจ้งซ่อม</option>
                                                <option value="กำลังซ่อม">กำลังซ่อม</option>
                                                <option value="เรียบร้อย">เรียบร้อย</option>
                                            @elseif ($Transaction->status == "กำลังซ่อม")
                                                <option value="แจ้งซ่อม">แจ้งซ่อม</option>
                                                <option value="ยกเลิก">ยกเลิก</option>
                                                <option value="เรียบร้อย">เรียบร้อย</option>
                                            @elseif ($Transaction->status == "เรียบร้อย")
                                                <option value="แจ้งซ่อม">แจ้งซ่อม</option>
                                                <option value="ยกเลิก">ยกเลิก</option>
                                                <option value="กำลังซ่อม">กำลังซ่อม</option>
                                            @endif
                                        @else
                                            <option value="แจ้งซ่อม">แจ้งซ่อม</option>
                                            <option value="กำลังซ่อม">กำลังซ่อม</option>
                                            <option value="ยกเลิก">ยกเลิก</option>
                                            <option value="เรียบร้อย">เรียบร้อย</option>
                                        @endif
                                    </select>
                                    {{-- <input type="text" class="form-control col-sm-6"  name="status" value="{{isset($Category)?"$Category->status":''}}" > --}}
                                </div>
                            </div>

                            <div class="row align-items-center form-group mt-4">
                                <div class="col-sm-12">
                                    <label for="details">รายละเอียด</label>
                                    @error('details')
                                        <label>
                                            <span class="text-danger">{{$message}}</span>
                                        </label>
                                    @enderror
                                </div>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control col-sm-6"  name="details" value="{{isset($Transaction)?"$Transaction->details":''}}" >
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
                                    <input type="text" class="form-control col-sm-6"  name="guaranty" value="{{isset($Transaction)?"$Transaction->guaranty":''}}" >
                                </div>
                            </div>

                            <div class="row align-items-center form-group mt-4">
                                <div class="d-flex flex-row-reverse align-items-start bd-highlight mt-4" >
                                    <input type="submit" name="submit" value="{{isset($Transaction)? "แก้ไข":"เพิ่มข้อมูล"}}" class="{{isset($Transaction)? "btn btn-warning col-sm-5":"btn btn-success col-sm-5"}}">
                                    &nbsp;&nbsp;
                                    <button class="btn btn-secondary col-sm-3" type="reset">ยกเลิก</button>      
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </form>
            </div>
          
        </div>
    </main>
    

@endsection