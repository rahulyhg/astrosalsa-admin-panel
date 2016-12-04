<?php
require_once '../Domain/Administrator.php';
/**
* StudentAdministrator
* Administrates the students
*/
class StudentsAdministrator extends Administrator {

  public function __construct() {

    parent::__construct( 'students' );

  }

  public function getStudentByName( $taskData ) {
      $this->accessDatabase();
      $attributes = ["*" => "*"];
      $rowFilters = "name=".$taskData['name'];

      $isTaskSuccessful = $this->databaseAccessor->selectRows( $attributes, $rowFilters );
      $stamp = 'get ' . $this->tableName;

      return $this->writeReport( $isTaskSuccessful, $stamp );
  }

  public function getStudentByID( $taskData ) {

      $this->accessDatabase();
      $attributes = ["*" => "*"];
      $rowFilters = "id=".$taskData['id'];

      $isTaskSuccessful = $this->databaseAccessor->selectRows( $attributes, $rowFilters );
      $stamp = 'get ' . $this->tableName;
      $isTaskSuccessful = $isTaskSuccessful[0];

      return $this->writeReport( $isTaskSuccessful, $stamp );
  }

  protected function logStudentInscription(){
      $tableName = 'studentInscriptionLog';
      $activity = [
          'studentId' => $this->databaseAccessor->getLastInsertedId(),
          'date' => date('Y/m/d')
      ];

      ActivityLogger::logActivity ( $tableName, $activity );

  }

  protected  function logActivity( $activityData, $stamp ){

      if( $stamp === 'add students'){

          $this->logStudentInscription();

      }
  }

  protected function getInscriptionsLog( $taskData ){

    $tableName = 'studentInscriptionLog';
    $databaseResponse = ActivityLogger::getActivityLog( $tableName, $taskData );
    $stamp = 'get '. $this->tableName;

    return $this->writeReport( $databaseResponse, $stamp );

    }
}
