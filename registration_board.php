<?php session_start(); ?>
<!DOCTYPE HTML>
<html>
   <head>
    <title>게시판 글쓰기</title>
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
                   <li><a href="#" class="button fit">Login</a></li>
                </ul>
             </nav>

        <!--profile-->
        <section id="main" class="wrapper">
          <div class="inner">
           <form method="POST" action="upload_board.php">
              <div class="fields">
                <header class="align-center">
                   <h1 id = "user_name" style = "display : inline">공유게시판 글쓰기</h1>
                   <br>
                   <br>
                   <p>멋지게 만든 프로젝트의 깃허브 주소를 공유하세요.</p>
                 </header>

                 <div class="field half">
                    <label for="title">제목</label>
                    <input type="text" name="title" id="title" />
                 </div>
                 <br>

                 <div class="field half">
                    <label for="participation">참가자</label>
                    <input type="text" name="participation" id="participation" />
                 </div>
                 <br>

                 <div class="field half">
                    <label for="link">깃허브 링크</label>
                    <input type="text" name="git_link" id="link" />
                 </div>
                 <br>

                 <div class="field">
                    <label for="message">프로젝트 간단한 소개</label>
                    <textarea name="message" id="message" rows="4"></textarea>
                 </div>
                 <br>
              </div>
                <input type="submit" name="write_board" value="작성"/>
           </form>
          </div>
        </section>
          <!-- Scripts -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/jquery.scrolly.min.js"></script>
        <script src="assets/js/skel.min.js"></script>
        <script src="assets/js/util.js"></script>
        <script src="assets/js/main.js"></script>
   </body>
</html>
