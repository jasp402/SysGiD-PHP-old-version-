<?php

/*----------> Acceso al MySQL <---------*/
//////////////////////////////////////////
// usuario:   gunuwebn                  //
// password:  1z2x3c4v5b+-*/            //
// Ruta:      http://gunuweb.net:2082/  //
//////////////////////////////////////////

date_default_timezone_set('America/Caracas');
$JSON = file_get_contents("php://input");
$request = json_decode($JSON);

function getConnection()
{
    $dbhost = "localhost"; //
    $dbuser = "root";  //
    $dbpass = "";
    $dbname = "sysgidco_uniprint"; //
    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $dbh->exec("set names utf8");
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
}

function ExecutetSQL($sql)
{
    $db = getConnection();
    $stmt = $db->query($sql);
    $db = null;
}

function InsertSQL($sql)
{
    $db = getConnection();
    $stmt = $db->query($sql);
    $db = null;
}

function UpdateSQL($sql)
{
    $db = getConnection();
    $stmt = $db->query($sql);
    $db = null;
}

function SelectSQL($sql)
{
    try {
        $db = getConnection();
        $stmt = $db->query($sql);
        $data = $stmt->fetchAll();
        $db = null;
        echo json_encode($data, JSON_NUMERIC_CHECK);
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}


function SelectObjectSQL($sql)
{
    try {
        $db = getConnection();
        $stmt = $db->query($sql);
        $data = $stmt->fetchObject();
        $db = null;
        echo json_encode($data, JSON_NUMERIC_CHECK);
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

function SelectOneSQL($sql)
{
    try {
        $db = getConnection();
        $stmt = $db->query($sql);
        $data = $stmt->fetchColumn();
        $db = null;
        echo json_encode($data, JSON_NUMERIC_CHECK);
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
    return $data;
}


function NumRowsSQL($sql)
{
    try {
        $db = getConnection();
        $stmt = $db->query($sql);
        $data = $stmt->rowCount();
        $db = null;
        echo json_encode($data, JSON_NUMERIC_CHECK);
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
    return $data;
}

function PHPSelectSQL($sql)
{

    $db = getConnection();
    $stmt = $db->query($sql);
    $data = $stmt->fetchAll();
    $db = null;


    //implode("','",$data);

    return json_encode($data);
}

?>

