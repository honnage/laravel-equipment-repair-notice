$(document).ready(function(){
    $('.deleteform').click(function(evt){
        var name=$(this).data("name");
        var form=$(this).closest("form");
        evt.preventDefault();
        swal({
            title:`ต้องการลบข้อมูล ${name} หรือไม่ ?`,
            text:"ถ้าลบแล้วไม่สามารถกู้คืนได้",
            icon:"warning",
            buttons:true,
            dangerMode:true
        }).then((wilDelete)=>{
            if(wilDelete){
                form.submit();
            }
        });
    });

    $('.deleteCancel').click(function(evt){
        var name=$(this).data("name");
        var form=$(this).closest("form");
        evt.preventDefault();
        swal({
            title:`ไม่สามารถลบข้อมูลได้ `,
            text:"นอกเหนือจากสถานะ แจ้งซ่อมได้ ",
            icon:"warning",
            // buttons:true,ฟ
            // dangerMode:true
        }).then((wilDelete)=>{
            if(wilDelete){
                form.submit();
            }
        });
    });

    $('.editCancel').click(function(evt){
        var name=$(this).data("name");
        var form=$(this).closest("form");
        evt.preventDefault();
        swal({
            title:`ไม่สามารถแก้ไขได้ `,
            text:"นอกเหนือจากสถานะ แจ้งซ่อมได้ ",
            icon:"warning",
            // buttons:true,ฟ
            // dangerMode:true
        }).then((wilDelete)=>{
            if(wilDelete){
                form.submit();
            }
        });
    });

});