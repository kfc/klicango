<?php

/**
 * Implementation of hook_strongarm().
 */
function commons_event_strongarm() {
  $export = array();

  $strongarm = new stdClass;
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'content_extra_weights_event';
  $strongarm->value = array(
    'title' => '-5',
    'body_field' => '-3',
    'revision_information' => '3',
    'author' => '7',
    'options' => '8',
    'comment_settings' => '5',
    'menu' => '4',
    'taxonomy' => '-1',
    'path' => '6',
    'flag' => '1',
    'og_nodeapi' => '2',
  );
  $export['content_extra_weights_event'] = $strongarm;

  $strongarm = new stdClass;
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'node_options_event';
  $strongarm->value = array(
    0 => 'status',
    1 => 'promote',
  );
  $export['node_options_event'] = $strongarm;

  $strongarm = new stdClass;
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'remove_markup_default_event';
  $strongarm->value = 1;
  $export['remove_markup_default_event'] = $strongarm;

  return $export;
}
