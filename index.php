<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>Nevada Heights Neighborhood - Garbage Pickup Reservation</title>
    <link href="bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
	* {
	  font-weight: 600;
	}
	body {
	  padding-top: 40px;
	  padding-bottom: 40px;
	  background-color: #eee;
	}
    body, html {
      height: 100%;
    }
    .bg { 
      background-image: url("nhnc-map.png");
      height: 100%; 
	  /*opacity: 0.65;*/
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
	  background-attachment: fixed;
    }
	.form-signin {
	  max-width: 330px;
	  padding: 15px;
	  margin: 0 auto;
	}
	.form-signin .form-signin-heading,
	.form-signin .checkbox {
	  margin-bottom: 10px;
	}
	.form-signin .checkbox {
	  font-weight: normal;
	}
	.form-signin .form-control {
	  position: relative;
	  height: auto;
	  -webkit-box-sizing: border-box;
      box-sizing: border-box;
	  padding: 10px;
	  font-size: 16px;
	}
	.form-signin .form-control:focus {
	  z-index: 2;
	}
	button.accordion {
		background-color: #eee;
		color: #444;
		cursor: pointer;
		padding: 18px;
		width: 100%;
		text-align: left;
		border: none;
		outline: none;
		transition: 0.4s;
	}
	button.accordion.active, button.accordion:hover {
		background-color: #ddd;
	}
	button.accordion:after {
		content: '\02795';
		font-size: 13px;
		color: #777;
		float: right;
		margin-left: 5px;
	}
	button.accordion.active:after {
		content: "\2796";
	}
	div.panel {
		padding: 0 18px;
		background-color: white;
		max-height: 0;
		overflow: hidden;
		transition: max-height 0.2s ease-out;
	}
	</style>
  </head>
  <body class="bg">
    <div class="container" style="text-align:center;">
	
