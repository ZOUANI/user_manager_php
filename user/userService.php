<?php

include_once '../config.php';
include_once '../utilService.php';

function seConnecter($data) {
    $user = findUser($data);
    if ($user == NULL) {
        return -1;
    } else if ($user->passeWord != $data["passeWord"]) {
        return -2;
    }return 1;
}

function findUser($data) {
    $query = "SELECT * FROM user WHERE id='" . wrapParam('id', $data) . "'";
    return loadOne($query);
}

function findDetailUser($id) {
    $query = "SELECT * FROM user WHERE id='$id'";
    return loadOne($query);
}

function findAllUser() {
    $query = "SELECT * FROM user";
    return loadMultiple($query);
}

function deleteUser($data) {
    $query = "DElETE FROM user WHERE id='" . wrapParam('id', $data) . "'";
    return execRequest($query);
}

function updateUser($data) {
    $query = "UPDATE  user SET id='" . wrapParam('id', $data) . "', passeWord='" . wrapParam('passeWord', $data) . "' WHERE id='" . wrapParam('id', $data) . "'";
    return execRequest($query);
}

function createUser($data) {
    $query = "INSERT INTO user(id, passeWord) VALUES('" . wrapParam('id', $data) . "', '" . wrapParam('passeWord', $data) . "')";
    execRequest($query);
    return $data->id;
}

function findByCriteriaUser($data) {
    $query = $query = "SELECT * FROM user WHERE 1=1";
    if (wrapParam('id', $data) != NULL) {
        return loadOne($query .= addAttribute('id', wrapParam('id', $data), 'AND'));
    }
    $query .= addAttribute('passeWord', wrapParam('passeWord', $data), 'LIKE');

    return loadMultiple($query);
}

function formatDataToTableUser($data) {
    $res = "";
    if ($data != NULL) {
        foreach ($data as $mydata) {
            $res .= constructTrUser($mydata);
        }
    }
    return $res;
}

function constructTrUser($mydata) {
    $res = "";
    $res .= " <tr id='tr" . $mydata->id . "'>"
            . "<td><input type=\"checkbox\" class=\"checkthis\" /></td>";
    $res .= "             <td id='id" . $mydata->id . "'>";
    $res .= $mydata->id . "</td>";
    $res .= "             <td id='passeWord" . $mydata->id . "'>";
    $res .= $mydata->passeWord . "</td>";
    $res .= "<td>            <button id='e" . $mydata->id . "' class=\"btn btn-primary btn-xs\" data-title=\"Edit\" data-toggle=\"modal\" data-target=\"#userEdit\" ><span class=\"glyphicon glyphicon-pencil\"></span></button>";
    $res .= "             <button id='d" . $mydata->id . "' class=\"btn btn-danger btn-xs\" data-title=\"Delete\" data-toggle=\"modal\" data-target=\"#userRemove\" ><span class=\"glyphicon glyphicon-trash\"></span></button>";
    $res .= "</td>";
    $res .= "</tr>";
    return $res;
}

?>