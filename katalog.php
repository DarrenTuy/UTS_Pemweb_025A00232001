<?php

declare(strict_types=1);

require_once 'functions.php';
require_once 'data.php';

$countries = array_unique(array_column($units, 'country'));
sort($countries);



?>