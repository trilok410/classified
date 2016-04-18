<div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
             <h2>Category Management</h2>   
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
        <?php $flash = $this->Session->flash('category');
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
                         Category Table
                    </div>
                    <div class="panel-body">
                        <div class="ad_new_user">
                          <a class="btn btn-success add_new_cat" href="javascript:void(0)">Add New +</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Logo</th>
                                        <th>Name (English)</th>
                                        <th>Name (German)</th>
                                        <th>Main Category</th>
                                        <th>Created Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $count = 1;  foreach($all_category1 as $category): ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $count; ?></td>
                                        <td><img src="<?php echo $this->webroot.$category["files"]["base_url"];   ?>"></td>
                                        <td><?php echo utf8_encode($category["classified_category"]["category"]); ?></td>
                                        <td><?php foreach($all_category2 as $cat2)
                                                {
                                                  if($category["classified_category"]["c_id"] == $cat2["classified_category"]["c_id"])
                                                  {
                                                    echo utf8_encode($cat2["classified_category"]["category"]);
                                                    break;
                                                  }
                                                }
                                              ?>
                                         </td>
                                        <td>
                                            <?php echo $category["classified_maincategories"]["maincategory"]; ?>
                                        </td>
                                        <td><?php echo date('d-m-Y', strtotime($category["classified_category"]["created_date"])); ?></td>
                                        <td>
                                             <?php if($category["classified_category"]["status"] == '1') {?>
                                             <span> Blocked</span>
                                             <?php }else{?>
                                             <span> Unblock</span>
                                              <?php }?>
                                        </td>
                                        <td class="center">
                                           <span class="edit_maincategory point" main="<?php echo $category["classified_category"]["c_id"]; ?>"><i class="glyphicon glyphicon-pencil"></i></span> |
                                           <?php if($category["classified_category"]["status"] == '1') {?>
                                           <span class="unblock_maincategory point" main="<?php echo $category["classified_category"]["c_id"];?>"><i class="glyphicon glyphicon-ok-circle"></i></span>  
                                           <?php }else{?>
                                           <span class="block_maincategory point" main="<?php echo $category["classified_category"]["c_id"];?>"><i class="glyphicon glyphicon-remove-circle"></i></span>  
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
                    <form id="edit_maincategory"  method="post" action="<?php echo $this->webroot; ?>classifiedadmins/addcategory" enctype="multipart/form-data">
                        <table class="table table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>Add Category</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                          <tr>
                              <td>Logo</td>
                              <td>
                                  <span class="btn btn-success btn-file">
                                  Select Logo<input type="file" name="logo" id="logo" required>
                                  </span>
                              </td>
                            </tr>
                            <tr>
                              <td>Name (English)</td>
                              <td>
                                <input type="text" value="" name="sub[]" class="form-control" required>
                              </td>
                            </tr>
                            <tr>
                              <td>Name (German)</td>
                              <td>
                                <input type="text" value="" name="sub[]" class="form-control" required>
                              </td>
                            </tr>
                            <tr>
                                <td>Main Category Name</td>
                                <td>
                                    <select class="form-control" name="category_name" required>
                                        <option value="">Select Category</option>
                                      <?php foreach($all_category as $data): ?>
                                        <option value="<?php echo $data["classified_maincategories"]["m_id"]; ?>"><?php echo $data["classified_maincategories"]["maincategory"]; ?></option>
                                      <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td>Meta Description</td>
                                <td>
                                  <textarea class="form-control" name="meta_description"  required></textarea>
                                  <p><b>Hint: </b> {city} for city, {keyword} for keyword</p>
                                </td>
                            </tr>
                            <tr>
                                <td>Meta Keywords</td>
                                <td>
                                  <input type="text" class="form-control" name="meta_keyword" value=""  required>
                                  <p><b>Hint: </b> {city} for city, {keyword} for keyword</p>
                                </td>
                            </tr>
                            <tr>
                                <td>Meta Title</td>
                                <td>
                                  <input type="text" class="form-control" name="meta_title" value=""  required>
                                  <p><b>Hint: </b> {city} for city, {keyword} for keyword</p>
                                </td>
                            </tr>
                            <tr>
                              <td colspan="2"><input type="submit" name="save_maincategory" id="save_maincategory" value="Save" class="btn btn-primary"> 
                               <input type="button" name="cancel" id="cancel" value="Cancel" class="btn btn-danger"></td>
                            </tr>
                          </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#dataTables-example').dataTable();

        $(".table").on('click','.block_maincategory',function(){
            var c_id = btoa($(this).attr('main'));
            var tab = 'classified_category';
            var col = 'c_id';
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
            var tab = 'classified_category';
             var col = 'c_id';
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

        

        $(".table").on('click','.edit_maincategory',function(){
            var c_id = btoa($(this).attr("main"));
            $('#edit_contant').load('<?php echo $this->webroot; ?>classifiedadmins/editcategory?c_id='+c_id);
            $('html, body').animate({ scrollTop: $("#edit_contant").offset().top }, 1000);
        });

        $('#cancel').click(function(){
            window.location.reload();
        });

        $("body").on("click",".add_new_cat", function(){
          $('html, body').animate({ scrollTop: $("#edit_contant").offset().top-100 }, 1000);
        });
    });
</script>
