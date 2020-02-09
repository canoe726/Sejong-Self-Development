<?php
  session_start();

  require "db_require.php";
  $db = mysqli_connect($db_host,$db_user,$db_passwd,$db_name);

  if( !$db ) {
   die( 'MYSQL connect ERROR: ' . mysqli_error($db));
  }

  $user_id = '18000001';
  $sql = "SELECT * FROM hackerton_subject_info WHERE StudentID='$user_id'";
  $resource = mysqli_query( $db, $sql );
  $row = mysqli_fetch_assoc($resource);

  echo $row['TakenCourse'];
?>
<!DOCTYPE HTML>
<html>

<head>
   <title>Elements - Intensify by TEMPLATED</title>
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
      <a href="index.html" class="logo">intensify</a>
      <nav class="right">
         <a href="#" class="button alt">Log in</a>
      </nav>
   </header>

   <!-- Menu -->
   <nav id="menu">
      <ul class="links">
         <li><a href="index.html">Home</a></li>
         <li><a href="generic.html">Generic</a></li>
         <li><a href="elements.html">Elements</a></li>
      </ul>
      <ul class="actions vertical">
         <li><a href="#" class="button fit">Login</a></li>
      </ul>
   </nav>

   <!-- Main -->
   <section id="main" class="wrapper">
      <div class="inner">
         <header class="align-center">
            <h1>~~~님께 추천드리는 트랙</h1>
         </header>

         <!-- Preformatted Code -->
         <h2 id = "recommend" style = "text-align:center; color:black; font-weight: 800">추천트랙 이름</h2>
         <pre><code id = "subsubject" style="font-size: 15px; color: black">
추천트랙의 과목 이름
                     </code>
                     </pre>

         <h2 style = "text-align: center;">트랙과목 중 수강한 과목</h2>
         <pre><code id = "subjected" style="font-size: 15px; color: black">
               수강한 과목 이름
               </code>
               </pre>

         <h2 style = "text-align: center;">미수강 과목 중 추천 과목</h2>
         <pre><code id = "unsubject" style="font-size: 15px; color: black">
               추천 과목 이름
               </code>
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
        var data = "<?= $row['TakenCourse']; ?>";
        alert(data);
        var tracknum = 0;
        var subjectnum = 0;
        var track = ['HCI & 비쥬얼컴퓨팅','멀티미디어','사물인터넷','시스템응용','인공지능','가상현실','정보보호','데이터사이언스','SW교육','사이버국방']
        var subject = [['선형대수및프로그래밍','컴퓨터그래픽스','웹프로그래밍','영상처리','HCI개론'],['멀티미디어','선형대수및프로그래밍','통계학개론','신호및시스템','디지털신호처리'],['컴퓨터네트워크','신호및시스템','확률통계및프로그래밍','통신시스템','디지털신호처리'],['디지털시스템','마이크로컴퓨터','VHDL프로그래밍','데이터베이스','소프트웨어공학'],['통계학개론','확률통계및프로그래밍','데이터베이스','영상처리','패턴인식'],['멀티미디어프로그래밍','선형대수및프로그래밍','컴퓨터그래픽스','가상현실','멀티미디어'],['어썸블리어','보안프로그래밍','컴퓨터네트워크','공개키암호론','시스템해킹과보안'],['데이터베이스','확률통계및프로그래밍','데이터분석개론','기계학습','인공지능'],['문제해결및실습','웹프로그래밍','소프트웨어공학','모바일프로그래밍','데이터베이스'],['웹해킹과보안','사이버전개론','시스템해킹과보안','사이버관제및대응','악성코드분석']]
        function show_recommend(){
            for(var k = 0; k<subject.length; k++){
                for(var t = 0; t<subject[k].length;t++){
                    //alert(subject[k][t]);
                }
            }
            document.getElementById("recommend").innerHTML = track[4];
            document.getElementById("subsubject").innerHTML = subject[4];
            document.getElementById("subjected").innerHTML = subject[4][0];
            document.getElementById("unsubject").innerHTML = data;
      }
      show_recommend();
   </script>
</body>
</html>
