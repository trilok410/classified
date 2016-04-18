<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');


class UserFavorite extends AppModel{
 public $name = 'UserFavorite';
    public $useTable = 'user_favorite'; 
    
    
    
}