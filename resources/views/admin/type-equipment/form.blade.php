@extends('layouts.index')
@section('content')
    <main>
        <div class="container-fluid px-4">
            {{-- <h1 class="mt-4">ประเภทครุภัณฑ์</h1>
            <div class="d-flex flex-row-reverse  ">
                <button href="#" class="  btn btn-outline-success" >ฟอร์มข้อมูล </button>
            </div> --}}
            <div class="d-flex justify-content-between mt-4">
                <div class=" flex-row-reverse  ">
                    <h1 class="text-left">เพิ่มข้อมูล ประเภทครุภัณฑ์</h1>
                </div>
              
            </div>

            {{-- <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">จำนวนรายการทั้งหมด</li>
            </ol> --}}

            <br>
            {{-- <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Primary Card</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" style="text-decoration: none; font-size: 20px;" href="#">แจ้งซ่อม</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning  mb-4">
                        <div class="card-body">Warning Card</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-dark stretched-link" style="text-decoration: none; font-size: 20px;" href="#">กำลังซ่อม</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">Success Card</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" style="text-decoration: none; font-size: 20px;" href="#">สำเร็จ</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-secondary text-white mb-4">
                        <div class="card-body">Danger Card</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" style="text-decoration: none; font-size: 20px;" href="#">ยกเลิก</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div> --}}
          
            <div class=" mb-4">
                <form action="{{isset($TypeEquipment)?"/type/update/$TypeEquipment->id":route('addType') }}" method="post">
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
                                    <input type="text" class="form-control col-sm-6"  name="name" value="{{isset($TypeEquipment)?"$TypeEquipment->name":''}}" >
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
                                    @if (!isset($TypeEquipment))
                                        <option value="" style="color:red;">--- กรุณาเลือกหมวดหมู่ --- </option>
                                    @endif

                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}"
                                            @if(isset($TypeEquipment))
                                                @if($TypeEquipment->category_id == $category->id)
                                                    selected
                                                @endif
                                            @endif
                                        >{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>
                    <div class="col-md-6 d-flex flex-row-reverse bd-highlight mt-4">
                        <input type="submit" name="submit" value="{{isset($TypeEquipment)? "แก้ไข":"เพิ่มข้อมูล"}}" class="{{isset($TypeEquipment)? "btn btn-warning col-sm-2":"btn btn-success col-sm-2"}}">
                        &nbsp;&nbsp;
                        <button class="btn btn-secondary col-sm-1" type="reset">ยกเลิก</button>      
                    </div>
                </form>
            </div>
          
        </div>
    </main>
    

@endsection