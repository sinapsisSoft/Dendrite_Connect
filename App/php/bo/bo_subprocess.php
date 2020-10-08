<?php
#Author: LAURA GRISALES
#Date: 23/08/2019
#Description : Is BO Subprocess
include "../dto/dto_subprocess.php";
include "../dao/dao_subprocess.php";
header("Content-type: application/json; charset=utf-8");
class BoSubprocess
{
  private $objSubprocess;
  private $objDao;
  private $intValidate;

  public function __construct()
  {
    $this->objSubprocess = new DtoSubprocess();
    $this->objDao = new DaoSubprocess();
  }

  #Description: Function for create a new Subprocess
  public function newSubprocess($id, $name, $description, $process, $state)
  {
    try {
      $this->objSubprocess->__setSubprocess($id, $name, $description, $process, $state);
      $intValidate = $this->objDao->newSubprocess($this->objSubprocess);
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
      $intValidate = 0;
    }
    return $intValidate;
  }

  #Description: Function for select Subprocess
  public function selectSubprocess($dataSubprocess)
  {
    try {
      echo $this->objDao->selectSubprocess($dataSubprocess);
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
    }
  }

  #Description: Function for select Subprocess
  public function selectOneSubprocess($dataSubprocess)
  {
    try {
      echo $this->objDao->selectOneSubprocess($dataSubprocess);
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
    }
  }

  #Description: Function list status Subprocess
    public function selectStatusSubprocess($id)
    {
      try {
        $this->objSubprocess->__setStatus($id);
        $intValidate = $this->objDao->selectStatusSubprocess($this->objSubprocess);
      } catch (Exception $e) {
        echo 'Exception captured: ', $e->getMessage(), "\n";
        $intValidate = 0;
      }
      return $intValidate;
    }

    #Description: Function list Process
    public function selectProcess()
    {
      try {
        $intValidate = $this->objDao->selectProcess();
      } catch (Exception $e) {
        echo 'Exception captured: ', $e->getMessage(), "\n";
        $intValidate = 0;
      }
      return $intValidate;
    }
}

$obj = new BoSubprocess();
/// We get the json sent
$getData = file_get_contents('php://input');
$data = json_decode($getData);

/**********CREATE ************/
if (isset($data->POST)) {
  if ($data->POST == "POST") {
    echo $obj->newSubprocess($data->Spro_id, $data->Spro_name, $data->Spro_description, $data->Ptype_id, $data->Stat_id);
  }
}

/**********READ AND CONSULT ************/
if (isset($data->GET)) {
  if ($data->GET == "GET_ALL") {
    echo $obj->selectSubprocess($data->Spro_name);
  }
  if ($data->GET == "GET_LIST_STATUS") {
    echo $obj-> selectStatusSubprocess($data->Stat_id);
  }
  if ($data->GET == "GET_EDIT") {
    echo $obj->selectOneSubprocess($data->Spro_id);
  }
  if ($data->GET == "GET_LIST_PROCESS") {
    echo $obj-> selectProcess();
  }
}

/********** UPDATE ************/
if (isset($data->PUT)) {
  if ($data->PUT == "PUT") { }
}

/********** DELETE  ************/
if (isset($data->DELETE)) {
  if ($data->DELETE == "DELETE") { }
}
/**********************/
//echo $obj->newSubprocess(0,'Prueba 4', 'Detalle prueba 4', 3, 8);
//echo $obj->selectSubprocess('');