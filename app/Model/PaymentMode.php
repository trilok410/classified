<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');


class PaymentMode extends AppModel{
 public $name = 'PaymentMode';
    public $useTable = 'payment_modes'; 
    
    
    
}