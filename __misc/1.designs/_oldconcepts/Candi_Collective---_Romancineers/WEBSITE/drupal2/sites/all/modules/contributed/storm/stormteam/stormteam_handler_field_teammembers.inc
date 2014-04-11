<?php
// $Id: stormteam_handler_field_teammembers.inc,v 1.1.2.1 2009/10/03 17:03:35 magnity Exp $

/**
 * Separate team members into array.
 */
class stormteam_handler_field_teammembers extends views_handler_field_prerender_list {
  
  function render($values) {
    $field = $values->{$this->field_alias};
    $field = unserialize($field);
    
    if (!empty($field)) {
      // Turn member names into links to Storm person.
      if (is_array($field)) {
        $temp_field = array();
        foreach ($field as $field_nid => $field_title) {
          $temp_field[] = l($field_title, 'node/'. $field_nid);
        }
        $field = $temp_field;
      }
      
      if ($this->options['type'] == 'separator') {
        return implode(check_plain($this->options['separator']), $field);
      }
      else {
        return theme('item_list', $field, NULL, $this->options['type']);
      }
    }
    else if (!empty($this->options['empty'])) {
      return $this->options['empty'];
    }
  }
}
