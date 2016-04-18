<div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
             <h2>Users Add's</h2>   
            </div>
        </div>
         <!-- /. ROW  -->
         <hr />
        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                         Users Add's
                    </div>
                    <div class="panel-body">
                        <?php 
                         $msg = $this->Session->flash('good');
                         if(!empty($msg)){ ?>
                         <div class="alert alert-warning alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <strong><?php echo $msg; ?></strong>
                        </div>
                        <?php } ?>
                        <div class="ad_new_user">
                            <a href="<?php echo $this->webroot; ?>classifiedadmins/addad" class="btn btn-primary">Add Ad</a>
                            <span class="unblock_all_ad point"><i class="glyphicon glyphicon-ok-circle"></i></span>  
                            <span class="block_all_ad point"><i class="fa fa-ban"></i></span>  
                            <span class="delete_all_ad point"><i class="fa fa-trash"></i></span>
                            <a href="javascript:void(0)" class="refresh_page"><i class="fa fa-refresh"></i></a>
                        </div>
                        <div class="table-responsive" id="manage_table">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" class="select_all"> </th>
                                        <th>Ad Id.</th>
                                        <th></th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>User</th>
                                        <th>User type</th>
                                        <th>Hits</th>
                                        <th>Ad Type</th>
                                        <th>Price</th>
                                        <th>Added Date</th>
                                        <th>Promotion Plan</th>
                                        <th>Payment Date</th>
                                        <th>Expiration Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($add_data as $add): ?>
                                    <tr class="odd gradeX">
                                        <td><input type="checkbox" class="select_ad" main="<?php echo $add["classifieds"]["id"]; ?>"></td>
                                        <td><?php echo $add["classifieds"]["id"]; ?></td>
                                        <td><img src="<?php echo $this->webroot.$add["files"]["base_url"]; ?>"></td>
                                        <td><?php echo substr($add["classifieds"]["title"], 0,15); ?></td>
                                        <td><?php echo $add["classified_category"]["category"]; ?></td>
                                        <td><?php echo $add["users"]["name"]; ?></td>
                                        <td><?php echo $add["classifieds"]["provider"]; ?></td>
                                        <td><?php echo $add["classifieds"]["view"]; ?></td>
                                        <td><?php echo ($add["classifieds"]["post_type"] == 2)? "L" : "O"; ?></td>
                                        <td><?php echo ($add["classifieds"]["price"] > 0)? $add["classifieds"]["price"] : ""; ?></td>
                                        <td><?php echo date('d-m-Y', strtotime($add["classifieds"]["create_date"])); ?></td>
                                        <?php 
                                                if($add["classifieds"]["urgent"] == 1)
                                                {
                                                    echo "<td>urgent</td>";
                                                    echo "<td>".date('d-m-Y', strtotime($add["classifieds"]["create_date"]))."</td>";
                                                    echo "<td>".date('d-m-Y', strtotime($add["classifieds"]["urgent_date"]))."</td>";
                                                }else if($add["classifieds"]["featured"] == 1)
                                                {
                                                    echo "<td>featured</td>";
                                                    echo "<td>".date('d-m-Y', strtotime($add["classifieds"]["create_date"]))."</td>";
                                                    echo "<td>".date('d-m-Y', strtotime($add["classifieds"]["featured_date"]))."</td>";
                                                }else if($add["classifieds"]["gallery"] == 1)
                                                {
                                                    echo "<td>gallery</td>";
                                                    echo "<td>".date('d-m-Y', strtotime($add["classifieds"]["create_date"]))."</td>";
                                                    echo "<td>".date('d-m-Y', strtotime($add["classifieds"]["gallery_date"]))."</td>";
                                                }else 
                                                {
                                                    echo "<td>no</td>";
                                                    echo "<td>null</td>";
                                                    echo "<td>null</td>";
                                                }
                                            ?>
                                        <td>
                                             <span class="btn btn-success">Active</span>
                                        </td>
                                        <td class="center">
                                          <span class="event_detail point" main="<?php echo $add["classifieds"]["id"]; ?>"><i class="glyphicon glyphicon-eye-open"></i></span> |
                                          <span class="block_event point" main="<?php echo $add["classifieds"]["id"];?>"><i class="glyphicon glyphicon-remove-circle"></i></span> | 
                                          <a href="<?php echo $this->webroot ?>classifiedadmins/editad?id=<?php echo $add["classifieds"]["id"];?>"><i class="glyphicon glyphicon-pencil"></i></a>|
                                          <span class="delete_ad point" main="<?php echo $add["classifieds"]["id"];?>"><i class="fa fa-trash"></i></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>   
                                </tbody>
                            </table>
                            <div class="event"></div>
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
        $('#dataTables-example').dataTable({"columnDefs": [ { "targets": 0, "orderable": false } ] });
    });
</script>

<script>
    $(document).ready(function(){
        
        $(".table").on('click','.block_event',function(){
            var c_id = btoa($(this).attr('main'));
            var tab = 'classifieds';
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

        $(".table").on('click','.unblock_event',function(){
            var c_id = btoa($(this).attr('main'));
            var tab = 'classifieds';
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

        $(".table").on('click','.event_detail',function(){
              var a_id = btoa($(this).attr("main"));
              window.location.href= "<?php echo $this->webroot; ?>classifiedadmins/viewadddetail?a_id="+a_id;              //$('.view_event').load("/classifiedadmins/viewadddetail?a_id="+a_id);
        });

        $("body").on("click",".delete_ad", function(){
            var id = $(this).attr("main");
            var cur = $(this);
            $.ajax({
                    url:"<?php echo $this->webroot; ?>classifiedadmins/deletead",
                    type:"post",
                    data:{id:id},
                    dataType:"json",
                    success: function(data)
                    {
                        cur.parents("tr").remove();
                    }    
            });
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

        $("body").on("click",".unblock_all_ad", function(){
            var id = "";
            var tab = "classifieds";
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

        $("body").on("click",".block_all_ad", function(){
            var id = "";
            var tab = "classifieds";
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

        $("body").on("click",".delete_all_ad", function(){
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
                        url:"<?php echo $this->webroot; ?>classifiedadmins/deletead",
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
