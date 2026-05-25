const options = {method: 'GET', headers: {accept: 'application/json'}};

const Searchinput = document.querySelector( "#search input");
const Searchresult = document.querySelector("#search .search-result")

Searchinput.addEventListener("input", async() =>{
    const query = Searchinput.value.trim();
    if(query === ""){
        Searchresult.innerHTML="";
        return;

    }
    const result= await GetSearchResult(query);
    showsearchresult(result);

      
})

async function GetSearchResult(query) {
    try {
        const response = await fetch(`${Base_url}/games?search=${query}&key=${Api_key}`, options);
        const data = await response.json();
         
        const result = data.results.slice(0, 10);
        console.log("First 10 results:", result);

        return result;

    } catch (err) {
        console.error("Error fetching games:", err);
        return [];
    }
}

function showsearchresult(result){
      Searchresult.innerHTML='';
    
    result.forEach(game => {
        
        const gamediv=document.createElement("div");
        gamediv.classList.add("search-result-item");

        gamediv.innerHTML=`
       
        
    
            <p>${game.name}</p>
            
       
         `;

          gamediv.addEventListener("click", () => {
                    window.location.href= `gamePage/Game.php?id=${game.id}`;
                    });
         Searchresult.appendChild(gamediv);
    });
         
}

