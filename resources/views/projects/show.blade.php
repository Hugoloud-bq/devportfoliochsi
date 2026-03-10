@extends('layouts.app')

@section('title', $project->title)

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        {{ $project->title }}
                    </h4>
                    <a href="{{ route('projects.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>Назад
                    </a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th style="width: 200px;">Предмет</th>
                            <td>
                                <span class="badge bg-info">{{ $project->subject }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Описание</th>
                            <td>{{ $project->description ?: 'Нет описания' }}</td>
                        </tr>
                        <tr>
                            <th>Ссылка GitHub</th>
                            <td>
                                @if($project->github_link)
                                    <a href="{{ $project->github_link }}" target="_blank">
                                        <i class="fab fa-github me-1"></i>{{ $project->github_link }}
                                    </a>
                                @else
                                    <span class="text-muted">Нет ссылки</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Прикреплённый файл</th>
                            <td>
                                @if($project->file_path)
                                    <a href="{{ asset('storage/' . $project->file_path) }}" target="_blank" class="btn btn-sm btn-success">
                                        <i class="fas fa-download me-1"></i>Скачать файл
                                    </a>
                                @else
                                    <span class="text-muted">Нет файла</span>
                                @endif
                            </td>
                        </tr>
                        
                        <!-- ⬇️ ⬇️ ⬇️ СЮДА ВСТАВЛЯЕМ СКРИНШОТЫ ⬇️ ⬇️ ⬇️ -->
                        @if($project->screenshots->count() > 0)
                        <tr>
                            <th>Скриншоты</th>
                            <td>
                                <div class="row">
                                    @foreach($project->screenshots as $screenshot)
                                    <div class="col-md-4 mb-3">
                                        <a href="{{ asset('storage/' . $screenshot->path) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $screenshot->path) }}" 
                                                 class="img-fluid rounded shadow" 
                                                 style="max-height: 100px; object-fit: cover;">
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                        @endif
                        <!-- ⬆️ ⬆️ ⬆️ ДОСЮДА ⬆️ ⬆️ ⬆️ -->
                        
                        <tr>
                            <th>Статус ТЗ</th>
                            <td>
                                @if($project->tz_status)
                                    <span class="status-badge bg-success text-white">
                                        <i class="fas fa-check-circle me-1"></i>Сдано
                                    </span>
                                @else
                                    <span class="status-badge bg-danger text-white">
                                        <i class="fas fa-times-circle me-1"></i>Не сдано
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Статус отчёта</th>
                            <td>
                                @if($project->report_status)
                                    <span class="status-badge bg-success text-white">
                                        <i class="fas fa-check-circle me-1"></i>Сдано
                                    </span>
                                @else
                                    <span class="status-badge bg-danger text-white">
                                        <i class="fas fa-times-circle me-1"></i>Не сдано
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Статус дневника</th>
                            <td>
                                @if($project->diary_status)
                                    <span class="status-badge bg-success text-white">
                                        <i class="fas fa-check-circle me-1"></i>Сдано
                                    </span>
                                @else
                                    <span class="status-badge bg-danger text-white">
                                        <i class="fas fa-times-circle me-1"></i>Не сдано
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Дата начала</th>
                            <td>{{ $project->start_date ? date('d.m.Y', strtotime($project->start_date)) : 'Не указана' }}</td>
                        </tr>
                        <tr>
                            <th>Дата сдачи</th>
                            <td>{{ $project->end_date ? date('d.m.Y', strtotime($project->end_date)) : 'Не указана' }}</td>
                        </tr>
                        <tr>
                            <th>Часов затрачено</th>
                            <td>{{ $project->hours_spent ?? 'Не указано' }} {{ $project->hours_spent ? 'ч' : '' }}</td>
                        </tr>
                        <tr>
                            <th>Дата создания</th>
                            <td><i class="far fa-calendar-alt me-1"></i>{{ $project->created_at->format('d.m.Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Дата обновления</th>
                            <td><i class="far fa-calendar-alt me-1"></i>{{ $project->updated_at->format('d.m.Y H:i') }}</td>
                        </tr>
                    </table>
                    
                    <!-- Кнопки действий -->
                    <div class="d-flex gap-2 mt-3 flex-wrap">
                        <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning btn-custom">
                            <i class="fas fa-edit me-2"></i>Редактировать
                        </a>
                        
                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-custom" onclick="return confirm('Точно удалить?')">
                                <i class="fas fa-trash me-2"></i>Удалить
                            </button>
                        </form>
                        
                        <!-- Кнопка поделиться -->
                        <button class="btn btn-info btn-custom" onclick="copyToClipboard('{{ $project->share_url }}')">
                            <i class="fas fa-share-alt me-2"></i>Поделиться
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function copyToClipboard(url) {
    navigator.clipboard.writeText(url).then(() => {
        alert('✅ Ссылка скопирована в буфер обмена!\n\nТеперь вы можете отправить её преподавателю.');
    }).catch(err => {
        alert('❌ Не удалось скопировать ссылку. Попробуйте выделить и скопировать вручную:\n' + url);
    });
}
</script>
@endsection