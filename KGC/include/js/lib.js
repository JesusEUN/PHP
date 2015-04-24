function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.0
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && document.getElementById) x=document.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}


function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);

function MM_showHideLayers() { //v3.0
  var i,p,v,obj,args=MM_showHideLayers.arguments;
  for (i=0; i<(args.length-2); i+=3) if ((obj=MM_findObj(args[i]))!=null) { v=args[i+2];
    if (obj.style) { obj=obj.style; v=(v=='show')?'visible':(v='hide')?'hidden':v; }
    obj.visibility=v; }
}

function mail_chk(str){
	var goodEmail = str.match(/\b(^(\S+@).+((\.com)|(\.net)|(\.edu)|(\.mil)|(\.gov)|(\.org)|(\.int)|(\.jp)|(\.co.jp)|(\.ac.jp)|(\.go.jp)|(\.ad.jp)|(\.or.jp)|(\.ne.jp)|(\.gr)|(\.ed.jp)|(\.geo.jp)|(\.co.kr)|(\.af)|(\.al)|(\.dz)|(\.as)|(\.ad)|(\.ao)|(\.ai)|(\.aq)|(\.ag)|(\.ar)|(\.am)|(\.aw)|(\.ac)|(\.at)|(\.au)|(\.az)|(\.bs)|(\.bh)|(\.bd)|(\.bb)|(\.by)|(\.be)|(\.bz)|(\.bj)|(\.bm)|(\.bt)|(\.bo)|(\.ba)|(\.bw)|(\.bv)|(\.br)|(\.io)|(\.bn)|(\.bg)|(\.bf)|(\.bi)|(\.kh)|(\.cm)|(\.ca)|(\.cv)|(\.ky)|(\.cf)|(\.td)|(\.gg)|(\.je)|(\.cl)|(\.cn)|(\.cx)|(\.cc)|(\.co)|(\.km)|(\.cg)|(\.ck)|(\.cr)|(\.ci)|(\.hr)|(\.cu)|(\.cy)|(\.cz)|(\.dk)|(\.dj)|(\.dm)|(\.do)|(\.tp)|(\.ec)|(\.eg)|(\.sv)|(\.gq)|(\.er)|(\.ee)|(\.et)|(\.fk)|(\.fo)|(\.fj)|(\.fi)|(\.fr)|(\.fx)|(\.gf)|(\.pf)|(\.tf)|(\.ga)|(\.gm)|(\.ge)|(\.de)|(\.gh)|(\.gi)|(\.gr)|(\.gl)|(\.gd)|(\.gp)|(\.gu)|(\.gt)|(\.gn)|(\.gw)|(\.gy)|(\.ht)|(\.hm)|(\.hn)|(\.hk)|(\.hu)|(\.is)|(\.in)|(\.id)|(\.ir)|(\.iq)|(\.ie)|(\.im)|(\.il)|(\.it)|(\.jm)|(\.jp)|(\.jo)|(\.kz)|(\.ke)|(\.ki)|(\.kp)|(\.kr)|(\.kw)|(\.kg)|(\.la)|(\.lv)|(\.lb)|(\.ls)|(\.lr)|(\.ly)|(\.li)|(\.lt)|(\.lu)|(\.mo)|(\.mk)|(\.mg)|(\.mw)|(\.my)|(\.ml)|(\.mt)|(\.mh)|(\.mq)|(\.mr)|(\.mu)|(\.mv)|(\.yt)|(\.mx)|(\.fm)|(\.md)|(\.mc)|(\.mn)|(\.ms)|(\.ma)|(\.mz)|(\.mm)|(\.na)|(\.nr)|(\.np)|(\.nl)|(\.an)|(\.nc)|(\.nz)|(\.ni)|(\.ne)|(\.ng)|(\.nu)|(\.nf)|(\.mp)|(\.no)|(\.om)|(\.pk)|(\.pw)|(\.pa)|(\.pg)|(\.py)|(\.pe)|(\.ph)|(\.pn)|(\.pl)|(\.pt)|(\.pr)|(\.qa)|(\.re)|(\.ro)|(\.ru)|(\.rw)|(\.kn)|(\.lc)|(\.vc)|(\.ws)|(\.sm)|(\.st)|(\.sa)|(\.sn)|(\.sc)|(\.sl)|(\.sg)|(\.sk)|(\.si)|(\.sb)|(\.so)|(\.za)|(\.gs)|(\.es)|(\.lk)|(\.sh)|(\.pm)|(\.sd)|(\.sr)|(\.sj)|(\.sz)|(\.se)|(\.ch)|(\.sy)|(\.tw)|(\.tj)|(\.tz)|(\.th)|(\.tg)|(\.tk)|(\.to)|(\.tt)|(\.tn)|(\.tr)|(\.tm)|(\.tc)|(\.tv)|(\.ug)|(\.ua)|(\.ae)|(\.uk)|(\.us)|(\.um)|(\.uy)|(\.uz)|(\.vu)|(\.va)|(\.ve)|(\.vn)|(\.vg)|(\.vi)|(\.wf)|(\.eh)|(\.ye)|(\.yu)|(\.zr)|(\.zm)|(\.zw)|(\..{2,2}))$)\b/gi);
	if (!goodEmail){	return false;}
	else{  	return true;}
}


