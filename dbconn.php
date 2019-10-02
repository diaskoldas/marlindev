<?php
$driver = 'mysql'; // тип базы данных, с которой мы будем работать
$host = '127.0.0.1'; // альтернатива '127.0.0.1' - адрес хоста, в нашем случае локального
$db_name = 'marlin'; // имя базы данных
$db_user = 'root'; // имя пользователя для базы данных
$db_password = ''; // пароль пользователя
$charset = 'utf8'; // кодировка по умолчанию
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]; // массив с дополнительными настройками подключения. В данном примере мы установили отображение ошибок, связанных с базой данных, в виде исключений

/*
 * Далее из нескольких переменных формируем строку DSN соединения и сохраняем в отдельную переменную
 * (можно этого и не делать, но так удобнее и читабельнее):
 */
$dsn = "$driver:host=$host;dbname=$db_name;charset=$charset";


// И в конечном итоге создаём объект PDO, передавая ему следующие переменные:
$pdo = new PDO(
    $dsn,
    $db_user,
    $db_password,
    $options
);





$sql = "SELECT * FROM comments";

$statement  = $pdo->query($sql);
$result = $statement->fetchAll(PDO::FETCH_ASSOC);

echo '<pre>';
print_r($result);
echo '</pre>';
//foreach ($item as $result->fetch())
//{
//}











?>