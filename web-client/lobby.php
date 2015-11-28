<?php 
session_start(); 
if (!isset($_SESSION["uid"])) {header("location: index.php"); exit;} 
include ("class/user.class.php");
$user = new User($_SESSION["uid"]);
?>
 <!DOCTYPE html>
<html>
	<head>
		<title>Cartas contra la humanidad - Lobby</title>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="resources/css/materialize.min.css"	media="screen,projection"/>
		<link type="text/css" rel="stylesheet" href="resources/css/inner.css" media="screen,projection"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	</head>
	<body>
		<nav>
			<ul id="dropdown1" class="dropdown-content">
				<li><a href="#!">perfil</a></li>
				<li class="divider"></li>
				<li><a href="#!">cerrar sesion</a></li>
			</ul>
			<div class="nav-wrapper">
				<a href="#!" class="brand-logo">CCLH</a>
				<ul class="right hide-on-med-and-down">
					<li><a class="dropdown-button" href="#!" data-activates="dropdown1"><?php echo $user->getUserData()["username"]; ?><i class="material-icons right">arrow_drop_down</i></a></li>
				</ul>
			</div>
		</nav>
		<section>
			<div class="row">
				<?php for($i = 0; ; $i++){ ?>
						<div class="col s12">
							<div="gamecard">
							
							</div>
						</div>
				<?php } ?>
			</div>
		</section>
		<script type="text/javascript" src="resources/js/jquery.min.js"></script>
		<script type="text/javascript" src="resources/js/jquery.form.min.js"></script>
		<script type="text/javascript" src="resources/js/materialize.min.js"></script>
		<script type="text/javascript" src="resources/js/functions.js"></script>
		<script>
			$(".dropdown-button").dropdown();
		</script>
	</body>
</html>