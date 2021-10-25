let checkPass = ( event ) => {

    if(password.value!=password2.value){
        event.preventDefault();
        errPass1.innerHTML = 'Les mots de passe sont différents';
        errPass2.innerHTML = 'Les mots de passe sont différents';
    } 
}


profilForm.addEventListener('submit', checkPass);