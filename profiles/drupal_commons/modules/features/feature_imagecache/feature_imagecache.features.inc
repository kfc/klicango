<?php

/**
 * Implementation of hook_imagecache_default_presets().
 */
function feature_imagecache_imagecache_default_presets() {
  $items = array(
    'comment_image' => array(
      'presetname' => 'comment_image',
      'actions' => array(
        '0' => array(
          'weight' => '0',
          'module' => 'imagecache',
          'action' => 'imagecache_scale',
          'data' => array(
            'width' => '100',
            'height' => '',
            'upscale' => 0,
          ),
        ),
      ),
    ),
    'comment_image_big' => array(
      'presetname' => 'comment_image_big',
      'actions' => array(
        '0' => array(
          'weight' => '0',
          'module' => 'imagecache',
          'action' => 'imagecache_scale',
          'data' => array(
            'width' => '100%',
            'height' => '',
            'upscale' => 0,
          ),
        ),
      ),
    ),
    'comment_image_right_thumbnail' => array(
      'presetname' => 'comment_image_right_thumbnail',
      'actions' => array(
        '0' => array(
          'weight' => '0',
          'module' => 'imagecache',
          'action' => 'imagecache_scale',
          'data' => array(
            'width' => '193',
            'height' => '',
            'upscale' => 0,
          ),
        ),
      ),
    ),
  );
  return $items;
}
