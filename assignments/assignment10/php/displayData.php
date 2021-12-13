<?php

require_once('classes/crud.php');
$crud = new Crud();


function displayData() {
    global $crud;
    $display = $crud->getNames();

    return ["", $display];
}

function deleteData() {
    global $crud;
    $delete = $crud->deleteNames($_POST);
    $display = $crud->getNames();

    return [$delete, $display];
}


?>