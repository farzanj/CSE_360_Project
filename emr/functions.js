
function chfname(){
	var regExp =/^[a-zA-Z\s]{2,15}$/;	
	var letter = document.orderform.fname.value;
	letter = letter.replace(/(^\s*)|(\s*$)/gi,"");
	letter = letter.replace(/[ ]{2,}/gi," ");
	letter = letter.replace(/\n /,"\n");
	var num = letter.split(" ");
	num = num.length;
	
	if (!letter.match(regExp) || (num > 2)){
		document.getElementById('fname').style.backgroundColor ="red";
	} 
	else {
		
		document.getElementById('fname').style.backgroundColor="#19FF19";
		
	}
	
}
function chlname(){
	var regExp =/^[a-zA-Z\s]{2,15}$/;
	var letter = document.orderform.lname.value;
	letter = letter.replace(/(^\s*)|(\s*$)/gi,"");
	letter = letter.replace(/[ ]{2,}/gi," ");
	letter = letter.replace(/\n /,"\n");
	var num = letter.split(" ");
	num = num.length;
	
	if (!letter.match(regExp) || (num > 1)){  
		document.getElementById('lname').style.backgroundColor ="red";
		
	} else {
		document.getElementById('lname').style.backgroundColor ="#19FF19";
	}
	
}
function chnick(){
	var regExp = /^[a-z](?=[\w.]{4,15}$)\w*\.?\w*$/i ;
	var letter = document.orderform.nick.value;
	letter = letter.replace(/(^\s*)|(\s*$)/gi,"");
	letter = letter.replace(/[ ]{2,}/gi," ");
	letter = letter.replace(/\n /,"\n");
	var num = letter.split(" ");
	num = num.length;
	
	if (!letter.match(regExp) || (num > 1)){            
		document.getElementById('nick').style.backgroundColor ="red";
		
	} else {
		document.getElementById('nick').style.backgroundColor ="#19FF19";
	}
	
}
function chbirth(){
	var birth=document.getElementById("birthmonth");
	document.getElementById("moE").innerHTML=birth.options[birth.selectedIndex].text;
	if( birth.selectedIndex == 1){
		document.getElementById("moE").innerHTML="January &nbsp;".fontcolor("green");;
		
	}
	if( birth.selectedIndex == 2){
		document.getElementById("moE").innerHTML="February &nbsp;".fontcolor("green");;
		
	}
	if( birth.selectedIndex == 3){
		document.getElementById("moE").innerHTML="March &nbsp;".fontcolor("green");;
		
	}
	if( birth.selectedIndex == 4){
		document.getElementById("moE").innerHTML="April &nbsp;".fontcolor("green");;
		
	}
	if( birth.selectedIndex == 5){
		document.getElementById("moE").innerHTML="May &nbsp;".fontcolor("green");;
		
	}
	if( birth.selectedIndex == 6){
		document.getElementById("moE").innerHTML="June &nbsp;".fontcolor("green");
		
	}
	if( birth.selectedIndex == 7){
		document.getElementById("moE").innerHTML="July &nbsp;".fontcolor("green");;
		
	}
	if( birth.selectedIndex == 8){
		document.getElementById("moE").innerHTML="August &nbsp;".fontcolor("green");;
		
	}
	if( birth.selectedIndex == 9){
		document.getElementById("moE").innerHTML="September &nbsp;".fontcolor("green");;
		
	}
	if( birth.selectedIndex == 10){
		document.getElementById("moE").innerHTML="October  &nbsp; ".fontcolor("green");;
		
	}
	if( birth.selectedIndex ==11){
		document.getElementById("moE").innerHTML="November  &nbsp;".fontcolor("green");;
		
	}
	if( birth.selectedIndex ==12){
		document.getElementById("moE").innerHTML="December  &nbsp;".fontcolor("green");;
		
	}
	if( birth.value ==  "no"){
		document.getElementById("moE").innerHTML="";
		
	}
}
function chyear(){
	var year=document.getElementById("birthyear");
	document.getElementById("yeE").innerHTML=year.options[year.selectedIndex].text.fontcolor("green");
	if( year.value == "no"){
		document.getElementById("yeE").innerHTML="";
		
	}
}
function chcity(){
	var regExp =/^[a-zA-Z\s]{2,50}$/;
	var letter = document.orderform.city.value;
	letter = letter.replace(/(^\s*)|(\s*$)/gi,"");
	letter = letter.replace(/[ ]{2,}/gi," ");
	letter = letter.replace(/\n /,"\n");
	var num = letter.split(" ");
	num = num.length;
	
	if (!letter.match(regExp) || (num > 10)){    
		document.getElementById('city').style.backgroundColor ="red";
		
	} else {
		document.getElementById('city').style.backgroundColor ="#19FF19";
	}
	
}
function chzip(){
	var regExp =/^[(\d)]{5}$/;
	var letter = document.orderform.zip.value;
	if ( !letter.match(regExp)){  
		document.getElementById('zip').style.backgroundColor ="red";
		
	} else {
		document.getElementById('zip').style.backgroundColor ="#19FF19";
	}
	
}
function chstate(){
	var regExp =/^[a-zA-Z\s]{2,50}$/;
	var letter = document.orderform.state.value;
	letter = letter.replace(/(^\s*)|(\s*$)/gi,"");
	letter = letter.replace(/[ ]{2,}/gi," ");
	letter = letter.replace(/\n /,"\n");
	var num = letter.split(" ");
	num = num.length;
	
	if (!letter.match(regExp) || (num > 10)){    
		document.getElementById('state').style.backgroundColor ="red";
		
	} else {
		document.getElementById('state').style.backgroundColor ="#19FF19";
	}
	
}
function chcountry(){
	var regExp =/^[a-zA-Z\s]{2,32}$/;
	var letter = document.orderform.country.value;
	letter = letter.replace(/(^\s*)|(\s*$)/gi,"");
	letter = letter.replace(/[ ]{2,}/gi," ");
	letter = letter.replace(/\n /,"\n");
	var num = letter.split(" ");
	num = num.length;
	
	if (!letter.match(regExp) || (num > 3)){     
		document.getElementById('country').style.backgroundColor ="red";
		
	} else {
		document.getElementById('country').style.backgroundColor ="#19FF19";
	}
	
}
function chmail(){
	var regExp = /^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
	var letter = document.orderform.email.value;
	letter = letter.replace(/(^\s*)|(\s*$)/gi,"");
	letter = letter.replace(/[ ]{2,}/gi," ");
	letter = letter.replace(/\n /,"\n");
	var num = letter.split(" ");
	num = num.length;
	
	if (!letter.match(regExp) || (num > 1)){		
		document.getElementById('email').style.backgroundColor ="red";
	}else{
		document.getElementById('email').style.backgroundColor ="#19FF19";
	}
}
function chphone(){
	var phone = document.orderform.phone.value;	
	var regExp = /^\d*$/;
	if(!phone.match(regExp) ){		
		document.getElementById('phone').style.backgroundColor ="red";
	}
	
	else if(phone.length != 10){		
		document.getElementById('phone').style.backgroundColor ="red";
	}
	else {
		document.getElementById('phone').style.backgroundColor ="#19FF19";
	}
	
}
function chpassf(){
	var regExp = /^[a-zA-Z0-9!@#$?&*]{8,12}$/;
	var passb = document.orderform.pass.value;
	if(!passb.match(regExp)){
		document.getElementById('pass').style.backgroundColor ="red";
	}else{		
		document.getElementById('pass').style.backgroundColor ="#19FF19";
	}
}
function chpasst(){
	var passf = document.orderform.pass.value;
	var passk = document.orderform.mpass.value;
	if(passf != passk){		
		document.getElementById('mpass').style.backgroundColor ="red";
	}else{		
		document.getElementById('mpass').style.backgroundColor ="#19FF19";
	}
}
function checkform(){
	
	if (document.orderform.fname.value == "" ){
		strMsg="**You must fill in all of the<sup>*</sup>fields**".fontcolor("#FF0000");
		document.getElementById('fill').innerHTML = strMsg;  
		document.orderform.fname.focus();
		return false;
		
	}	
	var regExp =/^[a-zA-Z\s]{2,15}$/;
	
	var letter = document.orderform.fname.value;
	letter = letter.replace(/(^\s*)|(\s*$)/gi,"");
	letter = letter.replace(/[ ]{2,}/gi," ");
	letter = letter.replace(/\n /,"\n");
	var num = letter.split(" ");
	num = num.length;
	
	if (!letter.match(regExp) || (num > 2)){		  
		alert("Name must be Letters and bettween 2-15 chars long not more than 2 words");
		document.orderform.fname.focus();
		return false;
	}
	if (document.orderform.lname.value == "" ){
		strMsg="**You must fill in all of the<sup>*</sup>fields**".fontcolor("#FF0000");
		document.getElementById('fill').innerHTML = strMsg;  
		document.orderform.lname.focus();
		return false;
		
	}	
	var regExp =/^[a-zA-Z\s]{2,15}$/;	
	var letter = document.orderform.lname.value;
	letter = letter.replace(/(^\s*)|(\s*$)/gi,"");
	letter = letter.replace(/[ ]{2,}/gi," ");
	letter = letter.replace(/\n /,"\n");
	var num = letter.split(" ");
	num = num.length;
	
	if (!letter.match(regExp) || (num > 1)){		  
		alert("Please Enter Letters and bettween 2-15 chars long"); 
		document.orderform.lname.focus();
		return false;
	}
	if (document.orderform.nick.value == "" ){
		strMsg="**You must fill in all of the<sup>*</sup> fields**".fontcolor("#FF0000");
		document.getElementById('fill').innerHTML = strMsg;  
		document.orderform.nick.focus();
		return false;
	}	
	
	var regExp = /^[a-z](?=[\w.]{4,15}$)\w*\.?\w*$/i;
	var letter = document.orderform.nick.value;
	letter = letter.replace(/(^\s*)|(\s*$)/gi,"");
	letter = letter.replace(/[ ]{2,}/gi," ");
	letter = letter.replace(/\n /,"\n");
	var num = letter.split(" ");
	num = num.length;
	
	if (!letter.match(regExp) || (num > 1)){ 
		alert(" Username Must start with letter and bettween 5-15 chars long");
		document.orderform.nick.focus();
		return false;
	}
	var birth=document.getElementById("birthmonth");
	if( birth.value ==  "no"){
		alert("Please Enter your birth month");
		strMsg="**You must fill in all of the<sup>*</sup> fields**".fontcolor("#FF0000");
		document.getElementById('fill').innerHTML = strMsg; 
		return false;
	}
	var year=document.getElementById("birthyear");
	if( year.value == "no"){
		alert("Please Enter your birth year");
		strMsg="**You must fill in all of the<sup>*</sup> fields**".fontcolor("#FF0000");
		document.getElementById('fill').innerHTML = strMsg; 
		return false;
	}
	if (document.orderform.zip.value == "" ){
		strMsg="**You must fill in all of the<sup>*</sup> fields**".fontcolor("#FF0000");
		document.getElementById('fill').innerHTML = strMsg;  
		document.orderform.zip.focus();
		
		return false;
	}	
	var regExp =/^[(\d)]{5}$/;
	var letter = document.orderform.zip.value;
	if ( !letter.match(regExp)){		
		alert("Your zipcode is Invalid");
		document.orderform.zip.focus();
		return false;
	}
	if (document.orderform.city.value == "" ){
		strMsg="**You must fill in all of the<sup>*</sup> fields**".fontcolor("#FF0000");
		document.getElementById('fill').innerHTML = strMsg;  
		document.orderform.city.focus();
		return false;
	}	
	var regExp =/^[a-zA-Z\s]{2,32}$/;
	var letter = document.orderform.city.value;
	letter = letter.replace(/(^\s*)|(\s*$)/gi,"");
	letter = letter.replace(/[ ]{2,}/gi," ");
	letter = letter.replace(/\n /,"\n");
	var num = letter.split(" ");
	num = num.length;
	
	if (!letter.match(regExp) || (num > 3)){  		   
		alert("City must be Letters and bettween 2-32 chars long");
		document.orderform.city.focus();
		return false;
	}
	if (document.orderform.state.value == "" ){
		strMsg="**You must fill in all of <sup>*</sup>the fields**".fontcolor("#FF0000");
		document.getElementById('fill').innerHTML = strMsg;  
		document.orderform.state.focus();
		
		return false;
	}	
	var regExp =/^[a-zA-Z\s]{2,32}$/;
	var letter = document.orderform.state.value;
	letter = letter.replace(/(^\s*)|(\s*$)/gi,"");
	letter = letter.replace(/[ ]{2,}/gi," ");
	letter = letter.replace(/\n /,"\n");
	var num = letter.split(" ");
	num = num.length;
	
	if (!letter.match(regExp) || (num > 3)){  
		alert("State must be Letters and bettween 2-32 chars long");
		document.orderform.state.focus();
		
		return false;
	}
	if (document.orderform.country.value == "" ){
		strMsg="**You must fill in all of <sup>*</sup>the fields**".fontcolor("#FF0000");
		document.getElementById('fill').innerHTML = strMsg;  
		document.orderform.country.focus();
		
		return false;
	}	
	var regExp =/^[a-zA-Z\s]{2,32}$/;
	var letter = document.orderform.country.value;
	letter = letter.replace(/(^\s*)|(\s*$)/gi,"");
	letter = letter.replace(/[ ]{2,}/gi," ");
	letter = letter.replace(/\n /,"\n");
	var num = letter.split(" ");
	num = num.length;
	
	if (!letter.match(regExp) || (num > 3)){   
		alert("Country must be Letters and bettween 2-32 chars long");
		document.orderform.country.focus();
		
		return false;
	}
	if (  document.orderform.email.value == ""){
		strMsg="**You must fill in all of <sup>*</sup>the fields**".fontcolor("#FF0000");
		document.getElementById('fill').innerHTML = strMsg; 
		document.orderform.email.focus();
		return false;
		
	}
	var regExp = /^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
	var letter = document.orderform.email.value;
	letter = letter.replace(/(^\s*)|(\s*$)/gi,"");
	letter = letter.replace(/[ ]{2,}/gi," ");
	letter = letter.replace(/\n /,"\n");
	var num = letter.split(" ");
	num = num.length;
	
	if (!letter.match(regExp) || (num > 1)){
		alert("Please Enter a valid Email!!!!");
		document.orderform.email.focus();
		return false;
	}
	if (  document.orderform.phone.value == ""){
		strMsg="**You must fill in all of the<sup>*</sup> fields**".fontcolor("#FF0000");
		document.getElementById('fill').innerHTML = strMsg; 
		document.orderform.phone.focus();
		return false;
		
	}
	var phone = document.orderform.phone.value;
	var regExp = /^\d*$/;
	if(!phone.match(regExp) ){
		alert("Please Enter only digits");
		document.orderform.phone.focus();
		return false;
	}
	var phone = document.orderform.phone.value;
	if(phone.length != 10 ){
		alert("Please Enter Full Numbers");
		document.orderform.phone.focus();
		return false;
	}
	if (  document.orderform.pass.value == ""){
		strMsg="**You must fill in all of <sup>*</sup>the fields**".fontcolor("#FF0000");
		document.getElementById('fill').innerHTML = strMsg; 
		document.orderform.pass.focus();
		return false;
		
	}
	var regExp = /^[a-zA-Z0-9!@#$?&*]{8,12}$/;
	var passb = document.orderform.pass.value;
	if(!passb.match(regExp)){
		alert("Password must be letters numbers and allowing !@#$?&* characters");
		document.orderform.pass.focus();
		return false;
	}
	if (  document.orderform.mpass.value == ""){
		strMsg="**You must fill in all of the <sup>*</sup>fields**".fontcolor("#FF0000");
		document.getElementById('fill').innerHTML = strMsg; 
		document.orderform.mpass.focus();
		return false;
		
	}
	var passf = document.orderform.pass.value;
	var passk = document.orderform.mpass.value;
	if(passf != passk){
		alert("Your Passwords do not Match &#10005");      
		document.orderform.mpass.focus();
		return false;
	}
}