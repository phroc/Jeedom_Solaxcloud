<?php

/* This file is part of Jeedom.
 *
 * Jeedom is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Jeedom is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Jeedom. If not, see <http://www.gnu.org/licenses/>.
 */

/* * ***************************Includes********************************* */
require_once __DIR__  . '/../../../../core/php/core.inc.php';

class solaxcloud extends eqLogic {
    /*     * *************************Attributs****************************** */
    
  /*
   * Permet de définir les possibilités de personnalisation du widget (en cas d'utilisation de la fonction 'toHtml' par exemple)
   * Tableau multidimensionnel - exemple: array('custom' => true, 'custom::layout' => false)
	public static $_widgetPossibility = array();
   */
    
    /*     * ***********************Methode static*************************** */


    // Fonction exécutée automatiquement toutes les minutes par Jeedom
    public static function cron() {
		foreach (self::byType('solaxcloud') as $solaxcloud) {//parcours tous les équipements du plugin solaxcloud
			if ($solaxcloud->getIsEnable() == 1) {//vérifie que l'équipement est actif
				$cmd = $solaxcloud->getCmd(null, 'refresh');//retourne la commande "refresh si elle existe
				if (!is_object($cmd)) {//Si la commande n'existe pas
					continue; //continue la boucle
				}
				$cmd->execCmd(); // la commande existe on la lance
			}
		}      
      }
 
    /*
     * Fonction exécutée automatiquement toutes les 5 minutes par Jeedom
      public static function cron5() {
      }
     */

    /*
     * Fonction exécutée automatiquement toutes les 10 minutes par Jeedom
      public static function cron10() {
      }
     */
    
    /*
     * Fonction exécutée automatiquement toutes les 15 minutes par Jeedom
      public static function cron15() {
      }
     */
    
    /*
     * Fonction exécutée automatiquement toutes les 30 minutes par Jeedom
      public static function cron30() {
      }
     */
    
    /*
     * Fonction exécutée automatiquement toutes les heures par Jeedom
      public static function cronHourly() {
      }
     */

    /*
     * Fonction exécutée automatiquement tous les jours par Jeedom
      public static function cronDaily() {
      }
     */



    /*     * *********************Méthodes d'instance************************* */
    
 // Fonction exécutée automatiquement avant la création de l'équipement 
    public function preInsert() {
        
    }

 // Fonction exécutée automatiquement après la création de l'équipement 
    public function postInsert() {
        
    }

 // Fonction exécutée automatiquement avant la mise à jour de l'équipement 
    public function preUpdate() {
        
    }

 // Fonction exécutée automatiquement après la mise à jour de l'équipement 
    public function postUpdate() {
 		$cmd = $this->getCmd(null, 'refresh'); // On recherche la commande refresh de l’équipement
		if (is_object($cmd)) { //elle existe et on lance la commande
			 $cmd->execCmd();
		}       
    }

    public function preSave() {
		$this->setDisplay("width","400px");
		$this->setDisplay("height","350px");
    }
    
 // Crée une commande info si elle n'existe pas encore, puis met à jour sa définition.
 // L'historisation et la visibilité ne sont définies qu'à la création : les réglages
 // faits ensuite par l'utilisateur sont conservés lors des sauvegardes suivantes.
    private function createOrUpdateInfoCmd($_logicalId, $_name, $_subType, $_unit, $_order) {
		$info = $this->getCmd(null, $_logicalId);
		if (!is_object($info)) {
			$info = new solaxcloudCmd();
			$info->setName(__($_name, __FILE__));
			$info->setIsHistorized(0);
			$info->setIsVisible(1);
		}
		$info->setLogicalId($_logicalId);
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType($_subType);
		if ($_unit !== '') {
			$info->setUnite($_unit);
		}
		$info->setOrder($_order);
		$info->save();
    }

