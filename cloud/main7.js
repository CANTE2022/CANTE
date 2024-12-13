var jkjsq=0;var tcxk="T";var Qzydz="";
var myTree = new tree();
var Q = {
    a: false, mlbh: -1, flid: "", llcx: "0", ckbh: "0", wg: false, lybj: { bh: "", tp: "", gk: "" }, bjlx: "",
    bjts: { o: null, bh: function(ro) { this.qx(); this.o = ro; this.o.style.border = "2px solid red"; }, qx: function() { if (!!this.o) { this.o.style.border = "0"; ; this.o = null; } } },
    fl_mc: function() { if (Q.flid == "") return ""; return Q.flid.split("_")[2] },
    mlxz: function(rbh) { if (Q.mlbh == rbh) return; Q.mlbh = rbh; Q.flid = ""; if (rbh >= 0) { qhzml(3); } else { if ($("ml_" + 3).style.display == "block") { qhzml(2); } } }
}
var _CK = {
    glts: { mc: "glts", w: 260, h: 125 },
    yzck: { mc: "yzck", w: 300, h: 220, z: { a: "" }, wz: [180, 150] },
    bj: { mc: "bj", w: 255, h: 180 },
    qxsm: { mc: "qxsm", w: 300, h: 200 },
    mmrz: { mc: "mmrz", w: 264, h: 310 },
    mmsz: { mc: "mmsz", w: 300, h: 350, z: ["", false], wz: [180, 150] },
    scjd: { mc: "scjd", w: 360, h: 130 },
    zxlb: { mc: "zxlb", w: 350, h: 250, size: true },
    addd: { mc: "addd", w: 350, h: 150, size: true },
    xzlb: { mc: "xzlb", w: 700, h: 430, size: true },
    zxtp: { mc: "zxtp", w: 750, h: 600, size: true },
    wjsc: { mc: "wjsc", w: 620, h: 300, size: true },
    wgts: { mc: "wgts", w: 250, h: 160 }
}
function tree(){this.branches = new Array();this.add = addBranch;}
function addBranch(branch){this.branches[this.branches.length] = branch;}
function branch(id) {
    this.id = id; this.text = ""; this.sj = new Date().getTime(); this.fsj = ""; this.llcx = "0"; this.xkck = true; this.xksc = true; this.xkxz = true; this.scpz = "";
    this.cssj = function() { this.sj = new Date().getTime(); var M = new ML(this.id); this.xkck = M.xkck(); this.xksc = M.xksc(); this.xkxz = M.xkxz(); }
    this.cs = function() { var sjc = new Date().getTime() - this.sj; sjc = Math.round(sjc / 60 / 1000); if (sjc > 50) { return true; } else { return false; } }
}

function findml(mlbh){var i=-1;for (var j=0;j<myTree.branches.length;j++){if (myTree.branches[j].id==mlbh){i=j;break;}}return i;}
function readxml(cz, z1, z2, z3, z4) {
    if (!Qcxzt) { alert(C.m0); return; } 
    var dobj=Rx();if (!dobj) return;
    Qcxzt = false;
    dobj.Yz0.value = cz; dobj.Yz1.value = z1; dobj.Yz2.value = z2; dobj.Yz3.value = z3; dobj.Yz4.value = z4;
    setTimeout("frxcx.document.forms[0].submit();", 100); return;
}
function Rx() {
    try {var ox = frxcx.document.forms[0].Yz0 } catch (error) { alert(C.m0); return false; } finally { }
    return frxcx.document.forms[0];
}

function ML(mlbh) {
    if (mlbh == "") mlbh = Q.mlbh;    var _t = this;    _t.bh = mlbh;    _t.oM = $("ZMm_" + _t.bh);    _t.oP = _t.oM.parentNode;    _t.mmcd = _t.oP.id.split("_")[1].split("|")[0];    _t.sx = _t.oP.id.split("|")[1];
    _t.jl = function() { var n1 = findml(_t.bh); if (n1 == -1) return null; return myTree.branches[n1]; }
    _t.xkxz = function() { if (Q.a) return true; if (_t.mmcd == 0) return true; if (!_rz.jc(_t.bh)) return (_t.sx.substr(5, 1) == 1); if (_rz.jc(_t.bh)) return (_t.sx.substr(2, 1) == 1); return true; };
    _t.xkck = function() { if (Q.a) return true; if (_t.mmcd == 0) return true; if (_t.sx == "000000") return false; if (!_rz.jc(_t.bh)) return (_t.sx.substr(3, 1) == 1); return true; };
    _t.xksc = function() { if (Q.a) return true; if (_t.mmcd == 0) { if (!dxksc) { return false; } return true; }; if (_rz.jc(_t.bh)) { if (_t.sx.substr(1, 1) != 1) { return false; } return true; }; if (_t.sx.substr(4, 1) != 1) { return false; }; return true; };
    _t.xkadd = function(tzpd) {
        if (FFGQPD == "1") { if (tzpd) alert(C.q2); return false; }
        if (!!document.getElementById("Tj_" + _t.bh)) { if ($("Tj_" + _t.bh).innerHTML > xdwjsl) { if (tzpd) alert(C.w1); return false } }
        if (Q.a) return true; if (Qzdqbh == _t.bh) { if (tzpd) alert(C.q1); return false; }; if (_t.mmcd == 0) { if (!dxksc) { if (tzpd) alert(C.q3); return false; } return true; };
        if (_rz.jc(_t.bh)) { if (_t.sx.substr(1, 1) != 1) { if (tzpd) alert(C.q4); return false; } return true; }; if (_t.sx.substr(4, 1) != 1) { if (tzpd) alert(C.q5); return false; }
        return true;
    }
    _t.xkbj = function() { if (Q.a) return true; if (_t.mmcd == 0) { alert(C.q6); return false; }; if (_rz.jc(_t.bh)) { if (_t.sx.substr(0, 1) != 1) { alert(C.q7); return false } return true; }; alert(C.q8); return false; };
}
var _rz = { mlbh: 0, sx: "", rzjl: "",
    jl: function(rbh) { var s1 = "[" + rbh + "]"; if (this.rzjl.indexOf(s1) < 0) this.rzjl += s1; },
    jc: function(rbh) { return (this.rzjl.indexOf("[" + rbh + "]") >= 0); },
    clear: function() { if (_CK.mmrz.zt) { if (_CK.mmrz.ck.style.display == "block") _CK.mmrz.gb(); } },
    kq: function(rmlbh, rsx) {
        this.mlbh = rmlbh; this.sx = rsx;
        $("ZMm_" + this.mlbh).parentNode.style.backgroundColor = "#F8C7C9";
        //this.kqpd = true;
        var h1 = (this.sx.substr(3, 3) == "000") ? "220" : "310";
        if (_CK.mmrz.zt) { _CK.mmrz.ck.childNodes[1].style.height = h1 + "px"; } else { _CK.mmrz.h = h1; }
        _C.kq(_CK.mmrz);
        _CK.mmrz.gb = function() { _CK.mmrz.ck.style.display = "none"; $("ZMm_" + _rz.mlbh).parentNode.style.backgroundColor = "#FFFFFF"; };
    }
}

