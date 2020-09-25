<?php

/*
 * Base controller
 * Loads the models and views
 */
class Controller {

  // Load model
  public function model($model) {

    // Compose name
    $modelName = "../app/models/" . $model . ".php";

    // Check the model file
    if (file_exists($modelName)) {

      // Require the model to load
      require_once $modelName;

      // Instantiate the model
      return new $model();

    } else {
      // No model exists
      die("Model " . $modelName . " does not exists");
    }
  }

  // Load view with data and fragments files
  public function view($view, $data = []) {

  // Compose name
  $viewName = "../app/views/" . $view . ".php";

    // Check the view file
    if (file_exists($viewName)) {

      // Require the view to load
      require_once $viewName;

    } else {
      // No view exists
      die("View " . $viewName . " does not exists");
    }
  }

  // Redirect view with clearing url
  public function redirect($view, $data = []) {

  // Compose name
  $viewName = "../app/controllers/" . $view . ".php";

    // Check the view file
    if (file_exists($viewName)) {
      $_POST["data"] = $data;
      // Require the view to load
      header("Location: " . URLROOT . "/" . $view);

    } else {
      // No view exists
      die("View " . $viewName . " does not exists");
    }
  }

  public function sessionCheck() {
  if ($_SESSION["userid"] == null) {
      $this->redirect("Userlogin");
  }
}
}




?>
