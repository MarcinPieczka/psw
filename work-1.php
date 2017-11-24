<html>
<head>
	<?php readfile("partials/head.html") ?>
	<link rel="stylesheet" href="css/work-1.css">
  <script type="text/javascript" src="js/work-1.js"></script>
</head>
<body>
  <?php readfile("partials/menu.html") ?>
    <div id="container">
        <script>
            var height = 25;
            var width = 25;
            for (var i = 0; i < height; i++) {
                document.writeln("<div class=\"row\">");
                for (var j = 0; j < width; j++) {
                    document.writeln(sprintf("<div id=\"%d,%d\" class=\"cell\"></div>", i, j));
                }
                document.writeln("</div>");
            }
        </script>
    </div>
</body>
</html>
