<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'DevPortfolio')); ?></title>

    <!-- Fonts -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap + FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <style>
        .alert {
    animation: slideDown 0.5s ease-out;
}

@keyframes slideDown {
    from {
        transform: translateY(-100%);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}
        /* ===== ТЁМНАЯ ТЕМА - ДОПОЛНЕНИЯ ===== */
.dark-theme .bg-white {
    background-color: #1e1e2f !important;
    color: #fff;
}

.dark-theme .bg-white h1,
.dark-theme .bg-white h2,
.dark-theme .bg-white h3,
.dark-theme .bg-white h4,
.dark-theme .bg-white p,
.dark-theme .bg-white .lead {
    color: #fff;
}

.dark-theme .bg-white .text-muted {
    color: #a0a0b0 !important;
}

.dark-theme .bg-white .btn-primary {
    background: #667eea;
    border-color: #667eea;
}

.dark-theme .bg-white .btn-primary:hover {
    background: #5a67d8;
    border-color: #5a67d8;
}

/* Карточки статистики */
.dark-theme .card {
    background: #1e1e2f;
    color: #fff;
}

.dark-theme .card h2,
.dark-theme .card h5,
.dark-theme .card p {
    color: #fff;
}

/* Прогресс-бары */
.dark-theme .progress {
    background: #2a2a3a;
}

.dark-theme .progress-bar {
    color: #fff;
}

/* Градиентный текст (если где-то есть) */
.dark-theme .text-primary {
    color: #a0a0ff !important;
}
        /* ===== ТЁМНАЯ ТЕМА ===== */
.dark-theme {
    background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
}

.dark-theme .navbar-custom {
    background: #16213e !important;
    box-shadow: 0 2px 20px rgba(0,0,0,0.3);
}

.dark-theme .navbar-custom .navbar-brand,
.dark-theme .navbar-custom .nav-link {
    color: #fff !important;
}

.dark-theme .navbar-custom .nav-link:hover {
    color: #a0a0ff !important;
}

.dark-theme .card {
    background: #1e1e2f;
    color: #fff;
    border: 1px solid #2a2a3a;
}

.dark-theme .card-header {
    background: rgba(255,255,255,0.05);
    border-bottom: 1px solid #2a2a3a;
}

.dark-theme .card-footer {
    background: rgba(255,255,255,0.02);
    border-top: 1px solid #2a2a3a;
}

.dark-theme .text-muted {
    color: #a0a0b0 !important;
}

.dark-theme .text-white {
    color: #fff !important;
}

.dark-theme .table {
    color: #fff;
}

.dark-theme .table-bordered {
    border-color: #2a2a3a;
}

.dark-theme .table td,
.dark-theme .table th {
    border-color: #2a2a3a;
}

.dark-theme .form-control,
.dark-theme .form-select {
    background: #2a2a3a;
    border: 1px solid #3a3a4a;
    color: #fff;
}

.dark-theme .form-control:focus,
.dark-theme .form-select:focus {
    background: #2a2a3a;
    border-color: #667eea;
    color: #fff;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.dark-theme .form-check-label {
    color: #fff;
}

.dark-theme .btn-outline-primary {
    color: #a0a0ff;
    border-color: #a0a0ff;
}

.dark-theme .btn-outline-primary:hover {
    background: #a0a0ff;
    color: #16213e;
}

.dark-theme .btn-outline-secondary {
    color: #a0a0b0;
    border-color: #a0a0b0;
}

.dark-theme .btn-outline-secondary:hover {
    background: #a0a0b0;
    color: #16213e;
}

.dark-theme .alert-success {
    background: #1e3a2e;
    color: #a0ffa0;
    border-color: #2a4a3a;
}

.dark-theme .alert-info {
    background: #1e3a4a;
    color: #a0f0ff;
    border-color: #2a4a5a;
}

.dark-theme .badge.bg-info {
    background: #2a4a6a !important;
    color: #fff;
}

.dark-theme .badge.bg-success {
    background: #1e4a2e !important;
}

.dark-theme .badge.bg-danger {
    background: #4a2a2a !important;
}

.dark-theme .progress {
    background: #2a2a3a;
}

.dark-theme .btn-light {
    background: #2a2a3a;
    color: #fff;
    border-color: #3a3a4a;
}

.dark-theme .btn-light:hover {
    background: #3a3a4a;
    color: #fff;
}

.dark-theme .bg-white {
    background-color: #1e1e2f !important;
}

.dark-theme .bg-transparent {
    background-color: transparent !important;
}
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .navbar-custom {
            background: rgba(255, 255, 255, 0.95) !important;
            box-shadow: 0 2px 20px rgba(0,0,0,0.1) !important;
            padding: 15px 0;
        }
        .navbar-custom .nav-link {
            color: #333 !important;
            font-weight: 500;
            padding: 10px 15px !important;
        }
        .navbar-custom .nav-link:hover {
            color: #667eea !important;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .btn-custom {
            border-radius: 25px;
            padding: 8px 25px;
            font-weight: 500;
        }
        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }
        .fade-in {
            animation: fadeIn 0.8s ease-in;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }
        .delay-4 { animation-delay: 0.4s; }
        .delay-5 { animation-delay: 0.5s; }
        .dark-theme .btn-outline-dark {
    color: #fff;
    border-color: #666;
}
.dark-theme .btn-outline-dark:hover {
    background: #444;
    color: #fff;
    border-color: #888;
}
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen">
        <!-- НАВИГАЦИЯ (БЕЗ БУРГЕРА, ВСЕГДА ВИДНА) -->
        <nav class="navbar-custom">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <!-- Логотип слева -->
                    <a class="navbar-brand fs-3 fw-bold text-dark" href="<?php echo e(route('home')); ?>">
                        <i class="fas fa-code me-2" style="color: #667eea;"></i>DevPortfolio
                    </a>

