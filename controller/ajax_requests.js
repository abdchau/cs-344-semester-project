// var script = document.createElement('script');
// script.src = '../controller/jquery.js';
// script.type = 'text/javascript';
// document.getElementsByTagName('head')[0].appendChild(script);


function verifyUser(email, password){
	console.log(email);
	$.ajax({
		type:'POST',
		url: '../model/interface.php',
		data: {user:{'email':email, 'password':password}, 'func':'verifyUser'},
		datatype: 'json',
		success: function(response){

			console.log('post success');
			console.log(response);
			response=JSON.parse(response);
			if (response['res']===0) {
				alert("This email does not exist");
				return;
			}

			else if(response['res']===1){
				console.log('Sign in successful');
				window.location.href = 'index.php';
			}
			else if (response['res']===-1)
				alert('Password incorrect');
		},
		error: function(){console.log('post error');}
	})
	return email+password;
}

function signOut(){
	$.ajax({
		type:'POST',
		url: '../model/interface.php',
		data: {'func':'signOut'},
		datatype: 'json',
		success: function(response){

			console.log('post success');
			console.log(response);
			window.location.href='signin.php';
		},
		error: function(){console.log('post error');}
	})
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
			alert("Congratulations! You are now registered at Shopoholic");
			window.location.href = 'signin.php';
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
			alert(response);

		},
		error: function(){console.log('post error');}
	})
}

function resetDB(){
	$.ajax({
		type:'POST',
		url: '../model/interface.php',
		data: {'func':'resetDB'},
		datatype: 'json',
		success: function(response){

			console.log('post success');
			alert(response);
			location.reload();
		},
		error: function(){console.log('post error');}
	})
}

function deleteUser(userID) {
	$.ajax({
		type:'POST',
		url: '../model/interface.php',
		data: {'userID':userID, 'func':'deleteUser'},
		datatype: 'json',
		success: function(response){

			console.log('post success');
			alert(response);
			location.reload();
		},
		error: function(){console.log('post error');}
	})
}

function deleteProduct(productID) {
	$.ajax({
		type:'POST',
		url: '../model/interface.php',
		data: {'productID':productID, 'func':'deleteProduct'},
		datatype: 'json',
		success: function(response){

			console.log('post success');
			location.reload();
		},
		error: function(){console.log('post error');}
	})
}

function deleteOrder(orderID, productID) {
	$.ajax({
		type:'POST',
		url: '../model/interface.php',
		data: {'orderID':orderID, 'productID':productID, 'func':'deleteOrder'},
		datatype: 'json',
		success: function(response){

			console.log('post success');
			location.reload();
		},
		error: function(){console.log('post error');}
	})
}

function completeOrder(orderID, productID) {
	$.ajax({
		type:'POST',
		url: '../model/interface.php',
		data: {'orderID':orderID, 'productID':productID, 'func':'completeOrder'},
		datatype: 'json',
		success: function(response){

			console.log('post success');
			alert(response);
			location.reload();
		},
		error: function(){console.log('post error');}
	})
}

function toggleAdmin(userID) {
	$.ajax({
		type:'POST',
		url: '../model/interface.php',
		data: {'userID':userID, 'func':'toggleAdmin'},
		datatype: 'json',
		success: function(response){

			console.log('post success');
			location.reload();
		},
		error: function(){console.log('post error');}
	})
}

function removeCategory(categoryID) {
	$.ajax({
		type:'POST',
		url: '../model/interface.php',
		data: {'categoryID':categoryID, 'func':'removeCategory'},
		datatype: 'json',
		success: function(response){

			console.log('post success');
			location.reload();
		},
		error: function(){console.log('post error');}
	})
}
function editCategory(categoryID,newName) {
	$.ajax({
		type:'POST',
		url: '../model/interface.php',
		data: {'categoryID':categoryID, 'Name':newName, 'func':'editCategory'},
		datatype: 'json',
		success: function(response){

			console.log('post success');
			location.reload();
		},
		error: function(){console.log('post error');}
	})
}
function editStock(productID,newStock) {
	$.ajax({
		type:'POST',
		url: '../model/interface.php',
		data: {'productID':productID, 'stock':newStock, 'func':'editStock'},
		datatype: 'json',
		success: function(response){

			console.log('post success');
			location.reload();
		},
		error: function(){console.log('post error');}
	})
}

