<?php require_once "utils/connectToDB.php";
$stmt = $pdo->query("SELECT * FROM serv_status WHERE status = 2 AND name = 'seven'");
if ($_POST['submit'] && $stmt->fetch()) {
	$dateTime = new DateTime();
	$dateTime->setTimezone(new DateTimeZone('Europe/Paris'))
		->add(new DateInterval('PT46M38S'));
	$end_time = $dateTime->format('Y-m-d H:i:s');
	$stmt = $pdo->prepare("UPDATE serv_status SET status = 3, end_time = ? WHERE name = 'seven'");
	$stmt->execute(array($end_time));
	shell_exec('sudo -S /root/stop7dtd.sh');
	$stmt = $pdo->query("UPDATE serv_status SET status = 0, end_time = NULL WHERE name = 'seven'");
	header('Location: index.php?success=true');
} else {
	header('Location: index.php?success=false');
}
