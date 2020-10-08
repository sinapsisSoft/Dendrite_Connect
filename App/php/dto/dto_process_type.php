<?php
#Author: LAURA GRISALES
#Date: 14/09/2020
#Description : Is DTO Process Type
class DtoProcessType
{
    private $Ptype_id;
    private $Ptype_name;
    private $Ptype_description;
    private $Stat_id;

    public function __construct()
    {

    }
    public function __setProcess($name, $description, $status)
    {

        $this->Ptype_name = $name;
        $this->Ptype_description = $description;
        $this->Stat_id = $status;
    }

    public function __getProcess()
    {
        $objProcess = new DtoProcessType();
        $objProcess->__getId();
        $objProcess->__getName();
        $objProcess->__getDescription();        
        $objProcess->__getStatus();        
        return $objProcess;
    }
    //SET Pro
    public function __setId($id)
    {
        $this->Ptype_id = $id;
    }
    public function __setName($name)
    {
        $this->Ptype_name = $name;
    }
    public function __setDescription($description)
    {
        $this->Ptype_description = $description;
    }
    public function __setStatus($status)
    {
        $this->Stat_id = $status;
    }
    //GET Pro
    public function __getId()
    {
        return $this->Ptype_id;
    }
    public function __getName()
    {
        return $this->Ptype_name;
    }
    public function __getDescription()
    {
        return $this->Ptype_description;
    }
    public function __getStatus()
    {
        return $this->Stat_id;
    }
}