 // Fonction exécutée automatiquement après la sauvegarde (création ou mise à jour) de l'équipement
    public function postSave() {
		$this->createOrUpdateInfoCmd('invertertype', 'Inverter type: ', 'string', '', 2);
		$this->createOrUpdateInfoCmd('inverterstatus', 'Inverter status: ', 'string', '', 3);
		$this->createOrUpdateInfoCmd('acpower', 'AC Power (Total)', 'numeric', 'W', 4);
		$this->createOrUpdateInfoCmd('yieldtoday', 'AC Energy Out (Daily)', 'numeric', 'kWh', 5);
		$this->createOrUpdateInfoCmd('yieldtotal', 'AC Energy Out (Total)', 'numeric', 'kWh', 6);
		$this->createOrUpdateInfoCmd('feedinpower', 'GCP Power (Total)', 'numeric', 'W', 7);
		$this->createOrUpdateInfoCmd('feedinenergy', 'Energy to Grid (Total)', 'numeric', 'kWh', 8);
		$this->createOrUpdateInfoCmd('consumeenergy', 'Energy from Grid (Total)', 'numeric', 'kWh', 9);
		$this->createOrUpdateInfoCmd('feedinpowerM2', 'Add.2 Meter AC Power (Total)', 'numeric', 'W', 10);
		$this->createOrUpdateInfoCmd('soc', 'DC Battery', 'numeric', '%', 11);
		$this->createOrUpdateInfoCmd('peps1', 'AC EPS Power R', 'numeric', 'W', 12);
		$this->createOrUpdateInfoCmd('peps2', 'AC EPS Power S', 'numeric', 'W', 13);
		$this->createOrUpdateInfoCmd('peps3', 'AC EPS Power T', 'numeric', 'W', 14);
		$this->createOrUpdateInfoCmd('batPower', 'Battery Power', 'numeric', 'W', 15);
		$this->createOrUpdateInfoCmd('powerdc1', 'Power DC1', 'numeric', 'W', 16);
		$this->createOrUpdateInfoCmd('powerdc2', 'Power DC2', 'numeric', 'W', 17);
		$this->createOrUpdateInfoCmd('powerdc3', 'Power DC3', 'numeric', 'W', 18);
		$this->createOrUpdateInfoCmd('powerdc4', 'Power DC4', 'numeric', 'W', 19);
		$this->createOrUpdateInfoCmd('uploadTime', 'Update time: ', 'string', '', 20);

		$refresh = $this->getCmd(null, 'refresh');
		if (!is_object($refresh)) {
			$refresh = new solaxcloudCmd();
			$refresh->setName(__('Refresh', __FILE__));
		}
		$refresh->setEqLogic_id($this->getId());
		$refresh->setLogicalId('refresh');
		$refresh->setType('action');
		$refresh->setSubType('other');
		$refresh->setOrder(1);
		$refresh->save();
    }
 // Fonction exécutée automatiquement avant la suppression de l'équipement
    public function preRemove() {

    }

 // Fonction exécutée automatiquement après la suppression de l'équipement
    public function postRemove() {

    }

	public function getSolaxcloudData() {
		$solaxcloud_regisno = $this->getConfiguration("regisno");
		$solaxcloud_token = $this->getConfiguration("token");

		if (strlen($solaxcloud_regisno) == 0) {
			log::add('solaxcloud', 'debug','Registration Number not provided ...');
			return;
		}

		if (strlen($solaxcloud_token) == 0) {
			log::add('solaxcloud', 'debug','Token not provided ...');
			return;
		}

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 20);

		// COLLECTING VALUES
		curl_setopt($ch, CURLOPT_URL, 'https://www.solaxcloud.com:9443/proxy/api/getRealtimeInfo.do?tokenId=' . urlencode($solaxcloud_token) . '&sn=' . urlencode($solaxcloud_regisno));
		$data = curl_exec($ch);

		if (curl_errno($ch)) {
			$error = curl_error($ch);
			curl_close($ch);
			log::add('solaxcloud', 'error', 'Error getting value on Solax Cloud: ' . $error);
			return;
		}
		curl_close($ch);

		$json = json_decode($data, true);

		// Remise à 0 des puissances instantanées uniquement si l'API répond en échec.
		// Les compteurs d'énergie (cumuls) ne sont pas touchés pour ne pas fausser l'historique.
		if (!is_array($json) || empty($json['success']) || !isset($json['result']) || !is_array($json['result'])) {
			$exception = (is_array($json) && isset($json['exception'])) ? $json['exception'] : $data;
			log::add('solaxcloud', 'warning', 'Solax Cloud returned no valid data: ' . $exception);
			foreach (array('acpower', 'feedinpower', 'feedinpowerM2', 'peps1', 'peps2', 'peps3', 'batPower', 'powerdc1', 'powerdc2', 'powerdc3', 'powerdc4') as $logicalId) {
				$this->checkAndUpdateCmd($logicalId, 0);
			}
			return;
		}
		$result = $json['result'];
		log::add('solaxcloud', 'debug', 'Solax Cloud data: ' . json_encode($result));

