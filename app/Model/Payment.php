<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');


class Payment extends AppModel{
 	public $name = 'Payment';
    public $useTable = 'payment_detail'; 
    
    
    
}