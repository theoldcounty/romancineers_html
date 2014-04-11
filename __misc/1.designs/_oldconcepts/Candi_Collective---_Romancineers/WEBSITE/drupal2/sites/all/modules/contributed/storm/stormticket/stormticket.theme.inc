<?php
// $Id: stormticket.theme.inc,v 1.5.4.16 2009/12/19 00:02:18 magnity Exp $

/**
 * @file
 */

function theme_stormticket_list($header, $tickets) {

  $rows = array();
  foreach ($tickets as $ticket) {
    $n = new stdClass();
    $n->nid = $ticket->nid;
    $n->uid = $ticket->uid;
    $n->organization_nid = $ticket->organization_nid;
    $n->type = 'stormticket';

    $rows[] = array(
      storm_icon('category_'. $ticket->ticketcategory, $ticket->ticketcategory),
      l($ticket->organization_title, 'node/'. $ticket->organization_nid),
      l($ticket->project_title, 'node/'. $ticket->project_nid),
      l($ticket->title, 'node/'. $ticket->nid) . theme('mark', node_mark($ticket->nid, $ticket->changed)),
      format_date($ticket->created, 'small'),
      storm_icon('status_'. $ticket->ticketstatus, $ticket->ticketstatus),
      storm_icon('priority_'. $ticket->ticketpriority, $ticket->ticketpriority),
      array(
        'data' => storm_icon_edit_node($n, $_GET) .'&nbsp;'. storm_icon_delete_node($n, $_GET),
        'class' => 'storm_list_operations',
      ),
    );
  }
  $o = theme('table', $header, $rows);
  return $o;
}

function theme_stormticket_view($node, $teaser = FALSE, $page = FALSE) {
  drupal_add_css(drupal_get_path('module', 'storm') . '/storm-node.css', 'module');
  
  $node = node_prepare($node, $teaser);
  
  $node->content['links'] = array(
    '#prefix' => '<div class="stormlinks"><dl>',
    '#suffix' => '</dl></div>',
    '#weight' => -25,
  );

  $node->content['links']['expenses'] = theme('storm_link', 'stormticket', 'stormexpense', $node->nid, 1);
  $node->content['links']['timetrackings'] = theme('storm_link', 'stormticket', 'stormtimetracking', $node->nid, 5);

  $node->content['group1'] = array(
    '#prefix' => '<div class="stormfields">',
    '#suffix' => '</div>',
    '#weight' => module_exists('content') ? content_extra_field_weight($node->type, 'group1') : -20,
  );

  $node->content['group1']['organization'] = array(
    '#prefix' => '<div class="organization">',
    '#suffix' => '</div>',
    '#value' => theme('storm_view_item', t('Organization'), l($node->organization_title, 'node/'. $node->organization_nid)),
    '#weight' => $w++,
  );

  $node->content['group1']['project_nid'] = array(
    '#prefix' => '<div class="project">',
    '#suffix' => '</div>',
    '#value' => theme('storm_view_item', t('Project'), l($node->project_title, 'node/'. $node->project_nid)),
    '#weight' => $w++,
  );

  $node->content['group1']['task_nid'] = array(
    '#prefix' => '<div class="task">',
    '#suffix' => '</div>',
    '#value' => theme('storm_view_item', t('Task'), l($node->task_title, 'node/'. $node->task_nid)),
    '#weight' => $w++,
  );

  $node->content['group2'] = array(
    '#prefix' => '<div class="stormfields">',
    '#suffix' => '</div>',
    '#weight' => module_exists('content') ? content_extra_field_weight($node->type, 'group2') : -19,
  );

  $node->content['group2']['category'] = array(
    '#prefix' => '<div class="category">',
    '#suffix' => '</div>',
    '#value' => theme('storm_view_item', t('Category'), stormattribute_value('Ticket category', $node->ticketcategory)),
    '#weight' => 1,
  );
  
  $node->content['group2']['status'] = array(
    '#prefix' => '<div class="storm_status">',
    '#suffix' => '</div>',
    '#value' => theme('storm_view_item', t('Status'), stormattribute_value('Ticket status', $node->ticketstatus)),
    '#weight' => 2,
  );

  $node->content['group2']['priority'] = array(
    '#prefix' => '<div class="priority">',
    '#suffix' => '</div>',
    '#value' => theme('storm_view_item', t('Priority'), stormattribute_value('Ticket priority', $node->ticketpriority)),
    '#weight' => 3,
  );
  
  $node->content['group5'] = array(
    '#prefix' => '<div class="stormfields">',
    '#suffix' => '</div>',
    '#weight' => module_exists('content') ? content_extra_field_weight($node->type, 'group2') : -16,
  );
  
  $node->content['group5']['assigned'] = array(
    '#prefix' => '<div class="assigned">',
    '#suffix' => '</div>',
    '#value' => theme('storm_view_item', t('Assigned to'), l($node->assigned_title, 'node/'. $node->assigned_nid)),
    '#weight' => 4,
  );
  
  $node->content['body_field'] = array(
    '#prefix' => '<div class="stormbody">',
    '#suffix' => '</div>',
    '#value' => theme('storm_view_item', t('Description'), $node->content['body']['#value']),
    '#weight' => module_exists('content') ? content_extra_field_weight($node->type, 'body_field') : -15,
  );
  unset($node->content['body']);

  return $node;
}