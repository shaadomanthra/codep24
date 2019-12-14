<?php

require 'pages/blocks/header.php';
if(isset($page))
	require 'pages/'.$page.'.php';
else
	require 'pages/home.php';
require 'pages/blocks/footer.php';

