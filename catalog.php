<?php
	//Инициализация переменных
	$name_model = "";
	$description = "";
	$strength = "";
	$weight = "";
	$price	 = "";
	$uploadlink = "";

	if (isset($_POST['delete']))
	{
		if (!empty($_POST['delId'])){			    
			foreach($_POST['delId'] as $val)
			{
				$row = getOne("select uploadlink from items where id = '$val'");
				executeQuery("DELETE FROM items WHERE id = '$val'"); // удаляем записи из таблицы items				
				@unlink($row['uploadlink']);   					
			}
		}
		else echo "<br><center><font color='red'>Отметьте записи, которые необходимо удалить!</font><br></center>";
	}	
?>

<button id="add" class='btn' style='margin: 5px' onclick="location.href='index.php?command=add';">Добавить</button>
<br/><br/>

<form method='POST'>
<table class="lab1" border="1">
	<tr>
		<th width="20%" bgcolor="#838283" align="center">Модель гаджета</th>
		<th width="20%" bgcolor="#838283" align="center">Название</th>
		<th width="20%" bgcolor="#838283" align="center">Ёмкость аккумулятора,мАч</th>
		<th width="20%" bgcolor="#838283" align="center">Цена</th>
		<th width="2%" bgcolor="#838283" align="center"></th>
	</tr>
	<?php 
	$query = "SELECT * FROM items ORDER BY id ASC";					
	$rows = getAll($query); 
	if (!empty($rows)) {
		foreach ($rows as $item){
			$name_model = $item['model'];
			//$description = $item['description'];
			$strength = $item['strength'];
			$weight = $item['weight'];
			$price = $item['price'];
			$id = $item['id'];
		echo 
		"<tr>
		<td> <a href='index.php?command=item&id=$id';' style='color:black; display:inline;'> $name_model </a> </td>
		<td>$strength</td>
		<td>$weight</td>
		<td>$price</td>
		<td>
			<input type='checkbox' name='delId[]' value=$id/>
		</td>
		</tr>";
		}
	}
	?>
	
	</table>
	<input id='delete' class='btn' style='margin: 5px' type='submit' class='button' name='delete' value='Удалить'/>
</form>
