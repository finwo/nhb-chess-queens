<?php

/*
 * Because there will be no overlap in horizontal or vertical direction, we can
 *   treat the chess-board as a 7x7 graph
 *
 * A possible solution will be stored as an array with 7 integers, where the Y
 *   axis is the array's index and the X axis the integer stored there, both
 *   ranging from 0 up to, and including, 6.
 *
 * Handling the board as a graph turns the issue into math instead of code
 *   complexity.
 *
 * ---
 *
 * Because the problem has been reduced to validation on a multiplicative
 * modulo (7), I'll be going for functional programming instead of OOP.
 *
 * Because 7 is a prime number, all integers below it (e.g. locations on the
 *   board) are co-prime to it. This removes the need for horizontal and
 *   vertical checks, even though they are included.
 *
 * Approach:
 * - Select an increment
 * - Generate board/graph: y * increment = x (mod 7)
 * - Validate solution diagonally
 * - Print
 *
 * This approach does not include rotations, so only an estimated n/4 solutions
 *   are found for the problem.
 */

// Validator and printing
require_once('./util.php');

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
