<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$project = App\Models\Project::latest()->first();
echo "ID: " . $project->id . "\n";
echo "Title: " . $project->title . "\n";
echo "File path: " . ($project->file_path ?? 'NULL') . "\n";
echo "\nВсе данные:\n";
print_r($project->toArray());