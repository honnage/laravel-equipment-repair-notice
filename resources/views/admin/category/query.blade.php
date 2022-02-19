
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
                <h1 class="text-left">ครุภัณฑ์</h1>
            </div>
            
            <div class="d-flex flex-row-reverse  ">
                <a href="{{ route('createType') }}" class="btn btn-outline-success" style=" display: flex; align-items: center"><i class="fas fa-plus-circle"></i>&nbsp; เพิ่มประเภท </a>
            </div>
        </div>

        {{-- <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">จำนวนรายการทั้งหมด</li>
        </ol> --}}
        <br> 
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                ตาราง ประเภทครุภัณฑ์
            </div>
            <div class="card-body">
                @if($equipment->count() > 0)
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>หมายเลขครุภัณฑ์</th>
                            <th>ชื่อครุภัณฑ์</th>
                            <th>หมวดหมู่ครุภัณฑ์</th>
                            <th style="text-align: center">ราคา </th>
                            <th style="text-align: center">อายุประกัน</th>
                            <th style="text-align: center">วันที่ซื้อ</th>
                            <th style="text-align: center">ประวัติ</th>
                            <th style="text-align: center">แสดง</th>
                            <th style="text-align: center">แก้ไข</th>
                            <th style="text-align: center">ลบ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $equipment as $row )
                        <tr>
                            <td style="vertical-align: middle;">{{$row->equipment_number}}</td>
                            <td style="vertical-align: middle;">{{$row->name}}</td>
                            <td style="vertical-align: middle;"><a href="{{route('category')}}" style="text-decoration: none">{{$row->category->name}}</a></td>
                            <td style="vertical-align: middle; text-align: right;">{{ number_format( $row->price, 2, '.', ',')}} </td>
                            <td style="vertical-align: middle; text-align: right;">{{$row->insurance}}</td>
                            <td style="vertical-align: middle; text-align: center;">{{$row->purchase_date}}</td>
                            <td style="vertical-align: middle;"> <center>{{ number_format( $row->Transaction->count() )}} ครั้ง<center></td>
                            <td style="width: 6%; vertical-align: middle;">
                                <center><a href="{{url('/equipment/query/'.$row->id)}}" class="btn btn-success" style="width: 70px;"><i class="fas fa-eye"></i></a></center>
                            </td>
                            <td style="width: 6%; vertical-align: middle;">
                                <center><a href="{{url('/equipment/edit/'.$row->id)}}" class="btn btn-warning" style="width: 70px;"><i class="fas fa-edit"></i></a></center>
                            </td>
                            <td style="width: 6%; text-align: center; vertical-align: middle;">
                                <form action="{{url('/equipment/destroy/'.$row->id)}}" method="get">
                                    @csrf
                                    @method('DELETE')
                                    <a type="submit" class="btn btn-danger deleteform" data-name="{{$row->name}}" style="width: 70px;"><i class="fas fa-trash-alt"></i></a>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <h3 style="color:red; text-align:center ;padding-top: 20px; padding-bottom: 20px">-- ไม่มีข้อมูล ครุภัณฑ์ --</h3>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection