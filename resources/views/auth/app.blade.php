<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --lg-red: #a50034;
            --lg-red-dark: #8e0029;
        }
        
        body {
            background-color: #f5f5f5;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .login-container {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            overflow: hidden;
        }
        
        .brand-side {
            background-color: var(--lg-red);
            color: white;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: auto;
        }
        
        .brand-logo {
            font-size: 4rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
        }
        
        .form-side {
            background-color: white;
            padding: 3rem;
        }
        
        .form-header {
            margin-bottom: 2rem;
        }
        
        .form-control:focus {
            border-color: var(--lg-red);
            box-shadow: 0 0 0 0.25rem rgba(165, 0, 52, 0.25);
        }
        
        .form-check-input:checked {
            background-color: var(--lg-red);
            border-color: var(--lg-red);
        }
        
        .btn-lg-primary {
            background-color: var(--lg-red);
            color: white;
            transition: background-color 0.3s;
        }
        
        .btn-lg-primary:hover {
            background-color: var(--lg-red-dark);
            color: white;
        }
        
        .link-lg {
            color: var(--lg-red);
            text-decoration: none;
        }
        
        .link-lg:hover {
            color: var(--lg-red-dark);
        }
    </style>
</head>
<body>
@yield('content')
</body>
</html>