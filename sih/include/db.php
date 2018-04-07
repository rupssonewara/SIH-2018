<?php


class db
{
    private $dbhost = 'mysql.hostinger.in';
    private $dbuser = 'u227762889_cryst';
    private $dbpass = 'crysthope';
    private $dbname = 'u227762889_sih';

    public function connect(){
        $mysql_connect_str = "mysql:host=$this->dbhost;dbname=$this->dbname";
        $dbConnection = new PDO($mysql_connect_str, $this->dbuser, $this->dbpass);

        $dbConnection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        return $dbConnection;
    }

}