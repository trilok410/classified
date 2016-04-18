<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <?php echo $this->Meta->getmeta();  ?>
    <!-- Bootstrap -->
	<?php     
	    echo $this->Html->css('bootstrap.css');
	    echo $this->Html->css('custom.css');
	    echo $this->Html->css('responsive.css');
	    echo $this->Html->css('flaticon.css');
	    echo $this->Html->css('animsition.min.css');
	    echo $this->Html->css('font-awesome.min.css');
	    echo $this->Html->css('toastr.min.css');
	?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<?php     
	    echo $this->Html->script('jquery.min.js');
	    echo $this->Html->script('modernizr.custom.28101.js');
	    echo $this->Html->script('bootstrap.min.js');
	    echo $this->Html->script('jquery.animsition.min.js');
	    echo $this->Html->script('jquery.nicescroll.min.js');
      echo $this->Html->script('toastr.min.js');
	    echo $this->Html->script('custom.js');
	 ?>
     <script type="text/javascript">
     	function get_url()
     	{
     		var url = "<?php echo $this->webroot; ?>";
     		return url;
     	}
     </script>	
  </head>
  <body>
  		<?php echo $this->element('index_header'); ?>

		<?php echo $this->fetch('content'); ?>

		<?php echo $this->element('default_footer'); ?>
  </body>
</html>