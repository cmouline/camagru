document.addEventListener('scroll', function(event){
	if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) || (document.body.scrollHeight == document.documentElement.scrollTop + window.innerHeight)) {
		var xhttp = new XMLHttpRequest();
		var lastPost = document.getElementById('gallery-mosaic').lastChild;
		var lastPostId = lastPost.parentNode.lastElementChild.id;
		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				document.getElementById('gallery-mosaic').insertAdjacentHTML('beforeend', xhttp.responseText);
			}
		};
		xhttp.open("GET", "load-post.php?lastid=" + lastPostId, true);
		xhttp.send();
	}
});