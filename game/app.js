let boxes = document.querySelectorAll(".box");
let msg = document.querySelector("#msg");
let msgContainer = document.querySelector(".msg-container");
let resetGame = document.querySelector("#reset-Btn");
let newGame = document.querySelector("#new-Btn");

let turnO = true;

const winnerPatterns = [
    [0, 1, 2],
    [3, 4, 5],
    [6, 7, 8],
    [0, 3, 6],
    [1, 4, 7],
    [2, 5, 8],
    [0, 4, 8],
    [2, 4, 6],
];

   boxes.forEach((box)=>{
      box.addEventListener("click", ()=>{
      if(turnO){
        box.innerText="0";
        turnO = false;
      }else{
        box.innerText= "x";
        turnO = true;
      }
          checkWinner();
       
      });
   });

   const checkWinner =()=>{
     winnerPatterns.forEach((winnerPattern)=>{
     let pos1Val= boxes[winnerPattern[0]].innerText;
     let pos2Val= boxes[winnerPattern[1]].innerText;
     let pos3Val= boxes[winnerPattern[2]].innerText;
      
     if(pos1Val !="" && pos2Val !="" && pos3Val !=""){
        if(pos1Val===pos2Val && pos2Val===pos3Val){
            console.log("winner", pos1Val);
              winner(pos1Val);
              boxDisable();
        }
     }

    });

   }
   const winner = (winnar)=>{
    msg.innerText= `Congratulations, Winnar is ${winnar}`;
    msgContainer.classList.remove("hide");
   }

   const boxDisable = ()=>{
    boxes.forEach((box)=>{
       box.disabled=true;
    });
   }
   const boxEnable = ()=>{
    boxes.forEach((box)=>{
       box.disabled=false;
       box.innerText=null;
    });
   }

   const resetBtn = ()=>{
       boxEnable();
       msgContainer.classList.add("hide")
   }

   resetGame.addEventListener("click", resetBtn);
   newGame.addEventListener("click", resetBtn);