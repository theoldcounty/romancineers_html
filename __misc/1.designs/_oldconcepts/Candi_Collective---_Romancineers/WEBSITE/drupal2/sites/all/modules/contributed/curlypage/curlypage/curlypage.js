// $Id: curlypage.js,v 1.1.4.1 2010/01/05 23:36:17 manfer Exp $
/********************************************************************************************
* Curlypage javascript configuration file
*
* @author    Fernando San Julián
*********************************************************************************************/

/********************************************************************************************
* Curlypage parameters. This shows its acceptable values.
*
*
* swf files
*   flag_swf = 'flag.swf';
*   peel_swf = 'turn.swf';
* wait icon parameters
*   wait_enabled = 'true';
*   wait_url = 'wait.gif';
*   wait_width = '42';
*   wait_height = '42';
*
* flag style. Values: 'style1', 'style2'.
*   flag_style = 'style1';
* peel style. Values: 'style1', 'style2'.
*   peel_style = 'style1';
*
* flag and peel sizes
*   flag_width = 100;
*   flag_height = 100;
*   peel_width = 500;
*   peel_height = 500;
*
* Position of ear. Values: 'topleft', 'topright', 'bottomleft' or 'bottomright'.
*   peel_position = 'topright';
* Position model. Values: 'absolute' or 'fixed'.
*   peel_position_model = 'absolute';
*
* URL of small image.
*   small_url = 'small.jpg';
* URL of big image.
*   big_url = 'big.jpg';
* The image is mirrored on peel. Values: 0 (false) or 1 (true).
*   mirror = 0;
* Start transition. Values: 'none', 'Blinds', 'Fade', 'Fly', 'Iris', 'Photo', 'Rotate', 'Squeeze', 'Wipe', 'PixelDissolve', 'Zoom'.
*   in_transition = 'Photo';
* Transition duration. Values: 1-9
*   transition_duration = 4;
*
* Color of Peel. Values: 'golden', 'silver', 'custom'
*   peel_color = 'golden';
* Color of Peel Style. Values: 'flat', 'gradient'
*   peel_color_style = 'gradient';
* RGB values for a Custom Peel Color. Values: 0-255.
*   red_value = 0;
*   green_value = 0;
*   blue_value = 0;
*
* enable or disable link. Values: 0 (disabled) or 1 (enabled).
*   link_enabled = 0;
* Where to open the link. Same or New Window (tab). Values: '_self' or '_blank'.
*   link_target = '_blank';
* URL of link.
*   link = 'http://www.manfer.co.cc';
*
* URL of sound on load Peel Ad.
*   load_sound_url = '';
* URL of sound when peel is opened.
*   open_sound_url = '';
* URL of sound when peel is closed.
*   close_sound_url = '';
*
* Speed of flag movement. Values: 1-9
*   flag_speed = 4;
* Speed of peel. Values: 1-9
*   peel_speed = 4;
* Milliseconds till an automatic open of peel. Values: 0 (no automatic open) >0 (milliseconds configured).
*   automatic_open = 0;
* Milliseconds till an automatic close of peel. Values: 0 (no automatic close) >0 (milliseconds configured).
*   automatic_close = 0;
*
* Close button on open Peel. Values: 0 (disabled) or 1 (enabled).
*   close_button_enable = 0;
* Text on close button.
*   text_on_close_button = 'close';
* RGB values of close button. Values: 0-255.
*   close_red_value = 0;
*   close_green_value = 0;
*   close_blue_value = 0;
*
*********************************************************************************************/

// Help functions to control curlypage flash versions
// to be sure the correct versions are retrieved from
// server and not old ones from browser cache are used.
function get_curlypage_flag_version(){
  return 'flag110';
}

function get_curlypage_peel_version(){
  return 'turn120';
}

function doPeel(position){
  if (position == 'topleft' || position =='topright') {
    document.getElementById('peelDiv_' + position).style.top = '0px';
    document.getElementById('flagDiv_' + position).style.top = '-1000px';
  } else {
    document.getElementById('peelDiv_' + position).style.bottom = '0px';
    document.getElementById('flagDiv_' + position).style.bottom = '-1000px';
  }
  document.getElementById('peel' + position).doPeel();
}

function doFlag(position){
  if (position == 'topleft' || position =='topright') {
    document.getElementById("flagDiv_" + position).style.top = "0px";
    document.getElementById("peelDiv_" + position).style.top = "-1000px";
  } else {
    document.getElementById("flagDiv_" + position).style.bottom = "0px";
    document.getElementById("peelDiv_" + position).style.bottom = "-1000px";
  }
}

