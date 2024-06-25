 const searchBar = document.querySelector(".users .search input"),
 serachBtn =document.querySelector(".users .search button"),
 usersList =document.querySelector(".users .users-list");

 serachBtn.onclick=()=>{
    searchBar.classList.toggle("active");
    searchBar.focus();
    serachBtn.classList.toggle("active");
    searchBar.value="";
 }

 searchBar.onkeyup= () =>{
   let searchTerm= searchBar.value;

 
     //let'S start Ajax
     let xhr = new XMLHttpRequest();// craeting XML object
     xhr.open("POST","php/search.php",true);
     xhr.onload = ()=>{
         if(xhr.readyState === XMLHttpRequest.DONE){
             if(xhr.status === 200){
                 let data =xhr.response;
                 usersList.innerHTML =data;
             }
         }
 
     }
     xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
     xhr.send("searchTerm=" + searchTerm );

 
 }

 setInterval(() =>{
      //let'S start Ajax
    let xhr = new XMLHttpRequest();// craeting XML object
    xhr.open("GET","php/users.php",true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data =xhr.response;
                if(!searchBar.classList.contains("active")){
                  usersList.innerHTML =data;
                }
                
            }
        }

    }
    xhr.send();

 },500)
  