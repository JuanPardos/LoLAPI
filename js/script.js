var x = 0;

$(function () {
	$('[data-toggle="tooltip"]').tooltip()
})
  
function changeImg(){
	var source1 = "https://icons-for-free.com/iconfiles/png/512/mark+opinion+rating+star+icon-1320191205647153700.png";
	var source2 = "https://upload.wikimedia.org/wikipedia/commons/thumb/2/29/Gold_Star.svg/1200px-Gold_Star.svg.png";
	  
	if(document.getElementById("starimg").getAttribute("src") == source2)
		document.getElementById("starimg").src = source1; 
	else
		document.getElementById("starimg").src = source2;

	if(x%2==0)
		document.getElementById("aux").value = "true";
	else
		document.getElementById("aux").value = "false";
	x++;
}
