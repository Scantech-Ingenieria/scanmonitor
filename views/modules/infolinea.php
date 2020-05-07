<?php

		
		// Cuenta la cantidad de brazos de una balanza, según su id (CD_PONTO) 
		function getCantidadBrazos($CD_PONTO) {
			require("connection.php");

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

			require("connection.php");

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

			//while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ) {
			//	if(is_null($row) === true) {echo "a";}
				/*if($row['DT_PESAGEM'] <> "")
					$result = $row['DT_PESAGEM']->format('Y-m-d\TH:i:s.000');
				else
					$result = "{no data}";*/
			//}

			sqlsrv_free_stmt($stmt);
			sqlsrv_close($conn);

			return $result;
		}
		
		// Muestra información de piezas y kilos de cada brazos, según id de balanza (CD_PONTO)
		// y a partir de la fecha inicial indicada (DT_PESAGEM_INICIAL)
		function getInfo($CD_PONTO, $NR_SAIDA, $DT_PESAGEM_INICIAL){
			require("connection.php");

			$numBrazos = $NR_SAIDA;

			// Crea arrays individuales para cada brazo sólo la primera vez que la pagina carga
			if(isset($_GET['isFirst'])){
				// Deben ser arrays de sesion para poder imprimir solo el valor y no todo...
				for($a = 1; $a <= $numBrazos; $a++)
					$_SESSION["totalBrazo" . $a] = array('piezas' => '0', 'kilos' => '0', 'status' => 'false', 'ultimopesaje' => '');			
			}/*else {
				// Usuario hizo click en reset, por lo tanto reinicia arrays con totales de piezas y kilos
				// según numero de brazo
				// guarda hora de ultimo pesaje según lote..
				// variable status cambia a true (por defecto false)

				if(isset($_GET["reset"])) {
					$_SESSION["totalBrazo" . $_GET["reset"]]["piezas"] = "0";
					$_SESSION["totalBrazo" . $_GET["reset"]]["kilos"] = "0";
					$_SESSION["totalBrazo" . $_GET["reset"]]["status"] = "true";					
					$_SESSION["totalBrazo" . $_GET["reset"]]["ultimopesaje"] = getHoraUltimoPesaje($_SESSION["current"], $_GET["reset"]);					
				}
			}*/

	echo "<table style='height:100%;'>
			<tr>
		        <td><a href='info.php'><img src='logo_cbay.png' style='width: 20vw;'></a></td>
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

			// $i = n° línea, 4=L1 - 3=L2 - 2=L3 - 1=L4
			switch ($i) {	
				case 4:
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
		    	break;
		    	case 3:
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
		        	/*if($_SESSION["totalBrazo" . $i]["kilos"] <> "")
							echo number_format($_SESSION["totalBrazo" . $i]["kilos"]);
						else
							echo "0";*/
		      echo "</label>
		        </td>
		    </tr>
		    <tr>";
		    	break;
		    	case 2:
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
							echo "0";	*/	        	
		      echo "</label>
		        </td>
		    </tr>
		    <tr>";
		    	break;
		    	case 1:
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
				break;
			}
			
				/*switch ($_SESSION["totalBrazo" . $i]["status"]) {
				    case "true": //fue reseteado
				        if($indivualInfoReset["pz"] <> "")
							echo "<label>Piezas: " . number_format($indivualInfoReset["pz"]) . "</label>";
						else
							echo "<label>Piezas: 0</label>";

						echo "</div>";
						echo "<div class='box-brazo-total'>";
						
						if($indivualInfoReset["kg"] <> "")
							echo "<label>Kg: " . number_format($indivualInfoReset["kg"]) . "</label>";
							//echo "<label>Kg: " . round($indivualInfoReset["kg"], 2) . "</label>";
						else
							echo "<label>Kg: 0</label>";

				        break;
				    case "false": //No ha sido reseteado*/
						
						

				        /*break;
				}*/

				sqlsrv_free_stmt( $stmt);		
			}	
			echo "</table>";
			
			sqlsrv_close($conn);
		}

		function printIndividualBrazo($CD_PONTO, $NR_SAIDA, $DT_PESAGEM_ULTIMO_RESET){
			require("connection.php");

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
			require("connection.php");

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

		// Muestra información al instante del lote actual y busca los ultimos 5 lotes a partir del actual
		/*function getInfoLotes($CD_PONTO){
			require("connection.php");

			// Ultimo lote ingresado en tabla de pesaje
			$sql = "SELECT TOP 1 CD_LOTE
					FROM LK_PESAGEM
					WHERE CD_PONTO = $CD_PONTO
					ORDER BY CD_PESAGEM DESC";

			$stmt = sqlsrv_query( $conn, $sql );

			if( $stmt === false) {
		    	die( print_r( sqlsrv_errors(), true) );
			}

			while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
				$_SESSION["infoLoteActual"] = $row["CD_LOTE"]; // Lote actual
			}

			// A partir de lote actual, muestra lotes antiguos
			$_SESSION["infoUltimosLotes"] = infoUltimosLotes($CD_PONTO, 
															 $_SESSION["infoLoteActual"], 
															 $_SESSION["fecha_inicial"]);
			
			sqlsrv_free_stmt( $stmt);
			sqlsrv_close($conn);

			return $_SESSION["infoLoteActual"];
			//print_r($_SESSION["infoUltimosLotes"]);
		}*/

		// Devuelve en array ultimos lotes a partir del lote actual, id de balanza y fecha inicial
		/*function infoUltimosLotes($CD_PONTO, $CD_LOTE_ACTUAL, $DT_PESAGEM_INICIAL){
			require("connection.php");

			$sql = "SELECT TOP " . cuentaPesajesAntesDeCambioDeLote($CD_PONTO, $CD_LOTE_ACTUAL, $DT_PESAGEM_INICIAL) . " CD_LOTE
					FROM lk_pesagem
					WHERE cd_ponto = $CD_PONTO
					AND DT_PESAGEM >= '$DT_PESAGEM_INICIAL'
					AND CD_LOTE != '$CD_LOTE_ACTUAL'
					ORDER BY CD_PESAGEM DESC";

			$stmt = sqlsrv_query( $conn, $sql );

			if( $stmt === false) {
		    	die( print_r( sqlsrv_errors(), true) );
			}
				
			$lotesResult = array();
			
			$a = 0;
			while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
				array_push($lotesResult, $row["CD_LOTE"]); // Ultimos 5 lotes anteriores 
			}

			sqlsrv_free_stmt( $stmt);
			sqlsrv_close($conn);
			
			return array_unique($lotesResult);
		}*/

		/*function cuentaPesajesAntesDeCambioDeLote($CD_PONTO, $CD_LOTE_ACTUAL, $DT_PESAGEM_INICIAL){
			require("connection.php");

			$sql = "SELECT COUNT(CD_PESAGEM) as topValue
					FROM lk_pesagem
					WHERE cd_ponto = $CD_PONTO
					AND DT_PESAGEM >= '$DT_PESAGEM_INICIAL'
					AND CD_LOTE != '$CD_LOTE_ACTUAL'";

			$stmt = sqlsrv_query( $conn, $sql );

			if( $stmt === false) {
		    	die( print_r( sqlsrv_errors(), true) );
			}
				
			while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
				$result = $row["topValue"];
			}

			sqlsrv_free_stmt( $stmt);
			sqlsrv_close($conn);
			
			return $result;
		}*/

		/*function getHoraUltimoPesaje($CD_PONTO, $NR_SAIDA){
			require("connection.php");

			$sql = "SELECT TOP 1 DT_PESAGEM
				FROM LK_PESAGEM
				WHERE cd_ponto = $CD_PONTO
				AND NR_SAIDA = $NR_SAIDA
				ORDER BY CD_PESAGEM DESC";

			$stmt = sqlsrv_query( $conn, $sql );

			if( $stmt === false) {
		    	die( print_r( sqlsrv_errors(), true) );
			}

			//if($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) === NULL) 
				//$result = "2999-12-31T00:00:00.000"; //NADA
			//else
			//	$result = $row["DT_PESAGEM"]->format('Y-m-d\TH:i:s.000');
			
			while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
				if($row <> NULL)
				//if($row["DT_PESAGEM"] <> "NULL")
				$result = $row["DT_PESAGEM"]->format('Y-m-d\TH:i:s.000');
				else
					echo "no hay pesajes asociados a este brazo";
			}

			sqlsrv_free_stmt( $stmt);
			sqlsrv_close($conn);

			return $result;
		}*/


		// Para información de total kilos en barra superior
		function sumaPiezasKilos($CD_PONTO, $DT_PESAGEM_INICIAL){
			require("connection.php");

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
		$sec = "10";
		
		// Setea sólo una vez los parámetros de sesión
		if(isset($_GET['isFirst'])) {
			// Id de balanza "CD_PONTO"
			$_SESSION["current"] = $_GET["CD_PONTO"];

			// Fecha y hora de inicio de conteo
			$_SESSION["fecha_inicial_get"] = $_GET['fecha_inicial'];	
			$_SESSION["fecha_inicial"] = str_replace(' ', '', 
										 substr($_SESSION["fecha_inicial_get"] . ":00.000", 0, 10) . 'T' . 
										 substr($_SESSION["fecha_inicial_get"] . ":00.000", 10, 22));

			// Obtiene cantidad de brazos
			$_SESSION["cantidadBrazos"] = getCantidadBrazos($_SESSION["current"]);

			// Dotación brazo - Línea 4
			if(isset($_GET["inputBrazo1"])) 
				$_SESSION["dotacionBrazo1"] = $_GET["inputBrazo1"];
			else
				$_SESSION["dotacionBrazo1"] = "{No records}";
			
			// Dotación brazo 2 - Línea 3
			if(isset($_GET["inputBrazo2"])) 
				$_SESSION["dotacionBrazo2"] = $_GET["inputBrazo2"];
			else
				$_SESSION["dotacionBrazo2"] = "{No records}";

			// Dotación brazo 3	- Línea 2		
			if(isset($_GET["inputBrazo3"])) 
				$_SESSION["dotacionBrazo3"] = $_GET["inputBrazo3"];
			else
				$_SESSION["dotacionBrazo3"] = "{No records}";

			// Dotación brazo 4 - Línea 1			
			if(isset($_GET["inputBrazo4"]))
				$_SESSION["dotacionBrazo4"] = $_GET["inputBrazo4"];
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

			$_SESSION["contratista"] = $_GET["inputContratista"];

			/*unset($_SESSION["infoLoteActual"]);	
			unset($_SESSION["infoUltimosLotes"]);
			unset($_SESSION["resetInfoBrazo"]);*/



		}

?>

<!-- Código HTML -->
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="processinfo.css">
		<script src="plugins/jquery-3.2.1.min.js"></script>

	</head>
<body>
	<div id="main-wrapper">
		<!-- Header info
		<div id="header-info">
			<div id="info-actual">
				<div id="info-actual-lote">
					<label>SALA: FILETE</label>
				</div>
				<div id="info-totales">
					<?php
						/*
						$totalPzKg = sumaPiezasKilos($_SESSION["current"], $_SESSION["fecha_inicial"]);

						echo "
						<label>
							PIEZAS: <strong>". number_format($totalPzKg['piezas']) ."</strong>
						</label>
						<label>|</label>
						<label>
							KG: <strong>". number_format($totalPzKg['kilos']) ."</strong>
						</label>";
						*/
					?>
				</div>
				<div id="info-actual-brazos-title">
					<label>Inicio de turno: <strong><?php //echo $_SESSION["fecha_inicial_get"]; ?></strong></label> 
				</div>
			</div>
			<div id="link-volver">
				<a href="info.php" title="Volver"><</a>
			</div>
		</div>
		Fin header info -->
	
		<div id="logo-cliente">
			<img src="logo_cbay.png" />
		</div>
		
		<!--<div id="main-info-wrapper">-->
			<?php
				// Llama función para mostrar información de brazos, además crea box.
				getInfo($_SESSION["current"], $_SESSION["cantidadBrazos"], $_SESSION["fecha_inicial"]);
			?>	
		<!--</div>-->
	</div>
	
	<!--<div id="footer">
		<div style="position:relative; top:2;">
			<label>
				<?php 		
					/*$strStart = $_SESSION["fecha_inicial"]; 
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

			   		echo date_format($dteStart, "d") . " de " . $mesTexto . " desde las " . date_format($dteStart, "h:i") . " - Contratista: " . $_SESSION["contratista"];*/
				?>
			</label>
		</div>
	</div>-->
</body>
</html>
<?php

		
		// Cuenta la cantidad de brazos de una balanza, según su id (CD_PONTO) 
		function getCantidadBrazos($CD_PONTO) {
			require("connection.php");

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

			require("connection.php");

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

			//while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ) {
			//	if(is_null($row) === true) {echo "a";}
				/*if($row['DT_PESAGEM'] <> "")
					$result = $row['DT_PESAGEM']->format('Y-m-d\TH:i:s.000');
				else
					$result = "{no data}";*/
			//}

			sqlsrv_free_stmt($stmt);
			sqlsrv_close($conn);

			return $result;
		}
		
		// Muestra información de piezas y kilos de cada brazos, según id de balanza (CD_PONTO)
		// y a partir de la fecha inicial indicada (DT_PESAGEM_INICIAL)
		function getInfo($CD_PONTO, $NR_SAIDA, $DT_PESAGEM_INICIAL){
			require("connection.php");

			$numBrazos = $NR_SAIDA;

			// Crea arrays individuales para cada brazo sólo la primera vez que la pagina carga
			if(isset($_GET['isFirst'])){
				// Deben ser arrays de sesion para poder imprimir solo el valor y no todo...
				for($a = 1; $a <= $numBrazos; $a++)
					$_SESSION["totalBrazo" . $a] = array('piezas' => '0', 'kilos' => '0', 'status' => 'false', 'ultimopesaje' => '');			
			}/*else {
				// Usuario hizo click en reset, por lo tanto reinicia arrays con totales de piezas y kilos
				// según numero de brazo
				// guarda hora de ultimo pesaje según lote..
				// variable status cambia a true (por defecto false)

				if(isset($_GET["reset"])) {
					$_SESSION["totalBrazo" . $_GET["reset"]]["piezas"] = "0";
					$_SESSION["totalBrazo" . $_GET["reset"]]["kilos"] = "0";
					$_SESSION["totalBrazo" . $_GET["reset"]]["status"] = "true";					
					$_SESSION["totalBrazo" . $_GET["reset"]]["ultimopesaje"] = getHoraUltimoPesaje($_SESSION["current"], $_GET["reset"]);					
				}
			}*/

	echo "<table style='height:100%;'>
			<tr>
		        <td><a href='info.php'><img src='logo_cbay.png' style='width: 20vw;'></a></td>
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

			// $i = n° línea, 4=L1 - 3=L2 - 2=L3 - 1=L4
			switch ($i) {	
				case 4:
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
		    	break;
		    	case 3:
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
		        	/*if($_SESSION["totalBrazo" . $i]["kilos"] <> "")
							echo number_format($_SESSION["totalBrazo" . $i]["kilos"]);
						else
							echo "0";*/
		      echo "</label>
		        </td>
		    </tr>
		    <tr>";
		    	break;
		    	case 2:
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
							echo "0";	*/	        	
		      echo "</label>
		        </td>
		    </tr>
		    <tr>";
		    	break;
		    	case 1:
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
				break;
			}
			
				/*switch ($_SESSION["totalBrazo" . $i]["status"]) {
				    case "true": //fue reseteado
				        if($indivualInfoReset["pz"] <> "")
							echo "<label>Piezas: " . number_format($indivualInfoReset["pz"]) . "</label>";
						else
							echo "<label>Piezas: 0</label>";

						echo "</div>";
						echo "<div class='box-brazo-total'>";
						
						if($indivualInfoReset["kg"] <> "")
							echo "<label>Kg: " . number_format($indivualInfoReset["kg"]) . "</label>";
							//echo "<label>Kg: " . round($indivualInfoReset["kg"], 2) . "</label>";
						else
							echo "<label>Kg: 0</label>";

				        break;
				    case "false": //No ha sido reseteado*/
						
						

				        /*break;
				}*/

				sqlsrv_free_stmt( $stmt);		
			}	
			echo "</table>";
			
			sqlsrv_close($conn);
		}

		function printIndividualBrazo($CD_PONTO, $NR_SAIDA, $DT_PESAGEM_ULTIMO_RESET){
			require("connection.php");

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
			require("connection.php");

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

		// Muestra información al instante del lote actual y busca los ultimos 5 lotes a partir del actual
		/*function getInfoLotes($CD_PONTO){
			require("connection.php");

			// Ultimo lote ingresado en tabla de pesaje
			$sql = "SELECT TOP 1 CD_LOTE
					FROM LK_PESAGEM
					WHERE CD_PONTO = $CD_PONTO
					ORDER BY CD_PESAGEM DESC";

			$stmt = sqlsrv_query( $conn, $sql );

			if( $stmt === false) {
		    	die( print_r( sqlsrv_errors(), true) );
			}

			while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
				$_SESSION["infoLoteActual"] = $row["CD_LOTE"]; // Lote actual
			}

			// A partir de lote actual, muestra lotes antiguos
			$_SESSION["infoUltimosLotes"] = infoUltimosLotes($CD_PONTO, 
															 $_SESSION["infoLoteActual"], 
															 $_SESSION["fecha_inicial"]);
			
			sqlsrv_free_stmt( $stmt);
			sqlsrv_close($conn);

			return $_SESSION["infoLoteActual"];
			//print_r($_SESSION["infoUltimosLotes"]);
		}*/

		// Devuelve en array ultimos lotes a partir del lote actual, id de balanza y fecha inicial
		/*function infoUltimosLotes($CD_PONTO, $CD_LOTE_ACTUAL, $DT_PESAGEM_INICIAL){
			require("connection.php");

			$sql = "SELECT TOP " . cuentaPesajesAntesDeCambioDeLote($CD_PONTO, $CD_LOTE_ACTUAL, $DT_PESAGEM_INICIAL) . " CD_LOTE
					FROM lk_pesagem
					WHERE cd_ponto = $CD_PONTO
					AND DT_PESAGEM >= '$DT_PESAGEM_INICIAL'
					AND CD_LOTE != '$CD_LOTE_ACTUAL'
					ORDER BY CD_PESAGEM DESC";

			$stmt = sqlsrv_query( $conn, $sql );

			if( $stmt === false) {
		    	die( print_r( sqlsrv_errors(), true) );
			}
				
			$lotesResult = array();
			
			$a = 0;
			while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
				array_push($lotesResult, $row["CD_LOTE"]); // Ultimos 5 lotes anteriores 
			}

			sqlsrv_free_stmt( $stmt);
			sqlsrv_close($conn);
			
			return array_unique($lotesResult);
		}*/

		/*function cuentaPesajesAntesDeCambioDeLote($CD_PONTO, $CD_LOTE_ACTUAL, $DT_PESAGEM_INICIAL){
			require("connection.php");

			$sql = "SELECT COUNT(CD_PESAGEM) as topValue
					FROM lk_pesagem
					WHERE cd_ponto = $CD_PONTO
					AND DT_PESAGEM >= '$DT_PESAGEM_INICIAL'
					AND CD_LOTE != '$CD_LOTE_ACTUAL'";

			$stmt = sqlsrv_query( $conn, $sql );

			if( $stmt === false) {
		    	die( print_r( sqlsrv_errors(), true) );
			}
				
			while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
				$result = $row["topValue"];
			}

			sqlsrv_free_stmt( $stmt);
			sqlsrv_close($conn);
			
			return $result;
		}*/

		/*function getHoraUltimoPesaje($CD_PONTO, $NR_SAIDA){
			require("connection.php");

			$sql = "SELECT TOP 1 DT_PESAGEM
				FROM LK_PESAGEM
				WHERE cd_ponto = $CD_PONTO
				AND NR_SAIDA = $NR_SAIDA
				ORDER BY CD_PESAGEM DESC";

			$stmt = sqlsrv_query( $conn, $sql );

			if( $stmt === false) {
		    	die( print_r( sqlsrv_errors(), true) );
			}

			//if($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) === NULL) 
				//$result = "2999-12-31T00:00:00.000"; //NADA
			//else
			//	$result = $row["DT_PESAGEM"]->format('Y-m-d\TH:i:s.000');
			
			while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
				if($row <> NULL)
				//if($row["DT_PESAGEM"] <> "NULL")
				$result = $row["DT_PESAGEM"]->format('Y-m-d\TH:i:s.000');
				else
					echo "no hay pesajes asociados a este brazo";
			}

			sqlsrv_free_stmt( $stmt);
			sqlsrv_close($conn);

			return $result;
		}*/


		// Para información de total kilos en barra superior
		function sumaPiezasKilos($CD_PONTO, $DT_PESAGEM_INICIAL){
			require("connection.php");

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
		$sec = "10";
		
		// Setea sólo una vez los parámetros de sesión
		if(isset($_GET['isFirst'])) {
			// Id de balanza "CD_PONTO"
			$_SESSION["current"] = $_GET["CD_PONTO"];

			// Fecha y hora de inicio de conteo
			$_SESSION["fecha_inicial_get"] = $_GET['fecha_inicial'];	
			$_SESSION["fecha_inicial"] = str_replace(' ', '', 
										 substr($_SESSION["fecha_inicial_get"] . ":00.000", 0, 10) . 'T' . 
										 substr($_SESSION["fecha_inicial_get"] . ":00.000", 10, 22));

			// Obtiene cantidad de brazos
			$_SESSION["cantidadBrazos"] = getCantidadBrazos($_SESSION["current"]);

			// Dotación brazo - Línea 4
			if(isset($_GET["inputBrazo1"])) 
				$_SESSION["dotacionBrazo1"] = $_GET["inputBrazo1"];
			else
				$_SESSION["dotacionBrazo1"] = "{No records}";
			
			// Dotación brazo 2 - Línea 3
			if(isset($_GET["inputBrazo2"])) 
				$_SESSION["dotacionBrazo2"] = $_GET["inputBrazo2"];
			else
				$_SESSION["dotacionBrazo2"] = "{No records}";

			// Dotación brazo 3	- Línea 2		
			if(isset($_GET["inputBrazo3"])) 
				$_SESSION["dotacionBrazo3"] = $_GET["inputBrazo3"];
			else
				$_SESSION["dotacionBrazo3"] = "{No records}";

			// Dotación brazo 4 - Línea 1			
			if(isset($_GET["inputBrazo4"]))
				$_SESSION["dotacionBrazo4"] = $_GET["inputBrazo4"];
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

			$_SESSION["contratista"] = $_GET["inputContratista"];

			/*unset($_SESSION["infoLoteActual"]);	
			unset($_SESSION["infoUltimosLotes"]);
			unset($_SESSION["resetInfoBrazo"]);*/



		}

?>

<!-- Código HTML -->
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="processinfo.css">
		<script src="plugins/jquery-3.2.1.min.js"></script>

	</head>
<body>
	<div id="main-wrapper">
		<!-- Header info
		<div id="header-info">
			<div id="info-actual">
				<div id="info-actual-lote">
					<label>SALA: FILETE</label>
				</div>
				<div id="info-totales">
					<?php
						/*
						$totalPzKg = sumaPiezasKilos($_SESSION["current"], $_SESSION["fecha_inicial"]);

						echo "
						<label>
							PIEZAS: <strong>". number_format($totalPzKg['piezas']) ."</strong>
						</label>
						<label>|</label>
						<label>
							KG: <strong>". number_format($totalPzKg['kilos']) ."</strong>
						</label>";
						*/
					?>
				</div>
				<div id="info-actual-brazos-title">
					<label>Inicio de turno: <strong><?php //echo $_SESSION["fecha_inicial_get"]; ?></strong></label> 
				</div>
			</div>
			<div id="link-volver">
				<a href="info.php" title="Volver"><</a>
			</div>
		</div>
		Fin header info -->
	
		<div id="logo-cliente">
			<img src="logo_cbay.png" />
		</div>
		
		<!--<div id="main-info-wrapper">-->
			<?php
				// Llama función para mostrar información de brazos, además crea box.
				getInfo($_SESSION["current"], $_SESSION["cantidadBrazos"], $_SESSION["fecha_inicial"]);
			?>	
		<!--</div>-->
	</div>
	
	<!--<div id="footer">
		<div style="position:relative; top:2;">
			<label>
				<?php 		
					/*$strStart = $_SESSION["fecha_inicial"]; 
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

			   		echo date_format($dteStart, "d") . " de " . $mesTexto . " desde las " . date_format($dteStart, "h:i") . " - Contratista: " . $_SESSION["contratista"];*/
				?>
			</label>
		</div>
	</div>-->
</body>
</html>