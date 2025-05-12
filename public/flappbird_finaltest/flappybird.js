//browser sizes:
let windowWidth = window.innerWidth;
let windowHeight = window.innerHeight;

//board
let board;
let boardWidth = 457;//image width
let boardHeight = 640;//image height
let context;//drawing on the canvas.
let zoom;
//bird
let birdWidth = 170;// width/height = ratio --> Actual bird image size.
let birdHeight = 119;//Same just in smaller version. The image is not "deformed".
let birdX = boardWidth/8;
let birdY = boardHeight/2;
let birdImg;


let bird = {
    x: birdX,
    y: birdY,
    width: birdWidth,
    height: birdHeight
}

//pipes
let pipeArray = [];
let pipeWidth = 64; //width/height ratio = 384/3072 = 1/8
let pipeHeight = 512;
let pipeX = boardWidth;
let pipeY = 0;


let topPipeImg;
let bottomPipeImg;

//physics:
let velocityX = -2.5;//pipes left moving speed
let velocityY = 0;//bird jump speed
let gravity = 0.4;

let gameStart = false;//the game started
let gameOver = false;//the game ended
let restartButton = document.getElementById("restart");

let score = 0;
let maxScore = score;
let time = 2500;
let speed = 4.5/(time/1000); //calculates the pipes moving speed based on the time and velocity ratio;

window.onload = function(){
    board = document.getElementById("board");
    board.height = boardHeight;
    board.width = boardWidth;

    context = board.getContext("2d"); // used drawing on the canvas
    console.log(boardWidth);

    canvasResize();
     //draw flappy bird
     //context.fillStyle = "green";
     //context.fillRect(bird.x, bird.y, bird.width, bird.height);

    //load images
    birdImg = new Image();
    birdImg.src = "./flappybird6.png";
    birdImg.onload = function(){
        context.drawImage(birdImg, bird.x, bird.y, bird.width, bird.height);
    }

    topPipeImg = new Image();
    topPipeImg.src = "./toppipe.png";

    bottomPipeImg = new Image();
    bottomPipeImg.src = "./bottompipe.png";

    context.fillStyle = "white";

    //drawing the text in different sizes based on the window width
    // context.font = windowWidth > 1200 ? "40px sans-serif" : "2.5rem sans-serif";
    // context.fillText(score, 5, 45);
    
    // context.font = windowWidth > 1500 ? "50px sans-serif" : "2rem sans-serif";
   
    //: telefonra mi és gépre mi?
    //érintőképernyőre vagy billentyűzetre?
    //const textWidth;//let textWidth;
    if(window.navigator.maxTouchPoints !== 0){
        //Only touchscreen devices will be display like this.
        // const textWidth = context.measureText("Tap on the playing area").width;
        // context.fillText("Tap on the playing area", (boardWidth-textWidth)/2, boardHeight/2 - 20);
       
    }
    else{
        //Not touchscreen devices will display like this.
        // console.log('pb');
        // const textWidth = context.measureText("Press Enter To Start").width;
        // context.fillText("Press Enter To Start", (boardWidth-textWidth)/2, boardHeight/2 - 20);
    
        // context.font = windowWidth > 1500 ? "45px sans-serif" : "2rem sans-serif";
        // context.fillText("Space To Jump", boardWidth - (context.measureText("Space To Jump").width) - 10, 45);
        
    }
   

    if(gameStart === false)
    {
        document.addEventListener("keypress", startGame);
        document.addEventListener("touchend", startGame);
    }
    /*else{

    }*/
}
function startGame(e){
    if(gameStart === false){//ToDo: If there are wrong inputs it could alert the user about it.
        console.log(e.type);
        if(e.code === "Enter" || e.type === "touchend"){
            gameStart = true;
            requestAnimationFrame(update);
            setInterval(placePipes, time);//1500 ms -- every 1.5 seconds
            document.addEventListener("keydown", moveBird);
            board.addEventListener("click", moveBird);
        }
        else{
            alert("Wrong input! Correct: Enter or tap the screen");
            return; //Throws out the user if it's the incorrect input.
        }
    }
}

