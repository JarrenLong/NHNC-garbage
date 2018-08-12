<?php
require("register.php");

if(isset($_POST['dl_csv']))
{
  array_to_csv_download(get_registration_list(), 'registration_list.csv');
}
?>
