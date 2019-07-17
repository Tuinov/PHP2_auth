<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1><?=$title?></h1>
<?if (!$auth):?>
Войдите:
<form>
	<input type='text' name='login' placeholder='Логин'>
	<input type='password' name='pass' placeholder='Пароль'>
	Save? <input type='checkbox' name='save'>
	<input type='submit' name='send'>
</form>

<?else:?> Добро пожаловать, <?=$user?> <a href='?logout'>выход</a><br>
<?endif?>
<?=$content?>
</body>
</html>


