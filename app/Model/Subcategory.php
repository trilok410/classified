<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');


class Subcategory extends AppModel{
 	public $name = 'Subcategory';
    public $useTable = 'classified_subcategory';     
}