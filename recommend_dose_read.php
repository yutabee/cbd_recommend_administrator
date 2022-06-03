<?php

$file = fopen('data/data.txt', 'r');
flock($file, LOCK_EX);
if ($file) {
    $line = fgets($file);
}
flock($file, LOCK_UN);
fclose($file);
