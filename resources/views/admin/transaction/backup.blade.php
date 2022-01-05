<x-app-layout>

    <div class="py-12">
        <div class="container">
            @if(Session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{Session()->get('success')}}
                </div>
            @endif
            <div class="row">
                <div class="col-md-3 ">
                    <div class="card-body background" style="background-color: rgb(51, 163, 248);">
                        <nav class="title">แจ้งซ่อม </nav>
                        จำนวนรายการ
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="card-body background" style="background-color: rgb(255, 207, 13);">
                        <nav class="title">กำลังซ่อม </nav>
                        จำนวนรายการ
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="card-body background" style="background-color: rgb(151, 151, 151);">
                        <nav class="title">ยกเลิก </nav>
                        จำนวนรายการ
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="card-body background" style="background-color: rgb(12, 196, 43);;">
                        <nav class="title">เรียบร้อย </nav>
                        จำนวนรายการ
                    </div>
                </div>
            </div>
            <br>

            
            <div class="container-fluid px-4">
                <div class="col-xl-12 my-4">
                    <div class="d-flex justify-content-between">
                        <div class=" flex-row-reverse ">
                            <h4 class="text-left">จำนวนรายการทั้งหมด ....</h4>
                        </div>
                        @if(Auth::user()->isStatus == 10 || Auth::user()->id == 1)
                            <div class="d-flex flex-row-reverse  ">
                                <button href="#" class=" slideToggle_table btn btn-outline-success" >ฟอร์มข้อมูล </button>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xl-12 my-2">
                        {{-- display:none; --}}
                        <div class="card mb-4"  id="form_data" style="display:none;"> 
                            <div class="card-header">
                                <i class="fas fa-chart-bar me-1"></i>
                                เพิ่มรายการแจ้งซ่อม
                            </div>
                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                           
                                {{-- <form action="{{route('addCategory')}}" method="post" enctype="multipart/form-data"> --}}
                                <form action="{{route('addTransaction')}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="col-md-6"> {{-- left  --}}
                                            <div class="row align-items-center form-group ">
                                                <div class="col-sm-12">
                                                    <label for="user_id">รหัสผู้แจ้งซ่อม <span style="color: red">*</span></label>
                                                    @error('user_id')
                                                        <label>
                                                            <span class="text-danger">{{$message}}</span>
                                                        </label>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control col-sm-6" name="user_id" placeholder="user_id">
                                                </div>
                                            </div>

                                            <div class="row align-items-center form-group mt-2">
                                                <div class="col-sm-12">
                                                    <label for="name">ชื่ออุปกรณ์ <span style="color: red">*</span></label>
                                                    @error('name')
                                                        <label>
                                                            <span class="text-danger">{{$message}}</span>
                                                        </label>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control col-sm-6" name="name" placeholder="name">
                                                </div>
                                            </div>

                                            <div class="row align-items-center form-group mt-2">
                                                <div class="col-sm-12">
                                                    <label for="category">หมวดหมู่อุปกรณ์ <span style="color: red">*</span></label>
                                                    @error('category')
                                                        <label>
                                                            <span class="text-danger">{{$message}}</span>
                                                        </label>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-12">
                                                    <select class="form-control col-sm-6" id="category" name="category">
                                                        <option value="electrical">อุปกรณ์ไฟฟ้า</option>
                                                        <option value="electronic ">อุปกรณ์อิเล็กทรอนิกส์</option>
                                                    </select>
                                                    {{-- <input type="text" class="form-control col-sm-6" name="categories_image"> --}}
                                                </div>
                                            </div>

                                            <div class="row align-items-center form-group mt-2">
                                                <div class="col-sm-12">
                                                    <label for="status">สถานะ <span style="color: red">*</span></label>
                                                    @error('status')
                                                        <label>
                                                            <span class="text-danger">{{$message}}</span>
                                                        </label>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-12">
                                                    <select class="form-control col-sm-6" id="status" name="status">
                                                        <option value="inform">แจ้งซ่อม</option>
                                                        <option value="saab">กำลังซ่อม</option>
                                                        <option value="fiat">ยกเลิก</option>
                                                        <option value="audi">เรียบร้อย</option>
                                                    </select>
                                                    {{-- <input type="text" class="form-control col-sm-6" name="categories_image"> --}}
                                                </div>
                                            </div>

                                            <div class="row align-items-center form-group mt-2">
                                                <div class="col-sm-12">
                                                    <label for="set_at">วันที่กำหนด <span style="color: red">*</span></label>
                                                    @error('set_at')
                                                        <label>
                                                            <span class="text-danger">{{$message}}</span>
                                                        </label>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-12">
                                                    <input type="date" class="form-control col-sm-6" name="set_at">
                                                </div>
                                            </div>

                                            <div class="row align-items-center form-group mt-2">
                                                <div class="col-sm-12">
                                                    <label for="fileImage">ไฟล์แนบ</label>
                                                    @error('fileImage')
                                                        <label>
                                                            <span class="text-danger">{{$message}}</span>
                                                        </label>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-12">
                                                    <input type="file" class="form-control col-sm-6" name="fileImage">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-6"> {{-- right  --}}
                                            <div class="row align-items-center form-group ">
                                                <div class="col-sm-12">
                                                    <label for="device_id">รหัสอุปกรณ์ <span style="color: red">*</span></label>
                                                    @error('device_id')
                                                        <label>
                                                            <span class="text-danger">{{$message}}</span>
                                                        </label>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control col-sm-6" name="device_id"  placeholder="device_id">
                                                </div>
                                            </div>

                                            <div class="row align-items-center form-group mt-2">
                                                <div class="col-sm-12">
                                                    <label for="problem">ปัญหางานซ่อม <span style="color: red">*</span></label>
                                                    @error('problem')
                                                        <label>
                                                            <span class="text-danger">{{$message}}</span>
                                                        </label>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control col-sm-6" name="problem" placeholder="problem">
                                                </div>
                                            </div>

                                            <div class="row align-items-center form-group mt-2">
                                                <div class="col-sm-12">
                                                    <label for="details">ประเภทงานซ่อม <span style="color: red">*</span></label>
                                                    @error('details')
                                                        <label>
                                                            <span class="text-danger">{{$message}}</span>
                                                        </label>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control col-sm-6" name="details" placeholder="details">
                                                </div>
                                            </div>

                                            <div class="row align-items-center form-group mt-2">
                                                <div class="col-sm-12">
                                                    <label for="note">สาเหตุ / วิธีแก้ไข</label>
                                                    @error('note')
                                                        <label>
                                                            <span class="text-danger">{{$message}}</span>
                                                        </label>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control col-sm-6" name="note" placeholder="note">
                                                </div>
                                            </div>

                                            <div class="row align-items-center form-group mt-2">
                                                <div class="col-sm-12">
                                                    <label for="price">ราคา</label>
                                                    @error('price')
                                                        <label>
                                                            <span class="text-danger">{{$message}}</span>
                                                        </label>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-12">
                                                    <input type="number" class="form-control col-sm-6" name="price" placeholder="price">
                                                </div>
                                            </div>

                                            <div class="row align-items-center form-group mt-2">
                                                <div class="col-sm-12">
                                                    <label for="guaranty">หลักประกัน</label>
                                                    @error('fileImage')
                                                        <label>
                                                            <span class="text-danger">{{$message}}</span>
                                                        </label>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control col-sm-6" name="guaranty" placeholder="guaranty">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row-reverse bd-highlight mt-4">
                                        <button type="submit" name="submit" class="btn btn-success col-sm-2">เพิ่มข้อมูล</button>
                                        &nbsp;&nbsp;
                                        <button class="btn btn-secondary col-sm-1" type="reset">ยกเลิก</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                   
                    <div class="card">
                        <div class="card-header" style="font-size: 24px;">ตารางข้อมูล แจ้งซ่อม</div>
                        <div class="table-responsive">
                            @if($transaction->count()>0)
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                    <th scope="col">ลำดับ</th>
                                    <th scope="col">รหัสผู้แจ้งซ่อม</th>
                                    <th scope="col">ชื่ออุปกรณ์</th>
                                    <th scope="col">ปัญหางานซ่อม</th>
                                    <th scope="col">หมวดหมู่อุปกรณ์</th>
                                    <th scope="col">วันที่กำหนด </th>
                                    <th scope="col">สถานะ </th>
                                    <th scope="col"><center>เพิ่มเติม</center></th>
                                    <th scope="col"><center>แก้ไข</center></th>
                                    <th scope="col"><center>ลบ</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $transaction as $row )
                                    <tr>
                                        <th>{{$transaction->firstItem()+$loop->index}}</th>
                                       
                                        <td>{{$row->user_id}}</td> 
                                        <td>{{$row->name}}</td> 
                                        <td>{{$row->problem}}</td> 
                                        <td>{{$row->category}}</td> 
                                        <td>{{$row->set_at}}</td> 
                                        <td>{{$row->status}}</td> 
                                        <td>
                                        
                                        </td>
                                        <td>
                                            <center><a href="{{url('/category/edit/'.$row->id)}}" class="btn btn-warning">แก้ไข</a></center>
                                        </td>
                                        <td>
                                            <center><a href="{{url('/category/delete/'.$row->id)}}" class="btn btn-danger"
                                            onclick="return confirm('คุณต้องการลบข้อมูลบริการหรือไม่?')">ลบ</a></center>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                                <h3 style="color:red; text-align:center ;padding-top: 20px; padding-bottom: 20px">-- ไม่มีข้อมูล ธุรกรรมแจ้งซ่อม --</h3>
                            @endif
                        </div>
                        {{$transaction->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
