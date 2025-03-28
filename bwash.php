<?php
session_start();
include("connection.php");
include("functions.php");
 $user_data=check_login($con);

function build_calendar($month, $year) {
    $mysqli = new mysqli('localhost', 'root', '', 'mfa website');
    
    // Create array containing abbreviations of days of week.
    $daysOfWeek = array('Sunday', 'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');

    // What is the first day of the month in question?
    $firstDayOfMonth = mktime(0,0,0,$month,1,$year);

    // How many days does this month contain?
    $numberDays = date('t',$firstDayOfMonth);

    // Retrieve some information about the first day of the
    // month in question.
    $dateComponents = getdate($firstDayOfMonth);

    // What is the name of the month in question?
    $monthName = $dateComponents['month'];

    // What is the index value (0-6) of the first day of the
    // month in question.
    $dayOfWeek = $dateComponents['wday'];

    // Create the table tag opener and day headers
     
    $datetoday = date('Y-m-d');
    $calendar = "<table class='table table-bordered'>";
    $calendar .= "<center><h2>$monthName $year</h2>";
    $calendar.= "<a class='btn btn-xs btn-primary' href='?month=".date('m', mktime(0, 0, 0, $month-1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month-1, 1, $year))."'>Previous Month</a> ";
    
    $calendar.= " <a href='bwash.php' class='btn btn-xs btn-primary' data-month='".date('m')."' data-year='".date('Y')."'>Current Month</a> ";
    
    $calendar.= "<a href='?month=".date('m', mktime(0, 0, 0, $month+1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month+1, 1, $year))."' class='btn btn-xs btn-primary'>Next Month</a></center><br>";
    
    $calendar .= "<tr>";

    // Create the calendar headers
    foreach($daysOfWeek as $day) {
        $calendar .= "<th  class='header'>$day</th>";
    } 
    
    // Create the rest of the calendar
    // Initiate the day counter, starting with the 1st.
    $currentDay = 1;
    $calendar .= "</tr><tr>";

     // The variable $dayOfWeek is used to
     // ensure that the calendar
     // display consists of exactly 7 columns.

    if($dayOfWeek > 0) { 
        for($k=0;$k<$dayOfWeek;$k++){
            $calendar .= "<td  class='empty'></td>"; 
        }
    }
    
     
    $month = str_pad($month, 2, "0", STR_PAD_LEFT);
    
    while ($currentDay <= $numberDays) {
         //Seventh column (Saturday) reached. Start a new row.
         if ($dayOfWeek == 7) {
             $dayOfWeek = 0;
             $calendar .= "</tr><tr>";
         }
          
         $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
         $date = "$year-$month-$currentDayRel";
         $dayname = strtolower(date('l', strtotime($date)));
         $eventNum = 0;
		
         $today = $date==date('Y-m-d')? "today" : "";
		 if($dayname=='sunday'){
		  $calendar.="<td><h5>$currentDay</h5> <button class='btn btn-danger btn-xs'>Holiday</button>";
		 }else if($date<=date('Y-m-d')){
             $calendar.="<td class='$today'><h5>$currentDay</h5> <button class='btn btn-danger btn-xs'>N/A</button>";
          }else{
             $calendar.="<td ><h5>$currentDay</h5> <a href='book.php?date=".$date."' class='btn btn-success btn-xs'>Book</a>";
         }
         
         
         $calendar .="</td>";
         //Increment counters
         $currentDay++;
         $dayOfWeek++;
     }
     
     //Complete the row of the last week in month, if necessary
     if ($dayOfWeek != 7) { 
        $remainingDays = 7 - $dayOfWeek;
        for($l=0;$l<$remainingDays;$l++){
            $calendar .= "<td class='empty'></td>"; 
        }
     }
     
    $calendar .= "</tr>";
    $calendar .= "</table>";
    return $calendar;
}

?>
<html>
	<head>
				<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt"
			crossorigin="anonymous">
			<link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Condensed|Roboto+Slab" rel="stylesheet">
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
		         <link rel="stylesheet" href="style2.css">
</head>
 <body>
 
	<div class="container">
        <div class="row">
           <div class="col-md-12">
		   <div id="calendar"> 
		   <br>
		   <br>
		   <br>
		   <br>
		   <font face="Blackadder ITC"size="6"color="black"><b> Welcome ,<?php echo $user_data['Uname'];?></b></font>
		 <br>
		 <br>
		 <br>
		 <a href="userview.php"align="float:right" class="btn btn-info" role="button" ></i>Status</a>
		 
		 <?php
		   $dateComponents=getdate();
		   if(isset($_GET['month'])&&isset($_GET['year'])){
		   $month=$_GET['month'];
		   $year=$_GET['year'];
		   }else{
		   $month=$dateComponents['mon'];
		   $year=$dateComponents['year'];
		   }
		   echo build_calendar($month,$year);
		   ?>
         </div> 
       </div> 
    </div>
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
 
 
  <!-- Register script-->
<script
src='https://code.jquery.com/jquery-3.2.1.min.js'>
</script>

<script>
$('.message a').click(function(){
$('form').animate({height:"toggle",opacity:"toggle"},"slow");
});
</script>
 <script>
function myFunction(x) {
  x.classList.toggle("change");
}
</script>    
                     
  <script src="main.js"></script>

 </body>

</html>

		
		
		
		
		
		
		
		
		
		
		
		
		
		
