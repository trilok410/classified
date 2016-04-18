<?php

App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');


class Models extends AppModel{
 	public $name = 'Model';
    public $useTable = 'models'; 
    
    
    
}