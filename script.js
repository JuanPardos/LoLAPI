$(function () {
  $('[data-toggle="tooltip"]').tooltip()   //Enables BootStrap Tooltips
})

function changeImg(){
	var source1 = "https://upload.wikimedia.org/wikipedia/commons/thumb/2/29/Gold_Star.svg/1200px-Gold_Star.svg.png";
	var source2 = "https://image.flaticon.com/icons/png/512/130/130188.png";
	
	if(document.getElementById("starimg").getAttribute("src") == source1)
		document.getElementById("starimg").src = source2;
	else
		document.getElementById("starimg").src = source1;
}
