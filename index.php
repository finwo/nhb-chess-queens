<?php


// Validator and printing
require_once(__DIR__.'/util.php');

/*
 * Range 2..5 was chosen because:
 * * 1 produces diagonal lines, which are by definition invalid in our solution
 * * y * 6 = y * -1 (mod 7)
 */

$solutionsFound    = 0;
$solutionsEstimate = 0;
foreach(range(2,5) as $increment) {

    // Build the board
    $board = array_map(function($y) use ($increment) {
        return ($y * $increment) % 7;
    }, array_keys(array_fill(0,7,0)));

    // Validate the possible solution diagonally
    if (!solution_valid($board)) {
        continue;
    }

    // Print found solution
    solution_print($board);

    // Track found solutions
    $solutionsFound    += 1;
    $solutionsEstimate += 4;
}

printf('Found solutions: %d' . PHP_EOL, $solutionsFound);
printf('Estimated solutions: %d' . PHP_EOL, $solutionsEstimate);
