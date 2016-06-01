<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>

    <style type="text/css">
    body{
            background-image:url('http://cs-server.usc.edu:45678/hw/hw8/images/bg.jpg');
            background-repeat: no-repeat;
            background-size:cover;
        }
            
           
            .red{
               color: red;
            }
            
            img {  
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
			
			
      
    </style>
    <script>
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
	
	$(document).ready(function($) {
			
			
            //form validation rules
            $("#searchForm").validate({
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
						selectNone: true
					}
                },
                messages: {
                    address: "Please enter valid address",
                    city: "Please enter your city",
                }
				
            });
       });
     
        
        
    </script>
</head>
<body>
	<div class="container">
		<div class="title text-center">
			<br><h1>Forecast Search</h1><br><br>
        </div>
        <div class="jumbotron">
			<div class="row">
				<form action="" id="searchForm" novalidate="novalidate" method="post">
					<div class="form-group col-sm-3">
						<label class="control-label" for="address"><span class="white">Street Address:</span><span style="color:red;">*</span></label>
                        <input type="text" name="address" class="form-control" id="address" placeholder="Enter street address">
                    </div>
                    <div class="form-group col-sm-2">
						<label class="control-label" for="city"><span class="white">City:</span><span style="color:red;">*</span></label>
                        <input type="text" name="city" class="form-control" id="city" placeholder="Enter the city:">
                    </div>
                    <div class="form-group col-sm-2">
						<label class="control-label" for="state"><span class="white">State:</span><span style="color:red;">*</span></label>
                        <select name="state" type="text" class="form-control" id="state" placeholder="">
							<option value="none" selected disabled>Select your state..</option>
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
                    <div class="form-group col-sm-3">
						<label class="control-label" for="degree"><span class="white">Degree:</span></label>
                        <br>
                        <label class="radio-inline"><input type="radio" name="optradio" checked>Fahrenheit</label>
                        <label class="radio-inline"><input type="radio" name="optradio">Celsius</label>
                    </div>
                    <div class="form-group col-sm-2">
						<br>
                        <button type="submit" class="btn btn-primary col-sm-6" id="submit"><span class="glyphicon glyphicon-search"></span>Search</button>
						<button type="submit" class="btn btn-default col-sm-6" id="clear"><span class="glyphicon glyphicon-refresh"></span>Clear</button>
                        <br><span class="white">Powered by:</span><a href="http://forecast.io/"><img src="http://cs-server.usc.edu:45678/hw/hw8/images/forecast_logo.png"></a>	 
                    </div>
				</form>
            </div>
		</div>
        <span class="white"><hr size="10"></span>
        <div>		
			<ul class="nav nav-tabs" id="myTab">
				<li class="active"><a data-toggle="tab" href="#rightNow">Right Now</a></li>
				<li><a data-toggle="tab" href="#24hours">Next 24 Hours</a></li>
				<li><a data-toggle="tab" href="#7days">Next 7 days</a></li>
			</ul>
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="rightNow">
					<p>HELLO</p>
				</div>
				<div role="tabpanel" class="tab-pane" id="24hours">
					<p>HI</p>
				</div>
				<div role="tabpanel" class="tab-pane" id="7days">
					<p>BYE</p>
				</div>
			</div>
		</div>
	</div>               
</body>
</html>