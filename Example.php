<?php


    require_once  'GreenValidator.php';

    $valdiation = new GreenValidator();


    $result = $valdiation->validate(
        [
            'Mohammed Elamin' => 'string|min:6|max:19',
            'mohamed13374' => 'string|max:255|min:2',
            'mohammed@ahoo.com' => 'email',
            'asd' => 'string',
            '5.55' => 'float'
        ])->execute();


    if ($result->getisValid()) {
        echo 'validated';

    } else {
        echo $result->getMessage();
    }
