﻿package {		import flash.display.MovieClip;	import flash.display.SimpleButton;	import flash.media.Sound;	import flash.display.Loader;		public class Style1Peel extends Peel {				public function Style1Peel (peelPosition:String,							 		mirror:Boolean,							 		peelColor:String,							 		peelColorStyle:String,							 		redValue:uint,							 		greenValue:uint,							 		blueValue:uint,									linkEnabled:Boolean,							 		linkTarget:String,							 		link:String,							 		peelSpeed:uint,							 		automaticOpen:uint,							 		automaticClose:uint,							 		close_button_enable:Boolean,							 		text_on_close_button:String,							 		close_redValue:uint,							 		close_greenValue:uint,							 		close_blueValue:uint,									imageLoader:Loader,									openSound:Sound,									closeSound:Sound,									toScaleX:Number,									toScaleY:Number,									flagWidth:uint,									flagHeight:uint,									peelWidth:uint,									peelHeight:uint)		{			super(peelPosition,				  mirror,				  peelColor,				  peelColorStyle,				  redValue,				  greenValue,				  blueValue,				  linkEnabled,				  linkTarget,				  link,				  peelSpeed,				  automaticOpen,				  automaticClose,				  close_button_enable,				  text_on_close_button,				  close_redValue,				  close_greenValue,				  close_blueValue,				  imageLoader,				  openSound,				  closeSound,				  toScaleX,				  toScaleY,				  flagWidth,				  flagHeight,				  peelWidth,				  peelHeight);		}	}}