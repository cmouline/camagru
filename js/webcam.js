(function() {
	
	var streaming = false,
		video = document.querySelector('#video-element'),
		cover = document.querySelector('#cover'),
		canvas = document.querySelector('#canvas'),
		photo = document.querySelector('#photo'),
		startbutton = document.querySelector('#startbutton'),
		width = 500,
		height = 0;

	navigator.getMedia = ( navigator.getUserMedia ||
						 navigator.webkitGetUserMedia ||
						 navigator.mozGetUserMedia ||
						 navigator.msGetUserMedia);

	navigator.getMedia(
	{
		video: true,
		audio: false
	},
	function(stream) {
		if (navigator.mozGetUserMedia) {
			video.mozSrcObject = stream;
		} else {
			var vendorURL = window.URL || window.webkitURL;
			video.src = vendorURL.createObjectURL(stream);
		}
		video.play();
	},
	function(err) {
		var newDiv = document.createElement("DIV");
		newDiv.setAttribute("id", "no-webcam");
		newDiv.innerHTML = "Vous n'avez pas de webcam ou celle ci ne marche pas.<br/>Pas de problème, uploadez une image de votre ordinateur!<form id='no-webcam-file' action='create-picture.php' method='post' enctype='multipart/form-data'><input id='file-field' type='file' name='upload-pic' accept='.png' onchange='filterSelection()'><span class='shoot'></span><input type='hidden' name='from' value='form'><input id='submitstartbutton' type='submit' name='submit' disabled></form>";
		document.getElementById("video-div").appendChild(newDiv);
		var elem = document.getElementById( 'startbutton' );
		elem.remove();
	}
	);

	video.addEventListener('canplay', function(ev){
		if (!streaming) {
			height = video.videoHeight / (video.videoWidth/width);
			video.setAttribute('width', width);
			video.setAttribute('height', height);
			canvas.setAttribute('width', width);
			canvas.setAttribute('height', height);
			streaming = true;
		}
	}, false);

	function takepicture() {
		var filter = document.querySelector('input[name="filter"]:checked').value;
		var filterPath = 'img/' + filter + '.png';		canvas.width = width;
	
		canvas.height = height;
		canvas.getContext('2d').drawImage(video, 0, 0, width, height);
		var data = canvas.toDataURL('image/png');
		b64 = encodeURIComponent(data);
		var param = 'img=' + b64 + '&filter=' + filterPath + '&from=camera';
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				document.getElementById('id-last-pic-group').insertAdjacentHTML('afterbegin', xhttp.responseText);			}
		};
		xhttp.open("POST", "create-picture.php", true);
		xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhttp.send(param);
	}

	startbutton.addEventListener('click', function(ev){
		takepicture();
		ev.preventDefault();
	}, false);

})();