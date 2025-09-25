<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $squadra1 = $_POST["squadra1"];
    $vinte1 = (int)$_POST["vinte1"];
    $pareggi1 = (int)$_POST["pareggi1"];
    $perse1 = (int)$_POST["perse1"];

    $squadra2 = $_POST["squadra2"];
    $vinte2 = (int)$_POST["vinte2"];
    $pareggi2 = (int)$_POST["pareggi2"];
    $perse2 = (int)$_POST["perse2"];

    $punti1 = $vinte1 * 3 + $pareggi1;
    $punti2 = $vinte2 * 3 + $pareggi2;

    $partite1 = $vinte1 + $pareggi1 + $perse1;
    $partite2 = $vinte2 + $pareggi2 + $perse2;

    $classifica = [
        ["nome" => $squadra1, "punti" => $punti1, "partite" => $partite1],
        ["nome" => $squadra2, "punti" => $punti2, "partite" => $partite2]
    ];

    usort($classifica, function ($a, $b) {
        return $b["punti"] - $a["punti"];
    });

    ob_start();
    echo "<h2 class='mb-3'>Classifica</h2>";
    echo "<ul class='list-group'>";
    foreach ($classifica as $s) {
        echo "<li class='list-group-item d-flex justify-content-between align-items-center'>
                <b>{$s['nome']}</b>
                <span>Punti: {$s['punti']} | Partite giocate: {$s['partite']}</span>
              </li>";
    }
    echo "</ul>";

    if ($partite1 != $partite2) {
        echo "<div class='alert alert-danger mt-3'>
                <b>Attenzione:</b> le due squadre hanno giocato un numero diverso di partite!
              </div>";
    }
    $risultato = ob_get_clean();
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Classifica squadre</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-md-6">
            <div class="card shadow p-4">
                <h1 class="text-center mb-4">Inserisci i dati delle due squadre</h1>
                <form method="post" action="">
                    <fieldset class="mb-3">
                        <legend>Squadra 1</legend>
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" class="form-control" name="squadra1" required>
                        </div>
                        <div class="form-group">
                            <label>Partite vinte</label>
                            <input type="number" class="form-control" name="vinte1" min="0" required>
                        </div>
                        <div class="form-group">
                            <label>Partite pareggiate</label>
                            <input type="number" class="form-control" name="pareggi1" min="0" required>
                        </div>
                        <div class="form-group">
                            <label>Partite perse</label>
                            <input type="number" class="form-control" name="perse1" min="0" required>
                        </div>
                    </fieldset>

                    <fieldset class="mb-3">
                        <legend>Squadra 2</legend>
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" class="form-control" name="squadra2" required>
                        </div>
                        <div class="form-group">
                            <label>Partite vinte</label>
                            <input type="number" class="form-control" name="vinte2" min="0" required>
                        </div>
                        <div class="form-group">
                            <label>Partite pareggiate</label>
                            <input type="number" class="form-control" name="pareggi2" min="0" required>
                        </div>
                        <div class="form-group">
                            <label>Partite perse</label>
                            <input type="number" class="form-control" name="perse2" min="0" required>
                        </div>
                    </fieldset>

                    <button type="submit" class="btn btn-primary btn-block">Calcola classifica</button>
                </form>

                <?php if (!empty($risultato)) : ?>
                    <div class="mt-4">
                        <?php echo $risultato; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
