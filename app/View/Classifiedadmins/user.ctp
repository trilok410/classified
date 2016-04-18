<style>
  .pagination {
      margin:0 ! important;
  }
</style>
<div class="container-fluid" id="content"> 
    <!-- Page Heading -->
    <div class="col-lg-12"> 
      <h3 class="page-header"> User Management</h3>
    </div>
    <div class="row">
      <div class="col-md-12">
        <?php 
        $msg = $this->Session->flash('good');
        if(!empty($msg)){ ?>
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong><?php echo $msg; ?></strong>
        </div>
        <?php } ?>
        <div class="ad_new_user">
            <a href="<?php echo $this->webroot; ?>classifiedadmins/adduser" class="btn btn-success">Add New +</a>
            <span class="unblock_all_user point"><i class="fa fa-check-circle-o"></i></span>  
            <span class="block_all_user point"><i class="fa fa-ban"></i></span>  
            <span class="delete_all_user point"><i class="fa fa-trash"></i></span>
            <a href="javascript:void(0)" class="refresh_page"><i class="fa fa-refresh"></i></a>
        </div>
        <div class="table-responsive clearfix">
          <table class="table table-bordered table-hover" id="u">
            <thead>
              <tr>
                <th><input type="checkbox" class="select_all"> </th>
                <th>S. No.</th>   
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>user Type</th>
                <th>Contact No.</th>
                <th>Created Date</th>
                <th>City</th>
                <th>Status</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php  $count=1; foreach($user_data as $emp): ?>
              <tr>
                <td><input type="checkbox" class="select_ad" main="<?php echo $emp["User"]["id"]; ?>"></td>
                <td><?php echo $count ?></td>
                <td><?php echo $emp["User"]["id"]; ?></td>
                <td><?php echo $emp["User"]["name"]; ?></td>
                <td><?php echo $emp["User"]["email"]; ?></td>
                <td><?php echo $emp["User"]["provider"]; ?></td>
                <td><?php echo $emp["User"]["phone"]; ?></td>
                <td><?php echo date("d-m-Y",strtotime($emp["User"]["created_date"])); ?></td>
                <td><?php echo $emp["User"]["city"]; ?></td>
                <?php if($emp["User"]["status"] == '2'){ ?>
                <td><span class="btn btn-success">Active</span></td>
                <?php }else{ ?>
                <td><span class="btn btn-danger">Block</span></td>
                <?php } ?>
                <td class="center">
                   <span class="event_detail point" main="<?php echo $emp["User"]["id"]; ?>"><i class="glyphicon glyphicon-eye-open"></i></span> |
                   <a href="<?php echo $this->webroot; ?>classifiedadmins/edituser?id=<?php echo $emp["User"]["id"]; ?>"><i class="glyphicon glyphicon-pencil"></i></a>
                   <?php if($emp["User"]["status"] == '1') {?>
                   <span class="unblock_user point" main="<?php echo $emp["User"]["id"];?>"><i class="glyphicon glyphicon-ok-circle"></i></span>  
                   <?php }else{?>
                   <span class="block_user point" main="<?php echo $emp["User"]["id"];?>"><i class="glyphicon glyphicon-remove-circle"></i></span>  
                   <?php }?>
                </td>
              </tr>
           <?php $count++; endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- /.row --> 
    <div class="row event">
      <div class="col-md-12">
         <div class="view_event"></div>
      </div>
    </div>
</div>
  <!-- /#page-wrapper --> 
 <script type="text/javascript">
$(document).ready(function(){

        $('#u').dataTable({"columnDefs": [ { "targets": 0, "orderable": false } ] });
        $(".unblock_user").click(function() {
            var c_id = btoa($(this).attr("main"));
            var tab = 'users';
            var col = 'id';
            $.ajax({
                type: "post", // Request method: post, get
                url: "<?php echo $this->webroot ?>classifiedadmins/unblockdata", // URL to request
                data: 'c_id='+c_id+'&tab='+tab+"&col="+col, // Form variables
                dataType: "json", // Expected response type
                success: function(data) {
                   if(data.message == 'success')
                   {
                     window.location.reload();
                   }
                
                }
            });
        });

        $(".block_user").click(function() {
            var c_id = btoa($(this).attr("main"));
            var tab = 'users';
            var col = 'id';
            $.ajax({
                type: "post", // Request method: post, get
                url: "<?php echo $this->webroot ?>classifiedadmins/blockdata", // URL to request
                data: 'c_id='+c_id+'&tab='+tab+"&col="+col, // Form variables
                dataType: "json", // Expected response type
                success: function(data) {
                   if(data.message == 'success')
                   {
                     window.location.reload();
                   }
                
                }
            });
        });

        $(".table").on('click','.event_detail',function(){
            var u_id = btoa($(this).attr("main"));
            $('.view_event').load("<?php echo $this->webroot; ?>classifiedadmins/viewuserdetail?u_id="+u_id);
            $('html, body').animate({ scrollTop: $(".event").offset().top }, 1000);
        });

        $("body").on("change",".select_all", function(){
            if(this.checked)
            { 
                $(".select_ad").each(function(){
                    $(this).prop("checked", true);
                });
            }else
            {
                $(".select_ad").prop("checked", false);
            }
        });

        $("body").on("click",".unblock_all_user", function(){
            var id = "";
            var tab = "users";
            $(".select_ad").each(function(){
                if(this.checked)
                {
                    id += $(this).attr("main")+",";
                }
            });
            if(id != "")
            {
                $.ajax({
                        url:"<?php echo $this->webroot; ?>classifiedadmins/unblockalldata",
                        type:"post",
                        data:{id:id,tab:tab},
                        dataType:"json",
                        beforeSend: function() {
                            $('.loading').show();
                            $('.loading_icon').show();
                         },
                        success: function(data)
                        {
                            window.location.reload();
                        }
                });
            }else
            {
                alert("Please Select Ad");
            }
        });

        $("body").on("click",".block_all_user", function(){
            var id = "";
            var tab = "users";
            $(".select_ad").each(function(){
                if(this.checked)
                {
                    id += $(this).attr("main")+",";
                }
            });

            if(id != "")
            {
                $.ajax({
                        url:"<?php echo $this->webroot; ?>classifiedadmins/blockalldata",
                        type:"post",
                        data:{id:id,tab:tab},
                        dataType:"json",
                        beforeSend: function() {
                            $('.loading').show();
                            $('.loading_icon').show();
                         },
                        success: function(data)
                        {
                            window.location.reload();
                        }
                });
            }else
            {
                alert("Please Select Ad");
            }
        });

        $("body").on("click",".delete_all_user", function(){
            var id = "";
            $(".select_ad").each(function(){
                if(this.checked)
                {
                    id += $(this).attr("main")+",";
                }
            });

            if(id != "")
            {
                $.ajax({
                        url:"<?php echo $this->webroot; ?>classifiedadmins/deleteuser",
                        type:"post",
                        data:{id:id},
                        dataType:"json",
                        beforeSend: function() {
                            $('.loading').show();
                            $('.loading_icon').show();
                         },
                        success: function(data)
                        {
                            window.location.reload();
                        }
                });
            }else
            {
                alert("Please Select Ad");
            }
        });

        $("body").on("click",".refresh_page", function(){
            window.location.reload();
        });
});
</script>


