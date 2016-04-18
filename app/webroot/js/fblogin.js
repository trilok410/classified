window.fbAsyncInit = function() {
    FB.init({
      appId      : '1543131492663867',
      xfbml      : true,
      version    : 'v2.5'
    });
  };

(function(d){
	 var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
	 if (d.getElementById(id)) {return;}
	 js = d.createElement('script'); js.id = id; js.async = true;
	 js.src = "//connect.facebook.net/en_US/all.js";
	 ref.parentNode.insertBefore(js, ref);
}(document));

function fbLogin(){
    FB.getLoginStatus(function(response) {
     if (response.status === 'connected') {
       fbLoginDetails();
     }
     else {
      if(navigator.userAgent.match('CriOS')){
          window.open('https://www.facebook.com/dialog/oauth?client_id=1543131492663867&redirect_uri='+ document.location.href +'&scope=email,public_profile', '', null);
      }else{
         FB.login(function(response){
          if (response.status === 'connected') {
              fbLoginDetails();
          }
         },{scope: 'email,user_photos,user_videos'});
      }
     }
   });
}

if(navigator.userAgent.match('CriOS')){
    setTimeout(function(){fbLoginDetails(); },1500);
}

function fbLoginDetails(){  
  FB.getLoginStatus(function(response1) {
    if (response1.status == 'connected') {
      FB.api('/me?fields=id,name,email', function(response) {                  
          $.ajax({
          		url:get_url()+"users/fblogin",
          		type:"post",
          		data: response,
          		dataType:"json",
          		success: function(data)
          		{
          			if(data.message == "success")
                    {
                       FB.logout(function(){ console.log("logout"); });
                       window.location.reload();
                    }else
                    {
                        $(".show_error").html(data.message);
                    }
          		}	
          });
      });
    }
  });
}

function fbSignup(){
    FB.getLoginStatus(function(response) {
     if (response.status === 'connected') {
       fbSignupDetails();
     }
     else {
      if(navigator.userAgent.match('CriOS')){
          window.open('https://www.facebook.com/dialog/oauth?client_id=1605812143016049&redirect_uri='+ document.location.href +'&scope=email,public_profile', '', null);
      }else{
         FB.login(function(response){
          if (response.status === 'connected') {
              fbSignupDetails();
          }
         },{scope: 'email,user_photos,user_videos'});
      }
     }
   });

}
function fbSignupDetails(){  
  FB.api('/me?fields=id,name,email', function(response) {                  
      $.ajax({
      		url:get_url()+"users/fbsignup",
      		type:"post",
      		data: response,
      		dataType:"json",
      		success: function(data)
      		{
      			FB.logout(function(){ console.log("logout"); });
      			if(data.message == "success")
                {
                    $("#signup_form")[0].reset();
                    $(".success_msg").show();
                    setTimeout(function(){  
                       window.location.reload();
                    },2500);
                }else
                {
                    if(typeof(data.error.email) != 'undefined' )
                    {
                        $(".error_email").html(data.error.email).show();
                    } 
                    if(typeof(data.error.password) != 'undefined' )
                    {
                        $(".error_password").html(data.error.password).show();
                    }
                }
      		}	
      });
  });
}