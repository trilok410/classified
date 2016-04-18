<div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
             <h2>Sub Category Management</h2>   
            </div>
        </div>
         <!-- /. ROW  -->
         <hr />
         <?php $flash = $this->Session->flash('subcat');
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
                                        <th>Name (English)</th>
                                        <th>Name (German)</th>
                                        <th>Main Category</th>
                                        <th>Category</th>
                                        <th>Created Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $count = 1;  foreach($all_category1 as $category): ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo utf8_encode($category["classified_subcategory"]["subcategory"]); ?></td>
                                        <td><?php foreach($all_category2 as $cat2)
                                                {
                                                  if($category["classified_subcategory"]["s_id"] == $cat2["classified_subcategory"]["s_id"])
                                                  {
                                                    echo utf8_encode($cat2["classified_subcategory"]["subcategory"]);
                                                    break;
                                                  }
                                                }
                                              ?>
                                         </td>
                                        <td>
                                            <?php echo utf8_encode($category["classified_category"]["category"]); ?>
                                        </td>
                                        <td>
                                            <?php echo utf8_encode($category["classified_maincategories"]["maincategory"]); ?>
                                        </td>
                                        <td><?php echo date('d-m-Y', strtotime($category["classified_subcategory"]["created_date"])); ?></td>
                                        <td>
                                             <?php if($category["classified_subcategory"]["status"] == '1') {?>
                                             <span> Blocked</span>
                                             <?php }else{?>
                                             <span> Unblock</span>
                                              <?php }?>
                                        </td>
                                        <td class="center">
                                           <span class="edit_maincategory point" main="<?php echo $category["classified_subcategory"]["s_id"]; ?>"><i class="glyphicon glyphicon-pencil"></i></span> |
                                           <?php if($category["classified_subcategory"]["status"] == '1') {?>
                                           <span class="unblock_maincategory point" main="<?php echo $category["classified_subcategory"]["s_id"];?>"><i class="glyphicon glyphicon-ok-circle"></i></span>  
                                           <?php }else{?>
                                           <span class="block_maincategory point" main="<?php echo $category["classified_subcategory"]["s_id"];?>"><i class="glyphicon glyphicon-remove-circle"></i></span>  
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
           <form id="add_subcategory">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th colspan="2">Add New Subcategory</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                    <td>Main Category Name</td>
                    <td>
                        <select class="form-control" name="main_id" id="main_cat">
                            <option selected disabled value="0">Select Category</option>
                          <?php foreach($main_category as $main): ?>
                            <option value="<?php echo $main["classified_maincategories"]["m_id"]; ?>"><?php echo $main["classified_maincategories"]["maincategory"]; ?></option>
                          <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Category Name</td>
                    <td>
                        <select class="form-control" name="category_id" id="category">
                            <option selected disabled value="0">Select Category</option>
                        </select>
                    </td>
                </tr>
                <tr>
                  <td>Name (English)</td>
                    <td>
                        <input type="text" name="sub[name][]" class="form-control" placeholder="Name (English)">
                        <input type="hidden" name="sub[lang_id][]" value="1">
                    </td>
                </tr>
                <tr>
                  <td>Name (German)</td>
                  <td>
                      <input type="text" name="sub[name][]" class="form-control" placeholder="Name (German)">
                      <input type="hidden" name="sub[lang_id][]" value="2">  
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
                    <td colspan="2"><input type="button" name="save_subcategory" id="save_subcategory" value="Save" class="btn btn-primary"> 
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
    $(document).ready(function () {
        $('#dataTables-example').dataTable();
    });
</script>

<script>
    $(document).ready(function(){
        
        $(".table").on('click','.block_maincategory',function(){
            var c_id = btoa($(this).attr('main'));
            var tab = 'classified_subcategory';
            var col = 's_id';
            
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
            var tab = 'classified_subcategory';
            var col = 's_id';
            
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

        $(".table").on('click','#save_subcategory',function(){
            var name = $('#add_subcategory').serialize();
            
          if($("#add_subcategory").valid())
          {
            $.ajax({
                    url:"<?php echo $this->webroot; ?>classifiedadmins/addsubcategory",
                    type:"post",
                    data:name,
                    dataType:"json",
                    beforeSend: function() {
                      $('.loading').show();
                      $('.loading_icon').show();
                    },
                    success: function(data){
                        if(data.message == 'success')
                        {   
                            $('#add_subcategory')[0].reset();
                            window.location.reload();
                        }
                    }
            }); 
          }else{
            return false;
          } 
        });

         $(".table").on('click','.edit_maincategory',function(){
            var s_id = btoa($(this).attr("main"));
            $('#edit_contant').load('<?php echo $this->webroot; ?>classifiedadmins/editsubcategory?s_id='+s_id);
            $('html, body').animate({ scrollTop: $("#edit_contant").offset().top }, 1000);
         });

         $('#cancel').click(function(){
            window.location.reload();
         });

         $('#main_cat').change(function(){
            var m_id = btoa($(this).val());
            $.ajax({
                    url:"<?php echo $this->webroot; ?>classifiedadmins/getcategory",
                    data:"m_id="+m_id,
                    type:"post",
                    dataType:"json",
                    success: function(data)
                    {
                        if(data.category != "")
                        {
                             var option = '<option selected disabled>Category</option>';
                             $.each(data.category, function(index, value) {
                                 option += '<option value="'+index+'">' + value + '</option>';
                             });
                             
                             $('#category').html(option);
                        }
                    }
            });
         });

         $("body").on("click",".add_new_cat", function(){
            $('html, body').animate({ scrollTop: $("#edit_contant").offset().top-100 }, 1000);
         });

    });
</script>
