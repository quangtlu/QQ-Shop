<style>
  
/* right-aligned */

.ui-menu .ui-menu-icon { position: static; float: right; }

.ui-progressbar { height:2em; text-align: left; overflow: hidden; }
.ui-progressbar .ui-progressbar-value {margin: -1px; height:100%; }
.ui-resizable { position: relative;}
.ui-resizable-handle { position: absolute;font-size: 0.1px; display: block; }
.ui-resizable-disabled .ui-resizable-handle, .ui-resizable-autohide .ui-resizable-handle { display: none; }
.ui-resizable-n { cursor: n-resize; height: 7px; width: 100%; top: -5px; left: 0; }
.ui-resizable-s { cursor: s-resize; height: 7px; width: 100%; bottom: -5px; left: 0; }
.ui-resizable-e { cursor: e-resize; width: 7px; right: -5px; top: 0; height: 100%; }
.ui-resizable-w { cursor: w-resize; width: 7px; left: -5px; top: 0; height: 100%; }
.ui-resizable-se { cursor: se-resize; width: 12px; height: 12px; right: 1px; bottom: 1px; }
.ui-resizable-sw { cursor: sw-resize; width: 9px; height: 9px; left: -5px; bottom: -5px; }
.ui-resizable-nw { cursor: nw-resize; width: 9px; height: 9px; left: -5px; top: -5px; }
.ui-resizable-ne { cursor: ne-resize; width: 9px; height: 9px; right: -5px; top: -5px;}
.ui-selectable-helper { position: absolute; z-index: 100; border:1px dotted black; }

.ui-slider { position: relative; text-align: left; }
.ui-slider .ui-slider-handle { position: absolute; z-index: 2; width: 1.2em; height: 1.2em; cursor: default; }
.ui-slider .ui-slider-range { position: absolute; z-index: 1; font-size: .7em; display: block; border: 0; background-position: 0 0; }

.ui-slider-horizontal { height: .3em; }
.ui-slider-horizontal .ui-slider-handle { top: -3px; margin-left: -2px;}
.ui-slider-horizontal .ui-slider-range { top: 0; height: 100%; }
.ui-slider-horizontal .ui-slider-range-min { left: 0; }
.ui-slider-horizontal .ui-slider-range-max { right: 0; }

.ui-slider-vertical { width: .8em; height: 100px; }
.ui-slider-vertical .ui-slider-handle { left: -.3em; margin-left: 0; margin-bottom: -.6em; }
.ui-slider-vertical .ui-slider-range { left: 0; width: 100%; }
.ui-slider-vertical .ui-slider-range-min { bottom: 0; }
.ui-slider-vertical .ui-slider-range-max { top: 0; }
.ui-spinner { position:relative; display: inline-block; overflow: hidden; padding: 0; vertical-align: middle; }
.ui-spinner-input { border: none; background: none; padding: 0; margin: .2em 0; vertical-align: middle; margin-left: .4em; margin-right: 22px; }
.ui-spinner-button { width: 16px; height: 50%; font-size: .5em; padding: 0; margin: 0; text-align: center; position: absolute; cursor: default; display: block; overflow: hidden; right: 0; }
.ui-spinner a.ui-spinner-button { border-top: none; border-bottom: none; border-right: none; } /* more specificity required here to overide default borders */
.ui-spinner .ui-icon { position: absolute; margin-top: -8px; top: 50%; left: 0; } /* vertical centre icon */
.ui-spinner-up { top: 0; }
.ui-spinner-down { bottom: 0; }



/* Fades and background-images don't work well together in IE6, drop the image */
/* Component containers
----------------------------------*/
.ui-widget { font-family: Verdana,Arial,sans-serif/*{ffDefault}*/; font-size: 1.1em/*{fsDefault}*/; }
.ui-widget .ui-widget { font-size: 1em; }
.ui-widget input, .ui-widget select, .ui-widget textarea, .ui-widget button { font-family: Verdana,Arial,sans-serif/*{ffDefault}*/; font-size: 1em; }
.ui-widget-content { background: #c3c3c3; color: #222222;  margin:2em 0 1em 0; }
.ui-widget-content a { color: #222222/*{fcContent}*/; }
.ui-widget-header {  background: #D8703F; color: #222222/*{fcHeader}*/; font-weight: bold; }
.ui-widget-header a { color: #222222/*{fcHeader}*/; }

/* Interaction states
----------------------------------*/

.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default { border: none; background:#BA6036; font-weight: normal/*{fwDefault}*/; color: #555555/*{fcDefault}*/;  border-radius: 100px;  outline: none;
  width: 10px;
  height: 10px; }
.ui-state-default a, .ui-state-default a:link, .ui-state-default a:visited { color: #555555/*{fcDefault}*/; text-decoration: none; }
</style>