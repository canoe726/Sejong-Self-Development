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

  $sql = "SELECT * FROM hackerton_subject_info WHERE StudentID='$hashed_id'";
  $resource = mysqli_query( $db, $sql );
  $row = mysqli_fetch_assoc($resource);

  $data_sub = $row['TakenCourse'];
?>
<!DOCTYPE HTML>
<html>
   <head>
      <title>내 트랙 레벨</title>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <link rel="stylesheet" href="assets/css/main.css" />
      <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
      <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script>
          var data_sub = '<?=$data_sub?>';
          data_sub = data_sub.split(',');

          var subject = [
             ['선형대수 및 프로그래밍', '컴퓨터 그래픽스', '웹 프로그래밍', '영상처리’, HCI개론', 'XMI 프로그래밍', '정보검색', '가상현실', '멀티미디어 프로그래밍', '고급실시간그래픽스', '오픈소스SW개론'],
             ['멀티미디어','선형대수 및 프로그래밍','통계학개론','신호 및 시스템','디지털 신호처리', '패턴인식', '영상처리', '영상처리 프로그래밍','모바일 프로그래밍','가상현실','멀티미디어 프로그래밍'],
             ['컴퓨터네트워크', '신호 및 시스템', '확률통계 및 프로그래밍', '통신시스템','디지털 신호처리','임베디드 시스템','네트워크 프로그래밍','정보보호개론','데이터통신','무선통신','인터넷보안','지능형 시스템','멀티코어 프로그래밍'],
             ['디지털 시스템','마이크로컴퓨터','VHDL 프로그래밍','데이터베이스','프로그래밍 언어의 개념','소프트웨어공학','컴파일러','멀티코어 프로그래밍','임베디드 시스템','UNIX 프로그래밍','멀티미디어 프로그래밍','문제해결기법'],
             ['통계학개론','확률통계 및 프로그래밍','데이터베이스','영상처리','패턴인식','인공지능','지능형시스템','멀티미디어','정보검색','HCI개론','데이터분석개론','기계학습','가상현실','오픈소스SW개론'],
             ['멀티미디어 프로그래밍','선형대수 및 프로그래밍','컴퓨터 그래픽스','고급실시간그래픽스','가상현실','멀티미디어','디지털사운드','HCI개론','영상처리','오픈소스SW개론'],
             ['어썸블리어','보안프로그래밍','컴퓨터네트워크','대칭키암호론','공개키암호론','시스템해킹과 보안','인터넷보안','악성코드분석','정보보호개론','정보보호와 보안의 기초','데이터베이스 및 보안','사이버전개론'],
             ['데이터베이스','확률통계 및 프로그래밍','데이터분석개론','기계학습','데이터기반인공지능','인공지능','경영과학','데이터시각화','대용량데이터처리개론','텍스트마이닝','의사결정분석','컴퓨터 그래픽스','통계학개론'],
             ['문제해결 및 실습 C++','웹 프로그래밍','소프트웨어공학','문제해결 및 실습 JAVA','모바일 프로그래밍','오픈소스SW개론','데이터베이스','오픈소스SW공학','오픈소스SW설계'],
             ['웹해킹과 보안','사이버전개론','시스템해킹과 보안','사이버관제 및 대응','사이버공방종합훈련','디지털포렌식','네트워크해킹과 보안','악성코드분석']
          ];

          var level_score = [1,1,1,1,1,1,1,1,1,1];

          for(var i=0; i<subject.length; i++) {
            for(var j=0; j<subject[i].length; j++) {
              for(var k=0; k<data_sub.length; k++) {
                 if( subject[i][j] == data_sub[k] ) {
                   level_score[i] = level_score[i] + 1;
                 }
              }
            }
          }
        </script>
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
        <section id="main" class="wrapper">
          <div class="inner">
            <header class="align-center">

            <header class="align-center">
               <h1 id = "user_name" style = "display : inline"><?php echo $user_name;?></h1>
               <h2  style = "display : inline">님의 트랙 이수 교과목</h2>
               <br>
               <br>
               <p>내 트랙 레벨을 통해 실력을 체크하세요.</p>
             </header>
             <div id="logo">
                 <img class="image" src = "images/profile.png" width = "150px" height = "150px" >
             </div>
             <div class="progress">
                <div id="bar1" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
                     aria-valuemin="0" aria-valuemax="100"> HCI & 비주얼 컴퓨팅 </div>
              </div>

              <div class="progress">
                <div id="bar2" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
                     aria-valuemin="0" aria-valuemax="100"> 멀티미디어 </div>
              </div>

              <div class="progress">
                <div id="bar3" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
                     aria-valuemin="0" aria-valuemax="100"> 사물인터넷 </div>
              </div>

              <div class="progress">
                <div id="bar4" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
                     aria-valuemin="0" aria-valuemax="100"> 시스템응용 </div>
              </div>

              <div class="progress">
              <div id="bar5" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
                   aria-valuemin="0" aria-valuemax="100"> 인공지능 </div>
              </div>

              <div class="progress">
              <div id="bar6" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
                   aria-valuemin="0" aria-valuemax="100"> 가상현실 </div>
              </div>

              <div class="progress">
              <div id="bar7" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
                   aria-valuemin="0" aria-valuemax="100"> 정보보호 </div>
              </div>

              <div class="progress">
              <div id="bar8" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
                   aria-valuemin="0" aria-valuemax="100"> 데이터 사이언스 </div>
              </div>

              <div class="progress">
                <div id="bar9" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
                     aria-valuemin="0" aria-valuemax="100"> SW교육 </div>
              </div>

              <div class="progress">
              <div id="bar10" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
                   aria-valuemin="0" aria-valuemax="100"> 사이버 국방 </div>
              </div>

              <div class="progress-meter">
                <div class="meter meter-left" style="width: 0%;"><span class="meter-text"></span></div>
                <div class="meter meter-left" style="width: 14%;"><span class="meter-text">Lv.0</span></div>
                <div class="meter meter-left" style="width: 14%;"><span class="meter-text">Lv.1</span></div>
                <div class="meter meter-left" style="width: 14%;"><span class="meter-text">Lv.2</span></div>
                <div class="meter meter-left" style="width: 14%;"><span class="meter-text">Lv.3</span></div>
                <div class="meter meter-left" style="width: 14%;"><span class="meter-text">Lv.4</span></div>
                <div class="meter meter-left" style="width: 14%;"><span class="meter-text">Lv.5</span></div>
                <div class="meter meter-left" style="width: 14%;"><span class="meter-text">Lv.6</span></div>
                <div class="meter meter-right" style="width: 0%;"><span class="meter-text"></span></div>
              </div>
          </header>
        </div>
     </section>

     <!-- Scripts -->
     <script src="assets/js/jquery.min.js"></script>
     <script src="assets/js/jquery.scrolly.min.js"></script>
     <script src="assets/js/skel.min.js"></script>
     <script src="assets/js/util.js"></script>
     <script src="assets/js/main.js"></script>
     <script>
        for(var i=1; i<=10; i++) {
          var score = (level_score[i-1]*14);
          if( score >= 98 ) {
            score = 100;
          }
          document.getElementById("bar"+i).style.width = score + "%";
        }
     </script>
     <br><br><br><br><br>

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
   </body>
</html>
