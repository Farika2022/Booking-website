//form 1

        function vfun(){
            var Uname=document.forms["myform"]["Uname"].value;
            var Upass=document.forms["myform"]["Upass"].value;

        if(Uname==null || Uname=="" ){
                  document.getElementById("errorBox").innerHTML =
                   "enter the user name";
                 return false;
        }

        if(Upass==null || Upass==""){
                  document.getElementById("errorBox").innerHTML =
                   "enter the password";
                 return false;
        }

        if (Uname != '' && Upass != '' ){
         alert("Login successfully");
                         }

        }

 //form 2

  function vfun1(){
            var Uname=document.forms["myform2"]["Uname"].value;
            var Upass=document.forms["myform2"]["Upass"].value;
            var Upass=document.forms["myform2"]["upswd2"].value;
			 var email=document.forms["myform2"]["email"].value;
		   var phone=document.forms["myform2"]["phone"].value;
		   var vehicle=document.forms["myform2"]["vehicle"].value;


        if(Uname==null || Uname=="" ){
                  document.getElementById("errorBox").innerHTML =
                   "enter the user name";
                 return false;
        }
		 if(Upass==null || Upass=="" ){
                  document.getElementById("errorBox").innerHTML =
                   "enter the password";
                 return false;
        }

        if(Upass2==null || Upass2==""){
                  document.getElementById("errorBox").innerHTML =
                   "enter the password";
                 return false;}

 		if(Upass != Upass2){
                  document.getElementById("errorBox").innerHTML =
                   "password dont match";
                 return false;}

        if(email==null || email==""){
                  document.getElementById("errorBox").innerHTML =
                   "enter the email";
                 return false;
        }
		 if(phone==null || phone==""){
                  document.getElementById("errorBox").innerHTML =
                   "enter the email";
                 return false;
        }
		 if(vehicle==null || vehicle==""){
                  document.getElementById("errorBox").innerHTML =
                   "enter the email";
                 return false;
        }
       

        

        if (Uname != '' && Upass != '' && Upass2 != '' && email != ''  && phone != '' && vehicle != ''&& Upass == Upass2)


          alert("Register successfull");
                         

        }