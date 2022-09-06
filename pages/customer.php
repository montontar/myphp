<?php
session_start();

?>
            <div class="row">
              <div class="col-3 ml-5 mt-4">
                <input type="text" class="form-control" id="txtSearch" onkeyup="show_data();" placeholder="ค้นหารายการ">
              </div>
            </div>

            <div class="row mt-4 card-body table-responsive p-0" id="tb_Data" style="height: 420px;max-height: 350px;overflow-y: auto;">
              <div class="col-11 ml-5">
                <table id="Data_Table" class="table table-bordered table-hover w-100 table-head-fixed">
                  <thead>
                    <tr class="text-center">
                      <th style="width: 5%;" class="bg_tableAll"></th>
                      <th class="bg_tableAll">ชื่อ</th>
                      <th class="bg_tableAll">นามสกุล</th>
                      <th class="bg_tableAll">E-Mail</th>
                      <th class="bg_tableAll">เบอร์โทร</th>
                      <th class="bg_tableAll">สถานะ</th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>

            </div>

            <hr>

            <div class="row ml-4 mt-1">
              <div class="col-3 mt-3" hidden>
                <input type="text" class="form-control" id="ID_txt" hidden>
              </div>
                  
                      <div class="col-3 ml-3 mt-3">
                      <label>First Name :</label>
                          <input type="text" class="form-control" id="txt_fname" placeholder="ชื่อ">
                      </div>
                    
                      <div class="col-3 ml-3 mt-3">
                      <label>Last Name :</label>
                          <input type="text" class="form-control" id="txt_lname" placeholder="นามสกุล">
                      </div>
                      
                      <div class="col-3 ml-3 mt-3">
                      <label>E-Mail :</label>
                          <input type="text" class="form-control" id="txt_email" placeholder="อีเมล">
                      </div>

                      <div class="col-3 ml-3 mt-3">
                      <label>Tel. :</label>
                          <input type="text" class="form-control" id="txt_tel" placeholder="เบอร์โทร">
                      </div>
                   

                 
                    <div class="col-3 ml-3 mt-3">
                        <label>Task :</label>
                            <select class="custom-select form-control " id="select_task" >
                                
                            </select>
                    </div>
                    <div class="col-3 ml-2 mt-5">
                      <button style="width: 100px;" type="button" class="btn btn-outline-success ml-2" id="btnSaveCus" onclick="saveData();">บันทึก</button>
                      <button style="width: 100px;" type="button" class="btn btn-outline-warning ml-2" id="btnEditCus">แก้ไข</button>
                      <button style="width: 100px;" type="button" class="btn btn-outline-danger ml-2" id="btnDeleteCus">ลบ</button>
                      <button style="width: 100px;" type="button" class="btn btn-outline-secondary ml-2" id="btncleanCus" >ล้างข้อมูล</button>
                    </div>
                  
            </div>