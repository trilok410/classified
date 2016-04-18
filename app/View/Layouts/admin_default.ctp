<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

// $cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
// $cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
  <head>


    <!-- <link rel="icon" href="images/fav_icon.png" type="image/png"/>
    <link rel="icon" href="images/fav_icon.ico" type="image/ico"/>
 -->


  	<title>Classified Admin</title>
    <?php echo $this->Html->charset(); ?>
  	<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
    <?php //echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'); ?>
	<?php
      echo $this->Html->meta('icon');
      echo $this->Html->css('/css/admin-bootstrap.css');
      echo $this->Html->css('/css/sb-admin.css');
      echo $this->Html->css('/css/metisMenu.min.css');
      echo $this->Html->css('/css/admin-custom.css');
      /* for validation */
      echo $this->Html->css('/css/jsvalidaion_css.css');
     //echo $this->Html->css('sb-admin-2.css');
      echo $this->Html->css('/css/font-awesome.min.css');
      //echo $this->Html->css('/css/bootstrap.min.css');
      
      /* for date and time*/
      echo $this->Html->css('/css/bootstrap-datetimepicker.css');

      /* for table*/
      echo $this->Html->css('/css/dataTables.bootstrap.css');
      
      /** For Light Box **/
      echo $this->Html->css('/css/lightbox.css');
      /* For view detail slider */
      echo $this->Html->css('owl.carousel.css');
      echo $this->Html->css('jasny-bootstrap.min.css');
      //echo $this->Html->css('custom.css');
      

      echo $this->fetch('meta');


      //echo $this->Html->css('/js/jquery-ui.css');
      echo $this->Html->script('/js/jquery.min.js');
      echo $this->Html->script('/js/jquery-ui.js');
      echo $this->Html->script('bootstrap.min.js');
      echo $this->Html->script('/js/metisMenu.min.js');
      echo $this->Html->script('/js/sb-admin-2.js');
      /* for date time*/
      echo $this->Html->script('/js/bootstrap-datetimepicker.js');
      /*Auto size*/
      echo $this->Html->script('/js/jquery.autosize.js');
      /* for table */
      echo $this->Html->script('/js/jquery.dataTables.js');
      echo $this->Html->script('/js/dataTables.bootstrap.js');
      /** For Light box **/
      echo $this->Html->script('/js/lightbox.js');
      /* for validation */
      echo $this->Html->script('/js/jquery.validate.js');
      /* For view detail slider */
      echo $this->Html->script('jasny-bootstrap.min.js');
      echo $this->Html->script('owl.carousel.min.js');

     ?>
</head>
  <body>
        
	  <?php $admin = $this->Session->read('admin'); 
        if(empty($admin)){
          echo $this->element('admin_header');
        }else{
          echo $this->element('admin_main_header');
        }
     
    ?>

		<?php 
        if(empty($admin)){
         }else{
          echo $this->element('admin_sidebar');
        } 
					 
		 ?> 


	 <?php
  	 if(isset($page) AND $page == 'view') { echo $this->element('admin_banner'); }
  	 else
  	 {
  	  echo $this->fetch('content');	
  	 }
	 ?>

   <?php echo $this->element('admin_footer'); ?>
     
  </body>
</html>