		$tinvtyp = array(1=>'X1-LX', 2=>'X-Hybrid', 3=>'X1-Hybiyd/Fit', 4=>'X1-Boost/Air/Mini', 5=>'X3-Hybiyd/Fit', 6=>'X3-20K/30K', 7=>'X3-MIC/PRO', 8=>'X1-Smart', 9=>'X1-AC', 10=>'A1-Hybrid', 11=>'A1-Fit', 12=>'A1-Grid', 13=>'J1-ESS', 14=>'X3-Hybrid-G4', 15=>'X1-Hybrid-G4', 16=> 'X3-MIC/PRO-G2', 17=>'X1-SPT', 18=>'X1-Boost/Mini-G4', 19=>'A1-HYB-G2', 20=>'A1-AC-G2', 21=>'A1-SMT-G2', 22=>'X3-FTH', 23=>'X3-MGA-G2');

		$tinvstat = array(100=>'Wait Mode', 101=>'Check Mode', 102=>'Normal Mode', 103=>'Fault Mode', 104=>'Permanent Fault Mode', 105=>'Update Mode', 106=>'EPS Check Mode', 107=>'EPS Mode', 108=>'Self-Test Mode', 109=>'Idle Mode', 110=>'Standby Mode', 111=>'Pv Wake Up Bat Mode', 112=>'Gen Check Mode', 113=>'Gen Run Mode');

		// Un type ou un statut inconnu de la table (onduleur récent) est affiché tel quel au lieu de bloquer les données
		$invtyp = isset($result['inverterType']) ? $result['inverterType'] : null;
		$invstat = isset($result['inverterStatus']) ? $result['inverterStatus'] : null;
		$invertertype = ($invtyp !== null && $invtyp !== '') ? (isset($tinvtyp[$invtyp]) ? $tinvtyp[$invtyp] : 'Type ' . $invtyp) : '';
		$inverterstatus = ($invstat !== null && $invstat !== '') ? (isset($tinvstat[$invstat]) ? $tinvstat[$invstat] : 'Status ' . $invstat) : '';

		$this->checkAndUpdateCmd('invertertype', $invertertype);
		$this->checkAndUpdateCmd('inverterstatus', $inverterstatus);
		foreach (array('acpower', 'yieldtoday', 'yieldtotal', 'feedinpower', 'feedinenergy', 'consumeenergy', 'feedinpowerM2', 'soc', 'peps1', 'peps2', 'peps3', 'uploadTime', 'batPower', 'powerdc1', 'powerdc2', 'powerdc3', 'powerdc4') as $logicalId) {
			if (isset($result[$logicalId])) {
				$this->checkAndUpdateCmd($logicalId, $result[$logicalId]);
			}
		}
	}
	

    /*
     * Non obligatoire : permet de modifier l'affichage du widget (également utilisable par les commandes)
      public function toHtml($_version = 'dashboard') {

      }
     */

    /*
     * Non obligatoire : permet de déclencher une action après modification de variable de configuration
    public static function postConfig_<Variable>() {
    }
     */

    /*
     * Non obligatoire : permet de déclencher une action avant modification de variable de configuration
    public static function preConfig_<Variable>() {
    }
     */

    /*     * **********************Getteur Setteur*************************** */
}

class solaxcloudCmd extends cmd {
    /*     * *************************Attributs****************************** */
    
    /*
      public static $_widgetPossibility = array();
    */
    
    /*     * ***********************Methode static*************************** */


    /*     * *********************Methode d'instance************************* */

    /*
     * Non obligatoire permet de demander de ne pas supprimer les commandes même si elles ne sont pas dans la nouvelle configuration de l'équipement envoyé en JS
      public function dontRemoveCmd() {
      return true;
      }
     */

  // Exécution d'une commande  
     public function execute($_options = array()) {
				$eqlogic = $this->getEqLogic();
				switch ($this->getLogicalId()) {		
					case 'refresh':
						$info = $eqlogic->getSolaxcloudData();
						break;					
		}        
     }

    /*     * **********************Getteur Setteur*************************** */
}
