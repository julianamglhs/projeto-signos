<?php include('layouts/header.php'); ?>

<h1>Descubra seu signo</h1>

<form method="POST" action="show_zodiac_sign.php">
    <div class="mb-3">
        <label>Data de nascimento:</label>
        <input type="date" name="data_nascimento" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Descobrir</button>
</form>

</body>
</html>