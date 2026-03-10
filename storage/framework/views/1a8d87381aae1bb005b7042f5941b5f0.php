

<?php $__env->startSection('title', 'Главная'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <!-- Приветственный баннер с анимацией -->
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card text-center p-5 mb-5 fade-in">
            <div class="card text-center p-5 mb-5 fade-in bg-white">
                <div class="card-body">
                    <h1 class="display-4 mb-4">
                        <i class="fas fa-code text-primary me-3"></i>
                        DevPortfolio
                    </h1>
                    <p class="lead mb-4">
                        Добро пожаловать в моё портфолио и дневник практики!
                    </p>
                    <p class="mb-5">
                        Здесь я собираю все свои лабораторные работы, проекты и отчёты.
                    </p>
                    
                    <div class="row g-4">
                        <div class="col-md-6 fade-in delay-1">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <i class="fas fa-folder-open fa-3x text-primary mb-3"></i>
                                    <h3>Мои работы</h3>
                                    <p class="text-muted">Все лабораторные и проекты в одном месте</p>
                                    <a href="<?php echo e(route('projects.index')); ?>" class="btn btn-primary btn-custom">
                                        <i class="fas fa-eye me-2"></i>Смотреть
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 fade-in delay-2">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <i class="fas fa-user fa-3x text-primary mb-3"></i>
                                    <h3>Обо мне</h3>
                                    <p class="text-muted">Мой стек, контакты и информация</p>
                                    <a href="<?php echo e(route('about')); ?>" class="btn btn-primary btn-custom">
                                        <i class="fas fa-user me-2"></i>Узнать
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
        $totalProjects = App\Models\Project::count();
        $tzDone = App\Models\Project::where('tz_status', true)->count();
        $reportDone = App\Models\Project::where('report_status', true)->count();
        $diaryDone = App\Models\Project::where('diary_status', true)->count();
        $withGit = App\Models\Project::whereNotNull('github_link')->count();
        $withFile = App\Models\Project::whereNotNull('file_path')->count();
    ?>

    <?php if($totalProjects > 0): ?>
        <!-- Статистика (6 параметров) -->
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card p-4 fade-in delay-3">
                    <div class="row text-center">
                        <div class="col-md-2">
                            <h2 class="text-primary"><?php echo e($totalProjects); ?></h2>
                            <p class="text-muted">Всего работ</p>
                        </div>
                        <div class="col-md-2">
                            <h2 class="text-success"><?php echo e($tzDone); ?></h2>
                            <p class="text-muted">ТЗ сдано</p>
                        </div>
                        <div class="col-md-2">
                            <h2 class="text-success"><?php echo e($reportDone); ?></h2>
                            <p class="text-muted">Отчётов</p>
                        </div>
                        <div class="col-md-2">
                            <h2 class="text-success"><?php echo e($diaryDone); ?></h2>
                            <p class="text-muted">Дневников</p>
                        </div>
                        <div class="col-md-2">
                            <h2 class="text-info"><?php echo e($withGit); ?></h2>
                            <p class="text-muted">GitHub</p>
                        </div>
                        <div class="col-md-2">
                            <h2 class="text-info"><?php echo e($withFile); ?></h2>
                            <p class="text-muted">Файлы</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Прогресс-бары (5 параметров) -->
        <div class="row justify-content-center mt-4">
            <div class="col-md-10">
                <div class="card p-4 fade-in delay-4">
                    <h5 class="mb-3">Прогресс по работам</h5>
                    
                    <?php
                        $tzPercent = round(($tzDone / $totalProjects) * 100);
                        $reportPercent = round(($reportDone / $totalProjects) * 100);
                        $diaryPercent = round(($diaryDone / $totalProjects) * 100);
                        $gitPercent = round(($withGit / $totalProjects) * 100);
                        $filePercent = round(($withFile / $totalProjects) * 100);
                    ?>
                    
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span><i class="fas fa-check-circle text-success me-1"></i> ТЗ</span>
                            <span><?php echo e($tzPercent); ?>% (<?php echo e($tzDone); ?>/<?php echo e($totalProjects); ?>)</span>
                        </div>
                        <div class="progress" style="height: 20px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo e($tzPercent); ?>%;" aria-valuenow="<?php echo e($tzPercent); ?>" aria-valuemin="0" aria-valuemax="100"><?php echo e($tzPercent); ?>%</div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span><i class="fas fa-file-alt text-info me-1"></i> Отчёты</span>
                            <span><?php echo e($reportPercent); ?>% (<?php echo e($reportDone); ?>/<?php echo e($totalProjects); ?>)</span>
                        </div>
                        <div class="progress" style="height: 20px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo e($reportPercent); ?>%;" aria-valuenow="<?php echo e($reportPercent); ?>" aria-valuemin="0" aria-valuemax="100"><?php echo e($reportPercent); ?>%</div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span><i class="fas fa-book text-warning me-1"></i> Дневники</span>
                            <span><?php echo e($diaryPercent); ?>% (<?php echo e($diaryDone); ?>/<?php echo e($totalProjects); ?>)</span>
                        </div>
                        <div class="progress" style="height: 20px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo e($diaryPercent); ?>%;" aria-valuenow="<?php echo e($diaryPercent); ?>" aria-valuemin="0" aria-valuemax="100"><?php echo e($diaryPercent); ?>%</div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span><i class="fab fa-github text-dark me-1"></i> GitHub</span>
                            <span><?php echo e($gitPercent); ?>% (<?php echo e($withGit); ?>/<?php echo e($totalProjects); ?>)</span>
                        </div>
                        <div class="progress" style="height: 20px;">
                            <div class="progress-bar bg-secondary" role="progressbar" style="width: <?php echo e($gitPercent); ?>%;" aria-valuenow="<?php echo e($gitPercent); ?>" aria-valuemin="0" aria-valuemax="100"><?php echo e($gitPercent); ?>%</div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span><i class="fas fa-paperclip text-primary me-1"></i> Файлы</span>
                            <span><?php echo e($filePercent); ?>% (<?php echo e($withFile); ?>/<?php echo e($totalProjects); ?>)</span>
                        </div>
                        <div class="progress" style="height: 20px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo e($filePercent); ?>%;" aria-valuenow="<?php echo e($filePercent); ?>" aria-valuemin="0" aria-valuemax="100"><?php echo e($filePercent); ?>%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Последние добавленные работы -->
        <div class="row justify-content-center mt-4">
            <div class="col-md-10">
                <div class="card p-4 fade-in delay-5">
                    <h5 class="mb-3">Последние работы</h5>
                    
                    <div class="row">
                        <?php $__currentLoopData = App\Models\Project::latest()->take(3)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6><?php echo e($project->title); ?></h6>
                                    <p class="small text-muted"><?php echo e($project->subject); ?></p>
                                    <div class="d-flex justify-content-between small">
                                        <span>ТЗ: <?php echo $project->tz_status ? '✅' : '❌'; ?></span>
                                        <span>Отчёт: <?php echo $project->report_status ? '✅' : '❌'; ?></span>
                                        <span>Дневник: <?php echo $project->diary_status ? '✅' : '❌'; ?></span>
                                    </div>
                                    <?php if($project->github_link): ?>
                                        <div class="small mt-1">
                                            <i class="fab fa-github"></i> GitHub
                                        </div>
                                    <?php endif; ?>
                                    <?php if($project->file_path): ?>
                                        <div class="small mt-1">
                                            <i class="fas fa-paperclip"></i> Файл
                                        </div>
                                    <?php endif; ?>
                                    <a href="<?php echo e(route('projects.show', $project->id)); ?>" class="btn btn-sm btn-outline-primary mt-2 w-100">Подробнее</a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH L:\DevProfile\resources\views/home.blade.php ENDPATH**/ ?>