function mlkq(ro) {
    ro.blur();
    var mlbh = _m.qdmlbh(ro);
    _rz.clear();
    
    var M = new ML(mlbh);
    if (M.oM.style.display == "block") { M.oM.style.display = "none"; Q.mlxz(-1); return; }
    if (!Q.a && M.mmcd != 0) {
        if (M.sx == "000000") { alert(C.q9); return; }
        if (M.sx.substr(0, 3) != "000") {
            _rz.kq(mlbh, M.sx);
            return;
         }
    }
    mlkq_x(mlbh); return;
}
function mlkq_x(mlbh) {
    var mllb = $("menuList"); var M = new ML(mlbh); Q.mlxz(mlbh); var dobj; 
    for (var j = 0; j < mllb.childNodes.length; j++) { dobj = mllb.childNodes[j].lastChild; if (dobj.style.display == "block") { if (dobj.id != M.oM.id) { dobj.style.display = "none"; break; } } }
    var adpd = M.xkadd(false);
    fxk("filesc2", adpd);fxk("bulj", adpd); fxk("buzml", adpd);;
   
    //upf_0.document.forms[0].f.disabled = (adpd) ? "" : "true";
    if (M.jl()) {
        var xj = M.jl();
        if (M.xkck() == xj.xkck && M.xksc() == xj.xksc && M.xkxz() == xj.xkxz && Q.llcx == xj.llcx && !xj.cs()) {
            if (M.oM.innerHTML == "") { M.oM.innerHTML = xj.text; };
            mlxs(mlbh);  M.oM.style.display = "block"; return;
        }
    }
    M.oM.innerHTML = "<li class='lxts'><span class='s3'>" + C.x1 + "</span></li>";
    M.oM.style.display = "block";
    
    readxml("dq", mlbh, "", "", "");
}
function mlxs(mlbh) {
    var js = 0;
    var M = new ML(mlbh);
    if (M.xkck() == false) return;
    var objml = M.oM;
    if (objml.innerHTML == "") objml.innerHTML = tjzf(mlbh);
    for (var j = 0; j < objml.childNodes.length; j++) {
        dobj = objml.childNodes[j];
        if (dobj.lastChild.className != "menu") { js += 1; continue; }
        js += dobj.lastChild.childNodes.length;
        if (dobj.lastChild.style.display == "block") dobj.lastChild.style.display = "none";
    }
    if (Q.flid != "") {
        if (Q.flid.split("_")[1] == mlbh) {
            if (document.getElementById(Q.flid)) {
                $(Q.flid).style.display = "block";
                _zml.jcts(Q.flid);
            } else {Q.flid = ""; }
         } else {Q.flid = ""; }
    }
    if (document.getElementById("Tj_" + mlbh)) $("Tj_" + mlbh).innerHTML = js - 1;
    
}

