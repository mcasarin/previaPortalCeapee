function passwordCaracters(){
    var pass = document.getElementById("inputPassword");
    if(pass.value.length < 7){
        document.getElementById("notSeven").innerHTML = "A senha precisa ter pelo menos 7 caracteres.";
        document.getElementById("inputRepeat").disabled=true;
    } else {
        document.getElementById("notSeven").innerHTML = "";
        document.getElementById("inputRepeat").disabled=false;
    }
}

function validRepeatEmail(){
    var pass = document.getElementById("inputPassword");
    var confirmacao = document.getElementById("inputRepeat");
    if(pass.value === confirmacao.value){
        document.getElementById("btnRegister").disabled=false;
        document.getElementById("notConfirmed").innerHTML = "";
    } else {
        document.getElementById("notConfirmed").innerHTML = "As senhas são diferentes.";
        document.getElementById("btnRegister").disabled=true;
    }
}