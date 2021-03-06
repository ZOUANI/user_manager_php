<?php


function getDbHost($local) {
    return $local == 1 ? "127.0.0.1" : "";
}

function getDbName($local) {
    return $local == 1 ? "gestion_user" : "";
}

function getDbUser($local) {
    return $local == 1 ? "root" : "";
}

function getDbPass($local) {
    return $local == 1 ? "" : "";
}

function connect() {

    $local = 1;
    $dbhost = getDbHost($local);
    $dbname = getDbName($local);
    $dbuser = getDbUser($local);
    $dbpswd = getDbPass($local);


    try {
        $db = new PDO('mysql:dbname=' . $dbname . ';host=' . $dbhost, $dbuser, $dbpswd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $db->exec("SET CHARACTER SET utf8");
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        return $db;
    } catch (PDOexception $e) {
        die("2 Une erreur est survenue lors de la connexion a la base de donnees ".$e);
    }
}

function loadMultiple($query) {
    $db = connect();
    $columns = $db->query($query);
    $datas = [];
    $i = 0;
    while ($item = $columns->fetch()) {
        $datas[] = $item;
        $i++;
    }
    if ($i == 0) {
        return NULL;
    }
    return $datas;
}

function loadOne($query) {
    $db = connect();
    $req = $db->query($query);
    while ($fe = $req->fetch()) {
        return $fe;
    }
    return NULL;
}

function execRequest($query) {
    $db = connect();
    return $db->query($query);
}

function generateMax($beanName,$atributeName){
$myMax = loadOne("SELECT MAX($atributeName) AS myMax FROM $beanName")->myMax ;
if($myMax == NULL){
return 1;
}
return $myMax+1;
}
