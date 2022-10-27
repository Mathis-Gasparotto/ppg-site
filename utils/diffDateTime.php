<?php
$now = new DateTime("now");
//$now->setTimezone(new DateTimeZone('Europe/Paris'));
//$diff = $now->diff($end_time);
//$delay = $diff->format('%imin %ss');
$endTimeToClose = clone $end_time;
$endTimeToClose->add(new DateInterval('PT5M'));
//$diff = $now->diff($endTimeToClose);
//$delayToClose = $diff->format('%imin %ss');
