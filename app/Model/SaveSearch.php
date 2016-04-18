<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');


class SaveSearch extends AppModel{
 public $name = 'SaveSearch';
    public $useTable = 'user_savesearch'; 
    
    
    
}