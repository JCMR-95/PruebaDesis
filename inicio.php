<!DOCTYPE html>
<html>
<head>
	<title>Formulario de Votación</title>
	<style>
		form {
			display: flex;
			flex-direction: column;
			align-items: flex-start;
			margin: 0 auto;
		}

		label {
			display: block;
			font-weight: bold;
			margin-bottom: 0.5rem;
			width: 120px;
			text-align: left;
			margin-right: 10px;
		}

		input[type="text"],
		input[type="email"]{
			padding: 0.5rem;
			margin-bottom: 1rem;
			border-radius: 3px;
			border: 1px solid #ccc;
			width: 283px;
		}

		select {
			padding: 0.5rem;
			margin-bottom: 1rem;
			border-radius: 3px;
			border: 1px solid #ccc;
			width: 300px;

		}

		input[type="submit"] {
			background-color: #007bff;
			color: #fff;
			border: none;
			padding: 0.5rem 1rem;
			border-radius: 3px;
			cursor: pointer;
		}

		input[type="submit"]:hover {
			background-color: #0069d9;
		}

		input:invalid {
			border-color: red;
		}

		label {
			font-weight: bold;
			display: inline-block;
			width: 120px;
			text-align: left;
			margin-right: 10px;
			margin-bottom: 0.5rem;
		}

	</style>
</head>
<body>
	
	<h1>Formulario de Votación</h1>

	<form action="funciones/guardar_voto.php" method="post">
		<div>
			<label for="nombre">Nombre y Apellido:</label>
			<input type="text" id="nombre" name="nombre" required>
		</div>
		<div>
			<label for="alias">Alias:</label>
			<input type="text" id="alias" name="alias" required minlength="6" pattern="[a-zA-Z0-9]+" title="El alias debe tener al menos 6 caracteres y sólo puede contener letras y números.">
		</div>
		<div>
			<label for="rut">RUT:</label>
			<input type="text" id="rut" name="rut" required minlength="9" maxlength="10" pattern="[0-9]+-[0-9kK]{1}" title="El RUT debe tener el formato 12345678-9.">
		</div>
		<div>
			<label for="email">Email:</label>
			<input type="email" id="email" name="email" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Debe estar en el formato de Email">
		</div>
		<div>
			<label for="region">Seleccione una región:</label>
			<select id="region" name="region" >
				<option value="">Seleccione una región</option>
				<!-- Se llenará dinámicamente desde obtener_regiones.php -->
			</select>
		</div>
		<div>
			<label for="comuna">Comunas:</label>
			<select id="comuna" name="comuna">
				<option value="">Seleccione una comuna</option>
				<!-- Se llenará dinámicamente desde obtener_comunas.php -->
			</select>
		</div>
		<div>
			<label for="candidato">Candidato:</label>
			<select id="candidato" name="candidato">
				<option value="">Seleccione un Candidato</option>
				<!-- Se llenará dinámicamente desde obtener_candidatos.php -->
			</select>
		</div>
		<div>
			<label>¿Cómo se enteró de nosotros?</label>
			<input type="checkbox" id="web" name="motivo[]" value="Web"> Web </input>
			<input type="checkbox" id="tv" name="motivo[]" value="Por televisión"> TV</input>
			<input type="checkbox" id="redes" name="motivo[]" value="Por redes sociales"> Redes Sociales</input>
			<input type="checkbox" id="amigo" name="motivo[]" value="Por un amigo"> Por un amigo</input>
		</div>
		<br>
		<div>
			<input type="submit" value="Enviar voto">
		</div>
	</form> 
	
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
		$(document).ready(function() {
			// Al cargar la página, se ejecuta esta función
			obtenerRegiones(); // Llamamos a la función para obtener las regiones
			obtenerCandidatos(); // Llamamos a la función para obtener las candidatos
		});

		function obtenerRegiones() {
	
			$.ajax({
				url: "funciones/obtener_regiones.php",
				type: "GET",
				dataType: "json",
				success: function(data) {
					// En caso de éxito, se ejecuta esta función
					// Agregamos cada nombre de región como opción en el ComboBox
					$.each(data, function(index, value) {
						$("#region").append("<option value='" + value.id + "'>" + value.nombre_region + "</option>");
					});
				},
				error: function(xhr, status, error) {
					// En caso de error, se ejecuta esta función
					console.log("Error al obtener las regiones");
				}
			});
		}

		function obtenerCandidatos() {
	
			$.ajax({
				url: "funciones/obtener_candidatos.php",
				type: "GET",
				dataType: "json",
				success: function(data) {
					// En caso de éxito, se ejecuta esta función
					// Agregamos cada nombre de región como opción en el ComboBox
					$.each(data, function(index, value) {
						$("#candidato").append("<option value='" + value.id + "'>" + value.nombre_candidato + "</option>");
					});
				},
				error: function(xhr, status, error) {
					// En caso de error, se ejecuta esta función
					console.log("Error al obtener los candidatos");
				}
			});
		}

		function obtenerComunas(id_region) {
			$.ajax({
				url: "funciones/obtener_comunas.php",
				method: "POST",
				data: { id_region: id_region },
				dataType: "json",
				success: function(data) {
					// Actualizar el ComboBox de comunas con los datos obtenidos
					var comunas_comboBox = $("#comuna");
					comunas_comboBox.empty();
					$.each(data, function(key, value) {
						comunas_comboBox.append($("<option></option>").attr("value", value.id).text(value.nombre_comuna));
					});
				}
			});
		}

		// Evento que se activa cuando se selecciona una región
		$("#region").on("change", function() {
			var id_region = $(this).val();
			obtenerComunas(id_region);
		});

		// Evento que se ocupa de validar los ComboBox y Select
		$('form').submit(function() {

			var checkboxes = $('input[name="motivo[]"]:checked');
			var region_seleccionada = $('#region').val();
			var comuna_seleccionada = $('#comuna').val();
			var candidato_seleccionado = $('#candidato').val();

			if (checkboxes.length < 2) {
				alert('Debe seleccionar al menos dos opciones');
				return false;
			}

			if (!region_seleccionada) {
				event.preventDefault();
				alert('Debe seleccionar una región');
			}

			if (!comuna_seleccionada) {
				event.preventDefault();
				alert('Debe seleccionar una comuna');
			}

			if (!candidato_seleccionado) {
				event.preventDefault();
				alert('Debe seleccionar un candidato');
			}
		});

	</script>
</body>
</html>

