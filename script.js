document.addEventListener("DOMContentLoaded", () => {
        GetNewGame();
        GetTopGame();
});


// Får  10 komande spel från api:en
async function GetNewGame(){
   try {
        const response = await fetch(`${Base_url}/games?key=${Api_key}&dates=2026-01-01,2026-12-31&ordering=-released&page_size=10`);
        
        if (response.ok) { 
            const data = await response.json();
            
            ShowNewgames(data.results);
        } else {
            console.log("Fetch failed. Status:", response.status);
        }
    } catch (error) {
        console.log("Network error:", error);
    }
}

//Få 10 av högsta rankade filmer

async function GetTopGame() {
    try{
        const response= await fetch(`${Base_url}/games?key=${Api_key}&ordering=-rating&page_size=10`);

        if (response.ok){
            const data = await response.json();
            console.log("Fetch successful! " ,data.results);
          
            ShowTopgame(data.results)
         } else {
            console.log("Fetch failed. Status:", response.status);
        }
    } catch (error) {
        console.log("Network error:", error);
    }

}
    //shwo the new games
function ShowNewgames(Newgames){
    const Newgamecont= document.getElementById("Upcoming_game");
    Newgamecont.innerHTML="";
       
     Newgames.forEach(game => {
        const gamediv=document.createElement("div");        
        gamediv.classList.add("singleGamecard");
                gamediv.innerHTML=`
                    <div class="card" style="width: 18rem;">
                    <img src="${game.background_image}" class="card-img-top" alt="">
                    <div class="card-body cardbody">
                        <p class="card-text">${game.name}</p>
                    </div>
                    </div>
                
                
             
                `;

                gamediv.addEventListener("click", () => {
                window.location.href= `gamePage/Game.php?id=${game.id}`;
                });
        Newgamecont.appendChild(gamediv);
     });

    }



    function ShowTopgame(Topgame){
        const TopGameCont=document.getElementById("TopRatedGame");
         TopGameCont.innerHTML="";

        
        Topgame.forEach(game => {

            const gamediv=document.createElement("div");        
            gamediv.classList.add("singleGamecard");

            gamediv.innerHTML=`
                    
                    <div class="card" style="width: 18rem; " >
                    <img src="${game.background_image}" class="card-img-top" alt="">
                    <div class="card-body cardbody" >
                        <p class="card-text">${game.name}</p>
                    </div>
                    </div>

                        
                        
                    `;
                
                    gamediv.addEventListener("click", () => {
                    window.location.href= `gamePage/Game.php?id=${game.id}`;
                    });
             
                TopGameCont.appendChild(gamediv);
     
        });

   


    }



    