function showFlag(position, flagWidth, flagHeight, peelWidth, peelHeight){
  if (document.getElementById("waitDiv_" + position)) {
    document.getElementById("waitDiv_" + position).style.display = "none";
  }

  document.getElementById("flagDiv_" + position).style.width = flagWidth + "px";
  document.getElementById("flagDiv_" + position).style.height = flagHeight + "px";
  document.getElementById("peelDiv_" + position).style.width = peelWidth + "px";
  document.getElementById("peelDiv_" + position).style.height = peelHeight + "px";

  if (position == 'topleft' || position =='topright') {
    document.getElementById("peelDiv_" + position).style.top = "-1000px";
  } else {
    document.getElementById("peelDiv_" + position).style.bottom = "-1000px";
  }
  document.getElementById("flagDiv_" + position).style.display = "block";
}

function hide_peel_flag(position){
  document.getElementById("flagDiv_" + position).style.width = "1px";
  document.getElementById("flagDiv_" + position).style.height = "1px";
  document.getElementById("peelDiv_" + position).style.width = "1px";
  document.getElementById("peelDiv_" + position).style.height = "1px";
}


function curlypage(curlypage_vars) {

  this.curlypage_vars = curlypage_vars;

  this.flag_params = {
    play: "true",
    loop: "true",
    menu: "false",
    quality: "autohigh",
    scale: "noscale",
    wmode: "transparent",
    bgcolor: "#ffffff",
    allowScriptAccess: "sameDomain",
    allowFullScreen: "false"
  };

  this.flag_attributes = {
    id: "flag" + this.curlypage_vars.peel_position,
    name: "flag" + this.curlypage_vars.peel_position,
    styleclass: "curlypage"
  };

  this.peel_params = {
    play: "true",
    loop: "true",
    menu: "false",
    quality: "autohigh",
    scale: "noscale",
    wmode: "transparent",
    bgcolor: "#ffffff",
    allowScriptAccess: "sameDomain",
    allowFullScreen: "false"
  };

  this.peel_attributes = {
    id: "peel" + this.curlypage_vars.peel_position,
    name: "peel" + this.curlypage_vars.peel_position,
    styleclass: "curlypage"
  };

  this.write = write_curlypage_objects;
  this.flag_vars = get_flag_vars;
  this.peel_vars = get_peel_vars;
  this.flag_version = get_curlypage_flag_version;
  this.peel_version = get_curlypage_peel_version;

}

function get_flag_vars () {
  var flag_vars = {};
  flag_vars.flagStyle = this.curlypage_vars.flag_style;
  flag_vars.flagWidth = this.curlypage_vars.flag_width;
  flag_vars.flagHeight = this.curlypage_vars.flag_height;
  flag_vars.peelPosition = this.curlypage_vars.peel_position;
  flag_vars.smallURL = this.curlypage_vars.small_url;
  flag_vars.mirror = this.curlypage_vars.mirror;
  flag_vars.inTransition = this.curlypage_vars.in_transition;
  flag_vars.transitionDuration = this.curlypage_vars.transition_duration;
  flag_vars.peelColor = this.curlypage_vars.peel_color;
  flag_vars.peelColorStyle = this.curlypage_vars.peel_color_style;
  flag_vars.redValue = this.curlypage_vars.red_value;
  flag_vars.greenValue = this.curlypage_vars.green_value;
  flag_vars.blueValue = this.curlypage_vars.blue_value;
  flag_vars.loadSoundURL = this.curlypage_vars.load_sound_url;
  flag_vars.flagSpeed = this.curlypage_vars.flag_speed;
  return flag_vars;
}

