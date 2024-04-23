<?php
declare(strict_types =  1); 
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/functions.php';
?>

<?php
$testArr = null;
$testKey = null;
$targetArr = [
    'key1' => 'value1',
    'key2' => 'value2',
    'key3' => [
        'key3-1' => 'value3-1',
        'key3-2' => 'value3-2',
        'key3-3' => 'value3-3',
        'key3-4' => 'value3-4',
        'key3-5' => 'value3-5',
    ],
    'key4' => 'value4',
    'key5' => 'value5',
    'key6' => 'value6',
    'key7' => [
        'key7-1' => 'value7-1',
        'key7-2' => 'value7-2',
        'key7-3' => [
            'key7-3-1' => 'value7-3-1',
            'key7-3-2' => 'value7-3-2',
            'key7-3-3' => 'value7-3-3',
            'key7-3-4' => 'value7-3-4',
            'key7-3-5' => 'value7-3-5',
        ],
    ],
];

dump (data_get($targetArr, 'key7.key7-3.key7-3-5', date("Y/n/j")));

?>