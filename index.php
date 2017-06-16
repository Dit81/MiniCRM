<?php
require_once('config.php');

$tasks = array();
	// Выводим 10 записей
	$stmt = $pdo->query('SELECT * FROM tasks ORDER BY id DESC LIMIT 0, 10');
	while ($row = $stmt->fetch())
	{
		$tasks[] = $row;
	}
require "tmpl/index.html";
?>
