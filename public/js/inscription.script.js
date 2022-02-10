window.onload = function (){

    var name = document.getElementById("name");
    var validNameIcon = document.getElementById("validNameIcon");
    var invalidNameIcon = document.getElementById("invalidNameIcon");
    var validNameMsg = document.getElementById("validNameMsg");
    var invalidNameMsg = document.getElementById("invalidNameMsg");

    var email = document.getElementById("email");
    var validEmailIcon = document.getElementById("validEmailIcon");
    var invalidEmailIcon = document.getElementById("invalidEmailIcon");
    var validEmailMsg = document.getElementById("validEmailMsg");
    var invalidEmailMsg = document.getElementById("invalidEmailMsg");

    var pwd = document.getElementById("pwd");
    var validPwdIcon = document.getElementById("validPwdIcon");
    var invalidPwdIcon = document.getElementById("invalidPwdIcon");
    var validPwdMsg = document.getElementById("validPwdMsg");
    var invalidPwdMsg = document.getElementById("invalidPwdMsg");

    //Event Listeners

    document.getElementById("submit").addEventListener("click", function(){
        if( name_is_valid() && email_is_valid() && pwd_is_valid() ){
     
            var data = {
                user_name: name.value,
                user_email: email.value,
                user_password: pwd.value
            }
            var xhr = new XMLHttpRequest();

            xhr.open("POST", "/public/users/create.php", true);
            xhr.onreadystatechange = function(){
                if(this.readyState === 4 && ( (this.status >= 200) && (this.status < 400) )){
                    var _data = JSON.parse(this.responseText);
                    alert(_data.message);
                }
            }
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.responseType = "text";
            xhr.send(serilizeData(data));
        }
    });

    //Events handlers
    function name_is_valid(){
        if( (name.value.length < 3) || (name.value.length > 30)){
            if( validNameMsg.className.search(" is-hidden") < 0){
                validNameMsg.className += " is-hidden";
            }
            if( validNameIcon.className.search(" is-hidden") < 0){
                validNameIcon.className += " is-hidden";
            }
            
            invalidNameIcon.className = invalidNameIcon.className.replace(" is-hidden", "");
            invalidNameMsg.className = invalidNameMsg.className.replace(" is-hidden", "");
            return false;
        }else{
            if( invalidNameMsg.className.search(" is-hidden") < 0){
                invalidNameMsg.className += " is-hidden";
            }
            if( invalidNameIcon.className.search(" is-hidden") < 0){
                invalidNameIcon.className += " is-hidden";
            }
            validNameIcon.className = validNameIcon.className.replace(" is-hidden", "");
            validNameMsg.className = validNameMsg.className.replace(" is-hidden", "");
            return true;
        }
    }

    function pwd_is_valid(){
        if( (pwd.value.length < 6) || (pwd.value.length > 64)){
            if( validPwdMsg.className.search(" is-hidden") < 0){
                validPwdMsg.className += " is-hidden";
            }

            if( validPwdIcon.className.search(" is-hidden") < 0){
                validPwdIcon.className += " is-hidden";
            }

            invalidPwdIcon.className = invalidPwdIcon.className.replace(" is-hidden", "");
            invalidPwdMsg.className = invalidPwdMsg.className.replace(" is-hidden", "");

            return false;
        }else{
            if( invalidPwdMsg.className.search(" is-hidden") < 0){
                invalidPwdMsg.className += " is-hidden";
            }

            if( invalidPwdIcon.className.search(" is-hidden") < 0){
                invalidPwdIcon.className += " is-hidden";
            }
            validPwdIcon.className = validPwdIcon.className.replace(" is-hidden", "");
            validPwdMsg.className = validPwdMsg.className.replace(" is-hidden", "");

            return true;
        }
    }

    function email_is_valid(){
        var pattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        if( !pattern.test(email.value)){
            if( validEmailMsg.className.search(" is-hidden") < 0){
                validEmailMsg.className += " is-hidden";
            }

            if( validEmailIcon.className.search(" is-hidden") < 0){
                validEmailIcon.className += " is-hidden";
            }

            invalidEmailIcon.className = invalidEmailIcon.className.replace(" is-hidden", "");
            invalidEmailMsg.className = invalidEmailMsg.className.replace(" is-hidden", "");

            return false;
        }else{
            if( invalidEmailMsg.className.search(" is-hidden") < 0){
                invalidEmailMsg.className += " is-hidden";
            }

            if( invalidEmailIcon.className.search(" is-hidden") < 0){
                invalidEmailIcon.className += " is-hidden";
            }
            validEmailIcon.className = validEmailIcon.className.replace(" is-hidden", "");
            validEmailMsg.className = validEmailMsg.className.replace(" is-hidden", "");

            return true;
        }
    }

    //Helpers functions
    function serilizeData(objData){
        var urlEncodedData = "";
        var urlEncodedDataPairs = [];
        var name;
        for(name in objData) {
            urlEncodedDataPairs.push(encodeURIComponent(name) + '=' + encodeURIComponent(objData[name]));
        }
        urlEncodedData = urlEncodedDataPairs.join('&').replace(/%20/g, '+');
        return urlEncodedData;
    }
}