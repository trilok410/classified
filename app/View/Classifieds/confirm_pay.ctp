<?php $lang = $this->Session->read('lang'); ?>
</section>
<!--content start-->
<div class="conten">
  <div class="post_details">
       <div class="container">
          <?php if(isset($newuser) && !empty($newuser)){ ?>
          <div class="success_register_main">
              <div class="success_register"  style="box-shadow:0 0 2px #ccc; padding:15px; max-width:700px; background-color:#fff">
                <div class="success_register_head" style="color:#FFFF00; background-color:#1598d7; padding:10px; border-radius:4px 4px 0px 0px; text-transform:capitalize; font-size:14px;">
                    Just one step towards the registration
                </div>
                <div class="success_register_content" style="padding:10px;">
                    <div class="src_icon"><i class="fa fa-exclamation-circle"></i></div>
                    <div class="src_txt">
                        Confirm registration!
                        <span>
                           You will receive your activation link via email.
                        </span>
                    </div>
                </div>
              </div>
              <div class="success_register_bottom">
                <h5>Please click on the activation link in the email with the subject line "click activation link" to confirm successful your registration.</h5>
                <p>By clicking on the registration link you will be logged in and your newly created ad is published. If you after a few minutes no E-mail with the subject: "activation link click" 
                find in your inbox, then please check to see whether the email was accidentally sorted into the spam folder. You should also get the Spam Folder not find any email from kleinanzeigen.de, then 
                please check whether the entered email address is correct. If you make a mistake, then you can use your email address here correct.   
                </p>
              </div>
          </div>
          <?php }else{ ?>
          <div class="ads_confimation_wrap">
            <div>
             <h2><?php echo $lang["Thank"]." ".$lang["You"]." ".$lang["Your"]." ".$lang["Payment"]; ?> , <?php echo $ack;?> </h2>
              <h3><?php echo $lang["Your"]." ".$lang["Transaction Id"] ;?> :<span class="label label-success"><?php echo $tr_id; ?></span></h3>
              <h3><?php echo $lang["Amount"]; ?>: <span class="label label-primary">£<?php echo $Amount; ?></span></h3>
              <a href="<?php echo $this->webroot; ?>" class="your_ads_url"><?php echo $lang["Home"]; ?> </a>  
              <?php if(isset($add_id)){ ?>
              <a href="<?php echo $this->webroot; ?>cad/<?php echo $add_id; ?>" class="your_ads_url"><?php echo $lang["View Ad"]; ?> </a>
              <?php } ?>
           </div>
          </div>
          <?php } ?>
      </div>
  </div>
</div>
<!--content end-->