function update(){
    requestAnimationFrame(update);
    if(gameOver)
    {
        pipeArray = [];
        return;
        //Ends the loop of calling itself if the game is over. 
    }
    context.clearRect(0,0, board.width, board.height);
    //Clears the last frame to load the new.

    //bird
    velocityY += gravity;
    bird.y = Math.max(bird.y + velocityY, 0);//apply gravity to current bird.y, limit the bird.y to the top of the canvas
    context.drawImage(birdImg, bird.x, bird.y, bird.width, bird.height);
    if(bird.y > board.height)//the game met the bird has fallen condition
    {
        gameOver = true;
        restartButton.style.display = "block";
        //Make the restart button visible.
    }
    //pipes
    for(let i = 0; i < pipeArray.length; i++ ){
        let pipe = pipeArray[i];
        pipe.x += velocityX;
        context.drawImage(pipe.img, pipe.x, pipe.y, pipe.width, pipe.height);

        if(!pipe.passed && bird.x > pipe.x + pipe.width)
        {
            score+=0.5;//because there are two pipes: top and bottom! 0.5*2 = 1, 1 for each set of pipes.
            pipe.passed = true;
        }


        if(detectCollision(bird, pipe))//the game met the bird collided with pipe condition
        {
            gameOver = true;
            restartButton.style.display = "block";
            //Make the restart button visible.
        }
    }
    //clear pipes

    while(pipeArray.length > 0 && pipeArray[0].x < -pipeWidth)
    {
        pipeArray.shift();//removes first element of the game
        //memory overflow prevention.
    }


    //score
    context.fillStyle = "white";
    context.font = windowWidth < 1500 ? "3rem sans-serif" : '45px sans-serif';
    context.fillText(score, 5, 45);
    

    if(gameOver){
        maxScore = Math.max(score, maxScore);

        const textWidth = context.measureText("GAME OVER").width;
        context.font = windowWidth < 1500 ? "3rem sans-serif" : '45px sans-serif';
        context.fillText("GAME OVER", (boardWidth-textWidth)/2 , boardHeight/2 - 20);

        context.font =  window.innerWidth > 1500 ?  "35px sans-serif": "2rem sans-serif";
        context.fillText("Best score: " + maxScore, boardWidth - (context.measureText("Best score: " + maxScore).width) - 10, 45);
        /*context.fillText("GAME OVER", boardWidth/2, boardHeight/2 - 20);*/
    }
}

function placePipes(){

    if(gameOver)
    {
        return;
    }
    let randomPipeY = pipeY - pipeHeight/4 - Math.random() * (pipeHeight/2);
    let openingSpace = boardHeight/4;
    //(0-1) * pipeHeight/2
    // 0 -> -pipeHeight/4;
    // 1 -> -pipeHeight/4 - pipeHeight/2 = -3/4pipeHeight    
    let topPipe = {
        img: topPipeImg,
        x : pipeX,
        y : randomPipeY,
        width : pipeWidth,
        height : pipeHeight,
        passed : false
    }
    let bottomPipe = {
        img: bottomPipeImg,
        x : pipeX,
        y : randomPipeY + pipeHeight + openingSpace,
        width : pipeWidth,
        height : pipeHeight,
        passed : false
    }

    //Making sure that no pipes placed over each other, and there's enough space beetween them 
    if(pipeArray.length === 0){
        pipeArray.push(topPipe);
        pipeArray.push(bottomPipe);
    }
    else if(pipeArray.length !== 0 && !(pipeArray[pipeArray.length - 1].x + pipeArray[pipeArray.length - 1].width + bird.width + bird.width + bird.width/2 > pipeX)){
        console.log(pipeArray[pipeArray.length - 1].x);
        pipeArray.push(topPipe);
        pipeArray.push(bottomPipe);
    }
    //pipeArray.push(topPipe);

    
    //pipeArray.push(bottomPipe);
    //console.log(lastPipePosition);
    console.log("New pipes");
}

function moveBird(e){
    if(e.code == "Space" || e.code == "ArrowUp" || e.code == "KeyX" || e.type == "click")
    {
        velocityY -= e.type === 'click' ?  3.858 : 10;//jump: 3.5 - 7
        gravity = e.type == 'click' ? 0.2355 : 0.4;//reset jump grav .0.245
        //reset game
        if(gameOver){
            bird.y = birdY;
            pipeArray = [];
            score = 0;
            // maxScore
            restartButton.style.display = "none";
            gameOver = false;
        }
    }
}

function detectCollision(a,b){
    return a.x < b.x + b.width &&
           a.x + a.width > b.x &&
           a.y < b.y + b.height &&
           a.y + a.height > b.y;
}

