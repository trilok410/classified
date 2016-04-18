<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');


class ClassifiedImage extends AppModel{
 public $name = 'ClassifiedImage';
    public $useTable = 'classifiedimages'; 
    
    
    
}