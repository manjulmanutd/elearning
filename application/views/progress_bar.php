<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>jQuery UI Progressbar - Default functionality</title>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <!--link rel="stylesheet" href="/resources/demos/style.css" /-->
  <script>
  $(function() {
    $( "#progressbar" ).progressbar({
      value: 10
    });
  });
  </script>
</head>
<body>
 
<div id="progressbar"></div>
 
 
</body>
</html>