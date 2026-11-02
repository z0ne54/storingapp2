<?php require_once __DIR__.'/../../../config/config.php'; ?>
<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp / Meldingen / Nieuw</title>
    <?php require_once __DIR__.'/../components/head.php'; ?>
</head>

<body>

    <?php require_once __DIR__.'/../components/header.php'; ?>

    <div class="container">
        <h1>Nieuwe melding</h1>

        <?php if (isset($_GET['fout']) && is_string($_GET['fout'])): ?>
            <div class="msg"><?php echo htmlspecialchars($_GET['fout'], ENT_QUOTES, 'UTF-8'); ?></div>
        <?php endif; ?>

        <form action="<?php echo $base_url; ?>/app/Http/Controllers/meldingenController.php" method="POST">

            <div class="form-group">
                <label for="attractie">Naam attractie:</label>
                <input type="text" name="attractie" id="attractie" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <!-- hier komt een dropdown -->
                 <select id="type" name="type" required>
                    <option value="">-- kies een type --</option>
                    <option value="achtbaan">Achtbaan</option>
                    <option value="draaiend">draaiend</option>
                    <option value="kinder">kinder</option>
                    <option value="horeca">horeca</option>
                    <option value="show">show</option>
                    <option value="water">water</option>
                    <option value="overig">overig</option>
                </select>
            </div>
            <div class="form-group">
                <label for="capaciteit">Capaciteit p/uur:</label>
                <input type="number" min="0" name="capaciteit" id="capaciteit" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="melder">Naam melder:</label>
                <input type="text" name="melder" id="melder" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="prioriteit">Prioriteit:</label>
                <select id="prioriteit" name="prioriteit" required>
                    <option value="">-- kies ja of nee --</option>
                    <option value="0">Nee</option>
                    <option value="1">Ja</option>
                </select>
            </div>
            <div class="form-group">
                <label for="overig">Overige informatie:</label>
                <textarea name="overig" id="overig" class="form-input" rows="4" required></textarea>
            </div>

            <input type="submit" value="Verstuur melding">

        </form>
    </div>

</body>

</html>
