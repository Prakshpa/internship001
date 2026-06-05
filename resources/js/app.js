import bcrypt from "bcrypt";
const submit=document.getElementById("submit");
const name=document.getElementById("name");
const uid=document.getElementById("uid");
const password=document.getElementById("password");
const uidMessage=document.getElementById("uidError");
const pwMessage=document.getElementById("pwErr");
var id="", passkey="", uidErr='', pwErr='';
const numbers=/^[0-9]+$/;
const emails=/^[a-z0-9@.]+$/i;
const validity=/^[a-zA-Z0-9_ !@#$%^~&\*\-\=\\\+\|/.,;:]+$/
const email=/^[a-z]+[a-z0-9]*([.]{1}[a-z]+[a-z0-9]*)*(@){1}([a-z]+(.)?)*[a-z]+$/i;
submit.addEventListener("click", submit)
function submit(e){
    e.preventDefault();
    id=uid.nodeValue;
    passkey=password.nodeValue;
    if(id && id.trim()) {
        var trimmedId=id.trim();
        if(numbers.test(trimmedId)){
            var number=parseInt(trimmedId, 10);
            if(number<9700000000 || number>9899999999) uidErr="Invalid Mobile Number";
            else uidErr="";
        }else if(emails.test(trimmedId)) {
            if(email.test(id)) uidErr="";
            else uidErr="Invalid Email format";
        }else uidErr="Invalid Email or phone";
    }else uidErr="Enter email or phone";
    if(validity.test(passkey)){
        if(passkey.length<8) pwErr="Password must at least be 8 characters long";
        else pwErr="";
    }else pwErr="A password can only contain alphabets, numbers and ~!@#$%^&*_=+/.,";
    if(uidErr || pwErr) {
        e.preventDefault();
        uidMessage.innerHTML=uidErr? `<br>${uidErr}`:"";
        pwMessage.innerHTML=pwErr? `<br>${pwErr}`:"";
    }
}