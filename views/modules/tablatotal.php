<?php
  session_start();
?>



  <style type="text/css">


#footer {
   position:fixed;
   left:0px;
   bottom:0px;
   height:50px;
   width:100%;
   background: #003869;
   border-top: 1px solid darkslategray;
}

#footer label {
  font-family: arial black, sans-serif;
    font-size: 30px;
    color:white;
}

/* LOGIN */

#login-logo-wrapper {
  position: absolute; 
  left: 50%; 
  top: 9.5%;
  width: 22%;
  transform: translate(-50%, -50%);
}

#form-login-wrapper {
  text-align: center; 
  position: absolute; 
  left: 43%; 
  top: 36%; 
}

#mensaje-error-login {
  position: inherit;
    margin-top: 15%;
    margin-left: 41%;
}

.label-login {
  padding-bottom: 5%;
}

.label-login label {
  font-family: "Trebuchet MS", Helvetica, sans-serif;
  font-size: 20px;
}

.input-login {
  padding-bottom: 10%;
}

.input-login input {
  width: 230px;
    height: 35px;
    box-shadow: 2px 2px 15px rgba(0, 55, 255, 0.28);
    border: 1px solid rgba(80, 80, 80, 0.35);
    font-size: 20px;
}

.input-login input[type="submit"] {
  width: 230px;
    margin-top: 35px;
    font-size: 15px;
    border-radius: 1px 0px 10px 10px;
    background-color: rgba(0, 161, 255, 0.45);
}

.input-login input[type="submit"]:hover {
  background-color: rgb(0, 161, 255);
  cursor: pointer;
}
/* FIN LOGIN */


/* PROCESS INFO */

#main-wrapper {
  text-align: center; 
  position: absolute; 
  left: 0; 
  top: 0;  
  width: 100%; 
  height: 100%; 
  box-shadow: 3px 0 20px 0px #888;
}

#logo-cliente {
  position: absolute;
    text-align: center;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    opacity: 0.07;
}

#info-actual {
  width: 100%
}

#info-actual label {
  font-family: Century Gothic, sans-serif;
    text-shadow: rgb(0, 0, 0) 1px 1px;
    color: white;
}

#info-actual-lote {
  position: absolute;
    left: 3%;
    top: 35px;
}

#info-actual-lote label { 
  font-size: 25px; 
}
      
/*#info-actual-balanza {
  padding-bottom: 30px;
}*/

#info-actual-brazos-title {
  position: absolute;
    top: 35px;
    left: 76%;
}
#info-actual-brazos-title label {
  font-size: 25px;
}

#header-info {
  position: absolute;
  width: 100%;
  height: 7%;
  border-bottom: 1px solid black;
  background: #060873;
  box-shadow: 0 2px 10px -1px grey;
}

#main-info-wrapper {
  position: relative;
}

.box-brazo { 
  border: 1px solid lightgray;
    display: inline-block;
    /*margin: 1% 2%;*/
    width: 49%;
    height: 46.25%;
    box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.15);
    /*opacity: 0; sólo para animate de jquery */
}

.box-brazo-title {
  position: relative;
    border-bottom: 1px solid rgba(148, 10, 10, 0.25);
    width: 50%;
    height: 10%;
    left:25%;
    top:20px;
    /*box-shadow: 0 10px 14px -8px grey;*/
}

.box-brazo-title label {
    font-family: Century Gothic, sans-serif;
    font-size: 45px;
    color: #47525d;
    /*position: relative;
    top: 15%;
    text-shadow: 1px 1px 3px white;*/
}

.box-brazo-piezas {
  position: relative;
    top:20%;
}

.box-brazo-piezas label  {
  font-family: Century Gothic, sans-serif;
  font-size: 70px;
    color: #47525d;
}

.box-brazo-total {
  position: relative;
  top: 40%;
}

.box-brazo-total label  {
  font-family: Century Gothic, sans-serif;
  font-size: 70px;
    color: #47525d;
}

.box-reset-link {
      position: relative;
    top: 42%; 
}

.box-reset-link a {
  color: blue;
  text-decoration: none;
  font-family: Century Gothic, sans-serif;
  font-size: 14px;
    text-shadow: rgba(169, 169, 169, 0.53) 1px 1px;
}

.box-reset-link a:visited {
  color: blue;
    text-decoration: none;
}
.box-reset-link a:hover {
  color: red;
  cursor: pointer;
}


