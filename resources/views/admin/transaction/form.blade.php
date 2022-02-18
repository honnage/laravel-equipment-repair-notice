@extends('layouts.index')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <div class="d-flex justify-content-between mt-4">
                <div class=" flex-row-reverse  ">
                    @if(isset($transaction))
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
                <form action="{{isset($transaction)?"/transaction/update/$transaction->id":route('addTransaction') }}" method="post" enctype="multipart/form-data">
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

                                @if(isset($transaction))
                                <div class="col-sm-12">
                                    <input type="text" class="form-control col-sm-6"  name="" value="{{$transaction->User->id}} | {{$transaction->User->firstname}} {{$transaction->User->lastname}}" readonly>
                                    <input type="hidden" class="form-control col-sm-6"  name="user_id"  value="{{isset($transaction)?"$transaction->user_id":''}}" >
                                </div>
                                @else
                                <div class="col-sm-12">
                                    <select class="form-control" name="user_id">
                                        @if (!isset($transaction))
                                            <option value="" style="color:red;">--- กรุณาเลือกผู้แจ้งซ่อม ---  </option>
                                        @endif

                                        @foreach($user as $row)
                                            <option value="{{$row->id}}"
                                                @if(isset($transaction))
                                                    @if($transaction->user_id == $row->id)
                                                        selected
                                                    @endif
                                                @endif
                                            > {{$row->id}} | {{$row->firstname}}  {{$row->lastname}}  </option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif 
                            </div>

                            @if ( isset($transaction) )
                            <div class="row align-items-center form-group mt-4">
                                <div class="col-sm-12">
                                    <label for="set_at">วันที่กำหนดส่งคืน  </label>
                                    @error('set_at')
                                        <label>
                                            <span class="text-danger">{{$message}}</span>
                                        </label>
                                    @enderror
                                </div>
                          
                                <div class="col-sm-6 d-flex">
                                    <input type="datetime" class="form-control col-sm-12"  name="set_at" value="{{$transaction->set_at}}" readonly> &nbsp;&nbsp;&nbsp;
                                    <input type="datetime-local" class="form-control col-sm-12"  name="set_at" value="{{$transaction->set_at}}" >
                                    <input type="hidden" class="form-control col-sm-12"  name="set_at" value="{{$transaction->set_at}}" >
                                </div>
                            </div>
                            @endif

                            @if ( isset($transaction) )
                            <div class="row align-items-center form-group mt-4">
                                <div class="col-sm-12">
                                    <label for="price">ราคา (บาท)</label>
                                    @error('price')
                                        <label>
                                            <span class="text-danger">{{$message}}</span>
                                        </label>
                                    @enderror
                                </div>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control col-sm-6"  name="price" value="{{isset($transaction)?"$transaction->price":''}}" >     
                                </div>
                            </div>
                            @endif

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
                                    <input type="file" class="form-control col-sm-6"  name="fileImage" value="{{isset($transaction)?"$transaction->fileImage":''}}" >         
                                </div>
                            </div>

                            @if ( isset($transaction) )
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
                                        @if (isset($transaction))
                                            <option value="{{$transaction->status}}">{{$transaction->status}}</option>
                                            @if ($transaction->status == "แจ้งซ่อม")
                                                <option value="ยกเลิก">ยกเลิก</option>
                                                <option value="กำลังซ่อม">กำลังซ่อม</option>
                                                <option value="เรียบร้อย">เรียบร้อย</option>
                                            @elseif ($transaction->status == "ยกเลิก")
                                                <option value="แจ้งซ่อม">แจ้งซ่อม</option>
                                                <option value="กำลังซ่อม">กำลังซ่อม</option>
                                                <option value="เรียบร้อย">เรียบร้อย</option>
                                            @elseif ($transaction->status == "กำลังซ่อม")
                                                <option value="แจ้งซ่อม">แจ้งซ่อม</option>
                                                <option value="ยกเลิก">ยกเลิก</option>
                                                <option value="เรียบร้อย">เรียบร้อย</option>
                                            @elseif ($transaction->status == "เรียบร้อย")
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
                                </div>
                            </div>
                            @endif

                            @if ( isset($transaction) )
                                @if ($transaction->type_file != "pdf")
                                    @if ($transaction->fileImage != NULL)
                                        <div class="row align-items-center form-group mt-4">
                                            <div class="col-sm-12">
                                                <label for="guaranty">รูป</label>
                                                @error('fileImage')
                                                    <label>
                                                        <span class="text-danger">{{$message}}</span>
                                                    </label>
                                                @enderror
                                            </div>
                                        
                                            <img src="{{ asset($transaction->fileImage) }}" >
                                        </div>
                                    @endif
                                @else
                                <div class="row align-items-center form-group ">
                                    <div class=" align-items-start bd-highlight mt-4" >
                                        <a href="{{ asset($transaction->fileImage) }}"  class="btn btn-outline-primary mt-4">Open file PDF</a>
                                    </div>
                                </div>
                                @endif
                            @endif
                        </div>

                        <div class="col-md-4">
                            <div class="row align-items-center form-group ">
                                <div class="col-sm-12">
                                    <label for="equipment_id">รหัสครุภัณฑ์  <span style="color: red">*</span></label>
                                    @error('equipment_id')
                                        <label>
                                            <span class="text-danger">{{$message}}</span>
                                        </label>
                                    @enderror
                                </div>
                                <div class="col-sm-12">
                                    @if (isset($transaction))
                                        <input type="text" class="form-control col-sm-6"  name="" value="{{$transaction->equipment_id}} | {{$transaction->Equipment->name}} / {{$transaction->Equipment->TypeEquipment->name}} / {{$transaction->Equipment->category->name}}" readonly>
                                        <input type="hidden" class="form-control col-sm-6"  name="equipment_id" value="{{$transaction->equipment_id}} ">
                                    @else
                                        <select class="form-control" name="equipment_id">
                                            @if (!isset($transaction))
                                                <option value=" " style="color:red;">--- กรุณาเลือกครุภัณฑ์ ---  </option>
                                            @endif
                                            @foreach($equipment as $row)
                                                <option value="{{$row->id}}"
                                                    @if(isset($transaction))
                                                        @if($transaction->equipment_id == $row->id)
                                                            selected
                                                        @endif
                                                    @endif
                                                > {{$row->equipment_number}} | {{$row->name}} | </option>
                                            @endforeach
                                        </select>
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
                                    @if(isset($transaction))
                                        <input type="text" class="form-control col-sm-6"  name="problem" value="{{isset($transaction)?"$transaction->problem":''}}" readonly>
                                    @else
                                        <input type="text" class="form-control col-sm-6"  name="problem" value="{{isset($transaction)?"$transaction->problem":''}}" >
                                    @endif
                                </div>
                            </div>

                            @if ( isset($transaction) )
                            <div class="row align-items-center form-group mt-4">
                                <div class="col-sm-12">
                                    <label for="details">สาเหตุ / รายละเอียด</label>
                                    @error('details')
                                        <label>
                                            <span class="text-danger">{{$message}}</span>
                                        </label>
                                    @enderror
                                </div>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control col-sm-6"  name="details" value="{{isset($transaction)?"$transaction->details":''}}" >
                                </div>
                            </div>
                            @endif

                            @if ( isset($transaction) )
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
                                    <input type="text" class="form-control col-sm-6"  name="guaranty" value="{{isset($transaction)?"$transaction->guaranty":''}}" >
                                </div>
                            </div>
                            @endif

                            <div class="row align-items-center form-group mt-4">
                                <div class="d-flex flex-row-reverse align-items-start bd-highlight mt-4" >
                                    <input type="submit" name="submit" value="{{isset($transaction)? "แก้ไข":"เพิ่มข้อมูล"}}" class="{{isset($transaction)? "btn btn-warning col-sm-5":"btn btn-success col-sm-5"}}">
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