<div class="table-responsive clearfix">
      <form id="edit_maincategory">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Edit Main Category</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Name (English)</td>
              <td><input type="text" value="<?php echo $subcategory_data[0]["classified_subcategory"]["subcategory"]; ?>" name="sub[name][]" class="form-control">
              <input type="hidden" value="<?php echo $subcategory_data[0]["classified_subcategory"]["id"]; ?>" name="sub[id][]">
              </td>
            </tr>
            <tr>
              <td>Name (German)</td>
              <td><input type="text" value="<?php if(isset($sub_data2[0]["classified_subcategory"]["subcategory"])){ echo utf8_encode($sub_data2[0]["classified_subcategory"]["subcategory"]); } ?>" name="sub[name][]" class="form-control">
              <input type="hidden" value="<?php if(isset($sub_data2[0]["classified_subcategory"]["id"])) { echo $sub_data2[0]["classified_subcategory"]["id"]; } ?>" name="sub[id][]">
              <input type="hidden" value="<?php echo $subcategory_data[0]["classified_subcategory"]["s_id"]; ?>" name="s_id">
              <input type="hidden" value="2" name="lang_id">
              </td>
            </tr>
            <tr>
                <td>Category Name</td>
                <td>
                    <select class="form-control" name="category_name">
                        <option selected disabled value="0">Select Category</option>
                      <?php foreach($all_category as $data): ?>
                        <?php if($subcategory_data[0]["classified_subcategory"]["c_id"] == $data["classified_category"]["c_id"] ) { ?>
                        <option value="<?php echo $data["classified_category"]["c_id"]; ?>" selected><?php echo $data["classified_category"]["category"]; ?></option>
                        <?php }else{ ?>
                        <option value="<?php echo $data["classified_category"]["c_id"]; ?>"><?php echo $data["classified_category"]["category"]; ?></option>
                        <?php } ?>
                      <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Main Category Name</td>
                <td>
                    <select class="form-control" name="main_name">
                        <option selected disabled value="0">Select Category</option>
                      <?php foreach($main_category as $main): ?>
                        <?php if($subcategory_data[0]["classified_subcategory"]["main_id"] == $main["classified_maincategories"]["m_id"] ) { ?>
                        <option value="<?php echo $main["classified_maincategories"]["m_id"]; ?>" selected><?php echo $main["classified_maincategories"]["maincategory"]; ?></option>
                        <?php }else{ ?>
                        <option value="<?php echo $main["classified_maincategories"]["m_id"]; ?>"><?php echo $main["classified_maincategories"]["maincategory"]; ?></option>
                        <?php } ?>
                      <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Meta Description</td>
                <td>
                  <textarea class="form-control" name="meta_description"  required><?php echo $subcategory_data[0]["classified_subcategory"]["meta_description"]; ?></textarea>
                  <p><b>Hint: </b> {city} for city, {keyword} for keyword</p>
                </td>
            </tr>
            <tr>
                <td>Meta Keywords</td>
                <td>
                  <input type="text" class="form-control" name="meta_keyword" value="<?php echo $subcategory_data[0]["classified_subcategory"]["meta_keyword"]; ?>"  required>
                  <p><b>Hint: </b> {city} for city, {keyword} for keyword</p>
                </td>
            </tr>
            <tr>
                <td>Meta Title</td>
                <td>
                  <input type="text" class="form-control" name="meta_title" value="<?php echo $subcategory_data[0]["classified_subcategory"]["meta_title"]; ?>"  required>
                  <p><b>Hint: </b> {city} for city, {keyword} for keyword</p>
                </td>
            </tr>
            <tr>
              <td colspan="2"><input type="button" name="save_maincategory" id="save_maincategory" value="Save" class="btn btn-primary"> 
               <input type="button" name="cancel" id="cancel" value="Cancel" class="btn btn-danger"></td>
            </tr>
          </tbody>
        </table>
      </form>
  </div>

<script>
    $(document).ready(function(){

      $('#save_maincategory').click(function(){
           
            var name = $('#edit_maincategory').serialize();
            //var name = new FormData($('#edit_maincategory')[0]);

            if($("#edit_maincategory").valid())
            {
              $.ajax({
                      url:"<?php echo $this->webroot; ?>classifiedadmins/editsubcategory",
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
                              window.location.reload();
                          }
                      }
              });
            }else{
              return false;
            }  
        });

      $('#cancel').click(function(){
          window.location.reload();
      });

    });
</script>