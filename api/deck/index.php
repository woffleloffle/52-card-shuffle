<?php

include "../includes/functions.php";
/*$cards = [
    'c1', 'c2', 'c3', 'c4', 'c5', 'c6', 'c7', 'c8', 'c9', 'c10', 'c11', 'c12', 'c13',
    'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'h7', 'h8', 'h9', 'h10', 'h11', 'h12', 'h13',
    'd1', 'd2', 'd3', 'd4', 'd5', 'd6', 'd7', 'd8', 'd9', 'd10', 'd11', 'd12', 'd13',
    's1', 's2', 's3', 's4', 's5', 's6', 's7', 's8', 's9', 's10', 's11', 's12', 's13'
];*/

    $id = $_GET['id'];

    $sql = "SELECT * FROM decks WHERE id = $id";
    //print_r($sql);
    // Let's connect to the database
    $db = dbConnect();
    // Then, prepare the statement to run..
    $statement = $db->prepare($sql);
    // execute the prepared statement
    $statement->execute();
    // Go get the data.
    $data = $statement->fetchall(PDO::FETCH_ASSOC);
     //echo '<pre>', print_r($data) ,'</pre>';
    // Close the connection!
    $db = $statement = null;

    // Make the deck from string into array to shuffle again
     $deck = explode(',', $data[0]['deck']);
     //shuffle($deck);
    //  echo '<pre>', print_r($deck), '</pre>';
    /*
    // split the string into elements to read the suits.
    foreach ($deck as $card) {

        $split = str_split($card,1);

        echo '<pre>', print_r($split), '</pre>';
    }*/
    // Nice response
    $response = new Response();

    // Create an object holding everything
    $body = (object)array(
        'id' => $id,
        'deck' => $deck
    );
    $response->code = 200;
    $response->status = "success";
    $response->body = $body;

    header("Content-Type: application/json");
    echo json_encode($response);



