const form = document.getElementById('form');
const inputName = document.getElementById('inputName');
const inputFirstname = document.getElementById('inputFirstname');
const inputMail = document.getElementById('inputMail');
const inputDescription = document.getElementById('inputDescription');
const submit = document.getElementById('submit');

function checkLength($data){
    // let error = document.createElement('p');
    if($data.value.length < 2){
        $data.style.borderBottom = "1px solid #ff0000";
        // error.innerText = "Trop court";
        // $data.parentNode.appendChild(error);
    } else{
        $data.style.borderBottom = "1px solid #5d5c5c";
    }
    if($data.value.length >= 2){
        $data.style.borderBottom = "1px solid #5d5c5c";
    }
    if($data.value.length > 255){
        $data.style.borderBottom = "1px solid #ff0000";
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