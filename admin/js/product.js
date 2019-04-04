// enable fileuploader plugin

  $('input[name="image_main"]').fileuploader({
        theme: 'dragdrop',
        upload: {
          url: 'php/ajax_upload_file.php',
          data: {image_main:'image_main'},
          type: 'POST',
          enctype: 'multipart/form-data',
          start: true,
          synchron: true,
          beforeSend: null,
          onSuccess: function(result, item) {
              var data = JSON.parse(result);
              // if success
              if (data.isSuccess && data.files[0]) {
                  item.name = data.files[0].name;
                  item.html.find('.column-title > div:first-child').text(data.files[0].name).attr('title', data.files[0].name);
              }

              // if warnings
              if (data.hasWarnings) {
                  for (var warning in data.warnings) {
                    alert(data.warnings);
                  }
                
                item.html.removeClass('upload-successful').addClass('upload-failed');
                // go out from success function by calling onError function
                // in this case we have a animation there
                // you can also response in PHP with 404
                return this.onError ? this.onError(item) : null;
              }
                      
              item.html.find('.column-actions').append('<a class="fileuploader-action fileuploader-action-remove fileuploader-action-success" title="Remove"><i></i></a>');
              setTimeout(function() {
                  item.html.find('.progress-bar2').fadeOut(400);
              }, 400);

              console.log(item.name);
              var image_name = item.name;
              var image_date = $('#datenow').val();
              $.ajax({
                url:"php/product_process.php",
                type: "post", //กำหนดให้มีรูปแบบเป็น post
                data:{
                  image_main:'image_main',
                  image_name:image_name,
                  image_date:image_date
                },
                success:function(data)
                {                     
                  if(data == "yes")
                  {
                    console.log("===================");
                    console.log(data);
                    console.log("===================");
                  } // if data == yes
                  else
                  {
                    console.log("===================");
                    console.log("NO");
                    console.log(data);
                    console.log("===================");
                  }
                }
              }); // ajax

          }, //onSuccess

          onError: function(item) {
            var progressBar = item.html.find('.progress-bar2');
            
            if(progressBar.length > 0) {
              progressBar.find('span').html(0 + "%");
                        progressBar.find('.fileuploader-progressbar .bar').width(0 + "%");
              item.html.find('.progress-bar2').fadeOut(400);
            }
                    
                    item.upload.status != 'cancelled' && item.html.find('.fileuploader-action-retry').length == 0 ? item.html.find('.column-actions').prepend(
                        '<a class="fileuploader-action fileuploader-action-retry" title="Retry"><i></i></a>'
                    ) : null;
          }, //onError
          onProgress: function(data, item) {
              var progressBar = item.html.find('.progress-bar2');
      
              if(progressBar.length > 0) {
                  progressBar.show();
                  progressBar.find('span').html(data.percentage + "%");
                  progressBar.find('.fileuploader-progressbar .bar').width(data.percentage + "%");
              }
          }, //onProgress
          onComplete: null,
        },
        onRemove: function(item) {
          /*$.post('php/ajax_remove_image_main.php', {
            image_main: item.name
          });*/
          var image_name = item.name;
          $.ajax({
            url:"php/ajax_remove_file.php",
            type: "post", //กำหนดให้มีรูปแบบเป็น post
            data:{
              image_main:'image_main',
              image_name:image_name
            },
            success:function(data)
            {                     
              if(data == "yes")
              {
                console.log("===================");
                console.log(data);
                console.log("===================");
              } // if data == yes
              else
              {
                console.log("===================");
                console.log("NO");
                console.log(data);
                console.log("===================");
              }
            }
          }); // ajax
        },
        captions: {
                feedback: 'Drag and drop files here',
                feedback2: 'Drag and drop files here',
                drop: 'Drag and drop files here'
        },
        extensions: null,
  });

