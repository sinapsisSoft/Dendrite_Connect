<?php
#Author: LAURA GRISALES
#Date: 17/09/2020
#Description : Is DAO Process
include "../class/connectionDB.php";
class DaoProcess
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
    public function newProcess($objProcess)
    {
        try {
            $con = $this->objConntion->connect();
            $con->query("SET NAMES 'utf8'");
            if ($con != null) {
                $dataProcess = "'" . $objProcess->__getBuilding() . "','" . $objProcess->__getOrigin() ."','" . $objProcess->__getOffice() . "','" . $objProcess->__getOfficeEmail() . "','" . $objProcess->__getFiling() . "','". $objProcess->__getConsecutive() . "',". $objProcess->__getClient() . ",'". $objProcess->__getAttorney() . "','". $objProcess->__getPlaintiff() . "','". $objProcess->__getDefendant() . "','". $objProcess->__getDepartment() . "','". $objProcess->__getCity() . "','". $objProcess->__getJuridistic() . "','". $objProcess->__getArea() . "',". $objProcess->__getPtype();
                if ($result = $con->query("CALL sp_process_insert_update (" . $dataProcess . ")")) {
                  while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                    $this->arrayResult[] =$row;
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

  #Description : Function for select Process
  public function selectProcessActive($dataProcess)
  {
    try {
      $con = $this->objConntion->connect();
      $con->query("SET NAMES 'utf8'");
      if ($con != null) {
        if ($result = $con->query("CALL sp_process_active('" . $dataProcess . "')")) {
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

  #Description : Function for select one Process
  public function selectOneProcess($dataProcess)
  {
    try {
      $con = $this->objConntion->connect();
      $con->query("SET NAMES 'utf8'");
      if ($con != null) {
        if ($result = $con->query("CALL sp_process_select_one (" . $dataProcess . ")")) {
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

   #Description: Function for create a new performace
   public function newPerfomance($objProcess)
   {
       try {
           $con = $this->objConntion->connect();
           $con->query("SET NAMES 'utf8'");
           if ($con != null) {
               $dataProcess = $objProcess->__getPerId() . ",'" . $objProcess->__getPerDescription() ."','" . $objProcess->__getPerDate() . "','" . $objProcess->__getPerInitialDate() . "','" . $objProcess->__getPerFinalDate() . "','". $objProcess->__getPerLocation() . "','". $objProcess->__getPerAttached() . "',". $objProcess->__getId();
               if ($con->query("CALL sp_performance_insert_update (" . $dataProcess . ")")) {
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

    #Description : Function for select Performances of one Process
    public function selectPerformance($objProcess)
    {
        try {
            $con = $this->objConntion->connect();
            $con->query("SET NAMES 'utf8'");
            if ($con != null) {
                $dataProcess = $objProcess->__getId();
                if ($result = $con->query("CALL sp_performance_select_all (" . $dataProcess . ")")) {
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

    #Description : Function for select on performance
    public function selectOnePerformance($objProcess)
    {
        try {
            $con = $this->objConntion->connect();
            $con->query("SET NAMES 'utf8'");
            if ($con != null) {
                $dataProcess = $objProcess->__getPerId();
                if ($result = $con->query("CALL sp_performance_select_one (" . $dataProcess . ")")) {
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
}
