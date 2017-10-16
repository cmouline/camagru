function deletePicture(elem, id){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById(id).remove();
		}
	};
	xhttp.open("GET", "delete-picture.php?id=" + id, true);
	xhttp.send();
}