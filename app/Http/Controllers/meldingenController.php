<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../../resources/views/meldingen/create.php');
    exit;
}

$attractie = isset($_POST['attractie']) && is_string($_POST['attractie']) ? trim($_POST['attractie']) : '';
$type = isset($_POST['type']) && is_string($_POST['type']) ? $_POST['type'] : '';
$capaciteitInput = isset($_POST['capaciteit']) && is_string($_POST['capaciteit']) ? trim($_POST['capaciteit']) : '';
$melder = isset($_POST['melder']) && is_string($_POST['melder']) ? trim($_POST['melder']) : '';
$prioriteitInput = isset($_POST['prioriteit']) && is_string($_POST['prioriteit']) ? $_POST['prioriteit'] : '';
$overig = isset($_POST['overig']) && is_string($_POST['overig']) ? trim($_POST['overig']) : '';
$capaciteit = filter_var($capaciteitInput, FILTER_VALIDATE_INT);

if (
    $attractie === '' ||
    !in_array($type, ['achtbaan', 'draaiend', 'kinder', 'horeca', 'show', 'water', 'overig'], true) ||
    $capaciteit === false ||
    $capaciteit < 0 ||
    $melder === '' ||
    !in_array($prioriteitInput, ['0', '1'], true) ||
    $overig === ''
) {
    header('Location: ../../../resources/views/meldingen/create.php?fout=' . rawurlencode('Vul alle velden correct in.'));
    exit;
}

$prioriteit = (int) $prioriteitInput;

//1. Verbinding
require_once '../../../config/conn.php';

//2. Query
$query = 'INSERT INTO meldingen
    (attractie, type, capaciteit, melder, prioriteit, overig)
    VALUES
    (:attractie, :type, :capaciteit, :melder, :prioriteit, :overig)';
//3. Prepare
$statement = $conn->prepare($query);
//4. Execute
$statement->execute([
    ':attractie' => $attractie,
    ':type' => $type,
    ':capaciteit' => (int) $capaciteit,
    ':melder' => $melder,
    ':prioriteit' => $prioriteit,
    ':overig' => $overig,
]);
$bericht = 'Melding opgeslagen';

header('Location: ../../../resources/views/meldingen/index.php?bericht=' . rawurlencode($bericht));
exit;
