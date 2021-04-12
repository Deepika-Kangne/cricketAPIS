<?php

function arr($arr){
	print_r($arr);
};

function get_safe_val($con,$str){
	if($str!=''){
	return mysqli_real_escape_string($con,$str);
	}
}
?>