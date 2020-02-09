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
  $user_name = $row['StudentName'];
?>
<!DOCTYPE HTML>
<html>
   <head>
      <title>프로필 수정</title>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <link rel="stylesheet" href="assets/css/main.css" />
   </head>
   <body class="subpage">

       <!-- Header -->
       <header id="header">
          <nav class="left">
             <a href="#menu"><span>Menu</span></a>
          </nav>
          <a href="index.html" class="logo">Sejong Self-Development</a>
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
  					<li><a href="mypage.php">나의 트랙 레벨</a></li>
  					<li><a href="my_track_level.php">추천 트랙</a></li>
  					<li><a href="my_track_level.php">세종인 공유 게시판</a></li>
  					<?php } ?>
          </ul>
       </nav>

       <!-- Main -->
       <section id="main" class="wrapper">
          <div class="inner">
             <header class="align-center">
                <h1 id = "user_name" style = "display : inline"><?php echo $user_name;?></h1>
                <h2  style = "display : inline">님의 프로필</h2>
                <br>
                <br>
                <p>프로필 개선을 통해 다른 세종인과 경험을 비교하세요. </p>
             </header>

             <!-- Elements -->
            <h3 id="elements">경험 작성</h3>
            </br>
            <div class="row 200%">
               <div class="12u">
                 <form method="POST" action="register_profile_info.php">
                   <div class="row uniform">

                       <h3>학점&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h3>
                       <div class="6u$ 12u$(xsmall)">
                          <input style="width:800px;" type="text" name="grade" id="score" value="" placeholder="학점 / 4.5" />
                       </div>

                       <h3>영어 성적</h3>
                       <div class="6u$ 12u$(xsmall)">
                          <input style="width:800px;" type="text" name="toeic" id="toeic" value="" placeholder="TOEIC / 990 만점" />
                       </div>


                       <h3>수상 내역</h3>
                       <div class="6u$ 6u$(xsmall)">
                          <input style="width:800px;" type="text" name="prize" id="prize" value="" placeholder="여러개는 , 로 구분해주세요" />
                       </div>

                       <h3>자격증&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h3>
                       <div class="6u$ 6u$(xsmall)" >
                          <input style="width:800px;" type="text" name="certification" id="license" value="" placeholder="여러개는 , 로 구분해주세요" />
                       </div>

                       <h3>인턴쉽&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h3>
                       <div class="6u$ 6u$(xsmall)" >
                          <input style="width:800px;" type="text" name="internship" id="internship" value="" placeholder="회사명 /여러개는 , 로 구분해주세요" />
                       </div>

                       <div class="12u$" style ="margin-left:90px">
                          <ul class="actions">
                             <li><input type="submit" name="profile_info" value="제출" /></li>
                             <li><input type="reset" value="다시쓰기" class="alt" /></li>
                          </ul>
                       </div>
                    </div>
                 </form>
               </div>
            </div>
          </div>
       </section>

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

      </script>
   </body>
</html>
