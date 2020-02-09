<?php session_start(); ?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>회원가입</title>
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
		</header>

    </br>
    <h1>회원가입</h1>
    <form method="POST" action="signup_check.php">
      <p>이름을 입력해주세요.</p>
      <input style="width:800px;" type="text" name="StudentName" placeholder="이름을 입력하세요.">
      </br>

      <p>학번을 입력해주세요.</p>
      <input style="width:800px;" type="text" name="StudentID" placeholder="학번을 입력하세요. 8자리 (ex)12345678">
      </br>

      <p>비밀번호를 입력해주세요.</p>
      <input style="width:800px;" type="password" name="Password" placeholder="비밀번호를 입력하세요. 최소 8자리">
      </br>

      <p>이메일을 입력해주세요.</p>
      <input style="width:800px;" type="text" name="Email" placeholder="이메일을 입력하세요.">
      </br>

      <input type="submit" name="new_account" value="회원가입 하기">
    </form>
  </body>
</html>
