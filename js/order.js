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
                url:"php/order_process.php",
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

  $("#p_bank").change(function(){
    $("#form_p_bank").removeClass();
    $("#form_p_bank").addClass("form-group");
    $("#label_p_bank").removeClass();
    $("#label_p_bank").addClass("control-label");
  });

  $("#p_date").change(function(){
    $("#form_p_date").removeClass();
    $("#form_p_date").addClass("form-group");
    $("#label_p_date").removeClass();
    $("#label_p_date").addClass("control-label");
    $("#p_date").removeClass();
    $("#p_date").addClass("form-control");
  });

  $("#p_price").keydown(function(event) {
    $("#form_p_price").removeClass();
    $("#form_p_price").addClass("form-group");
    $("#label_p_price").removeClass();
    $("#label_p_price").addClass("control-label");
    $("#p_price").removeClass();
    $("#p_price").addClass("form-control");
  });

  $("#image_main").change(function(){
    $("#form_order_image_main").removeClass();
    $("#form_order_image_main").addClass("form-group");
    $("#label_order_image_main").removeClass();
    $("#label_order_image_main").addClass("control-label");
    $("#image_main").removeClass();
    $("#image_main").addClass("form-control");
  });

  $('#save').click(function() {
    if($('#p_bank').val() == '')
    {
      $("#form_p_bank").addClass("form-group has-danger");
      $("#label_p_bank").addClass("text-danger");
      $("#p_bank").addClass("form-control form-control-danger");
      $('#p_bank').focus();     
      swal({
          title: "กรุณาเลือกธนาคารที่โอน",
          text: "",
          type: "error",
          showCancelButton: false,
          confirmButtonColor: "#26dad2",
          confirmButtonText: 'OK!',
      });
      return false;
    }
    else if($('#p_date').val() == '')
    {
      $("#form_p_date").addClass("form-group has-danger");
      $("#label_p_date").addClass("text-danger");
      $("#p_date").addClass("form-control form-control-danger");
      $('#p_date').focus();     
      swal({
          title: "กรุณาใส่วันที่โอน",
          text: "",
          type: "error",
          showCancelButton: false,
          confirmButtonColor: "#26dad2",
          confirmButtonText: 'OK!',
      });
      return false;
    }
    else if($('#p_price').val() == '')
    {
      $("#form_p_price").addClass("form-group has-danger");
      $("#label_p_price").addClass("text-danger");
      $("#p_price").addClass("form-control form-control-danger");
      $('#p_price').focus();     
      swal({
          title: "กรุณาใส่จำนวนเงินที่โอน",
          text: "",
          type: "error",
          showCancelButton: false,
          confirmButtonColor: "#26dad2",
          confirmButtonText: 'OK!',
      });
      return false;
    }
    else if($('#p_price').val() < $('#order_price').val())
    {
      $("#form_p_price").addClass("form-group has-danger");
      $("#label_p_price").addClass("text-danger");
      $("#p_price").addClass("form-control form-control-danger");
      $('#p_price').focus();     
      swal({
          title: "กรุณาใส่จำนวนเงินที่ถูกต้อง",
          text: "",
          type: "error",
          showCancelButton: false,
          confirmButtonColor: "#26dad2",
          confirmButtonText: 'OK!',
      });
    }
    /*else if($('#image_main').length == 0)
    {
      $("#form_order_image_main").addClass("form-group has-danger");
      $("#label_order_image_main").addClass("text-danger");
      $("#image_main").addClass("form-control form-control-danger");
      $('#image_main').focus();     
      swal({
          title: "กรุณาใส่หลักฐานการโอนโอน",
          text: "",
          type: "error",
          showCancelButton: false,
          confirmButtonColor: "#26dad2",
          confirmButtonText: 'OK!',
      });
      return false;
    }*/
    else
    {
      swal({   
            title: "คุณต้องการแจ้งโอน?",
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
              var form_payment = $("#form_payment");
              $.ajax({
                  url:"php/order_process.php",
                  type: "post", //กำหนดให้มีรูปแบบเป็น post
                  data:form_payment.serialize() + "&add_payment=add_payment",
                  success:function(data)
                  {                        
                    if(data == "yes")
                    {
                      console.log(data);
                      swal({   
                          title: "แจ้งโอนเงินเรียบร้อย",   
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
                      console.log("can't save payment");
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

});

