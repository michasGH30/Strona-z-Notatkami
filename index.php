<!DOCTYPE HTML>
<?php
session_start();
require_once "connect.php";
mysqli_report(MYSQLI_REPORT_STRICT);
try
{
	$connection = new mysqli($host,$db_user,$db_password,$db_name);

	if($connection->connect_errno!=0)
	{
		throw new Exception(mysqli_connect_errno());
	}
}
	catch(Exception $e)
	{
		echo "<span style='color:red'>Błąd w działaniu serwera spróbuj w innym terminie.</span>";
		echo "DEVELOP ".$e;
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
				Najnowsze notatki
			</header>
			<article>
				<div id="entries">
					<?php 
						$entries=$connection->query(sprintf("SELECT ID,Subject,Date_Add FROM blog ORDER BY Date_Add DESC LIMIT 3"));
						if(!$entries) throw new Exception($connection->error);
						while($entry = $entries->fetch_assoc())
						{
							$ID = $entry['ID'];
							$mydate=$entry['Date_Add'];
							$date=date('d-m-Y',strtotime($mydate)); 
							echo "<a href='entry.php?ID=$ID' class='entry_link'> <b>Tytuł:</b> <i>".$entry['Subject']."</i> <b>Data Dodania:</b> <i>".$date."</i></a><br>";
						}
						$entries->free();
						$connection->close();
					?>
				</div>
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