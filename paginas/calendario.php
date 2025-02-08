<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendário</title>
    <style>
        .container {
            max-width: 400px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
        }

        input[type="date"] {
            padding: 10px;
            width: 100%;
            font-size: 16px;
        }

        button {
            margin-top: 15px;
            padding: 10px;
            width: 100%;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<header>
<?php include '../inc/cabecalho.php'; ?>
</header>
<div class="container">
    <h2>Escolha uma Data</h2>
    
    <form action="reserva.php" method="POST">
        <label for="data">Data:</label>
        <input type="date" id="data" name="data" required>
        <button type="submit">Continuar</button>
    </form>
</div>

<script>
    // Bloquear datas anteriores à data atual
    document.addEventListener("DOMContentLoaded", function() {
        let dataInput = document.getElementById("data");
        let hoje = new Date().toISOString().split("T")[0]; 
        dataInput.setAttribute("min", hoje);
    });
</script>

<footer>
<?php include '../inc/rodape.php'; ?>
</footer>

</body>
</html>
