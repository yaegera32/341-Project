var monthName = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
var monthNum = {January:0, February:1, March:2, April:3, May:4, June:5, July:6, August:7, September:8, October:9, November:10, December:11};
var openTime = ['8:00','8:30','9:00','9:30','10:00','10:30','11:00','11:30','12:00','12:30','13:00','13:30','14:00','14:30','15:00','15:30','16:00','16:30','17:00'];
var month;
var year;
var id;

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
					data.forEach(function(appt){
						var date = new Date(appt['date']);
						var apptYear = date.getUTCFullYear();
						var apptMonth = date.getUTCMonth();
						var apptDay = date.getUTCDate();
						var apptTime = appt['time'];
						apptTime = apptTime.substring(0,5);
						if(apptYear == year && apptMonth == month){
							$('#'+apptDay).children("ul").append('<li><button id="appt'+appt['id']+'">'
									+apptTime+' '+appt['type']+'<br> Dentist:'+appt['dentist']+'<br> Hygienist:'+appt['hygienist']+'<br> Patient:'+appt['patient']+
									'</button></li>');
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
	for(var i=0; i<openTime.length-1; i++){
		var min = '00';
		if(i%2 == 1){
			min = '30';
		}
		var hour = i/2 + 8;
		if(hour%1==.5){
			hour -= .5;
		}
		$.ajax({
			async: false,
			method: "GET",
			url: "php/getAvailable.php",
			data: ({date: yearPoll+'-'+monthSend+'-'+daySend,time: openTime[i],endTime:openTime[i+1], id: dentistID}),
			success: function(data){
						console.log(data);
						addToList(openTime[i], openTime[i+1], data);
			}
		});
	}
}

var addToList = function(start52, end52, data52){
	//console.log(data);
	data52 = JSON.parse(data52);
	data52.forEach(function(appt52){
		if(appt52['hygienist']!=null){
			$('<li><button onclick="createApptment(\''+start52+'\', \''+end52+'\', \''+appt52['hygienist']+'\')">'+start52+' Dentist ID:'+appt52['id']+'</button></li>').appendTo($('#Appts'));
		}
	});
}

var createApptment = function(start1, end1, dent1){
	$.ajax({
		method: "POST",
		url: "php/addApt.php",
		data: ({year: $('#yearApt').val(),day: $('#dayApt').val(),month: monthNum[$('#monthApt').val()],start: start1,hygenist: 7, dentist: dent1, patient: $('#patientID').val(),type: $('#typeApt').val(), end: end1}),
		success: function(data){
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
		var form = document.querySelector('input[name="dentist"]:checked').value;
		edtDayApt(arg1+1, arg2, arg3, form);
	}
}

var displayCalendar = function(month, year) {       
	month = parseInt(month);
	year = parseInt(year);
	
	$('#month').empty().append(monthName[month] +" "+ year);
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
		var list = "<ul><li id=\""+dayNum+"h12a\">12AM:</li><li id=\""+dayNum+"h1a\">1AM:</li>"+
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
		"<li id=\""+dayNum+"h10p\">10PM:</li><li id=\""+dayNum+"h11p\">11PM:</li></ul>"
		if(month == new Date().getUTCMonth() && year == new Date().getUTCFullYear() && i == (new Date().getUTCDate())){
			$('#w'+week).append($('<td id="'+dayNum+'" class=" day"><p>'+dayNum+'</p><ul></ul></td>'));
		} else{
			$('#w'+week).append($('<td id="'+dayNum+'" class="day"><p id="add'+dayNum+'">'+dayNum+'</p><ul></ul></td>'));
		}
		$('#add'+dayNum).click(clickAdder(month, year, dayNum));
		dayNum++;
	}
	fillAppts();
	dentists();
}
var dentists = function() {
		$.ajax({
			method: "GET",
			url: "php/getDentists.php",
			success: function(data){
				data = JSON.parse(data);
				data.forEach(function(name){
				$('#dentNames').append($('<input type = "radio" name = "dentist" id = "values" value = "' + name['id']+ '">' +name['name']+'</input>'));
				console.log(data);
			});
			}
		});
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