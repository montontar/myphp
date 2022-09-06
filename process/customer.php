<?php
session_start();
require '../connect/connect.php';

if (!empty($_POST['FUNC_NAME'])) {
  if ($_POST['FUNC_NAME'] == 'show_data') {
    show_data($conn);
  } else if ($_POST['FUNC_NAME'] == 'show_Detail') {
    show_Detail($conn);
  } else if ($_POST['FUNC_NAME'] == 'editData') {
    editData($conn);
  } else if ($_POST['FUNC_NAME'] == 'saveData') {
    saveData($conn);
  } else if ($_POST['FUNC_NAME'] == 'deleteData') {
    deleteData($conn);
  } else if ($_POST['FUNC_NAME'] == 'select_task') {
    select_task($conn);
  } 

}



function editData($conn)
{
  $txt_fname    = $_POST['txt_fname'];
  $txt_lname    = $_POST['txt_lname'];
  $txt_email    = $_POST['txt_email'];
  $txt_tel    = $_POST['txt_tel'];
  $select_task    = $_POST['select_task'];

  $ID_txt     = $_POST['ID_txt'];

  
    $query = "UPDATE customer SET customer.cus_fname = '$txt_fname' ,
                                  customer.cus_lname = '$txt_lname' ,
                                  customer.cus_email = '$txt_email' ,
                                  customer.cus_tel = '$txt_tel' ,
                                  customer.cus_task = '$select_task' 
              WHERE id = '$ID_txt'";

    $return = "แก้ไขข้อมูล สำเร็จ";

  mysqli_query($conn, $query);

  echo $return;
  unset($conn);
  die;
}

function saveData($conn)
{
  $txt_fname    = $_POST['txt_fname'];
  $txt_lname    = $_POST['txt_lname'];
  $txt_email    = $_POST['txt_email'];
  $txt_tel      = $_POST['txt_tel'];
  $select_task  = $_POST['select_task'];
  
  $Sql2 = "SELECT
            customer.id,
            customer.cus_fname,
            customer.cus_lname,
            customer.cus_email,
            customer.cus_tel,
            customer.cus_task
          FROM
            customer
          WHERE  customer.cus_fname = '$txt_fname'
          ";
  $result = mysqli_query($conn, $Sql2);
  $num_rows = mysqli_num_rows($result);
   if($num_rows>0){
        $return = "0";
   }else{
        

    $query = "INSERT INTO customer SET  customer.cus_fname = '$txt_fname' , 
                                        customer.cus_lname = '$txt_lname' ,
                                        customer.cus_email = '$txt_email' ,
                                        customer.cus_tel = '$txt_tel' ,
                                        customer.cus_task = '$select_task' 
    ";

          $return = "เพิ่มข้อมูล สำเร็จ";
          mysqli_query($conn, $query);
   }
    
 
  echo $return;
  unset($conn);
  die;
}

function show_data($conn)
{
  $Search_txt = $_POST["Search_txt"];


  $Sql = "SELECT
            customer.id,
            customer.cus_fname,
            customer.cus_lname,
            customer.cus_email,
            customer.cus_tel,
            customer.cus_task,
            task.t_name
          FROM
            customer
          INNER JOIN 
            task ON task.id = customer.cus_task
          WHERE (customer.cus_fname LIKE '%$Search_txt%')
          OR (customer.cus_lname LIKE '%$Search_txt%')
          OR (customer.cus_email LIKE '%$Search_txt%')
          OR (customer.cus_tel LIKE '%$Search_txt%')
          OR (task.t_name LIKE '%$Search_txt%')
           
          ORDER BY  customer.id DESC
          ";

  $meQuery = mysqli_query($conn, $Sql);
  while ($row = mysqli_fetch_assoc($meQuery)) {
    $return[] = $row;
  }

  
  echo json_encode($return);
  mysqli_close($conn);
  die;
}


function show_Detail($conn)
{
  $ID = $_POST["ID"];


  $Sql = "SELECT
            customer.id,
            customer.cus_fname,
            customer.cus_lname,
            customer.cus_email,
            customer.cus_tel,
            customer.cus_task,
            task.id,
            task.t_name
          FROM
            customer
          INNER JOIN 
            task ON task.id = customer.cus_task
          WHERE 
            customer.id = '$ID'
          ";
          
  $meQuery = mysqli_query($conn, $Sql);
  while ($row = mysqli_fetch_assoc($meQuery)) {
    $return[] = $row;
  }

  
  echo json_encode($return);
  mysqli_close($conn);
  die;
}

function select_task($conn)
{
  $Sql = "SELECT
            task.id, 
            task.t_name
          FROM
            task
            ORDER BY  task.id ASC
       ";

  $meQuery = mysqli_query($conn, $Sql);
  while ($row = mysqli_fetch_assoc($meQuery)) {
    $return[] = $row;
  }


  echo json_encode($return);
  mysqli_close($conn);
  die;
}


function deleteData($conn)
{
  $ID_txt = $_POST['ID_txt'];

  $query = "DELETE FROM customer WHERE id = $ID_txt";

  mysqli_query($conn, $query);
  echo "ลบ ข้อมูลสำเร็จ";
  unset($conn);
  die;
}
