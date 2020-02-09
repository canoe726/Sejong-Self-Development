<?php
  session_start();

  require "db_require.php";
  $db = mysqli_connect($db_host,$db_user,$db_passwd,$db_name);

  if( !$db ) {
   die( 'MYSQL connect ERROR: ' . mysqli_error($db));
  }

  $user_id = $_SESSION['StudentID'];
  $hashed_id = hash('sha512', $user_id);
  $sql = "SELECT * FROM hackerton_board WHERE number='$hashed_id'";
  $resource = mysqli_query( $db, $sql );
  $row = mysqli_fetch_assoc($resource);
  $user_name = $row['StudentName'];

  $sql = "SELECT * FROM hackerton_subject_info WHERE StudentID='$hashed_id'";
  $resource = mysqli_query( $db, $sql );
  $row = mysqli_fetch_assoc($resource);


?>
<!DOCTYPE HTML>
<html>
<head>
 <title>공유게시판</title>
 <meta charset="utf-8" />
 <meta name="viewport" content="width=device-width, initial-scale=1" />
 <link rel="stylesheet" href="assets/css/main.css" />
 <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
 <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
 <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    </head>

  <body>
      <!-- Header -->
      <header id="header">
          <nav class="left">
              <a href="#menu"><span>Menu</span></a>
          </nav>
          <a href="index.php" class="logo">Sejong Self-Development</a>
          <nav class="right">
            <?php if(!isset($_SESSION['StudentID'])) { ?>
            <a href="login.php" class="button alt">로그인</a>
            <?php } else { ?>
            <a href="logout.php" class="button alt">로그아웃</a>
            <?php	} ?>
          </nav>
      </header>

      <!-- Menu -->
      <nav id="menu">
        <ul class="links">
          <li><a href="index.php">메인</a></li>
          <?php if(isset($_SESSION['StudentID'])) { ?>
          <li><a href="mypage.php">마이페이지</a></li>
          <li><a href="my_track_level.php">나의 트랙 레벨</a></li>
          <li><a href="mytrack.php">추천 트랙</a></li>
          <li><a href="board.php">세종인 공유 게시판</a></li>
          <?php } ?>
        </ul>
        <ul class="actions vertical">
          <?php if(!isset($_SESSION['StudentID'])) { ?>
          <a href="login.php" class="button alt">로그인</a>
          <?php } else { ?>
          <a href="logout.php" class="button alt">로그아웃</a>
          <?php	} ?>
        </ul>
      </nav>

      <!--profile-->
      <!-- Main -->
        <section id="main" class="wrapper">
            <div class="inner">
                <header class="align-center">
                    <h1>공유 게시판</h1>
                      <br><br>
                </header>

     <!-- Preformatted Code -->
            <h2 id = "btitle" style = "text-align:center; color:black; font-weight: 800">게시판 제목</h2>
            <pre><code id = "bcontents" style="font-size: 15px; color: black; width: 100%; height: 300px;">게시판 내용</code>
              </pre>
              </div>
            </section>

            <div class="text-center">
              <a href="http://canoe726.cafe24.com/SejongSelfDevelopment/board.php" class="btn btn-default" style="text-alingn:right;"> 목록 </a>
            </div>
            <br><br>

      <!-- Footer -->
  			<footer id="footer">
  				<div class="inner">
  					<h2>Get In Touch</h2>
  					<ul class="actions">
  						<li><span class="icon fa-phone"></span> <a href="#">(010) 0000-0000</a></li>
  						<li><span class="icon fa-envelope"></span> <a href="#">ybkim@gmail.com</a></li>
  					</ul>
  				</div>
  			</footer>

      <!-- Scripts -->
      <script src="assets/js/jquery.min.js"></script>
      <script src="assets/js/jquery.scrolly.min.js"></script>
      <script src="assets/js/skel.min.js"></script>
      <script src="assets/js/util.js"></script>
      <script src="assets/js/main.js"></script>
      <script>

        //var message =
        //var board_title =
         var message = "해커톤에 참여했다.";
         var board_title = "해커톤";
         function up(){
           document.getElementById("btitle").innerHTML = board_title;
           document.getElementById("bcontents").innerHTML = message;
         }
         up();
      </script>
  </body>
  </html>
