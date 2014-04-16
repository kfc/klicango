<?php
/*
 * @file
 * Administration form
 */
function klicango_pay_settings_form() {
  $form = array();
  // default values are for test account
  $form['klicango_pay_PBX_SITE'] = array(
    '#type' => 'textfield',
    '#title' => t('Site number, given by the bank'),
    '#default_value' => variable_get('klicango_pay_PBX_SITE', '1161854'),
    '#size' => 7,
    '#maxlength' => 7,
    '#required' => TRUE,
    '#element_validate' => array('klicango_pay_site_number_validate'),
  );

  $form['klicango_pay_PBX_RANG'] = array(
    '#type' => 'textfield',
    '#title' => t('Rank number, given by the bank'),
    '#default_value' => variable_get('klicango_pay_PBX_RANG', '01'),
    '#size' => 2,
    '#maxlength' => 2,
    '#required' => TRUE,
    '#element_validate' => array('klicango_pay_rank_number_validate'),
  );

  $form['klicango_pay_PBX_IDENTIFIANT'] = array(
    '#type' => 'textfield',
    '#title' => t('PAYBOX identifier, given by PAYBOX SERVICES when you subscribed'),
    '#default_value' => variable_get('klicango_pay_PBX_IDENTIFIANT', '225483021'),
    '#size' => 9,
    '#maxlength' => 9,
    '#required' => TRUE,
    '#element_validate' => array('klicango_pay_identifier_validate'),
  );

  $form['klicango_pay_PBX_HMAC_KEY'] = array(
    '#type' => 'textarea',
    '#title' => t('PAYBOX HMAC secret key'),
    '#default_value' => variable_get('klicango_pay_PBX_HMAC_KEY', ''),
    '#required' => TRUE,
  );

  $default_ip = "195.101.99.76\n194.2.122.158\n195.25.7.166";
  $form['klicango_pay_paybox_servers'] = array(
    '#type' => 'textarea',
    '#required' => TRUE,
    '#title' => t('Paybox IP addresses'),
    '#description' => t('Paybox payment servers IP addresses (one per line)'),
    '#default_value' => variable_get('klicango_pay_paybox_servers',$default_ip),
  );

  $form['klicango_pay_transactions_url'] = array(
    '#type' => 'textfield',
    '#title' => t('The URLs to start transactions with the standard Paybox System service'),
    '#default_value' => variable_get('klicango_pay_transactions_url', 'https://tpeweb.paybox.com/cgi/MYchoix_pagepaiement.cgi'),
    '#required' => TRUE,
  );

  $form['klicango_pay_effectue_message'] = array(
    '#type' => 'textarea',
    '#title' => t('Message when payment succeeded'),
    '#default_value' => variable_get('klicango_pay_effectue_message', t('Payment completed. Thank you.')),
    '#required' => TRUE,
  );

  $form['klicango_pay_refuse_message'] = array(
    '#type' => 'textarea',
    '#title' => t('Message when payment was refused'),
    '#default_value' => variable_get('klicango_pay_refuse_message', t('Payment refused. Sorry.')),
    '#required' => TRUE,
  );

  $form['klicango_pay_annule_message'] = array(
    '#type' => 'textarea',
    '#title' => t('Message when payment was cancelled'),
    '#default_value' => variable_get('klicango_pay_annule_message', t('Payment cancelled.')),
    '#required' => TRUE,
  );
  
  $form['klicango_pay_error_message'] = array(
    '#type' => 'textarea',
    '#title' => t('Message when user already bought max number of tickets or all tickets sold'),
    '#default_value' => variable_get('klicango_pay_error_message', t('You already bought max number of tickets or all tickets sold')),
    '#required' => TRUE,
  );

  return system_settings_form($form);
}

function klicango_pay_site_number_validate($element) {
      if (preg_match('/[0-9]{7}/', $element['#value'])) return;
      form_error($element, t('The site number must have 7 digits.'));
}

function klicango_pay_rank_number_validate($element) {
      if (preg_match('/[0-9]{2}/', $element['#value'])) return;
      form_error($element, t('The rank number must have 2 digits.'));
}

