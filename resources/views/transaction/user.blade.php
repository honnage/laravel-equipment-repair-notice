{{-- {{Auth::user()->firstname }} {{Auth::user()->lastname }} --}}

<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            สวัสดีคุณ, {{Auth::user()->firstname }} {{Auth::user()->lastname }}
        </h2>
    </x-slot> --}}


    <div class="container">
        <div class="row">

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
                            <h1 class="text-left">รายการแจ้งซ่อมของคุณ 
                                {{-- {{Auth::user()->firstname }} {{Auth::user()->lastname }}</h1> --}}
                        </div>
                        <div class="d-flex flex-row-reverse  ">
                            <a href="{{ route('createTransaction') }}" class="btn btn-outline-success" style=" display: flex; align-items: center"><i class="fas fa-plus-circle"></i>&nbsp; แจ้งซ่อม </a>
                        </div>
                    </div>
        
                    <br>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body" style="font-size: 26px">{{ number_format( $count_status_notifyRepair ) }} </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" style="text-decoration: none; font-size: 20px;" 
                                        href="{{url('/transaction/user/query/แจ้งซ่อม')}}">แจ้งซ่อม</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning  mb-4">
                                <div class="card-body" style="font-size: 26px"> {{ number_format( $count_status_beingRepaired ) }} </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-dark stretched-link" style="text-decoration: none; font-size: 20px;" 
                                        href="{{url('/transaction/user/query/กำลังซ่อม')}}">กำลังซ่อม</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body" style="font-size: 26px">{{ number_format( $count_status_sussecc ) }} </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" style="text-decoration: none; font-size: 20px;" 
                                        href="{{url('/transaction/user/query/เรียบร้อย')}}">เรียบร้อย</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-secondary text-white mb-4">
                                <div class="card-body" style="font-size: 26px">{{ number_format( $count_status_cancelr ) }} </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" style="text-decoration: none; font-size: 20px;" 
                                        href="{{url('/transaction/user/query/ยกเลิก')}}">ยกเลิก</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <ol class="breadcrumb mt-2">
                        <li class="breadcrumb-item active">จำนวนแจ้งซ่อมครุภัณฑ์ทั้งหมด {{ number_format( $count_translation ) }} รายการ</li>
                    </ol>
                    
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            ตาราง แจ้งซ่อมครุภัณฑ์
                        </div>
                        <div class="card-body">
                            @if($transaction->count() > 0)
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th style="text-align: center; vertical-align: middle;">รหัสแจ้งซ่อม</th>
                                        <th style="text-align: center; vertical-align: middle;">ผู้แจ้งซ่อม</th>
                                        <th style="text-align: center; vertical-align: middle;">ชื่อครุภัณฑ์</th>
                                        <th style="text-align: center; vertical-align: middle;">หมวดหมู่</th>
                                        <th style="text-align: center; vertical-align: middle;">อาการหรือปัญหา</th>
                                        <th style="text-align: center; vertical-align: middle;">วันที่แจ้ง </th>
                                        <th style="text-align: center; vertical-align: middle;">กำหนดคืน </th>
                                        <th style="text-align: center; vertical-align: middle;">สถานะ </th>                                         
                                        <th style="text-align: center; vertical-align: middle;">เพิ่มเติม</th>
                                        <th style="text-align: center; vertical-align: middle;">แก้ไข</th>
                                        <th style="text-align: center; vertical-align: middle;">ลบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $transaction as $row )
                                    <tr>
                                        <td style="vertical-align: middle;">{{$row->id}}</td>
                                        <td style="vertical-align: middle;">{{$row->User->firstname}} {{$row->User->lastname}}</td>
                                        <td style="vertical-align: middle;">{{$row->Equipment->name}}</td>
                                        <td style="vertical-align: middle;">{{$row->Equipment->category->name}}</td>
                                        <td style="vertical-align: middle;">{{$row->problem}}</td>
                                        <td style="vertical-align: middle; text-align: center;  width: 8%;">{{$row->created_at}}</td>
                                        <td style="vertical-align: middle; text-align: center; width: 8%;  ">{{$row->set_at}}</td>
                                        <td style="vertical-align: middle;  width: 8%;"> 
                                                @if ( $row->status== "เรียบร้อย" )
                                                    <nav style="height: 30px; border-radius: 10px; background-color: green; vertical-align: middle; text-align: center; padding: 5px; color: #fff">  {{$row->status}} </nav>
                                                @elseif ( $row->status== "กำลังซ่อม")
                                                    <nav style="height: 30px; border-radius: 10px; background-color: #eb9d29; vertical-align: middle; text-align: center; padding: 5px; color: #fff">  {{$row->status}} </nav>
                                                @elseif ( $row->status== "ยกเลิก")
                                                    <nav style="height: 30px; border-radius: 10px; background-color: #808080; vertical-align: middle; text-align: center; padding: 5px; color: #fff">  {{$row->status}} </nav>
                                                @else
                                                    <nav style="height: 30px; border-radius: 10px; background-color: #2591f7; vertical-align: middle; text-align: center; padding: 5px; color: #fff">  {{$row->status}} </nav>
                                                @endif
                                                    
                                            </nav>                  
                                        </td>
                                        <td style="vertical-align: middle;">
                                            <center><a href="{{url('/transaction/details/user/'.$row->id)}}" class="btn btn-success" style="width: 70px;"><i class="fas fa-eye"></i></a></center>
                                        </td>
                                        <td style="width: 4%; vertical-align: middle;">
                                            @if ($row->status != "แจ้งซ่อม")
                                                <a type="#" class="btn btn-secondary " data-name="{{$row->code}}" style="width: 70px;">-</a>
                                            @else
                                                <center><a href="{{url('/transaction/edit/'.$row->id)}}" class="btn btn-warning" style="width: 70px"><i class="fas fa-edit"></i></a></center>
                                            @endif
                                        </td>
                                        <td style="width: 4%; vertical-align: middle; text-align: center">
                                            @if ($row->status != "แจ้งซ่อม")
                                                <form action="" method="get">
                                                    <a type="#" class="btn btn-secondary" data-name="{{$row->code}}" style="width: 70px;">-</a>
                                                </form>
                                            @else
                                                <form action="{{url('/transaction/destroy/'.$row->id)}}" method="get">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a type="submit" class="btn btn-danger deleteform" data-name="{{$row->code}}" style="width: 70px;"><i class="fas fa-trash-alt"></i></a>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                                <h3 style="color:red; text-align:center ;padding-top: 20px; padding-bottom: 20px">-- ไม่มีข้อมูล แจ้งซ่อมครุภัณฑ์ของคุณ --</h3>
                            @endif
                        </div>
                    </div>
                    
                </div>
            </main>                
        </div>
    </div>
</x-app-layout>
