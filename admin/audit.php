<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="../css/jquery-ui.css">
<link rel="stylesheet" href="../css/style.css">

<title>Welcome to nginx!</title>
</head>
<body>
<div id="banner">
<img src="../css/images/" alt="">
<h1>Portal de Administraci&oacute;n</h1>
</div> <!-- banner end -->

<div id="form">
<div id="entrada">
<input id="fileupload" type="file" name="files[]" data-url="generar.php" multiple>
<div id="progress">
    <div class="bar" style="width: 0%;"></div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="../js/vendor/jquery.ui.widget.js"></script>
<script src="../js/jquery.iframe-transport.js"></script>
<script src="../js/jquery.fileupload.js"></script>
<script>
$(function () {
    $('#fileupload').fileupload({
        dataType: 'json',
        done: function (e, data) {
            /*$.each(data.result.files, function (index, file) {
                $('<p/>').text(file.name).appendTo(document.body);
            });*/
		$("#demo").html("<strong>Listo. </strong><br /><form method='get' action='files/out.csv'><button type='submit'>Bajar archivo</button></form>");
        },
	progressall: function (e, data) {
        	var progress = parseInt(data.loaded / data.total * 100, 10);
        	$('#progress .bar').css(
            		'width',
            		progress + '%'
        	);
    	}
    });
});
</script>




<span id="demo"></span>
</div> <!-- entrada end -->
</div> <!-- form end -->
<div id="results">
</div>

<script>


</script>

</body>
</html>
