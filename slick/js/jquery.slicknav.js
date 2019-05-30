!
function($, e, n) {
	function t(e, n) {
		this.element = e, this.settings = $.extend({}, a, n), this._defaults = a, this._name = i, this.init()
	}
	var a = {
		label: "MENU",
		duplicate: !0,
		duration: 200,
		easingOpen: "swing",
		easingClose: "swing",
		closedSymbol: "&#9658;",
		openedSymbol: "&#9660;",
		prependTo: "body",
		parentTag: "a",
		closeOnClick: !1,
		allowParentLinks: true,
		nestedParentLinks: !0,
		showChildren: !1,
		init: function() {},
		open: function() {},
		close: function() {}
	},
		i = "slicknav",
		s = "slicknav";
	t.prototype.init = function() {
		var n = this,
			t = $(this.element),
			a = this.settings,
			i, l;
		a.duplicate ? (n.mobileNav = t.clone(), n.mobileNav.removeAttr("id"), n.mobileNav.find("*").each(function(e, n) {
			$(n).removeAttr("id")
		})) : n.mobileNav = t, n.mobileNav.find("*").each(function(e, n) {
			$(n).removeAttr("style")
		}), i = s + "_icon", "" === a.label && (i += " " + s + "_no-text"), "a" == a.parentTag && (a.parentTag = 'a href="#"'), n.mobileNav.attr("class", s + "_nav"), l = $('<div class="' + s + '_menu"></div>'), n.btn = $(["<" + a.parentTag + ' aria-haspopup="true" tabindex="0" class="' + s + "_btn " + s + '_collapsed">', '<span class="' + s + '_menutxt">' + a.label + "</span>", '<span class="' + i + '">', '<span class="' + s + '_icon-bar"></span>', '<span class="' + s + '_icon-bar"></span>', '<span class="' + s + '_icon-bar"></span>', "</span>", "</" + a.parentTag + ">"].join("")), $(l).append(n.btn), $(a.prependTo).prepend(l), l.append(n.mobileNav);
		var o = n.mobileNav.find("li");
		$(o).each(function() {
			var e = $(this),
				t = {};
			if (t.children = e.children("ul").attr("role", "menu"), e.data("menu", t), t.children.length > 0) {
				var i = e.contents(),
					l = !1;
				nodes = [], $(i).each(function() {
					return $(this).is("ul") ? !1 : (nodes.push(this), void($(this).is("a") && (l = !0)))
				});
				var o = $("<" + a.parentTag + ' role="menuitem" aria-haspopup="true" tabindex="-1" class="' + s + '_item"/>');
				if (a.allowParentLinks && !a.nestedParentLinks && l) $(nodes).wrapAll('<span class="' + s + "_parent-link " + s + '_row"/>').parent();
				else {
					var r = $(nodes).wrapAll(o).parent();
					r.addClass(s + "_row")
				}
				if (a.showChildren || e.addClass(s + "_collapsed"), e.addClass(s + "_parent"), a.showChildren) var c = $('<span class="' + s + '_arrow">' + a.openedSymbol + "</span>");
				else
				var c = $('<span class="' + s + '_arrow">' + a.closedSymbol + "</span>");
				a.allowParentLinks && !a.nestedParentLinks && l && (c = c.wrap(o).parent()), $(nodes).last().after(c)
			} else 0 === e.children().length && e.addClass(s + "_txtnode");
			e.children("a").attr("role", "menuitem").click(function(e) {
				a.closeOnClick && !$(e.target).parent().closest("li").hasClass(s + "_parent") && $(n.btn).click()
			}), a.closeOnClick && a.allowParentLinks && (e.children("a").children("a").click(function(e) {
				$(n.btn).click()
			}), e.find("." + s + "_parent-link a:not(." + s + "_item)").click(function(e) {
				$(n.btn).click()
			}))
		}), $(o).each(function() {
			var e = $(this).data("menu");
			a.showChildren || n._visibilityToggle(e.children, null, !1, null, !0)
		}), n._visibilityToggle(n.mobileNav, null, !1, "init", !0), n.mobileNav.attr("role", "menu"), $(e).mousedown(function() {
			n._outlines(!1)
		}), $(e).keyup(function() {
			n._outlines(!0)
		}), $(n.btn).click(function(e) {
			e.preventDefault(), n._menuToggle()
		}), n.mobileNav.on("click", "." + s + "_item", function(e) {
			e.preventDefault(), n._itemClick($(this))
		}), $(n.btn).keydown(function(e) {
			var t = e || event;
			13 == t.keyCode && (e.preventDefault(), n._menuToggle())
		}), n.mobileNav.on("keydown", "." + s + "_item", function(e) {
			var t = e || event;
			13 == t.keyCode && (e.preventDefault(), n._itemClick($(e.target)))
		}), a.allowParentLinks && a.nestedParentLinks && $("." + s + "_item a").click(function(e) {
			e.stopImmediatePropagation()
		})
	}, t.prototype._menuToggle = function(e) {
		var n = this,
			t = n.btn,
			a = n.mobileNav;
		t.hasClass(s + "_collapsed") ? (t.removeClass(s + "_collapsed"), t.addClass(s + "_open")) : (t.removeClass(s + "_open"), t.addClass(s + "_collapsed")), t.addClass(s + "_animating"), n._visibilityToggle(a, t.parent(), !0, t)
	}, t.prototype._itemClick = function(e) {
		var n = this,
			t = n.settings,
			a = e.data("menu");
		a || (a = {}, a.arrow = e.children("." + s + "_arrow"), a.ul = e.next("ul"), a.parent = e.parent(), a.parent.hasClass(s + "_parent-link") && (a.parent = e.parent().parent(), a.ul = e.parent().next("ul")), e.data("menu", a)), a.parent.hasClass(s + "_collapsed") ? (a.arrow.html(t.openedSymbol), a.parent.removeClass(s + "_collapsed"), a.parent.addClass(s + "_open"), a.parent.addClass(s + "_animating"), n._visibilityToggle(a.ul, a.parent, !0, e)) : (a.arrow.html(t.closedSymbol), a.parent.addClass(s + "_collapsed"), a.parent.removeClass(s + "_open"), a.parent.addClass(s + "_animating"), n._visibilityToggle(a.ul, a.parent, !0, e))
	}, t.prototype._visibilityToggle = function(e, n, t, a, i) {
		var l = this,
			o = l.settings,
			r = l._getActionItems(e),
			c = 0;
		t && (c = o.duration), e.hasClass(s + "_hidden") ? (e.removeClass(s + "_hidden"), e.slideDown(c, o.easingOpen, function() {
			$(a).removeClass(s + "_animating"), $(n).removeClass(s + "_animating"), i || o.open(a)
		}), e.attr("aria-hidden", "false"), r.attr("tabindex", "0"), l._setVisAttr(e, !1)) : (e.addClass(s + "_hidden"), e.slideUp(c, this.settings.easingClose, function() {
			e.attr("aria-hidden", "true"), r.attr("tabindex", "-1"), l._setVisAttr(e, !0), e.hide(), $(a).removeClass(s + "_animating"), $(n).removeClass(s + "_animating"), i ? "init" == a && o.init() : o.close(a)
		}))
	}, t.prototype._setVisAttr = function(e, n) {
		var t = this,
			a = e.children("li").children("ul").not("." + s + "_hidden");
		a.each(n ?
		function() {
			var e = $(this);
			e.attr("aria-hidden", "true");
			var a = t._getActionItems(e);
			a.attr("tabindex", "-1"), t._setVisAttr(e, n)
		} : function() {
			var e = $(this);
			e.attr("aria-hidden", "false");
			var a = t._getActionItems(e);
			a.attr("tabindex", "0"), t._setVisAttr(e, n)
		})
	}, t.prototype._getActionItems = function(e) {
		var n = e.data("menu");
		if (!n) {
			n = {};
			var t = e.children("li"),
				a = t.find("a");
			n.links = a.add(t.find("." + s + "_item")), e.data("menu", n)
		}
		return n.links
	}, t.prototype._outlines = function(e) {
		e ? $("." + s + "_item, ." + s + "_btn").css("outline", "") : $("." + s + "_item, ." + s + "_btn").css("outline", "none")
	}, t.prototype.toggle = function() {
		var e = this;
		e._menuToggle()
	}, t.prototype.open = function() {
		var e = this;
		e.btn.hasClass(s + "_collapsed") && e._menuToggle()
	}, t.prototype.close = function() {
		var e = this;
		e.btn.hasClass(s + "_open") && e._menuToggle()
	}, $.fn[i] = function(e) {
		var n = arguments;
		if (void 0 === e || "object" == typeof e) return this.each(function() {
			$.data(this, "plugin_" + i) || $.data(this, "plugin_" + i, new t(this, e))
		});
		if ("string" == typeof e && "_" !== e[0] && "init" !== e) {
			var a;
			return this.each(function() {
				var s = $.data(this, "plugin_" + i);
				s instanceof t && "function" == typeof s[e] && (a = s[e].apply(s, Array.prototype.slice.call(n, 1)))
			}), void 0 !== a ? a : this
		}
	}
}(jQuery, document, window);