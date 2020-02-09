<?php
  session_start();

  require "db_require.php";
  $db = mysqli_connect($db_host,$db_user,$db_passwd,$db_name);

  if( !$db ) {
   die( 'MYSQL connect ERROR: ' . mysqli_error($db));
  }

  $user_id = $_SESSION['StudentID'];
  $hashed_id = hash('sha512', $user_id);
  $sql = "SELECT * FROM hackerton_subject_info WHERE StudentID='$hashed_id'";
  $resource = mysqli_query( $db, $sql );
  $row = mysqli_fetch_assoc($resource);

  $data_sub = $row['TakenCourse'];

  $sql = "SELECT * FROM hackerton_survey_info WHERE StudentID='$hashed_id'";
  $resource = mysqli_query( $db, $sql );
  $row = mysqli_fetch_assoc($resource);

  $data_tra = $row['track'];
  $data_pro = $row['project'];
  $data_aff = $row['aff'];
  $data_pri = $row['exps'];

  $sql = "SELECT * FROM hackerton_login_info WHERE StudentID='$hashed_id'";
  $resource = mysqli_query( $db, $sql );
  $row = mysqli_fetch_assoc($resource);
  $user_name = $row['StudentName'];
?>
<!DOCTYPE HTML>
<html>
  <head>
     <title>추천 트랙</title>
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

     <!-- Main -->
     <section id="main" class="wrapper">
        <div class="inner">
          <header class="align-center">
            <h1 style = "display : inline"><?php echo $user_name;?></h1>
            <h2 id = "username" style = "display : inline">님의 추천트랙은 : "</h2>
            <br>
            <br>
          </header>
          <br>
           <!-- Preformatted Code -->
           <h2 style = "text-align: center;">수강 해야하는 과목</h2>
           <pre>
              <code style="font-size: 15px; color: black"><div id = "subsubject1" class = "pil">수강해야하는</div><br><div id = "subsubject" class = "npil">과목</div></code>
           </pre>

           <h2 style = "text-align: center;">트랙과목 중 수강한 과목</h2>
           <pre>
             <code style="font-size: 15px; color: black"><div id = "subjected1" class = "pil">수강한</div><br><div id = "subjected" class = "npil">과목</div></code>
           </pre>

           <h2 style = "text-align: center;">미수강 과목 중 추천 과목</h2>
           <pre>
             <code style="font-size: 15px; color: black"><div id = "unsubject1" class = "pil">추천하는</div><br><div id = "unsubject" class = "npil">과목</div></code>
           </pre>
        </div>
     </section>

     <!-- Footer -->
     <footer id="footer">
        <div class="inner">
           <h2>Get In Touch</h2>
           <ul class="actions">
              <li><span class="icon fa-phone"></span> <a href="#">(000) 000-0000</a></li>
              <li><span class="icon fa-envelope"></span> <a href="#">information@untitled.tld</a></li>
              <li><span class="icon fa-map-marker"></span> 123 Somewhere Road, Nashville, TN 00000</li>
           </ul>
        </div>
        <div class="copyright">
           &copy; Untitled. Design <a href="https://templated.co">TEMPLATED</a>. Images <a
              href="https://unsplash.com">Unsplash</a>.
        </div>
     </footer>

     <!-- Scripts -->
     <script src="assets/js/jquery.min.js"></script>
     <script src="assets/js/jquery.scrolly.min.js"></script>
     <script src="assets/js/skel.min.js"></script>
     <script src="assets/js/util.js"></script>
     <script src="assets/js/main.js"></script>
     <script>
           var data_tra = '<?=$data_tra?>';
           var data_pro = '<?=$data_pro?>';
           var data_aff = '<?=$data_aff?>';
           var data_pri = '<?=$data_pri?>';
           var data_sub = '<?=$data_sub?>';

           data_tra = data_tra.split(',');
           data_pro = data_pro.split(',');
           data_aff = data_aff.split(',');
           data_pri = data_pri.split(',');
           data_sub = data_sub.split(',');

           var tracknum = 0;
           var subjectnum = 0;
           var track = ['HCI & 비쥬얼컴퓨팅','멀티미디어','사물인터넷','시스템응용','인공지능','가상현실','정보보호','데이터사이언스','SW교육','사이버국방'];
           var project = ['창의SW기초설계','오픈소스SW설계','AI프로그램설계','악성코드분석','영상처리프로그래밍','임베디드시스템','데이터베이스 및 보안','소프트웨어 종합 설계','컴퓨터 구조 설계'];

           var subject = [
              ['선형대수 및 프로그래밍', '컴퓨터 그래픽스', '웹 프로그래밍', '영상처리', 'HCI개론', 'XMI 프로그래밍', '정보검색', '가상현실', '멀티미디어 프로그래밍', '고급실시간그래픽스', '오픈소스SW개론'],
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

           var aff=['스마클', '바이너리', '인터페이스', '연구실', '기타'];
           var recommend = [0,0,0,0,0,0,0,0,0,0];
           function show_recommend(){

              //관심트랙 가중치
              for(var k = 0; k<track.length; k++){
                 for(var t = 0; t< data_tra.length; t++){
                    if(track[k]==data_tra[t]) {
                      recommend[k] +=6;
                    }
                 }
              }

              //참여 프로젝트 가중치
              for(var k = 0; k<project.length; k++){
                 for(var t = 0; t< data_pro.length; t++){
                    if(project[k]==data_pro[t]){
                       switch(k){
                          case 0:
                               recommend[2]+=1;
                               recommend[8]+=2;
                               break;
                          case 1:
                               recommend[4]+=3;
                               recommend[5]+=2;
                               recommend[7]+=1;
                               recommend[8]+=4;
                               break;
                          case 2:
                               recommend[2]+=2;
                               recommend[4]+=3;
                               recommend[7]+=1;
                               break;
                          case 3:
                               recommend[6]+=1;
                               recommend[9]+=2;
                               break;
                          case 4:
                               recommend[0]+=4;
                               recommend[1]+=1;
                               recommend[4]+=2;
                               recommend[5]+=3;
                               break;
                          case 5:
                               recommend[2]+=2;
                               recommend[3]+=1;
                               break;
                          case 6:
                               recommend[6]+=3;
                               recommend[7]+=2;
                               recommend[9]+=1;
                               break;
                          case 7:
                               recommend[2]+=2;
                               recommend[3]+=1;
                               recommend[4]+=3;
                               recommend[8]+=4;
                               break;
                          case 8:
                               recommend[0]+=2;
                               recommend[3]+=1;
                               break;
                       }
                    }
                 }
              }

              //소속팀 가중치
              for(var k = 0; k<aff.length; k++){
                 for(var t = 0; t< data_aff.length; t++){
                    if(aff[k]==data_aff[t]){
                       switch(k){
                          case 0:
                               recommend[2]+=2;
                               recommend[4]+=3;
                               recommend[7]+=1;
                               break;
                          case 1:
                               recommend[2]+=1;
                               recommend[6]+=2;
                               recommend[8]+=3;
                               break;
                          case 2:
                               recommend[1]+=3;
                               recommend[8]+=2;
                               recommend[9]+=1;
                               break;
                          case 3:
                               recommend[0]+=2;
                               recommend[3]+=1;
                               recommend[5]+=3;
                               break;
                       }
                    }
                 }
              }

              //수상경력 가중치
              if(data_pri=='있음'){
                 recommend[8]+=1;
                 recommend[4]+=1;
                 recommend[6]+=1;
              }


              //수강 과목 가중치
              for(var k = 0; k<subject.length;k++){
                 for(var t = 0; t<subject[k].length; t++){
                    for(var z = 0; z<data_sub.length;z++){
                       if(subject[k][t]==data_sub[z]){
                          if(t<4){
                             recommend[k]+=2;
                          }
                          else{
                             recommend[k]+=1;
                          }
                       }
                    }
                 }
              }


              var max = 0;
              for(var k = 0; k<recommend.length; k++){
                 if(max<recommend[k]){
                    max = recommend[k];
                    tracknum = k;
                 }
              }

              //추천
              document.getElementById("username").innerHTML += track[tracknum] + "\"";

              //수강해야하는 강의
              document.getElementById("subsubject1").innerHTML = '';
              document.getElementById("subsubject").innerHTML = '';
              for(var k = 0; k<subject[tracknum].length; k++){
                 if(k<4){
                    document.getElementById("subsubject1").innerHTML += subject[tracknum][k] +' ';
                 }
                 else{
                    document.getElementById("subsubject").innerHTML += subject[tracknum][k] +' ';
                 }

              }
              //수강한강의
              document.getElementById("subjected1").innerHTML = '';
              document.getElementById("subjected").innerHTML = '';
              //수강해야하는 강의
              document.getElementById("unsubject1").innerHTML = '';
              document.getElementById("unsubject").innerHTML = '';

              for(var k = 0; k<subject[tracknum].length;k++){
                 var tmp = 0;
                 for(var t = 0; t<data_sub.length;t++){
                    if(subject[tracknum][k]==data_sub[t]){
                       tmp++;
                       if(k<4){
                          document.getElementById("subjected1").innerHTML += data_sub[t] +' ';
                       }
                       else{
                          document.getElementById("subjected").innerHTML += data_sub[t] +' ';
                       }

                    }
                 }
                 if(tmp==0){
                    if(k<4){
                       document.getElementById("unsubject1").innerHTML += subject[tracknum][k]+' ';
                    }
                    else{
                       document.getElementById("unsubject").innerHTML += subject[tracknum][k]+' ';
                    }

                 }
              }
           }
        show_recommend();
     </script>
  </body>
</html>
