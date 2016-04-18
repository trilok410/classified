<link rel="stylesheet" href="/css/lightbox.css">

<div id="page-wrapper" >
   <div id="page-inner">
   	<div class="row">
        <div class="col-md-12">
         <h2>Add Management</h2>   
        </div>
    </div>
     <!-- /. ROW  -->
     <hr />
      <div class="row">
	        <div class="col-md-12">
            <div class="right_sec">
                <div class="create_album">
                    <button class="btn btn-default" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span>Add Images</button>
                  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog" id="img_upload">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            </div>
                          <form  class="dropzone" id="upload_album" >
                            <div class="form-group album_creat">
                                <select class="form-control" id="page_name" name="page_name" required>
                                <option selected="" disabled="">Select Page Name</option>
                                <?php foreach($page_data as $page): ?>
                                  <option value="<?php echo $page["classifieds_pages"]["id"];?>" ><?php echo $page["classifieds_pages"]["page_name"]; ?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group album_creat">
                                <select class="form-control" id="country_name" name="country" required>
                                <option selected="" disabled="">Select Country</option>
                                <?php foreach($country as $cont): ?>
                                  <option value="<?php echo $cont["countries"]["id"];?>" ><?php echo $cont["countries"]["country_name"]; ?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                  <div class="col-md-5">
                                      <input type="text" name="s_date" placeholder="Start Date" data-date-format="yyyy-mm-dd" class="form-control wh1 date form_datetime" data-date="" data-link-field="dtp_input1" id="s_date" readonly value="">
                                  </div>
                                  <div class="col-md-5">
                                      <input type="text" name="e_date" placeholder="End Date" data-date-format="yyyy-mm-dd" class="form-control wh1 date form_datetime" data-date="" data-link-field="dtp_input1" id="e_date" readonly value="">
                                  </div>
                                </div>
                            </div>
                            <div class="bg_album">
                              <div class="fallback">
                                <input name="images" type="file" multiple class="s_images" />
                                <input type="button" value="Upload" id="upload_images" class="btn btn-warning btn-xs">
                               </div>
                               <div><span id="show_error" class="text-danger" style="display:none">Please select all fields</span></div>
                              <div>
                              <div id="uploaded_images">
                                  
                              </div>
                          </div>
                        </form>
                            <div class="mfile_close">
                                <input type="button" id="after_upload" value="Close" class="btn btn-success btn-xs">
                            </div>
                             <div class="clear"></div>
                          </div>
                            
                          </div>
                        </div>
                        
                      </div>
                  </div>

                  <div class="btn-group">
                  <?php foreach($page_data as $data): ?>
                      <input class="btn btn-default user_tab" type="button" main="<?php echo $data["classifieds_pages"]["id"]; ?>" value="<?php echo $data["classifieds_pages"]["page_name"]; ?>">
                 <?php endforeach; ?>
                  </div>

                  <div id="load_page">
                      
                  </div>

                  <div class="row">
                     <div class="col-md-6" style="margin-top: 20px;" id="edit_contant">
                      
                    </div>
                  </div>


                    <div class="clear"></div>
               </div>
          </div>
      </div>

<script src="/js/lightbox.js"></script>
           
<script>
$(document).ready(function(){

     var id = btoa("1");
     $('#load_page').load("/classifiedadmins/banneradd?id="+id);

    $('#upload_images').click(function(){
        var name = $('#page_name').val();
        var photo = $('.s_images').val();

        var cont = $('#country_name').val();
        var s_date = $('#s_date').val();
        var e_date = $('#e_date').val();
        
        if(name == "" || photo == "" || cont == "" || s_date == "" || e_date == "")
        {
           $('#show_error').show();
            return false;
        }else{
            $('#show_error').hide();
        }

        var fd = new FormData();
        var file_data = $('input[type="file"]')[0].files; // for multiple files
        for(var i = 0;i<file_data.length;i++){
            fd.append("file_"+i, file_data[i]);
        }
        var other_data = $('#upload_album').serializeArray();
        $.each(other_data,function(key,input){
            fd.append(input.name,input.value);
        });
        
        $.ajax({
            type: "post",
            url: "<?php echo $this->webroot ?>classifiedadmins/uploadadd",
            data: fd,
            contentType: false,
            processData: false,
            beforeSend: function() {
            $('.loading').show();
            $('.loading_icon').show();
             },
            dataType: "json",
            success: function(data){
                if(data.images_data != "")
                {
                  $('.loading').hide();
                  $('.loading_icon').hide();
                   $('#uploaded_images').html(data.images_data);
                }else{
                    
                }
           }
    });
 });

    $('.user_tab').click(function(){
        var id = btoa($(this).attr("main"));
        $('#load_page').load("/classifiedadmins/banneradd?id="+id);
    });
  
});
</script>

<script>
    $(document).ready(function(){
        $('#after_upload').click(function(){
            window.location.href = "/classifiedadmins/banner";
         });

        $("#s_date").datetimepicker({
             language:  'en',
             weekStart: 1,
             todayBtn:  1,
             autoclose: 1,
             todayHighlight: 1, 
             startView: 2,
             minView: 2,
             forceParse: 0,
             pickTime: false
        });

        $("#e_date").datetimepicker({
             language:  'en',
             weekStart: 1,
             todayBtn:  1,
             autoclose: 1,
             todayHighlight: 1, 
             startView: 2,
             minView: 2,
             forceParse: 0,
             pickTime: false
        });


        $('body').on('click','.delete_album', function(){
          if(confirm("Are you sure you want to Delete"))
          {
            var image_id = btoa($(this).attr("main"));
            var tab = "classifieds_add";
            var page_id = btoa($(this).attr("page"));
         
            $.ajax({
                    type: "post",
                    url: "<?php echo $this->webroot ?>classifiedadmins/deleteimage",
                    data:"image_id="+image_id+"&tab="+tab,
                    dataType: "json",
                    beforeSend: function() {
                      $('.loading').show();
                      $('.loading_icon').show();
                    },
                    success: function(data){
                        if(data.message == 'success'){
                          $('#load_page').load("/classifiedadmins/banneradd?id="+page_id);
                          $('.loading').hide();
                          $('.loading_icon').hide();
                        }
                    }
            });
          }
        });
    });
</script>