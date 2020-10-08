<?php
#Author: LAURA GRISALES
#Date: 14/09/2020
#Description : Is DAO Process Type
include "../class/connectionDB.php";
class DaoProcessType
{
    private $objConntion;
    private $arrayResult;
    private $intValidatio;

    public function __construct()
    {
        $this->objConntion = new Connection();
        $this->arrayResult = array();
        $this->intValidatio;
    }
    #Description: Function for create a new provider
    public function newProcessType($objProcessType)
    {
        try {
            $con = $this->objConntion->connect();
            $con->query("SET NAMES 'utf8'");
            if ($con != null) {
                $dataProcessType = "'" . $objProcessType->__getName() . "','" . $objProcessType->__getDescription() ."',". $objProcessType->__getStatus();
                if ($con->query("CALL sp_process_type_insert_update (" . $dataProcessType . ")")) {
                    $this->intValidatio = 1;
                } else {
                    $this->intValidatio = 0;
                }
            }
            $con->close();
        } catch (Exception $e) {
            echo 'Exception captured: ', $e->getMessage(), "\n";
            $this->intValidatio = 0;
        }
        return $this->intValidatio;
    }

    #Description : Function for select Process
    public function selectProcessType($dataProcessType)
    {
        try {
            $con = $this->objConntion->connect();
            $con->query("SET NAMES 'utf8'");
            if ($con != null) {
                if ($result = $con->query("CALL sp_process_type_active('".$dataProcessType."')")) {
                    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                        $this->arrayResult[] =$row;
                    };
                    mysqli_free_result($result);
                }
            }
            $con->close();
        } catch (Exception $e) {
            echo 'Exception captured: ', $e->getMessage(), "\n";
        }
        
        return json_encode($this->arrayResult);
    }  

    #Description : Function for select one process
    public function selectOneProcessType($dataProcessType)
    {
        try {
            $con = $this->objConntion->connect();
            $con->query("SET NAMES 'utf8'");
            if ($con != null) {
                if ($result = $con->query("CALL sp_process_type_select_one ('" . $dataProcessType . "')")) {
                    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                        $this->arrayResult[] = $row;
                    };
                    mysqli_free_result($result);
                }
            }
            $con->close();
        } catch (Exception $e) {
            echo 'Exception captured: ', $e->getMessage(), "\n";
        }
        return json_encode($this->arrayResult);
    }

   #Description: Function list status process
   public function selectStatusProcessType($objProcessType)
   {
     try {
       $con = $this->objConntion->connect();
       $con->query("SET NAMES 'utf8'");
       if ($con != null) {
         $dataId =  $objProcessType->__getStatus();
         if ($result = $con->query("CALL sp_select_status(" . $dataId . ")")) {

          while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $this->arrayResult[] = $row;
          };
          mysqli_free_result($result);
        }
       }
       $con->close();
     } catch (Exception $e) {
       echo 'Exception captured: ', $e->getMessage(), "\n";
       $this->intValidatio = 0;
     }
     return json_encode($this->arrayResult);
   }

   #Description: Function list subprocess
   public function selectAllSubprocess($objProcessType)
   {
     try {
       $con = $this->objConntion->connect();
       $con->query("SET NAMES 'utf8'");
       if ($con != null) {
         $dataId =  $objProcessType->__getId();
         if ($result = $con->query("CALL sp_subprocess_all(" . $dataId . ")")) {

          while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $this->arrayResult[] = $row;
          };
          mysqli_free_result($result);
        }
       }
       $con->close();
     } catch (Exception $e) {
       echo 'Exception captured: ', $e->getMessage(), "\n";
       $this->intValidatio = 0;
     }
     return json_encode($this->arrayResult);
   }
}
