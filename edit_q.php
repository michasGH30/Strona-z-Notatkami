<!DOCTYPE HTML>
<?php
	session_start();
	if(!isset($_SESSION['logged']) || $_SESSION['logged']==false)
	{
		header('Location: to_login.php');
		exit();
	}
	else 
	{
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
				$Subject = $_POST['Subject'];
				$Content = $_POST['Content'];
				$ID=$_POST['ID'];
				$date = date('Y-m-d');
				$add=$connection->query(sprintf("UPDATE blog SET Subject='$Subject', Content='$Content' WHERE ID=$ID"));
				if(!$add) throw new Exception($connection->error);
				$connection->close();
				header('Location: administrator.php');
			}
		}
		catch(Exception $e)
		{
			echo "<span style='color:red'>Błąd w działaniu serwera spróbuj w innym terminie.</span>";
			echo "DEVELOP ".$e;
		}
	}
?>
