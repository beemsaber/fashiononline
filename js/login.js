$(function(){
	$('#login').click(function() {
		var username = $('#username').val();
		var password = $('#password').val();
		var remember_check = $('#remember_check').is( ':checked' );
		var actionpage = $('#actionpage').val();
		//alert(remember_check);
		$.ajax({
			url:"php/login_process.php",
			type: "post", //กำหนดให้มีรูปแบบเป็น post
			data:{
				login:'login',
				username:username,
				password:password,
				remember_check:remember_check,
				actionpage:actionpage
			},
			success:function(data)
			{                     
				if(data == "yes")
				{
					swal({   
					  title: "ยินดีต้อนรับเข้าสู่ระบบ",   
					  text: "",   
					  type: "success",   
					  confirmButtonColor: "#26dad2",   
					  confirmButtonText: "OK"                          
					}, function(){
						// alert(data);
					  window.location.replace("index.php");
					}); // swal
				} // if data == yes
				else if(data == "checkout")
				{
					swal({   
					  title: "ยินดีต้อนรับเข้าสู่ระบบ",   
					  text: "",   
					  type: "success",   
					  confirmButtonColor: "#26dad2",   
					  confirmButtonText: "OK"                          
					}, function(){
						// alert(data);
					  window.location.replace("checkout.php");
					}); // swal
				} // if data == yes
				else
				{
					swal({
				          title: "รหัสผ่านหรือชื่อผู้ใช้งานไม่ถูกต้อง",   
				          text: "",
				          type: "error",
				          confirmButtonColor: "#26dad2",
				          confirmButtonText: "OK"
				      }, function(){
				      	// alert(data);
				          //window.location.replace("login.php");
					}); // swal
				} // else data == no
			}
	  	}); // ajax
	});

	$('#logout').click(function() {
      swal({   
            title: "คุณต้องการออกจากระบบ?",
            text: "",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#26dad2",   
            confirmButtonText: "ตกลง",   
            cancelButtonText: "ยกเลิก",   
            closeOnConfirm: false,
            closeOnCancel: true 
        },function (isConfirm) {
          if (isConfirm) 
			{
				$.ajax({
				url:"php/login_process.php",
				type: "post", //กำหนดให้มีรูปแบบเป็น post
				data:{
					logout:'logout'
				},
				success:function(data)
				{                   
					if(data == "yes")
					{
						swal({   
						  title: "ออกจากระบบเรียบร้อย",   
						  text: "",   
						  type: "success",   
						  confirmButtonColor: "#26dad2",   
						  confirmButtonText: "OK"                          
						}, function(){
							//alert(data);
						  window.location.replace("login.php");
						}); // swal
					} // if data == yes
					else
					{
						console.log("no");
						console.log(data);
					} // else data == no
				}
			}); // ajax
          } //isConfirm
          else 
          {
              return false;
          }
      }); //swal
  	}); // logout1 click

}); // function บบสุด