function checkfu() {
    var M = new ML("");
    if (!M.xkadd(true)) return;
    var Sbt = zfaq(scbt2.value); var Sdz = zfaq(teljdz.value);
    if (Sbt == "") { alert(C.w3); return false; }
    if (Sdz == "") { alert(C.w4); return false; }
    if (Sdz.length > 200) { alert(C.w5); return false; }
    if (Sdz.indexOf("://") < 0) { if (confirm(C.w6)) { } else { return false; } }
    readxml("xzlj", Sbt, Sdz, Q.mlbh, Q.fl_mc());
}
function mldq(mlbh) {
    var xdobj = Rx(); if (!xdobj) return; var mdnr = $("ZMm_" + mlbh); var j = findml(mlbh); var dbra;
    if (j != -1) { dbra = myTree.branches[j] } else { dbra = new branch(mlbh); myTree.add(dbra); }
    var s1 = xdobj.Yz1.value; var n1 = s1.indexOf("|"); if (n1 < 0) { alert(mlbh); alert(C.m91); return; }
    var ar1 = s1.substr(0, n1).split(","); if (ar1.length != 3) { alert(C.m91); return; }
    Q.llcx = ar1[0]; dbra.cssj(); dbra.llcx = ar1[0]; dbra.fsj = ar1[1]; dbra.scpz = ar1[2]; dbra.text = s1.substr(n1 + 1);
    if (dbra.xkck) dbra.text += tjzf(mlbh); mdnr.innerHTML = dbra.text; mlxs(mlbh);
/*    if (mlbh == Qzdqbh) { $("idzdy").style.display = "block"; $("zdy_wz0").style.display = "block"; Qzdy.kq() }
*/}
function tjzf(mlbh) {
    var s1 = "<li class='lxts'><span class='s1'>" + C.g3 + ":<font id='Tj_" + mlbh + "'>" + 0 + "</font></span>";
    s1 += "&nbsp;<a style='color:#999966;' href='javascript:' onclick='sxmldq(" + mlbh + ")'>[" + C.g4 + "]</a></li>";
    return s1;
}
function qhzml(x) {
    var dobj = $("mm" + x);
    if (dobj.className == "ysm1" && dobj.style.display == "block") return;
    if (x == 3) { if (Q.mlbh == -1) { alert((dxken) ? "Please first select a directory" : "请在右边选择一个目录再上传文件！"); return; } }
    for (i = 1; i <= 4; i++) { $("mm" + i).className = "ysm0"; }
    dobj.className = "ysm1";
    for (i = 1; i <= 4; i++) $("ml_" + i).style.display = "none";
    $("ml_" + x).style.display = "block";
}
function zmlkq(ro) {
    var menu = ro.parentNode.lastChild;
    var display = menu.style.display;
	
	if(display=="block"){
		zhbds="";
	}else{
		zhbds=menu.id.split("_")[2];
	}
	//alert(zhbds+"__");
    menu.style.display = (display == "block") ? "none" : "block";
    //telb.value = (display == "block") ? "" : ro.parentNode.childNodes[1].innerHTML;
    Q.flid = (display == "block") ? "" : menu.id;
	//alert(aaa);
    if (display == "block") return;
    if (wjlx1.checked == true) { changelx(1) } else { changelx(2) }
    var objml = menu.parentNode.parentNode;
    for (var j = 0; j < objml.childNodes.length; j++) {
        dobj = objml.childNodes[j];
        if (dobj.lastChild.className == "menu") {
            dobjx = dobj.lastChild;
            if (dobjx != menu && dobjx.style.display == "block") {
                dobjx.style.display = "none";
            }
        }
    }
    return;
}
function sxmldq(mlbh){if(confirm(C.w7)){readxml("dq",mlbh,"","","");	return;}}
function sxmldq1(mlbh){readxml("dq",mlbh,"","","");return;}

var _zml = {
    jcts: function(rid) {
        var ob1 = $(rid);
        if (ob1.childNodes.length > 0) {
            if (ob1.lastChild.className == "lxts") ob1.removeChild(ob1.lastChild)
        } else { ob1.innerHTML = "<li class='lxts'><span class='s1' style='font-weight:bold;color:red;'>" + C.z2 + "</span></li>"; }
    },

    cj: function() {
		
        var M = new ML(""); if (!M.xkadd(true)) return false;
        zhbd = zfaq(tezml.value);
        if (this.jc(zhbd) != "") { alert(this.jc(zhbd)); return false; }
        zhbd = vreplace(zhbd, " ", ""); zhbd = vreplace(zhbd, "&", "*");
        zmlid = "z_" + Q.mlbh + "_" + zhbd;
        if (!!document.getElementById(zmlid)) { alert(C.z1); return false; }
        var dzml = "<img src='" + Qzydz + "/images/mlgk.gif' id='" + zmlid + "_i" + "' onclick='_fbj.tj(this)'>";
        dzml += "<a href='javascript:' onclick='zmlkq(this);'>" + zhbd + "</a>";
        dzml += "<ul id='" + zmlid + "' class='menu' >";
        dzml += "</ul>"
		zhbds=zhbd+"";
        var newNode = document.createElement("li");
        var objml = $("ZMm_" + Q.mlbh);
        objml.insertBefore(newNode, objml.childNodes[0]);
        objml.childNodes[0].innerHTML = dzml;
        this.jcts(zmlid);
        Q.flid = zmlid;
        $("tezml").value = "";
        wjlx1.checked = true; changelx(1);
        zmlkq($(zmlid));
       
    },
    jc: function(x1) {
        if (x1 == "") return (dxken) ? "The Child folder name cannot for be spatial!" : "子目录名称不能为空！";
        var _zfpd = "_#+?/%&\\<>\'";
        for (i = 0; i <= _zfpd.length - 1; i++) {
            if (x1.indexOf(_zfpd.substr(i, 1)) >= 0) { return "子目录名称不得含有字符 " + _zfpd.substr(i, 1); }
        }
        if (x1.length > 50) return "子目录名称长度不能超过50个字符！"; return "";
    }


}
function addsj(mlbh) {
    var xdobj = Rx();if (!xdobj) return;
    var mbml;
    if (xdobj.Yz2.value != "") {
        var fmlid = "z_" + mlbh + "_" + xdobj.Yz2.value;
        if (document.getElementById(fmlid)) { mbml = $(fmlid) } else { mbml = $("ZMm_" + mlbh); };
    } else {
        mbml = $("ZMm_" + mlbh);
    }
    var newNode = document.createElement("li");
    mbml.insertBefore(newNode, mbml.childNodes[0]);
    mbml.childNodes[0].innerHTML = xdobj.Yz1.value;
    mbml.childNodes[0].childNodes[0].onclick = function() { _fbj.tj(this); }
    if (mbml.id.split("_")[0] == "z") _zml.jcts(mbml.id);
    var j = findml(mlbh); var dbra = myTree.branches[j];
    dbra.text = $("ZMm_" + mlbh).innerHTML;
    dbra.fsj = xdobj.Yz4.value;
    scbt2.value = ""; teljdz.value = ""; mlxs(mlbh); if (mlbh == Qzdqbh) Qzdy.kq();
}
function fxwj(ro) {var fh = { bh: "", wjm: "", bz: "", kzm: "", dz: "", kqzf: "" };fh.bh = ro.parentNode.childNodes[0].id.split("_")[1];fh.wjm = ro.parentNode.childNodes[1].innerHTML;
    fh.dz = ro.parentNode.childNodes[1].href;var n1 = fh.wjm.lastIndexOf(" ");fh.wjm = fh.wjm.substr(0, n1);fh.kzm = fh.wjm.substr(fh.wjm.lastIndexOf(".") + 1).toLowerCase();
    if (ro.parentNode.childNodes[2].className == "yyck") {fh.bz = ro.parentNode.childNodes[3].innerHTML;fh.kqzf = ro.parentNode.childNodes[2].innerHTML;} else {fh.bz = ro.parentNode.childNodes[2].innerHTML;    }
    return fh;    
}

