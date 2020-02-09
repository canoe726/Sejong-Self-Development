<?php
  session_start();

  require "db_require.php";
  $db = mysqli_connect($db_host,$db_user,$db_passwd,$db_name);

  $user_id = $_SESSION['StudentID'];
  $hashed_id = hash('sha512', $user_id);
  $track = $_POST['track'];
  $project = $_POST['project'];
  $aff = $_POST['aff'];
  $exp = $_POST['exp'];

  if( !$db ) {
   die( 'MYSQL connect ERROR: ' . mysqli_error($db));
  }

  if( count($track) > 0 && count($project) > 0 && count($aff) > 0 && count($exp) > 0 ) {

    $track = implode(',', $track);
    $project = implode(',', $project);
    $aff = implode(',', $aff);
    $exp = implode(',', $exp);

    $sql = "INSERT INTO hackerton_survey_info( StudentID, track, project, aff, exps )
            VALUES( '$hashed_id', '$track', '$project', '$aff', '$exp' )";
    $ret = mysqli_query( $db, $sql );

    if( $ret ) {
      $query = "UPDATE hackerton_login_info SET survey_status=1 WHERE StudentID='$hashed_id'";
      $resource = mysqli_query( $db, $query );

      echo "<script> alert('설문 정보가 정상적으로 등록되었습니다'); </script>";
      echo "<meta http-equiv='refresh' content=\"0;url=http://canoe726.cafe24.com/SejongSelfDevelopment/show_recommend_lists.php\">";
      exit(0);
    }
    else {
      die( 'MYSQL query ERROR: ' . mysqli_error($db));
    }
  } else {
    echo "<script> alert('모든 질문 카테고리 당 최소 하나 이상 선택해주세요.'); document.location.href='http://canoe726.cafe24.com/SejongSelfDevelopment/survey.php';</script>";
  }
?>
