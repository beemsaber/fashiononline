// enable fileuploader plugin

$(function() {

  $("#cat_name").keydown(function(event) {
    $("#form_cat_name").removeClass();
    $("#form_cat_name").addClass("form-group");
    $("#label_cat_name").removeClass();
    $("#label_cat_name").addClass("control-label");
    $("#cat_name").removeClass();
    $("#cat_name").addClass("form-control");
  });
  
  $('#save').click(function() {
    if($('#cat_name').val() == '')
    {
      $("#form_cat_name").addClass("form-group has-danger");
      $("#label_cat_name").addClass("text-danger");
      $("#cat_name").addClass("form-control form-control-danger");
      $('#cat_name').focus();     
      swal({
          title: "กรุณาใส่ชื่อประเภทสินค้า",
          text: "",
          type: "error",
          showCancelButton: false,
          confirmButtonColor: "#26dad2",
          confirmButtonText: 'OK!',
      });
      return false;
    }
    else
    {
      swal({   
            title: "คุณต้องการบันทึกข้อมูล?",
            text: "",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#26dad2",   
            confirmButtonText: "บันทึก",   
            cancelButtonText: "ยกเลิก",   
            closeOnConfirm: false,
            closeOnCancel: true 
        }, function(isConfirm){   
            if (isConfirm)
            {
              var form_cat = $("#form_cat");
              $.ajax({
                  url:"php/cat_process.php",
                  type: "post", //กำหนดให้มีรูปแบบเป็น post
                  data:form_cat.serialize() + "&add_cat=add_cat",                  
                  success:function(data)
                  {                        
                    if(data == "yes")
                    {
                      swal({   
                          title: "บันทึกข้อมูลเรียบร้อย",   
                          text: "",   
                          type: "success",   
                          confirmButtonColor: "#26dad2",   
                          confirmButtonText: "OK"                          
                      }, function(){   
                          window.location.replace("categories.php");
                      }); // swal
                    } // if data == yes
                    else
                    {
                      console.log("can't save categories");
                      console.log(data);
                      return false;
                    } // else data == no
                  } // success data
              }); // ajax
            }// isConfirm
             else {     
                return false;
            } 
        });
    }
  }); // #save button

  $('#edit').click(function() {
    if($('#cat_name').val() == '')
    {
      $("#form_cat_name").addClass("form-group has-danger");
      $("#label_cat_name").addClass("text-danger");
      $("#cat_name").addClass("form-control form-control-danger");
      $('#cat_name').focus();     
      swal({
          title: "กรุณาใส่ชื่อสินค้า",
          text: "",
          type: "error",
          showCancelButton: false,
          confirmButtonColor: "#26dad2",
          confirmButtonText: 'OK!',
      });
      return false;
    }
    else
    {
      swal({   
            title: "คุณต้องการบันทึกข้อมูล?",
            text: "",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#26dad2",   
            confirmButtonText: "บันทึก",   
            cancelButtonText: "ยกเลิก",   
            closeOnConfirm: false,
            closeOnCancel: true 
        }, function(isConfirm){   
            if (isConfirm)
            {
              var form_cat = $("#form_cat");
              $.ajax({
                  url:"php/cat_process.php",
                  type: "post", //กำหนดให้มีรูปแบบเป็น post
                  data:form_cat.serialize() + "&edit_cat=edit_cat",                  
                  success:function(data)
                  {                        
                    if(data == "yes")
                    {
                      swal({   
                          title: "บันทึกข้อมูลเรียบร้อย",   
                          text: "",   
                          type: "success",   
                          confirmButtonColor: "#26dad2",   
                          confirmButtonText: "OK"                          
                      }, function(){   
                          window.location.replace("categories.php");
                      }); // swal
                    } // if data == yes
                    else
                    {
                      console.log("can't edit categories");
                      console.log(data);
                      return false;
                    } // else data == no
                  } // success data
              }); // ajax
            }// isConfirm
             else {     
                return false;
            } 
        });
    }
  }); // #edit button
});

function delete_cat(cat_id){
  swal({   
          title: "คุณต้องการลบข้อมูล?",
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
            url:"php/cat_process.php",
            type: "post", //กำหนดให้มีรูปแบบเป็น Json
            data:{
              delete_cat:'delete_cat',
              cat_id:cat_id
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
                    window.location.replace("categories.php");
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