var _m = {
    jlid: "", jlsx: "", jlmm: "", sBt: "", sSm: "", sMm: "", xzbh: "", xzxx: "",
    xs: function() {
        var omm = document.getElementById("menuList");
        var obj1 = Rx(); if (!obj1) return;
        omm.innerHTML = obj1.Yz3.value;
        for (var i = 0; i < omm.childNodes.length; i++) {
            if (omm.childNodes[i].childNodes.length > 2) {
                omm.childNodes[i].childNodes[0].onclick = function() { _CK.qxsm.o = this; _C.kq(_CK.qxsm); }
                omm.childNodes[i].childNodes[1].onclick = function() { _m.b(this); }
                omm.childNodes[i].childNodes[2].onclick = function() { mlkq(this); }
            }
        }
        if (this.xzbh != "") {
            var b1 = this.xzbh; var a1 = this.xzxx.split(",");
            this.xzbh = ""; this.xzxx = "";
            if (a1.length != 3) { alert("新增目录数据有误！"); return; }
            var xb = new branch(b1);
            xb.cssj(); xb.llcx = a1[0]; xb.fsj = a1[1]; xb.scpz = a1[2]; xb.text = tjzf(b1); myTree.add(xb); Q.llcx = a1[0];
            var M = new ML(b1);
            if (M.mmcd == 0) { Q.mlxz(b1); } else { Q.mlxz(-1); }
        }
        if (Q.mlbh == -1) { qhzml(1); } else { mlkq_x(Q.mlbh); }
        if (Qzdqbh < 0) {
/*            $("idzdy").style.display = "none";
            if ($("idzdy1").style.display == "none") $("zdy_wz0").style.display = "none";
*/        }
    },
    cxdq: function() { readxml("ml_dq", "", "", "", ""); },
    cxdq1: function() { alert("需要重新读取目录数据"); _m.cxdq(); },
    b: function(ro) {
        var mlbh = this.qdmlbh(ro);
        if (!Q.a && ro.parentNode.childNodes[4].className != "yybj") { alert(C.m1); return; }
        this.jlid = mlbh;
        Q.bjts.bh(ro.parentNode.childNodes[2]);
        Q.bjlx = "m";
        _C.kq(_CK.bj)

    },
    add: function(mlbh, rxx) { this.xzbh = mlbh; this.xzxx = rxx; bdbt.value = ""; $("bdmlmm").value = ""; },
    tj2: function() { readxml("xzml", this.sBt, this.sSm, $("bdmlmm").value, _CK.mmsz.z[0]); },
    tj: function() {
        if (_CK.bj.zt) { _CK.bj.gb(); }

        if ($("bdmlmm").value != "") {
            if (zfaq($("bdmlmm").value) != $("bdmlmm").value) {
                alert("目录密码含有非法字符！");
                return;
            }
        }
        if (!dxkbt && !Q.a) { alert(C.m3); return false; };
        this.sBt = zfaq($("bdbt").value);
        this.sSm = zfaq($("bdsm").value);
        if (this.sBt == "") { alert(C.m4); return false; };
        if ($("bdmlmm").value.length > 15) { alert(C.m5); return false; }
        //qxck.jlxz = "011000";
        _CK.mmsz.z[0] = "011000";
        if ($("bdmlmm").value != "") {
            //qxck.kq(false);
            _CK.mmsz.z[1] = false; _C.kq(_CK.mmsz); return;
        }
        this.tj2();
    },
    qdmlbh: function(ro) { return ro.parentNode.id.split("_")[0].substr(1); }
}
var _fbj = {
    id0: "", lx: "", ml0: "", ob: null,
    tj: function(ro) {
        this.ob = ro;
        this.id0 = ro.parentNode.childNodes[0].id;
        this.lx = this.id0.split("_")[0];
        this.ml0 = ro.parentNode.parentNode.id.split("_")[1];
        if (this.lx == "z" && !Q.a) { alert("子目录需管理员登录后才能编辑"); return; }
        if (this.lx != "z") {if (ro.parentNode.childNodes[ro.parentNode.childNodes.length - 1].className != "yybj") { var M = new ML(this.ml0); if (!M.xkbj()) return; } }
        Q.bjts.bh(ro.parentNode.childNodes[1]);
        Q.bjlx = this.lx;
        _C.kq(_CK.bj);
    }
}
function f_check(wjm) {
    var s1 = _fup.fkzm(wjm); if (s1 == "") return "文件名须带扩展名";
    if (s1.length > 10) return "文件扩展名不能超过１０个字符";
    var ar = ["%","&", "#", "..", "+", "\\", "://", "\'", ",", "<", ">", "?"];
    for (i = 0; i <= ar.length - 1; i++) { if (wjm.indexOf(ar[i]) >= 0) { return "文件名中不能含有 " + ar[i]; } }
    if (wjm.length > 100) return "文件名不能超过100个字符"; return "";
}


