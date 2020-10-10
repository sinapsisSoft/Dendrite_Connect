<?php
#Author: LAURA GRISALES
#Date: 9/10/2020
#Description : Is BO video
include "../dto/dto_video.php";
include "../dao/dao_video.php";
include "../../system/config.php";
// header("Content-type: application/json; charset=utf-8");
// header("Access-Control-Allow-Origin: https://www.rdinlaw.com");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Access-Control-Allow-Origin, X-Requested-With");
class BoVideo
{
  private $objVideo;
  private $objDao;
  private $intValidate;

  public function __construct()
  {
    $this->objVideo = new DtoVideo();
    $this->objDao = new DaoVideo();
  }

  #Description: Function for register the video watched
  public function newVideo($name, $watched, $user)
  {
    try {
      $this->objVideo->__setVideo($name, $watched, $user);
      $intValidate = $this->objDao->newVideo($this->objVideo);
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
      $intValidate = 0;
    }
    return $intValidate;
  }

  // #Description: Function for select user
  // public function selectUser($id)
  // {
  //   try {
  //     echo $this->objDao->selectUser($id);
  //   } catch (Exception $e) {
  //     echo 'Exception captured: ', $e->getMessage(), "\n";
  //   }
  // }
}

$obj = new BoVideo();
/// We get the json sent
$getData = file_get_contents('php://input');
$data = json_decode($getData);

/**********CREATE ************/
if (isset($data->POST)) {
  if ($data->POST == "POST") {
    echo $obj->newVideo($data->Video_name, $data->Video_watched, $data->User_id);
  }
}

/**********READ AND CONSULT ************/
if (isset($data->GET)) {
  // if ($data->GET == "GET") {
  //   echo $obj->selectUser($data->User_id);
  // }
}

/********** PUT ************/
if (isset($data->PUT)) {
  if ($data->PUT == "PUT") {
  }
}

/********** DELETE  ************/
if (isset($data->DELETE)) {
  if ($data->DELETE == "DELETE") {
  }
}

/**********************/

echo $obj->newVideo("video6", "1", 3);
//echo $obj->selectNotifications(3);



