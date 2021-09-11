let checkPass = ( event ) => {

    if(password.value!=password2.value){
        event.preventDefault();
        errPass.innerHTML = 'Les 2 mots de passe sont différents';
        errPass2.innerHTML = 'Les 2 mots de passe sont différents';
    } 
}


signUpForm.addEventListener('submit', checkPass);