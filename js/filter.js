var radios = document.getElementsByName('filter');

function filterSelection() {
	var isChecked = false;
	var isFile = 1;
	var button = document.getElementById("startbutton");
	if (button == null) {
		var button = document.getElementById("submitstartbutton");
		var isFile = document.getElementById("file-field").files.length;
	}
	for (var i = 0, length = radios.length; i < length; i++) {
		var filterName = radios[i].value;
		if (radios[i].checked) {
			isChecked = true;
			document.getElementById(filterName).style.display = "block";
		} else {
			document.getElementById(filterName).style.display = "none";
		}
	}
	var isDisabled = button.hasAttribute("disabled");
	if ( isDisabled === true && isChecked === true && isFile == 1 ) {
		button.removeAttribute('disabled');
	}
}
