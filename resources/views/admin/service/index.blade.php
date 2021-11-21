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
                        <div class="card-header">ตารางข้อมูลบริการ</div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                    <th scope="col">ลำดับ</th>
                                    <th scope="col">ภาพประกอบ</th>
                                    <th scope="col">ชื่อบริการ</th>
                                    <th scope="col">created_at</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $services as $row )
                                    <tr>
                                        <th>{{$services->firstItem()+$loop->index}}</th>
                                        <td>{{$row->service_image}}</td>
                                        <td>{{$row->service_name}}</td>
                                        <td>
                                            @if($row->created_at == NULL)
                                                ไม่ถูกนิยาย
                                            @else
                                                {{Carbon\Carbon::parse($row->created_at)->diffForHumans() }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{url('/department/edit/'.$row->id)}}" class="btn btn-warning">แก้ไข</a>
                                        </td>
                                        <td>
                                            <a href="{{url('/department/softdelete/'.$row->id)}}" class="btn btn-danger">ลบ</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{$services->links()}}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">แบบฟอร์มบริการ</div>
                        <div class="card-body">
                            <form action="{{route('addService')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="service_name">ชื่อบริการ</label>
                                    <input type="text" class="form-control" name="service_name">
                                </div>
                                @error('service_name')
                                    <div class="my-2">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
                                @enderror

                                <div class="form-group">
                                    <label for="service_image">ภาพประกอบ</label>
                                    <input type="file" class="form-control" name="service_image">
                                </div>
                                @error('service_image')
                                <div class="my-2">
                                    <span class="text-danger">{{$message}}</span>
                                </div>
                            @enderror
                                <br>
                                <input type="submit" value="บันทึก" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
