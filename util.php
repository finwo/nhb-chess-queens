<?php

/**
 * Validate a possible solution
 *
 * @param array $board     The possible solution to validate
 *
 * @return boolean $valid  Whether or not the given solution is valid
 */
function solution_valid(array $board): bool {

    // Check for vertical duplicate
    // validate by rotating the board (swap x/y axis)
    $rotated = [];
    for($y = 0 ; $y < 7 ; $y++) {
        $x = $board[$y];

        // Duplicate found = fail
        if (isset($rotated[$x])) {
            return false;
        }

        // Track rotated board
        $rotated[$x] = $y;
    }

    // Check diagonal y+x
    // Builds view and checks for duplicates
    $sums = array_fill(0,13,0);
    foreach($sums as $index => &$sum) {

        // Calculate start point
        $y = max(0, 6 - $index);
        $x = max(0, $index - 6);

        // Sum diagonal
        for(; $x<7 && $y<7; $y++, $x++) {
            if ($board[$y] == $x) {
                $sum++;
            }
        }

        // More than 1 = failed
        if ($sum > 1) {
            return false;
        }
    }

    // Check diagonal y-x
    // Builds view and checks for duplicates
    $sums = array_fill(0,13,0);
    foreach($sums as $index => &$sum) {

        // Calculate start point
        $y = max(0, 6 - $index);
        $x = min(6, 12 - $index);

        // Sum diagonal
        for(; $x>=0 && $y<7; $y++, $x--) {
            if ($board[$y] == $x) {
                $sum++;
            }
        }

        // More than 1 = failed
        if ($sum > 1) {
            return false;
        }
    }

    // All checks passed
    return true;
}

/**
 * Output a visual version of the board
 *
 * @param array $board
 */
function solution_print(array $board): void {

    // Print top edge
    echo '+---+---+---+---+---+---+---+', PHP_EOL;

    // Print all the rows
    foreach($board as $row) {

        // Left edge of the board
        echo '|';

        // Spaces before the queen
        echo str_repeat('   |', $row);

        // The queen itself
        echo ' X |';

        // Spaces behind the queen
        echo str_repeat('   |', 6 - $row), PHP_EOL;

        // Print bottom edge of row
        echo '+---+---+---+---+---+---+---+', PHP_EOL;
    }
}

