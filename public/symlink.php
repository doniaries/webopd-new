<?php
$target = $_SERVER['DOCUMENT_ROOT'] . '/../storage/app/public';
$link = $_SERVER['DOCUMENT_ROOT'] . '/storage';

if (file_exists($link)) {
    echo "Link already exists at $link";
    exit;
}

if (symlink($target, $link)) {
    echo "Symlink created successfully: $link -> $target";
} else {
    echo "Failed to create symlink. Ensure target exists: $target";
}
