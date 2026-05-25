
    document.addEventListener("DOMContentLoaded", () => {
       
        
        loadwantGames();
        loadplayedgGames();
        loadplayingGames();

       

        
        });

        //bring data of all game from wanttoplay tabel
    async function loadwantGames() {
        for (const id of wantToPlayIds) {
            try {
            const response = await fetch(`${Base_url}/games/${id}?key=${Api_key}`);
            if (response.ok) { 
                const data = await response.json();
                
                // vissa upp all spele
                const div = document.createElement("div");
                div.innerHTML = `
            <div class="card  Rowstyling"  >
                <img class="card-img-top" src="${data.background_image}" alt="${data.name}">
                <div class="card-body cardbody">
                    <h5 class="card-title">${data.name}</h5>
                </div>
        </div>
            `;
             div.addEventListener("click", () => {
                window.location.href= `gamePage/Game.php?id=${data.id}`;
                });
            document.getElementById("want-to-play").appendChild(div);
            
                
            } else {
                console.log("Fetch failed. Status:", response.status);
            }
            } catch (error) {
                console.log("Network error:", error);
            }

        
        //
        }
    }
   
    //bring data of all game from played tabel
    async function loadplayedgGames() {
        for (const id of playedgameIds) {
            try {
            const response = await fetch(`${Base_url}/games/${id}?key=${Api_key}`);
            if (response.ok) { 
                const data = await response.json();
                
                // vissa upp all spele
                const div = document.createElement("div");
                div.innerHTML = `
            <div class="card Rowstyling"  >
                <img class="card-img-top" src="${data.background_image}" alt="${data.name}">
                <div class="card-body cardbody">
                    <h5 class="card-title">${data.name}</h5>
                </div>
        </div>
            `;
              div.addEventListener("click", () => {
                window.location.href= `gamePage/Game.php?id=${data.id}`;
                });
            document.getElementById("played").appendChild(div);
            
                
            } else {
                console.log("Fetch failed. Status:", response.status);
            }
            } catch (error) {
                console.log("Network error:", error);
            }

        
        //
        }
    }

    // bring data of all game from playing tabel
    async function loadplayingGames() {
        for (const id of playingameIds) {
            try {
            const response = await fetch(`${Base_url}/games/${id}?key=${Api_key}`);
            if (response.ok) { 
                const data = await response.json();
                
                // vissa upp all spele
                const div = document.createElement("div");
                div.innerHTML = `
            <div class="card Rowstyling" >
                <img class="card-img-top" src="${data.background_image}" alt="${data.name}">
                <div class="card-body cardbody">
                    <h5 class="card-title">${data.name}</h5>
                </div>
        </div>
            `;
             div.addEventListener("click", () => {
                window.location.href= `gamePage/Game.php?id=${data.id}`;
                });
            document.getElementById("playing").appendChild(div);
            
                
            } else {
                console.log("Fetch failed. Status:", response.status);
            }
            } catch (error) {
                console.log("Network error:", error);
            }

        
        //
        }
    }





    
