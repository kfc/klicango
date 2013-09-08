<?php

class views_content_cache_key_nodequeue extends views_content_cache_key {
  function options_form($value, &$handler) {
    // Get list of nodequeues
    $options = array();
    $subqueues = nodequeue_load_subqueues_by_queue(nodequeue_get_all_qids());
    foreach ($subqueues as $sqid => $subqueue) {
      $options[$sqid] = $subqueue->title;
    }
    natcasesort($options);

    return array(
      '#title' => t('Nodequeues'),
      '#description' => t('Checks for changes to nodequeues for the selected queues.'),
      '#type' => 'checkboxes',
      '#options' => $options,
      '#default_value' => $value,
      '#weight' => -10,
    );
  }

  function content_key($object, $object_type) {
    if ($object_type === 'nodequeue') {
      return $object->sqid;
    }
  }

  function clause_mode() {
    // We can't be combined with other cache segments:
    return 'OR';
  }
}