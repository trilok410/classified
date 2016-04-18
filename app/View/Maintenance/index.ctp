<!DOCTYPE html>
<html>
<head>
	<title><?php echo $setting["Websetting"]["title"]; ?></title>
	<style type="text/css">
		body {
		  background-image: url("<?php echo $this->webroot; ?>images/under_construction.jpg");
		  background-size: cover;
		}
		.under_mesg{ width: 30%; height: 200px; background-color: #fff; margin: 5%auto 0 ; border-radius: 8px; padding: 20px;
		}
	</style>
</head>

<body>
	<div class="under_mesg">
	<?php echo $setting["Websetting"]["description"]; ?>
	</div>
</body>
</html>


