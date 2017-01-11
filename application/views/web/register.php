<div class="container">
	<div class="box-form">
		<div class="box-form-title">REGISTRO</div>
		<div class="form-group">
			<label class="box-form-label">CORREO</label>
		  	<input type="email" class="form-control" id="email">
		</div>
		<div class="form-group">
			<label class="box-form-label">USUARIO</label>
		  	<input type="text" class="form-control" id="username">
		</div>
		<div class="form-group">
			<label class="box-form-label">CONTRASEÑA</label>
		  	<input type="password" class="form-control" id="password">
		</div>
		</br>
		<div id="result-msg"></div>
		<button class="btn btn-block btn-teal" id="btn-register">REGISTRAR</button>
		<a href="<?php print base_url(); ?>index.php/web/login" class="box-form-link">INGRESAR</a>
	</div>
</div>
<!-- /.container -->

<!-- Custom JavaScript -->
<script type="text/javascript">

	function register(username, password, email)
	{
		$("#btn-register").addClass('disabled');
		$.ajax({
			method: "POST",
			url: "<?php print base_url(); ?>index.php/user/add",
			context: document.body,
			data: { 
				username: username,
				password: password,
				email: email
			},
			success: function(result){
				console.log(result.status)
				if(result.status == 'OK')
				{
					location.assign("<?php print base_url(); ?>");
				}
				else
				{
					var response = '<div class="alert alert-danger alert-dismissible" role="alert">' + 
								'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
  								result.msg +
  								'</div>';

        			$("#result-msg").html(response);
				}

        		$("#btn-register").removeClass('disabled');
    		}
    	});
	}

	$(document).ready(function(){
	    $("#btn-register").click(function(){
	        register($("#username").val(), $("#password").val(), $("#email").val());
	    });
	});
</script>
