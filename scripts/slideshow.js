var image1 = new Image()
image1.src = "images/index/pic1.jpg"
var image2 = new Image()
image2.src = "images/index/pic2.jpg"
var image3 = new Image()
image3.src = "images/index/pic3.jpg"
var image4 = new Image()
image4.src = "images/index/pic4.jpg"
var image5 = new Image()
image5.src = "images/index/pic5.jpg"

var step = 1;
function slideit() {
	document.images.slide.src = eval("image" + step + ".src");
	if (step < 5)
		step++;
	else
		step = 1;
	setTimeout("slideit()", 5000); // Switch every 5 seconds
}
