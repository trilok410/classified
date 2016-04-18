<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
<script>
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
<div id="page-wrapper" >
  <div id="page-inner">
      <div class="row">
          <div class="col-md-12">
           <h2>ToolTip</h2>   
          </div>
      </div>
       <!-- /. ROW  -->
       <hr />
       
      <div class="row">
          <div class="col-md-12">
              <!-- Advanced Tables -->
              <div class="panel panel-default">
                  <div class="panel-heading">
                       Edit ToolTip
                  </div>      
                  <div class="table-responsive clearfix">
                    <form method="post" action="<?php echo $this->webroot; ?>classifiedadmins/edittooltip" enctype="multipart/form-data">
                        <table class="table table-bordered table-hover">
                          <tbody>
                            <tr>
                              <td>Key</td>
                              <td>
                                  <input type="text" value="<?php echo $tool["ToolTip"]["key"]; ?>" class="form-control" readonly>
                              </td>
                            </tr>
                            <tr>
                              <td>Content</td>
                              <td>
                                  <textarea class="form-control template_body_block" name="content"><?php echo $tool["ToolTip"]["content"]; ?></textarea>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="2">
                                <input type="hidden" value="<?php echo $tool["ToolTip"]["id"]; ?>" name="t_id" id="t_id">
                                <input type="submit" value="Save" class="btn btn-primary"> 
                                <input type="button" name="cancel" id="cancel" value="Cancel" class="btn btn-danger">
                              </td>
                            </tr>
                          </tbody>
                        </table>
                    </form>
                  </div>
            </div>
          </div>
      </div>
  </div>
</div>

<script>
    $(document).ready(function(){
      $('#cancel').click(function(){
          window.location.href="<?php echo $this->webroot; ?>classifiedadmins/tooltip";
      });
    });
</script>