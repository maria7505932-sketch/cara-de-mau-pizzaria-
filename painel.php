<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sistema - Cara de Mau Pizzaria</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #000;
            color: white;
            min-height: 100vh;
        }

        /* ==============================
           TOPO
        ============================== */

        .topo-sistema {
            width: 100%;
            background: #000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 50px;
            border-bottom: 1px solid #222;
        }

        .logo-sistema {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo-sistema img {
            width: 75px;
            height: 75px;
            object-fit: contain;
        }

        .nome-sistema h1 {
            color: #d62828;
            font-size: 28px;
            margin-bottom: 3px;
        }

        .nome-sistema span {
            color: #d4a72c;
            font-size: 13px;
            font-weight: bold;
            letter-spacing: 4px;
        }

        /* ==============================
           BOTÃO SAIR
        ============================== */

        .sair {
            text-decoration: none;
            background: #d62828;
            color: white;
            padding: 11px 22px;
            border-radius: 6px;
            font-weight: bold;
            transition: 0.2s;
        }

        .sair:hover {
            background: #a91f1f;
        }

        /* ==============================
           MENU
        ============================== */

        .menu-sistema {
            width: 100%;
            background: #111;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 45px;
            padding: 18px;
            border-bottom: 1px solid #222;
        }

        .menu-sistema a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            font-size: 15px;
            transition: 0.2s;
        }

        .menu-sistema a:hover {
            color: #d4a72c;
        }

        /* ==============================
           CONTEÚDO
        ============================== */

        .conteudo {
            width: 90%;
            max-width: 1100px;
            margin: 50px auto;
            text-align: center;
        }

        .conteudo h2 {
            color: #d4a72c;
            font-size: 30px;
            margin-bottom: 10px;
        }

        .conteudo > p {
            color: #aaa;
            font-size: 16px;
            margin-bottom: 40px;
        }

        /* ==============================
           CARDS
        ============================== */

        .cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
        }

        .card {
            background: #111;
            border: 1px solid #252525;
            border-radius: 10px;
            padding: 30px 20px;
            text-decoration: none;
            color: white;
            transition: 0.2s;
            min-height: 190px;

            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .card:hover {
            transform: translateY(-5px);
            border-color: #d62828;
            background: #151515;
        }

        .card .icone {
            font-size: 42px;
            margin-bottom: 14px;
        }

        .card h3 {
            color: #d4a72c;
            font-size: 19px;
            margin-bottom: 10px;
        }

        .card p {
            color: #aaa;
            font-size: 14px;
            line-height: 1.4;
            margin: 0;
        }

        /* ==============================
           RODAPÉ
        ============================== */

        footer {
            margin-top: 70px;
            background: #111;
            border-top: 1px solid #222;
            text-align: center;
            padding: 25px;
            color: #777;
            font-size: 13px;
        }

        /* ==============================
           CELULAR
        ============================== */

        @media (max-width: 800px) {

            .topo-sistema {
                padding: 15px 20px;
            }

            .logo-sistema img {
                width: 60px;
                height: 60px;
            }

            .nome-sistema h1 {
                font-size: 21px;
            }

            .nome-sistema span {
                font-size: 11px;
            }

            .sair {
                padding: 9px 14px;
                font-size: 13px;
            }

            .menu-sistema {
                gap: 20px;
                padding: 15px 10px;
            }

            .menu-sistema a {
                font-size: 13px;
            }

            .cards {
                grid-template-columns: 1fr;
            }

        }

    </style>

</head>

<body>

    <!-- ==============================
         TOPO DO SISTEMA
    ============================== -->

    <header class="topo-sistema">

        <div class="logo-sistema">

            <img
                src="../../imagens/WhatsApp Image 2026-09-01 at 16.53.24 copy.jpeg"
                alt="Logo Cara de Mau"
            >

            <div class="nome-sistema">

                <h1>CARA DE MAU</h1>

                <span>SISTEMA</span>

            </div>

        </div>

        <a href="../../index.php" class="sair">
            SAIR
        </a>

    </header>


    <!-- ==============================
         MENU
    ============================== -->

    <nav class="menu-sistema">

        <a href="painel.php">
            Início
        </a>

        <a href="../proprietario/cadastro-gerente.php">
            Cadastro
        </a>

        <a href="#">
            Produtos
        </a>

        <a href="#">
            Comissões
        </a>

        <a href="#">
            Relatórios
        </a>

    </nav>


    <!-- ==============================
         CONTEÚDO
    ============================== -->

    <main class="conteudo">

        <h2>Sistema da Pizzaria</h2>

        <p>
            Bem-vindo ao sistema da Cara de Mau Pizzaria.
        </p>


        <section class="cards">


            <!-- CADASTRAR GERENTE -->

            <a href="../proprietario/cadastro-gerente.php" class="card">

                <div class="icone">
                    👨‍💼
                </div>

                <h3>
                    Cadastrar Gerente
                </h3>

                <p>
                    Cadastrar os gerentes da pizzaria.
                </p>

            </a>


            <!-- CADASTRAR GARÇOM -->

                       <!-- CADASTRAR GARÇOM -->

            <a href="../gerente/cadastrar-garçom.php" class="card">

                <div class="icone">
                    👨‍🍳
                </div>

                <h3>
                    Cadastrar Garçom
                </h3>

                <p>
                    Cadastrar os garçons da pizzaria.
                </p>

            </a>


            <!-- PRODUTOS -->

<a href="../gerente/produtos.php" class="card">
                <div class="icone">
                    🍕
                </div>

                <h3>
                    Produtos
                </h3>

                <p>
                    Cadastrar, visualizar, alterar e excluir produtos.
                </p>

            </a>


            <!-- COMISSÕES -->

            <a href="#" class="card">

                <div class="icone">
                    💰
                </div>

                <h3>
                    Comissões
                </h3>

                <p>
                    Calcular as comissões dos garçons.
                </p>

            </a>


            <!-- RELATÓRIOS -->

            <a href="#" class="card">

                <div class="icone">
                    📊
                </div>

                <h3>
                    Relatórios
                </h3>

                <p>
                    Consultar os relatórios da pizzaria.
                </p>

            </a>


            <!-- CONTAS -->

            <a href="#" class="card">

                <div class="icone">
                    🧾
                </div>

                <h3>
                    Contas
                </h3>

                <p>
                    Abrir, fechar e administrar as contas.
                </p>

            </a>


        </section>

    </main>


    <!-- ==============================
         RODAPÉ
    ============================== -->

    <footer>

        © 2026 Cara de Mau Pizzaria — Sistema

    </footer>

</body>

</html>