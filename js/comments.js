var commentCount = 0;

function like(elem, id, user) {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			var elemID = "reg-like-" + id;
			var myElem = document.getElementById(elemID);
			myElem.innerHTML = xhttp.responseText;
			myElem.onclick = function(){dislike(elem, id, user);};
			myElem.className = "heart-full";
		}
	};
	xhttp.open("GET", "update-like.php?id=" + id + "&action=like&user=" + user, true);
	xhttp.send();
}
  
function dislike(elem, id, user) {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			var elemID = "reg-like-" + id;
			var myElem = document.getElementById(elemID);
			myElem.innerHTML = xhttp.responseText;
			myElem.onclick = function(){like(elem, id, user);};
			myElem.className = "heart";
		}
	};
	xhttp.open("GET", "update-like.php?id=" + id + "&action=dislike&user=" + user, true);
	xhttp.send();
}

function addComment(id, user) {
	var textAreaId = "comment-textarea-" + id;
	var textArea = document.getElementById(textAreaId);
	var newComment = textArea.value.trim();
	if (newComment !== "") {
		var lastCommentId = "last-comment-" + id;
		this.onclick = null;
		if ( document.getElementById( lastCommentId ) !== null ) {
			document.getElementById( lastCommentId ).removeAttribute("id");
		}
		commentCount += 1;
		var commentingUser = user;
		textArea.value = '';
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				var nodeLi = document.createElement("LI");
				nodeLi.setAttribute("id", lastCommentId);
				var textNodeLi = document.createTextNode(newComment);
				nodeLi.appendChild(textNodeLi);
				var commentListId = "comments-list-" + id;
				document.getElementById(commentListId).appendChild(nodeLi);

				var nodeSpan = document.createElement("SPAN");
				var textNodeSpan = document.createTextNode(commentingUser);
				nodeSpan.appendChild(textNodeSpan);
				document.getElementById( lastCommentId ).appendChild(nodeSpan);
			}
		};
		xhttp.open("GET", "add-comment.php?id=" + id + "&comment=" + newComment, true);
		xhttp.send();
	}
}
