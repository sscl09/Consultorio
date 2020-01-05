<?php
  session_start();
  $titulo = "Consultorio Pediátrico";
  echo $_POST['id-paciente'];
  require_once('Parciales/arriba.php');
  require_once('Parciales/nav.php');
  //require_once('Recursos/conexion.php');
?>
	<div class=".map-responsive">
		 <center>
			<div>
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3764.7503358543563!2d-99.05591218509483!3d19.336637086938918!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85ce028722647b45%3A0xfd08c5e8c695584b!2sEl%20Vergel%2C%20La%20Era%20I%20y%20II%2C%20Ciudad%20de%20M%C3%A9xico%2C%20CDMX!5e0!3m2!1ses-419!2smx!4v1578012855588!5m2!1ses-419!2smx" width="600" height="450" frameborder="0" allowfullscreen="" class="mapa"></iframe>
			</div>
			<div>
				<div class="espacio">
					<p><h5>Av. Vergel Mz. 13 Lt. 8 Col. La Hera, Iztapalapa CDMX C.P. 09720</h2></p>
				</div>
				<div>
					<p><h5>Tel. 2608 8778</h2></p>
				</div>
			</div>
		</center>
	</div>
<?php
  require_once('Parciales/abajo.php');
  require_once('Parciales/footer.php');

?>
