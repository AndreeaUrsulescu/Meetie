var nrOfInvitationReplies = [];
var myPos;
var networkUserId;

function searchByFields() {
	var searchFields = [];
	var searchValues = [];
	var result = [];

	if ((invitations != "You have no invitations!") && (invitations != "You have no created meetings!")) {
		if ($('#searchByTitle').val().trim() != '') {
			searchValues.push($('#searchByTitle').val().trim());
			searchFields.push("title");
			$('#searchByTitle').val('');
		}

		if ($('#searchByCreator').val().trim() != '') {
			searchValues.push($('#searchByCreator').val().trim());
			searchFields.push("creator_name");
			$('#searchByCreator').val('');
		}

		if ($('#searchByType').val().trim() != '') {
			searchValues.push($('#searchByType').val().trim());
			searchFields.push("type");
			$('#searchByType').val('');
		}

		for (var i = 0; i < invitations.length; i++) {
			if (isInvitationMatched(invitations[i], searchFields, searchValues) == true) {
				result.push(invitations[i]);
			}
		}		
	}
	generate(result);
}

function sendFinalResponse(element) {
	var invitationId = $(element).attr('data-invitationId');
	var network = localStorage.getItem('network');
	var invitedPersonsIds = [];
	$(element).prop('disabled', true);

	for (var i = 0; i < invitations.length; i++) {
		if (invitations[i]['id'] == invitationId) {
			for (var j = 0; j < invitations[i]['invitedPers'].length; j++) {
				invitedPersonsIds.push(invitations[i]['invitedPers'][j]['userNetworkId']);
			}
			break;
		}
	}

	if (network === 'facebook') {
			
	}
	else if (network === 'google_plus') {
		var invitedPersons = '';

		for (var i = 0; i < invitedPersonsIds.length - 1; i++) {
			invitedPersons = invitedPersons.concat(invitedPersonsIds[i] + ',');
		}

		invitedPersons = invitedPersons.concat(invitedPersonsIds[invitedPersonsIds.length - 1]);
		var text = $(element).siblings('textarea').val();
		var options = {
			contenturl : 'http://webprojects.dev/meetie/index.php/home',
			clientid : '552747617031-iq9hg8hgm56mtd2jdn9uv4neit9tvhkr.apps.googleusercontent.com',
			calltoactionurl : 'http://webprojects.dev/meetie/index.php/home',
			cookiepolicy : 'none',
			prefilltext : text,
			recipients : invitedPersons
		};

		gapi.interactivepost.render('sharePost', options);
		$('#sharePost').click();
	}
	else if (network === 'twitter') {
		for (var i = 0; i < invitedPersonsIds.length; i++) {
			var text = $(element).siblings('textarea').val();
			console.log(text);
	 		twitterSendMessage(invitedPersonsIds[i], text);
	 	}
	}
}


