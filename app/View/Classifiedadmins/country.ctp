<div id="page-wrapper" >
  <div id="page-inner">
      <div class="row">
          <div class="col-md-12">
           <h2>Country Management</h2>   
          </div>
      </div>
      <!-- /. ROW  -->
      <hr />
               
      <div class="row">
          <div class="col-md-12">
              <!-- Advanced Tables -->
              <div class="panel panel-default">
                  <div class="panel-heading">
                       Country Table
                  </div>
                  <div class="panel-body">
                      <div class="table-responsive">
                          <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                              <thead>
                                  <tr>
                                      <th>S.no</th>
                                      <th>Country Name</th>
                                      <th>Created Date</th>
                                      <th>Status</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                              <?php $count = 1;  foreach($country_data as $country): ?>
                                  <tr class="odd gradeX">
                                      <td><?php echo $count; ?></td>
                                      <td><?php echo $country["countries"]["name"]; ?></td>
                                      <td><?php echo date('d-m-Y', strtotime($country["countries"]["created_date"])); ?></td>
                                      <td>
                                           <?php if($country["countries"]["status"] == '1') {?>
                                           <span> Blocked</span>
                                           <?php }else{?>
                                           <span> Unblock</span>
                                            <?php }?>
                                      </td>
                                      <td class="center">
                                        <span class="edit_country point" main="<?php echo $country["countries"]["id"]; ?>"><i class="glyphicon glyphicon-pencil"></i></span> |
                                        <?php if($country["countries"]["status"] == '1') {?>
                                         <span class="unblock_country point" main="<?php echo $country["countries"]["id"];?>"><i class="glyphicon glyphicon-ok-circle"></i></span>  
                                         <?php }else{?>
                                         <span class="block_country point" main="<?php echo $country["countries"]["id"];?>"><i class="glyphicon glyphicon-remove-circle"></i></span>  
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
      <div class="row">
       <div class="col-md-6" style="margin-top: 20px;" id="edit_contant">
        <div class="table-responsive clearfix">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Add New Country</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Country Name </td>
                <td><input type="text" id="cont_name" class="form-control" placeholder="Country Name"></td>
              </tr>
              <tr>
                <td colspan="2"><input type="button" name="save_cont" id="save_cont" value="Save" class="btn btn-primary"> 
                 <input type="button" name="cancel" id="cancel" value="Cancel" class="btn btn-danger"></td>
              </tr>
            </tbody>
          </table>
        </div>
       </div>
      </div>
  </div>
</div>
<script>
    $(document).ready(function(){
        $('#dataTables-example').dataTable();

        $(".table").on('click','.block_country',function(){
            var c_id = btoa($(this).attr('main'));
            var tab = 'countries';
            var col = "id";
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

        $(".table").on('click','.unblock_country',function(){
            var c_id = btoa($(this).attr('main'));
            var tab = 'countries';
            var col = "id";
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

        $(".table").on('click','#save_cont',function(){
            var name = btoa($('#cont_name').val());
           
            if(name == "")
            {
              alert("Please fill fields first");
              return false;
            }

            $.ajax({
                    url:"<?php echo $this->webroot; ?>classifiedadmins/addcountry",
                    type:"post",
                    data:"name="+name,
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

         $(".table").on('click','.edit_country',function(){
            var c_id = btoa($(this).attr("main"));
            $('#edit_contant').load('<?php echo $this->webroot; ?>classifiedadmins/editcountry?c_id='+c_id);
            $('html, body').animate({ scrollTop: $("#edit_contant").offset().top }, 1000);
         });

         $('#cancel').click(function(){
            window.location.reload();
         });


    });
</script>
