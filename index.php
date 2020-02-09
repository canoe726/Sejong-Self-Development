<?php session_start(); ?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>세종대학교 자기개발 사이트</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
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
					<li><a href="login.php" class="button alt">로그인</a></li>
					<?php } else { ?>
					<li><a href="logout.php" class="button alt">로그아웃</a></li>
					<?php	} ?>
				</ul>
			</nav>

		<!-- One -->
			<section id="one" class="wrapper">
				<div class="inner flex flex-3">
					<div class="flex-item left">
						<div>
							<h3>트랙 제도를 통한 전공 탐색 추천</h3>
							<p>트랙 제도를 통한 전공 찾기<br /> 트랙 성취에 대비한 전공과목 추천 기능</p>
						</div>
						<div>
							<h3>트랙 레벨을 통한 자기 관리</h3>
							<p>수강 과목 수에 따른 자가 진단<br /> 레벨업을 통한 시각화</p>
						</div>
					</div>
					<div class="flex-item image fit round">
						<img src="images/sejong_logo.png" alt="" />
					</div>
					<div class="flex-item right">
						<div>
							<h3>마이 페이지</h3>
							<p>마이 페이지에서 다른 세종인들과 경험 비교<br /> 활동 추천을 통한 실력 향상</p>
						</div>
						<div>
							<h3>공유 게시판</h3>
							<p>공유 게시판을 통한 프로젝트 공유 <br /> 다른 세종인들과의 프로젝트 공유</p>
						</div>
					</div>
				</div>
			</section>

		<!-- Two -->
			<section id="two" class="wrapper style1 special">
				<div class="inner">
					<h2>Seize the day</h2>
					<figure>
					    <blockquote>
					        "트랙 제도와 과목 추천 기능을 통해 나만의 전공을 찾으세요<br /> 경험 비교와 공유 게시판을 통해 동기부여를 얻으세요."
					    </blockquote>
					    <footer>
					        <cite class="author">김영배, 김혜정, 이유리, 이진수</cite>
					        <cite class="company">Sejong Self-Development</cite>
					    </footer>
					</figure>
				</div>
			</section>

		<!-- Three -->
		<section id="three" class="wrapper">
		 <div class="inner flex flex-3">
				 <div class="flex-item box">
						 <div class="image fit">
								 <img src="images/graph.png" alt="" height = "170"/>
						 </div>
						 <div class="content">
								 <h3>마이페이지&나의트랙레벨</h3>
								 <p>자신의 역량을 작성하여 세종인들과 비교하고 이수 과목을 추가하여 트랙레벨을 올려봅시다!</p>
						 </div>
				 </div>
				 <div class="flex-item box">
						 <div class="image fit">
								 <img src="images/track.png" alt="" />
						 </div>
						 <div class="content">
								 <h3>추천 트랙</h3>
								 <p>설문을 통하여 자신의 선호와 능력에 따른 트랙을 추천받아 소프트웨어 산업에서 구체적으로 어떤 분야를 교육받을지를 도와줍니다!</p>
						 </div>
				 </div>
				 <div class="flex-item box">
						 <div class="image fit">
								 <img src="images/talk.jpg" alt="" height = "170"/>
						 </div>
						 <div class="content">
								 <h3>공유게시판</h3>
								 <p>자신의 프로젝트 오픈소스를 깃허브에 올려 링크와 함께 공유게시판에 세종인들과 공유합시다!</p>
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
