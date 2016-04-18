<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('CakeSession', 'Model/Datasource');

class Classified extends AppModel{
   	public $name = 'Classified';
    public $useTable = 'classifieds';


/**************** Jayendra start ********************/

    public function getmaincategory()
    {
      $lang_id = CakeSession::read('lang_id');
      return $this->query(" SELECT
                  classified_maincategories.*,
                  classified_category.maincategory_id,
                  files.base_url    
                  FROM classified_maincategories 
                  LEFT JOIN files ON files.id = classified_maincategories.logo_id
                  LEFT JOIN classified_category ON classified_category.maincategory_id = classified_maincategories.m_id
                  WHERE classified_maincategories.lang_id = $lang_id AND classified_maincategories.status = 2
                  GROUP BY classified_maincategories.m_id
                  ORDER BY classified_maincategories.lead_cat ASC
                ");
    }

    public function getcategorybymid($m_id)
    {
        $lang_id = CakeSession::read('lang_id');
        return $this->query(" SELECT 
                              classified_category.*,
                              files.base_url,
                              postaddpage.page_name,
                              classified_subcategory.c_id
                              FROM classified_category
                              LEFT JOIN files ON classified_category.logo_id = files.id
                              LEFT JOIN postaddpage ON postaddpage.id = classified_category.pap_id
                              LEFT JOIN classified_subcategory ON classified_subcategory.c_id = classified_category.c_id
                              WHERE classified_category.lang_id = $lang_id AND classified_category.status = 2 AND classified_category.maincategory_id = $m_id GROUP BY classified_category.c_id 
                            ");
    }

    public function getcategory($m_id)
    {
      $lang_id = CakeSession::read('lang_id');
      return $this->query(" SELECT 
                            classified_category.*, 
                            classified_subcategory.c_id,
                            filter_page.page_name
                            FROM classified_category
                            LEFT JOIN classified_subcategory ON classified_subcategory.c_id = classified_category.c_id
                            LEFT JOIN filter_page ON filter_page.id = classified_category.filter_page
                            WHERE classified_category.lang_id = $lang_id AND classified_category.status = 2 AND classified_category.maincategory_id = $m_id GROUP BY classified_category.c_id");
    }

    public function getsubcategorybycid($c_id)
    {
        $lang_id = CakeSession::read('lang_id');
        return $this->query(" SELECT * FROM classified_subcategory WHERE lang_id = $lang_id AND status = 2 AND c_id = $c_id ");
    }

    public function getuserdata($add_id)
    {
        return $this->query(" SELECT
                       users.*
                       FROM classifieds
                       INNER JOIN users ON users.id = classifieds.user_id
                       WHERE classifieds.id = $add_id
                    ");
    }

    public function updateadview($ad_id)
    {
        $cl_view = $this->query(" SELECT classifieds.view FROM classifieds WHERE classifieds.id = $ad_id ");
        $view = (int)$cl_view[0]["classifieds"]["view"];
        $view = $view + 1;
        $this->query(" UPDATE classifieds SET view = $view WHERE classifieds.id = $ad_id ");
        return $view;
    }

    public function getadddetail($add_id)
    {
      $lang_id = CakeSession::read('lang_id');
      return $this->query(" SELECT 
                            classifieds.*,
                            users.email,
                            users.created_date,
                            users.name,
                            classified_maincategories.maincategory,
                            classified_category.category,
                            (SELECT classified_subcategory.subcategory FROM classifieds LEFT JOIN classified_subcategory ON classified_subcategory.s_id = classifieds.s_id WHERE classifieds.id = $add_id AND classified_subcategory.lang_id = $lang_id) as subcategory,
                            files.base_url                            
                            FROM classifieds
                            LEFT JOIN users ON users.id = classifieds.user_id
                            LEFT JOIN classified_maincategories ON classified_maincategories.m_id = classifieds.m_id
                            LEFT JOIN classified_category ON classified_category.c_id = classifieds.c_id
                            LEFT JOIN files ON files.id = classifieds.logo_id
                            WHERE classifieds.id = $add_id AND classifieds.status = 2 AND classified_maincategories.lang_id = $lang_id AND classified_category.lang_id = $lang_id
                          ");
    }

    public function getadview($add_id)
    {
      $lang_id = CakeSession::read('lang_id');
      return $this->query(" SELECT 
                            classifieds.*,
                            users.email,
                            users.created_date,
                            users.name,
                            classified_maincategories.maincategory,
                            classified_category.category,
                            (SELECT classified_subcategory.subcategory FROM classifieds LEFT JOIN classified_subcategory ON classified_subcategory.s_id = classifieds.s_id WHERE classifieds.id = $add_id AND classified_subcategory.lang_id = $lang_id) as subcategory,
                            files.base_url                            
                            FROM classifieds
                            LEFT JOIN users ON users.id = classifieds.user_id
                            LEFT JOIN classified_maincategories ON classified_maincategories.m_id = classifieds.m_id
                            LEFT JOIN classified_category ON classified_category.c_id = classifieds.c_id
                            LEFT JOIN files ON files.id = classifieds.logo_id
                            WHERE classifieds.id = $add_id AND classified_maincategories.lang_id = $lang_id AND classified_category.lang_id = $lang_id
                          ");
    }

    public function getuserad($id,$ad_id)
    {
      $lang_id = CakeSession::read('lang_id');
      return $this->query(" SELECT 
                            classifieds.*,
                            classifieds.id as add_id,
                            users.email,
                            users.created_date,
                            users.name,
                            classified_maincategories.maincategory,
                            classified_category.category,
                            (SELECT classified_subcategory.subcategory FROM classifieds LEFT JOIN classified_subcategory ON classified_subcategory.s_id = classifieds.s_id WHERE classifieds.id = add_id AND classified_subcategory.lang_id = $lang_id) as subcategory,
                            files.base_url,
                            (SELECT files.base_url FROM classifieds
                            INNER JOIN classified_category ON classified_category.c_id = classifieds.c_id 
                            LEFT JOIN files ON files.id = classified_category.logo_id
                            WHERE classifieds.id = add_id AND classified_category.lang_id = $lang_id) as category_image
                            FROM classifieds 
                            LEFT JOIN users ON users.id = classifieds.user_id
                            LEFT JOIN classified_maincategories ON classified_maincategories.m_id = classifieds.m_id
                            LEFT JOIN classified_category ON classified_category.c_id = classifieds.c_id
                            LEFT JOIN files ON files.id = classifieds.logo_id
                            WHERE classifieds.id != $ad_id AND classifieds.user_id = $id AND classifieds.status = 2 AND classified_maincategories.lang_id = $lang_id AND classified_category.lang_id = $lang_id
                          ");
    }

    public function getaddimages($add_id)
    {
      return $this->query(" SELECT 
                            files.base_url,
                            classifiedimages.logo_id
                            FROM classifiedimages
                            LEFT JOIN files ON files.id = classifiedimages.logo_id
                            WHERE classifiedimages.add_id = $add_id
                          ");
    }

    public function getpremiumad()
    {
       $lang_id = CakeSession::read('lang_id');
       $date = date("Y-m-d");
       return $this->query("SELECT 
                            classifieds.*,
                            classified_maincategories.maincategory,
                            classified_category.category,
                            files.base_url                            
                            FROM classifieds
                            LEFT JOIN classified_maincategories ON classified_maincategories.m_id = classifieds.m_id
                            LEFT JOIN classified_category ON classified_category.c_id = classifieds.c_id
                            LEFT JOIN files ON files.id = classifieds.logo_id
                            WHERE classifieds.status = 2 AND classifieds.gallery = 1 AND classifieds.gallery_date >= '$date'
                            AND classified_maincategories.lang_id = $lang_id
                            AND classified_category.lang_id = $lang_id
                            ORDER BY RAND()
                            LIMIT 0,6
                         ");
    }

    public function getlatestad()
    {
       $lang_id = CakeSession::read('lang_id');
       return $this->query("SELECT 
                            classifieds.*,
                            classified_maincategories.maincategory,
                            classified_category.category,
                            files.base_url                            
                            FROM classifieds
                            LEFT JOIN classified_maincategories ON classified_maincategories.m_id = classifieds.m_id
                            LEFT JOIN classified_category ON classified_category.c_id = classifieds.c_id
                            LEFT JOIN files ON files.id = classifieds.logo_id
                            WHERE classifieds.status = 2 
                            AND classified_maincategories.lang_id = $lang_id
                            AND classified_category.lang_id = $lang_id
                            ORDER BY classifieds.create_date DESC
                            LIMIT 0,6
                         ");
    }

    public function getsubcategorybymid($m_id)
    {
        $lang_id = CakeSession::read('lang_id');
        return $this->query(" SELECT * FROM classified_subcategory WHERE lang_id = $lang_id AND status = 2 AND main_id = $m_id ");
    }

    public function searchmaincategory($mstr)
    {
      $lang_id = CakeSession::read('lang_id');
      
      return $this->query(" SELECT
                  classified_maincategories.maincategory,
                  classified_maincategories.m_id as mm_id,
                  (SELECT count(`m_id`) as record FROM `classifieds` WHERE `m_id` = mm_id $mstr) as record,
                  files.base_url
                  FROM classified_maincategories 
                  LEFT JOIN files ON files.id = classified_maincategories.logo_id
                  WHERE classified_maincategories.lang_id = $lang_id AND classified_maincategories.status = 2
                  GROUP BY classified_maincategories.m_id
                  ORDER BY classified_maincategories.lead_cat ASC
                ");
    }

    public function searchadds($dstr,$ad,$un,$off,$order,$radius)
    {
        $lang_id = CakeSession::read('lang_id');
        return $this->query(" SELECT 
                            classifieds.*,
                            classifieds.id as add_id,
                            ( 6371 * acos( cos( radians(37) ) * cos( radians( classifieds.lat ) ) * cos( radians( classifieds.lng ) - radians(-122) ) + sin( radians(37) ) * sin( radians( classifieds.lat ) ) ) ) AS distance,
                            classified_maincategories.maincategory,
                            classified_category.category,
                            (SELECT classified_subcategory.subcategory FROM classifieds LEFT JOIN classified_subcategory ON classified_subcategory.s_id = classifieds.s_id WHERE classifieds.id = add_id AND classified_subcategory.lang_id = $lang_id) as subcategory,
                            files.base_url,
                            (SELECT files.base_url FROM classifieds INNER JOIN classified_maincategories ON classified_maincategories.m_id = classifieds.m_id LEFT JOIN files ON files.id = classified_maincategories.logo_id WHERE classifieds.id = add_id AND classified_maincategories.lang_id = $lang_id) as category_image,
                            filter_page.page_name
                            FROM classifieds 
                            LEFT JOIN classified_maincategories ON classified_maincategories.m_id = classifieds.m_id
                            LEFT JOIN classified_category ON classified_category.c_id = classifieds.c_id
                            LEFT JOIN files ON files.id = classifieds.logo_id
                            LEFT JOIN filter_page ON filter_page.id = classified_category.filter_page
                            WHERE classifieds.status = 2 AND classified_maincategories.lang_id = $lang_id AND classified_category.lang_id = $lang_id $dstr $ad $un
                            $radius
                            $order
                            $off
                          ");
    }

    public function getcountry()
    {
        return $this->query(" SELECT * FROM countries");
    }

    public function getstates($c_id)
    {
        return $this->query(" SELECT * FROM states WHERE c_id = $c_id ");
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
    
    public function getadddata($add_id)
    {
        $lang_id = CakeSession::read('lang_id');
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

    public function deleteaddimages($add_id)
    {
      return $this->query(" DELETE FROM `classifiedimages` WHERE add_id = $add_id ");
    }

    public function getlocations($loc)
    {
      return $this->query(" SELECT DISTINCT `zipcode`,`city` FROM `classifieds` WHERE `zipcode` LIKE '$loc%' OR `city` LIKE '$loc%' ");
    }

    public function getmaincat($m_id)
    {
       $lang_id = CakeSession::read('lang_id');
       return $this->query(" SELECT 
                             classified_category.c_id,
                             classified_category.category,
                             classified_category.filter_page,
                             filter_page.page_name
                             FROM classified_category
                             LEFT JOIN filter_page ON filter_page.id = classified_category.filter_page
                             WHERE classified_category.maincategory_id = $m_id AND classified_category.status = 2 AND classified_category.lang_id = $lang_id
                             GROUP BY classified_category.c_id
                          ");
    }

    public function getsubcatbycid($c_id)
    {
        $lang_id = CakeSession::read('lang_id');
        return $this->query(" SELECT
                              classified_subcategory.s_id,
                              classified_subcategory.subcategory
                              FROM classified_subcategory
                              WHERE lang_id = $lang_id AND status = 2 AND c_id = $c_id 
                          ");
    }

    public function getallcountry()
    {
        return $this->query(" SELECT * FROM `countries` WHERE countries.status = 2 ");
    }

    public function getsearchstates($cid)
    {
      return $this->query(" SELECT
                            states.id,
                            states.name
                            FROM countries
                            INNER JOIN states ON states.c_id = countries.id
                            WHERE countries.id = $cid AND countries.status = 2 AND states.status = 2
                        ");
    }

    public function getcitylist($s_id)
    {
       return $this->query(" SELECT * FROM city WHERE s_id = $s_id ");
    }

    public function adtxnid($ad_id,$txn_id)
    {
      $date = date("Y-m-d H:i:s");
      return $this->query("INSERT INTO ad_txnid (ad_id,txn_id,created_date) VALUES ($ad_id,'$txn_id','$date') ");
    }

    public function getadtxnid($add_id)
    {
        return $this->query("SELECT txn_id FROM ad_txnid WHERE ad_id = $add_id ");
    }

    public function getmettags($tab,$col,$val)
    {
        return $this->query(" SELECT meta_description,meta_keyword, meta_title FROM  $tab WHERE $col = '$val' AND lang_id = 1 ");
    }

    

/********************* Jayendra end *********************/    

    /* COMMON FUNCTION   */

    

    public function getsubcategory()
    {
        $lang_id = CakeSession::read('lang_id');
        return $this->query(" SELECT * FROM classified_subcategory WHERE lang_id = $lang_id AND status = 2 ");
    }

	  

    public function getcityname($city_id)
    {
        return $this->query(" SELECT city_name FROM countries_state_city WHERE id = $city_id ");
    }

   
    public function searchresult($final,$off)
    {
      return $this->query(" SELECT
                            classifieds.*,
                            files.base_url
                            FROM classifieds
                            LEFT JOIN files ON files.id = classifieds.logo_id
                            $final
                            ORDER BY classifieds.create_date DESC
                            $off
                         ");
    }

    public function searchbyfilter($final,$od,$off)
    {
      return $this->query(" SELECT
                            classifieds.*,
                            files.base_url
                            FROM classifieds
                            LEFT JOIN files ON files.id = classifieds.logo_id
                            $final
                            $od
                            $off
                         ");
    }

    

    public function getmaincategorycount()
    {
       $main_count1 = $this->query(" SELECT count(`m_id`) as m ,`m_id` FROM `classifieds` WHERE `status` = 2 GROUP BY `m_id` ");
       
       $main_count = array();
       
       foreach($main_count1 as $mcat)
       {
            $main_count[$mcat["classifieds"]["m_id"]] = $mcat[0]["m"];
       }

       return $main_count;
    }
    

    public function getcategorycount()
    {
       $category_count1 = $this->query(" SELECT `c_id`, count(`c_id`) as c FROM `classifieds` WHERE status = 2 Group By `c_id` ");
    
        $category_count = array();
       
       foreach($category_count1 as $cat)
       {
            $category_count[$cat["classifieds"]["c_id"]] = $cat[0]["c"];
       }

       return $category_count;

    }

    public function getsubcategorycount()
    {
      $subcategory_count1 = $this->query(" SELECT `s_id`, count(`s_id`) as c FROM `classifieds` WHERE status = 2 Group By `s_id` ");
    
        $subcategory_count = array();
       
       foreach($subcategory_count1 as $sub)
       {
            $subcategory_count[$sub["classifieds"]["s_id"]] = $sub[0]["c"];
       }

       return $subcategory_count;
    }

    /* COMMON FUNCTION   */

    public function getallplace()
    {
        return $this->query(" SELECT `city`, count(`city`) as number FROM `classifieds` where `status` = 2  group by `city` order by `city` asc ");
    }

    public function getaddsubcategory($add_id)
    {
      $lang_id = CakeSession::read('lang_id');
      return $this->query(" SELECT
                            classified_subcategory.subcategory
                            FROM classifieds
                            RIGHT JOIN classified_subcategory ON classified_subcategory.s_id = classifieds.s_id
                            WHERE classifieds.id = $add_id AND classified_subcategory.lang_id = $lang_id
                          ");
    }


    public function myaddcategory($user_id)
    {
      $lang_id = CakeSession::read('lang_id');
      return $this->query(" SELECT
                            count(classifieds.c_id) as c,
                            classifieds.c_id,
                            classified_category.category  
                            FROM classifieds
                            INNER JOIN classified_category ON classified_category.c_id = classifieds.c_id 
                            WHERE classifieds.user_id = $user_id AND classifieds.status = 2 AND classified_category.lang_id = $lang_id 
                            GROUP BY classifieds.c_id

                            ");
    }

    public function myaddsubcategory($user_id)
    {
        $lang_id = CakeSession::read('lang_id');
        return $this->query(" SELECT
                              count(classifieds.s_id) as s,
                              classifieds.c_id,
                              classifieds.s_id, 
                              classified_subcategory.subcategory  
                              FROM classifieds
                              LEFT JOIN classified_subcategory ON classified_subcategory.s_id = classifieds.s_id 
                              WHERE classifieds.user_id = $user_id AND classifieds.status = 2 AND classified_subcategory.lang_id = $lang_id 
                              GROUP BY classifieds.s_id

                              ");
    }


    

    

    public function getadds($page_id)
    {
      $user = CakeSession::read('user');
      $id = (int) $user["id"];
      $c = $this->query(" SELECT country FROM users WHERE id  = $id ");
      
      $cont = (int) $c[0]["users"]["country"];
      $date = date('Y-m-d');

      return $this->query(" SELECT
                       files.base_url,
                       classifieds_add.image_id,
                       classifieds_add.user_id
                       FROM classifieds_add
                       LEFT JOIN files ON classifieds_add.image_id = files.id
                       WHERE classifieds_add.page_id = '$page_id' AND classifieds_add.status = '2' AND classifieds_add.country = $cont AND classifieds_add.s_date <= '$date' AND classifieds_add.e_date >= '$date'
                       ");
    }

    public function gettopclassified()
    {
        return $this->query(" SELECT
                            classifieds.*,
                            files.base_url
                            FROM classifieds
                            LEFT JOIN files ON files.id = classifieds.logo_id
                            WHERE classifieds.mode = 'top'
                            ORDER BY classifieds.create_date DESC
                         ");
    }

    


}

?>