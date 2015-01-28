    $(document).ready(function(){
    	var profilePicture = localStorage.getItem('profilePicture');
        $('#profile').attr('src', profilePicture);
    });
