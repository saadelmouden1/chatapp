const form= document.querySelector(".typing-area"),
inputField =form.querySelector(".input-field"),
sendBtn=form.querySelector('button'),
chatBox= document.querySelector(".chat-box");

form.onsubmit =(e) =>{
    e.preventDefault();//preventing form from submiting
}

chatBox.onmouseenter =()=>{
    chatBox.classList.add("active")
}
chatBox.onmouseleave =()=>{
    chatBox.classList.remove("active")
}

sendBtn.onclick= () =>{
    //let'S start Ajax
    let xhr = new XMLHttpRequest();// craeting XML object
    xhr.open("POST","php/insert-chat.php",true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data =xhr.response;
                console.log(data );
                inputField.value="";
                chatBox.scrollTop=chatBox.scrollHeight;
                
            }
        }

    }
    //we have to send the form data through ajax to php
    let formData = new FormData(form);//craeating new formData object
    xhr.send(formData); 
}

setInterval(() =>{
    //let'S start Ajax
  let xhr = new XMLHttpRequest();// craeting XML object
  xhr.open("POST","php/get-chat.php",true);
  xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              let data =xhr.response;
              chatBox.innerHTML=data;
              console.log(data);
              if(!chatBox.classList.contains("active")){
                chatBox.scrollTop=chatBox.scrollHeight;
              }
             
         }
      }

  }
   //we have to send the form data through ajax to php
   let formData = new FormData(form);//craeating new formData object
   xhr.send(formData); 

},500)