<?php
#Author: LAURA GRISALES
#Date: 23/08/2019
#Description : Is BO process
include "../dto/dto_process_type.php";
include "../dao/dao_process_type.php";
header("Content-type: application/json; charset=utf-8");
class BoProcessType
{
  private $objProcess;
  private $objDao;
  private $intValidate;

  public function __construct()
  {
    $this->objProcess = new DtoProcessType();
    $this->objDao = new DaoProcessType();
  }

  #Description: Function for create a new process type
  public function newProcessType($name, $description, $state)
  {
    try {
      $this->objProcess->__setProcess($name, $description, $state);
      $intValidate = $this->objDao->newProcessType($this->objProcess);
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
      $intValidate = 0;
    }
    return $intValidate;
  }

  #Description: Function for select process type
  public function selectProcessType($dataProcessType)
  {
    try {
      echo $this->objDao->selectProcessType($dataProcessType);
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
    }
  }

  #Description: Function for select process type
  public function selectOneProcessType($dataProcessType)
  {
    try {
      echo $this->objDao->selectOneProcessType($dataProcessType);
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
    }
  }

  #Description: Function list status process type
    public function selectStatusProcessType($id)
    {
      try {
        $this->objProcess->__setStatus($id);
        $intValidate = $this->objDao->selectStatusProcessType($this->objProcess);
      } catch (Exception $e) {
        echo 'Exception captured: ', $e->getMessage(), "\n";
        $intValidate = 0;
      }
      return $intValidate;
    }

    #Description: Function list subprocess
    public function selectAllSubprocess($id)
    {
      try {
        $this->objProcess->__setId($id);
        $intValidate = $this->objDao->selectAllSubprocess($this->objProcess);
      } catch (Exception $e) {
        echo 'Exception captured: ', $e->getMessage(), "\n";
        $intValidate = 0;
      }
      return $intValidate;
    }
}

$obj = new BoProcessType();
/// We get the json sent
$getData = file_get_contents('php://input');
$data = json_decode($getData);

/**********CREATE ************/
if (isset($data->POST)) {
  if ($data->POST == "POST") {
    echo $obj->newProcessType($data->Ptype_name, $data->Ptype_description, $data->Stat_id);
  }
}

/**********READ AND CONSULT ************/
if (isset($data->GET)) {
  if ($data->GET == "GET_ALL") {
    echo $obj->selectProcessType($data->Ptype_name);
  }
  if ($data->GET == "GET_LIST_STATUS") {
    echo $obj->selectStatusProcessType($data->Stat_id);
  }
  if ($data->GET == "GET_EDIT") {
    echo $obj->selectOneProcessType($data->Ptype_id);
  }
  if ($data->GET == "GET_SUBPROCESS") {
    echo $obj->selectAllSubprocess($data->Ptype_id);
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
//echo $obj->newProcess('Liquidacion', 'Proceso de liquidación', 8);
//echo $obj->selectProcess('');