<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FiscalControl')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --light-color: #ecf0f1;
        }

        body {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            min-height: 100vh;
            color: var(--light-color);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background-color: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.4rem;
            color: var(--light-color) !important;
        }

        .nav-link {
            color: var(--light-color) !important;
            opacity: 0.9;
        }

        .nav-link:hover {
            opacity: 1;
        }

        .content-wrapper {
            padding-top: 80px;
            padding-bottom: 40px;
        }

        .card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 12px;
        }

        footer {
            padding: 25px 0;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            text-align: center;
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .btn {
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('index') }}">
                <i class="fas fa-file-invoice-dollar me-2"></i>FiscalControl
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('notas.index') }}">Notas</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('cupom.index') }}">Cupons</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('instituicoes.index') }}">Instituições</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Relatórios</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Ajuda</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Conteúdo principal -->
    <div class="content-wrapper">
        @yield('content')
    </div>

    <!-- Rodapé -->
    <footer>
        <div class="container">
            <p>FiscalControl 2025 - Sistema de Controle Fiscal</p>
            <p>Desenvolvido com Laravel</p>
        </div>
    </footer>

    <!-- Scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
