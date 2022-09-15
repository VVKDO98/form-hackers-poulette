const form = document.getElementById('contactForm');
const inputName = document.getElementById('inputName');
const inputFirstname = document.getElementById('inputFirstname');
const inputMail = document.getElementById('inputMail');
const inputDescription = document.getElementById('inputDescription');
const submit = document.getElementById('submitbtn');

function checkLength($data){
    if($data.value.length < 2){
        $data.style.borderBottom = "1px solid #F0F230";
    } else{
        $data.style.borderBottom = "1px solid #5d5c5c";
    }
    if($data.value.length >= 2){
        $data.style.borderBottom = "1px solid #5d5c5c";
    }
    if($data.value.length > 255){
        $data.style.borderBottom = "1px solid #F0F230";
    }
}

inputName.addEventListener('blur', e =>{
    checkLength(inputName);
})
inputFirstname.addEventListener('blur', e =>{
    checkLength(inputFirstname);
})
inputMail.addEventListener('blur', e =>{
    checkLength(inputMail);
})
inputDescription.addEventListener('blur', e =>{
    checkLength(inputDescription);
})

function sendFormIfOk(){
    let send = true;

    const mailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

    function onlyLetters(str) {
        return /^[a-zA-Z]+$/.test(str);
    }

    if(inputName.value.length < 2 || inputFirstname.value.length < 2 || inputMail.value.length < 2 || inputDescription.value.length < 2){
        send = false;
    }
    if(inputName.value.length > 2 || inputFirstname.value.length > 2 || inputMail.value.length > 2 || inputDescription.value.length > 2){

    }
    if(inputName.value.length > 255 || inputFirstname.value.length > 255 || inputMail.value.length > 255 || inputDescription.value.length > 1000){
        send = false;
    }
    if (!onlyLetters(inputName.value) || !onlyLetters(inputFirstname.value) || !inputMail.value.match(mailRegex)){
        send = false;
    }
    return send;
}


submit.addEventListener('click', e =>{
    const errorMessage = document.getElementById('form__errorMessage');

    e.preventDefault();
    if (sendFormIfOk()){
        form.submit();
    } else{
        errorMessage.innerText = "Something is wrong with your information, please make sure not to use numbers in your first and last name and to enter a valid email address.";
    }
})

