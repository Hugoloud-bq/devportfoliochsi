@extends('layouts.app')

@section('title', 'О себе')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-user me-2"></i>
                        О себе
                    </h4>
                    <a href="{{ route('about.edit') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit me-1"></i>Редактировать
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="text-center mb-4">
    @if($about->avatar)
        <img src="{{ asset('storage/' . $about->avatar) }}" 
             alt="Avatar" 
             class="rounded-circle d-block mx-auto mb-3" 
             style="width: 150px; height: 150px; object-fit: cover;">
    @else
        <div class="display-1 text-primary mb-3">
            <i class="fas fa-user-circle"></i>
        </div>
    @endif
    <h2>{{ $about->name }}</h2>
    <p class="text-muted">{{ $about->title }}</p>
</div>

                    @if($about->bio)
                        <div class="mb-4">
                            <h5><i class="fas fa-info-circle me-2"></i>Обо мне</h5>
                            <p>{{ $about->bio }}</p>
                        </div>
                    @endif

                    @if($about->skills)
                        <div class="mb-4">
                            <h5><i class="fas fa-code me-2"></i>Стек технологий</h5>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach(is_array($about->skills) ? $about->skills : [] as $skill)
                                    <span class="badge bg-primary p-2">{{ $skill }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="mb-4">
                        <h5><i class="fas fa-graduation-cap me-2"></i>Образование</h5>
                        <p>
                            <strong>{{ $about->university }}</strong><br>
                            Специальность: {{ $about->specialty }}<br>
                            Курс: {{ $about->course }}
                        </p>
                    </div>

                    @if($about->github || $about->telegram)
<!-- ССЫЛКИ (только заголовок) -->
<h5 class="mb-2" style="margin-top: -10px;">
    <i class="fas fa-link me-2"></i>Ссылки
</h5>

<!-- КНОПКИ (GitHub, Telegram) -->
<div class="d-flex gap-3 mb-4">
    @if($about->github)
        <a href="{{ $about->github }}" target="_blank" class="btn btn-outline-dark">
            <i class="fab fa-github me-2"></i>GitHub
        </a>
    @endif
    @if($about->telegram)
        <a href="https://t.me/{{ str_replace('@', '', $about->telegram) }}" target="_blank" class="btn btn-outline-primary">
            <i class="fab fa-telegram me-2"></i>Telegram
        </a>
    @endif
</div>
                    @endif

                    @if($about->email)
                        <div class="alert alert-info">
                            <i class="fas fa-envelope me-2"></i>
                            <strong>Email:</strong> {{ $about->email }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection