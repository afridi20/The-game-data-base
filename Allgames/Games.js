let pagenr=1;
document.addEventListener("DOMContentLoaded", () => {
     GetAllgames();
    const Nextbutton=document.getElementById("Next-Button");
    const Prebutton=document.getElementById("Previous")
  

     Nextbutton.addEventListener("click", () =>{
            pagenr++;
            GetAllgames();
           Prebutton.style.display="block";
         

           
            
        })

        
     Prebutton.addEventListener("click", () =>{
            pagenr--;
            GetAllgames();
            if(pagenr<= 1){
                Prebutton.style.display="none"
            }
            else{
                Prebutton.style.display="block"
            }
           
         

           
            
        })
 
  
  
});

async function GetAllgames(){
    try {
        const response = await fetch(`${Base_url}/games?page=${pagenr}&key=${Api_key}`);
        if (response.ok) { 
            const data = await response.json();
            ShowAllgame(data.results);
        } else {
            console.log("Fetch failed. Status:", response.status);
        }
    } catch (error) {
        console.log("Network error:", error);
    }
}


    function ShowAllgame(Allgames){
        const Allgamecontainer=document.getElementById("All-games");
        Allgamecontainer.innerHTML="";

         
        Allgames.forEach(game => {
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
                    window.location.href= `../gamePage/Game.php?id=${game.id}`;
                    });

                    
            
             
                Allgamecontainer.appendChild(gamediv);

        });
        
       

   

    }
