<div id="page-wrapper" >
  <div id="page-inner">
      <div class="row">
          <div class="col-md-12">
           <h2>Email Template</h2>   
          </div>
      </div>
       <!-- /. ROW  -->
       <hr />
      <?php $flash = $this->Session->flash('template');
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
                       Email Template
                  </div>
                  <div class="panel-body">
                      <div class="table-responsive">
                          <table class="table table-striped table-bordered table-hover" id="emailtemplate">
                              <thead>
                                  <tr>
                                      <th>ID</th>
                                      <th>Subject</th>
                                      <th>Key</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php foreach($emails as $email){ ?>
                                  <tr>
                                      <td><?php echo $email["EmailTemplate"]["id"]; ?></td>
                                      <td><?php echo $email["EmailTemplate"]["subject"]; ?></td>
                                      <td><?php echo $email["EmailTemplate"]["key"]; ?></td>
                                      <td><a href="<?php echo $this->webroot; ?>classifiedadmins/edittemplate?id=<?php echo $email["EmailTemplate"]["id"]; ?>"><i class="glyphicon glyphicon-pencil"></i></a></td>
                                  </tr>
                                  <?php } ?>
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
        $('#emailtemplate').dataTable();
    });
</script>
