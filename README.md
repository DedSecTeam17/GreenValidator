# GreenValidator
![GitHub Logo](leaf.png)
###green validator it,s a php lib for form validation
########types of validation on this version :
1. Email 
2. Numbers
3. String
4. Float
5. double 
6. String min
7. String max 
8. complex----> mix of all above 

###Examples :
1. create object of GreenValidator in your php class :
```php
   $valdiator = new GreenValidator();
```

2. call method validate and fallow it wit execute method  : 
```php
   $valdiator = new GreenValidator();
   
    $result = $valdiation->validate(
           [
               'FirstName LastName' => 'string|min:6|max:150',
               'molaksmdkajsnd928' => 'string|max:255|min:2',
               'example@ahoo.com' => 'email',
               2019 => 'number',
               5.55 => 'float'
           ])->execute();
```

2. use result variable to check your data is valid or not . GreenValidator use Validation class to OOP to it 
from result you have to method
     *  ```php  getisValid()  ``` 
           * to check if your data valid or not
     * ```php  getMessage ```
         * to get message against entered data 
 ```php
    if ($result->getisValid()) {
        echo 'validated !! attempt to insert data successfully';

    } else {
        echo $result->getMessage();
    }
 ```


###### ok if feel there are need to add more staff please help me ^_^
            

