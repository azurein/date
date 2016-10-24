/*!
 * Modernizr v2.0.6
 * http://www.modernizr.com
 *
 * Copyright (c) 2009-2011 Faruk Ates, Paul Irish, Alex Sexton
 * Dual-licensed under the BSD or MIT licenses: www.modernizr.com/license/
 */

/*
 * Modernizr tests which native CSS3 and HTML5 features are available in
 * the current UA and makes the results available to you in two ways:
 * as properties on a global Modernizr object, and as classes on the
 * <html> element. This information allows you to progressively enhance
 * your pages with a granular level of control over the experience.
 *
 * Modernizr has an optional (not included) conditional resource loader
 * called Modernizr.load(), based on Yepnope.js (yepnopejs.com).
 * To get a build that includes Modernizr.load(), as well as choosing
 * which tests to include, go to www.modernizr.com/download/
 *
 * Authors        Faruk Ates, Paul Irish, Alex Sexton,
 * Contributors   Ryan Seddon, Ben Alman
 */
window.Modernizr = (function( window, document, undefined ) {var version = '2.0.6', Modernizr = {}, enableClasses = true, docElement = document.documentElement, docHead = document.head || document.getElementsByTagName('head')[0], mod = 'modernizr', modElem = document.createElement(mod), mStyle = modElem.style, inputElem = document.createElement('input'), smile = ':)', toString = Object.prototype.toString, prefixes = ' -webkit- -moz- -o- -ms- -khtml- '.split(' '), domPrefixes = 'Webkit Moz O ms Khtml'.split(' '), ns = {'svg': 'http://www.w3.org/2000/svg'}, tests = {}, inputs = {}, attrs = {}, classes = [], featureName, injectElementWithStyles = function( rule, callback, nodes, testnames ) {var style, ret, node, div = document.createElement('div'); if ( parseInt(nodes, 10) ) {while ( nodes-- ) {node = document.createElement('div'); node.id = testnames ? testnames[nodes] : mod + (nodes + 1); div.appendChild(node); } } style = ['&shy;', '<style>', rule, '</style>'].join(''); div.id = mod; div.innerHTML += style; docElement.appendChild(div); ret = callback(div, rule); div.parentNode.removeChild(div); return !!ret; }, testMediaQuery = function( mq ) {if ( window.matchMedia ) {return matchMedia(mq).matches; } var bool; injectElementWithStyles('@media ' + mq + ' { #' + mod + ' { position: absolute; } }', function( node ) {bool = (window.getComputedStyle ? getComputedStyle(node, null) : node.currentStyle)['position'] == 'absolute'; }); return bool; }, isEventSupported = (function() {var TAGNAMES = {'select': 'input', 'change': 'input', 'submit': 'form', 'reset': 'form', 'error': 'img', 'load': 'img', 'abort': 'img'}; function isEventSupported( eventName, element ) {element = element || document.createElement(TAGNAMES[eventName] || 'div'); eventName = 'on' + eventName; var isSupported = eventName in element; if ( !isSupported ) {if ( !element.setAttribute ) {element = document.createElement('div'); } if ( element.setAttribute && element.removeAttribute ) {element.setAttribute(eventName, ''); isSupported = is(element[eventName], 'function'); if ( !is(element[eventName], undefined) ) {element[eventName] = undefined; } element.removeAttribute(eventName); } } element = null; return isSupported; } return isEventSupported; })(); var _hasOwnProperty = ({}).hasOwnProperty, hasOwnProperty; if ( !is(_hasOwnProperty, undefined) && !is(_hasOwnProperty.call, undefined) ) {hasOwnProperty = function (object, property) {return _hasOwnProperty.call(object, property); }; } else {hasOwnProperty = function (object, property) { /* yes, this can give false positives/negatives, but most of the time we don't care about those */ return ((property in object) && is(object.constructor.prototype[property], undefined)); }; } /** * setCss applies given styles to the Modernizr DOM node. */ function setCss( str ) {mStyle.cssText = str; } /** * setCssAll extrapolates all vendor-specific css strings. */ function setCssAll( str1, str2 ) {return setCss(prefixes.join(str1 + ';') + ( str2 || '' )); } /** * is returns a boolean for if typeof obj is exactly type. */ function is( obj, type ) {return typeof obj === type; } /** * contains returns a boolean for if substr is found within str. */ function contains( str, substr ) {return !!~('' + str).indexOf(substr); } /** * testProps is a generic CSS / DOM property test; if a browser supports *   a certain property, it won't return undefined for it. *   A supported CSS property returns empty string when its not yet set. */ function testProps( props, prefixed ) {for ( var i in props ) {if ( mStyle[ props[i] ] !== undefined ) {return prefixed == 'pfx' ? props[i] : true; } } return false; } /** * testPropsAll tests a list of DOM properties we want to check against. *   We specify literally ALL possible (known and/or likely) properties on *   the element including the non-vendor prefixed one, for forward- *   compatibility. */ function testPropsAll( prop, prefixed ) {var ucProp  = prop.charAt(0).toUpperCase() + prop.substr(1), props   = (prop + ' ' + domPrefixes.join(ucProp + ' ') + ucProp).split(' '); return testProps(props, prefixed); } /** * testBundle tests a list of CSS features that require element and style injection. *   By bundling them together we can reduce the need to touch the DOM multiple times. */ /*>>testBundle*/ var testBundle = (function( styles, tests ) {var style = styles.join(''), len = tests.length; injectElementWithStyles(style, function( node, rule ) {var style = document.styleSheets[document.styleSheets.length - 1], cssText = style.cssRules && style.cssRules[0] ? style.cssRules[0].cssText : style.cssText || "", children = node.childNodes, hash = {}; while ( len-- ) {hash[children[len].id] = children[len]; } /*>>touch*/           Modernizr['touch'] = ('ontouchstart' in window) || hash['touch'].offsetTop === 9; /*>>touch*/ /*>>csstransforms3d*/ Modernizr['csstransforms3d'] = hash['csstransforms3d'].offsetLeft === 9;          /*>>csstransforms3d*/ /*>>generatedcontent*/Modernizr['generatedcontent'] = hash['generatedcontent'].offsetHeight >= 1;       /*>>generatedcontent*/ /*>>fontface*/        Modernizr['fontface'] = /src/i.test(cssText) && cssText.indexOf(rule.split(' ')[0]) === 0;        /*>>fontface*/ }, len, tests); })([/*>>fontface*/        '@font-face {font-family:"font";src:url("https://")}'         /*>>fontface*/ /*>>touch*/           ,['@media (',prefixes.join('touch-enabled),('),mod,')', '{#touch{top:9px;position:absolute}}'].join('')           /*>>touch*/ /*>>csstransforms3d*/ ,['@media (',prefixes.join('transform-3d),('),mod,')', '{#csstransforms3d{left:9px;position:absolute}}'].join('')/*>>csstransforms3d*/ /*>>generatedcontent*/,['#generatedcontent:after{content:"',smile,'";visibility:hidden}'].join('')  /*>>generatedcontent*/ ], [/*>>fontface*/        'fontface'          /*>>fontface*/ /*>>touch*/           ,'touch'            /*>>touch*/ /*>>csstransforms3d*/ ,'csstransforms3d'  /*>>csstransforms3d*/ /*>>generatedcontent*/,'generatedcontent' /*>>generatedcontent*/ ]);/*>>testBundle*/ /** * Tests * ----- */ tests['flexbox'] = function() {/** * setPrefixedValueCSS sets the property of a specified element * adding vendor prefixes to the VALUE of the property. * @param {Element} element * @param {string} property The property name. This will not be prefixed. * @param {string} value The value of the property. This WILL be prefixed. * @param {string=} extra Additional CSS to append unmodified to the end of * the CSS string. */ function setPrefixedValueCSS( element, property, value, extra ) {property += ':'; element.style.cssText = (property + prefixes.join(value + ';' + property)).slice(0, -property.length) + (extra || ''); } /** * setPrefixedPropertyCSS sets the property of a specified element * adding vendor prefixes to the NAME of the property. * @param {Element} element * @param {string} property The property name. This WILL be prefixed. * @param {string} value The value of the property. This will not be prefixed. * @param {string=} extra Additional CSS to append unmodified to the end of * the CSS string. */ function setPrefixedPropertyCSS( element, property, value, extra ) {element.style.cssText = prefixes.join(property + ':' + value + ';') + (extra || ''); } var c = document.createElement('div'), elem = document.createElement('div'); setPrefixedValueCSS(c, 'display', 'box', 'width:42px;padding:0;'); setPrefixedPropertyCSS(elem, 'box-flex', '1', 'width:10px;'); c.appendChild(elem); docElement.appendChild(c); var ret = elem.offsetWidth === 42; c.removeChild(elem); docElement.removeChild(c); return ret; }; tests['canvas'] = function() {var elem = document.createElement('canvas'); return !!(elem.getContext && elem.getContext('2d')); }; tests['canvastext'] = function() {return !!(Modernizr['canvas'] && is(document.createElement('canvas').getContext('2d').fillText, 'function')); }; tests['webgl'] = function() {return !!window.WebGLRenderingContext; }; tests['touch'] = function() {return Modernizr['touch']; }; tests['geolocation'] = function() {return !!navigator.geolocation; }; tests['postmessage'] = function() {return !!window.postMessage; }; tests['websqldatabase'] = function() {var result = !!window.openDatabase; return result; }; tests['indexedDB'] = function() {for ( var i = -1, len = domPrefixes.length; ++i < len; ){if ( window[domPrefixes[i].toLowerCase() + 'IndexedDB'] ){return true; } } return !!window.indexedDB; }; tests['hashchange'] = function() {return isEventSupported('hashchange', window) && (document.documentMode === undefined || document.documentMode > 7); }; tests['history'] = function() {return !!(window.history && history.pushState); }; tests['draganddrop'] = function() {return isEventSupported('dragstart') && isEventSupported('drop'); }; tests['websockets'] = function() {for ( var i = -1, len = domPrefixes.length; ++i < len; ){if ( window[domPrefixes[i] + 'WebSocket'] ){return true; } } return 'WebSocket' in window; }; tests['rgba'] = function() {setCss('background-color:rgba(150,255,150,.5)'); return contains(mStyle.backgroundColor, 'rgba'); }; tests['hsla'] = function() {setCss('background-color:hsla(120,40%,100%,.5)'); return contains(mStyle.backgroundColor, 'rgba') || contains(mStyle.backgroundColor, 'hsla'); }; tests['multiplebgs'] = function() {setCss('background:url(https://),url(https://),red url(https://)'); return /(url\s*\(.*?){3}/.test(mStyle.background); }; tests['backgroundsize'] = function() {return testPropsAll('backgroundSize'); }; tests['borderimage'] = function() {return testPropsAll('borderImage'); }; tests['borderradius'] = function() {return testPropsAll('borderRadius'); }; tests['boxshadow'] = function() {return testPropsAll('boxShadow'); }; tests['textshadow'] = function() {return document.createElement('div').style.textShadow === ''; }; tests['opacity'] = function() {setCssAll('opacity:.55'); return /^0.55$/.test(mStyle.opacity); }; tests['cssanimations'] = function() {return testPropsAll('animationName'); }; tests['csscolumns'] = function() {return testPropsAll('columnCount'); }; tests['cssgradients'] = function() {var str1 = 'background-image:', str2 = 'gradient(linear,left top,right bottom,from(#9f9),to(white));', str3 = 'linear-gradient(left top,#9f9, white);'; setCss((str1 + prefixes.join(str2 + str1) + prefixes.join(str3 + str1)).slice(0, -str1.length) ); return contains(mStyle.backgroundImage, 'gradient'); }; tests['cssreflections'] = function() {return testPropsAll('boxReflect'); }; tests['csstransforms'] = function() {return !!testProps(['transformProperty', 'WebkitTransform', 'MozTransform', 'OTransform', 'msTransform']); }; tests['csstransforms3d'] = function() {var ret = !!testProps(['perspectiveProperty', 'WebkitPerspective', 'MozPerspective', 'OPerspective', 'msPerspective']); if ( ret && 'webkitPerspective' in docElement.style ) {ret = Modernizr['csstransforms3d']; } return ret; }; tests['csstransitions'] = function() {return testPropsAll('transitionProperty'); }; tests['fontface'] = function() {return Modernizr['fontface']; }; tests['generatedcontent'] = function() {return Modernizr['generatedcontent']; }; tests['video'] = function() {var elem = document.createElement('video'), bool = false; try {if ( bool = !!elem.canPlayType ) {bool      = new Boolean(bool); bool.ogg  = elem.canPlayType('video/ogg; codecs="theora"'); var h264 = 'video/mp4; codecs="avc1.42E01E'; bool.h264 = elem.canPlayType(h264 + '"') || elem.canPlayType(h264 + ', mp4a.40.2"'); bool.webm = elem.canPlayType('video/webm; codecs="vp8, vorbis"'); } } catch(e) { } return bool; }; tests['audio'] = function() {var elem = document.createElement('audio'), bool = false; try {if ( bool = !!elem.canPlayType ) {bool      = new Boolean(bool); bool.ogg  = elem.canPlayType('audio/ogg; codecs="vorbis"'); bool.mp3  = elem.canPlayType('audio/mpeg;'); bool.wav  = elem.canPlayType('audio/wav; codecs="1"'); bool.m4a  = elem.canPlayType('audio/x-m4a;') || elem.canPlayType('audio/aac;'); } } catch(e) { } return bool; }; tests['localstorage'] = function() {try {return !!localStorage.getItem; } catch(e) {return false; } }; tests['sessionstorage'] = function() {try {return !!sessionStorage.getItem; } catch(e){return false; } }; tests['webworkers'] = function() {return !!window.Worker; }; tests['applicationcache'] = function() {return !!window.applicationCache; }; tests['svg'] = function() {return !!document.createElementNS && !!document.createElementNS(ns.svg, 'svg').createSVGRect; }; tests['inlinesvg'] = function() {var div = document.createElement('div'); div.innerHTML = '<svg/>'; return (div.firstChild && div.firstChild.namespaceURI) == ns.svg; }; tests['smil'] = function() {return !!document.createElementNS && /SVG/.test(toString.call(document.createElementNS(ns.svg, 'animate'))); }; tests['svgclippaths'] = function() {return !!document.createElementNS && /SVG/.test(toString.call(document.createElementNS(ns.svg, 'clipPath'))); }; function webforms() {Modernizr['input'] = (function( props ) {for ( var i = 0, len = props.length; i < len; i++ ) {attrs[ props[i] ] = !!(props[i] in inputElem); } return attrs; })('autocomplete autofocus list placeholder max min multiple pattern required step'.split(' ')); Modernizr['inputtypes'] = (function(props) {for ( var i = 0, bool, inputElemType, defaultView, len = props.length; i < len; i++ ) {inputElem.setAttribute('type', inputElemType = props[i]); bool = inputElem.type !== 'text'; if ( bool ) {inputElem.value         = smile; inputElem.style.cssText = 'position:absolute;visibility:hidden;'; if ( /^range$/.test(inputElemType) && inputElem.style.WebkitAppearance !== undefined ) {docElement.appendChild(inputElem); defaultView = document.defaultView; bool =  defaultView.getComputedStyle && defaultView.getComputedStyle(inputElem, null).WebkitAppearance !== 'textfield' && (inputElem.offsetHeight !== 0); docElement.removeChild(inputElem); } else if ( /^(search|tel)$/.test(inputElemType) ){} else if ( /^(url|email)$/.test(inputElemType) ) {bool = inputElem.checkValidity && inputElem.checkValidity() === false; } else if ( /^color$/.test(inputElemType) ) {docElement.appendChild(inputElem); docElement.offsetWidth; bool = inputElem.value != smile; docElement.removeChild(inputElem); } else {bool = inputElem.value != smile; } } inputs[ props[i] ] = !!bool; } return inputs; })('search tel url email datetime date month week time datetime-local number range color'.split(' ')); } for ( var feature in tests ) {if ( hasOwnProperty(tests, feature) ) {featureName  = feature.toLowerCase(); Modernizr[featureName] = tests[feature](); classes.push((Modernizr[featureName] ? '' : 'no-') + featureName); } } Modernizr.input || webforms(); /** * addTest allows the user to define their own feature tests * the result will be added onto the Modernizr object, * as well as an appropriate className set on the html element * * @param feature - String naming the feature * @param test - Function returning true if feature is supported, false if not */ Modernizr.addTest = function ( feature, test ) {if ( typeof feature == "object" ) {for ( var key in feature ) {if ( hasOwnProperty( feature, key ) ) {Modernizr.addTest( key, feature[ key ] ); } } } else {feature = feature.toLowerCase(); if ( Modernizr[feature] !== undefined ) {return; } test = typeof test == "boolean" ? test : !!test(); docElement.className += ' ' + (test ? '' : 'no-') + feature; Modernizr[feature] = test; } return Modernizr; }; setCss(''); modElem = inputElem = null; if ( window.attachEvent && (function(){ var elem = document.createElement('div'); elem.innerHTML = '<elem></elem>'; return elem.childNodes.length !== 1; })() ) {(function(win, doc) {win.iepp = win.iepp || {}; var iepp = win.iepp, elems = iepp.html5elements || 'abbr|article|aside|audio|canvas|datalist|details|figcaption|figure|footer|header|hgroup|mark|meter|nav|output|progress|section|summary|time|video', elemsArr = elems.split('|'), elemsArrLen = elemsArr.length, elemRegExp = new RegExp('(^|\\s)('+elems+')', 'gi'), tagRegExp = new RegExp('<(\/*)('+elems+')', 'gi'), filterReg = /^\s*[\{\}]\s*$/, ruleRegExp = new RegExp('(^|[^\\n]*?\\s)('+elems+')([^\\n]*)({[\\n\\w\\W]*?})', 'gi'), docFrag = doc.createDocumentFragment(), html = doc.documentElement, head = html.firstChild, bodyElem = doc.createElement('body'), styleElem = doc.createElement('style'), printMedias = /print|all/, body; function shim(doc) {var a = -1; while (++a < elemsArrLen) doc.createElement(elemsArr[a]); } iepp.getCSS = function(styleSheetList, mediaType) {if(styleSheetList+'' === undefined){return '';} var a = -1, len = styleSheetList.length, styleSheet, cssTextArr = []; while (++a < len) {styleSheet = styleSheetList[a]; if(styleSheet.disabled){continue;} mediaType = styleSheet.media || mediaType; if (printMedias.test(mediaType)) cssTextArr.push(iepp.getCSS(styleSheet.imports, mediaType), styleSheet.cssText); mediaType = 'all'; } return cssTextArr.join(''); }; iepp.parseCSS = function(cssText) {var cssTextArr = [], rule; while ((rule = ruleRegExp.exec(cssText)) != null){cssTextArr.push(( (filterReg.exec(rule[1]) ? '\n' : rule[1]) +rule[2]+rule[3]).replace(elemRegExp, '$1.iepp_$2')+rule[4]); } return cssTextArr.join('\n'); }; iepp.writeHTML = function() {var a = -1; body = body || doc.body; while (++a < elemsArrLen) {var nodeList = doc.getElementsByTagName(elemsArr[a]), nodeListLen = nodeList.length, b = -1; while (++b < nodeListLen) if (nodeList[b].className.indexOf('iepp_') < 0) nodeList[b].className += ' iepp_'+elemsArr[a]; } docFrag.appendChild(body); html.appendChild(bodyElem); bodyElem.className = body.className; bodyElem.id = body.id; bodyElem.innerHTML = body.innerHTML.replace(tagRegExp, '<$1font'); }; iepp._beforePrint = function() {styleElem.styleSheet.cssText = iepp.parseCSS(iepp.getCSS(doc.styleSheets, 'all')); iepp.writeHTML(); }; iepp.restoreHTML = function(){bodyElem.innerHTML = ''; html.removeChild(bodyElem); html.appendChild(body); }; iepp._afterPrint = function(){iepp.restoreHTML(); styleElem.styleSheet.cssText = ''; }; shim(doc); shim(docFrag); if(iepp.disablePP){return;} head.insertBefore(styleElem, head.firstChild); styleElem.media = 'print'; styleElem.className = 'iepp-printshim'; win.attachEvent('onbeforeprint', iepp._beforePrint ); win.attachEvent('onafterprint', iepp._afterPrint ); })(window, document); } Modernizr._version      = version; Modernizr._prefixes     = prefixes; Modernizr._domPrefixes  = domPrefixes; Modernizr.mq            = testMediaQuery; Modernizr.hasEvent      = isEventSupported; Modernizr.testProp      = function(prop){return testProps([prop]); }; Modernizr.testAllProps  = testPropsAll; Modernizr.testStyles    = injectElementWithStyles; Modernizr.prefixed      = function(prop){return testPropsAll(prop, 'pfx'); }; docElement.className = docElement.className.replace(/\bno-js\b/, '') + (enableClasses ? ' js ' + classes.join(' ') : ''); return Modernizr; })(this, this.document);

//----------------------------------- Canvas Logic ----------------------------------------------------------------

//Untuk buat objek bulat
function RoundCanvasFacility(posX, posY, id, color, childFrom, isParent, totalCurrentChild, totalFullChild, name) {
    this.x = posX;
    this.y = posY;
    this.oldX = posX;
    this.oldY = posY;
    this.velX = 0;
    this.velY = 0;
    this.accelX = 0;
    this.accelY = 0;
    this.color = color;
    this.radius = 10;
    this.id = id;
    this.childFrom = childFrom;
    this.isParent = isParent;
    this.totalCurrentChild = totalCurrentChild;
    this.totalFullChild = totalFullChild;
    this.name = name;
}

//The function below returns a Boolean value representing whether the point with the coordinates supplied "hits" the particle.
RoundCanvasFacility.prototype.hitTest = function(hitX,hitY) {
  var dx = this.x - hitX;
  var dy = this.y - hitY;

  return(dx*dx + dy*dy < this.radius*this.radius);
}

//drawing the particle.
RoundCanvasFacility.prototype.drawToContext = function(theContext) {
  theContext.fillStyle = this.color;
  theContext.beginPath();
  theContext.arc(this.x, this.y, this.radius, 0, 2*Math.PI, false);
  theContext.closePath();
  theContext.fill();
}

//Untuk buat objek kotak
function SquareCanvasFacility(posX, posY, id, color, childFrom, isParent, totalCurrentChild, totalFullChild, name) {
    this.x = posX;
    this.y = posY;
    this.oldX = posX;
    this.oldY = posY;
    this.velX = 0;
    this.velY = 0;
    this.accelX = 0;
    this.accelY = 0;
    this.color = color;
    this.radius = 10;
    this.id = id;
    this.childFrom = childFrom;
    this.isParent = isParent;
    this.totalCurrentChild = totalCurrentChild;
    this.totalFullChild = totalFullChild;
    this.name = name;
}

//The function below returns a Boolean value representing whether the point with the coordinates supplied "hits" the particle.
SquareCanvasFacility.prototype.hitTest = function(hitX,hitY) {
  return((hitX > this.x - this.radius)&&(hitX < this.x + this.radius)&&(hitY > this.y - this.radius)&&(hitY < this.y + this.radius));
}

//drawing the particle.
SquareCanvasFacility.prototype.drawToContext = function(theContext) {
  theContext.fillStyle = this.color;
  theContext.fillRect(this.x - this.radius, this.y - this.radius, 2*this.radius, 2*this.radius);
}

var numShapes;
var shapes;
var dragIndex;
var dragging;
var mouseX;
var mouseY;
var dragHoldX;
var dragHoldY;
var timer;
var targetX;
var targetY;
var easeAmount;
var theCanvas;
var context;
var facility;
var facilityID;
var facilityChild;
var facilityParent;
var facilityName;
var isLoadImage;

function canvasSupport() {
  return Modernizr.canvas;
}

function canvasApp(data){
  if (!canvasSupport()) {
    return;
  }

  theCanvas = document.getElementById("canvasOne");
  context = theCanvas.getContext("2d");
  facility = data;
  isLoadImage = true;

  init();

}

  function init() {
    numShapes = facility.length;
    easeAmount = 0.45;

    shapes = [];

    makeShapes();

    drawScreen();

    theCanvas.addEventListener("mousedown", mouseDownListener, false);
  }

  function makeShapes() {
    var i;
    var tempX;
    var tempY;
    var facilityColorParent = ["#68ff6f","#fff222","#ff8b8b"];//lime, cramp, pink
    var facilityColorChild = ["#33cc00","#ff8533","#ff2b2b"];//green, orange, red
    var color;

    for (i=0; i < numShapes; i++) {
      if(facility[i].is_parent == 1){ //make different color between child and parent
        color = facilityColorParent[facility[i].color];
      }else{
        color = facilityColorChild[facility[i].color];
      }
      tempShape = new RoundCanvasFacility(parseInt(facility[i].x_axis), parseInt(facility[i].y_axis), facility[i].facility_id, color, facility[i].facility_parent_id, facility[i].is_parent, facility[i].totalCurrentChild, facility[i].totalFullChild, facility[i].name);
      if(facility[i].is_parent == 1){ //is parent true
        tempShape.radius = 25;  //canvas size
      }else{ //child
        tempShape.radius = 7;
      }

      shapes.push(tempShape);
    }
  }

  function mouseDownListener(evt) {
    var i;

    //get mouse position
    var bRect = theCanvas.getBoundingClientRect();
    mouseX = (evt.clientX - bRect.left)*(theCanvas.width/bRect.width);
    mouseY = (evt.clientY - bRect.top)*(theCanvas.height/bRect.height);

    for (i=0; i < numShapes; i++) {
      if (shapes[i].hitTest(mouseX, mouseY)) {
        facilityID = shapes[i].id;
        facilityParent = shapes[i].isParent;
        facilityName = shapes[i].name;
        dragging = true;

        dragIndex = i;
      }
    }

    if (dragging) {
      window.addEventListener("mousemove", mouseMoveListener, false);

      //place currently dragged shape on top
      shapes.push(shapes.splice(dragIndex,1)[0]);
      //shapeto drag is now last one in array
      dragHoldX = mouseX - shapes[numShapes-1].x;
      dragHoldY = mouseY - shapes[numShapes-1].y;

      //make smooth
      targetX = mouseX - dragHoldX;
      targetY = mouseY - dragHoldY;

      //start timer
      timer = setInterval(onTimerTick, 1000/30);
    }
    theCanvas.removeEventListener("mousedown", mouseDownListener, false);
    window.addEventListener("mouseup", mouseUpListener, false);

    //code below prevents the mouse down from having an effect on the main browser window:
    if (evt.preventDefault) {
      evt.preventDefault();
    } //standard
    else if (evt.returnValue) {
      evt.returnValue = false;
    } //older IE
    return false;
  }

  function onTimerTick() {
    //the dragging shape is the last one in the array.
    var x_Move = easeAmount*(targetX - shapes[numShapes-1].x);
    var y_Move = easeAmount*(targetY - shapes[numShapes-1].y);
    shapes[numShapes-1].x = shapes[numShapes-1].x + x_Move;
    shapes[numShapes-1].y = shapes[numShapes-1].y + y_Move;

    //if parent
    facilityChild = [];
    if(shapes[numShapes-1].isParent == 1){
      for(var i = 0;i < shapes.length;i++){
        if(shapes[i].childFrom == shapes[numShapes-1].id){
          facilityChild.push(shapes[i]);
          shapes[i].x = shapes[i].x + x_Move;
          shapes[i].y = shapes[i].y + y_Move;
        }
      }
    }

    //stop the timer when the target position is reached (close enough)
    if ((!dragging)&&(Math.abs(shapes[numShapes-1].x - targetX) < 0.1) && (Math.abs(shapes[numShapes-1].y - targetY) < 0.1)) {
      shapes[numShapes-1].x = targetX;
      shapes[numShapes-1].y = targetY;

      //save data if there change coordinate
      if(shapes[numShapes-1].oldX != shapes[numShapes-1].x){
      	saveCoordinateFacility(facilityID,parseInt(targetX),parseInt(targetY));
      	shapes[numShapes-1].oldX = shapes[numShapes-1].x;
	    if(facilityParent == true){//save coordinate child if parent drag
	      for(var i=0;i<facilityChild.length;i++){
	          saveCoordinateFacility(facilityChild[i].id,parseInt(facilityChild[i].x),parseInt(facilityChild[i].y));
	      }
	    }
      }else{ //if just click show table detail
      	if(facilityParent == true){
	      $('#tableDetailModal').modal('show');
	      $('#tableName').text(facilityName);
	      getTableDetail(facilityID);
	    }
      }

      //stop timer:
      clearInterval(timer);
    }
    drawScreen();
  }

  function mouseUpListener(evt) {
    theCanvas.addEventListener("mousedown", mouseDownListener, false);
    window.removeEventListener("mouseup", mouseUpListener, false);
    if (dragging) {
      dragging = false;
      window.removeEventListener("mousemove", mouseMoveListener, false);
    }
  }

  function mouseMoveListener(evt) {
    var posX;
    var posY;
    var shapeRad = shapes[numShapes-1].radius;
    var minX = shapeRad;
    var maxX = theCanvas.width - shapeRad;
    var minY = shapeRad;
    var maxY = theCanvas.height - shapeRad;

    //mouse position
    var bRect = theCanvas.getBoundingClientRect();
    mouseX = (evt.clientX - bRect.left)*(theCanvas.width/bRect.width);
    mouseY = (evt.clientY - bRect.top)*(theCanvas.height/bRect.height);

    //prevent object from dragging outside of canvas
    posX = mouseX - dragHoldX;
    posX = (posX < minX) ? minX : ((posX > maxX) ? maxX : posX);
    posY = mouseY - dragHoldY;
    posY = (posY < minY) ? minY : ((posY > maxY) ? maxY : posY);

    targetX = posX;
    targetY = posY;
  }

  function drawShapes() {
    var i;
    for (i=0; i < numShapes; i++) {
      shapes[i].drawToContext(context);
      if(shapes[i].isParent == 1){
        context.font = 'bold 16px Calibri';
        context.fillStyle = 'black';
        context.textAlign = 'center';
        context.fillText((shapes[i].totalFullChild-shapes[i].totalCurrentChild)+'/'+shapes[i].totalFullChild, shapes[i].x, shapes[i].y+12);
        context.fillText(shapes[i].name, shapes[i].x, shapes[i].y - 2);
      }
    }
  }

  function drawScreen() {
    if(isLoadImage){
      //if not support
        //loadImageBackground();
      document.getElementById('imgBackgroundCanvas').onload = function(){
        loadImageBackground();
      }
    }else{
      var background = document.getElementById('imgBackgroundCanvas');
      context.drawImage(background,0,0,theCanvas.width,theCanvas.height);
      context.fillStyle = "rgba(0,0,0,0)";
      context.fillRect(0,0,theCanvas.width,theCanvas.height);

      drawShapes();
    }

  }

  function loadImageBackground(){
    var background = document.getElementById('imgBackgroundCanvas');
    context.drawImage(background,0,0,theCanvas.width,theCanvas.height);
    context.fillStyle = "rgba(0,0,0,0)";
    context.fillRect(0,0,theCanvas.width,theCanvas.height);
    drawShapes();
    isLoadImage = false;
  }

  function resizeCanvas(){
    var canvasBorder = $('#CanvasBorder');
    if(theCanvas.height != canvasBorder.height() || theCanvas.width != canvasBorder.width()){
        theCanvas.height = canvasBorder.height();
        theCanvas.width = canvasBorder.width();
        drawScreen();
      }
  }
