<div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Report Management</h2>   
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                         Report Table
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Name</th>
                                        <th>Message</th>
                                        <th>View Ad</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $count = 1;  foreach($report as $repo){ ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $repo["Report"]["name"]; ?></td>
                                        <td><?php echo nl2br($repo["Report"]["message"]); ?></td>
                                        <td><a href="<?php echo $this->webroot; ?>classifiedadmins/viewadddetail?a_id=<?php echo base64_encode($repo["Report"]["ad_id"]); ?>">View Ad</a></td>
                                        <td>
                                            <?php echo ($repo["Report"]["status"] == 1)? "Unresolved" : "Resolved"; ?>
                                        </td>
                                        <td class="center">
                                          <span class="reply_Report point" main="<?php echo $repo["Report"]["id"]; ?>">Reply</span> | 
                                          <?php if($repo["Report"]["status"] == 1){ ?>
                                          <span class="resolve_Report point" main="<?php echo $repo["Report"]["id"]; ?>">Rsolve</span> 
                                          <?php } ?>
                                        </td>
                                    </tr>
                                <?php $count++; } ?>   
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
        
        /* Reply user */
        $(".table").on('click','.reply_Report',function(){
            var id = btoa($(this).attr("main"));
            $('#edit_contant').load("<?php echo $this->webroot; ?>classifiedadmins/feedbacktouesr?id="+id);
            $('html, body').animate({ scrollTop: $("#edit_contant").offset().top }, 1000);
        });

        /* Resolve Report */
        $("body").on("click",".resolve_Report", function(){
            var c_id = btoa($(this).attr('main'));
            var tab = 'report';
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
 });
</script>
