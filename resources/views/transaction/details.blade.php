{{-- {{Auth::user()->firstname }} {{Auth::user()->lastname }} --}}

<x-app-layout>
    <div class="container">
        <div class="card">
   
                <div class="container-fluid px-4">
                    <div class="d-flex justify-content-between mt-4" >
                        <div class=" flex-row-reverse  ">
                            <h1 class="text-left">รายละเอียด</h1>
                        </div>
                      
                        <div class="d-flex flex-row-reverse  ">
                            <a h href="{{url('/transaction/downloadPDF/'.$transaction->id)}}" class="btn btn-outline-success" style=" display: flex; align-items: center"><i class="fas fa-print"></i>&nbsp; พิมพ์ </a>
                        </div>
                    </div>
                    <hr>
                    <div class=" mb-4">
                        <h3>ข้อมูลผู้แจ้ง</h3>
                        <table class="table table-striped table-bordered" >
                            <tbody>
                              {{-- <tr>
                                <th style="width: 20%">วันที่แจ้ง</th>
                                <td style="width: 80%">{{$transaction->created_at}}</td>
                              </tr> --}}
                              <tr>
                                <th style="width: 20%">ชื่อ - นามสกุล</th>
                                <td style="width: 80%">{{$transaction->user->firstname}} {{$transaction->user->lastname}}</td>
                              </tr>
                              <tr>
                                <th style="width: 20%">ตำแหน่ง</th>
                                <td style="width: 80%">{{$transaction->user->department}} </td>
                              </tr>
                              <tr>
                                <th style="width: 20%">เบอร์โทร</th>
                                <td style="width: 80%">{{$transaction->user->phone}}</td>
                              </tr>
                              <tr>
                                <th style="width: 20%">อีเมล</th>
                                <td style="width: 80%">{{$transaction->user->email}}</td>
                              </tr>
                              
                            </tbody>
                        </table>
        
                        <br>
        
                        <h3>ข้อมูลการแจ้งซ่อม</h3>
                        <table class="table table-striped table-bordered">
                            <tbody>
                              <tr>
                                <th style="width: 20%">รหัสแจ้งซ่อม</th>
                                <td style="width: 80%">{{$transaction->code}}</td>
                              </tr>
                              <tr>
                                <th style="width: 20%">ชื่อครุภัณฑ์</th>
                                <td style="width: 80%">{{$transaction->Equipment->name}}</td>
                              </tr>
                              <tr>
                                <th style="width: 20%">ประเภทครุภัณฑ์</th>
                                <td style="width: 80%">{{$transaction->Equipment->TypeEquipment->name}}</td>
                              </tr>
                              <tr>
                                <th style="width: 20%">หมวดหมู่ครุภัณฑ์</th>
                                <td style="width: 80%">{{$transaction->Equipment->TypeEquipment->category->name}}</td>
                              </tr>
                              <tr>
                                <th style="width: 20%">อาการหรือปัญหา</th>
                                <td style="width: 80%">{{$transaction->problem}} </td>
                              </tr>
                              <tr>
                                <th style="width: 20%">วันที่แจ้งซ่อม</th>
                                <td style="width: 80%">{{$transaction->created_at}} </td>
                              </tr>
                              <tr>
                                <th style="width: 20%">วันที่กำหนดส่งคืน</th>
                                <td style="width: 80%">{{$transaction->set_at}} </td>
                              </tr>
                              <tr>
                                <th style="width: 20%">สาเหต / รายละเอียด</th>
                                <td style="width: 70%">
                                  @if ($transaction->details == null) 
                                      -
                                  @else
                                      {{$transaction->details}} 
                                  @endif
                                </td>
                              </tr>
                              <tr>
                                <th style="width: 20%">สถานะ</th>
                                <td style="width: 80%"> 
                                    @if ( $transaction->status == "แจ้งซ่อม" )                    
                                        <span style="color:#2591f7; font-weight: 700">{{$transaction->status}} </span>                       
                                    @elseif ( $transaction->status == "กำลังซ่อม" )
                                        <span style="color:#eb9d29; font-weight: 700">{{$transaction->status}} </span>                            
                                    @elseif ( $transaction->status == "เรียบร้อย" )
                                        <span style="color:green; font-weight: 700">{{$transaction->status}} </span>
                                    @else
                                        <span style="color:#808080; font-weight: 700">{{$transaction->status}} </span>
                                    @endif
                                </td>
                              </tr>
                              <tr>
                                <th style="width: 20%">ราคา</th>
                                <td style="width: 70%">
                                  @if ($transaction->price == null) 
                                      -
                                  @else
                                      {{$transaction->price}} 
                                  @endif
                                </td>
                              </tr>
                              <tr>
                                <th style="width: 20%">ประกัน</th>
                                <td style="width: 70%">
                                  @if ($transaction->guaranty == null) 
                                      -
                                  @else
                                      {{$transaction->price}} 
                                  @endif
                                </td>
                              </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
     
        </div>
    </div>
</x-app-layout>
