<?php session_start(); ?>
<!DOCTYPE HTML>
<html>
   <head>
      <title>설문조사</title>
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
        <a href="index.php" class="logo">Sejong Self-Development</a>
        <nav class="right">
          <?php if(!isset($_SESSION['StudentID'])) { ?>
         <a href="login.php" class="button alt">로그인</a>
         <?php } else { ?>
         <a href="logout.php" class="button alt">로그아웃</a>
         <?php   } ?>
        </nav>
     </header>

      <!-- Menu -->
     <nav id="menu">
        <ul class="links">
           <?php if(isset($_SESSION['StudentID'])) { ?>
           <li><a href="mypage.php">마이페이지</a></li>
           <li><a href="my_track_level.php">나의 트랙 레벨</a></li>
           <li><a href="mytrack.php">추천 트랙</a></li>
           <li><a href="board.php">세종인 공유 게시판</a></li>
           <?php } ?>
           <li><a href="index.php">메인</a></li>
        </ul>
        <ul class="actions vertical">
           <li><a href="#" class="button fit">Login</a></li>
        </ul>
     </nav>

      <!-- Main -->
     <section id="main" class="wrapper">
      <div class="inner">
         <header class="align-center">
            <h1>Survey</h1>
            <p>당신의 트랙을 설계해드립니다.</p>
         </header>

         <hr class="major" />
         <!-- Elements -->
            <div class="row 200%">
               <div class="12u">
                  <!-- Form -->
                  <form method="POST" action="register_survey_info.php">
                  <h3>01. 관심있는 트랙을 선택해주세요.</h3>
                     <div class="row uniform">
                          <div class="4u 12u$(small)">
                             <input type="checkbox" id="track1" name="track[]" value="HCI & 비쥬얼컴퓨팅">
                             <label for="track1">HCI & 비쥬얼컴퓨팅</label>
                          </div>
                          <div class="4u 12u$(small)">
                                <input type="checkbox" id="track2" name="track[]" value="멀티미디어">
                                <label for="track2">멀티미디어</label>
                          </div>
                          <div class="4u$ 12u$(small)">
                                <input type="checkbox" id="track3" name="track[]" value="사물인터넷">
                                <label for="track3">사물인터넷</label>
                          </div>
                          <div class="4u 12u$(small)">
                                <input type="checkbox" id="track4" name="track[]" value="시스템응용">
                                <label for="track4">시스템응용</label>
                          </div>
                          <div class="4u 12u$(small)">
                                   <input type="checkbox" id="track5" name="track[]" value="인공지능">
                                   <label for="track5">인공지능</label>
                          </div>
                          <div class="4u$ 12u$(small)">
                                   <input type="checkbox" id="track6" name="track[]" value="가상현실">
                                   <label for="track6">가상현실</label>
                          </div>
                          <div class="4u 12u$(small)">
                                <input type="checkbox" id="track7" name="track[]" value="정보보호">
                                <label for="track7">정보보호</label>
                          </div>
                          <div class="4u 12u$(small)">
                                   <input type="checkbox" id="track8" name="track[]" value="데이터 사이언스">
                                   <label for="track8">데이터 사이언스</label>
                          </div>
                          <div class="4u$ 12u$(small)">
                                   <input type="checkbox" id="track9" name="track[]" value="SW교육">
                                   <label for="track9">SW교육</label>
                          </div>
                          <div class="4u$ 12u$(small)">
                                <input type="checkbox" id="track10" name="track[]" value="사이버국방">
                                <label for="track10">사이버국방</label>
                          </div>
                    </div>

                   <hr class="major" />

                   <h3>02. 참여한 프로젝트를 선택해주세요. </h3>
                     <div class="row uniform">
                          <div class="4u 12u$(small)">
                             <input type="checkbox" id="project1" name="project[]" value="창의SW기초설계">
                             <label for="project1">창의SW기초설계</label>
                          </div>
                          <div class="4u 12u$(small)">
                              <input type="checkbox" id="project2" name="project[]" value="오픈소스SW설계">
                              <label for="project2">오픈소스SW설계</label>
                          </div>
                          <div class="4u$ 12u$(small)">
                              <input type="checkbox" id="project3" name="project[]" value="AI프로그램설계">
                              <label for="project3"> AI프로그램설계  </label>
                          </div>
                          <div class="4u 12u$(small)">
                              <input type="checkbox" id="project4" name="project[]" value="악성코드분석">
                              <label for="project4">악성코드분석</label>
                          </div>
                          <div class="4u 12u$(small)">
                               <input type="checkbox" id="project5" name="project[]" value="영상처리프로그래밍">
                               <label for="project5">영상처리프로그래밍</label>
                          </div>
                          <div class="4u$ 12u$(small)">
                               <input type="checkbox" id="project6" name="project[]" value="임베디드시스템 설계">
                               <label for="project6">임베디드시스템 설계</label>
                          </div>
                          <div class="4u 12u$(small)">
                              <input type="checkbox" id="project7" name="project[]" value="데이터베이스 및 보안">
                              <label for="project7">데이터베이스 및 보안</label>
                          </div>
                          <div class="4u 12u$(small)">
                               <input type="checkbox" id="project8" name="project[]" value="소프트웨어 종합 설계">
                               <label for="project8">소프트웨어 종합 설계</label>
                          </div>
                          <div class="4u$ 12u$(small)">
                               <input type="checkbox" id="project9" name="project[]" value="컴퓨터 구조 설계">
                               <label for="project9">컴퓨터 구조 설계</label>
                          </div>
                          <div class="4u$ 12u$(small)">
                              <input type="checkbox" id="project10" name="project[]" value="없음">
                              <label for="project10">없음</label>
                          </div>
                        </div>

                     <hr class="major" />

                     <h3>03. 소속된 개발 팀을 선택해주세요. </h3>
                       <div class="row uniform">
                        <div class="4u 12u$(small)">
                           <input type="checkbox" id="aff1" name="aff[]" value="스마클">
                           <label for="aff1">스마클</label>
                        </div>
                        <div class="4u 12u$(small)">
                          <input type="checkbox" id="aff2" name="aff[]" value="바이너리">
                          <label for="aff2">바이너리</label>
                        </div>
                        <div class="4u$ 12u$(small)">
                          <input type="checkbox" id="aff3" name="aff[]" value="인터페이스">
                          <label for="aff3">인터페이스</label>
                        </div>
                        <div class="4u 12u$(small)">
                          <input type="checkbox" id="aff4" name="aff[]" value="연구실">
                          <label for="aff4">연구실</label>
                        </div>
                        <div class="4u 12u$(small)">
                          <input type="checkbox" id="aff5" name="aff[]" value="기타">
                          <label for="aff5">기타</label>
                         </div>
                         <div class="4u$ 12u$(small)">
                           <input type="checkbox" id="aff6" name="aff[]" value="없음">
                           <label for="aff6">없음</label>
                         </div>
                        </div>

                     <hr class="major" />
                     <h3>04. SW관련대회의 수상경력이 있나요?</h3>
                       <div class="row uniform">
                          <div class="4u 12u$(small)">
                             <input type="radio" id="exp1" name="exp[]" value="네">
                             <label for="exp1">네</label>
                             <input type="radio" id="exp2" name="exp[]" value="아니요">
                              <label for="exp2">아니요</label>
                          </div>

                        </div>

                        <!-- Break -->
                        <br><br>
                        <div class="12u$">
                           <ul class="actions">
                              <input type="submit" name="survey" value="완료" />
                           </ul>
                        </div>
                    </form>
                  </div>
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
   </body>
</html>
