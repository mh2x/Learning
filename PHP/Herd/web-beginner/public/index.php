<?php
//set the base_path relative to our document root 'public'
const BASE_PATH = __DIR__ . "/../";

require_once(BASE_PATH . "functions.php");
require_once(base_path("response.php"));
require_once(base_path("database.php"));
include(base_path("router.php"));
