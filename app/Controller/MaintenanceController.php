<?php 

App::uses("AppController","Controller");

class MaintenanceController extends AppController
{
	
	public function index()
	{
		$this->layout = "default_maintenance";
		$this->loadModel("Websetting");
		$setting = $this->Websetting->find("first",array("conditions" => array("id" => 1)));
		if($setting["Websetting"]["construction"] == 1)
		{
			$this->redirect("/");
		}
		$this->set("setting",$setting);
	}

	public function blockpage()
	{
		$this->layout = "default_maintenance";
		$this->loadModel("Websetting");
		$setting = $this->Websetting->find("first",array("conditions" => array("id" => 1)));
		$blockip = explode(",", $setting["Websetting"]["blockip"]);
		$my_ip = $_SERVER["REMOTE_ADDR"];
		if(!in_array($my_ip, $blockip))
		{
			$this->redirect("/");
		}
		$this->set("setting",$setting);
		$this->render("index");
	}
}

 ?>