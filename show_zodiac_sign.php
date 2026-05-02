<?php
include('layouts/header.php');

// Recebe a data
$data_nascimento = $_POST['data_nascimento'] ?? null;

if (!$data_nascimento) {
    echo "<p>Data não enviada.</p>";
    echo '<a href="index.php">Voltar</a>';
    exit;
}

// Carrega XML
$signos = simplexml_load_file(__DIR__ . "/signos.xml");

// pega mês e dia da data informada
$data = strtotime("2000-" . date("m-d", strtotime($data_nascimento)));

$signo_encontrado = null;

foreach ($signos->signo as $signo) {

    list($diaInicio, $mesInicio) = explode("-", $signo->dataInicio);
    list($diaFim, $mesFim) = explode("-", $signo->dataFim);

    $inicio = strtotime("2000-$mesInicio-$diaInicio");
    $fim = strtotime("2000-$mesFim-$diaFim");

    if ($inicio <= $fim) {
        if ($data >= $inicio && $data <= $fim) {
            $signo_encontrado = $signo;
            break;
        }
    } else {
        // caso que cruza o ano (Capricórnio)
        if ($data >= $inicio || $data <= $fim) {
            $signo_encontrado = $signo;
            break;
        }
    }
}
?>

<?php if ($signo_encontrado): ?>
    <h2>Seu signo é: <?= $signo_encontrado->signoNome ?></h2>
    <p><?= $signo_encontrado->descricao ?></p>
<?php else: ?>
    <p>Signo não encontrado.</p>
<?php endif; ?>

<a href="index.php" class="btn btn-secondary mt-3">Voltar</a>

</body>
</html>