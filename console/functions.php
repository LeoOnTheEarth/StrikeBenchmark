<?php

/**
 * Show benchmark results
 *
 * @param int    $n
 * @param Ubench $bench  Total benchmark
 * @param Ubench $bench1 Initialize router benchmark
 * @param Ubench $bench2 Match pattern benchmark
 */
function showResults($n, $bench, $bench1, $bench2) {
    echo 'run ' . $n . ' times' . PHP_EOL;

    echo 'Total benchmark result:' . PHP_EOL;
    echo 'spent ' . $bench->getTime() . PHP_EOL;
    echo 'average spent ' . ($bench->getTime(true) / $n * 1000) . ' ms' . PHP_EOL;
    echo 'run ' . (int) floor($n / $bench->getTime(true)) . ' requests per second' . PHP_EOL;
    echo PHP_EOL;

    echo 'Initialize router benchmark result:' . PHP_EOL;
    echo 'spent ' . $bench1->getTime() . ' seconds.' . PHP_EOL;
    echo 'average spent ' . ($bench1->getTime(true) / $n * 1000) . ' ms' . PHP_EOL;
    echo 'run ' . (int) floor($n / $bench1->getTime(true)) . ' requests per second' . PHP_EOL;
    echo PHP_EOL;

    echo 'Match pattern benchmark result:' . PHP_EOL;
    echo 'spent ' . $bench2->getTime() . ' seconds.' . PHP_EOL;
    echo 'average spent ' . ($bench2->getTime(true) / $n * 1000) . ' ms' . PHP_EOL;
    echo 'run ' . (int) floor($n / $bench2->getTime(true)) . ' requests per second' . PHP_EOL;
    echo PHP_EOL;
}
