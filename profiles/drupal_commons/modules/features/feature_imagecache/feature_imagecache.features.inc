<?php

/**
 * Implementation of hook_imagecache_default_presets().
 */
function feature_imagecache_imagecache_default_presets() {
  $items = array(
    'activity_stream_photo' => array(
      'presetname' => 'activity_stream_photo',
      'actions' => array(
        '0' => array(
          'weight' => '0',
          'module' => 'imagecache',
          'action' => 'imagecache_scale_and_crop',
          'data' => array(
            'width' => '114',
            'height' => '75',
          ),
        ),
      ),
    ),
    'comment_image' => array(
      'presetname' => 'comment_image',
      'actions' => array(
        '0' => array(
          'weight' => '0',
          'module' => 'imagecache',
          'action' => 'imagecache_scale_and_crop',
          'data' => array(
            'width' => '100',
            'height' => '88',
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
            'width' => '800',
            'height' => '',
            'upscale' => 1,
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
    'events_overview_thumbnail' => array(
      'presetname' => 'events_overview_thumbnail',
      'actions' => array(
        '0' => array(
          'weight' => '0',
          'module' => 'imagecache',
          'action' => 'imagecache_scale_and_crop',
          'data' => array(
            'width' => '161',
            'height' => '144',
          ),
        ),
      ),
    ),
    'facebook_image_size' => array(
      'presetname' => 'facebook_image_size',
      'actions' => array(
        '0' => array(
          'weight' => '0',
          'module' => 'imagecache',
          'action' => 'imagecache_scale_and_crop',
          'data' => array(
            'width' => '50',
            'height' => '50',
          ),
        ),
      ),
    ),
    'homepage_carousel' => array(
      'presetname' => 'homepage_carousel',
      'actions' => array(
        '0' => array(
          'weight' => '0',
          'module' => 'imagecache',
          'action' => 'imagecache_scale_and_crop',
          'data' => array(
            'width' => '1280',
            'height' => '300',
          ),
        ),
      ),
    ),
    'profile_picture_big' => array(
      'presetname' => 'profile_picture_big',
      'actions' => array(
        '0' => array(
          'weight' => '0',
          'module' => 'imagecache',
          'action' => 'imagecache_scale_and_crop',
          'data' => array(
            'width' => '100',
            'height' => '100',
          ),
        ),
      ),
    ),
    'profile_picture_small' => array(
      'presetname' => 'profile_picture_small',
      'actions' => array(
        '0' => array(
          'weight' => '0',
          'module' => 'imagecache',
          'action' => 'imagecache_scale_and_crop',
          'data' => array(
            'width' => '30',
            'height' => '30',
          ),
        ),
      ),
    ),
    'user_picture_40x40' => array(
      'presetname' => 'user_picture_40x40',
      'actions' => array(
        '0' => array(
          'weight' => '0',
          'module' => 'imagecache',
          'action' => 'imagecache_scale_and_crop',
          'data' => array(
            'width' => '40',
            'height' => '40',
          ),
        ),
      ),
    ),
  );
  return $items;
}
