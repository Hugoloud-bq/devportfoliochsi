@extends('layouts.app')

@section('title', 'Мои работы')

@section('content')
<div class="container">
    @php
        $hasProjects = \App\Models\Project::count() > 0;
    @endphp

    @if($hasProjects)
        <!-- Шапка с кнопкой "Добавить работу" (отдельно, под навигацией) -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-white">
                <i class="fas fa-folder-open me-2"></i>
                Мои проекты и лабораторные работы
            </h1>
            <div>
                <a href="{{ route('projects.print') }}" target="_blank" class="btn btn-secondary me-2">
                    <i class="fas fa-print me-2"></i>Печать
                </a>
                <a href="{{ route('projects.export') }}" class="btn btn-success me-2">
                    <i class="fas fa-download me-2"></i>Excel
                </a>
                <a href="{{ route('projects.create') }}" class="btn btn-light btn-custom">
                    <i class="fas fa-plus-circle me-2"></i>Добавить работу
                </a>
            </div>
        </div>

        <!-- Панель фильтров -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('projects.index') }}" class="row g-3">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" name="search" class="form-control" placeholder="Поиск по названию..." value="{{ request('search') }}">
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <select name="status" class="form-select">
                            <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Все работы</option>
                            <option value="tz" {{ request('status') == 'tz' ? 'selected' : '' }}>✅ ТЗ сдано</option>
                            <option value="report" {{ request('status') == 'report' ? 'selected' : '' }}>📄 Отчёт сдан</option>
                            <option value="diary" {{ request('status') == 'diary' ? 'selected' : '' }}>📔 Дневник сдан</option>
                            <option value="github" {{ request('status') == 'github' ? 'selected' : '' }}>🐙 Есть GitHub</option>
                            <option value="file" {{ request('status') == 'file' ? 'selected' : '' }}>📎 Есть файл</option>
                        </select>
                    </div>
                    
                    <div class="col-md-3">
                        <select name="sort" class="form-select">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>📅 Сначала новые</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>📅 Сначала старые</option>
                            <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>🔤 По названию</option>
                            <option value="subject" {{ request('sort') == 'subject' ? 'selected' : '' }}>📚 По предмету</option>
                            <option value="status" {{ request('sort') == 'status' ? 'selected' : '' }}>✅ По статусу</option>
                        </select>
                    </div>
                    
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-filter me-1"></i>Применить
                        </button>
                    </div>
                    
                    @if(request()->anyFilled(['search', 'status', 'sort']))
                    <div class="col-12">
                        <a href="{{ route('projects.index') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-times me-1"></i>Сбросить фильтры
                        </a>
                    </div>
                    @endif
                </form>
            </div>
        </div>

        <!-- Список проектов -->
        <div class="row">
            @foreach($projects as $project)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header bg-transparent border-0 pt-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-file-code text-primary me-2"></i>
                                    {{ $project->title }}
                                </h5>
                                <span class="badge bg-info">{{ $project->subject }}</span>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <p class="card-text text-muted">
                                {{ Str::limit($project->description, 100) ?: 'Нет описания' }}
                            </p>
                            
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">ТЗ</span>
                                    @if($project->tz_status)
                                        <span class="status-badge bg-success text-white">
                                            <i class="fas fa-check-circle me-1"></i>Сдано
                                        </span>
                                    @else
                                        <span class="status-badge bg-danger text-white">
                                            <i class="fas fa-times-circle me-1"></i>Не сдано
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Отчёт</span>
                                    @if($project->report_status)
                                        <span class="status-badge bg-success text-white">
                                            <i class="fas fa-check-circle me-1"></i>Сдано
                                        </span>
                                    @else
                                        <span class="status-badge bg-danger text-white">
                                            <i class="fas fa-times-circle me-1"></i>Не сдано
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Дневник</span>
                                    @if($project->diary_status)
                                        <span class="status-badge bg-success text-white">
                                            <i class="fas fa-check-circle me-1"></i>Сдано
                                        </span>
                                    @else
                                        <span class="status-badge bg-danger text-white">
                                            <i class="fas fa-times-circle me-1"></i>Не сдано
                                        </span>
                                    @endif
                                </div>
                            </div>

                            @if($project->github_link)
                                <div class="mb-3">
                                    <a href="{{ $project->github_link }}" target="_blank" class="text-decoration-none">
                                        <i class="fab fa-github me-1"></i>GitHub
                                    </a>
                                </div>
                            @endif

                            @if($project->file_path)
                                <div class="mb-3">
                                    <a href="{{ asset('storage/' . $project->file_path) }}" target="_blank" class="text-decoration-none">
                                        <i class="fas fa-paperclip me-1"></i>Файл
                                    </a>
                                </div>
                            @endif
                        </div>

                        <div class="card-footer bg-transparent border-0 pb-3">
                            <div class="d-flex gap-2">
                                <a href="{{ route('projects.show', $project->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye me-1"></i>Просмотр
                                </a>
                                <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="fas fa-edit me-1"></i>Ред.
                                </a>
                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Точно удалить?')">
                                        <i class="fas fa-trash me-1"></i>Удалить
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Пустое состояние (нет проектов) -->
        <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
            <div class="col-md-6">
                <div class="card text-center p-5">
                    <div class="card-body">
                        <i class="fas fa-folder-open fa-5x text-muted mb-4"></i>
                        <h2 class="mb-3">Здесь пока пусто</h2>
                        <p class="text-muted mb-4">Добавьте свою первую работу, чтобы начать портфолио</p>
                        <a href="{{ route('projects.create') }}" class="btn btn-primary btn-lg px-5 py-3">
                            <i class="fas fa-plus-circle me-2"></i>Добавить работу
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection