<?php 




//Leggo il file json e lo decodo
$phpList = json_decode(file_get_contents('./data/data.json'), true);

//Se c'è todo settato
if (isset($_POST['todo'])) {
    $todo = $_POST['todo'];
    $done = $_POST['done'];
    $newtodo = [//Creo un nuovo array associativo con ciò che mi serve
        'todo' => $todo,
        'done' => $done//viene inviato come stringa e non booleano, dopo mangiato vedo
    ];
    array_push($phpList, $newtodo);//e lo pusho all'array decodificato

}

$jsData = json_encode($phpList);//Ricodifico l'array in json
file_put_contents('./data/data.json', $jsData);//Sovrascrivo il file json con l'array JSON aggiornato




header('Content-Type: application/json');//Specifico il tipo di dato che verrà letto dal browser

echo $jsData;//Stampo l'array per la lettura



