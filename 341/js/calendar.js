var monthName = ['','January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
var monthNum = {January:1, February:2, March:3, April:4, May:5, June:6, July:7, August:8, September:9, October:10, November:11, December:12};
var appointmentTypes = {Cleaning: 1, RootCanal: 3, ToothExtraction: 2, ToothImplant: 2, Gone:17};
var openTime = ['8:00','8:30','9:00','9:30','10:00','10:30','11:00','11:30','12:00','12:30','13:00','13:30','14:00','14:30','15:00','15:30','16:00','16:30','17:00'];
var month;
var year;
var id;

var dropdownfunction = function(){
	document.getElementById("myDropDown").classList.toggle("show");
}

var getID = function(){
	$.ajax({
		method: "GET",
		url: "js/getID.php",
		success: function(data){
					id = data;
				},
	});
}

var fillAppts = function(){
		$.ajax({
			method: "GET",
			url: "php/getAppt.php",
			success: function(data){
						data = JSON.parse(data);
						data.sort(function(a, b){
							var date = (a['date'] + " " + a['time']).split(/[- :]/);
							var d = new Date(date[0],date[1]-1, date[2], date[3], date[4], date[5]);
							var date2 = (b['date'] + " " + b['time']).split(/[- :]/);
							var d2 = new Date(date2[0],date2[1]-1, date2[2], date2[3], date2[4], date2[5]);
							return d - d2;	
						});
						data.forEach(function(appt){
							var date = new Date(appt['date']);
							var apptYear = date.getUTCFullYear();
							var apptMonth = date.getUTCMonth();
							var apptDay = date.getUTCDate();
							var apptTime = appt['time'];
							var apptType = appt['type'];
							apptTime = apptTime.substring(0,5);
							if(apptYear == year && apptMonth == month){
								if(apptType == "Time Off"){
									if(appt['dentist'] == null){
										$('#' + apptDay).children("ul").append('<li class = "appt"><button id = "appt'+appt['id']+'">'
											+apptType+ ' for ' + appt['hygienist'] + '</button></li>');
									}
									else {
										$('#' + apptDay).children("ul").append('<li class = "appt"><button id = "appt'+appt['id']+'">'
											+apptType+ ' for ' + appt['dentist'] + '</button></li>');
									}
								}
								else{
								$('#'+apptDay).children("ul").append('<li class = "appt"><button id="appt'+appt['id']+'">'
										+apptTime+' '+appt['type']+'<br> Dentist:'+appt['dentist']+'<br> Hygienist:'+appt['hygienist']+'<br> Patient:'+appt['patient']+
										'</button></li>');
								}
							}
							deleteAppt(appt['id']);
						});
					}
		});
}

var deleteAppt = function(apptID){
	$('#appt'+apptID).click(function(){
		$.ajax({
		method: "POST",
		url: "php/deleteAppt.php",
		data: ({id: apptID}),
		success: function(data){
					console.log(data);
					location.reload(true);
				}
	});
	});
}

var edtDayApt = function(monthPoll, yearPoll, dayPoll, dentistID){
	$('#Appts').empty();
	$('#calendar').toggle();
	$('#create').toggle();
	$('#yearApt').val(yearPoll);
	$('#dayApt').val(dayPoll);
	$('#monthApt').val(monthName[monthPoll]);
	
	var monthSend;
	if(monthPoll<10){
		monthSend = '0'+monthPoll;
	}
	else{
		monthSend = monthPoll;
	}
	var daySend;
	if(dayPoll<10){
		daySend = '0'+dayPoll;
	}
	else{
		daySend = dayPoll;
	}
	var type = document.getElementById("typeselectID").value;
	var typeLength;
	switch(type) {
		case "cleaning":
			typeLength = 1;
			break;
		case "rootcanal":
			typeLength = 3;
			break;
	}
	
	for(var i=0; i<openTime.length-1; i++){
		$.ajax({
			async: false,
			method: "GET",
			url: "php/getAvailable.php",
			data: ({date: yearPoll+'-'+monthSend+'-'+daySend,time: openTime[i],endTime:openTime[i+typeLength], id: dentistID}),
			success: function(data){
						console.log(data);
						addToList(openTime[i], openTime[i+typeLength], data, dentistID);
			}
		});
	}
}
			   
	var addToList = function(start52, end52, data52, dentistID){
	//console.log(data);
	data52 = JSON.parse(data52);
	data52.forEach(function(appt52){
		if(appt52['hygienist']!=null && appt52['id']!=null && end52!=null){
			$('<li><button onclick="createApptment(\''+start52+'\', \''+end52+'\', \''+dentistID+'\', \''+appt52['hygienist']+'\')">'+start52+' - ' + end52 + '</button></li>').appendTo($('#Appts'));
		}
	});
}

var createApptment = function(start1, end1, dent1, hyg){
	//console.log("month = "+$('#monthApt').val());
	$.ajax({
		method: "POST",
		url: "php/addApt.php",
		data: ({year: $('#yearApt').val(),day: $('#dayApt').val(),month: monthNum[$('#monthApt').val()],start: start1,hygienist: hyg, dentist: dent1, patient: id,type: $('#typeApt').val(), end: end1}),
		success: function(data){
					//console.log(data);
					location.reload(true);
				}
	});
}

var toggleApt = function(){
	$('#calendar').toggle();
	$('#create').toggle();
}

var toggleCalendar = function(){
	$('#calendar').toggle();
}

var setToday = function() {
	var now   = new Date();
	var day   = now.getUTCDate();
	month = now.getUTCMonth();
	year  = now.getUTCFullYear();
	if (year < 2000){
		year = year + 1900;
	}
	this.focusDay = day;
	$('#yearJump').val(year);
	$('#monthJump').val(month);
	getID();
	displayCalendar(month, year);
	
}

var selectDate = function() {
	var day   = 0;
	month = $('#monthJump').val();
	year = $('#yearJump').val();
	displayCalendar(month, year);
}

var setPreviousYear = function() {
	var day   = 0;
	year--;
	$('#yearJump').val(year);
	displayCalendar(month, year);
}

var setPreviousMonth = function() {
	var day   = 0;
	if (month == 0) {
		month = 11;
		if (year > 1000) {
			year--;
		}
	} 
	else {
		month--; 
	}
	
	$('#yearJump').val(year);
	$('#monthJump').val(month);
	displayCalendar(month, year);
}

var setNextMonth = function() {
	var day   = 0;
	if (month == 11) {
		month = 0;
		year++;
	} 
	else { 
		month++; 
	}
	
	$('#yearJump').val(year);
	$('#monthJump').val(month);
	displayCalendar(month, year);
}

var setNextYear = function() {
	var day = 0;
	year++;
	$('#yearJump').val(year);
	displayCalendar(month, year);
}

var clickAdder = function(arg1, arg2, arg3){
	return function(){
		var dentist = document.getElementById("selectID").value;
		edtDayApt(arg1+1, arg2, arg3, dentist);
	}
}

var displayCalendar = function(month, year) {       
	month = parseInt(month);
	year = parseInt(year);
	
	$('#month').empty().append(monthName[month+1] +" "+ year);
	var i = 0;
	for(i=1; i<7; i++){
		$('#w'+i).empty();
	}
	var days = getDaysInMonth(month+1,year);
	var firstOfMonth = new Date (year, month, 1);
	var startingPos = firstOfMonth.getDay();
	days += startingPos;
	for (i = 0; i < startingPos; i++) {
		$('#w1').append($('<td></td>'));
	}
	var week = 1;
	var dayNum = 1;
	for (i = startingPos; i < days; i++) {
		if ( i%7 == 0 ){
			week++;
		}
		/*var list = "<ul><li id=\""+dayNum+"h12a\">12AM:</li><li id=\""+dayNum+"h1a\">1AM:</li>"+
		"<li id=\""+dayNum+"h2a\">2AM:</li><li id=\""+dayNum+"h3a\">3AM:</li>"+
		"<li id=\""+dayNum+"h4a\">4AM:</li><li id=\""+dayNum+"h5a\">5AM:</li>"+
		"<li id=\""+dayNum+"h6a\">6AM:</li><li id=\""+dayNum+"h7a\">7AM:</li>"+
		"<li id=\""+dayNum+"h8a\">8AM:</li><li id=\""+dayNum+"h9a\">9AM:</li>"+
		"<li id=\""+dayNum+"h10a\">10AM:</li><li id=\""+dayNum+"h11a\">11AM:</li>"+
		"<li id=\""+dayNum+"h12p\">12PM:</li><li id=\""+dayNum+"h1p\">1PM:</li>"+
		"<li id=\""+dayNum+"h2p\">2PM:</li><li id=\""+dayNum+"h3p\">3PM:</li>"+
		"<li id=\""+dayNum+"h4p\">4PM:</li><li id=\""+dayNum+"h5p\">5PM:</li>"+
		"<li id=\""+dayNum+"h6p\">6PM:</li><li id=\""+dayNum+"h7p\">7PM:</li>"+
		"<li id=\""+dayNum+"h8p\">8PM:</li><li id=\""+dayNum+"h9p\">9PM:</li>"+
		"<li id=\""+dayNum+"h10p\">10PM:</li><li id=\""+dayNum+"h11p\">11PM:</li></ul>"*/
		if(month == new Date().getUTCMonth() && year == new Date().getUTCFullYear() && i == (new Date().getUTCDate())){
			$('#w'+week).append($('<td id="'+dayNum+'" class="day"><p>'+dayNum+'</p><ul></ul></td>'));
		} else{
			$('#w'+week).append($('<td id="'+dayNum+'" class="day"><p id="add'+dayNum+'">'+dayNum+'</p><ul></ul></td>'));
		}
		$('#add'+dayNum).click(clickAdder(month, year, dayNum));
		dayNum++;
	}
	
	fillAppts();
}

var getDaysInMonth = function(month,year)  {
	var days;
	if(month==1 || month==3 || month==5 || month==7 || month==8 || month==10 || month==12){
		days=31;
	}
	else if(month==4 || month==6 || month==9 || month==11){
		days=30;
	}
	else if (month==2)  {
		if (isLeapYear(year)){
			days=29;
		}
		else{ 
			days=28;
		}
	}
	return (days);
}

var isLeapYear = function(Year) {
	if (((Year % 4)==0) && ((Year % 100)!=0) || ((Year % 400)==0)) {
		return (true);
	} 
	else { 
		return (false); 
	}
}