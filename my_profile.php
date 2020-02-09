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

	$sql = "SELECT * FROM hackerton_profile_info WHERE StudentID='$hashed_id'";
  $resource = mysqli_query( $db, $sql );
  $row = mysqli_fetch_assoc($resource);

  $grade = (int)(($row['grade']/4.5) * 100);
  $toeic = (int)(($row['toeic']/990) * 100);

	$prize = $row['prize'];
  $prize = count(explode(',' , $prize));
	$prize = (int)(($prize/5) * 100);

	$certification = $row['certification'];
	$certification = count(explode(',' , $certification));
	$certification = (int)(($certification/5) * 100);

	$internship = $row['internship'];
	$internship = count(explode(',' , $internship));
	$internship = (int)(($internship/5) * 100);

	$sql = "SELECT * FROM hackerton_total_score";
  $resource = mysqli_query( $db, $sql );
  $row = mysqli_fetch_assoc($resource);

	$total_grade = $row['grade'];
	$total_toeic = $row['toeic'];
	$total_prize = $row['prize'];
	$total_certification = $row['certification'];
	$total_internship = $row['internship'];
?>
<!DOCTYPE HTML>
<html>
   <head>
      <title>내 역량 검사</title>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <link rel="stylesheet" href="assets/css/main.css" />
         <link rel="stylesheet" href="assets/css/chart_style.css" />
         <script src="assets/js/chart.js"></script>
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
					  <li><a href="login.php" class="button alt">로그인</a></li>
					  <?php } else { ?>
					  <li><a href="logout.php" class="button alt">로그아웃</a></li>
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
							 <h1 id = "user_name" style = "display : inline"><?php echo $user_name;?></h1>
							 <h2  style = "display : inline">님의 트랙 이수 교과목</h2>
							 <br>
							 <br>
							 <p>등록된 모든 세종인들의 데이터와 내 경험을 비교하세요.</p>
             </header>
          </div>
       </section>

      <!-- Scripts -->
       <script src="assets/js/jquery.min.js"></script>
       <script src="assets/js/jquery.scrolly.min.js"></script>
       <script src="assets/js/skel.min.js"></script>
       <script src="assets/js/util.js"></script>
       <script src="assets/js/main.js"></script>
       <script src="https://www.riamore.net/HTML5demo/chart/LicenseKey/rMateChartH5License.js"></script>
       <script src="https://www.riamore.net/HTML5demo/chart/rMateChartH5/JS/rMateChartH5.js"></script>
       <link rel="stylesheet" href="https://www.riamore.net/HTML5demo/chart/rMateChartH5/Assets/Css/rMateChartH5.css"/>
   </body>

   <h2>객관적 역량 지수</h2>
   <div id="chart11"></div>
   <script>
			var total_grade = <?=$total_grade?>;
			var total_toeic = <?=$total_toeic?>;
			var total_prize = <?=$total_prize?>;
			var total_certification  = <?=$total_certification?>;
			var total_internship  = <?=$total_internship?>;

	 		var my_grade = <?=$grade?>;
	 	 	var my_toeic = <?=$toeic?>;
	 	 	var my_prize = <?=$prize?>;
	 	 	var my_certification  = <?=$certification?>;
	 	 	var my_internship  = <?=$internship?>;

      var options = {
         'legend':{
            names: ['학점', 'TOEIC', '자격증', '수상', '인턴'],
            hrefs: []
         },
         'dataset': {
            title: 'Web accessibility status',
						// 앞 : 전체 평균, 뒤 : 내 점수
            values: [[total_grade,total_toeic,total_prize,total_certification,total_internship],
										 [my_grade,my_toeic,my_prize,my_certification,my_internship]],
            bgColor: '#f9f9f9',
                fgColor: 'blue',
                numberof : 2
      },
         'chartDiv': 'chart11',
         'chartType': 'radar',
            'chartSize': {width:600, height:300},
           };
        Nwagon.chart(options);
      CNT = 0;
   </script>

   <h2>카테고리별 역량 지수</h2>
   <div id="chart18" style="margin-left: 100px;"></div>

   <script>
      var options = {
         'legend':{
            names: ['성적', 'TOEIC', '인턴', '자격증', '상장'],
            hrefs: []
               },
         'dataset':{
            title:'Playing time per day',
            values: [[total_grade,my_grade], [total_toeic,my_toeic], [total_prize,my_prize], [total_certification,my_certification], [total_internship,my_internship]],
            colorset: ['blue', 'red'],
            fields:['전체 평균', '나']
            },
         'chartDiv' : 'chart18',
         'chartType' : 'multi_column',
         'chartSize' : {width:700, height:300},
         'maxValue' : 100,
         'increment' : 20
      };

      Nwagon.chart(options);

    </script>
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
</html>
