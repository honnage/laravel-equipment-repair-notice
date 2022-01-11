<x-app-layout>
    <div class="container">
        <div class="card">
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
                            
                            <div class="col-md-6"> {{-- left  --}}
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
                                        @if(isset($transaction))
                                            <input type="text" class="form-control col-sm-6"  name="" value="{{$transaction->user_id}} | {{$transaction->User->firstname}} {{$transaction->User->lastname}}" readonly>
                                            <input type="hidden" class="form-control col-sm-6"  name="user_id"  value="{{isset($transaction)?"$transaction->user_id":''}}" >
                                        @else
                                            <input type="text" class="form-control col-sm-6"  name="" value="{{Auth::user()->id }} | {{Auth::user()->firstname }} {{Auth::user()->lastname }}" readonly>
                                            <input type="hidden" class="form-control col-sm-6"  name="user_id"  value="{{Auth::user()->id }}" >
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
                                            @if (!isset($transaction))
                                                <option value="" style="color:red;">--- กรุณาเลือกครุภัณฑ์ ---  </option>
                                            @endif
    
                                            @foreach($equipment as $row)
                                                <option value="{{$row->id}}"
                                                    @if(isset($transaction))
                                                        @if($transaction->equipment_id == $row->id)
                                                            selected
                                                        @endif
                                                    @endif
                                                > {{$row->equipment_number}} | {{$row->name}} | {{$row->TypeEquipment->name}} / {{$row->TypeEquipment->category->name}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
    
                                {{-- <div class="row align-items-center form-group mt-4">
                                    <div class="col-sm-12">
                                        <label for="set_at">วันที่กำหนดส่งคืน <span style="color: red">*</span></label>
                                        @error('set_at')
                                            <label>
                                                <span class="text-danger">{{$message}}</span>
                                            </label>
                                        @enderror
                                    </div>
                                
                                    <div class="col-sm-12">
                                        @if(isset($transaction))
                                        <input type="datetime" class="form-control col-sm-6"  name="set_at" value="{{$transaction->set_at}}" >
                                    @else
                                        <input type="datetime-local" class="form-control col-sm-6"  name="set_at" value="" >
                                    @endif              
                                    </div>
                                </div> --}}
                     

    
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
                                        {{-- {{$Transaction->fileImage}} --}}
                                        <input type="file" class="form-control col-sm-6"  name="fileImage" value="{{isset($transaction)?"$transaction->fileImage":''}}" >         
                                    </div>
                                </div>
    
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
    
                            <div class="col-md-6">
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
                                        @if(isset($transaction))
                                            <input type="text" class="form-control col-sm-6"  name="code" value="{{isset($transaction)?"$transaction->code":''}}" readonly>
                                        @else
                                            <input type="text" class="form-control col-sm-6"  name="code" value="{{isset($transaction)?"$transaction->code":''}}" >
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
                                        <input type="text" class="form-control col-sm-6"  name="problem" value="{{isset($transaction)?"$transaction->problem":''}}" >
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
                                        <input type="text" class="form-control col-sm-6"  name="code" value="{{isset($transaction)?"$transaction->status":''}}" readonly>
                                    </div>
                                </div>
                                @endif
                     
                                {{-- <input type="hidden" class="form-control col-sm-6"  name="status"  value="แจ้งซ่อม" > --}}
    
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
        </div>
    </div>
</x-app-layout>
<script>
    // var date = new Date();
    // var newDate = date.getTime() + 6000 ;
    // console.log(date);
    // console.log(newDate);

    // var day = date.getDate();
    // var month = date.getMonth() ;
    // var year = date.getFullYear();

    // if (month < 10) month = "0" + month;
    // if (day < 10) day = "0" + day;

    // var today = year + "-" + month + "-" + day +"T00:00";       
    // $("#theDate").attr("value", today);
</script>