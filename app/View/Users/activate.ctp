<script type="text/javascript">
     $(document).ready(function() {
     $("#register_error").modal("show");
     
     $(".close_popup").click(function(){
     window.location.href =  "<?php echo $this->webroot ?>";       
     });
     
     
     });
    
</script>

    <div class="modal fade success" id="register_error" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
    <div class="sum_from">
        <div class="modal-body" id="error_body">
            <div class="success_register"  style="box-shadow:0 0 2px #ccc; padding:15px; max-width:700px; background-color:#fff">
                 <div class="success_register_head" style="color:#FFF; background-color:#1598d7; padding:10px; border-radius:4px 4px 0px 0px; text-transform:capitalize; font-size:18px;">
                    your registration
                 </div>
                 <div class="success_register_content" style="background-color:#f0f0f0; padding:10px;">
                    <?php echo $message; ?>
                 </div>
            </div>
            <input type="button" class="btn btn-primary close_popup" value="OK"/>
        </div>
    </div>
</div></div></div>       