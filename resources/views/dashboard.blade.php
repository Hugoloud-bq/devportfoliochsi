@extends('layouts.app')

@section('title', 'Статистика')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card fade-in">
                <div class="card-header bg-transparent">
                    <h4 class="mb-0">
                        <i class="fas fa-chart-bar me-2"></i>
                        Статистика
                    </h4>
                </div>
                <div class="card-body">
                    
                    @php
                        $projects = Auth::user()->projects;
                        $total = $projects->count();
                        $tzDone = $projects->where('tz_status', true)->count();
                        $reportDone = $projects->where('report_status', true)->count();
                        $diaryDone = $projects->where('diary_status', true)->count();
                        $withGit = $projects->whereNotNull('github_link')->count();
                        $withFile = $projects->whereNotNull('file_path')->count();
                        
                        $months = [];
                        $monthData = [];
                        for ($i = 5; $i >= 0; $i--) {
                            $month = now()->subMonths($i);
                            $months[] = $month->format('M Y');
                            $monthData[] = $projects->where('created_at', '>=', $month->copy()->startOfMonth())
                                                     ->where('created_at', '<=', $month->copy()->endOfMonth())
                                                     ->count();
                        }
                    @endphp

                    @if($total > 0)
                        <!-- Карточки с цифрами (в стиле общего дизайна) -->
                        <div class="row g-4 mb-5">
                            <div class="col-md-6 col-lg-4 col-xl-2">
                                <div class="card text-center p-3 fade-in delay-1">
                                    <div class="card-body">
                                        <h2 class="text-primary fw-bold">{{ $total }}</h2>
                                        <p class="text-muted mb-0">Всего работ</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-lg-4 col-xl-2">
                                <div class="card text-center p-3 fade-in delay-1">
                                    <div class="card-body">
                                        <h2 class="text-success fw-bold">{{ $tzDone }}</h2>
                                        <p class="text-muted mb-0">ТЗ сдано</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-lg-4 col-xl-2">
                                <div class="card text-center p-3 fade-in delay-2">
                                    <div class="card-body">
                                        <h2 class="text-info fw-bold">{{ $reportDone }}</h2>
                                        <p class="text-muted mb-0">Отчётов</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-lg-4 col-xl-2">
                                <div class="card text-center p-3 fade-in delay-2">
                                    <div class="card-body">
                                        <h2 class="text-warning fw-bold">{{ $diaryDone }}</h2>
                                        <p class="text-muted mb-0">Дневников</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-lg-4 col-xl-2">
                                <div class="card text-center p-3 fade-in delay-3">
                                    <div class="card-body">
                                        <h2 class="text-secondary fw-bold">{{ $withGit }}</h2>
                                        <p class="text-muted mb-0">GitHub</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-lg-4 col-xl-2">
                                <div class="card text-center p-3 fade-in delay-3">
                                    <div class="card-body">
                                        <h2 class="text-purple fw-bold" style="color: #a855f7;">{{ $withFile }}</h2>
                                        <p class="text-muted mb-0">Файлы</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Графики -->
                        <div class="row g-4 mb-5">
                            <div class="col-md-6">
                                <div class="card p-4 fade-in delay-4">
                                    <h5 class="card-title mb-4">
                                        <i class="fas fa-tasks me-2 text-primary"></i>
                                        Прогресс выполнения
                                    </h5>
                                    <canvas id="progressChart"></canvas>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="card p-4 fade-in delay-4">
                                    <h5 class="card-title mb-4">
                                        <i class="fas fa-calendar-alt me-2 text-primary"></i>
                                        Динамика за полгода
                                    </h5>
                                    <canvas id="timelineChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card p-4 fade-in delay-5">
                                    <h5 class="card-title mb-4">
                                        <i class="fas fa-chart-pie me-2 text-primary"></i>
                                        Статус ТЗ
                                    </h5>
                                    <canvas id="statusChart"></canvas>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="card p-4 fade-in delay-5">
                                    <h5 class="card-title mb-4">
                                        <i class="fas fa-percent me-2 text-primary"></i>
                                        Прогресс по пунктам
                                    </h5>
                                    
                                    @php
                                        $tzPercent = $total > 0 ? round(($tzDone / $total) * 100) : 0;
                                        $reportPercent = $total > 0 ? round(($reportDone / $total) * 100) : 0;
                                        $diaryPercent = $total > 0 ? round(($diaryDone / $total) * 100) : 0;
                                        $gitPercent = $total > 0 ? round(($withGit / $total) * 100) : 0;
                                        $filePercent = $total > 0 ? round(($withFile / $total) * 100) : 0;
                                    @endphp

                                    @foreach([
                                        ['label' => 'ТЗ', 'percent' => $tzPercent, 'color' => 'bg-success'],
                                        ['label' => 'Отчёты', 'percent' => $reportPercent, 'color' => 'bg-info'],
                                        ['label' => 'Дневники', 'percent' => $diaryPercent, 'color' => 'bg-warning'],
                                        ['label' => 'GitHub', 'percent' => $gitPercent, 'color' => 'bg-secondary'],
                                        ['label' => 'Файлы', 'percent' => $filePercent, 'color' => 'bg-primary']
                                    ] as $item)
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between mb-1">
                                                <span>{{ $item['label'] }}</span>
                                                <span>{{ $item['percent'] }}% ({{ $total > 0 ? round(($item['percent']/100)*$total) : 0 }}/{{ $total }})</span>
                                            </div>
                                            <div class="progress" style="height: 10px;">
                                                <div class="progress-bar {{ $item['color'] }}" role="progressbar" 
                                                     style="width: {{ $item['percent'] }}%;" 
                                                     aria-valuenow="{{ $item['percent'] }}" 
                                                     aria-valuemin="0" 
                                                     aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script>
                            // Прогресс выполнения
                            new Chart(document.getElementById('progressChart'), {
                                type: 'bar',
                                data: {
                                    labels: ['ТЗ', 'Отчёты', 'Дневники', 'GitHub', 'Файлы'],
                                    datasets: [{
                                        label: 'Выполнено',
                                        data: [{{ $tzDone }}, {{ $reportDone }}, {{ $diaryDone }}, {{ $withGit }}, {{ $withFile }}],
                                        backgroundColor: ['#22c55e', '#06b6d4', '#eab308', '#6c757d', '#a855f7']
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        legend: {
                                            display: false
                                        }
                                    }
                                }
                            });

                            // Динамика по месяцам
                            new Chart(document.getElementById('timelineChart'), {
                                type: 'line',
                                data: {
                                    labels: {!! json_encode($months) !!},
                                    datasets: [{
                                        label: 'Добавлено работ',
                                        data: {{ json_encode($monthData) }},
                                        borderColor: '#667eea',
                                        backgroundColor: 'rgba(102, 126, 234, 0.1)',
                                        tension: 0.1,
                                        fill: true
                                    }]
                                },
                                options: {
                                    responsive: true
                                }
                            });

                            // Статус ТЗ (круговая)
                            new Chart(document.getElementById('statusChart'), {
                                type: 'doughnut',
                                data: {
                                    labels: ['Сдано', 'Не сдано'],
                                    datasets: [{
                                        data: [{{ $tzDone }}, {{ $total - $tzDone }}],
                                        backgroundColor: ['#22c55e', '#ef4444']
                                    }]
                                },
                                options: {
                                    responsive: true
                                }
                            });
                        </script>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-folder-open fa-4x text-muted mb-3"></i>
                            <h3>Нет проектов</h3>
                            <p class="text-muted mb-4">Добавьте свою первую работу, чтобы увидеть статистику</p>
                            <a href="{{ route('projects.create') }}" class="btn btn-primary btn-custom">
                                <i class="fas fa-plus-circle me-2"></i>Добавить работу
                            </a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection