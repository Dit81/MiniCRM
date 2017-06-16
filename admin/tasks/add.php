<?php
require_once('../../config.php');

$message = "";

	if (isset($_POST['submit'])){
		$_POST['title'] = htmlspecialchars($_POST['title']); //!!!! Очистить ввод данных !!!!
		$_POST['description'] = htmlspecialchars($_POST['description']);
		
		
		// Запись в БД
		$stmt = $pdo->prepare("INSERT INTO tasks ( title, description, status, created_at ) values ( '" . $_POST['title'] . "', '" . $_POST['description'] . "', 'Открыта', '" . date('d.m.Y h:i:s') . "')");
		$stmt->execute();
		
		$message = "Данные записаны!";
}
require "./tmpl/add.html";
?>
