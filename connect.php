<?php 

	include ('classes/Conexion.class.php');

	if (class_exists('Conexion')) {
	    $pdo = new Conexion();
	}

	try{

		$query = $pdo->prepare("SELECT * FROM tables");
		$query->execute();

			$table= '<table>
						<thead>
							<tr>
								<th>Table Name</th>
								<th>Table Type</th>
								<th>Engine</th>
								<th>Length</th>
							</tr>
						</thead><tbody>';
			while ( $result = $query->fetch(PDO::FETCH_ASSOC)) {
				//print_r($result);
				$table.='<tr>
							<td>'.$result['TABLE_NAME'].'</td>
							<td>'.$result['TABLE_TYPE'].'</td>
							<td>'.$result['ENGINE'].'</td>
							<td>'.$result['DATA_LENGTH'].'</td>
						</tr>';
			}
			$table.='</tbody></table>';
			echo $table;
		
	} catch (PDOException $e){
		echo '<b>Error de Sintaxis SQL</b>';
		echo '<br> Detalle del Error: ' .$e->getMessage(); 
	}

?>