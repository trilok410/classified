<div id="page-wrapper" >
  <div id="page-inner">
      <div class="row">
          <div class="col-md-12">
           <h2>Payment Modes</h2>   
          </div>
      </div>
       <!-- /. ROW  -->
       <hr />
       <?php $flash = $this->Session->flash('tooltip');
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
                       ToolTip Table
                  </div>
                  <div class="panel-body">
                      <div class="table-responsive">
                          <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                              <thead>
                                  <tr>
                                      <th>S.no</th>
                                      <th>Key</th>
                                      <th>Content</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                              <?php $count = 1;  foreach($tooltip as $tool): ?>
                                  <tr class="odd gradeX">
                                      <td><?php echo $count; ?></td>
                                      <td><?php echo $tool["ToolTip"]["key"]; ?></td>
                                      <td><?php echo $tool["ToolTip"]["content"]; ?></td>
                                      <td class="center">
                                        <a href="<?php echo $this->webroot; ?>classifiedadmins/edittooltip?t_id=<?php echo base64_encode($tool["ToolTip"]["id"]); ?>">
                                       		<i class="glyphicon glyphicon-pencil"></i>
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
  </div>
</div>
<script>
    $(document).ready(function () {
        $('#dataTables-example').dataTable();
    });
</script>
