<?php require_once "utils/connectToDB.php";
$stmt = $pdo->query("SELECT * FROM serv_status WHERE status = 0 AND name = 'mc'");
if ($_POST['submit'] && $stmt->fetch()) {
	$dateTime = new DateTime();
	$dateTime->setTimezone(new DateTimeZone('Europe/Paris'))
		->add(new DateInterval('PT2M8S'));
	$end_time = $dateTime->format('Y-m-d H:i:s');
	$stmt = $pdo->prepare("UPDATE serv_status SET status = 1, end_time = ? WHERE name = 'mc'");
	$stmt->execute(array($end_time));
	shell_exec('sudo -S /root/startmc.sh');
	$stmt = $pdo->query("UPDATE serv_status SET status = 2, end_time = NULL WHERE name = 'mc'");
	header('Location: index.php?success=true');
} else {
	header('Location: index.php?success=false');
}
