<script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
<div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
             <h2>Main Category Management</h2>   
            </div>
        </div>
         <!-- /. ROW  -->
         <hr />
        <?php $flash = $this->Session->flash('maincat');
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
                         <!-- <form id="addleadcategory"> -->
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Logo</th>
                                        <th>Name (English)</th>
                                        <th>Name (German)</th>
                                        <th>Description</th>
                                        <th>Created Date</th>
                                        <th>Status</th>
                                        <!-- <th>Lead Category</th> -->
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $count = 1;  foreach($all_category1 as $category): ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $count; ?></td>
                                        <td><img src="<?php echo $this->webroot.$category["files"]["base_url"];   ?>"></td>
                                        <td><?php echo utf8_encode($category["classified_maincategories"]["maincategory"]); ?></td>
                                        <td><?php foreach($all_category2 as $cat2)
                                                {
                                                  if($category["classified_maincategories"]["m_id"] == $cat2["classified_maincategories"]["m_id"])
                                                  {
                                                    echo utf8_encode($cat2["classified_maincategories"]["maincategory"]);
                                                    break;
                                                  }
                                                }
                                              ?>
                                         </td>
                                        <td>
                                            <?php echo nl2br($category["classified_maincategories"]["description"]); ?>
                                        </td>
                                        <td><?php echo date('d-m-Y', strtotime($category["classified_maincategories"]["modify_date"])); ?></td>
                                        <td>
                                             <?php if($category["classified_maincategories"]["status"] == '1') {?>
                                             <span> Blocked</span>
                                             <?php }else{?>
                                             <span> Unblock</span>
                                              <?php }?>
                                        </td>
                                        <!-- <td class="center">
                                      
                                         <?php if($category["classified_maincategories"]["lead_cat"] == '0') {?>
                                          <input type="checkbox" value="<?php echo $category["classified_maincategories"]["m_id"]; ?>" name="lead[]" class="cehck_lead" >
                                          <?php }else{?>
                                          <input type="checkbox" value="<?php echo $category["classified_maincategories"]["m_id"]; ?>" name="lead[]" class="cehck_lead" checked>
                                          <?php } ?>
                                       
                                        </td> -->
                                        <td class="center">
                                           <span class="edit_maincategory point" main="<?php echo $category["classified_maincategories"]["m_id"]; ?>"><i class="glyphicon glyphicon-pencil"></i></span> |
                                           <?php if($category["classified_maincategories"]["status"] == '1') {?>
                                           <span class="unblock_maincategory point" main="<?php echo $category["classified_maincategories"]["m_id"];?>"><i class="glyphicon glyphicon-ok-circle"></i></span>  
                                           <?php }else{?>
                                           <span class="block_maincategory point" main="<?php echo $category["classified_maincategories"]["m_id"];?>"><i class="glyphicon glyphicon-remove-circle"></i></span>  
                                           <?php }?>
                                        </td>
                                    </tr>
                                <?php $count++; endforeach; ?>   
                                </tbody>
                            </table>
                           <!--  <div>
                              <input type="button" id="save_leadcat" value="Save" class="btn btn-primary"> 
                              <input type="button" name="cancel" id="cancel" value="Cancel" class="btn btn-danger">
                            </div> -->
                          <!-- </form> -->
                        </div>
                        
                    </div>
                </div>
                <!--End Advanced Tables -->
            </div>
        </div>
        <div class="row">
         <div class="col-md-6" style="margin-top: 20px;" id="edit_contant">
              <div class="table-responsive clearfix">
                  <form id="add_maincategory" method="post" action="<?php echo $this->webroot; ?>classifiedadmins/addmaincategory" enctype="multipart/form-data">
                    <table class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th colspan="2">Add Main Category</th>
                        </tr>
                      </thead>
                      <tbody>
                      <tr>
                          <td>Logo</td>
                          <td>
                              <span class="btn btn-success btn-file">
                              Select Logo<input type="file" name="logo" id="logo"  required>
                              </span>
                          </td>
                        </tr>
                        <tr>
                          <td>Name (English)</td>
                          <td>
                            <input type="text" value="" name="sub[]" class="form-control"  required>
                          </td>
                        </tr>
                        <tr>
                          <td>Name (German)</td>
                          <td>
                            <input type="text" value="" name="sub[]" class="form-control"  required>
                          </td>
                        </tr>
                        <tr>
                            <td> Description</td>
                            <td>
                              <textarea class="form-control add_description" name="description"  required></textarea>
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
                          <td colspan="2"><input type="submit" name="add_maincategory" id="add_maincategory" value="Save" class="btn btn-primary"> 
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
        var oTable = $('#dataTables-example').dataTable();
        $('.table-responsive').on('click','#save_leadcat', function(){
            var lead_val = "";
            
            var rowcollection =  oTable.$("input[type=checkbox]:checked", {"page": "all"});
            rowcollection.each(function(){
                lead_val += ","+$(this).val();
            });

            var new_lead = lead_val.split(",");

            if((new_lead.length) < 5)
            {  
                $.ajax({
                        url:"<?php echo $this->webroot; ?>classifiedadmins/addleadcategory",
                        type:"post",
                        data: 'data='+lead_val,
                        // cache: false,
                        // contentType: false,
                        // processData: false,
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
            }else{
                alert("Select Maximum 3 Categories");
            }
        });
    });
</script>
<script>
  tinymce.init({
    selector: ".add_description",
    theme: "modern",
    //width: 300,
    height: 450,
    font_size_classes : "fontSize1, fontSize2, fontSize3, fontSize4, fontSize5, fontSize6",
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "save table contextmenu directionality emoticons template paste textcolor"
   ],

   //content_css: "css/content.css",
   toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons | sizeselect | fontselect | fontsize | fontsizeselect", 
   style_formats: [
        {title: 'Bold text', inline: 'b'},
        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
        {title: 'Example 1', inline: 'span', classes: 'example1'},
        {title: 'Example 2', inline: 'span', classes: 'example2'},
        {title: 'Table styles'},
        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
    ]
}); 
</script>
<script>
    $(document).ready(function(){
        
        $(".table").on('click','.block_maincategory',function(){
            var c_id = btoa($(this).attr('main'));
            var tab = 'classified_maincategories';
            var col = 'm_id';
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
            var tab = 'classified_maincategories';
            var col = 'm_id';
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
          var m_id = btoa($(this).attr("main"));
          tinymce.remove(".add_description");
          tinymce.remove(".template_body_block");
          $('#edit_contant').load('<?php echo $this->webroot; ?>classifiedadmins/editmaincategory?m_id='+m_id);
          $('html, body').animate({ scrollTop: $("#edit_contant").offset().top }, 1000);
       });

       $("body").on("click",".add_new_cat", function(){
          $('html, body').animate({ scrollTop: $("#edit_contant").offset().top-100 }, 1000);
       });

       $('#cancel').click(function(){
          window.location.reload();
       });
    });
</script>
