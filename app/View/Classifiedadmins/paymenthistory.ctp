<div id="page-wrapper" >
  <div id="page-inner">
      <div class="row">
          <div class="col-md-12">
           <h2>Payment Modes</h2>   
          </div>
      </div>
       <!-- /. ROW  -->
       <hr />
       
      <div class="row">
          <div class="col-md-12">
              <!-- Advanced Tables -->
              <div class="panel panel-default">
                  <div class="panel-heading">
                       Payment Modes Table
                  </div>
                  <div class="panel-body">
                      <div class="table-responsive">
                          <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                              <thead>
                                  <tr>
                                      <th>ID</th>
                                      <th>User</th>
                                      <th>Name</th>
                                      <th>Txn Id</th>
                                      <th>Price</th>
                                      <th>Payment Type</th>
                                      <th>IP Address</th>
                                      <th>Subcription Date</th>
                                      <th>Subcription End Date</th>
                                      <th>Status</th>
                                  </tr>
                              </thead>
                              <tbody>
                              <?php foreach($history as $mode): ?>
                                  <tr class="odd gradeX">
                                      <td><?php echo $mode["payment_detail"]["ad_id"]; ?></td>
                                      <td><?php echo $mode["classifieds"]["name"]."( Id ".$mode["classifieds"]["user_id"].")"; ?></td>
                                      <td>
                                          <?php 
                                              if($mode["classifieds"]["urgent"] == 1)
                                              {
                                                echo "urgent";
                                              }else if($mode["classifieds"]["featured"] == 1)
                                              {
                                                echo "featured";
                                              }else if($mode["classifieds"]["gallery"] == 1)
                                              {
                                                echo "gallery";
                                              }
                                           ?>
                                      </td>
                                      <td><?php echo $mode["payment_detail"]["txn_id"]; ?></td>
                                      <td>€ <?php echo $mode["payment_detail"]["amount"]; ?></td>
                                      <td><?php echo $mode["payment_detail"]["payment_type"]; ?></td>
                                      <td><?php echo $mode["payment_detail"]["ipaddress"]; ?></td>
                                      <td><?php echo date("d/m/Y", strtotime($mode["payment_detail"]["created_date"])); ?></td>
                                      <td>
                                          <?php 
                                              if($mode["classifieds"]["urgent"] == 1)
                                              {
                                                echo date("d/m/Y", strtotime($mode["classifieds"]["urgent_date"]));
                                              }else if($mode["classifieds"]["featured"] == 1)
                                              {
                                                echo date("d/m/Y", strtotime($mode["classifieds"]["featured_date"]));
                                              }else if($mode["classifieds"]["gallery"] == 1)
                                              {
                                                echo date("d/m/Y", strtotime($mode["classifieds"]["gallery_date"]));
                                              }
                                           ?>
                                      </td>
                                      <td><?php echo $mode["payment_detail"]["mode"]; ?></td>
                                  </tr>
                              <?php endforeach; ?>   
                              </tbody>
                          </table>
                      </div>
                      
                  </div>
              </div>
              <!--End Advanced Tables -->
          </div>
      </div>
      <div class="row">
        <div class="col-md-6" style="margin-top: 20px;" id="edit_contant">
        
        </div>
      </div>
  </div>
</div>
<script>
    $(document).ready(function () {
        $('#dataTables-example').dataTable();
    });
</script>

<script>
    $(document).ready(function(){
        
         $(".table").on('click','.edit_country',function(){
            var c_id = btoa($(this).attr("main"));
            $('#edit_contant').load('<?php echo $this->webroot; ?>classifiedadmins/editp_mode?m_id='+c_id);
            $('html, body').animate({ scrollTop: $("#edit_contant").offset().top }, 1000);
         });

         $('#cancel').click(function(){
            window.location.reload();
         });


    });
</script>
