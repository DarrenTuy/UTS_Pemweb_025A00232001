<?php

declare(strict_types=1);

require_once 'functions.php';
require_once 'data.php';

$selectedCountry = $_GET['country'] ?? 'all';
$selectedSort    = $_GET['sort'] ?? 'default';

if (!is_string($selectedCountry)) {
    $selectedCountry = 'all';
}
if (!is_string($selectedSort)) {
    $selectedSort = 'default';
}

$countries     = getUniqueCountries($units);
$countryCounts = countByCountry($units);

$sortOptions = [
    'default' => 'Default',
    'br_asc'  => 'BR Terendah',
    'br_desc' => 'BR Tertinggi',
];

$filteredUnits = filterByCountry($units, $selectedCountry);
$filteredUnits = sortByBattleRating($filteredUnits, $selectedSort);

$allCountriesLink = 'katalog.php?country=all&sort=' . urlencode($selectedSort);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Unit</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
   <header>
        <div class="container">
            <h1>Koleksi War Thunder Ground Units</h1>
            <p>Favorite Units List</p>
            <nav>
                <a href="index.php">Home</a>
                <a href="katalog.php" class="active">Catalog</a>
            </nav>
        </div>
    </header>

    <main class="container">

        <section>
            <h2>Filter dan Urutan</h2>

            <p class="filter-label">Negara</p>
            <div class="filter-buttons">
                <a href="<?= e($allCountriesLink) ?>"
                   class="filter-btn <?= $selectedCountry === 'all' ? 'active' : '' ?>">
                    Semua (<?= count($units) ?>)
                </a>
                
                <?php foreach ($countries as $country): ?>
                    <?php $countryLink = 'katalog.php?country=' . urlencode($country) . '&sort=' . urlencode($selectedSort); ?>
                    <a href="<?= e($countryLink) ?>"
                       class="filter-btn <?= $selectedCountry === $country ? 'active' : '' ?>">
                        <?= e($country) ?> (<?= $countryCounts[$country] ?>)
                    </a>
                <?php endforeach; ?>
            </div>

            <p class="filter-label">Urutan</p>
            <div class="filter-buttons">
                <?php foreach ($sortOptions as $sortValue => $sortLabel): ?>
                    <?php $sortLink = 'katalog.php?country=' . urlencode($selectedCountry) . '&sort=' . urlencode((string) $sortValue); ?>
                    <a href="<?= e($sortLink) ?>"
                       class="filter-btn <?= $selectedSort === $sortValue ? 'active' : '' ?>">
                        <?= e($sortLabel) ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </section>

        <section>
            <h2>
                <?php if ($selectedCountry === 'all'): ?>
                    All Units
                <?php else: ?>
                    Units dari <?= e($selectedCountry) ?>
                <?php endif; ?>
            </h2>

            <p class="result-info">
                Menampilkan <?= count($filteredUnits) ?> dari <?= count($units) ?> units
            </p>

            <?php if (count($filteredUnits) === 0): ?>
                <p>Tidak ada unit dari negara ini.</p>
            <?php else: ?>
                <div class="units-list">
                    <?php foreach ($filteredUnits as $unit): ?>
                        <article class="unit-card">

                            <div class="unit-visual">
                                <img src="<?= e($unit['image']) ?>"
                                     alt="Tank <?= e($unit['name']) ?> dari <?= e($unit['country']) ?>"
                                     loading="lazy">
                                <div class="unit-title">
                                    <span class="unit-category">Ground Vehicles</span>
                                    <h3><?= e($unit['name']) ?></h3>
                                </div>
                            </div>

                            <div class="unit-info">
                                <div class="info-box">
                                    <strong><?= e((string) $unit['battle_rating']) ?></strong>
                                    <span>BR</span>
                                </div>
                                <div class="info-box">
                                    <strong><?= e($unit['type']) ?></strong>
                                    <span>Role</span>
                                </div>
                                <div class="info-box">
                                    <strong><?= e($unit['country']) ?></strong>
                                    <span>Negara</span>
                                </div>
                                <div class="info-box">
                                    <strong>
                                        <span class="<?= e(getStatusClass($unit['status'])) ?>">
                                            <?= e(getStatusLabel($unit['status'])) ?>
                                        </span>
                                    </strong>
                                    <span>Status</span>
                                </div>
                                <div class="info-box info-wide">
                                    <strong class="reason-text"><?= e($unit['reason']) ?></strong>
                                    <span>Reason</span>
                                </div>
                            </div>

                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>

    </main>

    <footer>
        <div class="container">
            <p>&copy; Darren Haq. Projek UTS pemrograman web 2026</p>
        </div>
    </footer>

</body>
</html>