
<?php 
session_start();  

// $brazo04=$_POST["inputBrazo4"];
// $brazo03=$_POST["inputBrazo3"];
// $brazo02=$_POST["inputBrazo2"];
// $brazo01=$_POST["inputBrazo1"];



// echo $brazo04;
// echo $brazo03;
// echo $brazo02;
// echo $brazo01;
  if(isset($_POST["action"])) { // Se pasa una acción
        switch(sprintf("%d", $_POST["action"])) { // ¿Qué acción?
            case 1: 

              echo "Tarea completada!";
$contratista=$_POST['contratista'];
$fecha_inicial=$_POST['fecha_inicial'];
$inputBrazo4=$_POST['inputBrazo4'];
$inputBrazo3=$_POST['inputBrazo3'];
$inputBrazo2=$_POST['inputBrazo2'];
$inputBrazo1=$_POST['inputBrazo1'];
$CD_PONTO1=$_POST['CD_PONTO'];
$isFirst=$_POST['isFirst'];
echo $contratista;
echo $fecha_inicial;
echo $inputBrazo4;
echo $inputBrazo3;
echo $inputBrazo2;
echo $inputBrazo1;
echo $CD_PONTO1;
echo $isFirst;
function getCantidadBrazos($CD_PONTO) {
      require("conns.php");

      // Ultimo lote ingresado en tabla de pesaje
      $sql = "SELECT NR_SAIDA
          FROM LK_PESAGEM
          WHERE CD_PONTO = $CD_PONTO
          and NR_SAIDA != '5' and NR_SAIDA != '6'
          GROUP BY nr_saida
          HAVING nr_saida IS NOT NULL
          ORDER BY NR_SAIDA";

      $stmt = sqlsrv_query( $conn, $sql );

      if( $stmt === false) {
          die( print_r( sqlsrv_errors(), true) );
      }
        
      $cuentaBrazos = 0;

      while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
          $cuentaBrazos = $cuentaBrazos + 1;
      }

      sqlsrv_free_stmt( $stmt);
      sqlsrv_close($conn);

      return $cuentaBrazos;
    }

    function ultimoPesaje($DT_PESAGEM, $CD_PONTO, $NR_SAIDA) {
      $DT_PESAGEM = str_replace(' ', '', 
                       substr($DT_PESAGEM . ":00.000", 0, 10) . 'T' . 
                       substr($DT_PESAGEM . ":00.000", 10, 22));

    require("conns.php");
     

      $sql = "SELECT TOP 1 DT_PESAGEM
          FROM LK_PESAGEM
          WHERE dt_pesagem >= '$DT_PESAGEM'
          AND cd_ponto = $CD_PONTO
          AND NR_SAIDA = $NR_SAIDA
          ORDER BY CD_PESAGEM DESC";

      $stmt = sqlsrv_query($conn, $sql);

      if($stmt === false) {
        die( print_r(sqlsrv_errors(), true) );
      }

      $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
      
      if($row <> NULL)
        $result = $row['DT_PESAGEM']->format('Y-m-d\TH:i:s.000');
      else
        $result = "{no data on line}";
      sqlsrv_free_stmt($stmt);
      sqlsrv_close($conn);
      return $result;
    }
  
    // Muestra información de piezas y kilos de cada brazos, según id de balanza (CD_PONTO)
    // y a partir de la fecha inicial indicada (DT_PESAGEM_INICIAL)
    function getInfo($CD_PONTO, $NR_SAIDA, $DT_PESAGEM_INICIAL){
       require("conns.php");
      $numBrazos = $NR_SAIDA;

      // Crea arrays individuales para cada brazo sólo la primera vez que la pagina carga
      if(isset($isFirst)){
        // Deben ser arrays de sesion para poder imprimir solo el valor y no todo...
        for($a = 1; $a <= $numBrazos; $a++)
          $_SESSION["totalBrazo" . $a] = array('piezas' => '0', 'kilos' => '0', 'status' => 'false', 'ultimopesaje' => '');     
      }
  echo "<table style='height:100%;'>
      <tr>
            <td><a href='info.php'><img src='views/img/logo_cbay.png' style='width: 20vw;'></a></td>
            <td>Pz/hh</td>
            <td>Piezas</td>
        </tr>

        <tr>";
      // Imprime información de total de kilos y piezas de cada línea (brazos)
      for ($i = $numBrazos; $i >= 1; $i--){         
        $sql = "SELECT COUNT(QT_PESO_LIQUIDO) AS 'pz', SUM(qt_peso_liquido) AS 'kg'
            FROM LK_PESAGEM
            WHERE CD_PONTO = $CD_PONTO AND NR_SAIDA = $i AND ID_STATUS = 0
            AND DT_PESAGEM >= '$DT_PESAGEM_INICIAL'";

        $stmt = sqlsrv_query( $conn, $sql );

        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true) );
        }

        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
          /*if($_SESSION["totalBrazo" . $i]["status"] === "false") { // No hay reset en linea*/
            $_SESSION["totalBrazo" . $i]["piezas"] = $row["pz"];
            $_SESSION["totalBrazo" . $i]["kilos"] = $row["kg"]; 
          /*}else {
            $indivualInfoReset = printIndividualBrazo($_SESSION["current"], $i, $_SESSION["totalBrazo" . $i]["ultimopesaje"]);

            $indivualInfoReset["pz"];
            $indivualInfoReset["kg"];
          }*/
        }

