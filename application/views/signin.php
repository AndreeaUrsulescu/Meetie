<!DOCTYPE html>
<html>
	<head>
		<title> Twitter Log In</title>
        <script src="http://code.jquery.com/jquery-1.11.0.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo base_url('assets\scripts\oauth.js'); ?>"></script>
	</head>

	<body>
		<script>
			//$(document).ready(function () {
                console.log('in function');
                // Initialize with your OAuth.io app public key
                 OAuth.initialize('T9T4EMe1xKCl-fE-Nm7srtSZang');
                 function twitterlogin() {

                OAuth.popup('twitter', function(err, res) {
                    var text = encodeURIComponent('Salut Corbuletule! :*');
                    var username = encodeURIComponent('Corbu_Oana');
                res.post('/1.1/direct_messages/new.json', {
                    data: {
                        text: 'Salut Corbuletule! :*',
                        screen_name: 'Corbu_Oana'
                    }
                }).done(function(data) {
                    console.log(data);
                }).fail(function(err) {
                    console.log(err);
                })
            });



        //                  OAuth.popup('twitter')
        //                 .done(function(result) {
        //               //use result.access_token in your API request 
        //               //or use result.get|post|put|del|patch|me methods (see below)
        //               console.log(result);
                      
        //             })
        //             .fail(function (err) {
        //       //handle error with err
        //                 console.log(err);
        // });



            // OAuth.popup('twitter', function(err, res) {
            //     res.get('/1.1/friends/list.json').done(function(data) {
            //         console.log(data);
            //     })
            // })


             }
		</script>
        <button onclick="twitterlogin()">Twitter</button>
	</body>
</html>