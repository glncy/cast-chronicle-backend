<?php

function baseURL(){
	return "http://localhost/onlinepublishing-v2/";
}

function showResponse($response){
	$json = json_encode($response);
    echo $json;
}