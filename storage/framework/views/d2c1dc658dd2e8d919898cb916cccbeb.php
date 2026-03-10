<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevPortfolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .guest-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            padding: 3rem;
            max-width: 500px;
            width: 90%;
            text-align: center;
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
        .logo {
            font-size: 3rem;
            color: #667eea;
            margin-bottom: 1rem;
        }
        h1 {
            color: #333;
            margin-bottom: 1rem;
        }
        p {
            color: #666;
            margin-bottom: 2rem;
        }
        .btn-guest {
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: transform 0.3s;
            margin: 0 10px;
        }
        .btn-guest:hover {
            transform: translateY(-3px);
        }
        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
        }
        .btn-register {
            background: white;
            border: 2px solid #667eea;
            color: #667eea;
        }
    </style>
</head>
<body>
    <div class="guest-card">
        <div class="logo">
            <i class="fas fa-code"></i>
        </div>
        <h1>DevPortfolio</h1>
        <p>Добро пожаловать! Войдите или зарегистрируйтесь, чтобы управлять своим портфолио и дневником практики.</p>
        
        <div class="d-flex justify-content-center gap-3">
            <a href="<?php echo e(route('login')); ?>" class="btn btn-guest btn-login">
                <i class="fas fa-sign-in-alt me-2"></i>Вход
            </a>
            <a href="<?php echo e(route('register')); ?>" class="btn btn-guest btn-register">
                <i class="fas fa-user-plus me-2"></i>Регистрация
            </a>
        </div>
    </div>
</body>
</html><?php /**PATH L:\DevProfile\resources\views/auth-guest.blade.php ENDPATH**/ ?>