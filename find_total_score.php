<?php
  session_start();

  require "db_require.php";
  $db = mysqli_connect($db_host,$db_user,$db_passwd,$db_name);

  if( !$db ) {
   die( 'MYSQL connect ERROR: ' . mysqli_error($db));
  }

  $sql = "SELECT * FROM hackerton_profile_info";
  $result = mysqli_query($db, $sql);

  $total_people = 0;
  $total_grade = 0;
  $total_toeic = 0;
  $total_prize = 0;
  $total_certification = 0;
  $total_internship = 0;

  while($row = mysqli_fetch_assoc($result)) {
      $total_people = $total_people + 1;

      $total_grade = $total_grade + $row['grade'];
      $total_toeic = $total_toeic + $row['toeic'];

      $temp_prize = $row['prize'];
      $total_prize = $total_prize + count(explode(',' , $temp_prize));

      $temp_certification = $row['certification'];
      $total_certification = $total_certification + count(explode(',' , $temp_certification));

      $temp_internship = $row['internship'];
      $total_internship = $total_internship + count(explode(',' , $temp_internship));
  }

  $total_grade = (int)((($total_grade / $total_people)/4.5) * 100);
  $total_toeic = (int)((($total_toeic / $total_people)/990) * 100);
  $total_prize = (int)((($total_grade / $total_people)/5) * 100);
  $total_certification = (int)((($total_grade / $total_people)/5) * 100);
  $total_internship = (int)((($total_grade / $total_internship)/5) * 100);

  $sql = "INSERT INTO hackerton_total_score( grade, toeic, prize, certification, internship )
          VALUES( '$total_grade', '$total_toeic', '$total_prize', '$total_certification', '$total_internship' )";
  $ret = mysqli_query( $db, $sql );

?>
