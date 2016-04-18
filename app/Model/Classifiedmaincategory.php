<?php 

App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');


class Classifiedmaincategory extends AppModel{
    public $name = 'Classifiedmaincategory';
    public $useTable = 'classified_maincategories';

}
?>