function setMenuColor() {
	var currentFrame = document.getElementsByClassName("frame-content");

	var id = currentFrame[0].id.substr(6);
	var nav = document.getElementsByClassName("navbutton");
	var navID = "nav-" + id;

	var currentNav = document.getElementsByClassName("navbutton-active");
	if (typeof(currentNav[0]) != "undefined" && currentNav[0] != null ) {
		currentNav[0].className = "navbutton";
	}

	for (var i = 0; i < nav.length; i++) {
		if (nav[i].id == navID) {
			nav[i].className = "navbutton-active";
		}
	}
}

function makeAjaxRequest() {
	var ajaxRequest;
	
	try {
		ajaxRequest = new XMLHttpRequest();
	} catch (e) {
		try {
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {
				return false;
			}
		}
	}

	return ajaxRequest;
}

function loadPage(filename, callback) {
	var ajaxRequest = makeAjaxRequest();

	ajaxRequest.open("GET", "/emr/controller.php?file=" + filename, true);
	ajaxRequest.send(null);

	ajaxRequest.onreadystatechange = function() {
		if (ajaxRequest.readyState == 4) {
			var frame = document.getElementsByClassName("frame");
			frame[0].innerHTML = ajaxRequest.responseText;
			setMenuColor();
			callback();
		}
	}
}

function loadRecord(recordId) {
	var ajaxRequest = makeAjaxRequest();

	ajaxRequest.open("GET", "/emr/controller.php?find_submit=Find&recId=" + recordId, true);
	ajaxRequest.send(null);

	ajaxRequest.onreadystatechange = function() {
		if (ajaxRequest.readyState == 4) {
			var frame = document.getElementsByClassName("frame");
			frame[0].innerHTML = ajaxRequest.responseText;
		}
	}
}

function sendForm(formID, callback) {
	var ajaxRequest = makeAjaxRequest();

	var form = document.getElementById(formID);
	var elements = form.elements;

	var dataString = "?";

	for (var i = 0; i < elements.length; i++) {
		if (elements[i].tagName == "INPUT") {
			if (elements[i].type == "checkbox" || elements[i].type == "radio") {
				dataString += elements[i].name + "=" + elements[i].checked + "&";
			} else {
				dataString += elements[i].name + "=" + elements[i].value + "&";
			}
		}
	}

	ajaxRequest.open("GET", "/emr/controller.php" + dataString, true);
	ajaxRequest.send(null);

	ajaxRequest.onreadystatechange = function() {
		if (ajaxRequest.readyState == 4) {
			var frame = document.getElementsByClassName("frame");
			frame[0].innerHTML = ajaxRequest.responseText;
			setMenuColor();
			callback();
		}
	}
}

function setPhysician(id) {
	var row = document.getElementById(id);
	var startPos = row.innerHTML.indexOf("<span class=\"choose-detail\">") + 28;
	var endPos = row.innerHTML.indexOf("</span>");
	var name = row.innerHTML.substr(startPos, endPos - startPos);

	loadPage("makeAppointment2", function() {
		var span = document.getElementsByClassName("physician-name");
		span[0].innerHTML = name;

		var physician = document.getElementById("physician-appointment");
		physician.value = name;
	});
}

function switchFrame(id) {
	var currentNav = document.getElementsByClassName("navbutton-active");
	if (typeof(currentNav[0]) != "undefined" && currentNav[0] != null ) {
		currentNav[0].className = "navbutton";
	}

	var nav = document.getElementsByClassName("navbutton");
	var navID = "nav-" + id;

	for (var i = 0; i < nav.length; i++) {
		if (nav[i].id == navID) {
			nav[i].className = "navbutton-active";
		}
	}

	var frames = document.getElementsByClassName("frame-content");
	var frameID = "frame-" + id;

	for (var i = 0; i < frames.length; i++) {
		if (frames[i].id == frameID) {
			frames[i].style.display = "block";
		} else {
			frames[i].style.display = "none";
		}
	}
}

function redirect(url) {
	window.location = url;
}