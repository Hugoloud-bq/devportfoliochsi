

<?php $__env->startSection('title', 'О себе'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-user me-2"></i>
                        О себе
                    </h4>
                    <a href="<?php echo e(route('about.edit')); ?>" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit me-1"></i>Редактировать
                    </a>
                </div>
                <div class="card-body">
                    <?php if(session('success')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>

                    <div class="text-center mb-4">
    <?php if($about->avatar): ?>
        <img src="<?php echo e(asset('storage/' . $about->avatar)); ?>" 
             alt="Avatar" 
             class="rounded-circle d-block mx-auto mb-3" 
             style="width: 150px; height: 150px; object-fit: cover;">
    <?php else: ?>
        <div class="display-1 text-primary mb-3">
            <i class="fas fa-user-circle"></i>
        </div>
    <?php endif; ?>
    <h2><?php echo e($about->name); ?></h2>
    <p class="text-muted"><?php echo e($about->title); ?></p>
</div>

                    <?php if($about->bio): ?>
                        <div class="mb-4">
                            <h5><i class="fas fa-info-circle me-2"></i>Обо мне</h5>
                            <p><?php echo e($about->bio); ?></p>
                        </div>
                    <?php endif; ?>

                    <?php if($about->skills): ?>
                        <div class="mb-4">
                            <h5><i class="fas fa-code me-2"></i>Стек технологий</h5>
                            <div class="d-flex flex-wrap gap-2">
                                <?php $__currentLoopData = is_array($about->skills) ? $about->skills : []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span class="badge bg-primary p-2"><?php echo e($skill); ?></span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="mb-4">
                        <h5><i class="fas fa-graduation-cap me-2"></i>Образование</h5>
                        <p>
                            <strong><?php echo e($about->university); ?></strong><br>
                            Специальность: <?php echo e($about->specialty); ?><br>
                            Курс: <?php echo e($about->course); ?>

                        </p>
                    </div>

                    <?php if($about->github || $about->telegram): ?>
<!-- ССЫЛКИ (только заголовок) -->
<h5 class="mb-2" style="margin-top: -10px;">
    <i class="fas fa-link me-2"></i>Ссылки
</h5>

<!-- КНОПКИ (GitHub, Telegram) -->
<div class="d-flex gap-3 mb-4">
    <?php if($about->github): ?>
        <a href="<?php echo e($about->github); ?>" target="_blank" class="btn btn-outline-dark">
            <i class="fab fa-github me-2"></i>GitHub
        </a>
    <?php endif; ?>
    <?php if($about->telegram): ?>
        <a href="https://t.me/<?php echo e(str_replace('@', '', $about->telegram)); ?>" target="_blank" class="btn btn-outline-primary">
            <i class="fab fa-telegram me-2"></i>Telegram
        </a>
    <?php endif; ?>
</div>
                    <?php endif; ?>

                    <?php if($about->email): ?>
                        <div class="alert alert-info">
                            <i class="fas fa-envelope me-2"></i>
                            <strong>Email:</strong> <?php echo e($about->email); ?>

                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH L:\DevProfile\resources\views/about.blade.php ENDPATH**/ ?>