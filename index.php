<?php

declare(strict_types=1);

require_once 'functions.php';
require_once 'data.php';

$totalUnits    = count($units);
$ownedCount    = countByStatus($units, 'researched');
$notownedCount = countByStatus($units, 'not_owned');
$avgbr         = getAverageBR($units);
$highestUnit   = getHighestBrUnit($units);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Kolektor</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <div class="container">
            <h1>Koleksi War Thunder Ground Units</h1>
            <p>website profile & Katalog koleksi unit favorit war thunder</p>
            <nav>
                <a href="index.php" class="active">Home</a>
                <a href="catalog.php">Catalog</a>
            </nav>
        </div>
    </header>

    <main class="container">

        <section class="profile-section">
            <div class="profile-card">
                <div class="profile-photo">
                    <img src="assets/profile.jpg" alt="Profile Photo" width="160" height="160">
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
                    <h3>Average BR</h3>
                    <p><?= e((string) $avgbr) ?></p>
                </div>
            </div>

            <?php if ($highestUnit !== null): ?>
                <p>
                    Unit dengan BR tertinggi:
                    <strong><?= e($highestUnit['name']) ?></strong>
                    (BR <?= e((string)$highestUnit['name']) ?>)
                </p>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        <div class="container"
            <p>UTS Pemrograman Web &copy; 2026</>
        </div>
    </footer>
    
</body>
</html>