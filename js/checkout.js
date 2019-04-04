var total_price = parseInt($('#total_price').val());
if($('#ems').attr('checked'))
{
	$('#type_delivery').val("Ems");
	var grand_total = total_price + 100;
  var grand_total_number = Number(grand_total).toLocaleString('en');
	$('#money_delivery_message').text("100 บาท");
	$('#money_delivery').val(100);
	$('#grand_total').text(grand_total_number +" บาท");
	$('#grand_total_price').val(grand_total);
}

$("#ems").click(function() {
	$('#type_delivery').val("Ems");
	var grand_total = total_price + 100;
  var grand_total_number = Number(grand_total).toLocaleString('en');
	$('#money_delivery_message').text("100 บาท");
	$('#money_delivery').val(100);
	$('#grand_total').text(grand_total_number +" บาท");
	$('#grand_total_price').val(grand_total);
});

$("#register").click(function() {
	$('#type_delivery').val("ลงทะเบียน");
	var grand_total = total_price + 60;
  var grand_total_number = Number(grand_total).toLocaleString('en');
	$('#money_delivery_message').text("60 บาท");
	$('#money_delivery').val(60);
	$('#grand_total').text(grand_total_number +" บาท");
	$('#grand_total_price').val(grand_total);
});

if($('#money_bank').attr('checked'))
{
	$('#type_payment').val("โอนเงินผ่านธนาคาร");
}

$("#money_bank").click(function() {
	$('#type_payment').val("โอนเงินผ่านธนาคาร");
});

$("#save").click(function() {
  swal({   
      title: "ยืนยันการสั่งซื้อ",
      text: "",   
      type: "warning",   
      showCancelButton: true,   
      confirmButtonColor: "#26dad2",   
      confirmButtonText: "ตกลง",   
      cancelButtonText: "ยกเลิก",   
      closeOnConfirm: false,
      closeOnCancel: true 
  }, function(isConfirm){   
      if (isConfirm)
      {
        var form_order_detail = $("#form_order_detail");
        $.ajax({
            url:"php/order_process.php",
            type: "post", //กำหนดให้มีรูปแบบเป็น post
            data:form_order_detail.serialize() + "&user_order=user_order",                  
            success:function(data){                        
              if(data == "yes")
              {
                  console.log(data);
                swal({   
                    title: "สั่งซื้อสินค้าเรียบร้อย",   
                    text: "",   
                    type: "success",   
                    confirmButtonColor: "#26dad2",   
                    confirmButtonText: "OK"
                }, function(){   
                    window.location.replace("myaccount.php");
                }); // swal
              } // if data == yes
              else
              {
                swal({   
                    title: "ไม่สามารถสั่งซื้อสินค้าได้",   
                    text: "",   
                    type: "error",   
                    confirmButtonColor: "#26dad2",   
                    confirmButtonText: "OK"                          
                }, function(){
                    console.log(data);
                    //window.location.replace("myaccount.php");
                }); // swal
                return false;
              } // else data == no
            } // success data
        }); // ajax
      }// isConfirm
       else {     
          return false;
      } 
  });
});