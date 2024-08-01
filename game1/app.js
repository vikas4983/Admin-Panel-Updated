let userScore = 0;
let compScore = 0;

const choices = document.querySelectorAll(".choice");

let msg = document.querySelector("#msg");



const gameDrow = ()=>{
    msg.innerText="Game Was Drow";
    msg.style.backgroundColor = "#081b31";
}

const winnar = (userWin, userChoice, comChoice) => {
    if (userWin === true) {
        msg.innerText = "User Win!";
        msg.style.backgroundColor = "green";
    } else {
        
        msg.innerText = "User Loss!";
        msg.style.backgroundColor = "red";
    }
};


const gencomChoice = () => {
    const options = ["rock", "paper", "scissors"];
    const randIdx = Math.floor(Math.random() * 3);
    console.log(randIdx);
    return options[randIdx];
};

const playGame = (userChoice) => {
    console.log("User Choice = ", userChoice);
    //Generate Computer Choice
    const comChoice = gencomChoice();
    console.log("com choice =", comChoice);

    if(userChoice === comChoice){
        gameDrow();
        console.log("Game Drow");
         
    }
    else{
        let userWin = true;
        if(userChoice === "rock"){
            // scissors, papaer => computer choice option
          const userWin = comChoice === "paper" ? false : true;
          console.log("User = ", userWin);
           winnar(userWin);
          
        }else if (userChoice === "paper") {
            // scissors , rock => computer choice option
              const userWin = comChoice === "scissors" ? false : true;
               console.log("User", userWin);
                winnar(userWin);
             
        }else{
            //scissors, paper => computer choice option
            const userWin= comChoice === "rock" ? false : true;
            console.log("User", userWin);
            winnar(userWin);
        }
         
    }
};

choices.forEach((choice) => {
    console.log(choice);
    choice.addEventListener("click", () => {
        const userChoice = choice.getAttribute("id");
        console.log("choice was clicked", userChoice);
        playGame(userChoice);
    });
});