function get_peel_vars() {
  var peel_vars = {};
  peel_vars.peelStyle = this.curlypage_vars.peel_style;
  peel_vars.flagWidth = this.curlypage_vars.flag_width;
  peel_vars.flagHeight = this.curlypage_vars.flag_height;
  peel_vars.peelWidth = this.curlypage_vars.peel_width;
  peel_vars.peelHeight = this.curlypage_vars.peel_height;
  peel_vars.peelPosition = this.curlypage_vars.peel_position;
  peel_vars.bigURL = this.curlypage_vars.big_url;
  peel_vars.mirror = this.curlypage_vars.mirror;
  peel_vars.peelColor = this.curlypage_vars.peel_color;
  peel_vars.peelColorStyle = this.curlypage_vars.peel_color_style;
  peel_vars.redValue = this.curlypage_vars.red_value;
  peel_vars.greenValue = this.curlypage_vars.green_value;
  peel_vars.blueValue = this.curlypage_vars.blue_value;
  peel_vars.linkEnabled = this.curlypage_vars.link_enabled;
  peel_vars.linkTarget = this.curlypage_vars.link_target;
  peel_vars.link = this.curlypage_vars.link;
  peel_vars.openSoundURL = this.curlypage_vars.open_sound_url;
  peel_vars.closeSoundURL = this.curlypage_vars.close_sound_url;
  peel_vars.peelSpeed = this.curlypage_vars.peel_speed;
  peel_vars.automaticOpen = this.curlypage_vars.automatic_open;
  peel_vars.automaticClose = this.curlypage_vars.automatic_close;
  peel_vars.close_button_enable = this.curlypage_vars.close_button_enable;
  peel_vars.text_on_close_button = this.curlypage_vars.text_on_close_button.toLowerCase();
  peel_vars.close_redValue = this.curlypage_vars.close_red_value;
  peel_vars.close_greenValue = this.curlypage_vars.close_green_value;
  peel_vars.close_blueValue = this.curlypage_vars.close_blue_value;
  return peel_vars;
}


function write_curlypage_objects () {
<!--

  // Absolute not available for bottom curlypages.
  // Set it always to fixed to prevent a wrong configuration with absolute.
  if (this.curlypage_vars.peel_position == 'bottomleft' || this.curlypage_vars.peel_position == 'bottomright') {
    this.curlypage_vars.peel_position_model = 'fixed';
  }

  // Check position of curlypage. 
  if(this.curlypage_vars.peel_position == 'topleft' || this.curlypage_vars.peel_position == 'bottomleft') {
    xPos = 'left';
  } else {
    xPos = 'right';
  }

  if(this.curlypage_vars.peel_position == 'topleft' || this.curlypage_vars.peel_position == 'topright') {
    yPos = 'top';
  } else {
    yPos = 'bottom';
  }

  if (this.curlypage_vars.wait_enable == "1") {
    //Write wait div layer
    document.write('<div id="waitDiv_' + this.curlypage_vars.peel_position + '" style="position:' + this.curlypage_vars.peel_position_model + '; width:' + this.curlypage_vars.wait_width +'px; height:' + this.curlypage_vars.wait_height + 'px; z-index:9999; ' + xPos + ':0px; ' + yPos + ':0px;">');
    document.write('<img src="' + this.curlypage_vars.wait_url + '" />');
    document.write('</div>');
  }

  // Write peel div layer
  document.write('<div id="peelDiv_' + this.curlypage_vars.peel_position  + '" style="position:' + this.curlypage_vars.peel_position_model + '; width:' + this.curlypage_vars.peel_width + 'px; height:' + this.curlypage_vars.peel_height + 'px; z-index:9999; ' + xPos + ':0px; ' + yPos + ':0px;">');

  document.write('<div id="peelDivAlternative_' + this.curlypage_vars.peel_position + '">');
  document.write('<a href="http://www.adobe.com/go/getflashplayer">');
  document.write('<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />');
  document.write('</a>');
  document.write('</div>');

  // Close peel div layer
  document.write('</div>'); 


  // Write flag div layer
  document.write('<div id="flagDiv_' + this.curlypage_vars.peel_position  + '" style="position:' + this.curlypage_vars.peel_position_model + '; width:' + this.curlypage_vars.flag_width + 'px; height:' + this.curlypage_vars.flag_height + 'px; z-index:9999; ' + xPos + ':0px; ' + yPos + ':0px;">');

  document.write('<div id="flagDivAlternative_' + this.curlypage_vars.peel_position + '">');
  document.write('<a href="http://www.adobe.com/go/getflashplayer">');
  document.write('<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />');
  document.write('</a>');
  document.write('</div>');

  // Close flag div layer
  document.write('</div>');


  // Embed flag
  swfobject.embedSWF(flag_swf + "?" + this.flag_version(), "flagDivAlternative_" + this.curlypage_vars.peel_position, this.curlypage_vars.flag_width, this.curlypage_vars.flag_height, "9.0.0", "expressInstall.swf", this.flag_vars(), this.flag_params, this.flag_attributes);

    
  // Embed peel
  swfobject.embedSWF(peel_swf + "?" + this.peel_version(), "peelDivAlternative_" + this.curlypage_vars.peel_position, this.curlypage_vars.peel_width, this.curlypage_vars.peel_height, "9.0.0", "expressInstall.swf", this.peel_vars(), this.peel_params, this.peel_attributes);

 
  hide_peel_flag(this.curlypage_vars.peel_position);

// -->
}
