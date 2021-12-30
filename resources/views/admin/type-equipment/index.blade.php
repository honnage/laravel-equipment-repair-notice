@extends('layouts.index')
@section('content')

    <main>
        <div class="container-fluid px-4">
            @if(Session()->has('success'))
                <div class="alert alert-success  mt-4" role="alert">
                    {{Session()->get('success')}}
                </div>
            @endif

            {{-- <h1 class="mt-4">ประเภทครุภัณฑ์</h1>
            <div class="d-flex flex-row-reverse  ">
                <button href="#" class="  btn btn-outline-success" >ฟอร์มข้อมูล </button>
            </div> --}}
            <div class="d-flex justify-content-between mt-4">
                <div class=" flex-row-reverse  ">
                    <h1 class="text-left">ประเภทครุภัณฑ์</h1>
                </div>
              
                <div class="d-flex flex-row-reverse  ">
                    {{-- <a class="nav-link" href="{{ route('type') }}"> --}}
                    <a href="{{ route('typeCreate') }}" class="btn btn-outline-success" style=" display: flex; align-items: center"><i class="fas fa-plus-circle"></i>&nbsp; เพิ่มประเภท </a>
                </div>
              
            </div>

            {{-- <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">จำนวนรายการทั้งหมด</li>
            </ol> --}}
            <br>
            <div class="row">
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
            </div>
          
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    ตาราง ประเภทครุภัณฑ์
                </div>
                <div class="card-body">
                    @if($TypeEquipment->count() > 0)
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>รหัส</th>
                                <th>ประเภทครุภัณฑ์</th>
                                <th style="text-align: center">จำนวน</th>
                                <th style="text-align: center">เพิ่มเติม</th>
                                <th style="text-align: center">แก้ไข</th>
                                <th style="text-align: center">ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $TypeEquipment as $row )
                            <tr>
                                {{-- <th>{{$categories->firstItem()+$loop->index}}</th> --}}
                                {{-- <td><img src="{{asset($row->categories_image)}}" width="70px" height="70px"></td> --}}
                                <td style="width: 7%">{{$row->id}}</td>
                                <td style="width: 65%">{{$row->name}}</td>
                                <td style="width: 10%">
                                
                                </td>
                                <td style="width: 6%">
                                
                                </td>
                                <td style="width: 6%">
                                
                                </td>
                                <td style="width: 6% ; text-align: center">
                                    {{-- <form action="{{route('addType')}}" method="post" enctype="multipart/form-data"> --}}

                                    {{-- <form action="{{url('/type/destroy/'.$row->id)}}" method="post">
                                    
                                        <a style="color:white; width: 50px" type="submit" class="btn btn-danger " style><i class="fas fa-trash-alt"></i></a>
                                    </form> --}}

                                    {{-- <form class="delete_form" action="/type/destroy/{{$row->id}}" method="post">
                                        {{csrf_field()}}
                                        <input type="hidden" class="_method" value="DELETE">
                                        <input type="submit" class="btn btn-danger col-sm-12" name="" value="ลบ">
                                    </form> --}}

                                    {{-- /type/destroy/{{$row->id}} --}}
                                    <form action="{{url('/type/destroy/'.$row->id)}}" method="get">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>                                
                                    </form>
                                </td>
                  
                                {{-- <td>
                                    <center><a href="{{url('/category/edit/'.$row->id)}}" class="btn btn-warning">แก้ไข</a></center>
                                </td>
                                <td>
                                    <center><a href="{{url('/category/delete/'.$row->id)}}" class="btn btn-danger"
                                    onclick="return confirm('คุณต้องการลบข้อมูลบริการหรือไม่?')">ลบ</a></center>
                                </td> --}}
                            </tr>
                            @endforeach
                           
                
                        </tbody>
                    </table>
                    @else
                        <h3 style="color:red; text-align:center ;padding-top: 20px; padding-bottom: 20px">-- ไม่มีข้อมูล ประเภทครุภัณฑ์ --</h3>
                    @endif
                </div>
            </div>
          
        </div>
    </main>
    

@endsection