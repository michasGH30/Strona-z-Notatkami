<!DOCTYPE HTML>
<?php
session_start();
if(!isset($_SESSION['logged']) || $_SESSION['logged']==false)
{
	header('Location: to_login.php');
	exit();
}
if(!isset($_POST['list']) && $_POST['name']=="")
{
	header('Location: shop.php');
	exit();
}
require_once "connect.php";
mysqli_report(MYSQLI_REPORT_STRICT);
try
{
	$connection = new mysqli($host,$db_user,$db_password,$db_name);

	if($connection->connect_errno!=0)
	{
		throw new Exception(mysqli_connect_errno());
	}
	else
	{
		if(isset($_POST['name']) && $_POST['name']!="")
		{
			$name = $_POST['name'];
			$add=$connection->query(sprintf("INSERT INTO shop VALUES(NULL,'$name')"));
			if(!$add) throw new Exception($connection->error);
		}
		else if(isset($_POST['list']))
		{
			$list = $_POST['list'];
			foreach($list as $l)
			{
				$del=$connection->query(sprintf("DELETE FROM shop WHERE ID=$l"));
				if(!$del) throw new Exception($connection->error);
			}
		}
		$connection->close();
		header('Location: shop.php');
	}
}
	catch(Exception $e)
	{
		echo "<span style='color:red'>Błąd w działaniu serwera spróbuj w innym terminie.</span>";
		echo "DEVELOP ".$e;
	}

?>
