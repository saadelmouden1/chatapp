const form = document.querySelector('.signup form'),
continueBtn = form.querySelector(".button input"),
errorText=form.querySelector(".error-txt");

form.onsubmit =(e) =>{
    e.preventDefault();//preventing form from submiting
}

continueBtn.onclick =() =>{
    //let'S start Ajax
    let xhr = new XMLHttpRequest();// craeting XML object
    xhr.open("POST","php/signup.php");
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data =xhr.response;
                if(data =='success'){
                    location.href='users.php';
                    console.log('ggg');
                }else{
                    errorText.textContent= data;
                    errorText.style.display='block';
                  
                }
            }
        }

    }
    //we have to send the form data through ajax to php
    let formData = new FormData(form);//craeating new formData object
    xhr.send(formData);
}