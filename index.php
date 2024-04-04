<?php

include 'db/BD.php';

header('Access-Control-Allow-Origin: *');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $query = 'select * from frameworks where id =' . $_GET['id'];
        $result = metodoGet($query);
        echo json_encode($result->fetch(PDO::FETCH_ASSOC));
    } else {
        $query = 'select * from frameworks';
        $result = metodoGet($query);
        echo json_encode($result->fetchAll());
    }
    header('HTTP/1.1 200 OK');
    exit();
}

if ($_POST['METHOD'] == 'POST') {
    unset($_POST['METHOD']);
    $nombre = $_POST['nombre'];
    $lanzamiento = $_POST['lanzamiento'];
    $desarrollador = $_POST['desarrollador'];
    $query = "Insert into frameworks (nombre,lanzamiento, desarrollador) values ('$nombre','$lanzamiento','$desarrollador')";
    $queryAutoIncrement = "select MAX(id) as id from frameworks";
    $result = metodoPost($query, $queryAutoIncrement);
    echo json_encode($result);
    header('HTTP/1.1 200 OK');
    exit();
}

if ($_POST['METHOD'] == 'PUT') {
    unset($_POST['METHOD']);
    $id = $_GET['id'];
    $nombre = $_POST['nombre'];
    $lanzamiento = $_POST['lanzamiento'];
    $desarrollador = $_POST['desarrollador'];
    $query = "Update frameworks set nombre='$nombre',lanzamiento='$lanzamiento', desarrollador='$desarrollador' WHERE id ='$id'";
    $result = metodoPut($query);
    echo json_encode($result);
    header('HTTP/1.1 200 OK');
    exit();
}

if ($_POST['METHOD'] == "DEL") {
    unset($_POST['METHOD']);
    $id = $_GET['id'];
    $query = "DELETE FROM frameworks  WHERE id ='$id'";
    $result = metodoDelete($query);
    echo json_encode($result);
    header('HTTP/1.1 200 OK');
    exit();
}

header('HTTP/1.1 400 Bad Request');

?>
