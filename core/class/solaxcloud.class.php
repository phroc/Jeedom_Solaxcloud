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
    
 // Fonction exécutée automatiquement après la sauvegarde (création ou mise à jour) de l'équipement 
    public function postSave() {	
		$info = $this->getCmd(null, 'acpower');
		if (!is_object($info)) {
			$info = new solaxcloudCmd();
			$info->setName(__('AC Power (Total)', __FILE__));
		}
		$info->setLogicalId('acpower');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(0);
		$info->setIsVisible(1);	
		$info->setUnite('W');
		$info->setOrder(4);
		$info->save();
		
		$info = $this->getCmd(null, 'yieldtoday');
		if (!is_object($info)) {
			$info = new solaxcloudCmd();
			$info->setName(__('AC Energy Out (Daily)', __FILE__));
		}
		$info->setLogicalId('yieldtoday');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(0);
		$info->setIsVisible(1);
		$info->setOrder(5);		
		$info->setUnite('kWh');
		$info->save();
		
		$info = $this->getCmd(null, 'yieldtotal');
		if (!is_object($info)) {
			$info = new solaxcloudCmd();
			$info->setName(__('AC Energy Out (Total)', __FILE__));
		}
		$info->setLogicalId('yieldtotal');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(0);
		$info->setIsVisible(1);
		$info->setOrder(6);
		$info->setUnite('kWh');
		$info->save();
		
		$info = $this->getCmd(null, 'feedinpower');
		if (!is_object($info)) {
			$info = new solaxcloudCmd();
			$info->setName(__('GCP Power (Total)', __FILE__));
		}
		$info->setLogicalId('feedinpower');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(0);
		$info->setIsVisible(1);
		$info->setOrder(7);
		$info->setUnite('W');
		$info->save();
		
		$info = $this->getCmd(null, 'feedinenergy');
		if (!is_object($info)) {
			$info = new solaxcloudCmd();
			$info->setName(__('Energy to Grid (Total)', __FILE__));
		}
		$info->setLogicalId('feedinenergy');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(0);
		$info->setIsVisible(1);
		$info->setOrder(8);
		$info->setUnite('kWh');
		$info->save();
		
		$info = $this->getCmd(null, 'consumeenergy');
		if (!is_object($info)) {
			$info = new solaxcloudCmd();
			$info->setName(__('Energy from Grid (Total)', __FILE__));
		}
		$info->setLogicalId('consumeenergy');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(0);
		$info->setIsVisible(1);
		$info->setOrder(9);
		$info->setUnite('kWh');
		$info->save();
		
		$info = $this->getCmd(null, 'feedinpowerM2');
		if (!is_object($info)) {
			$info = new solaxcloudCmd();
			$info->setName(__('Add.2 Meter AC Power (Total)', __FILE__));
		}
		$info->setLogicalId('feedinpowerM2');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(0);
		$info->setIsVisible(1);		
		$info->setOrder(10);	
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
		$info->setOrder(11);		
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
		$info->setOrder(12);		
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
		$info->setOrder(13);		
		$info->save();
		
		$info = $this->getCmd(null, 'peps3');
		if (!is_object($info)) {
			$info = new solaxcloudCmd();
			$info->setName(__('AC EPS Power T', __FILE__));
		}
		$info->setLogicalId('peps3');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(0);
		$info->setIsVisible(1);		
		$info->setUnite('W');
		$info->setOrder(14);
		$info->save();
		
		$info = $this->getCmd(null, 'invertertype');
		if (!is_object($info)) {
			$info = new solaxcloudCmd();
			$info->setName(__('Inverter type: ', __FILE__));
		}
		$info->setLogicalId('invertertype');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('string');
		$info->setIsHistorized(0);
		$info->setIsVisible(1);
		$info->setOrder(2);
		$info->save();
		
		$info = $this->getCmd(null, 'inverterstatus');
		if (!is_object($info)) {
			$info = new solaxcloudCmd();
			$info->setName(__('Inverter status: ', __FILE__));
		}
		$info->setLogicalId('inverterstatus');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('string');
		$info->setIsHistorized(0);
		$info->setIsVisible(1);
		$info->setOrder(3);
		$info->save();
			
		$info = $this->getCmd(null, 'uploadTime');
		if (!is_object($info)) {
			$info = new solaxcloudCmd();
			$info->setName(__('Update time: ', __FILE__));
		}
		$info->setLogicalId('uploadTime');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('string');
		$info->setIsHistorized(0);
		$info->setIsVisible(1);
		$info->setOrder(19);
		$info->save();
		
		$info = $this->getCmd(null, 'batPower');
		if (!is_object($info)) {
			$info = new solaxcloudCmd();
			$info->setName(__('Battery Power', __FILE__));
		}
		$info->setLogicalId('batPower');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(0);
		$info->setIsVisible(1);		
		$info->setOrder(15);	
		$info->setUnite('W');
		$info->save();
      
      	$info = $this->getCmd(null, 'powerdc1');
		if (!is_object($info)) {
			$info = new solaxcloudCmd();
			$info->setName(__('Power DC1', __FILE__));
		}
		$info->setLogicalId('powerdc1');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(0);
		$info->setIsVisible(1);		
		$info->setOrder(16);	
		$info->setUnite('W');
		$info->save();
     
      	$info = $this->getCmd(null, 'powerdc2');
		if (!is_object($info)) {
			$info = new solaxcloudCmd();
			$info->setName(__('Power DC2', __FILE__));
		}
		$info->setLogicalId('powerdc2');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(0);
		$info->setIsVisible(1);		
		$info->setOrder(17);	
		$info->setUnite('W');
		$info->save();					
     
      	$info = $this->getCmd(null, 'powerdc3');
		if (!is_object($info)) {
			$info = new solaxcloudCmd();
			$info->setName(__('Power DC3', __FILE__));
		}
		$info->setLogicalId('powerdc3');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(0);
		$info->setIsVisible(1);		
		$info->setOrder(18);	
		$info->setUnite('W');
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

		$tinvtyp = array(1=>'X1-LX', 2=>'X-Hybrid', 3=>'X1-Hybiyd/Fit', 4=>'X1-Boost/Air/Mini', 5=>'X3-Hybiyd/Fit', 6=>'X3-20K/30K', 7=>'X3-MIC/PRO', 8=>'X1-Smart', 9=>'X1-AC', 10=>'A1-Hybrid', 11=>'A1-Fit', 12=>'A1-Grid', 13=>'J1-ESS', 14=>'X3-Hybrid-G4', 15=>'X1-Hybrid-G4', 16=> 'X3-MIC/PRO-G2', 17=>'X1-SPT', 18=>'X1-Boost/Mini-G4', 19=>'A1-HYB-G2', 20=>'A1-AC-G2', 21=>'A1-SMT-G2', 22=>'X3-FTH', 23=>'X3-MGA-G2');
		
		$tinvstat = array(100=>'Wait Mode', 101=>'Check Mode', 102=>'Normal Mode', 103=>'Fault Mode', 104=>'Permanent Fault Mode', 105=>'Update Mode', 106=>'EPS Check Mode', 107=>'EPS Mode', 108=>'Self-Test Mode', 109=>'Idle Mode', 110=>'Standby Mode', 111=>'Pv Wake Up Bat Mode', 112=>'Gen Check Mode', 113=>'Gen Run Mode');		
		
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
		$invtyp = $json['result']['inverterType'];
		$invstat = $json['result']['inverterStatus'];
		$invertertype = $tinvtyp[$invtyp];				
		$inverterstatus = $tinvstat[$invstat];
        $uploadTime = $json['result']['uploadTime'];
        $batPower = $json['result']['batPower'];
        $powerdc1 = $json['result']['powerdc1'];
        $powerdc2 = $json['result']['powerdc2'];
        $powerdc3 = $json['result']['powerdc3'];
      
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
			$this->checkAndUpdateCmd('invertertype', '');
			$this->checkAndUpdateCmd('inverterstatus', '');
            $this->checkAndUpdateCmd('uploadTime', '');
            $this->checkAndUpdateCmd('batPower', 0);
            $this->checkAndUpdateCmd('powerdc1', 0);
            $this->checkAndUpdateCmd('powerdc2', 0);
            $this->checkAndUpdateCmd('powerdc3', 0);
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
            $this->checkAndUpdateCmd('uploadTime', $uploadTime);
            $this->checkAndUpdateCmd('batPower', $batPower);
            $this->checkAndUpdateCmd('powerdc1', $powerdc1);
            $this->checkAndUpdateCmd('powerdc2', $powerdc2);
            $this->checkAndUpdateCmd('powerdc3', $powerdc3);
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
