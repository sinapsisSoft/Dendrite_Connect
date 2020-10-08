<?php
#Author: LAURA GRISALES
#Date: 24/09/2020
#Description : Is DTO process
class DtoProcess
{
    private $Proc_id;
    private $Proc_building;    
    private $Proc_origin;
    private $Proc_office;
    private $Proc_officeEmail;
    private $Proc_filing;
    private $Proc_consecutive;
    private $Client_id;
    private $Proc_attorney;
    private $Proc_plaintiff;
    private $Proc_defendant;
    private $Proc_department;
    private $Proc_city;
    private $Proc_juridistic;
    private $Proc_area;
    private $Ptype_id;
    private $Perf_id;
    private $Perf_description;
    private $Perf_date;
    private $Perf_initialDate;
    private $Perf_finalDate;
    private $Perf_location;
    private $Perf_attached;

    public function __construct()
    {

    }
    public function __setProcess($building, $origin, $office, $officeEmail, $filing, $consecutive, $client, $attorney, $plaintiff, $defendant, $department, $city, $juridistic, $area, $ptype)
    {

        $this->Proc_building = $building;        
        $this->Proc_origin = $origin;
        $this->Proc_office = $office;
        $this->Proc_officeEmail = $officeEmail;
        $this->Proc_filing = $filing;
        $this->Proc_consecutive = $consecutive;
        $this->Client_id = $client;
        $this->Proc_attorney = $attorney;
        $this->Proc_plaintiff = $plaintiff;
        $this->Proc_defendant = $defendant;
        $this->Proc_department = $department;
        $this->Proc_city = $city;
        $this->Proc_juridistic = $juridistic;
        $this->Proc_area = $area;
        $this->Ptype_id = $ptype;
    }

    public function __setPerformance($id, $description, $date, $initialDate, $finalDate, $location, $attached, $process)
    {
        $this->Perf_id = $id;
        $this->Perf_description = $description;
        $this->Perf_date = $date;
        $this->Perf_initialDate = $initialDate;
        $this->Perf_finalDate = $finalDate;
        $this->Perf_location = $location;
        $this->Perf_attached = $attached;
        $this->Proc_id = $process;
    }

    public function __getProcess()
    {
        $objProcess = new DtoProcess();
        $objProcess->__getId();
        $objProcess->__getBuilding();        
        $objProcess->__getOrigin();
        $objProcess->__getOffice();
        $objProcess->__getOfficeEmail();
        $objProcess->__getFiling();
        $objProcess->__getConsecutive();
        $objProcess->__getClient();
        $objProcess->__getAttorney();
        $objProcess->__getPlaintiff();
        $objProcess->__getDefendant();
        $objProcess->__getDepartment();
        $objProcess->__getCity();
        $objProcess->__getJuridistic();
        $objProcess->__getArea();
        $objProcess->__getPtype();      
        return $objProcess;
    }

    public function __getPerformace()
    {
      $objProcess = new DtoProcess();
      $objProcess->__getPerId();
      $objProcess->__getPerDescription();
      $objProcess->__getPerDate();
      $objProcess->__getPerInitialDate();
      $objProcess->__getPerFinalDate();
      $objProcess->__getPerLocation();
      $objProcess->__getPerAttached();
      $objProcess->__getId();
      return $objProcess;
    }
    //SET Process
    public function __setId($id)
    {
        $this->Proc_id = $id;
    }
    public function __setBuilding($building)
    {
        $this->Proc_building = $building;
    }    
    public function __setOrigin($origin)
    {
        $this->Proc_origin = $origin;
    }
    public function __setOffice($office)
    {
        $this->Proc_office = $office;
    }
    public function __setOfficeEmail($officeEmail)
    {
        $this->Proc_officeEmail = $officeEmail;
    }
    public function __setFiling($filing)
    {
        $this->Proc_filing = $filing;
    }
    public function __setConsecutive($consecutive)
    {
        $this->Proc_consecutive = $consecutive;
    }
    public function __setClient($client)
    {
        $this->Client_id = $client;
    }
    public function __setAttorney($attorney)
    {
        $this->Proc_attorney = $attorney;
    }
    public function __setPlaintiff($plaintiff)
    {
        $this->Proc_plaintiff = $plaintiff;
    }
    public function __setDefendant($defendant)
    {
        $this->Proc_defendant = $defendant;
    }
    public function __setDepartment($department)
    {
        $this->Proc_department = $department;
    }
    public function __setCity($city)
    {
        $this->Proc_city = $city;
    }
    public function __setJuridistic($juridistic)
    {
        $this->Proc_juridistic = $juridistic;
    }
    public function __setArea($area)
    {
        $this->Proc_area = $area;
    }
    public function __setPtype($ptype)
    {
        $this->Ptype_id = $ptype;
    }
    // SET PERFORMANCE
    public function __setPerfId($id)
    {
        $this->Perf_id = $id;
    }
    public function __setPerDescription($description)
    {
        $this->Perf_description = $description;
    }
    public function __setPerDate($date)
    {
        $this->Perf_date = $date;
    }
    public function __setPerInitialDate($initialDate)
    {
        $this->Perf_initialDate = $initialDate;
    }
    public function __setPerFinalDate($finalDate)
    {
        $this->Perf_finalDate = $finalDate;
    }
    public function __setPerLocation($location)
    {
        $this->Perf_location = $location;
    }
    public function __setPerAttached($attached)
    {
        $this->Perf_attached = $attached;
    }

    //GET Process
    public function __getId()
    {
        return $this->Proc_id;
    }
    public function __getBuilding()
    {
        return $this->Proc_building;
    }    
    public function __getOrigin()
    {
        return $this->Proc_origin;
    }
    public function __getOffice()
    {
        return $this->Proc_office;
    }
    public function __getOfficeEmail()
    {
        return $this->Proc_officeEmail;
    }
    public function __getFiling()
    {
        return $this->Proc_filing;
    }
    public function __getConsecutive()
    {
        return $this->Proc_consecutive;
    }
    public function __getClient()
    {
        return $this->Client_id;
    }
    public function __getAttorney()
    {
        return $this->Proc_attorney;
    }
    public function __getPlaintiff()
    {
        return $this->Proc_plaintiff;
    }
    public function __getDefendant()
    {
        return $this->Proc_defendant;
    }
    public function __getDepartment()
    {
        return $this->Proc_department;
    }
    public function __getCity()
    {
        return $this->Proc_city;
    }
    public function __getJuridistic()
    {
        return $this->Proc_juridistic;
    }
    public function __getArea()
    {
        return $this->Proc_area;
    }
    public function __getPtype()
    {
        return $this->Ptype_id;
    }
    // GET PERFORMANCE
    public function __getPerId()
    {
        return $this->Perf_id;
    }
    public function __getPerDescription()
    {
        return $this->Perf_description;
    }
    public function __getPerDate()
    {
        return $this->Perf_date;
    }
    public function __getPerInitialDate()
    {
        return $this->Perf_initialDate;
    }
    public function __getPerFinalDate()
    {
        return $this->Perf_finalDate;
    }
    public function __getPerLocation()
    {
        return $this->Perf_location;
    }
    public function __getPerAttached()
    {
        return $this->Perf_attached;
    }
}
