<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');


class User extends AppModel{
    public $name = 'User';
    public $useTable = 'users';
   
public $validate = array (
    
    'email'=>array(
        'Valid email'=>array(
            'rule'=>array('email'),
            'message'=>'Please enter a valid Email address!'
        ),
        'Already exists'=>array(
            'rule'=>'isUnique',
            'message'=>'This Email is already registered in our database!'
        )
    ),
    'password'=>array(
        'Match password'=>array(
            'rule'=>'matchPasswords',
            //'required' => true,
            'allowEmpty' => false,
            'message'=>'Your passwords do not match!'
        )
    ),
);

public function matchPasswords($data){
    if ($data['password'] == $this->data['User']['confirm_password']){
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

/** Common Function Start ***/

public function getadds($page_id)
    {
        $user = CakeSession::read('user');
        $id = (int) $user["id"];
        $c = $this->query(" SELECT country FROM users WHERE id  = $id ");
        
        $cont = (int) $c[0]["users"]["country"];
        $date = date('Y-m-d');

        return $this->query(" SELECT
                           files.base_url,
                           community_adds.image_id,
                           community_adds.user_id
                           FROM community_adds
                           INNER JOIN files ON community_adds.image_id = files.id
                           WHERE community_adds.page_id = '$page_id' AND community_adds.status = '2' AND community_adds.country = $cont AND community_adds.s_date <= '$date' AND community_adds.e_date >= '$date'
                           ");
    }

/** Common Function End ***/

/* Jayendra start */
public function insertactivationcode($user_id,$email,$activation)
{
  $date = date("Y-m-d H:i:s");  
  return $this->query("INSERT INTO `user_activation`(`user_id`, `email`, `tokenhash`, `activate`,`created_on`) VALUES ($user_id,'$email','$activation',1,'$date')");
}

public function gettokendetail($id)
{
    return $this->query("SELECT * FROM `user_activation` WHERE user_id = $id");    
}

public function Updatestatusofuser($id){
  $this->query("UPDATE `users` SET `status` = 2 WHERE `id` = $id");
  return $this->query("UPDATE `user_activation` SET `activate` = 2 WHERE `user_id` = $id");                    
}

public function resetpasswordhashcode($email,$user_id,$reset_hash)
{
  $date = date("Y-m-d");
  $reset_data = $this->query("select * from forget_password where user_id = $user_id");
  if(empty($reset_data)){
    return  $this->query("insert into forget_password (user_id, email, hash_code, status, create_date) values ('".$user_id."','".$email."','".$reset_hash."','1','".$date."')");  
  }else{
    return  $this->query("update forget_password set  email = '".$email."', hash_code = '".$reset_hash."', status = '1', create_date = '".$date."' where user_id = '".$user_id."'");
  }

}

public function getresettokendetail($id){
    return $this->query("select * from forget_password where user_id = $id");
}

public function updateresetstatus($id){
    return $this->query("update forget_password set status = 2 where user_id = $id");
}

public function getlanguage($lang_id)
{
    return $this->query(" select * from webtexts where lang_id = '$lang_id' ");
}

public function blockad($tab,$col,$id)
{
   return $this->query(" UPDATE $tab SET status = 1 WHERE $col = $id ");
}

public function unblockad($tab,$col,$id)
{
   return $this->query(" UPDATE $tab SET status = 2 WHERE $col = $id ");
}

public function getcountry(){
    return $this->query("SELECT * FROM countries WHERE countries.`status` = 2 ORDER BY countries.name ASC ");
}

public function getuserdetail($id)
{
   return $this->query(" SELECT
                         users.*,
                         states.name
                         FROM users
                         LEFT JOIN states ON states.id = users.state
                         WHERE users.id = $id
                      ");
}

public function getstates($id)
{
    return $this->query(" SELECT * FROM states WHERE c_id = $id ");
}

public function updatecontact($id,$data)
{
   return $this->query(" UPDATE users SET name = '".$data["name"]."', country = '".$data["country"]."', state = '".$data["state"]."', city = '".$data["city"]."', zipcode = '".$data["zipcode"]."', street_no = '".$data["street_no"]."', phone = '".$data["phone"]."', provider = '".$data["provider"]."', imprint = '".$data["imprint"]."', newslater = '".$data["newslater"]."' WHERE id = $id ");
}

public function getpaymenthistory($id)
{
    return $this->query(" SELECT 
                          payment_detail.*,
                          classifieds.title
                          FROM payment_detail
                          INNER JOIN classifieds ON classifieds.id = payment_detail.ad_id
                          WHERE payment_detail.user_id = $id
                          ORDER BY  payment_detail.created_date DESC
                      ");
}

public function savefbsignupdata($data)
{
    $this->query("INSERT INTO users (fb_id,name,email) VALUES ('".$data["id"]."','".$data["name"]."','".$data["email"]."')");
    return $this->query('select last_insert_id() as id;');
}

public function getuserfavoritead($user_id)
{   
    $lang_id = CakeSession::read('lang_id');
    return $this->query(" SELECT 
                          classifieds.id,
                          classifieds.title,
                          classifieds.price,
                          classifieds.city,
                          classifieds.s_id as sub_id,
                          files.base_url,
                          classified_category.category,
                          (SELECT classified_subcategory.subcategory FROM classified_subcategory WHERE classified_subcategory.s_id = sub_id AND classified_subcategory.lang_id = $lang_id) as subcategory
                          FROM user_favorite
                          INNER JOIN classifieds ON classifieds.id = user_favorite.ad_id
                          INNER JOIN files ON files.id = classifieds.logo_id
                          LEFT JOIN classified_category ON classified_category.c_id = classifieds.c_id
                          WHERE user_favorite.user_id = $user_id AND classified_category.lang_id = $lang_id
                      ");
}

public function updatemailstatus($id,$token)
{
   return $this->query("UPDATE `user_activation` SET `activate` = 2 WHERE `user_id` = $id AND tokenhash = '$token'");
}

public function gettokendetailemail($id,$token)
{
  return $this->query("SELECT * FROM `user_activation` WHERE user_id = $id AND tokenhash = '$token'");    
}

public function getnewmsg($id)
{
    return $this->query(" SELECT id  FROM messages WHERE to_id = $id AND status = 1");
}

public function getmsg($user_id)
{
  return $this->query(" SELECT
                        messages.*,
                        users.name
                        FROM messages
                        INNER JOIN users ON users.id = messages.from_id
                        WHERE messages.to_id = $user_id
                        GROUP BY messages.from_id
                        ORDER BY messages.created_date DESC
                    ");
}

public function getchatmsg($to_id,$from_id)
{
    return $this->query(" SELECT
                        messages.*,
                        users.name
                        FROM messages
                        INNER JOIN users ON users.id = messages.from_id
                        WHERE  (messages.to_id = $to_id AND messages.from_id = $from_id) OR (messages.to_id = $from_id AND messages.from_id = $to_id)
                        ORDER BY messages.created_date ASC
                    ");
}

public function getlastmsg($mid)
{
  return $this->query(" SELECT
                        messages.*,
                        users.name
                        FROM messages
                        INNER JOIN users ON users.id = messages.from_id
                        WHERE  messages.id = $mid
                    ");
}

public function deleteusermsg($from_id,$to_id)
{
   return $this->query(" DELETE FROM messages WHERE to_id = $to_id AND from_id = $from_id ");
}

public function getsentmsg($user_id)
{
  return $this->query(" SELECT
                        messages.*,
                        users.name
                        FROM messages
                        INNER JOIN users ON users.id = messages.to_id
                        WHERE messages.from_id = $user_id
                        GROUP BY messages.to_id
                        ORDER BY messages.created_date DESC
                    ");
}

public function getchatsentmsg($to_id,$from_id)
{
    return $this->query(" SELECT
                        messages.*,
                        users.name
                        FROM messages
                        INNER JOIN users ON users.id = messages.from_id
                        WHERE  (messages.to_id = $to_id AND messages.from_id = $from_id) OR (messages.to_id = $from_id AND messages.from_id = $to_id)
                        ORDER BY messages.created_date ASC
                    ");
}



/******************* Jayendra End *************************************/






public function getcity($state_id,$country_id){
    return $this->query("SELECT
countries_state_city.id,
countries_state_city.city_name
FROM
countries_state_city
WHERE
countries_state_city.country_id = $country_id AND
countries_state_city.state_id = $state_id AND
countries_state_city.`status` = 2
ORDER BY
countries_state_city.city_name ASC
");
}

public function getuserpost($user_id){
    return $this->query("SELECT
users.first_name,
users.last_name,
user_posts.id,
user_posts.user_id,
user_posts.post_text,
user_posts.image_upload,
user_posts.attach_user,
user_posts.location,
user_posts.type,
user_posts.`status`,
user_posts.created_on,
user_posts.updated_on,
files.file_name,
files.size,
files.base_url,
files.url,
user_profiles.profile_id,
user_images.size
FROM
users
INNER JOIN user_posts ON users.id = user_posts.user_id
INNER JOIN user_profiles ON user_posts.user_id = user_profiles.user_id
INNER JOIN user_images ON user_profiles.profile_id = user_images.main_file_id
INNER JOIN files ON user_images.file_id = files.id
WHERE
users.id = $user_id    
AND
user_profiles.status = 2
AND
user_images.size = '64X64'AND
user_posts.status = 2
ORDER BY
user_posts.id DESC");
}

public function getuserpostincludefriend($friend_string){
    return  $this->query("SELECT
users.first_name,
users.last_name,
user_posts.id,
user_posts.user_id,
user_posts.post_text,
user_posts.image_upload,
user_posts.attach_user,
user_posts.location,
user_posts.type,
user_posts.`status`,
user_posts.created_on,
user_posts.updated_on,
files.file_name,
files.size,
files.base_url,
files.url,
user_profiles.profile_id,
user_images.size
FROM
users
INNER JOIN user_posts ON users.id = user_posts.user_id
INNER JOIN user_profiles ON user_posts.user_id = user_profiles.user_id
INNER JOIN user_images ON user_profiles.profile_id = user_images.main_file_id
INNER JOIN files ON user_images.file_id = files.id
WHERE
users.id IN($friend_string)    
AND
user_profiles.status = 2
AND
user_images.size = '64X64' AND
user_posts.status = 2
AND
(user_posts.type = 'Friends' OR user_posts.type = 'Public' OR user_posts.type = 'Freunde' OR user_posts.type = 'Öffentlich')
ORDER BY
user_posts.id DESC");
}

public function getusercomment($post_id){
    return $this->query("SELECT
post_comments.id,
post_comments.user_id,
post_comments.post_id,
post_comments.comment_text,
post_comments.logo_id,
post_comments.`status`,
post_comments.created_on,
post_comments.updated_on,
users.first_name,
users.last_name,
files.file_name,
files.size,
files.base_url,
files.url,
user_images.size,
user_profiles.profile_id,
(select files.base_url from files where files.id = post_comments.logo_id) as logo_url
FROM
users
INNER JOIN post_comments ON users.id = post_comments.user_id
INNER JOIN user_profiles ON post_comments.user_id = user_profiles.user_id
INNER JOIN user_images ON user_profiles.profile_id = user_images.main_file_id
INNER JOIN files ON user_images.file_id = files.id
WHERE
post_comments.post_id = $post_id
AND
user_profiles.status = 2
AND
user_images.size = '64X64'
AND
post_comments.status = 2
ORDER BY
post_comments.id ASC
");    
}

public function getpostlike($post_id){
    return $this->query("SELECT
post_likes.id,
post_likes.user_id,
post_likes.post_id,
post_likes.comment_id,
post_likes.`like`,
post_likes.`status`,
post_likes.created_on,
post_likes.updated_on,
users.first_name,
users.last_name
FROM
post_likes
INNER JOIN users ON post_likes.user_id = users.id
WHERE
post_likes.post_id = $post_id AND
post_likes.`like` = 1 AND
post_likes.comment_id = 0
");  
}

public function commentslike($comment_id){
    return $this->query("SELECT
post_likes.id,
post_likes.user_id,
post_likes.post_id,
post_likes.comment_id,
post_likes.`like`,
post_likes.`status`,
post_likes.created_on,
post_likes.updated_on,
users.first_name,
users.last_name
FROM
post_likes
INNER JOIN users ON post_likes.user_id = users.id
WHERE
post_likes.comment_id = $comment_id AND
post_likes.`like` != 0 AND
post_likes.`status` = 2");
    
}

public function upldateprofileimage($user_id,$file_id){
$date = date("Y-m-d H:i:s");
$this->query("UPDATE `user_profiles` SET `profile_id` = $file_id WHERE `user_id` = $user_id");    
return $this->query("INSERT INTO `user_gallarys` (`user_id`,`file_id`,`file_type`,`status`,`created_on`) VALUES ($user_id,$file_id,'profile',2,'$date')");

}

public function getprofileimage($user_id){
    return $this->query("SELECT
user_profiles.profile_id,
files.file_name,
files.size,
files.base_url,
files.url,
users.first_name,
users.last_name,
user_images.size
FROM
user_profiles
INNER JOIN user_images ON user_profiles.profile_id = user_images.main_file_id
INNER JOIN files ON user_images.file_id = files.id
INNER JOIN users ON user_profiles.user_id = users.id
WHERE
user_profiles.`status` = 2 AND
user_profiles.user_id = $user_id AND
user_images.size = '128X128'    
    
");
}

public function uploadpostingimage($user_id,$file_id){
$date = date("Y-m-d H:i:s");    
return $this->query("INSERT INTO `user_gallarys` (`user_id`,`file_id`,`file_type`,`status`,`created_on`) VALUES ($user_id,$file_id,'post',2,'$date')");
}

public function uploadpersonalimage($user_id,$file_id){
$date = date("Y-m-d H:i:s");    
return $this->query("INSERT INTO `user_gallarys` (`user_id`,`file_id`,`file_type`,`status`,`created_on`) VALUES ($user_id,$file_id,'personal',2,'$date')");
}
public function getfriendslistwithimage($query){
    return $this->query("SELECT
user_profiles.id,
user_profiles.user_id,
user_profiles.about_you,
user_profiles.fav_quotes,
user_profiles.home_town,
user_profiles.current_city,
user_profiles.mobile_phone,
user_profiles.address,
user_profiles.website,
user_profiles.`language`,
user_profiles.religious_view,
user_profiles.poltical_view,
user_profiles.`status`,
user_profiles.created_on,
user_profiles.updated_on,
user_profiles.profile_id,
files.file_name,
files.base_url,
files.url,
users.id,
users.first_name,
users.last_name
FROM
user_profiles
INNER JOIN files ON user_profiles.profile_id = files.id
INNER JOIN users ON users.id = user_profiles.user_id
WHERE
users.`status` = 2 AND
users.first_name LIKE  '%$query%'
ORDER BY
users.first_name ASC");   
}

public function getcitylist($query){
    return $this->query("SELECT
countries_state_city.id,
countries_state_city.city_name
FROM
countries_state_city
WHERE
countries_state_city.`status` = 2 AND
countries_state_city.city_name LIKE  '%$query%'
ORDER BY
countries_state_city.city_name ASC");    
}

public function getpostimage($user_id){
    return $this->query("SELECT
files.base_url,
user_gallarys.file_id
FROM
user_gallarys
INNER JOIN files ON user_gallarys.file_id = files.id
WHERE
user_gallarys.user_id = $user_id AND
user_gallarys.file_type = 'post'");
}

public function getfriendpostimage($friend_string){
 return $this->query("SELECT
files.base_url,
user_gallarys.file_id
FROM
user_gallarys
INNER JOIN files ON user_gallarys.file_id = files.id
WHERE
user_gallarys.user_id IN ($friend_string) AND
user_gallarys.file_type = 'post'");   
}

public function getallsizeforimage(){
    return $this->query("SELECT resize_images.height,resize_images.width FROM `resize_images` WHERE status = 2"); 
}

public function upldateresizeimage($id, $file_id,$re_size){
$date = date("Y-m-d H:i:s");    
return $this->query("INSERT INTO `user_images`(`main_file_id`, `size`, `file_id`, `status`, `created_on`) VALUES ($id,'$re_size',$file_id,2,'$date')"); 
}

public function deleteallresizeiamge($id){
return $this->query("DELETE FROM `user_images` WHERE `user_id` = $id");     
}

public function removeprofileimage($id){
    return $this->query("UPDATE `user_profiles` SET `profile_id` = 1 WHERE `user_id` = $id");   
}

public function getallprofileimage($id){
    return $this->query("SELECT
user_gallarys.user_id,
files.base_url,
files.url,
user_gallarys.file_id
FROM
user_gallarys
INNER JOIN files ON user_gallarys.file_id = files.id
WHERE
user_gallarys.user_id = $id AND
user_gallarys.file_type = 'profile' ");
}

public function getallpostimageonly6($id){
    return $this->query("SELECT
user_gallarys.user_id,
files.base_url,
files.url,
user_gallarys.file_id
FROM
user_gallarys
INNER JOIN files ON user_gallarys.file_id = files.id
WHERE
user_gallarys.user_id = $id AND
(user_gallarys.file_type = 'post' OR user_gallarys.file_type = 'personal') ORDER BY user_gallarys.id DESC LIMIT 9");
}

public function getallpostimage($id){
    return $this->query("SELECT
user_gallarys.user_id,
files.base_url,
files.url,
user_gallarys.file_id
FROM
user_gallarys
INNER JOIN files ON user_gallarys.file_id = files.id
WHERE
user_gallarys.user_id = $id AND
user_gallarys.file_type = 'post' ");
}

public function getallpersonalimage($id){
    return $this->query("SELECT
user_gallarys.user_id,
files.base_url,
files.url,
user_gallarys.file_id
FROM
user_gallarys
INNER JOIN files ON user_gallarys.file_id = files.id
WHERE
user_gallarys.user_id = $id AND
user_gallarys.file_type = 'personal' ");
}

public function readdimageforuser($file_id,$id){
    return $this->query("UPDATE `user_profiles` SET `profile_id` = $file_id WHERE `user_id` = $id");    
}

public function updatepostlike($post_id,$user_id){
  $date = date("Y-m-d H:i:s");      
    return $this->query("UPDATE `post_likes` SET `like` = 0,`created_on` = '$date' WHERE `comment_id` = 0 AND `post_id` = $post_id AND `user_id` = $user_id");
}

public function updatecommentlike($comment_id,$user_id){
  $date = date("Y-m-d H:i:s");      
    return $this->query("UPDATE `post_likes` SET `like` = 0,`created_on` = '$date' WHERE `comment_id` = $comment_id AND `user_id` = $user_id");
}

public function insertfriendrequest($from_id,$to_id){
$date = date("Y-m-d H:i:s");          
return $this->query("INSERT INTO `user_friends` (`from_user`,`to_user`,`status`,`created_on`) VALUES ($from_id,$to_id,1,'$date')");    
}

public function deletefriendrequest($from_id,$to_id){
    
return $this->query("DELETE FROM `user_friends` WHERE `from_user` = $from_id AND `to_user` = $to_id");        
    
}

public function getsingalfrienddetail($from_id,$to_id){
    return $this->query("SELECT * from `user_friends` WHERE (`from_user` = $from_id AND `to_user` = $to_id) OR (`to_user` = $from_id AND `from_user` = $to_id)");
}

public function getfriendshiprequest($id){
    return $this->query("SELECT
user_friends.from_user,
user_friends.to_user,
users.id,
users.first_name,
users.last_name,
users.email,
users.`password`,
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
user_profiles.about_you,
user_profiles.fav_quotes,
user_profiles.home_town,
user_profiles.current_city,
user_profiles.mobile_phone,
user_profiles.address,
user_profiles.website,
user_profiles.`language`,
user_profiles.religious_view,
user_profiles.poltical_view,
user_profiles.profile_id,
user_profiles.company,
user_profiles.c_position,
user_profiles.c_city,
user_profiles.c_description,
user_profiles.p_skills,
user_profiles.school,
user_profiles.s_description,
user_profiles.relationship,
user_profiles.`status`,
user_profiles.created_on,
user_profiles.updated_on,
user_friends.`status`,
user_images.size,
user_images.file_id,
user_images.`status`,
files.file_name,
files.base_url,
files.url
FROM
user_friends
INNER JOIN users ON user_friends.from_user = users.id
INNER JOIN user_profiles ON users.id = user_profiles.user_id
INNER JOIN user_images ON user_profiles.profile_id = user_images.main_file_id
INNER JOIN files ON user_images.file_id = files.id
WHERE
user_friends.to_user = $id AND
user_friends.`status` = 1 AND
user_images.size = '64X64'
");
}


public function confirmationfriendshiprequest($from_id,$to_id){
    return $this->query("UPDATE `user_friends` SET `status` = 2 WHERE `from_user` = $from_id AND `to_user` = $to_id LIMIT 1");
}

public function fetchfriendslist($id){
    return $this->query("SELECT
user_friends.from_user,
user_friends.to_user,
users.id,
users.first_name,
users.last_name,
users.email,
users.`password`,
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
user_profiles.about_you,
user_profiles.fav_quotes,
user_profiles.home_town,
user_profiles.current_city,
user_profiles.mobile_phone,
user_profiles.address,
user_profiles.website,
user_profiles.`language`,
user_profiles.religious_view,
user_profiles.poltical_view,
user_profiles.profile_id,
user_profiles.company,
user_profiles.c_position,
user_profiles.c_city,
user_profiles.c_description,
user_profiles.p_skills,
user_profiles.school,
user_profiles.s_description,
user_profiles.relationship,
user_profiles.`status`,
user_profiles.created_on,
user_profiles.updated_on,
user_friends.`status`,
user_images.size,
user_images.file_id,
user_images.`status`,
files.file_name,
files.base_url,
files.url
FROM
user_friends
INNER JOIN users ON user_friends.from_user = users.id OR user_friends.to_user = users.id
INNER JOIN user_profiles ON users.id = user_profiles.user_id
INNER JOIN user_images ON user_profiles.profile_id = user_images.main_file_id
INNER JOIN files ON user_images.file_id = files.id
WHERE
(user_friends.to_user = $id
OR
user_friends.from_user = $id
)AND

users.id != $id
AND
user_friends.`status` = 2 AND
user_images.size = '128X128'
");
}
public function fetchfriendslistonlysix($id){
    return $this->query("SELECT
user_friends.from_user,
user_friends.to_user,
users.id,
users.first_name,
users.last_name,
users.email,
users.`password`,
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
user_profiles.about_you,
user_profiles.fav_quotes,
user_profiles.home_town,
user_profiles.current_city,
user_profiles.mobile_phone,
user_profiles.address,
user_profiles.website,
user_profiles.`language`,
user_profiles.religious_view,
user_profiles.poltical_view,
user_profiles.profile_id,
user_profiles.company,
user_profiles.c_position,
user_profiles.c_city,
user_profiles.c_description,
user_profiles.p_skills,
user_profiles.school,
user_profiles.s_description,
user_profiles.relationship,
user_profiles.`status`,
user_profiles.created_on,
user_profiles.updated_on,
user_friends.`status`,
user_images.size,
user_images.file_id,
user_images.`status`,
files.file_name,
files.base_url,
files.url
FROM
user_friends
INNER JOIN users ON user_friends.from_user = users.id OR user_friends.to_user = users.id
INNER JOIN user_profiles ON users.id = user_profiles.user_id
INNER JOIN user_images ON user_profiles.profile_id = user_images.main_file_id
INNER JOIN files ON user_images.file_id = files.id
WHERE
(user_friends.to_user = $id
OR
user_friends.from_user = $id
)AND

users.id != $id
AND
user_friends.`status` = 2 AND
user_images.size = '128X128'
LIMIT 10
");
}
public function onlineuser($id){
    return $this->query("UPDATE `users` SET `flag`= 1 WHERE id = $id");    
}

public function listoffriends($id){
    return $this->query("SELECT
(case when (user_friends.from_user = $id ) 
 THEN
   user_friends.to_user   
 ELSE
      user_friends.from_user
 END)
 as friend_id
FROM
user_friends
WHERE
(user_friends.from_user = $id OR
user_friends.to_user = $id) AND
user_friends.`status` = 2");   
}

public function listonlineuser($friend_string){
    return $this->query("SELECT
users.id,
users.first_name,
users.last_name,
users.email,
users.`password`,
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
user_images.file_id,
user_images.size,
files.file_name,
files.base_url,
files.url
FROM
users
INNER JOIN user_profiles ON users.id = user_profiles.user_id
INNER JOIN user_images ON user_profiles.profile_id = user_images.main_file_id
INNER JOIN files ON user_images.file_id = files.id
WHERE
users.id IN ($friend_string) AND
user_images.size = '64X64'
");
}

public function chatboxinfo($id){
    return $this->query("SELECT
users.id,
users.first_name,
users.last_name,
users.`status`,
users.flag,
user_profiles.username,
users.role_id,
user_images.size,
files.file_name,
files.base_url,
files.url
FROM
users
INNER JOIN user_profiles ON users.id = user_profiles.user_id
INNER JOIN user_images ON user_profiles.profile_id = user_images.main_file_id
INNER JOIN files ON user_images.file_id = files.id
WHERE
users.id = $id AND
users.`status` = 2 AND
user_images.size = '64X64'");    
}

public function fullchatting($from_id,$to_id){
    $date = date("Y-m-d");
    return $this->query("SELECT
user_chattings.id,
user_chattings.from_id,
user_chattings.to_id,
user_chattings.message,
user_chattings.date,
UNIX_TIMESTAMP(user_chattings.created_on) AS created_on,
user_chattings.updated_on
FROM
user_chattings
WHERE
(user_chattings.from_id = $from_id AND user_chattings.to_id = $to_id AND user_chattings.date = '$date')
OR
(user_chattings.from_id = $to_id AND user_chattings.to_id = $from_id AND user_chattings.date = '$date')");
}

public function lasttwodaychat($from_id,$to_id){
    return $this->query("SELECT
user_chattings.id,
user_chattings.from_id,
user_chattings.to_id,
user_chattings.message,
user_chattings.date,
UNIX_TIMESTAMP(user_chattings.created_on) AS created_on,
user_chattings.updated_on
FROM
user_chattings
WHERE
(user_chattings.from_id = $from_id AND user_chattings.to_id = $to_id AND user_chattings.date >= NOW() - INTERVAL 2 DAY)
OR
(user_chattings.from_id = $to_id AND user_chattings.to_id = $from_id AND user_chattings.date >= NOW() - INTERVAL 2 DAY)");   
}

public function latestmessage($user_id){
    return $this->query("SELECT 
user_chattings.from_id,
user_chattings.to_id,
user_chattings.message,
user_chattings.date,
user_chattings.created_on,
UNIX_TIMESTAMP(user_chattings.created_on) AS created_on,
user_chattings.updated_on,
users.id,
users.first_name,
users.last_name,
user_profiles.username,
user_images.size,
user_images.file_id,
files.file_name,
files.base_url,
files.url
FROM
user_chattings
INNER JOIN users ON user_chattings.from_id = users.id
INNER JOIN user_profiles ON users.id = user_profiles.user_id
INNER JOIN user_images ON user_profiles.profile_id = user_images.main_file_id
INNER JOIN files ON user_images.file_id = files.id
WHERE
user_chattings.to_id = $user_id AND
user_images.size = '64X64'
AND
user_chattings.created_on IN (SELECT  DISTINCT MAX(user_chattings.created_on)  FROM user_chattings WHERE user_chattings.to_id = $user_id GROUP BY user_chattings.from_id )
AND user_chattings.created_on >= NOW( ) - INTERVAL 2 DAY
ORDER BY user_chattings.created_on DESC
LIMIT 0 , 5
");
}


public function getmessagepersec($last_time,$user_id,$to_id){
    return $this->query("SELECT
user_chattings.id,
user_chattings.from_id,
user_chattings.to_id,
user_chattings.message,
user_chattings.date,
UNIX_TIMESTAMP(user_chattings.created_on) AS created_on,
user_chattings.updated_on
FROM
user_chattings
WHERE
(user_chattings.from_id = $user_id AND user_chattings.to_id = $to_id  AND UNIX_TIMESTAMP(user_chattings.created_on) > '$last_time')
OR
(user_chattings.from_id = $to_id AND user_chattings.to_id = $user_id AND UNIX_TIMESTAMP(user_chattings.created_on) > '$last_time')
ORDER BY user_chattings.id DESC
LIMIT 1");
}






 public function offlineuser($id){
    return $this->query("UPDATE users SET flag = 0 WHERE id = $id");
}

 public function submituserplacecountry($country,$user_id){
    return $this->query(" update users set country = '$country' where id = '$user_id' ");
}

public function submituserplacestate($state,$user_id){
    return $this->query(" update users set state = '$state' where id = '$user_id' ");
}

public function submituserplacecity($city,$user_id){
    return $this->query(" update users set city = '$city' where id = '$user_id' ");
}

public function deleteplaceuserinfo($user_id,$key){
    return $this->query(" update user_profiles set $key = '' where user_id = '$user_id' ");
}

public function getuserdata($user_id){
    return $this->query(" SELECT
users.id,
users.first_name,
users.last_name,
users.email,
users.gender,
users.company_name,
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
users.role_id,
countries.country_name,
countries_state.state_name,
countries_state_city.city_name
FROM
users
LEFT JOIN countries ON users.country = countries.id
LEFT JOIN countries_state ON users.state = countries_state.id
LEFT JOIN countries_state_city ON users.city = countries_state_city.id
WHERE
users.id = $user_id");
}

 public function deleteplaceuserinfotwo($user_id,$key,$key1){
    return $this->query(" update user_profiles set $key = '', $key1 = '' where user_id = '$user_id' ");
}

public function deleteplaceuserinfofour($user_id,$key,$key1,$key2,$key3){
    return $this->query(" update user_profiles set $key = '', $key1 = '', $key2 = '', $key3 = '' where user_id = '$user_id' ");
}

public function searchusersprofile($value){
    return $this->query("SELECT
users.id,
users.first_name,
users.last_name,
user_images.size,
files.file_name,
files.base_url,
files.url,
user_profiles.company
FROM
users
INNER JOIN user_profiles ON users.id = user_profiles.user_id
INNER JOIN user_images ON user_profiles.profile_id = user_images.main_file_id
INNER JOIN files ON user_images.file_id = files.id
WHERE
user_images.size = '64x64'  AND
users.first_name LIKE '%$value%'");
}

public function getcommentdata($lid)
{
    return $this->query("SELECT
post_comments.id,
post_comments.user_id,
post_comments.post_id,
post_comments.comment_text,
post_comments.logo_id,
post_comments.`status`,
post_comments.created_on,
post_comments.updated_on,
users.first_name,
users.last_name,
files.file_name,
files.size,
files.base_url,
files.url,
user_images.size,
user_profiles.profile_id,
(select files.base_url from files where files.id = post_comments.logo_id) as logo_url
FROM
users
INNER JOIN post_comments ON users.id = post_comments.user_id
INNER JOIN user_profiles ON post_comments.user_id = user_profiles.user_id
INNER JOIN user_images ON user_profiles.profile_id = user_images.main_file_id
INNER JOIN files ON user_images.file_id = files.id
WHERE
post_comments.id = $lid
AND
user_profiles.status = 2
AND
user_images.size = '64X64'
AND
post_comments.status = 2
ORDER BY
post_comments.id ASC
");  
}

 public function getusersettingdata($user_id)
{
    return $this->query(" SELECT 
            users.first_name,
            users.last_name,
            user_profiles.username
            FROM users
            INNER JOIN user_profiles ON users.id = user_profiles.user_id
            WHERE users.id = '$user_id'
        ");
}

public function updateusername($f_name,$l_name,$user_id)
{
    return $this->query("update users set first_name = '$f_name', last_name = '$l_name' where id = '$user_id'");
}

public function updateuserusername($u_name,$user_id)
{
    return $this->query(" update user_profiles set username = '$u_name' where user_id = '$user_id'");
}



public function getlatestmessagecount($user_id)
{
    return $this->query(" SELECT count(`id`) as coun  FROM `user_chattings` WHERE `to_id` = $user_id AND `status` = 1 ");
}

public function updatelatestmessage($user_id)
{
    return $this->query(" UPDATE `user_chattings` SET `status` = 2  WHERE `to_id` = $user_id ");
}

public function getlatestfriendscount($user_id)
{
    return $this->query(" SELECT count('id') as f FROM user_friends WHERE to_user = $user_id  AND  status = 1 ");
}

public function getpaymentmode()
{
    return $this->query(" SELECT * FROM `payments_modes` ");
}

public function updatesubcription($start_date,$end_date,$user_id)
{
    return $this->query(" UPDATE users SET sub_startdate = '$start_date', sub_enddate = '$end_date' WHERE id = '$user_id' ");
}

public function getuserimageurl($id,$type){
    return $this->query("SELECT
user_gallarys.user_id,
files.base_url,
files.url,
user_gallarys.file_id
FROM
user_gallarys
INNER JOIN files ON user_gallarys.file_id = files.id
WHERE
user_gallarys.file_id = $id AND
user_gallarys.file_type = '$type' ");
}

public function removeuserimage($id,$type)
{
   $this->query(" DELETE FROM user_gallarys WHERE  user_gallarys.file_id = $id AND user_gallarys.file_type = '$type' "); 
   $this->query("SET FOREIGN_KEY_CHECKS=0");
   $this->query(" DELETE FROM  files WHERE id = '$id' ");
   return $this->query("SET FOREIGN_KEY_CHECKS=1");
    
}

/** For message chat **/

public function listofallfriends($id){
    return $this->query("SELECT
(case when (user_friends.from_user = $id ) 
 THEN
   user_friends.to_user   
 ELSE
      user_friends.from_user
 END)
 as friend_id
FROM
user_friends
WHERE
(user_friends.from_user = $id OR
user_friends.to_user = $id) AND
user_friends.`status` = 2");   
}

public function listofallonlineuser($friend_string){
    return $this->query("SELECT
users.id,
users.first_name,
users.last_name,
users.`status`,
users.flag,
user_profiles.username,
user_images.file_id,
user_images.size,
files.file_name,
files.base_url,
files.url
FROM
users
INNER JOIN user_profiles ON users.id = user_profiles.user_id
INNER JOIN user_images ON user_profiles.profile_id = user_images.main_file_id
INNER JOIN files ON user_images.file_id = files.id
WHERE
users.id IN ($friend_string) AND
user_images.size = '64X64'
ORDER BY users.first_name ASC
");
}

public function searchfriendlist($user_id,$val)
{
    return $this->query("SELECT
                        (case when (user_friends.from_user = $user_id ) 
                         THEN
                           user_friends.to_user   
                         ELSE
                              user_friends.from_user
                         END)
                         as friend_id,
                        users.id,
                        users.first_name,
                        users.last_name,
                        users.`status`,
                        users.flag,
                        user_profiles.username,
                        user_images.file_id,
                        user_images.size,
                        files.file_name,
                        files.base_url,
                        files.url
                        FROM
                        users
                        INNER JOIN user_profiles ON users.id = user_profiles.user_id
                        INNER JOIN user_images ON user_profiles.profile_id = user_images.main_file_id
                        INNER JOIN files ON user_images.file_id = files.id
                        INNER JOIN user_friends ON 
                        (case when (user_friends.from_user = $user_id ) 
                         THEN
                           user_friends.to_user  = users.id 
                         ELSE
                              user_friends.from_user = users.id
                         END)
                        WHERE
                        (user_friends.from_user = $user_id OR
                        user_friends.to_user = $user_id) AND
                        user_friends.`status` = 2 AND
                        (users.first_name LIKE '%$val%' OR users.last_name LIKE '%$val%') AND
                        user_images.size = '64X64'
                        ORDER BY users.first_name ASC
                 ");
}


public function friendschatting($from_id,$to_id){

    return $this->query("SELECT
                        user_chattings.id,
                        user_chattings.from_id,
                        user_chattings.to_id,
                        user_chattings.message,
                        user_chattings.date,
                        UNIX_TIMESTAMP(user_chattings.created_on) AS created_on,
                        user_chattings.created_on,
                        user_chattings.updated_on
                        FROM
                        user_chattings
                        WHERE
                        (user_chattings.from_id = $from_id AND user_chattings.to_id = $to_id)
                        OR
                        (user_chattings.from_id = $to_id AND user_chattings.to_id = $from_id)
                        ORDER BY user_chattings.created_on ASC
                    ");
}

public function getusersdetails($id)
{
    return $this->query(" SELECT
                        users.id,
                        users.first_name,
                        users.last_name,
                        files.base_url
                        FROM users
                        INNER JOIN user_profiles ON users.id = user_profiles.user_id
                        INNER JOIN user_images ON user_profiles.profile_id = user_images.main_file_id
                        INNER JOIN files ON user_images.file_id = files.id
                        WHERE users.id = $id AND user_images.size = '128X128'
                     ");
}

public function messagechatpersecond($user_id,$to_id,$l_time)
{
    return $this->query("SELECT
                        user_chattings.id,
                        user_chattings.from_id,
                        user_chattings.to_id,
                        user_chattings.message,
                        user_chattings.date,
                        UNIX_TIMESTAMP(user_chattings.created_on) AS created_on,
                        user_chattings.created_on,
                        user_chattings.updated_on
                        FROM
                        user_chattings
                        WHERE
                        (user_chattings.from_id = $user_id AND user_chattings.to_id = $to_id  AND UNIX_TIMESTAMP(user_chattings.created_on) > '$l_time')
                        OR
                        (user_chattings.from_id = $to_id AND user_chattings.to_id = $user_id  AND UNIX_TIMESTAMP(user_chattings.created_on) > '$l_time')
                        ORDER BY user_chattings.created_on ASC
                    ");
}

public function getuserchat($c_id)
{
    return $this->query("SELECT
                        user_chattings.id,
                        user_chattings.from_id,
                        user_chattings.to_id,
                        user_chattings.message,
                        user_chattings.date,
                        UNIX_TIMESTAMP(user_chattings.created_on) AS created_on,
                        user_chattings.created_on,
                        user_chattings.updated_on
                        FROM
                        user_chattings
                        WHERE
                        id = $c_id;                       
                    ");
}




}