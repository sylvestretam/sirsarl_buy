<?php

class DbConnect
{
    // public ?PDO $database = null;
    public  $database = null;

    public function getConection(): PDO
    {
        if($this->database === null)
        {
            $this->database = new PDO('mysql:host=localhost;dbname=sisas_erp;charset=utf8', 'sisas', 'sisas');
            // $this->database = new PDO('mysql:host=localhost;dbname=sisas_erp;charset=utf8', 'sisas_erp', 'Tam691672195$');
        }

        return $this->database;
    }
}