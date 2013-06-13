<?php

/**
 * Collection of upgrade steps
 */
class CRM_Civibooking_Upgrader extends CRM_Civibooking_Upgrader_Base {

  // By convention, functions that look like "function upgrade_NNNN()" are
  // upgrade tasks. They are executed in order (like Drupal's hook_update_N).

  /**
   * Example: Run an external SQL script when the module is installed
   */
  public function install() {

    $result = civicrm_api('OptionGroup', 'create', array(
      'version' => 3,
      'name' => 'resource_type',
      'title' => 'Resource type',
      'is_reserved' => '1',
      'is_active' => '1'
    ));

    if ($result['is_error']) {
     CRM_Core_Session::setStatus(ts('Failed to create resource type'));
    }else{
      $opgId = $result['id']; //fixed to get the array index
      $result = civicrm_api('OptionValue', 'create', array(
        'version' => 3,
        'option_group_id' => $opgId,
        'label' => 'Test option group',
        'value' => 'test option group',
        'filter' => '0',
        'weight' => '1',
        'is_optgroup' => '0',
        'is_reserved' => '0',
        'is_active' => '1'
      ));

      dprint_r($result);

      if ($result['is_error']) {
        CRM_Core_Session::setStatus(ts('Failed to create option xxx'));
      }
    }

    exit;

    $result = civicrm_api('OptionGroup', 'create', array(
      'version' => 3,
      'name' => 'resource_location',
      'title' => 'Resource Location',
      'is_reserved' => '1',
      'is_active' => '1'
    ));

    if ($result['is_error']) {
       CRM_Core_Session::setStatus(ts('Failed to create resource location'));
    }else{

    }

    $result = civicrm_api('OptionGroup', 'create', array(
      'version' => 3,
      'name' => 'size_unit',
      'title' => 'Size Unit',
      'is_reserved' => '1',
      'is_active' => '1'
    ));

    if ($result['is_error']) {
       CRM_Core_Session::setStatus(ts('Failed to create size unit'));
    }else{

    }

    $result = civicrm_api('OptionGroup', 'create', array(
      'version' => 3,
      'name' => 'resource_criteria',
      'title' => 'Resource criteria',
      'is_reserved' => '1',
      'is_active' => '1'
    ));

    if ($result['is_error']) {
       CRM_Core_Session::setStatus(ts('Failed to create resource criteria'));
    }else{

    }

    exit;


   
    //$this->executeSqlFile('sql/myinstall.sql');
  }

  /**
   * Example: Run an external SQL script when the module is uninstalled
   */
  public function uninstall() {
    
    $getResult = civicrm_api('OptionGroup', 'getsingle', array(
      'version' => 3,
      'name' => 'resource_type',
    ));
    
    if ($getResult['id']) {
      $delResult = civicrm_api('ReportTemplate', 'delete', array(
        'version' => 3,
        'id' => $getResult['id'],
      ));
    }
    
    if ($delResult['is_error']) {
      CRM_Core_Session::setStatus(ts('Failed to delete resource type'));
    }else{
      //TODO:: remove option value for resource type
    }

    $getResult = civicrm_api('OptionGroup', 'getsingle', array(
      'version' => 3,
      'name' => 'resource_location',
    ));
    
    if ($getResult['id']) {
      $delResult = civicrm_api('OptionGroup', 'delete', array(
        'version' => 3,
        'id' => $getResult['id'],
      ));
    }
    
    if ($delResult['is_error']) {
      CRM_Core_Session::setStatus(ts('Failed to resource location'));
    }else{
      //TODO:: remove option value for resource location
    }

    $getResult = civicrm_api('OptionGroup', 'getsingle', array(
      'version' => 3,
      'name' => 'size_=unit',
    ));
    
    if ($getResult['id']) {
      $delResult = civicrm_api('OptionGroup', 'delete', array(
        'version' => 3,
        'id' => $getResult['id'],
      ));
    }
    
    if ($delResult['is_error']) {
      CRM_Core_Session::setStatus(ts('Failed to size unit'));
    }else{
      //TODO :: remove custom field for size unit
    }
    
    $getResult = civicrm_api('OptionGroup', 'getsingle', array(
      'version' => 3,
      'name' => 'resource_criteria',
    ));
    
    if ($getResult['id']) {
      $delResult = civicrm_api('OptionGroup', 'delete', array(
        'version' => 3,
        'id' => $getResult['id'],
      ));
    }
    
    if ($delResult['is_error']) {
      CRM_Core_Session::setStatus(ts('Failed to resource criteria'));
    }else{
      //TODO :: remove resource criteria
    }
   //$this->executeSqlFile('sql/myuninstall.sql');
  }

  /**
   * Example: Run a simple query when a module is enabled
   *
  public function enable() {
    CRM_Core_DAO::executeQuery('UPDATE foo SET is_active = 1 WHERE bar = "whiz"');
  }

  /**
   * Example: Run a simple query when a module is disabled
   *
  public function disable() {
    CRM_Core_DAO::executeQuery('UPDATE foo SET is_active = 0 WHERE bar = "whiz"');
  }

  /**
   * Example: Run a couple simple queries
   *
   * @return TRUE on success
   * @throws Exception
   *
  public function upgrade_4200() {
    $this->ctx->log->info('Applying update 4200');
    CRM_Core_DAO::executeQuery('UPDATE foo SET bar = "whiz"');
    CRM_Core_DAO::executeQuery('DELETE FROM bang WHERE willy = wonka(2)');
    return TRUE;
  } // */


  /**
   * Example: Run an external SQL script
   *
   * @return TRUE on success
   * @throws Exception
  public function upgrade_4201() {
    $this->ctx->log->info('Applying update 4201');
    // this path is relative to the extension base dir
    $this->executeSqlFile('sql/upgrade_4201.sql');
    return TRUE;
  } // */


  /**
   * Example: Run a slow upgrade process by breaking it up into smaller chunk
   *
   * @return TRUE on success
   * @throws Exception
  public function upgrade_4202() {
    $this->ctx->log->info('Planning update 4202'); // PEAR Log interface

    $this->addTask(ts('Process first step'), 'processPart1', $arg1, $arg2);
    $this->addTask(ts('Process second step'), 'processPart2', $arg3, $arg4);
    $this->addTask(ts('Process second step'), 'processPart3', $arg5);
    return TRUE;
  }
  public function processPart1($arg1, $arg2) { sleep(10); return TRUE; }
  public function processPart2($arg3, $arg4) { sleep(10); return TRUE; }
  public function processPart3($arg5) { sleep(10); return TRUE; }
  // */


  /**
   * Example: Run an upgrade with a query that touches many (potentially
   * millions) of records by breaking it up into smaller chunks.
   *
   * @return TRUE on success
   * @throws Exception
  public function upgrade_4203() {
    $this->ctx->log->info('Planning update 4203'); // PEAR Log interface

    $minId = CRM_Core_DAO::singleValueQuery('SELECT coalesce(min(id),0) FROM civicrm_contribution');
    $maxId = CRM_Core_DAO::singleValueQuery('SELECT coalesce(max(id),0) FROM civicrm_contribution');
    for ($startId = $minId; $startId <= $maxId; $startId += self::BATCH_SIZE) {
      $endId = $startId + self::BATCH_SIZE - 1;
      $title = ts('Upgrade Batch (%1 => %2)', array(
        1 => $startId,
        2 => $endId,
      ));
      $sql = '
        UPDATE civicrm_contribution SET foobar = whiz(wonky()+wanker)
        WHERE id BETWEEN %1 and %2
      ';
      $params = array(
        1 => array($startId, 'Integer'),
        2 => array($endId, 'Integer'),
      );
      $this->addTask($title, 'executeSql', $sql, $params);
    }
    return TRUE;
  } // */

}