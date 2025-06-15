<?php

require 'vendor/autoload.php';

$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Total stocks: " . App\Models\ErrorPage::count() . PHP_EOL;

foreach (App\Models\ErrorPage::all() as $stock) {
    echo "ID: {$stock->id}, User ID: " . ($stock->user_id ?: 'NULL') . ", Title: {$stock->title}" . PHP_EOL;
}
