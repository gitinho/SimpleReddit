const inputs = document.querySelectorAll('input');

const patterns = {
    username:/^[a-z]{3,}$/,
    password:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-_]).{8,}$/ 
};

function validate(field, regex){

    if(regex.test(field.value)){
        field.className = 'valid';
    } else {
        field.className = 'invalid';
    }
}

inputs.forEach((input)=> {  
    input.addEventListener('keyup', (e)=>{
        validate(e.target, patterns[e.target.attributes.name.value]); 
    });
})  