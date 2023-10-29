<?php
class conexao {
    public $con;
    public function __construct()
    {
         $this->con = new PDO("mysql:host=localhost;dbname=projetophp", "root", "");
    }
      
}
  

