function isFormValid(){
	var login = document.getElementById('login');
	var email = document.getElementById('email');
	var password = document.getElementById('original-password');
	var checkPwd = document.getElementById('check-password');
	var regEmail = new RegExp('^[0-9a-z._-]+@{1}[0-9a-z.-]{2,}[.]{1}[a-z]{2,5}$','i');

	if (login.value.length > 4 && regEmail.test(email.value) === true && password.value.length > 7 && checkPwd.value == password.value) {
		document.getElementById("register-validate").removeAttribute('disabled');
	} else {
		document.getElementById("register-validate").setAttribute('disabled', 'disabled');
	}
}

function isLoginValid(login) {
	var loginIcon = document.getElementById('login-icon');

	if (login.length > 4) {
		loginIcon.style.color = "#5cd65d";		
	} else {
		loginIcon.style.color = "black";
	}
	isFormValid();
}

function isEmailValid(email) {
	var regEmail = new RegExp('^[0-9a-z._-]+@{1}[0-9a-z.-]{2,}[.]{1}[a-z]{2,5}$','i');
	var emailIcon = document.getElementById('email-icon');

	if ( regEmail.test(email) === true ){
		emailIcon.style.color = "#5cd65d";
	} else {
		emailIcon.style.color = "black";		
	}
	isFormValid();
}

function unlockIcon(id) {
	var pwdIcon = document.getElementById(id);
	var className = pwdIcon.className;
	if ( className == 'lock' ) {
		pwdIcon.removeAttribute("class");
		pwdIcon.setAttribute("class", "unlock");
		pwdIcon.style.color = "#000000";
	}
}

function lockIcon(id) {
	var pwdIcon = document.getElementById(id);
	pwdIcon.removeAttribute("class");
	pwdIcon.setAttribute("class", "lock");
	pwdIcon.style.color = "#5cd65d";
}

function isPwdValid(currentPwd) {
	var valid = false;
	var length = currentPwd.length;
	if ( length > 7 ) {
		for ( var i = 0; i < length; i++ ) {
			if ( !isNaN(currentPwd[i]) ) {
				lockIcon("password-icon");
				valid = true;
			}
		}
	}
	if (valid === false) {
		unlockIcon("password-icon");
	}
	var pwdCheck = document.getElementById("check-password").value;
	isPwdMatching(pwdCheck);
}

function isPwdMatching(pwdBis) {
	var originalPwd = document.getElementById("original-password");
	if ( originalPwd.value.length > 7 && pwdBis == originalPwd.value ) {
		lockIcon("check-password-icon");
	} else {
		unlockIcon("check-password-icon");
	}
	isFormValid();
}
