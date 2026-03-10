<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Project;
use Illuminate\Http\Request;


class ProjectController extends Controller
{
    public function index(Request $request)
{
    $query = Project::where('user_id', auth()->id());

    // Поиск по названию
    if ($request->filled('search')) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    // Фильтр по статусу
    if ($request->filled('status')) {
        switch($request->status) {
            case 'tz':
                $query->where('tz_status', true);
                break;
            case 'report':
                $query->where('report_status', true);
                break;
            case 'diary':
                $query->where('diary_status', true);
                break;
            case 'github':
                $query->whereNotNull('github_link');
                break;
            case 'file':
                $query->whereNotNull('file_path');
                break;
            case 'all':
                // без фильтра
                break;
        }
    }

    // Сортировка
    switch($request->get('sort', 'newest')) {
        case 'oldest':
            $query->oldest();
            break;
        case 'title':
            $query->orderBy('title');
            break;
        case 'subject':
            $query->orderBy('subject');
            break;
        case 'status':
            $query->orderBy('tz_status')->orderBy('report_status')->orderBy('diary_status');
            break;
        default: // newest
            $query->latest();
            break;
    }

    $projects = $query->get();
    
    return view('projects.index', compact('projects'));
}

    public function create()
    {
        return view('projects.create');
    }

public function store(Request $request)
{
    $data = $request->validate([
        'title' => 'required',
        'subject' => 'required',
        'description' => 'nullable',
        'github_link' => 'nullable|url',
        'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date',
        'hours_spent' => 'nullable|integer',
        'screenshots.*' => 'nullable|image|max:2048'
    ]);

    // Добавляем чекбоксы
    $data['tz_status'] = $request->has('tz_status') ? true : false;
    $data['report_status'] = $request->has('report_status') ? true : false;
    $data['diary_status'] = $request->has('diary_status') ? true : false;

    // ВАЖНО: добавляем user_id
    $data['user_id'] = auth()->id();

    // Обработка файла
    if ($request->hasFile('file')) {
        $path = $request->file('file')->store('uploads', 'public');
        $data['file_path'] = $path;
    }

    // СОЗДАЁМ ПРОЕКТ (ОДИН РАЗ!)
    $project = Project::create($data);

    // Сохраняем скриншоты
    if ($request->hasFile('screenshots')) {
        foreach($request->file('screenshots') as $screenshot) {
            $path = $screenshot->store('screenshots', 'public');
            $project->screenshots()->create(['path' => $path]);
        }
    }

    return redirect()->route('projects.index')->with('success', '✅ Работа успешно добавлена!');
}
public function shared($token)
{
    $project = Project::where('share_token', $token)->firstOrFail();
    return view('projects.shared', compact('project'));
}
public function print()
{
    $projects = Project::where('user_id', auth()->id())->get();
    return view('projects.print', compact('projects'));
}

    public function show(Project $project)
    {
        // Проверяем, принадлежит ли проект текущему пользователю
        if ($project->user_id !== auth()->id()) {
            abort(403, 'У вас нет доступа к этому проекту.');
        }
        
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        // Проверяем, принадлежит ли проект текущему пользователю
        if ($project->user_id !== auth()->id()) {
            abort(403, 'У вас нет доступа к этому проекту.');
        }
        
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        // Проверяем, принадлежит ли проект текущему пользователю
        if ($project->user_id !== auth()->id()) {
            abort(403, 'У вас нет доступа к этому проекту.');
        }

        $data = $request->validate([
            'start_date' => 'nullable|date',
'end_date' => 'nullable|date|after_or_equal:start_date',
'hours_spent' => 'nullable|integer|min:0',
            'title' => 'required',
            'subject' => 'required',
            'description' => 'nullable',
            'github_link' => 'nullable|url',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048',
            'tz_status' => 'boolean',
            'report_status' => 'boolean',
            'diary_status' => 'boolean',
        ]);

        if ($request->hasFile('file')) {
            // Удаляем старый файл, если есть
            if ($project->file_path) {
                Storage::disk('public')->delete($project->file_path);
            }
            $path = $request->file('file')->store('uploads', 'public');
            $data['file_path'] = $path;
        }

$project->update($data);
return redirect()->route('projects.index')->with('success', '✏️ Работа обновлена!');
    }

    public function destroy(Project $project)
    {
        // Проверяем, принадлежит ли проект текущему пользователю
        if ($project->user_id !== auth()->id()) {
            abort(403, 'У вас нет доступа к этому проекту.');
        }

        // Удаляем файл, если есть
        if ($project->file_path) {
            Storage::disk('public')->delete($project->file_path);
        }
        
$project->delete();
return redirect()->route('projects.index')->with('success', '🗑️ Работа удалена!');
    }
}