<div class="container">
	<div class="box-form">
		<div class="box-form-title">INGRESAR</div>
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
		<button class="btn btn-block btn-teal" id="btn-login">ENTRAR</button>
		<a href="<?php print base_url(); ?>index.php/web/register" class="box-form-link">REGISTRARME</a>
	</div>
</div>
<!-- /.container -->

<!-- Custom JavaScript -->
<script type="text/javascript">

	function login(username, password)
	{
		$("#btn-login").addClass('disabled');
		$.ajax({
			method: "POST",
			url: "<?php print base_url(); ?>index.php/user/login",
			context: document.body,
			data: { 
				username: username,
				password: password
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

        		$("#btn-login").removeClass('disabled');
    		}
    	});
	}

	$(document).ready(function(){
	    $("#btn-login").click(function(){
	        login($("#username").val(), $("#password").val());
	    });
	});
</script>
