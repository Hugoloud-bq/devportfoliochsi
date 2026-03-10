<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $project->title }} (публичный просмотр)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .public-badge {
            position: fixed;
            top: 10px;
            right: 10px;
            background: rgba(255,255,255,0.9);
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 14px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="public-badge">
        <i class="fas fa-eye me-1"></i> Публичный просмотр
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fas fa-info-circle me-2"></i>
                            {{ $project->title }}
                        </h4>
                        <span class="badge bg-info">{{ $project->subject }}</span>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th style="width: 200px;">Описание</th>
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
                        </table>
                        
                        <div class="alert alert-info mt-3">
                            <i class="fas fa-info-circle me-2"></i>
                            Это публичная ссылка. Данные доступны только для просмотра.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>