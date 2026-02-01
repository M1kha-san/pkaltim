<?php
/**
 * Admin Login Page
 */
require_once APP_PATH . '/helpers/Auth.php';
$flash = Auth::getFlash();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - <?= APP_NAME ?></title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <link href="<?= BASE_URL ?>public/css/output.css" rel="stylesheet">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #061E29 0%, #1D546D 50%, #5F9598 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        
        .login-container {
            background: white;
            border-radius: 1.5rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            width: 100%;
            max-width: 420px;
            overflow: hidden;
        }
        
        .login-header {
            background: linear-gradient(135deg, #061E29 0%, #1D546D 100%);
            padding: 2.5rem 2rem;
            text-align: center;
        }
        
        .form-input {
            width: 100%;
            padding: 0.875rem 1rem 0.875rem 2.75rem;
            border: 2px solid #e2e8f0;
            border-radius: 0.75rem;
            font-size: 0.9375rem;
            transition: all 0.2s;
            background: #f8fafc;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #5F9598;
            background: white;
            box-shadow: 0 0 0 3px rgba(95, 149, 152, 0.15);
        }
        
        .input-wrapper {
            position: relative;
        }
        
        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            transition: color 0.2s;
        }
        
        .input-wrapper:focus-within .input-icon {
            color: #5F9598;
        }
        
        .btn-login {
            width: 100%;
            padding: 0.875rem;
            background: linear-gradient(135deg, #1D546D 0%, #061E29 100%);
            color: white;
            border: none;
            border-radius: 0.75rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(6, 30, 41, 0.4);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        .alert {
            padding: 0.875rem 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.875rem;
        }
        
        .alert-error {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
        
        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Header -->
        <div class="login-header">
            <!-- <div class="flex items-center justify-center space-x-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-[#5F9598]/20 flex items-center justify-center">
                    <i class="fas fa-leaf text-2xl text-[#5F9598]"></i>
                </div>
            </div> -->
            <h1 class="text-white text-2xl font-bold">Explore<span class="text-[#5F9598]">Kaltim</span></h1>
            <p class="text-gray-300 text-sm mt-2">Panel Administrasi</p>
        </div>
        
        <!-- Form -->
        <div class="p-8">
            <?php if ($flash): ?>
                <div class="alert alert-<?= $flash['type'] ?>">
                    <i class="fas fa-<?= $flash['type'] === 'success' ? 'check-circle' : 'exclamation-circle' ?>"></i>
                    <span><?= $flash['message'] ?></span>
                </div>
            <?php endif; ?>
            
            <form action="<?= BASE_URL ?>admin/login" method="POST">
                <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                
                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2 text-sm">Username atau Email</label>
                    <div class="input-wrapper">
                        <i class="fas fa-user input-icon"></i>
                        <input type="text" name="username" class="form-input" placeholder="Masukkan username" required autofocus>
                    </div>
                </div>
                
                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2 text-sm">Password</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" name="password" class="form-input" placeholder="Masukkan password" required>
                    </div>
                </div>
                
                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt mr-2"></i> Masuk
                </button>
            </form>
            
            <div class="mt-8 text-center">
                <a href="<?= BASE_URL ?>" class="text-gray-500 hover:text-[#1D546D] text-sm transition">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali ke Website
                </a>
            </div>
        </div>
    </div>
</body>
</html>
