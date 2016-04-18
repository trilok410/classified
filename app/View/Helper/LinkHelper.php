<?php 

/* /app/View/Helper/LinkHelper.php */
App::uses('AppHelper', 'View/Helper');

class LinkHelper extends AppHelper {
    
    function changetitle($tit)
	{
	  $jay = preg_replace('/[^a-zA-Z0-9]/', "-", $tit);
	  $jay = strtolower($jay);
	  return $jay;
	}

	function changename($name)
	{
		$jay = str_ireplace(" & ","-",$name);
		$jay = str_ireplace(" ","-",$jay);
		$jay = strtolower($jay); 
		return $jay;
	}
}


?>