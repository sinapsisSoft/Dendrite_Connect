<?php
#Author: LAURA GRISALES
#Date: 23/08/2019
#Description : Is BO Subprocess
include "../dto/dto_process.php";
include "../dao/dao_process.php";
header("Content-type: application/json; charset=utf-8");
class BoProcess
{
  private $objProcess;
  private $objDao;
  private $intValidate;

  public function __construct()
  {
    $this->objProcess = new DtoProcess();
    $this->objDao = new DaoProcess();
  }

  #Description: Function for create a new Process
  public function newProcess($building, $origin, $office, $officeEmail, $filing, $consecutive, $client, $attorney, $plaintiff, $defendant, $department, $city, $juridistic, $area, $ptype)
  {
    try {
      $this->objProcess->__setProcess($building, $origin, $office, $officeEmail, $filing, $consecutive, $client, $attorney, $plaintiff, $defendant, $department, $city, $juridistic, $area, $ptype);
      $intValidate = $this->objDao->newProcess($this->objProcess);
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
      $intValidate = 0;
    }
    return $intValidate;
  }

  #Description: Function for select Subprocess
  public function selectProcessActive($dataSubprocess)
  {
    try {
      echo $this->objDao->selectProcessActive($dataSubprocess);
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
    }
  }

  #Description: Function for select Subprocess
  public function selectOneProcess($dataSubprocess)
  {
    try {
      echo $this->objDao->selectOneProcess($dataSubprocess);
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
    }
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

  #Description: Function for create a new Performance
  public function newPerfomance($id, $description, $date, $initialDate, $finalDate, $location, $attached, $process)
  {
    try {
      $this->objProcess->__setPerformance($id, $description, $date, $initialDate, $finalDate, $location, $attached, $process);
      $intValidate = $this->objDao->newPerfomance($this->objProcess);
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
      $intValidate = 0;
    }
    return $intValidate;
  }

  #Description: Function list perfomances by process
  public function selectPerformance($id)
  {
    try {
      $this->objProcess->__setId($id);
      $intValidate = $this->objDao->selectPerformance($this->objProcess);
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
      $intValidate = 0;
    }
    return $intValidate;
  }

  #Description: Function one performance
  public function selectOnePerformance($id)
  {
    try {
      $this->objProcess->__setPerfId($id);
      $intValidate = $this->objDao->selectOnePerformance($this->objProcess);
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
      $intValidate = 0;
    }
    return $intValidate;
  }
}

$obj = new BoProcess();
/// We get the json sent
$getData = file_get_contents('php://input');
$data = json_decode($getData);

/**********CREATE ************/
if (isset($data->POST)) {
  if ($data->POST == "POST") {
    echo $obj->newProcess($data->Proc_building, $data->Proc_origin, $data->Proc_office, $data->Proc_officeEmail, $data->Proc_filing, $data->Proc_consecutive, $data->Client_id, $data->Proc_attorney, $data->Proc_plaintiff, $data->Proc_defendant, $data->Proc_department, $data->Proc_city, $data->Proc_juridistic, $data->Proc_area, $data->Ptype_id);
  }
  if ($data->POST == "POST_PERFORMANCE") {
    echo $obj->newPerfomance($data->Perf_id, $data->Perf_description, $data->Perf_date, $data->Perf_initialDate, $data->Perf_finalDate, $data->Perf_location, $data->Perf_attached, $data->Proc_id);
  }
}

/**********READ AND CONSULT ************/
if (isset($data->GET)) {
  if ($data->GET == "GET_ALL") {
    echo $obj->selectProcessActive($data->Proc_name);
  }
  // if ($data->GET == "GET_LIST_STATUS") {
  //   echo $obj-> selectStatusSubprocess($data->Stat_id);
  // }
  if ($data->GET == "GET_EDIT") {
    echo $obj->selectOneProcess($data->Proc_id);
  }
  if ($data->GET == "GET_LIST_PROCESS") {
    echo $obj-> selectProcess();
  }
  if ($data->GET == "GET_PERFORMANCE") {
    echo $obj->selectPerformance($data->Proc_id);
  }
  if ($data->GET == "GET_ONE_PERFORMANCE") {
    echo $obj->selectOnePerformance($data->Perf_id);
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
//echo $obj->newProcess('PALACIO DE JUSTICIA','13 LABORAL / 33 ADMINISTRATIVO','CSJ - SALA DISCIPLINARIA','','11001010200020190237100', '2019-2371', 1, 'MÓNICA QUINTERO', 'SERVICIO OCCIDENTAL DE SALUD EPS', 'MINISTERIO DE SALUD', 'BOGOTÁ D.C.', 'BOGOTÁ D.C.', 'ORDINARIA', 'PENAL', 1);
//echo $obj->newPerfomance(0,'11 Ago 2020 - RECIBIDA ACLARACION DE VOTO','2020-03-13','','','DESPACHO','',4);
//echo $obj->selectSubprocess('');
//echo $obj->selectPerformance(21);
//echo $obj->selectOnePerformance(1);