@extends('layouts.app')

@section('title', 'Редактировать: ' . $project->title)

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-transparent">
                    <h4 class="mb-0">
                        <i class="fas fa-edit me-2"></i>
                        Редактировать: {{ $project->title }}
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label class="form-label">Название <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" value="{{ $project->title }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Предмет <span class="text-danger">*</span></label>
                            <input type="text" name="subject" class="form-control" value="{{ $project->subject }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Описание</label>
                            <textarea name="description" class="form-control" rows="3">{{ $project->description }}</textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Ссылка на GitHub</label>
                            <input type="url" name="github_link" class="form-control" value="{{ $project->github_link }}">
                        </div>

<div class="mb-3">
    <label class="form-label">Заменить файл (отчёт, документация)</label>
    <input type="file" class="form-control" name="file">
    @if($project->file_path)
        <small class="form-text text-muted">
            Текущий файл: 
            <a href="{{ asset('storage/' . $project->file_path) }}" target="_blank">
                <i class="fas fa-download me-1"></i>Скачать
            </a>
        </small>
    @endif
</div>
<!-- СКРИНШОТЫ -->
<div class="mb-3">
    <label class="form-label">Добавить новые скриншоты</label>
    <input type="file" class="form-control" name="screenshots[]" multiple accept="image/*">
    <small class="text-muted">Можно выбрать несколько фото (jpg, png)</small>
    
    @if($project->screenshots->count() > 0)
        <div class="mt-2">
            <label class="form-label">Текущие скриншоты:</label>
            <div class="row">
                @foreach($project->screenshots as $screenshot)
                <div class="col-md-3 mb-2">
                    <div class="position-relative">
                        <img src="{{ asset('storage/' . $screenshot->path) }}" class="img-fluid rounded" style="max-height: 80px;">
                        <form action="{{ route('screenshots.destroy', $screenshot->id) }}" method="POST" class="position-absolute top-0 end-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Удалить скриншот?')">
                                <i class="fas fa-times"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

                        <!-- ДАТЫ И СРОКИ -->
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Дата начала</label>
                                <input type="date" name="start_date" class="form-control" value="{{ $project->start_date }}">
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Дата сдачи</label>
                                <input type="date" name="end_date" class="form-control" value="{{ $project->end_date }}">
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Часов затрачено</label>
                                <input type="number" name="hours_spent" class="form-control" min="0" step="1" value="{{ $project->hours_spent }}">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label d-block">Статусы</label>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="tz_status" class="form-check-input" value="1" {{ $project->tz_status ? 'checked' : '' }}>
                                <label class="form-check-label">ТЗ сдано</label>
                            </div>
                            
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="report_status" class="form-check-input" value="1" {{ $project->report_status ? 'checked' : '' }}>
                                <label class="form-check-label">Отчёт сдан</label>
                            </div>
                            
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="diary_status" class="form-check-input" value="1" {{ $project->diary_status ? 'checked' : '' }}>
                                <label class="form-check-label">Дневник сдан</label>
                            </div>
                        </div>
                        
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary btn-custom">
                                <i class="fas fa-save me-2"></i>Сохранить изменения
                            </button>
                            <a href="{{ route('projects.show', $project->id) }}" class="btn btn-secondary btn-custom">
                                <i class="fas fa-times me-2"></i>Отмена
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection