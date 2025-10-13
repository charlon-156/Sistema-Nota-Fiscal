<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema de Controle Fiscal')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --light-color: #ecf0f1;
            --dark-color: #2c3e50;
        }

        body {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--light-color);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
        }

        .hero-section {
            padding: 80px 0;
            text-align: center;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto 40px;
            opacity: 0.9;
        }

        .dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-top: 40px;
        }

        .card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            border: 1px solid rgba(255, 255, 255, 0.2);
            height: 100%;
            color: var(--light-color);
            text-decoration: none;
            display: block;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
            background: rgba(255, 255, 255, 0.15);
            color: var(--light-color);
            text-decoration: none;
        }

        .card-icon {
            font-size: 3.5rem;
            margin-bottom: 20px;
            color: var(--light-color);
        }

        .card-title {
            font-size: 1.5rem;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .card-description {
            font-size: 0.95rem;
            opacity: 0.8;
            line-height: 1.5;
        }

        footer {
            margin-top: 60px;
            padding: 20px 0;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            text-align: center;
        }

        @media (max-width: 768px) {
            .dashboard {
                grid-template-columns: 1fr;
            }

            .hero-title {
                font-size: 2.2rem;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: rgba(0,0,0,0.2);">
        <div class="container">
            <a class="navbar-brand" href="{{ route('index') }}">
                <i class="fas fa-file-invoice-dollar me-2"></i>FiscalControl
            </a>
        </div>
    </nav>

    <div class="container">
        <div class="hero-section">
            <h1 class="hero-title">Controle Fiscal Completo</h1>
            <p class="hero-subtitle">Gerencie notas fiscais, cupons fiscais e instituições de forma eficiente e organizada</p>
        </div>
        
        <div class="dashboard">
            <a href="{{ route('notas-fiscais.index') }}" class="card">
                <div class="card-icon">
                    <i class="fas fa-file-invoice"></i>
                </div>
                <h3 class="card-title">Notas Fiscais</h3>
                <p class="card-description">Gerencie todas as notas fiscais emitidas e recebidas. Controle prazos, status e visualize relatórios detalhados.</p>
            </a>
            
            <a href="{{ route('cupons-fiscais.index') }}" class="card">
                <div class="card-icon">
                    <i class="fas fa-receipt"></i>
                </div>
                <h3 class="card-title">Cupons Fiscais</h3>
                <p class="card-description">Controle de cupons fiscais eletrônicos com registro de data, valor e estabelecimento.</p>
            </a>
            
            <a href="#" class="card">
                <div class="card-icon">
                    <i class="fas fa-building"></i>
                </div>
                <h3 class="card-title">Instituições</h3>
                <p class="card-description">Cadastro e gestão de empresas, fornecedores e clientes vinculados ao sistema fiscal.</p>
            </a>
            
            <a href="#" class="card">
                <div class="card-icon">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <h3 class="card-title">Relatórios</h3>
                <p class="card-description">Gere relatórios personalizados, gráficos e análises sobre toda a movimentação fiscal.</p>
            </a>

            <a href="#" class="card">
                <div class="card-icon">
                    <i class="fas fa-cogs"></i>
                </div>
                <h3 class="card-title">Configurações</h3>
                <p class="card-description">Configure parâmetros do sistema, usuários, permissões e preferências.</p>
            </a>

            <a href="#" class="card">
                <div class="card-icon">
                    <i class="fas fa-question-circle"></i>
                </div>
                <h3 class="card-title">Ajuda</h3>
                <p class="card-description">Acesse tutoriais, documentação e suporte para utilizar o sistema.</p>
            </a>
        </div>
    </div>
    
    <footer>
        <div class="container">
            <p>FiscalControl 2025 - Sistema de Controle Fiscal</p>
            <p class="small opacity-75">Desenvolvido com Laravel</p>
        </div>
    </footer>
</body>
</html>