function generate(invitations){

	$("#impar").empty();
	$("#par").empty();

	var stanga = $("#impar");
	var dreapta = $("#par");
	var breakpoint = $('<br/>');

    console.log('network id ' + networkUserId);

    for ( var i = 0 ; i < invitations.length ; i++){

        var contact = $('<div class="contact"></div>');
        var title = $('</br><label class="toMiddle dTitle">'+ invitations[i]['title'] + '</label></br>');
        title.appendTo(contact);

        breakpoint.appendTo(contact);
        breakpoint.appendTo(contact);

        var description = $('<p class="toMiddle">'+ invitations[i]['description'] + '</p>');
        description.appendTo(contact);

        var creatorResponse = $('<textarea id="finalResponse" data-invitationId="' + invitations[i]['id'] + '" class="motiv toMiddle"></textarea><br/>');
        var send = $('<a data-invitationId="' + invitations[i]['id'] + '" class="sendButton toMiddle" onclick="sendFinalResponse(this)">Send response</a><br/><br/>');
        var titleLabel = $('<label class="reasonLabel toMiddle">Your decision regarding the meeting</label><br/>');

        titleLabel.appendTo(contact);
        creatorResponse.appendTo(contact);
        send.appendTo(contact);

        var tableHead = $('<table class="toMiddle little"><tr class="tableHead toMiddle little"></tr></table>');
        //console.log(invitations[i]);
        for (var j = 0; j < invitations[i]['times'].length; j++) {
        	var dateParts = invitations[i]['times'][j].split(new RegExp("\\s+"));
        	var dateAndTime = $('<td><label>' + dateParts[0] + '</label><br/><label>' + dateParts[1] + '</label></td>');
        	dateAndTime.appendTo(tableHead);
        }
        var notComming = $('<td><label>Not comming</label></td>');
	    notComming.appendTo(tableHead);


        var deadline = $('<label style="display:inline" class="toMiddle">Deadline: '+ invitations[i]['deadline'] + '</label>');
        deadline.appendTo(contact);
        tableHead.appendTo(contact);

        breakpoint.appendTo(contact);
        breakpoint.appendTo(contact);   

        var table = $('<table class="toMiddle" border="1"><tbody></tbody></table></br></br>');

        for ( var contor = 0 ; contor < invitations[i]['invitedPers'].length; contor++){
	        	var line;
	        	line = populateTable(invitations[i], contor);

	            line.appendTo(table);
        }

        table.appendTo(contact);
        
 	    var tableFooter = $('<table class="toMiddle little" ><tr class="tableFooter little"></tr></table>');
       
        for (var cont = 0; cont < invitations[i]['times'].length; cont++) {
        	for (var k = 0; k < nrOfInvitationReplies.length; k++) {
        		if ((nrOfInvitationReplies[k]['invitation_id'] == invitations[i]['id']) && (nrOfInvitationReplies[k]['time'] == invitations[i]['times'][cont])) {
        			var dateAndTime = $('<td><label  style="margin-right: 7px; margin-left: 5px">' + nrOfInvitationReplies[k]['value'] + ' votes</label><br/></td>');
        			dateAndTime.appendTo(tableFooter);
        		}
        	}
        }
        for (var k = 0; k < nrOfInvitationReplies.length; k++) {
        	if ((nrOfInvitationReplies[k]['time'] == "Not comming") && (nrOfInvitationReplies[k]['invitation_id'] == invitations[i]['id'])) {
        		var dateAndTime = $('<td><label>' + nrOfInvitationReplies[k]['value'] + ' votes</label><br/></td>');
        		dateAndTime.appendTo(tableFooter);
        	}
        }


        tableFooter.appendTo(contact);

        if( i%2 == 0 )
 	    	contact.appendTo(dreapta);
 		else
 	    	contact.appendTo(stanga);
    }
}

function populateTable(invitation, position){
	console.log('invitation in populate table ');
	console.log(invitation['invitedPers']);
	console.log(position);
	var line = $('<tr></tr>');
	var name = $('<td width="180">'+ invitation['invitedPers'][position]['name']+'</td>');
	name.appendTo(line);

	for ( var contor1 = 0 ; contor1 < invitation['times'].length ; contor1++){
		var column = $('<td width="50" height="30"></td>');;
	    var input = $('<input data-invitationId="' + invitation['id'] + '" data-meetingTime="' + invitation['times'][contor1] + '" type="checkbox" />');
	    
        $(input).prop('disabled',true);
        

	    if (invitation['invitedPers'][position]['response'] == invitation['times'][contor1]){
	        $(input).prop('checked',true);
	    }
	    
	    input.appendTo(column);
	    column.appendTo(line);
	}

	var column = $('<td width="40" height="30"></td>');;
	    var input = $('<input data-invitationId="' + invitation['id'] + '" data-meetingTime="Not comming" type="checkbox" />');
        $(input).prop('disabled',true);
        
	    if (invitation['invitedPers'][position]['response'] == "Not comming"){
	        $(input).prop('checked',true);
	    }
	    
	    input.appendTo(column);
	    column.appendTo(line);

    return line;
}

