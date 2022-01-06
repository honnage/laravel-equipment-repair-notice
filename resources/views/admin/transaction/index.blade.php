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
                    <h1 class="text-left">แจ้งซ่อมครุภัณฑ์</h1>
                </div>
              
                <div class="d-flex flex-row-reverse  ">
                    {{-- <a class="nav-link" href="{{ route('type') }}"> --}}
                    <a href="{{ route('createTransaction') }}" class="btn btn-outline-success" style=" display: flex; align-items: center"><i class="fas fa-plus-circle"></i>&nbsp; เพิ่มหมวดหมู่ </a>
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
                    ตาราง แจ้งซ่อมครุภัณฑ์
                </div>
                <div class="card-body">
                    @if($Translation->count() > 0)
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th style="vertical-align: middle;">รหัส</th>
                                <th style="vertical-align: middle;">รหัสแจ้งซ่อม</th>
                                <th style="text-align: center; vertical-align: middle;">ผู้แจ้งซ่อม</th>
                                <th style="text-align: center; vertical-align: middle;">ชื่อครุภัณฑ์</th>
                                <th style="text-align: center; vertical-align: middle;">ประเภท / หมวดหมู่</th>
                                <th style="text-align: center; vertical-align: middle;">อาการหรือปัญหา</th>
                                <th style="text-align: center; vertical-align: middle;">กำหนดส่งคืน </th>
                                <th style="text-align: center; vertical-align: middle;">สถานะ </th>
                                <th style="text-align: center; vertical-align: middle;">เพิ่มเติม</th>
                                <th style="text-align: center; vertical-align: middle;">แก้ไข</th>
                                <th style="text-align: center; vertical-align: middle;">ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $Translation as $row )
                            <tr>
                               
                                <td style="width: 4%; vertical-align: middle;">{{$row->id}}</td>
                                <td style="width: 7%; vertical-align: middle;">{{$row->code}}</td>
                                <td style="width: 10%; vertical-align: middle;">{{$row->User->firstname}} {{$row->User->lastname}}</td>
                                <td style="width: 15%; vertical-align: middle;">{{$row->Equipment->name}}</td>
                                <td style="width: 16%; vertical-align: middle; text-align: center">{{$row->Equipment->TypeEquipment->name}} / {{$row->Equipment->TypeEquipment->category->name}}</td>
                                <td style="width: 15%; vertical-align: middle;">{{$row->problem}}</td>
                                <td style="width: 8%; vertical-align: middle; text-align: center">{{$row->set_at}}</td>
                                <td style="width: 4%; vertical-align: middle; text-align: center">{{$row->status}}</td>
                                <td style="width: 4%; vertical-align: middle;">
                                    <center><a href="{{url('/type/edit/'.$row->id)}}" class="btn btn-success" style="width: 70px;"><i class="fas fa-eye"></i></a></center>
                                </td>
                                <td style="width: 4%; vertical-align: middle;">
                                    <center><a href="{{url('/category/edit/'.$row->id)}}" class="btn btn-warning" style="width: 70px"><i class="fas fa-edit"></i></a></center>
                                </td>
                                <td style="width: 4%; vertical-align: middle; text-align: center">
                                    <form action="{{url('/transaction/destroy/'.$row->id)}}" method="get">
                                        @csrf
                                        @method('DELETE')
                                        @if ($row->status != "แจ้งซ่อม")

                                        @else
                                            <a type="submit" class="btn btn-danger deleteform" data-name="{{$row->code}}" style="width: 70px;"><i class="fas fa-trash-alt"></i></a>
                                        @endif
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