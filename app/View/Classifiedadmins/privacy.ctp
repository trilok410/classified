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
             <h2>Privacy</h2>   
            </div>
        </div>
         <!-- /. ROW  -->
        <hr />
        <?php $flash = $this->Session->flash('privacy');
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
            <div class="col-md-12" style="margin-top: 20px;" id="edit_contant">
              	<div class="table-responsive clearfix">
	                <form id="add_terms" method="post" action="<?php echo $this->webroot; ?>classifiedadmins/privacy">
		                <table class="table table-bordered table-hover">
		                  <tbody>
			                   <tr>
			                        <td>Content</td>
			                        <td>
			                            <textarea class="form-control template_body_block" name="content"><?php echo $page["Page"]["content"]; ?></textarea>
			                        </td>
			                    </tr>
			                    <tr>
			                      <td colspan="2">
			                      	<input type="hidden" name="p_id" value="<?php echo $page["Page"]["id"]; ?>">
			                      	<input type="submit" value="Save" class="btn btn-primary"> 
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