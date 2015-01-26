function initializeOAuth(){
  OAuth.initialize('T9T4EMe1xKCl-fE-Nm7srtSZang');
}

    function twitterlogin() {
		OAuth.popup('twitter', {cache:true})
		.done(function(result) {
        localStorage.setItem("network", 'twitter');
    		result.me()
    		.done(function (response) {
        		var userData = {network:"twitter",id:response.id,name:response.name};
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

  function twitterFriendsList() {
    var friends = [];
    var followers = [];
    var following = [];

    var result = OAuth.create('twitter');
    result.get('/1.1/friends/list.json?skip_status=true&include_user_entities=false')
    .done(function(data) {
      for (var i = 0; i < data.users.length; i++) {
        var friend = {id: data.users[i].id, name: data.users[i].name, picture: data.users[i].profile_image_url};
        following.push(friend);
      }

      result.get('/1.1/followers/list.json?skip_status=true&include_user_entities=false')
      .done(function(data) {
        for (var i = 0; i < data.users.length; i++) {
          var friend = {id: data.users[i].id, name: data.users[i].name, picture: data.users[i].profile_image_url};
          followers.push(friend);
        }

        for (var i = 0; i < followers.length; i++) {
          for (var j = 0; j < following.length; j++) {
            if (followers[i].id == following[j].id) {
              friends.push(followers[i]);
              break;
            }
          }
        }

        localStorage.setItem("user_friends", JSON.stringify(friends));
        populateFriendsField(1);

      }).fail(function(err) {
        console.log(JSON.stringify(err));
      });

    }).fail(function(err) {
      console.log(JSON.stringify(err));
    });
  }



  function twitterSendMessage(friendId) {
    console.log('twitterSendMessage');
    var res = OAuth.create('twitter');
    res.post('/1.1/direct_messages/new.json', {
      data: {
        text: 'Hello, I have just invited you to a meeting on Meetie. Check your page to see it.',
        user_id : friendId    //2982593771        //user_id : 2985906389
      }
    })
    .done(function(data) {
      console.log(data);
    })
    .fail(function(err) {
      console.log(err);
    });
  }

