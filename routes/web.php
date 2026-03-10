<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;
use App\Exports\ProjectsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

/*
|--------------------------------------------------------------------------
| Главная страница (доступна всем)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    if (auth()->check()) {
        return view('home');
    } else {
        return view('auth-guest');
    }
})->name('home');

Route::get('/projects/export', function () {
    return Excel::download(new ProjectsExport(auth()->id()), 'мои-работы.xlsx');
})->name('projects.export')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Маршруты, требующие авторизации
|--------------------------------------------------------------------------
*/
Route::get('/print', [App\Http\Controllers\ProjectController::class, 'print'])->name('projects.print')->middleware('auth');
Route::get('/shared/{token}', [App\Http\Controllers\ProjectController::class, 'shared'])->name('projects.shared');
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Проекты (CRUD)
    Route::resource('projects', ProjectController::class);
    
    // Генерация описания через ИИ
    Route::post('/generate-description', function (Request $request) {
    $prompt = $request->input('prompt');
    
    $client = new Client();
    
    try {
        $response = $client->post('https://openrouter.ai/api/v1/chat/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . env('OPENROUTER_API_KEY'),
                'Content-Type' => 'application/json',
                'HTTP-Referer' => url('/'),  // ОБЯЗАТЕЛЬНО для free моделей
                'X-Title' => 'DevPortfolio', // ОБЯЗАТЕЛЬНО для free моделей
            ],
            'json' => [
                'model' => 'openrouter/free', // УНИВЕРСАЛЬНЫЙ БЕСПЛАТНЫЙ РОУТЕР
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => "Напиши краткое описание для лабораторной работы или проекта на тему: {$prompt}. Описание должно быть 2-3 предложения, профессиональным и полезным для портфолио. Только текст описания, без лишних слов."
                    ]
                ],
                'temperature' => 0.7,
                
            ]
        ]);
        
        $result = json_decode($response->getBody(), true);
        $description = $result['choices'][0]['message']['content'] ?? 'Не удалось сгенерировать описание';
        
        return response()->json(['description' => trim($description)]);
        
    } catch (\Exception $e) {
        // Ловим ошибку и возвращаем понятный ответ
        return response()->json(['error' => $e->getMessage()], 500);
    }
})->name('generate.description');
    
    // О себе
    Route::get('/about', [AboutController::class, 'index'])->name('about');
    Route::get('/about/edit', [AboutController::class, 'edit'])->name('about.edit');
    Route::post('/about/update', [AboutController::class, 'update'])->name('about.update');
    
    // Профиль
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/test', function () {
        return view('dashboard');
    })->name('test');
});

/*
|--------------------------------------------------------------------------
| Auth routes
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';