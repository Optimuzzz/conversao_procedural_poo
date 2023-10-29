<?php

    function databanco($data){

    $data = explode("/",$data); //[dd][mm][aaaa] separou 
    $data = array_reverse($data);//[aaaa][mm][dd]inverteu os valores
    $data = implode("-",$data);//aaaa-mm-dd juntou os valores invertidos

    return $data;//retorna para quem chamou

    };

    function datatela($data){

        $data = explode("-",$data); //[aaaa][mm][dd] separou 
        $data = array_reverse($data);//[dd][mm][aaaa]inverteu os valores
        $data = implode("/",$data);//dd/mm/aaaa juntou os valores invertidos

        return $data;//retorna para quem chamou

    };

?>