/* Menu lateral */
/*
#lateral-wrapper { 
  background: #dadada; 
  position: absolute; 
  overflow: hidden; 
  left: 76%; 
  top: 0; 
  width: 23.9%; 
  height: 100%; 
}

#lateral-title { 
  width: 100%; 
  text-align: center; 
  margin-top: 25px; 
  border-bottom: 1px solid #b7b7b7; 
  box-shadow: 0px 1px 0px 0px rgba(255, 253, 253, 0.58); 
  padding-bottom: 25px;
}

#lateral-title-main label {
  font-family: Century Gothic, sans-serif; 
  font-size: 25px; 
  text-shadow: rgba(119, 118, 118, 0.52) 1px 1px; 
  color:black;
}

#lateral-title-date {
  padding-top:10px;
}

#lateral-title-date label {
  font-family: Century Gothic, sans-serif; 
  font-size: 15px; 
  text-shadow: rgba(119, 118, 118, 0.52) 1px 1px; 
  color:black;
}
      
.lateral-info {
  width:100%; 
  height:80px;
  text-align: center;
  border-bottom: 1px solid #b7b7b7;
  box-shadow: 0px 1px 0px 0px rgba(255, 253, 253, 0.58); 
  padding:15px 5px; 
}
      
.lateral-info label {
  font-family: Century Gothic, sans-serif; 
  font-size: 20px; 
  text-shadow: rgba(119, 118, 118, 0.52) 1px 1px; 
  color:black;
}*/

#link-volver {
  position: absolute;
    top: 33px;
    left:0.5%;
}

#link-volver a {
  text-decoration: none;
    color: white;
    font-family: Century Gothic, sans-serif;
    font-size: 30px;
}

#link-volver a:hover {
  text-decoration: none;
  color: red;
}

#full-wrapper-info {
   position: absolute;
    text-align: center;
    top: 60%;
    left: 51%;
    transform: translate(-50%, -50%);
}

#info-title-wrapper {
  padding: 15px 15px;
}

#info-title-wrapper label {
    font-family: Century Gothic, sans-serif;
  font-size: 20px;
    color: #47525d;
}

#select-info-wrapper {
  padding-bottom: 10px;
}

#select-info-wrapper select {
  width: 230px;
  height: 30px;
}

#datetime-title {
  padding: 15px 15px;
}

#datetime-title label {
    font-family: Century Gothic, sans-serif;
  font-size: 20px;
    color: #47525d;
}

#calendar {
  padding-bottom: 10px;
}

#calendar input {
  width: 230px;
  height: 30px;
}

#link-volver-info {
  position: absolute;
    bottom: 0;
    width: 99%;
    padding-bottom: 1%;
    text-align: center;
}

#link-volver-info a {
  text-decoration: none;
    color: black;
    font-family: "Trebuchet MS", Helvetica, sans-serif;
    font-size: 14px;
    text-shadow: 0px 0px 6px rgba(0, 0, 0, 0.77);
}

#link-volver-info a:hover {
  text-decoration: none;
  color: red;
}


/* Productividad */
.box-brazo-prod-acu {
  position: relative;
    top:15%;
}

.box-brazo-prod-acu label  {
  font-family: Century Gothic, sans-serif;
  font-size: 45px;
    color: #47525d;
}

.box-brazo-prod-acu-ult {
  position: relative;
  top: 32%;
}

.box-brazo-prod-acu-ult  label  {
  font-family: Century Gothic, sans-serif;
  font-size: 45px;
    color: #47525d;
}

.box-brazo-pz-por-hr {
  position: relative;
  top: 50%;
}

.box-brazo-pz-por-hr  label  {
  font-family: Century Gothic, sans-serif;
  font-size: 45px;
    color: #47525d;
}

#info-totales {
  padding-top: 20px;
  margin-right: 86px;
}
#info-totales label {
  font-size: 35px;
}


#ingreso-dotacion-title {
      padding: 15px 15px;
}

#ingreso-dotacion {
  width: 600px;
}

#ingreso-dotacion label {
  font-family: Century Gothic, sans-serif;
  font-size: 20px;
    color: #47525d;
}

.input-dotacion input {
  width: 230px;
    height: 30px;
}


.input-dotacion {
  padding:5px 5px;
}



/* Diseño para tabla */
table {
  height:93.5%;
  width:100%; 
  position: absolute; 
  top: 0; 
  bottom: 0; 
  left: 0; 
  right: 0;
  border:0;
  border-collapse:collapse;
}

tr {
  height:21%;
}

tr:first-child {
  height:15%;
  background-color: rgba(128, 128, 128, 0.2);
}