function f_kzm(a){var x1=a.lastIndexOf(".");if (x1<=0) return "";return a.substr(a.lastIndexOf(".")).toLowerCase( );}
function changelx(pd) {
    if ($("idwj" + pd).style.display == "block") return;
    for (var i = 1; i <= 3; i++) { $("idwj" + i).style.display = "none" }
    $("idwj" + pd).style.display = "block";
    if (pd == 3) $("tezml").focus();
    if (pd == 2) $("scbt2").focus();
    if (pd == 1) $("filesc2").focus();
}
function zfaq(str) {
    str = vreplace(str, "'", "’"); str = vreplace(str, "\"", "|"); str = vreplace(str, "<", "《"); str = vreplace(str, ">", "》");
    str = vreplace(str, "&#", "*");
    return str;
}
function vreplace(z1, z2, z3) { jgzz = z1.replace(new RegExp(z2, "g"), z3); return jgzz; }
function show(ro) {
    var fx1 = fxwj(ro);
    var lx = fx1.kqzf;
    var bh = fx1.bh;
    var kzm = "." + fx1.kzm;
    var wjm = fx1.wjm;
    var wdz = fx1.dz;
    if (lx == "查看" || lx == "View") {
        Q.ckbh = bh;
        //_C.kq(_CK.zxtp);
        x = window.open(Qzydz + "/ck/show_tp.htm", duser + "ys168_1", "width=750,height=" + (600) + ",toolbar =no, menubar=no, scrollbars=yes, resizable=yes, location=no, status=yes");
        x.focus();
    }
    if (lx == "播放" || lx == "Play") {
        x = window.open(Qzydz + "/ck/show_sp.aspx?wdz=" + wdz, "ys168_2", "width=355,height=" + (288) + ",toolbar =no, menubar=no, scrollbars=yes, resizable=yes, location=no, status=yes");
        x.focus();
    }
    if (lx == "打开" || lx == "Open") { x = window.open(wdz, duser + "ys168_3" + bh, "width=600,height=450,toolbar =no, menubar=no, scrollbars=yes, resizable=yes, location=no, status=yes"); x.focus(); }
    if (x == null) { alert("由于您的浏览器禁止了弹出窗口，不能进行在线观看！"); return false; }
}
function glyqxjy(rzt) { if (Q.a != rzt) { Q.a = rzt; glyqxjy(); } };

