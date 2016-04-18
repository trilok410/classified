<?php $lang = $this->Session->read('lang'); ?>
</section>
	
<!--conten sec start-->
<div class="conten">
   <div class="favorite_main">
       <div class="container">
         <div class="row">
           <div class="col-md-12">
              <div class="success_register"  style="box-shadow:0 0 2px #ccc; padding:15px; max-width:700px; background-color:#fff">
                 <div class="success_register_head" style="color:#FFF; background-color:#1598d7; padding:10px; border-radius:4px 4px 0px 0px; text-transform:capitalize; font-size:18px;">
                    <?php echo $lang["Change Email"]; ?>
                 </div>
                 <div class="success_register_content" style="background-color:#f0f0f0; padding:10px;">
                   <?php echo $message; ?>
                 </div>
              </div>
           </div>
         </div>
         
       </div>
   </div>
</div>
<!--conten sec end-->