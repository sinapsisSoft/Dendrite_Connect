<?php
#Author: LAURA GRISALES
#Date: 17/09/2020
#Description : Is DAO Subprocess
include "../class/connectionDB.php";
class DaoSubprocess
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
    public function newSubprocess($objSubprocess)
    {
        try {
            $con = $this->objConntion->connect();
            $con->query("SET NAMES 'utf8'");
            if ($con != null) {
                $dataSubprocess = $objSubprocess->__getId() . ",'" . $objSubprocess->__getName() . "','" . $objSubprocess->__getDescription() ."',". $objSubprocess->__getProcess() . ",". $objSubprocess->__getStatus();
                if ($con->query("CALL sp_subprocess_insert_update (" . $dataSubprocess . ")")) {
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
    public function selectSubprocess($dataSubprocess)
    {
        try {
            $con = $this->objConntion->connect();
            $con->query("SET NAMES 'utf8'");
            if ($con != null) {
                if ($result = $con->query("CALL sp_subprocess_active('".$dataSubprocess."')")) {
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

    #Description : Function for select one subprocess
    public function selectOneSubprocess($dataSubprocess)
    {
        try {
            $con = $this->objConntion->connect();
            $con->query("SET NAMES 'utf8'");
            if ($con != null) {
                if ($result = $con->query("CALL sp_subprocess_select_one (" . $dataSubprocess . ")")) {
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
   public function selectStatusSubprocess($objSubprocess)
   {
     try {
       $con = $this->objConntion->connect();
       $con->query("SET NAMES 'utf8'");
       if ($con != null) {
         $dataId =  $objSubprocess->__getStatus();
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

   #Description: Function list process
   public function selectProcess()
   {
     try {
       $con = $this->objConntion->connect();
       $con->query("SET NAMES 'utf8'");
       if ($con != null) {
         if ($result = $con->query("CALL sp_select_process_type()")) {
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
