<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Отчёт по работам - DevPortfolio</title>
    <style>
        /* Стили для печати */
        @media print {
            body {
                font-family: 'Times New Roman', Times, serif;
                font-size: 12pt;
                line-height: 1.5;
                color: #000;
                background: #fff;
                margin: 2cm;
            }
            
            h1 {
                font-size: 18pt;
                text-align: center;
                margin-bottom: 20px;
            }
            
            h2 {
                font-size: 14pt;
                margin-top: 20px;
                border-bottom: 1px solid #000;
                padding-bottom: 5px;
            }
            
            table {
                width: 100%;
                border-collapse: collapse;
                margin: 20px 0;
            }
            
            th {
                background: #f0f0f0;
                font-weight: bold;
                text-align: left;
                padding: 8px;
                border: 1px solid #000;
            }
            
            td {
                padding: 8px;
                border: 1px solid #000;
                vertical-align: top;
            }
            
            .status-yes {
                color: #006400;
                font-weight: bold;
            }
            
            .status-no {
                color: #8b0000;
            }
            
            .footer {
                margin-top: 30px;
                font-size: 10pt;
                text-align: center;
                color: #666;
            }
            
            .no-print {
                display: none;
            }
            
            @page {
                size: A4;
                margin: 2cm;
            }
        }
        
        /* Стили для экрана (если нужно предпросмотр) */
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background: #f5f5f5;
        }
        
        .print-container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        
        .print-btn {
            margin-bottom: 20px;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        
        .print-btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <button class="print-btn no-print" onclick="window.print()">
        <i class="fas fa-print"></i> Распечатать / Сохранить PDF
    </button>
    
    <div class="print-container">
        <h1>Отчёт по учебной практике</h1>
        
        <p><strong>Студент:</strong> {{ auth()->user()->name }}</p>
        <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
        <p><strong>Дата формирования:</strong> {{ now()->format('d.m.Y') }}</p>
        
        <h2>Общая статистика</h2>
        <table>
            <tr>
                <th>Всего работ</th>
                <td>{{ $projects->count() }}</td>
            </tr>
            <tr>
                <th>ТЗ сдано</th>
                <td>{{ $projects->where('tz_status', true)->count() }} из {{ $projects->count() }}</td>
            </tr>
            <tr>
                <th>Отчётов сдано</th>
                <td>{{ $projects->where('report_status', true)->count() }} из {{ $projects->count() }}</td>
            </tr>
            <tr>
                <th>Дневников сдано</th>
                <td>{{ $projects->where('diary_status', true)->count() }} из {{ $projects->count() }}</td>
            </tr>
            <tr>
                <th>Проектов с GitHub</th>
                <td>{{ $projects->whereNotNull('github_link')->count() }}</td>
            </tr>
            <tr>
                <th>Проектов с файлами</th>
                <td>{{ $projects->whereNotNull('file_path')->count() }}</td>
            </tr>
            <tr>
                <th>Общее время (часов)</th>
                <td>{{ $projects->sum('hours_spent') }} ч</td>
            </tr>
        </table>
        
        <h2>Список работ</h2>
        
        @if($projects->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>№</th>
                        <th>Название</th>
                        <th>Предмет</th>
                        <th>Дата сдачи</th>
                        <th>ТЗ</th>
                        <th>Отчёт</th>
                        <th>Дневник</th>
                        <th>GitHub</th>
                        <th>Часы</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $index => $project)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $project->title }}</td>
                        <td>{{ $project->subject }}</td>
                        <td>{{ $project->end_date ? date('d.m.Y', strtotime($project->end_date)) : '—' }}</td>
                        <td class="{{ $project->tz_status ? 'status-yes' : 'status-no' }}">
                            {{ $project->tz_status ? '✅' : '❌' }}
                        </td>
                        <td class="{{ $project->report_status ? 'status-yes' : 'status-no' }}">
                            {{ $project->report_status ? '✅' : '❌' }}
                        </td>
                        <td class="{{ $project->diary_status ? 'status-yes' : 'status-no' }}">
                            {{ $project->diary_status ? '✅' : '❌' }}
                        </td>
                        <td>{{ $project->github_link ? '✓' : '—' }}</td>
                        <td>{{ $project->hours_spent ?? '—' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Нет добавленных работ.</p>
        @endif
        
        <div class="footer">
            Отчёт сгенерирован автоматически в системе DevPortfolio
        </div>
    </div>
    
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>