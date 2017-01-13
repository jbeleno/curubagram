<div class="container">
	<div class="col-md-8 col-md-offset-2">
		<div class="box-text">
			<div class="box-text-header">
				Corregir ortografía
			</div>
			<div class="box-text-content">
				<div class="box-text-gray-label">
					ORIGINAL
				</div>
				<div>
					<?php print $content; ?>
				</div>
				<div class="box-text-gray-label">
					FUENTE
				</div>
				<div>
					<?php print $source; ?>
				</div>
				<div class="box-text-gray-label">
					CORRECCIÓN
				</div>
				<textarea class="form-control" rows="7" id="txt-content"><?php print $content; ?></textarea>
				</br>
				<div id="result-msg"></div>
			</div>
			<div class="box-text-footer">
				<a href="<?php print base_url(); ?>index.php/web/correction" class="box-text-skip">IGNORAR</a>
				<button class="btn btn-default btn-outline-teal" type="button" id="btn-send">ENVIAR</button>
			</div>
		</div>
		<div class="disclaimer">
			Utilizaremos tus contribuciones para mejorar la calidad de futuros correctores ortográficos. Gracias por tu ayuda.

			<ul>
				<li>
					No introduzcas comentarios, solo correciones ortográficas.
				</li>
				<li>
					Aunque necesites más información de contexto (como el sexo, la edad o la localización de quién escribe), corrige lo mejor que puedas.
				</li>
				<li>
					Ignora un texto si te parece difícil de corregir o te parece ofensivo.
				</li>
				<li>
					Es posible que mostremos tu contribución a otros usuarios (de forma anónima si lo prefieres), por lo que debes tener cuidado de no incluir ningún dato privado o confidencial.
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

	function sendCorrection(texto)
	{
		$("#btn-send").addClass('disabled');
		$.ajax({
			method: "POST",
			url: "<?php print base_url(); ?>index.php/correction/add",
			context: document.body,
			data: { 
				correction: texto
			},
			success: function(result){
				var response = '';

				if(result.status == 'OK')
				{
					var response = 	'<div class="alert alert-success alert-dismissible" role="alert">' + 
									'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
	  								'<strong>¡Texto corregido!</strong> ' +
	  								'Muchas Gracias.' + 
	  								'</div>';

	        		
	        		$("#txt-content").val('');
	        		setTimeout(function(){ location.reload(); }, 1000);
				}
				else
				{
					var response = 	'<div class="alert alert-danger alert-dismissible" role="alert">' + 
									'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
	  								result.msg +
	  								'</div>';
				}
				
				$("#result-msg").html(response);
				$("#btn-send").removeClass('disabled');
    		}
    	});
	}

	$(document).ready(function(){
	    $("#btn-send").click(function(){
	        sendCorrection($("#txt-content").val());
	    });
	});
</script>