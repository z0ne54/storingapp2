<?php require_once __DIR__ . '/../../../config/config.php'; ?>
<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp / Meldingen</title>
    <?php require_once __DIR__ . '/../components/head.php'; ?>
</head>

<body>

    <?php require_once __DIR__ . '/../components/header.php'; ?>

    <div class="container">
        <h1>Meldingen</h1>
        <a href="create.php">Nieuwe melding &gt;</a>

        <?php if (isset($_GET['msg']) && is_string($_GET['msg'])): ?>
            <div class="msg"><?php echo htmlspecialchars($_GET['msg'], ENT_QUOTES, 'UTF-8'); ?></div>
        <?php endif; ?>

        <?php if (isset($_GET['bericht']) && is_string($_GET['bericht'])): ?>
            <div class="msg"><?php echo htmlspecialchars($_GET['bericht'], ENT_QUOTES, 'UTF-8'); ?></div>
        <?php endif; ?>

            <?php
            //Query uitvoeren:
            require_once '../../../config/conn.php';                     //Verbinding ophalen
            $query = 'SELECT * FROM meldingen';                     //Query schrijven
            $statement = $conn->prepare($query);                    //Van query naar statement
            $statement->execute();                                  //Statement uitvoeren
            $meldingen = $statement->fetchAll(PDO::FETCH_ASSOC);     //Resultaat ophalen
            ?>


<?php if ($meldingen === []): ?>
  <p>Er zijn nog geen storingen gemeld.</p>
<?php else: ?>
 <table>
                <thead>
                    <tr>
                        <th scope="col">Attractie</th>
                        <th scope="col">Type</th>
                        <th scope="col">Capaciteit</th>
                        <th scope="col">Melder</th>
                        <th scope="col">Prioriteit</th>
                        <th scope="col">Gemeld op</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($meldingen as $melding): ?>
                        <tr>
                            <td><?= htmlspecialchars($melding['attractie'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($melding['type'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= (int) $melding['capaciteit'] ?></td>
                            <td><?= htmlspecialchars($melding['melder'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= (int) $melding['prioriteit'] === 1 ? 'Ja' : 'Nee' ?></td>
                            <td><?= htmlspecialchars($melding['gemeld_op'], ENT_QUOTES, 'UTF-8') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
<?php endif; ?>




            
</body>

</html>