#first-child-total {
  height:5%;
  background-color: rgba(128, 128, 128, 0.2);
}

td {
  width: 40%;

  border-bottom: 1px solid rgba(12, 12, 12, 0.3);

  font-size: 6vw;
  font-weight:bold;
  font-family:arial black, sans-serif;

  text-align: center;
  text-shadow:1px 1px 4px rgba(255,242,56,1);
  text-transform:uppercase;

  color:#000000;
  line-height: 0;
}

td:first-child {
  width:20%;
  background-color: rgba(128, 128, 128, 0.2)
}

td label {
  font-size: 7.5vw;
}

</style>
  <div id="main-wrapper">
    <table>
      <tr id="first-child-total">
        <td>Pz/HH</td>
        <td>Piezas</td>
      </tr>
      <tr>
        <td>
          <label style='font-size:20vw;'>
            <?php
              /* Calculo cuando 1 línea no tiene dotacion */
              if( ($_SESSION["totalPzHHL1"] > 0) and ($_SESSION["totalPzHHL2"] > 0) and ($_SESSION["totalPzHHL3"] > 0) and ($_SESSION["totalPzHHL4"] > 0) ) {
                echo round(($_SESSION["totalPzHHL1"] + 
                      $_SESSION["totalPzHHL2"] +
                      $_SESSION["totalPzHHL3"] +
                      $_SESSION["totalPzHHL4"]) / 4);
              }
              if( ($_SESSION["totalPzHHL1"] == 0) and ($_SESSION["totalPzHHL2"] > 0) and ($_SESSION["totalPzHHL3"] > 0) and ($_SESSION["totalPzHHL4"] > 0) ) {
                echo round(($_SESSION["totalPzHHL2"] +
                      $_SESSION["totalPzHHL3"] +
                      $_SESSION["totalPzHHL4"]) / 3);
              }
              if( ($_SESSION["totalPzHHL1"] > 0) and ($_SESSION["totalPzHHL2"] == 0) and ($_SESSION["totalPzHHL3"] > 0) and ($_SESSION["totalPzHHL4"] > 0) ) {
                echo round(($_SESSION["totalPzHHL1"] +
                      $_SESSION["totalPzHHL3"] +
                      $_SESSION["totalPzHHL4"]) / 3);
              }
              if( ($_SESSION["totalPzHHL1"] > 0) and ($_SESSION["totalPzHHL2"] > 0) and ($_SESSION["totalPzHHL3"] == 0) and ($_SESSION["totalPzHHL4"] > 0) ) {
                echo round(($_SESSION["totalPzHHL1"] +
                      $_SESSION["totalPzHHL2"] +
                      $_SESSION["totalPzHHL4"]) / 3);
              }
              if( ($_SESSION["totalPzHHL1"] > 0) and ($_SESSION["totalPzHHL2"] > 0) and ($_SESSION["totalPzHHL3"] > 0) and ($_SESSION["totalPzHHL4"] == 0) ) {
                echo round(($_SESSION["totalPzHHL1"] +
                      $_SESSION["totalPzHHL2"] +
                      $_SESSION["totalPzHHL3"]) / 3);
              }
              /* Calculo cuando 2 líneas no tienen dotación */
              if( ($_SESSION["totalPzHHL1"] == 0) and ($_SESSION["totalPzHHL2"] == 0) and ($_SESSION["totalPzHHL3"] > 0) and ($_SESSION["totalPzHHL4"] > 0) ) {
                echo round(($_SESSION["totalPzHHL3"] +
                      $_SESSION["totalPzHHL4"]) / 2);
              }

              if( ($_SESSION["totalPzHHL1"] == 0) and ($_SESSION["totalPzHHL2"] > 0) and ($_SESSION["totalPzHHL3"] == 0) and ($_SESSION["totalPzHHL4"] > 0) ) {
                echo round(($_SESSION["totalPzHHL2"] +
                      $_SESSION["totalPzHHL4"]) / 2);
              }

              if( ($_SESSION["totalPzHHL1"] == 0) and ($_SESSION["totalPzHHL2"] > 0) and ($_SESSION["totalPzHHL3"] > 0) and ($_SESSION["totalPzHHL4"] == 0) ) {
                echo round(($_SESSION["totalPzHHL2"] +
                      $_SESSION["totalPzHHL3"]) / 2);
              }

              if( ($_SESSION["totalPzHHL1"] > 0) and ($_SESSION["totalPzHHL2"] == 0) and ($_SESSION["totalPzHHL3"] == 0) and ($_SESSION["totalPzHHL4"] > 0) ) {
                echo round(($_SESSION["totalPzHHL1"] +
                      $_SESSION["totalPzHHL4"]) / 2);
              }

              if( ($_SESSION["totalPzHHL1"] > 0) and ($_SESSION["totalPzHHL2"] == 0) and ($_SESSION["totalPzHHL3"] > 0) and ($_SESSION["totalPzHHL4"] == 0) ) {
                echo round(($_SESSION["totalPzHHL1"] +
                      $_SESSION["totalPzHHL3"]) / 2);
              }

              if( ($_SESSION["totalPzHHL1"] > 0) and ($_SESSION["totalPzHHL2"] > 0) and ($_SESSION["totalPzHHL3"] == 0) and ($_SESSION["totalPzHHL4"] == 0) ) {
                echo round(($_SESSION["totalPzHHL1"] +
                      $_SESSION["totalPzHHL2"]) / 2);
              }

              /* Calculo cuando 3 líneas no tienen dotación */
              if( ($_SESSION["totalPzHHL1"] > 0) and ($_SESSION["totalPzHHL2"] == 0) and ($_SESSION["totalPzHHL3"] == 0) and ($_SESSION["totalPzHHL4"] == 0) ) {
                echo round($_SESSION["totalPzHHL1"]);
              }

              if( ($_SESSION["totalPzHHL1"] == 0) and ($_SESSION["totalPzHHL2"] > 0) and ($_SESSION["totalPzHHL3"] == 0) and ($_SESSION["totalPzHHL4"] == 0) ) {
                echo round($_SESSION["totalPzHHL2"]);
              }

              if( ($_SESSION["totalPzHHL1"] == 0) and ($_SESSION["totalPzHHL2"] == 0) and ($_SESSION["totalPzHHL3"] > 0) and ($_SESSION["totalPzHHL4"] == 0) ) {
                echo round($_SESSION["totalPzHHL3"]);
              }

              if( ($_SESSION["totalPzHHL1"] == 0) and ($_SESSION["totalPzHHL2"] == 0) and ($_SESSION["totalPzHHL3"] == 0) and ($_SESSION["totalPzHHL4"] > 0) ) {
                echo round($_SESSION["totalPzHHL4"]);
              }

              /* Sin ninguna dotación */
              if( ($_SESSION["totalPzHHL1"] == 0) and ($_SESSION["totalPzHHL2"] == 0) and ($_SESSION["totalPzHHL3"] == 0) and ($_SESSION["totalPzHHL4"] == 0) ) {
                echo "0";
              }
            ?>            
          </label>
        </td>
        <td>
          <label style='font-size:20vw;'>
            <?php 
              echo number_format($_SESSION["totalBrazo1"]["piezas"] +
                 $_SESSION["totalBrazo2"]["piezas"] +
                 $_SESSION["totalBrazo3"]["piezas"] +
                 $_SESSION["totalBrazo4"]["piezas"], 0, ".", ".");
            ?>     
          </label>
        </td>
      </tr>
    </table>
  </div>
  <div id="logo-cliente">
    <img src="logo_cbay.png" />
  </div>
  <div id="footer">
    <div style="position:relative; top:2;">
      <label>
        <?php     
          $strStart = $_SESSION["fecha_inicial"]; 
            $dteStart = new DateTime($strStart);  
          $mes = date_format($dteStart, "m");
          switch ($mes) {
            case '1':
              $mesTexto = "Enero";
              break;
            case '2':
              $mesTexto = "Febrero";
              break;
            case '3':
              $mesTexto = "Marzo";
              break;
            case '4':
              $mesTexto = "Abril";
              break;
            case '5':
              $mesTexto = "Mayo";
              break;
            case '6':
              $mesTexto = "Junio";
              break;
            case '7':
              $mesTexto = "Julio";
              break;
            case '8':
              $mesTexto = "Agosto";
              break;
            case '9':
              $mesTexto = "Septiembre";
              break;
            case '10':
              $mesTexto = "Octubre";
              break;
            case '11':
              $mesTexto = "Noviembre";
              break;
            case '12':
              $mesTexto = "Diciembre";
              break;            
            default:  
              $mesTexto = $mes;             
              break;
          }

            echo date_format($dteStart, "d") . " de " . $mesTexto . " desde las " . date_format($dteStart, "h:i") . " - Contratista: " . $_SESSION["contratista"];
        ?>
      </label>
    </div>
  </div>
