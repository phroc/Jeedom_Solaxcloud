Description du plugin Solax Cloud
===

Le plugin Solax Cloud vous permet de récupérer les informations de vos **onduleurs Solax via Solax Cloud**.

Il ne s'agit donc pas d'une intégration en local, **mais via le cloud**.

Si vous souhaitez intégrer vos onduleurs Solax sur Jeedom sans dépendance du cloud, installez le plugin "Onduleur Solax", disponible gratuitement sur le market Jeedom.

L'avantage de ce plugin Solax Cloud est qu'il permet de récupérer les informations de onduleurs Solax non supportés par l'autre plugin.
<br>
<br>

Configuration du plugin
===

Après avoir installé le plugin via le market Jeedom, il vous suffit de l'activer. **Il n'a ni dépendances, ni démon**. Par conséquent, il n'y a rien d'autre à faire à ce niveau-là.

![Solaxcloud](https://github.com/phroc/Jeedom_Solaxcloud/blob/master/docs/fr_FR/pics/Solax_fra_1.png)

Ensuite vous devez créer un équipement. Pour cela, rendez-vous à Plugin / Monitoring / Solax Cloud.

![Solaxcloud](https://github.com/phroc/Jeedom_Solaxcloud/blob/master/docs/fr_FR/pics/Solax_fra_2.png)

Cliquez sur "+" (Ajouter).

![Solaxcloud](https://github.com/phroc/Jeedom_Solaxcloud/blob/master/docs/fr_FR/pics/Solax_fra_3.png)

Saisissez un nom pour votre nouvel équipement.

![Solaxcloud](https://github.com/phroc/Jeedom_Solaxcloud/blob/master/docs/fr_FR/pics/Solax_fra_4.png)

Vous devez ensuite saisir le "Registration No" de votre onduleur Solax (indiqué sur celui-ci).

Vous devez également saisir le "token" préalablement obtenu sur votre compte Solax Cloud.

![Solaxcloud](https://github.com/phroc/Jeedom_Solaxcloud/blob/master/docs/fr_FR/pics/Solax_fra_5.png)

Pour finir, cliquez sur "Sauvegarder"

C'est tout!
<br>
<br>

Les commandes
===

**Les commandes de l'équipement se créent automatiquement** dès que vous sauvegardez la configuration à l'étape précédente.

![Solaxcloud](https://github.com/phroc/Jeedom_Solaxcloud/blob/master/docs/fr_FR/pics/Solax_fra_6.png)

Vous obtenez **13 commandes de type "info"** que vous pouvez afficher et/ou historiser à votre convenance.
<br>
<br> 

Le widget
===

Widget en forme de jauges, à l'état brut. Utilisez le mode édition sur le dashboard (crayon situé en haut à droite de l'écran) pour dimensionner le wigdet comme vous l'entendez.

![Solaxcloud](https://github.com/phroc/Jeedom_Solaxcloud/blob/master/docs/fr_FR/pics/Solax_fra_7.png)

Vous pouvez personnaliser ce widget à votre guise.

**Le rafraîchissement des données s'effectue toutes les minutes**.

Si vous avez plusieurs onduleurs Solax, vous pouvez créer un équipement pour chacun d'entre eux. Dans ce cas, vous aurez un widget par onduleur.
<br>
<br>
Correspondance des valeurs remontées par la commmande "Inverter Type":

* 1 =  X1-LX

* 2 =  X-Hybrid

* 3 =  X1-Hybiyd/Fit

* 4 =  X1-Boost/Air/Mini

* 5 =  X3-Hybiyd/Fit

* 6 =  X3-20K/30K

* 7 =  X3-MIC/PRO

* 8 =  X1-Smart

* 9 =  X1-AC

* 10 = A1-Hybrid

* 11 = A1-Fit

* 12 = A1-Grid

* 13 = J1-ESS
<br>
<br>

Correspondance des valeurs remontées par la commmande "Inverter Status":

* 100 = Wait Mode

* 101 = Check Mode

* 102 = Normal Mode

* 103 = Fault Mode

* 104 = Permanent Fault Mode

* 105 = Update Mode

* 106 = EPS Check Mode

* 107 = EPS Mode

* 108 = Self-Test Mode

* 109 = Idle Mode

* 110 = Standby Mode

* 111 = Pv Wake Up Bat Mode

* 112 = Gen Check Mode

* 113 = Gen Run Mode
<br>
<br> 


Autres informations
===

Documentación en español disponible [aquí](https://github.com/phroc/Jeedom_Solaxcloud/blob/master/docs/es_ES/index.md)