function isInvitationMatched(invitation, searchFields, searchValues) {

	for (var i = 0; i < searchFields.length; i++) {
		var invitationComponents = invitation[searchFields[i]].split(new RegExp("\\s+"));
		var searchValueComponents = searchValues[i].split(new RegExp("\\s+"));

		if (searchValueComponents.length == 1) {
			var matched = false;

			for (var contor2 = 0; contor2 < invitationComponents.length; contor2++) {
				if (invitationComponents[contor2].substring(0, searchValueComponents[0].length).toLowerCase() === searchValueComponents[0].toLowerCase()) {
					matched = true;
					break;
				}
			}

			if (matched == false) {
				return false;
			}
		}
		else {
			var matchedComponents = 0;

			for (var contor1 = 0; contor1 < searchValueComponents.length; contor1++) {
				var matched = false;
				for (var contor2 = 0; contor2 < invitationComponents.length; contor2++) {
					if (searchValueComponents[contor1].toLowerCase() == invitationComponents[contor2].toLowerCase()) {
						matched = true;
						break;
					}
				}

				if (matched == true) {
					matchedComponents++;
				}
			}

			if (matchedComponents < searchValueComponents.length) {
				return false;
			}
		}
	}

	return true;
}

function getNetworkId(){
  
   $.ajax({
	    url:'/meetie/index.php/invitations/getUserNetworkId',
	    type: 'GET',
	    success: function(data){
	       networkUserId = $.parseJSON(data);
	       console.log(invitations);
	       if ((invitations != "You have no invitations!") && (invitations != "You have no created meetings!")) {
		   		countVotesForTimes();
           		generate(invitations);
       		}
       		else
       		{
       			console.log('Nu e nimic in bd');
       		}
	    },
	    error: function(){
	    	console.log("Fail");
	    }
	});

}


function sendInvitationReply(invitationId, timeOfMeeting){

	$.ajax({
	    url:'/meetie/index.php/invitations/storeInvitationReply',
	    type: 'POST',
	    data : {
	    	'invitation_id' : invitationId,
	    	'timeOfMeeting' : timeOfMeeting
	    },
	    success: function(){
	    },
	    error: function(){
	    	console.log("Fail");
	    }
	});	
}

function updateReplies(invId, time,type) {
	for (var i = 0; i < nrOfInvitationReplies.length; i++) {
		if ((nrOfInvitationReplies[i]['invitation_id'] == invId) && (type=="increment")) {
			nrOfInvitationReplies[i]['times'][time]++;
			break;
		}
		if ((nrOfInvitationReplies[i]['invitation_id'] == invId) && (type=="decrement")) {
			nrOfInvitationReplies[i]['times'][time]--;
			break;
		}
	}
}

function countVotesForTimes() {
	var times = [];
	if ((invitations != "You have no invitations!") && (invitations != "You have no created meetings!")) {
		for (var contor = 0; contor < invitations.length; contor++) {
			for (var i = 0; i < invitations[contor]['times'].length; i++) {
				var a = {
					'invitation_id' : invitations[contor]['id'],
					'time' : invitations[contor]['times'][i],
					'value' : 0};
				times.push(a);
			}
			var a = {
				'invitation_id' : invitations[contor]['id'],
				'time' : "Not comming",
				'value' : 0};
			times.push(a);

			for (var i = 0; i < invitations[contor]['invitedPers'].length; i++) {
				if (invitations[contor]['invitedPers'][i]['response'] != null) {
					for (var j = 0; j < times.length; j++) {
						if ((times[j]['invitation_id'] == invitations[contor]['id']) && (times[j]['time'] == invitations[contor]['invitedPers'][i]['response'])) {
							times[j]['value']++;
						}
					}
				}
			}
		}
	}
	nrOfInvitationReplies = times;
	console.log('nrOfInvitationReplies');
	console.log(nrOfInvitationReplies);
}