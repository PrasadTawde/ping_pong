var canvas = document.getElementById('screen');
ctx = canvas.getContext('2d');
var width = canvas.getAttribute('width');
var height = canvas.getAttribute('height');

var frames = 30;
var timer = 0;
var time = 0.0;
var fadeId = 0;
var backgroundY = 0;
var speed = 1;

var mouseX;
var mouseY;

var bgImage = new Image();
var logoImage = new Image();
var playImage = new Image();
var instructionImage = new Image();
var creditsImage = new Image();
var arrowImage = new Image();

var arrowX = [0,0];
var arrowY = [0,0];
var arrowWidth = 35;
var arrowHeight = 40;

var arrowVisible = false;
var arrowSize = arrowWidth;
var arrowRotate = 0;

var buttonX = [110,240,161,208];
var buttonY = [90,140,180,220];
var buttonWidth = [96,260,182,160];
var buttonHeight = [40,40,40,40];

bgImage.src = "img/background.jpg";
logoImage.src = "img/ping.png";
playImage.src = "img/play.png";
instructionImage.src = "img/instructions.png";
creditsImage.src = "img/credits.png";

//drawing images
arrowImage.src = "img/arrow.png";
bgImage.onload = function(){
	ctx.drawImage(bgImage, 0, backgroundY);
};

bgImage.onload = function(){
    ctx.drawImage(bgImage, 0, 0);
};
logoImage.onload = function(){
    ctx.drawImage(logoImage, 110,0);
}
playImage.onload = function(){
    ctx.drawImage(playImage, buttonX[0], buttonY[0]);
}
// playImage.onload = function(){
//     ctx.drawImage(playImage, buttonX[1], buttonY[1]);
// }
instructionImage.onload = function(){
    ctx.drawImage(instructionImage, buttonX[1], buttonY[1]);
}
creditsImage.onload = function(){
    ctx.drawImage(creditsImage, buttonX[2], buttonY[2]);
}
ctx.drawImage(bgImage, 0, backgroundY);

//animate
timer = setInterval("update()", 1000/frames);
canvas.addEventListener("mousemove", checkPosition);
canvas.addEventListener("mouseup", checkClick);

function update(){
	clear();
	move();
	draw();
}

function clear(){
	ctx.clearRect(0, 0, width, height);
}

function move(){
	backgroundY -= speed;
	if (backgroundY == -1 *height) {
		backgroundY = 0;
	}
		if(arrowSize == arrowWidth){
			arrowRotate = -1;
		}
		if(arrowSize == 0){
			arrowRotate = 1;
		}
		arrowSize += arrowRotate;
}
function draw(){
	ctx.drawImage(bgImage, 0, backgroundY);
	ctx.drawImage(logoImage, 110,0);
	ctx.drawImage(playImage, buttonX[1], buttonY[1]);
	ctx.drawImage(instructionImage, buttonX[2], buttonY[2]);
	ctx.drawImage(creditsImage, buttonX[3], buttonY[3]);

	if(arrowVisible == true){
			ctx.drawImage(arrowImage, arrowX[0] - (arrowSize/2), arrowY[0], arrowSize, arrowHeight);
			ctx.drawImage(arrowImage, arrowX[1] - (arrowSize/2), arrowY[1], arrowSize, arrowHeight);
		}
}
//checking mouse position
function checkPosition(mouseEvent){
	mouseX = mouseEvent.pageX - this.offsetLeft;
	mouseY = mouseEvent.pageY - this.offsetRight;
	if (mouseEvent.pageX || mouseEvent.pageY == 0) {
		mouseX = mouseEvent.pageX - this.offsetLeft;
		mouseY = mouseEvent.pageY - this.offsetRight;
	} else if(mouseEvent.offsetX || mouseEvent.offsetY == 0) {
		mouseX = mouseEvent.offsetX;
		mouseY = mouseEvent.offsetY;
	}
		for(i = 0; i < buttonX.length; i++){
			if(mouseX > buttonX[i] && mouseX < buttonX[i] + buttonWidth[i]){
				if(mouseY > buttonY[i] && mouseY < buttonY[i] + buttonHeight[i]){
					arrowVisible = true;
					arrowX[0] = buttonX[i] - (arrowWidth/2) - 2;
					arrowY[0] = buttonY[i] + 2;
					arrowX[1] = buttonX[i] + buttonWidth[i] + (arrowWidth/2); 
					arrowY[1] = buttonY[i] + 2;
				}
			}else{
				arrowVisible = false;
			}
		}
}


//mouse click
function checkClick(mouseEvent){
    for(i = 0; i < buttonX.length; i++){
        if(mouseX > buttonX[i] && mouseX < buttonX[i] + buttonWidth[i]){
            if(mouseY > buttonY[i] && mouseY < buttonY[i] + buttonHeight[i]){
               fadeId = setInterval("fadeOut()", 1000/frames);
				clearInterval(timer);
				canvas.removeEventListener("mousemove", checkPosition);
				canvas.removeEventListener("mouseup", checkClick);  
            }
        }
    }
}

function fadeOut(){
    ctx.fillStyle = "rgba(0,0,0, 0.2)";
    ctx.fillRect (0, 0, width, height);
    time += 0.1;
    if(time >= 2){
        clearInterval(fadeId);
        time = 0;
        timer = setInterval("update()", 1000/frames);
        canvas.addEventListener("mousemove", checkPosition);
        canvas.addEventListener("mouseup", checkClick);
	}
}