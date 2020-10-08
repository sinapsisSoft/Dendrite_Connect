<?php
#Author: LAURA GRISALES
#Date: 17/09/2020
#Description : Is DTO Subprocess
class DtoSubprocess
{
    private $Spro_id;
    private $Spro_name;
    private $Spro_description;
    private $Pro_id;
    private $Stat_id;

    public function __construct()
    {

    }
    public function __setSubprocess($id, $name, $description, $process, $status)
    {

        $this->Spro_id = $id;
        $this->Spro_name = $name;
        $this->Spro_description = $description;
        $this->Pro_id = $process;
        $this->Stat_id = $status;
    }

    public function __getSubprocess()
    {
        $objSubprocess = new DtoSubprocess();
        $objSubprocess->__getId();
        $objSubprocess->__getName();
        $objSubprocess->__getDescription();        
        $objSubprocess->__getProcess();        
        $objSubprocess->__getStatus();        
        return $objSubprocess;
    }
    //SET Subprocess
    public function __setId($id)
    {
        $this->Spro_id = $id;
    }
    public function __setName($name)
    {
        $this->Spro_name = $name;
    }
    public function __setDescription($description)
    {
        $this->Spro_description = $description;
    }
    public function __setProcess($process)
    {
        $this->Pro_id = $process;
    }
    public function __setStatus($status)
    {
        $this->Stat_id = $status;
    }
    //GET Subprocess
    public function __getId()
    {
        return $this->Spro_id;
    }
    public function __getName()
    {
        return $this->Spro_name;
    }
    public function __getDescription()
    {
        return $this->Spro_description;
    }
    public function __getProcess()
    {
        return $this->Pro_id;
    }
    public function __getStatus()
    {
        return $this->Stat_id;
    }
}