if ($i==4) {
echo "<td>L1</td>";         
          echo "<td>
              <label>"; // Total de piezas/hh en el brazo



              // Validación si brazo tiene pesaje asociado
          if( (intval($_SESSION["totalBrazo4"]["piezas"])) > 0 ) {
            // Validación si hay dotaciión asociada a la línea
            if( intval($_SESSION["dotacionBrazo4"]) > 0 ) {
              $strStart = $_SESSION["fecha_inicial_get"]; 
                $strEnd   = ultimoPesaje($_SESSION["fecha_inicial_get"], $_SESSION["current"], 4); 

                $dteStart = new DateTime($strStart); 
                $dteEnd   = new DateTime($strEnd);
                //echo "Ult. pesaje: " . date_format($dteEnd, "Y-m-d\TH:i:s") . "<br>";
                // Calculo de horas trabajdas según primer y ultimo pesaje
                $dteDiff  = $dteStart->diff($dteEnd); 

              // Pesaje entre 0 seg y 1 minuto
              //1 seg = 0,000277778 hrs
              if( ($dteDiff->format("%H") < 1) and ($dteDiff->format("%s") > 0) and ($dteDiff->format("%i") < 1) ) {
                $segToHr = floatval($dteDiff->format("%s") * 0.000277778);

                $total = $_SESSION["totalBrazo4"]["piezas"] / 
                     $_SESSION["dotacionBrazo4"] / 
                     $segToHr;

                $_SESSION["totalPzHHL1"] = round($total); // variable para suma de total en info-totales.php
                
                echo round($total);
              }else {
                // Pesaje entre 1 min y 1 hr
                // 1 min = 0,0166667 hrs
                if( ($dteDiff->format("%H") < 1) and ($dteDiff->format("%i") >= 1) ){
                  $minToHr = floatval($dteDiff->format("%i") * 0.0166667); 
                  $segToHr = floatval($dteDiff->format("%s") * 0.000277778);

                  $total = $_SESSION["totalBrazo4"]["piezas"] / 
                         $_SESSION["dotacionBrazo4"] / 
                         ($minToHr + $segToHr);

                  $_SESSION["totalPzHHL1"] = round($total); // variable para suma de total en info-totales.php

                    echo round($total);
                }else {
                  // Pesaje mayor a 1 hora
                  // Transforma hora a minutos y suma diferencia de minutos
                  if( $dteDiff->format("%H") >= 1 ) {
                    $hrs = intval($dteDiff->format("%H"));
                    $minToHr = floatval($dteDiff->format("%i") * 0.0166667);
                    $segToHr = floatval($dteDiff->format("%s") * 0.000277778);

                      $total = $_SESSION["totalBrazo4"]["piezas"] / 
                           $_SESSION["dotacionBrazo4"] / 
                           ($hrs + $minToHr + $segToHr);

                    $_SESSION["totalPzHHL1"] = round($total); // variable para suma de total en info-totales.php

                      echo round($total);
                  }else {
                    echo "{Error}";
                  }
                }
              }
            }else {
              echo "0";
            }
          }else {
            echo "0";
          }




          echo "</label>
            </td>
            <td>
              <label>"; // Total de pz en el brazo
              /* Este codigo comentado mostraba el total de kg segun la línea-
              if($_SESSION["totalBrazo" . $i]["kilos"] <> "")
              echo number_format($_SESSION["totalBrazo" . $i]["kilos"]);
            else
              echo "0";*/
          if($_SESSION["totalBrazo" . $i]["piezas"] <> "")
              echo number_format($_SESSION["totalBrazo" . $i]["piezas"], 0, ".", "."); 
            else
              echo "0";
          echo "</label>
            </td>
        </tr>
        <tr>";
}else if ($i==3){

  echo "<td>L2</td>";         
           echo "<td>
              <label>";
              
              // Validación si brazo tiene pesaje asociado
          if( (intval($_SESSION["totalBrazo3"]["piezas"])) > 0 ) {
            // Validación si hay dotaciión asociada a la línea
            if( intval($_SESSION["dotacionBrazo3"]) > 0 ) {

              $strStart = $_SESSION["fecha_inicial_get"]; 
                $strEnd   = ultimoPesaje($_SESSION["fecha_inicial_get"], $_SESSION["current"], 3); 

                $dteStart = new DateTime($strStart); 
                $dteEnd   = new DateTime($strEnd);
                //echo "Ult. pesaje: " . date_format($dteEnd, "Y-m-d\TH:i:s") . "<br>";
                // Calculo de horas trabajdas según primer y ultimo pesaje
                $dteDiff  = $dteStart->diff($dteEnd); 

              // Pesaje entre 0 seg y 1 minuto
              //1 seg = 0,000277778 hrs
              if( ($dteDiff->format("%H") < 1) and ($dteDiff->format("%s") > 0) and ($dteDiff->format("%i") < 1) ) {
                $segToHr = floatval($dteDiff->format("%s") * 0.000277778);

                $total = $_SESSION["totalBrazo3"]["piezas"] / 
                     $_SESSION["dotacionBrazo3"] / 
                     $segToHr;

                $_SESSION["totalPzHHL2"] = round($total); // variable para suma de total en info-totales.php

                echo round($total);
              }else {
                // Pesaje entre 1 min y 1 hr
                // 1 min = 0,0166667 hrs
                if( ($dteDiff->format("%H") < 1) and ($dteDiff->format("%i") >= 1) ){
                  $minToHr = floatval($dteDiff->format("%i") * 0.0166667); 
                  $segToHr = floatval($dteDiff->format("%s") * 0.000277778);

                  $total = $_SESSION["totalBrazo3"]["piezas"] / 
                         $_SESSION["dotacionBrazo3"] / 
                         ($minToHr + $segToHr);

                  $_SESSION["totalPzHHL2"] = round($total); // variable para suma de total en info-totales.php

                    echo round($total);
                }else {
                  // Pesaje mayor a 1 hora
                  // Transforma hora a minutos y suma diferencia de minutos
                  if( $dteDiff->format("%H") >= 1 ) {
                    $hrs = intval($dteDiff->format("%H"));
                    $minToHr = floatval($dteDiff->format("%i") * 0.0166667);
                    $segToHr = floatval($dteDiff->format("%s") * 0.000277778);

                      $total = $_SESSION["totalBrazo3"]["piezas"] / 
                           $_SESSION["dotacionBrazo3"] / 
                           ($hrs + $minToHr + $segToHr);

                      $_SESSION["totalPzHHL2"] = round($total); // variable para suma de total en info-totales.php

                      echo round($total);
                  }else {
                    echo "{Error}";
                  }
                }
              }
            }else {
              echo "0";
            }
          }else {
            echo "0";
          }


          echo "</label>
            </td>
            <td>
              <label>";
              if($_SESSION["totalBrazo" . $i]["piezas"] <> "")
              echo number_format($_SESSION["totalBrazo" . $i]["piezas"], 0, ".", ".");
            else
              echo "0";
        
          echo "</label>
            </td>
        </tr>
        <tr>";

}else if($i==2){


 echo "<td>L3</td>";         
        echo "<td>
              <label>";
              
              // Validación si brazo tiene pesaje asociado
          if( (intval($_SESSION["totalBrazo2"]["piezas"])) > 0 ) {
            // Validación si hay dotaciión asociada a la línea
            if( intval($_SESSION["dotacionBrazo2"]) > 0 ) {

              $strStart = $_SESSION["fecha_inicial_get"]; 
                $strEnd   = ultimoPesaje($_SESSION["fecha_inicial_get"], $_SESSION["current"], 2); 

                $dteStart = new DateTime($strStart); 
                $dteEnd   = new DateTime($strEnd);
                //echo "Ult. pesaje: " . date_format($dteEnd, "Y-m-d\TH:i:s") . "<br>";
                // Calculo de horas trabajdas según primer y ultimo pesaje
                $dteDiff  = $dteStart->diff($dteEnd); 

              // Pesaje entre 0 seg y 1 minuto
              //1 seg = 0,000277778 hrs
              if( ($dteDiff->format("%H") < 1) and ($dteDiff->format("%s") > 0) and ($dteDiff->format("%i") < 1) ) {
                $segToHr = floatval($dteDiff->format("%s") * 0.000277778);

                $total = $_SESSION["totalBrazo2"]["piezas"] / 
                     $_SESSION["dotacionBrazo2"] / 
                     $segToHr;

                $_SESSION["totalPzHHL3"] = round($total); // variable para suma de total en info-totales.php

                echo round($total);
              }else {
                // Pesaje entre 1 min y 1 hr
                // 1 min = 0,0166667 hrs
                if( ($dteDiff->format("%H") < 1) and ($dteDiff->format("%i") >= 1) ){
                  $minToHr = floatval($dteDiff->format("%i") * 0.0166667); 
                  $segToHr = floatval($dteDiff->format("%s") * 0.000277778);

                  $total = $_SESSION["totalBrazo2"]["piezas"] / 
                         $_SESSION["dotacionBrazo2"] / 
                         ($minToHr + $segToHr);

                    $_SESSION["totalPzHHL3"] = round($total); // variable para suma de total en info-totales.php

                    echo round($total);
                }else {
                  // Pesaje mayor a 1 hora
                  // Transforma hora a minutos y suma diferencia de minutos
                  if( $dteDiff->format("%H") >= 1 ) {
                    $hrs = intval($dteDiff->format("%H"));
                    $minToHr = floatval($dteDiff->format("%i") * 0.0166667);
                    $segToHr = floatval($dteDiff->format("%s") * 0.000277778);

                      $total = $_SESSION["totalBrazo2"]["piezas"] / 
                           $_SESSION["dotacionBrazo2"] / 
                           ($hrs + $minToHr + $segToHr);

                      $_SESSION["totalPzHHL3"] = round($total); // variable para suma de total en info-totales.php

                      echo round($total);
                  }else {
                    echo "{Error}";
                  }
                }
              }
            }else {
              echo "0";
            }
          }else {
            echo "0";
          }


          echo "</label>
            </td>
            <td>
              <label>";
              if($_SESSION["totalBrazo" . $i]["piezas"] <> "")
              echo number_format($_SESSION["totalBrazo" . $i]["piezas"], 0, ".", ".");
            else
              echo "0";
              /*if($_SESSION["totalBrazo" . $i]["kilos"] <> "")
              echo number_format($_SESSION["totalBrazo" . $i]["kilos"]);
            else
              echo "0"; */            
          echo "</label>
            </td>
        </tr>
        <tr>";
}else if($i==1){
  

   echo "<td>L4</td>";         
      echo "<td>
              <label>";
              
              // Validación si brazo tiene pesaje asociado
          if( (intval($_SESSION["totalBrazo1"]["piezas"])) > 0 ) {
            // Validación si hay dotaciión asociada a la línea
            if( intval($_SESSION["dotacionBrazo1"]) > 0 ) {

              $strStart = $_SESSION["fecha_inicial_get"]; 
                $strEnd   = ultimoPesaje($_SESSION["fecha_inicial_get"], $_SESSION["current"], 1); 

                $dteStart = new DateTime($strStart); 
                $dteEnd   = new DateTime($strEnd);
                //echo "Ult. pesaje: " . date_format($dteEnd, "Y-m-d\TH:i:s") . "<br>";
                // Calculo de horas trabajdas según primer y ultimo pesaje
                $dteDiff  = $dteStart->diff($dteEnd); 

              // Pesaje entre 0 seg y 1 minuto
              //1 seg = 0,000277778 hrs
              if( ($dteDiff->format("%H") < 1) and ($dteDiff->format("%s") > 0) and ($dteDiff->format("%i") < 1) ) {
                $segToHr = floatval($dteDiff->format("%s") * 0.000277778);

                $total = $_SESSION["totalBrazo1"]["piezas"] / 
                     $_SESSION["dotacionBrazo1"] / 
                     $segToHr;

                $_SESSION["totalPzHHL4"] = round($total); // variable para suma de total en info-totales.php

                echo round($total);
              }else {
                // Pesaje entre 1 min y 1 hr
                // 1 min = 0,0166667 hrs
                if( ($dteDiff->format("%H") < 1) and ($dteDiff->format("%i") >= 1) ){
                  $minToHr = floatval($dteDiff->format("%i") * 0.0166667); 
                  $segToHr = floatval($dteDiff->format("%s") * 0.000277778);

                  $total = $_SESSION["totalBrazo1"]["piezas"] / 
                         $_SESSION["dotacionBrazo1"] / 
                         ($minToHr + $segToHr);

                    $_SESSION["totalPzHHL4"] = round($total); // variable para suma de total en info-totales.php

                    echo round($total);
                }else {
                  // Pesaje mayor a 1 hora
                  // Transforma hora a minutos y suma diferencia de minutos
                  if( $dteDiff->format("%H") >= 1 ) {
                    $hrs = intval($dteDiff->format("%H"));
                    $minToHr = floatval($dteDiff->format("%i") * 0.0166667);
                    $segToHr = floatval($dteDiff->format("%s") * 0.000277778);

                      $total = $_SESSION["totalBrazo1"]["piezas"] / 
                           $_SESSION["dotacionBrazo1"] / 
                           ($hrs + $minToHr + $segToHr);

                      $_SESSION["totalPzHHL4"] = round($total); // variable para suma de total en info-totales.php

                      echo round($total);
                  }else {
                    echo "{Error}";
                  }
                }
              }
            }else {
              echo "0";
            }
          }else {
            echo "0";
          }

          echo "</label>
            </td>
            <td>
              <label>";
              if($_SESSION["totalBrazo" . $i]["piezas"] <> "")
              echo number_format($_SESSION["totalBrazo" . $i]["piezas"], 0, ".", ".");
            else
              echo "0";
              /*if($_SESSION["totalBrazo" . $i]["kilos"] <> "")
              echo number_format($_SESSION["totalBrazo" . $i]["kilos"]);
            else
              echo "0";*/
          echo "</label>
            </td>
        </tr>";   
}

      
  
        sqlsrv_free_stmt( $stmt);   
      } 
      echo "</table>";
      
      sqlsrv_close($conn);
    }

    function printIndividualBrazo($CD_PONTO, $NR_SAIDA, $DT_PESAGEM_ULTIMO_RESET){
     require("conns.php");
      

      // Ultimo lote ingresado en tabla de pesaje
      $sql = "SELECT COUNT(QT_PESO_LIQUIDO) AS 'pz', SUM(qt_peso_liquido) AS 'kg'
          FROM LK_PESAGEM
          WHERE CD_PONTO = $CD_PONTO AND NR_SAIDA = $NR_SAIDA AND ID_STATUS = 0
          AND DT_PESAGEM > '$DT_PESAGEM_ULTIMO_RESET'";
          
      $stmt = sqlsrv_query( $conn, $sql );

      if( $stmt === false) {
          die( print_r( sqlsrv_errors(), true) );
      }
        
      $tempTotal = array("pz" => "", "kg" => "");
      while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        $tempTotal["pz"] = $row["pz"];
        $tempTotal["kg"] = $row["kg"];
        }

      sqlsrv_free_stmt( $stmt);
      sqlsrv_close($conn);

      return $tempTotal;
    }

    // Devuelve un array con total de piezas y kilos según el id de balanza (CD_PONTO),
    // el lote (CD_LOTE) y la fecha inicial indicada (DT_PESAGEM_INICIAL)
    function getTotalPzKg($CD_PONTO, $CD_LOTE, $DT_PESAGEM_INICIAL){
       require("conns.php");


      $arrayTotalPzKg = array('pz' => '', 'kg' => '');

      $sql = "SELECT count(qt_peso_liquido) as 'pz', sum(qt_peso_liquido) as 'kg'
          FROM lk_pesagem
          WHERE cd_ponto = $CD_PONTO
          AND cd_lote = '$CD_LOTE'
          AND dt_pesagem >= '$DT_PESAGEM_INICIAL'";

      $stmt = sqlsrv_query( $conn, $sql );

      if( $stmt === false) {
          die( print_r( sqlsrv_errors(), true) );
      }

      while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        $arrayTotalPzKg["pz"] = $row["pz"];
        $arrayTotalPzKg["kg"] = $row["kg"];
      } 

      sqlsrv_free_stmt( $stmt);
      sqlsrv_close($conn);

      return $arrayTotalPzKg;
    }


    // Para información de total kilos en barra superior
    function sumaPiezasKilos($CD_PONTO, $DT_PESAGEM_INICIAL){
  require("conns.php");
      

      $totalPzKg = array('piezas' => '', 'kilos' => '');

      $sql = "SELECT count(qt_peso_liquido) as 'pz', sum(qt_peso_liquido) as 'kg'
          FROM lk_pesagem
          WHERE cd_ponto = $CD_PONTO
          AND dt_pesagem >= '$DT_PESAGEM_INICIAL'";

      $stmt = sqlsrv_query( $conn, $sql );

      if( $stmt === false) {
          die( print_r( sqlsrv_errors(), true) );
      }

      while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        $totalPzKg["piezas"] = $row["pz"];
        $totalPzKg["kilos"] = $row["kg"];
      } 

      sqlsrv_free_stmt( $stmt);
      sqlsrv_close($conn);

      return $totalPzKg;
    }

    // Segundos de Refresh

    
    // Setea sólo una vez los parámetros de sesión
    if(isset($isFirst)) {
      // Id de balanza "CD_PONTO"
      $_SESSION["current"] = $CD_PONTO1;

      echo $_SESSION["current"];
      echo $_SESSION["current"];
      echo $_SESSION["current"];
      echo $_SESSION["current"];
      echo $_SESSION["current"];


      // Fecha y hora de inicio de conteo
      $_SESSION["fecha_inicial_get"] = $fecha_inicial;  
      $_SESSION["fecha_inicial"] = str_replace(' ', '', 
                     substr($_SESSION["fecha_inicial_get"] . ":00.000", 0, 10) . 'T' . 
                     substr($_SESSION["fecha_inicial_get"] . ":00.000", 10, 22));

      // Obtiene cantidad de brazos
      $_SESSION["cantidadBrazos"] = getCantidadBrazos($_SESSION["current"]);

      // Dotación brazo - Línea 4
      if(isset($inputBrazo1)) 
        $_SESSION["dotacionBrazo1"] = $inputBrazo1;
      else
        $_SESSION["dotacionBrazo1"] = "{No records}";
      
      // Dotación brazo 2 - Línea 3
      if(isset($inputBrazo2)) 
        $_SESSION["dotacionBrazo2"] = $inputBrazo2;
      else
        $_SESSION["dotacionBrazo2"] = "{No records}";

      // Dotación brazo 3 - Línea 2   
      if(isset($inputBrazo3)) 
        $_SESSION["dotacionBrazo3"] = $inputBrazo3;
      else
        $_SESSION["dotacionBrazo3"] = "{No records}";

      // Dotación brazo 4 - Línea 1     
      if(isset($inputBrazo4))
        $_SESSION["dotacionBrazo4"] = $inputBrazo4;
      else
        $_SESSION["dotacionBrazo4"] = "{No records}";

      // Variable de sesión para calculo de productividad ultima hora
      $_SESSION["piezasUltHrBrazo1"] = 0;
      $_SESSION["piezasUltHrBrazo2"] = 0;
      $_SESSION["piezasUltHrBrazo3"] = 0;
      $_SESSION["piezasUltHrBrazo4"] = 0;

      $_SESSION["totalBrazo1"]["piezas"] = 0;
      $_SESSION["totalBrazo2"]["piezas"] = 0;
      $_SESSION["totalBrazo3"]["piezas"] = 0;
      $_SESSION["totalBrazo4"]["piezas"] = 0;

      $_SESSION["totalBrazo1"]["kilos"] = 0;
      $_SESSION["totalBrazo2"]["kilos"] = 0;
      $_SESSION["totalBrazo3"]["kilos"] = 0;
      $_SESSION["totalBrazo4"]["kilos"] = 0;

      $_SESSION["totalPzHHL1"] = 0;
      $_SESSION["totalPzHHL2"] = 0;
      $_SESSION["totalPzHHL3"] = 0;
      $_SESSION["totalPzHHL4"] = 0;

      $_SESSION["contratista"] = $contratista;





}else {     
    } 

echo "<div style='height:1000px;'>";
echo "<div id='main-wrapper'>";
  echo "<div id='logo-cliente'>";
     echo "<img src='logo_cbay.png' />";
    echo "</div>";
    

        // Llama función para mostrar información de brazos, además crea box.
        getInfo($_SESSION["current"], $_SESSION["cantidadBrazos"], $_SESSION["fecha_inicial"]);
      
   
 echo "</div>";
 echo "</div>";
 

                break;
            default:
                echo "Error: Falta una acción";
        }
    }







 ?>

