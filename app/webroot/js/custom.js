$(document).ready(function() {
  var site_url = get_url();

  //js for page loading animation start
	 /*$(".animsition").animsition({
	  
		inClass               :   'fade-in-down',
		outClass              :   'fade-out-down',
		inDuration            :    1500,
		outDuration           :    800,
		linkElement           :   '.animsition-link',
		// e.g. linkElement   :   'a:not([target="_blank"]):not([href^=#])'
		loading               :    true,
		loadingParentElement  :   'body', //animsition wrapper element
		loadingClass          :   'animsition-loading',
		unSupportCss          : [ 'animation-duration',
								  '-webkit-animation-duration',
								  '-o-animation-duration'
								],
		//"unSupportCss" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
		//The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
		
		overlay               :   false,
		
		overlayClass          :   'animsition-overlay-slide',
		overlayParentElement  :   'body'
	  });*/

  //js for page loading animation end 
  
  //js for calling nice scorll start
   $("html").niceScroll({});
 //js for calling nice scorll end


/********* Mark Favorite Start ************/   
	  
	  var aid = sessionStorage.getItem("a_id");
	  if(aid != null)
	  {
	  	setTimeout(function(){ markfavorite(aid); sessionStorage.removeItem("a_id"); },3000);
	  }
    /** Save Favourite login **/
	  $("body").on("click",".remember_log,.bookmark_log", function(){
	  		var a_id = $(this).attr("main");
	  		sessionStorage.setItem("a_id",a_id);
	  		$("#login").trigger("click");
	  });

	  $("body").on("click",".remove_fav",function(){
	  	 sessionStorage.removeItem("a_id");
	  });

    /** Save Favourite**/
    $("body").on("click",".remember,.bookmark", function(){
    		var a_id = $(this).attr("main");
    		markfavorite(a_id);
    });

    /* Remove Favorite */
    $("body").on("click",".fav_remove,.bookmark_remove", function(){
    		var ad_id = $(this).attr("main");
    		$.ajax({
                url:site_url+"classifieds/removebookmark",
                type:"post",
                data:{ad_id:ad_id},
                dataType:"json",
                success: function(data)
                {
                  $("#remember_"+ad_id).removeClass("fav_remove").addClass("remember").find("i").removeClass("mark_favorite");
                $(".bookmark_remove").removeClass("bookmark_remove").addClass("bookmark").find("i").removeClass("mark_favorite");
                toastr.success('Remove Favorite Successfully');
                }
          });
    });

    $("body").on("click",".clearall_favorite", function(){
        var aid = $(this).attr("main");
        $.ajax({
                url:site_url+"users/clearfavorite",
                type:"post",
                data:{aid:aid},
                dataType:"json",
                success: function(data)
                {
                  window.location.reload();
                }
        });
    });

    /* Mark favorite */
    function markfavorite(aid)
    {
      	$.ajax({
              url:site_url+"classifieds/savebookmark",
              type:"post",
              data:{ad_id:aid},
              dataType:"json",
              success: function(data)
              {
                $("#remember_"+aid).removeClass("remember").addClass("fav_remove").find("i").addClass("mark_favorite");
                $(".bookmark").removeClass("bookmark").addClass("bookmark_remove").find("i").addClass("mark_favorite");
                toastr.success('Add Favorite Successfully');
              }
        });
        return;
    }

/********* Mark Favorite End ************/   

/********* Save Search History Start ************/ 
    var ss = sessionStorage.getItem("savesearch");
    if(ss != null)
    {
      setTimeout(function(){ savesearch();  sessionStorage.removeItem("savesearch");},3000);
    }

    /* Save Search login */  
    $("body").on("click",".save_search_log", function(){
        sessionStorage.setItem("savesearch","yes");
        $("#login").trigger("click");
    });

    /* Save Search */  
    $("body").on("click",".save_search", function(){
        savesearch();
    });

    /* Remove Session object */
    $("body").on("click",".remove_fav",function(){
       sessionStorage.removeItem("savesearch");
    });

    /* Remove saved search */
    $("body").on("click", ".remove_savesearch", function(){
        var id = $(this).attr("main");
        $.ajax({
                url:site_url+"users/removesavesearch",
                type:"post",
                data:{id:id},
                dataType:"json",
                success: function(data)
                {
                   window.location.reload();
                }
        });
    });

    /* Save Search */
    function savesearch()
    {
      var url = document.URL;
      var search = {};
      var surl = "",city = "",title = "";
      
      var keyword =  $(".input_keyword").val();
      var m_id = $(".main_category").val();
      var m_name = $(".main_category option:selected").text().trim();
      var loc = $(".region_city").val();
      var c_id = $("#hid_category").val();
      var c_name = $("#hid_category").attr("main");
      var s_id = $("#hid_subcategory").val();
      var s_name = $("#hid_subcategory").attr("main");
      var adt = $('.post_type:checked').val();
      var price1 = $('#select_price1').val();
      var price2 = $('#select_price2').val();
      var cond_type = $(".condition_type:checked").val();
      var model = $(".model").val();
      var year1 = $('#select_year1').val();
      var year2 = $('#select_year2').val();
      var fuel = "";
      $('.fuel_type:checked').each(function()
      {
         if(fuel == "")
         {
          fuel += $(this).val();
         }else
         {
          fuel += ","+$(this).val(); 
         }
      });
      
      var km1 = $('#select_km1').val();
      var km2 = $('#select_km2').val();
      var at = $(".typeofadd:checked").val();
      var fur = $(".furnished:checked").val();
      var room = "";
      $('.select_room:checked').each(function()
      {
          if(room == "")
          {
            room += $(this).val();
          }else
          {
            room += ","+$(this).val();
          }
      });

      var ms1 = $('#sort_ms1').val();
      var ms2 = $('#sort_ms2').val();
      var jt = $("#job_type").val();
      var sp = "";
      $('.salary_period:checked').each(function()
      {
          if(sp == "")
          {
            sp += $(this).val();
          }else
          {
            sp += ","+$(this).val();
          }
      });

      var sr1 = $('#salary_range1').val();
      var sr2 = $('#salary_range2').val();
      var pt = $("#position_type").val();
      var ad = $("#search_by_ad").val();

      if(loc != "")
      {
        city = loc;
      }
      
      if(m_id != "")
      {
        surl += m_name;
      }
      if(c_id != "")
      {
        surl += "/"+c_name;
      }
      if(s_id != "")
      {
        surl += "/"+s_name;
      }

      if(keyword != "")
      {
        title = keyword;
      }

      if(ad == 1)
      {
        search.AdswithPhotos = "Yes";
      }else
      {
        search.AllAds = "Yes";
      }

      if(adt != "" &&  adt != undefined)
      {
        search.AdType = (adt == 1)? "Sell" : "Buy";
      }else if(at != "" &&  at != undefined)
      {
        search.AdType = (at == 1)? "Rent" : "Sell";
      }

      if((price1 != undefined && price2 != undefined) && (price1 != "" && price2 != ""))
      {
         var pp = "from £ "+price1+" to £ "+price2;
         search.Price = pp;
      }

      if(cond_type != "" &&  cond_type != undefined)
      {
        search.Condition = (cond_type == 1)? "New":"Used";
      }

      if(model != "" && model != undefined)
      {
        search.Model = model;
      }

      if((year1 != undefined && year2 != undefined) && (year1 != "" && year2 != ""))
      {
         var yy = "from "+year1+" to "+year2;
         search.Year = yy;
      }

      if(fuel != "")
      { 
        search.Fuel = fuel;
      }

      if((km1 != undefined && km2 != undefined) && (km1 != "" && km2 != ""))
      {
         var kk = "from "+km1+" km "+" to "+km2+" km";
         search.Kilometers = kk;
      }      

      if(fur != "" &&  fur != undefined)
      {
        search.Furnished = fur;
      }

      if(room != "")
      { 
        search.Rooms = room+" rooms"; 
      }

      if((ms1 != undefined && ms2 != undefined) && (ms1 != "" && ms2 != ""))
      {
         var mms = "from "+ms1+" ms to "+ms2+" ms";
         search.Metersquare = mms;
      }

      if(jt != undefined && jt != "")
      {
        search.JobType = (jt == 1)? "Offering job" : "Seeking job";
      }

      if(sp != "")
      { 
        search.SalaryPeriod = sp;
      }

      if((sr1 != "" && sr2 != "") && (sr1 != undefined &&  sr2 != undefined))
      {
        var srr = "from £"+sr1+" to £"+sr2;
        search.salaryRange = srr;
      }
      
      if(pt != "" &&  pt != undefined)
      {
        search.PositionType = pt;
      }  
      
      $.ajax({
              url:site_url+"users/saveusersearch",
              type:"post",
              data:{title:title, surl:surl,city:city, search:search,url:url },
              dataType:"json",
              success: function(data)
              {
                toastr.success('Search save Successfully');
              }
      });

      return;      
     // window.location.href = newurl;
    }

/********* Save Search History End ************/ 

  
});