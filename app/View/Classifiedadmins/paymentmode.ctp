<div id="page-wrapper" >
  <div id="page-inner">
      <div class="row">
          <div class="col-md-12">
           <h2>Payment Modes</h2>   
          </div>
      </div>
       <!-- /. ROW  -->
       <hr />
       <?php $flash = $this->Session->flash('pay');
          if(!empty($flash)){ ?>
            <div class="row">
              <div class="col-md-12">
                <div class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <?php echo $flash; ?>
                </div>
              </div>
            </div>
        <?php } ?>
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
                                      <th>S.no</th>
                                      <th>Image</th>
                                      <th>Name</th>
                                      <th>Days</th>
                                      <th>Price</th>
                                      <th>Description</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                              <?php $count = 1;  foreach($p_data as $mode): ?>
                                  <tr class="odd gradeX">
                                      <td><?php echo $count; ?></td>
                                      <td><img src="<?php echo $this->webroot.$mode["files"]["base_url"]; ?>" alt=""></td>
                                      <td><?php echo $mode["payment_modes"]["title"]; ?></td>
                                      <td><?php echo $mode["payment_modes"]["days"]; ?> days</td>
                                      <td>£ <?php echo $mode["payment_modes"]["price"]; ?></td>
                                      <td><?php echo $mode["payment_modes"]["description"]; ?></td>
                                      <td class="center">
                                        <a href="<?php echo $this->webroot; ?>classifiedadmins/editp_mode?m_id=<?php echo base64_encode($mode["payment_modes"]["id"]); ?>">
                                        <span class="edit_country point" main="<?php echo $mode["payment_modes"]["id"]; ?>"><i class="glyphicon glyphicon-pencil"></i></span>
                                        </a>
                                      </td>
                                  </tr>
                              <?php $count++; endforeach; ?>   
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
