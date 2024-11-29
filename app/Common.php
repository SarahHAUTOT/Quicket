<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the framework's
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @see: https://codeigniter.com/user_guide/extending/common.html
 */

/**
 * @param int $var
 * @param int $min
 * @param int $max
 * @return bool
 */
function est_dans_intervalle(int $var, int $min, int $max): bool {
	return $var >= $min && $var <= $max;
}

function temp_restant(int $secondes): array|false {
	if ($secondes < 0)
		return false;
	$tmp = $secondes / 86400;
	$jours = intval(substr("$tmp", 0, strpos("$tmp", ".")));
	$tmp = ($tmp - $jours) * 24;
	$heures = intval(substr("$tmp", 0, strpos("$tmp", ".")));
	$tmp = ($tmp - $heures) * 60;
	$minutes = intval(substr("$tmp", 0, strpos("$tmp", ".")));
	$tmp = ($tmp - $minutes) * 60;
	$secondes = intval(substr("$tmp", 0, strpos("$tmp", ".")));
	return [
		'jours'=>[
			'total'=>$jours,
			'affichage'=>"jour".($jours > 1 ? "s" : ""),
		],
		'heures'=>[
			'total'=>$heures,
			'affichage'=>"heure".($heures > 1 ? "s" : ""),
		],
		'minutes'=>[
			'total'=>$minutes,
			'affichage'=>"minute".($minutes > 1 ? "s" : ""),
		],
		'secondes'=>[
			'total'=>$secondes,
			'affichage'=>"seconde".($secondes > 1 ? "s" : ""),
		],
	];
}

function affichage_temp_restant_mail(int $secondes): string {
	$restes = temp_restant($secondes);
	if (!$restes)
		return "";
	$arr = [];
	if ($restes['heures']['total'] !== 0)
		$arr[] = "{$restes['heures']['total']} {$restes['heures']['affichage']}";
	if ($restes['minutes']['total'] !== 0)
		$arr[] = "{$restes['minutes']['total']} {$restes['minutes']['affichage']}";
	if ($restes['secondes']['total'] !== 0)
		$arr[] = "{$restes['secondes']['total']} {$restes['secondes']['affichage']}";
	return str_lreplace(", ", " et ", join(", ", $arr));
}

function str_lreplace($search, $replace, $subject) {
	$pos = strrpos($subject, $search);
	if($pos !== false)
		$subject = substr_replace($subject, $replace, $pos, strlen($search));
	return $subject;
}
