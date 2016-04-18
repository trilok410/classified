<?php 

App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('CakeSession', 'Model/Datasource');


class Classifiedadmin extends AppModel{
    public $name = 'Classified';
    public $useTable = 'classifieds';

    
/* Common Functions  */

	public function getlastid($tab,$id)
    {
      return $this->query(" select $id from $tab order by $id desc limit 0,1 ");
    }

    public function blockdata($c_id,$tab,$col)
      {
          return $this->query(" update  $tab set status = '1' where $col = '$c_id'");
      }

    public function unblockdata($c_id,$tab,$col)
      {
          return $this->query(" update  $tab set status = '2' where $col = '$c_id'");
      }

    public function getallmaincategory()
    {
    	return $this->query(" SELECT * FROM  classified_maincategories WHERE lang_id = 1 ");
    }

    public function getallcategory()
    {
    	return $this->query(" SELECT * FROM  classified_category WHERE lang_id = 1 ");
    }

    public function getcategory1($tab,$val,$m_id)
    {
    	return $this->query(" select * from $tab where $val = '$m_id' AND lang_id = '1' ");
    }

    public function getcategory2($tab,$val,$m_id)
    {
      return $this->query(" select * from $tab where $val = '$m_id' AND lang_id = '2' ");
    }

    public function updateimage($lid,$id,$tab,$m_id)
    {
    	return $this->query(" UPDATE $tab SET logo_id = '$lid' WHERE $m_id = '$id'");
    }

