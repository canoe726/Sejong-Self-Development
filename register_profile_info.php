<?php
  session_start();

  require "db_require.php";
  $db = mysqli_connect($db_host,$db_user,$db_passwd,$db_name);

  $user_id = $_SESSION['StudentID'];
  $hashed_id = hash('sha512', $user_id);
  $grade = $_POST["grade"];
  $toeic = $_POST["toeic"];
  $prize = $_POST["prize"];
  $certification = $_POST["certification"];
  $internship = $_POST["internship"];

  if( !$db ) {
   die( 'MYSQL connect ERROR: ' . mysqli_error($db));
  }

  if( $grade != '') {
    $sql = "INSERT INTO hackerton_profile_info( StudentID, grade, toeic, prize, certification, internship )
            VALUES( '$hashed_id', '$grade', '$toeic', '$prize', '$certification', '$internship' )";
    $ret = mysqli_query( $db, $sql );

    if( $ret ) {
      $query = "UPDATE hackerton_login_info SET profile_status=1 WHERE StudentID='$hashed_id'";
      $resource = mysqli_query( $db, $query );

      echo "<script> alert('프로필 정보가 정상적으로 등록되었습니다'); </script>";
      echo "<meta http-equiv='refresh' content=\"0;url=http://canoe726.cafe24.com/SejongSelfDevelopment/my_profile.php\">";
      exit(0);
    }
    else {
      die( 'MYSQL query ERROR: ' . mysqli_error($db));
    }
  } else {
    echo "<script> alert('학점 항목은 반드시 선택해주세요.'); document.location.href='http://canoe726.cafe24.com/SejongSelfDevelopment/profile_input.php';</script>";
  }
?>
