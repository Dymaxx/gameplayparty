<?php

class Dashboard extends controller {

  public function __construct() {
    $this->hallsModel = $this->model("Halls");
  }

  public function index() {
    $this->sessionCheck();
    $this->view("pages/dashboard");
  }

  public function halls($data = null) {
    $this->sessionCheck();
    $data["halls"] = $this->hallsModel->getAllHalls();
    $this->view("Pages/halls", $data);
  }

  public function acounts() {
    $this->sessionCheck();
    $this->view("Pages/acounts");
  }

  public function updatehall($id = null) {
    $this->sessionCheck();
    if (isset($id)) {
      $data = $this->hallsModel->getHall($id);
      if ($data["hall_error"] != null) {
        $data["halls"] = $this->hallsModel->getAllHalls();
        $this->view("pages/halls",$data);
      } else {
        $this->view("pages/updateHall",$data);
      }
    } else {
      $data = $this->hallsModel->sendUpdateHall();
      $data2 = $this->hallsModel->getHall($data["id"]);
      $data["hall"] = $data2["hall"];
      if ($data["success_message"] != null) {
        $this->view("pages/updateHall",$data);
      } else {
        $this->view("pages/updateHall",$data);
      }
    }
  }

  public function deletehall($id = null) {
    $this->sessionCheck();
    $data = [
      "hall_error" => null
    ];
    $data["hall_error"] = $this->hallsModel->deletehall($id,$data);
    if ($data) {
      $data["halls"] = $this->hallsModel->getAllHalls();  
      $this->updatehall("pages/halls",$data);
    } else {
      $this->redirect("Dashboard/halls");
    }
  }

  public function createhall() {
    $this->sessionCheck();
    $data = [
      "hall_number_error" => null,
      "hall_seats_error" => null,
      "hall_sound_error" => null,
      "error" => null,
      "success_message" => null
    ];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $data = $this->hallsModel->createHall($data);
      $this->view("pages/createHall",$data);
    } else {
      $this->view("pages/createHall",$data);
    }
  }


  public function createPacket() {
    $this->sessionCheck();
    $this->view("Pages/createPacket");
  }


}
