<?php

function baseURL(){
	return "http://localhost/onlinepublishing/";
}

function showResponse($response){
	$json = json_encode($response);
    echo $json;
}