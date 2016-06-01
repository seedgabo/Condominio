<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Password Reset</h2>

		<div>
			Para reestablecer tu contraseña completa este formulario: {{ URL::to('password/reset', array($token)) }}.<br/>
			Este link expira en  {{ Config::get('auth.reminder.expire', 60) }} minutos.
		</div>
	</body>
</html>
