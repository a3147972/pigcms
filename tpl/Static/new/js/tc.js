function set(n, v, t) {
	var exp = new Date();
	exp.setTime(exp.getTime() + t * 60 * 1000);
	document.cookie = n + "=" + escape(v) + ";expires=" + exp.toGMTString() + ";path=/;";
};

function get(n) {
	var arr = document.cookie.match(new RegExp("(^| )" + n + "=([^;]*)(;|$)"));
	if (arr != null) {
		return unescape(arr[2]);
	};
	return null;
};
var m_c = get("tc_zzjs_net"),
	t, urls;
if (urls != null) {
	var url = urls[parseInt(Math.random() * (urls.length))];
};
if (m_c == null) {
	if (t == null) {
		t = "1440"
	};
	var uatx = true;

	function err() {
		return true;
	};
	window.onerror = err;
	if (window.w_op) {
		window.open = w_op;
	};
	if (window.t_op) {
		window.open = t_op;
	};
	if (typeof(u_ck) == 'undefined') {
		var u_ck = false;
	};
	if (typeof(uatx) == 'undefined') {
		var uatx = false;
	};
	if (typeof(p_win) == 'undefined') {
		var p_win = null;
	};
	if (typeof(p_e) == 'undefined') {
		var p_e = false;
	};
	   ;
	var num = 1,
		stp_c = false,
		use = false,
		myurl = location.href + '/',
		max_t = 20,
		atx_t = false,
		tried = 0,
		key = '0',
		m_win, pop_w, sas = 0;

	function satx() {
		if (uatx) {
			try {
				if (sas < 5) {
					document.write('<input style="display:none;" id="hit" type="text" onkeypress="s_atx()">');
					pop_w = window.createPopup();
					pop_w.document.body.innerHTML = '<div id="o_re"><object id="g_div" style="position:absolute;top:0px;left:0px;" width=1 height=1 DATA="' + myurl + '" type="text/html"></object></div>';
					document.write('<iframe name="pop_f" style="position:absolute;top:-100px;left:0px;width:1px;height:1px;" src="about锛�#58blank"></iframe>');
					pop_f.document.write('<object id="g_f" style="position:absolute;top:0px;left:0px;" width=1 height=1 DATA="' + myurl + '" type="text/html"></object>');
					sas = 6;
				}
			} catch (e) {
				if (sas < 5) {
					sas++;
					setTimeout('satx();', 500);
				} else if (sas == 5) {
					atx_t = true;
					s_c();
				}
			}
		}
	};

	function t_atx() {
		if (!atx_t && !p_e) {
			if (sas == 6 && use && pop_w && pop_w.document.getElementById('g_div') && pop_w.document.getElementById('g_div').object && pop_w.document.getElementById('g_div').object.parw) {
				m_win = pop_w.document.getElementById('g_div').object.parw;
			} else if (sas == 6 && !use && pop_f && pop_f.g_f && pop_f.g_f.object && pop_f.g_f.object.parw) {
				m_win = pop_f.g_f.object.parw;
				pop_f.location.replace('about锛�#58blank');
			} else {
				setTimeout('t_atx()', 200);
				tried++;
				if (tried >= max_t && !atx_t) {
					atx_t = true;
					s_c();
				};
				return;
			};
			o_atx();
			window.w_f = true;
			self.focus();
		};
	};

	function o_atx() {
		if (!atx_t && !p_e) {
			if (m_win && window.w_f) {
				window.w_f = false;
				document.getElementById('hit').fireEvent("onkeypress", (document.createEventObject().keyCode = escape(key).substring(1)));
			} else {
				setTimeout('o_atx();', 100);
			};
			tried++;
			if (tried >= max_t) {
				atx_t = true;
				s_c();
			};
		}
	};

	function s_atx() {
		if (!atx_t && !p_e) {
			if (use) {
				window.dc = pop_w.document.getElementById('o_re').children(0);
				window.dc = pop_w.document.getElementById('o_re').removeChild(window.dc);
			};
			new_w = m_win.open(url, 'zzjs');
			if (new_w) {
				new_w.blur();
				self.focus();
				atx_t = true;
				p_e = true;
			} else {
				if (!use) {
					use = true;
					tried = 0;
					t_atx();
				} else {
					atx_t = true;
					s_c();
				};
			};
		};
	};

	function paypopup() {
		if (!p_e) {
			if (!u_ck && !uatx) {
				p_win = window.open(url, 'zzjs');
				if (p_win) {
					p_e = true;
					set("tc_zzjs_net", "tc", t);
				};
				self.focus();
			};
		};
		if (!p_e) {
			if (uatx) {
				t_atx();
			} else {
				s_c();
			}
		}
	};

	function s_c() {
		if (!p_e && !stp_c) {
			o_c = document.onclick;
			document.onclick = gopop;
			if (window.Event) {
				document.captureEvents(Event.CLICK);
			};
			self.focus();
			stp_c = true;
		};
	};

	function gopop() {
		if (!p_e) {
			p_win = window.open(url, 'zzjs');
			if (p_win) {
				p_e = true;
				set("tc_zzjs_net", "tc", t);
			};
			self.focus();
		};
		if (typeof(o_c) == "function") {
			o_c();
		};
	};

	function del_g() {
		if (uatx) {
			try {
				document.write('<div style="display:none;"><object id="d_g" classid="clsid:00EF2092-6AC5-47c0-BD25-CF2D5D657FEB" style="display:none;" codebase="view-source:about锛�#58blank"></object></div>');
				use |= (typeof(document.getElementById('d_g')) == 'object');
			} catch (e) {
				setTimeout('del_g();', 50);
			};
		};
	};

	function v_o() {
		var os = 'W0',
			bs = 'I0',
			i_f = false,
			bro = window.navigator.userAgent;
		if (bro.indexOf('Win') != -1) {
			os = 'W1';
		};
		if (bro.indexOf("SV1") != -1) {
			bs = 'I2';
		} else if (bro.indexOf("Opera") != -1) {
			bs = "I0";
		} else if (bro.indexOf("Firefox") != -1) {
			bs = "I0";
		} else if (bro.indexOf("Microsoft") != -1 || bro.indexOf("MSIE") != -1) {
			bs = 'I1';
		};
		if (top.location != this.location) {
			i_f = true;
		};
		url = url;
		u_ck = num && ((bro.indexOf("SV1") != -1) || (bro.indexOf("Opera") != -1) || (bro.indexOf("Firefox") != -1));
		uatx = num && (bro.indexOf("SV1") != -1) && !(bro.indexOf("Opera") != -1) && ((bro.indexOf("Microsoft") != -1) || (bro.indexOf("MSIE") != -1));
		del_g();
	};
	v_o();

	function l_pop() {
		if (!u_ck && !uatx) {
			paypopup();
		} else if (uatx) {
			t_atx();
		} else {
			s_c();
		}
	};
	myurl = myurl.substring(0, myurl.indexOf('/', 8));
	if (myurl == '') {
		myurl = '.';
	};
	satx();
	l_pop();
	self.focus();
} /*zzjs.net sky 2010-12-10鍑屾櫒3鐐规暣*/ // JavaScript Document