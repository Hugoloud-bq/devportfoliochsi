@extends('layouts.app')

@section('title', 'Добавить работу')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-transparent">
                    <h4 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>
                        Добавить новую работу
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Скриншоты</label>
                            <input type="file" class="form-control" name="screenshots[]" multiple accept="image/*">
                            <small class="text-muted">Можно выбрать несколько фото (jpg, png)</small>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Название <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Предмет <span class="text-danger">*</span></label>
                            <input type="text" name="subject" class="form-control" required>
                        </div>
                        
                        <!-- КНОПКА ИИ -->
                        <div class="mb-3">
                            <button type="button" id="generateDescBtn" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-magic me-1"></i>Сгенерировать описание через ИИ
                            </button>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Описание</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Ссылка на GitHub</label>
                            <input type="url" name="github_link" class="form-control" placeholder="https://github.com/...">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Файл (отчёт, документация)</label>
                            <input type="file" class="form-control" name="file">
                            <small class="text-muted">PDF, Word, Excel (макс. 2МБ)</small>
                        </div>

                        <!-- ДАТЫ И СРОКИ -->
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Дата начала</label>
                                <input type="date" name="start_date" class="form-control">
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Дата сдачи</label>
                                <input type="date" name="end_date" class="form-control">
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Часов затрачено</label>
                                <input type="number" name="hours_spent" class="form-control" min="0" step="1">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label d-block">Статусы</label>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="tz_status" class="form-check-input" value="1">
                                <label class="form-check-label">ТЗ сдано</label>
                            </div>
                            
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="report_status" class="form-check-input" value="1">
                                <label class="form-check-label">Отчёт сдан</label>
                            </div>
                            
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="diary_status" class="form-check-input" value="1">
                                <label class="form-check-label">Дневник сдан</label>
                            </div>
                        </div>
                        
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success btn-custom">
                                <i class="fas fa-save me-2"></i>Сохранить
                            </button>
                            <a href="{{ route('projects.index') }}" class="btn btn-secondary btn-custom">
                                <i class="fas fa-times me-2"></i>Отмена
                            </a>
                        </div>
                    </form>

                    @if($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- СКРИПТ ДЛЯ ИИ -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const generateBtn = document.getElementById('generateDescBtn');
    
    if (generateBtn) {
        generateBtn.addEventListener('click', function() {
            const title = document.querySelector('input[name="title"]').value;
            const subject = document.querySelector('input[name="subject"]').value;
            const descriptionField = document.querySelector('textarea[name="description"]');
            
            if (!title) {
                alert('Сначала введите название работы');
                return;
            }
            
            const prompt = title + (subject ? ' по предмету ' + subject : '');
            
            this.disabled = true;
            this.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Генерация...';
            
            fetch('{{ route("generate.description") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ prompt: prompt })
            })
            .then(response => response.json())
            .then(data => {
                if (data.description) {
                    descriptionField.value = data.description;
                } else if (data.error) {
                    alert('Ошибка: ' + data.error);
                }
            })
            .catch(error => {
                alert('Ошибка при генерации');
                console.error(error);
            })
            .finally(() => {
                this.disabled = false;
                this.innerHTML = '<i class="fas fa-magic me-1"></i>Сгенерировать описание через ИИ';
            });
        });
    }
});
</script>
@endsection