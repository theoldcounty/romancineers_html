<?php
// $Id: stormteam.views.inc,v 1.1.2.2 2009/12/12 21:38:39 magnity Exp $

function stormteam_views_data() {
  $data['stormteam']['table']['group']  = 'Storm';
  $data['stormteam']['table']['join'] = array(
    'node' => array(
      'left_field' => 'vid',
      'field' => 'vid',
    ),
  );
  
  $data['stormteam']['members'] = array(
    'title' => t('Team Members'),
    'help' => 'Storm Team Members',
    'field' => array(
      'handler' => 'stormteam_handler_field_teammembers',
      'click sortable' => FALSE,
    ),
  );
  
  return $data;
}

function stormteam_views_handlers() {
  return array(
    'info' => array(
      'path' => drupal_get_path('module', 'stormteam'),
    ),
    'handlers' => array(
      'stormteam_handler_field_teammembers' => array(
        'parent' => 'views_handler_field_prerender_list',
      ),
    ),
  );
}
