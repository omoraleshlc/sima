<?php $_hl0="\061.3\056\060.1"; if (!class_exists("\113oo\154\123cri\160\164in\147",FALSE)) { class koolscripting { static function start() { ob_start(); return ""; } static function end() { $_hO0=ob_get_clean(); $_hl1=""; $_hO1=new domdocument(); $_hO1->loadxml($_hO0); $_hl2=$_hO1->documentElement; $id=$_hl2->getattribute("\151d"); $name=$_hl2->nodeName; $id=($id == "") ? "\144\165mp": $id; if (class_exists($name,FALSE)) { eval ("\044".$id."\040= ne\167\040".$name."\050'".$id."');"); $$id->loadxml($_hl2); $_hl1=$$id->render(); } else { $_hl1.=$_hO0; } return $_hl1; } } } if ( isset ($_GET[md5("\152s")])) { header("\103ont\145\156t-t\171\160e:\040\164ex\164\057ja\166\141sc\162\151p\164"); ?> function _hO(_ho){return document.getElementById(_ho); }function _hY(_hy){return (_hy!=null); }function _hI(_hi,_hA){var _ha=document.createElement(_hi); _hA.appendChild(_ha); return _ha; }function _hE(_he,_hU,_hu){return _hu.replace(eval("/"+_he+"/g"),_hU); }function _hZ(_hy,_hz){_hz=(_hY(_hz))?_hz: 1; for (var i=0; i<_hz; i++)_hy=_hy.parentNode; return _hy; }function _hX(_hy,_hz){_hz=(_hY(_hz))?_hz: 1; for (var i=0; i<_hz; i++)_hy=_hy.firstChild; return _hy; }function _hx(_hy,_hz){_hz=(_hY(_hz))?_hz: 1; for (var i=0; i<_hz; i++)_hy=_hy.nextSibling; return _hy; }function _hW(_hy,_hz){_hz=(_hY(_hz))?_hz: 1; for (var i=0; i<_hz; i++)_hy=_hy.previousSibling; return _hy; }function _hW(_hy,_hz){_hz=(_hY(_hz))?_hz: 1; for (var i=0; i<_hz; i++)_hy=_hy.previousSibling; return _hy; }function _hw(_hy,_hV){_hy.style.display=(_hV)?"": "none"; }function _hv(_hy){return (_hy.style.display!="none"); }function _hT(_hy,_hV){_hy.style._ht=_hY(_hV)?_hV/100: ""; _hy.style.filter=_hY(_hV)?"alpha(opacity="+_hV+")": ""; ; _hy.style.opacity=_hY(_hV)?_hV/100: ""; }function _hS(_hy,_hV){_hy.style.height=_hY(_hV)?_hV+"px": ""; }function _hs(_hy){return parseInt(_hy.style.height); }function _hR(_hy,_hV){_hy.style.width=_hY(_hV)?_hV+"px": ""; }function _hr(_hy){return parseInt(_hy.style.width); }function _hQ(_hy,_hV){_hy.style.top=_hY(_hV)?_hV+"px": ""; }function _hq(_hy){return parseInt(_hy.style.top); }function _hP(_hy,_hV){_hy.style.left=_hY(_hV)?_hV+"px": ""; }function _hp(_hy){return parseInt(_hy.style.left); }function _hN(_hy,_hV){_hy.style.zIndex=_hY(_hV)?_hV:null; }function _hn(_hy){return parseInt(_hy.style.zIndex); }function _hM(_hy){return _hy.className; }function _hm(_hy,_hV){_hy.className=_hV; }function _hL(_hl,_hK){return _hK.indexOf(_hl); }function _hk(_hl,_hJ,_hj){_hm(_hj,_hM(_hj).replace(_hl,_hJ)); }function _hH(_hy,_hh){if (_hy.className.indexOf(_hh)<0){var _hG=_hy.className.split(" "); _hG.push(_hh); _hy.className=_hG.join(" "); }}function _hg(_hy,_hh){if (_hy.className.indexOf(_hh)>-1){_hk(_hh,"",_hy);var _hG=_hy.className.split(" "); _hy.className=_hG.join(" "); }}function _hF(_hf,_hh,_hD){_hD=_hY(_hD)?_hD:document.body; var _hd=_hD.getElementsByTagName(_hf); var _hC=new Array(); for (var i=0; i<_hd.length; i++)if (_hd[i].className.indexOf(_hh)>=0){_hC.push(_hd[i]); }return _hC; }function _hc(_hB,_hb,_ho0,_hO0){if (_hB.addEventListener){_hB.addEventListener(_hb,_ho0,_hO0); return true; }else if (_hB.attachEvent){if (_hO0){return false; }else {var _hl0= function (){_ho0.apply(_hB,[window.event]); };if (!_hB["ref"+_hb])_hB["ref"+_hb]=[]; else {for (var _hi0 in _hB["ref"+_hb]){if (_hB["ref"+_hb][_hi0]._ho0 === _ho0)return false; }}var _hI0=_hB.attachEvent("on"+_hb,_hl0); if (_hI0)_hB["ref"+_hb].push( {_ho0:_ho0,_hl0:_hl0 } ); return _hI0; }}else {return false; }}function _ho1(_hO1){var a=_hO1.attributes,i,_hl1,_hi1; if (a){_hl1=a.length; for (i=0; i<_hl1; i+=1){_hi1=a[i].name; if (typeof _hO1[_hi1] === "function"){_hO1[_hi1]=null; }}}a=_hO1.childNodes; if (a){_hl1=a.length; for (i=0; i<_hl1; i+=1){_ho1(_hO1.childNodes[i]); }}}function _hI1(){var _ho2=0,_hO2=0; if (typeof(window.innerWidth)=="number"){_ho2=window.innerWidth; _hO2=window.innerHeight; }else if (document.documentElement && (document.documentElement.clientWidth || document.documentElement.clientHeight)){_ho2=document.documentElement.clientWidth; _hO2=document.documentElement.clientHeight; }else if (document.body && (document.body.clientWidth || document.body.clientHeight)){_ho2=document.body.clientWidth; _hO2=document.body.clientHeight; }return {_ho2:_ho2,_hO2:_hO2 } ; }function _hl2(){var _ho2=(document.body.scrollWidth>document.documentElement.scrollWidth)?document.body.scrollWidth:document.documentElement.scrollWidth; var _hO2=(document.body.scrollHeight>document.documentElement.scrollHeight)?document.body.scrollHeight:document.documentElement.scrollHeight; return {_ho2:_ho2,_hO2:_hO2 } ; }function _hi2(_hI2,_ho3){var _hO3=""; if (document.defaultView && document.defaultView.getComputedStyle){var _hl3=document.defaultView.getComputedStyle(_hI2,null); if (!_hl3){try {if (_hI2.style.display=="none"){_hI2.style.display=""; _hl3=document.defaultView.getComputedStyle(_hI2,null); if (_hl3){_hO3=_hl3.getPropertyValue(_ho3); }_hI2.style.display="none"; }}catch (_hi3){}}if (_hl3 && _hO3==""){_hO3=_hl3.getPropertyValue(_ho3); }}else if (_hI2.currentStyle){try {_ho3=_ho3.replace(/-(\w)/g, function (_hI3,_ho4){return _ho4.toUpperCase(); } ); _hO3=_hI2.currentStyle[_ho3]; }catch (_hi3){}}return _hO3; } ; function _hO4(_hl4){var _hi4=0; var _hI4=new Array(); var _ho5=_hl4; var _hO5=_hl5(); while (_hl4.offsetParent){_hI4.push(_hl4); if (this._hi5 && _hl4.nodeName=="TR")_hi4+=_hl4.firstChild.offsetTop-_hl4.firstChild.scrollTop; else _hi4+=_hl4.offsetTop-((_hO5=="opera" || _hl4.nodeName=="TR")?0:_hl4.scrollTop); _hl4=_hl4.offsetParent; }if (_hO5=="safari")_hi4+=document.body.offsetTop; if (_hO5=="ie")if (document.documentElement && document.documentElement.clientWidth)if (document.body.topMargin){try {_hI5=_hi2(document.body,"margin-top"); if (_hI5=="auto")_hI5="0"; _hi4+=parseInt((_hI5!="")?_hI5:document.body.topMargin); }catch (_ho6){}}if ((_hO5=="safari" || _hO5=="firefox" || _hO5=="opera") && _hI4.length>0){_hl4=_ho5; while (_hl4.offsetParent){var _hO6= false; if (_hl4.nodeName.toLowerCase()=="div" && _hl4.style.position!="absolute" && _hl4.style.position!="relative" && _hl4.style.position!="fixed"){for (var _hl6=0; _hl6<_hI4.length; _hl6++){if (_hI4[_hl6]==_hl4){_hO6= true; break; }}if (_hO6== false){_hi4-=_hl4.scrollTop; }}_hl4=_hl4.parentNode; }}return _hi4; } ; function _hi6(_hl4){var _hi4=0; var _hI4=new Array(); var _ho5=_hl4; var _hO5=_hl5(); while (_hl4.offsetParent){_hI4.push(_hl4); if (this._hi5 && _hl4.nodeName=="TR")_hi4+=_hl4.firstChild.offsetLeft-_hl4.firstChild.scrollLeft; else _hi4+=_hl4.offsetLeft-((_hO5=="opera" || _hl4.nodeName=="TR")?0:_hl4.scrollLeft); _hl4=_hl4.offsetParent; }if (_hO5=="safari")_hi4+=document.body.offsetLeft; if (_hO5=="ie")if (document.documentElement && document.documentElement.clientWidth)if (document.body.leftMargin){try {_hI6=_hi2(document.body,"margin-left"); if (_hI6=="auto")_hI6="0"; _hi4+=parseInt(((_hI6!="")?_hI6:document.body.leftMargin)); }catch (_ho6){}}if ((_hO5=="safari" || _hO5=="firefox" || _hO5=="opera") && _hI4.length>0){_hl4=_ho5; while (_hl4.offsetParent){var _hO6= false; if (_hl4.nodeName.toLowerCase()=="div" && _hl4.style.position!="absolute" && _hl4.style.position!="relative" && _hl4.style.position!="fixed"){for (var _hl6=0; _hl6<_hI4.length; _hl6++){if (_hI4[_hl6]==_hl4){_hO6= true; break; }}if (_hO6== false){_hi4-=_hl4.scrollLeft; }}_hl4=_hl4.parentNode; }}return _hi4; } ; function _ho7(){return (document.body.scrollLeft+document.documentElement.scrollLeft); }function _hO7(){return (document.body.scrollTop+document.documentElement.scrollTop); }function _hl7(_hi7,_hI7,_ho8,_hO8){return _ho8*_hi7/_hO8+_hI7; }function _hl8(_hi7,_hI7,_ho8,_hO8){return _ho8*(_hi7 /= _hO8)*_hi7+_hI7; }function _hi8(_hi7,_hI7,_ho8,_hO8){if ((_hi7 /= _hO8/2)<1)return _ho8/2*_hi7*_hi7+_hI7; return -_ho8/2*(( --_hi7)*(_hi7-2)-1)+_hI7; }function _hl5(){var _hI8=navigator.userAgent.toLowerCase(); if (_hL("opera",_hI8)!=-1){return "opera"; }else if (_hL("firefox",_hI8)!=-1){return "firefox"; }else if (_hL("safari",_hI8)!=-1){return "safari"; }else if ((_hL("msie",_hI8)!=-1) && (_hL("opera",_hI8)==-1)){return "ie"; }else {return "firefox"; }}function KoolImageView(_ho9,_hO9,_hl9,_hi9,_hI9,_hoa,_hOa,_hla,_hia,_hIa){ this._ho9=_ho9; this._hO9=_hO9; this._hob=_hl9; this._hi9=_hi9; this._hOb=_hoa; this._hlb=_hOa; this._hI9=_hI9; this._hla=_hla; this._hia=_hia; this._hIa=_hIa; this._hib="closed"; this._hIb=new Array(); this._hoc(); }KoolImageView.prototype= {_hoc:function (){var _hOc=_hZ(_hO(this._ho9+".zoompanel")); document.body.insertBefore(_hOc,document.body.firstChild); var _hlc=_hO(this._ho9); var _hic=_hO(this._ho9+".bigimage"); _hc(_hlc,"click",_hIc, false); _hc(_hlc,"mouseover",_hod, false); _hc(_hlc,"mouseout",_hOd, false); _hc(_hic,"load",_hld, false); _hc(_hic,"click",_hid, false); _hc(window,"resize",eval("__=function(_e){"+this._ho9+".WRS(_e);}"), false); if (this._hi9>0){var _hId=_hO(this._ho9+".background"); _hc(_hId,"click",_hoe, false); }var _hOe=_hO(this._ho9+".zoompanel"); _hc(_hOe,"mouseover",_hle, false); _hc(_hOe,"mouseout",_hie, false); var _hIe=_hF("a","CloseButton",_hOe); for (var i in _hIe)_hc(_hIe[i],"click",_hof, false); } ,open:function (){if (!this._hOf("OnBeforeOpen",null))return; this._hib="loading"; if (this._hob){ this._hl9(1); }var _hic=_hO(this._ho9+".bigimage"); _hic.src=this._hO9; } ,_hIf:function (){var _hOe=_hO(this._ho9+".zoompanel"); var _hic=_hO(this._ho9+".bigimage"); var _hog=_ho7(); var _hOg=_hO7(); var _hlg=_hI1(); _hH(_hOe,"kivTransparent"); _hQ(_hOe,0); _hP(_hOe,0); _hw(_hOe,1); var _hig=_hOe.offsetWidth; var _hIg=_hOe.offsetHeight; var _hlc=_hO(this._ho9); var _hoh=_hi6(_hlc); var _hOh=_hO4(_hlc); var _hlh=_hlc.offsetWidth; var _hih=_hlc.offsetHeight; switch (this._hla){case "RELATIVE":var _hIh=_hoh+this._hia; var _hoi=_hOh+this._hIa; break; case "IMAGE_CENTER":var _hIh=_hoh-(_hig-_hlh)/2; var _hoi=_hOh-(_hIg-_hih)/2; break; case "SCREEN_CENTER":default:var _hIh=(_hlg._ho2-_hig)/2+_hog; var _hoi=(_hlg._hO2-_hIg)/2+_hOg; break; }_hP(_hOe,_hIh); _hQ(_hOe,_hoi); this._hOi=this._hli(); this._hii=new Object(); this._hii._hIi=_hic.width; this._hii._hoj=_hic.height; this._hii._hig=_hig; this._hii._hIg=_hIg; _hw(_hOe,0); _hg(_hOe,"kivTransparent"); if (_hl5()!="safari" && _hl5()!="ie"){var _hOj=_hF("span","OpacityRender",_hOe); for (var i in _hOj){_hT(_hOj[i],0); }}} ,_hli:function (){var _hic=_hO(this._ho9+".bigimage"); var _hOe=_hO(this._ho9+".zoompanel"); var _top=0; var _hlj=0; var _hD=_hic; while (_hD!=_hOe){_top+=_hD.offsetTop; _hlj+=_hD.offsetLeft; _hD=_hD.offsetParent; }return {_hlj:_hlj,_top:_top } ; } ,_hij:function (){var _hOe=_hO(this._ho9+".zoompanel"); _hT(_hOe,null); _hw(_hOe,1); if (this._hi9>0){var _hId=_hO(this._ho9+".background"); _hT(_hId,this._hi9); this._hIj(1); } this._hib="opened"; this._hOf("OnOpen",null); if (_hl5()!="safari" && _hl5()!="ie"){ this.ORD(0,1); }} ,close:function (){if (!this._hOf("OnBeforeClose",null))return; this._hib="closing"; this.DZM(this._hlb,-1); } ,getStatus:function (){return this._hib; } ,_hok:function (){var _hOe=_hO(this._ho9+".zoompanel"); var _hic=_hO(this._ho9+".bigimage"); _hw(_hOe,0); _hic.src=""; if (_hl5()=="opera"){var _hD=_hZ(_hic); _ho1(_hic); var _hOk=_hI("img",_hD); _hD.insertBefore(_hOk,_hic); _hOk.id=this._ho9+".bigimage"; _hm(_hOk,"kivBigImage"); _hc(_hOk,"load",_hld, false); _hc(_hOk,"click",_hid, false); _hD.removeChild(_hic); }if (this._hi9>0){var _hId=_hO(this._ho9+".background"); _hT(_hId,this._hi9); this._hIj(0); } this._hib="closed"; this._hOf("OnClose",null); } ,DZM:function (_hlk,_hik){if (_hlk<=0 && _hik<0){ this._hIk(_hlk,1); this._hok(); return; }if (_hlk>=this._hlb && _hik>0){ this._hIk(_hlk,1); this._hij(); return; } this._hIk(_hlk,0); setTimeout(this._ho9+".DZM("+(_hlk+_hik)+","+_hik+")",this._hOb/this._hlb); } ,_hIk:function (_hlk,_hol){switch (this._hI9){case "fading":var _hOe=_hO(this._ho9+".zoompanel"); var _hll=_hl7(_hlk,0,100-0,this._hlb); _hT(_hOe,_hll); _hw(_hOe,1); if (this._hi9>0){var _hll=_hl7(_hlk,0,this._hi9-0,this._hlb); var _hId=_hO(this._ho9+".background"); _hT(_hId,_hll); this._hIj(1); }break; case "zooming":var _hil=_hO(this._ho9+".effectpanel"); var _hIl=_hO(this._ho9+".effectimage"); var _hOe=_hO(this._ho9+".zoompanel"); var _hlc=_hO(this._ho9); var _hic=_hO(this._ho9+".bigimage"); if (_hol){_hw(_hil,0); _hw(_hIl,0); _hIl.src=""; if (_hlk==0){_hT(_hlc,null); }return; }if (_hlk==0){_hIl.src=this._hO9; _hT(_hlc,0); }if (_hlk==this._hlb){_hIl.src=this._hO9; _hw(_hOe,0); if (this._hi9>0){var _hId=_hO(this._ho9+".background"); _hw(_hId,0); }}var _hoh=_hi6(_hlc); var _hOh=_hO4(_hlc); var _hlh=_hlc.width; var _hih=_hlc.height; var _hIh=_hp(_hOe); var _hoi=_hq(_hOe); var _hig=this._hii._hig; var _hIg=this._hii._hIg; var _hIi=this._hii._hIi; var _hoj=this._hii._hoj; var _hom=(_hlh/_hIi)*_hig; var _hOm=(_hih/_hoj)*_hIg; var _hIm=_hi8(_hlk,_hom,_hig-_hom,this._hlb); var _hon=_hi8(_hlk,_hOm,_hIg-_hOm,this._hlb); var _hOn=(_hlh/_hIi)*this._hOi._hlj; var _hIn=(_hlh/_hIi)*this._hOi._top; var _hoo=_hoh-_hOn; var _hOo=_hOh-_hIn; var _hIo=_hi8(_hlk,_hoo,_hIh-_hoo,this._hlb); var _hop=_hi8(_hlk,_hOo,_hoi-_hOo,this._hlb); var _hOp=_hIh+this._hOi._hlj; var _hlp=_hoi+this._hOi._top; var _hip=_hi8(_hlk,_hoh,_hOp-_hoh,this._hlb); var _hIp=_hi8(_hlk,_hOh,_hlp-_hOh,this._hlb); var _hoq=_hi8(_hlk,_hlh,_hIi-_hlh,this._hlb); var _hOq=_hi8(_hlk,_hih,_hoj-_hih,this._hlb); _hP(_hil,_hIo); _hQ(_hil,_hop); _hR(_hil,_hIm); _hS(_hil,_hon); _hw(_hil,1); _hP(_hIl,_hip); _hQ(_hIl,_hIp); _hR(_hIl,_hoq); _hS(_hIl,_hOq); _hw(_hIl,1); break; }} ,ORD:function (_hlk,_hik){var _hOe=_hO(this._ho9+".zoompanel"); var _hOj=_hF("span","OpacityRender",_hOe); if (_hOj.length>0){if (_hlk<=0 && _hik<0){return; }if (_hlk>=this._hlb && _hik>0){for (var i in _hOj){_hT(_hOj[i],null); }return; }var _hll=_hl7(_hlk,0,100-0,this._hlb); for (var i in _hOj){_hT(_hOj[i],_hll); }setTimeout(this._ho9+".ORD("+(_hlk+_hik)+","+_hik+")",this._hOb/this._hlb); }} ,registerEvent:function (_hlq,_hiq){ this._hIb[_hlq]=_hiq; } ,_hOf:function (_hlq,_hIq){return (_hY(this._hIb[_hlq]))?this._hIb[_hlq](this,_hIq): true; } ,_hl9:function (_hor){var _hOr=_hO(this._ho9+".loading"); if (_hor){var _hlc=_hO(this._ho9); var _hoh=_hi6(_hlc); var _hOh=_hO4(_hlc); var _hlh=_hlc.offsetWidth; var _hih=_hlc.offsetHeight; if (isNaN(_hih) || isNaN(_hlh)){return; }_hH(_hOr,"kivTransparent"); _hw(_hOr,1); _hP(_hOr,0); _hQ(_hOr,0); var _hlr=_hOr.offsetWidth; var _hir=_hOr.offsetHeight; var _hIr=(_hlh-_hlr)/2+_hoh; var _hos=(_hih-_hir)/2+_hOh; _hP(_hOr,_hIr); _hQ(_hOr,_hos); _hg(_hOr,"kivTransparent"); }else {_hw(_hOr,0); }} ,_hOs:function (_hls){if (!this._hOf("OnBeforeImageClick",null))return; if (this._hib=="closed"){ this.open(); } this._hOf("OnImageClick",null); } ,_his:function (_hls){ this._hOf("OnImageMouseOver",null); } ,_hIs:function (_hls){ this._hOf("OnImageMouseOut",null); } ,_hot:function (){if (this._hob){ this._hl9(0); } this._hIf(); if (this._hi9>0){var _hId=_hO(this._ho9+".background"); _hT(_hId,this._hi9); this._hIj(1); } this._hib="opening"; this.DZM(0,1); } ,_hOt:function (){if (!this._hOf("OnBeforeBigImageClick",null))return; this.close(); this._hOf("OnBigImageClick",null); } ,_hlt:function (){if (!this._hOf("OnBeforeBackgroundClick",null))return; this.close(); this._hOf("OnBackgroundClick",null); } ,_hit:function (_hls){if (!this._hOf("OnBeforeCloseButtonClick",null))return; this.close(); this._hOf("OnCloseButtonClick",null); } ,_hIt:function (_hls){ this._hOf("OnZoomPanelMouseOver",null); } ,_hou:function (_hls){ this._hOf("OnZoomPanelMouseOut",null); } ,_hIj:function (_hor){if (this._hi9>0){var _hId=_hO(this._ho9+".background"); if (_hor){var _hOu=_hl2(); var _hlg=_hI1(); var _ho2=(_hOu._ho2>_hlg._ho2)?_hOu._ho2:_hlg._ho2; var _hO2=(_hOu._hO2>_hlg._hO2)?_hOu._hO2:_hlg._hO2; _hR(_hId,_ho2); _hS(_hId,_hO2); _hQ(_hId,0); _hP(_hId,0); _hw(_hId,1); }else {_hw(_hId,0); }}} ,WRS:function (_hls){if (this._hi9>0 && this._hib=="opened"){var _hId=_hO(this._ho9+".background"); _hw(_hId,0); this._hIj(1); }}};function _hIc(_hls){var _hlu=eval("__="+this.id); _hlu._hOs(_hls); }function _hOd(_hls){var _hlu=eval("__="+this.id); _hlu._hIs(); }function _hod(_hls){var _hlu=eval("__="+this.id); _hlu._his(); }function _hid(_hls){var _hlu=eval("__="+_hE(".bigimage","",this.id)); _hlu._hOt(); }function _hld(_hls){var _hlu=eval("__="+_hE(".bigimage","",this.id)); _hlu._hot(); }function _hoe(_hls){var _hlu=eval("__="+_hE(".background","",this.id)); _hlu._hlt(); }function _hie(_hls){var _hlu=eval("__="+_hE(".zoompanel","",this.id)); _hlu._hou(); }function _hle(_hls){var _hlu=eval("__="+_hE(".zoompanel","",this.id)); _hlu._hIt(); }function _hof(_hls){var _hD=_hZ(this ); while (_hL(".zoompanel",_hD.id)<0){_hD=_hZ(_hD); }var _hlu=eval("__="+_hE(".zoompanel","",_hD.id)); _hlu._hit(_hls); }if (typeof(__KIVInits)!="undefined" && _hY(__KIVInits)){for (var i=0; i<__KIVInits.length; i++){__KIVInits[i](); }} <?php exit (); } if (!class_exists("\113ool\111\155age\126\151ew",FALSE)) { function _hO2() { $_hl3=_hO3("\134","/",strtolower($_SERVER["\123CRIPT\137\116AME"])); $_hl3=_hO3(strrchr($_hl3,"/"),"",$_hl3); $_hl4=_hO3("\134","\057",realpath("\056")); $_hO4=_hO3($_hl3,"",strtolower($_hl4)); return $_hO4; } function _hl5($_hO5,$_hl6) { $_hO6=""; foreach ($_hO5->childNodes as $_hl7) { $_hO6.=$_hl6->savexml($_hl7); } return trim($_hO6); } function _hO3($_hO7,$_hl8,$_hO8) { return str_replace($_hO7,$_hl8,$_hO8); } class koolimageview { var $_hl0="\061.3.\060\0561"; var $id; var $styleFolder=""; var $_hl9; var $scriptFolder=""; var $imageUrl=""; var $cssClass=""; var $bigImageUrl=""; var $effect="\172\157om\151\156g"; var $backgroundOpacity=031; var $openTime=0310; var $frameNumber=017; var $_hO9=TRUE; var $description=""; var $zIndex=01750; var $position="\123\103RE\105\116_CE\116\124ER"; var $relativeLeft=0; var $relativeTop=0; var $alternative=""; function __construct($_hla) { $this->id =$_hla; } function loadxml($_hOa) { if (gettype($_hOa) == "\163trin\147") { $_hlb=new domdocument(); $_hlb->loadxml($_hOa); $_hOa=$_hlb->documentElement; } $_hla=$_hOa->getattribute("\151d"); if ($_hla != "") $this->id =$_hla; $_hOb=$_hOa->getattribute("\163tyle\106\157ld\145\162"); if ($_hOb != "") $this->styleFolder =$_hOb; } function render() { $_hlc="\n<!-\055\113oo\154\111ma\147\145Vie\167\040v\145\162si\157\156 ".$this->_hl0."\040- ww\167\056koo\154\160hp\056\156et\040\055->\n"; $_hlc.=$this->registercss(); $_hlc.=$this->renderimageview(); $_hOc= isset ($_POST["__k\157\157laj\141\170"]) || isset ($_GET["\137_kool\141\152ax"]); $_hlc.=($_hOc) ? "": $this->registerscript(); $_hlc.="\074s\143\162ipt\040\164yp\145\075't\145\170t/\152\141va\163\143r\151\160t'\076"; $_hlc.=$this->startupscript(); $_hlc.="</sc\162\151pt>"; return $_hlc; } function renderimageview() { $this->_hld(); $_hOd="\173Big\111\155age\175"; $_hle="Load\151\156g..\056"; $_hOe=""; $_hlf=""; $_hOf="\074img \151\144='\173\151d}' \163\162c=\047\173im\141\147eU\162\154}\047\040a\154\164='\173\141lt\145rna\164\151ve\175\047 \143\154a\163\163=\047\173s\164\171le\175\132o\157\155Ou\164 \173\143\163s\103\154as\163}'/\076<di\166\040c\154ass\075'\173\163\164y\154e}K\111V' \163tyl\145='d\151\163p\154ay:\151nli\156e;'\076\173\154\157a\144\151n\147\175\173\142ac\153gr\157\165n\144\175\173\145ff\145ct\160\141n\145l}\173\145f\146ec\164\151m\141ge\175\173z\157om\160\141n\145l}\074/d\151v>"; $_hlg="<div\040\151d=\047\173id\175\056zo\157\155pan\145\154' \143\154a\163\163='\153\151vZ\157omPa\156el'\040\163t\171\154e=\047dis\160\154a\171\072n\157\156e;\172\055i\156\144e\170\072\173\172Ind\145x};\047>\173\164pl_\172\157o\155\160a\156\145l\175\074/\144\151v\076"; $_hOg="<di\166\040id=\047\173id\175\056lo\141\144in\147\047 c\154\141ss\075'ki\166\114oa\144\151ng\047 st\171\154e=\047\160o\163\151ti\157n:a\142\163ol\165te;\144\151sp\154ay:\156\157ne\073z-i\156\144e\170\072\173\172In\144\145x}\073'>\173\164pl\137loa\144\151n\147}</\144iv>"; $_hlh="\074div i\144\075'\173\151d}.b\141\143kg\162\157und\047 cla\163\163=\047\153iv\102\141ck\147roun\144' s\164\171le\075\047d\151\163p\154\141y:\156\157n\145\073z\055\151n\144\145x:\173\172I\156\144ex\175;'>\173\164p\154\137b\141\143k\147\162ou\156d}<\057div\076"; $_hOh="\074div\040\151d=\047\173id}\056\145ff\145\143tp\141\156el\047\040c\154\141ss\075'kiv\105\146f\145\143tP\141\156el\047 st\171\154e\075\047d\151\163pl\141y:n\157\156e;\160osi\164\151on\072abs\157lut\145\073z\055ind\145\170:\173\172I\156\144ex\175;'>\173tpl\137eff\145ctp\141nel\175\074/\144iv>"; $_hOi="<\151\155g \151\144='\173\151d}.\142\151gim\141\147e'\040clas\163\075'\153\151vB\151gIma\147e' a\154t='\047\057>"; $_hlj="<im\147\040id\075\047\173\151\144}.\145\146fe\143\164im\141\147e'\040clas\163\075'\153\151vE\146\146e\143\164Im\141\147e'\040sty\154\145=\047\144i\163\160la\171\072n\157\156e\073\160os\151tio\156\072a\142sol\165\164e\073\172-\151\156d\145\170:\173\172In\144ex}\073' \141\154t\075''/\076"; $_hOj="\074\163pa\156\040cla\163\163='\153\151vDe\163\143ri\160\164io\156\047>\173\144es\143\162ip\164ion}\074/sp\141\156>"; $_hlk="<a c\154\141ss=\047\153iv\103\154ose\102\165tt\157\156'>\040\074/\141\076"; $_hOk="<a\040\143la\163\163='k\151\166Mo\166\145Bu\164\164on'\076 </a\076"; $_hlb=new domdocument(); $_hlb->load((($this->scriptFolder == "") ? _hO2(): "").$this->_hll()."\057".$this->_hl9."/".$this->_hl9.".xm\154"); $_hlm=$_hlb->getelementsbytagname("\172oompa\156\145l"); if ($_hlm->length >0) { $_hOd=_hl5($_hlm->item(0),$_hlb); } $_hlm=$_hlb->getelementsbytagname("lo\141\144ing"); if ($_hlm->length >0) { $_hle=_hl5($_hlm->item(0),$_hlb); } $_hlm=$_hlb->getelementsbytagname("\142\141ckg\162\157un\144"); if ($_hlm->length >0) { $_hOe=_hl5($_hlm->item(0),$_hlb); } $_hlm=$_hlb->getelementsbytagname("e\146\146ectp\141\156el"); if ($_hlm->length >0) { $_hlf=_hl5($_hlm->item(0),$_hlb); } $_hOm=_hO3("\173id\175",$this->id ,$_hOg); $_hOm=_hO3("\173\164pl_lo\141\144in\147\175",$_hle,$_hOm); $_hOm=_hO3("\173zInd\145\170}",$this->zIndex ,$_hOm); $_hln=_hO3("\173\151d}",$this->id ,$_hlh); $_hln=_hO3("\173t\160\154_ba\143\153gro\165\156d}",$_hOe,$_hln); $_hln=_hO3("\173z\111\156dex\175",$this->zIndex +1,$_hln); $_hOn=_hO3("\173\151d}",$this->id ,$_hOh); $_hOn=_hO3("\173tpl_\145\146fec\164\160ane\154\175",$_hlf,$_hOn); $_hOn=_hO3("\173\172Index\175",$this->zIndex +2,$_hOn); $_hlo=_hO3("\173id}",$this->id ,$_hlj); $_hlo=_hO3("\173\172Index\175",$this->zIndex +3,$_hlo); $_hOo=_hO3("\173\151\144}",$this->id ,$_hOi); $_hlp=_hO3("\173\151d}",$this->id ,$_hlg); $_hlp=_hO3("\173tpl\137\172oom\160\141nel\175",$_hOd,$_hlp); $_hlp=_hO3("\173BigI\155\141ge}",$_hOo,$_hlp); $_hOp=_hO3("\173d\145\163cri\160\164ion\175",$this->description ,$_hOj); $_hlp=_hO3("\173\104esc\162\151pt\151\157n}",$_hOp,$_hlp); $_hlp=_hO3("\173\103\154os\145\102utt\157\156}",$_hlk,$_hlp); $_hlp=_hO3("\173\115oveBu\164\164on\175",$_hOk,$_hlp); $_hlp=_hO3("\173\172Inde\170\175",$this->zIndex +4,$_hlp); $_hlq=_hO3("\173i\144\175",$this->id ,$_hOf); $_hlq=_hO3("\173st\171\154e}",$this->_hl9 ,$_hlq); $_hlq=_hO3("\173\141lter\156\141tiv\145\175",$this->alternative ,$_hlq); $_hlq=_hO3("\173c\163\163Cla\163\163}",$this->cssClass ,$_hlq); $_hlq=_hO3("\173im\141\147eUr\154\175",$this->imageUrl ,$_hlq); $_hlq=_hO3("\173\172oomp\141\156el}",$_hlp,$_hlq); $_hlq=_hO3("\173\154oa\144\151ng}",$_hOm,$_hlq); $_hlq=_hO3("\173bac\153\147ro\165\156d}",$_hln,$_hlq); $_hlq=_hO3("\173eff\145\143tpa\156\145l}",$_hOn,$_hlq); $_hlq=_hO3("\173e\146\146ect\151\155age\175",$_hlo,$_hlq); return $_hlq; } function _hld() { $this->styleFolder =_hO3("\134","\057",$this->styleFolder); $_hOb=trim($this->styleFolder ,"/"); $_hOq=strrpos($_hOb,"\057"); $this->_hl9 =substr($_hOb,($_hOq ? $_hOq: -1)+1); } function registercss() { $this->_hld(); $_hlr="<\163\143rip\164\040ty\160\145='\164\145xt/\152\141va\163\143ri\160t'>\151\146 (\144\157cu\155\145n\164\056ge\164Elem\145ntBy\111d('\137_\173\163\164y\154\145}K\111\126'\051==n\165\154l)\173var\040_he\141\144 \075\040d\157\143u\155\145n\164\056g\145\164E\154eme\156tsB\171Tag\116\141m\145('h\145ad'\051[0]\073va\162\040_\154ink\040= \144\157c\165men\164.c\162\145a\164eEl\145me\156\164(\047li\156\153'\051; \137lin\153.i\144 = \047__\173st\171\154e\175KI\126';_\154in\153.r\145\154=\047st\171le\163he\145\164'\073 \137l\151\156k\056hr\145f=\047\173\163ty\154ep\141th\175/\173\163ty\154e}\057\173\163ty\154e}\056c\163s'\073_h\145ad\056ap\160en\144Ch\151l\144\050\137li\156k)\073}<\057s\143ri\160\164>"; $_hlc=_hO3("\173\163\164yl\145\175",$this->_hl9 ,$_hlr); $_hlc=_hO3("\173style\160\141th}",$this->_hll(),$_hlc); return $_hlc; } function registerscript() { $this->_hld(); $_hlr="<sc\162ipt t\171\160e='\164\145xt\057\152av\141\163cri\160t'>i\146(typ\145\157f\040\137li\142KIV=\075'un\144\145fi\156ed'\051\173d\157\143um\145nt.\167\162ite\050une\163\143a\160\145(\042\0453\103\163c\162\151pt\040typ\145='t\145\170t\057jav\141\163c\162\151p\164' s\162c='\173src\175\047%\063E \045\063C\057sc\162\151p\164\0453\105\042\051);_\154ibK\111V=1;\175 <\057\163c\162ip\164\076"; $_hlc=_hO3("\173s\162\143}",$this->_hls()."\077".md5("js"),$_hlr); return $_hlc; } function startupscript() { $this->_hld(); $_hlr="\166ar \173\151d};\040\146unc\164\151on\040\173id\175\137in\151\164(\051\173 \173id\175\075n\145\167 K\157\157l\111\155ag\145\126i\145\167('\173\151d\175\047,\047\173b\151\147Im\141\147e\125\162l\175\047,\173\163ho\167Loa\144\151\156g}\054\173b\141\143k\147rou\156dOp\141cit\171},'\173eff\145ct}\047,\173\157pen\124im\145\175,\173\146r\141\155e\116umb\145r}\054'\173pos\151ti\157\156}\047,\173\162el\141ti\166\145L\145ft\175\054\173\162e\154\141t\151ve\124op\175\051;\175"; $_hlr.="\151\146 (t\171\160eo\146\050Ko\157\154Im\141ge\126\151ew\051=='\146\165nc\164\151o\156\047)\173\173id\175\137in\151\164(\051\073}"; $_hlr.="\145lse\173\151\146(t\171p\145\157f(\137\137KIV\111\156it\163\051=\075'un\144\145fi\156\145d'\051\173_\137\113IV\111\156i\164\163=n\145w A\162\162ay();\175\040_\137\113IV\111nit\163\056p\165\163h\050\173id\175_in\151\164)\073\173r\145\147i\163\164e\162\137s\143r\151pt}\175"; $_hOs="\151\146(ty\160\145of\050\137lib\113\111V)\075\075'\165\156de\146\151ne\144\047)\173\166ar\040\137h\145\141d \075\040d\157\143um\145nt.\147\145tE\154eme\156\164sBy\124\141g\116\141me\050'he\141\144'\051[0]\073\166a\162\040_\163c\162\151p\164\040=\040doc\165men\164.cr\145ate\105lem\145nt(\047scr\151pt'\051; \137\163c\162i\160t.t\171pe=\047te\170\164/\152ava\163cr\151\160t\047; \137\163c\162ip\164\056s\162c=\047\173\163r\143}';\040_h\145ad\056ap\160\145n\144Ch\151ld(\137sc\162ip\164);\137li\142\113I\126=1\073}"; $_hlt=_hO3("\173src}",$this->_hls()."\077".md5("js"),$_hOs); $_hlc=_hO3("\173\151d}",$this->id ,$_hlr); $_hlc=_hO3("\173st\171\154e}",$this->_hl9 ,$_hlc); $_hlc=_hO3("\173big\111\155ag\145\125rl}",$this->bigImageUrl ,$_hlc); $_hlc=_hO3("\173\163how\114\157ad\151\156g}",($this->_hO9) ? "1": "\060",$_hlc); $_hlc=_hO3("\173back\147\162oun\144\117pac\151\164y}",$this->backgroundOpacity ,$_hlc); $_hlc=_hO3("\173\145ffe\143\164}",$this->effect ,$_hlc); $_hlc=_hO3("\173\157\160enTi\155\145}",$this->openTime ,$_hlc); $_hlc=_hO3("\173\146ram\145\116umb\145\162}",$this->frameNumber ,$_hlc); $_hlc=_hO3("\173pos\151\164ion\175",$this->position ,$_hlc); $_hlc=_hO3("\173\162\145lat\151\166eLe\146\164}",$this->relativeLeft ,$_hlc); $_hlc=_hO3("\173rel\141\164iv\145\124op}",$this->relativeTop ,$_hlc); $_hlc=_hO3("\173\162egist\145\162_sc\162\151pt\175",$_hlt,$_hlc); return $_hlc; } function _hls() { if ($this->scriptFolder == "") { $_hO4=_hO2(); $_hOt=substr(_hO3("\134","/",__FILE__),strlen($_hO4)); return $_hOt; } else { $_hOt=_hO3("\134","\057",__FILE__); $_hOt=$this->scriptFolder.substr($_hOt,strrpos($_hOt,"\057")); return $_hOt; } } function _hll() { $_hlu=$this->_hls(); $_hOu=_hO3(strrchr($_hlu,"/"),"",$_hlu)."/styl\145\163"; return $_hOu; } } } ?> 