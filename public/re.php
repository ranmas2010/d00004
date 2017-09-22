<?php
$saveData = array('title' => json_encode($rePayData));
DbFunction::InsertDB('test', $saveData);

?>

1|OK