function glyqxkz() {
    var sglmc = C.g2;
    if (Q.a) {
        _C.kq(_CK.glts);
        if (Q.wg) { _C.kq(_CK.wgts); }
        _rz.clear(); bdglymm.value = "";
        glyq1.style.display = "none";
        glyq2.style.display = "block";
        document.getElementById("mm4").innerHTML = sglmc + "<font color='green'>√</font>";
    } else {
        $("glyq1").style.display = "block"; $("glyq2").style.display = "none";
        document.getElementById("mm4").innerHTML = sglmc; if (_CK.glts.zt) _CK.glts.gb();
    } buqx();
    if (Q.mlbh >= 0) { var M = new ML(""); if (M.jl()) { var t = M.jl(); if (M.xkck() != t.xkck || M.xksc() != t.xksc || M.xkxz() != t.xkxz) { readxml("dq", Q.mlbh, "", "", ""); } } }
}
function buqx() {
    if (!document.getElementById("buxz")) return;if (Q.a) {
        fxk("buly", true); fxk("sutjbt", true); fxk("buxz", true); fxk("filesc2", true); fxk("bulj", true); fxk("buzml", true); lyxkzt(true);
    } else {
        fxk("sutjbt", dxkbt); fxk("buxz", dxkjl); lyxkzt(dxkly);
        if (Q.mlbh >= 0) { var M = new ML(""); fxk("filesc2", M.xkadd(false)); fxk("bulj", M.xkadd(false)); fxk("buzml", M.xkadd(false)); } 
        else { fxk("filesc2", dxksc); fxk("bulj", dxksc); fxk("buzml", dxksc); }
    }
}
//-------
var Qdhrs = ""; Qlyfyxx = ""; var lygxpd = "0";
var Qzdy = { zt: false, kq: function() { if (!this.zt) { this.zt = true; var s1 = "<iframe id='I_zdyja' src='" + Qzydz + "/ck/zdy_dy.htm' style='display:none'></iframe>"; var e1 = document.createElement('div'); document.body.appendChild(e1); e1.innerHTML = s1; } else { I_zdyja.zdqdq(); } } };
function lyxkzt(rxk) { var onr = $("nr"); if (!rxk) { fxk("buly", false); onr.readOnly = true; if (onr.value == "") { onr.value = "未开放访客留言权限" }; onr.style.color = "#696969"; } else { fxk("buly", true); onr.readOnly = false; onr.style.color = "blue"; if (onr.value == "未开放访客留言权限") { onr.value = "" }; } }
function fxk(rid, rzt) { $(rid).style.textDecoration = (rzt) ? "none " : "line-through"; 
if((rzt)){
document.getElementById("filesc2").onclick = function(){_C.kq(_CK.wjsc);}
}else{
document.getElementById("filesc2").onclick = function(){}
}

}; function lyfy(ro, rfyxx) { ro.disabled = "true"; readxml("lyb_dq", rfyxx, "", "", ""); }
function Lyb_xs() { var ob1 = Rx(); if (!ob1) return; $("lynr").innerHTML = ob1.Yz4.value; try { var ryz0 = ob1.Yz0.value; if (ryz0 != "lyxg" && ryz0 != "lysc") { $("lynr").scrollTop = 0; } } catch (error) { } finally { } }
function checkly(ryzm) {
    if (!Q.a && dxkly == 0) { if (dxkly == 0) { alert(C.l1); return false; }; };
    if ($("bdgkpdlyb").checked) {
        if (!Q.a && dxkly == 2) {
            if (!confirm(C.l4)) { return false; };
            $("bdgkpdlyb").checked = false;
        };
    };
    var sxm = zfaq($("xm").value);
    var snr = zfaq($("nr").value);
    if (sxm == "") { alert(C.l2); return false };
    if (snr == "") { alert(C.l3); return false };
    if (snr.length > 1000) { alert("留言内容长度不能超过1000个字符！"); return false; };
    var cz1 = (($("bdgkpdlyb").checked) ? "n" : "y") + $("bdbq").value;
    if (Q.a && $("bdgkpdlyb").checked == false) { alert("由于您已经在管理区登录，不公开的留言也可以查看，\n\n如要查看效果，请在管理区退出"); }
    readxml("lytj", cz1, sxm, snr, ryzm);
}

