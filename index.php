<?php

declare(strict_types=1);

require_once 'functions.php';
require_once 'data.php';

$totalUnits    = count($units);
$ownedCount    = countByStatus($units, 'researched');
$notownedCount = countByStatus($units, 'not_owned');
$highestUnit   = getHighestBrUnit($units);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Darren Haq</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <div class="container">
            <h1>Koleksi War Thunder Ground Units</h1>
            <p>website profile & Katalog koleksi unit favorit war thunder</p>
            <nav>
                <a href="index.php" class="active">Home</a>
                <a href="katalog.php">Catalog</a>
            </nav>
        </div>
    </header>

    <main class="container">

        <section class="profile-section">
            <div class="profile-card">
                <div class="profile-photo">
                    <img src="assets/Foto_Profil.png" alt="Profile Photo" width="160" height="220">
                </div>
                <div class="profile-info">
                    <h2>Nama Kolektor</h2>
                    <p class ="profile-role">War Thunder Enthusiast</p>
                    <p class="profile-bio">Military vehicle enthusiast with a passion for War Thunder vehicles collection.</p>
                </div>
            </div>
        </section>

        <section>
            <h2> Koleksi Unit Favorit</h2>
            <div class="summary"> 
                <div class="summary-card">
                    <h3>Total Units</h3>
                    <p><?= e((string) $totalUnits) ?></p>
                </div>
                <div class="summary-card">
                    <h3>Researched</h3>
                    <p><?= e((string) $ownedCount) ?></p>
                </div>
                <div class="summary-card">
                    <h3>Not owned</h3>
                    <p><?= e((string) $notownedCount) ?></p>
                </div>
                <div class="summary-card">
                    <h3>BR Tertinggi</h3>
                    <?php if ($highestUnit !== null): ?>
                        <p><?= e((string) $highestUnit['battle_rating']) ?></p>
                        <span class="summary-sub"><?= e($highestUnit['name']) ?></span>
                    <?php else: ?>
                        <p>-</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; Darren Haq. Projek UTS pemrograman web 2026</p>
        </div>
    </footer>
    
</body>
</html>