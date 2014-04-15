$(function() {
    //is a set?
    if (!localStorage.a) {
	//init the localStorage
	$.getJSON('getTimes.php', function(data) {
	    for (x in data) {
		localStorage.setItem(x, data[x]);
	    }
	});
    }
    
    //clear the localStorage when click the button
    $("#clear_webstorage").click(function(){
	localStorage.clear();
    });
    
    //calculate the win lost when click the button
    $("#calculate_win_lost").click(function(){
	var n = $("#item_num").val();
	var summary = 0;
	for(var i = 1 ; i <= n ; i++){
	    var code = $("#"+ i + 2).text();
	    var reg = /[a-z]+/;
	    code = code.match(reg);
	    var cost = $("#"+ i + 3).text();
	    var quatity = $("#"+ i + 4).text();
	    var price = $("#"+ i + 5).val();
	    if(!price){
		continue;
	    }
	    if(quatity > 0){
		var win_lost = (price - cost)*quatity;
	    } else {
		var win_lost = -(-cost - price)*quatity;
	    }
	    $("#"+ i + 6 ).text(win_lost*localStorage.getItem(code));
	    summary = summary + win_lost*localStorage.getItem(code);
	}
	$("#summary").text(summary);
    });
    
    //close the record if quatity is 0
    $("#close_record").click(function(){
	$.get('closeRecord.php', function(data){
	    if(data){
		alert('success close records, please refresh the page');
	    }else {
		alert('failed close');
	    }
	});
    });
});