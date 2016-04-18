<?php 

App::uses("AppHelper","View/Helper");
App::import("Model", "Classifiedmaincategory");

class MetaHelper extends AppHelper {
	
	public function getmeta()
	{
		$clf = new Classified();
		$meta_words = "";
		$cat = array();
		$city = (isset($_GET["city"]) && !empty($_GET["city"]))? $_GET["city"] : "";
		$city = (isset($_GET["pm"]) && !empty($_GET["pm"]))? $_GET["pm"] : "";
		$keywords = (isset($_GET["keyword"]) && !empty($_GET["keyword"]))? $_GET["keyword"] : "";
		
		if(isset($_GET["s_id"]) && !empty($_GET["s_id"]))
		{
			$data = $clf->getmettags("classified_subcategory","s_id",$_GET["s_id"]);
			$cat = $data[0]["classified_subcategory"];		
		}else if(isset($_GET["c_id"]) && !empty($_GET["c_id"]))
		{
			$data = $clf->getmettags("classified_category","c_id",$_GET["c_id"]);
			$cat = $data[0]["classified_category"];
		}else if(isset($_GET["m_id"]) && !empty($_GET["m_id"]))
		{
			$data = $clf->getmettags("classified_maincategories","m_id",$_GET["m_id"]);
			$cat = $data[0]["classified_maincategories"];
		}

		if(!empty($cat))
		{
			$meta_words .= '<title>'.str_replace("{keyword}", $keywords, str_replace("{city}", $city, $cat["meta_title"])).'</title>';
			$meta_words .= '<meta name="description" content="'.str_replace("{keyword}", $keywords, str_replace("{city}", $city, $cat["meta_description"])).'"/>';
			$meta_words .= '<meta name="keywords" content="'.str_replace("{keyword}", $keywords, str_replace("{city}", $city, $cat["meta_keyword"])).'">';
		}else if(!empty($city))
		{	
			$kw = (!empty($keywords))? $keywords : "Classifieds";
			$meta_words .= '<title>'.$kw." in ".$city.'</title>';
			$meta_words .= '<meta name="description" content="'.$kw." in ".$city.'"/>';
			$meta_words .= '<meta name="keywords" content="'.$kw.",".$city.'">';
		}else if(!empty($keywords))
		{
			$meta_words .= '<title>'.$keywords.' in Classified</title>';
			$meta_words .= '<meta name="description" content="'.$keywords.' in Classified"/>';
			$meta_words .= '<meta name="keywords" content="'.$keywords.'">';
		}else
		{
			$meta_words .= '<title>Classified</title>';
			$meta_words .= '<meta name="description" content="Classified"/>';
			$meta_words .= '<meta name="keywords" content="Classified">';
		}

		return $meta_words; 
	}

	function changename($name)
	{
		$jay = str_ireplace(" & ","-",$name);
		$jay = str_ireplace(" ","-",$jay); 
		return $jay;
	}
}



 ?>