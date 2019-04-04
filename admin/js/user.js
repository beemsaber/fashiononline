$(function() {
  
$(".select2").select2();
$("#user_status").select2({
    minimumResultsForSearch: -1   // ปิด Textbox ของ select2 ตอนเลือก listbox
});

  // show province
  //ดึงข้อมูล เอกสาร จากไฟล์ get_datalist.php
  $.ajax({
      url:"php/get_datalist.php",
      dataType: "json", //กำหนดให้มีรูปแบบเป็น Json
      data:{show_province:'show_province'}, //ส่งค่าตัวแปร show_province ไปที่ get_province.php เพื่อดึงข้อมูล province
      success:function(data){                        
          //วนลูปแสดงข้อมูล ที่ได้จาก ตัวแปร data
          $.each(data, function( index, value ) {
              //แทรก Elements ใน id med_docType  ด้วยคำสั่ง append
                $("#user_province").append("<option value='"+ value.province_id +"'> " + value.province_name + "</option>");
          });
      }
  }); // show province

  $("#user_name").keydown(function(event) {
    $("#form_user_name").removeClass();
    $("#form_user_name").addClass("form-group");
    $("#label_user_name").removeClass();
    $("#label_user_name").addClass("control-label");
    $("#user_name").removeClass();
    $("#user_name").addClass("form-control");
  });

  $("#user_email").keydown(function(event) {
    $("#form_user_email").removeClass();
    $("#form_user_email").addClass("form-group");
    $("#label_user_email").removeClass();
    $("#label_user_email").addClass("control-label");
    $("#user_email").removeClass();
    $("#user_email").addClass("form-control");
  });

  $("#user_username").keydown(function(event) {
    $("#form_user_username").removeClass();
    $("#form_user_username").addClass("form-group");
    $("#label_user_username").removeClass();
    $("#label_user_username").addClass("control-label");
    $("#user_username").removeClass();
    $("#user_username").addClass("form-control");
  });

  $("#user_password").keydown(function(event) {
    $("#form_user_password").removeClass();
    $("#form_user_password").addClass("form-group");
    $("#label_user_password").removeClass();
    $("#label_user_password").addClass("control-label");
    $("#user_password").removeClass();
    $("#user_password").addClass("form-control");
  });

  $("#user_cpassword").keydown(function(event) {
    $("#form_user_cpassword").removeClass();
    $("#form_user_cpassword").addClass("form-group");
    $("#label_user_cpassword").removeClass();
    $("#label_user_cpassword").addClass("control-label");
    $("#user_cpassword").removeClass();
    $("#user_cpassword").addClass("form-control");
  });

  $("#user_status").change(function(){
    $("#form_user_status").removeClass();
    $("#form_user_status").addClass("form-group");
    $("#label_user_status").removeClass();
    $("#label_user_status").addClass("control-label");
  });

  $('#save').click(function() {
    if($('#user_name').val() == '')
    {
      $("#form_user_name").addClass("form-group has-danger");
      $("#label_user_name").addClass("text-danger");
      $("#user_name").addClass("form-control form-control-danger");
      $('#user_name').focus();     
      swal({
          title: "กรุณาใส่ ชื่อ - นามสกุล",
          text: "",
          type: "error",
          showCancelButton: false,
          confirmButtonColor: "#26dad2",
          confirmButtonText: 'OK!',
      });
      return false;
    }
    else if($('#user_email').val() == '')
    {
      $("#form_user_email").addClass("form-group has-danger");
      $("#label_user_email").addClass("text-danger");
      $("#user_email").addClass("form-control form-control-danger");
      $('#user_email').focus();     
      swal({
          title: "กรุณาใส่ อีเมล",
          text: "",
          type: "error",
          showCancelButton: false,
          confirmButtonColor: "#26dad2",
          confirmButtonText: 'OK!',
      });
      return false;
    }
    else if($('#user_username').val() == '')
    {
      $("#form_user_username").addClass("form-group has-danger");
      $("#label_user_username").addClass("text-danger");
      $("#user_username").addClass("form-control form-control-danger");
      $('#user_username').focus();     
      swal({
          title: "กรุณาใส่ Username",
          text: "",
          type: "error",
          showCancelButton: false,
          confirmButtonColor: "#26dad2",
          confirmButtonText: 'OK!',
      });
      return false;
    }
    else if($('#user_password').val() == '')
    {
      $("#form_user_password").addClass("form-group has-danger");
      $("#label_user_password").addClass("text-danger");
      $("#user_password").addClass("form-control form-control-danger");
      $('#user_password').focus();     
      swal({
          title: "กรุณาใส่ รหัสผ่าน",
          text: "",
          type: "error",
          showCancelButton: false,
          confirmButtonColor: "#26dad2",
          confirmButtonText: 'OK!',
      });
      return false;
    }
    else if($('#user_cpassword').val() == '')
    {
      $("#form_user_cpassword").addClass("form-group has-danger");
      $("#label_user_cpassword").addClass("text-danger");
      $("#user_cpassword").addClass("form-control form-control-danger");
      $('#user_cpassword').focus();     
      swal({
          title: "กรุณายืนยันรหัสผ่าน",
          text: "",
          type: "error",
          showCancelButton: false,
          confirmButtonColor: "#26dad2",
          confirmButtonText: 'OK!',
      });
      return false;
    }
    else if($('#user_password').val() != $('#user_cpassword').val())
    {
      $("#form_user_password").addClass("form-group has-danger");
      $("#label_user_password").addClass("text-danger");
      $("#user_password").addClass("form-control form-control-danger");
      $('#user_password').focus();
      $("#form_user_cpassword").addClass("form-group has-danger");
      $("#label_user_cpassword").addClass("text-danger");
      $("#user_cpassword").addClass("form-control form-control-danger");
      $('#user_password').val("");
      $('#user_cpassword').val("");
      swal({
          title: "รหัสผ่านไม่ตรงกัน",
          text: "",
          type: "error",
          showCancelButton: false,
          confirmButtonColor: "#26dad2",
          confirmButtonText: 'OK!',
      });
      return false;
    }
    else if($('#user_status').val() == '')
    {
      $("#form_user_status").addClass("form-group has-danger");
      $("#label_user_status").addClass("text-danger");
      $("#user_status").addClass("form-control form-control-danger");
      $('#user_status').focus();     
      swal({
          title: "กรุณาเลือกสถานะ",
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
              var form_user = $("#form_user");
              $.ajax({
                  url:"php/user_process.php",
                  type: "post", //กำหนดให้มีรูปแบบเป็น post
                  data:form_user.serialize() + "&add_user=add_user",                  
                  success:function(data){                        
                    if(data == "yes")
                    {
                      swal({   
                          title: "บันทึกข้อมูลเรียบร้อย",   
                          text: "",   
                          type: "success",   
                          confirmButtonColor: "#26dad2",   
                          confirmButtonText: "OK"                          
                      }, function(){   
                          window.location.replace("user.php");
                      }); // swal
                    } // if data == yes
                    else
                    {
                      // alert(data);
                      $("#form_user_username").addClass("form-group has-danger");
                      $("#label_user_username").addClass("text-danger");
                      $("#user_username").addClass("form-control form-control-danger");
                      $('#user_username').val("");
                      $('#user_username').focus();    
                      swal({
                          title: "Username ซ้ำ",
                          text: "",
                          type: "error",
                          showCancelButton: false,
                          confirmButtonColor: "#26dad2",
                          confirmButtonText: 'OK!',
                      });
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
    if($('#user_name').val() == '')
    {
      $("#form_user_name").addClass("form-group has-danger");
      $("#label_user_name").addClass("text-danger");
      $("#user_name").addClass("form-control form-control-danger");
      $('#user_name').focus();     
      swal({
          title: "กรุณาใส่ ชื่อ - นามสกุล",
          text: "",
          type: "error",
          showCancelButton: false,
          confirmButtonColor: "#26dad2",
          confirmButtonText: 'OK!',
      });
      return false;
    }
    else if($('#user_email').val() == '')
    {
      $("#form_user_email").addClass("form-group has-danger");
      $("#label_user_email").addClass("text-danger");
      $("#user_email").addClass("form-control form-control-danger");
      $('#user_email').focus();     
      swal({
          title: "กรุณาใส่ อีเมล",
          text: "",
          type: "error",
          showCancelButton: false,
          confirmButtonColor: "#26dad2",
          confirmButtonText: 'OK!',
      });
      return false;
    }
    else if($('#user_username').val() == '')
    {
      $("#form_user_username").addClass("form-group has-danger");
      $("#label_user_username").addClass("text-danger");
      $("#user_username").addClass("form-control form-control-danger");
      $('#user_username').focus();     
      swal({
          title: "กรุณาใส่ Username",
          text: "",
          type: "error",
          showCancelButton: false,
          confirmButtonColor: "#26dad2",
          confirmButtonText: 'OK!',
      });
      return false;
    }
    else if($('#user_password').val() == '')
    {
      $("#form_user_password").addClass("form-group has-danger");
      $("#label_user_password").addClass("text-danger");
      $("#user_password").addClass("form-control form-control-danger");
      $('#user_password').focus();     
      swal({
          title: "กรุณาใส่ รหัสผ่าน",
          text: "",
          type: "error",
          showCancelButton: false,
          confirmButtonColor: "#26dad2",
          confirmButtonText: 'OK!',
      });
      return false;
    }
    else if($('#user_cpassword').val() == '')
    {
      $("#form_user_cpassword").addClass("form-group has-danger");
      $("#label_user_cpassword").addClass("text-danger");
      $("#user_cpassword").addClass("form-control form-control-danger");
      $('#user_cpassword').focus();     
      swal({
          title: "กรุณายืนยันรหัสผ่าน",
          text: "",
          type: "error",
          showCancelButton: false,
          confirmButtonColor: "#26dad2",
          confirmButtonText: 'OK!',
      });
      return false;
    }
    else if($('#user_password').val() != $('#user_cpassword').val())
    {
      $("#form_user_password").addClass("form-group has-danger");
      $("#label_user_password").addClass("text-danger");
      $("#user_password").addClass("form-control form-control-danger");
      $('#user_password').focus();
      $("#form_user_cpassword").addClass("form-group has-danger");
      $("#label_user_cpassword").addClass("text-danger");
      $("#user_cpassword").addClass("form-control form-control-danger");
      $('#user_password').val("");
      $('#user_cpassword').val("");
      swal({
          title: "รหัสผ่านไม่ตรงกัน",
          text: "",
          type: "error",
          showCancelButton: false,
          confirmButtonColor: "#26dad2",
          confirmButtonText: 'OK!',
      });
      return false;
    }
    else if($('#user_status').val() == '')
    {
      $("#form_user_status").addClass("form-group has-danger");
      $("#label_user_status").addClass("text-danger");
      $("#user_status").addClass("form-control form-control-danger");
      $('#user_status').focus();     
      swal({
          title: "กรุณาเลือกสถานะ",
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
              var form_user = $("#form_user");
              $.ajax({
                  url:"php/user_process.php",
                  type: "post", //กำหนดให้มีรูปแบบเป็น post
                  data:form_user.serialize() + "&edit_user=edit_user",                  
                  success:function(data){                        
                    if(data == "yes")
                    {
                      swal({   
                          title: "บันทึกข้อมูลเรียบร้อย",   
                          text: "",   
                          type: "success",   
                          confirmButtonColor: "#26dad2",   
                          confirmButtonText: "OK"                          
                      }, function(){   
                          window.location.replace("user.php");
                      }); // swal
                    } // if data == yes
                    else
                    {
                      console.log(data);
                    }
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

function delete_user(user_id){
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
            url:"php/user_process.php",
            type: "post", //กำหนดให้มีรูปแบบเป็น Json
            data:{
              delete_user:'delete_user',
              user_id:user_id
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
                    window.location.replace("user.php");
                }); // swal
              } // if data == yes
            } // success data
        }); // ajax
      }// isConfirm
       else {     
          return false;
      } 
  });
}; // #delete button
