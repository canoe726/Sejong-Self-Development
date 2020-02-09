<?php session_start(); ?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>로그인</title>
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
					<li><a href="mypage.php">나의 트랙 레벨</a></li>
					<li><a href="my_track_level.php">추천 트랙</a></li>
					<li><a href="my_track_level.php">세종인 공유 게시판</a></li>
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

		<!-- One -->
    </br>
    <h1>로그인</h1>

    <?php if(!isset($_SESSION['StudentID'])) { ?>

    <form method="POST" action="signup_check.php">
        <p>학번을 입력하세요.</p>
        <input style="width:800px;" type="text" name="StudentID" placeholder="학번을 입력하세요. 8자리 ex)12345678">
        </br>

        <p>비밀번호를 입력하세요.</p>
        <input style="width:800px;" type="password" name="Password" placeholder="비밀번호를 입력하세요.">
        </br>
        <section style="text-align:center;">
          <input type="submit" name="login" value="로그인">
          <input type="submit" name="signup" value="회원가입">
        </section>
    </form>

    <?php } else {
        $user_id = $_SESSION['StudentID'];
        echo "<p><strong>($user_id)</strong>님은 이미 로그인하고 있습니다. ";
        echo "<a href=\"index.php\">[돌아가기]</a> ";
        echo "<a href=\"logout.php\">[로그아웃]</a></p>";
    } ?>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>
