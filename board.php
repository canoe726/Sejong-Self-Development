<?php
  session_start();

  require "db_require.php";
  $db = mysqli_connect($db_host,$db_user,$db_passwd,$db_name);

  if( !$db ) {
   die( 'MYSQL connect ERROR: ' . mysqli_error($db));
  }
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
      <div class="container">
        <div class="inner">
          <section id="main" class="wrapper">
            <header class="align-center">
               <br>
               <br>
               <h1 id = "user_name" style = "display : inline">공유 게시판</h1>
               <br>
               <br>
               <p>모든 세종인들의 프로젝트를 비교해보세요.</p>
             </header>
           </section>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="70">번호</th>
                        <th width="300">제목</th>
                        <th width="200">참가자</th>
                        <th width="200">링크</th>
                        <th width="100">작성일</th>
                    </tr>
                </thead>
                <?php
                  $sql = ("SELECT * FROM hackerton_board");
                  $ret = mysqli_query( $db, $sql );
                    while($board = mysqli_fetch_assoc($ret))
                    {
                      $title=$board["title"];
                      if(strlen($title)>30)
                      {
                        //title이 30을 넘어서면 ...표시
                        $title = str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]);
                      }
                  ?>
                <tbody>
                    <tr>
                        <th width="70"><?php echo $board['number']; ?></th>
                        <th width="300"><a href="boards.php" onlick="go();"><?php echo $title; ?></a></th>
                        <th width="200"><?php echo $board['team_member']; ?></th>
                        <th width="200"><a href = "http://"+<?php echo $board['git_link']; ?>><?php echo $board['git_link']; ?></a></th>
                        <th width="100"><?php echo $board['dates']; ?></th>
                    </tr>
                </tbody>
              <?php } ?>
            </table>
            <div class="text-center">

                <ul class="pagination">
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                </ul>

                <a href="http://canoe726.cafe24.com/SejongSelfDevelopment/registration_board.php" class="btn btn-default" style="text-alingn:right;"> 글쓰기 </a>
            </div>

        </div>
      </div>

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
      <scirpt>
        function go() {

        }
      </script>
  </body>
</html>