function addCategory(categoryName) {
	$.ajax({
		type:'POST',
		url: '../model/interface.php',
		data: {'categoryName':categoryName,'func':'addCategory'},
		datatype: 'json',
		success: function(response){

			console.log('post success');
			location.reload();
		},
		error: function(){console.log('post error');}
	})
}

function removeCity(cityID) {
	$.ajax({
		type:'POST',
		url: '../model/interface.php',
		data: {'cityID':cityID, 'func':'removeCity'},
		datatype: 'json',
		success: function(response){

			console.log('post success');
			location.reload();
		},
		error: function(){console.log('post error');}
	})
}

function addCity(cityName) {
	$.ajax({
		type:'POST',
		url: '../model/interface.php',
		data: {'cityName':cityName,'func':'addCity'},
		datatype: 'json',
		success: function(response){

			console.log('post success');
			location.reload();
		},
		error: function(){console.log('post error');}
	})
}

function toggleFeatured(productID) {
	$.ajax({
		type:'POST',
		url: '../model/interface.php',
		data: {'productID':productID,'func':'toggleFeatured'},
		datatype: 'json',
		success: function(response){

			console.log('post success');
			location.reload();
		},
		error: function(){console.log('post error');}
	})
}

function placeOrder(buyerID, amount, billingName, billingAddress, order_items){
	$.ajax({
		type:'POST',
		url: '../model/interface.php',
		data: {order:{'buyerID':buyerID, 'amount':amount, 'billingName':billingName,
				'billingAddress':billingAddress, 'order_items':order_items},'func':'placeOrder'},
		datatype: 'json',
		success: function(response){

			console.log('post success');
			alert(response);
			location.reload();
		},
		error: function(){console.log('post error');}
	})
}

function removeFromCart(userID, productID) {
	$.ajax({
		type:'POST',
		url: '../model/interface.php',
		data: {'userID':userID, 'productID':productID, 'func':'removeFromCart'},
		datatype: 'json',
		success: function(response){

			console.log('post success');
			location.reload();
		},
		error: function(){console.log('post error');}
	})
}

function changePassword(oldPassword, newPassword, userID) {
	$.ajax({
		type:'POST',
		url: '../model/interface.php',
		data: {'userID':userID, 'password':newPassword, 'oldPassword':oldPassword, 'func':'changePassword'},
		datatype: 'json',
		success: function(response){

			console.log('post success');

			response=JSON.parse(response);
			if (response['res']===0) {
				alert("Old password does not match");
				return;
			}
			else{
				alert("Password updated. You will have to log in again with your new password");
				signOut();
			}
			// location.reload();
		},
		error: function(){console.log('post error');}
	})
}

function changeUser(userID, email, firstName, lastName, address, city, zipcode) {
	$.ajax({
		type:'POST',
		url: '../model/interface.php',
		data: {user:{'userID':userID, 'firstName':firstName, 'email':email, 'lastName':lastName,
			'address':address, 'city':city, 'zipcode':zipcode}, 'func':'changeUser'},
		datatype: 'json',
		success: function(response){

			console.log('post success');
			location.reload();
		},
		error: function(){console.log('post error');}
	})
}

function storeMessage(question, name, email, phone, description) {
	$.ajax({
		type:'POST',
		url: '../model/interface.php',
		data: {"question":question, "name":name, "phone":phone, "email":email,
					"description":description, 'func':'storeMessage'},
		datatype: 'json',
		success: function(response){

			console.log('post success');
			alert(response);
			location.reload();
		},
		error: function(){console.log('post error');}
	})
}