<?php
#Author: LAURA GRISALES
#Date: 9/10/2020
#Description : Is DAO Video
include "../class/connectionDB.php";
class DaoVideo
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
  #Description: Function for register the video watched
  public function newVideo($objVideo)
  {
    try {
      $con = $this->objConntion->connect();
      $con->query("SET NAMES 'utf8'");
      if ($con != null) {  
        $dataVideo = "'" . $objVideo->__getName() . "','" . $objVideo->__getWatched() . "'," . $objVideo->__getUser();
        if ($con->query("CALL sp_video_insert (" . $dataVideo . ")")) {
          $this->intValidatio = 1;
        } 
        else {
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

  // #Description : Function for select user
  // public function selectUser($dataVideo)
  // {
  //   try {
  //     $con = $this->objConntion->connect();
  //     $con->query("SET NAMES 'utf8'");
  //     if ($con != null) {
  //       if ($result = $con->query("CALL sp_user_select_one('" . $dataVideo . "')")) {
  //         while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
  //           $this->arrayResult[] = $row;
  //         };
  //         mysqli_free_result($result);
  //       }
  //     }
  //     $con->close();
  //   } catch (Exception $e) {
  //     echo 'Exception captured: ', $e->getMessage(), "\n";
  //   }
  //   return json_encode($this->arrayResult);
  // }
}

