<div id="page-wrapper" >
  <div id="page-inner">
      <div class="row">
          <div class="col-md-12">
           <h2>Model Management</h2>   
          </div>
      </div>
       <!-- /. ROW  -->
       <hr />
      <?php $flash = $this->Session->flash('umodel');
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
                       Model Table <a href="<?php echo $this->webroot ?>classifiedadmins/addmodel" class="btn btn-primary">Add Model</a>
                  </div>
                  <div class="panel-body">
                      <div class="table-responsive">
                          <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                              <thead>
                                  <tr>
                                      <th>S.no</th>
                                      <th>Model</th>
                                      <th>Sub Category</th>
                                      <th>Created Date</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                              <?php $count = 1;  foreach($mod as $mo): ?>
                                  <tr class="odd gradeX">
                                      <td><?php echo $count; ?></td>
                                      <td><?php echo $mo["models"]["model"]; ?></td>
                                      <td><?php echo utf8_encode($mo["classified_subcategory"]["subcategory"]); ?></td>
                                      <td><?php echo date('d-m-Y', strtotime($mo["models"]["created_date"])); ?></td>
                                      <td class="center">
                                         <a href="<?php echo $this->webroot; ?>classifiedadmins/editmodel?id=<?php echo base64_encode($mo["models"]["id"]);?>"><span class="edit_maincategory point"><i class="glyphicon glyphicon-pencil"></i></span></a> |
                                         <?php if($mo["models"]["status"] == '1') {?>
                                         <span class="unblock_maincategory point" main="<?php echo $mo["models"]["id"];?>"><i class="glyphicon glyphicon-ok-circle"></i></span>  
                                         <?php }else{?>
                                         <span class="block_maincategory point" main="<?php echo $mo["models"]["id"];?>"><i class="glyphicon glyphicon-remove-circle"></i></span>  
                                         <?php }?>
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
</div>
<script>
    $(document).ready(function () {
        $('#dataTables-example').dataTable();
    });
</script>

<script>
    $(document).ready(function(){
        
        $(".table").on('click','.block_maincategory',function(){
            var c_id = btoa($(this).attr('main'));
            var tab = 'models';
            var col = 'id';
            
            $.ajax({
                    url:"<?php echo $this->webroot; ?>classifiedadmins/blockdata",
                    type:"post",
                    data:"c_id="+c_id+"&tab="+tab+"&col="+col,
                    dataType:"json",
                    beforeSend: function() {
                      $('.loading').show();
                      $('.loading_icon').show();
                    },
                    success: function(data){
                        if(data.message == 'success')
                        {
                            window.location.reload();
                        }
                    }
            });
        });

        $(".table").on('click','.unblock_maincategory',function(){
            var c_id = btoa($(this).attr('main'));
            var tab = 'models';
            var col = 'id';
            
            $.ajax({
                    url:"<?php echo $this->webroot; ?>classifiedadmins/unblockdata",
                    type:"post",
                    data:"c_id="+c_id+"&tab="+tab+"&col="+col,
                    dataType:"json",
                    beforeSend: function() {
                      $('.loading').show();
                      $('.loading_icon').show();
                    },
                    success: function(data){
                        if(data.message == 'success')
                        {
                            window.location.reload();
                        }
                    }
            });
        });
    });
</script>
