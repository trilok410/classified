<?php 

App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');


class Admin extends AppModel{
    public $name = 'Admin';
    public $useTable = 'admins';
   
    public $validate = array (
    
        'password'=>array(
            'Match password'=>array(
                'rule'=>'matchPasswords',
                'required' => true,
                'message'=>'Your passwords do not match!'
            )
        ),

        'email' => array(
                'email' => array(
                        'rule'    => array('email'),
                        'message' => 'Please enter a valid email address.'
                    ),
                'uniq' => array(
                        'rule' => 'isUnique',
                        'message' => 'This Mail Address is already used'
                    )
        )
    );

    public function matchPasswords($data){
        if ($data['password'] == $this->data['Admin']['confirm_password']){
            return true;
        } else {
            //$this->invalidate('confirm_password', 'Your passwords do not match!');
            return false;
        }
    }    
    
    
    
    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new SimplePasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }
        return true;
	}

    /* Jayendra functions Start*/

    public function updateusername($f_name,$l_name,$user_id)
    {
        return $this->query("update admins set first_name = '$f_name', last_name = '$l_name' where id = '$user_id'");
    }

    public function updateusercontact($contact_no,$user_id)
    {
        return $this->query(" update admins set contact_no = '$contact_no' where id = '$user_id'");
    }
    /* Jayendra functions End*/

    public function getpermission($id)
    {
        return $this->query(" SELECT 
                            admin_permissions.p_id,
                            permissions.p_name
                            FROM admin_permissions
                            INNER JOIN permissions ON admin_permissions.p_id = permissions.id
                            WHERE admin_permissions.user_id = '$id' 
                        ");
    }

    public function getallcountry()
       {
           return $this->query(" select * from countries");
       } 
    public function addcountry($name)
    {
        $date = date("Y-m-d h:i:s");
        return $this->query(" INSERT INTO `countries`(`country_name`, `status`, `create_on`) VALUES ('$name','2','$date')");
    }

    public function blockdata($c_id,$tab)
      {
          return $this->query(" update  $tab set status = '1' where id = '$c_id'");
      }

    public function unblockdata($c_id,$tab)
      {
          return $this->query(" update  $tab set status = '2' where id = '$c_id'");
      } 

    public function getcountrydata($c_id)
    {
        return $this->query(" select * from countries where id = '$c_id'");
    }

    public function updatecountry($name,$id)
    {
        return $this->query(" update countries set country_name = '$name', status = '2' where id = '$id'");
    }

    public function getallstatedata()
    {
        return $this->query(" SELECT
                countries_state.id,
                countries_state.state_name,
                countries_state.status,
                countries_state.create_on,
                countries.country_name
                FROM countries_state
                INNER JOIN countries ON countries_state.country_id = countries.id

            ");
    }

    public function addstate($name,$c_id)
    {   $date = date("Y-m-d h:i:s"); 
        return $this->query(" INSERT INTO `countries_state`(`country_id`, `state_name`, `status`, `create_on`) VALUES ('$c_id','$name','2','$date')");
    }

    public function getstatedata($s_id)
    {
        return $this->query(" select * from countries_state where id = '$s_id'");
    }

    public function updatestate($name,$s_id,$c_id)
    {
        return $this->query(" update countries_state set country_id = '$c_id', state_name = '$name' where id = '$s_id'");
    }

    public function getallcitydata()
    {
      return $this->query("SELECT
                countries_state_city.id,
                countries_state_city.city_name,
                countries_state_city.status,
                countries_state_city.create_on,
                countries_state.state_name,
                countries.country_name
                FROM countries_state_city
                INNER JOIN countries_state ON countries_state_city.state_id = countries_state.id
                INNER JOIN countries ON countries_state_city.country_id = countries.id ORDER BY countries_state_city.create_on DESC
             ");
    }
    
    public function getcitydata($c_id){
        return $this->query("SELECT
                countries_state_city.id,
                countries_state_city.city_name,
                countries_state_city.status,
                countries_state_city.create_on,
                countries_state.id,
                countries_state.state_name,
                countries.id,
                countries.country_name
                FROM countries_state_city
                INNER JOIN countries_state ON countries_state_city.state_id = countries_state.id
                INNER JOIN countries ON countries_state_city.country_id = countries.id
                WHERE countries_state_city.id = $c_id                 
        ");    
    }
    
    public function getstate($id){
        return $this->query("SELECT
                            countries_state.id,
                            countries_state.state_name
                            FROM
                            countries_state
                            WHERE
                            countries_state.country_id = $id AND
                            countries_state.`status` = 2
                            ORDER BY
                            countries_state.state_name ASC");
    }

    public function addcity($name,$c_id,$s_id){
        $date = date("Y-m-d h:i:s"); 
        return $this->query("INSERT INTO `countries_state_city`(`country_id`, `state_id`, `city_name`, `status`, `create_on`) VALUES ($c_id,$s_id,'$name',2,'$date')");
    }

    public function updatecity($name,$s_id,$c_id,$id){
        return $this->query("UPDATE `countries_state_city` SET `country_id`= $c_id,`state_id`= $s_id,`city_name`= '$name',`status`= 2 WHERE `id` = $id"); 
    }

    public function getallpermissions()
    {
        return $this->query(" select * from permissions");
    }

    public function getalluserdata()
    {
        return $this->query(" select * from admins where parent != '0'");
    }

    public function getuserpermission($id)
    {
        return $this->query(" SELECT
                            admin_permissions.p_id,
                            permissions.p_name
                            FROM admin_permissions
                            INNER JOIN permissions ON admin_permissions.p_id = permissions.id
                            WHERE admin_permissions.user_id = $id
                         ");
    }

    public function getuserdata($id)
    {
        return $this->query(" select * from admins where id = '$id'");
    }

    public function deleteuserpermission($user_id)
     {
        return $this->query(" delete from admin_permissions where user_id = '$user_id'");
     }

    public function viewuserpermission($id)
    {
        return $this->query(" SELECT
                            admin_permissions.p_id,
                            permissions.p_name,
                            admin_role.name
                            FROM admin_permissions
                            INNER JOIN permissions ON admin_permissions.p_id = permissions.id
                            INNER JOIN admin_role ON permissions.parent_role = admin_role.id
                            WHERE admin_permissions.user_id = '$id'
                         ");
    }

    

    

    public function latestevents()
    {
        $date = date("Y-m-d");
        return $this->query(" select * from events where date >= '$date' AND status = 2  order by created_on desc ");
    }

    public function latestusers()
    {
        return $this->query(" select * from users where created_on >= NOW() - INTERVAL 3 DAY AND status = 2  order by created_on desc ");
    }

    public function latestclub()
    {
        return $this->query(" select * from event_club where created_date >= NOW() - INTERVAL 3 DAY AND status = 2  order by created_date desc ");
    }

   

    public function getfeedback()
    {
        return $this->query(" SELECT
                            user_problems.id,
                            user_problems.user_id,
                            user_problems.problem,
                            user_problems.created_on,
                            users.first_name,
                            users.last_name
                            FROM user_problems
                            INNER JOIN users ON user_problems.user_id = users.id
                            WHERE user_problems.p_t = '1' ORDER BY user_problems.created_on DESC
            "); 
    }

    public function getabusivecontent()
    {
        return $this->query(" SELECT
                            user_problems.*,
                            users.first_name,
                            users.last_name,
                            files.base_url
                            FROM user_problems
                            LEFT JOIN users ON user_problems.user_id = users.id
                            LEFT JOIN files ON user_problems.img_id = files.id
                            WHERE user_problems.p_t = '3' AND user_problems.report_id = 0 ORDER BY user_problems.created_on DESC
                 ");
    }

    public function getbalkanuserdetail($u_id)
    {
        return $this->query("SELECT
            users.id,
            users.first_name,
            users.last_name,
            users.email,
            users.role_id,
            users.birthday,
            users.gender,
            users.company_name,
            users.address,
            users.zip,
            users.country,
            users.state,
            users.city,
            users.uid_number,
            users.phone,
            users.fax,
            users.web_address,
            users.created_on,
            users.updated_on,
            users.`status`,
            users.flag,
            user_profiles.username,
            files.file_name,
            files.base_url,
            files.url,
            countries.country_name,
            countries_state.state_name,
            countries_state_city.city_name
            FROM
            users
            LEFT JOIN user_profiles ON users.id = user_profiles.user_id
            LEFT JOIN files ON user_profiles.profile_id = files.id
            LEFT JOIN countries ON users.country = countries.id
            LEFT JOIN countries_state ON users.state = countries_state.id
            LEFT JOIN countries_state_city ON users.city = countries_state_city.id
            WHERE users.id = '$u_id' ORDER BY  users.created_on DESC
        ");
    }

    public function getlangpages()
    {
        return $this->query(" SELECT * FROM balkanbook_pages WHERE status = 2 ");
    }

    public function getallpaymentmode()
    {
        return $this->query(" SELECT * FROM `payments_modes` ");
    }

    public function getpaymentmodebyid($m_id)
    {
        return $this->query(" SELECT * FROM `payments_modes` WHERE id = $m_id ");
    }

    public function updatepaymentmode($m_price,$m_id)
    {
        return $this->query("  UPDATE `payments_modes` SET `mode_price` = '$m_price' WHERE id = $m_id ");
    }

}
?>