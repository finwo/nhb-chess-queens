# nhb-chess-queens

This project was created as code test solution for a job interview. The
requirements of the test can be found in spec.md.

## Running

Simply cloning the repository and run the following command:

```sh
php index.php
```

## Dependencies

- php5.6 .. php7.4

## Heads up

- No function return types were used to be compatible with php5.6
- 3rd party code was not needed, so composer was not initialized
- Functional programming was chosen over OOP, because the problem could be reduced to math

## Approach

Because there will be no overlap in horizontal or vertical direction, we can
  treat the chess-board as a 7x7 graph

A possible solution will be stored as an array with 7 integers, where the Y
  axis is the array's index and the X axis the integer stored there, both
  ranging from 0 up to, and including, 6.

Handling the board as a graph we approach the problem as solving the
  prerequisites in a multiplicative modulo 7 graph.

Because 7 is a prime number, all integers below it (e.g. locations on the
  board) are co-prime to it. This removes the need for horizontal and
  vertical checks, even though they are included.

Approach:
- Select an increment
- Generate board/graph: y * increment = x (mod 7)
- Validate solution diagonally
- Print

This approach does not include rotations, so only an estimated n/4 solutions
  are found for the problem.
