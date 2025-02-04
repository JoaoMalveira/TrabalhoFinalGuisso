<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Calendário</title>

    <style>
        table {
            border-collapse: collapse;
            margin: 0 auto;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
        }

        caption {
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <header>
        <?php
        include "../inc/cabecalho.php";
       include "../inc/validacao.php";

        ?>
    </header>

    <main>
        <?php
             $mesAtual = isset($_GET['month']) ? intval($_GET['month']) : date('m');
             $anoAtual = isset($_GET['year']) ? intval($_GET['year']) : date('Y');

        
            if (isset($_GET['month_year'])) {
                $parsedDate = date_parse($_GET['month_year']);
                $mesAtual = $parsedDate['month'];
                $anoAtual = $parsedDate['year'];
            }

            function gerarCalendario($mes, $ano)
        {
            $diaInicial = date('w', strtotime("$ano-$mes-01"));
            $totalDias = date('t', strtotime("$ano-$mes-01"));
            $nomeMeses = [
                1 => 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
                'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
            ];
            $mes = max(1, min(12, $mes)); 

            $calendario = "<table border='1'>";
            $calendario .= "<caption>{$nomeMeses[$mes]} de $ano</caption>";
            $calendario .= "<tr><th>Dom</th><th>Seg</th><th>Ter</th><th>Qua</th><th>Qui</th><th>Sex</th><th>Sáb</th></tr>";
            $calendario .= "<tr>";

            for ($i = 0; $i < $diaInicial; $i++) {
                $calendario .= "<td></td>";
            }

            for ($dia = 1; $dia <= $totalDias; $dia++) {
                if (($dia + $diaInicial - 1) % 7 == 0 && $dia != 1) {
                    $calendario .= "</tr><tr>";
                }

                $dataCompleta = sprintf("%d-%02d-%02d", $ano, $mes, $dia);
                $linkReserva = "ambiente.php?date=$dataCompleta";
                $calendario .= "<td><a href='$linkReserva'>$dia</a></td>";
            }

            $espacosRestantes = 7 - (($totalDias + $diaInicial) % 7);
            if ($espacosRestantes < 7) {
                for ($i = 0; $i < $espacosRestantes; $i++) {
                    $calendario .= "<td></td>";
                }
            }

            $calendario .= "</tr></table>";

            return $calendario;
        }
        ?>
        <h1>Calendário de Reservas</h1>

        <form method="get" action="">
            <label for="month_year">Mês:</label>
            <input type="month" name="month_year" value="<?php echo $anoAtual . '-' . sprintf('%02d', $mesAtual); ?>" onchange="this.form.submit()">

        </form>

        <div>
            <?php
            echo gerarCalendario($mesAtual, $anoAtual);
            ?>
        </div>
    </main>
</body>
<footer>
    <?php
        include "../inc/rodape.php"

    ?>
    </footer>
</html>