var script = document.createElement('script');
script.src = 'https://code.jquery.com/jquery-3.4.1.min.js';
script.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(script);

function verifyUser(username, password)
{
	$.ajax({
		type:'POST', 
		url: '../model/users.php',
		data: {'username':username, 'func':'getPassword'},
		datatype: 'json',
		success: function(response){

			console.log('post success');
			console.log(response);
			response = JSON.parse(response);
			if (response===null) {
				console.log("Username incorrect");
				return;
			}

			if(password===response['password'])
				console.log('Sign in successful');
			else
				console.log('Password incorrect');
		},
		error: function(){console.log('post error');}
	})
	return username+password;
}

function addUser(username, password) {
	$.ajax({
		type:'POST', 
		url: '../model/users.php',
		data: {'username':username, 'password':password, 'func':'addUser'},
		datatype: 'json',
		success: function(response){

			console.log('post success');
			console.log(response);
			// response = JSON.parse(response);
			// if (response===null) {
			// 	console.log("Username incorrect");
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