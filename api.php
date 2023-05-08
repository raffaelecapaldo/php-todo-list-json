<?php 
//Leggo il file json e lo decodo
$phpList = json_decode(file_get_contents('./data/data.json'), true);

//Se c'è checkIndex settato ed è un numero
if(isset($_POST['checkIndex']) && ctype_digit($_POST['checkIndex'])) {
    $indexToCheck = $_POST['checkIndex'];
    $phpList[$indexToCheck]['done'] = !$phpList[$indexToCheck]['done'];//Imposta il valore inverso di done a quell'indice
}

//Se c'è delete index settato ed è un numero
if (isset($_POST['deleteIndex']) && ctype_digit($_POST['deleteIndex'])) {
$indexToRemove = $_POST['deleteIndex'];
array_splice($phpList, $indexToRemove, 1);//recuperato l'indice da POST, rimuovi l'item corrispondente dall'aray
}

//Se c'è todo settato ed è almeno di 3 caratteri
if (isset($_POST['todo']) && strlen($_POST['todo']) > 2) {
    $todo = $_POST['todo'];
    $done = $_POST['done'];
    $newtodo = [//Creo un nuovo array associativo con ciò che mi serve
        'todo' => $todo,
        'done' => filter_var($done, FILTER_VALIDATE_BOOLEAN)//rendi stringa nel formato booleano
    ];
    array_push($phpList, $newtodo);//e lo pusho all'array decodificato

}

$jsData = json_encode($phpList);//Ricodifico l'array in json
file_put_contents('./data/data.json', $jsData);//Sovrascrivo il file json con l'array JSON aggiornato




header('Content-Type: application/json');//Specifico il tipo di dato che verrà letto dal browser

echo $jsData;//Stampo l'array per la lettura