$(function() {
  
$(".select2").select2();
$("#cat_id").select2({
    minimumResultsForSearch: -1   // ปิด Textbox ของ select2 ตอนเลือก listbox
});

  // show province
  //ดึงข้อมูล เอกสาร จากไฟล์ get_datalist.php
  $.ajax({
      url:"php/get_datalist.php",
      dataType: "json", //กำหนดให้มีรูปแบบเป็น Json
      data:{show_cat:'show_cat'}, //ส่งค่าตัวแปร show_province ไปที่ get_province.php เพื่อดึงข้อมูล province
      success:function(data){                        
          //วนลูปแสดงข้อมูล ที่ได้จาก ตัวแปร data
          $.each(data, function( index, value ) {
              //แทรก Elements ใน id med_docType  ด้วยคำสั่ง append
                $("#cat_id").append("<option value='"+ value.cat_id +"'> " + value.cat_name + "</option>");
          });
      }
  }); // show province


  $("#product_name").keydown(function(event) {
    $("#form_product_name").removeClass();
    $("#form_product_name").addClass("form-group");
    $("#label_product_name").removeClass();
    $("#label_product_name").addClass("control-label");
    $("#product_name").removeClass();
    $("#product_name").addClass("form-control");
  });

  $("#cat_id").change(function(){
    $("#form_cat_id").removeClass();
    $("#form_cat_id").addClass("form-group");
    $("#label_cat_id").removeClass();
    $("#label_cat_id").addClass("control-label");
  });

  $("#product_price").keydown(function(event) {
    $("#form_product_price").removeClass();
    $("#form_product_price").addClass("form-group");
    $("#label_product_price").removeClass();
    $("#label_product_price").addClass("control-label");
    $("#product_price").removeClass();
    $("#product_price").addClass("form-control");
  });

  $("#product_qty").keydown(function(event) {
    $("#form_product_qty").removeClass();
    $("#form_product_qty").addClass("form-group");
    $("#label_product_qty").removeClass();
    $("#label_product_qty").addClass("control-label");
    $("#product_qty").removeClass();
    $("#product_qty").addClass("form-control");
  });

  $('#save').click(function() {
    if($('#product_name').val() == '')
    {
      $("#form_product_name").addClass("form-group has-danger");
      $("#label_product_name").addClass("text-danger");
      $("#product_name").addClass("form-control form-control-danger");
      $('#product_name').focus();     
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
    else if($('#cat_id').val() == '')
    {
      $("#form_cat_id").addClass("form-group has-danger");
      $("#label_cat_id").addClass("text-danger");
      $("#cat_id").addClass("form-control form-control-danger");
      $('#cat_id').focus();     
      swal({
          title: "กรุณาเลือกประเภทสินค้า",
          text: "",
          type: "error",
          showCancelButton: false,
          confirmButtonColor: "#26dad2",
          confirmButtonText: 'OK!',
      });
      return false;
    }
    else if($('#product_price').val() == '')
    {
      $("#form_product_price").addClass("form-group has-danger");
      $("#label_product_price").addClass("text-danger");
      $("#product_price").addClass("form-control form-control-danger");
      $('#product_price').focus();     
      swal({
          title: "กรุณาใส่ราคาสินค้า",
          text: "",
          type: "error",
          showCancelButton: false,
          confirmButtonColor: "#26dad2",
          confirmButtonText: 'OK!',
      });
      return false;
    }
    else if($('#product_qty').val() == '')
    {
      $("#form_product_qty").addClass("form-group has-danger");
      $("#label_product_qty").addClass("text-danger");
      $("#product_qty").addClass("form-control form-control-danger");
      $('#product_qty').focus();     
      swal({
          title: "กรุณาใส่จำนวนสินค้า",
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
              /*var user_name = $("#user_name").val();
              var user_username = $("#user_username").val();
              var user_password = $("#user_password").val();*/

              var form_product = $("#form_product");
              $.ajax({
                  url:"php/product_process.php",
                  type: "post", //กำหนดให้มีรูปแบบเป็น post
                  data:form_product.serialize() + "&add_product=add_product",                  
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
                          window.location.replace("product.php");
                      }); // swal
                    } // if data == yes
                    else
                    {
                      console.log("can't save product");
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
    if($('#product_name').val() == '')
    {
      $("#form_product_name").addClass("form-group has-danger");
      $("#label_product_name").addClass("text-danger");
      $("#product_name").addClass("form-control form-control-danger");
      $('#product_name').focus();     
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
    else if($('#cat_id').val() == '')
    {
      $("#form_cat_id").addClass("form-group has-danger");
      $("#label_cat_id").addClass("text-danger");
      $("#cat_id").addClass("form-control form-control-danger");
      $('#cat_id').focus();     
      swal({
          title: "กรุณาเลือกประเภทสินค้า",
          text: "",
          type: "error",
          showCancelButton: false,
          confirmButtonColor: "#26dad2",
          confirmButtonText: 'OK!',
      });
      return false;
    }
    else if($('#product_price').val() == '')
    {
      $("#form_product_price").addClass("form-group has-danger");
      $("#label_product_price").addClass("text-danger");
      $("#product_price").addClass("form-control form-control-danger");
      $('#product_price').focus();     
      swal({
          title: "กรุณาใส่ราคาสินค้า",
          text: "",
          type: "error",
          showCancelButton: false,
          confirmButtonColor: "#26dad2",
          confirmButtonText: 'OK!',
      });
      return false;
    }
    else if($('#product_qty').val() == '')
    {
      $("#form_product_qty").addClass("form-group has-danger");
      $("#label_product_qty").addClass("text-danger");
      $("#product_qty").addClass("form-control form-control-danger");
      $('#product_qty').focus();     
      swal({
          title: "กรุณาใส่จำนวนสินค้า",
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
              /*var user_name = $("#user_name").val();
              var user_username = $("#user_username").val();
              var user_password = $("#user_password").val();*/

              var form_product = $("#form_product");
              $.ajax({
                  url:"php/product_process.php",
                  type: "post", //กำหนดให้มีรูปแบบเป็น post
                  data:form_product.serialize() + "&edit_product=edit_product",                  
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
                          window.location.replace("product.php");
                      }); // swal
                    } // if data == yes
                    else
                    {
                      console.log("can't save product");
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

function delete_product(product_id){
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
            url:"php/product_process.php",
            type: "post", //กำหนดให้มีรูปแบบเป็น Json
            data:{
              delete_product:'delete_product',
              product_id:product_id
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
                    window.location.replace("product.php");
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

function delete_image(image_id){
  var product_id = $('#product_id').val();
  swal({   
          title: "คุณต้องการลบรูป?",
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
            url:"php/product_process.php",
            type: "post", //กำหนดให้มีรูปแบบเป็น Json
            data:{
              delete_image:'delete_image',
              image_id:image_id
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
                    window.location.replace("product_edit.php?product_id="+product_id);
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
