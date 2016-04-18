<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class UsersController extends AppController {

    public $components = array('Cookie', 'Session', 'Auth');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->sitemaintenance();
        //$this->Auth->loginRedirect = array('action' => 'login');
        //$this->Auth->logoutRedirect = array('action' => 'login');
        $this->Auth->allow('login', 'register', 'activate','forgotpassword','resetpassword',"fbsignup","fblogin","activateemail");
        $this->Auth->userModel = 'User';
    }

    public function register() {
        if ($this->RequestHandler->isAjax()) {
            if (!empty($this->data)) {
                $data = $this->data;
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
                   $message = "success";
                   $error = "no";
                    
                } else {
                    $error = $this->User->validationErrors;
                    $message = "There is some problem while creating your account";
                }

                $this->set('message', $message);
                $this->set('error', $error);
                $this->set('_serialize', array('message', 'error'));
                $this->response->statusCode(200);
            }
        }
    }

    public function fbsignup()
    {
        if($this->RequestHandler->isAjax())
        {
            $data = $this->request->data;
            $u_data = array();
            $u_data["fb_id"] = $data["id"];
            $u_data["name"] =  $data["name"];
            $u_data["email"] =  $data["email"];
            $u_data['created_date'] = date("Y-m-d H:i:s");
            $u_data['status'] = 1;

            $this->User->create();
            if ($this->User->save($u_data)) {
                $lid = (int) $this->User->getLastInsertID();
                $record = $this->User->findById($lid);
                $hash = sha1($record['User']['email'] . rand(0, 100));
                $this->User->insertactivationcode($record['User']['id']
                        , $record['User']['email']
                        , $hash);

               $done = $this->__sendEmailConfirm($lid, $hash);
               $message = "success";
               $error = "no";
                
            } else {
                $error = $this->User->validationErrors;
                $message = "There is some problem while creating your account";
            }
            $this->set('message', $message);
            $this->set('error', $error);
            $this->set('_serialize', array('message', 'error'));
            $this->response->statusCode(200);
        }
    }

    public function activate() {
        if (!empty($this->passedArgs['id'])) {
            $id = $this->passedArgs['id'];
            $tokenhash = $this->passedArgs['t'];
            if (!empty($id) && !empty($tokenhash)) {

                $data = $this->User->gettokendetail($id);
                if ($data[0]["user_activation"]["activate"] == 1) {

                    if ($tokenhash == $data[0]["user_activation"]["tokenhash"]) {

                        $this->User->Updatestatusofuser($id);
                        return $this->set('message', 'Your registration was successful. With your email address and password you can now at any time at eBay Classified log in Under "My ads" You can edit, renew or delete your ads, and z. B. Change your notification settings.');
                    } else {
                        return $this->set('message', 'There is some problem with your token! Please Register Again');
                    }
                } else {
                    return $this->set('message', 'Your Account is activated already');
                }
            } else {
                return $this->set('message', 'There is some problem with your token! Please Register Again');
            }
        } else {
            return $this->set('message', 'Your url is not correct please contact to Admin');
        }
    }

    public function login() {
        $login_user = $this->Session->read("user");
        if (!empty($login_user)) {
            return $this->redirect(array('action' => 'index'));
        }
        if ($this->request->is('post')) {
            $email = $this->request->data["User"]["email"];
            $record = $this->User->find('first', array(
                'conditions' => array(
                    'User.email' => $email,
                )
            ));
            if (empty($record)) {
                $this->set('message', 'Invalid Email or password, try again');
            }else{
                $status = $record['User']['status'];
                if ($status == 1) {
                    $this->set('message', 'Please varifiy your email id first');
                }else{
        			$this->Auth->authenticate['Form'] = array('fields' => array('username' => 'email', 'password' => 'password'));
                    if ($this->Auth->login()) {
        				$user = $this->Auth->user();
                        $this->Session->write('user', $user);
                        $this->set('message',"success");
                    }else {
                        $this->set('message', 'Invalid Email or password, try again');
                    }
                }
            }

            $this->set('_serialize', array('message'));
            $this->response->statusCode(200);
        }else
        {
            $this->redirect(array("controller" => "classifieds", "action" => "index"));
        }
    }

    public function fblogin()
    {
        $login_user = $this->Session->read("user");
        if (!empty($login_user)) {
            return $this->redirect(array('action' => 'index'));
        }
        if ($this->request->is('post')) {
            //$this->p($this->request->data);
            $email = $this->request->data["email"];
            $record = $this->User->find('first', array(
                'conditions' => array(
                    'User.email' => $email,
                )
            ));

            if (empty($record)) {

                $this->set('message', 'Invalid Email or password, try again');
            }else{
                $status = $record['User']['status'];
                if ($status == 1) {
                    $this->set('message', 'Please varifiy your email id first');
                }
                $this->Auth->authenticate['Form'] = array('fields' => array('email' => 'email'));
                $this->request->data['User']['id'] = $record['User']['id'];
                
                if ($this->Auth->login($this->request->data['User'])) {
                    $user = $this->Auth->user();
                    $this->Session->write('user', $user);
                    $this->set('message',"success");
                }else {
                    $this->set('message', 'Invalid Email or password, try again2');
                }
            }
            $this->set('_serialize', array('message'));
            $this->response->statusCode(200);
        }
    }

    public function logout() {
        $this->Auth->logout();
        $this->Session->destroy();
        return $this->redirect('/');
    }

    public function myaccount()
    {
        $this->loadModel("Classified");
    	$user_id = (int) $this->Auth->user("id");
        $myadd = $this->Classified->find("all", array("conditions"=> array("user_id" => $user_id),"fields" => array("id","title","price","create_date","status"),'order' => array("create_date DESC")));
        $this->set("myadd",$myadd);
    }

    /******** Setting section start *******/
    
    public function setting()
    {
        $id = (int)$this->Auth->user("id");
        if($this->request->isAjax())
        {
            $data = $this->request->data;
            $this->User->updatecontact($id,$data);
            $message = "success";
            $this->set("message",$message);
            $this->set("_serialize", array("message"));
            $this->response->statusCode(200);
        }else
        {
            $this->loadModel("ToolTip");
            $country = $this->User->getcountry();
            $u_data = $this->User->getuserdetail($id);
            $u_data = $u_data[0];
            $tooltip = $this->ToolTip->find("all");
            $tip = array();
            foreach($tooltip as $tool)
            {
                $tip[$tool["ToolTip"]["id"]] = $tool["ToolTip"]["content"];
            }
            //$this->p($u_data);
            $this->set("tip", $tip);
            $this->set("u_data",$u_data);
            $this->set("country",$country);
        }
    }

    public function changepassword()
    {
        if($this->request->isAjax())
        {
            $data = $this->request->data;
            $user_id = (int) $this->Auth->user("id");
            $pass = $data["oldpassword"];
            $haspass = $this->Auth->password($pass);
            $user = $this->User->find("first", array("conditions" => array("id" => $user_id)));
            
            if($user["User"]["password"] == $haspass)
            {
                $this->User->id = $user_id;
                if($this->User->save($data))
                {
                    $message = "success";
                }else
                {
                    $message = "error";
                }
            }else
            {
                $message = "password";
            }
            
            $this->set("message",$message);
            $this->set("_serialize", array("message"));
            $this->response->statusCode(200);
        }
    }

    public function changeemail()
    {
        if($this->RequestHandler->isAjax())
        {
            $this->loadModel("EmailTemplate");
            $data = $this->request->data;
            $user_id = (int)$this->Auth->user("id");
            $user = $this->User->find("first",array("conditions"=>array("email" => $data["nemail"])));
            if(empty($user))
            {   
                $email1 = $this->EmailTemplate->findById(1);
                $em1 = array();
                $em1["to"] = $data["remail"];
                $em1["subject"] = $email1["EmailTemplate"]["subject"];
                $em1["msg"] = $email1["EmailTemplate"]["content"];
                $this->defaultsendmail($em1);
                $email2 = $this->EmailTemplate->findById(2);
                $activatiinHash = base64_encode($data["nemail"]);
                $activate_url = 'http://' . env('SERVER_NAME') . '/ci/classified/users/activateemail/id:' . $user_id . '/t:' . $activatiinHash;

                $this->User->insertactivationcode($user_id,"", $activatiinHash);

                $msg = str_replace("{ACTIVATION_LINK}", $activate_url, $email2["EmailTemplate"]["content"]);
                $em2 = array();
                $em2["to"] = $data["nemail"];
                $em2["subject"] = $email2["EmailTemplate"]["subject"];
                $em2["msg"] = $msg;
                $this->defaultsendmail($em2);
                $message = "success";
            }else
            {
                $message = "Email Already Exist";
            }
            $this->set("message",$message);
            $this->set("_serialize", array("message"));
            $this->response->statusCode(200);
        }
    }

    public function activateemail()
    {
        if (!empty($this->passedArgs['id'])) {
            $id = $this->passedArgs['id'];
            $tokenhash = $this->passedArgs['t'];
            if (!empty($id) && !empty($tokenhash)) {

                $data = $this->User->gettokendetailemail($id,$tokenhash);
                if (!empty($data)) {

                    if ($data[0]["user_activation"]["activate"] == 1) {
                        $email = base64_decode($tokenhash);
                        $this->User->updatemailstatus($id,$tokenhash);
                        $this->User->id = $id;
                        $this->User->saveField("email",$email);
                        return $this->set('message', 'Your Email Has been Changed! You can login now with new email');
                    } else {
                        return $this->set('message', 'Your Link is expired');
                    }
                } else {
                    return $this->set('message', 'There is some problem with your token!');
                }
            } else {
                return $this->set('message', 'There is some problem with your token!');
            }
        } else {
            return $this->set('message', 'Your url is not correct please contact to Admin');
        }
    }

    public function deleteaccount()
    {
        if($this->RequestHandler->isAjax())
        {
            $this->loadModel("Classified");
            $this->loadModel("SaveSearch");
            $this->loadModel("Payment");
            $this->loadModel("UserFavorite");
            $user_id = (int) $this->Auth->user("id");
            $this->Classified->deleteAll(array('user_id' => $user_id), false);
            $this->SaveSearch->deleteAll(array('user_id' => $user_id), false);
            $this->Payment->deleteAll(array('user_id' => $user_id), false);
            $this->UserFavorite->deleteAll(array('user_id' => $user_id), false);
            $this->User->delete($user_id);
            $this->set("message","success");
            $this->set("_serialize", array("message"));
            $this->response->statusCode(200);
        }
    }

    /******** Setting section End *******/

    public function paymenthistory()
    {
        $id = (int)$this->Auth->user("id");
        $p_history = $this->User->getpaymenthistory($id);
        $this->set("p_history", $p_history); 
    }

    /*********** Favorite ad section start *******************/
    public function favoritead()
    {
        $this->loadModel("UserFavorite");
        $this->loadModel("SaveSearch");
        $user_id = (int)$this->Auth->user("id");
        $ufav = $this->User->getuserfavoritead($user_id);
        $searchcount = $this->SaveSearch->find("count", array("conditions" => array("user_id" => $user_id)));
        $this->set("ufav",$ufav);
        $this->set("scount",$searchcount);
    }

    public function clearfavorite()
    {
        if($this->RequestHandler->isAjax())
        {
            $this->loadModel("UserFavorite");
            $user_id = (int)$this->Auth->user("id");
            $aid = $this->request->data["aid"];
            $fav = array();
            $fav["user_id"] = $user_id;
            if(!empty($aid))
            {
                $fav["ad_id"] = $aid;    
            }
            
            $this->UserFavorite->deleteAll($fav, false);
            $this->set("message","success");
            $this->set("_serialize", array("message"));
            $this->response->statusCode(200);
        }
    }
    /*********** Favorite ad section End *******************/

    /*********** Save search section start *******************/

    public function saveusersearch()
    {
        if($this->RequestHandler->isAjax())
        {
            $this->loadModel("SaveSearch");
            $user_id = (int)$this->Auth->user("id");
            $data = $this->request->data;
            $filter = serialize($data["search"]);
            $search = array();
            $search["user_id"] = $user_id;
            $search["url"] = $data["url"];
            $search["title"] = $data["title"];
            $search["category"] = $data["surl"];
            $search["location"] = $data["city"];
            $search["filters"] = $filter;
            $search["status"] = 2;
            $search["create_date"] = date("Y-m-d H:i:s");
            $search["modify_date"] = date("Y-m-d H:i:s");

            $this->SaveSearch->create();
            $this->SaveSearch->save($search);
            $this->set("message","success");
            $this->set("_serialize", array("message"));
            $this->response->statusCode(200);
        }
    }
    
    public function savesearch()
    {
        $this->loadModel("SaveSearch");
        $this->loadModel("UserFavorite");
        $user_id = (int) $this->Auth->user("id");
        $search = $this->SaveSearch->find("all", array("conditions"=>array("user_id" => $user_id)));
        $favcount = $this->UserFavorite->find("count",array("conditions" => array("user_id" => $user_id)));
        $this->set("favcount",$favcount);
        $this->set("search",$search);
    }

    public function removesavesearch()
    {
        if($this->RequestHandler->isAjax())
        {
            $this->loadModel("SaveSearch");
            $user_id = (int)$this->Auth->user("id");
            $id = $this->request->data["id"];
            $search = array();
            $search["user_id"] = $user_id;
            if(!empty($id))
            {
                $search["id"] = $id;
            }

            $this->SaveSearch->deleteAll($search,false);
            $this->set("message","success");
            $this->set("_serialize", array("message"));
            $this->response->statusCode(200);
        }
    }


    /*********** Save search section End *******************/

    /*********** Billing section start *******************/

    public function billing()
    {
        $this->loadModel("BillingAddress");
        $user_id = $this->Auth->user("id");
        if($this->request->is("post"))
        {
            $data = $this->request->data;
            $data["user_id"] = $user_id;
            $data["status"] = 2;
            $data["create_date"] = date("Y-m-d H:i:s");

            if(isset($data["ba_id"]) && !empty($data["ba_id"]))
            {
                $ba_id  = (int)$data["ba_id"];
                $this->BillingAddress->id = $ba_id;
                $this->BillingAddress->save($data);
            }else
            {
                $this->BillingAddress->create();
                $this->BillingAddress->save($data);
            }
            $this->Session->setFlash('Address added Successfully', 'default', array(), 'address');
        }

        $baddress = $this->BillingAddress->find("first",array("conditions"=> array("user_id" => $user_id )));
        $this->set("ba", $baddress);
    }

    /*********** Billing section End *******************/
    
    /*********** Messsage section Start *******************/

    public function message()
    {
        $user_id = $this->Auth->user("id");
        $msgcount = count($this->User->getnewmsg($user_id));
        $msg = $this->User->getmsg($user_id);
        $this->set("msgcount", $msgcount);
        $this->set("msg", $msg);
    }

    public function getusermsg()
    {
        if($this->RequestHandler->isAjax())
        {
            $to_id = $this->Auth->user("id");
            $from_id = $this->request->data["from_id"];
            $chat = $this->User->getchatmsg($to_id,$from_id);
            $this->set("chat",$chat);
            $this->set("_serialize",array("chat"));
            $this->response->statusCode(200);
        }
    }

    public function sendmsg()
    {
        if($this->RequestHandler->isAjax())
        {   
            $this->loadModel("Message");
            $msg = $this->request->data["msg"];
            $to_id = $this->request->data["from_id"];
            $user = $this->Session->read('user');
            $from_id = (int) $user["id"];
            $data["to_id"] = $to_id;
            $data["message"] = $msg;
            $data["from_id"] = $from_id;
            $data["status"] = 1;
            $data["created_date"] = date("Y-m-d H:i:s");
            $this->Message->create();
            $this->Message->save($data);
            $lid = (int) $this->Message->getLastInsertID();
            
            $msg = $this->User->getlastmsg($lid); 
            
            $this->set("message"," success");
            $this->set("msg",$msg);
            $this->set("_serialize",array("message","msg"));
            $this->response->statusCode(200);
        }
    }

    public function deleteusermsg()
    {
        if($this->RequestHandler->isAjax())
        {
            $user_id = $this->Auth->user("id");
            $from_id = $this->request->data["fid"]; 
            $from_id = rtrim($from_id,",");
            $from_id = explode(",", $from_id);
            foreach($from_id as $fid)
            {
                $this->User->deleteusermsg($fid,$user_id);    
            }
            
            $this->set("message"," success");
            $this->set("_serialize",array("message"));
            $this->response->statusCode(200);
        }
    }

    public function sent()
    {
        $user_id = $this->Auth->user("id");
        $msg = $this->User->getsentmsg($user_id);
        $this->set("msg", $msg);
    }

    public function getusersentmsg()
    {
       if($this->RequestHandler->isAjax())
        {
            $from_id = $this->Auth->user("id");
            $to_id = $this->request->data["to_id"];
            $chat = $this->User->getchatsentmsg($to_id,$from_id);
            $this->set("chat",$chat);
            $this->set("_serialize",array("chat"));
            $this->response->statusCode(200);
        }
    }

    public function deleteusersentmsg()
    {
        if($this->RequestHandler->isAjax())
        {
            $user_id = $this->Auth->user("id");
            $to_id = $this->request->data["tid"]; 
            $to_id = rtrim($to_id,",");
            $to_id = explode(",", $to_id);
            foreach($to_id as $tid)
            {
                $this->User->deleteusermsg($user_id,$tid);    
            }
            
            $this->set("message"," success");
            $this->set("_serialize",array("message"));
            $this->response->statusCode(200);
        }
    }

    /*********** Messsage section End *******************/



    public function getstates()
    {
        if($this->request->isAjax())
        {
            $id = $this->request->data["id"];
            $states = $this->User->getstates($id);
            $this->set("states",$states);
            $this->set("_serialize", array("states"));
            $this->response->statusCode(200);
        }
    }

    public function blockad()
    {
        if($this->request->isAjax())
        {
            $id = $this->request->data["id"];
            $col = $this->request->data["col"];
            $tab = $this->request->data["tab"];
            $this->User->blockad($tab,$col,$id);
            $this->set("message","success");
            $this->set("_serialize",array("message"));
            $this->response->statusCode(200);
        }
    }

    public function unblockad()
    {
        if($this->request->isAjax())
        {
            $id = $this->request->data["id"];
            $col = $this->request->data["col"];
            $tab = $this->request->data["tab"];
            $this->User->unblockad($tab,$col,$id);
            $this->set("message","success");
            $this->set("_serialize",array("message"));
            $this->response->statusCode(200);
        }
    }

    public function forgotpassword(){
        if ($this->request->is('post')) {
            $email = $this->request->data["email"];
            $record_data = $this->User->find('first', array(
                'conditions' => array(
                    'User.email' => $email,
                )
            ));
            if (empty($record_data)) {

                $this->set('message', 'Invalid Email ID, try again');
            }else
            {
                $reset_hash = sha1($record_data['User']['email'] . rand(0, 100).$record_data['User']['id']);
                $this->User->resetpasswordhashcode($record_data['User']['email'],$record_data['User']['id'],$reset_hash);
                $sent_mail = $this->__sendResetPasswordConfirm($record_data['User']['id'], $reset_hash);
                $this->set('message', 'success');
            }
            $this->set("_serialize", array("message"));
            $this->response->statusCode(200);
        }
    }

    public function resetpassword(){
	    if (!empty($this->passedArgs['id'])) {
		    $id = $this->passedArgs['id'];
		    $tokenhash = $this->passedArgs['t'];
		    if (!empty($id) && !empty($tokenhash)) {
		        $data = $this->User->getresettokendetail($id);
		        if ($data[0]["forget_password"]["status"] == 1) {
		            if ($tokenhash == $data[0]["forget_password"]["hash_code"]) {
		            $message = 'success';
		            $error = 'no';
		            $this->set('user_id',$id);
		            $this->set('message',$message);
		            }
		            else{
		                $message = 'Your Reset password link expired';
		                return $this->set('message',$message);
		            }
		        }else{
		            $message = 'Your password Reset allready';
		            return $this->set('message',$message);
		        }
	        }else {
	            $message = 'Your url is not correct please contact to Admin';
	            return $this->set('message',$message);
	           
	        }
	 	}
	    if($this->RequestHandler->isAjax())
	    {
	        $data = $this->data;
	        $id = $data["id"];
	        $pass = $data["pass"];
	        $c_pass = $data["c_pass"];
	        $this->User->id = $id;
		    if($pass == $c_pass)
		    {
		       if($this->User->saveField('password',$pass))
		       {
		        $update_status = $this->User->updateresetstatus($id);
		            $message = 'success';
		       }else{
		            $message = 'Password did not reset due to some internal error please try again';
		       }
		    }else{
		        $message = 'Password and Confirm Password did not matched';
		    }
	        $this->set('message', $message);
	        $this->set('_serialize', array('message'));
	        $this->response->statusCode(200);
	    }
	}
    function __sendEmailConfirm($user_id, $activatiinHash) {
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

    function __sendResetPasswordConfirm($user_id, $activatiinHash) {
        $user = $this->User->find('first', array('conditions' => array('User.id' => $user_id), 'recursive' => 0));
        if ($user === false) {
            debug(__METHOD__ . " failed to retrieve User data for user.id: {$user_id}");
            return false;
        }
        $activate_url = 'http://' . env('SERVER_NAME') . '/ci/classified/users/resetpassword/id:' . $user['User']['id'] . '/t:' . $activatiinHash;
        $email = $user['User']['email'];
        $name = $user['User']['name'];

        $this->loadModel("EmailTemplate");
        $edata = $this->EmailTemplate->findById(4);
        $msg = str_replace("{NAME}", $name, str_replace("{ACTIVATION_LINK}", $activate_url, $edata["EmailTemplate"]["content"]));
        
        $cakeEmail = new CakeEmail('default');
        $cakeEmail->template('default','defaultmail')
                ->emailFormat('html')
                ->to($email)
                ->subject($edata["EmailTemplate"]["subject"])
                ->viewVars(array('content' => $msg));
        return $cakeEmail->send();
    }

    /* Default mail function */
    public function defaultsendmail($data)
    {
        $cakeEmail = new CakeEmail('default');
        $cakeEmail->template('default','defaultmail')
                ->emailFormat('html')
                ->to($data["to"])
                ->subject($data["subject"])
                ->viewVars(array('content' => $data["msg"]));
        return $cakeEmail->send();
    }

    public function p($data)
    {
        echo "<pre>"; print_r($data); die();
    }
}