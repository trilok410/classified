<?php 
	App::uses('AppController', 'Controller');
	App::uses('CakeEmail', 'Network/Email');
  App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
  App::uses('Paypal', 'Paypal.Lib');

	class ClassifiedadminsController extends AppController{

		public $components = array('Cookie', 'Session', 'Auth');

	    public function beforeFilter() {
	        parent::beforeFilter();
	        //$this->Auth->loginRedirect = array('controller' => 'events','action' => 'login');
          $this->Auth->logoutRedirect = array('controller' => 'admins', 'action' => 'view');
	        $this->Auth->allow('login', 'view');
	        $this->Auth->userModel = 'Classified';
	        $this->layout = 'admin_default'; 
	        //$this->Auth->authorize = array('Event');
	    }

	    /* Common functions */

	    public function blockdata()
        {
         if($this->RequestHandler->isPost())
         {
            $data = $this->request->data;
            $c_id = (int) base64_decode($data["c_id"]);
            $tab = $data["tab"];
            $col = $data["col"];
           
            $this->Classifiedadmin->blockdata($c_id,$tab,$col);
            
            $this->set('message', 'success');
            $this->set('_serialize',array('message'));
            $this->response->statusCode(200);
         }
        }

	    public function unblockdata()
        {
         if($this->RequestHandler->isPost())
         {
            $data = $this->request->data;
            $c_id = (int) base64_decode($data["c_id"]);
            $tab = $data["tab"];
            $col = $data["col"];

            $this->Classifiedadmin->unblockdata($c_id,$tab,$col);
            
            $this->set('message', 'success');
            $this->set('_serialize',array('message'));
            $this->response->statusCode(200);
         }
        }

        public function getcategory()
        {
        	if($this->RequestHandler->isAjax())
        	{
        		$data = $this->request->data;
        		$m_id = (int) base64_decode($data["m_id"]);
        		
        		$category_data = $this->Classifiedadmin->getcategory($m_id);

        		$category = array();

                foreach ($category_data as $x) {
                    $category[$x['classified_category']['c_id']] = $x["classified_category"]["category"];
                }
        		$this->set('category',$category);
        		$this->set('_serialize', array("category"));
        		$this->response->statusCode(200);
        	}
        }

        public function logout() {
	        $this->Auth->logout();
	        $this->Session->destroy();
          return $this->redirect('/classifiedadmins/');
   		}

   		public function deletead()
   		{
   			if($this->RequestHandler->isAjax())
   			{
   				$id = $this->request->data["id"];
   				$id = rtrim($id,",");
   				$this->Classifiedadmin->deletead($id);
   				$img_id = $this->Classifiedadmin->getallimagesid($id);
   				if(!empty($img_id))
   				{
	   				$imgid = "";
	   				foreach($img_id as $iid)
	   				{
	   					$imgid .= $iid["classifiedimages"]["logo_id"].",";
	   				}
	   				$imgid = rtrim($imgid,",");
	   				$this->Classifiedadmin->deleteallimages("classifiedimages","logo_id",$imgid);
	   				$this->Classifiedadmin->deleteallimages("files","id",$imgid);
   				}
   				$this->set("message","success");
   				$this->set("_serialize",array("message"));
   				$this->response->statusCode(200);
   			}
   		}

   		public function unblockalldata()
   		{
   			if($this->RequestHandler->isAjax())
   			{
   				$id = $this->request->data["id"];
   				$tab = $this->request->data["tab"];
   				$id = rtrim($id,",");
   				$this->Classifiedadmin->unblockalldata($tab,$id);
   				$this->set("message","success");
   				$this->set("_serialize",array("message"));
   				$this->response->statusCode(200);
   			}
   		}

   		public function blockalldata()
   		{
   			if($this->RequestHandler->isAjax())
   			{
   				$id = $this->request->data["id"];
   				$tab = $this->request->data["tab"];
   				$id = rtrim($id,",");
   				$this->Classifiedadmin->blockalldata($tab,$id);
   				$this->set("message","success");
   				$this->set("_serialize",array("message"));
   				$this->response->statusCode(200);
   			}
   		}

   		public function deleteuser()
   		{
   			if($this->RequestHandler->isAjax())
   			{
   				$this->loadModel("Classified");
	            $this->loadModel("SaveSearch");
	            $this->loadModel("Payment");
	            $this->loadModel("UserFavorite");
	            $this->loadModel("User");

   				$id = $this->request->data["id"];
   				$id = rtrim($id,",");
   				$id = explode(",", $id);
   				foreach($id as $idd){
		            $user_id = (int) $idd;
		            $this->Classified->deleteAll(array('user_id' => $user_id), false);
		            $this->SaveSearch->deleteAll(array('user_id' => $user_id), false);
		            $this->Payment->deleteAll(array('user_id' => $user_id), false);
		            $this->UserFavorite->deleteAll(array('user_id' => $user_id), false);
		            $this->User->delete($user_id);
	            }
	            $this->set("message","success");
	            $this->set("_serialize", array("message"));
	            $this->response->statusCode(200);
   			}
   		}

 		/* Common functions */

/************** Jayendra start ***************/
	    public function index()
	    {
	    	$this->loadModel("User");
	    	$this->loadModel("Report");
	    	$this->loadModel("Classified");
	    	$all_count =  $this->Classifiedadmin->allcount();
            $topusers = $this->User->find("all",array("conditions" => array("status" => 2),"fields" => array("name"),"order" => array("created_date DESC"),"limit" => 5));
            $topad = $this->Classified->find("all",array("conditions" => array("status" => 2),"fields" => array("title"),"order" => array("create_date DESC"),"limit" => 5));
            $topissue = $this->Report->find("all",array("conditions" => array("status" => 2),"fields" => array("name"),"order" => array("created_date DESC"),"limit" => 5));
            //echo "<pre>"; print_r($topusers); die();

            $this->set('topissue',$topissue);
            $this->set('topad',$topad);
            $this->set('topusers',$topusers);
            $this->set('all_count',$all_count);
	    }

	    public function view() {
          $login_user = $this->Session->read("admin");
          if (!empty($login_user)) {
              return $this->redirect('/admins/index');
           }
          $this->set('page', 'view');
          $this->layout = 'admin_default'; 
        }

        public function login()
		{
			$this->loadModel('Admin');

	        $login_user = $this->Session->read("admin");
	        if (!empty($login_user)) {
	          	return $this->redirect('/classifiedadmins/index');
	        }
	        if ($this->request->is('post')) {
	        	$email = $this->request->data["email"];
	        	$pass = $this->request->data["password"];
	        	$haspass = $this->Auth->password($pass);
            	$record = $this->Admin->find('first', array(
	                'conditions' => array(
	                    'Admin.email' => $email,
	                    'Admin.password' => $haspass,
	                )
	            ));
	         
	            if (empty($record)) {

	                return $this->set('message', 'Invalid Email or Password, try again');
	            }

	            $status = $record['Admin']['status'];
	          	
		        if ($status == "1") {
	            	return $this->set('message', 'Please varifiy your Email first');
	        	}
		    	
		    	$this->Auth->authenticate['Form'] = array('fields' => array('email' => 'email', 'password' => 'password'));
		        
		        $this->request->data['Admin']['id'] = $record['Admin']['id'];
		        
		        if ($this->Auth->login($this->request->data['Admin'])) {
		            $user = $this->Auth->user();
		            $this->Session->write('admin', $record);
		            return $this->redirect('/classifiedadmins/index');
		        } else {
		           return $this->Session->setFlash(__('Invalid Email or password, try again'));
		        }	       
	        }
	    }

	    public function profile()
	    {
	        $this->loadModel("Admin");

	        $user_id = (int) $this->Auth->user("id");

	        $user_data = $this->Admin->find('first', array('conditions' => array('id'=> $user_id)));
	        
	        $this->set('user',$user_data);
	    }

	    public function updatesettings()
	    {
            $this->loadModel("Admin");

            $user_id = (int) $this->Auth->user("id");

            if($this->RequestHandler->isAjax())
            {
                $data = $this->data;   
                if(!empty($data["f_name"])){
                    $f_name = base64_decode($data["f_name"]);
                    $l_name = base64_decode($data["l_name"]);
                    $this->Admin->updateusername($f_name,$l_name,$user_id);

                    $message = 'success';
                }
                if(!empty($data["contact_no"]))
                {
                    $contact_no = base64_decode($data["contact_no"]);
                    $this->Admin->updateusercontact($contact_no,$user_id);
                    $message = 'success';
                }
                if(!empty($data["web_address"]))
                {
                    $web_address = base64_decode($data["web_address"]);
                    $this->Admin->id = $user_id;
                    $this->Admin->saveField('web_address',$web_address);
                    $message = 'success';
                }

                $this->set('message',$message);
                $this->set('_serialize',array('message'));
                $this->response->statusCode(200);
            }
	    }

	    public function updatepassword()
        {
          $this->loadModel('Admin');

          $user_id = (int) $this->Auth->user("id");
          
          if($this->RequestHandler->isAjax())
          {
            $data = $this->data;
            $old_password = $data["cur_pass"];
            $new_password = $data["password"];
            $confirm_password = $data["confirm_password"];
            $user_detail = $this->Admin->findById($user_id);
            $passwordHasher = new SimplePasswordHasher();
            if($passwordHasher->check($old_password,$user_detail["Admin"]["password"]))
            {
               if($new_password == $confirm_password){
               $this->Admin->id = $user_id;
               $this->Admin->saveField('password',$new_password);
               $message  = "Your password has been changed.";    
               }else{
                $message = "New Password is not match with Confirm Password";   
               }
            }else{
               $message = "Your Current Password is wrong"; 
            }
              $this->set('message',$message);
              $this->set('_serialize',array('message'));
              $this->response->statusCode(200);
          }
        }

	    public function maincategory()
	    {
	    	$all_category1 = $this->Classifiedadmin->getallmaincategory1();
            $all_category2 = $this->Classifiedadmin->getallmaincategory2();
   			
   			$this->set('all_category1',$all_category1);
            $this->set('all_category2',$all_category2);
	    }

	    public function editmaincategory()
      {
        	$user_id = (int) $this->Auth->user("id");
    		  $this->loadModel('file');

        if(!empty($this->params["url"]["m_id"]))
	    	{
	    		$m_id = (int) base64_decode($this->params["url"]["m_id"]);
	    		$subcategory_data1 = $this->Classifiedadmin->getcategory1('classified_maincategories','m_id',$m_id);
          $subcategory_data2 = $this->Classifiedadmin->getcategory2('classified_maincategories','m_id',$m_id);
	    		$this->set('subcategory_data',$subcategory_data1);
          $this->set('sub_data2',$subcategory_data2);
	    	}elseif($this->RequestHandler->isAjax())
	    	{
	    			$data = $this->request->data;
	    			$lang_id = (int) $data["lang_id"];
            $m_id = (int) $data["m_id"];
            $description = $data["description"];
            $meta_desc = $data["meta_description"];
            $meta_key = $data["meta_keyword"];
            $meta_tit = $data["meta_title"];
            for($i = 0; $i < count($data["sub"]["name"]); $i++)
            {
                $name = $data["sub"]["name"][$i];
                if(!empty($data["sub"]["id"][$i]))
                {
                    $id = (int) $data["sub"]["id"][$i];

                    $this->Classifiedadmin->editmaincategory($name,$id,$description,$meta_desc,$meta_key,$meta_tit);        
                }else{
                    $this->Classifiedadmin->updatemaincategory($name,$lang_id,$m_id,$description,$meta_desc,$meta_key,$meta_tit);
                }
            }
            $message = "success";

            if (!empty($_FILES["logo"]["size"])) {
         
              $filename = $_FILES["logo"]["name"];
              $date = date_create();
              $timestamp = date_timestamp_get($date);
              $ext_array = explode(".", $filename);
              $ext = array_pop($ext_array);
              $newfilename = $timestamp . '_main_cat_' . $user_id . "." . $ext;
              $path = 'files/admin/classified/' . $newfilename;
              $status = 2;
              $created_on = date("Y-m-d H:i:s");
              $file = array();
              $file["file_name"] = $newfilename;
              $file["base_url"] = $path;
              $file["status"] = $status;
              $file["created_on"] = $created_on;
              if (move_uploaded_file($_FILES["logo"]["tmp_name"], $path)) {
                  chmod($path, 0777);
                  $this->file->create();
                  if ($this->file->save($file)) {
                      $lid = (int) $this->file->getLastInsertID();
                      $this->Classifiedadmin->updateimage($lid,$m_id,'classified_maincategories','m_id');
                      $message = "success";
                  } else {
                      $message = "unsuccess";
                  }
              }
            }

            $this->set('message',$message);
            $this->set('_serialize',array('message'));
            $this->response->statusCode(200);

	    	}
      }

      public function category()
	    {
	    	$all_category1 = $this->Classifiedadmin->getallcategory1();
	    	$all_category2 = $this->Classifiedadmin->getallcategory2();
   			$maincategory = $this->Classifiedadmin->getallmaincategory();

   			$this->set('all_category1',$all_category1);
        $this->set('all_category2',$all_category2);
        $this->set('all_category',$maincategory);
	    }

      public function addcategory()
      {
          $this->loadModel("Classifiedcategory");
          $this->loadModel("file");
          $user_id = (int) $this->Auth->user("id");
          $data = $this->request->data;
          //$this->p($data);
          $last = $this->Classifiedadmin->getlastid('classified_category','c_id');
          $last_id = 1 + (int) $last[0]["classified_category"]["c_id"];
          $logo_id = 0;

          $filename = $_FILES["logo"]["name"];
          $date = date_create();
          $timestamp = date_timestamp_get($date);
          $ext_array = explode(".", $filename);
          $ext = array_pop($ext_array);
          $newfilename = $timestamp . '_cat_' . $user_id . "." . $ext;
          $path = 'files/admin/classified/' . $newfilename;
          $status = 2;
          $created_on = date("Y-m-d H:i:s");
          $file = array();
          $file["file_name"] = $newfilename;
          $file["base_url"] = $path;
          $file["status"] = $status;
          $file["created_on"] = $created_on;
          if (move_uploaded_file($_FILES["logo"]["tmp_name"], $path)) {
             chmod($path, 0777);
             $this->file->create();
             $this->file->save($file);
             $logo_id = (int) $this->file->getLastInsertID();
          }

          $c = 0;
          for($i = 1; $i <= count($data["sub"]); $i++)
          {
            $cat = array();
            $cat["c_id"] = $last_id;
            $cat["maincategory_id"] = $data["category_name"];
            $cat["logo_id"] = $logo_id;
            $cat["category"] = $data["sub"][$c];
            $cat["lang_id"] = $i;
            $cat["pap_id"] = 1;
            $cat["filter_page"] = 1;
            $cat["meta_description"] = $data["meta_description"];
            $cat["meta_keyword"] = $data["meta_keyword"];
            $cat["meta_title"] = $data["meta_title"];
            $cat["status"] = 2;
            $cat["created_date"] = date("Y-m-d H:i:s");
            $this->Classifiedcategory->create();
            $this->Classifiedcategory->save($cat);
            $c++;
          }
          $this->Session->setFlash('Category added Successfully', 'default', array(), 'category');
          $this->redirect("/classifiedadmins/category");
      }

	    public function editcategory()
	    {
	    	$user_id = (int) $this->Auth->user("id");
    		$this->loadModel('file');
	    	if(!empty($this->params["url"]["c_id"]))
	    	{
	    		$c_id = (int) base64_decode($this->params["url"]["c_id"]);
	    		$subcategory_data1 = $this->Classifiedadmin->getcategory1('classified_category','c_id',$c_id);
          $subcategory_data2 = $this->Classifiedadmin->getcategory2('classified_category','c_id',$c_id);
	    		$maincategory = $this->Classifiedadmin->getallmaincategory();

	    		$this->set('subcategory_data',$subcategory_data1);
          $this->set('sub_data2',$subcategory_data2);
          $this->set('all_category',$maincategory);
	    		
			}elseif($this->RequestHandler->isAjax())
	    		{
            $this->loadModel("Classifiedcategory");
	    			$data = $this->request->data;
                   
	    			$lang_id = (int) $data["lang_id"];
            $c_id = (int) $data["c_id"];
            $maincat_id = (int) $data["category_name"];

              for($i = 0; $i < count($data["sub"]["name"]); $i++)
              {
                  $cat = array();
                  $name = $data["sub"]["name"][$i];
                  $cat["category"] = $name;
                  $cat["maincategory_id"] = $maincat_id;
                  $cat["meta_description"] = $data["meta_description"];
                  $cat["meta_keyword"] = $data["meta_keyword"];
                  $cat["meta_title"] = $data["meta_title"];
                  if(!empty($data["sub"]["id"][$i]))
                  {
                      $id = (int) $data["sub"]["id"][$i];
                      $this->Classifiedcategory->id = $id;
                      $this->Classifiedcategory->save($cat);
                  }else{
                      $cat["lang_id"] = $lang_id; 
                      $cat["c_id"] = $c_id;
                      $cat["status"] = 2;
                      $cat["created_date"] = date("Y-m-d h:i:s");
                      $this->Classifiedcategory->create();
                      $this->Classifiedcategory->save($cat);
                  }
              }
              $message = "success";

              if (!empty($_FILES["logo"]["size"])) {
         
              $filename = $_FILES["logo"]["name"];
              $date = date_create();
              $timestamp = date_timestamp_get($date);
              $ext_array = explode(".", $filename);
              $ext = array_pop($ext_array);
              $newfilename = $timestamp . '_cat_' . $user_id . "." . $ext;
              $path = 'files/admin/classified/' . $newfilename;
              $status = 2;
              $created_on = date("Y-m-d H:i:s");
              $file = array();
              $file["file_name"] = $newfilename;
              $file["base_url"] = $path;
              $file["status"] = $status;
              $file["created_on"] = $created_on;
              if (move_uploaded_file($_FILES["logo"]["tmp_name"], $path)) {
                  chmod($path, 0777);
                  $this->file->create();
                  if ($this->file->save($file)) {
                      $lid = (int) $this->file->getLastInsertID();
                      $this->Classifiedadmin->updateimage($lid,$c_id,'classified_category','c_id');
                      $message = "success";
                  } else {
                      $message = "unsuccess";
                  }
              }
          }
            $this->Session->setFlash('Category Updated Successfully', 'default', array(), 'category');
            $this->set('message',$message);
            $this->set('_serialize',array('message'));
            $this->response->statusCode(200);

	    		}
	    }

	    public function subcategory()
	    {
	    	$all_category1 = $this->Classifiedadmin->getallsubcategory1();
	    	$all_category2 = $this->Classifiedadmin->getallsubcategory2();
   			$maincategory = $this->Classifiedadmin->getallmaincategory();
    		$category = $this->Classifiedadmin->getallcategory();

    		$this->set('main_category',$maincategory);
			  $this->set('all_category',$category);	
   			$this->set('all_category1',$all_category1);
        $this->set('all_category2',$all_category2);
	    }

	    public function addsubcategory()
	    {
	    	if($this->RequestHandler->isAjax())
	    	{
          $this->loadModel("Subcategory");
	    		$data = $this->request->data;

	    		$last = $this->Classifiedadmin->getlastid('classified_subcategory','s_id');
          $last_id = 1 + (int) $last[0]["classified_subcategory"]["s_id"];
          $m_id = (int) $data["main_id"];
          $c_id = (int) $data["category_id"];

          $subcat = array();
          $subcat["s_id"] = $last_id;
          $subcat["main_id"] = $m_id;
          $subcat["c_id"] = $c_id;
          $subcat["meta_description"] = $data["meta_description"];
          $subcat["meta_keyword"] = $data["meta_keyword"];
          $subcat["meta_title"] = $data["meta_title"];
          $subcat["status"] = 2;
          $subcat["created_date"] = date("Y-m-d h:i:s");;

          $c = 0;
          for($i = 1; $i <= count($data["sub"]); $i++)
          {
              $subcat["subcategory"] = $data["sub"]["name"][$c];
              $subcat["lang_id"] = (int)$data["sub"]["lang_id"][$c];
              // $this->Classifiedadmin->updatesubcategory($category,$lang_id,$last_id,$m_id,$c_id);
              $this->Subcategory->create();
              $this->Subcategory->save($subcat);
              $c++;
          }
	        $this->Session->setFlash('Category added Successfully', 'default', array(), 'subcat');    
          $this->set('message', 'success');
          $this->set('_serialize',array('message'));
          $this->response->statusCode(200);
	    	}
	    }

	    public function editsubcategory()
	    {
	    	$user_id = (int) $this->Auth->user("id");
    		$this->loadModel('file');
        $this->loadModel("Subcategory");
	    	if(!empty($this->params["url"]["s_id"]))
	    	{
	    		$s_id = (int) base64_decode($this->params["url"]["s_id"]);
	    		$subcategory_data1 = $this->Classifiedadmin->getcategory1('classified_subcategory','s_id',$s_id);
          $subcategory_data2 = $this->Classifiedadmin->getcategory2('classified_subcategory','s_id',$s_id);
	    		$maincategory = $this->Classifiedadmin->getallmaincategory();
	    		$category = $this->Classifiedadmin->getallcategory();
	    		$this->set('subcategory_data',$subcategory_data1);
          $this->set('sub_data2',$subcategory_data2);
          $this->set('main_category',$maincategory);
  				$this->set('all_category',$category);	    		
  			}elseif($this->RequestHandler->isAjax())
    		{
    			$data = $this->request->data;
                 
    			$lang_id = (int) $data["lang_id"];
          $s_id = (int) $data["s_id"];
          $c_id = (int) $data["category_name"];
          $m_id = (int) $data["main_name"];
          
          $subcat = array();
          $subcat["main_id"] = $m_id;
          $subcat["c_id"] = $c_id;
          $subcat["meta_description"] = $data["meta_description"];
          $subcat["meta_keyword"] = $data["meta_keyword"];
          $subcat["meta_title"] = $data["meta_title"];

          for($i = 0; $i < count($data["sub"]["name"]); $i++)
          {
              $name = $data["sub"]["name"][$i];
              $subcat["subcategory"] = $name;
              if(!empty($data["sub"]["id"][$i]))
              {
                  $id = (int) $data["sub"]["id"][$i];
                  $this->Subcategory->id = $id;
                  $this->Subcategory->save($subcat);
              }else{

                  $subcat["s_id"] = $s_id;
                  $subcat["lang_id"] = $lang_id;
                  $subcat["status"] = 2;
                  $subcat["created_date"] = date("Y-m-d h:i:s");
                  $this->Subcategory->create();
                  $this->Subcategory->save($subcat);
              }
          }
          $this->Session->setFlash('Category Updated Successfully', 'default', array(), 'subcat');        
          $this->set('message','success');
          $this->set('_serialize',array('message'));
          $this->response->statusCode(200);
    		}
	    }

	    public function viewmodel()
	    {
	    	$mod = $this->Classifiedadmin->getmodels();
	    	// echo "<pre>"; print_r($mod); die();
	    	$this->set("mod",$mod);
	    }

	    public function addmodel()
	    {
	    	if($this->request->is("post"))
	    	{	
	    		$this->loadModel("Models");
	    		$data = $this->request->data;
	    		foreach($data["m_name"] as $m_name)
	    		{
		    		$mod = array();
		    		$mod["c_id"] = $data["c_id"];
		    		$mod["s_id"] = $data["category_id"];
		    		$mod["model"] = $m_name;
		    		$mod["status"] = 2;
		    		$mod["created_date"] = date("Y-m-d H:i:s");
		    		$mod["modify_date"] = date("Y-m-d H:i:s");
		    		$this->Models->create();
		    		$this->Models->save($mod);
	    		}
	    		$this->Session->setFlash('Model Added Successfully', 'default', array(), 'model');
	    	}
	    	$cat = $this->Classifiedadmin->getcategories();
	    	$this->set("category", $cat);
		}

		public function getsubcategories()
		{
			if($this->RequestHandler->isAjax())
			{
				$c_id = (int) $this->request->data["c_id"];
				$subcat = $this->Classifiedadmin->getsubcategories($c_id);
	    		$this->set('subcat',$subcat);
                $this->set('_serialize',array('subcat'));
                $this->response->statusCode(200);
			}
		}

		public function editmodel()
		{
			if($this->request->is("post"))
			{
				$this->loadModel("Models");
				$data = $this->request->data;
				$data["status"] = 2;
				$data["modify_date"] = date("Y-m-d H:i:s");
				$this->Models->id = $data["m_id"];
				$this->Models->save($data);
				$this->Session->setFlash('Model Updated Successfully', 'default', array(), 'umodel');
				$this->redirect("/classifiedadmins/viewmodel");
			}else if($this->request->is("get"))
			{
				$m_id = (int) base64_decode($this->params["url"]["id"]);
				$mod = $this->Classifiedadmin->getmodelbyid($m_id);
				$cat = $this->Classifiedadmin->getcategories();
	    		//echo "<pre>"; print_r($mod); die();
	    		$this->set("category", $cat);
	    		$this->set("mod", $mod);
			}
		}

		public function useradds() 
        {
        	$add_data = $this->Classifiedadmin->getallad();
        	$this->set('add_data',$add_data);
		}

		public function viewadddetail()
		{
			if($this->request->is('get'))
		        {
		            $add_id = (int) base64_decode($this->params["url"]["a_id"]);
		            
		            $add_data = $this->Classifiedadmin->getadddetail($add_id);
		            $add_images = $this->Classifiedadmin->getaddimages($add_id);
		            
		            if(!empty($add_data))
		            {
		                $add_data = $add_data[0];
		            }
		            //echo "<pre>"; print_r($add_data); die();
		            $this->set('add',$add_data);
		            $this->set('add_images',$add_images);
		        }
		}

		public function sendmailtosellor()
	    {
	        if($this->RequestHandler->isAjax())
	        {
	        	$this->loadModel('Admin');
				$user_id = (int) $this->Auth->user("id");

	            $data = $this->request->data;

            	$user_data = $this->Admin->find('first', array('conditions' => array('id' => $user_id)));
	            $user_mail = $user_data["Admin"]["email"];
	            $this->__usertosellormail($data,$user_mail);
	            
	            $this->set('success', "success");
	            $this->set('_serialize', array('success'));
	            $this->response->statusCode(200);

	        }
	    }

	    /** For send mail to sellor **/

	    public function __usertosellormail($data,$user_mail)
	    {
            $to = $data['to_mail'];
            $subject = "Classified Admin";
            $txt = '<html><body><div style="border:1px solid #999; border-radius:5px; background-color:#ccc">';
            $txt .= '<h2> Dear '.$data["to_name"].' Response for Your Add '.$data["title"].'</h2>';
            $txt .= '<p style="background-color:#999">'.nl2br($data["description"]).'</p>';
            $txt .= '</div></body></html>';

            $headers = "From:". strip_tags($user_mail). "\r\n";
            $headers .= "Reply-To: ". strip_tags($user_mail) . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";  
            mail($to,$subject,$txt,$headers);
	    }

	    public function user()
        {
          $this->loadModel("User");
		  $user_data = $this->User->find('all');
          $this->set('user_data',$user_data);
        }

        public function viewuserdetail()
        {   
        	$this->loadModel('Classifiedadmin');
            if(!empty($this->params["url"]["u_id"]))
            {
              $u_id = (int) base64_decode($this->params["url"]["u_id"]);
              $user_detail = $this->Classifiedadmin->getuserdetail($u_id);
              $this->set('user',$user_detail);
            }
        }

        public function country()
   		{
	 		$country_data = $this->Classifiedadmin->getallcountry();
	        $this->set('country_data',$country_data);
       	}

       	public function addcountry()
        {
         if($this->RequestHandler->isPost())
         {
            $data = $this->request->data;
            $name = base64_decode($data["name"]);

            $this->Classifiedadmin->addcountry($name);

            $this->set('message', 'success');
            $this->set('_serialize',array('message'));
            $this->response->statusCode(200);
         }
        }

        public function editcountry()
        {

         if($this->RequestHandler->isPost())
          {
            $data = $this->request->data;
            $name = base64_decode($data["name"]);
            $id = (int) base64_decode($data["id"]);
            $this->Classifiedadmin->updatecountry($name,$id);

            $this->set('message', 'success');
            $this->set('_serialize',array('message'));
            $this->response->statusCode(200);

          }
         if(!empty($this->params["url"]["c_id"]))
         {
           $c_id = (int) base64_decode($this->params["url"]["c_id"]);  
           $cont_data = $this->Classifiedadmin->getcountrydata($c_id);
         
           $this->set('cont_data',$cont_data);
         }
        }

        public function state()
     		{
     		 	$state_data = $this->Classifiedadmin->getallstatedata();
          $country_data = $this->Classifiedadmin->getallcountry();
       		$this->set('country_data',$country_data);
          $this->set('state_data',$state_data);
     		}

       	public function addstate()
        {
         if($this->RequestHandler->isPost())
         {
            $data = $this->request->data;
            $name = base64_decode($data["name"]);
            $c_id = (int) base64_decode($data["c_id"]);

            $this->Classifiedadmin->addstate($name,$c_id);

            $this->set('message', 'success');
            $this->set('_serialize',array('message'));
            $this->response->statusCode(200);
         }
        }

        public function editstate()
        {
          if($this->RequestHandler->isPost())
          {
            $data = $this->request->data;

            $name = base64_decode($data["name"]);
            $s_id = (int) base64_decode($data["s_id"]);
            $c_id = (int) base64_decode($data["c_id"]);

            $this->Classifiedadmin->updatestate($name,$s_id,$c_id);

            $this->set('message', 'success');
            $this->set('_serialize',array('message'));
            $this->response->statusCode(200);

          }
          if(!empty($this->params["url"]["s_id"]))
          {
           $s_id = (int) base64_decode($this->params["url"]["s_id"]);  
           $state_data = $this->Classifiedadmin->getstatedata($s_id);
           $country_data = $this->Classifiedadmin->getallcountry();
           $this->set('country_data',$country_data);
           $this->set('state_data',$state_data);
          }
        }

        public function city()
        {
          ini_set('memory_limit', '-1');
          $city_data = $this->Classifiedadmin->getallcitydata();
          $country_data = $this->Classifiedadmin->getallcountry();
          //$this->p($city_data);
          $this->set('country_data',$country_data);
          $this->set('city_data',$city_data);
        }

        public function addcity()
        {
         if($this->RequestHandler->isPost())
         {
            $data = $this->request->data;
            $name = $data["name"];
            $s_id = (int) $data["s_id"];

            $this->Classifiedadmin->addcity($name,$s_id);

            $this->set('message', 'success');
            $this->set('_serialize',array('message'));
            $this->response->statusCode(200);
         }
        }

        public function editcity ()
        {
          if($this->RequestHandler->isPost())
          {
            $data = $this->request->data;

            $name = $data["name"];
            $s_id = (int) $data["s_id"];
            $cid = (int) $data["cid"];

            $this->Classifiedadmin->updatecity($name,$s_id,$cid);

            $this->set('message', 'success');
            $this->set('_serialize',array('message'));
            $this->response->statusCode(200);

          }
          if(!empty($this->params["url"]["cid"]))
          {
           $cid = (int) base64_decode($this->params["url"]["cid"]);  
           $city_data = $this->Classifiedadmin->getcitydata($cid);
           $country_data = $this->Classifiedadmin->getallcountry();
           $this->set('country_data',$country_data);
           $this->set('city_data',$city_data);
          }
        }

        public function webtext()
        {
          
        }

        public function textlist()
        {
           $this->loadModel("WebText");
           if(!empty($this->params["url"]["lang"]))
           {
              $lang_id = (int) base64_decode($this->params["url"]["lang"]);
              $text_data = $this->WebText->find('all', array('conditions' => array('lang_id' => $lang_id)));
              $this->set('text_data',$text_data);
           }  
        }

        public function edittext()
        {
          $this->loadModel("WebText");

          if(!empty($this->params["url"]["t_id"]))
          {
            $t_id = (int) base64_decode($this->params["url"]["t_id"]);
            $text_data = $this->WebText->find('first', array('conditions' => array('id' => $t_id)));
            $this->set('text',$text_data);
          }else if($this->RequestHandler->isAjax())
          {
              $data = $this->data;
              $this->WebText->id =  (int) $data["id"];
              if($this->WebText->saveField('text_lang',$data["name"]))
              {
                $message = 'success';
              }else{
                $message = 'unsuccess';
              }
              $this->set('message',$message);
              $this->set('_serialize', array('message'));
              $this->response->statusCode(200);  
          }
        }

        public function paymentmode()
        {
        	$p_data = $this->Classifiedadmin->getpaymentmode();
        	$this->set("p_data", $p_data);
        }

        public function editp_mode()
        {
            if(isset($this->params["url"]["m_id"]))
            {
              $m_id =  (int)base64_decode($this->params["url"]["m_id"]);
              $p_data = $this->Classifiedadmin->getpaymentmodebyid($m_id);
              $this->set('p_data',$p_data);
            }
        }

        public function updatep_mode()
        {
            if($this->request->is("post"))
            {	
            	$this->loadModel("PaymentMode");
            	$this->loadModel("file");
            	$data = $this->request->data;
				      $pay_id = (int)$data["m_id"];
            	$this->PaymentMode->id = $pay_id;
            	if($this->PaymentMode->save($data))
            	{
            		if (!empty($_FILES["image"]["size"]))
            		{
                        $filename = $_FILES["image"]["name"];
		                $date = date_create();
		                $timestamp = date_timestamp_get($date);
		                $ext_array = explode(".", $filename);
		                $ext = array_pop($ext_array);
		                $newfilename = $timestamp . '_pay_' . $pay_id . "." . $ext;
		                $path = 'files/admin/' . $newfilename;
		                $status = 2;
		                $created_on = date("Y-m-d H:i:s");
		                $file = array();
		                $file["file_name"] = $newfilename;
		                $file["base_url"] = $path;
		                $file["status"] = $status;
		                $file["created_on"] = $created_on;
		                if (move_uploaded_file($_FILES["image"]["tmp_name"], $path)) {
		                    chmod($path, 0777);
		                    $this->file->create();
		                    if ($this->file->save($file)) {
		                        $lid = (int) $this->file->getLastInsertID();
		                        $this->PaymentMode->id = $pay_id;
                    			$this->PaymentMode->saveField('logo_id',$lid);
		                        $message = "success";
		                    } else {
		                        $message = "unsuccess";
		                    }
		                }
		            }
		            $this->Session->setFlash('Updatded Successfully', 'default', array(), 'pay');
            		$this->redirect("/classifiedadmins/paymentmode");
            	}
            }
        }

        public function paymenthistory()
        {
        	$history = $this->Classifiedadmin->gethistory();
          $this->set("history", $history);
        }

        public function report()
        {
        	$this->loadModel("Report");
        	$report = $this->Report->find("all", array("order" =>array("created_date DESC")));
        	$this->set("report", $report);
        }

        public function feedbacktouesr()
        {
            if(!empty($this->params["url"]["id"]))
            {
            	$this->loadModel("Report");
                $id = (int)base64_decode($this->params["url"]["id"]);
                $report = $this->Report->find("first", array("order" =>array("created_date DESC")));
        		$this->set("report", $report);
            }
        }

        public function contactevents()
        {
            if($this->RequestHandler->isAjax())
            {
                $data = $this->request->data;
                $sent_mail = $this->__sendmailtouser($data);
                $message = "success";
                $this->set('message', $message);
                $this->set('_serialize', array('message'));
                $this->response->statusCode(200);  
            }
        }

        function __sendmailtouser($data) {
            $email = $data['to_email'];
            $name = $data['to_name'];
            $subject = $data['subject'];
            $message = $data['message'];

            $this->loadModel("EmailTemplate");
            $edata = $this->EmailTemplate->findById(9);
            $sub = str_replace("{SUBJECT}", $subject, $edata["EmailTemplate"]["subject"]);
            $msg = str_replace("{NAME}", $name, str_replace("{MESSAGE}", $message, $edata["EmailTemplate"]["content"]));
            
            $cakeEmail = new CakeEmail('default');
            $cakeEmail->template('default','defaultmail')
                    ->emailFormat('html')
                    ->to($email)
                    ->subject($sub)
                    ->viewVars(array('content' => $msg));
            return $cakeEmail->send();
        }

        public function websetting()
        {	
        	$this->loadModel("Websetting");
        	if($this->request->is("post"))
        	{
        		$data = $this->request->data;
        		$this->Websetting->id = (int)$data["w_id"];
        		if($this->Websetting->save($data))
        		{
        			$this->Session->setFlash('Setting Updatded Successfully', 'default', array(), 'setting');
        		}
        	}
        	$setting = $this->Websetting->find("first",array("conditions" => array("id" => 1)));
        	$this->set("setting",$setting);
		}

    public function tooltip()
		{
			$this->loadModel("ToolTip");
			$tool = $this->ToolTip->find("all");
			$this->set("tooltip", $tool);
		}

		public function edittooltip()
		{
			$this->loadModel("ToolTip");
			if($this->request->is("get"))
			{
				$tid = (int)base64_decode($this->params["url"]["t_id"]);
				$tool = $this->ToolTip->find("first", array("conditions"=>array("id" =>$tid)));
				$this->set("tool", $tool);
			}else if($this->request->is("post"))
			{
				$data = $this->request->data;
				$this->ToolTip->id = $data["t_id"];
				$this->ToolTip->saveField("content",$data["content"]);
				$this->Session->setFlash('Updatded Successfully', 'default', array(), 'tooltip');
        $this->redirect("/classifiedadmins/tooltip");
			}

		}

		public function pendingadds()
		{
			$data = $this->Classifiedadmin->getpendingad();
			$this->set("add_data",$data);
		}

		public function addad()
		{
			  $this->loadModel("ToolTip");
        $this->loadModel("Classified");

        if($this->request->is("post"))
        {
          $this->loadModel("User");
          $this->loadModel('file');
          $this->loadModel('ClassifiedImage');
          $this->loadModel('Tag');
          
          $data = $this->request->data;
          $user_id = (int)$data["uid"];

          $address = $data["street_no"].' '.$data["zipcode"].' '.$data["city"].' '.$data["cont_name"];
          $loc = $this->getlatlng($address);

          $data["user_id"] = $user_id;
          $data["logo_id"] = 28;
          $data["lat"] = $loc["latitude"];
          $data["lng"] = $loc["longitude"];
          $data["addby"] =  1;  
          $data["status"] = 0;
          $data["create_date"] = date("Y-m-d H:i:s");
          $data["modify_date"] = date("Y-m-d H:i:s");
          $this->Classified->create();
          if($this->Classified->save($data))
          {
              $add_id = (int) $this->Classified->getLastInsertID();

              if (!empty($_FILES["logo_image"])) {
                  $img_id = array();
                  for($i = 0; $i < count($_FILES["logo_image"]["name"]); $i++)
                  {
                      if($_FILES["logo_image"]["size"][$i] > 0 )
                      {
                          $filename = $_FILES["logo_image"]["name"][$i];
                          $date = date_create();
                          $timestamp = date_timestamp_get($date);
                          $ext_array = explode(".", $filename);
                          $ext = array_pop($ext_array);
                          $newfilename = $timestamp . '_classified_add_'.$ext_array[0]."_".$i."_".$user_id."." . $ext;
                          $path = 'files/admin/classified_add/' . $newfilename;
                          $status = 2;
                          $created_on = date("Y-m-d H:i:s");
                          $file = array();
                          $file["file_name"] = $newfilename;
                          $file["base_url"] = $path;
                          $file["status"] = $status;
                          $file["created_on"] = $created_on;

                          if (move_uploaded_file($_FILES["logo_image"]["tmp_name"][$i], $path)) {
                              chmod($path, 0777);
                              $this->file->create();
                              if ($this->file->save($file)) {

                                  $lid = (int) $this->file->getLastInsertID();
                                  $img_id[] = $lid;
                                  $file_data = array();
                                  $file_data["user_id"] = $user_id;
                                  $file_data["add_id"] = $add_id;
                                  $file_data["logo_id"] = $lid;
                                  $file_data["status"] = 2;
                                  $file_data["created_date"] = date('Y-m-d h:i:s');

                                  $this->ClassifiedImage->create();
                                  $this->ClassifiedImage->save($file_data);
                              }
                              $message = "Add Posted Successfully";
                          }else
                          {
                              $message = "There is some error Add did not post successfully";  
                          }
                      }
                  }
                  if(count($img_id) > 0)
                  {
                      $this->Classified->id = $add_id;
                      $this->Classified->saveField('logo_id', $img_id[0]);
                  }
              }

              $tags = explode(",", $data["tag_name"]);
              foreach($tags as $tag)
              {
                  $t_data = $this->Tag->find("first", array("conditions" => array("tag" => $tag)));
                  if(empty($t_data))
                  {
                      $td = array();
                      $td["tag"] = $tag;
                      $td["status"] = 2;
                      $td["created_date"] = date("Y-m-d H:i:s");
                      $this->Tag->create();
                      $this->Tag->save($td);
                  }
              }

              if(!empty($data["feature"]))
              {
                  $u_amt = array();
                  $totalamt = 0; 
                  foreach($data["feature"] as $feat)
                  {
                       $name = $feat["name"];
                       $val = $data["feat"][$name];
                       $val = explode("-", $val);
                       $totalamt += $val[1];
                       $u_amt["totalamt"] = $totalamt;
                       $u_amt[$name] = 1;
                       $u_amt[$name."_date"] = date("Y-m-d", strtotime("+ $val[0]"));
                  }
                  //echo "<pre>"; print_r($u_amt); die();
                  $this->Session->write("u_amt", $u_amt);
                  $this->set("u_amt", $u_amt);
                  $this->set("data", $data);
                  $this->set("add_id", $add_id);
                  $this->render('payment');
              }else
              {
                  //$this->__sendpostaddmail($data,$add_id);
                  $message = "success";
                  $this->set("add_id", $add_id);
                  $this->set("data", $data);
              }                
          }else
          {
              $message =  "fail";
          }

          $this->set("message", $message);
        }
        $main_cat_data = $this->Classifiedadmin->getmaincategory();
        $country = $this->Classified->getcountry();
        $p_mode = $this->Classified->getpaymentmode();
        $tooltip = $this->ToolTip->find("all");
        $tip = array();
        foreach($tooltip as $tool)
        {
            $tip[$tool["ToolTip"]["id"]] = $tool["ToolTip"]["content"];
        }
        
        $this->set("tip", $tip);
        $this->set("p_mode", $p_mode);
        $this->set("country", $country);    
        $this->set("main_cat", $main_cat_data);
    }

    public function editad()
    {
      if($this->request->is("get"))
        {
            $this->loadModel("Models");
            $this->loadModel("ToolTip");
            $this->loadModel("Classified");
            $id =  (int)$_GET["id"];
            $addata = $this->Classifiedadmin->getadddata($id);
            $addata = $addata[0];
            $add_images = $this->Classified->getaddimages($id);
            $country = $this->Classified->getcountry();
            $p_mode = $this->Classified->getpaymentmode();

            $s_id = $addata["classifieds"]["s_id"];
            $mod = $this->Models->find("all",array("conditions" => array("s_id" => $s_id)));
            $main_cat_data = $this->Classified->getmaincategory();

            $this->set("main_cat", $main_cat_data);
            $this->set("model",$mod);
            $this->set("p_mode", $p_mode);
            $this->set("country", $country);    
            $this->set("add_images",$add_images);
            $this->set("add",$addata);
        }
    }

    /** Update post add  **/
    public function updatepostadd()
    {
        $this->loadModel('file');
        $this->loadModel('Tag');
        $this->loadModel('Classified');
        $this->loadModel('ClassifiedImage');
        
        if(!empty($_POST))
        {
               
            $data = $_POST;
            $user_id = (int) $data["user_id"];
            $message = "Post Edited Successfully";
            $add_id = (int) $data["add_id"];
            $img_logoid = $data["img_logoid"];

            $uf = array();
            $uf["price"] = 0; $uf["price_type"] = ""; $uf["condition_type"] = 0; $uf["year"] = ""; $uf["fuel"] = ""; $uf["model"] = ""; $uf["kilometer"] = 0; $uf["typeofadd"] = 0; $uf["rent"] = ""; $uf["sale"] = ""; $uf["furnished"] = ""; $uf["rooms"] = 0; $uf["squaremeter"] = 0; $uf["post_type"] = 0; $uf["gearbox"] = ""; $uf["power"] = 0; $uf["power_unit"] = ""; $uf["mode"] = ""; $uf["job_type"] = 0; $uf["salary_period"] = ""; $uf["salary_from"] = ""; $uf["salary_to"] = ""; $uf["position_type"] = "";
            
            $this->Classified->id = $add_id;
            $this->Classified->save($uf);

            $data["modify_date"] = date('Y-m-d h:i:s');

            $this->Classified->id = $add_id;
            $this->Classified->save($data);
           
            $this->Classified->deleteaddimages($add_id);

            if (!empty($_FILES["logo_image"]))
            {
                $img_id = array();
                for($i = 0; $i < count($_FILES["logo_image"]["name"]); $i++)
                {
                    if($_FILES["logo_image"]["size"][$i] > 0 )
                    {
                        
                        $filename = $_FILES["logo_image"]["name"][$i];
                        $date = date_create();
                        $timestamp = date_timestamp_get($date);
                        $ext_array = explode(".", $filename);
                        $ext = array_pop($ext_array);
                        $newfilename = $timestamp . '_classified_add_'.$ext_array[0]."_".$i."_".$user_id."." . $ext;
                        $path = 'files/admin/classified_add/' . $newfilename;
                        $status = 2;
                        $created_on = date("Y-m-d H:i:s");
                        $file = array();
                        $file["file_name"] = $newfilename;
                        $file["base_url"] = $path;
                        $file["status"] = $status;
                        $file["created_on"] = $created_on;

                        if (move_uploaded_file($_FILES["logo_image"]["tmp_name"][$i], $path)) {
                            chmod($path, 0777);
                            $this->file->create();
                            if ($this->file->save($file)) {

                                $lid = (int) $this->file->getLastInsertID();
                                $img_id[] = $lid;
                                $file_data = array();
                                $file_data["user_id"] = $user_id;
                                $file_data["add_id"] = $add_id;
                                $file_data["logo_id"] = $lid;
                                $file_data["status"] = 2;
                                $file_data["created_date"] = date('Y-m-d h:i:s');

                                $this->ClassifiedImage->create();
                                $this->ClassifiedImage->save($file_data);                            
                            }
                            $message = "Post Edited Successfully";
                        }else{
                                $message = "There is some error Add did not post successfully";  
                             }
                    }
                }
            }else{
                $message = "Post Edited Successfully";
            }
            
            if($img_logoid != "")
            {
              $new_img_logoid = substr($img_logoid, 0,-1);
              $logoid_array = explode(",", $new_img_logoid);
              if(count($logoid_array) > 0 )
              {
                  $this->Classified->id = $add_id;
                  $this->Classified->saveField('logo_id', $logoid_array[0]);
                 
                  for($j = 0; $j < count($logoid_array); $j++)
                  {
                      $file_data = array();
                      $file_data["user_id"] = $user_id;
                      $file_data["add_id"] = $add_id;
                      $file_data["logo_id"] = $logoid_array[$j];
                      $file_data["status"] = 2;
                      $file_data["created_date"] = date('Y-m-d h:i:s');

                      $this->ClassifiedImage->create();
                      $this->ClassifiedImage->save($file_data);
                  }
              }
            }else{
                $this->Classified->id = $add_id;
                $this->Classified->saveField('logo_id', $img_id[0]);
            } 

            $tags = explode(",", $data["tag_name"]);
            foreach($tags as $tag)
            {
                $t_data = $this->Tag->find("first", array("conditions" => array("tag" => $tag)));
                if(empty($t_data))
                {
                    $td = array();
                    $td["tag"] = $tag;
                    $td["status"] = 2;
                    $td["created_date"] = date("Y-m-d H:i:s");
                    $this->Tag->create();
                    $this->Tag->save($td);
                }
            }
            
            if(!empty($data["feature"]))
            {
                $u_amt = array();
                $totalamt = 0; 
                foreach($data["feature"] as $feat)
                {
                     $name = $feat["name"];
                     $val = $data["feat"][$name];
                     $val = explode("-", $val);
                     $totalamt += $val[1];
                     $u_amt["totalamt"] = $totalamt;
                     $u_amt[$name] = 1;
                     $u_amt[$name."_date"] = date("Y-m-d", strtotime("+ $val[0]"));
                }
                //echo "<pre>"; print_r($u_amt); die();
                $this->Session->write("u_amt", $u_amt);
                $this->set("u_amt", $u_amt);
                $this->set("data", $data);
                $this->set("add_id", $add_id);
                $this->render('payment');
            }else
            {
                $this->Session->setFlash($message, 'default', array(), 'good');
                return $this->redirect(array('controller' => 'classifiedadmins', 'action' => 'useradds'));   
            }
        }
    }

    /* Credit/debit card payment */
    public function payment()
    {
        if($this->request->is('post'))
        {
            $this->loadModel("Payment");
            $this->loadModel("Classified");

            $data = $this->request->data;

            $add_id = $data["add_id"];
            $title = $data["title"];
            $amount = $data["amount"];            
            $card = $data["no_card"];
            $cvv = $data["card_cvv"];
            $exp_m = $data["card_month"];
            $exp_y = $data["card_year"];
            
            $this->Paypal = new Paypal(array(
                                            'sandboxMode' => true,
                                            'nvpUsername' => 'soravgarg123-facilitator_api1.gmail.com',
                                            'nvpPassword' => 'PCYX45KMRA3CCNHS',
                                            'nvpSignature' => 'AFcWxV21C7fd0v3bYYYRCpSSRl31ArtJ7rcztV7aXbA7Eg3Lz-jtl8CL'
                                        )); 
            $payment = array(
                            'amount' => $amount,
                            'card' => $card, // This is a sandbox CC
                            'expiry' => array(
                                'M' => $exp_m,
                                'Y' => $exp_y,
                            ),
                            'cvv' => $cvv,
                            'currency' => 'EUR' // Defaults to GBP if not provided
                        );

                        try {
                            $result =  $this->Paypal->doDirectPayment($payment);
                            if($result["ACK"] == 'Success')
                            {   
                                $u_amt = $this->Session->read("u_amt");
                                $this->Session->delete("u_amt");
                                $this->Classified->id = $add_id;
                                $this->Classified->save($u_amt);
                                $user = $this->Classified->getuserdata($add_id);
                                $pmt = array();
                                $pmt["user_id"]  = $user[0]["users"]["id"];
                                $pmt["ad_id"]  = $add_id;
                                $pmt["txn_id"]  = $result['TRANSACTIONID'];
                                $pmt["amount"]  = $result['AMT'];
                                $pmt["payment_type"]  = "credit/debit card";
                                $pmt["mode"] = $result['ACK'];
                                $pmt["ipaddress"] = $_SERVER["REMOTE_ADDR"];
                                $pmt["status"]  = 2;
                                $pmt["created_date"]  = date("Y-m-d H:i:s");
                                $pmt["modify_date"] = date("Y-m-d H:i:s"); 

                                $this->Payment->create();
                                $this->Payment->save($pmt);

                                $status_array = array();
                                $status_array["add_id"] = $add_id;
                                $status_array["title"] = $title;
                                $status_array["tr_id"] = $result["TRANSACTIONID"];
                                $status_array["ack"] = $result["ACK"];
                                $status_array["amt"] = $result["AMT"];

                                $u_res = $this->__sendaddconfirmmailtouser($status_array,$user);
                                
                                $this->set('add_id',$add_id);
                                $this->set('ack',$result["ACK"]);
                                $this->set('tr_id',$result["TRANSACTIONID"]);
                                $this->set('Amount',$result["AMT"]);
                                $this->render('confirm_pay');
                                
                            }else
                            {
                                $this->set('ack',$result["ACK"]);
                                $this->set('tr_id',$result["TRANSACTIONID"]);
                                $this->set('Amount',$result["AMT"]);
                                $this->render('confirm_pay');
                            }
                            
                       } catch (Exception $e) {
                            $message = $e->getMessage();
                            $this->set('ack',$message);
                            $this->set('Amount',"");
                            $this->set('tr_id',"");
                            $this->render('confirm_pay');
                        }   
        }
    }

    /* Paypal payment */
    public function confirm_pay()
    {
        if(!empty($_REQUEST['st']))
        {
            
            if($_REQUEST['st'] == 'Completed' OR $_REQUEST['st'] == "Pending")
            {   
                $this->loadModel("Payment");
                $this->loadModel("Classified");

                $add_id = $_REQUEST['cm'];

                $u_amt = $this->Session->read("u_amt");
                $this->Session->delete("u_amt");

                $this->Classified->id = (int) $add_id;
                $this->Classified->save($u_amt);

                $status_array = array();
                $status_array["add_id"] = $add_id;
                $status_array["title"] = "";
                $status_array["tr_id"] = $_REQUEST['tx'];
                $status_array["ack"] = $_REQUEST['st'];
                $status_array["amt"] = $_REQUEST['amt'];

                $user = $this->Classified->getuserdata($add_id);
                
                $pmt = array();
                $pmt["user_id"]  = $user[0]["users"]["id"];
                $pmt["ad_id"]  = $add_id;
                $pmt["txn_id"]  = $_REQUEST['tx'];
                $pmt["amount"]  = $_REQUEST['amt'];
                $pmt["payment_type"]  = "paypal";
                $pmt["mode"] = $_REQUEST['st'];
                $pmt["ipaddress"] = $_SERVER["REMOTE_ADDR"];
                $pmt["status"]  = 2;
                $pmt["created_date"]  = date("Y-m-d H:i:s");
                $pmt["modify_date"] = date("Y-m-d H:i:s"); 

                $this->Payment->create();
                $this->Payment->save($pmt);
                
                $u_res = $this->__sendaddconfirmmailtouser($status_array,$user);
                
                $this->set('ack',$_REQUEST['st']);
                $this->set('tr_id',$_REQUEST['tx']);
                $this->set('Amount',$_REQUEST['amt']);
                $this->render('confirm_pay');
            }else
            {
                $this->set('ack',$_REQUEST['st']);
                $this->set('tr_id',$_REQUEST['tx']);
                $this->set('Amount',$_REQUEST['amt']);
                $this->render('confirm_pay');
            }  
        }
    }

    public function searchuser()
    {
        if($this->RequestHandler->isAjax())
        {
            $this->loadModel("User");
            $val = $this->request->data["val"];
            $user = $this->User->find("all",array("conditions" => array("name LIKE" => "%".$val."%","status" => 2)));
            $this->set('user',$user);
            $this->set('_serialize', array('user'));
            $this->response->statusCode(200);
        }
    }

		public function adduser()
		{
      $this->loadModel("Classified");
      $this->loadModel("User");
			if($this->request->is("post"))
      {
          $data = $this->request->data;
          $data['created_date'] = date("Y-m-d H:i:s");
          $data['status'] = 1;
          $this->User->create();
          if ($this->User->save($data)) {
              $lid = (int) $this->User->getLastInsertID();
              $record = $this->User->findById($lid);
              
              $hash = sha1($record['User']['email'] . rand(0, 100));
              $this->User->insertactivationcode($record['User']['id']
                      , $record['User']['email']
                      , $hash);

             $done = $this->__sendEmailConfirm($lid, $hash);
             $message = "User Created Successfully";
             $error = "no";
          } else {
              $error = $this->User->validationErrors;
              $message = "There is some problem while creating your account";
          }
          $this->Session->setFlash($message, 'default', array(), 'good');
          return $this->redirect(array('controller' => 'classifiedadmins', 'action' => 'user'));    
      }else{
        $country = $this->Classified->getcountry();
        $this->set("country", $country);
      }
		}

    public function edituser()
    {
        $this->loadModel("Classified");
        $this->loadModel("User");

        if($this->request->is("post"))
        {
          $data = $this->request->data;
          $user_id = $data["user_id"];
          if(!empty($data["pass"]))
          {
            $data["password"] = $data["pass"];
            $data["confirm_password"] = $data["c_pass"];
          }

          $this->User->id = $user_id;
          $this->User->save($data);
          
          $this->Session->setFlash("User Updated Successfully", 'default', array(), 'good');
          return $this->redirect(array('controller' => 'classifiedadmins', 'action' => 'user'));
        }elseif($this->request->is("get"))
        {
            $user_id = $this->params["url"]["id"];
            $user = $this->Classifiedadmin->getuserdetail($user_id);
            $country = $this->Classified->getcountry();
            $this->set("user", $user[0]);
            $this->set("country", $country);
        }
    }

    public function checkemail()
    {   
        $this->loadModel("User");
        $val = $this->request->data["val"];
        $user_id = (int) $this->request->data["id"];
        $user = $this->User->find("first",array("conditions"=> array("email" => $val,"id != " => $user_id)));
        if(!empty($user))
        {
            $message = "exist";
        }else
        {
            $message = "notexist";
        }
        $this->set("message", $message);
        $this->set("_serialize",array("message"));
        $this->response->statusCode(200);
    }

    public function emailtemplate()
    {
       $this->loadModel("EmailTemplate");
       $emails = $this->EmailTemplate->find("all");
       $this->set("emails",$emails);
    }

    public function edittemplate()
    {
      if(isset($_GET["id"]) && !empty($_GET["id"]))
      {
         $id = $_GET["id"];
         $this->loadModel("EmailTemplate");
         $emails = $this->EmailTemplate->find("first",array("conditions" => array("id"=> $id)));
         if(!empty($emails))
         {
          $this->set("email",$emails);
         }else{
          $this->redirect(array("controller" => "classifiedadmins", "action" => "emailtemplate"));
         }  
      }else{
        $this->redirect(array("controller" => "classifiedadmins", "action" => "emailtemplate"));
       }
    }

    public function updatetemplate()
    {
       if($this->request->is("post"))
       {
          $this->loadModel("EmailTemplate");
          $data = $this->request->data;
          $tid = (int)$data["t_id"];
          $this->EmailTemplate->id = $tid;
          $this->EmailTemplate->save($data);
          $this->Session->setFlash("Template Updated Successfully", 'default', array(), 'template');
          $this->redirect("/classifiedadmins/emailtemplate");
       }
    }

    public function browse()
    {
        $mainarray = array();
        $maincat = $this->Classifiedadmin->getmaincategory();
        $count = 0;
        foreach($maincat as $mcat)
        {
            $mainarray[$count]["mcat"] = $mcat;
            $mainarray[$count]["cat"] = $this->Classifiedadmin->getcategory($mcat["classified_maincategories"]["m_id"]);
            $count++;
        }
       $this->set("mainarray",$mainarray);
    }

    public function adbymaincategory()
    {
        if($this->request->is("get"))
        {
            $mid = (int)$this->params["url"]["mid"];
            $maincat = $this->Classifiedadmin->maincategorybyid($mid);
            $category = $this->Classifiedadmin->getcategory($mid);
            $add_data = $this->Classifiedadmin->getadbymaincat("m_id",$mid);
            $this->set("maincat",$maincat);
            $this->set("category",$category);
            $this->set("add_data",$add_data);
        }
    }

    public function adbycategory()
    {
      if($this->request->is("get"))
        {
            $mid = (int)$this->params["url"]["mid"];
            $cid = (int)$this->params["url"]["cid"];
            $maincat = $this->Classifiedadmin->maincategorybyid($mid);
            $category = $this->Classifiedadmin->getcategory1("classified_category","c_id",$cid);
            $add_data = $this->Classifiedadmin->getadbymaincat("c_id",$cid);
            $this->set("maincat",$maincat);
            $this->set("category",$category);
            $this->set("add_data",$add_data);
        }
    }

    public function addmaincategory()
    {
      $this->loadModel("Classifiedmaincategory");
      $this->loadModel("file");

      $data = $this->request->data;
      $last = $this->Classifiedadmin->getlastid('classified_maincategories','m_id');
      $last_id = 1 + (int) $last[0]["classified_maincategories"]["m_id"];
      $logo_id = 0;

      $filename = $_FILES["logo"]["name"];
      $date = date_create();
      $timestamp = date_timestamp_get($date);
      $ext_array = explode(".", $filename);
      $ext = array_pop($ext_array);
      $newfilename = $timestamp . '_main_cat_' . $user_id . "." . $ext;
      $path = 'files/admin/classified/' . $newfilename;
      $status = 2;
      $created_on = date("Y-m-d H:i:s");
      $file = array();
      $file["file_name"] = $newfilename;
      $file["base_url"] = $path;
      $file["status"] = $status;
      $file["created_on"] = $created_on;
      if (move_uploaded_file($_FILES["logo"]["tmp_name"], $path)) {
          chmod($path, 0777);
          $this->file->create();
          $this->file->save($file);
          $logo_id = (int) $this->file->getLastInsertID();
      }

      $c = 0;
      for($i = 1; $i <= count($data["sub"]); $i++)
      {   
          $cat = array();
          $cat["m_id"] = $last_id;
          $cat["maincategory"] = $data["sub"][$c];
          $cat["description"] = $data["description"];
          $cat["meta_description"] = $data["meta_description"];
          $cat["meta_keyword"] = $data["meta_keyword"];
          $cat["meta_title"] = $data["meta_title"];
          $cat["logo_id"] = $logo_id;
          $cat["lang_id"] = $i;
          $cat["status"] = 2;
          $cat["created_date"] = date("Y-m-d H:i:s");
          $this->Classifiedmaincategory->create();
          $this->Classifiedmaincategory->save($cat);
          $c++;
      }
      $this->Session->setFlash('Category added Successfully', 'default', array(), 'maincat');
      $this->redirect("/classifiedadmins/maincategory");
    }

    public function getlatlng($address)
    {
        // We define our address
        //$address = 'germany 01723';
        // We get the JSON results from this request
        $loc = array();
        $loc["latitude"] = "";
        $loc["longitude"] = "";
        $geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false');
        // We convert the JSON to an array
        $geo = json_decode($geo, true);
        //echo "<pre>"; print_r($geo);
        // If everything is cool
        if ($geo['status'] = 'OK') {
          // We set our values
          $loc["latitude"] = $geo['results'][0]['geometry']['location']['lat'];
          $loc["longitude"] = $geo['results'][0]['geometry']['location']['lng'];
        }
        return $loc;
    }

    public function userdetail() 
    {
       if($this->RequestHandler->isAjax())
       {
          $user_id = $this->request->data["id"];
          $user = $this->Classifiedadmin->getuserdetail($user_id);
          $this->set("user", $user[0]);
          $this->set("_serialize", array("user"));
          $this->response->statusCode(200);
       }
    }

    public function terms()
    {
        $this->loadModel("Page");
        if($this->request->is("post"))
        {
            $data  = $this->request->data;
            $p_id = $data["p_id"];
            $this->Page->id = $p_id;
            $this->Page->save($data);
            $this->Session->setFlash('Content Updated Successfully', 'default', array(), 'terms');
        }

        $content = $this->Page->findById(1);
        $this->set("page",$content);
    }

    public function privacy()
    {
        $this->loadModel("Page");
        if($this->request->is("post"))
        {
            $data  = $this->request->data;
            $p_id = $data["p_id"];
            $this->Page->id = $p_id;
            $this->Page->save($data);
            $this->Session->setFlash('Content Updated Successfully', 'default', array(), 'privacy');
        }

        $content = $this->Page->findById(2);
        $this->set("page",$content);
    }

    public function contactus()
    {
        $this->loadModel("Page");
        if($this->request->is("post"))
        {
            $data  = $this->request->data;
            $p_id = $data["p_id"];
            $this->Page->id = $p_id;
            $this->Page->save($data);
            $this->Session->setFlash('Content Updated Successfully', 'default', array(), 'contactus');
        }

        $content = $this->Page->findById(3);
        $this->set("page",$content);
    }

/**** Sofort Payment Getway Start ***/
    public function dosofort()
    {
        if($this->request->is("post"))
        {
            $data = $this->request->data;
            $this->Session->write("ad_data",$data);
            require_once(ROOT .DS. 'app'. DS . 'Vendor' . DS . 'sofort' . DS .'payment'. DS . 'sofortLibSofortueberweisung.inc.php');
            // enter your configuration key – you only can create a new configuration key by creating
            // a new Gateway project in your account at sofort.com
            $configkey = '123759:273271:03f6ff90ddf9fb340965f116672590bf'; //trilok
            $Sofortueberweisung = new Sofortueberweisung($configkey);

            $Sofortueberweisung->setAmount($data["amount"]);
            $Sofortueberweisung->setCurrencyCode('EUR');
            $Sofortueberweisung->setUserVariable($data["ad_id"]);
            $Sofortueberweisung->setReason('Ad Payment', 'Payment');
            
            $Sofortueberweisung->setSuccessUrl('http://43.229.224.74/ci/classified/classifiedadmins/sofortpayment', true);
            $Sofortueberweisung->setAbortUrl('http://43.229.224.74/ci/classified/classifiedadmins/abortsofortpayment');
            $Sofortueberweisung->setNotificationUrl("http://43.229.224.74/ci/classified/classifieds/dosofortpayment",'loss,pending,received,untraceable,refunded');

            $Sofortueberweisung->sendRequest();

            if($Sofortueberweisung->isError()) {
                //SOFORT-API didn't accept the data
                echo $Sofortueberweisung->getError();
            } else {
                //buyer must be redirected to $paymentUrl else payment cannot be successfully completed!
                $paymentUrl = $Sofortueberweisung->getPaymentUrl();
                //header('Location: '.$paymentUrl);
                $this->redirect($paymentUrl);
            }
        }
    }

    /* For sofort notify url */
    public function dosofortpayment()
    {
        $this->loadModel("Classified");
        $this->loadModel("Payment");

        require_once(ROOT .DS. 'app'. DS . 'Vendor' . DS . 'sofort' . DS .'core'. DS . 'sofortLibNotification.inc.php');
        require_once(ROOT .DS. 'app'. DS . 'Vendor' . DS . 'sofort' . DS .'core'. DS . 'sofortLibTransactionData.inc.php');
        
        $configkey = '123759:273271:03f6ff90ddf9fb340965f116672590bf';
        $SofortLib_Notification = new SofortLibNotification();
        $TestNotification = $SofortLib_Notification->getNotification(file_get_contents('php://input'));

        $SofortLibTransactionData = new SofortLibTransactionData($configkey);
        $SofortLibTransactionData->addTransaction($TestNotification);
        $SofortLibTransactionData->setApiVersion('2.0');
        $SofortLibTransactionData->sendRequest();

        $ad_id = $SofortLibTransactionData->getUserVariable(0);
        $txn_id = $TestNotification;
        $adtxnid = $this->Classified->getadtxnid($ad_id);
        if(empty($adtxnid))
        {
            $this->Classified->adtxnid($ad_id,$txn_id);
        }
    }   

    /* For Sofort Success Url*/
    public function sofortpayment()
    {
        sleep(25);
        $data = $this->Session->read("ad_data");
        if(!empty($data))
        {
            $this->loadModel("Classified");
            $this->loadModel("Payment");

            $this->Session->delete("ad_data");
            require_once(ROOT .DS. 'app'. DS . 'Vendor' . DS . 'sofort' . DS .'core'. DS . 'sofortLibNotification.inc.php');
            require_once(ROOT .DS. 'app'. DS . 'Vendor' . DS . 'sofort' . DS .'core'. DS . 'sofortLibTransactionData.inc.php');
            
            $configkey = '123759:273271:03f6ff90ddf9fb340965f116672590bf';
            $SofortLibTransactionData = new SofortLibTransactionData($configkey);
            
            
            $add_id = $data["ad_id"];
            $title = $data["title"];
            $amount = $data["amount"];

            $ad_txnid = $this->Classified->getadtxnid($add_id);
            $txn_id = $ad_txnid[0]["ad_txnid"]["txn_id"];
            $SofortLibTransactionData->addTransaction($txn_id);
            $SofortLibTransactionData->setApiVersion('2.0');
            $SofortLibTransactionData->sendRequest();

            $ack = $SofortLibTransactionData->getStatus();

            $u_amt = $this->Session->read("u_amt");
            $this->Session->delete("u_amt");
            
            $this->Classified->id = $add_id;
            $this->Classified->save($u_amt);
            $user = $this->Classified->getuserdata($add_id);
            
            $pmt = array();
            $pmt["user_id"]  = $user[0]["users"]["id"];
            $pmt["ad_id"]  = $add_id;
            $pmt["txn_id"]  = $txn_id;
            $pmt["amount"]  = $amount;
            $pmt["payment_type"]  = "bank wired";
            $pmt["mode"] = $ack;
            $pmt["ipaddress"] = $_SERVER["REMOTE_ADDR"];
            $pmt["status"]  = 2;
            $pmt["created_date"]  = date("Y-m-d H:i:s");
            $pmt["modify_date"] = date("Y-m-d H:i:s"); 

            $this->Payment->create();
            $this->Payment->save($pmt);

            $status_array = array();
            $status_array["add_id"] = $add_id;
            $status_array["title"] = $title;
            $status_array["tr_id"] = $txn_id;
            $status_array["ack"] = $ack;
            $status_array["amt"] = $amount;
            $u_res = $this->__sendaddconfirmmailtouser($status_array,$user);
          
            $this->set('add_id',$add_id);
            $this->set('ack',$ack);
            $this->set('tr_id',$txn_id);
            $this->set('Amount',$amount);
            $this->render('confirm_pay');
        }else
        {
            $this->redirect("/");
        }
    }

    /* For Sofort cancel url  */
    public function abortsofortpayment()
    {
        $data = $this->Session->read("ad_data");
        $this->Session->delete("ad_data");
        $add_id = $data["ad_id"];
        $title = $data["title"];
        $amount = $data["amount"];

        $this->set('add_id',$add_id);
        $this->set('ack',"cancel");
        $this->set('tr_id',"");
        $this->set('Amount',$amount);
        $this->render('confirm_pay');
    }

/**** Sofort Payment Getway End ***/



    function __sendEmailConfirm($user_id, $activatiinHash) {
        $this->loadModel("User");
        $user = $this->User->find('first', array('conditions' => array('User.id' => $user_id), 'recursive' => 0));
        if ($user === false) {
            debug(__METHOD__ . " failed to retrieve User data for user.id: {$user_id}");
            return false;
        }
        $activate_url = 'http://' . env('SERVER_NAME') . '/ci/classified/users/activate/id:' . $user['User']['id'] . '/t:' . $activatiinHash;
        $email = $user['User']['email'];
        $name = $user['User']['name'];
        $date = date("d-m-Y");
        $this->loadModel("EmailTemplate");
        $edata = $this->EmailTemplate->findById(3);
        $msg = str_replace("{DATE}", $date, str_replace("{ACTIVATION_LINK}", $activate_url, $edata["EmailTemplate"]["content"]));

        $cakeEmail = new CakeEmail('default');
        $cakeEmail->template('default','defaultmail')
                ->emailFormat('html')
                ->to($email)
                ->subject($edata["EmailTemplate"]["subject"])
                ->viewVars(array('content' => $msg));
        return $cakeEmail->send();
    }

    function __sendpostaddmail($data, $add_id) {
        $email = $data['email'];
        $name = $data['name'];
        $title = $data["title"];
        $ad_url = '<a href="http://' . env('SERVER_NAME') . '/cad/'.$add_id.'" >View Ad</a>';
        
        $this->loadModel("EmailTemplate");
        $edata = $this->EmailTemplate->findById(7);
        $sub = str_replace("{ADDID}", $add_id, $edata["EmailTemplate"]["subject"]);
        $msg = str_replace("{NAME}", $name, str_replace("{TITLE}", $title, str_replace("{ADDURL}", $ad_url, $edata["EmailTemplate"]["content"])));
        
        $cakeEmail = new CakeEmail('default');
        $cakeEmail->template('default','defaultmail')
                ->emailFormat('html')
                ->to($email)
                ->subject($sub)
                ->viewVars(array('content' => $msg));
        return $cakeEmail->send();
    }

    public function __sendaddconfirmmailtouser($status_array,$user)
    {
            /** Send mail to User **/
            
            $add_id = $status_array["add_id"];
            $email2 = $user[0]["users"]["email"];
            $link = '<a href="http://' . env('SERVER_NAME') . '/cad/'.$add_id.'" >Click Hear</a>';

            $this->loadModel("EmailTemplate");
            $edata = $this->EmailTemplate->findById(8);
            $sub = str_replace("{TITLE}", $status_array["title"], str_replace("{ACK}", $status_array["ack"], $edata["EmailTemplate"]["subject"]));
            $msg = str_replace("{NAME}", $user[0]["users"]["name"], str_replace("{PRICE}", $status_array["amt"], str_replace("{TRANSACTIONID}", $status_array["tr_id"], str_replace("{LINK}", $link, $edata["EmailTemplate"]["content"]))));
            
            $cakeEmail = new CakeEmail('default');
            $cakeEmail->template('default','defaultmail')
                    ->emailFormat('html')
                    ->to($email2)
                    ->subject($sub)
                    ->viewVars(array('content' => $msg));
            return $cakeEmail->send();

             /** Send mail to Admin **/
            
            /*$user1 = $this->Session->read("user");
            $admin_data = $this->Admin->find('first', array('conditions' => array('id' => 1)));

            $email1 = $admin_data["Admin"]["email"]; //'jayendra.s@mobiwebtech.com';
            $name1 = "User Post a Add ".$user1["first_name"]." ".$user1["last_name"];
            $subject1 = "Payment of Add ".$status_array["title"]." is ".$status_array["ack"];
            $message1 = "Amount: ".$status_array["amt"]."</br>";
            $message1 .= "Transaction Id: ".$status_array["tr_id"]."</br>";
            $message1 .= 'Your Add link is <a href="http://' . env('SERVER_NAME') . '/beta/classifiedadmins/viewadddetail?a_id='.base64_encode($status_array["add_id"]).'" >Click Hear</a>';

            $cakeEmail1 = new CakeEmail('smtp');
            $cakeEmail1->template('contactevent','contactevent')
                    ->emailFormat('html')
                    ->to($email1)
                    ->subject($subject1)
                    ->viewVars(array('message' => $message1,'subject' => $subject1 ,'email' => $email1, 'name' => $name1));
            return $cakeEmail1->send();*/
    }

    public function p($data)
    {
        echo "<pre>"; print_r($data); die();
    }

/******************** jayendra end ********************************/
	    
        

	    public function addleadcategory()
	    {
	    	if ($this->RequestHandler->isAjax())
	    	{
	    		$data = $this->request->data;
	    		$lead = explode(',', $data);
	    		//var_dump($lead); die("hi");
	    		$this->Classifiedadmin->updateleadcat();

	    		for($i = 1; $i < (count($lead)); $i++)
	    		{
	    			$id = (int) $lead[$i];
					$this->Classifiedadmin->updateleadcat1($id);	    			
	    		}

	    		$this->set('message','success');
                $this->set('_serialize',array('message'));
                $this->response->statusCode(200);
	    	}
	    }

	    public function banner()
	    {
	    	$pages = $this->Classifiedadmin->getclassifiedpages();
	    	$country = $this->Classifiedadmin->getallcountry();
	    	
	    	$this->set('page_data',$pages);
	    	$this->set('country',$country);
	    }

	    public function banneradd()
	    {
	    	if(!empty($this->params["url"]["id"]))
            {
                $page_id = (int)base64_decode($this->params["url"]["id"]);
                
                $page_photo = $this->Classifiedadmin->getbanneradd($page_id);
                
                $this->set('page_photo',$page_photo);
            }
	    }

	    public function uploadadd()
	    {
	    	$this->loadModel("file");
            
            $user_id = (int) $this->Auth->user("id");

            if ($this->RequestHandler->isAjax()) {
                if (!empty($this->data)) {
                    $data = $this->data;
                    $page_id = (int) $data["page_name"];
                    $country = (int) $data["country"];
                    $s_date = $data["s_date"];
                    $e_date = $data["e_date"];
                 }

                $file_array = array();

                 if (!empty($_FILES)) {
                   foreach ($_FILES as $f) {
                    $filename = $f["name"];
                    $date = date_create();
                    $timestamp = date_timestamp_get($date);
                    $ext_array = explode(".", $filename);
                    $ext = array_pop($ext_array);
                    $ext_name = implode("_", $ext_array);
                    $newfilename = $timestamp . '_add_' .$ext_name. $user_id . "." . $ext;
                    $path = 'files/admin/add/' . $newfilename;
                    $fullpath = 'http://' . env('SERVER_NAME') . '/' . $path;
                    $size = $f["size"] / 10000 . " " . "MB";
                    $type = $f["type"];
                    $status = 2;
                    $created_on = date("Y-m-d H:i:s");
                    $file = array();
                    $file["file_name"] = $newfilename;
                    $file["size"] = $size;
                    $file["type"] = $type;
                    $file["base_url"] = $path;
                    $file["url"] = $fullpath;
                    $file["status"] = $status;
                    $file["created_on"] = $created_on;
                    if (move_uploaded_file($f["tmp_name"], $path)) {
                        chmod($path, 0777);
                        $this->file->create();
                        if ($this->file->save($file)) {
                            $file_lid = (int) $this->file->getLastInsertID();
                            $file_array[] = $file_lid;
                            $this->Classifiedadmin->addaddsimages($file_lid, $user_id,$page_id,$s_date,$e_date,$country);
                        }                     
                    }
                  }
                }
                    $images_data = '<ul class="muppic">';

                    foreach($file_array as $fie)
                    {
                        $f_id = (int) $fie;

                        $u_images = $this->Classifiedadmin->getuploadedsliderimages($f_id);
                        
                        $images_data.='<li><img src="/'.$u_images[0]["files"]["base_url"].'"</li>';
                    }

                    $images_data .= '</ul>';

					$this->set('images_data', $images_data);
		            $this->set('_serialize',array('images_data'));
		            $this->response->statusCode(200);
	                    //echo $images_data;
                }
	    }

	    public function deleteimage()
         {
            $this->loadModel('file');
            if($this->RequestHandler->isAjax()){
                if(!empty($this->data)){
                    $data = $this->data;
                    $image_id = (int) base64_decode($data["image_id"]);
                    $tab = $data["tab"];

                    $base_url = $this->file->find('first',array('conditions' => array('id' => $image_id)));
                    
                    @unlink($base_url["file"]["base_url"]);

                    $this->Classifiedadmin->deleteimage($image_id,$tab);

                    $this->set('message','success');
                    $this->set('_serialize',array('message'));
                    $this->response->statusCode(200);

                }
            }   
        }

        public function editadd()
        {
            if($this->request->is('get'))
            {
                $data = $this->params["url"];
                $add_id = (int) base64_decode($data["a_id"]);
                $page_id = (int) base64_decode($data["page_id"]);

                $add_data = $this->Classifiedadmin->getadddata($add_id);

                $page_data = $this->Classifiedadmin->getclassifiedpages();

                $country = $this->Classifiedadmin->getallcountry();

                $this->set('data',$add_data);
                $this->set('page_id',$page_id);
                $this->set('country',$country);
                $this->set('page_data',$page_data);
                
            }
        }

        public function editnewadds()
        {
            $this->loadModel("file");
            $user_id = (int) $this->Auth->user("id");

            if($this->RequestHandler->isAjax())
            {
                if (!empty($this->data)) {
                    $data = $this->data;
                    $add_id = (int) $data["add_id"];
                    $page_id = (int) $data["page_name1"];
                    $country = (int) $data["country1"];
                    $s_date = $data["s_date1"];
                    $e_date = $data["e_date1"];
                 }

                 if ($_FILES["image_id"]["size"] > 0) {
                  
                    $filename = $_FILES["image_id"]["name"];
                    $date = date_create();
                    $timestamp = date_timestamp_get($date);
                    $ext_array = explode(".", $filename);
                    $ext = array_pop($ext_array);
                    $ext_name = implode("_", $ext_array);
                    $newfilename = $timestamp . '_add_' .$ext_name. $user_id . "." . $ext;
                    $path = 'files/admin/add/' . $newfilename;
                    $fullpath = 'http://' . env('SERVER_NAME') . '/' . $path;
                    $size = $_FILES["image_id"]["size"] / 10000 . " " . "MB";
                    $type = $_FILES["image_id"]["type"];
                    $status = 2;
                    $created_on = date("Y-m-d H:i:s");
                    $file = array();
                    $file["file_name"] = $newfilename;
                    $file["size"] = $size;
                    $file["type"] = $type;
                    $file["base_url"] = $path;
                    $file["url"] = $fullpath;
                    $file["status"] = $status;
                    $file["created_on"] = $created_on;
                    if (move_uploaded_file($_FILES["image_id"]["tmp_name"], $path)) {
                        chmod($path, 0777);
                        $this->file->create();
                        if ($this->file->save($file)) {
                            $file_lid = (int) $this->file->getLastInsertID();
                            
                            $this->Classifiedadmin->updateaddsimages($file_lid, $user_id,$page_id,$s_date,$e_date,$country,$add_id);
                            $message = "success";
                        }else{
                            $message = "unsuccess";
                        }                     
                    }
                  }else{
                            $this->Classifiedadmin->updateadds($user_id,$page_id,$s_date,$e_date,$country,$add_id);
                            $message = "success";
                        }
            }
             $this->set('message', $message);
             $this->set('_serialize', array('message'));
             $this->response->statusCode(200);
        }

        public function notworking() 
        {
            $this->loadModel("user_problem");
            
            $option['fields'] = array('user_problem.*', 'files.base_url');
            
            $option['joins'] = array( array('table' => 'files',
                                            'type' => 'LEFT',
                                            'conditions' => array('files.id = user_problem.img_id')
                                            )
                                    );
            $option['conditions'] = array('admin_type' => 3, 'p_t'=> 2 );

            $option['order'] = array('user_problem.created_on DESC');

            $problem_data = $this->user_problem->find('all', $option);
            
            $this->set('problem_data',$problem_data);
        }

        

        




}
?>