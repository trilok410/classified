
<div class="row">
      <div class="col-md-12">
          <!-- Advanced Tables -->
          <div class="panel panel-default">
           <div class="panel-heading">
              <?php if(isset($page_name)){ echo $page_name[0]["event_page"]["name"];} ?>
            </div>
              <div class="panel-body">
                  <div class="table-responsive">
                      <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                          <thead>
                              <tr>
                                  <th>S.no</th>
                                  <th>Image</th>
                                  <th>Page Name</th>
                                  <th>Start Date</th>
                                  <th>End Date</th>
                                  <th>Country</th>
                                  <th>Status</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                          <?php $count = 1;  foreach($page_photo as $all): ?>
                              <tr class="odd gradeX">
                                  <td><?php echo $count; ?></td>
                                  <td>
                                    <a class="example-image-link" href="/<?php echo $all["files"]["base_url"]; ?>" data-lightbox="example-set" data-title=""><img class="example-image" src="/<?php echo $all["files"]["base_url"]; ?>" alt=""/></a>
                                  </td>
                                  <td><?php echo $all["classifieds_pages"]["page_name"]; ?></td>
                                  <td><?php echo date('d-m-Y', strtotime($all["classifieds_add"]["s_date"])); ?></td>
                                  <td><?php echo date('d-m-Y', strtotime($all["classifieds_add"]["e_date"])); ?></td>
                                  <td><?php echo $all["countries"]["country_name"]; ?></td>
                                  <td>
                                       <?php if($all["classifieds_add"]["status"] == '1') {?>
                                       <span> Hide</span>
                                       <?php }else{?>
                                       <span> Show</span>
                                        <?php }?>
                                  </td>
                                  <td class="center">
                                   <?php //if(isset($per["RemoveCategory/Subcategory"])){ ?> 
                                    <?php if($all["classifieds_add"]["status"] == '1') {?>
                                     <span class="show_img point" main="<?php echo $all["classifieds_add"]["id"];?>" page="<?php echo $all["classifieds_add"]["page_id"]; ?>">Show</span>  
                                     <?php }else{?>
                                     <span class="hide_img point" main="<?php echo $all["classifieds_add"]["id"];?>" page="<?php echo $all["classifieds_add"]["page_id"]; ?>">Hide</i></span>  
                                      <?php }?>
                                      <?php //} ?> 
                                      | <span class="edit_add point" main="<?php echo $all["classifieds_add"]["id"];?>" page="<?php echo $all["classifieds_add"]["page_id"]; ?>"><i class="glyphicon glyphicon-pencil"></i></span>
                                      | <span class="fa fa-close delete_album point" main="<?php echo $all["classifieds_add"]["image_id"]; ?>" page="<?php echo $all["classifieds_add"]["page_id"]; ?>" title="Delete Image"></span>
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

<script>
    $(document).ready(function () {
        $('#dataTables-example').dataTable();
    });
</script>
<script>
    $(document).ready(function () {

        $(".table").on('click','.hide_img',function(){
            var c_id = btoa($(this).attr('main'));
            var tab = 'classifieds_add';
            var page_id = btoa($(this).attr("page"));
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
                           $('#load_page').load("/classifiedadmins/banneradd?id="+page_id);
                           $('.loading').hide();
                           $('.loading_icon').hide();
                           // window.location.reload();
                        }
                    }
            });
        });

        $(".table").on('click','.show_img',function(){
            var c_id = btoa($(this).attr('main'));
            var tab = 'classifieds_add';
            var page_id = btoa($(this).attr("page"));
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
                            $('#load_page').load("/classifiedadmins/banneradd?id="+page_id);
                            $('.loading').hide();
                            $('.loading_icon').hide();
                           // / window.location.reload();
                        }
                    }
            });
        });

        $(".table").on('click','.edit_add',function(){
            var a_id = btoa($(this).attr("main"));
             var page_id = btoa($(this).attr("page"));
            $('#edit_contant').load('/classifiedadmins/editadd?a_id='+a_id+"&page_id="+page_id);
            $('html, body').animate({ scrollTop: $("#edit_contant").offset().top }, 1000);
         });
});
</script>