<?php

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     modifier.isbn.php
 * Type:     modifier
 * Name:     isbn
 * Purpose:  displays isbn in a readable format
 * 
 * @author Jonas Daniel Däster
 *
 * @param string $string       input string
 *
 * @return string
 * -------------------------------------------------------------
 */

function smarty_modifier_isbn($string) {
    preg_match("/[0-9]{13}|[0-9]{10}|([0-9]{9}X?|x?)/", $string, $matches);
    if (substr($matches[0], -1) == "x" || strlen($matches[0]) == 10) {
        $isbn = substr($matches[0], -10, 1) . "-" . substr($matches[0], -9, 5) . "-" . substr($matches[0], -4, 3) . "-" . substr($matches[0], -10, 1);
        return $isbn;
    } else if (strlen($matches[0]) == 9) {
        $isbn = substr($matches[0], -10, 1) . "-" . substr($matches[0], -9, 5) . "-" . substr($matches[0], -4, 3) . "-X";
        return $isbn;
    } else if (strlen($matches[0]) == 13) {
        $isbn = substr($matches[0], -13, 3) . "-" . substr($matches[0], -10, 1) . "-" . substr($matches[0], -9, 5) . "-" . substr($matches[0], -4, 3) . "-" . substr($matches[0], -10, 1);
        return $isbn;
    }
    else {
        return $string;
    }

    
}

?>