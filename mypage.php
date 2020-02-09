<?php
  session_start();

  require "db_require.php";
  $db = mysqli_connect($db_host,$db_user,$db_passwd,$db_name);

  if( !$db ) {
   die( 'MYSQL connect ERROR: ' . mysqli_error($db));
  }

  $user_id = $_SESSION['StudentID'];
  $hashed_id = hash('sha512', $user_id);
  $sql = "SELECT * FROM hackerton_login_info WHERE StudentID='$hashed_id'";
  $resource = mysqli_query( $db, $sql );
  $row = mysqli_fetch_assoc($resource);

  if( $row['profile_status'] == 1 ) {
    echo "<script> document.location.href='http://canoe726.cafe24.com/SejongSelfDevelopment/my_profile.php';</script>";
  } else {
    echo "<script> document.location.href='http://canoe726.cafe24.com/SejongSelfDevelopment/profile_input.php';</script>";
  }
?>
