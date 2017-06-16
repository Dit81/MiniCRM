<?php
require_once('../../config.php');

if (isset($_GET['id'])){
	// Выводим одну запись
	$stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = ?");
	$stmt->execute(array($_GET['id']));	
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE HTML>
<html>
	<head>
	  <meta charset="utf-8">
	  <title>Редактирование задач - MiniCRM Admin</title>
	</head>
	<body>
		<h1>Редактирование задач - MiniCRM Admin</h1>
		<ul id="menu">
			<li><a href="../../index.php">На сайт</a></li>
			<li><a href="../index.php">Administrator</a></li>
		</ul>
<form method="post" action="edit_save.php">
	<p>Заголовок задачи:</p>
	<input name="title" type="text" value="<?php echo $result['title'] ?>" /><br />
	<p>Описание задачи:</p>
	<textarea rows="4" cols="50" name="description"><?php echo $result['description'] ?></textarea><br />
	<p>Статус задачи:</p>		
	<select name="status[]">
		<?php if ($result['status'] == 'Открыта') {
			echo "<option selected value=\"Открыта\">Открыта</option>";
			echo "<option value=\"Закрыта\">Закрыта</option>";
		} else {
			echo "<option selected value=\"Закрыта\">Закрыта</option>";
			echo "<option value=\"Открыта\">Открыта</option>";
		} ?>
	 </select><br />
	<input name="id" type="text" hidden="" value="<?php echo $result['id'] ?>" /><br />
	<input type="submit" name="submit" value="Добавить">
</form>
</body>
</html>
<?php
} else {
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
	  <title>Редактирование задач - CRM Admin</title>
	</head>
	<body>
		<h1>Редактирование задач - CRM Admin</h1>
		<ul id="menu">
			<li><a href="../../index.php">На сайт</a></li>
			<li><a href="../index.php">Administrator</a></li>
		</ul>
		<?php
		foreach($tasks as $task){
				echo "<h2>" . $task['title'] . "</h2>";				
				echo "<p>Создана: " . $task['created_at'] . ". <a href=\"edit.php?id=" . $task['id'] ."\">Редактировать задачу</a><br />Статус: " . $task['status'] . "</p>";
			}
		?>
</body>
</html>
<?php } ?>
