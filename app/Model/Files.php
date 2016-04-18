<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');


class Files extends AppModel{
 public $name = 'file';
    public $useTable = 'files'; 
    
    
    
}