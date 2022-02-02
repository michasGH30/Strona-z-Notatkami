<!DOCTYPE HTML>
<?php
session_start();
if(!isset($_SESSION['logged']) || $_SESSION['logged']==false)
{
	header('Location: to_login.php');
	exit();
}
?>
<html lang="pl">
	<head>
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset="utf-8">
		<META HTTP-EQUIV="Pragma" content="cache">
		<META NAME="ROBOTS" CONTENT="all">
		<META HTTP-EQUIV="Content-Language" CONTENT="pl">
		<META NAME="description" CONTENT="To moja strona na notaki i ogólnie testowanie">
		<META NAME="keywords" CONTENT="notatki,studia,testowanie,programowanie">
		<META NAME="author" CONTENT="Michał Żuk">
		<META HTTP-EQUIV="Reply-to" CONTENT="michal.zuk30601@gmail.com">
		<META NAME="revisit-after" CONTENT="2 days">
		<link rel="stylesheet" href="style.css">
		<TITLE>Notatki</TITLE>
	</head>
	<body>
		<header>
			<div class="logo">
				<a href="index.php" class="logo">Michał Żuk - Notatki</a>
			</div>
		</header>
		<nav id="left">
			<div class="link">
				<button class="login">
					<a <?php if(isset($_SESSION['logged']) && $_SESSION['logged']==true) echo 'href="administrator.php"'; else echo 'href="to_login.php"';?> class="nav">
						<?php if(isset($_SESSION['logged']) && $_SESSION['logged']==true) echo "Panel administratora"; else echo "Zaloguj się";?>
					</a>
				</button>
			</div>
			<div class="link">
				<a href="all.php" class="nav">Wszystkie notatki</a>
			</div>
			<div class="link">
				<a href="shop.php" class="nav">Lista zakupów</a>
			</div>
			<div class="link">
				<a href="about.php" class="nav">O mnie i o stronie</a>
			</div>
		</nav>
		<main id="main">
			<header id="latest">
				Panel Administratora
			</header>
			<article>
				<button class="logout">
					<a href="logout.php" class="logout">Wyloguj</a>
				</button><br><br>
				<button class="login">
					<a href="new.php" class="nav">Nowa notatka</a>
				</button><br><br>
			</article>
		</main>
		<aside id="right">
			<?php
				echo "Data: ".date("d-m-Y")."<br>";
			?>
			<div id="clock"></div>
			<script>
				function digitalClock() {
				  var d = new Date();
				  var hrs = d.getHours();
				  var mins = d.getMinutes();       
				  var secs = d.getSeconds();   
				  var ctime = hrs + ":";
				  if(mins <10)
					  ctime+="0"+mins;
				  else
					  ctime+=mins;
				  if(secs<10)
					  ctime+=":0"+secs;
				  else
					  ctime+=":"+secs;
				  document.getElementById("clock").innerHTML="Godzina: "+ctime;
				}
				window.onload = function() {
				  digitalClock();
				  setInterval('digitalClock()', 1000);
				}
			</script>
		</aside>
		<footer id="footer">
			&copy; Michał Żuk 
			<?php 
				echo date("Y");
			?>
			Ta strona nie ma celu zarabiania. Ma cel tylko i wyłącznie edukacyjny.
		</footer>
	</body>
</html>