<!-- Меню справа -->
<div>
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('home')); ?>">
                <i class="fas fa-home me-1"></i>Главная
            </a>
        </li>

        <?php if(auth()->guard()->check()): ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('projects.index')); ?>">
                <i class="fas fa-folder-open me-1"></i>Мои работы
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('about')); ?>">
                <i class="fas fa-user me-1"></i>О себе
            </a>
        </li>
        <button id="themeToggle" class="btn btn-sm btn-outline-secondary ms-2">
    <i class="fas fa-moon"></i>
</button>
        
        <!-- ✅ СТАТИСТИКА -->
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('dashboard')); ?>">
                <i class="fas fa-chart-bar me-1"></i>Статистика
            </a>
        </li>
        <!-- ✅ КОНЕЦ -->
        
        <?php endif; ?>

        <?php if(auth()->guard()->check()): ?>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user-circle me-1"></i><?php echo e(Auth::user()->name); ?>

            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li>
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="dropdown-item">
                            <i class="fas fa-sign-out-alt me-2"></i>Выйти
                        </button>
                    </form>
                </li>
            </ul>
        </li>
        <?php else: ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('login')); ?>">
                <i class="fas fa-sign-in-alt me-1"></i>Вход
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('register')); ?>">
                <i class="fas fa-user-plus me-1"></i>Регистрация
            </a>
        </li>
        <?php endif; ?>
    </ul>
</div>
                </div>
            </div>
        </nav>

        <!-- Page Heading -->
        <?php if(isset($header)): ?>
            <header class="bg-white shadow">
                <div class="container py-4">
                    <?php echo e($header); ?>

                </div>
            </header>
        <?php endif; ?>

        <!-- Page Content -->
        <main class="py-4">
            <!-- Уведомления -->
<?php if(session('success')): ?>
    <div class="container mt-3">
        <div class="alert alert-success alert-dismissible fade show shadow" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle fa-2x me-3"></i>
                <div>
                    <strong>Успешно!</strong> <?php echo e(session('success')); ?>

                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div class="container mt-3">
        <div class="alert alert-danger alert-dismissible fade show shadow" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-circle fa-2x me-3"></i>
                <div>
                    <strong>Ошибка!</strong> <?php echo e(session('error')); ?>

                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
<?php endif; ?>
<?php if($errors->any()): ?>
    <div class="container mt-3">
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
<?php endif; ?>
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Flash messages -->
    <?php if(session('success')): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                alert('<?php echo e(session('success')); ?>');
            });
        </script>
    <?php endif; ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    // Тёмная тема
    (function() {
        const themeToggle = document.getElementById('themeToggle');
        if (!themeToggle) return;
        
        const icon = themeToggle.querySelector('i');
        
        // Проверяем сохранённую тему
        if (localStorage.getItem('theme') === 'dark') {
            document.body.classList.add('dark-theme');
            icon.classList.remove('fa-moon');
            icon.classList.add('fa-sun');
        }
        
        themeToggle.addEventListener('click', () => {
            document.body.classList.toggle('dark-theme');
            
            if (document.body.classList.contains('dark-theme')) {
                localStorage.setItem('theme', 'dark');
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            } else {
                localStorage.setItem('theme', 'light');
                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon');
            }
        });
    })();
</script>
</body>
</html><?php /**PATH L:\DevProfile\resources\views/layouts/app.blade.php ENDPATH**/ ?>