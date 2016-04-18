
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
              <td>Logo</td>
              <td>
                  <span class="btn btn-success btn-file">
                  Select Logo<input type="file" name="logo" id="logo">
                  </span>
              </td>
            </tr>
            <tr>
              <td>Name (English)</td>
              <td><input type="text" value="<?php echo $subcategory_data[0]["classified_maincategories"]["maincategory"]; ?>" name="sub[name][]" class="form-control">
              <input type="hidden" value="<?php echo $subcategory_data[0]["classified_maincategories"]["id"]; ?>" name="sub[id][]">
              </td>
            </tr>
            <tr>
              <td>Name (German)</td>
              <td><input type="text" value="<?php if(isset($sub_data2[0]["classified_maincategories"]["maincategory"])){ echo utf8_encode($sub_data2[0]["classified_maincategories"]["maincategory"]); } ?>" name="sub[name][]" class="form-control">
              <input type="hidden" value="<?php if(isset($sub_data2[0]["classified_maincategories"]["id"])) { echo $sub_data2[0]["classified_maincategories"]["id"]; } ?>" name="sub[id][]">
              <input type="hidden" value="<?php echo $subcategory_data[0]["classified_maincategories"]["m_id"]; ?>" name="m_id">
              <input type="hidden" value="2" name="lang_id">
              </td>
            </tr>
            <tr>
                <td> Description</td>
                <td>
                  <textarea class="form-control template_body_block" name="description"  required><?php echo $subcategory_data[0]["classified_maincategories"]["description"]; ?></textarea>
                </td>
            </tr>
            <tr>
                <td>Meta Description</td>
                <td>
                  <textarea class="form-control" name="meta_description"  required><?php echo $subcategory_data[0]["classified_maincategories"]["meta_description"]; ?></textarea>
                  <p><b>Hint: </b> {city} for city, {keyword} for keyword</p>
                </td>
            </tr>
            <tr>
                <td>Meta Keywords</td>
                <td>
                  <input type="text" class="form-control" name="meta_keyword" value="<?php echo $subcategory_data[0]["classified_maincategories"]["meta_keyword"]; ?>"  required>
                  <p><b>Hint: </b> {city} for city, {keyword} for keyword</p>
                </td>
            </tr>
            <tr>
                <td>Meta Title</td>
                <td>
                  <input type="text" class="form-control" name="meta_title" value="<?php echo $subcategory_data[0]["classified_maincategories"]["meta_title"]; ?>"  required>
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
    window.tinymce.dom.Event.domLoaded = true;
    tinymce.init({
      selector: ".template_body_block",
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

      $('#save_maincategory').click(function(){
           tinyMCE.triggerSave();
            //var name = $('#edit_maincategory').serialize();
            var name = new FormData($('#edit_maincategory')[0]);

            if($("#edit_maincategory").valid())
            {
              $.ajax({
                      url:"<?php echo $this->webroot; ?>classifiedadmins/editmaincategory",
                      type:"post",
                      data:name,
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