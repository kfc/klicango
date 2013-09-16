<?php

/**
 * Implementation of hook_imagecache_default_presets().
 */
function feature_imagecache_imagecache_default_presets() {
  $items = array(
    'homepage_carousel' => array(
      'presetname' => 'homepage_carousel',
      'actions' => array(
        '0' => array(
          'weight' => '0',
          'module' => 'imagecache',
          'action' => 'imagecache_scale_and_crop',
          'data' => array(
            'width' => '1280',
            'height' => '417',
          ),
        ),
      ),
    ),
  );
  return $items;
}
