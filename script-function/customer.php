<script>

  $(function() {

    $('#btnEditCus').hide();
    $('#btnDeleteCus').hide();
    $('#btncleanCus').hide();

    
    $('#ID_txt').val("");
    show_data();
    select_task();
  })



  $("#btnEditCus").click(function() {

      $.confirm({
        title: 'แจ้งเตือน!',
        content: 'ต้องการจะแก้ไขข้อมูล ใช่ หรือ ไม่?',
        type: 'orange',
        autoClose: 'cancel|8000',
        buttons: {
          cancel:  {text: 'ยกเลิก'},
          confirm: {
            btnClass: 'btn-primary',
            text: 'ตกลง',
            action: function() {
              editData();
            }
          }
        }
      });
  });


  $("#btncleanCus").click(function() {
        $('#btnSaveCus').show();
        $('#btnEditCus').hide();
        $('#btnDeleteCus').hide();
        $('#btncleanCus').hide();
        $('#txt_fname').val("");
        $('#txt_lname').val("");
        $('#txt_email').val("");
        $('#txt_tel').val("");
        $('#select_task').val(0);
        $('#ID_txt').val("");

        $(".chk_Cus").prop("checked", false);
    });

  function saveData() {
    var txt_fname= $('#txt_fname').val();
    var txt_lname= $('#txt_lname').val();
    var txt_email= $('#txt_email').val();
    var txt_tel= $('#txt_tel').val();
    var select_task= $('#select_task').val();

    var text = "";

    if (txt_fname == "") {
      text = "กรุณากรอกชื่อ";
      showDialogFailed(text);
      return;
    }

    if (txt_lname == "") {
      text = "กรุณากรอกนามสกุล";
      showDialogFailed(text);
      return;
    }

    if (txt_email == "") {
      text = "กรุณากรอกอีเมล";
      showDialogFailed(text);
      return;
    }

    if (txt_tel == "") {
      text = "กรุณากรอกเบอร์โทร";
      showDialogFailed(text);
      return;
    }

    if(select_task == 0){
      text = "กรุณาเลือกสถานะ";
      showDialogFailed(text);
      return;
    }

    $.ajax({
      url: "process/customer.php",
      type: 'POST',
      data: {
        'FUNC_NAME': 'saveData',
        'txt_fname': txt_fname,
        'txt_lname': txt_lname,
        'txt_email': txt_email,
        'txt_tel': txt_tel,
        'select_task': select_task
      },
      success: function(result) {
        show_data();
        $('#txt_fname').val("");
        $('#txt_lname').val("");
        $('#txt_email').val("");
        $('#txt_tel').val("");
        $('#select_task').val(0);
      
   
      }
    });
  }

  function editData() {
    var ID_txt = $('#ID_txt').val();

    var txt_fname= $('#txt_fname').val();
    var txt_lname= $('#txt_lname').val();
    var txt_email= $('#txt_email').val();
    var txt_tel= $('#txt_tel').val();
    var select_task= $('#select_task').val();


    if (txt_fname == "") {
      text = "กรุณากรอกชื่อ";
      showDialogFailed(text);
      return;
    }

    if (txt_lname == "") {
      text = "กรุณากรอกนามสกุล";
      showDialogFailed(text);
      return;
    }

    if (txt_email == "") {
      text = "กรุณากรอกอีเมล";
      showDialogFailed(text);
      return;
    }

    if (txt_tel == "") {
      text = "กรุณากรอกเบอร์โทร";
      showDialogFailed(text);
      return;
    }

    if(select_task == 0){
      text = "กรุณาเลือกสถานะ";
      showDialogFailed(text);
      return;
    }

    $.ajax({
      url: "process/customer.php",
      type: 'POST',
      data: {
        'FUNC_NAME': 'editData',
        'txt_fname': txt_fname,
        'txt_lname': txt_lname,
        'txt_email': txt_email,
        'txt_tel': txt_tel,
        'select_task': select_task,
        'ID_txt':ID_txt
      },
      success: function(result) {
        showDialogSuccess(result);
        show_data();
        $('#txt_fname').val("");
        $('#txt_lname').val("");
        $('#txt_email').val("");
        $('#txt_tel').val("");
        $('#select_task').val(0);
        $('#ID_txt').val("");

        $('#btnEditCus').hide();
        $('#btnSaveCus').show();
        $('#btnDeleteCus').hide();
        $('#btncleanCus').hide();

      }
    });
  }

  function select_task() {
    $.ajax({
      url: "process/customer.php",
      type: 'POST',
      data: {
        'FUNC_NAME': 'select_task'
      },
      success: function(result) {
        var ObjData = JSON.parse(result);
        $("#select_task").empty();
        var Str = "";
        Str += "<option value=0 >เลือกสถานะ</option>";

        if (!$.isEmptyObject(ObjData)) {
          $.each(ObjData, function(key, value) {
            Str += "<option value=" + value.id + " >" + value.t_name + "</option>";
          });
        }
        $("#select_task").append(Str);

      }
    });
  }

  function show_data(){
    var  txtSearch =  $("#txtSearch").val();
    // var select_task = $("#select_task").val();
    $.ajax({
      url: "process/customer.php",
      type: 'POST',
      data: {
        'FUNC_NAME': 'show_data',
        'Search_txt': txtSearch
      },
      success: function(result) {
        var ObjData = JSON.parse(result);
              var StrTR = "" ;
              if (!$.isEmptyObject(ObjData)) {
                $.each(ObjData, function(key, value) {

                  var chkCus = "<input class='form-control chk_Cus' type='radio' value='1' name='id_Cus' id='id_Cus" + key + "' value='" + value.id + "' onclick='show_Detail(\"" + value.id + "\")' style='width: 25%;height:20px;'>";
                  StrTR += "<tr style='border-radius: 15px 15px 15px 15px;margin-top: 6px;margin-bottom: 6px;'>" +
                    "<td style='width:10%;text-align: center;'><center>"+chkCus+"</center></td>" +
                    "<td style='width:10%;text-align: center;' hidden>" + (key + 1) + "</td>" +
                    "<td style='width:20%;text-align: center;'>" + value.cus_fname + "</td>" +
                    "<td style='width:20%;text-align: center;'>" + value.cus_lname + "</td>" +
                    "<td style='width:20%;text-align: center;'>" + value.cus_email + "</td>" +
                    "<td style='width:20%;text-align: center;'>" + value.cus_tel + "</td>" +
                    "<td style='width:20%;text-align: center;'>" + value.t_name + "</td>" +
                    "</tr>";
                });
              }
              
              $('#Data_Table tbody').html(StrTR);
        
      }
    });

  }

  function show_Detail(ID){
    
    $('#ID_txt').val(ID);
    $.ajax({
      url: "process/customer.php",
      type: 'POST',
      data: {
        'FUNC_NAME': 'show_Detail',
        'ID': ID
      },
      success: function(result) {
        var ObjData = JSON.parse(result);
              
              if (!$.isEmptyObject(ObjData)) {
                $.each(ObjData, function(key, value) {

                  $('#txt_fname').val(value.cus_fname);
                  $('#txt_lname').val(value.cus_lname);
                  $('#txt_email').val(value.cus_email);
                  $('#txt_tel').val(value.cus_tel);
                  $('#select_task').val(value.cus_task);

                  $('#btnEditCus').show();
                  $('#btnSaveCus').hide();
                  $('#btnDeleteCus').show();
                  $('#btncleanCus').show();
                });
              }
      }
    });

  }


  function deleteData() {
    var  ID_txt = $('#ID_txt').val();
    $.ajax({
      url: "process/customer.php",
      type: 'POST',
      data: {
        'FUNC_NAME': 'deleteData',
        'ID_txt': ID_txt
      },
      success: function(result) {
        // feedData();

        $('#txt_fname').val("");
        $('#txt_lname').val("");
        $('#txt_email').val("");
        $('#txt_tel').val("");
        $('#select_task').val(0);
        $('#ID_txt').val("");
      
        $(".chk_Cus").prop("checked", false);

        $('#btnSaveCus').show();
        $('#btnEditCus').hide();
        $('#btnDeleteCus').hide();
        $('#btncleanCus').hide();

        show_data();

        showDialogSuccess(result);
      }
    });
  }

  $("#btnDeleteCus").click(function() {

    $.confirm({
      title: 'แจ้งเตือน!',
      content: 'ต้องการจะลบข้อมูล ใช่ หรือ ไม่?',
      type: 'orange',
      autoClose: 'cancel|8000',
      buttons: {
        cancel:  {
          text: 'ยกเลิก'
        },
        confirm: {
          btnClass: 'btn-primary',
          text: 'ตกลง',
          action: function() {
            deleteData();
          }
        }
      }
    });
  });



  function showDialogSuccess(text) {
    $.confirm({
      title: 'สำเร็จ!',
      content: text,
      type: 'green',
      autoClose: 'close|8000',
      typeAnimated: true,
      buttons: {
        close:  {
          text: 'ปิด',
        }
      }
    });
  }

  
  function showDialogFailed(text) {
    $.confirm({
      title: 'ผิดผลาด!',
      content: text,
      type: 'red',
      autoClose: 'close|8000',
      typeAnimated: true,
      buttons: {
        close:  {
          text: 'ปิด',
        }
      }
    });
  }
</script>