<?php include('layouts/header.php'); ?>

<div class="card shadow p-4 text-center" style="max-width: 400px; width: 100%;">
    
    <h2 class="mb-3">🔮 Descubra seu signo</h2>

    <form method="POST" action="show_zodiac_sign.php">
        <div class="mb-3">
            <input 
                type="date" 
                name="data_nascimento" 
                class="form-control text-center"
                required
            >
        </div>

        <button type="submit" class="btn btn-primary w-100">
            Descobrir
        </button>
    </form>

</div>

</div>
</body>
</html>