function klicango_pay_identifier_validate($element) {
    if (preg_match('/[0-9]{1,9}/', $element['#value'])) return;
    form_error($element, t('The identifier must have 1 to 9 digits.'));
}

function klicango_pay_test_settings(){
    $html = '';
    
    $key =  variable_get('klicango_pay_PBX_HMAC_KEY');
    $sit = variable_get('klicango_pay_PBX_SITE', '1161854');
    $rg = variable_get('klicango_pay_PBX_RANG', '01');
    $id =  variable_get('klicango_pay_PBX_IDENTIFIANT', '225483021');
    $url = variable_get('klicango_pay_transactions_url');

    //We get back the date in format ISO-8601
    $dateTime = date("c");

    //We create the string to be chopped without URLencodage
    $msg = "PBX_SITE=".$sit.
    "&PBX_RANG=".$rg.
    "&PBX_IDENTIFIANT=".$id.
    "&PBX_TOTAL=114".
    "&PBX_DEVISE=978".
    "&PBX_CMD=54".
    "&PBX_PORTEUR=e.transactions@ca-cp.fr".
    "&PBX_RETOUR=erreur:E".
    "&PBX_HASH=SHA512".
    "&PBX_TIME=".$dateTime;
    
    $hmac = klicango_pay_generate_hmac($key, $msg);
    
    $html = '<form method="POST" action="'.$url.'">
    <input type="hidden" name="PBX_SITE" value="'.$sit.'">
    <input type="hidden" name="PBX_RANG" value="'.$rg.'">
    <input type="hidden" name="PBX_IDENTIFIANT" value="'.$id.'">
    <input type="hidden" name="PBX_TOTAL" value="114">
    <input type="hidden" name="PBX_DEVISE" value="978">
    <input type="hidden" name="PBX_CMD" value="54">
    <input type="hidden" name="PBX_PORTEUR" value="e.transactions@ca-cp.fr">
    <input type="hidden" name="PBX_RETOUR" value="erreur:E">
    <input type="hidden" name="PBX_HASH" value="SHA512">
    <input type="hidden" name="PBX_TIME" value="'.$dateTime.'">
    <input type="hidden" name="PBX_HMAC" value="'.$hmac.'">
    <div class="submit">
    <input type="submit" value="Paid with E-Transactions" />
    <!-- 
    Do not put NAME in the input of type submit
    -->
    </div>
    </form>';
    
    return $html;    
}

function klicango_pay_send_request(){
 
    $key =  variable_get('klicango_pay_PBX_HMAC_KEY');
    $sit = variable_get('klicango_pay_PBX_SITE', '1161854');
    $rg = variable_get('klicango_pay_PBX_RANG', '01');
    $id =  variable_get('klicango_pay_PBX_IDENTIFIANT', '225483021');
    $url = variable_get('klicango_pay_transactions_url');

    //We get back the date in format ISO-8601
    $dateTime = date("c");

    //We create the string to be chopped without URLencodage
    $msg = "PBX_SITE=".$sit.
    "&PBX_RANG=".$rg.
    "&PBX_IDENTIFIANT=".$id.
    "&PBX_TOTAL=114".
    "&PBX_DEVISE=978".
    "&PBX_CMD=54".
    "&PBX_PORTEUR=e.transactions@ca-cp.fr".
    "&PBX_RETOUR=erreur:E".
    "&PBX_HASH=SHA512".
    "&PBX_TIME=".$dateTime;
    
    $hmac = klicango_pay_generate_hmac($key, $msg);
    
    $data = $msg.'&'.$hmac;
                 
    $query = array(
        'PBX_SITE'=>$sit,
        'PBX_RANG'=>$rg,
        'PBX_IDENTIFIANT'=>$id,
        'PBX_TOTAL'=>'114',
        'PBX_DEVISE'=>'978',
        'PBX_CMD'=>'54',
        'PBX_PORTEUR'=>'e.transactions@ca-cp.fr',
        'PBX_RETOUR'=>'erreur:E',
        'PBX_HASH'=>'SHA512',
        'PBX_TIME'=>$dateTime,
        'PBX_HMAC'=> $hmac,
    );
    
     drupal_goto($request_url, $query);  
    
}