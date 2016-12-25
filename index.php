<?php
  require("/var/www/html/config/config.php");
  require("/var/www/html/lib/db.php");
  $conn = db_init($config["hostname"], $config["duser"], $config["dpw"], $config["dname"]);
  $result = mysqli_query($conn, 'SELECT * FROM topic');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<link rel="stylesheet" type="text/css" href="http://localhost/style.css">
  <!-- Bootstrap -->
  <link href="http://localhost/bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body id='target'>
	<header>
    <img src="https://s3.ap-northeast-2.amazonaws.com/opentutorials-user-file/course/94.png" />
		<h1><a href="http://localhost/php/index.php">JavaScript</a></h1>
	</header>
	<nav>
		<ol>
			<?php
        while($row = mysqli_fetch_assoc($result)) {
          echo '<li><a href="http://localhost/php/index.php?id='.$row['id'].'">'.$row['title'].'</a></li>'."\n";
        }
      ?>
		</ol>
	</nav>
	<div id='control'>
		<input type="button" value="white" onclick="document.getElementById('target').className='white'"/>
		<input type="button" value="black" onclick="document.getElementById('target').className='black'"/>
    <a href="http://localhost/php/write.php">쓰기</a>
	</div>
  <article>
    <?php
      if(empty($_GET["id"]) == false) {
        $sql = "SELECT topic.id,title,description,name FROM topic LEFT JOIN user ON topic.author = user.id WHERE topic.id=".$_GET['id'];
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        echo '<h2>'.$row['title'].'</h2>';
        echo '<p>'.$row['name'].'</p>';
        echo $row['description'];
      }
    ?>
  </article>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="http://localhost/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
</body>
</html>
