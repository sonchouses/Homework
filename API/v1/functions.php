<?php 

function ajax_echo(
    $titel= '',
    $desc= '',
    $error= true,
    $type= 'ERROR', 
    $other= null
){
    return json_encode(
        array(
            "error" => $error,
            "type" => $type,
            "title" => $titel,
            "desc" => $desc,
            "other" => $other,
            "datetime" => array(
                'Y' => date('Y'),
                'm' => date('m'),
                'd' => date('d'),
                'H' => date('H'),
                'i' => date('i'),
                's' => date('s'),
                'full' => date('Y-m-d H:i:s'),
                
            )
        )
    );
}


