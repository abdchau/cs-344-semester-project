var script = document.createElement('script');
script.src = 'https://code.jquery.com/jquery-3.4.1.min.js';
script.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(script);

function verifyUser(email, password){
	$.ajax({
		type:'POST', 
		url: '../model/users.php',
		data: {'email':email, 'func':'getPassword'},
		datatype: 'json',
		success: function(response){

			console.log('post success');
			console.log(response);
			response = JSON.parse(response);
			if (response===null) {
				console.log("email incorrect");
				return;
			}

			if(password===response['password'])
				console.log('Sign in successful');
			else
				console.log('Password incorrect');
		},
		error: function(){console.log('post error');}
	})
	return email+password;
}

function addUser(email, password, firstName, lastName, address){
	$.ajax({
		type:'POST', 
		url: '../model/users.php',
		data: {'email':email, 'password':password, 'func':'resetDB'},
		datatype: 'json',
		success: function(response){

			console.log('post success');
			console.log(response);
			// response = JSON.parse(response);
			// if (response===null) {
			// 	console.log("Email incorrect");
			// 	return;
			// }

			// if(password===response['password'])
			// 	console.log('Sign in successful');
			// else
			// 	console.log('Password incorrect');
		},
		error: function(){console.log('post error');}
	})
}