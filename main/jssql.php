<!DOCTYPE html>
<html>
<head>
	<title>SQL</title>
	<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
</head>
<body>
	<div id="refresh">
		
	</div>
<script type="text/javascript">
  $(document).ready(function(){
     $("#refresh").load("getlive.php");
        setInterval(function() {
            $("#refresh").load("getlive.php");
        },2000);
    });
</script>
</body>
</html>