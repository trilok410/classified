<?php $user = $this->Session->read("user"); ?>
<?php $lang = $this->Session->read('lang'); ?>
<main class="">
    <?php $act = $this->request->params['action']; ?>
    <?php if($act == "search"){ ?>
    <section class="top_banner_sec search_top_sec">
    <?php }else{ ?>
    <section class="top_banner_sec">
    <?php } ?>
	<!--Header sec start-->
    <header class="header_sec" id="header">
        <div class="container">
        	<div class="row">
            	<div class="col-md-3 col-md-3">
                	<div class="logo"><a href="<?php echo $this->webroot; ?>"><img src="<?php echo $this->webroot; ?>images/logo.png" class="img-responsive"></a></div>
                </div>
                <div class="col-md-9 col-md-9">
                	<div class="header_right pull-right">
                    	<ul>
                            <?php if(!empty($user)){ ?>
                                <li>
                                    <a href="<?php echo $this->webroot ?>users/myaccount"><?php echo $lang["My Account"]; ?></a>
                                    <ul class="drop_list">
                                        <li><a href="<?php echo $this->webroot ?>users/myaccount"><?php echo $lang["My Ad"]; ?></a></li>
                                        <li><a href="<?php echo $this->webroot; ?>users/message"><?php echo $lang["Message"]; ?></a></li>
                                        <li><a href="<?php echo $this->webroot ?>users/favoritead"><?php echo $lang["Favorite Ads"]; ?></a></li>
                                        <li><a href="<?php echo $this->webroot ?>users/savesearch"><?php echo $lang["My Search"]; ?></a></li>
                                        <li><a href="<?php echo $this->webroot ?>users/paymenthistory"><?php echo $lang["Payment History"]; ?></a></li>
                                        <li><a href="<?php echo $this->webroot ?>users/setting"><?php echo $lang["Setting"]; ?></a></li>                                        
                                        <li><a href="<?php echo $this->webroot ?>users/logout"><?php echo $lang["Logout"]; ?></a></li>
                                    </ul>
                                </li>
                            <?php }else{ ?>
                            	<li>
                                	<a href="javascript:void(0)" id="login"><?php echo $lang["Login"]; ?></a>
                                </li>
                                <li>
                                	<a href="javascript:void(0)" id="register"><?php echo $lang["Register"]; ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                        <div class="post_addbtn">
                        	<a href="<?php echo $this->webroot; ?>classifieds/postadd">+ <?php echo $lang["Post A Free Add"]; ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--Header sec end-->
    
	