function restart(){
    bird.y = birdY;
    pipeArray = [];
    score = 0;
    restartButton.style.display = "none";
    gameOver = false;
}
function pipeResize(){
    //Resize the pipes based on the width and height of the canvas and the pipes former size
    const Hdiff = (boardHeight * 0.8) - pipeHeight;// (-+) difference in height compare to the last version of the pipe height
    const Wdiff = (boardWidth * 0.15) - pipeWidth;// (-+) difference in width compare to the last version.

    pipeHeight = pipeHeight + Hdiff;
    pipeWidth = pipeWidth + Wdiff;
    //Reset the existing pipes sizes, position.
    if(pipeArray.length !== 0){
        pipeArray.forEach((pipe, ind)=>{
            if(pipe.y < 0) 
            {
                pipe.y = pipeHeight * (pipe.y/pipe.height);
            }
            else
            {   
                pipe.y = pipeArray[ind - 1].y + boardHeight/4 + pipeHeight;
            }
            pipe.height = pipeHeight;
            pipe.width = pipeWidth;
        })
    }
   
   
}
function birdResize(){
    //Resize the bird by the canvas width and height
    const newBirdHeight = 1/22 * boardHeight;//bird original image height and the board height ratio result
    const newBirdWidth = newBirdHeight * 34/22;// the original bird height and the width ratio multiplied by the new bird height

    bird.height = newBirdHeight;
    bird.width = newBirdWidth;

    bird.x = boardWidth/8; 
    bird.y = boardHeight/2;

    //Extra: Resets the position of the bird
}
function canvasResize(){
	//ToDo: If window size is bigger smaller imaging...
    //if smaller than bigger.
    //Make it so that the background image is seeable.
    //I have to change it as well in running in pipe speed.
    
    
    if(window.innerWidth < 457 || window.innerHeight < 440){
        // console.log("Hi")
        console.log(navigator.maxTouchPoints);
        if(window.navigator.maxTouchPoints !== 0){
            boardWidth = screen.width;
            boardHeight = screen.height;
            console.log("Hi");
        }
        else{
            boardWidth = 457;
            boardHeight = 640;
            console.log("Hi telephone");
        }
       
    }
    else{
        boardWidth = window.innerWidth * 0.72;
        boardHeight = window.innerHeight * 0.72;
        console.log("Hi normal");
    } 
    
    //Calculate the velocityX by canvas properties
    if(windowWidth < 4500){
        time = 2500;
        //velocityX = -2.5;
    }
    else{
        time = 3500;
    }
    velocityX = -time/1000 * speed;
    //console.log(velocityX);
    pipeX = boardWidth;
    
    windowHeight = window.innerHeight;
    windowWidth = window.innerWidth;

    
    pipeResize();
    birdResize();

    const canvas = document.getElementById("board");
    canvas.width = boardWidth;
    canvas.height = boardHeight;
    //context.fillText();
    if(gameOver)
    {
        
        context.fillStyle = "white";
        context.font = "3rem sans-serif";
        context.fillText(score, 5, 45);
        const textWidth = context.measureText("GAME OVER").width;
        context.fillText("GAME OVER", (boardWidth-textWidth)/2 , boardHeight/2 - 20);
        context.fillStyle = "white";
        context.font =  window.innerWidth > 1500 ?  "35px sans-serif": "2rem sans-serif";
        context.fillText("Best score: " + maxScore, boardWidth - (context.measureText("Best score: " + maxScore).width) - 10, 45);
        console.log("I'm writing best: " + maxScore);
    }
    else if(gameStart == false){
        context = canvas.getContext("2d");
        context.fillStyle = "white";
        context.font = window.innerWidth > 600 ? "40px sans-serif": "3rem sans-serif";
        context.fillText(score, 5, 45);

        // console.log(window.navigator.maxTouchPoints);

        if(window.navigator.maxTouchPoints !== 0){
            console.log("Touch");
            context.font = window.innerWidth < 600 ? "2rem sans-serif": "35px sans-serif";
            const textWidth = context.measureText("Tap on the playing area").width;
            context.fillText("Tap on the playing area", (boardWidth - textWidth)/2, boardHeight/2 - 20);
        }
        else{
            context.font = window.innerWidth > 600 ? "2.5rem sans-serif": "45px sans-serif";
            const textWidth = context.measureText("Press Enter To Start").width;
            context.fillText("Press Enter To Start", (boardWidth-textWidth)/2 , boardHeight/2 - 20);
            context.font =  window.innerWidth > 1500 ?  "35px sans-serif": "2rem sans-serif";
            context.fillText("Space To Jump", boardWidth - (context.measureText("Space To Jump").width) - 10, 45);
        }

        birdImg = new Image();
        birdImg.src = "flappybird6.png";

        birdImg.onload = function() {
            context.drawImage(birdImg, bird.x, bird.y, bird.width, bird.height);
        }

        
    }
    console.log(time);
}
window.addEventListener("resize", canvasResize, 200);//resize detection and handeling
window.addEventListener("online", function (){
    //Redirect to the last online page...alert("online");
    this.location.href="file:///C:/Users/Lenovo/Documents/flappybird/flappybird.html";
    //TODO: Get the last page here.
})