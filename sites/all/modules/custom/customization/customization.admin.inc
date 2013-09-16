<?php
// $Id$

/**
* @file
* Administration page callbacks for the advanced_profile module
*/

/**
* Administration page callbacks for the advanced_profile module
*/
function customization_carousel_settings() {
$form['homepage'] = array(
    '#type' => 'fieldset',
    '#title' => t('Homepage carousel'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#weight' => -5,    
  );
  
  $form['homepage']['carousel_main_message'] = array(
    '#type' => 'text',
    '#title' => t('Main message'),
    '#default_value' => variable_get('carousel_main_message', ''),
    '#description' => 'Main message displayed over the carousel images.',   
  );
  
  $form['homepage']['carousel_duration'] = array(
    '#type' => 'textfield',
    '#title' => t('Duration'),
    '#default_value' => variable_get('carousel_duration', '1000'),
    '#description' => 'Time in ms during which carousel slide would be displayed.',
  );
  
  $form['homepage']['carousel_speed'] = array(
    '#type' => 'textfield',
    '#title' => t('Speed'),
    '#default_value' => variable_get('carousel_duration', '1250'),
    '#description' => 'Speed of slides during changing.',
  );
  
  return system_settings_form($form);
}