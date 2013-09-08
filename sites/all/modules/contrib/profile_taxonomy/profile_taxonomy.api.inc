<?php
// $Id$

/**
 * @file profile_taxonomy.api.inc
 * The developer's API for this module layers the access and the handling of database transactions.
 */

/**
 * Get information about an user profile field vocabulary relation.
 * @param $fid
 *   field id
 * @return
 *   integer of vocabulary id
 */
function profile_taxonomy_get_reference($fid) {
  if (!$fid && !intval($fid)) {
    return;
  }
    
  $sql = "SELECT * FROM {profile_taxonomy} WHERE fid = %d";
  $reference = db_fetch_object(db_query($sql, intval($fid)));
  if ($reference) { //only unserialize existing db row
    $reference->terms = unserialize($reference->terms);
    $reference->settings = unserialize($reference->settings);
  }
  return $reference;
}

/**
 * Get all profile fields which use a certain vocabulary.
 * @param $vid
 *   vocabulary id
 * @return
 *   array of profile field objects (db table profile_fields)
 */
function profile_taxonomy_get_references_by_vid($vid) {
  if (!$vid && !intval($vid)) {
    return;  
  }
 
  $sql = "SELECT * FROM {profile_taxonomy} WHERE vid = %d";
  $result = db_query($sql, intval($vid));
  $references = array();
  while (($reference = db_fetch_object($result)) != NULL) {
  	$reference->terms = unserialize($reference->terms);
    $reference->settings = unserialize($reference->settings);
  	$references[] = $reference;
  }
  return $references;
}

/**
 * Get all field vocabulary assignements.
 * @return
 *   profile taxonomy assignements
 */
function profile_taxonomy_get_all_references() {
  static $references = array();
  if (empty($references)) {
    $result = db_query('SELECT * FROM {profile_taxonomy}');
    while (($reference = db_fetch_object($result)) != NULL) {
      $reference->terms = unserialize($reference->terms);
  	  $reference->settings = unserialize($reference->settings);
      $references[] = $reference;
    }
  }
  return $references;
}

/**
 * Create or update a field vocabulary reference.
 * @param $reference
 *   object to be saved
 * @return
 *   status of db operation
 */
function profile_taxonomy_save_reference($reference) {
  // check if field reference already exists
  if (!profile_taxonomy_get_reference($reference->fid)) { // create a new instance
   $success = db_query("INSERT INTO {profile_taxonomy} VALUES (%d, %d, '%s', '%s')", 
   		intval($reference->fid), 
   		intval($reference->vid), 
   		serialize($reference->terms), 
   		serialize($reference->settings)
   );
 }
 else { // update existing instance
   $success = db_query("UPDATE {profile_taxonomy} SET vid = %d, terms = '%s', settings = '%s' WHERE fid = %d", 
   		intval($reference->vid), 
   		serialize($reference->terms), 
   		serialize($reference->settings),
   		intval($reference->fid)
   );
 }
 if ($success) {
   profile_taxonomy_save_selection_options($reference->fid, $reference->terms['values']); //save field options
   drupal_set_message('Profile Taxonomy term references have been successfully saved.');
 }
 else {
   drupal_set_message('Profile Taxonomy term references could not be saved.', 'error');
 }
 return $success;
}


/**
 * Delete a specific field vocabulary association
 * @param $field
 *   name of the profile field
 * @return
 *   status of db operation
 */
function profile_taxonomy_delete_reference($fid) {
  if (!$fid) {
    return;
  }
  return db_query("DELETE FROM {profile_taxonomy} WHERE fid = %d", $fid);
}

/**
 * Delete all profile fields association of a vocabulary.
 * @param $vid
 *   vocabulary id
 * @return
 *   status of db operation
 */
function profile_taxonomy_delete_references_by_vid($vid) {
  if (!$vid) {
    return;
  }
  return db_query("DELETE FROM {profile_taxonomy} WHERE vid = %d", $vid);
}



