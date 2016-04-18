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
             <h2>Edit Template</h2>   
            </div>
        </div>
         <!-- /. ROW  -->
        <hr />
        <div class="row">
            <div class="col-md-12" style="margin-top: 20px;" id="edit_contant">
              	<div class="table-responsive clearfix">
	                <form id="add_subcategory" method="post" action="<?php echo $this->webroot; ?>classifiedadmins/updatetemplate">
		                <table class="table table-bordered table-hover">
		                  <tbody>
			                    <tr>
			                        <td>Key</td>
			                        <td>
			                            <input type="text" class="form-control" value="<?php echo $email["EmailTemplate"]["key"]; ?>" readonly>
			                        </td>
			                    </tr>
			                    <tr>
			                    	<td>Short Code</td>
			                      	<td class="new_model">
			                          For Subject: <?php echo $email["EmailTemplate"]["short_subject"]; ?>
			                      	</td>
			                    </tr>
			                    <tr>
			                    	<td>Subject</td>
			                      	<td class="new_model">
			                          <input type="text" class="form-control" value="<?php echo $email["EmailTemplate"]["subject"]; ?>" name="subject">
			                      	</td>
			                    </tr>
			                    <tr>
			                    	<td>Short Code</td>
			                      	<td class="new_model">
			                          For Content: <?php echo $email["EmailTemplate"]["short_code"]; ?>
			                      	</td>
			                    </tr>
			                    <tr>
			                        <td>Content</td>
			                        <td>
			                            <textarea class="form-control template_body_block" name="content"><?php echo $email["EmailTemplate"]["content"]; ?></textarea>
			                        </td>
			                    </tr>
			                    <tr>
			                      <td colspan="2">
			                      	<input type="hidden" name="t_id" value="<?php echo $email["EmailTemplate"]["id"]; ?>">
			                      	<input type="submit" id="save_subcategory" value="Update" class="btn btn-primary"> 
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