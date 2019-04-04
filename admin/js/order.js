
function delete_order_main(order_id,payment_date){
  swal({   
          title: "คุณต้องการลบคำสั่งซื้อ?",
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
        $.ajax({
            url:"php/order_process.php",
            type: "post", //กำหนดให้มีรูปแบบเป็น Json
            data:{
              delete_order:'delete_order',
              order_id:order_id,
              payment_date:payment_date
            },
            success:function(data){                        
              if(data == "yes")
              {
                swal({   
                    title: "ลบข้อมูลเรียบร้อย",   
                    text: "",   
                    type: "success",   
                    confirmButtonColor: "#26dad2",   
                    confirmButtonText: "OK"                          
                }, function(){   
                    window.location.replace("order.php");
                }); // swal
              } // if data == yes
              else
              {
                console.log("no");
                console.log(data);
              }
            } // success data
        }); // ajax
      }// isConfirm
       else {     
          return false;
      } 
  });
}; // #delete button