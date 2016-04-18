<div class="table-responsive clearfix editclearfix">
      <form id="add_club" name="add_club" enctype="multipart/form-data">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th colspan="2">Edit Add</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Browse Image </td>
              <td>
              <span class="btn btn-success btn-file">
                  Select Image<input type="file" name="image_id" id="image_id">
                  </span>
                  <div class="edit_clogo">
                      <img src="/<?php echo $data[0]["files"]["base_url"]; ?>" alt="edit_img">
                  </div>
              </td>
            </tr>
            <tr>
              <td>Start Date</td>
              <td>
                 <input type="text" name="s_date1" placeholder="Start Date" data-date-format="yyyy-mm-dd" class="form-control wh1 date form_datetime" data-date="" data-link-field="dtp_input1" id="s_date1" readonly value="<?php echo $data[0]["classifieds_add"]["s_date"]; ?>">
              </td>
            </tr>
            <tr>
              <td>End Date</td>
              <td>
                  <input type="text" name="e_date1" placeholder="End Date" data-date-format="yyyy-mm-dd" class="form-control wh1 date form_datetime" data-date="" data-link-field="dtp_input1" id="e_date1" readonly value="<?php echo $data[0]["classifieds_add"]["e_date"]; ?>">
              </td>
            </tr>


            <tr>
              <td>Page Name</td>
              <td>
                  <select class="form-control" id="page_name1" name="page_name1">
                      <option selected="" disabled="">Select Page Name</option>
                      <?php foreach($page_data as $page): ?>
                        <?php if($data[0]["classifieds_add"]["page_id"] == $page["classifieds_pages"]["id"]){ ?>
                          <option value="<?php echo $page["classifieds_pages"]["id"];?>" selected><?php echo $page["classifieds_pages"]["page_name"]; ?></option>
                        <?php }else{ ?>
                          <option value="<?php echo $page["classifieds_pages"]["id"];?>" ><?php echo $page["classifieds_pages"]["page_name"]; ?></option>
                      <?php } endforeach; ?>
                  </select>
              </td>
            </tr>
            <tr>
              <td>Country</td>
              <td>
                  <select class="form-control" id="country_name1" name="country1">
                      <option selected="" disabled="">Select Country</option>
                      <?php foreach($country as $cont): ?>
                        <?php if($data[0]["classifieds_add"]["country"] == $cont["countries"]["id"]){ ?>
                          <option value="<?php echo $cont["countries"]["id"];?>" selected><?php echo $cont["countries"]["country_name"]; ?></option>
                        <?php }else{ ?>
                          <option value="<?php echo $cont["countries"]["id"];?>" ><?php echo $cont["countries"]["country_name"]; ?></option>
                      <?php } endforeach; ?>
                  </select>
              </td>
            </tr>

            <tr>
              <input type="hidden" name="add_id"  value="<?php echo $data[0]["classifieds_add"]["id"]; ?>">
              <input type="hidden" id="add_page_id" value="<?php echo $page_id; ?>">
              <td colspan="2"><input type="button" name="save_add" id="save_add" value="Save" class="btn btn-primary"> 
               <input type="button" name="cancel" id="cancel" value="Cancel" class="btn btn-danger"></td>
            </tr>
          </tbody>
        </table>
      </form>
      </div>

<script>
    $(document).ready(function(){

          $(".table").on('click','#save_add',function(){
              if($("#add_club").valid())
              {
                //var data = $('#add_club').serialize();
                var formData = new FormData($('#add_club')[0]);
                var page_id = btoa($('#page_name1').val());
                $.ajax({
                        url:"<?php echo $this->webroot; ?>classifiedadmins/editnewadds",
                        type:"post",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType:"json",
                        beforeSend: function() {
                          $('.loading').show();
                          $('.loading_icon').show();
                         },
                        success: function(data){
                            if(data.message == 'success')
                            {
                                $('#load_page').load("/classifiedadmins/banneradd?id="+page_id);  
                                
                                $('.editclearfix').hide();
                                $('.loading').hide();
                                $('.loading_icon').hide();
                            }
                        }
                });
              }else{
                return false;
              } 
          });

          $('#cancel').click(function(){
             window.location.href = "/classifiedadmins/banner";
           });

          $("#s_date1").datetimepicker({
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

        $("#e_date1").datetimepicker({
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
  });
</script>