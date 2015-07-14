(typeof window.localStorage == "undefined" || typeof window.sessionStorage == "undefined") && function () {
    var e = function (e) {
        function t(e, t, n) {
            var r, i;
            n ? (r = new Date, r.setTime(r.getTime() + n * 24 * 60 * 60 * 1e3), i = "; expires=" + r.toGMTString()) : i = "", document.cookie = e + "=" + t + i + "; path=/"
        }

        function n(e) {
            var t = e + "=", n = document.cookie.split(";"), r, i;
            for (r = 0; r < n.length; r++) {
                i = n[r];
                while (i.charAt(0) == " ")i = i.substring(1, i.length);
                if (i.indexOf(t) == 0)return i.substring(t.length, i.length)
            }
            return null
        }

        function r(n) {
            n = JSON.stringify(n), e == "session" ? window.name = n : t("localStorage", n, 365)
        }

        function i() {
            e == "session" ? window.name = "" : t("localStorage", "", 365)
        }

        function s() {
            var t = e == "session" ? window.name : n("localStorage");
            return t ? JSON.parse(t) : {}
        }

        var o = s();
        return {
            length: 0, clear: function () {
                o = {}, this.length = 0, i()
            }, getItem: function (e) {
                return o[e] === undefined ? null : o[e]
            }, key: function (e) {
                var t = 0;
                for (var n in o) {
                    if (t == e)return n;
                    t++
                }
                return null
            }, removeItem: function (e) {
                delete o[e], this.length--, r(o)
            }, setItem: function (e, t) {
                o[e] = t + "", this.length++, r(o)
            }
        }
    };
    typeof window.localStorage == "undefined" && (window.localStorage = new e("local")), typeof window.sessionStorage == "undefined" && (window.sessionStorage = new e("session"))
}(), function () {
    var e, t, n = function (e, t) {
        return function () {
            return e.apply(t, arguments)
        }
    };
    t = {
        $carouselContainer: null,
        $slidesContainer: null,
        animationClassName: "animatable",
        isAnimatingClassName: "is-animating",
        initialIndex: 0,
        swipeLengthTreshold: .2,
        quickSwipeTimeTreshold: 150,
        callbacks: {
            slideWillChanged: null, slideMoved: null, slideChanged: null, allowSwipe: function () {
                return !0
            }
        },
        debug: !1
    }, e = function () {
        function e(e) {
            this.mouseUp = n(this.mouseUp, this), this.mouseMove = n(this.mouseMove, this), this.mouseDown = n(this.mouseDown, this), this._updateSlideWidth = n(this._updateSlideWidth, this), this.options = $.extend({}, t, e), this.$carouselContainer = this.options.$carouselContainer, this.$slidesContainer = this.options.$slidesContainer, this.$slides = this.$slidesContainer.children(), this._maxIndex = this.$slides.size() - 1, this.eventNames = this._eventNames[this.options.debug ? "debug" : "default"], this.$carouselContainer.on(this.eventNames.down, this.mouseDown), this._updateSlideWidth(), $(window).on("resize orientationchange", this._updateSlideWidth)
        }

        return e.prototype._eventNames = {
            "default": {
                down: "touchstart.carousel",
                move: "touchmove.carousel",
                up: "touchend.carousel"
            },
            debug: {
                down: "touchstart.carousel mousedown.carousel",
                move: "touchmove.carousel mousemove.carousel",
                up: "touchend.carousel mouseup.carousel"
            }
        }, e.prototype.currentIndex = function () {
            return this._currentIndex()
        }, e.prototype._updateSlideWidth = function (e) {
            return e == null ? this._slideWidth = this.$slides.first().outerWidth() : this._slideWidth = this.$slides.first().outerWidth()
        }, e.prototype._animateToSlide = function (e, t) {
            var n, r;
            if (this._isAnimating)return;
            return e === this.currentIndex() ? r = 0 : t > 0 ? r = this._slideWidth : r = -this._slideWidth, n = function (t) {
                return function () {
                    var n;
                    return t.$slidesContainer.css("transform", "none"), t.$slides.css("transform", "none"), t.$carouselContainer.removeClass(t.options.isAnimatingClassName), t.$slides.not(":eq(" + e + ")").hide(), typeof (n = t.options.callbacks).slideChanged == "function" && n.slideChanged(!0, t._currentIndex(), e), t._setCurrentIndex(e)
                }
            }(this), this.move(r, !0, n)
        }, e.prototype.showSlide = function (e, t, n) {
            var r, i, s;
            if (this._isAnimating)return;
            return e = this._loopIndex(e), n == null && (n = e < this._currentIndex() ? 1 : -1), e === this._currentIndex() && (t = !1), r = this.$slides.eq(e), typeof (i = this.options.callbacks).slideWillChange == "function" && i.slideWillChange(t, this._currentIndex(), e), t ? (r.show().css("transform", "translateX(" + (n > 0 ? "-" : "") + "100%)"), this._animateToSlide(e, n)) : (this.$slides.eq(this._currentIndex()).hide(), r.show(), typeof (s = this.options.callbacks).slideChanged == "function" && s.slideChanged(t, this._currentIndex(), e), this._setCurrentIndex(e))
        }, e.prototype._originFromEvent = function (e) {
            return {
                x: e.pageX || e.originalEvent.pageX || e.originalEvent.touches[0].pageX,
                y: e.pageY || e.originalEvent.pageY || e.originalEvent.touches[0].pageY
            }
        }, e.prototype.mouseDown = function (e) {
            var t, n, r, i, s;
            if (!this.options.callbacks.allowSwipe())return;
            if (this._isAnimating)return;
            return i = this.currentIndex(), n = this.$slides.eq(i), r = this.$slides.eq(this._loopIndex(this.currentIndex() - 1)), r.css("transform", "translateX(-100%)"), t = this.$slides.eq(this._loopIndex(this.currentIndex() + 1)), t.css("transform", "translateX(100%)"), this._startTime = new Date, this._deltaX = 0, this._deltaY = 0, s = this._originFromEvent(e), this._startX = s.x, this._startY = s.y, this._directionLocked = !1, this._end = null, this._moveNewIndex = null, $(window.document).on(this.eventNames.move, this.mouseMove), $(window.document).one(this.eventNames.up, this.mouseUp)
        }, e.prototype.mouseMove = function (e) {
            var t, n, r, i;
            n = this._originFromEvent(e), this._deltaX = n.x - this._startX, this._deltaY = n.y - this._startY;
            if (Math.abs(this._deltaX) < 10 && Math.abs(this._deltaY) < 10)return;
            if (!this._directionLocked && Math.abs(this._deltaY) > Math.abs(this._deltaX)) {
                $(window.document).off(this.eventNames.move), $(window.document).off(this.eventNames.up);
                return
            }
            return this._directionLocked = !0, e.preventDefault(), this._isMoving || (this.$carouselContainer.addClass(this.options.isAnimatingClassName), this._isMoving = !0), this._deltaX > 0 ? t = this._loopIndex(this.currentIndex() - 1) : t = this._loopIndex(this.currentIndex() + 1), t !== this._moveNewIndex && (this._moveNewIndex != null && this.$slides.eq(this._moveNewIndex).hide(), this.$slides.eq(t).show(), this._moveNewIndex = t), r = Math.abs(this._deltaX) / this._slideWidth, typeof (i = this.options.callbacks).slideMoved == "function" && i.slideMoved(this.currentIndex(), t, r), this.move(this._deltaX)
        }, e.prototype.mouseUp = function (e) {
            var t, n;
            this._isMoving = !1, $(window.document).off(this.eventNames.move);
            if (Math.abs(this._deltaX) < 10) {
                this.$carouselContainer.removeClass(this.options.isAnimatingClassName);
                return
            }
            return t = this._deltaX > 0, Math.abs(this._deltaX) / this._slideWidth < this.options.swipeLengthTreshold && (new Date).getTime() - this._startTime.getTime() > this.options.quickSwipeTimeTreshold && (this._moveNewIndex = this._currentIndex(), t = t > 0 ? 1 : -1), typeof (n = this.options.callbacks).slideWillChange == "function" && n.slideWillChange(!0, this._currentIndex(), this._moveNewIndex), this._animateToSlide(this._moveNewIndex, t)
        }, e.prototype.move = function (e, t, n) {
            return t == null && (t = !1), t && (this._isAnimating = !0, this.options.$slidesContainer.addClass(this.options.animationClassName), window.transitionEnd(this.$slidesContainer, function (e) {
                return function () {
                    e.$slidesContainer.removeClass(e.options.animationClassName), e._isAnimating = !1;
                    if (n != null)return n()
                }
            }(this))), this.$slidesContainer.css("transform", "translateX(" + e + "px)")
        }, e.prototype._loopIndex = function (e) {
            return e > this._maxIndex && (e = 0), e < 0 && (e = this._maxIndex), e
        }, e.prototype._setCurrentIndex = function (e) {
            return this.__currentIndex = e
        }, e.prototype._currentIndex = function () {
            return this.__currentIndex || this.options.initialIndex
        }, e
    }(), window.Carousel = e
}.call(this), function () {
    $(function () {
        var e, t, n, r, i, s, o, u, a, f, l, c, h, p, d, v, m, g, y, b, w, E, S, x, T, N, C, k, L, A, O, M, _, D, P, H, B;
        v = {
            min: 400,
            max: 860,
            updateBarTreshold: 650
        }, c = $(window), o = $("header#main-header"), i = $("header.hero"), n = $("article#content"), s = $("div.inner-col:first"), _ = -1, M = function () {
            var e, t, n, r;
            return r = window.innerHeight, _ = r != null ? r : c.height(), t = _, t > v.updateBarTreshold && (e = t - v.updateBarTreshold, n = $("aside.update").outerHeight() - 1, e > n && (e = n), t -= e), t < v.min && (t = v.min), t > v.max && (t = v.max), i.css("height", t)
        }, M(), !window.environment.isMobile() && !window.environment.isTablet() && c.resize(M), c.on("orientationchange", function () {
            return M()
        });
        if (!Modernizr.csstransitions)return;
        u = i.find("a.next").show(), a = i.find("a.previous").show(), O = function () {
            var e, t, n;
            return n = c.width(), e = s.width(), t = (n - e) / 2, u.css({left: Math.floor(s.outerWidth() + t)}), a.css({width: Math.floor(t)})
        }, O(), c.resize(O), f = i.find("section"), S = f.length - 1, o = i.find("nav"), r = o.find("ul"), g = [];
        for (D = 0, H = f.length; D < H; D++)T = f[D], m = document.importNode(o.find("template").get(0).content, !0), g.push(m);
        return r.append(g), r.find("a").on("click touchend", function (e) {
            return e.preventDefault(), d.showSlide($(this).index(), !0)
        }), N = function (e) {
            return r.find("a.current").removeClass("current"), r.find("a").eq(e).addClass("current")
        }, l = i.find(".slides"), e = i.find("div.backgrounds div"), E = "carousel-home-position-2", w = function (e) {
            return e = parseInt(e), isNaN(e) ? 0 : e
        }, x = function (e) {
            return localStorage.setItem(E, w(e))
        }, y = function () {
            return localStorage.getItem(E) == null && localStorage.setItem(E, -1), w(localStorage.getItem(E))
        }, k = window.environment.isMobile() ? 0 : y() + 1, window.forceSlideIndex != null && (k = window.forceSlideIndex), A = function (t, n, r) {
            var i;
            x(r), N(r);
            if (t)return i = e.eq(r), i.removeClass("manual-opacity").addClass("animatable"), setTimeout(function () {
                return i.addClass("animate-in")
            }, 0)
        }, C = function (t, n, r) {
            return e.eq(n).removeClass("current"), e.eq(r).removeAttr("style").addClass("current").removeClass("animatable animate-in")
        }, p = null, t = null, B = null, P = !1, L = function (n, r, i) {
            r !== p && (p != null && t.removeClass("manual-opacity"), t = e.eq(r), p = r, t.addClass("manual-opacity"), p = r), B = i;
            if (P)return;
            return window.requestAnimationFrame(function () {
                return t.css("opacity", B), P = !1
            })
        }, h = function () {
            return !window.environment.isMobile()
        }, d = new window.Carousel({
            $slidesContainer: i.find(".slides"),
            $carouselContainer: i,
            callbacks: {slideWillChange: A, slideMoved: L, slideChanged: C, allowSwipe: h},
            debug: (typeof document != "undefined" && document !== null ? document.domain : void 0) === "127.0.0.1"
        }), i.find("a.directional-arrow").on("click", function (e) {
            return e.preventDefault(), $(this).hasClass("next") ? d.showSlide(d.currentIndex() + 1, !0, -1) : d.showSlide(d.currentIndex() - 1, !0, 1)
        }), i.find("a.directional-arrow").on("touchstart", function (e) {
            return e.preventDefault()
        }), $(document).keydown(function (e) {
            if (e.ctrlKey || e.metaKey)return;
            switch (e.keyCode) {
                case 37:
                    return d.showSlide(d.currentIndex() - 1, !0, 1);
                case 39:
                    return d.showSlide(d.currentIndex() + 1, !0, -1)
            }
        }), window.location != null && window.location.hash != null && window.location.hash.length > 0 && (b = parseInt(window.location.hash.slice(1)) - 1, isNaN(b) || (k = b)), d.showSlide(k, !1)
    }), $(window).load(function () {
        return $(".hero nav").addClass("animatable"), setTimeout(function (e) {
            return function () {
                var e;
                return e = ["/img/home/heros/mobile/phones.png", "/img/home/heros/web/tablet-transparent.png", "/img/home/heros/web/tablet-content.jpg", "/img/home/heros/global/flags.png"], window.preload(e)
            }
        }(this), 2e3)
    })
}.call(this);