<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="http://openlayers.org/api/OpenLayers.js"></script>
    <script src="moment.js"></script>
    <script src="moment-timezone.js"></script>
  
  

    <style type="text/css">
    body{
            background-image:url('http://cs-server.usc.edu:45678/hw/hw8/images/bg.jpg');
            background-repeat: no-repeat;
            background-size:cover;
        }
            
           
            .red{
               color: red;
            }
            
            img#logo {  
                width: 70px; 
                height:50px;  
               
            }
            
            .jumbotron{
                background-color: rgba(50, 50, 50, 0.25);
                padding: 10px !important;
              
            }
            .white{
                color: white;
            }
        
            #rightNow th{
                background-color: #F47D7D;
                align: right; 
            }
            
            table#rightNow th{
                border-top: 0px none !important;
            }
        
            
            #rightNow tr:nth-child(odd) {
              background-color: #F3DEDE;
              color: black;
            }

            #rightNow tr:nth-child(even) {
              background-color: #F9F9F9;
              color: black;
            }
        
            #hourly th{
                background-color: #2C70AB;
                color: white;
            }
        
            #hourly tr{
                background-color: #FFFFFF;
            }
            #hourly td,th{
                text-align: center;
            }
            #hourly img{
                width: 100px;
                height: 70px;
            }
        
            .glyphicon-plus{
                color: #2C70AB;
            }
        
            #weekDisplay{
                background-color: #2F3439;
                padding-left: 5%;
            }
        
            @media (max-width: 320px) {
            #extab li a{
                width: 50px;
            }
                
             ul.nav.nav-pills.col-xs-12.col-sm-12 li a{
                 width: 80px !important;
            }
                
            #hourly{
                width: 100% !important;
            }
                
            #weekDisplay{
                background-color: rgba(254,254,254,0.1);
            }
            }
           #one{
                background-color: #327CB7;
                border-radius: 7px;
                margin: 1%;
            }
            #dayOne td,#dayOne th,#dayTwo td,#dayTwo th,#dayThree th,#dayThree td,#dayFour td,#dayFour th,#dayFive th,#dayFive td,#daySix th,#daySix td,#daySeven td,#daySeven th, .borderless th, .borderless td{
                width: 100px;
                text-align: center;
                margin-top: 20px;
                border-top: none !important;
            }
        
            
        
            #two{
                background-color: #EF423E;
               
                border-radius: 7px;
                margin: 1%;
            }
            
           #three{
                background-color: #E88E48;
               
                border-radius: 7px;
                margin: 1%;
            }
            
            #four{
                background-color: #A7A52E;
              
                border-radius: 7px;
                margin: 1%;
            }
            
            #five{
                background-color: #986EA8;
               
                border-radius: 7px;
                margin: 1%;
            }
        
           
        
            #six{
                background-color: #F57B7C;
               
                border-radius: 7px;
                margin: 1%;
            }
        
            #seven{
                background-color: #D04270;
              
                border-radius: 7px;
                margin: 1%;
            }
        
            #extab .nav-pills > li > a {
              border-radius: 4px 4px 0 0 ;
            }

            #extab li a {
              color : #428bca;
              background-color: white;
              padding : 5px 15px;
            }
            
            #extab .nav-pills > li.active > a,
            #extab .nav-pills > li.active > a:hover,
            #extab .nav-pills > li.active > a:focus{
                color: white;
                background-color: #428bca;  
            } 
            
           #innertable th{
               background-color: white;
               color: black;
           }
            #innertable td{
               background-color: #EFEFEF;
           }
        
        
            #temp{
                font-size: 50px;
            }
        
            #weekDisplay li{
                line-height: 20px;
            }
            .blue{
                color: blue;
            }
        
            .green{
                color: green;
            }
            sup{
                font-size: 10px;
            }
            .firstCenter{
                text-align: center;
            }
        
            #basicMap{
                width: 570px;
                height: 460px;
                padding-left: 0px;
            }
        .modal img{
            width: 25%;
            height: 25%;
        }
        #extab{
            display:none;
        }
        
        strong {
            font-size:120%;
        }
                
           
    </style>
    <script>
       var FC; 
    $(document).ready(function() {
	   //$("#submit1").click(function(event){
        
            
            jQuery.validator.addMethod( 
              "selectNone", 
              function(value, element) { 
                if (element.value == "none") 
                { 
                  return false; 
                } 
                else return true; 
              }, 
              "Please select an option." 
            ); 
           
            $("#myForm").validate({
                rules: {
                    address: {
						required: {
                            depends:function(){
								$(this).val($.trim($(this).val()));
								return true;
							     }
                        }
				    },
                    city: {
						required: {
                                depends:function(){
								$(this).val($.trim($(this).val()));
                        		return true;
                                }
                            }
						},
					state: {
						required: true
					}
                },
                messages: {
                    address: "Please enter valid address",
                    city: "Please enter your city",
                    state: "Please enter a state"
                },
                errorPlacement: function (error, element){                                    
                                    if (element.attr("name") == "address" ){
                                    error.css('color','red');
                                    error.appendTo("#streetError");
                                    } else if (element.attr("name") == "city" ) {
                                        error.css('color','red');
                                        error.insertAfter("#cityError");
                                    } else if (element.attr("name") == "state" )  {
                                        error.css('color','red');
                                        error.insertAfter("#stateError");
                                    }
                                },
                      submitHandler: function(form){                                 
				
                     $.ajax({
                    type: 'GET',
                    url: 'forecastValidate.php',
                    data: $('form').serialize(),
                    datatype: "json",
                    success: function (data) {
                    
                  $("#extab").css("display","block");       
                $("#outer").css("display","block");
                
                json_data = JSON.parse(data);
                
                 windVal = "",visiVal = "",pressureVal = "",deg_val = "";
                getMap(json_data.longitude,json_data.latitude);
               
                current_timezone = json_data.timezone;

                  var degree=$("input:radio[name='degree']:checked").val();
               
                                 if(degree=='Celsius'){
                                    FC='si';
                                    deg_val='C';
                                 }
                                 else{
                                     FC='us';
                                     deg_val='F';
                                 }
                                if(FC=='si')
                                {
                                    windVal = "m/s";
                                    visiVal = "km";
                                    pressureVal = "hPa";
                                    deg_val = "C";
                                }

                                if(FC=='us')
                                {
                                    windVal = "mph";
                                    visiVal = "mi";
                                    pressureVal = "mb";
                                    deg_val = "F";
                                }
                 
                firstRowVal=json_data.currently.summary+" in "+$("#city").val()+","+$("#state").val();
                    temperatureVal=Math.round(json_data.hourly.data[0].temperature) + "&deg<sup>"+deg_val+"</sup>" ;
                    lowsAndHighs="<span class='blue'>L:"+(json_data.daily.data[0].temperatureMin.toFixed(2))+"&deg </span><span class='green'>|H: "+(json_data.daily.data[0].temperatureMax.toFixed(2))+"&deg </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='http://cs-server.usc.edu:45678/hw/hw8/images/fb_icon.png' height='20px' width='20px' onclick='share()'>";
                
                
                switch(json_data.currently.icon){
                         case 'clear-day': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/clear.png' width='140px' height='120px'>";
                                            break;
                         case 'clear-night': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/clear_night.png' width='140px' height='120px'>";
                                            break;
                         case 'rain': icon="<img src=http://cs-server.usc.edu:45678/hw/hw8/images/rain.png width='140px' height='120px'>";
                                        break;
                         case 'snow': icon="<img src=http://cs-server.usc.edu:45678/hw/hw8/images/snow.png width='140px' height='120px'>";
                                        break;
                         case 'sleet': icon="<img src=http://cs-server.usc.edu:45678/hw/hw8/images/sleet.png width='140px' height='120px'>";
                                        break;
                         case 'wind': icon="<img src=http://cs-server.usc.edu:45678/hw/hw8/images/wind.png width='140px' height='120px'>";
                                        break;
                         case 'fog': icon="<img src=http://cs-server.usc.edu:45678/hw/hw8/images/fog.png width='140px' height='120px'>";
                                    break;
                         case 'cloudy': icon="<img src=http://cs-server.usc.edu:45678/hw/hw8/images/cloudy.png width='140px' height='120px'>";
                                        break;
                         case 'partly-cloudy-day': icon="<img src=http://cs-server.usc.edu:45678/hw/hw8/images/cloud_day.png width='140px' height='120px'>";
                                                    break;
                         case 'partly-cloudy-night': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/cloud_night.png' align='width='140px' height='120px'>";
                                                        break;
                         default: icon="<img src=http://cs-server.usc.edu:45678/hw/hw8/images/wind.png>";
                                        break;
					}
                    
                    $("#rightNow").append("<tr><th rowspan='3'>"+icon+"</th><th><span class='white'>"+firstRowVal+"</span></th></tr><tr><th id='temp'><span class='white'>"+temperatureVal+"</span></th></tr><tr><th >"+lowsAndHighs+"</th></tr>");
                
                var precip = "",rain = "", dew="", humidity="", wind="",visibility="",sunsetTime="",sunriseTime="";
                    precip == json_data.currently.precipIntensity;
                        
                        if((precip>=0) && (precip<0.002)){
                            precip="None";
                        }else if((precip>=0.002) && (precip<0.017)){
                            precip="Very Light";
                        }else if((precip>=0.017) && (precip<0.1)){
                            precip="Light";
                        }else if((precip>=0.1) && (precip<0.4)){
                            precip="Moderate";
                        }else if(precip>=0.4){
                            precip="Heavy";
                        }
                        $("#rightNow").append("<tr><td>Precipitation</td><td class='firstCenter'>"+precip+"</td></tr>");
                    
                  
                    //Chance of Rain
                
                        rain=json_data.currently.precipProbability;
                        rain=(rain*100)+"%";
                        $("#rightNow").append("<tr><td>Chance of Rain</td><td class='firstCenter'>"+rain+"</td></tr>");
                    
                    //Wind Speed
                   
                        wind=json_data.currently.windSpeed;
                        if(FC=="us"){
                            wind=wind+" mph";
                        }else{	
                            wind=wind+" m/s";
                    }
                    $("#rightNow").append("<tr><td>WindSpeed</td><td class='firstCenter'>"+wind+"</td></tr>");
			       
                    
                    //Dew Point
                    
                        dew=json_data.currently.dewPoint;
                        if(FC=="us"){
                            dew=dew+"&deg" +deg_val;	
                        }else{
                            dew=dew+"&deg" +deg_val;
                        }
                        $("#rightNow").append("<tr><td>Dew Point</td><td class='firstCenter'>"+dew+"</td></tr>");
                    
                  
                    //Humidity
                        humidity=json_data.currently.humidity;
                        humidity=(Math.round(humidity)*100)+"%";
                        $("#rightNow").append("<tr><td>Humidity</td><td class='firstCenter'>"+humidity+"</td></tr>");
                   
                    
                    //Visibility             
                        visibility=json_data.currently.visibility;
                        if(FC=="us"){
                            visibility=visibility+" mi";	
                        }else{
                            visibility=visibility+" km";
                    }
                    $("#rightNow").append("<tr><td>Visibility</td><td class='firstCenter'>"+visibility+"</td></tr>");
			     
                    //Sunset time
                    //sunsetTime=json_data.currently.sunsetTime;
                  
                    convertedTime=new Date((json_data.daily.data[0].sunriseTime)*1000);
                        if(convertedTime.getHours() > 12){
                            value=("0" + (convertedTime.getHours()%12))+":"+(("0" + (convertedTime.getMinutes())).slice(-2))+" PM";
                        }
                        else{
                            value=(("0" + (convertedTime.getHours())).slice(-2))+":"+(("0" + (convertedTime.getMinutes())).slice(-2))+" AM";
                           }
                        sunRise=value; 
                    $("#rightNow").append("<tr><td>Sunset Time</td><td class='firstCenter'>"+getTimeZone(current_timezone,json_data.daily.data[0].sunriseTime)+"</td></tr>");
                    
                    
                        convertedTime=new Date((json_data.daily.data[0].sunsetTime)*1000);
                        if(convertedTime.getHours() > 12){
                            value=("0" + (convertedTime.getHours()%12))+":"+(("0" + (convertedTime.getMinutes())).slice(-2))+" PM";
                        }
                        else{
                            value=(("0" + (convertedTime.getHours())).slice(-2))+":"+(("0" + (convertedTime.getMinutes())).slice(-2))+" AM";
                           }
                        sunSet=value; 
                    
                    $("#rightNow").append("<tr><td>Sunrise Time</td><td class='firstCenter'>"+getTimeZone(current_timezone,json_data.daily.data[0].sunsetTime)+"</td></tr>");
            
                 
                    
        var rowentry = "",count=1; 
        var time_vale="",summary_value="",cloud_value="",temp_value="",detail_value="",rowentry="";
        var wind = humidity = visibility = pressure =" ";
        
        var firstFlag = 'true';
        rowentry+="<tr><th>Time</th><th>Summary</th><th>Cloud Value</th><th>Temp("+"&deg"+deg_val+")</th><th>View Details</th></tr>";
		$.each(json_data.hourly.data, function(key,value){

                firstFlag='false';
            rowentry+="<tr>";
			   $.each(this, function(key,value){	
				  if((key=="time") || (key=="icon") ||(key=="cloudCover")||(key=="temperature")){
					if(key=="time"){
                        time_value=getTimeZone(current_timezone,value);
						/*convertedTime=new Date(value*1000);
                        if(convertedTime.getHours() > 12){
                            value=("0" + (convertedTime.getHours())%12)+":"+(("0" + (convertedTime.getMinutes())).slice(-2))+" PM";
                        }
                        else{
                            value=(("0" + (convertedTime.getHours())).slice(-2))+":"+(("0" + (convertedTime.getMinutes())).slice(-2))+" AM";
                           }*/
                        
                        }
                     if(key=="icon")
                        {
                        switch(value){
                         case 'clear-day': value="<img src=http://cs-server.usc.edu:45678/hw/hw8/images/clear.png>";
                                            break;
                         case 'clear-night': value="<img src=http://cs-server.usc.edu:45678/hw/hw8/images/clear_night.png>";
                                            break;
                         case 'rain': value="<img src=http://cs-server.usc.edu:45678/hw/hw8/images/rain.png>";
                                        break;
                         case 'snow': value="<img src=http://cs-server.usc.edu:45678/hw/hw8/images/snow.png>";
                                        break;
                         case 'sleet': value="<img src=http://cs-server.usc.edu:45678/hw/hw8/images/sleet.png>";
                                        break;
                         case 'wind': value="<img src=http://cs-server.usc.edu:45678/hw/hw8/images/wind.png>";
                                        break;
                         case 'fog': value="<img src=http://cs-server.usc.edu:45678/hw/hw8/images/fog.png>";
                                    break;
                         case 'cloudy': value="<img src=http://cs-server.usc.edu:45678/hw/hw8/images/cloudy.png>";
                                        break;
                         case 'partly-cloudy-day': value="<img src=http://cs-server.usc.edu:45678/hw/hw8/images/cloud_day.png>";
                                                    break;
                         case 'partly-cloudy-night': value="<img src=http://cs-server.usc.edu:45678/hw/hw8/images/cloud_night.png>";
                                                        break;
                         default: value="<img src=http://cs-server.usc.edu:45678/hw/hw8/images/wind.png>";
                                        break;
					}
                    summary = value;
                    }
                    if(key=="cloudCover")
                        cloud_value=value;
                      
                    if(key=="temperature")
                        temp_value=value;
                      
					
                    }
                    
                    if(key=="windSpeed")wind=value;
                    if(key=="humidity")humidity=value;
                    if(key=="visibility")visibility=value;
                    if(key=="pressure")pressure=value;
			     });
            
            
         
                rowentry+="<td>"+time_value+"</td><td>"+summary+"</td><td>"+cloud_value+"</td><td>"+temp_value+"</td>"; 
			    rowentry+="<td><span class='glyphicon glyphicon-plus' data-toggle='collapse' data-target='#collapse"+count+"'></span></td></tr>";
                rowentry+="<tr class='collapse out' id='collapse"+count+"'><td colspan=5  style='background-color:#EFEFEF'>";
                rowentry+="<div><table class='table' id='innertable'><tr><th>Wind</th><th>Humidity</th><th>Visibility</th><th>Pressure</th></tr>";
                rowentry+="<tr><td>"+wind+" "+windVal+"</td><td>"+humidity*100+"%</td><td>"+visibility+" " + visiVal+"</td><td>"+pressure+""+pressureVal+"</td></tr></table>";
                rowentry+="</div></td></tr>";
                 rowentry+="<\tr>";
                count=count+1;
            
		  });
                
            $("#hourly").append(rowentry);
              
           //Tab 3  
                var summary = [];
            $.each(json_data.daily.data[1],function(key,value){
                if(key=="time")
                {
                        var dateVal =new Date(value*1000);
                        
                        var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
                        var val=days[dateVal.getDay()];
                        var day=val;
                        
                        $("#dayOne").append("<tr><td style='font-size:11px'>"+day+"</td></tr>");
                
                        //Extract months and day
                        dateVal =new Date(value*1000);
                        var month = ["Jan","Feb","March","April","May","June","July","Aug","Sept","Oct","Nov","Dec"];
                        var val= month[dateVal.getMonth()]+" "+dateVal.getDate();
                        $("#dayOne").append("<tr><td>"+val+"</td></tr>");
                }
                    icon="";
                     if(key=="icon")
                        {
                        switch(value){
                        case 'clear-day': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/clear.png' width='50px' height='50px'>";
                                            break;
                         case 'clear-night': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/clear_night.png' width='50px' height='50px'>";
                                            break;
                         case 'rain': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/rain.png' width='50px' height='50px'>";
                                        break;
                         case 'snow': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/snow.png' width'='50px' height='50px'>";
                                        break;
                         case 'sleet': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/sleet.png' width='50px' height='50px'>";
                                        break;
                         case 'wind': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/wind.png' width='50px' height='50px'>";
                                        break;
                         case 'fog': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/fog.png' width='50px' height='50px'>";
                                    break;
                         case 'cloudy': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/cloudy.png' width='50px' height='50px'>";
                                        break;
                         case 'partly-cloudy-day': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/cloud_day.png' width='50px' height='50px'>";
                                                    break;
                         case 'partly-cloudy-night': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/cloud_night.png' width='50px' height='50px'>";
                                                        break;
                         default: icon="<img src=http://cs-server.usc.edu:45678/hw/hw8/images/wind.png>";
                                        break;
					}
                    summary[1] = icon;
                    
                    $("#dayOne").append("<tr><td>"+icon+"</td></tr>");
                }
                
            
                if(key=="temperatureMin")
                {
                    val=Math.round(value);
                    $("#dayOne").append("<tr><td>Min</td></tr>");
                    $("#dayOne").append("<tr><td>Temp</td></tr>");
                    $("#dayOne").append("<tr><td style='font-size:200%;font-weight:bold'>"+val+"&deg"+"</td></tr>");
                }
                
                if(key=="temperatureMax")
                {
                    val=Math.round(value);
                    $("#dayOne").append("<tr><td>Max</td></tr>");
                    $("#dayOne").append("<tr><td>Temp</td></tr>");
                    $("#dayOne").append("<tr><td style='font-size:200%;font-weight:bold'>"+val+"&deg"+"</td></tr>");
                }
                
                
                
              });
                //Second Day
                $.each(json_data.daily.data[2],function(key,value){
                if(key=="time")
                {
                        var dateVal =new Date(value*1000);
                        
                        var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
                        var val=days[dateVal.getDay()];
                        var day=val;
                        
                        $("#dayTwo").append("<tr><td style='font-size:11px'>"+day+"</td></tr>");
                
                        //Extract months and day
                        dateVal =new Date(value*1000);
                        var month = ["Jan","Feb","March","April","May","June","July","Aug","Sept","Oct","Nov","Dec"];
                        var val= month[dateVal.getMonth()]+" "+dateVal.getDate();
                        $("#dayTwo").append("<tr><td>"+val+"</td></tr>");
                }
                    icon="";
                     if(key=="icon")
                        {
                        switch(value){
                        case 'clear-day': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/clear.png' width='50px' height='50px'>";
                                            break;
                         case 'clear-night': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/clear_night.png' width='50px' height='50px'>";
                                            break;
                         case 'rain': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/rain.png' width='50px' height='50px'>";
                                        break;
                         case 'snow': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/snow.png' width'='50px' height='50px'>";
                                        break;
                         case 'sleet': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/sleet.png' width='50px' height='50px'>";
                                        break;
                         case 'wind': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/wind.png' width='50px' height='50px'>";
                                        break;
                         case 'fog': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/fog.png' width='50px' height='50px'>";
                                    break;
                         case 'cloudy': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/cloudy.png' width='50px' height='50px'>";
                                        break;
                         case 'partly-cloudy-day': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/cloud_day.png' width='50px' height='50px'>";
                                                    break;
                         case 'partly-cloudy-night': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/cloud_night.png' width='50px' height='50px'>";
                                                        break;
                         default: icon="<img src=http://cs-server.usc.edu:45678/hw/hw8/images/wind.png>";
                                        break;
					}
                    summary[2] = icon;
                    
                    $("#dayTwo").append("<tr><td>"+icon+"</td></tr>");
                }
                
            
                if(key=="temperatureMin")
                {
                    val=Math.round(value);
                    $("#dayTwo").append("<tr><td>Min</td></tr>");
                    $("#dayTwo").append("<tr><td>Temp</td></tr>");
                    $("#dayTwo").append("<tr><td style='font-size:200%;font-weight:bold'>"+val+"&deg"+"</td></tr>");
                }
                
                if(key=="temperatureMax")
                {
                    val=Math.round(value);
                    $("#dayTwo").append("<tr><td>Max</td></tr>");
                    $("#dayTwo").append("<tr><td>Temp</td></tr>");
                    $("#dayTwo").append("<tr><td style='font-size:200%;font-weight:bold'>"+val+"&deg"+"</td></tr>");
                }
                
                
                
              });
                
                $.each(json_data.daily.data[3],function(key,value){
                if(key=="time")
                {
                        var dateVal =new Date(value*1000);
                        
                        var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
                        var val=days[dateVal.getDay()];
                        var day=val;
                        
                        $("#dayThree").append("<tr><td style='font-size:11px'>"+day+"</td></tr>");
                
                        //Extract months and day
                        dateVal =new Date(value*1000);
                        var month = ["Jan","Feb","March","April","May","June","July","Aug","Sept","Oct","Nov","Dec"];
                        var val= month[dateVal.getMonth()]+" "+dateVal.getDate();
                        $("#dayThree").append("<tr><td>"+val+"</td></tr>");
                }
                    icon="";
                     if(key=="icon")
                        {
                        switch(value){
                        case 'clear-day': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/clear.png' width='50px' height='50px'>";
                                            break;
                         case 'clear-night': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/clear_night.png' width='50px' height='50px'>";
                                            break;
                         case 'rain': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/rain.png' width='50px' height='50px'>";
                                        break;
                         case 'snow': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/snow.png' width'='50px' height='50px'>";
                                        break;
                         case 'sleet': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/sleet.png' width='50px' height='50px'>";
                                        break;
                         case 'wind': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/wind.png' width='50px' height='50px'>";
                                        break;
                         case 'fog': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/fog.png' width='50px' height='50px'>";
                                    break;
                         case 'cloudy': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/cloudy.png' width='50px' height='50px'>";
                                        break;
                         case 'partly-cloudy-day': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/cloud_day.png' width='50px' height='50px'>";
                                                    break;
                         case 'partly-cloudy-night': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/cloud_night.png' width='50px' height='50px'>";
                                                        break;
                         default: icon="<img src=http://cs-server.usc.edu:45678/hw/hw8/images/wind.png>";
                                        break;
					}
                    summary[3] = icon;
                    
                    $("#dayThree").append("<tr><td>"+icon+"</td></tr>");
                }
                
            
                if(key=="temperatureMin")
                {
                    val=Math.round(value);
                    $("#dayThree").append("<tr><td>Min</td></tr>");
                    $("#dayThree").append("<tr><td>Temp</td></tr>");
                    $("#dayThree").append("<tr><td style='font-size:200%;font-weight:bold'>"+val+"&deg"+"</td></tr>");
                }
                
                if(key=="temperatureMax")
                {
                    val=Math.round(value);
                    $("#dayThree").append("<tr><td>Max</td></tr>");
                    $("#dayThree").append("<tr><td>Temp</td></tr>");
                    $("#dayThree").append("<tr><td style='font-size:200%;font-weight:bold'>"+val+"&deg"+"</td></tr>");
                }
                
                
                
              });
                $.each(json_data.daily.data[4],function(key,value){
                if(key=="time")
                {
                        var dateVal =new Date(value*1000);
                        
                        var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
                        var val=days[dateVal.getDay()];
                        var day=val;
                        
                        $("#dayFour").append("<tr><td style='font-size:11px'>"+day+"</td></tr>");
                
                        //Extract months and day
                        dateVal =new Date(value*1000);
                        var month = ["Jan","Feb","March","April","May","June","July","Aug","Sept","Oct","Nov","Dec"];
                        var val= month[dateVal.getMonth()]+" "+dateVal.getDate();
                        $("#dayFour").append("<tr><td>"+val+"</td></tr>");
                }
                    icon="";
                     if(key=="icon")
                        {
                        switch(value){
                        case 'clear-day': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/clear.png' width='50px' height='50px'>";
                                            break;
                         case 'clear-night': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/clear_night.png' width='50px' height='50px'>";
                                            break;
                         case 'rain': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/rain.png' width='50px' height='50px'>";
                                        break;
                         case 'snow': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/snow.png' width'='50px' height='50px'>";
                                        break;
                         case 'sleet': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/sleet.png' width='50px' height='50px'>";
                                        break;
                         case 'wind': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/wind.png' width='50px' height='50px'>";
                                        break;
                         case 'fog': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/fog.png' width='50px' height='50px'>";
                                    break;
                         case 'cloudy': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/cloudy.png' width='50px' height='50px'>";
                                        break;
                         case 'partly-cloudy-day': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/cloud_day.png' width='50px' height='50px'>";
                                                    break;
                         case 'partly-cloudy-night': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/cloud_night.png' width='50px' height='50px'>";
                                                        break;
                         default: icon="<img src=http://cs-server.usc.edu:45678/hw/hw8/images/wind.png>";
                                        break;
					}
                    summary[4] = icon;
                    
                    $("#dayFour").append("<tr><td>"+icon+"</td></tr>");
                }
                
            
                if(key=="temperatureMin")
                {
                    val=Math.round(value);
                    $("#dayFour").append("<tr><td>Min</td></tr>");
                    $("#dayFour").append("<tr><td>Temp</td></tr>");
                    $("#dayFour").append("<tr><td style='font-size:200%;font-weight:bold'>"+val+"&deg"+"</td></tr>");
                }
                
                if(key=="temperatureMax")
                {
                    val=Math.round(value);
                    $("#dayFour").append("<tr><td>Max</td></tr>");
                    $("#dayFour").append("<tr><td>Temp</td></tr>");
                    $("#dayFour").append("<tr><td style='font-size:200%;font-weight:bold'>"+val+"&deg"+"</td></tr>");
                }
                
                
                
              });
                
                $.each(json_data.daily.data[5],function(key,value){
                if(key=="time")
                {
                        var dateVal =new Date(value*1000);
                        
                        var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
                        var val=days[dateVal.getDay()];
                        var day=val;
                        
                        $("#dayFive").append("<tr><td style='font-size:11px'>"+day+"</td></tr>");
                
                        //Extract months and day
                        dateVal =new Date(value*1000);
                        var month = ["Jan","Feb","March","April","May","June","July","Aug","Sept","Oct","Nov","Dec"];
                        var val= month[dateVal.getMonth()]+" "+dateVal.getDate();
                        $("#dayFive").append("<tr><td>"+val+"</td></tr>");
                }
                    icon="";
                     if(key=="icon")
                        {
                        switch(value){
                        case 'clear-day': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/clear.png' width='50px' height='50px'>";
                                            break;
                         case 'clear-night': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/clear_night.png' width='50px' height='50px'>";
                                            break;
                         case 'rain': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/rain.png' width='50px' height='50px'>";
                                        break;
                         case 'snow': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/snow.png' width'='50px' height='50px'>";
                                        break;
                         case 'sleet': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/sleet.png' width='50px' height='50px'>";
                                        break;
                         case 'wind': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/wind.png' width='50px' height='50px'>";
                                        break;
                         case 'fog': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/fog.png' width='50px' height='50px'>";
                                    break;
                         case 'cloudy': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/cloudy.png' width='50px' height='50px'>";
                                        break;
                         case 'partly-cloudy-day': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/cloud_day.png' width='50px' height='50px'>";
                                                    break;
                         case 'partly-cloudy-night': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/cloud_night.png' width='50px' height='50px'>";
                                                        break;
                         default: icon="<img src=http://cs-server.usc.edu:45678/hw/hw8/images/wind.png>";
                                        break;
					}
                    summary[5] = icon;
                    
                    $("#dayFive").append("<tr><td>"+icon+"</td></tr>");
                }
                
            
                if(key=="temperatureMin")
                {
                    val=Math.round(value);
                    $("#dayFive").append("<tr><td>Min</td></tr>");
                    $("#dayFive").append("<tr><td>Temp</td></tr>");
                    $("#dayFive").append("<tr><td style='font-size:200%;font-weight:bold'>"+val+"&deg"+"</td></tr>");
                }
                
                if(key=="temperatureMax")
                {
                    val=Math.round(value);
                    $("#dayFive").append("<tr><td>Max</td></tr>");
                    $("#dayFive").append("<tr><td>Temp</td></tr>");
                    $("#dayFive").append("<tr><td style='font-size:200%;font-weight:bold'>"+val+"&deg"+"</td></tr>");
                }
                
                
                
              });
                
                $.each(json_data.daily.data[6],function(key,value){
                if(key=="time")
                {
                        var dateVal =new Date(value*1000);
                        
                        var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
                        var val=days[dateVal.getDay()];
                        var day=val;
                        
                        $("#daySix").append("<tr><td style='font-size:11px'>"+day+"</td></tr>");
                
                        //Extract months and day
                        dateVal =new Date(value*1000);
                        var month = ["Jan","Feb","March","April","May","June","July","Aug","Sept","Oct","Nov","Dec"];
                        var val= month[dateVal.getMonth()]+" "+dateVal.getDate();
                        $("#daySix").append("<tr><td>"+val+"</td></tr>");
                }
                    icon="";
                     if(key=="icon")
                        {
                        switch(value){
                        case 'clear-day': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/clear.png' width='50px' height='50px'>";
                                            break;
                         case 'clear-night': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/clear_night.png' width='50px' height='50px'>";
                                            break;
                         case 'rain': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/rain.png' width='50px' height='50px'>";
                                        break;
                         case 'snow': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/snow.png' width'='50px' height='50px'>";
                                        break;
                         case 'sleet': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/sleet.png' width='50px' height='50px'>";
                                        break;
                         case 'wind': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/wind.png' width='50px' height='50px'>";
                                        break;
                         case 'fog': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/fog.png' width='50px' height='50px'>";
                                    break;
                         case 'cloudy': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/cloudy.png' width='50px' height='50px'>";
                                        break;
                         case 'partly-cloudy-day': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/cloud_day.png' width='50px' height='50px'>";
                                                    break;
                         case 'partly-cloudy-night': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/cloud_night.png' width='50px' height='50px'>";
                                                        break;
                         default: icon="<img src=http://cs-server.usc.edu:45678/hw/hw8/images/wind.png>";
                                        break;
					}
                    summary[6] = icon;
                    
                    $("#daySix").append("<tr><td>"+icon+"</td></tr>");
                }
                
            
                if(key=="temperatureMin")
                {
                    val=Math.round(value);
                    $("#daySix").append("<tr><td>Min</td></tr>");
                    $("#daySix").append("<tr><td>Temp</td></tr>");
                    $("#daySix").append("<tr><td style='font-size:200%;font-weight:bold'>"+val+"&deg"+"</td></tr>");
                }
                
                if(key=="temperatureMax")
                {
                    val=Math.round(value);
                    $("#daySix").append("<tr><td>Max</td></tr>");
                    $("#daySix").append("<tr><td>Temp</td></tr>");
                    $("#daySix").append("<tr><td style='font-size:200%;font-weight:bold'>"+val+"&deg"+"</td></tr>");
                }
                
                
                
              });
                
                $.each(json_data.daily.data[7],function(key,value){
                if(key=="time")
                {
                        var dateVal =new Date(value*1000);
                        
                        var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
                        var val=days[dateVal.getDay()];
                        var day=val;
                        
                        $("#daySeven").append("<tr><td style='font-size:11px'>"+day+"</td></tr>");
                
                        //Extract months and day
                        dateVal =new Date(value*1000);
                        var month = ["Jan","Feb","March","April","May","June","July","Aug","Sept","Oct","Nov","Dec"];
                        var val= month[dateVal.getMonth()]+" "+dateVal.getDate();
                        $("#daySeven").append("<tr><td>"+val+"</td></tr>");
                }
                    icon="";
                     if(key=="icon")
                        {
                        switch(value){
                        case 'clear-day': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/clear.png' width='50px' height='50px'>";
                                            break;
                         case 'clear-night': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/clear_night.png' width='50px' height='50px'>";
                                            break;
                         case 'rain': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/rain.png' width='50px' height='50px'>";
                                        break;
                         case 'snow': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/snow.png' width'='50px' height='50px'>";
                                        break;
                         case 'sleet': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/sleet.png' width='50px' height='50px'>";
                                        break;
                         case 'wind': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/wind.png' width='50px' height='50px'>";
                                        break;
                         case 'fog': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/fog.png' width='50px' height='50px'>";
                                    break;
                         case 'cloudy': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/cloudy.png' width='50px' height='50px'>";
                                        break;
                         case 'partly-cloudy-day': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/cloud_day.png' width='50px' height='50px'>";
                                                    break;
                         case 'partly-cloudy-night': icon="<img src='http://cs-server.usc.edu:45678/hw/hw8/images/cloud_night.png' width='50px' height='50px'>";
                                                        break;
                         default: icon="<img src=http://cs-server.usc.edu:45678/hw/hw8/images/wind.png>";
                                        break;
					}
                    summary[7] = icon;
                    
                    $("#daySeven").append("<tr><td>"+icon+"</td></tr>");
                }
                
            
                if(key=="temperatureMin")
                {
                    val=Math.round(value);
                    $("#daySeven").append("<tr><td>Min</td></tr>");
                    $("#daySeven").append("<tr><td>Temp</td></tr>");
                    $("#daySeven").append("<tr><td style='font-size:200%;font-weight:bold'>"+val+"&deg"+"</td></tr>");
                }
                
                if(key=="temperatureMax")
                {
                    val=Math.round(value);
                    $("#daySeven").append("<tr><td>Max</td></tr>");
                    $("#daySeven").append("<tr><td>Temp</td></tr>");
                    $("#daySeven").append("<tr><td style='font-size:200%;font-weight:bold'>"+val+"&deg"+"</td></tr>");
                }
                
                
                
              });
                
        //Modal code 
                for (var i = 1; i < 8; i++) {
                    bodyOfModal="#body"+i; 
                    titleOfModal="#title"+i;
                    
                        dateVal =new Date((json_data.daily.data[i].time)*1000);
                        var month = ["Jan","Feb","March","April","May","June","July","Aug","Sept","Oct","Nov","Dec"];
                        var val= month[dateVal.getMonth()]+" "+dateVal.getDate();
                    
                    var modalHeader= "Weather in "+$("#city").val()+" on "+" "+val;
                    $(titleOfModal).append(modalHeader);
                    var modalbody="<tr><td align='center' colspan='100%'>"+summary[i]+"</td></tr>";
                        
                        var dateVal =new Date((json_data.daily.data[i].time)*1000);
                        var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
                        var val=days[dateVal.getDay()];
                        var day=val;
                    
                        
                    var output= "<strong>"+day+"</strong>:<span style='color:#FFA600;'> "+json_data.daily.data[i].summary+"</span>";
                    modalbody+="<tr><td colspan='100%' align='center'>"+output+"</td></tr>";
                    modalbody+="<tr><td style='font-weight: bold;'>Sunrise Time</td><td style='font-weight: bold;'>Sunset Time</td><td style='font-weight: bold;'>Humidity</td></tr>"
                    
                       /* convertedTime=new Date((json_data.daily.data[i].sunriseTime)*1000);
                        if(convertedTime.getHours() > 12){
                            value=("0" + (convertedTime.getHours())%12)+":"+(("0" + (convertedTime.getMinutes())).slice(-2))+" PM";
                        }
                        else{
                            value=(("0" + (convertedTime.getHours())).slice(-2))+":"+(("0" + (convertedTime.getMinutes())).slice(-2))+" AM";
                           }*/
                        sunRise=getTimeZone(current_timezone,json_data.daily.data[i].sunriseTime); 
                    
                        /*convertedTime=new Date((json_data.daily.data[i].sunsetTime)*1000);
                        if(convertedTime.getHours() > 12){
                            value=("0" + (convertedTime.getHours())%12)+":"+(("0" + (convertedTime.getMinutes())).slice(-2))+" PM";
                        }
                        else{
                            value=(("0" + (convertedTime.getHours())).slice(-2))+":"+(("0" + (convertedTime.getMinutes())).slice(-2))+" AM";
                           }*/
                        sunSet=getTimeZone(current_timezone,json_data.daily.data[i].sunsetTime); 
                    
                        
                    
                    modalbody+="<tr><td>"+sunRise+"</td><td>"+sunSet+"</td><td>"+(json_data.daily.data[i].humidity)*100+""+"%</td></tr>";
                    modalbody+="<tr><td style='font-weight: bold;'>Wind Speed</td><td style='font-weight: bold;'>Visibility</td><td style='font-weight: bold;'>Pressure</td></tr>"
                    visibilityValue = json_data.daily.data[i].visibility
                    if(!visibilityValue){
                        visibilityValue = "Not Available"
                        visiVal = " ";
                    }
                        
                    modalbody+="<tr><td>"+json_data.daily.data[i].windSpeed+""+windVal+"</td><td>"+visibilityValue+""+visiVal+"</td><td>"+json_data.daily.data[i].pressure+""+pressureVal+"</td></tr>";
                    $(bodyOfModal).append(modalbody);  			
                }
                
            //function to display map
           function getMap(longitude,latitude){
           try{
           
            var lonlat = new OpenLayers.LonLat(longitude, latitude);
           
            var map = new OpenLayers.Map("basicMap");
            // Create OSM overlays
               
            
            var mapnik = new OpenLayers.Layer.OSM();
        
            var layer_cloud = new OpenLayers.Layer.XYZ(
                "clouds",
                "http://${s}.tile.openweathermap.org/map/clouds/${z}/${x}/${y}.png",
                {
                    isBaseLayer: false,
                    opacity: 0.3,
                    sphericalMercator: true
                }
            );

            var layer_precipitation = new OpenLayers.Layer.XYZ(
                "precipitation",
                "http://${s}.tile.openweathermap.org/map/precipitation/${z}/${x}/${y}.png",
                {
                    isBaseLayer: false,
                    opacity: 0.3,
                    sphericalMercator: true
                }
            );


            map.addLayers([mapnik, layer_precipitation, layer_cloud]);
               map.setCenter(lonlat.transform('EPSG:4326', 'EPSG:3857'), 9);
           }
           catch(e){
            
           }    
           }      
          }

     });

             }
            });
            
        
   }); 
        
      function resetForm(){
                
             $(':input', "#myForm").each(function() {
                    var type = this.type;
                    var tag = this.tagName.toLowerCase(); // normalize case
                    if (type == 'text' || type == 'password' || tag == 'textarea')
                          this.value = "";    
                    else if (type == 'radio')
                        {
                            radiobtn = document.getElementById("F");
                            radiobtn.checked = true;
                        }
                          
                    else if (tag == 'select')
                          this.selectedIndex = 0;
                  });    
                $("#rightNow").empty();
                $("#hourly").empty();
                $("#dayOne").empty();
                $("#dayTwo").empty();
                $("#dayThree").empty();
                $("#dayFour").empty();
                $("#dayFive").empty();
                $("#daySix").empty();
                $("#daySeven").empty();
                
                $("#extab").css("display","none");
                
                $('#basicMap').html('');
                for(var k=0;k<8;k++){
                    title="#title"+k;
                    body="#body"+k;
                    $(title).empty();
                    $(body).empty();
                }
          $("#outer").css("display","none");
            }  
        
        function getTimeZone(timezone,currentTime){
           
            var time = moment(currentTime*1000);
            var val=time.tz(timezone).format("hh:mm A");
            
            return val;
        }
      
        
        function geticon(summary)
        {
            
             switch(summary){
                        case 'clear-day': icon="http://cs-server.usc.edu:45678/hw/hw8/images/clear.png'";
                                            break;
                         case 'clear-night': icon="http://cs-server.usc.edu:45678/hw/hw8/images/clear_night.png";
                                            break;
                         case 'rain': icon="http://cs-server.usc.edu:45678/hw/hw8/images/rain.png";
                                        break;
                         case 'snow': icon="http://cs-server.usc.edu:45678/hw/hw8/images/snow.png";
                                        break;
                         case 'sleet': icon="http://cs-server.usc.edu:45678/hw/hw8/images/sleet.png>";
                                        break;
                         case 'wind': icon="http://cs-server.usc.edu:45678/hw/hw8/images/wind.png";
                                        break;
                         case 'fog': icon="http://cs-server.usc.edu:45678/hw/hw8/images/fog.png";
                                    break;
                         case 'cloudy': icon="http://cs-server.usc.edu:45678/hw/hw8/images/cloudy.png";
                                        break;
                         case 'partly-cloudy-day': icon="http://cs-server.usc.edu:45678/hw/hw8/images/cloud_day.png";
                                                    break;
                         case 'partly-cloudy-night': icon="http://cs-server.usc.edu:45678/hw/hw8/images/cloud_night.png";
                                                        break;
                         default: icon="http://cs-server.usc.edu:45678/hw/hw8/images/wind.png";
                                        break;
             }
            return  icon;
        }
      function share()
        {
            
            var name_value = "Currently Weather in " + $("#city").val() + "," + $("#state").val();
            var icon = geticon(json_data.currently.icon);
            FB.ui({
                  method: 'feed',
                  name: name_value,
                  link: 'http://forecast.io/',
                  caption: 'WEATHER INFORMATION FROM FORECAST IO',
                  description : json_data.currently.summary+","+Math.round(json_data.currently.temperature)+ "°" +deg_val,
                  picture: icon,
                  
                    },  function(response) {
                        if (response && response.post_id) {
                              alert('Post was published.');
                        } else {
                            alert('Post was not published.');
                            }
                        }
                  );
            }
    </script>
</head>
<body>
    <script>
          window.fbAsyncInit = function() {
            FB.init({
              appId      : '907194222684842',
              xfbml      : true,
              version    : 'v2.5'
            });
          };

          (function(d, s, id){
             var js, fjs = d.getElementsByTagName(s)[0];
             if (d.getElementById(id)) {return;}
             js = d.createElement(s); js.id = id;
             js.src = "//connect.facebook.net/en_US/sdk.js";
             fjs.parentNode.insertBefore(js, fjs);
           }(document, 'script', 'facebook-jssdk'));
        </script>

        <div class="container">
                <div class="title text-center">
                        <br><h1>Forecast Search</h1><br><br><br>
                </div>

                <div class="jumbotron">
               <div class="row">

                        <form name="myForm" id="myForm" method ="GET" action="">
                            <div class="form-group col-md-3 has-warning" id="sadd">
                                    <label class="control-label" for="address"><span class="white">Street Address:</span><span style="color:red;">*     </span></label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter street address" value=" "><div id="streetError"></div>
                            </div>

                        <div class="form-group col-md-2">
                            <label class="control-label" for="city"><span class="white">City:</span><span style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="city" name="city" placeholder="Enter the city:" value=" ">
                                <div id="cityError"></div>
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label" for="state"><span class="white">State:</span><span style="color:red;">*</span></label>
                            <select name="state" type="text" class="form-control" id="state" placeholder="" >
                            <option value="" selected disabled>Select your state..</option>
                <option value="AL">Alabama</option>
                <option value="AK">Alaska</option>
                <option value="AZ">Arizona</option>
                <option value="AR">Arkansas</option>
                <option value="CA">California</option>
                <option value="CO">Colorado</option>
                <option value="CT">Connecticut</option>
                <option value="DE">Delaware</option>
                <option value="DC">District Of Columbia</option>
                <option value="FL">Florida</option>
                <option value="GA">Georgia</option>
                <option value="HI">Hawaii</option>
                <option value="ID">Idaho</option>
                <option value="IL">Illinois</option>
                <option value="IN">Indiana</option>
                <option value="IA">Iowa</option>
                <option value="KS">Kansas</option>
                <option value="KY">Kentucky</option>
                <option value="LA">Louisiana</option>
                <option value="ME">Maine</option>
                <option value="MD">Maryland</option>
                <option value="MA">Massachusetts</option>
                <option value="MI">Michigan</option>
                <option value="MN">Minnesota</option>
                <option value="MS">Mississippi</option>
                <option value="MO">Missouri</option>
                <option value="MT">Montana</option>
                <option value="NE">Nebraska</option>
                <option value="NV">Nevada</option>
                <option value="NH">New Hampshire</option>
                <option value="NJ">New Jersey</option>
                <option value="NM">New Mexico</option>
                <option value="NY">New York</option>
                <option value="NC">North Carolina</option>
                <option value="ND">North Dakota</option>
                <option value="OH">Ohio</option>
                <option value="OK">Oklahoma</option>
                <option value="OR">Oregon</option>
                <option value="PA">Pennsylvania</option>
                <option value="RI">Rhode Island</option>
                <option value="SC">South Carolina</option>
                <option value="SD">South Dakota</option>
                <option value="TN">Tennessee</option>
                <option value="TX">Texas</option>
                <option value="UT">Utah</option>
                <option value="VT">Vermont</option>
                <option value="VA">Virginia</option>
                <option value="WA">Washington</option>
                <option value="WV">West Virginia</option>
                <option value="WI">Wisconsin</option>
                <option value="WY">Wyoming</option>
                            </select>
                            <div id="stateError"></div>
                             
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label" for="degree"><span class="white">Degree:</span></label>
                                <br>
                                <label class="radio-inline"><input type="radio" name="degree" id="F" value="Fahrenheit" checked>Fahrenheit</label>
                                <label class="radio-inline"><input type="radio" name="degree" id="C" value="Celsius">Celsius</label>

                        </div>
                        <div class= "form-group col-md-2">
                                <br>
                                <button type="submit" class="btn btn-primary" id="submit1"><span class="glyphicon glyphicon-search"></span>Search</button>
							     <button type="button" class="btn btn-default" id="clear1" onclick="resetForm()"><span class="glyphicon glyphicon-refresh"></span>Clear</button>
                            <br><span class="white">Powered by:</span><a href="http://forecast.io/"><img id="logo" src="http://cs-server.usc.edu:45678/hw/hw8/images/forecast_logo.png"></a>	 
                            </div>
                         


                        </form>
                </div>
                
               
        </div>
            <span class="white"><hr size="10"></span>
            
            

              <!-- Nav tabs -->
            <div id="outer">
                <div id="extab" class="container" style="padding-left: 0px;">
                  <ul class="nav nav-pills col-xs-12 col-sm-12" role="tablist">
                    <li class="active"><a href="#both" data-toggle="tab">Right Now</a>
                        
                    </li>
                    <li><a href="#hours" data-toggle="tab">Next 24 hours</a>

                    </li>
                    <li><a href="#days" data-toggle="tab">Next 7 days</a>
                      
                      
                    </li>

                  </ul>
                </div>
              <!-- Tab panes -->
            
              <div class="tab-content tab-justified" >
                <div role="tabpanel" class="tab-pane active  table-responsive" id="both">
                  <div  class="col-sm-6 col-xs-12" id="now" style="padding: 0%;">
                    <table id='rightNow' class='table' style="border: none">
                        <col width="40%">
                        <col width="50%">
                        </table>
                </div>
                  <div role="tabpanel" class="tab-pane active col-sm-6 col-xs-12" id="basicMap">
                 
                  </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="hours">
                <div class="col-sm-12 col-xs-12" id="hourlyDisplay">
                </div>
                    <table id="hourly" class="table">
                        
                    </table>
                </div>
                    
                <div role="tabpanel" class="tab-pane" id="days">
                  <div class="col-sm-12 col-xs-12" id="weekDisplay">
                          
                        
                        <div class="col-sm-12">
                             <div id="blankOne" class="col-sm-1 col-xs-12">
                                
                            </div>

                            <div id="one" class="col-sm-1 col-xs-12"><a href="#modalOne" data-toggle="modal" data-target="#modalOne"><span class="white">
                                <table class="table" id="dayOne">
                                </table>    
                            </span></a>
                            </div>
                            <div id="two" class="col-sm-1 col-xs-12"><a href="#modalTwo" data-toggle="modal" data-target="#modalTwo"><span class="white">
                                <table class="table" id="dayTwo">
                                </table>
                            </span></a>
                            </div>  
                            <div id="three" class="col-sm-1 col-xs-12"><a href="#modalThree" data-toggle="modal" data-target="#modalThree"><span class="white">
                                <table class="table" id="dayThree">
                                </table>
                            </span></a>
                            </div>
                            <div id="four" class="col-sm-1 col-xs-12"><a href="#modalFour" data-toggle="modal" data-target="#modalFour"><span class="white">
                                <table class="table" id="dayFour">
                                </table>  
                            </span></a>
                            </div>
                            
                            <div id="five" class="col-sm-1 col-xs-12"><a href="#modalFive" data-toggle="modal" data-target="#modalFive"><span class="white">
                               <table class="table" id="dayFive">
                                </table> 
                            </span></a>
                            </div>
                            
                            <div id="six" class="col-sm-1 col-xs-12"><a href="#modalSix" data-toggle="modal" data-target="#modalSix"> <span class="white">
                              <table class="table" id="daySix">
                                </table>  
                            </span></a>
                            </div>
                            
                            <div id="seven" class="col-sm-1 col-xs-12"><a href="#modalSeven" data-toggle="modal" data-target="#modalSeven"><span class="white">
                                <table class="table" id="daySeven">
                                </table>
                            </span></a>
                            </div>
                          

                    
                  </div>
                </div> 
                    
                    
                <div class="modal fade" id="modalOne" role="dialog">
                    <div class="modal-dialog">

                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title" id="title1"></h4>
                        </div>
                        <div class="modal-body">
                          <table class="table borderless" id="body1"></table>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>

                    </div>
                  </div>
                  
                    
                <div class="modal fade" id="modalTwo" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title" id="title2"></h4>
                    </div>
                    <div class="modal-body">
                      <table class="table borderless" id="body2" border="0"></table>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>

                </div>
              </div>

            <!--Day 3-->
            <div class="modal fade" id="modalThree" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title" id="title3"></h4>
                    </div>
                    <div class="modal-body">
                      <table class="table borderless" id="body3"></table>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>

                </div>
              </div>

            <!--Day 4-->
            <div class="modal fade" id="modalFour" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title" id="title4"></h4>
                    </div>
                    <div class="modal-body">
                      <table class="table borderless" id="body4"></table>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>

                </div>
            </div>

                <!--Day 5-->
                <div class="modal fade" id="modalFive" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title" id="title5"></h4>
                        </div>
                        <div class="modal-body">
                          <table class="table borderless" id="body5"></table>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>

                    </div>
                  </div>

                    <!--Day 6-->
                    <div class="modal fade" id="modalSix" role="dialog">
                        <div class="modal-dialog">

                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title" id="title6"></h4>
                            </div>
                            <div class="modal-body">
                              <table class="table borderless" id="body6"></table>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </div>

                        </div>
                      </div>
                    
                    <div class="modal fade" id="modalSeven" role="dialog">
                        <div class="modal-dialog">

                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title" id="title7"></h4>
                            </div>
                            <div class="modal-body">
                              <table class="table borderless" id="body7"></table>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </div>

                        </div>
                      </div>
                    
                    
              </div>
            </div>
            
    </div>
        

</div>                            
     
</body>
</html>