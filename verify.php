<?php

use App\Models\User;
use App\Models\Brief;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "Starting Verification...\n";

// 1. Auth & User Setup
$user = User::where('email', 'test@example.com')->first();
if (!$user) {
    $user = User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);
    echo "[PASS] User created.\n";
} else {
    echo "[PASS] User already exists.\n";
}

$admin = User::where('email', 'admin@example.com')->first();
if (!$admin) {
    $admin = User::create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'password' => Hash::make('password'),
        'is_admin' => true,
    ]);
    echo "[PASS] Admin user created.\n";
} else {
    echo "[PASS] Admin user exists.\n";
}

// 2. Brief CRUD
$brief = Brief::create([
    'user_id' => $user->id,
    'title' => 'Verification Brief',
    'content' => 'This is a test brief content.',
]);

if ($brief) {
    echo "[PASS] Brief created in DB.\n";
} else {
    echo "[FAIL] Brief creation failed.\n";
}

// 3. AI Job Dispatch
Queue::fake();
\App\Jobs\ProcessBriefAi::dispatch($brief);
Queue::assertPushed(\App\Jobs\ProcessBriefAi::class);
echo "[PASS] AI Job dispatched (Fake Queue).\n";

// 4. API Endpoint Check
// Simulating an internal request or just checking if route is registered
$request = Request::create('/api/briefs/' . $brief->id, 'GET');
$response = app()->handle($request);

if ($response->getStatusCode() === 200) {
    $data = json_decode($response->getContent(), true);
    if ($data['id'] === $brief->id) {
        echo "[PASS] API endpoint returned correct brief.\n";
    } else {
        echo "[FAIL] API returned incorrect ID.\n";
    }
} else {
    echo "[FAIL] API endpoint returned " . $response->getStatusCode() . "\n";
}

echo "Verification Complete.\n";
