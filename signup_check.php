<?php
  session_start();

  //$auth_status = 0;
  //$_SESSION['auth_status'] = $auth_status;

  require "db_require.php";
  $db = mysqli_connect($db_host,$db_user,$db_passwd,$db_name);

  $user_id = $_POST["StudentID"];
  $user_pw = $_POST["Password"];

  $hashed_id = hash('sha512', $user_id);
  $hashed_pw = hash('sha512', $user_pw);

  if( !$db ) {
   die( 'MYSQL connect ERROR: ' . mysqli_error($db));
  }

  # signup-button was clicked
  if (isset($_POST['signup'])) {
    header('Location: http://canoe726.cafe24.com/SejongSelfDevelopment/signup.php');
  }
  # new_account-button was clicked
  elseif (isset($_POST['new_account'])) {
    //echo "new account";
    $user_name = $_POST["StudentName"];
    $email = $_POST["Email"];

    // input something
    if( $user_id != '' && $user_pw != '' && $email ) {
      // duplicate check
      $sql = "SELECT * FROM hackerton_login_info WHERE StudentID='$hashed_id'";
      $resource = mysqli_query( $db, $sql );
      $num = mysqli_num_rows( $resource );

      // if exist login information -> exit()
      if( $num > 0 ) {
        echo "<script> alert('이미 다른 사용자가 같은 아이디를 사용하고 있습니다.'); </script>";
        echo "<script> window.history.back(); </script>";
        exit(0);
      }

      // if no exist login information -> insert information into db
      $sql = "INSERT INTO hackerton_login_info( StudentName, StudentID, Password, Email ) VALUES( '$user_name', '$hashed_id', '$hashed_pw', '$email' )";
      $ret = mysqli_query( $db, $sql );

      if( $ret ) {
        echo "<script> alert('회원가입이 정상적으로 처리되었습니다'); </script>";
        echo "<meta http-equiv='refresh' content=\"0;url=http://canoe726.cafe24.com/SejongSelfDevelopment/login.php\">";
        exit(0);
      }
      else {
        die( 'MYSQL query ERROR: ' . mysqli_error($db));
      }
    }
    // nothing login information -> back to login page
    else {
      echo "<script> alert('아이디와 비밀번호를 입력해주세요.'); document.location.href='http://canoe726.cafe24.com/SejongSelfDevelopment/signup.php';</script>";
    }
  }
  # login-button was clicked
  elseif (isset($_POST['login'])) {

      $sql = "SELECT * FROM hackerton_login_info WHERE StudentID='$hashed_id'";
      $resource = mysqli_query( $db, $sql );

      $row = mysqli_fetch_assoc($resource);

      if( $row['StudentID'] == $hashed_id && $row['Password'] == $hashed_pw )
      {
        /* If success */
        $_SESSION['StudentID'] = $user_id;
        echo "<script> alert('로그인 하셨습니다.');
              document.location.href='http://canoe726.cafe24.com/SejongSelfDevelopment/index.php';</script>";
      }
      else
      {
        echo "<script> alert('아이디 혹은 패스워드가 맞지 않습니다.');
              document.location.href='http://canoe726.cafe24.com/SejongSelfDevelopment/login.php'; </script>";
      }
  }

  mysql_close($db);
?>
