document.onmouseover = doOver;
document.onmouseout  = doOut;
document.onmousedown = doDown;
document.onmouseup   = doUp;
function doOver() {
	var toEl = getReal(window.event.toElement, "className", "Wbtn");
	var fromEl = getReal(window.event.fromElement, "className", "Wbtn");
	if (toEl == fromEl) return;
	var el = toEl;
	var cDisabled = el.cDisabled;
	cDisabled = (cDisabled != null);
	if (el.className == "Wbtn")
	el.onselectstart = new Function("return false");
	if ((el.className == "Wbtn") && !cDisabled) {
		makeRaised(el);
		makeGray(el,false);
	}
}
function doOut() {
	var toEl = getReal(window.event.toElement, "className", "Wbtn");
	var fromEl = getReal(window.event.fromElement, "className", "Wbtn");
	if (toEl == fromEl) return;
	var el = fromEl;
	var cDisabled = el.cDisabled;
	cDisabled = (cDisabled != null);

	var cToggle = el.cToggle;
	toggle_disabled = (cToggle != null);

	if (cToggle && el.value) {
	makePressed(el);
	makeGray(el,true);
	}
	else if ((el.className == "Wbtn") && !cDisabled) {
	makeFlat(el);
	makeGray(el,true);
	}
}

function doDown() {
	el = getReal(window.event.srcElement, "className", "Wbtn");

	var cDisabled = el.cDisabled;
	cDisabled = (cDisabled != null);

	if ((el.className == "Wbtn") && !cDisabled) {
	makePressed(el)
	}
}

function doUp() {
	el = getReal(window.event.srcElement, "className", "Wbtn");

	var cDisabled = el.cDisabled;
	cDisabled = (cDisabled != null);

	if ((el.className == "Wbtn") && !cDisabled) {
	makeRaised(el);
	}
}


function getReal(el, type, value) {
	temp = el;
	while ((temp != null) && (temp.tagName != "BODY")) {
	if (eval("temp." + type) == value) {
	el = temp;
	return el;
	}
	temp = temp.parentElement;
	}
	return el;
}

function findChildren(el, type, value) {
	var children = el.children;
	var tmp = new Array();
	var j=0;

	for (var i=0; i<children.length; i++) {
		if (eval("children[i]." + type + "==\"" + value + "\"")) {
		tmp[tmp.length] = children[i];
		}
		tmp = tmp.concat(findChildren(children[i], type, value));
	}
	return tmp;
}

function disable(el) {

	if (document.readyState != "complete") {
		window.setTimeout("disable(" + el.id + ")", 100);
		return;
	}

	var cDisabled = el.cDisabled;
	cDisabled = (cDisabled != null);

	if (!cDisabled) {
		el.cDisabled = true;

		el.innerHTML = '<span style="background: buttonshadow; text-align: center;">' +
		//'<span style="filter:Mask(Color=buttonface) DropShadow(Color=buttonhighlight, OffX=1, OffY=1, Positive=0); text-align: center;">' +el.innerHTML +
		'<span style="text-align: center;">' +el.innerHTML +
		'</span>' +
		'</span>';

		if (el.onclick != null) {
		el.cDisabled_onclick = el.onclick;
		el.onclick = null;
		}
	}
}

function enable(el) {
	var cDisabled = el.cDisabled;

	cDisabled = (cDisabled != null);

	if (cDisabled) {
	el.cDisabled = null;
	el.innerHTML = el.children[0].children[0].innerHTML;

		if (el.cDisabled_onclick != null) {
		el.onclick = el.cDisabled_onclick;
		el.cDisabled_onclick = null;
		}
	}
}

function addToggle(el) {
	var cDisabled = el.cDisabled;

	cDisabled = (cDisabled != null);

	var cToggle = el.cToggle;

	cToggle = (cToggle != null);

	if (!cToggle && !cDisabled) {
	el.cToggle = true;

		if (el.value == null)
		el.value = 0;   

		if (el.onclick != null)
		el.cToggle_onclick = el.onclick; 
		else 
		el.cToggle_onclick = "";

		el.onclick = new Function("toggle(" + el.id +"); " + el.id + ".cToggle_onclick();");
	}
}

function removeToggle(el) {
	var cDisabled = el.cDisabled;

	cDisabled = (cDisabled != null);

	var cToggle = el.cToggle;

	cToggle = (cToggle != null);

	if (cToggle && !cDisabled) {
		el.cToggle = null;

		if (el.value) {
		toggle(el);
		}

		makeFlat(el);

		if (el.cToggle_onclick != null) {
		el.onclick = el.cToggle_onclick;
		el.cToggle_onclick = null;
		}
	}
}

function toggle(el) {
	el.value = !el.value;

	if (el.value)
	el.style.background = "URL(../image/blank.gif)";
	else
	el.style.backgroundImage = "";
}


function makeFlat(el) {
	with (el.style) {
	background = "";
	border = "1px solid buttonface";
	padding = "1px";
	}
}

