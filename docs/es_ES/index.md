Descripción del plugin Solax Cloud
===

El plugin Solax Cloud le permite obtener datos de sus **inversores Solax a través de Solax Cloud**.

No se trata, por tanto, de una integración en local, **sino a través de la nube de Solax**.

Si quiere integrar sus inversores Solax en Jeedom sin ninguna dependencia de la nube, puede instalar el plugin "Onduleur Solax", disponible gratuitamente en el market Jeedom.

La ventaja del plugin Plugin Solax Cloud es que permite obtener datos de inversores Solax no soportados por el otro plugin.
<br>
<br>

Configuración del plugin
===

Una vez que haya instalado el plugin desde el market Jeedom, sólo tiene que activarlo. **El plugin no tiene dependencias ni tampoco demonio**. Por consiguiente, no tiene que hacer nada más.

![Solaxcloud](https://github.com/phroc/Jeedom_Solaxcloud/blob/master/docs/es_ES/pics/Solax_esp_1.png)


Después, debe crear un equipo nuevo. Para ello, vaya a Plugins / Monitoreo / Solax Cloud.

![Solaxcloud](https://github.com/phroc/Jeedom_Solaxcloud/blob/master/docs/es_ES/pics/Solax_esp_2.png)

Haga clic en "+" (Añadir).

![Solaxcloud](https://github.com/phroc/Jeedom_Solaxcloud/blob/master/docs/es_ES/pics/Solax_esp_3.png)

Introduzca el nombre del equipo nuevo.

![Solaxcloud](https://github.com/phroc/Jeedom_Solaxcloud/blob/master/docs/es_ES/pics/Solax_esp_4.png)

Después, debe introducir el "Registration No" de su inversor Solax (viene indicado en el mismo).

También debe introducir el "token" obtenido previamente a través de su cuenta Solax Cloud.

![Solaxcloud](https://github.com/phroc/Jeedom_Solaxcloud/blob/master/docs/es_ES/pics/Solax_esp_5.png)

Finalmente, haga clic en "Guardar"

¡Eso es todo!
<br>
<br>

Los comandos
===

**Los comandos del equipo se crean automaticamente** al guardar la configuración realizada en el punto anterior.

![Solaxcloud](https://github.com/phroc/Jeedom_Solaxcloud/blob/master/docs/es_ES/pics/Solax_esp_6.png)

Obtendrá en su equipo **13 comandos de tipo "información"** que puede hacer visibles y/o historizar como mejor le convenga.
<br>
<br> 


El widget
===

El Widget viene con indicadores circulares, en "bruto". Use el modo "edición" en el dashboard (lápiz situado en la esquina superior derecha) para dejarlo con el tamaño adecuado.

![Solaxcloud](https://github.com/phroc/Jeedom_Solaxcloud/blob/master/docs/es_ES/pics/Solax_esp_7.png)

Puede personalizarlo como más le guste.

**El refresco de los datos se hace cada minuto**.

Si tiene más de un inversor Solax, puede crear un equipo para cada inversor. En ese caso, tendrá un widget por inversor.
<br>
<br> 
Correspondencia de los valores devueltos por el comando "Inverter Type":

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

Correspondencia de los valores devueltos por el comando "Inverter Status":

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


<span style="color: #67A4F2">Información complementaria</span>
===

Documentation en français disponible [ici](https://github.com/phroc/Jeedom_Solaxcloud/blob/master/docs/fr_FR/index.md)
