<!DOCTYPE html>
<html lang="fr-FR">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Réinitialisation du mot de passe</h2>

		<div>
			Pour réinitialiser votre mot de passe, veuillez cliquer sur ce lien: {{ URL::to('password/reset', array($token)) }}.<br/>
			Le lien expire dans {{ Config::get('auth.reminder.expire', 60) }} minutes.
		</div>
	</body>
</html>
