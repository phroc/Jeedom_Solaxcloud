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

    }

 // Fonction exécutée automatiquement après la sauvegarde (création ou mise à jour) de l'équipement 
    public function postSave() {	
		$info = $this->getCmd(null, 'acpower');
		if (!is_object($info)) {
			$info = new solaxcloudCmd();
			$info->setName(__('Inverter AC Power Total', __FILE__));
		}
		$info->setLogicalId('acpower');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(0);
		$info->setIsVisible(1);	
		$info->setUnite('W');
		$info->setOrder(1);
		$info->save();
		
		$info = $this->getCmd(null, 'yieldtoday');
		if (!is_object($info)) {
			$info = new solaxcloudCmd();
			$info->setName(__('Energy Out Daily', __FILE__));
		}
		$info->setLogicalId('yieldtoday');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(0);
		$info->setIsVisible(1);
		$info->setOrder(2);		
		$info->setUnite('kWh');
		$info->save();
		
		$info = $this->getCmd(null, 'yieldtotal');
		if (!is_object($info)) {
			$info = new solaxcloudCmd();
			$info->setName(__('Energy Out Total', __FILE__));
		}
		$info->setLogicalId('yieldtotal');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(0);
		$info->setIsVisible(1);
		$info->setOrder(3);
		$info->setUnite('kWh');
		$info->save();
		
		$info = $this->getCmd(null, 'feedinpower');
		if (!is_object($info)) {
			$info = new solaxcloudCmd();
			$info->setName(__('Power Total', __FILE__));
		}
		$info->setLogicalId('feedinpower');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(0);
		$info->setIsVisible(1);
		$info->setOrder(4);
		$info->setUnite('W');
		$info->save();
		
		$info = $this->getCmd(null, 'feedinenergy');
		if (!is_object($info)) {
			$info = new solaxcloudCmd();
			$info->setName(__('Energy to Grid Total', __FILE__));
		}
		$info->setLogicalId('feedinenergy');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(0);
		$info->setIsVisible(1);
		$info->setOrder(5);
		$info->setUnite('kWh');
		$info->save();
		
		$info = $this->getCmd(null, 'consumeenergy');
		if (!is_object($info)) {
			$info = new solaxcloudCmd();
			$info->setName(__('Energy from Grid Total', __FILE__));
		}
		$info->setLogicalId('consumeenergy');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(0);
		$info->setIsVisible(1);
		$info->setOrder(6);
		$info->setUnite('kWh');
		$info->save();
		
		$info = $this->getCmd(null, 'feedinpowerM2');
		if (!is_object($info)) {
			$info = new solaxcloudCmd();
			$info->setName(__('Meter AC Power Total', __FILE__));
		}
		$info->setLogicalId('feedinpowerM2');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(0);
		$info->setIsVisible(1);		
		$info->setOrder(7);	
		$info->setUnite('KWh');
		$info->save();
		
		$info = $this->getCmd(null, 'soc');
		if (!is_object($info)) {
			$info = new solaxcloudCmd();
			$info->setName(__('DC Battery', __FILE__));
		}
		$info->setLogicalId('soc');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(0);
		$info->setIsVisible(1);
		$info->setUnite('%');
		$info->setOrder(8);		
		$info->save();
		
		$info = $this->getCmd(null, 'peps1');
		if (!is_object($info)) {
			$info = new solaxcloudCmd();
			$info->setName(__('AC EPS Power R', __FILE__));
		}
		$info->setLogicalId('peps1');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(0);
		$info->setIsVisible(1);
		$info->setUnite('W');
		$info->setOrder(9);		
		$info->save();
		
		$info = $this->getCmd(null, 'peps2');
		if (!is_object($info)) {
			$info = new solaxcloudCmd();
			$info->setName(__('AC EPS Power S', __FILE__));
		}
		$info->setLogicalId('peps2');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(0);
		$info->setIsVisible(1);
		$info->setUnite('W');
		$info->setOrder(10);		
		$info->save();
		
		$info = $this->getCmd(null, 'peps3');
		if (!is_object($info)) {
			$info = new solaxcloudCmd();
			$info->setName(__('AC ESP Power T', __FILE__));
		}
		$info->setLogicalId('peps3');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(0);
		$info->setIsVisible(1);		
		$info->setUnite('W');
		$info->setOrder(11);
		$info->save();
		
		$info = $this->getCmd(null, 'invertertype');
		if (!is_object($info)) {
			$info = new solaxcloudCmd();
			$info->setName(__('Inverter type', __FILE__));
		}
		$info->setLogicalId('invertertype');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(0);
		$info->setIsVisible(1);
		$info->setOrder(12);
		$info->save();
		
		$info = $this->getCmd(null, 'inverterstatus');
		if (!is_object($info)) {
			$info = new solaxcloudCmd();
			$info->setName(__('Inverter status', __FILE__));
		}
		$info->setLogicalId('inverterstatus');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(0);
		$info->setIsVisible(1);
		$info->setOrder(13);
		$info->save();
			
		$refresh = $this->getCmd(null, 'refresh');
		if (!is_object($refresh)) {
			$refresh = new solaxcloudCmd();
			$refresh->setName(__('Refresh', __FILE__));
		}
		$refresh->setEqLogic_id($this->getId());
		$refresh->setLogicalId('refresh');
		$refresh->setType('action');
		$refresh->setSubType('other');
		$info->setIsHistorized(0);
		$info->setIsVisible(0);	
		$refresh->setOrder(14);
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
			$this->checkAndUpdateCmd('status', 'Registration Number not provided ...');
			return;
		}
		
		if (strlen($solaxcloud_token) == 0) {
			log::add('solaxcloud', 'debug','Token not provided ...');
			$this->checkAndUpdateCmd('status', 'Token not provided ...');
			return;
		}

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		// COLLECTING VALUES
		curl_setopt($ch, CURLOPT_URL, 'https://www.solaxcloud.com:9443/proxy/api/getRealtimeInfo.do?tokenId=' .$solaxcloud_token.'&sn=' .$solaxcloud_regisno);
		$data = curl_exec($ch);
		
		if (curl_errno($ch)) {
			curl_close ($ch);
			log::add('solaxcloud', 'error','Error getting value on Solax Cloud: '.curl_error($ch));
			$this->checkAndUpdateCmd('status', 'Error retrieving data');
			return;
		}
		
		$json = json_decode($data, true);
		
		$acpower = $json['result']['acpower'];
		$yieldtoday = $json['result']['yieldtoday'];
		$yieldtotal = $json['result']['yieldtotal'];
		$feedinpower = $json['result']['feedinpower'];
		$feedinenergy = $json['result']['feedinenergy'];
		$consumeenergy = $json['result']['consumeenergy'];
		$feedinpowerM2 = $json['result']['feedinpowerM2'];
		$soc = $json['result']['soc'];
		$peps1 = $json['result']['peps1'];
		$peps2 = $json['result']['peps2'];
		$peps3 = $json['result']['peps3'];
		$invertertype = $json['result']['inverterType'];
		$inverterstatus = $json['result']['inverterStatus'];

		if ($invertertype == '') {
			$this->checkAndUpdateCmd('acpower', 0);
			$this->checkAndUpdateCmd('yieldtoday', 0);
			$this->checkAndUpdateCmd('yieldtotal', 0);
			$this->checkAndUpdateCmd('feedinpower', 0);
			$this->checkAndUpdateCmd('feedinenergy', 0);
			$this->checkAndUpdateCmd('consumeenergy', 0);
			$this->checkAndUpdateCmd('feedinpowerM2', 0);
			$this->checkAndUpdateCmd('soc', 0);
			$this->checkAndUpdateCmd('peps1', 0);
			$this->checkAndUpdateCmd('peps2', 0);
			$this->checkAndUpdateCmd('peps3', 0);
			$this->checkAndUpdateCmd('invertertype', 0);
			$this->checkAndUpdateCmd('inverterstatus', 0);
			} else {
			curl_close ($ch);
			$this->checkAndUpdateCmd('acpower', $acpower);
			$this->checkAndUpdateCmd('yieldtoday', $yieldtoday);
			$this->checkAndUpdateCmd('yieldtotal', $yieldtotal);
			$this->checkAndUpdateCmd('feedinpower', $feedinpower);
			$this->checkAndUpdateCmd('feedinenergy', $feedinenergy);
			$this->checkAndUpdateCmd('consumeenergy', $consumeenergy);
			$this->checkAndUpdateCmd('feedinpowerM2', $feedinpowerM2);
			$this->checkAndUpdateCmd('soc', $soc);
			$this->checkAndUpdateCmd('peps1', $peps1);
			$this->checkAndUpdateCmd('peps2', $peps2);
			$this->checkAndUpdateCmd('peps3', $peps3);
			$this->checkAndUpdateCmd('invertertype', $invertertype);
			$this->checkAndUpdateCmd('inverterstatus', $inverterstatus);		
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