function makeRaised(el) {
	with (el.style) {
	borderLeft   = "1px solid buttonhighlight";
	borderRight  = "1px solid buttonshadow";
	borderTop    = "1px solid buttonhighlight";
	borderBottom = "1px solid buttonshadow";
	padding      = "1px";
	}
}

function makePressed(el) {
	with (el.style) {
	borderLeft   = "1px solid buttonshadow";
	borderRight  = "1px solid buttonhighlight";
	borderTop    = "1px solid buttonshadow";
	borderBottom = "1px solid buttonhighlight";
	paddingTop    = "2px";
	paddingLeft   = "2px";
	paddingBottom = "0px";
	paddingRight  = "0px";
	}
}

function makeGray(el,b) {
	var filtval = "";

	var imgs = findChildren(el, "tagName", "IMG");

	for (var i=0; i<imgs.length; i++) {
	imgs[i].style.filter = filtval;
	}
}


document.write("<style>");
document.write(".coolBar{background: buttonface;border-top: 1px solid buttonhighlight; border-left: 1px solid buttonhighlight; border-bottom: 1px solid buttonshadow; border-right: 1px solid buttonshadow; padding: 2px; font: menu;}");
document.write(".Wbtn {border: 1px solid buttonface; padding: 1px; text-align: center; cursor: default;}");
//document.write(".Wbtn IMG {filter: gray();}");
document.write("</style>");

window.onerror = null;
var bName = navigator.appName;
var bVer = parseInt(navigator.appVersion);
var NS4 = (bName == "Netscape" && bVer >= 4);
var IE4 = (bName == "Microsoft Internet Explorer" && bVer >= 4);
var NS3 = (bName == "Netscape" && bVer < 4);
var IE3 = (bName == "Microsoft Internet Explorer" && bVer < 4);
var menuActive = 0
var menuOn = 0
var onLayer
var timeOn = null
var loaded = 0


// LAYER SWITCHING CODE
if (NS4 || IE4) {
if (navigator.appName == "Netscape") {
layerStyleRef="layer.";
layerRef="document.layers";
styleSwitch="";
}else{
layerStyleRef="layer.style.";
layerRef="document.all";
styleSwitch=".style";
}
}


function layershow(){
	var i, visStr, args, theObj;
	args = layershow.arguments;

	for (i=0; i<(args.length-2); i+=3) {
		visStr   = args[i+2];

		if (navigator.appName == 'Netscape' && document.layers != null) {
			theObj = eval(args[i]);
			if (theObj) theObj.visibility = visStr;
		} else if (document.all != null) {
			if (visStr == 'show') visStr = 'visible';
			if (visStr == 'hide') visStr = 'hidden';
			theObj = eval(args[i+1]);
			if (theObj) theObj.style.visibility = visStr;
		}
	}
}

// SHOW MENU
function showLayer(layerName){
	if (NS4 || IE4) {
	if (timeOn != null) {
	clearTimeout(timeOn)
	hideLayer(onLayer)
	}
	if (NS4 || IE4) {
	eval(layerRef+'["'+layerName+'"]'+styleSwitch+'.visibility="visible"');
	}
	onLayer = layerName
	}
}

// HIDE MENU
function hideLayer(layerName){
	if (menuActive == 0) {
	if (NS4 || IE4) {
	eval(layerRef+'["'+layerName+'"]'+styleSwitch+'.visibility="hidden"');
	}
	}
}

// TIMER FOR BUTTON MOUSE OUT
function btnTimer() {
	menuActive=0
	timeOn = setTimeout("btnOut()",10)
}

// BUTTON MOUSE OUT
function btnOut(layerName) {
	menuActive=0
	if (menuActive == 0) {
	hideLayer(onLayer)
	}
}

// MENU MOUSE OVER  
function menuOver(itemName) {
	clearTimeout(timeOn)
	menuActive = 1
}

// MENU MOUSE OUT 
function menuOut(itemName) {
	menuActive = 0 
	timeOn = setTimeout("hideLayer(onLayer)", 10)
}

function check_smenu() {
	showLayer('m0');
	menuOut('m0');
}
function Show_Submenu(id)
{
	top.document.all[id].style.visibility = "visible";
}
function Hide_Submenu(id)
{
	top.document.all[id].style.visibility = "hidden";
}
function Hide_aSubmenu()
{
	top.document.all.m1_sub1.style.visibility = "hidden";
	top.document.all.m2_sub1.style.visibility = "hidden";
	top.document.all.m2_sub2.style.visibility = "hidden";
	top.document.all.m6_sub1.style.visibility = "hidden";
	top.document.all.m3_sub1.style.visibility = "hidden";
	top.document.all.m3_sub2.style.visibility = "hidden";
	top.document.all.m3_sub3.style.visibility = "hidden";
}
function Hide_amenu()
{
	for(var i = 1; i < 9; i++) {
		eval("document.all.m"+i).style.visibility = "hidden";
	}
	Hide_aSubmenu();
}