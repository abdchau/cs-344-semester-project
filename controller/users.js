var script = document.createElement('script');
script.src = '../controller/jquery.js';
script.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(script);

//================START COOKIE CODE==================
function setCookie(cname, cvalue, exhours){
  var d = new Date();
  d.setTime(d.getTime() + (exhours * 60 * 60 * 1000));
  var expires = "expires="+d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname){
  var name = cname + "=";
  var ca = document.cookie.split(';');
  for(var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function checkCookie() {
  var user = getCookie("username");
  if (user != "") {
    alert("Welcome again " + user);
  } else {
    user = prompt("Please enter your name:", "");
    if (user != "" && user != null) {
      setCookie("username", user, 365);
    }
  }
}
//=================END COOKIE CODE===================

function verifyUser(email, password){
	$.ajax({
		type:'POST', 
		url: '../model/interface.php',
		data: {user:{'email':email}, 'func':'getPassword'},
		datatype: 'json',
		success: function(response){

			console.log('post success');
			console.log(response);
			response = JSON.parse(response);
			if (response===null) {
				console.log("email incorrect");
				return;
			}

			if(password===response['password']){
				console.log('Sign in successful');

				setCookie('userID', response['userID'], 0.5);
				window.location.href = 'index.php';
			}
			else
				console.log('Password incorrect');
		},
		error: function(){console.log('post error');}
	})
	return email+password;
}

function addUser(email, password, firstName, lastName, address, city, zipcode){
	console.log(email+ password+ firstName+ lastName+ address+ city+ zipcode);
	$.ajax({
		type:'POST', 
		url: '../model/interface.php',
		data: {user:{'firstName':firstName, 'email':email, 'password':password, 'lastName':lastName,
			'address':address, 'city':city, 'zipcode':zipcode}, 'func':'addUser'},
		datatype: 'json',
		success: function(response){

			console.log('post success');
			console.log(response);

		},
		error: function(){console.log('post error');}
	})
}

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
};

function addToCart(userID, quantity){
	console.log(userID+" "+quantity);
	$.ajax({
		type:'POST', 
		url: '../model/interface.php',
		data: {'userID':userID, 'quantity':quantity, 'productID':getUrlParameter('prd'),
			'func':'addToCart'},
		datatype: 'json',
		success: function(response){

			console.log('post success');
			console.log(response);

		},
		error: function(){console.log('post error');}
	})
}