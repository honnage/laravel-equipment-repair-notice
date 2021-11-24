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
                        <div class="card-header" style="font-size: 24px;">ตารางข้อมูลหมวดหมู่</div>
                        <div class="table-responsive">
                            @if($categories->count()>0)
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">ลำดับ</th>
                                        <th scope="col">ภาพประกอบ</th>
                                        <th scope="col" style="width:48%"><center>ชื่อหมวดหมู่</center></th>
                                        <th scope="col"><center>จำนวน</center></th>
                                        <th scope="col"><center>เพิ่มเติม</center></th>
                                        <th scope="col"><center>แก้ไข</center></th>
                                        <th scope="col"><center>ลบ</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $categories as $row )
                                    <tr>
                                        <th>{{$categories->firstItem()+$loop->index}}</th>
                                        <td><img src="{{asset($row->categories_image)}}" width="70px" height="70px"></td>
                                        <td>{{$row->categories_name}}</td>
                                        <td>
                                           
                                        </td>
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
                                <h3 style="color:red; text-align:center ;padding-top: 20px; padding-bottom: 20px">-- ไม่มีข้อมูลหมวดหมู่ --</h3>
                            @endif
                        </div>
                        {{$categories->links()}}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header" style="font-size: 24px;">แบบฟอร์มแก้ไข หมวดหมู่</div>
                        <div class="card-body">
                            <form action="{{url('/category/update/'.$category->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="categories_name">ชื่อหมวดหมู่</label>
                                    <input type="text" class="form-control" name="categories_name" value="{{$category->categories_name}}">
                                </div>
                                @error('categories_name')
                                    <div class="my-2">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
                                @enderror

                                <div class="form-group my-2">
                                    <label for="categories_image">ภาพประกอบ</label>
                                    <input type="file" class="form-control" name="categories_image"  value="{{$category->categories_image}}">
                                </div>
                                @error('categories_image')
                                <div class="my-2">
                                    <span class="text-danger">{{$message}}</span>
                                </div>
                                @enderror

                                <input type="hidden" name="old_image" value="{{$category->categories_image}}">
                                <div class="form-group">
                                    <img src="{{asset($category->categories_image)}}" width="400px" height="400px">
                                </div>
                                <br>
                                <center>
                                    <a class="btn btn-secondary" type="reset" href="{{route('category')}}">ยกเลิก</a> &nbsp;
                                    <input type="submit" value="อัปเดต" class="btn btn-success col-sm-5">
                                </center>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
