<?php


    require_once  'GreenValidator.php';

    $valdiation = new GreenValidator();


    $result = $valdiation->validate(
        [
            'Mohammed Elamin' => 'string|min:6|max:15',
            'mohamed13374' => 'string|max:255|min:2',
            'mohammed@ahoo.com' => 'email',
            '2019' => 'number',
            '5.55' => 'float'
        ])->execute();


    if ($result->getisValid()) {
        echo 'validated !! attempt to insert data successfully';

    } else {
        echo $result->getMessage();
    }
