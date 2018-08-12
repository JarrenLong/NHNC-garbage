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
	<script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
	#map_canvas {
		/* width: 500px; */
		height: 480px;
	}
	</style>
  </head>
  <body class="bg">
    <div class="container" style="text-align:center;">
	<h1 class="form-signin-heading">Nevada Heights Neighborhood</h1>
	<div class="row">
      <div class="col-12">
	    <h2 class="form-signin-heading">Registration Map</h2>
	    <div id="map_canvas"></div>
		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAO4VD44T97jOxsj-O_UaxzC4Bie0nANa0"></script>
		<script>
        $(document).ready(function () {
			var map;
			var elevator;
			var myOptions = {
				zoom: 15,
				center: new google.maps.LatLng(47.700935, -117.403556),
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			map = new google.maps.Map($('#map_canvas')[0], myOptions);

			var addresses = ['428 e wellesley ave, spokane, wa 99207', '504 e wellesley ave, spokane, wa 99207'];

			for (var x = 0; x < addresses.length; x++) {
				$.getJSON('//maps.googleapis.com/maps/api/geocode/json?address='+addresses[x]+'&sensor=false', null, function (data) {
					var p = data.results[0].geometry.location
					var latlng = new google.maps.LatLng(p.lat, p.lng);
					new google.maps.Marker({
						position: latlng,
						map: map
					});

				});
			}
		});
        </script>
		<hr/>
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
	    <h2 class="form-signin-heading" id="faqs">Registration List</h2>
		<form action="dlcsv.php" method="post">
			<input type="hidden" name="dl_csv" />
			<input type="submit" value="Download as CSV" />
		</form>
	
		<table class="table table-bordered table-sm table-inverse">
		  <thead class="thead-default">
		    <tr>
		      <td>Name</td>
		      <td>Address</td>
		      <td>Phone</td>
		      <td>Email</td>
		      <td>Notes</td>
			  <td>Latitude</td>
		      <td>Longitude</td>
			  <td>RegularPickup?</td>
			  <td>AppliancePickup?</td>
		      <td>FurniturePickup?</td>
		    </tr>
		  </thead>
		  <?php
		  require("register.php");
		  $regList = get_registration_list();
		  
		  foreach($regList as $rec) {
		    echo "
		  <tr>
		      <td>" . $rec[0] . "</td>
		      <td>" . $rec[1] . "</td>
		      <td>" . $rec[2] . "</td>
		      <td>" . $rec[3] . "</td>
		      <td>" . $rec[4] . "</td>
			  <td>" . $rec[5] . "</td>
		      <td>" . $rec[6] . "</td>
			  <td>" . $rec[7] . "</td>
			  <td>" . $rec[8] . "</td>
		      <td>" . $rec[9] . "</td>
		    </tr>
			";
		  }
		  ?>
	  </div>
	</div>

    </div>
    <script src="ie10-viewport-bug-workaround.js.download"></script>
  </body>
</html>