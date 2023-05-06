<?php
function selectQuery($sql)
{
    $pdo = new PDO('mysql:host=localhost;dbname=dbgtckanteen','root','');
    $res = $pdo->prepare($sql);
    $res->execute();
    $data = $res->fetch(PDO::FETCH_OBJ);
    return $data;
}
function editQuery($sql)
{
    $pdo = new PDO('mysql:host=localhost;dbname=dbgtckanteen','root','');
    $res = $pdo->prepare($sql);
    $res->execute();
}

editQuery('UPDATE tblareekanteen SET menu_rating=menu_rating+1 WHERE id='.$_GET['id']);
$data = selectQuery('SELECT menu_rating FROM tblareekanteen WHERE id='.$_GET['id']);

echo json_encode($data);
?>
