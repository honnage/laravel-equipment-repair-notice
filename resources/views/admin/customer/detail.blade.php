<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ __('Dashboard') }} --}}
            สวัสดี , {{Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    @if(session("success"))
                        <div class="alert alert-success">{{ session("success") }}</div>
                    @endif
                    <div class="card">
                        <div class="card-header" style="font-size: 24px;">ตารางข้อมูล ลูกค้า</div>
                        <div class="table-responsive">
                            @if($customers->count()>0)
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                    <th scope="col" style="text-align: center">ID</th>
                                    <th scope="col" style="width:38%; text-align: center">ชื่อจริง</th>
                                    <th scope="col" style="width:38%; text-align: center">นามสกุล</th>
                                    <th scope="col" style="width:5%; text-align: center">เพศ</th>
                                    <th scope="col" style="width:5%; text-align: center">เบอร์โทร</th>
                                    <th scope="col" style="width:20%; text-align: center"><center>เพิ่มเติม</center></th>
                                    <th scope="col" style="width:20%; text-align: center"><center>แก้ไข</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $customers as $row )
                                    <tr>
                                        <th>{{$customers->firstItem()+$loop->index}}</th>
                                        <td>{{$row->firstname}}</td>
                                        <td>{{$row->lastname}}</td>
                                        <td>
                                            @if($row->gender == "F")
                                                ชาย
                                            @else
                                                หญิง
                                            @endif
                                        </td>
                                        <td>{{$row->phone}}</td>
                                        <td>
                                            <center><a href="{{url('/customer/detail/'.$row->id)}}" class="btn btn-primary">เพิ่มเติบ</a></center>
                                        </td>
                                        <td>
                                            <center><a href="{{url('/customer/edit/'.$row->id)}}" class="btn btn-warning">แก้ไข</a></center>
                                        </td>
                                        {{-- <td>
                                            <center><a href="{{url('/category/delete/'.$row->id)}}" class="btn btn-danger"
                                            onclick="return confirm('คุณต้องการลบข้อมูลบริการหรือไม่?')">ลบ</a></center>
                                        </td> --}}
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                                <h3 style="color:red; text-align:center ;padding-top: 20px; padding-bottom: 20px">-- ไม่มีข้อมูล ลูกค้า --</h3>
                            @endif
                        </div>
                        {{$customers->links()}}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header" style="font-size: 24px;">รายละเอียด ลูกค้า ID: {{$customer->id}}</div>
                        <div class="card-body">
                            <form action="{{url('/customer/update/'.$customer->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="firstname">ชื่อจริง</label>
                                    <input type="text" class="form-control" name="firstname" placeholder="กรุณาป้อน ชื่อจริง" value="{{$customer->firstname}}" readonly>
                                </div>
                                @error('firstname')
                                    <div class="my-2">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
                                @enderror

                                <div class="form-group my-2">
                                    <label for="lastname">นามสกุล</label>
                                    <input type="text" class="form-control" name="lastname" placeholder="กรุณาป้อน นามสกุล" value="{{$customer->lastname}}" readonly>
                                </div>
                                @error('lastname')
                                    <div class="my-2">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
                                @enderror

                                <div class="form-group my-2">
                                    <label for="gender">เพศ</label>
                                    <input type="text" class="form-control" name="lastname" placeholder="กรุณาป้อน นามสกุล" 
                                    
                                    @if ( $customer->gender == "F" )
                                        value="เพศชาย" 
                                    @else
                                        value="เพศหญิง" 
                                    @endif                                    
                                    readonly>
                                </div>
                                @error('gender')
                                    <div class="my-2">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
                                @enderror

                                <div class="form-group my-2">
                                    <label for="email">อีเมล</label>
                                    <input type="text" class="form-control" name="email"placeholder="กรุณาป้อน อีเมล" value="{{$customer->email}}" readonly>
                                </div>
                                @error('email')
                                    <div class="my-2">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
                                @enderror

                                <div class="form-group my-2">
                                    <label for="phone">เบอร์โทร</label>
                                    <input type="text" class="form-control" name="phone" placeholder="กรุณาป้อน เบอร์โทร" value="{{$customer->phone}}" readonly>
                                </div>
                                @error('phone')
                                    <div class="my-2">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
                                @enderror

                                <div class="form-group my-2">
                                    <label for="address">ที่อยู่</label>
                                    <input type="text" class="form-control" name="address" placeholder="กรุณาป้อน ที่อยู่" value="{{$customer->address}}" readonly>
                                </div>
                                @error('address')
                                    <div class="my-2">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
                                @enderror

                          
                                <br>
                                <center>
                                    <a href="{{ route('customer') }}" class="btn btn-secondary" type="reset">ย้อนกลับ</a> &nbsp;
                                </center>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