function lyxg2(ro) { ro.parentNode.childNodes[0].click(); }
function lyxg(bh, tp, gk) { if (!Q.a && $("Xm_" + bh).nextSibling.className != "yybj") { alert("管理员在空间管理区登录后才能编辑此项数据！"); return; }; if (gk == "y" && !Q.a) { alert("只有管理员登录后才能修改不公开的留言"); return; }; Q.lybj.bh = bh; Q.lybj.tp = tp; Q.lybj.gk = gk; Q.bjts.bh($("Nr_" + bh).parentNode); Q.bjlx = "l"; _C.kq(_CK.bj); return; }
function changetp(pd) {if (pd == "z") { bdbq.value = ++bdbq.value; } if (pd == "y") { bdbq.value = --bdbq.value; }; if (bdbq.value < 0) { bdbq.value = 9; } if (bdbq.value > 9) { bdbq.value = 0; } document.images['t_bq'].src = Qzydz + "/images/f" + bdbq.value + ".gif"; }
function lygxjc() { if (lygxpd == "1") { readxml("lyb_dq", Qlyfyxx, "", "", ""); return; }; var ob1 = $("lynr"); var ars; for (var z = 0; z < ob1.childNodes.length; z++) { if (ob1.childNodes[z].className != "cslyb") continue; ars = ob1.childNodes[z].lastChild.innerHTML.split("."); if (ars.length != 4) continue; if (!Q.a) { ob1.childNodes[z].lastChild.innerHTML = ars[0] + "." + ars[1] + "." + ars[2] + "." + "*"; } else { ob1.childNodes[z].lastChild.innerHTML = ars[0] + "." + ars[1] + "." + ars[2] + "." + ob1.childNodes[z].lastChild.id.split("_")[1]; } } }
var jcjs = 0;
function checkgl(ryzm) { if (bdglymm.value == "") { alert(C.g1); $('bdglymm').focus(); return false; }; readxml("gly_dl", bdglymm.value, ryzm, "", ""); return; }; function fglytc() { readxml("gly_tc", "", "", "", "") }
function mlq_ov(ro) { if (ro.className == "ysm1") return; ro.className = "ysm0x" }; function mlq_ou(ro) { if (ro.className == "ysm1") return; ro.className = "ysm0" };
function drag(o, omb, isyd) { if (!isyd) { o.firstChild.onmousedown = function() { return false; }; }; o.onmousedown = function(a) { if (isyd) { if (omb.style.zIndex < _C.z) { omb.style.zIndex = _C.t(); } }; var d = document; if (!a) a = window.event; var x_ = a.clientX; var y_ = a.clientY; var x0; var y0; if (isyd) { x0 = parseInt(omb.style.left); y0 = parseInt(omb.style.top); } else { x0 = parseInt(omb.parentNode.style.width); y0 = parseInt(omb.style.height); }; if (o.setCapture) { o.setCapture(); } else if (window.captureEvents) { window.captureEvents(Event.MOUSEMOVE | Event.MOUSEUP); }; d.onmousemove = function(a) { if (!a) a = window.event; var x1 = x0 + (a.clientX - x_); var y1 = y0 + (a.clientY - y_); if (isyd) { omb.style.left = (x1 < 0) ? 0 : x1; omb.style.top = (y1 < 0) ? 0 : y1; } else { omb.parentNode.style.width = x1 + "px"; omb.style.height = y1 + "px"; }; }; d.onmouseup = function() { if (o.releaseCapture) { o.releaseCapture(); } else if (window.captureEvents) { window.captureEvents(Event.MOUSEMOVE | Event.MOUSEUP); }; d.onmousemove = null; d.onmouseup = null; }; } }
function xs_gg() { /*var ob1 = Rx(); if (!ob1) return; $("idzdy1").innerHTML = ob1.Yz2.value; $("zdy_wz0").style.display = "block"; $("idzdy1").style.display = "block"; */}
function kq_help() { window.open("/help_bj.html", "ys_help", "height=520, width=550, toolbar=no, menubar=no, location=no, status=no,scrollbars=yes,resizable=yes"); }
var _C = { z: 2000, t: function() { _C.z += 1; return _C.z }, zd: function(rid) { if ($(rid).style.zIndex < _C.z) { $(rid).style.zIndex = _C.t(); } }, kq: function(r) { if (!r.zt) { r.zt = true; this.qd(r); this.jz(r); } else { this.cx(r); eval(r.id + "_i.csdy();"); } },
    qd: function(r) { r.id = "D_" + r.mc; var s1 = "<div id='" + r.id + "' class='ck' style='width:" + r.w + "px;left:180px;top:150px;display:none;'>"; s1 += "<div class='ckbt'><a href='javascript:' onclick='this.focus();eval(_CK." + r.mc + ".gb());' class='abu'>x</a><label>文件上传</label></div>"; s1 += "<div style='height:" + r.h + "px; overflow-y :auto;'>"; if (r.nr) { s1 += r.nr; } else { s1 += "<iframe id='" + r.id + "_i'" + " name='" + r.id + "_i' src='" + Qzydz + "/ck/" + r.id + ((r.kzm) ? r.kzm : ".htm"); s1 += "' width='100%' height='100%' scrolling='" + ((r.size) ? "auto" : "no") + "' style='border:0;'></iframe>"; }; s1 += "</div>"; if (r.size) s1 += "<div style='text-align:right;background-color:#FFFFE6;'><img style='cursor:nw-resize;' src='/images/ccls.gif' width='12' height='12' /></div>"; s1 += "</div>"; var e1 = document.createElement('div'); document.body.appendChild(e1); e1.innerHTML = s1; r.ck = $(r.id); drag(r.ck.childNodes[0], r.ck, true); if (r.size) drag(r.ck.lastChild, r.ck.childNodes[1], false); r.ck.childNodes[1].onmousedown = function() { if (r.ck.style.zIndex < _C.z) { r.ck.style.zIndex = _C.t(); } }; r.gb = function() { r.ck.style.display = "none" }; },
    xs: function(r) { if (r.ck.style.zIndex < _C.z) r.ck.style.zIndex = _C.t(); if (r.ck.style.display == "none") r.ck.style.display = "block"; },
    jz: function(r) { if (r.wz) { r.ck.style.left = r.wz[0]; r.ck.style.top = r.wz[1]; this.xs(r); return; }; var x1 = parseInt(document.body.clientWidth / 2 - parseInt(r.ck.style.width) / 2); var y1 = parseInt(document.body.clientHeight / 2 - parseInt(r.ck.childNodes[1].style.height) / 2 - 40); r.ck.style.left = x1; r.ck.style.top = y1; this.xs(r); },
    cx: function(r) { if (r.wz) { _C.jz(r); return; } var w1 = parseInt(r.ck.style.width) / 2; var h1 = parseInt(r.ck.childNodes[1].style.height) / 2; var l1 = parseInt(r.ck.style.left); var t1 = parseInt(r.ck.style.top); if (l1 > (document.body.clientWidth - w1)) { this.jz(r); return; }; if (t1 > (document.body.clientHeight - h1)) { this.jz(r); return; }; this.xs(r); }, bt: function(rid, rbt) { $(rid).childNodes[0].childNodes[1].innerHTML = rbt; }
};
_fup = { mcs: false, mlbh: "", fl: "", upxh: 0, scpz: "", ly: "", server: "", fmax: 0, fzt: [true, true, true, true, true, true], wjmc: "",
    fwjm: function(rs) { var n1 = rs.lastIndexOf("\\"); if (n1 < 0) return rs; return rs.substr(n1 + 1); },
    fkzm: function(rs) { var n1 = rs.lastIndexOf("."); if (n1 < 0) return ""; return rs.substr(n1 + 1).toLowerCase(); },
    gzzt: function(rpd) { var s1 = (rpd) ? "true" : ""; $("scmore").disabled = s1; $("filesc2").disabled = s1; },
    more: function() { if ($("scmore").checked == true) { if (this.mcs == false) { this.mcs = true; var s1 = ""; for (var i = 1; i <= 5; i++) { s1 += "<Iframe id='upf_" + i + "' name='upf_" + i + "' src='/upfile/up.htm?" + i + "0" + dfgxz + ((dxken) ? "1" : "0"); s1 += "' width='230' height=24 scrolling=no frameborder='0'></iframe>"; }; $("rqfile").innerHTML = s1; } $("rqfile").style.display = "block"; } else { $("rqfile").style.display = "none"; } },
    fjc: function() {
        var js = 0;
        for (var i = 0; i <= (($("scmore").checked) ? 5 : 0); i++) {
            if (!this.fzt[i]) { alert("请重新进入空间！"); return false; };
            var s1 = eval("upf_" + i).document.forms[0].f.value;
            if (s1 != "") {
                if (f_check(this.fwjm(s1)) != "") { alert(f_check(this.fwjm(s1))); return false; };
                if ("exe,txt,htm".indexOf(this.fkzm(s1)) >= 0 && !Q.a) {
                    var m = new ML(""); if (m.mmcd == 0) {
                        alert("访客不能在未设置权限的目录里上传EXE,TXT,HTM格式文件！\n\n建议访客把文件压缩后再上传.(管理员在管理区登录后不受此限制)"); return false;
                    }
                };
                js += 1;
            }
        }; if (js == 0) { alert("您没有选择文件!"); return false; }; return true;
    },
    ks: function() { if (Q.mlbh < 0) { alert("需先选择一个目录"); return false; }; this.fl = Q.fl_mc(); if (!M.jl()) { alert("请刷新目录再次上传(1)"); return; }; this.scpz = M.jl().scpz; if (this.scpz == "") { alert("请刷新目录再次上传(2)"); return; }; this.gzzt(true); this.upxh = 0; this.up(); },
    up: function() {
        var f = eval("upf_" + this.upxh).document.forms[0];
        if (f.f.value == "") { this.upend(); return; }
        f.bt.value = zfaq($("scbt").value); f.fl.value = this.fl;
        f.action = this.server + "up.php?p=" + this.scpz + this.upxh + "&name=" + this.ly + "&fm=" + this.fmax;
        this.wjmc = this.fwjm(f.f.value); _C.kq(_CK.scjd); this.fzt[this.upxh] = false; f.submit();
    },
    upend: function() { if (this.upxh < (($("scmore").checked) ? 5 : 0)) { this.upxh += 1; this.up(); } else { this.upjs(); } },
    upjs: function() { this.gzzt(false); if ($("scmore").checked) { $("scmore").checked = false; this.more(); } },
    errjs: function(rlx) {
        this.upjs();
        var s1 = "上传任务未完成，原因:\n\n";
        if (rlx == 1) { alert(s1 + "所选文件大小超过了空间剩余大小,不能进行上传！"); return; }
        if (rlx == 2) { alert(s1 + "单个文件大小不能超出限定:" + this.fmax + " MB\n\n注:空间级别不同，单个文件大小限定不同，详细请看:伍六Ｅ盘产品介绍http://www.ys168.com/list_cp.aspx"); return; }
        if (rlx == 6) { alert(s1 + "报歉！上传中出现问题，请重新登录空间再进行上传操作。"); return; }
        if (rlx == 9) { return; }
    },
    stop: function(rs) { eval("upf_" + this.upxh).location.href = "http://" + this.ly + "/upfile/up.htm?" + this.upxh + rs; },
    jdgb: function() { if (_CK.scjd.zt) { _CK.scjd.ck.style.display = "none"; D_scjd_i.$("D_wj_if").src = "about:blank"; } }
}

