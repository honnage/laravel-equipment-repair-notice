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

            {{-- <h1 class="mt-4">ประเภทครุภัณฑ์</h1>
            <div class="d-flex flex-row-reverse  ">
                <button href="#" class="  btn btn-outline-success" >ฟอร์มข้อมูล </button>
            </div> --}}
            <div class="d-flex justify-content-between mt-4">
                <div class=" flex-row-reverse  ">
                    <h1 class="text-left">พนักงาน</h1>
                </div>
              
                <div class="d-flex flex-row-reverse  ">
                    {{-- <a class="nav-link" href="{{ route('type') }}"> --}}
                    {{-- <a href="{{ route('createRegister') }}" class="btn btn-outline-success" style=" display: flex; align-items: center"><i class="fas fa-plus-circle"></i>&nbsp; สมัคร </a> --}}

                    {{-- <a href="{{ route('typeCreate') }}" class="btn btn-outline-success" style=" display: flex; align-items: center"><i class="fas fa-plus-circle"></i>&nbsp; เพิ่มประเภท </a> --}}
                </div>
              
            </div>

            {{-- <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">จำนวนรายการทั้งหมด</li>
            </ol> --}}
            <br>
           
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    ตาราง พนักงาน
                </div>
                <div class="card-body">
                    @if($User->count() > 0)
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>รหัส</th>
                                <th>สถานะ</th>
                                <th>ชื่อจริง</th>
                                <th>นามสกุล</th>
                                <th>เพศ</th>
                                <th>ตำแหน่ง</th>
                                <th>อีเมล</th>
                                <th>เบอร์โทร</th>
                                <th>ที่อยู่</th>
                                <th>แจ้งซ่อม</th>
                                <th style="text-align: center">เพิ่มเติม</th>
                                <th style="text-align: center">แก้ไข</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $User as $row )
                            <tr>
                                <td style="width: 5%; vertical-align: middle;">{{$row->id}}</td>
                                <td style="width: 5%; vertical-align: middle;">
                                    @if ($row->status == "1" || $row->id =="1")
                                        Admin
                                    @else
                                        Employee
                                    @endif
                                </td>
                                <td style="width: 10%; vertical-align: middle;">{{$row->firstname}}</td>
                                <td style="width: 10%; vertical-align: middle;">{{$row->lastname}}</td>
                                <td style="width: 3%; vertical-align: middle;">{{$row->gender}} </td>
                                <td style="width: 10%; vertical-align: middle;">{{$row->department}}</td>
                                <td style="width: 15%; vertical-align: middle;">{{$row->email}}</td>
                                <td style="width: 3%; vertical-align: middle;">{{$row->phone}}</td>
                                <td style="width: 20%; vertical-align: middle;">{{$row->address}}</td>
                                <td style="width: 6%; vertical-align: middle;">
                                    <center>{{ number_format( $row->Transaction->count() )}} ครั้ง<center>
                                </td>
                                <td style="width: 6%; vertical-align: middle;">
                                    <center><a href="{{url('/type/edit/'.$row->id)}}" class="btn btn-success" style="width: 70px;"><i class="fas fa-eye"></i></a></center>
                                </td>
                                <td style="width: 6%; vertical-align: middle;">
                                    <center><a href="{{url('/user/edit/'.$row->id)}}" class="btn btn-warning" style="width: 70px;"><i class="fas fa-edit"></i></a></center>
                                </td>
                               
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