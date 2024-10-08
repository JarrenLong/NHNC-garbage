<?php

function send_confirmation_email($name, $email, $comment) {
  $subject = "Nevada Heights Neighborhood - 2018 Garbage Pickup Registration";

  $message = file_get_contents("./email.html");
  $message = str_replace("__NAME__", $name, $message);
  $message = str_replace("__COMMENT__", $comment, $message);

  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
  $headers .= 'From: "Nevada Heights Neighborhood Council" <no-reply@nevadaheights.org>' . "\r\n";
  //$headers .= 'BCC: Nevada Heights Neighborhood Council <nevadaheightsnc@gmail.com>' . "\r\n";
  $headers .= 'Reply-To: Nevada Heights Neighborhood Council <nevadaheightsnc@gmail.com>' . "\r\n";

  return mail($email, $subject, $message, $headers);
}

function register($firstName, $lastName, $email, $phone, $address, $city, $state, $zipcode, $comment, $mailingList, $regularPickup, $appliancePickup, $furniturePickup) {
  $ret = '';
  
  $servername = "";
  $username = "";
  $password = "";
  $dbname = "";

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    $ret = "Error registering! Please call or email us to schedule your pickup instead.";
  }
  
  // Check to make sure this person is not already registered
  $sql = "SELECT FirstName FROM GarbageRegistrations WHERE (FirstName='".$firstName."' AND LastName='".$lastName."') OR Address='".$address."' OR Email='".$email."' OR Phone='".$phone."'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $ret = "You are already registered!";
	$conn->close();
    return $ret;
  }
  
  // Not already saved, do so now
  $sql = "INSERT INTO GarbageRegistrations (FirstName, LastName, Email, Phone, Address, City, State, Zipcode, Comment, MailingList, RegularPickup, AppliancePickup, FurniturePickup) VALUES ('".$firstName."', '".$lastName."', '".$email."', '".$phone."', '".$address."', '".$city."', '".$state."', '".$zipcode."', '".$comment."', '".($mailingList?1:0)."', '".($regularPickup?1:0)."', '".($appliancePickup?1:0)."', '".($furniturePickup?1:0)."')";
  if($conn->query($sql) !== TRUE) {
    $ret = "Error registering! Please call or email us to schedule your pickup instead.";
	$conn->close();
    return $ret;
  }

  // Send out the confirmation email
  if(send_confirmation_email($firstName, $email, $comment) === FALSE) {
    $ret = "We received your registration, but are having trouble sending the confirmation email. Don't worry, you're accounted for :)";
	$conn->close();
    return $ret;
  }
  
  // Cleanup and return success  
  $conn->close();
  
  return $ret;
}

function get_registration_list() {
  $ret = array();
  
  $servername = "mysql.nevadaheights.org";
  $username = "nevadaheightsorg";
  $password = "ps4fVuFm";
  $dbname = "nevadaheights_org";

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    $ret = "Error!";
  }
  
  // Get a list of everyone who has already registered
  $sql = "SELECT CONCAT(FirstName, ' ', LastName), CONCAT(Address, ', ', City, ', ', State, ', ', Zipcode), Phone, Email, Comment, Latitude, Longitude, RegularPickup, AppliancePickup, FurniturePickup FROM GarbageRegistrations";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while ($row=mysqli_fetch_row($result)) {
      $buf = array($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9]);
      array_push($ret, $buf);
    }
  }
  
  // Cleanup and return success  
  $conn->close();
  
  return $ret;
}

function registration_list_to_csv($regList) {
  $ret = '';
  foreach($regList as $rec) {
	  $ret .= '"' .$rec[0] . '","' . $rec[1] . '","' . $rec[2] . '","' . $rec[3] . '","' . $rec[4] . '","' . $rec[5] . '","' . $rec[6] . '","' . $rec[7] . '","' . $rec[8] . '","' . $rec[9] . '"\n';
  }
  return $ret;
}

function array_to_csv_download($array, $filename = "export.csv", $delimiter=",") {
    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename="'.$filename.'";');

    $f = fopen('php://output', 'w');

    foreach ($array as $line) {
        fputcsv($f, $line, $delimiter);
    }
	
	header('Location: ~;');
}   
?>
