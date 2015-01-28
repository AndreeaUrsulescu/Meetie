    $(document).ready(function(){
        var profilePicture = localStorage.getItem('profilePicture');
        $('#profile').attr('src', profilePicture);
    	hovers();
    });

    function hovers(){
    	$(".invitatii").hover(function(){
    		$(this).css("background-color", "rgba(11,11,11,0.5)");
    	},function(){
    		$(this).css("background-color", "rgba(49,93,149,0.85)");
    	});
    	$(".planifica").hover(function(){
    		$(this).css("background-color", "rgba(11,11,11,0.5)");
    	},function(){
    		$(this).css("background-color", "rgba(190, 20, 20, 0.85)");
    	});
    	$(".propune").hover(function(){
    		$(this).css("background-color", "rgba(11,11,11,0.5)");
    	},function(){
    		$(this).css("background-color", "rgba(91,156,201,0.85)");
    	});
    }
