<?php
function validate($field){
    $field=trim($field);
    $field=htmlspecialchars($field);
    $field=stripslashes($field);
    return $field;
}

?>