<?php
include('layouts/header.php');

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$data_nascimento = $_POST['data_nascimento'] ?? null;

if (!$data_nascimento) {
    echo "<p>Data não enviada.</p>";
    exit;
}

$signos = simplexml_load_file(__DIR__ . "/signos.xml");

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
        if ($data >= $inicio || $data <= $fim) {
            $signo_encontrado = $signo;
            break;
        }
    }
}

// Mapeamento de imagens e cores
$map = [
    "Áries" => ["img" => "aries.png", "color" => "#ff4757"],
    "Touro" => ["img" => "taurus.png", "color" => "#2ed573"],
    "Gêmeos" => ["img" => "gemini.png", "color" => "#1e90ff"],
    "Câncer" => ["img" => "cancer.png", "color" => "#70a1ff"],
    "Leão" => ["img" => "leo.png", "color" => "#ffa502"],
    "Virgem" => ["img" => "virgo.png", "color" => "#7bed9f"],
    "Libra" => ["img" => "libra.png", "color" => "#eccc68"],
    "Escorpião" => ["img" => "scorpio.png", "color" => "#ff6b81"],
    "Sagitário" => ["img" => "sagittarius.png", "color" => "#ff7f50"],
    "Capricórnio" => ["img" => "capricorn.png", "color" => "#57606f"],
    "Aquário" => ["img" => "aquarius.png", "color" => "#00d2d3"],
    "Peixes" => ["img" => "pisces.png", "color" => "#a29bfe"]
];

$img = null;
$color = "#333";

if ($signo_encontrado && isset($map[(string)$signo_encontrado->signoNome])) {
    $img = "assets/imgs/" . $map[(string)$signo_encontrado->signoNome]["img"];
    $color = $map[(string)$signo_encontrado->signoNome]["color"];
}
?>

<div class="card shadow p-4 animate card-signo">

<?php if ($signo_encontrado): ?>

    <div class="signo-header">
        <?php if ($img): ?>
            <img src="<?= $img ?>" alt="signo" class="signo-img">
        <?php endif; ?>

        <h2 style="color: <?= $color ?>;">
            ✨ <?= $signo_encontrado->signoNome ?>
        </h2>
    </div>

    <p class="descricao">
        <?= $signo_encontrado->descricao ?>
    </p>

<?php else: ?>
    <p class="text-danger">Não foi possível identificar o signo.</p>
<?php endif; ?>

<a href="index.php" class="btn btn-outline-light mt-3 w-100">
    Voltar
</a>

</div>

</div>
</body>
</html>