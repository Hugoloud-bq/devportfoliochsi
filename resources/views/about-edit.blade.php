@extends('layouts.app')

@section('title', 'Редактировать профиль')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-edit me-2"></i>
                        Редактировать профиль
                    </h4>
                    <a href="{{ route('about') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>Назад
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('about.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Имя</label>
                                <input type="text" name="name" class="form-control" value="{{ $about->name }}" required>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Должность</label>
                                <input type="text" name="title" class="form-control" value="{{ $about->title }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">О себе</label>
                            <textarea name="bio" class="form-control" rows="4">{{ $about->bio }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $about->email }}">
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">GitHub</label>
                                <input type="url" name="github" class="form-control" value="{{ $about->github }}" placeholder="https://github.com/...">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Telegram</label>
                                <input type="text" name="telegram" class="form-control" value="{{ $about->telegram }}" placeholder="@username">
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Аватар</label>
                                <input type="file" name="avatar" class="form-control">
                                @if($about->avatar)
                                    <small class="form-text text-muted">
                                        Текущий: <a href="{{ asset('storage/' . $about->avatar) }}" target="_blank">Фото</a>
                                    </small>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Учебное заведение</label>
                                <input type="text" name="university" class="form-control" value="{{ $about->university }}" required>
                            </div>
                            
                            <div class="col-md-5 mb-3">
                                <label class="form-label">Специальность</label>
                                <input type="text" name="specialty" class="form-control" value="{{ $about->specialty }}" required>
                            </div>
                            
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Курс</label>
                                <input type="number" name="course" class="form-control" value="{{ $about->course }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Навыки (через запятую)</label>
                            <input type="text" name="skills" class="form-control" value="{{ is_array($about->skills) ? implode(', ', $about->skills) : '' }}" placeholder="PHP, Laravel, MySQL, ...">
                        </div>

                        <button type="submit" class="btn btn-primary btn-custom">
                            <i class="fas fa-save me-2"></i>Сохранить изменения
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection