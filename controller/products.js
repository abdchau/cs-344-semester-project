var script = document.createElement('script');
script.src = '../controller/jquery.js';
script.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(script);

function fetchProduct(productID){
	$.ajax({
		type:'POST', 
		url: '../model/products.php',
		data: {'productID':productID, 'func':'fetchProduct'},
		datatype: 'json',
		success: function(product){

			console.log('post success');
			console.log(product);
		},
		error: function(){console.log('post error');}
	})
	return productID;
}
