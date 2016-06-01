  <?php

            $address = $city = $state =$degree="";

            $address = $_GET["address"];
             $city = $_GET["city"];
             $state = $_GET["state"];
             $units = $_GET["degree"];
             $degree = $_GET["degree"];
            
        

       
      
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
                        if ($_GET["degree"] == 'Fahrenheit')
                             $units = "us";
                        else
                            $units = "si";
            
                        $api_key = "41471d124c083f6ff704481a9057ff1b";
                        $forecast_url = "https://api.forecast.io/forecast/" .$api_key. "/" .$xml->result->geometry->location->lat.",".$xml->result->geometry->location->lng."?units=".$units."&exclude=flags";
             
                        $json = file_get_contents($forecast_url);
                        $json_data = json_decode($json,true);
                        echo $json;
        
        
            }
        
            
        
    
?>    