/**
 * Check if the a user has a certain term assigned. The search can be optionally narrowed
 * to a specific profile field (see $fid parameter).
 * @param $uid
 *   integer user id
 * @param $tid
 *   integer term id
 * @param $fid
 *   integer profile field id (optional)
 * @return
 *   boolean indicating whether a term is assigned to that user
 */
function profile_taxonomy_has_user_term($uid, $tid, $fid = 0) {
  // function parameters must be integer numbers
  if (!($uid = intval($uid)) || !($tid = intval($tid))) {
    return FALSE;
  }
  // load an user object with taxonony information
  $user = _profile_taxonomy_load_user($uid); 
  
  if (!empty($user->taxonomy)) {
    // iterate over all taxonomy terms
    foreach ($user->taxonomy as $field) {
  	  if ($fid && $fid != $field->fid) { // only search for term in a specific field
  	    continue;
  	  }
      if (array_key_exists($tid, $field->terms)) { // search for matches
        return TRUE;
      }
    }
  }
  return FALSE;
}

/**
 * Get term(s) from a user field.
 * @param $uid
 *   integer user id
 * @param $fid
 *   integer profile field id (optional)
 * @return
 *   associative array of term object keyed by term id
 */
function profile_taxonomy_get_user_terms($uid, $fid) {
  // function parameters must be integer numbers
  if (!($uid = intval($uid)) || !($fid = intval($fid))) {
    return NULL;
  }
   // load an user object with taxonony information
  $user = _profile_taxonomy_load_user($uid); 
  
  if (!empty($user->taxonomy[$fid]->terms)) {
    return $user->taxonomy[$fid]->terms;
  }
  else { // return empty array
     return array();
  }
}

/**
 * Assign terms to a user. Existing values will be overwritten and can be retrieved by 
 * invoking profile_taxonomy_get_user_terms($uid, $fid).
 * 
 * If the field doesn't support multiple values only the first term id will be saved.
 * 
 * NOTE: The executing user must have write permissions for this field. Otherwise
 * there won't be any effect. If you are in doubt, switch to the admin user (uid 1) by 
 * setting/overwriting the global variable $user.
 * 
 * @param $uid
 *   integer user id
 * @param $tid
 *   integer term id or array of term ids
 * @param $fid
 *   integer profile field id
 * @return
 *  A fully-loaded $user object upon successful save or FALSE if the save failed.
 */
function profile_taxonomy_save_user_term($uid, $tid, $fid) {
  // function parameters must be integer numbers, except term ids
  if (!($uid = intval($uid)) || !(is_array($tid) || is_numeric($tid)) || !($fid = intval($fid))) {
    return NULL;
  }
  // check if field support multiple values
  if (is_array($tid) && profile_taxonomy_field_supports_multiple_values($uid, $fid)) {
    $tids = $tid;
  }
  else { // if not only save first term id
    $tids = !is_array($tid) ? array(intval($tid)) : $tid[0];
  }
 
  // do a full load here, object will be saved later
  $account = user_load($uid);
  // try to get profile field cheaply from assigned user properties
  if ($account->taxonomy[$fid]) {
    $field = $account->taxonomy[$fid]; // get field object
  }
  else { // load profile field from database
    $field = profile_taxonomy_get_profile_field_by_id($fid);
  }
  $reference = profile_taxonomy_get_reference($fid);
  
  $edit = array();
  if (!empty($tids)) {
    // aggregate terms avoiding duplicates
    $term_names = array();
    foreach ($tids as $tid) {
      if (($index = array_search($tid, $reference->terms['keys'])) !== FALSE && !$term_names[$tid]) {
        $term_names[$tid] = $reference->terms['values'][$index];
      }
    }
    ksort($term_names); // sort by key (term id) from low to high
  	
    $edit[$field->name] = array_values($term_names); // assign value to field
    // call user validation hook manually, so that other modules may alter the value,
    // e. g. profile_checkboxes_user('validate', $edit, $user) serializes/implodes it.
    user_module_invoke('validate', $edit, $account, $field->category);
  }
  else {
    unset($account->{$field->name});
  }
  // With a category provided the function profile_save_profile($edit, $account, $field->category);
  // is invoked in scope of user_save().
  $account =  user_save($account, $edit, $field->category);
  
  return $account;
}