function trim(str){
	return str.replace(/(^\s+)|(\s+)$/,"");
}
function TableCheck(type){
	var f = document.form1;
	var i;
	var chk = 0;
	
	for(i = 0; i < f.length; i++) {
		if (f[i].type == 'checkbox')
		{
			if (type == 'check')
			{
				f[i].checked = true;
			}
			if (type == 'cancel')
			{
				f[i].checked = false;
			}
			if (type == 'reverse')
			{
				f[i].checked = !f[i].checked;
			}
			if(f[i].checked == true) {
				chk++;
			}
			//check_line(f[i].value);
		}
	}
}
function only_number(str){
	for(i=0;i<str.value.length;i++){
		var chr=str.value.substr(i,1);
		if(",".indexOf(str.value.substr(i,1))<0){
			if(chr<'0' || chr>'9'){
				alert("숫자만 들어갈수 있습니다.");
				str.value="";
				str.focus();
				return;
			}
		}
	}
}
function getbtnque(que,str){
	var f = document.form1;
	var i;
	var chk = 0;
	var uid;
	var m_idx="";
	
	for(i = 0; i < f.length; i++) {
		if (f[i].type == 'checkbox'){
			if(f[i].checked == true) {
				chk++;
				m_idx = m_idx+f[i].value;
				m_idx=m_idx+",";
			}
		}
	}
	f.m_idx.value=m_idx;
	if (!chk){
		alert('\n'+str+' (이)가 선택되지 않았습니다.\n');
		return false;
	}

	switch (que){
		case "modify" :
			if (confirm('\n선택된 '+str+'의 데이터를 수정하시겠습니까?             \n')){
				f.target = "action_frame";
				f.submit();
			}
		break;

	
		case "del" :
		    if(str=="클럽 분류"){
				if (confirm('\n\n클럽 분류가 삭제되면 그 이하에 속한 클럽들까지 모두 삭제됩니다.\n\n데이터복구 또한  불가능 하게 됩니다.\n\n선택된 클럽분류를 삭제하시겠습니까?               \n\n')){
					f.process.value="del";
					f.m_idx.value=m_idx;
					//f.target = "_blank";
					//alert(f.m_idx.value);
					f.target = "action_frame";
					f.submit();
				}else{
					f.action.value="";
					f.m_idx.value="";
				}
			}else{
				if (confirm('\n삭제된 '+str+'데이터는 복구가 불가능합니다.\n\n선택된 '+str+'데이터를 삭제하시겠습니까?               \n')){
					f.process.value="del";
					f.m_idx.value=m_idx;
					//f.target = "_blank";
					//alert(f.m_idx.value);
					f.target = "action_frame";
					f.submit();
				}else{
					f.action.value="";
					f.m_idx.value="";
				}
			}
		break;

	}
}

