 window.fbAsyncInit = function() {
	FB.init({
	    appId      : '1520377664890574',
	    cookie     : true,  
	    xfbml      : true,  // parse social plugins on this page
	   	version    : 'v2.2' 
	});
};


 function facebookStatusChangeCallback(response) {
	console.log('statusChangeCallback');
	console.log(response);

	if (response.status === 'connected') {
	} else if (response.status === 'not_authorized') {
	    document.getElementById('status').innerHTML = 'Please log ' +
	        'into this app.';
	} else {
	    document.getElementById('status').innerHTML = 'Please log ' +
	        'into Facebook.';
	}
}

function facebookCheckLoginState() {
    FB.getLoginStatus(function(response) {
        facebookStatusChangeCallback(response);
    });
}

function logInWithFacebook() {
	FB.login(function(response) {
    	if (response.status === 'connected') {
    		localStorage.setItem("userKey", response.authResponse.accessToken);
		    // Logged into your app and Facebook.
		    console.log('connected fb');
		    localStorage.setItem("network", 'facebook');
		    facebookGetUserInfo();
		    //sendMail();
		} else if (response.status === 'not_authorized') {
		    // The person is logged into Facebook, but not your app.
		    console.log('not_authorized fb');
		} else {

		}
	}, {scope: 'email, user_friends,publish_actions'});
}

function facebookGetUserInfo() {
	FB.api('/me', function(response) {
		var userData = {network:"facebook",id:response.id,name:response.name,email:response.email};
		redirectToHome(userData);
	});
}

function facebookFriendsList() {
	var result = [];
	var key = localStorage.getItem("userKey");
	FB.api("/me/friends?access_token="+key, {fields: 'id, name, picture, email'},
    	function (response) {
      		if (response && !response.error) {
        		for (var i = 0; i < response.data.length; i++) {
        			var friend = {id:response.data[i].id, name:response.data[i].name, picture:response.data[i].picture.data.url, email:response.data[i].email};
        			result.push(friend);
        			console.log(response.data[i].email);
        		}
        		localStorage.setItem("user_friends", JSON.stringify(result));
      			populateFriendsField(1);
      		}
    	}
	);
}

// Load the SDK asynchronously
(function(d, s, id) {
   	var js, fjs = d.getElementsByTagName(s)[0];

   	if (d.getElementById(id)) return;
   	js = d.createElement(s); js.id = id;
   	js.src = "//connect.facebook.net/en_US/sdk.js";
   	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));