    public function getcategory($m_id)
    {
    	return $this->query(" SELECT 
                              classified_category.*,
                              classified_category.c_id as cid,
                              (SELECT count(id) as ad FROM `classifieds` WHERE c_id = cid AND status = 2 ) as ccount  
                              FROM classified_category
                              WHERE maincategory_id = $m_id AND lang_id = 1
                           ");
    }

    public function getallcountry()
    {
        return $this->query(" SELECT * FROM countries ");
    }

    public function getclassifiedpages()
    {
        return $this->query(" SELECT * FROM classifieds_pages WHERE status = 2 ");
    }


/* Common Functions  */ 

    /* Jayendra start */
    public function getallmaincategory1()
  	{
  		return $this->query("select classified_maincategories.*, files.base_url from classified_maincategories LEFT JOIN files ON classified_maincategories.logo_id = files.id where lang_id = '1' ");
  	}

    public function getallmaincategory2()
    {
      return $this->query("select * from classified_maincategories where lang_id = '2' ");
    }

    public function editmaincategory($name,$id,$description,$meta_desc,$meta_key,$meta_tit)
    {
        return  $this->query(" UPDATE `classified_maincategories` SET `maincategory` = '$name', `status` ='2', `description` = '$description', meta_description = '$meta_desc', meta_keyword = '$meta_key' , meta_title = '$meta_tit' WHERE `id` = '$id'");
    }

    public function addmaincategory($category,$lang_id,$last_id)
    {
        $date = date("Y-m-d h:i:s");
        return $this->query("INSERT INTO `classified_maincategories`(`m_id`, `maincategory`, `lang_id`, `status`, `created_date`) VALUES ('$last_id','$category','$lang_id','2','$date')");
    }

    public function updatemaincategory($name,$lang_id,$m_id,$description,$meta_tit)
    {
        $date = date("Y-m-d h:i:s");
        return $this->query("INSERT INTO `classified_maincategories`(`m_id`, `maincategory`, `lang_id`,`description`,`meta_description`,`meta_keyword`,`meta_title`, `status`, `created_date`) VALUES ('$m_id','$name','$lang_id','$description','$meta_desc','$meta_key','$meta_tit','2','$date')");
    }

    public function getallcategory1()
    {
        return $this->query("   SELECT 
                                classified_category.*,
                                classified_maincategories.maincategory,
                                files.base_url
                                FROM classified_category
                                INNER JOIN classified_maincategories ON classified_maincategories.m_id = classified_category.maincategory_id
                                LEFT JOIN files ON files.id = classified_category.logo_id
                                WHERE  classified_category.lang_id = 1 AND classified_maincategories.lang_id = 1
                            ");
    }

    public function getallcategory2()
    {
        return $this->query(" SELECT * FROM classified_category WHERE lang_id = 2");
    }

    public function editcategory($name,$id,$maincat_id)
    {
        return $this->query("UPDATE `classified_category` SET `maincategory_id` = '$maincat_id',`category` = '$name' WHERE `id` = $id ");
    }

    public function updatecategory($name,$lang_id,$c_id,$maincat_id)
    {
        $date = date("Y-m-d h:i:s");
        return $this->query("INSERT INTO `classified_category`(`c_id`, `maincategory_id`,`category`, `lang_id`, `status`, `created_date`) VALUES ('$c_id','$maincat_id','$name','$lang_id','2','$date')");
    }

    public function getallsubcategory1()
    {
        return $this->query(" SELECT 
                                classified_subcategory.*,
                                classified_category.category,
                                classified_maincategories.maincategory
                                FROM classified_subcategory
                                INNER JOIN classified_category ON classified_subcategory.c_id = classified_category.c_id
                                INNER JOIN classified_maincategories ON classified_subcategory.main_id = classified_maincategories.m_id
                                WHERE  classified_category.lang_id = 1 AND classified_maincategories.lang_id = 1 AND classified_subcategory.lang_id = 1
                            ");
    }

    public function getallsubcategory2()
    {
        return $this->query(" SELECT * FROM classified_subcategory WHERE lang_id = 2");
    }

    public function editsubcategory($name,$id,$m_id,$c_id)
    {
        return $this->query("UPDATE `classified_subcategory` SET `subcategory` = '$name',`main_id` = '$m_id',`c_id` = '$c_id',`status` = '2' WHERE id = $id ");
    }

    public function updatesubcategory($name,$lang_id,$s_id,$m_id,$c_id)
    {
        $date = date("Y-m-d h:i:s");
        return $this->query("INSERT INTO `classified_subcategory`(`s_id`, `main_id`, `c_id`, `subcategory`, `lang_id`, `status`, `created_date`) VALUES ('$s_id','$m_id','$c_id','$name','$lang_id','2','$date')");
    }

    public function getcategories()
    {
        return $this->query("SELECT * FROM classified_category WHERE c_id IN (1,2,3) AND lang_id = 1");
    }

    public function getsubcategories($c_id)
    {
        return $this->query(" SELECT * FROM classified_subcategory WHERE c_id = $c_id AND lang_id = 1 ");
    }

    public function getmodels()
    {
        return $this->query(" SELECT
                              models.*,
                              classified_subcategory.subcategory
                              FROM models
                              INNER JOIN classified_subcategory ON classified_subcategory.s_id = models.s_id
                              WHERE classified_subcategory.lang_id = 1
                          ");
    }

    public function getmodelbyid($m_id)
    {
        return $this->query(" SELECT
                              models.*,
                              classified_subcategory.subcategory
                              FROM models
                              INNER JOIN classified_subcategory ON classified_subcategory.s_id = models.s_id
                              WHERE models.id = $m_id AND classified_subcategory.lang_id = 1
                          ");
    }

    public function getadddetail($add_id)
    {
      //$lang_id = CakeSession::read('lang_id');
      return $this->query(" SELECT 
                            classifieds.*,
                            users.email,
                            users.created_date,
                            users.name,
                            classified_maincategories.maincategory,
                            classified_category.category,
                            (SELECT classified_subcategory.subcategory FROM classifieds LEFT JOIN classified_subcategory ON classified_subcategory.s_id = classifieds.s_id WHERE classifieds.id = $add_id AND classified_subcategory.lang_id = 1) as subcategory,
                            countries.name,
                            states.name,
                            files.base_url                            
                            FROM classifieds
                            LEFT JOIN users ON users.id = classifieds.user_id
                            LEFT JOIN classified_maincategories ON classified_maincategories.m_id = classifieds.m_id
                            LEFT JOIN classified_category ON classified_category.c_id = classifieds.c_id
                            LEFT JOIN countries ON countries.id = classifieds.country
                            LEFT JOIN states ON states.id = classifieds.state
                            LEFT JOIN files ON files.id = classifieds.logo_id
                            WHERE classifieds.id = $add_id AND classified_maincategories.lang_id = 1 AND classified_category.lang_id = 1
                          ");
    }

    public function getaddimages($add_id)
    {
      return $this->query(" SELECT 
                            files.base_url,
                            classifiedimages.logo_id
                            FROM classifiedimages
                            INNER JOIN files ON files.id = classifiedimages.logo_id
                            WHERE classifiedimages.add_id = $add_id
                          ");
    }

    public function getuserdetail($u_id)
    {
        return $this->query("SELECT
            users.*,
            countries.name,
            states.name
            FROM
            users
            LEFT JOIN countries ON users.country = countries.id
            LEFT JOIN states ON users.state = states.id
            WHERE users.id = '$u_id'
        ");
    }

    public function getcountrydata($c_id)
    {
        return $this->query(" select * from countries where id = '$c_id'");
    }

    public function updatecountry($name,$id)
    {
        return $this->query(" update countries set name = '$name', status = '2' where id = '$id'");
    }

    public function addcountry($name)
    {
        $date = date("Y-m-d h:i:s");
        return $this->query(" INSERT INTO `countries`(`name`, `status`, `created_date`) VALUES ('$name','2','$date')");
    }

    public function getallstatedata()
    {
        return $this->query(" SELECT
                states.id,
                states.name,
                states.status,
                states.created_date,
                countries.name
                FROM states
                INNER JOIN countries ON states.c_id = countries.id
            ");
    }

    public function getstatedata($s_id)
    {
        return $this->query(" select * from states where id = '$s_id'");
    }

    public function getcitydata($cid)
    {
        return $this->query("SELECT
                             city.*,
                             states.name 
                             FROM city
                             INNER JOIN states ON states.id = city.s_id 
                             WHERE city.id = $cid
                           ");
    }

    public function updatestate($name,$s_id,$c_id)
    {
        return $this->query(" update states set c_id = '$c_id', name = '$name' where id = '$s_id'");
    }
    public function updatecity($name,$s_id,$cid)
    {
        return $this->query(" update city set s_id = '$s_id', name = '$name' where id = $cid");
    }

    public function addstate($name,$c_id)
    {   $date = date("Y-m-d h:i:s"); 
        return $this->query(" INSERT INTO `states`(`c_id`, `name`, `status`, `created_date`) VALUES ('$c_id','$name','2','$date')");
    }

    public function addcity($name,$s_id)
    {
        $date = date("Y-m-d h:i:s"); 
        return $this->query(" INSERT INTO `city`(`s_id`, `name`, `status`, `create_date`) VALUES ('$s_id','$name','2','$date')");
    }

    public function getpaymentmode()
    {
        return $this->query(" SELECT
                              payment_modes.*,
                              files.base_url
                              FROM payment_modes
                              LEFT JOIN files ON files.id = payment_modes.logo_id
                           ");
    }

    public function getpaymentmodebyid($m_id)
    {
        return $this->query(" SELECT
                              payment_modes.*,
                              files.base_url
                              FROM payment_modes
                              LEFT JOIN files ON files.id = payment_modes.logo_id
                              WHERE payment_modes.id = $m_id
                           ");
    }

    public function updatepaymentmode($m_price,$m_id)
    {
        return $this->query("  UPDATE `payment_modes` SET `price` = '$m_price' WHERE id = $m_id ");
    }

    public function gethistory()
    {
        return $this->query(" SELECT
                              payment_detail.*,
                              classifieds.user_id,
                              classifieds.name,
                              classifieds.urgent,
                              classifieds.featured,
                              classifieds.gallery,
                              classifieds.urgent_date,
                              classifieds.featured_date,
                              classifieds.gallery_date
                              FROM payment_detail
                              INNER JOIN classifieds ON payment_detail.ad_id = classifieds.id
                            ");
    }

    public function allcount()
    {
        $date = date("Y-m-d");
        $count = array();

        $user = $this->query(" select id from users where status = 2");
        $count["user"] = sizeof($user);

        $no_ads = $this->query(" SELECT id FROM classifieds WHERE status = 2");
        $count["ads"] = sizeof($no_ads);

        $ad_main_cat = $this->query(" SELECT m_id FROM classified_maincategories GROUP BY m_id ");
        $count["ad_main_cat"] = sizeof($ad_main_cat);

        $ad_cat = $this->query(" SELECT c_id FROM classified_category GROUP BY c_id ");
        $count["ad_cat"] = sizeof($ad_cat);

        $ad_sub_cat = $this->query(" SELECT s_id FROM classified_subcategory GROUP BY s_id ");
        $count["ad_sub_cat"] = sizeof($ad_sub_cat);
        
        return $count;
    }

    public function getpendingad()
    {
      return $this->query(" SELECT 
                            classifieds.*,
                            users.name,
                            classified_category.category,
                            files.base_url                            
                            FROM classifieds
                            LEFT JOIN users ON users.id = classifieds.user_id
                            LEFT JOIN classified_category ON classified_category.c_id = classifieds.c_id
                            LEFT JOIN files ON files.id = classifieds.logo_id
                            WHERE classifieds.status = 0 AND classified_category.lang_id = 1
                            ORDER BY classifieds.create_date DESC
                          ");
    }

    public function getallad()
    {
      return $this->query(" SELECT 
                            classifieds.*,
                            users.name,
                            classified_category.category,
                            files.base_url                            
                            FROM classifieds
                            LEFT JOIN users ON users.id = classifieds.user_id
                            LEFT JOIN classified_category ON classified_category.c_id = classifieds.c_id
                            LEFT JOIN files ON files.id = classifieds.logo_id
                            WHERE classifieds.status = 2 AND classified_category.lang_id = 1
                            ORDER BY classifieds.create_date DESC
                          ");
    }

    public function getadbymaincat($col,$val)
    {
      return $this->query(" SELECT 
                            classifieds.*,
                            users.name,
                            classified_category.category,
                            files.base_url                            
                            FROM classifieds
                            LEFT JOIN users ON users.id = classifieds.user_id
                            LEFT JOIN classified_category ON classified_category.c_id = classifieds.c_id
                            LEFT JOIN files ON files.id = classifieds.logo_id
                            WHERE classifieds.status = 2 AND classified_category.lang_id = 1 AND classifieds.$col  = $val
                            ORDER BY classifieds.create_date DESC
                          ");
    }

    public function deletead($id)
    {
        return $this->query("DELETE FROM classifieds WHERE id IN ($id) ");
    }

    public function getallimagesid($id)
    {
        return $this->query(" SELECT logo_id FROM classifiedimages WHERE add_id IN ($id)");
    }

    public function deleteallimages($tab,$col,$id)
    {
        return $this->query("DELETE FROM $tab WHERE $col IN ($id) ");
    }

    public function unblockalldata($tab,$id)
    {
        return $this->query("UPDATE $tab SET status = 2 WHERE id IN($id)");
    }

    public function blockalldata($tab,$id)
    {
        return $this->query("UPDATE $tab SET status = 1 WHERE id IN($id)");
    }

    public function getmaincategory()
    {
      return $this->query(" SELECT
                  classified_maincategories.*,
                  classified_maincategories.m_id as mid,
                  classified_category.maincategory_id,
                  (SELECT count(id) as ad FROM `classifieds` WHERE m_id = mid AND status = 2 ) as mcount,
                  files.base_url    
                  FROM classified_maincategories 
                  LEFT JOIN files ON files.id = classified_maincategories.logo_id
                  LEFT JOIN classified_category ON classified_category.maincategory_id = classified_maincategories.m_id
                  WHERE classified_maincategories.lang_id = 1 AND classified_maincategories.status = 2
                  GROUP BY classified_maincategories.m_id
                  ORDER BY classified_maincategories.lead_cat ASC
                ");
    }

    public function maincategorybyid($mid)
    {
        return $this->query(" SELECT classified_maincategories.* FROM classified_maincategories WHERE classified_maincategories.lang_id = 1 AND classified_maincategories.status = 2 AND classified_maincategories.m_id  = $mid ");
    }

    public function getadddata($add_id)
    {
        $lang_id = 1;
        return $this->query(" SELECT 
                            classifieds.*,
                            states.name,
                            classified_maincategories.maincategory,
                            classified_category.category,
                            (SELECT classified_subcategory.subcategory FROM classifieds LEFT JOIN classified_subcategory ON classified_subcategory.s_id = classifieds.s_id WHERE classifieds.id = $add_id AND classified_subcategory.lang_id = $lang_id) as subcategory,
                            files.base_url
                            FROM classifieds
                            LEFT JOIN classified_maincategories ON classified_maincategories.m_id = classifieds.m_id
                            LEFT JOIN classified_category ON classified_category.c_id = classifieds.c_id
                            LEFT JOIN states ON states.id = classifieds.state
                            LEFT JOIN files ON files.id = classified_maincategories.logo_id
                            WHERE classifieds.id = $add_id AND classified_maincategories.lang_id = $lang_id AND classified_category.lang_id = $lang_id
                          ");
    }

    public function getallcitydata()
    {
        return $this->query(" SELECT
                              city.*,
                              states.name,
                              countries.name
                              FROM city
                              INNER JOIN states ON states.id = city.s_id
                              INNER JOIN countries ON countries.id = states.c_id
                            ");
    }
    
/*********************** jayendra end **************************/

    public function updateleadcat()
    {
        return $this->query(" UPDATE classified_maincategories SET lead_cat = 0 ");
    }

    public function updateleadcat1($id)
    {
        return $this->query(" UPDATE classified_maincategories SET lead_cat = 1 WHERE m_id = $id ");
    }

  

    public function getbanneradd($page_id)
    {
        return $this->query(" SELECT
                   files.base_url,
                   classifieds_add.*,
                   classifieds_pages.page_name,
                   countries.country_name
                   FROM classifieds_add
                   INNER JOIN files ON classifieds_add.image_id = files.id
                   INNER JOIN classifieds_pages ON classifieds_add.page_id = classifieds_pages.id
                   INNER JOIN countries ON countries.id = classifieds_add.country
                   WHERE classifieds_add.page_id = '$page_id' ");
    }

    

    public function addaddsimages($file_lid, $user_id,$page_id,$s_date,$e_date,$country)
    {
        $date = date("Y-m-d h:i:s");
        return $this->query(" INSERT INTO `classifieds_add`(`page_id`, `image_id`, `user_id`, `country`, `s_date`, `e_date`, `status`, `created_date`) VALUES ('$page_id','$file_lid','$user_id','$country','$s_date','$e_date','2','$date') ");
    }

    public function getuploadedsliderimages($f_id)
    {
      return $this->query(" select base_url from files where id = '$f_id' ");
    }

    public function deleteimage($image_id,$tab)
    {
        $this->query(" delete from files where id = '$image_id' ");

        return $this->query(" delete from $tab where image_id = '$image_id'");
    }

    public function updateaddsimages($file_lid, $user_id,$page_id,$s_date,$e_date,$country,$add_id)
    {
      return $this->query(" UPDATE `classifieds_add` SET `page_id` = $page_id,`image_id`= $file_lid,`user_id` = $user_id,`country` = $country,`s_date`='$s_date',`e_date`='$e_date',`status`= 2 WHERE id = $add_id ");
    }

    public function updateadds($user_id,$page_id,$s_date,$e_date,$country,$add_id)
    {
      return $this->query(" UPDATE `classifieds_add` SET `page_id` = $page_id,`user_id` = $user_id,`country` = $country,`s_date`='$s_date',`e_date`='$e_date',`status`= 2 WHERE id = $add_id ");
    }

    

    



}

?>