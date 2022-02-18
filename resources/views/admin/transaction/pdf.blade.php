<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <title>แจ้งซ่อมครุภัณฑ์</title>
</head>
<body>
    <h1 style="text-align: center">แบบฟอร์มแจ้งซ่อม</h1>
    <h3>ข้อมูลผู้แจ้ง</h3>
    <table class="table table-striped table-bordered" >
        <tbody>
          <tr>
            <th style="width: 25%">ชื่อ - นามสกุล</th>
            <td style="width: 75%">{{$transaction->user->firstname}} {{$transaction->user->lastname}}</td>
          </tr>
          <tr>
            <th style="width: 25%">ตำแหน่ง</th>
            <td style="width: 75%">{{$transaction->user->department}} </td>
          </tr>
          <tr>
            <th style="width: 25%">เบอร์โทร</th>
            <td style="width: 75%">{{$transaction->user->phone}}</td>
          </tr>
          <tr>
            <th style="width: 25%">อีเมล</th>
            <td style="width: 75%">{{$transaction->user->email}}</td>
          </tr>
          
        </tbody>
    </table>
    <br>

    <h3>ข้อมูลการแจ้งซ่อม</h3>
    <table class="table table-striped table-bordered">
        <tbody>
          <tr>
            <th style="width: 25%">รหัสแจ้งซ่อม</th>
            <td style="width: 75%">{{$transaction->id}}</td>
          </tr>
          <tr>
            <th style="width: 25%">ชื่อครุภัณฑ์</th>
            <td style="width: 75%">{{$transaction->Equipment->name}}</td>
          </tr>
     
        
          <tr>
            <th style="width: 25%">อาการหรือปัญหา</th>
            <td style="width: 75%">{{$transaction->problem}} </td>
          </tr>
          <tr>
            <th style="width: 25%">วันที่แจ้งซ่อม</th>
            <td style="width: 75%">{{$transaction->created_at}} </td>
          </tr>
          <tr>
            <th style="width: 25%">วันที่กำหนดส่งคืน</th>
            <td style="width: 75%">{{$transaction->set_at}} </td>
          </tr>
          <tr>
            <th style="width: 25%">สาเหต / รายละเอียด</th>
            <td style="width: 75%">
                @if ($transaction->details == null) 
                    -
                @else
                    {{$transaction->details}} 
                @endif
            </td>
          </tr>
          <tr>
            <th style="width: 25%">สถานะ</th>
            <td style="width: 75%"> 
                @if ( $transaction->status == "แจ้งซ่อม" )                    
                    <span style="color:#2591f7; font-weight: 750">{{$transaction->status}} </span>                       
                @elseif ( $transaction->status == "กำลังซ่อม" )
                    <span style="color:#d38510; font-weight: 750">{{$transaction->status}} </span>                            
                @elseif ( $transaction->status == "เรียบร้อย" )
                    <span style="color:green; font-weight: 750">{{$transaction->status}} </span>
                @else
                    <span style="color:#757575; font-weight: 750">{{$transaction->status}} </span>
                @endif
            </td>
          </tr>
          <tr>
            <th style="width: 25%">ราคา</th>
            <td style="width: 75%">
                @if ($transaction->price == null) 
                    -
                @else
                    {{$transaction->price}} 
                @endif
        
            </td>
          </tr>
          <tr>
            <th style="width: 25%">ประกัน</th>
            <td style="width: 75%">
                @if ($transaction->guaranty == null) 
                    -
                @else
                    {{$transaction->price}} 
                @endif
            </td>
          </tr>
        </tbody>
    </table>
</body>
</html>