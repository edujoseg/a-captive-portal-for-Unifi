<!DOCTYPE html>
<?php
//Start session to grab MAC Address and have it available throughout the auth process
        session_start();
//Get MAC Address and assign it to _SESSION variable to be available throughout the auth process
        if($_GET['id']) {
                $id = $_GET['id'];
        } else {
                echo "Direct Access is not allowed";
                exit();
        }
//Get original target URL for redirect after auth
        if ($_GET['url']) {
                $url = $_GET['url'];
        } else {
//If original URL not specified, default to ubnt.com
                $url = 'http://www.ubnt.com';
        }
?>
<html lang="en">
    <head>

        <meta charset="UTF-8">
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
        <title> Portal Cautivo | Hostal Casa Baluarte </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <!-- Favicons -->
        <link rel="shortcut icon" href="assets/images/icons/favicon.png">

        <!-- HELPERS -->

        <link rel="stylesheet" type="text/css" href="assets/helpers/animate-min.css">
        <link rel="stylesheet" type="text/css" href="assets/helpers/backgrounds.css">
        <link rel="stylesheet" type="text/css" href="assets/helpers/boilerplate.css">
        <link rel="stylesheet" type="text/css" href="assets/helpers/border-radius.css">
        <link rel="stylesheet" type="text/css" href="assets/helpers/grid.css">
        <link rel="stylesheet" type="text/css" href="assets/helpers/spacing.css">
        <link rel="stylesheet" type="text/css" href="assets/helpers/typography.css">
        <link rel="stylesheet" type="text/css" href="assets/helpers/utils.css">
        <link rel="stylesheet" type="text/css" href="assets/helpers/colors.css">

        <!-- ELEMENTS -->

        <link rel="stylesheet" type="text/css" href="assets/elements/badges.css">
        <link rel="stylesheet" type="text/css" href="assets/elements/buttons.css">
        <link rel="stylesheet" type="text/css" href="assets/elements/content-box.css">
        <link rel="stylesheet" type="text/css" href="assets/elements/dashboard-box.css">
        <link rel="stylesheet" type="text/css" href="assets/elements/forms.css">
        <link rel="stylesheet" type="text/css" href="assets/elements/images.css">
        <link rel="stylesheet" type="text/css" href="assets/elements/info-box.css">
        <link rel="stylesheet" type="text/css" href="assets/elements/invoice.css">
        <link rel="stylesheet" type="text/css" href="assets/elements/loading-indicators.css">
        <link rel="stylesheet" type="text/css" href="assets/elements/menus.css">
        <link rel="stylesheet" type="text/css" href="assets/elements/panel-box.css">
        <link rel="stylesheet" type="text/css" href="assets/elements/response-messages.css">
        <link rel="stylesheet" type="text/css" href="assets/elements/responsive-tables.css">
        <link rel="stylesheet" type="text/css" href="assets/elements/ribbon.css">
        <link rel="stylesheet" type="text/css" href="assets/elements/social-box.css">
        <link rel="stylesheet" type="text/css" href="assets/elements/tile-box.css">


        <!-- FRONTEND ELEMENTS -->
        <link rel="stylesheet" type="text/css" href="assets/frontend-elements/cta-box.css">
        <link rel="stylesheet" type="text/css" href="assets/frontend-elements/feature-box.css">
        <link rel="stylesheet" type="text/css" href="assets/frontend-elements/footer.css">
        <link rel="stylesheet" type="text/css" href="assets/frontend-elements/hero-box.css">
        <link rel="stylesheet" type="text/css" href="assets/frontend-elements/icon-box.css">
        <link rel="stylesheet" type="text/css" href="assets/frontend-elements/portfolio-navigation.css">
        <link rel="stylesheet" type="text/css" href="assets/frontend-elements/sliders.css">


        <!-- ICONS -->

        <link rel="stylesheet" type="text/css" href="assets/icons/fontawesome/fontawesome.css">

        <!-- WIDGETS -->

        <link rel="stylesheet" type="text/css" href="assets/widgets/carousel/carousel.css">

        <link rel="stylesheet" type="text/css" href="assets/widgets/dialog/dialog.css">
        <link rel="stylesheet" type="text/css" href="assets/widgets/modal/modal.css">       
        <link rel="stylesheet" type="text/css" href="assets/widgets/uniform/uniform.css">

        <!-- FRONTEND WIDGETS -->
        <link rel="stylesheet" type="text/css" href="assets/widgets/owlcarousel/owlcarousel.css">
        <link href="assets/widgets/dropdown/dropdown.css" rel="stylesheet" type="text/css"/>

        <!-- Frontend theme -->

        <link rel="stylesheet" type="text/css" href="assets/themes/frontend/layout.css">
        <link rel="stylesheet" type="text/css" href="assets/themes/frontend/color-schemes/default.css">

        <!-- Components theme -->

        <link rel="stylesheet" type="text/css" href="assets/themes/components/default.css">
        <link rel="stylesheet" type="text/css" href="assets/themes/components/border-radius.css">

        <!-- Frontend responsive -->

        <link rel="stylesheet" type="text/css" href="assets/helpers/responsive-elements.css">
        <link rel="stylesheet" type="text/css" href="assets/helpers/frontend-responsive.css">

        <!-- JS Core -->

        <script type="text/javascript" src="assets/js-core/jquery-core-min.js"></script>
        <script type="text/javascript" src="assets/js-core/jquery-ui-core-min.js"></script>
        <script type="text/javascript" src="assets/js-core/jquery-ui-widget-min.js"></script>
        <script type="text/javascript" src="assets/js-core/jquery-ui-position-min.js"></script>


        <script type="text/javascript">
            $(window).load(function () {
                setTimeout(function () {
                    $('#loading').fadeOut(400, "linear");
                }, 300);
            });
        </script>

        <script type="text/javascript" src="assets/widgets/dialog/dialog.js"></script>
        <script type="text/javascript" src="assets/widgets/dialog/dialog-demo.js"></script>
    <div class="hide" id="basic-dialog" title="Términos y condiciones">
        <div class="pad10A">
            <div class="panel">
                <div class="panel-body">
                    <h3 class="title-hero">
                        Politicas de uso.
                    </h3>
                    <div class="example-box-wrapper">
                        <div class="scrollable-content scrollable-xs scrollable-slim">

                            <p>Al acceder y utilizar la red WI-FI del Hotel Casa Baluarte, usted declara que ha leído, entendido y acepta los términos y condiciones para su utilización. Si usted no está de acuerdo con esta norma, se recomienda que no utilice este servicio.</p>

                            <p>La red WI-FI está destinada para el uso exclusivo de los Clientes del Hotel y sus invitados. Quienes no pertenezcan a estos grupos no tienen permitido el uso de este servicio.</p>

                            <p>Usted acepta y reconoce que hay riesgos potenciales a través de un servicio WI-FI. Debe tener cuidado al transmitir datos como: número de tarjeta de crédito, contraseñas u otra información personal sensible a través de redes WI-FI. El Hotel Casa Baluarte no puede y no garantiza la privacidad y seguridad de sus datos y de las comunicaciones al utilizar este servicio.</p>

                            <p>El Hotel Casa Baluarte, no garantiza el nivel de desempeño de la red WI-FI. El servicio puede no estar disponible o ser limitado en cualquier momento y por cualquier motivo, incluyendo emergencias, fallo del enlace, problemas en equipos de red, interferencias o fuerza de la señal.El Hotel, no se responsabiliza por datos, mensajes o páginas perdidas, no guardadas o retrasos por interrupciones o problemas de rendimiento con el servicio.</p>

                            <p>El Hotel Casa Baluarte, puede establecer límites de uso, suspender el servicio o bloquear ciertos comportamientos, acceso a ciertos servicios o dominios para proteger la red Hotelera de fraudes o actividades que atenten contra las leyes nacionales o internacionales.</p>

                            <p>NO se podrá utilizar la red WI-FI con los siguientes fines:</p>

                            <ol>
                                <li>Transmisión de contenido fraudulento, difamatorio, obsceno, ofensivo o de vandalismo, insultante o acosador, sea éste material o mensajes.</li>
                                <li>Interceptar, recopilar o almacenar datos sobre terceros sin su conocimiento o consentimiento. Escanear o probar la vulnerabilidad de equipos, sistemas o segmentos de red. Enviar mensajes no solicitados (spam), virus, o ataques internos o externos a la red hotelera.</li>
                                <li>Obtener acceso no autorizado a equipos, sistemas o programas tanto al interior de la red del hotel como fuera de ella. Tampoco podrá utilizar la red WI-FI para obtener, manipular y compartir cualquier archivo de tipo musical o filmográfico, sin tener los derechos de propiedad intelectual.</li>
                                <li>Transmitir, copiar y/o descargar cualquier material que viole cualquier ley. Esto incluye entre otros: material con derecho de autor, pornografía infantil, material amenazante u obsceno, o material protegido por secreto comercial o patentes.</li>
                                <li>Dañar equipos, sistemas informáticos o redes y/o perturbar el normal funcionamiento de la red. Ser usada con fines de lucro, actividades comerciales o ilegales, por ejemplo hacking. Ser utilizada para crear y/o la colocar un virus informático o malware en la red.</li>
                            </ol>                     
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</head>
<body class="main-header-fixed">
    <div id="page-wrapper">
        <div class="main-header bg-header wow fadeInDown">
            <div class="container">
                <a href="index.php" class="header-logo" title="Portal Cautivo | Hotel Casa Baluarte"></a><!-- .header-logo -->
            </div><!-- .container -->
        </div><!-- .main-header -->
        <div class="hero-box hero-box-smaller full-bg-13 font-inverse" data-top-bottom="background-position: 50% 0px;" data-bottom-top="background-position: 50% -400px;">
            <div class="container">
                <h1 class="hero-heading wow fadeInDown" data-wow-duration="0.6s">Bienvenido a nuestra red WiFi!</h1>
                <p class="hero-text wow bounceInUp" data-wow-duration="0.9s" data-wow-delay="0.2s">Ingrese los datos solicitados.</p>
                <br>
                <form class="form-horizontal" action="auth2.php" method=POST>
                    <div class="form-group">
                        <label class="col-sm-offset-1 col-sm-3 control-label">Nombre</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-offset-1 col-sm-3 control-label">Apellido</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-offset-1 col-sm-3 control-label">Clave</label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Clave">
                        </div>
                    </div>
                    <input type="checkbox" name="terminoscondiciones" value="aceptoterminos" id="terminoscondiciones"/> He leído y acepto los <a style="color: #e6ae43;" href="#" class="basic-dialog">Términos y condiciones</a>
                    <br><br>
                    <input type="hidden" name="mac" value="<?php echo $id; ?>" />
                    <input type="hidden" name="url" value="<?php echo $url; ?>" />
                    <div class="form-group">
                        <input id="entrar" href="#" type="submit" class="btn title-button hero-btn-submit btn-primary wow fadeInUp animated animated" data-wow-delay="0.4s" title="Entrar" value="Entrar">
                    </div>
                </form>
            </div>
            <div class="hero-overlay bg-black"></div>
        </div>
        <div id="page-content" class="col-md-10 center-margin frontend-components mrg25T">
            <div class="row">
                <div id="page-title">
                    <h2>OFERTAS DE SERVICIO - HOTEL CASA BALUARTE</h2>
                    <p>Realizamos traslados desde aeropuerto-hotel-aeropuerto.</p>
                </div>
                <div class="divider"></div>
                <div class="col-md-4">
                    <div class="example-box-wrapper">
                        <div class="content-box border-top border-gold">
                            <h3 class="content-box-header clearfix">
                                WIFI HOTELERA
                            </h3>
                            <div class="content-box-wrapper">
                                <p>Disfrute del gran servicio diferenciado de wifi que ofrecemos.</p>
                                <br>
                                <p>Encuentre un plácido y tranquilo ambiente interior, para descanso y lectura. Patios internos, hamacas y salas. Con acceso Internet inalámbrico gratis las 24 horas.</p>
                                <p>Ofrecemos cinco categorías de habitación, desde modernas con TV LED, minibar, conexión USB para smartphones y tablets; hasta sencillas, sobrias y ajustadas a su presupuesto.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="owl-carousel-1 slider-wrapper inverse arrows-outside carousel-wrapper">
                                <div>
                                    <div class="thumbnail-box-wrapper mrg5A">
                                        <div class="thumbnail-box">
                                            <a class="thumb-link" href="#" title=""></a>
                                            <div class="thumb-content">
                                                <div class="center-vertical">
                                                    <div class="center-content">
                                                        <i class="icon-helper icon-center animated zoomInUp font-white glyph-icon icon-linecons-camera"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="thumb-overlay bg-black"></div>
                                            <img src="assets/images/estetica-1.jpg" alt="">
                                        </div>
                                        <div class="thumb-pane">
                                            <h3 class="thumb-heading animated rollIn">
                                                <a href="#" title="">
                                                    Centro de Estética y Masajes
                                                </a>
                                                <br><br>
                                                <a class="btn btn-xs btn-primary" href="#">Contratar</a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="thumbnail-box-wrapper mrg5A">
                                        <div class="thumbnail-box">
                                            <a class="thumb-link" href="#" title=""></a>
                                            <div class="thumb-content">
                                                <div class="center-vertical">
                                                    <div class="center-content">
                                                        <i class="icon-helper icon-center animated zoomInUp font-white glyph-icon icon-linecons-camera"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="thumb-overlay bg-black"></div>
                                            <img src="assets/images/duster-prueba.jpg" alt="">
                                        </div>
                                        <div class="thumb-pane">
                                            <h3 class="thumb-heading animated rollIn">
                                                <a href="#" title="">
                                                    Hotel Tranfers
                                                </a>
                                                <br><br>
                                                <a class="btn btn-xs btn-primary" href="#">Contratar</a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
        <div class="main-footer bg-gradient-4 clearfix">
            <div class="container clearfix">
                <div class="col-md-7 pad25R">
                 
            <div class="footer-pane">
                <div class="container clearfix">
                    <div class="logo" style="color: rgba(255, 255, 255, .8);">&copy; 2016 <a target="_blank" href="http://www.lagenciactg.com.co">LAgencia</a>. Todos los derechos reservados.</div>
                </div>
            </div>
        </div></div>

    <script src="assets/widgets/sticky/sticky-min.js" type="text/javascript"></script>
    <script type="text/javascript" src="assets/widgets/owlcarousel/owlcarousel-min.js"></script>
    <script type="text/javascript" src="assets/widgets/owlcarousel/owlcarousel-demo.js"></script>
    <script type="text/javascript" src="assets/widgets/wow/wow.js"></script>
    <script src="assets/widgets/dropdown/dropdown.js" type="text/javascript"></script>
    <script type="text/javascript" src="assets/widgets/button/button.js"></script>
    <script type="text/javascript" src="assets/widgets/slimscroll/slimscroll.js"></script>
    <script type="text/javascript" src="assets/widgets/content-box/contentbox.js"></script>
    <script type="text/javascript" src="assets/widgets/overlay/overlay.js"></script>
    <script type="text/javascript" src="assets/js-init/widgets-init.js"></script>
    <script type="text/javascript" src="assets/js-init/frontend-init.js"></script>
    <script type="text/javascript" src="assets/themes/frontend/layout.js"></script>
	<script>
	$('#entrar').prop('disabled', 'true');
	/*$('#entrar').click(function() {
		if (this.prop('disabled')) {
			alert('Debe aceptar las condiciones para poder acceder a la red WiFi');
		}
	});*/
	$('#terminoscondiciones').on('change', function () {
		var input = this;
		$('#entrar').prop('disabled', !input.checked);
	});
	</script>

</body>
</html>