/**
 * Append terms to an user without overwriting existing assignments. Apparently it only works
 * when the field supports multiple values.
 * 
 * NOTE: The executing user must have write permissions for this field. Otherwise
 * there won't be any effect. If you are in doubt, switch to the admin user (uid 1) by 
 * setting/overwriting the global variable $user.
 * 
 * @param $uid
 *   integer user id
 * @param $tid
 *   integer term id or array of term ids
 * @param $fid
 *   integer profile field id
 * @return
 *  A fully-loaded $user object upon successful save or FALSE if the save failed or not supported.
 */
function profile_taxonomy_add_user_term($uid, $tid, $fid) {
  // function parameters must be integer numbers, except term ids
  if (!($uid = intval($uid)) || !(!is_array($tid) || intval($tid)) || !($fid = intval($fid))) {
    return NULL;
  }
  
  if (profile_taxonomy_field_supports_multiple_values($uid, $fid)) {
    $tids = array_keys(profile_taxonomy_get_user_terms($uid, $fid));  // get all existing assignments
    $new_tids = !is_array($tid) ?  array(intval($tid)) : $tid;
     // append if not already assigned.
    $tids = array_unique(array_merge($tids, $new_tids));
    return profile_taxonomy_save_user_term($uid, $tids, $fid);
  }
  return FALSE;
}

/**
 * Remove terms from an user object. Multiple terms can be removed.
 * 
 * NOTE: The executing user must have write permissions for this field. Otherwise
 * there won't be any effect. If you are in doubt, switch to the admin user (uid 1) by 
 * setting/overwriting the global variable $user.
 * 
 * @param $uid
 *   integer user id
 * @param $tid
 *   integer term id or array of term ids
 * @param $fid
 *   integer profile field id
 * @return
 *  A fully-loaded $user object upon successful save or FALSE if the save failed or not supported.
 */
function profile_taxonomy_remove_user_term($uid, $tid, $fid) {
  // function parameters must be integer numbers, except term ids
  if (!($uid = intval($uid)) || !(!is_array($tid) || intval($tid)) || !($fid = intval($fid))) {
    return NULL;
  }  
  // remove if existing
  $tids = array_keys(profile_taxonomy_get_user_terms($uid, $fid));  // get all existing assignments
  $new_tids = !is_array($tid) ?  array(intval($tid)) : $tid;
  $tids = array_diff($tids, $new_tids);  // return difference between arrays
  return profile_taxonomy_save_user_term($uid, $tids, $fid);
}

/**
 * Check if field suport multiple values.
 * @param $uid
 *   integer user id
 * @param $fid
 *   integer profile field id
 */
function profile_taxonomy_field_supports_multiple_values($uid, $fid) {
  if (module_exists('profile_checkboxes')) {
    $result = profile_checkboxes_selection_fields($uid);
    while ($field = db_fetch_object($result)) {
      if ($field->fid == $fid) {
        return TRUE;
      }
    }
  }
  return FALSE;
}

/**
 * Load an user object with taxonomy information.
 * @param $uid
 *   integer user id
 *   integer user id
 * @return
 *   partial user object
 */
function _profile_taxonomy_load_user($uid) {
  // Instead of invoking the heavy user load function <code>$user = user_load($uid)</code>
  // we call directly the profile module's hook implementation - gaining performance
  $account = new stdClass(); // create fake user object
  $account->uid = $uid;
  profile_load_profile($account);
  profile_taxonomy_user_load($account); // load user's taxonomy info array
  return $account;
}