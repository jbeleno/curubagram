<div class="container">
	<div class="col-md-8 col-md-offset-2">
		<div class="box-text">
			<div class="box-text-header">
				Proponer textos con errores ortografícos
			</div>
			<div class="box-text-content">
				<div class="box-text-gray-label">
					TEXTO
				</div>
				<textarea class="form-control" rows="7" id="txt-text"></textarea>
				<div class="box-text-gray-label">
					FUENTE
				</div>
				<input type="text" class="form-control" id="txt-source">
				</br>
				<div id="result-msg"></div>
			</div>
			<div class="box-text-footer">
				<button class="btn btn-default btn-outline-teal" id="btn-send" type="button">ENVIAR</button>
			</div>
		</div>
		<div class="disclaimer">
			Utilizaremos tus contribuciones para mejorar la calidad de futuros correctores ortográficos. Gracias por tu ayuda.

			<ul>
				<li>
					No introduzcas comentarios, solo textos con errores ortográficos.
				</li>
				<li>
					Incluye la fuente de donde el texto es extraido.
				</li>
				<li>
					Mostraremos tu contribución a otros usuarios (de forma anónima si lo prefieres) para ejecutar correciones ortográficas sobre el, por lo que debes tener cuidado de no incluir ningún dato privado o confidencial.
				</li>
				<li>
					Si no iniciaste sesión tus contribuciones serán anónimas
				</li>
			</ul>

		</div>
	</div>
</div>
<!-- /.container -->

<!-- Custom JavaScript -->
<script type="text/javascript">

	function sendText(texto, fuente)
	{
		$("#btn-send").addClass('disabled');
		$.ajax({
			method: "POST",
			url: "<?php print base_url(); ?>index.php/text/add",
			context: document.body,
			data: { 
				text: texto,
				source: fuente
			},
			success: function(result){
				var response = '<div class="alert alert-success alert-dismissible" role="alert">' + 
								'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
  								'<strong>¡Texto almacenado!</strong> ' +
  								'Muchas Gracias.' + 
  								'</div>';

        		$("#result-msg").html(response);
        		$("#txt-text").val('');
        		$("#txt-source").val('');
        		$("#btn-send").removeClass('disabled');
    		}
    	});
	}

	$(document).ready(function(){
	    $("#btn-send").click(function(){
	        sendText($("#txt-text").val(), $("#txt-source").val());
	    });
	});
</script>