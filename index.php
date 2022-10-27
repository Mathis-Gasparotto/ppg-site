<?php require "utils/connectToDB.php";
$stmt = $pdo->query("SELECT * FROM serv_status");
$servStatus = $stmt->fetchAll(); 
date_default_timezone_set('Europe/Paris');
?>

<!DOCTYPE html>
<html lang="fr">
	
	<head>
		<meta charset="UTF-8">
		<?php 
			$now = new DateTime("now");
			if ($servStatus[0]['end_time']) {
				$end_time = new DateTime($servStatus[0]['end_time']);
				if ($now->format('Y-m-d H:i:s') < $end_time->format('Y-m-d H:i:s')) {
					$endTimeList[] = $end_time;
				}
				if ($servStatus[0]['status'] == 1) {
					require "utils/diffDateTime.php";
					if ($now->format('Y-m-d H:i:s') < $endTimeToClose->format('Y-m-d H:i:s')) {
						$endTimeList[] = $endTimeToClose;
					}
				}
			}
			if ($servStatus[1]['end_time']) {
				$end_time = new DateTime($servStatus[1]['end_time']);
				if ($now->format('Y-m-d H:i:s') < $end_time->format('Y-m-d H:i:s')) {
					$endTimeList[] = $end_time;
				}
				if ($servStatus[1]['status'] == 1) {
					require "utils/diffDateTime.php";
					if ($now->format('Y-m-d H:i:s') < $endTimeToClose->format('Y-m-d H:i:s')) {
						$endTimeList[] = $endTimeToClose;
					}
				}
			}
			if ($servStatus[2]['end_time']) {
				$end_time = new DateTime($servStatus[2]['end_time']);
				if ($now->format('Y-m-d H:i:s') < $end_time->format('Y-m-d H:i:s')) {
					$endTimeList[] = $end_time;
				}
				if ($servStatus[2]['status'] == 1) {
					require "utils/diffDateTime.php";
					if ($now->format('Y-m-d H:i:s') < $endTimeToClose->format('Y-m-d H:i:s')) {
						$endTimeList[] = $endTimeToClose;
					}
				}
			}
			if ($servStatus[3]['end_time']) {
				$end_time = new DateTime($servStatus[3]['end_time']);
				if ($now->format('Y-m-d H:i:s') < $end_time->format('Y-m-d H:i:s')) {
					$endTimeList[] = $end_time;
				}
				if ($servStatus[3]['status'] == 1) {
					require "utils/diffDateTime.php";
					if ($now->format('Y-m-d H:i:s') < $endTimeToClose->format('Y-m-d H:i:s')) {
						$endTimeList[] = $endTimeToClose;
					}
				}
			}
			
			if ($endTimeList) {
				$count = count($endTimeList);
				if ($count > 1) {
					for ($i = 0; $i < ($count - 1); $i++) {
						$iNext = $i + 1;
						$firstDateTime = $endTimeList[$i];
						$secondDateTime = $endTimeList[$iNext];
						if ($firstDateTime->format('Y-m-d H:i:s') < $secondDateTime->format('Y-m-d H:i:s')) {
							$endTimeList[$iNext] = $firstDateTime;
						} else {
							$endTimeList[$iNext] = $secondDateTime;
						}
						$earliestDateTime = $endTimeList[$iNext];
					}
				} else {
					$earliestDateTime = $endTimeList[0];
				}
				$diff = $now->diff($earliestDateTime);
				$delay = ($diff->s) + ($diff->i * 60) + ($diff->h * 60 * 60) + ($diff->d * 60 * 60 * 24)	+ ($diff->m * 60 * 60 * 24 * 30) + ($diff->y * 60 * 60 * 24 * 365);
				?> 
				<meta http-equiv="refresh" content="<?php echo $delay; ?>" id="meta-refresh">
			<?php }
		?>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Piou Piou Gang</title>
	<link rel='icon' href='favicon.png' type='image/x-icon' />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="data/css/style.css">
	<script src="data/script/script.js"></script>
