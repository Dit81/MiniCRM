<?php
require_once('../../config.php');

	if (isset($_POST['submit'])){
		//var_dump($_POST);		
		
		$_POST['title'] = htmlspecialchars($_POST['title']); //!!!! Очистить ввод данных !!!!
		$_POST['description'] = htmlspecialchars($_POST['description']);
		$_POST['status'] = htmlspecialchars($_POST['status'][0]);
		$_POST['id'] = htmlspecialchars($_POST['id']);
 
		$sql = "UPDATE tasks SET title=:title, description=:description, status=:status WHERE id = :id";

		$stmt = $pdo->prepare ( $sql );
		$stmt->bindValue( ":title", $_POST['title'], PDO::PARAM_STR );
		$stmt->bindValue( ":description", $_POST['description'], PDO::PARAM_STR );
		$stmt->bindValue( ":status", $_POST['status'], PDO::PARAM_STR );
		$stmt->bindValue( ":id", $_POST['id'], PDO::PARAM_INT );
		$stmt->execute();
		
		echo "<p>Данные обновлены! <a href=\"../index.php\">Назад</a></p>";
}
?>
