const form = document.getElementById('form');
const inputName = document.getElementById('inputName');
const inputFirstname = document.getElementById('inputFirstname');
const inputMail = document.getElementById('inputMail');
const inputDescription = document.getElementById('inputDescription');



function checkLength($data){
    // const error = document.querySelector('#nameFeedback');
    // error.style.display = "none";
    if($data.value.length < 2){
        $data.style.borderBottom = "1px solid #ff0000";
    }
    if($data.value.length >= 2){
        $data.style.borderBottom = "1px solid #5d5c5c";
    }
    if($data.value.length > 255){
        $data.style.borderBottom = "1px solid #ff0000";
    }

}

inputName.addEventListener('keyup', e =>{
    checkLength(inputName);
})
inputFirstname.addEventListener('keyup', e =>{
    checkLength(inputFirstname);
})
inputMail.addEventListener('keyup', e =>{
    checkLength(inputMail);
})
inputDescription.addEventListener('keyup', e =>{
    checkLength(inputDescription);
})