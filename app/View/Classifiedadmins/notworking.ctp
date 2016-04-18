<?php $per = $this->Session->read('permission');  ?>
<div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Problem Management</h2>   
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
               
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Problem Table
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>S.no</th>
                                            <th>Image</th>
                                            <th>Issue In</th>
                                            <th>Problem Type</th>
                                            <th>Problem</th>
                                            <th>Created Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $count = 1;  foreach($problem_data as $problem): ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $count; ?></td>
                                            <td><?php if(!empty($problem["user_problem"]["img_id"]))
                                                        {?>
                                                            <a class="example-image-link" href="/<?php echo $problem["files"]["base_url"]; ?>" data-lightbox="example-<?php echo $problem["user_problem"]["img_id"]; ?>" data-title=""><img class="example-image" src="/<?php echo $problem["files"]["base_url"]; ?>"></a>
                                                  <?php }else{
                                                            echo "";
                                                        }
                                                    ?>
                                            </td>
                                            <td><?php echo $problem["user_problem"]["issue_type"]; ?></td>
                                            <td><?php echo $problem["user_problem"]["problem_type"]; ?></td>
                                            <td><?php echo $problem["user_problem"]["problem"]; ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($problem["user_problem"]["created_on"])); ?></td>
                                            <td>
                                                 <?php if($problem["user_problem"]["status"] == '1') {?>
                                                 <span> Unresolve</span>
                                                 <?php }else{?>
                                                 <span> Resolve</span>
                                                  <?php }?>
                                            </td>
                                            <td class="center">
                                            <?php if(isset($per["ClfReply&Resolve"])){ ?>
                                              <span class="reply_user point" main="<?php echo $problem["user_problem"]["user_id"]; ?>">Reply</span> 
                                              <?php if($problem["user_problem"]["status"] == '1') {?>
                                              | <span class="resolve_problem point" main="<?php echo $problem["user_problem"]["id"];?>" title="Resolve"><i class="glyphicon glyphicon-ok-circle"></i></span>  
                                               <?php }else{}?>
                                            <?php } ?>
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

<script>
    $(document).ready(function(){
        
        $(".table").on('click','.resolve_problem',function(){
            var c_id = btoa($(this).attr('main'));
            var tab = 'user_problems';
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

        
         $(".table").on('click','.reply_user',function(){
            var u_id = btoa($(this).attr("main"));
            $('#edit_contant').load('/classifiedadmins/feedbacktouesr?u_id='+u_id);
            $('html, body').animate({ scrollTop: $("#edit_contant").offset().top }, 1000);
         });

         

    });
</script>
