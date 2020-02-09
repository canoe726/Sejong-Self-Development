<?php
  session_start();

  require "db_require.php";
  $db = mysqli_connect($db_host,$db_user,$db_passwd,$db_name);

  if( !$db ) {
   die( 'MYSQL connect ERROR: ' . mysqli_error($db));
  }

  $title = $_POST["title"];
  $team_member = $_POST["participation"];
  $git_link = $_POST["git_link"];
  $message = $_POST["message"];
  $date = date('Y-m-d');

  if( $title != "" && $team_member != "" && $git_link != "" && $date != "") {
    $sql = "INSERT INTO hackerton_board( title, team_member, git_link, dates, data )
            VALUES( '$title', '$team_member', '$git_link', '$date', '$message' )";
    $resource = mysqli_query( $db, $sql );

    if( $resource ) {
      echo "<script> alert('글이 등록되었습니다.'); </script>";
      echo "<meta http-equiv='refresh' content=\"0;url=http://canoe726.cafe24.com/SejongSelfDevelopment/board.php\">";
    } else {
      die( 'MYSQL query ERROR: ' . mysqli_error($db));
    }
  } else {
    echo "<script> alert('모든 항목을 입력해주세요.'); </script>";
    echo "<meta http-equiv='refresh' content=\"0;url=http://canoe726.cafe24.com/SejongSelfDevelopment/registration_board.php\">";
  }
?>