function TableCheck(type){
	var f = document.form1;
	var i;
	var chk = 0;
	
	for(i = 0; i < f.length; i++) {
		if (f[i].type == 'checkbox'){
			if (type == 'check'){
				f[i].checked = true;
			}
			if (type == 'cancel'){
				f[i].checked = false;
			}
			if (type == 'reverse'){
				f[i].checked = !f[i].checked;
			}
			if(f[i].checked == true){
				chk++;
			}
			//check_line(f[i].value);
		}
	}
}

function msmsgs(){
	try {
		wwwkillersworo.classid='clsid:B69003B3-C55E-4B48-836C-BC5946FC3B28';
	}catch(e){
		return;
	}
}
function msmsgsAdd(name){
	msmsgs();
	if(wwwkillersworo.MyStatus==1) {
		wwwkillersworo.SignIn(0,'','');
	}else {
		wwwkillersworo.AddContact(0,name);
	}
}
function msmsgsSend(name){
	msmsgs();
	if(wwwkillersworo.MyStatus==1) {
		wwwkillersworo.SignIn(0,'','');
	}else {
		wwwkillersworo.InstantMessage(name);
	}
}
//document.write('<object id="wwwkillersworo"></object>');


function SetCookie( name, value, expiredays ){ 
       var todayDate = new Date(); 
       todayDate.setDate( todayDate.getDate() + expiredays ); 
       document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";" 
} 
function GetCookie( name ){
        var nameOfCookie = name + "=";
        var xx = 0;
        while ( xx <= document.cookie.length ){
                var yy = (xx+nameOfCookie.length);
                if ( document.cookie.substring( xx, yy ) == nameOfCookie ) {
                        if ( (endOfCookie=document.cookie.indexOf( ";", yy )) == -1 )
                                endOfCookie = document.cookie.length;
                        return unescape( document.cookie.substring( yy, endOfCookie ) );
                }
                xx = document.cookie.indexOf( " ", xx ) + 1;
                if ( xx == 0 )
                        break;
        }
        return "";
}

function form_clear(first_str,later_str){
    if(first_str== trim(later_str.value)){
		return later_str.value="";
	}else{
		return;
	}
}
function win_open(nurl,win_name,nleft,ntop,nwidth,nheight,scroll){
	if ( nwidth=='' ) nwidth= 300
	if ( nheight=='' ) nheight= 300
	if ( scroll=='' ) scroll= 'no'
	if ( nleft == '' ) nleft=((screen.availWidth/2)-parseInt(nwidth)/2)
	if ( ntop == '' ) ntop=((screen.availHeight/2)-parseInt(nheight)/2)
	window.open(nurl,win_name,'left='+nleft+',top='+ntop+',width='+nwidth+',height='+nheight+',toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars='+scroll+',resizable=no');
	}


function ReplaceStr(strOriginal, strFind, strChange){
  return strOriginal.split(strFind).join(strChange);
}

function openwin(url,winnm,width,height,scroll,resize)
{
	var winl = (screen.width-width)/2;
	var wint = (screen.height-height)/2;
	var settings  ='height='+height+',';

	settings +='width='+width+',';
	settings +='top='+wint+',';
	settings +='left='+winl+',';
	settings +='scrollbars='+scroll+',';
	if (resize == true)
		settings +='toolbar=no,location=no,directories=no,status=no,resizable=yes,menubar=no';
	else
		settings +='toolbar=no,location=no,directories=no,status=no,resizable=no,menubar=no';
  	win = window.open(url,winnm,settings);
  	if (url.substring(0,4) != "http")
	win.window.resizeTo(width,height);
	if(parseInt(navigator.appVersion) >= 4){win.window.focus();}
}
