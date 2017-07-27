<?php

require_once 'contributionstatus.civix.php';

function contributionstatus_civicrm_buildForm($formName, &$form) {
  if ($form instanceof CRM_Contribute_Form_Contribution && $form->getVar('_id')) {
    $status = CRM_Contribute_PseudoConstant::contributionStatus();
    $statusName = CRM_Contribute_PseudoConstant::contributionStatus(NULL, 'name');

    $contributionStatus = CRM_Core_DAO::getFieldValue('CRM_Contribute_DAO_Contribution', $form->getVar('_id'), 'contribution_status_id');

    $name = CRM_Utils_Array::value($contributionStatus, $statusName);
    switch ($name) {
      case 'Failed':
        $contributionStatusStatusIdField = $form->getElement('contribution_status_id');
        $contributionStatusStatusIdField->addOption($status[CRM_Utils_Array::key('Cancelled', $statusName)], CRM_Utils_Array::key('Cancelled', $statusName));
        break;
    }
  }
}

/**
 * Implements hook_civicrm_validateForm().
 *
 * @param string $formName
 * @param array $fields
 * @param array $files
 * @param CRM_Core_Form $form
 * @param array $errors
 */
function contributionstatus_civicrm_validateForm($formName, &$fields, &$files, &$form, &$errors) {
  if ($form instanceof CRM_Contribute_Form_Contribution && $form->getVar('_id')) {
    $formValues = $form->getVar('_values');
    $statusName = CRM_Contribute_PseudoConstant::contributionStatus(NULL, 'name');
    if (($form->getVar('_action') & CRM_Core_Action::UPDATE) && $formValues['contribution_status_id'] != $fields['contribution_status_id']) {
      $cancelledStatusId = CRM_Utils_Array::key('Cancelled', $statusName);
      $failedStatusId = CRM_Utils_Array::key('Failed', $statusName);
      if ($formValues['contribution_status_id'] == $failedStatusId && $fields['contribution_status_id'] == $cancelledStatusId) {
        $form->setElementError('contribution_status_id'); // reset the validation error as we might continue with processing.
      }
    }
  }
}

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function contributionstatus_civicrm_config(&$config) {
  _contributionstatus_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function contributionstatus_civicrm_xmlMenu(&$files) {
  _contributionstatus_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function contributionstatus_civicrm_install() {
  _contributionstatus_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function contributionstatus_civicrm_postInstall() {
  _contributionstatus_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function contributionstatus_civicrm_uninstall() {
  _contributionstatus_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function contributionstatus_civicrm_enable() {
  _contributionstatus_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function contributionstatus_civicrm_disable() {
  _contributionstatus_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function contributionstatus_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _contributionstatus_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function contributionstatus_civicrm_managed(&$entities) {
  _contributionstatus_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function contributionstatus_civicrm_caseTypes(&$caseTypes) {
  _contributionstatus_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_angularModules
 */
function contributionstatus_civicrm_angularModules(&$angularModules) {
  _contributionstatus_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function contributionstatus_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _contributionstatus_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function contributionstatus_civicrm_preProcess($formName, &$form) {

} // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
function contributionstatus_civicrm_navigationMenu(&$menu) {
  _contributionstatus_civix_insert_navigation_menu($menu, NULL, array(
    'label' => ts('The Page', array('domain' => 'nl.sp.contributionstatus')),
    'name' => 'the_page',
    'url' => 'civicrm/the-page',
    'permission' => 'access CiviReport,access CiviContribute',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _contributionstatus_civix_navigationMenu($menu);
} // */
