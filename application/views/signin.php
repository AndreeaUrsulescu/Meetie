<!DOCTYPE html>
<html>
	<head>
		<title> Twitter Log In</title>
        <script src="http://code.jquery.com/jquery-1.11.0.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo base_url('assets\scripts\oauth.js'); ?>"></script>
	</head>

	<body>
		<script>
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
             }
		</script>
        <button onclick="twitterlogin()">Twitter</button>
	</body>
</html>