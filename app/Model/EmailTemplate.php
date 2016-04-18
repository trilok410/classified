<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');


class EmailTemplate extends AppModel{
 public $name = 'EmailTemplate';
    public $useTable = 'email_templates'; 
    
    
    
}