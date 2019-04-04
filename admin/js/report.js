// enable fileuploader plugin
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

  function DateConvertJS(abc) {
    changevalue = abc.split('/');
    year = changevalue[2] - 543;
    changevalue = year + '-' + changevalue[1] + '-' + changevalue[0];

    return changevalue;
  }

  $("#cat_id").change(function(){
    $("#form_cat_id").removeClass();
    $("#form_cat_id").addClass("form-group");
    $("#label_cat_id").removeClass();
    $("#label_cat_id").addClass("control-label");
  });

  $('#income').click(function() {
      var start_date = DateConvertJS($('#start_date').val());
      var end_date = DateConvertJS($('#end_date').val());
      // alert(start_date);
      // alert(end_date);
      swal({
            title: "ต้องการดูรายงานรายรับ?",
            text: "",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#26dad2",   
            confirmButtonText: "ตกลง",   
            cancelButtonText: "ยกเลิก",   
            closeOnConfirm: false,
            closeOnCancel: true
          }, function (isConfirm) {
              if (isConfirm) 
              {
                  window.location.replace("report_income.php?start_date="+start_date+"&end_date="+end_date);
              } //isConfirm
              else 
              {
                  return false;
              }
      }); //swal
  }); // #income

  $('#order').click(function() {
      var start_date = DateConvertJS($('#start_date').val());
      var end_date = DateConvertJS($('#end_date').val());
      // alert(start_date);
      // alert(end_date);
      swal({
            title: "ต้องการดูรายงานคำสั่งซื้อ?",
            text: "",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#26dad2",   
            confirmButtonText: "ตกลง",   
            cancelButtonText: "ยกเลิก",   
            closeOnConfirm: false,
            closeOnCancel: true
          }, function (isConfirm) {
              if (isConfirm) 
              {
                  window.location.replace("report_order.php?start_date="+start_date+"&end_date="+end_date);
              } //isConfirm
              else 
              {
                  return false;
              }
      }); //swal
  }); // #income

  $('#product').click(function() {
      var cat_id = $('#cat_id').val();
      // alert(start_date);
      // alert(end_date);
      swal({
            title: "ต้องการดูรายงานสต็อกสินค้า?",
            text: "",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#26dad2",   
            confirmButtonText: "ตกลง",   
            cancelButtonText: "ยกเลิก",   
            closeOnConfirm: false,
            closeOnCancel: true
          }, function (isConfirm) {
              if (isConfirm) 
              {
                  window.location.replace("report_product.php?cat_id="+cat_id);
              } //isConfirm
              else 
              {
                  return false;
              }
      }); //swal
  }); // #income

  
});
