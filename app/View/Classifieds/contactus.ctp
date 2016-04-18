</section>
<?php $lang = $this->Session->read('lang'); ?>
<?php $user = $this->Session->read("user"); ?>

<!--conten sec start-->
<div class="conten">
  <div class="post_details">
       <div class="container">
         <div class="row">
            <div class="col-md-9 col-sm-9">
            	<h2>Contact Us</h2>
            	<div class="alert alert-success show_message" role="alert" style="display:none">Thank you for Contact Us</div>
            	<form class="form-horizontal" id="contact_form">
				    <div class="form-group">
				        <label for="name" class="col-sm-2 control-label">Name</label>
				        <div class="col-sm-10">
				            <input type="text" class="form-control" id="name" name="name" placeholder="First & Last Name" value="">
				        </div>
				    </div>
				    <div class="form-group">
				        <label for="email" class="col-sm-2 control-label">Email</label>
				        <div class="col-sm-10">
				            <input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="">
				        </div>
				    </div>
				    <div class="form-group">
				        <label for="message" class="col-sm-2 control-label">Message</label>
				        <div class="col-sm-10">
				            <textarea class="form-control" rows="4" name="message"></textarea>
				        </div>
				    </div>
				    <div class="form-group">
				        <div class="col-sm-10 col-sm-offset-2">
				            <input id="send_contact" type="button" value="Send" class="btn btn-primary">
				        </div>
				    </div>
				</form>
            </div>
            <div class="col-md-3 col-sm-3">
	            <div class="show_contact_data">
	     			<?php echo $data["Page"]["content"]; ?>	
	     		</div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("body").on("click","#send_contact", function(){
			var data = $("#contact_form").serialize();
			$.ajax({
					url:"<?php echo $this->webroot; ?>classifieds/sendcontactmail",
					type:"post",
					data: data,
					dataType:"json",
					success: function(data)
					{
						$("#contact_form")[0].reset();
						$(".show_message").show();
						setTimeout(function(){
							$(".show_message").hide();
						},1500);
					}
			});
		});
	});
</script>