<?php

function formatPhoneNumber($phoneNumber){

    if($phoneNumber){
        $formattedPhoneNumber = substr($phoneNumber, 0, 3) . '-' . substr($phoneNumber, 3, 3) . '-' . substr($phoneNumber, 6, 4);
        return $formattedPhoneNumber;
    }

    return '';

}