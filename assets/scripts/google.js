function initializeOAuthGoogle(){
	OAuth.initialize('T9T4EMe1xKCl-fE-Nm7srtSZang');
}

function googleLogin() {
	OAuth.popup('google_plus', {cache:true, scope:'https://www.googleapis.com/auth/plus.login'})
	.done(function(result) {
	    localStorage.setItem("network", 'google_plus');
	    result.me()
	    .done(function (response) {
	    	var userData = {network:"google_plus",id:response.id,name:response.name};
	        redirectToHome(userData);
	    })
	    .fail(function (err) {
	     	console.log(err);
	    });
	})
	.fail(function (err) {
		console.log(err);
	});
}

function googleFriendsList() {
    var friends = [];
    var result = OAuth.create('google_plus');
    result.get('/plus/v1/people/me/people/visible')
    .done(function(data) {
    	console.log(data);
      for (var i = 0; i < data.items.length; i++) {
        var friend = {id: data.items[i].id, name: data.items[i].displayName, picture: data.items[i].image.url};
        friends.push(friend);
      }
      localStorage.setItem("user_friends", JSON.stringify(friends));
      populateFriendsField(1);
    }).fail(function(err) {
      console.log(JSON.stringify(err));
    });
  }