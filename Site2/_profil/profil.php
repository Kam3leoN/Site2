<?php

	require_once('../include.php');

	if(!isset($_SESSION['id'])){
		header('Location: /');
		exit;
	}

	$req = $DB->prepare("SELECT *
		FROM utilisateur
		WHERE id = ?");
	
	$req->execute([$_SESSION['id']]);
	
	$req_user = $req->fetch();
	
	
	$date = date_create($req_user['date_creation']);
	$date_inscription =  date_format($date, 'd/m/Y');
	
	$date = date_create($req_user['date_connexion']);
	$date_connexion =  date_format($date, 'd/m/Y à H:i');
	
	switch($req_user['role']){
		case 0:
			$role = "Utilisateur";
		break;
		case 1:
			$role = "Super Admin";
		break;
		case 2:
			$role = "Admin";
		break;
		case 3:
			$role = "Modérateur";
		break;
	}
	
	$chemin_avatar = null;
	
	if(isset($req_user['avatar'])){
		$chemin_avatar = '../public/avatar/' . $req_user['id'] . '/' . $req_user['avatar'];
	}else{
		$chemin_avatar = '../public/avatar/defaut/defaut.svg';
	}
	
?>
<!doctype html>
<html lang="fr">
	<head>
		<?php	
			require_once('../_head/meta.php');
			require_once('../_head/link.php');
			require_once('../_head/script.php');
		?>
		<title>Profil de <?= $req_user['pseudo'] ?></title>
	</head>
	<body>
		<?php	
			require_once('../_menu/menu.php');
		?>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h1>Bonjour <?= $req_user['pseudo'] ?></h1>
					<div>
						<img src="<?= $chemin_avatar ?>" class="profil__avatar"/>
					</div>
					<div>
						Date d'inscription : Le <?= $date_inscription ?>
					</div>
					<div> 
						Date de dernière connexion : Le <?= $date_connexion ?>
					</div>
					<div> 
						Rôle utilisateur : <?= $role ?>
					</div>
					<div>
						<a href="_profil/modifier-profil.php">Modifier mon compte</a>
					</div>
					<div>
						<a href="_profil/avatar.php">Modifier mon avatar</a>
					</div>
				</div>
			</div>
		</div>
		<?php	
			require_once('../_footer/footer.php');
		?>
	</body>
</html>