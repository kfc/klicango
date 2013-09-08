<?php
// $Id$

/**
* @file
* Administration page callbacks for the advanced_profile module
*/

/**
* Administration page callbacks for the advanced_profile module
*/
function advanced_profile_admin_settings() {
  $options = user_roles();
  
  //Unsetting anonymous user role
  unset($options[1]);
  
  $form['advanced_profile_roles'] = array(
    '#type' => 'checkboxes',
    '#title' => t('Select roles that would have advanced profiles'),
    '#options' => $options,
    '#default_value' => variable_get('advanced_profile_roles', array()),
    '#description' => 'Additional fields (description, image) will be available for users with selected roles.',
    '#weight' => -10,        
  );
  
  $form['advanced'] = array(
    '#type' => 'fieldset',
    '#title' => t('Advanced settings'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
    '#weight' => -5,    
  );
  
  $form['advanced']['advanced_profile_photo_path'] = array(
    '#type' => 'textfield',
    '#title' => t('Path to store user photo'),
    '#default_value' => variable_get('advanced_profile_photo_path', ''),
    '#description' => 'Set the path relative to site root (default: sites/all/files).',   
  );
  
  $form['advanced']['advanced_profile_posts_number'] = array(
    '#type' => 'textfield',
    '#title' => t('Number of user\'s latest posts to display'),
    '#default_value' => variable_get('advanced_profile_posts_number', '3'),
  );
  
  return system_settings_form($form);
}