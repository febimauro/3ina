<!-- Indice Yacine Boussoufa 5INB 22/09/2021 -->
<!DOCTYPE html>
<html lang="it">
	<head>  <!-- Intestazione --> 
		<title>Boussoufa Yacine</title> <!-- Titolo visibile nella barra del titolo -->
		<!--	<meta charset="UTF-8">	-->
		<!-- Descrizione sito, Parole chiavi e autore per l'indicizzazione -->
		<meta name="description" content="LezioneTPSIT">
		<meta name="keywords" content="HTML">
		<meta name="author" content="BoussoufaYacine">
		<!-- Collegamento a CSS esterno -->
		<link rel="stylesheet" href="css\bootstrap.css">	<!-- Incorporamento foglio di stile bootstrap -->
		<link rel="stylesheet" href="css\stile.css">	<!-- Incorporamento foglio di stile personalizzato		-->
	</head>
	
	<body>
	
		<div class="container-fluid"> 
			<div class="row">		<!-- Prima riga piena-->
				<div class="col-md-12-1">
					<!-- Inclusione tramite php del file header.php presente nella cartella inc -->
					<?php require 'inc/header.php';?>	
				</div>
			</div>
			
			<div class="row">		<!-- Seconda riga divisa in due colonne-->
				<div class="col-md-3-1">		<!-- Prima colonna  -->
					<!-- Inclusione tramite php del file menu.php presente nella cartella inc -->
					<?php require 'inc/menu.php';?>
				</div>
				<div class="col-md-9-1">		<!-- Seconda colonna -->	
				<p>
					<?php
						//1: Parametri di connessione
					
						require 'inc/db_config.php';	//Richiesta pagina php con dati di configurazione
						$db_host=DB_HOST;	//Assegnazione alla variabile, il valore dell'host preso dal file di configurazione
						$db_user=DB_USER;	//Assegnazione alla variabile, il valore dell'username preso dal file di configurazione
						$db_password=DB_PASSWORD;	//Assegnazione alla variabile, il valore della password preso dal file di configurazione
						$db_name=DB_NAME;	//Assegnazione alla variabile, il valore del nome del database preso dal file di configurazione

						//2: Connessione al db
						$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

						//Controllo connessione e stampo messaggio di errore
						if (mysqli_connect_errno())
						{
							echo "Errore in fase di connessione" . mysqli_connect_errno();
							exit();	//Uscita
						}
	
						$query= 'SELECT * FROM w005_users ORDER BY user_registered ASC';	//Query utente	

						$result = mysqli_query($conn,$query);	//Assegnazione a risultato un vettore con i valori richiesti dalla query 

						//Stampa tabella
						echo '<table class=tabella id="Ordina">';
							echo '<tr>';
								echo '<th onclick="sortTable(0)"> Username </th>';	//Funzione onclick javascript per l'ordinamento
								echo '<th onclick="sortTable(1)"> Email </th>';
								echo '<th onclick="sortTable(2)"> Data iscrizione </th>';
							echo "</tr>";
								
						while($row = mysqli_fetch_assoc($result))	//Per ogni riga stampo il valore dell'array associativo
						{
							echo "<tr>";
								echo "<td>".$row['user_login']."</td>";
								echo "<td>".$row['user_email']."</td>";
								echo "<td>".$row['user_registered']."</td>";
							echo "</tr>";
						}
						echo "</table>";	//Fine tabella
						mysqli_close($conn);	//Chiusura connessione
					?>
				</p>
				</div>
			</div>
			<div class="row">		<!-- Terza riga piena-->
				<div class="col-md-12-1">
					<!-- Inclusione tramite php del file footer.php presente nella cartella inc -->
					<?php require 'inc/footer.php';?>
				</div>
			</div>
		</div>
	
	</body>
	<script>	//Script Javascript
		function sortTable(n)	//Funzione per l'ordinamento
		{
		  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
		  table = document.getElementById("Ordina");
		  switching = true;
		  // Direzione ascendente:
		  dir = "asc";
		  // Loop finchè lo switch non finisce l'esecuzione
		  while (switching)
		  {
			// Start by saying: no switching is done:
			switching = false;
			rows = table.rows;
			/* Loop through all table rows (except the
			first, which contains table headers): */
			for (i = 1; i < (rows.length - 1); i++) {
			  // Start by saying there should be no switching:
			  shouldSwitch = false;
			  /* Get the two elements you want to compare,
			  one from current row and one from the next: */
			  x = rows[i].getElementsByTagName("TD")[n];
			  y = rows[i + 1].getElementsByTagName("TD")[n];
			  /* Check if the two rows should switch place,
			  based on the direction, asc or desc: */
			  if (dir == "asc") {
				if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
				  // If so, mark as a switch and break the loop:
				  shouldSwitch = true;
				  break;
				}
			  } else if (dir == "desc") {
				if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
				  // If so, mark as a switch and break the loop:
				  shouldSwitch = true;
				  break;
				}
			  }
			}
			if (shouldSwitch) {
			  /* If a switch has been marked, make the switch
			  and mark that a switch has been done: */
			  rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
			  switching = true;
			  // Each time a switch is done, increase this count by 1:
			  switchcount ++;
			} else {
			  /* If no switching has been done AND the direction is "asc",
			  set the direction to "desc" and run the while loop again. */
			  if (switchcount == 0 && dir == "asc") {
				dir = "desc";
				switching = true;
			  }
			}
		  }
		}
	</script>
</html>