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
        
        <p><strong>Студент:</strong> <?php echo e(auth()->user()->name); ?></p>
        <p><strong>Email:</strong> <?php echo e(auth()->user()->email); ?></p>
        <p><strong>Дата формирования:</strong> <?php echo e(now()->format('d.m.Y')); ?></p>
        
        <h2>Общая статистика</h2>
        <table>
            <tr>
                <th>Всего работ</th>
                <td><?php echo e($projects->count()); ?></td>
            </tr>
            <tr>
                <th>ТЗ сдано</th>
                <td><?php echo e($projects->where('tz_status', true)->count()); ?> из <?php echo e($projects->count()); ?></td>
            </tr>
            <tr>
                <th>Отчётов сдано</th>
                <td><?php echo e($projects->where('report_status', true)->count()); ?> из <?php echo e($projects->count()); ?></td>
            </tr>
            <tr>
                <th>Дневников сдано</th>
                <td><?php echo e($projects->where('diary_status', true)->count()); ?> из <?php echo e($projects->count()); ?></td>
            </tr>
            <tr>
                <th>Проектов с GitHub</th>
                <td><?php echo e($projects->whereNotNull('github_link')->count()); ?></td>
            </tr>
            <tr>
                <th>Проектов с файлами</th>
                <td><?php echo e($projects->whereNotNull('file_path')->count()); ?></td>
            </tr>
            <tr>
                <th>Общее время (часов)</th>
                <td><?php echo e($projects->sum('hours_spent')); ?> ч</td>
            </tr>
        </table>
        
        <h2>Список работ</h2>
        
        <?php if($projects->count() > 0): ?>
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
                    <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($index + 1); ?></td>
                        <td><?php echo e($project->title); ?></td>
                        <td><?php echo e($project->subject); ?></td>
                        <td><?php echo e($project->end_date ? date('d.m.Y', strtotime($project->end_date)) : '—'); ?></td>
                        <td class="<?php echo e($project->tz_status ? 'status-yes' : 'status-no'); ?>">
                            <?php echo e($project->tz_status ? '✅' : '❌'); ?>

                        </td>
                        <td class="<?php echo e($project->report_status ? 'status-yes' : 'status-no'); ?>">
                            <?php echo e($project->report_status ? '✅' : '❌'); ?>

                        </td>
                        <td class="<?php echo e($project->diary_status ? 'status-yes' : 'status-no'); ?>">
                            <?php echo e($project->diary_status ? '✅' : '❌'); ?>

                        </td>
                        <td><?php echo e($project->github_link ? '✓' : '—'); ?></td>
                        <td><?php echo e($project->hours_spent ?? '—'); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Нет добавленных работ.</p>
        <?php endif; ?>
        
        <div class="footer">
            Отчёт сгенерирован автоматически в системе DevPortfolio
        </div>
    </div>
    
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html><?php /**PATH L:\DevProfile\resources\views/projects/print.blade.php ENDPATH**/ ?>