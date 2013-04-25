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
			setMenuColor();
		}
	}
}

function sendForm(formID, callback) {
	var ajaxRequest = makeAjaxRequest();

	var form = document.getElementById(formID);
	var elements = form.elements;

	var dataString = "?";

	for (var i = 0; i < elements.length; i++) {
		if (elements[i].tagName == "INPUT" || elements[i].tagName == "TEXTAREA" || elements[i].tagName == "SELECT") {
			if (elements[i].type == "checkbox" || elements[i].type == "radio") {
				dataString += elements[i].name + "=" + elements[i].checked + "&";
			} else if (elements[i].type == "select-one") {
				dataString += elements[i].name + "=" + elements[i].options[elements[i].selectedIndex].value + "&";
			} else {
				dataString += elements[i].name + "=" + elements[i].value.replace(/#/g, "") + "&";
			}
		}
	}

	ajaxRequest.open("GET", "/emr/controller.php" + encodeURI(dataString), true);
	ajaxRequest.send(null);

	ajaxRequest.onreadystatechange = function() {
		if (ajaxRequest.readyState == 4) {
			var frame = document.getElementsByClassName("frame");
			frame[0].innerHTML = ajaxRequest.responseText;
			callback();
		}
	}
}

function setPhysician(name, email) {
	loadPage("makeAppointment2", function() {
		var span = document.getElementsByClassName("physician-name");
		span[0].innerHTML = name;

		var physician = document.getElementById("physician-appointment");
		physician.value = email;
	});
}

function changeGraph(direction) {
	if (typeof changeGraph.number == "undefined") {
		changeGraph.number = 1;
	}

	var previousNumber = changeGraph.number;
	changeGraph.number += direction;

	switch (previousNumber) {
		case 1:
			previousGraph = "bloodPres";
			break;
		case 2:
			previousGraph = "sugarLevel";
			break;
		case 3:
			previousGraph = "weight";
			break;
	}

	var graphImage = document.getElementById("graph-image");
	var leftArrow = document.getElementsByClassName("left-arrow")[0];
	var rightArrow = document.getElementsByClassName("right-arrow")[0];

	var graphName = "";

	switch (changeGraph.number) {
		case 1:
			graphName = "bloodPres";
			leftArrow.style.display = "none";
			break;
		case 2:
			graphName = "sugarLevel";
			leftArrow.style.display = "inline";
			rightArrow.style.display = "inline";
			break;
		case 3:
			graphName = "weight";
			rightArrow.style.display = "none";
			break;
		default:
			graphName = "bloodPres";
			changeGraph.number = 1;
	}

	graphImage.src = graphImage.src.replace(previousGraph, graphName);
}

function showGraphLoader() {
	var graphLoader = document.getElementsByClassName("graph-loader")[0];
	graphLoader.style.display = "block";
}

/*
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
*/

function redirect(url) {
	window.location = url;
}