</head>

<body>
	<div id="bg"></div>

	<!-- <h1 style="color:#fff;">SITE EN MAINTENANCE</h1> -->

	<?php if ($servStatus[0]['status'] == 0) { ?>
		<form action="startVh.php" method="post" id="vh">
			<button type="submit" name="submit" value="onVh" class="btn btn-warning">Démarrer Valheim
				<!--<img src="data/img/favicon.png" alt="ppg" height="30">-->
			</button>
		</form>
	<?php } elseif ($servStatus[0]['status'] == 1) { ?>
		<form id="vh">
			<button type="button" class="btn btn-success btn-no-click-success">Démarrage de Valheim...</button>
		</form>
	<?php } elseif ($servStatus[0]['status'] == 2) { ?>
		<form action="stopVh.php" method="post" id="vh">
			<button type="submit" name="submit" value="offVh" class="btn btn-danger">Arrêter Valheim</button>
		</form>
	<?php } elseif ($servStatus[0]['status'] == 3) { ?>
		<form id="vh">
			<button type="button" class="btn btn-danger btn-no-click-danger">Arrêt de Valheim...</button>
		</form>
	<?php }

	if ($servStatus[1]['status'] == 0) { ?>
		<form action="startMc.php" method="post" id="mc">
			<button type="submit" name="submit" value="onMc" class="btn btn-warning">Démarrer Minecraft</button>
		</form>
	<?php } elseif ($servStatus[1]['status'] == 1) { ?>
		<form id="mc">
			<button type="button" class="btn btn-success btn-no-click-success">Démarrage de Minecraft...</button>
		</form>
	<?php } elseif ($servStatus[1]['status'] == 2) { ?>
		<form action="stopMc.php" method="post" id="mc">
			<button type="submit" name="submit" value="offMc" class="btn btn-danger">Arrêter Minecraft</button>
		</form>
	<?php } elseif ($servStatus[1]['status'] == 3) { ?>
		<form id="mc">
			<button type="button" class="btn btn-danger btn-no-click-danger">Arrêt de Minecraft...</button>
		</form>
	<?php }

	if ($servStatus[2]['status'] == 0) { ?>
		<form action="startArma.php" method="post" id="arma">
			<button type="submit" name="submit" value="onArma" class="btn btn-warning">Démarrer Arma</button>
		</form>
	<?php } elseif ($servStatus[2]['status'] == 1) { ?>
		<form id="arma">
			<button type="button" class="btn btn-success btn-no-click-success">Démarrage d'Arma...</button>
		</form>
	<?php } elseif ($servStatus[2]['status'] == 2) { ?>
		<form action="stopArma.php" method="post" id="arma">
			<button type="submit" name="submit" value="offArma" class="btn btn-danger">Arrêter Arma</button>
		</form>
	<?php } elseif ($servStatus[2]['status'] == 3) { ?>
		<form id="arma">
			<button type="button" class="btn btn-danger btn-no-click-danger">Arrêt d'Arma...</button>
		</form>
	<?php }

	if ($servStatus[3]['status'] == 0) { ?>
		<form action="startSeven.php" method="post" id="seven">
			<button type="submit" name="submit" value="onSeven" class="btn btn-warning">Démarrer 7 Days to Die</button>
		</form>
	<?php } elseif ($servStatus[3]['status'] == 1) { ?>
		<form id="seven">
			<button type="button" class="btn btn-success btn-no-click-success">Démarrage de 7 Days to Die...</button>
		</form>
	<?php } elseif ($servStatus[3]['status'] == 2) { ?>
		<form action="stopSeven.php" method="post" id="seven">
			<button type="submit" name="submit" value="offSeven" class="btn btn-danger">Arrêter 7 Days to Die</button>
		</form>
	<?php } elseif ($servStatus[3]['status'] == 3) { ?>
		<form id="seven">
			<button type="button" class="btn btn-danger btn-no-click-danger">Arrêt de 7 Days to Die...</button>
		</form>
	<?php } ?>




	<div id="alerts-spacer"><div onload="setTimer('2022-06-16 22:32:57', this)"></div></div>




	<?php if ($servStatus[0]['end_time'] && $servStatus[0]['status'] == 1) {
		$end_time = new DateTime($servStatus[0]['end_time']);
		require "utils/diffDateTime.php";
		if ($now->format('Y-m-d H:i:s') < $end_time->format('Y-m-d H:i:s')) { ?>
			<div class="alert alert-primary" id="alert-starting-vh">Le serveur Valheim sera prêt à <?php echo $end_time->format('H:i:s'); ?> (dans <span id="timer-starting-vh"></span>)</div>
			<script>setTimer('<?php echo $end_time->format('Y-m-d H:i:s'); ?>', document.getElementById('timer-starting-vh'));</script>
		<?php } elseif ($now->format('Y-m-d H:i:s') < $endTimeToClose->format('Y-m-d H:i:s')) { ?>
			<div class="alert alert-primary" id="alert-start-vh">Attendez <span id="timer-start-vh"></span> pour pouvoir refermer le serveur Valheim</div>
			<script>setTimer('<?php echo $endTimeToClose->format('Y-m-d H:i:s'); ?>', document.getElementById('timer-start-vh'));</script>
		<?php }
	}
	if ($servStatus[0]['end_time'] && $servStatus[0]['status'] == 3) {
		$end_time = new DateTime($servStatus[0]['end_time']);
		require "utils/diffDateTime.php"; ?>
		<div class="alert alert-danger" id="alert-stoping-vh">Le serveur Valheim sera réouvrable à <?php echo $end_time->format('H:i:s');
			if ($now->format('Y-m-d H:i:s') < $end_time->format('Y-m-d H:i:s')) { ?> 
				(dans <span id="timer-stoping-vh"></span>)
				<script>
					setTimer('<?php echo $end_time->format('Y-m-d H:i:s'); ?>', document.getElementById('timer-stoping-vh'));
					</script>
			<?php } ?>
		</div>
	<?php	}



	if ($servStatus[1]['end_time'] && $servStatus[1]['status'] == 1) {
		$end_time = new DateTime($servStatus[1]['end_time']);
		require "utils/diffDateTime.php";
		if ($now->format('Y-m-d H:i:s') < $end_time->format('Y-m-d H:i:s')) { ?>
			<div class="alert alert-primary" id="alert-starting-mc">Le serveur Minecraft sera prêt à <?php echo $end_time->format('H:i:s'); ?> (dans <span id="timer-starting-mc"></span>)</div>
			<script>
				setTimer('<?php echo $end_time->format('Y-m-d H:i:s'); ?>', document.getElementById('timer-starting-mc'));
			</script>
		<?php } elseif ($now->format('Y-m-d H:i:s') < $endTimeToClose->format('Y-m-d H:i:s')) { ?>
			<div class="alert alert-primary" id="alert-start-mc">Attendez <span id="timer-start-mc"></span> pour pouvoir refermer le serveur Minecraft</div>
			<script>setTimer('<?php echo $endTimeToClose->format('Y-m-d H:i:s'); ?>', document.getElementById('timer-start-mc'));</script>
		<?php }
	}
	if ($servStatus[1]['end_time'] && $servStatus[1]['status'] == 3) {
		$end_time = new DateTime($servStatus[1]['end_time']);
		require "utils/diffDateTime.php"; ?>
		<div class="alert alert-danger" id="alert-stoping-mc">Le serveur Minecraft sera réouvrable à <?php echo $end_time->format('H:i:s');
			if ($now->format('Y-m-d H:i:s') < $end_time->format('Y-m-d H:i:s')) { ?> 
				(dans <span id="timer-stoping-mc"></span>)
				<script>
					setTimer('<?php echo $end_time->format('Y-m-d H:i:s'); ?>', document.getElementById('timer-stoping-mc'));
				</script>
			<?php } ?>
		</div>
	<?php }



	if ($servStatus[2]['end_time'] && $servStatus[2]['status'] == 1) {
		$end_time = new DateTime($servStatus[2]['end_time']);
		require "utils/diffDateTime.php";
		if ($now->format('Y-m-d H:i:s') < $end_time->format('Y-m-d H:i:s')) { ?>
			<div class="alert alert-primary" id="alert-starting-arma">Le serveur Arma sera prêt à <?php echo $end_time->format('H:i:s'); ?> (dans <span id="timer-starting-arma"></span>)</div>
			<script>setTimer('<?php echo $end_time->format('Y-m-d H:i:s'); ?>', document.getElementById('timer-starting-arma'));</script>
		<?php } elseif ($now->format('Y-m-d H:i:s') < $endTimeToClose->format('Y-m-d H:i:s')) { ?>
			<div class="alert alert-primary" id="alert-start-arma">Attendez <span id="timer-start-arma"></span> pour pouvoir refermer le serveur Arma</div>
			<script>setTimer('<?php echo $endTimeToClose->format('Y-m-d H:i:s'); ?>', document.getElementById('timer-start-arma'));</script>
		<?php }
	}
	if ($servStatus[2]['end_time'] && $servStatus[2]['status'] == 3) {
		$end_time = new DateTime($servStatus[2]['end_time']);
		require "utils/diffDateTime.php"; ?>
		<div class="alert alert-danger" id="alert-stoping-arma">Le serveur Arma sera réouvrable à <?php echo $end_time->format('H:i:s');
			if ($now->format('Y-m-d H:i:s') < $end_time->format('Y-m-d H:i:s')) { ?> 
				(dans <span id="timer-stoping-arma"></span>)
				<script>
					setTimer('<?php echo $end_time->format('Y-m-d H:i:s'); ?>', document.getElementById('timer-stoping-arma'));
				</script>
			<?php } ?>
		</div>
	<?php }



	if ($servStatus[3]['end_time'] && $servStatus[3]['status'] == 1) {
		$end_time = new DateTime($servStatus[3]['end_time']);
		require "utils/diffDateTime.php";
		if ($now->format('Y-m-d H:i:s') < $end_time->format('Y-m-d H:i:s')) { ?>
			<div class="alert alert-primary" id="alert-starting-seven">Le serveur 7 Days to Die sera prêt à <?php echo $end_time->format('H:i:s'); ?> (dans <span id="timer-starting-seven"></span>)</div>
			<script>setTimer('<?php echo $end_time->format('Y-m-d H:i:s'); ?>', document.getElementById('timer-starting-seven'));</script>
		<?php } elseif ($now->format('Y-m-d H:i:s') < $endTimeToClose->format('Y-m-d H:i:s')) { ?>
			<div class="alert alert-primary" id="alert-start-seven">Attendez <span id="timer-start-seven"></span> pour pouvoir refermer le serveur 7 Days to Die</div>
			<script>setTimer('<?php echo $endTimeToClose->format('Y-m-d H:i:s'); ?>', document.getElementById('timer-start-seven'));</script>
		<?php }
	}
	if ($servStatus[3]['end_time'] && $servStatus[3]['status'] == 3) {
		$end_time = new DateTime($servStatus[3]['end_time']);
		require "utils/diffDateTime.php"; ?>
		<div class="alert alert-danger" id="alert-stoping-seven">Le serveur 7 Days to Die sera réouvrable à <?php echo $end_time->format('H:i:s');
			if ($now->format('Y-m-d H:i:s') < $end_time->format('Y-m-d H:i:s')) { ?> 
				(dans <span id="timer-stoping-seven"></span>)
				<script>
					setTimer('<?php echo $end_time->format('Y-m-d H:i:s'); ?>', document.getElementById('timer-stoping-seven'));
				</script>
			<?php } ?>
		</div>
	<?php } ?>

</body>

</html>
