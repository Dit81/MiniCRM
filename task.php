<?php
require_once('config.php');

$_GET['id'] = htmlspecialchars($_GET['id']); //!!!! Очистить ввод данных !!!!
$_GET['id'] = (int)$_GET['id'];

$tasks = array();
$created = array();

	
	$stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = ? ");
	$stmt->execute(array($_GET['id']));
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	
?>
<!DOCTYPE HTML>
<html>
	<head>
	  <meta charset="utf-8">
	  <title>Задачи - MiniCRM</title>
	</head>
	<body>
		<h1>Task #<?php echo $_GET['id'] ?></h1>
		<p><?php echo $result['created_at']; ?></p>
		<p><strong>Заголовок:</strong> <?php echo $result['title']; ?></p>
		<strong>Описание:</strong> <?php echo $result['description']; ?>
		<p><strong>Статус:</strong> <?php echo $result['status']; ?></p>
		<p><a href="./index.php">Назад</a></p>
	</body>
</html>
