<?php
#Author: LAURA GRISALES
#Date: 9/10/2020
#Description : Is DTO Video
class DtoVideo
{
    private $Video_id;
    private $Video_name;
    private $Video_watched;
    private $User_id;

    public function __construct()
    {

    }
    public function __setVideo($name, $watched, $user)
    {
        $this->Video_name = $name;
        $this->Video_watched = $watched;
        $this->User_id = $user;
    }

    public function __getVideo()
    {
        $objVideo = new DtoVideo();
        $objVideo->__getId();
        $objVideo->__getName();
        $objVideo->__getWatched();
        $objVideo->__getUser();
        return $objVideo;
    }
    //SET Video
    public function __setId($id)
    {
        $this->Video_id = $id;
    }
    public function __setName($name)
    {
        $this->Video_name = $name;
    }
    public function __setWatched($watched)
    {
        $this->Video_watched = $watched;
    }
    public function __setUser($user)
    {
        $this->User_id = $user;
    }    
    //GET User
   
    public function __getId()
    {
        return $this->Video_id;
    }
    public function __getName()
    {
        return $this->Video_name;
    }
    public function __getWatched()
    {
        return $this->Video_watched;
    }
    public function __getUser()
    {
        return $this->User_id;
    }
}
