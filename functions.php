<?php

declare(strict_types=1);

// IDX

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function getStatusLabel(string $status): string
{
    return match ($status) {
        'researched' => 'Researched',
        'not_owned' => 'Not Owned',
        default => 'Unknown status',
    };
}

function getStatusClass(string $status): string
{
    return match ($status) {
        'researched' => 'badge bg-success',
        'not_owned' => 'badge bg-danger',
        default => 'badge bg-secondary',
    };
}

function countByStatus(array $units, string $status): int
{
    $filtered = array_filter($units, function (array $unit) use ($status): bool {
        return $unit['status'] === $status;
    });
    return count($filtered);
}

function getHighestBrUnit(array $units)
{
    if (count($units) === 0) {
        return null;
    }

    usort($units, function (array $a, array $b): int {
        return (float)$b['battle_rating'] <=> (float)$a['battle_rating'];
    });

    return $units[0];
}

function getAverageBr(array $units): float
{
    if (count($units) === 0) {
        return 0.0;
    }

    $totalBr = array_sum(array_column($units, 'battle_rating'));
    return $totalBr / count($units);
}

function countByCountry(array $units): array
{
    $result = [];

    foreach ($units as $unit) {
        $country = $unit['country'];
        if (!isset($result[$country])) {
            $result[$country] = 0;
        }
        $result[$country]++;
    }

    return $result;
}

// KAT

function getUniqueCountries(array $units): array
{
    $countries = array_unique(array_column($units, 'country'));
    sort($countries);

    return $countries;
}

function filterByCountry(array $units, string $country): array
{
    if ($country === 'all') {
        return $units;
    }

    $filtered = array_filter($units, function (array $unit) use ($country): bool {
        return $unit['country'] === $country;
    });

    return array_values($filtered);
}

function sortByBattleRating(array $units, string $sort): array
{
    if ($sort === 'br_asc') {
        usort($units, function (array $a, array $b): int {
            return $a['battle_rating'] <=> $b['battle_rating'];
        });
    } elseif ($sort === 'br_desc') {
        usort($units, function (array $a, array $b): int {
            return $b['battle_rating'] <=> $a['battle_rating'];
        });
    }
    
    return $units;
}