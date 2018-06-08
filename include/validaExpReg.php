<?php
function validaTexto($text){  
    //NO cumple longitud minima  
    if(strlen($text) < 1)  
        return false;  
    //SI longitud pero NO solo caracteres A-z  
    //else if(!preg_match("/^[a-zA-Z]+$/", $name))
    else if(!preg_match("/^[a-záéóóúàèìíòùäëïöüñ\s]+$/i", $text))
        return false;  
    // SI longitud, SI caracteres A-z  
    else  
        return true;  
}

function validaLetrasNumeros($text){  
    //NO cumple longitud minima  
    if(strlen($text) < 1)  
        return false;  
    //SI longitud pero NO solo caracteres A-z  
    //else if(!preg_match("/^[a-zA-Z]+$/", $name))
    else if(!preg_match("/^[a-záéóóúàèìíòùäëïöüñ0-9\s]+$/i", $text))
        return false;  
    // SI longitud, SI caracteres A-z  
    else  
        return true;  
}

function validaDomicilio($text){  
    //NO cumple longitud minima  
    if(strlen($text) < 1)  
        return false;  
    //SI longitud pero NO solo caracteres A-z  
    //else if(!preg_match("/^[a-zA-Z]+$/", $name))
    else if(!preg_match("/^[a-záéóóúàèìíòùäëïöüñ0-9\.#°\s]+$/i", $text))
        return false;  
    // SI longitud, SI caracteres A-z  
    else  
        return true;  
}

function validaConPuntos($text){  
    //NO cumple longitud minima  
    if(strlen($text) < 1)  
        return false;  
    //SI longitud pero NO solo caracteres A-z  
    //else if(!preg_match("/^[a-zA-Z]+$/", $name))
    else if(!preg_match("/^[0-9a-záéóóúàèìíòùäëïöüñ\.\s]+$/i", $text))
        return false;  
    // SI longitud, SI caracteres A-z  
    else  
        return true;  
}

function validaMail($textMail){  
    //NO cumple longitud minima  
    if(strlen($textMail) < 1)  
        return false;  
    //SI longitud pero NO solo caracteres A-z  
    //else if(!preg_match("/^[a-zA-Z]+$/", $name))
    else if(!preg_match("/^[a-z0-9\._-]+@[a-z0-9-]{2,}[.][a-z]{2,4}$/", $textMail))
        return false;  
    // SI longitud, SI caracteres A-z  
    else  
        return true;  
}

function validaPassword($textPass){  
    //NO cumple longitud minima  
    if(strlen($textPass) < 1)  
        return false;  
    //SI longitud pero NO solo caracteres A-z  
    //else if(!preg_match("/^[a-zA-Z]+$/", $name))
    else if(!preg_match("/^([a-z]+[0-9]+)|([0-9]+[a-z]+)/i", $textPass))
        return false;  
    // SI longitud, SI caracteres A-z  
    else  
        return true;  
}

function validaTelefono($num){  
    //NO cumple longitud minima  
    if(strlen($num) < 1)  
        return false;  
    //SI longitud pero NO solo caracteres A-z  
    //else if(!preg_match("/^[a-zA-Z]+$/", $name))
    else if(!preg_match("/^[0-9\s]+$/", $num))
        return false;  
    // SI longitud, SI caracteres A-z  
    else  
        return true;  
}

function validaEntero($num){  
    //NO cumple longitud minima  
    if(strlen($num) < 1)  
        return false;  
    //SI longitud pero NO solo caracteres A-z  
    //else if(!preg_match("/^[a-zA-Z]+$/", $name))
    else if(!preg_match("/^[0-9]+$/", $num))
        return false;  
    // SI longitud, SI caracteres A-z  
    else  
        return true;  
}

function validaDecimal($num){  
    //NO cumple longitud minima  
    if(strlen($num) < 1)  
        return false;  
    //SI longitud pero NO solo caracteres A-z  
    //else if(!preg_match("/^[a-zA-Z]+$/", $name))
    else if(!preg_match("/^([0-9]+\.+[0-9]|[0-9])+$/", $num))
        return false;  
    // SI longitud, SI caracteres A-z  
    else  
        return true;  
}

?>