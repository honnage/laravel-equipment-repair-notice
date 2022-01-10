@extends('layouts.index')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <div class="d-flex justify-content-between mt-4">
                <div class=" flex-row-reverse  ">
                    <h1 class="text-left">รายละเอียด</h1>
                </div>
            </div>
            <hr>
            <div class=" mb-4">
                <h3>ข้อมูลปัญหา</h3>
                <table class="table table-striped table-bordered" style="width: 140vh;">
                    <tbody>
                      <tr>
                        <th style="width: 20%">วันที่แจ้ง</th>
                        <td style="width: 80%">{{$Transaction->created_at}}</td>
                      </tr>
                      <tr>
                        <th style="width: 20%">ชื่อ - นามสกุล</th>
                        <td style="width: 80%">{{$Transaction->user->firstname}} {{$Transaction->user->lastname}}</td>
                      </tr>
                      <tr>
                        <th style="width: 20%">เบอร์โทร</th>
                        <td style="width: 80%">{{$Transaction->user->phone}}</td>
                      </tr>
                      <tr>
                        <th style="width: 20%">อีเมล</th>
                        <td style="width: 80%">{{$Transaction->user->email}}</td>
                      </tr>
                      <tr>
                        <th style="width: 20%">ตำแหน่ง</th>
                        <td style="width: 80%">{{$Transaction->user->department}} </td>
                      </tr>
                    </tbody>
                </table>
                
                <br>

                <h3>ปัญหา / สาเหตุ</h3>
                <table class="table table-striped table-bordered" style="width: 140vh;">
                    <tbody>
                      <tr>
                        <th style="width: 20%">รหัสแจ้งซ่อม</th>
                        <td style="width: 80%">{{$Transaction->code}}</td>
                      </tr>
                      <tr>
                        <th style="width: 20%">ชื่อครุภัณฑ์</th>
                        <td style="width: 80%">{{$Transaction->Equipment->name}}</td>
                      </tr>
                      <tr>
                        <th style="width: 20%">ประเภทครุภัณฑ์</th>
                        <td style="width: 80%">{{$Transaction->Equipment->TypeEquipment->name}}</td>
                      </tr>
                      <tr>
                        <th style="width: 20%">หมวดหมู่ครุภัณฑ์</th>
                        <td style="width: 80%">{{$Transaction->Equipment->TypeEquipment->category->name}}</td>
                      </tr>
                      <tr>
                        <th style="width: 20%">อาการหรือปัญหา</th>
                        <td style="width: 80%">{{$Transaction->problem}} </td>
                      </tr>
                      <tr>
                        <th style="width: 20%">วันที่แจ้งซ่อม</th>
                        <td style="width: 80%">{{$Transaction->created_at}} </td>
                      </tr>
                      <tr>
                        <th style="width: 20%">วันที่กำหนดส่งคืน</th>
                        <td style="width: 80%">{{$Transaction->set_at}} </td>
                      </tr>
                      <tr>
                        <th style="width: 20%">สาเหต / รายละเอียด</th>
                        <td style="width: 80%">{{$Transaction->details}} </td>
                      </tr>
                      <tr>
                        <th style="width: 20%">สถานะ</th>
                        <td style="width: 80%"> 
                            @if ( $Transaction->status == "แจ้งซ่อม" )                    
                                <span style="color:#2591f7; font-weight: 700">{{$Transaction->status}} </span>                       
                            @elseif ( $Transaction->status == "กำลังซ่อม" )
                                <span style="color:#eb9d29; font-weight: 700">{{$Transaction->status}} </span>                            
                            @elseif ( $Transaction->status == "เรียบร้อย" )
                                <span style="color:green; font-weight: 700">{{$Transaction->status}} </span>
                            @else
                                <span style="color:#808080; font-weight: 700">{{$Transaction->status}} </span>
                            @endif
                        </td>
                      </tr>
                      <tr>
                        <th style="width: 20%">ราคา</th>
                        <td style="width: 80%">{{$Transaction->price}} </td>
                      </tr>
                      <tr>
                        <th style="width: 20%">ประกัน</th>
                        <td style="width: 80%">{{$Transaction->guaranty}} </td>
                      </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection