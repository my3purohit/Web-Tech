
<html>
    <head><title>Weather forecast</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <meta charset='utf-8'>
        <style type="text/css">
        body{
            background-image:url('http://cs-server.usc.edu:45678/hw/hw8/images/bg.jpg');
            background-repeat: no-repeat;
            background-size:cover;
        }
            
        input{
            display: inline-block;
            }
            .form-group{
                text-align:left;
            }
            
            .red{
               color: red;
            }
            
            .img-responsive {  
                display: block;  
                height: auto;  
                max-width: 100%; 
                width: 100%; 
            }
            
            .jumbotron{
                background-color: rgba(245, 245, 245, 0.3);
            }
        </style>
    
    <script type="text/javascript" charset="utf-8">
        function validate() {
            var alertstring = "Please enter value for\n";
            var missing = false;
            if(document.forms["myForm"]["address"].value == null || document.forms["myForm"]["address"].value == ""){
                missing = true;
                alertstring = alertstring + "Address \n";
            }
            if(document.forms["myForm"]["city"].value == null || document.forms["myForm"]["city"].value == ""){
                missing = true;
                alertstring+="City \n";
            }
            if(document.getElementById("states").selectedIndex == 0){
                missing=true;
             alertstring+="State";
            }
            if(missing){
            alert(alertstring);
            return false;
            }
            else 
                return true;

        }
        
        function resetPage(){

            document.forms["myForm"].reset();
            document.forms["myForm"]["address"].value = " ";
            document.forms["myForm"]["city"].value = " ";
            document.getElementById("F").checked = true;
            //window.location ="http://cs-server.usc.edu:38678/forecast_new.php";
            
            document.getElementById("result").innerHTML = "";
            }
       
        
    </script>
    
    </head>
    <body style="margin:0 auto;">
        <?php
            $address = $city = $state =$degree="";

            //ini_set('display_errors','0');
        if ($_SERVER["REQUEST_METHOD"] == "POST") 
        {
             $address = test_input($_POST["address"]);
             $city = test_input($_POST["city"]);
             $state = test_input($_POST["states"]);
             $units = $_POST["degree"];
             $degree = $_POST["degree"];
            
        }
        function test_input($data) 
            {
               $data = trim($data);
               $data = stripslashes($data);
               $data = htmlspecialchars($data);
               return $data;
            }
        
  
        ?>
            <div class="container">
            
        
          
                <h1 style="text-align:center;"><strong>Forecast Search</strong></h1>
            
                <div class="jumbotron">
                <form name = "myForm" id="myForm" method ="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"                          role="form">
                    <div class="col-sm-12">
                        <div class="form-group col-sm-3 col-xs-12">
                            <label type="control-label" class="col-xs-12">Street Address:<span class="red">*</span></label>
                                    
                                    <input type="text" name="address" value="<?php echo $address; ?>">
                                    
                        </div>
                    
                    
                        <div class="form-group col-sm-2 col-xs-12">
                            <label type="control-label" class="col-xs-12">City:<span class="red">*</span></label>
                                    <input type="text" name="city" value="<?php echo $city; ?>">
                    
                        </div>
                    
                        <div class="form-group col-sm-2 col-xs-12">
                            <label type="control-label" class="col-xs-12">State:<span class="red">*</span></label>
                            <select name="states" id="states" align="right" >
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
                        </div> 
                        
                        <div class="form-group col-sm-3 col-xs-12">
                            <label type="control-label" class="col-xs-12">Degree:<span class="red">*</span></label>
                            <input type="radio" name="degree" id="F" value="Fahrenheit" checked>Fahrenheit
                            <input type="radio" name="degree" id="C" value="Celsius" <?php if(isset($_POST["degree"]) && ($_POST["degree"]=="Celsius"))                                     { echo "checked" ;} ?> >Celsius
                        </div>
                        
                        <div class="form-group col-sm-1 col-xs-12">
                            <br><input type="submit" value="Search" name="search" align="right" onclick="return validate()">
                         </div>
                    
                    
                    
                        <div class="form-group col-sm-1 col-xs-12">
                            <br><input type="button" value="Clear" name="clear" align="right" onclick="resetPage()">
                        </div>
                    
                         <br>Powered by: <a href="http://forecast.io/" align="center">   <img src="http://cs-server.usc.edu:45678/hw/hw8/images/forecast_logo.png" class="img-responsive"></a><br>   
                        
                    
                    </div>
            
        
        </form>
        </div>
        </div>
        
        <script type="text/javascript">
              document.getElementById('states').value = "<?php echo $state;?>";
            </script>
       
        
    <?php

            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
            
             
                    if(!empty($address))
                    {
                        
                        if ($_POST["degree"] == 'Fahrenheit')
                 $units = "us";
            else
                $units = "si";
            
             
             $address = str_replace(' ','+',$address);
             $city = str_replace(' ','+',$city);
             $state = str_replace(' ','+',$state);
                        $context  = stream_context_create(array('http' => array('header' => 'Accept: application/xml')));
                        $url="https://maps.google.com/maps/api/geocode/xml?address=".$address.",".$city.",".$state ."&key=AIzaSyDCIUHl2QsA2gYcXEk3dXOhrkJ8k5qpXuo";
                        $xml = file_get_contents($url, false, $context);
                        
                        $xml = simplexml_load_string($xml); 
                        
                        if($xml->status == "ZERO_RESULTS")
                        {
                            echo "<script>alert('Incorrect City or Street Address')</script>";
                        }
                        else
                        {
                        //var_dump($xml);
                        //$lat = $xml->result->geometry->location->lat;
                        //$lng = $xml->result->geometry->location->lng;   
            $api_key = "41471d124c083f6ff704481a9057ff1b";
            $forecast_url = "https://api.forecast.io/forecast/" .$api_key. "/" .$xml->result->geometry->location->lat.",".$xml->result->geometry->location->lng."?units=".$units."&exclude=flags";
             //echo $forecast_url;
            $json = file_get_contents($forecast_url);
            $json_data = json_decode($json,true);
            
        
        
            $city_time = $json_data["timezone"];
            
            date_default_timezone_set($city_time);
            
            //echo "<script> showTable(); </script>";
             $resultstring = " ";
            
                
            $resultstring = "<div id='result'><table frame='box' align='center' width='300' margin-left='100'><tr><th colspan=2>" .$json_data["currently"]["summary"] . "</th></tr>";
            
            //Display temperature
            $deg = "F";
            if($units == "si")
                $deg = "C";
            
            $resultstring = $resultstring . "<tr><th colspan=2>" . round($json_data["currently"]["temperature"]) . "°" . $deg . "</th></tr>";
            
            //Display weather icon
            switch($json_data["currently"]["icon"])
            {
                case 'clear-day' : $img = "http://cs-server.usc.edu:45678/hw/hw6/images/clear.png";
                                    break;
                case 'clear-night': $img = "http://cs-server.usc.edu:45678/hw/hw6/images/clear_night.png";
                                    break;
                case 'rain' : $img = "http://cs-server.usc.edu:45678/hw/hw6/images/rain.png";
                                    break;
                case 'snow' : $img = "http://cs-server.usc.edu:45678/hw/hw6/images/snow.png";
                                    break;
                case 'wind': $img = "http://cs-server.usc.edu:45678/hw/hw6/images/wind.png";
                                    break;
                case 'fog' : $img = "http://cs-server.usc.edu:45678/hw/hw6/images/fog.png";
                                    break;
                case 'cloudy': $img = "http://cs-server.usc.edu:45678/hw/hw6/images/cloudy.png";
                                    break;
                case 'partly-cloudy-day':$img = "http://cs-server.usc.edu:45678/hw/hw6/images/cloud_day.png";
                                    break;  
                case 'partly-cloudy-night' : $img = "http://cs-server.usc.edu:45678/hw/hw6/images/cloud_night.png";
                                              break;
                case 'default' : $img = "http://cs-server.usc.edu:45678/hw/hw6/images/clear_night.png";
                
            } 
            
            $resultstring .= "<tr><th colspan=2><img src='" . $img . " 'title='" .$json_data['currently']['summary']. "'></th></tr>";
            
            //Display precipitation based on ranges
            //if $units for us is inches and mm for si
            
            
            $precip = $json_data["currently"]["precipIntensity"];
           
            if($degree == "Celsius")
             $precip = $precip * 0.0393701;
            
            if($precip < 0.002)
                $precip = "None";
            else if($precip < 0.017)
                $precip = "Very Light";
            else if($precip < 0.1)
                $precip = "Light";
            else if($precip < 0.4)
                $precip = "Moderate";
            else 
                $precip = "Heavy";
            
           
            $resultstring .= "<tr><td>Precipitation:</td><td>" . $precip . "</td></tr>";
                
            $resultstring .= "<tr><td>Chances of Rain:</td><td>" . $json_data["currently"]["precipProbability"] * 100 . "%</td></tr>";
            
            $windSpeed = $json_data["currently"]["windSpeed"];            
            if($units == "si")
                $windSpeed = 2.23694 * $windSpeed;
                
            $resultstring .= "<tr><td>Wind Speed:</td><td>" . round($windSpeed) . " mph</td></tr>";
            
            $resultstring .="<tr><td>Dew Point:</td><td>" . round($json_data["currently"]["dewPoint"]) ."° " . $deg . "</td></tr>";
            
            $resultstring .="<tr><td>Humidity:</td><td>" . ($json_data["currently"]["humidity"]) * 100 . "%</td></tr>";
            
            $visibility = $json_data["currently"]["visibility"];
            if($units == "si")
                $visibility = 0.621371 * $visibility;
            $resultstring .="<tr><td>Visibility:</td><td>" . round($visibility) . " mi</td></tr>";
            
            $unixTime = $json_data["daily"]["data"][0]["sunriseTime"];
            $sunriseMin = date('h:i A',$unixTime);
            $resultstring .= "<tr><td>Sunrise Time:</td><td>" .$sunriseMin . "</td></tr>" ;
            
            $unixTime = $json_data["daily"]["data"][0]["sunsetTime"];
            $sunsetMin = date('h:i A',$unixTime);
            $resultstring .= "<tr><td>Sunset Time:</td><td>" .$sunsetMin . "</td></tr></div>" ;
            
            echo $resultstring;
            }
                    }
            
            $address = str_replace('+',' ',$address);
             $city = str_replace('+',' ',$city);
             $state = str_replace('+',' ',$state);
            
        
        
            }
    ?>

    </body>
    
    
</html>