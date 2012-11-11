$(document).ready(function(){
var position=0;
var timerID;
slide=function(){timerID=setInterval(function(){
position-=960;
if(position==-3840)
position=0;
$("#banner").animate({left:position},1000);}
,4000)
};
slide();
$("#banner a").hover(function(){clearInterval(timerID)},function(){slide()});



});