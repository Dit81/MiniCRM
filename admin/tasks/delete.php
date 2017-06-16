<?php
require_once('../../config.php');

$message = "";

	if (isset($_GET['id'])){
		$_GET['id'] = (int)$_GET['id'];
		$_GET['id'] = htmlspecialchars($_GET['id']); //!!!! Очистить ввод данных !!!!
		if ($_GET['id'] > 1 && is_numeric($_GET['id'])){

			// Удаление в БД
			$sql = "DELETE FROM tasks WHERE id =  :id";
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
			$stmt->execute();

			echo "<p>Данные удалены! <a href=\"../index.php\">Назад</a></p>";
		}
} else { // echo "<p>Таких данных нет! <a href=\"../index.php\">Назад</a></p>";
	$tasks = array();

	// Выводим все записи
	$stmt = $pdo->query('SELECT * FROM tasks ORDER BY id DESC');
	while ($row = $stmt->fetch())
	{
		$tasks[] = $row;
	}
?>
<!DOCTYPE HTML>
<html>
	<head>
	  <meta charset="utf-8">
	  <title>Удаление задач - MiniCRM Admin</title>
	</head>
	<body>
		<h1>Удаление задач - MiniCRM Admin</h1>
		<ul id="menu">
			<li><a href="../../index.php">На сайт</a></li>
			<li><a href="../index.php">Administrator</a></li>
		</ul>
		<?php
		foreach($tasks as $task){
				echo "<h2>" . $task['title'] . "</h2>";
				echo "<p>Создана: " . $task['created_at'] . ". <a href=\"delete.php?id=" . $task['id'] ."\">Удалить задачу</a><br />Статус: " . $task['status'] . "</p>";
			}
		?>
</body>
</html>
<?php
}
?>
