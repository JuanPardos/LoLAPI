$(function () {
  $('[data-toggle="tooltip"]').tooltip()   //Enables BootStrap Tooltips
})

function changeImg(){
	var source1 = "https://upload.wikimedia.org/wikipedia/commons/thumb/2/29/Gold_Star.svg/1200px-Gold_Star.svg.png";
	var source2 = "https://i.dlpng.com/static/png/1355182-star-png-star-png-2000_2000_preview.png";
	
	if(document.getElementById("starimg").getAttribute("src") == source1)
		document.getElementById("starimg").src = source2;
	else
		document.getElementById("starimg").src = source1;
}

