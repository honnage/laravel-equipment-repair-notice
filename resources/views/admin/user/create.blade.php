@extends('layouts.index')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <div class="d-flex justify-content-between mt-4">
                <div class=" flex-row-reverse  ">
                    @if(isset($transaction))
                        <h1 class="text-left">แก้ไขข้อมูลสมาชิก</h1>
                    @else
                        <h1 class="text-left">เพิ่มข้อมูลสมาชิก</h1>
                    @endif
                </div>
            </div>

            <br>
            <div class=" mb-4">
                <form method="POST" action="{{ route('addUser') }}">
                    {{csrf_field()}}
                
                    <div class="form-group row ">
                        <label for="firstname" class="col-sm-1 col-form-label">ชื่อจริง</label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control" name="firstname" required placeholder="กรณาป้อนชื่อจริง">
                        </div>
                        <div class="col-sm-2">
                            @error('firstname')
                                <strong>
                                    <span class="text-danger">{{$message}}</span>
                                </strong>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row my-3">
                        <label for="lastname" class="col-sm-1 col-form-label">นามสกุล</label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control" name="lastname" required placeholder="กรณาป้อนนามสกุล">
                        </div>
                        <div class="col-sm-2">
                            @error('lastname')
                                <strong>
                                    <span class="text-danger">{{$message}}</span>
                                </strong>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row my-3">
                        <label for="gender" class="col-sm-1 col-form-label">เพศ</label>
                        <div class="col-sm-5 form-group " >
                            &nbsp;&nbsp;
                            <label >
                                <input type="radio" id="gender" name="gender" value="ชาย" autocomplete="gender" wire:model.defer="state.gender" autocomplete="gender"> &nbsp;&nbsp;
                                <label for="male">ชาย </label>
                            </label> 
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label>
                                <input type="radio" id="gender" name="gender" value="หญิง" autocomplete="gender" wire:model.defer="state.gender" autocomplete="gender"> &nbsp;&nbsp;
                                <label for="female">หญิง </label>
                            </label>
                        </div>
                        <div class="col-sm-2">
                            @error('gender')
                                <strong>
                                    <span class="text-danger">{{$message}}</span>
                                </strong>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row my-3">
                        <label for="phone" class="col-sm-1 col-form-label">เบอร์โทร</label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control" name="phone" required placeholder="กรณาป้อนเบอร์โทร">
                        </div>
                        <div class="col-sm-2">
                            @error('phone')
                                <strong>
                                    @if ($message == "The phone has already been taken.")
                                        <span class="text-danger">หมายเลขโทรศัพท์นี้ถูกนำไปใช้แล้ว</span>
                                    @elseif ($message == "The phone must not be greater than 10 characters.")
                                        <span class="text-danger">หมายเลขโทรศัพท์ต้องไม่เกิน 10 ตัว</span>
                                    @elseif ($message == "The phone must be at least 10 characters.")
                                        <span class="text-danger">หมายเลขโทรศัพท์ต้องมีอย่างน้อย 10 ตัว</span>
                                    @else
                                        <span class="text-danger">{{$message}}</span>
                                    @endif
                                </strong>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row my-3">
                        <label for="address" class="col-sm-1 col-form-label">ที่อยู่</label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control" name="address" required placeholder="กรณาป้อนที่อยู่">
                        </div>
                        <div class="col-sm-2">
                            @error('address')
                                <strong>
                                    <span class="text-danger">{{$message}}</span>
                                </strong>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row my-3">
                        <label for="department" class="col-sm-1 col-form-label">ตำแหน่ง</label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control" name="department" required placeholder="กรณาป้อนตำแหน่ง">
                        </div>
                        <div class="col-sm-2">
                            @error('department')
                                <strong>
                                    <span class="text-danger">{{$message}}</span>
                                </strong>
                            @enderror
                        </div>
                    </div>
               

                    <div class="form-group row my-3">
                        <label for="email" class="col-sm-1 col-form-label">อีเมล</label>
                        <div class="col-sm-5">
                          <input type="email" class="form-control" name="email" required placeholder="กรณาป้อนอีเมล">
                        </div>
                        <div class="col-sm-2">
                            @error('email')
                                <strong>
                                    <span class="text-danger">{{$message}}</span>
                                </strong>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row my-3">
                        <label for="password" class="col-sm-1 col-form-label">รหัสผ่าน</label>
                        <div class="col-sm-5">
                          <input type="password" class="form-control" name="password" required placeholder="กรณาป้อนรหัสผ่าน">
                        </div>
                        <div class="col-sm-2">
                            @error('password')
                                <strong>
                                    @if ($message == "The password confirmation does not match.")
                                        <span class="text-danger">ยืนยันรหัสผ่านไม่ตรงกัน</span>
                                    @elseif ($message == "The password must be at least 8 characters.")
                                        <span class="text-danger">รหัสผ่านต้องมีอย่างน้อย 8 ตัวอักษร </span>
                                    @else
                                        <span class="text-danger">{{$message}}</span>
                                    @endif
                                </strong>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row my-3">
                        <label for="password_confirmation" class="col-sm-1 col-form-label">ยืนยันรหัสผ่าน</label>
                        <div class="col-sm-5">
                          <input id="password_confirmation"  type="password" name="password_confirmation" required autocomplete="new-password"  class="form-control" placeholder="กรณายืนยันรหัสผ่าน">
                        </div>
                    </div>

                    
                      
                    <div class="form-group row my-3">
                        <div class=" bd-highlight mt-4">
                            <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                            <button class="btn btn-secondary col-sm-1" type="reset">ยกเลิก</button> 
                            &nbsp;&nbsp;     
                            <input type="submit" name="submit" value="{{isset($transaction)? "แก้ไข":"ลงทะเบียน"}}" class="{{isset($transaction)? "btn btn-warning col-sm-2":"btn btn-success col-sm-2"}}">
                        </div>
                    </div>
                </form>
            </div>
          
        </div>
    </main>
    

@endsection