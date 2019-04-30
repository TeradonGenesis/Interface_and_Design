var href = window.location.pathname.split('/');

function product1(product) {
	alert("Product selected: " + product);
	sessionStorage.products = product;
}

function price() {
	if (sessionStorage.products=="first1") {
		sessionStorage.price=100;
	}
	
	else if (sessionStorage.products=="second1") {
		sessionStorage.price=200;
	}
	
	else if (sessionStorage.products=="third1") {
		sessionStorage.price=300;
	}
	
	else if (sessionStorage.products=="fourth1") {
		sessionStorage.price=400;
	}
	
	else if (sessionStorage.products=="fifth1") {
		sessionStorage.price=500;
	}
	
	else if (sessionStorage.products=="sixth1") {
		sessionStorage.price=600;
	}
}
	
if (href.indexOf("buyform.php")>0) {
	window.onload = function() {
		price();
		document.forms["formBuy"]["product-selected"].value = sessionStorage.products;
		document.forms["formBuy"]["product-price"].value = sessionStorage.price;
	}
}
	
