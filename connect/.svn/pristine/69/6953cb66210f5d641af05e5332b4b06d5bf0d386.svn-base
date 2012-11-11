jQuery(function($){
   $("#comment").Watermark("Say something");
   $("#search").Watermark("USC School of Medicine");
   
});

function dump(obj) {
    var out = '';
    for (var i in obj) {
        out += i + ": " + obj[i] + "\n";
    }

    alert(out);

    // or, if you wanted to avoid alerts...

    var pre = document.createElement('pre');
    pre.innerHTML = out;
    document.body.appendChild(pre)
}
 
$(function() {
	 
	$("#tree").treeview({
 
		animated: "fast",
		control:"#sidetreecontrol",
 
		persist: "location",
 
	});
 
	$(".ulhide").css({'display': "none" });
})


$(document).ready(function(){

	$('.popularity').click(function() {
 
	    id=$(this).attr('name'); // school id is stored in the name attribute
 
	    $.ajax({
			  type: "POST",
			  url: "chat/addnum",
			  data: {"school_id": id},
			  success: function(data) {
				  
				  var link=data.url;
				  window.location = link;
				  if(data.error == '') {
					   
				  }
				 
			  },
			  dataType: "json"
		 });
	});
	
	
	
	$('#submit_comment').click(function() {
	 	var obj = $('#comment').val();
	var today = new Date();
	var curr_hour = today.getHours();
	var curr_min = today.getMinutes();
	var curr_sec = today.getSeconds();	 
	var dd = today.getDate();
	var mm = today.getMonth()+1; //January is 0!

	 var yyyy = today.getFullYear();
	 if(dd<10){dd='0'+dd} 
	 if(mm<10){mm='0'+mm} 
	    var today = yyyy+'-'+mm+'-'+dd+' '+curr_hour + ":" + curr_min + ":"+ curr_sec;
 
	    curr_hour + ":" + curr_min + ":"+ curr_sec;
	 
		 $.ajax({
			  type: "POST",
			  url: "chat/addcomment",
			  data: {"comments": obj},
			  success: function(data) {
				  if(data.error == '') {
					  var content = '<p class="activity_item">'+data.creator+' posted: '+obj+'. ( '+today+' )</p>';
					  $('#activity').prepend(content);
				  }
				 
			  },
			  dataType: "json"
		 });
	 
 
});
});
