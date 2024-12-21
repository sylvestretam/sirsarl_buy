<?php

    require_once("src/model/employee.php");

    class EmployeeRepository
    {
        private $dbconnect;

        public function __construct($dbconnect)
        {
            $this->dbconnect = $dbconnect;
        }

        public function getAll()
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "SELECT * FROM AT_employee"
                );


                $statement->execute();
                
                $dmds = [];

                while($row = $statement->fetch(PDO::FETCH_ASSOC))
                {        
                    $dmd = new Employee();
                    $dmd->matricule =$row['matricule'];
                    $dmd->noms =$row['noms'];
                    $dmd->prenoms =$row['prenoms'];
                    $dmd->email =$row['email'];
                    $dmd->num_cni =$row['num_cni'];
                    $dmd->date_naissance =$row['date_naissance'];

                    $dmds[]= $dmd;
                }
                
                return $dmds;
            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }


    }