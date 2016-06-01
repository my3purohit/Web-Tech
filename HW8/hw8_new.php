<html>
<head>
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
            
           
            .red{
               color: red;
            }
            
            .img-responsive {  
                width: 70px; 
                height:70px;  
               
            }
            
            .jumbotron{
                background-color: rgba(245, 245, 245, 0.3);
            }
        
        .form-group{
            margin-left: 0;
            padding-left: 0;
        }
           
        </style>
    </head>
    <body>

        <form name = "myForm" id="myForm" method ="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" role="form">
<div class="container">

                <h1 style="text-align:center;">Forecast Search</h1><br><br>
            
                <div class="jumbotron">
                    <div class="container-fluid">
                    

                        
                            <div class="form-group col-sm-3 col-xs-12">
                                <label class="col-sm-12 col-xs-12 control-label">Street Address:<span class="red">*</span></label>
                                        <input type="text" class="form-control" name="address" placeholder="Enter Street Address">          
                            </div>


                            <div class="form-group col-sm-2 col-xs-12">
                                <label class="col-xs-12 control-label">City:<span class="red">*</span></label>
                                        <input type="text" class="form-control" name="city" placeholder="Enter City Address">
                            </div>

                            <div class="form-group col-sm-2 col-xs-12">
                                <label class="col-xs-12 control-label">State:<span class="red">*</span></label>
                                <select name="states" id="states" class="form-control" >
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
                                <label class="col-xs-12 control-label">Degree:<span class="red">*</span></label>
                                    <div class="radio">
                                        <br><label><input type="radio" name="degree" id="F" value="Fahrenheit" checked>Fahrenheit</label>
                                        <label><input type="radio" name="degree" id="C" value="Celsius" >Celsius</label>
                                    </div>
                            </div>

                            <div class="form-group col-sm-1 col-xs-12">
                                <br><button class="btn btn-primary"  name="search" onclick="return validate()"><span class="glyphicon glyphicon-search"> </span>Search</button>
                             </div>



                            <div class="form-group col-sm-1 col-xs-12">
                                <br><button class="btn btn-default" name="clear"  onclick="resetPage()"><span class="glyphicon glyphicon-refresh"></span>Clear</button>
                            </div>

                             <br>Powered by: <a href="http://forecast.io/"><img src="http://cs-server.usc.edu:45678/hw/hw8/images/forecast_logo.png" class="img-responsive"></a><br>   

                        </form>            
                    
            
        
                    </div>
        </div>
        </div>
   </body>
    </html>