function fa1() 
{ 
	//Qdhrs = $("zxrsts").innerHTML; 
	//dhrs1 = $("zxrsts1").innerHTML; 
	//$("zxrsts").innerHTML = "<u>" + Qdhrs + "</u>"; 
	//var qqm = "";
	//if (Q.mlbh != -1) { var M = new ML(""); if (M.xkck()) { var j = findml(Q.mlbh); 
	//if (j != -1) qqm = myTree.branches[j].id + "|" + myTree.branches[j].fsj + "|" + myTree.branches[j].llcx; } };
	return "/zxsj.php?dlmc=" + ddlmc; }
function fa2(rs) {
    var jk = rs.split("~"); if (jk.length < 6) return;
    $i("zxrsts", Qdhrs);
    if (jk[1] != Qdhrs) { $("zxrsts").style.color = "red"; setTimeout("$('zxrsts').style.color='yellow';$('zxrsts').innerHTML='" + jk[1] + "';", 1000); }; 
    if (jk[2] == "") jk[1] = 0; if (dhrs1 == "") dhrs1 = 0; jk[2] = jk[2] * 1; dhrs1 = dhrs1 * 1; if (jk[2] > dhrs1) { $("zxrsts1").style.color = "red"; setTimeout("$('zxrsts1').style.color='yellow';$('zxrsts1').innerHTML='" + jk[2] + "';", 1000); }
    if (jk[6] != "") Q.llcx = jk[6];
    if (jk[7] != "") $("kjz2").innerHTML = jk[7];
    if (Qcxzt == false) return;
    if (jk[3] == "1") { readxml("lyb_dq", "", "", "", ""); return; };
    if (jk[4] == "1") { readxml("ml_dq", "", "", "", ""); return; }; 
    if (jk[5] != "") { if (jk[5] == Q.mlbh && Q.mlbh >= 0) { var M = new ML(""); if (!M.xkck()) { M = null; return; } readxml("dq", jk[5], "", "", ""); return; } }
    if (Q.mlbh != -1) { var j = findml(Q.mlbh); if (j != -1) { if (myTree.branches[j].cs()) { var M = new ML(""); if (!M.xkxz || !M.xkck) { M = null; return; } readxml("dq", Q.mlbh, "", "", ""); return; } } }
};

function $i(rid,rz) {if (rz) { $(rid).innerHTML = rz; } else { return $(rid).innerHTML } };

