<?php

namespace App\Controllers;

use App\Models\TacheModel;
use App\Models\UtilisateurModel;
use CodeIgniter\I18n\Time;
use Exception;

/**
 * La classe <b>Cron</b> est le contrôleur qui permet au programme
 * cron job d'intéragir avec le site et la base de données.
 */
class Cron extends BaseController {
	
	/**
	 * La méthode index permet d'appeler toutes les méthodes à effectuer lors du cron job.
	 *
	 * @param  int $index Le délai d'exécution du cron job, en secondes.
	 * @return void
	 * @throws Exception Si {@link Time::now()} échoue à retourner l'heure actuelle.
	 */
	public function index(int $index): void {
		$this->tasks($index);
		$this->tokens($index);
	}
	
	/**
	 * La méthode tâche consiste à envoyer des notifications par mail pour chaque tâche dont la date d'échéance est proche.
	 *
	 * Un mail sera envoyé 24h avant la date d'échéance si la durée entre celle-ci et la date de dernière modification excède
	 * 24h. Si cette durée est inférieure à 24h, le mail sera envoyé 1h avant la fin. Un seul mail sera envoyé par tâche, sauf
	 * cas particulier.
	 *
	 * @throws Exception Si {@link Time::now()} échoue à retourner l'heure actuelle.
	 * @param  int  $delay Le délai d'exécution du cron job, en secondes.
	 * @return void
	 */
	protected function tasks(int $delay): void {
		$tskMod = new TacheModel();
		$usrMod = new UtilisateurModel();
		$tasks = $tskMod->getTasks();
		$cur_date = Time::now('Europe/Paris', 'fr_FR')->addHours(1);
		foreach ($tasks as $task) {
			$creation_date     = $task->getCreationTache();
			$modif_date        = $task->getModiffTache();
			$due_date          = $task->getEcheance();
			$diff_date         = $creation_date->difference($modif_date)->getSeconds() === 0 ? $creation_date : $modif_date;
			$remaining_seconds = $due_date->getTimestamp() - $cur_date->getTimestamp();
			
			if ($remaining_seconds < 0)
				continue;
			
			if (($due_date->getTimestamp() - $diff_date->getTimestamp() > 86400 && est_dans_intervalle($remaining_seconds, 86400, 86400 + $delay)) ||
				($due_date->getTimestamp() - $diff_date->getTimestamp() <= 86400 && est_dans_intervalle($remaining_seconds, 3600, 3600 + $delay))) {
				echo "Send mail to task #{$task->getIdTache()}", PHP_EOL;
				$user = $usrMod->getUserById($task->getIdUtilisateur());
				envoyer_mail($user->getEmail(), "Tâche arrivant bientôt à échéance !", "La tâche '{$task->getTitre()}' arrivera à échéance dans "
					.affichage_temp_restant_mail($remaining_seconds)." !",
					"", "");
			}
		}
	}
	
	public function tokens(int $delay): void {
		$usrMod = new UtilisateurModel();
		var_dump($usrMod->findAll());
//		$cur_date = Time::now('Europe/Paris', 'fr_FR')->addHours(1);
//		foreach ($tasks as $task) {
//			$creation_date     = $task->getCreationTache();
//			$modif_date        = $task->getModiffTache();
//			$due_date          = $task->getEcheance();
//			$diff_date         = $creation_date->difference($modif_date)->getSeconds() === 0 ? $creation_date : $modif_date;
//			$remaining_seconds = $due_date->getTimestamp() - $cur_date->getTimestamp();
//
//			if ($remaining_seconds < 0)
//				continue;
//
//			if (($due_date->getTimestamp() - $diff_date->getTimestamp() > 86400 && est_dans_intervalle($remaining_seconds, 86400, 86400 + $delay)) ||
//				($due_date->getTimestamp() - $diff_date->getTimestamp() <= 86400 && est_dans_intervalle($remaining_seconds, 3600, 3600 + $delay))) {
//				echo "Send mail to task #{$task->getIdTache()}", PHP_EOL;
//				$user = $usrMod->getUserById($task->getIdUtilisateur());
//				envoyer_mail($user->getEmail(), "Tâche arrivant bientôt à échéance !", "La tâche '{$task->getTitre()}' arrivera à échéance dans "
//					.affichage_temp_restant_mail($remaining_seconds)." !",
//					"", "");
//			}
//		}
	}
	
}
