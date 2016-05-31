<!DOCTYPE html>
<html>
<head>


<script   src="https://code.jquery.com/jquery-2.2.3.min.js"   integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo="   crossorigin="anonymous"></script>
<script   src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"   integrity="sha256-xNjb53/rY+WmG+4L6tTl9m6PpqknWZvRt0rO1SRnJzw="   crossorigin="anonymous"></script>

<link rel="stylesheet" href="../css/jquery-ui.css">
<link rel="stylesheet" href="../css/style.css">

<title>Welcome to nginx!</title>
</head>
<body>
<div id="banner">
<img src="../css/images/casabaluarte.png" alt="Hostal Casa Baluarte">
<h1>Portal de Administraci&oacute;n</h1>
</div> <!-- banner end -->

<div id="form">
<div id="entrada">
<label for="voucher">Voucher</label>
<input id="voucher" type="text" name="voucher">
<button id="ok">buscar</button>
<button id="auth">autorizar</button>
<span id="demo"></span>
</div> <!-- entrada end -->
<div id="panel">
<div id="leftpanel">
<label for="nombre">Nombre</label>
<input id="nombre" type="text" name="nombre" readonly><br />
<label for="apellido">Apellido</label>
<input id="apellido" type="text" name="apellido" readonly><br />
<label for="password">Clave</label>
<input id="password" type="text" name="password" readonly><br />
</div> <!-- leftpanel end-->
<div id="rightpanel">
<label for="created">Fecha de reservaci&oacute;n</label>
<input id="created" type="text" name="created" readonly><br />
<label for="dfrom">Check-in</label>
<input id="dfrom" type="text" name="dfrom" readonly><br />
<label for="dto">Check-out</label>
<input id="dto" type="text" name="dto" readonly><br />
<label for="n_mac"># de dispositivos</label>
<input id="n_mac" type="text" name="n_mac" readonly><br />
</div> <!-- rightpanel end -->
</div> <!-- panel end -->
</div> <!-- form end -->



</div> <!-- form end -->

<script>
	var primeraP = ["rosa", "gema", "piedra", "agua", "madera", "pintura", "hoja", "silla"];
	var segundaP = ["blanca", "roja", "verde", "azul", "violeta", "negra", "amarilla", "marron", "oscura", "brillante"];
	$("#ok").click(function() {
		$("#demo").html("");
		$.post("getInfo.php", { func: "getReservationInfo", voucher: $("#voucher").val() }, function(result){
			if (!result.first_name) {
				$("#demo").html("Esta reservaci&oacute;n no existe !");
				return 0;
			}
			$("#nombre").val(result.first_name.split(" ").shift());
			$("#apellido").val(result.last_name.split(" ").shift());
			var dt = new Date((parseInt(result.created) + 57600) * 1000);
			$("#created").val(dt.getUTCDate() + "/" + (dt.getUTCMonth() + 1) + "/" + dt.getUTCFullYear());
			dt = new Date((parseInt(result.dfrom) + 57600) * 1000);
			$("#dfrom").val(dt.getUTCDate() + "/" + (dt.getUTCMonth() + 1) + "/" + dt.getUTCFullYear());
			$.dfrom = parseInt(result.dfrom) + 57600;
			dt = new Date((parseInt(result.dto) + 57600) * 1000);
			$("#dto").val(dt.getUTCDate() + "/" + (dt.getUTCMonth() + 1) + "/" + dt.getUTCFullYear());
			$.dto = parseInt(result.dto) + 57600;
			$("#n_mac").val(parseInt(result.adults));
			$("#password").val(primeraP[Math.floor(Math.random()*primeraP.length)] + segundaP[Math.floor(Math.random()*segundaP.length)]);
			var ctime = Date.now() / 1000;
			if ($.dto < ctime) {
				$("#auth").prop("disabled", true);
				$("#demo").html("Esta reservaci&oacute;n est&aacute; vencida");
			}
			else {
				$("#auth").prop("disabled", false);
				$("#demo").html("");
			}
			//$("#demo").html(result.dfrom + "," + result.dto + "," + Date.now()/1000);
		}, "json");
	});

	//$("#dto").datepicker({dateFormat: "dd/mm/yy"});
	//$("#dfrom").datepicker({dateFormat: "dd/mm/yy"});
	$("#auth").click(function() {
		var ctime = Date.now() / 1000;
		if (ctime < $.dfrom || ctime > $.dto) {
			$("#demo").html("No se puede autorizar fuera de las fechas de reservaci&oacute;n !");
                        return 0;
		}
		$.post("autorizar.php", {
			nombre: "'" + $("#nombre").val().toLowerCase() + "'", 
			apellido: "'" + $("#apellido").val().toLowerCase() + "'",
			voucher: "'" + $("#voucher").val() + "'",
			n_mac: "'" + $("#n_mac").val() + "'",
			clave: "'" + $("#password").val() + "'",
			dfrom: "'" + $.dfrom + "'",
			dto: "'" + $.dto + "'",
			activo: 'true' })
		.done(function(data) {
			$("#demo").html(data);
		});
	});
</script>

</body>
</html>
