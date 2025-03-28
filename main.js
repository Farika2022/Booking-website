var menuIcon = document.getElementById("menu-icon");
var slideoutMenu = document.getElementById("slideout-menu");
var searchIcon = document.getElementById("search-icon");
var searchBox = document.getElementById("searchbox");


searchIcon.addEventListener('click', function () {
  if (searchBox.style.top == '60px') {
    searchBox.style.top = '-48px';
    searchBox.style.pointerEvents = 'none';
  } else {
    searchBox.style.top = '60px';
    searchBox.style.pointerEvents = 'auto';
  }
});

menuIcon.addEventListener('click', function () {
  if (slideoutMenu.style.opacity == "1") {
    slideoutMenu.style.opacity = '0';
    slideoutMenu.style.pointerEvents = 'none';
  } else {
    slideoutMenu.style.opacity = '1';
    slideoutMenu.style.pointerEvents = 'auto';
  }
})




		// alert for Booking page


function myFunction() {

if (isset($_SESSION['loggedin']) 
  && $_SESSION['loggedin'] == false) { 
       <!-- display message -->
  }else if (confirm("Please login before Booking!"))
 {
 self.location = 'bookwash.html'}
 else
 {
 history.go(1);
    }
}
		
		




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
	   //do nothing
        return true;
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
                   "enter the phone no";
                 return false;
        }
		 if(vehicle==null || vehicle==""){
                  document.getElementById("errorBox").innerHTML =
                   "enter the vehicle";
                 return false;
        }
       

        

        if (Uname != '' && Upass != '' && Upass2 != '' && email != ''  && phone != '' && vehicle != ''&& Upass == Upass2)

		{
          alert("Register successfull");
                         

        }

  }
  
  
  //Booking Form Validation
   //form 2

  function bookingFormVal(){
            var fname=document.forms["myform3"]["fname"].value;
            var lname=document.forms["myform3"]["lname"].value;
            var phone=document.forms["myform3"]["phone"].value;
			var location =document.forms["myform3"]["location"].value;
		   var timeslot=document.forms["myform3"]["timeslot"].value;
		   var calender=document.forms["myform3"]["calendar"].value;
		   var vehicle=document.forms["myform3"]["vehicle"].value;
		   var type=document.forms["myform3"]["type"].value;


        if(fname==null || fname=="" ){
                  document.getElementById("errorBox").innerHTML =
                   "enter the First name";
                 return false;
        }
		 if(lname==null || lname=="" ){
                  document.getElementById("errorBox").innerHTML =
                   "enter the Last name";
                 return false;
        }

        if(phone==null || phone==""){
                  document.getElementById("errorBox").innerHTML =
                   "enter the phone no";
                 return false;}

 		

        if(location==null || location==""){
                  document.getElementById("errorBox").innerHTML =
                   "enter the location";
                 return false;
        }
		 if(timeslot==null || timeslot==""){
                  document.getElementById("errorBox").innerHTML =
                   "enter the time slot";
                 return false;
        }
		 if(calendar==null || calendar==""){
                  document.getElementById("errorBox").innerHTML =
                   "enter the date";
                 return false;
        }
        
		 
		if(type==null || type==""){
                  document.getElementById("errorBox").innerHTML =
                   "enter the type of wash";
                 return false;
        }
       

        

        if (fname != '' && lname != '' && phone != '' && location != ''  && timeslot != '' && calendar != ''&& vehicle != ''&& type != '')

		{
          alert("Booking successfull");
                         

        }

  }
  
  //form 3

        function vfun2(){
            var Aname=document.forms["myform"]["Aname"].value;
            var Apass=document.forms["myform"]["Apass"].value;

        if(Aname==null || Aname=="" ){
                  document.getElementById("errorBox").innerHTML =
                   "enter the user name";
                 return false;
        }

        if(Apass==null || Apass==""){
                  document.getElementById("errorBox").innerHTML =
                   "enter the password";
                 return false;
        }

        if (Uname != 'farook MFA' && Upass != 'MFA farook' )

		{
          alert(" ADMIN Login successfull");
                         

        }
      } 