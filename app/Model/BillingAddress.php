<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');


class BillingAddress extends AppModel{
 public $name = 'BillingAddress';
    public $useTable = 'billing_address'; 
    
    
    
}