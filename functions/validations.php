<?php

function validate_str($str) {
    if (mb_strlen($str) < 2) {
        return false;
    }
    return true;
}

function validate_pw($str) {
    if (mb_strlen($str) < 4) {
        return false;
    }
    return true;
}
