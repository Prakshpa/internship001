const form=document.getElementById("form");
const fname=document.getElementById("fname");
const mname=document.getElementById('mname');
const lname=document.getElementById("lname");
const dob=document.getElementById('dob');
const address=document.getElementById('address');
const male=document.getElementById("male");
const female=document.getElementById('female');
const uid=document.getElementById("email");
const phone=document.getElementById('phone');
const password=document.getElementById("password");
const confirmPassword=document.getElementById('confirm');
const uidMessage=document.getElementById("uidError");
const minimum=Date.now()-100*31536000000;
const nameMessage=document.getElementById("nameErr");
const dobMessage=document.getElementById('dobErr');
const pwMessage=document.getElementById("pwErr");
const genderMessage=document.getElementById("genderError");
const addressMessage=document.getElementById("addressErr");
const confirmMessage=document.getElementById("confirmErr");
const phoneMessage=document.getElementById("phoneErr");
var id="", passkey="", uidErr='', pwErr='', genderErr="", confirmErr="", nameErr="", dobErr="", addressErr="", phoneErr;
const numbers=/^[0-9]+$/;
const word=/^[a-z]+$/i;
const words=/^[a-z]+( [a-z]+)*$/i;
const emails=/^[a-z0-9@.]+$/i;
const validity=/^[a-zA-Z0-9_ !@#$%^~&\*\-\=\+/.,]+$/
const email=/^[a-z]+[a-z0-9]*([.]{1}[a-z]+[a-z0-9]*)*[@]{1}([a-z]+(.){1})+[a-z]+$/i;
const addresses=/^(([0-9]+(( )|( - )|(-))[a-z]+(((,)|(, )|( ))[a-z]+)*)|(?:[a-z]+([ -][0-9]+)?(,?\s[a-z]+)*)|((?:[a-z]+,?\s[a-z]+)+(?:[ -][0-9]+)?))$/i;
form.addEventListener("submit", submitForm);
function submitForm(e){
    if(!form.checkValidity()){
        form.reportValidity();
        e.preventDefault();
        return;
    }
    id=uid.value;
    passkey=password.value;
    if(id && id.trim()!="") {
        var trimmedId=id.trim();
        if(emails.test(trimmedId)) {
            if(email.test(id)) uidErr="";
            else uidErr="Invalid Email format";
        }else uidErr="Invalid Email address";
    }else uidErr="Enter your email";
    if(passkey && passkey!=""){
        if(validity.test(passkey)){
            if(passkey.length<8) pwErr="Password must at least be 8 characters long";
            else pwErr="";
        }else pwErr="Password can only contain alphanumericals, space and ~!@#$%^&-*_=+/.,";
    }else pwErr="Password Required"
    if(fname!=null){
        var first=fname.value;
        var middle=mname.value;
        var last=lname.value;
        var date=dob.value;
        var location=address.value;
        var confirm=confirmPassword.value;
        var number=phone.value;
        nameErr="";
        dobErr="";
        confirmErr="";
        addressErr="";
        phoneErr="";
/*Name*/if(first && first.trim()){
            first=first.trim();
            if(word.test(first)){
                if(middle && middle.trim()){
                    middle=middle.trim();
                    if(!words.test(middle)) mname.value="";
                }
                if(last && last.trim()){
                    last=last.trim();
                    if(!word.test(last)) nameErr="Invalid Last name";
                }
            }else nameErr="Invalid First Name";
        }else nameErr="Enter valid first and last name";
/*DOB*/ if(date){
            var milliseconds=Date.parse(date);
            if(milliseconds<minimum || milliseconds>Date.now()) dobErr="Invalid date of birth";
        }else dobErr="Date of birth required";
/*Mobile Number*/
        if(number<9700000000 || number>9899999999) phoneErr="Invalid Mobile Number";
/*Address*/
        if(location && location.trim()){
            location=location.trim();
            if(!addresses.test(location)) addressErr="Invalid address format";
        }else addressErr="Address required";
/*Confirm Password*/
        if(pwErr==""){
            if(passkey!=confirm) confirmErr="Retype password in this field";
        }
/*Gender*/
        if(male.checked || female.checked) genderErr="";
        else genderErr="Select your gender";
/*Check Errors*/
        if(nameErr || dobErr || addressErr || confirmErr || genderErr || phoneErr) e.preventDefault();
        phoneMessage.innerHTML=phoneErr? `<br>${phoneErr}`:"";
        nameMessage.innerHTML=(nameErr=="")? "":`<br>${nameErr}`;
        dobMessage.innerHTML=(dobErr=="")? "":`<br>${dobErr}`;
        addressMessage.innerHTML=(addressErr=="")? "":`<br>${addressErr}`;
        genderMessage.innerHTML=(genderErr=="")? "":`<br>${genderErr}`;
        confirmMessage.innerHTML=(confirmErr=="")? "":`<br>${confirmErr}`;
    }
    if(uidErr || pwErr) e.preventDefault();
    uidMessage.innerHTML=uidErr? `<br>${uidErr}`:"";
    pwMessage.innerHTML=pwErr? `<br>${pwErr}`:"";
}
document.getElementById("reset").addEventListener("click", function(e){
    uidErr="";
    uidMessage.innerHTML="";
    pwErr="";
    pwMessage.innerHTML="";
    if(fname!=null){
        nameErr="";
        nameMessage.innerHTML="";
        dobErr="";
        dobMessage.innerHTML="";
        genderErr="";
        genderMessage.innerHTML="";
        phoneErr="";
        phoneMessage.innerHTML="";
        addressErr="";
        addressMessage.innerHTML="";
        confirmErr="";
        confirmMessage.innerHTML="";
    }
})