$(document).ready(function(){
	
	$.ajax({
		url:"data.php",
		type:"GET",
		
		
		success:function(data){
			
			//console.log(data);
			var booking_no=[];
			var MonthName=[];
			var colors=[];
			for(var i in data){
			   booking_no.push(data[i].booking_no);
			   MonthName.push(data[i].MonthName);
			   colors.push(color());
			}
			console.log(MonthName);
			console.log(booking_no);
			var chartdata={
			labels:MonthName,
				datasets:[{
					label:"Services",
					backgroundColor:colors,
				data:booking_no}
				]
			
				};
				var ctx=$("#mycanvas");
				var barGraph= new Chart(ctx,{
					type:'bar',
					data:chartdata,
				});
			
		},
		error:function(data, textstatus, jqXHR){
			console.log(jqXHR.responseText);
			//$('#post').html('Uncaught error .\n' + jqXHR.responseText); 			
			
			}
	});
	


	function color()
	{
		var r =Math.floor(Math.random()*256);
		var g =Math.floor(Math.random()*256);
		var b =Math.floor(Math.random()*256);
		var rgba ='rgba('+r+','+g+','+b+',1.0)';
		return rgba;
	}
});