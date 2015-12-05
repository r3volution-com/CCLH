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
				<li><a href="javascript:void(0)" onclick="loadModal('profile')">perfil</a></li>
				<li class="divider"></li>
				<li><a href="operations.php?op=logout">cerrar sesion</a></li>
			</ul>
			<div class="nav-wrapper black">
				<a href="#!" class="brand-logo" style="margin-left: 2px; margin-top: 5px;"><img src="resources/img/logo.png"/></a>
				<ul class="right hide-on-med-and-down">
					<li><a class="dropdown-button" href="#!" data-activates="dropdown1"><?php echo $user->getUserData()["username"]; ?><i class="material-icons right">arrow_drop_down</i></a></li>
				</ul>
			</div>
		</nav>
		<section>
			<h3 class="sectiontitle">Mis salas</h3>
			<div class="row">
				<?php for($i = 0; $i < 12; $i++){ ?>
						<div class="col l2 m4">
							<div class="gamecard" id="gamecard_<?php echo $i; ?>">
								<span class="gamecardtitle">Mi juego <?php echo $i; ?></span>
								<span class="gamecardauthor">de themarioga</span>
							</div>
						</div>
				<?php } ?>
			</div>
			<a class="waves-effect waves-light btn createbutton black" href="javascript:void(0)" onclick="loadModal('createroom')">Crear sala</a>
		</section>
		<div id="modal" class="modal"></div>
		<script type="text/javascript" src="resources/js/jquery.min.js"></script>
		<script type="text/javascript" src="resources/js/jquery.form.min.js"></script>
		<script type="text/javascript" src="resources/js/materialize.min.js"></script>
		<script type="text/javascript" src="resources/js/functions.js"></script>
		<script>
			$(".dropdown-button").dropdown();
			$(".gamecard").each(function() {
				$(this).height($(this).width());
				$(this).on("click", function(){
					var id = $(this).attr("id").split("_");
					location.href="game.php?id="+id[1];
				});
			});
		</script>
	</body>
</html>