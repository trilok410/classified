<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');


class Tag extends AppModel{
 public $name = 'Tag';
    public $useTable = 'tags'; 
    
    
    
}