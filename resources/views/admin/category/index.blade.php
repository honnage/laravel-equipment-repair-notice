@extends('layouts.index')
@section('content')

    <main>
        <div class="container-fluid px-4">
            @if(Session()->has('success'))
                <div class="alert alert-success  mt-4" role="alert">
                    {{Session()->get('success')}}
                </div>
            @endif
            @if(Session()->has('error'))
                <div class="alert alert-danger  mt-4" role="alert">
                    {{Session()->get('error')}}
                </div>
            @endif

            <div class="d-flex justify-content-between mt-4">
                <div class=" flex-row-reverse  ">
                    <h1 class="text-left">หมวดหมู่ครุภัณฑ์</h1>
                </div>
              
                <div class="d-flex flex-row-reverse  ">
                    {{-- <a class="nav-link" href="{{ route('type') }}"> --}}
                    <a href="{{ route('createCategory') }}" class="btn btn-outline-success" style=" display: flex; align-items: center"><i class="fas fa-plus-circle"></i>&nbsp; เพิ่มหมวดหมู่ </a>
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
                    ตาราง หมวดหมู่ครุภัณฑ์
                </div>
                <div class="card-body">
                    @if($categories->count() > 0)
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>รหัส</th>
                                <th>หมวดหมู่ครุภัณฑ์</th>
                                <th style="text-align: center">จำนวน</th>
                                <th style="text-align: center">เพิ่มเติม</th>
                                <th style="text-align: center">แก้ไข</th>
                                <th style="text-align: center">ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $categories as $row )
                            <tr>
                                {{-- <th>{{$categories->firstItem()+$loop->index}}</th> --}}
                                {{-- <td><img src="{{asset($row->categories_image)}}" width="70px" height="70px"></td> --}}
                                <td style="width: 7%; vertical-align: middle;">{{$row->id}}</td>
                                <td style="width: 65%; vertical-align: middle;">{{$row->name}}</td>
                                <td style="width: 10%; vertical-align: middle;">
                                    <center>{{ number_format( $row->TypeEquipment->count() )}}<center>
                                </td>
                                <td style="width: 6%; vertical-align: middle;">
                                
                                </td>
                                <td style="width: 6%; vertical-align: middle;">
                                    <center><a href="{{url('/category/edit/'.$row->id)}}" class="btn btn-warning" style="width: 70px"><i class="fas fa-edit"></i></a></center>
                                </td>
                                <td style="width: 6%; text-align: center; vertical-align: middle;">
                                    <form action="{{url('/category/destroy/'.$row->id)}}" method="get">
                                        @csrf
                                        @method('DELETE')

                                        {{-- <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" style="width: 70px">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        
                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">คุณต้องการลบข้อมูล</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                   <h3> {{$row->id}} หรือไม่ ? </h3>
                                                   <h6 style="color: red">ถ้าลบแล้วไม่สามารถกู้คืนได้</h6>
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                                <button type="submit" class="btn btn-danger" style="width: 70px">ลบ</button>
                                                </div>
                                            </div>
                                            </div>
                                        </div> --}}
                            
                                        <a type="submit" class="btn btn-danger deleteform" data-name="{{$row->name}}" style="width: 70px;"><i class="fas fa-trash-alt"></i></a>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        <h3 style="color:red; text-align:center ;padding-top: 20px; padding-bottom: 20px">-- ไม่มีข้อมูล หมวดหมู่ครุภัณฑ์ --</h3>
                    @endif
                </div>
            </div>
          
        </div>
    </main>
    

@endsection