const url= new URLSearchParams(window.location.search);
const GameID= url.get('id');
GetGameInfo(GameID);
GetGametshots(GameID);


async function GetGameInfo(GameID){
   try {
        const response = await fetch(`${Base_url}/games/${GameID}?key=${Api_key}`);
        if (response.ok) { 
            const data = await response.json();
         
            showgameINfo(data);
            
        } else {
            console.log("Fetch failed. Status:", response.status);
        }
    } catch (error) {
        console.log("Network error:", error);
    }
}


async function GetGametshots(GameID){
   try {
        const response = await fetch(`${Base_url}/games/${GameID}/screenshots?key=${Api_key}`);
        if (response.ok) { 
            const data = await response.json();
            showscreenshots(data.results);

          
            
        } else {
            console.log("Fetch failed. Status:", response.status);
        }
    } catch (error) {
        console.log("Network error:", error);
    }
}





function showgameINfo(GameInfo){
    const Infocontainer= document.getElementById("Game-info");
   
    Infocontainer.innerHTML=`
           <div id="Main-info" >
             <img src="${GameInfo.background_image ?? ""}" alt="">
             
                <div id="game-text">
                    <h2>${GameInfo.name ?? ""}</h2>
                    
                    <div id="game-dis">
                    <p>${GameInfo.description_raw ?? ""}</p>
                    </div>
                    
                </div>
            </div>

           <div class="game-sidInfo">
                <p> Release date: ${GameInfo.released ?? "unknown"}</p>
                <p> Developers: ${GameInfo.developers[0]?.name ?? "unknown"}</p>
                <p><a href="${GameInfo.metacritic_url ?? "unnkown"}"> Metric score: ${GameInfo.metacritic ?? "Unkown"}</a></p>
                <p> Genra: ${GameInfo.genres?.map(g => g.name).join(", ") ?? "unknown"} </p>
                <p> Tags: ${GameInfo.tags?.map(g => g.name).join(", ") ?? "unkown"} </p>
                <p> Age Rating: ${GameInfo.esrb_rating?.name ?? "Unkown"} </p>
                <p> Platforms: ${GameInfo.parent_platforms?.map(g => g.platform.name).join(", ") ?? ""} </p>
            </div> `;

          
} 


function showscreenshots(shots) {
    const shotscont = document.getElementById("game-screenshots");

    shots.forEach(s => {
        const image = document.createElement("img");
        image.src = s.image;
        shotscont.appendChild(image);
    });
}