<?php
$firstName = $lastName = $address = $email = $phone = $comment = $err = "";
$city = "Spokane";
$state = "WA";
$zipcode = 99207;
$mailingList = true;
$regularPickup = true;
$appliancePickup = false;
$furniturePickup = false;
  
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $firstName = test_input($_POST["inputFirstName"]);
  if (empty($firstName) || $firstName == '') {
    $err .= "First name is required. ";
  }
  $lastName = test_input($_POST["inputLastName"]);
  if (empty($lastName) || $lastName == '') {
    $err .= "Last name is required. ";
  }
  $address = test_input($_POST["inputAddress"]);
  if (empty($address) || $address == '') {
    $err .= "Address is required. ";
  }
  $city = test_input($_POST["inputCity"]);
  if (empty($city) || $city == '') {
    $err .= "City is required. ";
  }
  $state = test_input($_POST["inputState"]);
  if (empty($state) || $state == '') {
    $err .= "State is required. ";
  }
  $zipcode = test_input($_POST["inputZipcode"]);
  if (empty($zipcode) || $zipcode == '') {
    $err .= "Zipcode is required. ";
  }
  $email = test_input($_POST["inputEmail"]);
  if (empty($email) || $email == '') {
    $err .= "Email is required. ";
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $err .= "Invalid email format. "; 
  }
  $phone = test_input($_POST["inputPhone"]);
  if (empty($phone) || $phone == '') {
    $err .= "Phone number is required. ";
  }
  
  $regularPickup = ($_POST["inputRegularPickup"] == "yes");
  $appliancePickup = ($_POST["inputAppliancePickup"] == "yes");
  $furniturePickup = ($_POST["inputFurniturePickup"] == "yes");
  
  $comment = test_input($_POST["inputDescription"]);
  if (empty($comment) || $comment == '') {
    $err .= "Please tell us what you need picked up. ";
  }
  $mailingList = ($_POST["inputMailingList"] == "yes");

  if (!empty($err)) {
?>
    <div class="alert alert-danger">Please fix the following issues, and try again: <br/><?php echo trim($err);?></div>
<?php
  } else {
    require 'register.php';
	
	$err = register($firstName, $lastName, $email, $phone, $address, $city, $state, $zipcode, $comment, $mailingList, $regularPickup, $appliancePickup, $furniturePickup);
	if (!empty($err)) {
?>
      <div class="alert alert-danger"><?php echo trim($err);?></div>
<?php
    } else {
?>
      <div class="alert alert-success">Thanks for registering! We just sent you a confirmation email. We'll send you another one with your pickup day once we can review your registration.<br/><a href="#faqs">Frequently Asked Questions.</a></div>
<?php
    }
  }
}
?>
	
	<h1 class="form-signin-heading">Nevada Heights Neighborhood</h1>
	<div class="row">
      <div class="col-12">
	    <h2 class="form-signin-heading">Free Garbage Pickup Event!</h2>
	    <p>If you live in the Nevada Heights Neighborhood, and are interested in signing up for the free garbage pickup event, please <a href="#register">fill out the form below</a>. If you have any questions, please check our <a href="#faqs">Frequently Asked Questions</a> list at the bottom of the page. The free garbage pickup event will take place on the following dates:</p>
		<h3>Small Items and Regular trash: June 5th and 6th, 2018</h3>
		<h3>Large Appliance Pickup: August 8th, 2018</h3>
		<h3>Furniture Pickup: August 16th, 2018</h3>
		<p>After you register, we will send you a confirmation email to let you know we received your registration. Once we review your your registration, we will email you again to let you know what day your have been scheduled for.</p>
		<hr/>
		<address>
		  Nevada Heights Neighborhood Council<br/>
		  4707 N. Addison St.<br/>
		  Spokane, WA 99207<br/>
		  Email: <a href="mailto:nevadaheightsnc@gmail.com">nevadaheightsnc@gmail.com</a><br/>
		  Phone: <a href="tel:15094892099">(509) 489-2099</a>
		</address>
		<hr/>
	  </div>
	</div>
	<div class="row">
	  <div class="col-12">
        <form class="form-signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
		  <h2 class="form-signin-header" id="register">Register for Pickup</h2>
		  <label for="inputFirstName" class="sr-only">First name</label>
          <input type="text" id="inputFirstName" name="inputFirstName" class="form-control" placeholder="First name" value="<?php echo $firstName;?>" required="">
		  <label for="inputLastName" class="sr-only">Last name</label>
          <input type="text" id="inputLastName" name="inputLastName" class="form-control" placeholder="Last name" value="<?php echo $lastName;?>" required="">
		
		  <label for="inputAddress" class="sr-only">Address</label>
          <input type="text" id="inputAddress" name="inputAddress" class="form-control" placeholder="Address" value="<?php echo $address;?>" required="">
		  <label for="inputCity" class="sr-only">City</label>
          <input type="text" id="inputCity" name="inputCity" class="form-control" placeholder="City" value="<?php echo $city;?>" required="">
		  <label for="inputState" class="sr-only">State</label>
          <input type="text" id="inputState" name="inputState" class="form-control" placeholder="State" value="<?php echo $state;?>" required="">
		  <label for="inputZipcode" class="sr-only">Zipcode</label>
          <input type="number" id="inputZipcode" name="inputZipcode" class="form-control" placeholder="Zipcode" value="<?php echo $zipcode;?>" required="">
		
          <label for="inputEmail" class="sr-only">Email address</label>
          <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" value="<?php echo $email;?>" required="">
		  <label for="inputPhone" class="sr-only">Phone number</label>
          <input type="text" id="inputPhone" name="inputPhone" class="form-control" placeholder="Phone number" value="<?php echo $phone;?>" required="">
		
		  <p>Which pickup events are your signing up for?</p>
		  <label for="inputRegularPickup" class="sr-only">Small Items/Regular Pickup?</label>
		  <input type="checkbox" id="inputRegularPickup" name="inputRegularPickup" class="form-control" style="text-align:left;" value="yes" <?php if($regularPickup) { echo "checked"; }?>> Small Items/Regular Pickup Event?
		  <label for="inputAppliancePickup" class="sr-only">Appliance Pickup?</label>
		  <input type="checkbox" id="inputAppliancePickup" name="inputAppliancePickup" class="form-control" style="text-align:left;" value="yes" <?php if($appliancePickup) { echo "checked"; }?>> Appliance Pickup Event?
		  <label for="inputFurniturePickup" class="sr-only">Furniture Pickup?</label>
		  <input type="checkbox" id="inputFurniturePickup" name="inputFurniturePickup" class="form-control" style="text-align:left;" value="yes" <?php if($furniturePickup) { echo "checked"; }?>> Furniture Pickup Event?
		
		  <label for="inputDescription" class="sr-only">What do you need picked up?</label>
          <textarea id="inputDescription" name="inputDescription" class="form-control" placeholder="What do you need picked up?" rows="5" required=""><?php echo $comment;?></textarea>
		  
		  <label for="inputMailingList" class="sr-only">Send me updates about our neighborhood</label>
          <input type="checkbox" id="inputMailingList" name="inputMailingList" class="form-control" style="text-align:left;" value="yes" <?php if($mailingList) { echo "checked"; }?>> Send me updates about our neighborhood
		  
          <button class="btn btn-lg btn-primary btn-block" type="submit">Register for Pickup!</button>
        </form>
	   </div>
    </div>
	<div class="row">
	  <div class="col-3">&nbsp;</div>
	  <div class="col-6">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle"
     style="display:block"
     data-ad-format="fluid"
     data-ad-layout-key="-6t+ed+2i-1n-4w"
     data-ad-client="ca-pub-8519280427354162"
     data-ad-slot="8418154450"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
	  </div>
	  <div class="col-3">&nbsp;</div>
	</div>
	<div class="row">
      <div class="col-12">
	    <hr/>
	    <h2 class="form-signin-heading" id="faqs">Frequently Asked Questions</h2>
		<p>Click on the questions you have to see the answer. Don't see our question below? Feel free to email us at <a href="mailto:nevadaheightsnc@gmail.com">nevadaheightsnc@gmail.com</a>, or call us at <a href="tel:15094892099">(509) 489-2099</a>, and we will get back to you ASAP!</p>
		
        <button class="accordion"><b>Q:</b> <i>This is free?</i></button>
        <div class="panel">
          <p>Yes, it's completely free! This is an annual event hosted by the Nevada Heights Neighborhood Council, in partnership with Waste Management (the same people who pickup your trash weekly).</p>
        </div>
		<button class="accordion"><b>Q:</b> <i>What kinds of things can I have picked up?</i></button>
        <div class="panel">
          <p>Just about anything! We only ask that you follow these few simple rules:</p>
		  <ul>
		    <li>All items must be light and small enough to be picked up by one person</li>
			<li>NO items that contain compressed refrigerants (no refrigerators, air conditioners, etc.) or petroleum products</li>
		  </ul>
        </div>
		<button class="accordion"><b>Q:</b> <i>How many things can I have picked up?</i></button>
        <div class="panel">
          <p>We are allowed to pick up no more than <strong>6 items</strong> per address for the curbside pickup, and <strong>3 items</strong> for large appliance/furniture. Have more than items? Try asking your neighbor if they will register for a pickup, so you can get rid of your extra stuff!</p>
        </div>
		<button class="accordion"><b>Q:</b> <i>Where do I put my items?</i></button>
        <div class="panel">
          <p>Place all items you have scheduled for pickup on the curb near where you normally put your garbage can. Please be sure to have everything put out by 7AM on the morning you are scheduled for pickup, or we may miss it!</p>
        </div>
        <button class="accordion"><b>Q:</b> <i>When do I need to have my items outside by?</i></button>
        <div class="panel">
          <p>Please be sure to have everything put out by 7AM on the morning you are scheduled for pickup, or we may miss it!</p>
        </div>
		<button class="accordion"><b>Q:</b> <i>Your website is cool! Who made it?</i></button>
        <div class="panel">
          <p><a href="https://www.booksnbytes.net">Books N' Bytes, Inc.</a> did! Their owners, Jarren Long and Debra Shutt, just happen to be members of our neighborhood council!</p>
        </div>
		
		<script>
        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
          acc[i].onclick = function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight){
              panel.style.maxHeight = null;
            } else {
              panel.style.maxHeight = panel.scrollHeight + "px";
            } 
          }
        }
        </script>
	  </div>
	</div>

    </div>
    <script src="ie10-viewport-bug-workaround.js.download"></script>
  </body>
</html>