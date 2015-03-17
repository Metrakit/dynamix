/*
 * metismenu - v1.1.3
 * Easy menu jQuery plugin for Twitter Bootstrap 3
 * https://github.com/onokumus/metisMenu
 *
 * Made by Osman Nuri Okumus
 * Under MIT License
 */
!function(a,b,c){function d(b,c){this.element=a(b),this.settings=a.extend({},f,c),this._defaults=f,this._name=e,this.init()}var e="metisMenu",f={toggle:!0,doubleTapToGo:!1};d.prototype={init:function(){var b=this.element,d=this.settings.toggle,f=this;this.isIE()<=9?(b.find("li.active").has("ul").children("ul").collapse("show"),b.find("li").not(".active").has("ul").children("ul").collapse("hide")):(b.find("li.active").has("ul").children("ul").addClass("collapse in"),b.find("li").not(".active").has("ul").children("ul").addClass("collapse")),f.settings.doubleTapToGo&&b.find("li.active").has("ul").children("a").addClass("doubleTapToGo"),b.find("li").has("ul").children("a").on("click."+e,function(b){return b.preventDefault(),f.settings.doubleTapToGo&&f.doubleTapToGo(a(this))&&"#"!==a(this).attr("href")&&""!==a(this).attr("href")?(b.stopPropagation(),void(c.location=a(this).attr("href"))):(a(this).parent("li").toggleClass("active").children("ul").collapse("toggle"),void(d&&a(this).parent("li").siblings().removeClass("active").children("ul.in").collapse("hide")))})},isIE:function(){for(var a,b=3,d=c.createElement("div"),e=d.getElementsByTagName("i");d.innerHTML="<!--[if gt IE "+ ++b+"]><i></i><![endif]-->",e[0];)return b>4?b:a},doubleTapToGo:function(a){var b=this.element;return a.hasClass("doubleTapToGo")?(a.removeClass("doubleTapToGo"),!0):a.parent().children("ul").length?(b.find(".doubleTapToGo").removeClass("doubleTapToGo"),a.addClass("doubleTapToGo"),!1):void 0},remove:function(){this.element.off("."+e),this.element.removeData(e)}},a.fn[e]=function(b){return this.each(function(){var c=a(this);c.data(e)&&c.data(e).remove(),c.data(e,new d(this,b))}),this}}(jQuery,window,document);;
/*!
 * fancyBox - jQuery Plugin
 * version: 2.1.5 (Fri, 14 Jun 2013)
 * @requires jQuery v1.6 or later
 *
 * Examples at http://fancyapps.com/fancybox/
 * License: www.fancyapps.com/fancybox/#license
 *
 * Copyright 2012 Janis Skarnelis - janis@fancyapps.com
 *
 */

(function (window, document, $, undefined) {
	"use strict";

	var H = $("html"),
		W = $(window),
		D = $(document),
		F = $.fancybox = function () {
			F.open.apply( this, arguments );
		},
		IE =  navigator.userAgent.match(/msie/i),
		didUpdate	= null,
		isTouch		= document.createTouch !== undefined,

		isQuery	= function(obj) {
			return obj && obj.hasOwnProperty && obj instanceof $;
		},
		isString = function(str) {
			return str && $.type(str) === "string";
		},
		isPercentage = function(str) {
			return isString(str) && str.indexOf('%') > 0;
		},
		isScrollable = function(el) {
			return (el && !(el.style.overflow && el.style.overflow === 'hidden') && ((el.clientWidth && el.scrollWidth > el.clientWidth) || (el.clientHeight && el.scrollHeight > el.clientHeight)));
		},
		getScalar = function(orig, dim) {
			var value = parseInt(orig, 10) || 0;

			if (dim && isPercentage(orig)) {
				value = F.getViewport()[ dim ] / 100 * value;
			}

			return Math.ceil(value);
		},
		getValue = function(value, dim) {
			return getScalar(value, dim) + 'px';
		};

	$.extend(F, {
		// The current version of fancyBox
		version: '2.1.5',

		defaults: {
			padding : 15,
			margin  : 20,

			width     : 800,
			height    : 600,
			minWidth  : 100,
			minHeight : 100,
			maxWidth  : 9999,
			maxHeight : 9999,
			pixelRatio: 1, // Set to 2 for retina display support

			autoSize   : true,
			autoHeight : false,
			autoWidth  : false,

			autoResize  : true,
			autoCenter  : !isTouch,
			fitToView   : true,
			aspectRatio : false,
			topRatio    : 0.5,
			leftRatio   : 0.5,

			scrolling : 'auto', // 'auto', 'yes' or 'no'
			wrapCSS   : '',

			arrows     : true,
			closeBtn   : true,
			closeClick : false,
			nextClick  : false,
			mouseWheel : true,
			autoPlay   : false,
			playSpeed  : 3000,
			preload    : 3,
			modal      : false,
			loop       : true,

			ajax  : {
				dataType : 'html',
				headers  : { 'X-fancyBox': true }
			},
			iframe : {
				scrolling : 'auto',
				preload   : true
			},
			swf : {
				wmode: 'transparent',
				allowfullscreen   : 'true',
				allowscriptaccess : 'always'
			},

			keys  : {
				next : {
					13 : 'left', // enter
					34 : 'up',   // page down
					39 : 'left', // right arrow
					40 : 'up'    // down arrow
				},
				prev : {
					8  : 'right',  // backspace
					33 : 'down',   // page up
					37 : 'right',  // left arrow
					38 : 'down'    // up arrow
				},
				close  : [27], // escape key
				play   : [32], // space - start/stop slideshow
				toggle : [70]  // letter "f" - toggle fullscreen
			},

			direction : {
				next : 'left',
				prev : 'right'
			},

			scrollOutside  : true,

			// Override some properties
			index   : 0,
			type    : null,
			href    : null,
			content : null,
			title   : null,

			// HTML templates
			tpl: {
				wrap     : '<div class="fancybox-wrap" tabIndex="-1"><div class="fancybox-skin"><div class="fancybox-outer"><div class="fancybox-inner"></div></div></div></div>',
				image    : '<img class="fancybox-image" src="{href}" alt="" />',
				iframe   : '<iframe id="fancybox-frame{rnd}" name="fancybox-frame{rnd}" class="fancybox-iframe" frameborder="0" vspace="0" hspace="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen' + (IE ? ' allowtransparency="true"' : '') + '></iframe>',
				error    : '<p class="fancybox-error">The requested content cannot be loaded.<br/>Please try again later.</p>',
				closeBtn : '<a title="Close" class="fancybox-item fancybox-close" href="javascript:;"></a>',
				next     : '<a title="Next" class="fancybox-nav fancybox-next" href="javascript:;"><span></span></a>',
				prev     : '<a title="Previous" class="fancybox-nav fancybox-prev" href="javascript:;"><span></span></a>'
			},

			// Properties for each animation type
			// Opening fancyBox
			openEffect  : 'fade', // 'elastic', 'fade' or 'none'
			openSpeed   : 250,
			openEasing  : 'swing',
			openOpacity : true,
			openMethod  : 'zoomIn',

			// Closing fancyBox
			closeEffect  : 'fade', // 'elastic', 'fade' or 'none'
			closeSpeed   : 250,
			closeEasing  : 'swing',
			closeOpacity : true,
			closeMethod  : 'zoomOut',

			// Changing next gallery item
			nextEffect : 'elastic', // 'elastic', 'fade' or 'none'
			nextSpeed  : 250,
			nextEasing : 'swing',
			nextMethod : 'changeIn',

			// Changing previous gallery item
			prevEffect : 'elastic', // 'elastic', 'fade' or 'none'
			prevSpeed  : 250,
			prevEasing : 'swing',
			prevMethod : 'changeOut',

			// Enable default helpers
			helpers : {
				overlay : true,
				title   : true
			},

			// Callbacks
			onCancel     : $.noop, // If canceling
			beforeLoad   : $.noop, // Before loading
			afterLoad    : $.noop, // After loading
			beforeShow   : $.noop, // Before changing in current item
			afterShow    : $.noop, // After opening
			beforeChange : $.noop, // Before changing gallery item
			beforeClose  : $.noop, // Before closing
			afterClose   : $.noop  // After closing
		},

		//Current state
		group    : {}, // Selected group
		opts     : {}, // Group options
		previous : null,  // Previous element
		coming   : null,  // Element being loaded
		current  : null,  // Currently loaded element
		isActive : false, // Is activated
		isOpen   : false, // Is currently open
		isOpened : false, // Have been fully opened at least once

		wrap  : null,
		skin  : null,
		outer : null,
		inner : null,

		player : {
			timer    : null,
			isActive : false
		},

		// Loaders
		ajaxLoad   : null,
		imgPreload : null,

		// Some collections
		transitions : {},
		helpers     : {},

		/*
		 *	Static methods
		 */

		open: function (group, opts) {
			if (!group) {
				return;
			}

			if (!$.isPlainObject(opts)) {
				opts = {};
			}

			// Close if already active
			if (false === F.close(true)) {
				return;
			}

			// Normalize group
			if (!$.isArray(group)) {
				group = isQuery(group) ? $(group).get() : [group];
			}

			// Recheck if the type of each element is `object` and set content type (image, ajax, etc)
			$.each(group, function(i, element) {
				var obj = {},
					href,
					title,
					content,
					type,
					rez,
					hrefParts,
					selector;

				if ($.type(element) === "object") {
					// Check if is DOM element
					if (element.nodeType) {
						element = $(element);
					}

					if (isQuery(element)) {
						obj = {
							href    : element.data('fancybox-href') || element.attr('href'),
							title   : element.data('fancybox-title') || element.attr('title'),
							isDom   : true,
							element : element
						};

						if ($.metadata) {
							$.extend(true, obj, element.metadata());
						}

					} else {
						obj = element;
					}
				}

				href  = opts.href  || obj.href || (isString(element) ? element : null);
				title = opts.title !== undefined ? opts.title : obj.title || '';

				content = opts.content || obj.content;
				type    = content ? 'html' : (opts.type  || obj.type);

				if (!type && obj.isDom) {
					type = element.data('fancybox-type');

					if (!type) {
						rez  = element.prop('class').match(/fancybox\.(\w+)/);
						type = rez ? rez[1] : null;
					}
				}

				if (isString(href)) {
					// Try to guess the content type
					if (!type) {
						if (F.isImage(href)) {
							type = 'image';

						} else if (F.isSWF(href)) {
							type = 'swf';

						} else if (href.charAt(0) === '#') {
							type = 'inline';

						} else if (isString(element)) {
							type    = 'html';
							content = element;
						}
					}

					// Split url into two pieces with source url and content selector, e.g,
					// "/mypage.html #my_id" will load "/mypage.html" and display element having id "my_id"
					if (type === 'ajax') {
						hrefParts = href.split(/\s+/, 2);
						href      = hrefParts.shift();
						selector  = hrefParts.shift();
					}
				}

				if (!content) {
					if (type === 'inline') {
						if (href) {
							content = $( isString(href) ? href.replace(/.*(?=#[^\s]+$)/, '') : href ); //strip for ie7

						} else if (obj.isDom) {
							content = element;
						}

					} else if (type === 'html') {
						content = href;

					} else if (!type && !href && obj.isDom) {
						type    = 'inline';
						content = element;
					}
				}

				$.extend(obj, {
					href     : href,
					type     : type,
					content  : content,
					title    : title,
					selector : selector
				});

				group[ i ] = obj;
			});

			// Extend the defaults
			F.opts = $.extend(true, {}, F.defaults, opts);

			// All options are merged recursive except keys
			if (opts.keys !== undefined) {
				F.opts.keys = opts.keys ? $.extend({}, F.defaults.keys, opts.keys) : false;
			}

			F.group = group;

			return F._start(F.opts.index);
		},

		// Cancel image loading or abort ajax request
		cancel: function () {
			var coming = F.coming;

			if (!coming || false === F.trigger('onCancel')) {
				return;
			}

			F.hideLoading();

			if (F.ajaxLoad) {
				F.ajaxLoad.abort();
			}

			F.ajaxLoad = null;

			if (F.imgPreload) {
				F.imgPreload.onload = F.imgPreload.onerror = null;
			}

			if (coming.wrap) {
				coming.wrap.stop(true, true).trigger('onReset').remove();
			}

			F.coming = null;

			// If the first item has been canceled, then clear everything
			if (!F.current) {
				F._afterZoomOut( coming );
			}
		},

		// Start closing animation if is open; remove immediately if opening/closing
		close: function (event) {
			F.cancel();

			if (false === F.trigger('beforeClose')) {
				return;
			}

			F.unbindEvents();

			if (!F.isActive) {
				return;
			}

			if (!F.isOpen || event === true) {
				$('.fancybox-wrap').stop(true).trigger('onReset').remove();

				F._afterZoomOut();

			} else {
				F.isOpen = F.isOpened = false;
				F.isClosing = true;

				$('.fancybox-item, .fancybox-nav').remove();

				F.wrap.stop(true, true).removeClass('fancybox-opened');

				F.transitions[ F.current.closeMethod ]();
			}
		},

		// Manage slideshow:
		//   $.fancybox.play(); - toggle slideshow
		//   $.fancybox.play( true ); - start
		//   $.fancybox.play( false ); - stop
		play: function ( action ) {
			var clear = function () {
					clearTimeout(F.player.timer);
				},
				set = function () {
					clear();

					if (F.current && F.player.isActive) {
						F.player.timer = setTimeout(F.next, F.current.playSpeed);
					}
				},
				stop = function () {
					clear();

					D.unbind('.player');

					F.player.isActive = false;

					F.trigger('onPlayEnd');
				},
				start = function () {
					if (F.current && (F.current.loop || F.current.index < F.group.length - 1)) {
						F.player.isActive = true;

						D.bind({
							'onCancel.player beforeClose.player' : stop,
							'onUpdate.player'   : set,
							'beforeLoad.player' : clear
						});

						set();

						F.trigger('onPlayStart');
					}
				};

			if (action === true || (!F.player.isActive && action !== false)) {
				start();
			} else {
				stop();
			}
		},

		// Navigate to next gallery item
		next: function ( direction ) {
			var current = F.current;

			if (current) {
				if (!isString(direction)) {
					direction = current.direction.next;
				}

				F.jumpto(current.index + 1, direction, 'next');
			}
		},

		// Navigate to previous gallery item
		prev: function ( direction ) {
			var current = F.current;

			if (current) {
				if (!isString(direction)) {
					direction = current.direction.prev;
				}

				F.jumpto(current.index - 1, direction, 'prev');
			}
		},

		// Navigate to gallery item by index
		jumpto: function ( index, direction, router ) {
			var current = F.current;

			if (!current) {
				return;
			}

			index = getScalar(index);

			F.direction = direction || current.direction[ (index >= current.index ? 'next' : 'prev') ];
			F.router    = router || 'jumpto';

			if (current.loop) {
				if (index < 0) {
					index = current.group.length + (index % current.group.length);
				}

				index = index % current.group.length;
			}

			if (current.group[ index ] !== undefined) {
				F.cancel();

				F._start(index);
			}
		},

		// Center inside viewport and toggle position type to fixed or absolute if needed
		reposition: function (e, onlyAbsolute) {
			var current = F.current,
				wrap    = current ? current.wrap : null,
				pos;

			if (wrap) {
				pos = F._getPosition(onlyAbsolute);

				if (e && e.type === 'scroll') {
					delete pos.position;

					wrap.stop(true, true).animate(pos, 200);

				} else {
					wrap.css(pos);

					current.pos = $.extend({}, current.dim, pos);
				}
			}
		},

		update: function (e) {
			var type = (e && e.type),
				anyway = !type || type === 'orientationchange';

			if (anyway) {
				clearTimeout(didUpdate);

				didUpdate = null;
			}

			if (!F.isOpen || didUpdate) {
				return;
			}

			didUpdate = setTimeout(function() {
				var current = F.current;

				if (!current || F.isClosing) {
					return;
				}

				F.wrap.removeClass('fancybox-tmp');

				if (anyway || type === 'load' || (type === 'resize' && current.autoResize)) {
					F._setDimension();
				}

				if (!(type === 'scroll' && current.canShrink)) {
					F.reposition(e);
				}

				F.trigger('onUpdate');

				didUpdate = null;

			}, (anyway && !isTouch ? 0 : 300));
		},

		// Shrink content to fit inside viewport or restore if resized
		toggle: function ( action ) {
			if (F.isOpen) {
				F.current.fitToView = $.type(action) === "boolean" ? action : !F.current.fitToView;

				// Help browser to restore document dimensions
				if (isTouch) {
					F.wrap.removeAttr('style').addClass('fancybox-tmp');

					F.trigger('onUpdate');
				}

				F.update();
			}
		},

		hideLoading: function () {
			D.unbind('.loading');

			$('#fancybox-loading').remove();
		},

		showLoading: function () {
			var el, viewport;

			F.hideLoading();

			el = $('<div id="fancybox-loading"><div></div></div>').click(F.cancel).appendTo('body');

			// If user will press the escape-button, the request will be canceled
			D.bind('keydown.loading', function(e) {
				if ((e.which || e.keyCode) === 27) {
					e.preventDefault();

					F.cancel();
				}
			});

			if (!F.defaults.fixed) {
				viewport = F.getViewport();

				el.css({
					position : 'absolute',
					top  : (viewport.h * 0.5) + viewport.y,
					left : (viewport.w * 0.5) + viewport.x
				});
			}
		},

		getViewport: function () {
			var locked = (F.current && F.current.locked) || false,
				rez    = {
					x: W.scrollLeft(),
					y: W.scrollTop()
				};

			if (locked) {
				rez.w = locked[0].clientWidth;
				rez.h = locked[0].clientHeight;

			} else {
				// See http://bugs.jquery.com/ticket/6724
				rez.w = isTouch && window.innerWidth  ? window.innerWidth  : W.width();
				rez.h = isTouch && window.innerHeight ? window.innerHeight : W.height();
			}

			return rez;
		},

		// Unbind the keyboard / clicking actions
		unbindEvents: function () {
			if (F.wrap && isQuery(F.wrap)) {
				F.wrap.unbind('.fb');
			}

			D.unbind('.fb');
			W.unbind('.fb');
		},

		bindEvents: function () {
			var current = F.current,
				keys;

			if (!current) {
				return;
			}

			// Changing document height on iOS devices triggers a 'resize' event,
			// that can change document height... repeating infinitely
			W.bind('orientationchange.fb' + (isTouch ? '' : ' resize.fb') + (current.autoCenter && !current.locked ? ' scroll.fb' : ''), F.update);

			keys = current.keys;

			if (keys) {
				D.bind('keydown.fb', function (e) {
					var code   = e.which || e.keyCode,
						target = e.target || e.srcElement;

					// Skip esc key if loading, because showLoading will cancel preloading
					if (code === 27 && F.coming) {
						return false;
					}

					// Ignore key combinations and key events within form elements
					if (!e.ctrlKey && !e.altKey && !e.shiftKey && !e.metaKey && !(target && (target.type || $(target).is('[contenteditable]')))) {
						$.each(keys, function(i, val) {
							if (current.group.length > 1 && val[ code ] !== undefined) {
								F[ i ]( val[ code ] );

								e.preventDefault();
								return false;
							}

							if ($.inArray(code, val) > -1) {
								F[ i ] ();

								e.preventDefault();
								return false;
							}
						});
					}
				});
			}

			if ($.fn.mousewheel && current.mouseWheel) {
				F.wrap.bind('mousewheel.fb', function (e, delta, deltaX, deltaY) {
					var target = e.target || null,
						parent = $(target),
						canScroll = false;

					while (parent.length) {
						if (canScroll || parent.is('.fancybox-skin') || parent.is('.fancybox-wrap')) {
							break;
						}

						canScroll = isScrollable( parent[0] );
						parent    = $(parent).parent();
					}

					if (delta !== 0 && !canScroll) {
						if (F.group.length > 1 && !current.canShrink) {
							if (deltaY > 0 || deltaX > 0) {
								F.prev( deltaY > 0 ? 'down' : 'left' );

							} else if (deltaY < 0 || deltaX < 0) {
								F.next( deltaY < 0 ? 'up' : 'right' );
							}

							e.preventDefault();
						}
					}
				});
			}
		},

		trigger: function (event, o) {
			var ret, obj = o || F.coming || F.current;

			if (!obj) {
				return;
			}

			if ($.isFunction( obj[event] )) {
				ret = obj[event].apply(obj, Array.prototype.slice.call(arguments, 1));
			}

			if (ret === false) {
				return false;
			}

			if (obj.helpers) {
				$.each(obj.helpers, function (helper, opts) {
					if (opts && F.helpers[helper] && $.isFunction(F.helpers[helper][event])) {
						F.helpers[helper][event]($.extend(true, {}, F.helpers[helper].defaults, opts), obj);
					}
				});
			}

			D.trigger(event);
		},

		isImage: function (str) {
			return isString(str) && str.match(/(^data:image\/.*,)|(\.(jp(e|g|eg)|gif|png|bmp|webp|svg)((\?|#).*)?$)/i);
		},

		isSWF: function (str) {
			return isString(str) && str.match(/\.(swf)((\?|#).*)?$/i);
		},

		_start: function (index) {
			var coming = {},
				obj,
				href,
				type,
				margin,
				padding;

			index = getScalar( index );
			obj   = F.group[ index ] || null;

			if (!obj) {
				return false;
			}

			coming = $.extend(true, {}, F.opts, obj);

			// Convert margin and padding properties to array - top, right, bottom, left
			margin  = coming.margin;
			padding = coming.padding;

			if ($.type(margin) === 'number') {
				coming.margin = [margin, margin, margin, margin];
			}

			if ($.type(padding) === 'number') {
				coming.padding = [padding, padding, padding, padding];
			}

			// 'modal' propery is just a shortcut
			if (coming.modal) {
				$.extend(true, coming, {
					closeBtn   : false,
					closeClick : false,
					nextClick  : false,
					arrows     : false,
					mouseWheel : false,
					keys       : null,
					helpers: {
						overlay : {
							closeClick : false
						}
					}
				});
			}

			// 'autoSize' property is a shortcut, too
			if (coming.autoSize) {
				coming.autoWidth = coming.autoHeight = true;
			}

			if (coming.width === 'auto') {
				coming.autoWidth = true;
			}

			if (coming.height === 'auto') {
				coming.autoHeight = true;
			}

			/*
			 * Add reference to the group, so it`s possible to access from callbacks, example:
			 * afterLoad : function() {
			 *     this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
			 * }
			 */

			coming.group  = F.group;
			coming.index  = index;

			// Give a chance for callback or helpers to update coming item (type, title, etc)
			F.coming = coming;

			if (false === F.trigger('beforeLoad')) {
				F.coming = null;

				return;
			}

			type = coming.type;
			href = coming.href;

			if (!type) {
				F.coming = null;

				//If we can not determine content type then drop silently or display next/prev item if looping through gallery
				if (F.current && F.router && F.router !== 'jumpto') {
					F.current.index = index;

					return F[ F.router ]( F.direction );
				}

				return false;
			}

			F.isActive = true;

			if (type === 'image' || type === 'swf') {
				coming.autoHeight = coming.autoWidth = false;
				coming.scrolling  = 'visible';
			}

			if (type === 'image') {
				coming.aspectRatio = true;
			}

			if (type === 'iframe' && isTouch) {
				coming.scrolling = 'scroll';
			}

			// Build the neccessary markup
			coming.wrap = $(coming.tpl.wrap).addClass('fancybox-' + (isTouch ? 'mobile' : 'desktop') + ' fancybox-type-' + type + ' fancybox-tmp ' + coming.wrapCSS).appendTo( coming.parent || 'body' );

			$.extend(coming, {
				skin  : $('.fancybox-skin',  coming.wrap),
				outer : $('.fancybox-outer', coming.wrap),
				inner : $('.fancybox-inner', coming.wrap)
			});

			$.each(["Top", "Right", "Bottom", "Left"], function(i, v) {
				coming.skin.css('padding' + v, getValue(coming.padding[ i ]));
			});

			F.trigger('onReady');

			// Check before try to load; 'inline' and 'html' types need content, others - href
			if (type === 'inline' || type === 'html') {
				if (!coming.content || !coming.content.length) {
					return F._error( 'content' );
				}

			} else if (!href) {
				return F._error( 'href' );
			}

			if (type === 'image') {
				F._loadImage();

			} else if (type === 'ajax') {
				F._loadAjax();

			} else if (type === 'iframe') {
				F._loadIframe();

			} else {
				F._afterLoad();
			}
		},

		_error: function ( type ) {
			$.extend(F.coming, {
				type       : 'html',
				autoWidth  : true,
				autoHeight : true,
				minWidth   : 0,
				minHeight  : 0,
				scrolling  : 'no',
				hasError   : type,
				content    : F.coming.tpl.error
			});

			F._afterLoad();
		},

		_loadImage: function () {
			// Reset preload image so it is later possible to check "complete" property
			var img = F.imgPreload = new Image();

			img.onload = function () {
				this.onload = this.onerror = null;

				F.coming.width  = this.width / F.opts.pixelRatio;
				F.coming.height = this.height / F.opts.pixelRatio;

				F._afterLoad();
			};

			img.onerror = function () {
				this.onload = this.onerror = null;

				F._error( 'image' );
			};

			img.src = F.coming.href;

			if (img.complete !== true) {
				F.showLoading();
			}
		},

		_loadAjax: function () {
			var coming = F.coming;

			F.showLoading();

			F.ajaxLoad = $.ajax($.extend({}, coming.ajax, {
				url: coming.href,
				error: function (jqXHR, textStatus) {
					if (F.coming && textStatus !== 'abort') {
						F._error( 'ajax', jqXHR );

					} else {
						F.hideLoading();
					}
				},
				success: function (data, textStatus) {
					if (textStatus === 'success') {
						coming.content = data;

						F._afterLoad();
					}
				}
			}));
		},

		_loadIframe: function() {
			var coming = F.coming,
				iframe = $(coming.tpl.iframe.replace(/\{rnd\}/g, new Date().getTime()))
					.attr('scrolling', isTouch ? 'auto' : coming.iframe.scrolling)
					.attr('src', coming.href);

			// This helps IE
			$(coming.wrap).bind('onReset', function () {
				try {
					$(this).find('iframe').hide().attr('src', '//about:blank').end().empty();
				} catch (e) {}
			});

			if (coming.iframe.preload) {
				F.showLoading();

				iframe.one('load', function() {
					$(this).data('ready', 1);

					// iOS will lose scrolling if we resize
					if (!isTouch) {
						$(this).bind('load.fb', F.update);
					}

					// Without this trick:
					//   - iframe won't scroll on iOS devices
					//   - IE7 sometimes displays empty iframe
					$(this).parents('.fancybox-wrap').width('100%').removeClass('fancybox-tmp').show();

					F._afterLoad();
				});
			}

			coming.content = iframe.appendTo( coming.inner );

			if (!coming.iframe.preload) {
				F._afterLoad();
			}
		},

		_preloadImages: function() {
			var group   = F.group,
				current = F.current,
				len     = group.length,
				cnt     = current.preload ? Math.min(current.preload, len - 1) : 0,
				item,
				i;

			for (i = 1; i <= cnt; i += 1) {
				item = group[ (current.index + i ) % len ];

				if (item.type === 'image' && item.href) {
					new Image().src = item.href;
				}
			}
		},

		_afterLoad: function () {
			var coming   = F.coming,
				previous = F.current,
				placeholder = 'fancybox-placeholder',
				current,
				content,
				type,
				scrolling,
				href,
				embed;

			F.hideLoading();

			if (!coming || F.isActive === false) {
				return;
			}

			if (false === F.trigger('afterLoad', coming, previous)) {
				coming.wrap.stop(true).trigger('onReset').remove();

				F.coming = null;

				return;
			}

			if (previous) {
				F.trigger('beforeChange', previous);

				previous.wrap.stop(true).removeClass('fancybox-opened')
					.find('.fancybox-item, .fancybox-nav')
					.remove();
			}

			F.unbindEvents();

			current   = coming;
			content   = coming.content;
			type      = coming.type;
			scrolling = coming.scrolling;

			$.extend(F, {
				wrap  : current.wrap,
				skin  : current.skin,
				outer : current.outer,
				inner : current.inner,
				current  : current,
				previous : previous
			});

			href = current.href;

			switch (type) {
				case 'inline':
				case 'ajax':
				case 'html':
					if (current.selector) {
						content = $('<div>').html(content).find(current.selector);

					} else if (isQuery(content)) {
						if (!content.data(placeholder)) {
							content.data(placeholder, $('<div class="' + placeholder + '"></div>').insertAfter( content ).hide() );
						}

						content = content.show().detach();

						current.wrap.bind('onReset', function () {
							if ($(this).find(content).length) {
								content.hide().replaceAll( content.data(placeholder) ).data(placeholder, false);
							}
						});
					}
				break;

				case 'image':
					content = current.tpl.image.replace('{href}', href);
				break;

				case 'swf':
					content = '<object id="fancybox-swf" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="100%" height="100%"><param name="movie" value="' + href + '"></param>';
					embed   = '';

					$.each(current.swf, function(name, val) {
						content += '<param name="' + name + '" value="' + val + '"></param>';
						embed   += ' ' + name + '="' + val + '"';
					});

					content += '<embed src="' + href + '" type="application/x-shockwave-flash" width="100%" height="100%"' + embed + '></embed></object>';
				break;
			}

			if (!(isQuery(content) && content.parent().is(current.inner))) {
				current.inner.append( content );
			}

			// Give a chance for helpers or callbacks to update elements
			F.trigger('beforeShow');

			// Set scrolling before calculating dimensions
			current.inner.css('overflow', scrolling === 'yes' ? 'scroll' : (scrolling === 'no' ? 'hidden' : scrolling));

			// Set initial dimensions and start position
			F._setDimension();

			F.reposition();

			F.isOpen = false;
			F.coming = null;

			F.bindEvents();

			if (!F.isOpened) {
				$('.fancybox-wrap').not( current.wrap ).stop(true).trigger('onReset').remove();

			} else if (previous.prevMethod) {
				F.transitions[ previous.prevMethod ]();
			}

			F.transitions[ F.isOpened ? current.nextMethod : current.openMethod ]();

			F._preloadImages();
		},

		_setDimension: function () {
			var viewport   = F.getViewport(),
				steps      = 0,
				canShrink  = false,
				canExpand  = false,
				wrap       = F.wrap,
				skin       = F.skin,
				inner      = F.inner,
				current    = F.current,
				width      = current.width,
				height     = current.height,
				minWidth   = current.minWidth,
				minHeight  = current.minHeight,
				maxWidth   = current.maxWidth,
				maxHeight  = current.maxHeight,
				scrolling  = current.scrolling,
				scrollOut  = current.scrollOutside ? current.scrollbarWidth : 0,
				margin     = current.margin,
				wMargin    = getScalar(margin[1] + margin[3]),
				hMargin    = getScalar(margin[0] + margin[2]),
				wPadding,
				hPadding,
				wSpace,
				hSpace,
				origWidth,
				origHeight,
				origMaxWidth,
				origMaxHeight,
				ratio,
				width_,
				height_,
				maxWidth_,
				maxHeight_,
				iframe,
				body;

			// Reset dimensions so we could re-check actual size
			wrap.add(skin).add(inner).width('auto').height('auto').removeClass('fancybox-tmp');

			wPadding = getScalar(skin.outerWidth(true)  - skin.width());
			hPadding = getScalar(skin.outerHeight(true) - skin.height());

			// Any space between content and viewport (margin, padding, border, title)
			wSpace = wMargin + wPadding;
			hSpace = hMargin + hPadding;

			origWidth  = isPercentage(width)  ? (viewport.w - wSpace) * getScalar(width)  / 100 : width;
			origHeight = isPercentage(height) ? (viewport.h - hSpace) * getScalar(height) / 100 : height;

			if (current.type === 'iframe') {
				iframe = current.content;

				if (current.autoHeight && iframe.data('ready') === 1) {
					try {
						if (iframe[0].contentWindow.document.location) {
							inner.width( origWidth ).height(9999);

							body = iframe.contents().find('body');

							if (scrollOut) {
								body.css('overflow-x', 'hidden');
							}

							origHeight = body.outerHeight(true);
						}

					} catch (e) {}
				}

			} else if (current.autoWidth || current.autoHeight) {
				inner.addClass( 'fancybox-tmp' );

				// Set width or height in case we need to calculate only one dimension
				if (!current.autoWidth) {
					inner.width( origWidth );
				}

				if (!current.autoHeight) {
					inner.height( origHeight );
				}

				if (current.autoWidth) {
					origWidth = inner.width();
				}

				if (current.autoHeight) {
					origHeight = inner.height();
				}

				inner.removeClass( 'fancybox-tmp' );
			}

			width  = getScalar( origWidth );
			height = getScalar( origHeight );

			ratio  = origWidth / origHeight;

			// Calculations for the content
			minWidth  = getScalar(isPercentage(minWidth) ? getScalar(minWidth, 'w') - wSpace : minWidth);
			maxWidth  = getScalar(isPercentage(maxWidth) ? getScalar(maxWidth, 'w') - wSpace : maxWidth);

			minHeight = getScalar(isPercentage(minHeight) ? getScalar(minHeight, 'h') - hSpace : minHeight);
			maxHeight = getScalar(isPercentage(maxHeight) ? getScalar(maxHeight, 'h') - hSpace : maxHeight);

			// These will be used to determine if wrap can fit in the viewport
			origMaxWidth  = maxWidth;
			origMaxHeight = maxHeight;

			if (current.fitToView) {
				maxWidth  = Math.min(viewport.w - wSpace, maxWidth);
				maxHeight = Math.min(viewport.h - hSpace, maxHeight);
			}

			maxWidth_  = viewport.w - wMargin;
			maxHeight_ = viewport.h - hMargin;

			if (current.aspectRatio) {
				if (width > maxWidth) {
					width  = maxWidth;
					height = getScalar(width / ratio);
				}

				if (height > maxHeight) {
					height = maxHeight;
					width  = getScalar(height * ratio);
				}

				if (width < minWidth) {
					width  = minWidth;
					height = getScalar(width / ratio);
				}

				if (height < minHeight) {
					height = minHeight;
					width  = getScalar(height * ratio);
				}

			} else {
				width = Math.max(minWidth, Math.min(width, maxWidth));

				if (current.autoHeight && current.type !== 'iframe') {
					inner.width( width );

					height = inner.height();
				}

				height = Math.max(minHeight, Math.min(height, maxHeight));
			}

			// Try to fit inside viewport (including the title)
			if (current.fitToView) {
				inner.width( width ).height( height );

				wrap.width( width + wPadding );

				// Real wrap dimensions
				width_  = wrap.width();
				height_ = wrap.height();

				if (current.aspectRatio) {
					while ((width_ > maxWidth_ || height_ > maxHeight_) && width > minWidth && height > minHeight) {
						if (steps++ > 19) {
							break;
						}

						height = Math.max(minHeight, Math.min(maxHeight, height - 10));
						width  = getScalar(height * ratio);

						if (width < minWidth) {
							width  = minWidth;
							height = getScalar(width / ratio);
						}

						if (width > maxWidth) {
							width  = maxWidth;
							height = getScalar(width / ratio);
						}

						inner.width( width ).height( height );

						wrap.width( width + wPadding );

						width_  = wrap.width();
						height_ = wrap.height();
					}

				} else {
					width  = Math.max(minWidth,  Math.min(width,  width  - (width_  - maxWidth_)));
					height = Math.max(minHeight, Math.min(height, height - (height_ - maxHeight_)));
				}
			}

			if (scrollOut && scrolling === 'auto' && height < origHeight && (width + wPadding + scrollOut) < maxWidth_) {
				width += scrollOut;
			}

			inner.width( width ).height( height );

			wrap.width( width + wPadding );

			width_  = wrap.width();
			height_ = wrap.height();

			canShrink = (width_ > maxWidth_ || height_ > maxHeight_) && width > minWidth && height > minHeight;
			canExpand = current.aspectRatio ? (width < origMaxWidth && height < origMaxHeight && width < origWidth && height < origHeight) : ((width < origMaxWidth || height < origMaxHeight) && (width < origWidth || height < origHeight));

			$.extend(current, {
				dim : {
					width	: getValue( width_ ),
					height	: getValue( height_ )
				},
				origWidth  : origWidth,
				origHeight : origHeight,
				canShrink  : canShrink,
				canExpand  : canExpand,
				wPadding   : wPadding,
				hPadding   : hPadding,
				wrapSpace  : height_ - skin.outerHeight(true),
				skinSpace  : skin.height() - height
			});

			if (!iframe && current.autoHeight && height > minHeight && height < maxHeight && !canExpand) {
				inner.height('auto');
			}
		},

		_getPosition: function (onlyAbsolute) {
			var current  = F.current,
				viewport = F.getViewport(),
				margin   = current.margin,
				width    = F.wrap.width()  + margin[1] + margin[3],
				height   = F.wrap.height() + margin[0] + margin[2],
				rez      = {
					position: 'absolute',
					top  : margin[0],
					left : margin[3]
				};

			if (current.autoCenter && current.fixed && !onlyAbsolute && height <= viewport.h && width <= viewport.w) {
				rez.position = 'fixed';

			} else if (!current.locked) {
				rez.top  += viewport.y;
				rez.left += viewport.x;
			}

			rez.top  = getValue(Math.max(rez.top,  rez.top  + ((viewport.h - height) * current.topRatio)));
			rez.left = getValue(Math.max(rez.left, rez.left + ((viewport.w - width)  * current.leftRatio)));

			return rez;
		},

		_afterZoomIn: function () {
			var current = F.current;

			if (!current) {
				return;
			}

			F.isOpen = F.isOpened = true;

			F.wrap.css('overflow', 'visible').addClass('fancybox-opened');

			F.update();

			// Assign a click event
			if ( current.closeClick || (current.nextClick && F.group.length > 1) ) {
				F.inner.css('cursor', 'pointer').bind('click.fb', function(e) {
					if (!$(e.target).is('a') && !$(e.target).parent().is('a')) {
						e.preventDefault();

						F[ current.closeClick ? 'close' : 'next' ]();
					}
				});
			}

			// Create a close button
			if (current.closeBtn) {
				$(current.tpl.closeBtn).appendTo(F.skin).bind('click.fb', function(e) {
					e.preventDefault();

					F.close();
				});
			}

			// Create navigation arrows
			if (current.arrows && F.group.length > 1) {
				if (current.loop || current.index > 0) {
					$(current.tpl.prev).appendTo(F.outer).bind('click.fb', F.prev);
				}

				if (current.loop || current.index < F.group.length - 1) {
					$(current.tpl.next).appendTo(F.outer).bind('click.fb', F.next);
				}
			}

			F.trigger('afterShow');

			// Stop the slideshow if this is the last item
			if (!current.loop && current.index === current.group.length - 1) {
				F.play( false );

			} else if (F.opts.autoPlay && !F.player.isActive) {
				F.opts.autoPlay = false;

				F.play();
			}
		},

		_afterZoomOut: function ( obj ) {
			obj = obj || F.current;

			$('.fancybox-wrap').trigger('onReset').remove();

			$.extend(F, {
				group  : {},
				opts   : {},
				router : false,
				current   : null,
				isActive  : false,
				isOpened  : false,
				isOpen    : false,
				isClosing : false,
				wrap   : null,
				skin   : null,
				outer  : null,
				inner  : null
			});

			F.trigger('afterClose', obj);
		}
	});

	/*
	 *	Default transitions
	 */

	F.transitions = {
		getOrigPosition: function () {
			var current  = F.current,
				element  = current.element,
				orig     = current.orig,
				pos      = {},
				width    = 50,
				height   = 50,
				hPadding = current.hPadding,
				wPadding = current.wPadding,
				viewport = F.getViewport();

			if (!orig && current.isDom && element.is(':visible')) {
				orig = element.find('img:first');

				if (!orig.length) {
					orig = element;
				}
			}

			if (isQuery(orig)) {
				pos = orig.offset();

				if (orig.is('img')) {
					width  = orig.outerWidth();
					height = orig.outerHeight();
				}

			} else {
				pos.top  = viewport.y + (viewport.h - height) * current.topRatio;
				pos.left = viewport.x + (viewport.w - width)  * current.leftRatio;
			}

			if (F.wrap.css('position') === 'fixed' || current.locked) {
				pos.top  -= viewport.y;
				pos.left -= viewport.x;
			}

			pos = {
				top     : getValue(pos.top  - hPadding * current.topRatio),
				left    : getValue(pos.left - wPadding * current.leftRatio),
				width   : getValue(width  + wPadding),
				height  : getValue(height + hPadding)
			};

			return pos;
		},

		step: function (now, fx) {
			var ratio,
				padding,
				value,
				prop       = fx.prop,
				current    = F.current,
				wrapSpace  = current.wrapSpace,
				skinSpace  = current.skinSpace;

			if (prop === 'width' || prop === 'height') {
				ratio = fx.end === fx.start ? 1 : (now - fx.start) / (fx.end - fx.start);

				if (F.isClosing) {
					ratio = 1 - ratio;
				}

				padding = prop === 'width' ? current.wPadding : current.hPadding;
				value   = now - padding;

				F.skin[ prop ](  getScalar( prop === 'width' ?  value : value - (wrapSpace * ratio) ) );
				F.inner[ prop ]( getScalar( prop === 'width' ?  value : value - (wrapSpace * ratio) - (skinSpace * ratio) ) );
			}
		},

		zoomIn: function () {
			var current  = F.current,
				startPos = current.pos,
				effect   = current.openEffect,
				elastic  = effect === 'elastic',
				endPos   = $.extend({opacity : 1}, startPos);

			// Remove "position" property that breaks older IE
			delete endPos.position;

			if (elastic) {
				startPos = this.getOrigPosition();

				if (current.openOpacity) {
					startPos.opacity = 0.1;
				}

			} else if (effect === 'fade') {
				startPos.opacity = 0.1;
			}

			F.wrap.css(startPos).animate(endPos, {
				duration : effect === 'none' ? 0 : current.openSpeed,
				easing   : current.openEasing,
				step     : elastic ? this.step : null,
				complete : F._afterZoomIn
			});
		},

		zoomOut: function () {
			var current  = F.current,
				effect   = current.closeEffect,
				elastic  = effect === 'elastic',
				endPos   = {opacity : 0.1};

			if (elastic) {
				endPos = this.getOrigPosition();

				if (current.closeOpacity) {
					endPos.opacity = 0.1;
				}
			}

			F.wrap.animate(endPos, {
				duration : effect === 'none' ? 0 : current.closeSpeed,
				easing   : current.closeEasing,
				step     : elastic ? this.step : null,
				complete : F._afterZoomOut
			});
		},

		changeIn: function () {
			var current   = F.current,
				effect    = current.nextEffect,
				startPos  = current.pos,
				endPos    = { opacity : 1 },
				direction = F.direction,
				distance  = 200,
				field;

			startPos.opacity = 0.1;

			if (effect === 'elastic') {
				field = direction === 'down' || direction === 'up' ? 'top' : 'left';

				if (direction === 'down' || direction === 'right') {
					startPos[ field ] = getValue(getScalar(startPos[ field ]) - distance);
					endPos[ field ]   = '+=' + distance + 'px';

				} else {
					startPos[ field ] = getValue(getScalar(startPos[ field ]) + distance);
					endPos[ field ]   = '-=' + distance + 'px';
				}
			}

			// Workaround for http://bugs.jquery.com/ticket/12273
			if (effect === 'none') {
				F._afterZoomIn();

			} else {
				F.wrap.css(startPos).animate(endPos, {
					duration : current.nextSpeed,
					easing   : current.nextEasing,
					complete : F._afterZoomIn
				});
			}
		},

		changeOut: function () {
			var previous  = F.previous,
				effect    = previous.prevEffect,
				endPos    = { opacity : 0.1 },
				direction = F.direction,
				distance  = 200;

			if (effect === 'elastic') {
				endPos[ direction === 'down' || direction === 'up' ? 'top' : 'left' ] = ( direction === 'up' || direction === 'left' ? '-' : '+' ) + '=' + distance + 'px';
			}

			previous.wrap.animate(endPos, {
				duration : effect === 'none' ? 0 : previous.prevSpeed,
				easing   : previous.prevEasing,
				complete : function () {
					$(this).trigger('onReset').remove();
				}
			});
		}
	};

	/*
	 *	Overlay helper
	 */

	F.helpers.overlay = {
		defaults : {
			closeClick : true,      // if true, fancyBox will be closed when user clicks on the overlay
			speedOut   : 200,       // duration of fadeOut animation
			showEarly  : true,      // indicates if should be opened immediately or wait until the content is ready
			css        : {},        // custom CSS properties
			locked     : !isTouch,  // if true, the content will be locked into overlay
			fixed      : true       // if false, the overlay CSS position property will not be set to "fixed"
		},

		overlay : null,      // current handle
		fixed   : false,     // indicates if the overlay has position "fixed"
		el      : $('html'), // element that contains "the lock"

		// Public methods
		create : function(opts) {
			opts = $.extend({}, this.defaults, opts);

			if (this.overlay) {
				this.close();
			}

			this.overlay = $('<div class="fancybox-overlay"></div>').appendTo( F.coming ? F.coming.parent : opts.parent );
			this.fixed   = false;

			if (opts.fixed && F.defaults.fixed) {
				this.overlay.addClass('fancybox-overlay-fixed');

				this.fixed = true;
			}
		},

		open : function(opts) {
			var that = this;

			opts = $.extend({}, this.defaults, opts);

			if (this.overlay) {
				this.overlay.unbind('.overlay').width('auto').height('auto');

			} else {
				this.create(opts);
			}

			if (!this.fixed) {
				W.bind('resize.overlay', $.proxy( this.update, this) );

				this.update();
			}

			if (opts.closeClick) {
				this.overlay.bind('click.overlay', function(e) {
					if ($(e.target).hasClass('fancybox-overlay')) {
						if (F.isActive) {
							F.close();
						} else {
							that.close();
						}

						return false;
					}
				});
			}

			this.overlay.css( opts.css ).show();
		},

		close : function() {
			var scrollV, scrollH;

			W.unbind('resize.overlay');

			if (this.el.hasClass('fancybox-lock')) {
				$('.fancybox-margin').removeClass('fancybox-margin');

				scrollV = W.scrollTop();
				scrollH = W.scrollLeft();

				this.el.removeClass('fancybox-lock');

				W.scrollTop( scrollV ).scrollLeft( scrollH );
			}

			$('.fancybox-overlay').remove().hide();

			$.extend(this, {
				overlay : null,
				fixed   : false
			});
		},

		// Private, callbacks

		update : function () {
			var width = '100%', offsetWidth;

			// Reset width/height so it will not mess
			this.overlay.width(width).height('100%');

			// jQuery does not return reliable result for IE
			if (IE) {
				offsetWidth = Math.max(document.documentElement.offsetWidth, document.body.offsetWidth);

				if (D.width() > offsetWidth) {
					width = D.width();
				}

			} else if (D.width() > W.width()) {
				width = D.width();
			}

			this.overlay.width(width).height(D.height());
		},

		// This is where we can manipulate DOM, because later it would cause iframes to reload
		onReady : function (opts, obj) {
			var overlay = this.overlay;

			$('.fancybox-overlay').stop(true, true);

			if (!overlay) {
				this.create(opts);
			}

			if (opts.locked && this.fixed && obj.fixed) {
				if (!overlay) {
					this.margin = D.height() > W.height() ? $('html').css('margin-right').replace("px", "") : false;
				}

				obj.locked = this.overlay.append( obj.wrap );
				obj.fixed  = false;
			}

			if (opts.showEarly === true) {
				this.beforeShow.apply(this, arguments);
			}
		},

		beforeShow : function(opts, obj) {
			var scrollV, scrollH;

			if (obj.locked) {
				if (this.margin !== false) {
					$('*').filter(function(){
						return ($(this).css('position') === 'fixed' && !$(this).hasClass("fancybox-overlay") && !$(this).hasClass("fancybox-wrap") );
					}).addClass('fancybox-margin');

					this.el.addClass('fancybox-margin');
				}

				scrollV = W.scrollTop();
				scrollH = W.scrollLeft();

				this.el.addClass('fancybox-lock');

				W.scrollTop( scrollV ).scrollLeft( scrollH );
			}

			this.open(opts);
		},

		onUpdate : function() {
			if (!this.fixed) {
				this.update();
			}
		},

		afterClose: function (opts) {
			// Remove overlay if exists and fancyBox is not opening
			// (e.g., it is not being open using afterClose callback)
			//if (this.overlay && !F.isActive) {
			if (this.overlay && !F.coming) {
				this.overlay.fadeOut(opts.speedOut, $.proxy( this.close, this ));
			}
		}
	};

	/*
	 *	Title helper
	 */

	F.helpers.title = {
		defaults : {
			type     : 'float', // 'float', 'inside', 'outside' or 'over',
			position : 'bottom' // 'top' or 'bottom'
		},

		beforeShow: function (opts) {
			var current = F.current,
				text    = current.title,
				type    = opts.type,
				title,
				target;

			if ($.isFunction(text)) {
				text = text.call(current.element, current);
			}

			if (!isString(text) || $.trim(text) === '') {
				return;
			}

			title = $('<div class="fancybox-title fancybox-title-' + type + '-wrap">' + text + '</div>');

			switch (type) {
				case 'inside':
					target = F.skin;
				break;

				case 'outside':
					target = F.wrap;
				break;

				case 'over':
					target = F.inner;
				break;

				default: // 'float'
					target = F.skin;

					title.appendTo('body');

					if (IE) {
						title.width( title.width() );
					}

					title.wrapInner('<span class="child"></span>');

					//Increase bottom margin so this title will also fit into viewport
					F.current.margin[2] += Math.abs( getScalar(title.css('margin-bottom')) );
				break;
			}

			title[ (opts.position === 'top' ? 'prependTo'  : 'appendTo') ](target);
		}
	};

	// jQuery plugin initialization
	$.fn.fancybox = function (options) {
		var index,
			that     = $(this),
			selector = this.selector || '',
			run      = function(e) {
				var what = $(this).blur(), idx = index, relType, relVal;

				if (!(e.ctrlKey || e.altKey || e.shiftKey || e.metaKey) && !what.is('.fancybox-wrap')) {
					relType = options.groupAttr || 'data-fancybox-group';
					relVal  = what.attr(relType);

					if (!relVal) {
						relType = 'rel';
						relVal  = what.get(0)[ relType ];
					}

					if (relVal && relVal !== '' && relVal !== 'nofollow') {
						what = selector.length ? $(selector) : that;
						what = what.filter('[' + relType + '="' + relVal + '"]');
						idx  = what.index(this);
					}

					options.index = idx;

					// Stop an event from bubbling if everything is fine
					if (F.open(what, options) !== false) {
						e.preventDefault();
					}
				}
			};

		options = options || {};
		index   = options.index || 0;

		if (!selector || options.live === false) {
			that.unbind('click.fb-start').bind('click.fb-start', run);

		} else {
			D.undelegate(selector, 'click.fb-start').delegate(selector + ":not('.fancybox-item, .fancybox-nav')", 'click.fb-start', run);
		}

		this.filter('[data-fancybox-start=1]').trigger('click');

		return this;
	};

	// Tests that need a body at doc ready
	D.ready(function() {
		var w1, w2;

		if ( $.scrollbarWidth === undefined ) {
			// http://benalman.com/projects/jquery-misc-plugins/#scrollbarwidth
			$.scrollbarWidth = function() {
				var parent = $('<div style="width:50px;height:50px;overflow:auto"><div/></div>').appendTo('body'),
					child  = parent.children(),
					width  = child.innerWidth() - child.height( 99 ).innerWidth();

				parent.remove();

				return width;
			};
		}

		if ( $.support.fixedPosition === undefined ) {
			$.support.fixedPosition = (function() {
				var elem  = $('<div style="position:fixed;top:20px;"></div>').appendTo('body'),
					fixed = ( elem[0].offsetTop === 20 || elem[0].offsetTop === 15 );

				elem.remove();

				return fixed;
			}());
		}

		$.extend(F.defaults, {
			scrollbarWidth : $.scrollbarWidth(),
			fixed  : $.support.fixedPosition,
			parent : $('body')
		});

		//Get real width of page scroll-bar
		w1 = $(window).width();

		H.addClass('fancybox-lock-test');

		w2 = $(window).width();

		H.removeClass('fancybox-lock-test');

		$("<style type='text/css'>.fancybox-margin{margin-right:" + (w2 - w1) + "px;}</style>").appendTo("head");
	});

}(window, document, jQuery));;
// ┌────────────────────────────────────────────────────────────────────┐ \\
// │ Raphaël 2.1.3 - JavaScript Vector Library                          │ \\
// ├────────────────────────────────────────────────────────────────────┤ \\
// │ Copyright © 2008-2012 Dmitry Baranovskiy (http://raphaeljs.com)    │ \\
// │ Copyright © 2008-2012 Sencha Labs (http://sencha.com)              │ \\
// ├────────────────────────────────────────────────────────────────────┤ \\
// │ Licensed under the MIT (http://raphaeljs.com/license.html) license.│ \\
// └────────────────────────────────────────────────────────────────────┘ \\
!function(a){var b,c,d="0.4.2",e="hasOwnProperty",f=/[\.\/]/,g="*",h=function(){},i=function(a,b){return a-b},j={n:{}},k=function(a,d){a=String(a);var e,f=c,g=Array.prototype.slice.call(arguments,2),h=k.listeners(a),j=0,l=[],m={},n=[],o=b;b=a,c=0;for(var p=0,q=h.length;q>p;p++)"zIndex"in h[p]&&(l.push(h[p].zIndex),h[p].zIndex<0&&(m[h[p].zIndex]=h[p]));for(l.sort(i);l[j]<0;)if(e=m[l[j++]],n.push(e.apply(d,g)),c)return c=f,n;for(p=0;q>p;p++)if(e=h[p],"zIndex"in e)if(e.zIndex==l[j]){if(n.push(e.apply(d,g)),c)break;do if(j++,e=m[l[j]],e&&n.push(e.apply(d,g)),c)break;while(e)}else m[e.zIndex]=e;else if(n.push(e.apply(d,g)),c)break;return c=f,b=o,n.length?n:null};k._events=j,k.listeners=function(a){var b,c,d,e,h,i,k,l,m=a.split(f),n=j,o=[n],p=[];for(e=0,h=m.length;h>e;e++){for(l=[],i=0,k=o.length;k>i;i++)for(n=o[i].n,c=[n[m[e]],n[g]],d=2;d--;)b=c[d],b&&(l.push(b),p=p.concat(b.f||[]));o=l}return p},k.on=function(a,b){if(a=String(a),"function"!=typeof b)return function(){};for(var c=a.split(f),d=j,e=0,g=c.length;g>e;e++)d=d.n,d=d.hasOwnProperty(c[e])&&d[c[e]]||(d[c[e]]={n:{}});for(d.f=d.f||[],e=0,g=d.f.length;g>e;e++)if(d.f[e]==b)return h;return d.f.push(b),function(a){+a==+a&&(b.zIndex=+a)}},k.f=function(a){var b=[].slice.call(arguments,1);return function(){k.apply(null,[a,null].concat(b).concat([].slice.call(arguments,0)))}},k.stop=function(){c=1},k.nt=function(a){return a?new RegExp("(?:\\.|\\/|^)"+a+"(?:\\.|\\/|$)").test(b):b},k.nts=function(){return b.split(f)},k.off=k.unbind=function(a,b){if(!a)return void(k._events=j={n:{}});var c,d,h,i,l,m,n,o=a.split(f),p=[j];for(i=0,l=o.length;l>i;i++)for(m=0;m<p.length;m+=h.length-2){if(h=[m,1],c=p[m].n,o[i]!=g)c[o[i]]&&h.push(c[o[i]]);else for(d in c)c[e](d)&&h.push(c[d]);p.splice.apply(p,h)}for(i=0,l=p.length;l>i;i++)for(c=p[i];c.n;){if(b){if(c.f){for(m=0,n=c.f.length;n>m;m++)if(c.f[m]==b){c.f.splice(m,1);break}!c.f.length&&delete c.f}for(d in c.n)if(c.n[e](d)&&c.n[d].f){var q=c.n[d].f;for(m=0,n=q.length;n>m;m++)if(q[m]==b){q.splice(m,1);break}!q.length&&delete c.n[d].f}}else{delete c.f;for(d in c.n)c.n[e](d)&&c.n[d].f&&delete c.n[d].f}c=c.n}},k.once=function(a,b){var c=function(){return k.unbind(a,c),b.apply(this,arguments)};return k.on(a,c)},k.version=d,k.toString=function(){return"You are running Eve "+d},"undefined"!=typeof module&&module.exports?module.exports=k:"undefined"!=typeof define?define("eve",[],function(){return k}):a.eve=k}(window||this),function(a,b){"function"==typeof define&&define.amd?define(["eve"],function(c){return b(a,c)}):b(a,a.eve||"function"==typeof require&&require("eve"))}(this,function(a,b){function c(a){if(c.is(a,"function"))return u?a():b.on("raphael.DOMload",a);if(c.is(a,V))return c._engine.create[D](c,a.splice(0,3+c.is(a[0],T))).add(a);var d=Array.prototype.slice.call(arguments,0);if(c.is(d[d.length-1],"function")){var e=d.pop();return u?e.call(c._engine.create[D](c,d)):b.on("raphael.DOMload",function(){e.call(c._engine.create[D](c,d))})}return c._engine.create[D](c,arguments)}function d(a){if("function"==typeof a||Object(a)!==a)return a;var b=new a.constructor;for(var c in a)a[z](c)&&(b[c]=d(a[c]));return b}function e(a,b){for(var c=0,d=a.length;d>c;c++)if(a[c]===b)return a.push(a.splice(c,1)[0])}function f(a,b,c){function d(){var f=Array.prototype.slice.call(arguments,0),g=f.join("␀"),h=d.cache=d.cache||{},i=d.count=d.count||[];return h[z](g)?(e(i,g),c?c(h[g]):h[g]):(i.length>=1e3&&delete h[i.shift()],i.push(g),h[g]=a[D](b,f),c?c(h[g]):h[g])}return d}function g(){return this.hex}function h(a,b){for(var c=[],d=0,e=a.length;e-2*!b>d;d+=2){var f=[{x:+a[d-2],y:+a[d-1]},{x:+a[d],y:+a[d+1]},{x:+a[d+2],y:+a[d+3]},{x:+a[d+4],y:+a[d+5]}];b?d?e-4==d?f[3]={x:+a[0],y:+a[1]}:e-2==d&&(f[2]={x:+a[0],y:+a[1]},f[3]={x:+a[2],y:+a[3]}):f[0]={x:+a[e-2],y:+a[e-1]}:e-4==d?f[3]=f[2]:d||(f[0]={x:+a[d],y:+a[d+1]}),c.push(["C",(-f[0].x+6*f[1].x+f[2].x)/6,(-f[0].y+6*f[1].y+f[2].y)/6,(f[1].x+6*f[2].x-f[3].x)/6,(f[1].y+6*f[2].y-f[3].y)/6,f[2].x,f[2].y])}return c}function i(a,b,c,d,e){var f=-3*b+9*c-9*d+3*e,g=a*f+6*b-12*c+6*d;return a*g-3*b+3*c}function j(a,b,c,d,e,f,g,h,j){null==j&&(j=1),j=j>1?1:0>j?0:j;for(var k=j/2,l=12,m=[-.1252,.1252,-.3678,.3678,-.5873,.5873,-.7699,.7699,-.9041,.9041,-.9816,.9816],n=[.2491,.2491,.2335,.2335,.2032,.2032,.1601,.1601,.1069,.1069,.0472,.0472],o=0,p=0;l>p;p++){var q=k*m[p]+k,r=i(q,a,c,e,g),s=i(q,b,d,f,h),t=r*r+s*s;o+=n[p]*N.sqrt(t)}return k*o}function k(a,b,c,d,e,f,g,h,i){if(!(0>i||j(a,b,c,d,e,f,g,h)<i)){var k,l=1,m=l/2,n=l-m,o=.01;for(k=j(a,b,c,d,e,f,g,h,n);Q(k-i)>o;)m/=2,n+=(i>k?1:-1)*m,k=j(a,b,c,d,e,f,g,h,n);return n}}function l(a,b,c,d,e,f,g,h){if(!(O(a,c)<P(e,g)||P(a,c)>O(e,g)||O(b,d)<P(f,h)||P(b,d)>O(f,h))){var i=(a*d-b*c)*(e-g)-(a-c)*(e*h-f*g),j=(a*d-b*c)*(f-h)-(b-d)*(e*h-f*g),k=(a-c)*(f-h)-(b-d)*(e-g);if(k){var l=i/k,m=j/k,n=+l.toFixed(2),o=+m.toFixed(2);if(!(n<+P(a,c).toFixed(2)||n>+O(a,c).toFixed(2)||n<+P(e,g).toFixed(2)||n>+O(e,g).toFixed(2)||o<+P(b,d).toFixed(2)||o>+O(b,d).toFixed(2)||o<+P(f,h).toFixed(2)||o>+O(f,h).toFixed(2)))return{x:l,y:m}}}}function m(a,b,d){var e=c.bezierBBox(a),f=c.bezierBBox(b);if(!c.isBBoxIntersect(e,f))return d?0:[];for(var g=j.apply(0,a),h=j.apply(0,b),i=O(~~(g/5),1),k=O(~~(h/5),1),m=[],n=[],o={},p=d?0:[],q=0;i+1>q;q++){var r=c.findDotsAtSegment.apply(c,a.concat(q/i));m.push({x:r.x,y:r.y,t:q/i})}for(q=0;k+1>q;q++)r=c.findDotsAtSegment.apply(c,b.concat(q/k)),n.push({x:r.x,y:r.y,t:q/k});for(q=0;i>q;q++)for(var s=0;k>s;s++){var t=m[q],u=m[q+1],v=n[s],w=n[s+1],x=Q(u.x-t.x)<.001?"y":"x",y=Q(w.x-v.x)<.001?"y":"x",z=l(t.x,t.y,u.x,u.y,v.x,v.y,w.x,w.y);if(z){if(o[z.x.toFixed(4)]==z.y.toFixed(4))continue;o[z.x.toFixed(4)]=z.y.toFixed(4);var A=t.t+Q((z[x]-t[x])/(u[x]-t[x]))*(u.t-t.t),B=v.t+Q((z[y]-v[y])/(w[y]-v[y]))*(w.t-v.t);A>=0&&1.001>=A&&B>=0&&1.001>=B&&(d?p++:p.push({x:z.x,y:z.y,t1:P(A,1),t2:P(B,1)}))}}return p}function n(a,b,d){a=c._path2curve(a),b=c._path2curve(b);for(var e,f,g,h,i,j,k,l,n,o,p=d?0:[],q=0,r=a.length;r>q;q++){var s=a[q];if("M"==s[0])e=i=s[1],f=j=s[2];else{"C"==s[0]?(n=[e,f].concat(s.slice(1)),e=n[6],f=n[7]):(n=[e,f,e,f,i,j,i,j],e=i,f=j);for(var t=0,u=b.length;u>t;t++){var v=b[t];if("M"==v[0])g=k=v[1],h=l=v[2];else{"C"==v[0]?(o=[g,h].concat(v.slice(1)),g=o[6],h=o[7]):(o=[g,h,g,h,k,l,k,l],g=k,h=l);var w=m(n,o,d);if(d)p+=w;else{for(var x=0,y=w.length;y>x;x++)w[x].segment1=q,w[x].segment2=t,w[x].bez1=n,w[x].bez2=o;p=p.concat(w)}}}}}return p}function o(a,b,c,d,e,f){null!=a?(this.a=+a,this.b=+b,this.c=+c,this.d=+d,this.e=+e,this.f=+f):(this.a=1,this.b=0,this.c=0,this.d=1,this.e=0,this.f=0)}function p(){return this.x+H+this.y+H+this.width+" × "+this.height}function q(a,b,c,d,e,f){function g(a){return((l*a+k)*a+j)*a}function h(a,b){var c=i(a,b);return((o*c+n)*c+m)*c}function i(a,b){var c,d,e,f,h,i;for(e=a,i=0;8>i;i++){if(f=g(e)-a,Q(f)<b)return e;if(h=(3*l*e+2*k)*e+j,Q(h)<1e-6)break;e-=f/h}if(c=0,d=1,e=a,c>e)return c;if(e>d)return d;for(;d>c;){if(f=g(e),Q(f-a)<b)return e;a>f?c=e:d=e,e=(d-c)/2+c}return e}var j=3*b,k=3*(d-b)-j,l=1-j-k,m=3*c,n=3*(e-c)-m,o=1-m-n;return h(a,1/(200*f))}function r(a,b){var c=[],d={};if(this.ms=b,this.times=1,a){for(var e in a)a[z](e)&&(d[_(e)]=a[e],c.push(_(e)));c.sort(lb)}this.anim=d,this.top=c[c.length-1],this.percents=c}function s(a,d,e,f,g,h){e=_(e);var i,j,k,l,m,n,p=a.ms,r={},s={},t={};if(f)for(v=0,x=ic.length;x>v;v++){var u=ic[v];if(u.el.id==d.id&&u.anim==a){u.percent!=e?(ic.splice(v,1),k=1):j=u,d.attr(u.totalOrigin);break}}else f=+s;for(var v=0,x=a.percents.length;x>v;v++){if(a.percents[v]==e||a.percents[v]>f*a.top){e=a.percents[v],m=a.percents[v-1]||0,p=p/a.top*(e-m),l=a.percents[v+1],i=a.anim[e];break}f&&d.attr(a.anim[a.percents[v]])}if(i){if(j)j.initstatus=f,j.start=new Date-j.ms*f;else{for(var y in i)if(i[z](y)&&(db[z](y)||d.paper.customAttributes[z](y)))switch(r[y]=d.attr(y),null==r[y]&&(r[y]=cb[y]),s[y]=i[y],db[y]){case T:t[y]=(s[y]-r[y])/p;break;case"colour":r[y]=c.getRGB(r[y]);var A=c.getRGB(s[y]);t[y]={r:(A.r-r[y].r)/p,g:(A.g-r[y].g)/p,b:(A.b-r[y].b)/p};break;case"path":var B=Kb(r[y],s[y]),C=B[1];for(r[y]=B[0],t[y]=[],v=0,x=r[y].length;x>v;v++){t[y][v]=[0];for(var D=1,F=r[y][v].length;F>D;D++)t[y][v][D]=(C[v][D]-r[y][v][D])/p}break;case"transform":var G=d._,H=Pb(G[y],s[y]);if(H)for(r[y]=H.from,s[y]=H.to,t[y]=[],t[y].real=!0,v=0,x=r[y].length;x>v;v++)for(t[y][v]=[r[y][v][0]],D=1,F=r[y][v].length;F>D;D++)t[y][v][D]=(s[y][v][D]-r[y][v][D])/p;else{var K=d.matrix||new o,L={_:{transform:G.transform},getBBox:function(){return d.getBBox(1)}};r[y]=[K.a,K.b,K.c,K.d,K.e,K.f],Nb(L,s[y]),s[y]=L._.transform,t[y]=[(L.matrix.a-K.a)/p,(L.matrix.b-K.b)/p,(L.matrix.c-K.c)/p,(L.matrix.d-K.d)/p,(L.matrix.e-K.e)/p,(L.matrix.f-K.f)/p]}break;case"csv":var M=I(i[y])[J](w),N=I(r[y])[J](w);if("clip-rect"==y)for(r[y]=N,t[y]=[],v=N.length;v--;)t[y][v]=(M[v]-r[y][v])/p;s[y]=M;break;default:for(M=[][E](i[y]),N=[][E](r[y]),t[y]=[],v=d.paper.customAttributes[y].length;v--;)t[y][v]=((M[v]||0)-(N[v]||0))/p}var O=i.easing,P=c.easing_formulas[O];if(!P)if(P=I(O).match(Z),P&&5==P.length){var Q=P;P=function(a){return q(a,+Q[1],+Q[2],+Q[3],+Q[4],p)}}else P=nb;if(n=i.start||a.start||+new Date,u={anim:a,percent:e,timestamp:n,start:n+(a.del||0),status:0,initstatus:f||0,stop:!1,ms:p,easing:P,from:r,diff:t,to:s,el:d,callback:i.callback,prev:m,next:l,repeat:h||a.times,origin:d.attr(),totalOrigin:g},ic.push(u),f&&!j&&!k&&(u.stop=!0,u.start=new Date-p*f,1==ic.length))return kc();k&&(u.start=new Date-u.ms*f),1==ic.length&&jc(kc)}b("raphael.anim.start."+d.id,d,a)}}function t(a){for(var b=0;b<ic.length;b++)ic[b].el.paper==a&&ic.splice(b--,1)}c.version="2.1.2",c.eve=b;var u,v,w=/[, ]+/,x={circle:1,rect:1,path:1,ellipse:1,text:1,image:1},y=/\{(\d+)\}/g,z="hasOwnProperty",A={doc:document,win:a},B={was:Object.prototype[z].call(A.win,"Raphael"),is:A.win.Raphael},C=function(){this.ca=this.customAttributes={}},D="apply",E="concat",F="ontouchstart"in A.win||A.win.DocumentTouch&&A.doc instanceof DocumentTouch,G="",H=" ",I=String,J="split",K="click dblclick mousedown mousemove mouseout mouseover mouseup touchstart touchmove touchend touchcancel"[J](H),L={mousedown:"touchstart",mousemove:"touchmove",mouseup:"touchend"},M=I.prototype.toLowerCase,N=Math,O=N.max,P=N.min,Q=N.abs,R=N.pow,S=N.PI,T="number",U="string",V="array",W=Object.prototype.toString,X=(c._ISURL=/^url\(['"]?(.+?)['"]?\)$/i,/^\s*((#[a-f\d]{6})|(#[a-f\d]{3})|rgba?\(\s*([\d\.]+%?\s*,\s*[\d\.]+%?\s*,\s*[\d\.]+%?(?:\s*,\s*[\d\.]+%?)?)\s*\)|hsba?\(\s*([\d\.]+(?:deg|\xb0|%)?\s*,\s*[\d\.]+%?\s*,\s*[\d\.]+(?:%?\s*,\s*[\d\.]+)?)%?\s*\)|hsla?\(\s*([\d\.]+(?:deg|\xb0|%)?\s*,\s*[\d\.]+%?\s*,\s*[\d\.]+(?:%?\s*,\s*[\d\.]+)?)%?\s*\))\s*$/i),Y={NaN:1,Infinity:1,"-Infinity":1},Z=/^(?:cubic-)?bezier\(([^,]+),([^,]+),([^,]+),([^\)]+)\)/,$=N.round,_=parseFloat,ab=parseInt,bb=I.prototype.toUpperCase,cb=c._availableAttrs={"arrow-end":"none","arrow-start":"none",blur:0,"clip-rect":"0 0 1e9 1e9",cursor:"default",cx:0,cy:0,fill:"#fff","fill-opacity":1,font:'10px "Arial"',"font-family":'"Arial"',"font-size":"10","font-style":"normal","font-weight":400,gradient:0,height:0,href:"http://raphaeljs.com/","letter-spacing":0,opacity:1,path:"M0,0",r:0,rx:0,ry:0,src:"",stroke:"#000","stroke-dasharray":"","stroke-linecap":"butt","stroke-linejoin":"butt","stroke-miterlimit":0,"stroke-opacity":1,"stroke-width":1,target:"_blank","text-anchor":"middle",title:"Raphael",transform:"",width:0,x:0,y:0},db=c._availableAnimAttrs={blur:T,"clip-rect":"csv",cx:T,cy:T,fill:"colour","fill-opacity":T,"font-size":T,height:T,opacity:T,path:"path",r:T,rx:T,ry:T,stroke:"colour","stroke-opacity":T,"stroke-width":T,transform:"transform",width:T,x:T,y:T},eb=/[\x09\x0a\x0b\x0c\x0d\x20\xa0\u1680\u180e\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u202f\u205f\u3000\u2028\u2029]*,[\x09\x0a\x0b\x0c\x0d\x20\xa0\u1680\u180e\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u202f\u205f\u3000\u2028\u2029]*/,fb={hs:1,rg:1},gb=/,?([achlmqrstvxz]),?/gi,hb=/([achlmrqstvz])[\x09\x0a\x0b\x0c\x0d\x20\xa0\u1680\u180e\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u202f\u205f\u3000\u2028\u2029,]*((-?\d*\.?\d*(?:e[\-+]?\d+)?[\x09\x0a\x0b\x0c\x0d\x20\xa0\u1680\u180e\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u202f\u205f\u3000\u2028\u2029]*,?[\x09\x0a\x0b\x0c\x0d\x20\xa0\u1680\u180e\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u202f\u205f\u3000\u2028\u2029]*)+)/gi,ib=/([rstm])[\x09\x0a\x0b\x0c\x0d\x20\xa0\u1680\u180e\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u202f\u205f\u3000\u2028\u2029,]*((-?\d*\.?\d*(?:e[\-+]?\d+)?[\x09\x0a\x0b\x0c\x0d\x20\xa0\u1680\u180e\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u202f\u205f\u3000\u2028\u2029]*,?[\x09\x0a\x0b\x0c\x0d\x20\xa0\u1680\u180e\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u202f\u205f\u3000\u2028\u2029]*)+)/gi,jb=/(-?\d*\.?\d*(?:e[\-+]?\d+)?)[\x09\x0a\x0b\x0c\x0d\x20\xa0\u1680\u180e\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u202f\u205f\u3000\u2028\u2029]*,?[\x09\x0a\x0b\x0c\x0d\x20\xa0\u1680\u180e\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u202f\u205f\u3000\u2028\u2029]*/gi,kb=(c._radial_gradient=/^r(?:\(([^,]+?)[\x09\x0a\x0b\x0c\x0d\x20\xa0\u1680\u180e\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u202f\u205f\u3000\u2028\u2029]*,[\x09\x0a\x0b\x0c\x0d\x20\xa0\u1680\u180e\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u202f\u205f\u3000\u2028\u2029]*([^\)]+?)\))?/,{}),lb=function(a,b){return _(a)-_(b)},mb=function(){},nb=function(a){return a},ob=c._rectPath=function(a,b,c,d,e){return e?[["M",a+e,b],["l",c-2*e,0],["a",e,e,0,0,1,e,e],["l",0,d-2*e],["a",e,e,0,0,1,-e,e],["l",2*e-c,0],["a",e,e,0,0,1,-e,-e],["l",0,2*e-d],["a",e,e,0,0,1,e,-e],["z"]]:[["M",a,b],["l",c,0],["l",0,d],["l",-c,0],["z"]]},pb=function(a,b,c,d){return null==d&&(d=c),[["M",a,b],["m",0,-d],["a",c,d,0,1,1,0,2*d],["a",c,d,0,1,1,0,-2*d],["z"]]},qb=c._getPath={path:function(a){return a.attr("path")},circle:function(a){var b=a.attrs;return pb(b.cx,b.cy,b.r)},ellipse:function(a){var b=a.attrs;return pb(b.cx,b.cy,b.rx,b.ry)},rect:function(a){var b=a.attrs;return ob(b.x,b.y,b.width,b.height,b.r)},image:function(a){var b=a.attrs;return ob(b.x,b.y,b.width,b.height)},text:function(a){var b=a._getBBox();return ob(b.x,b.y,b.width,b.height)},set:function(a){var b=a._getBBox();return ob(b.x,b.y,b.width,b.height)}},rb=c.mapPath=function(a,b){if(!b)return a;var c,d,e,f,g,h,i;for(a=Kb(a),e=0,g=a.length;g>e;e++)for(i=a[e],f=1,h=i.length;h>f;f+=2)c=b.x(i[f],i[f+1]),d=b.y(i[f],i[f+1]),i[f]=c,i[f+1]=d;return a};if(c._g=A,c.type=A.win.SVGAngle||A.doc.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#BasicStructure","1.1")?"SVG":"VML","VML"==c.type){var sb,tb=A.doc.createElement("div");if(tb.innerHTML='<v:shape adj="1"/>',sb=tb.firstChild,sb.style.behavior="url(#default#VML)",!sb||"object"!=typeof sb.adj)return c.type=G;tb=null}c.svg=!(c.vml="VML"==c.type),c._Paper=C,c.fn=v=C.prototype=c.prototype,c._id=0,c._oid=0,c.is=function(a,b){return b=M.call(b),"finite"==b?!Y[z](+a):"array"==b?a instanceof Array:"null"==b&&null===a||b==typeof a&&null!==a||"object"==b&&a===Object(a)||"array"==b&&Array.isArray&&Array.isArray(a)||W.call(a).slice(8,-1).toLowerCase()==b},c.angle=function(a,b,d,e,f,g){if(null==f){var h=a-d,i=b-e;return h||i?(180+180*N.atan2(-i,-h)/S+360)%360:0}return c.angle(a,b,f,g)-c.angle(d,e,f,g)},c.rad=function(a){return a%360*S/180},c.deg=function(a){return 180*a/S%360},c.snapTo=function(a,b,d){if(d=c.is(d,"finite")?d:10,c.is(a,V)){for(var e=a.length;e--;)if(Q(a[e]-b)<=d)return a[e]}else{a=+a;var f=b%a;if(d>f)return b-f;if(f>a-d)return b-f+a}return b};c.createUUID=function(a,b){return function(){return"xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx".replace(a,b).toUpperCase()}}(/[xy]/g,function(a){var b=16*N.random()|0,c="x"==a?b:3&b|8;return c.toString(16)});c.setWindow=function(a){b("raphael.setWindow",c,A.win,a),A.win=a,A.doc=A.win.document,c._engine.initWin&&c._engine.initWin(A.win)};var ub=function(a){if(c.vml){var b,d=/^\s+|\s+$/g;try{var e=new ActiveXObject("htmlfile");e.write("<body>"),e.close(),b=e.body}catch(g){b=createPopup().document.body}var h=b.createTextRange();ub=f(function(a){try{b.style.color=I(a).replace(d,G);var c=h.queryCommandValue("ForeColor");return c=(255&c)<<16|65280&c|(16711680&c)>>>16,"#"+("000000"+c.toString(16)).slice(-6)}catch(e){return"none"}})}else{var i=A.doc.createElement("i");i.title="Raphaël Colour Picker",i.style.display="none",A.doc.body.appendChild(i),ub=f(function(a){return i.style.color=a,A.doc.defaultView.getComputedStyle(i,G).getPropertyValue("color")})}return ub(a)},vb=function(){return"hsb("+[this.h,this.s,this.b]+")"},wb=function(){return"hsl("+[this.h,this.s,this.l]+")"},xb=function(){return this.hex},yb=function(a,b,d){if(null==b&&c.is(a,"object")&&"r"in a&&"g"in a&&"b"in a&&(d=a.b,b=a.g,a=a.r),null==b&&c.is(a,U)){var e=c.getRGB(a);a=e.r,b=e.g,d=e.b}return(a>1||b>1||d>1)&&(a/=255,b/=255,d/=255),[a,b,d]},zb=function(a,b,d,e){a*=255,b*=255,d*=255;var f={r:a,g:b,b:d,hex:c.rgb(a,b,d),toString:xb};return c.is(e,"finite")&&(f.opacity=e),f};c.color=function(a){var b;return c.is(a,"object")&&"h"in a&&"s"in a&&"b"in a?(b=c.hsb2rgb(a),a.r=b.r,a.g=b.g,a.b=b.b,a.hex=b.hex):c.is(a,"object")&&"h"in a&&"s"in a&&"l"in a?(b=c.hsl2rgb(a),a.r=b.r,a.g=b.g,a.b=b.b,a.hex=b.hex):(c.is(a,"string")&&(a=c.getRGB(a)),c.is(a,"object")&&"r"in a&&"g"in a&&"b"in a?(b=c.rgb2hsl(a),a.h=b.h,a.s=b.s,a.l=b.l,b=c.rgb2hsb(a),a.v=b.b):(a={hex:"none"},a.r=a.g=a.b=a.h=a.s=a.v=a.l=-1)),a.toString=xb,a},c.hsb2rgb=function(a,b,c,d){this.is(a,"object")&&"h"in a&&"s"in a&&"b"in a&&(c=a.b,b=a.s,d=a.o,a=a.h),a*=360;var e,f,g,h,i;return a=a%360/60,i=c*b,h=i*(1-Q(a%2-1)),e=f=g=c-i,a=~~a,e+=[i,h,0,0,h,i][a],f+=[h,i,i,h,0,0][a],g+=[0,0,h,i,i,h][a],zb(e,f,g,d)},c.hsl2rgb=function(a,b,c,d){this.is(a,"object")&&"h"in a&&"s"in a&&"l"in a&&(c=a.l,b=a.s,a=a.h),(a>1||b>1||c>1)&&(a/=360,b/=100,c/=100),a*=360;var e,f,g,h,i;return a=a%360/60,i=2*b*(.5>c?c:1-c),h=i*(1-Q(a%2-1)),e=f=g=c-i/2,a=~~a,e+=[i,h,0,0,h,i][a],f+=[h,i,i,h,0,0][a],g+=[0,0,h,i,i,h][a],zb(e,f,g,d)},c.rgb2hsb=function(a,b,c){c=yb(a,b,c),a=c[0],b=c[1],c=c[2];var d,e,f,g;return f=O(a,b,c),g=f-P(a,b,c),d=0==g?null:f==a?(b-c)/g:f==b?(c-a)/g+2:(a-b)/g+4,d=(d+360)%6*60/360,e=0==g?0:g/f,{h:d,s:e,b:f,toString:vb}},c.rgb2hsl=function(a,b,c){c=yb(a,b,c),a=c[0],b=c[1],c=c[2];var d,e,f,g,h,i;return g=O(a,b,c),h=P(a,b,c),i=g-h,d=0==i?null:g==a?(b-c)/i:g==b?(c-a)/i+2:(a-b)/i+4,d=(d+360)%6*60/360,f=(g+h)/2,e=0==i?0:.5>f?i/(2*f):i/(2-2*f),{h:d,s:e,l:f,toString:wb}},c._path2string=function(){return this.join(",").replace(gb,"$1")};c._preload=function(a,b){var c=A.doc.createElement("img");c.style.cssText="position:absolute;left:-9999em;top:-9999em",c.onload=function(){b.call(this),this.onload=null,A.doc.body.removeChild(this)},c.onerror=function(){A.doc.body.removeChild(this)},A.doc.body.appendChild(c),c.src=a};c.getRGB=f(function(a){if(!a||(a=I(a)).indexOf("-")+1)return{r:-1,g:-1,b:-1,hex:"none",error:1,toString:g};if("none"==a)return{r:-1,g:-1,b:-1,hex:"none",toString:g};!(fb[z](a.toLowerCase().substring(0,2))||"#"==a.charAt())&&(a=ub(a));var b,d,e,f,h,i,j=a.match(X);return j?(j[2]&&(e=ab(j[2].substring(5),16),d=ab(j[2].substring(3,5),16),b=ab(j[2].substring(1,3),16)),j[3]&&(e=ab((h=j[3].charAt(3))+h,16),d=ab((h=j[3].charAt(2))+h,16),b=ab((h=j[3].charAt(1))+h,16)),j[4]&&(i=j[4][J](eb),b=_(i[0]),"%"==i[0].slice(-1)&&(b*=2.55),d=_(i[1]),"%"==i[1].slice(-1)&&(d*=2.55),e=_(i[2]),"%"==i[2].slice(-1)&&(e*=2.55),"rgba"==j[1].toLowerCase().slice(0,4)&&(f=_(i[3])),i[3]&&"%"==i[3].slice(-1)&&(f/=100)),j[5]?(i=j[5][J](eb),b=_(i[0]),"%"==i[0].slice(-1)&&(b*=2.55),d=_(i[1]),"%"==i[1].slice(-1)&&(d*=2.55),e=_(i[2]),"%"==i[2].slice(-1)&&(e*=2.55),("deg"==i[0].slice(-3)||"°"==i[0].slice(-1))&&(b/=360),"hsba"==j[1].toLowerCase().slice(0,4)&&(f=_(i[3])),i[3]&&"%"==i[3].slice(-1)&&(f/=100),c.hsb2rgb(b,d,e,f)):j[6]?(i=j[6][J](eb),b=_(i[0]),"%"==i[0].slice(-1)&&(b*=2.55),d=_(i[1]),"%"==i[1].slice(-1)&&(d*=2.55),e=_(i[2]),"%"==i[2].slice(-1)&&(e*=2.55),("deg"==i[0].slice(-3)||"°"==i[0].slice(-1))&&(b/=360),"hsla"==j[1].toLowerCase().slice(0,4)&&(f=_(i[3])),i[3]&&"%"==i[3].slice(-1)&&(f/=100),c.hsl2rgb(b,d,e,f)):(j={r:b,g:d,b:e,toString:g},j.hex="#"+(16777216|e|d<<8|b<<16).toString(16).slice(1),c.is(f,"finite")&&(j.opacity=f),j)):{r:-1,g:-1,b:-1,hex:"none",error:1,toString:g}},c),c.hsb=f(function(a,b,d){return c.hsb2rgb(a,b,d).hex}),c.hsl=f(function(a,b,d){return c.hsl2rgb(a,b,d).hex}),c.rgb=f(function(a,b,c){return"#"+(16777216|c|b<<8|a<<16).toString(16).slice(1)}),c.getColor=function(a){var b=this.getColor.start=this.getColor.start||{h:0,s:1,b:a||.75},c=this.hsb2rgb(b.h,b.s,b.b);return b.h+=.075,b.h>1&&(b.h=0,b.s-=.2,b.s<=0&&(this.getColor.start={h:0,s:1,b:b.b})),c.hex},c.getColor.reset=function(){delete this.start},c.parsePathString=function(a){if(!a)return null;var b=Ab(a);if(b.arr)return Cb(b.arr);var d={a:7,c:6,h:1,l:2,m:2,r:4,q:4,s:4,t:2,v:1,z:0},e=[];return c.is(a,V)&&c.is(a[0],V)&&(e=Cb(a)),e.length||I(a).replace(hb,function(a,b,c){var f=[],g=b.toLowerCase();if(c.replace(jb,function(a,b){b&&f.push(+b)}),"m"==g&&f.length>2&&(e.push([b][E](f.splice(0,2))),g="l",b="m"==b?"l":"L"),"r"==g)e.push([b][E](f));else for(;f.length>=d[g]&&(e.push([b][E](f.splice(0,d[g]))),d[g]););}),e.toString=c._path2string,b.arr=Cb(e),e},c.parseTransformString=f(function(a){if(!a)return null;var b=[];return c.is(a,V)&&c.is(a[0],V)&&(b=Cb(a)),b.length||I(a).replace(ib,function(a,c,d){{var e=[];M.call(c)}d.replace(jb,function(a,b){b&&e.push(+b)}),b.push([c][E](e))}),b.toString=c._path2string,b});var Ab=function(a){var b=Ab.ps=Ab.ps||{};return b[a]?b[a].sleep=100:b[a]={sleep:100},setTimeout(function(){for(var c in b)b[z](c)&&c!=a&&(b[c].sleep--,!b[c].sleep&&delete b[c])}),b[a]};c.findDotsAtSegment=function(a,b,c,d,e,f,g,h,i){var j=1-i,k=R(j,3),l=R(j,2),m=i*i,n=m*i,o=k*a+3*l*i*c+3*j*i*i*e+n*g,p=k*b+3*l*i*d+3*j*i*i*f+n*h,q=a+2*i*(c-a)+m*(e-2*c+a),r=b+2*i*(d-b)+m*(f-2*d+b),s=c+2*i*(e-c)+m*(g-2*e+c),t=d+2*i*(f-d)+m*(h-2*f+d),u=j*a+i*c,v=j*b+i*d,w=j*e+i*g,x=j*f+i*h,y=90-180*N.atan2(q-s,r-t)/S;return(q>s||t>r)&&(y+=180),{x:o,y:p,m:{x:q,y:r},n:{x:s,y:t},start:{x:u,y:v},end:{x:w,y:x},alpha:y}},c.bezierBBox=function(a,b,d,e,f,g,h,i){c.is(a,"array")||(a=[a,b,d,e,f,g,h,i]);var j=Jb.apply(null,a);return{x:j.min.x,y:j.min.y,x2:j.max.x,y2:j.max.y,width:j.max.x-j.min.x,height:j.max.y-j.min.y}},c.isPointInsideBBox=function(a,b,c){return b>=a.x&&b<=a.x2&&c>=a.y&&c<=a.y2},c.isBBoxIntersect=function(a,b){var d=c.isPointInsideBBox;return d(b,a.x,a.y)||d(b,a.x2,a.y)||d(b,a.x,a.y2)||d(b,a.x2,a.y2)||d(a,b.x,b.y)||d(a,b.x2,b.y)||d(a,b.x,b.y2)||d(a,b.x2,b.y2)||(a.x<b.x2&&a.x>b.x||b.x<a.x2&&b.x>a.x)&&(a.y<b.y2&&a.y>b.y||b.y<a.y2&&b.y>a.y)},c.pathIntersection=function(a,b){return n(a,b)},c.pathIntersectionNumber=function(a,b){return n(a,b,1)},c.isPointInsidePath=function(a,b,d){var e=c.pathBBox(a);return c.isPointInsideBBox(e,b,d)&&n(a,[["M",b,d],["H",e.x2+10]],1)%2==1},c._removedFactory=function(a){return function(){b("raphael.log",null,"Raphaël: you are calling to method “"+a+"” of removed object",a)}};var Bb=c.pathBBox=function(a){var b=Ab(a);if(b.bbox)return d(b.bbox);if(!a)return{x:0,y:0,width:0,height:0,x2:0,y2:0};a=Kb(a);for(var c,e=0,f=0,g=[],h=[],i=0,j=a.length;j>i;i++)if(c=a[i],"M"==c[0])e=c[1],f=c[2],g.push(e),h.push(f);else{var k=Jb(e,f,c[1],c[2],c[3],c[4],c[5],c[6]);g=g[E](k.min.x,k.max.x),h=h[E](k.min.y,k.max.y),e=c[5],f=c[6]}var l=P[D](0,g),m=P[D](0,h),n=O[D](0,g),o=O[D](0,h),p=n-l,q=o-m,r={x:l,y:m,x2:n,y2:o,width:p,height:q,cx:l+p/2,cy:m+q/2};return b.bbox=d(r),r},Cb=function(a){var b=d(a);return b.toString=c._path2string,b},Db=c._pathToRelative=function(a){var b=Ab(a);if(b.rel)return Cb(b.rel);c.is(a,V)&&c.is(a&&a[0],V)||(a=c.parsePathString(a));var d=[],e=0,f=0,g=0,h=0,i=0;"M"==a[0][0]&&(e=a[0][1],f=a[0][2],g=e,h=f,i++,d.push(["M",e,f]));for(var j=i,k=a.length;k>j;j++){var l=d[j]=[],m=a[j];if(m[0]!=M.call(m[0]))switch(l[0]=M.call(m[0]),l[0]){case"a":l[1]=m[1],l[2]=m[2],l[3]=m[3],l[4]=m[4],l[5]=m[5],l[6]=+(m[6]-e).toFixed(3),l[7]=+(m[7]-f).toFixed(3);break;case"v":l[1]=+(m[1]-f).toFixed(3);break;case"m":g=m[1],h=m[2];default:for(var n=1,o=m.length;o>n;n++)l[n]=+(m[n]-(n%2?e:f)).toFixed(3)}else{l=d[j]=[],"m"==m[0]&&(g=m[1]+e,h=m[2]+f);for(var p=0,q=m.length;q>p;p++)d[j][p]=m[p]}var r=d[j].length;switch(d[j][0]){case"z":e=g,f=h;break;case"h":e+=+d[j][r-1];break;case"v":f+=+d[j][r-1];break;default:e+=+d[j][r-2],f+=+d[j][r-1]}}return d.toString=c._path2string,b.rel=Cb(d),d},Eb=c._pathToAbsolute=function(a){var b=Ab(a);if(b.abs)return Cb(b.abs);if(c.is(a,V)&&c.is(a&&a[0],V)||(a=c.parsePathString(a)),!a||!a.length)return[["M",0,0]];var d=[],e=0,f=0,g=0,i=0,j=0;"M"==a[0][0]&&(e=+a[0][1],f=+a[0][2],g=e,i=f,j++,d[0]=["M",e,f]);for(var k,l,m=3==a.length&&"M"==a[0][0]&&"R"==a[1][0].toUpperCase()&&"Z"==a[2][0].toUpperCase(),n=j,o=a.length;o>n;n++){if(d.push(k=[]),l=a[n],l[0]!=bb.call(l[0]))switch(k[0]=bb.call(l[0]),k[0]){case"A":k[1]=l[1],k[2]=l[2],k[3]=l[3],k[4]=l[4],k[5]=l[5],k[6]=+(l[6]+e),k[7]=+(l[7]+f);break;case"V":k[1]=+l[1]+f;break;case"H":k[1]=+l[1]+e;break;case"R":for(var p=[e,f][E](l.slice(1)),q=2,r=p.length;r>q;q++)p[q]=+p[q]+e,p[++q]=+p[q]+f;d.pop(),d=d[E](h(p,m));break;case"M":g=+l[1]+e,i=+l[2]+f;default:for(q=1,r=l.length;r>q;q++)k[q]=+l[q]+(q%2?e:f)}else if("R"==l[0])p=[e,f][E](l.slice(1)),d.pop(),d=d[E](h(p,m)),k=["R"][E](l.slice(-2));else for(var s=0,t=l.length;t>s;s++)k[s]=l[s];switch(k[0]){case"Z":e=g,f=i;break;case"H":e=k[1];break;case"V":f=k[1];break;case"M":g=k[k.length-2],i=k[k.length-1];default:e=k[k.length-2],f=k[k.length-1]}}return d.toString=c._path2string,b.abs=Cb(d),d},Fb=function(a,b,c,d){return[a,b,c,d,c,d]},Gb=function(a,b,c,d,e,f){var g=1/3,h=2/3;return[g*a+h*c,g*b+h*d,g*e+h*c,g*f+h*d,e,f]},Hb=function(a,b,c,d,e,g,h,i,j,k){var l,m=120*S/180,n=S/180*(+e||0),o=[],p=f(function(a,b,c){var d=a*N.cos(c)-b*N.sin(c),e=a*N.sin(c)+b*N.cos(c);return{x:d,y:e}});if(k)y=k[0],z=k[1],w=k[2],x=k[3];else{l=p(a,b,-n),a=l.x,b=l.y,l=p(i,j,-n),i=l.x,j=l.y;var q=(N.cos(S/180*e),N.sin(S/180*e),(a-i)/2),r=(b-j)/2,s=q*q/(c*c)+r*r/(d*d);s>1&&(s=N.sqrt(s),c=s*c,d=s*d);var t=c*c,u=d*d,v=(g==h?-1:1)*N.sqrt(Q((t*u-t*r*r-u*q*q)/(t*r*r+u*q*q))),w=v*c*r/d+(a+i)/2,x=v*-d*q/c+(b+j)/2,y=N.asin(((b-x)/d).toFixed(9)),z=N.asin(((j-x)/d).toFixed(9));y=w>a?S-y:y,z=w>i?S-z:z,0>y&&(y=2*S+y),0>z&&(z=2*S+z),h&&y>z&&(y-=2*S),!h&&z>y&&(z-=2*S)}var A=z-y;if(Q(A)>m){var B=z,C=i,D=j;z=y+m*(h&&z>y?1:-1),i=w+c*N.cos(z),j=x+d*N.sin(z),o=Hb(i,j,c,d,e,0,h,C,D,[z,B,w,x])}A=z-y;var F=N.cos(y),G=N.sin(y),H=N.cos(z),I=N.sin(z),K=N.tan(A/4),L=4/3*c*K,M=4/3*d*K,O=[a,b],P=[a+L*G,b-M*F],R=[i+L*I,j-M*H],T=[i,j];if(P[0]=2*O[0]-P[0],P[1]=2*O[1]-P[1],k)return[P,R,T][E](o);o=[P,R,T][E](o).join()[J](",");for(var U=[],V=0,W=o.length;W>V;V++)U[V]=V%2?p(o[V-1],o[V],n).y:p(o[V],o[V+1],n).x;return U},Ib=function(a,b,c,d,e,f,g,h,i){var j=1-i;return{x:R(j,3)*a+3*R(j,2)*i*c+3*j*i*i*e+R(i,3)*g,y:R(j,3)*b+3*R(j,2)*i*d+3*j*i*i*f+R(i,3)*h}},Jb=f(function(a,b,c,d,e,f,g,h){var i,j=e-2*c+a-(g-2*e+c),k=2*(c-a)-2*(e-c),l=a-c,m=(-k+N.sqrt(k*k-4*j*l))/2/j,n=(-k-N.sqrt(k*k-4*j*l))/2/j,o=[b,h],p=[a,g];return Q(m)>"1e12"&&(m=.5),Q(n)>"1e12"&&(n=.5),m>0&&1>m&&(i=Ib(a,b,c,d,e,f,g,h,m),p.push(i.x),o.push(i.y)),n>0&&1>n&&(i=Ib(a,b,c,d,e,f,g,h,n),p.push(i.x),o.push(i.y)),j=f-2*d+b-(h-2*f+d),k=2*(d-b)-2*(f-d),l=b-d,m=(-k+N.sqrt(k*k-4*j*l))/2/j,n=(-k-N.sqrt(k*k-4*j*l))/2/j,Q(m)>"1e12"&&(m=.5),Q(n)>"1e12"&&(n=.5),m>0&&1>m&&(i=Ib(a,b,c,d,e,f,g,h,m),p.push(i.x),o.push(i.y)),n>0&&1>n&&(i=Ib(a,b,c,d,e,f,g,h,n),p.push(i.x),o.push(i.y)),{min:{x:P[D](0,p),y:P[D](0,o)},max:{x:O[D](0,p),y:O[D](0,o)}}}),Kb=c._path2curve=f(function(a,b){var c=!b&&Ab(a);if(!b&&c.curve)return Cb(c.curve);for(var d=Eb(a),e=b&&Eb(b),f={x:0,y:0,bx:0,by:0,X:0,Y:0,qx:null,qy:null},g={x:0,y:0,bx:0,by:0,X:0,Y:0,qx:null,qy:null},h=(function(a,b,c){var d,e,f={T:1,Q:1};if(!a)return["C",b.x,b.y,b.x,b.y,b.x,b.y];switch(!(a[0]in f)&&(b.qx=b.qy=null),a[0]){case"M":b.X=a[1],b.Y=a[2];break;case"A":a=["C"][E](Hb[D](0,[b.x,b.y][E](a.slice(1))));break;case"S":"C"==c||"S"==c?(d=2*b.x-b.bx,e=2*b.y-b.by):(d=b.x,e=b.y),a=["C",d,e][E](a.slice(1));break;case"T":"Q"==c||"T"==c?(b.qx=2*b.x-b.qx,b.qy=2*b.y-b.qy):(b.qx=b.x,b.qy=b.y),a=["C"][E](Gb(b.x,b.y,b.qx,b.qy,a[1],a[2]));break;case"Q":b.qx=a[1],b.qy=a[2],a=["C"][E](Gb(b.x,b.y,a[1],a[2],a[3],a[4]));break;case"L":a=["C"][E](Fb(b.x,b.y,a[1],a[2]));break;case"H":a=["C"][E](Fb(b.x,b.y,a[1],b.y));break;case"V":a=["C"][E](Fb(b.x,b.y,b.x,a[1]));break;case"Z":a=["C"][E](Fb(b.x,b.y,b.X,b.Y))}return a}),i=function(a,b){if(a[b].length>7){a[b].shift();for(var c=a[b];c.length;)k[b]="A",e&&(l[b]="A"),a.splice(b++,0,["C"][E](c.splice(0,6)));a.splice(b,1),p=O(d.length,e&&e.length||0)}},j=function(a,b,c,f,g){a&&b&&"M"==a[g][0]&&"M"!=b[g][0]&&(b.splice(g,0,["M",f.x,f.y]),c.bx=0,c.by=0,c.x=a[g][1],c.y=a[g][2],p=O(d.length,e&&e.length||0))},k=[],l=[],m="",n="",o=0,p=O(d.length,e&&e.length||0);p>o;o++){d[o]&&(m=d[o][0]),"C"!=m&&(k[o]=m,o&&(n=k[o-1])),d[o]=h(d[o],f,n),"A"!=k[o]&&"C"==m&&(k[o]="C"),i(d,o),e&&(e[o]&&(m=e[o][0]),"C"!=m&&(l[o]=m,o&&(n=l[o-1])),e[o]=h(e[o],g,n),"A"!=l[o]&&"C"==m&&(l[o]="C"),i(e,o)),j(d,e,f,g,o),j(e,d,g,f,o);var q=d[o],r=e&&e[o],s=q.length,t=e&&r.length;f.x=q[s-2],f.y=q[s-1],f.bx=_(q[s-4])||f.x,f.by=_(q[s-3])||f.y,g.bx=e&&(_(r[t-4])||g.x),g.by=e&&(_(r[t-3])||g.y),g.x=e&&r[t-2],g.y=e&&r[t-1]}return e||(c.curve=Cb(d)),e?[d,e]:d},null,Cb),Lb=(c._parseDots=f(function(a){for(var b=[],d=0,e=a.length;e>d;d++){var f={},g=a[d].match(/^([^:]*):?([\d\.]*)/);if(f.color=c.getRGB(g[1]),f.color.error)return null;f.color=f.color.hex,g[2]&&(f.offset=g[2]+"%"),b.push(f)}for(d=1,e=b.length-1;e>d;d++)if(!b[d].offset){for(var h=_(b[d-1].offset||0),i=0,j=d+1;e>j;j++)if(b[j].offset){i=b[j].offset;break}i||(i=100,j=e),i=_(i);for(var k=(i-h)/(j-d+1);j>d;d++)h+=k,b[d].offset=h+"%"}return b}),c._tear=function(a,b){a==b.top&&(b.top=a.prev),a==b.bottom&&(b.bottom=a.next),a.next&&(a.next.prev=a.prev),a.prev&&(a.prev.next=a.next)}),Mb=(c._tofront=function(a,b){b.top!==a&&(Lb(a,b),a.next=null,a.prev=b.top,b.top.next=a,b.top=a)},c._toback=function(a,b){b.bottom!==a&&(Lb(a,b),a.next=b.bottom,a.prev=null,b.bottom.prev=a,b.bottom=a)},c._insertafter=function(a,b,c){Lb(a,c),b==c.top&&(c.top=a),b.next&&(b.next.prev=a),a.next=b.next,a.prev=b,b.next=a},c._insertbefore=function(a,b,c){Lb(a,c),b==c.bottom&&(c.bottom=a),b.prev&&(b.prev.next=a),a.prev=b.prev,b.prev=a,a.next=b},c.toMatrix=function(a,b){var c=Bb(a),d={_:{transform:G},getBBox:function(){return c}};return Nb(d,b),d.matrix}),Nb=(c.transformPath=function(a,b){return rb(a,Mb(a,b))},c._extractTransform=function(a,b){if(null==b)return a._.transform;b=I(b).replace(/\.{3}|\u2026/g,a._.transform||G);var d=c.parseTransformString(b),e=0,f=0,g=0,h=1,i=1,j=a._,k=new o;if(j.transform=d||[],d)for(var l=0,m=d.length;m>l;l++){var n,p,q,r,s,t=d[l],u=t.length,v=I(t[0]).toLowerCase(),w=t[0]!=v,x=w?k.invert():0;"t"==v&&3==u?w?(n=x.x(0,0),p=x.y(0,0),q=x.x(t[1],t[2]),r=x.y(t[1],t[2]),k.translate(q-n,r-p)):k.translate(t[1],t[2]):"r"==v?2==u?(s=s||a.getBBox(1),k.rotate(t[1],s.x+s.width/2,s.y+s.height/2),e+=t[1]):4==u&&(w?(q=x.x(t[2],t[3]),r=x.y(t[2],t[3]),k.rotate(t[1],q,r)):k.rotate(t[1],t[2],t[3]),e+=t[1]):"s"==v?2==u||3==u?(s=s||a.getBBox(1),k.scale(t[1],t[u-1],s.x+s.width/2,s.y+s.height/2),h*=t[1],i*=t[u-1]):5==u&&(w?(q=x.x(t[3],t[4]),r=x.y(t[3],t[4]),k.scale(t[1],t[2],q,r)):k.scale(t[1],t[2],t[3],t[4]),h*=t[1],i*=t[2]):"m"==v&&7==u&&k.add(t[1],t[2],t[3],t[4],t[5],t[6]),j.dirtyT=1,a.matrix=k}a.matrix=k,j.sx=h,j.sy=i,j.deg=e,j.dx=f=k.e,j.dy=g=k.f,1==h&&1==i&&!e&&j.bbox?(j.bbox.x+=+f,j.bbox.y+=+g):j.dirtyT=1}),Ob=function(a){var b=a[0];switch(b.toLowerCase()){case"t":return[b,0,0];case"m":return[b,1,0,0,1,0,0];case"r":return 4==a.length?[b,0,a[2],a[3]]:[b,0];case"s":return 5==a.length?[b,1,1,a[3],a[4]]:3==a.length?[b,1,1]:[b,1]}},Pb=c._equaliseTransform=function(a,b){b=I(b).replace(/\.{3}|\u2026/g,a),a=c.parseTransformString(a)||[],b=c.parseTransformString(b)||[];
for(var d,e,f,g,h=O(a.length,b.length),i=[],j=[],k=0;h>k;k++){if(f=a[k]||Ob(b[k]),g=b[k]||Ob(f),f[0]!=g[0]||"r"==f[0].toLowerCase()&&(f[2]!=g[2]||f[3]!=g[3])||"s"==f[0].toLowerCase()&&(f[3]!=g[3]||f[4]!=g[4]))return;for(i[k]=[],j[k]=[],d=0,e=O(f.length,g.length);e>d;d++)d in f&&(i[k][d]=f[d]),d in g&&(j[k][d]=g[d])}return{from:i,to:j}};c._getContainer=function(a,b,d,e){var f;return f=null!=e||c.is(a,"object")?a:A.doc.getElementById(a),null!=f?f.tagName?null==b?{container:f,width:f.style.pixelWidth||f.offsetWidth,height:f.style.pixelHeight||f.offsetHeight}:{container:f,width:b,height:d}:{container:1,x:a,y:b,width:d,height:e}:void 0},c.pathToRelative=Db,c._engine={},c.path2curve=Kb,c.matrix=function(a,b,c,d,e,f){return new o(a,b,c,d,e,f)},function(a){function b(a){return a[0]*a[0]+a[1]*a[1]}function d(a){var c=N.sqrt(b(a));a[0]&&(a[0]/=c),a[1]&&(a[1]/=c)}a.add=function(a,b,c,d,e,f){var g,h,i,j,k=[[],[],[]],l=[[this.a,this.c,this.e],[this.b,this.d,this.f],[0,0,1]],m=[[a,c,e],[b,d,f],[0,0,1]];for(a&&a instanceof o&&(m=[[a.a,a.c,a.e],[a.b,a.d,a.f],[0,0,1]]),g=0;3>g;g++)for(h=0;3>h;h++){for(j=0,i=0;3>i;i++)j+=l[g][i]*m[i][h];k[g][h]=j}this.a=k[0][0],this.b=k[1][0],this.c=k[0][1],this.d=k[1][1],this.e=k[0][2],this.f=k[1][2]},a.invert=function(){var a=this,b=a.a*a.d-a.b*a.c;return new o(a.d/b,-a.b/b,-a.c/b,a.a/b,(a.c*a.f-a.d*a.e)/b,(a.b*a.e-a.a*a.f)/b)},a.clone=function(){return new o(this.a,this.b,this.c,this.d,this.e,this.f)},a.translate=function(a,b){this.add(1,0,0,1,a,b)},a.scale=function(a,b,c,d){null==b&&(b=a),(c||d)&&this.add(1,0,0,1,c,d),this.add(a,0,0,b,0,0),(c||d)&&this.add(1,0,0,1,-c,-d)},a.rotate=function(a,b,d){a=c.rad(a),b=b||0,d=d||0;var e=+N.cos(a).toFixed(9),f=+N.sin(a).toFixed(9);this.add(e,f,-f,e,b,d),this.add(1,0,0,1,-b,-d)},a.x=function(a,b){return a*this.a+b*this.c+this.e},a.y=function(a,b){return a*this.b+b*this.d+this.f},a.get=function(a){return+this[I.fromCharCode(97+a)].toFixed(4)},a.toString=function(){return c.svg?"matrix("+[this.get(0),this.get(1),this.get(2),this.get(3),this.get(4),this.get(5)].join()+")":[this.get(0),this.get(2),this.get(1),this.get(3),0,0].join()},a.toFilter=function(){return"progid:DXImageTransform.Microsoft.Matrix(M11="+this.get(0)+", M12="+this.get(2)+", M21="+this.get(1)+", M22="+this.get(3)+", Dx="+this.get(4)+", Dy="+this.get(5)+", sizingmethod='auto expand')"},a.offset=function(){return[this.e.toFixed(4),this.f.toFixed(4)]},a.split=function(){var a={};a.dx=this.e,a.dy=this.f;var e=[[this.a,this.c],[this.b,this.d]];a.scalex=N.sqrt(b(e[0])),d(e[0]),a.shear=e[0][0]*e[1][0]+e[0][1]*e[1][1],e[1]=[e[1][0]-e[0][0]*a.shear,e[1][1]-e[0][1]*a.shear],a.scaley=N.sqrt(b(e[1])),d(e[1]),a.shear/=a.scaley;var f=-e[0][1],g=e[1][1];return 0>g?(a.rotate=c.deg(N.acos(g)),0>f&&(a.rotate=360-a.rotate)):a.rotate=c.deg(N.asin(f)),a.isSimple=!(+a.shear.toFixed(9)||a.scalex.toFixed(9)!=a.scaley.toFixed(9)&&a.rotate),a.isSuperSimple=!+a.shear.toFixed(9)&&a.scalex.toFixed(9)==a.scaley.toFixed(9)&&!a.rotate,a.noRotation=!+a.shear.toFixed(9)&&!a.rotate,a},a.toTransformString=function(a){var b=a||this[J]();return b.isSimple?(b.scalex=+b.scalex.toFixed(4),b.scaley=+b.scaley.toFixed(4),b.rotate=+b.rotate.toFixed(4),(b.dx||b.dy?"t"+[b.dx,b.dy]:G)+(1!=b.scalex||1!=b.scaley?"s"+[b.scalex,b.scaley,0,0]:G)+(b.rotate?"r"+[b.rotate,0,0]:G)):"m"+[this.get(0),this.get(1),this.get(2),this.get(3),this.get(4),this.get(5)]}}(o.prototype);var Qb=navigator.userAgent.match(/Version\/(.*?)\s/)||navigator.userAgent.match(/Chrome\/(\d+)/);v.safari="Apple Computer, Inc."==navigator.vendor&&(Qb&&Qb[1]<4||"iP"==navigator.platform.slice(0,2))||"Google Inc."==navigator.vendor&&Qb&&Qb[1]<8?function(){var a=this.rect(-99,-99,this.width+99,this.height+99).attr({stroke:"none"});setTimeout(function(){a.remove()})}:mb;for(var Rb=function(){this.returnValue=!1},Sb=function(){return this.originalEvent.preventDefault()},Tb=function(){this.cancelBubble=!0},Ub=function(){return this.originalEvent.stopPropagation()},Vb=function(a){var b=A.doc.documentElement.scrollTop||A.doc.body.scrollTop,c=A.doc.documentElement.scrollLeft||A.doc.body.scrollLeft;return{x:a.clientX+c,y:a.clientY+b}},Wb=function(){return A.doc.addEventListener?function(a,b,c,d){var e=function(a){var b=Vb(a);return c.call(d,a,b.x,b.y)};if(a.addEventListener(b,e,!1),F&&L[b]){var f=function(b){for(var e=Vb(b),f=b,g=0,h=b.targetTouches&&b.targetTouches.length;h>g;g++)if(b.targetTouches[g].target==a){b=b.targetTouches[g],b.originalEvent=f,b.preventDefault=Sb,b.stopPropagation=Ub;break}return c.call(d,b,e.x,e.y)};a.addEventListener(L[b],f,!1)}return function(){return a.removeEventListener(b,e,!1),F&&L[b]&&a.removeEventListener(L[b],f,!1),!0}}:A.doc.attachEvent?function(a,b,c,d){var e=function(a){a=a||A.win.event;var b=A.doc.documentElement.scrollTop||A.doc.body.scrollTop,e=A.doc.documentElement.scrollLeft||A.doc.body.scrollLeft,f=a.clientX+e,g=a.clientY+b;return a.preventDefault=a.preventDefault||Rb,a.stopPropagation=a.stopPropagation||Tb,c.call(d,a,f,g)};a.attachEvent("on"+b,e);var f=function(){return a.detachEvent("on"+b,e),!0};return f}:void 0}(),Xb=[],Yb=function(a){for(var c,d=a.clientX,e=a.clientY,f=A.doc.documentElement.scrollTop||A.doc.body.scrollTop,g=A.doc.documentElement.scrollLeft||A.doc.body.scrollLeft,h=Xb.length;h--;){if(c=Xb[h],F&&a.touches){for(var i,j=a.touches.length;j--;)if(i=a.touches[j],i.identifier==c.el._drag.id){d=i.clientX,e=i.clientY,(a.originalEvent?a.originalEvent:a).preventDefault();break}}else a.preventDefault();var k,l=c.el.node,m=l.nextSibling,n=l.parentNode,o=l.style.display;A.win.opera&&n.removeChild(l),l.style.display="none",k=c.el.paper.getElementByPoint(d,e),l.style.display=o,A.win.opera&&(m?n.insertBefore(l,m):n.appendChild(l)),k&&b("raphael.drag.over."+c.el.id,c.el,k),d+=g,e+=f,b("raphael.drag.move."+c.el.id,c.move_scope||c.el,d-c.el._drag.x,e-c.el._drag.y,d,e,a)}},Zb=function(a){c.unmousemove(Yb).unmouseup(Zb);for(var d,e=Xb.length;e--;)d=Xb[e],d.el._drag={},b("raphael.drag.end."+d.el.id,d.end_scope||d.start_scope||d.move_scope||d.el,a);Xb=[]},$b=c.el={},_b=K.length;_b--;)!function(a){c[a]=$b[a]=function(b,d){return c.is(b,"function")&&(this.events=this.events||[],this.events.push({name:a,f:b,unbind:Wb(this.shape||this.node||A.doc,a,b,d||this)})),this},c["un"+a]=$b["un"+a]=function(b){for(var d=this.events||[],e=d.length;e--;)d[e].name!=a||!c.is(b,"undefined")&&d[e].f!=b||(d[e].unbind(),d.splice(e,1),!d.length&&delete this.events);return this}}(K[_b]);$b.data=function(a,d){var e=kb[this.id]=kb[this.id]||{};if(0==arguments.length)return e;if(1==arguments.length){if(c.is(a,"object")){for(var f in a)a[z](f)&&this.data(f,a[f]);return this}return b("raphael.data.get."+this.id,this,e[a],a),e[a]}return e[a]=d,b("raphael.data.set."+this.id,this,d,a),this},$b.removeData=function(a){return null==a?kb[this.id]={}:kb[this.id]&&delete kb[this.id][a],this},$b.getData=function(){return d(kb[this.id]||{})},$b.hover=function(a,b,c,d){return this.mouseover(a,c).mouseout(b,d||c)},$b.unhover=function(a,b){return this.unmouseover(a).unmouseout(b)};var ac=[];$b.drag=function(a,d,e,f,g,h){function i(i){(i.originalEvent||i).preventDefault();var j=i.clientX,k=i.clientY,l=A.doc.documentElement.scrollTop||A.doc.body.scrollTop,m=A.doc.documentElement.scrollLeft||A.doc.body.scrollLeft;if(this._drag.id=i.identifier,F&&i.touches)for(var n,o=i.touches.length;o--;)if(n=i.touches[o],this._drag.id=n.identifier,n.identifier==this._drag.id){j=n.clientX,k=n.clientY;break}this._drag.x=j+m,this._drag.y=k+l,!Xb.length&&c.mousemove(Yb).mouseup(Zb),Xb.push({el:this,move_scope:f,start_scope:g,end_scope:h}),d&&b.on("raphael.drag.start."+this.id,d),a&&b.on("raphael.drag.move."+this.id,a),e&&b.on("raphael.drag.end."+this.id,e),b("raphael.drag.start."+this.id,g||f||this,i.clientX+m,i.clientY+l,i)}return this._drag={},ac.push({el:this,start:i}),this.mousedown(i),this},$b.onDragOver=function(a){a?b.on("raphael.drag.over."+this.id,a):b.unbind("raphael.drag.over."+this.id)},$b.undrag=function(){for(var a=ac.length;a--;)ac[a].el==this&&(this.unmousedown(ac[a].start),ac.splice(a,1),b.unbind("raphael.drag.*."+this.id));!ac.length&&c.unmousemove(Yb).unmouseup(Zb),Xb=[]},v.circle=function(a,b,d){var e=c._engine.circle(this,a||0,b||0,d||0);return this.__set__&&this.__set__.push(e),e},v.rect=function(a,b,d,e,f){var g=c._engine.rect(this,a||0,b||0,d||0,e||0,f||0);return this.__set__&&this.__set__.push(g),g},v.ellipse=function(a,b,d,e){var f=c._engine.ellipse(this,a||0,b||0,d||0,e||0);return this.__set__&&this.__set__.push(f),f},v.path=function(a){a&&!c.is(a,U)&&!c.is(a[0],V)&&(a+=G);var b=c._engine.path(c.format[D](c,arguments),this);return this.__set__&&this.__set__.push(b),b},v.image=function(a,b,d,e,f){var g=c._engine.image(this,a||"about:blank",b||0,d||0,e||0,f||0);return this.__set__&&this.__set__.push(g),g},v.text=function(a,b,d){var e=c._engine.text(this,a||0,b||0,I(d));return this.__set__&&this.__set__.push(e),e},v.set=function(a){!c.is(a,"array")&&(a=Array.prototype.splice.call(arguments,0,arguments.length));var b=new mc(a);return this.__set__&&this.__set__.push(b),b.paper=this,b.type="set",b},v.setStart=function(a){this.__set__=a||this.set()},v.setFinish=function(){var a=this.__set__;return delete this.__set__,a},v.getSize=function(){var a=this.canvas.parentNode;return{width:a.offsetWidth,height:a.offsetHeight}},v.setSize=function(a,b){return c._engine.setSize.call(this,a,b)},v.setViewBox=function(a,b,d,e,f){return c._engine.setViewBox.call(this,a,b,d,e,f)},v.top=v.bottom=null,v.raphael=c;var bc=function(a){var b=a.getBoundingClientRect(),c=a.ownerDocument,d=c.body,e=c.documentElement,f=e.clientTop||d.clientTop||0,g=e.clientLeft||d.clientLeft||0,h=b.top+(A.win.pageYOffset||e.scrollTop||d.scrollTop)-f,i=b.left+(A.win.pageXOffset||e.scrollLeft||d.scrollLeft)-g;return{y:h,x:i}};v.getElementByPoint=function(a,b){var c=this,d=c.canvas,e=A.doc.elementFromPoint(a,b);if(A.win.opera&&"svg"==e.tagName){var f=bc(d),g=d.createSVGRect();g.x=a-f.x,g.y=b-f.y,g.width=g.height=1;var h=d.getIntersectionList(g,null);h.length&&(e=h[h.length-1])}if(!e)return null;for(;e.parentNode&&e!=d.parentNode&&!e.raphael;)e=e.parentNode;return e==c.canvas.parentNode&&(e=d),e=e&&e.raphael?c.getById(e.raphaelid):null},v.getElementsByBBox=function(a){var b=this.set();return this.forEach(function(d){c.isBBoxIntersect(d.getBBox(),a)&&b.push(d)}),b},v.getById=function(a){for(var b=this.bottom;b;){if(b.id==a)return b;b=b.next}return null},v.forEach=function(a,b){for(var c=this.bottom;c;){if(a.call(b,c)===!1)return this;c=c.next}return this},v.getElementsByPoint=function(a,b){var c=this.set();return this.forEach(function(d){d.isPointInside(a,b)&&c.push(d)}),c},$b.isPointInside=function(a,b){var d=this.realPath=qb[this.type](this);return this.attr("transform")&&this.attr("transform").length&&(d=c.transformPath(d,this.attr("transform"))),c.isPointInsidePath(d,a,b)},$b.getBBox=function(a){if(this.removed)return{};var b=this._;return a?((b.dirty||!b.bboxwt)&&(this.realPath=qb[this.type](this),b.bboxwt=Bb(this.realPath),b.bboxwt.toString=p,b.dirty=0),b.bboxwt):((b.dirty||b.dirtyT||!b.bbox)&&((b.dirty||!this.realPath)&&(b.bboxwt=0,this.realPath=qb[this.type](this)),b.bbox=Bb(rb(this.realPath,this.matrix)),b.bbox.toString=p,b.dirty=b.dirtyT=0),b.bbox)},$b.clone=function(){if(this.removed)return null;var a=this.paper[this.type]().attr(this.attr());return this.__set__&&this.__set__.push(a),a},$b.glow=function(a){if("text"==this.type)return null;a=a||{};var b={width:(a.width||10)+(+this.attr("stroke-width")||1),fill:a.fill||!1,opacity:a.opacity||.5,offsetx:a.offsetx||0,offsety:a.offsety||0,color:a.color||"#000"},c=b.width/2,d=this.paper,e=d.set(),f=this.realPath||qb[this.type](this);f=this.matrix?rb(f,this.matrix):f;for(var g=1;c+1>g;g++)e.push(d.path(f).attr({stroke:b.color,fill:b.fill?b.color:"none","stroke-linejoin":"round","stroke-linecap":"round","stroke-width":+(b.width/c*g).toFixed(3),opacity:+(b.opacity/c).toFixed(3)}));return e.insertBefore(this).translate(b.offsetx,b.offsety)};var cc=function(a,b,d,e,f,g,h,i,l){return null==l?j(a,b,d,e,f,g,h,i):c.findDotsAtSegment(a,b,d,e,f,g,h,i,k(a,b,d,e,f,g,h,i,l))},dc=function(a,b){return function(d,e,f){d=Kb(d);for(var g,h,i,j,k,l="",m={},n=0,o=0,p=d.length;p>o;o++){if(i=d[o],"M"==i[0])g=+i[1],h=+i[2];else{if(j=cc(g,h,i[1],i[2],i[3],i[4],i[5],i[6]),n+j>e){if(b&&!m.start){if(k=cc(g,h,i[1],i[2],i[3],i[4],i[5],i[6],e-n),l+=["C"+k.start.x,k.start.y,k.m.x,k.m.y,k.x,k.y],f)return l;m.start=l,l=["M"+k.x,k.y+"C"+k.n.x,k.n.y,k.end.x,k.end.y,i[5],i[6]].join(),n+=j,g=+i[5],h=+i[6];continue}if(!a&&!b)return k=cc(g,h,i[1],i[2],i[3],i[4],i[5],i[6],e-n),{x:k.x,y:k.y,alpha:k.alpha}}n+=j,g=+i[5],h=+i[6]}l+=i.shift()+i}return m.end=l,k=a?n:b?m:c.findDotsAtSegment(g,h,i[0],i[1],i[2],i[3],i[4],i[5],1),k.alpha&&(k={x:k.x,y:k.y,alpha:k.alpha}),k}},ec=dc(1),fc=dc(),gc=dc(0,1);c.getTotalLength=ec,c.getPointAtLength=fc,c.getSubpath=function(a,b,c){if(this.getTotalLength(a)-c<1e-6)return gc(a,b).end;var d=gc(a,c,1);return b?gc(d,b).end:d},$b.getTotalLength=function(){var a=this.getPath();if(a)return this.node.getTotalLength?this.node.getTotalLength():ec(a)},$b.getPointAtLength=function(a){var b=this.getPath();if(b)return fc(b,a)},$b.getPath=function(){var a,b=c._getPath[this.type];if("text"!=this.type&&"set"!=this.type)return b&&(a=b(this)),a},$b.getSubpath=function(a,b){var d=this.getPath();if(d)return c.getSubpath(d,a,b)};var hc=c.easing_formulas={linear:function(a){return a},"<":function(a){return R(a,1.7)},">":function(a){return R(a,.48)},"<>":function(a){var b=.48-a/1.04,c=N.sqrt(.1734+b*b),d=c-b,e=R(Q(d),1/3)*(0>d?-1:1),f=-c-b,g=R(Q(f),1/3)*(0>f?-1:1),h=e+g+.5;return 3*(1-h)*h*h+h*h*h},backIn:function(a){var b=1.70158;return a*a*((b+1)*a-b)},backOut:function(a){a-=1;var b=1.70158;return a*a*((b+1)*a+b)+1},elastic:function(a){return a==!!a?a:R(2,-10*a)*N.sin(2*(a-.075)*S/.3)+1},bounce:function(a){var b,c=7.5625,d=2.75;return 1/d>a?b=c*a*a:2/d>a?(a-=1.5/d,b=c*a*a+.75):2.5/d>a?(a-=2.25/d,b=c*a*a+.9375):(a-=2.625/d,b=c*a*a+.984375),b}};hc.easeIn=hc["ease-in"]=hc["<"],hc.easeOut=hc["ease-out"]=hc[">"],hc.easeInOut=hc["ease-in-out"]=hc["<>"],hc["back-in"]=hc.backIn,hc["back-out"]=hc.backOut;var ic=[],jc=a.requestAnimationFrame||a.webkitRequestAnimationFrame||a.mozRequestAnimationFrame||a.oRequestAnimationFrame||a.msRequestAnimationFrame||function(a){setTimeout(a,16)},kc=function(){for(var a=+new Date,d=0;d<ic.length;d++){var e=ic[d];if(!e.el.removed&&!e.paused){var f,g,h=a-e.start,i=e.ms,j=e.easing,k=e.from,l=e.diff,m=e.to,n=(e.t,e.el),o={},p={};if(e.initstatus?(h=(e.initstatus*e.anim.top-e.prev)/(e.percent-e.prev)*i,e.status=e.initstatus,delete e.initstatus,e.stop&&ic.splice(d--,1)):e.status=(e.prev+(e.percent-e.prev)*(h/i))/e.anim.top,!(0>h))if(i>h){var q=j(h/i);for(var r in k)if(k[z](r)){switch(db[r]){case T:f=+k[r]+q*i*l[r];break;case"colour":f="rgb("+[lc($(k[r].r+q*i*l[r].r)),lc($(k[r].g+q*i*l[r].g)),lc($(k[r].b+q*i*l[r].b))].join(",")+")";break;case"path":f=[];for(var t=0,u=k[r].length;u>t;t++){f[t]=[k[r][t][0]];for(var v=1,w=k[r][t].length;w>v;v++)f[t][v]=+k[r][t][v]+q*i*l[r][t][v];f[t]=f[t].join(H)}f=f.join(H);break;case"transform":if(l[r].real)for(f=[],t=0,u=k[r].length;u>t;t++)for(f[t]=[k[r][t][0]],v=1,w=k[r][t].length;w>v;v++)f[t][v]=k[r][t][v]+q*i*l[r][t][v];else{var x=function(a){return+k[r][a]+q*i*l[r][a]};f=[["m",x(0),x(1),x(2),x(3),x(4),x(5)]]}break;case"csv":if("clip-rect"==r)for(f=[],t=4;t--;)f[t]=+k[r][t]+q*i*l[r][t];break;default:var y=[][E](k[r]);for(f=[],t=n.paper.customAttributes[r].length;t--;)f[t]=+y[t]+q*i*l[r][t]}o[r]=f}n.attr(o),function(a,c,d){setTimeout(function(){b("raphael.anim.frame."+a,c,d)})}(n.id,n,e.anim)}else{if(function(a,d,e){setTimeout(function(){b("raphael.anim.frame."+d.id,d,e),b("raphael.anim.finish."+d.id,d,e),c.is(a,"function")&&a.call(d)})}(e.callback,n,e.anim),n.attr(m),ic.splice(d--,1),e.repeat>1&&!e.next){for(g in m)m[z](g)&&(p[g]=e.totalOrigin[g]);e.el.attr(p),s(e.anim,e.el,e.anim.percents[0],null,e.totalOrigin,e.repeat-1)}e.next&&!e.stop&&s(e.anim,e.el,e.next,null,e.totalOrigin,e.repeat)}}}c.svg&&n&&n.paper&&n.paper.safari(),ic.length&&jc(kc)},lc=function(a){return a>255?255:0>a?0:a};$b.animateWith=function(a,b,d,e,f,g){var h=this;if(h.removed)return g&&g.call(h),h;var i=d instanceof r?d:c.animation(d,e,f,g);s(i,h,i.percents[0],null,h.attr());for(var j=0,k=ic.length;k>j;j++)if(ic[j].anim==b&&ic[j].el==a){ic[k-1].start=ic[j].start;break}return h},$b.onAnimation=function(a){return a?b.on("raphael.anim.frame."+this.id,a):b.unbind("raphael.anim.frame."+this.id),this},r.prototype.delay=function(a){var b=new r(this.anim,this.ms);return b.times=this.times,b.del=+a||0,b},r.prototype.repeat=function(a){var b=new r(this.anim,this.ms);return b.del=this.del,b.times=N.floor(O(a,0))||1,b},c.animation=function(a,b,d,e){if(a instanceof r)return a;(c.is(d,"function")||!d)&&(e=e||d||null,d=null),a=Object(a),b=+b||0;var f,g,h={};for(g in a)a[z](g)&&_(g)!=g&&_(g)+"%"!=g&&(f=!0,h[g]=a[g]);if(f)return d&&(h.easing=d),e&&(h.callback=e),new r({100:h},b);if(e){var i=0;for(var j in a){var k=ab(j);a[z](j)&&k>i&&(i=k)}i+="%",!a[i].callback&&(a[i].callback=e)}return new r(a,b)},$b.animate=function(a,b,d,e){var f=this;if(f.removed)return e&&e.call(f),f;var g=a instanceof r?a:c.animation(a,b,d,e);return s(g,f,g.percents[0],null,f.attr()),f},$b.setTime=function(a,b){return a&&null!=b&&this.status(a,P(b,a.ms)/a.ms),this},$b.status=function(a,b){var c,d,e=[],f=0;if(null!=b)return s(a,this,-1,P(b,1)),this;for(c=ic.length;c>f;f++)if(d=ic[f],d.el.id==this.id&&(!a||d.anim==a)){if(a)return d.status;e.push({anim:d.anim,status:d.status})}return a?0:e},$b.pause=function(a){for(var c=0;c<ic.length;c++)ic[c].el.id!=this.id||a&&ic[c].anim!=a||b("raphael.anim.pause."+this.id,this,ic[c].anim)!==!1&&(ic[c].paused=!0);return this},$b.resume=function(a){for(var c=0;c<ic.length;c++)if(ic[c].el.id==this.id&&(!a||ic[c].anim==a)){var d=ic[c];b("raphael.anim.resume."+this.id,this,d.anim)!==!1&&(delete d.paused,this.status(d.anim,d.status))}return this},$b.stop=function(a){for(var c=0;c<ic.length;c++)ic[c].el.id!=this.id||a&&ic[c].anim!=a||b("raphael.anim.stop."+this.id,this,ic[c].anim)!==!1&&ic.splice(c--,1);return this},b.on("raphael.remove",t),b.on("raphael.clear",t),$b.toString=function(){return"Raphaël’s object"};var mc=function(a){if(this.items=[],this.length=0,this.type="set",a)for(var b=0,c=a.length;c>b;b++)!a[b]||a[b].constructor!=$b.constructor&&a[b].constructor!=mc||(this[this.items.length]=this.items[this.items.length]=a[b],this.length++)},nc=mc.prototype;nc.push=function(){for(var a,b,c=0,d=arguments.length;d>c;c++)a=arguments[c],!a||a.constructor!=$b.constructor&&a.constructor!=mc||(b=this.items.length,this[b]=this.items[b]=a,this.length++);return this},nc.pop=function(){return this.length&&delete this[this.length--],this.items.pop()},nc.forEach=function(a,b){for(var c=0,d=this.items.length;d>c;c++)if(a.call(b,this.items[c],c)===!1)return this;return this};for(var oc in $b)$b[z](oc)&&(nc[oc]=function(a){return function(){var b=arguments;return this.forEach(function(c){c[a][D](c,b)})}}(oc));return nc.attr=function(a,b){if(a&&c.is(a,V)&&c.is(a[0],"object"))for(var d=0,e=a.length;e>d;d++)this.items[d].attr(a[d]);else for(var f=0,g=this.items.length;g>f;f++)this.items[f].attr(a,b);return this},nc.clear=function(){for(;this.length;)this.pop()},nc.splice=function(a,b){a=0>a?O(this.length+a,0):a,b=O(0,P(this.length-a,b));var c,d=[],e=[],f=[];for(c=2;c<arguments.length;c++)f.push(arguments[c]);for(c=0;b>c;c++)e.push(this[a+c]);for(;c<this.length-a;c++)d.push(this[a+c]);var g=f.length;for(c=0;c<g+d.length;c++)this.items[a+c]=this[a+c]=g>c?f[c]:d[c-g];for(c=this.items.length=this.length-=b-g;this[c];)delete this[c++];return new mc(e)},nc.exclude=function(a){for(var b=0,c=this.length;c>b;b++)if(this[b]==a)return this.splice(b,1),!0},nc.animate=function(a,b,d,e){(c.is(d,"function")||!d)&&(e=d||null);var f,g,h=this.items.length,i=h,j=this;if(!h)return this;e&&(g=function(){!--h&&e.call(j)}),d=c.is(d,U)?d:g;var k=c.animation(a,b,d,g);for(f=this.items[--i].animate(k);i--;)this.items[i]&&!this.items[i].removed&&this.items[i].animateWith(f,k,k),this.items[i]&&!this.items[i].removed||h--;return this},nc.insertAfter=function(a){for(var b=this.items.length;b--;)this.items[b].insertAfter(a);return this},nc.getBBox=function(){for(var a=[],b=[],c=[],d=[],e=this.items.length;e--;)if(!this.items[e].removed){var f=this.items[e].getBBox();a.push(f.x),b.push(f.y),c.push(f.x+f.width),d.push(f.y+f.height)}return a=P[D](0,a),b=P[D](0,b),c=O[D](0,c),d=O[D](0,d),{x:a,y:b,x2:c,y2:d,width:c-a,height:d-b}},nc.clone=function(a){a=this.paper.set();for(var b=0,c=this.items.length;c>b;b++)a.push(this.items[b].clone());return a},nc.toString=function(){return"Raphaël‘s set"},nc.glow=function(a){var b=this.paper.set();return this.forEach(function(c){var d=c.glow(a);null!=d&&d.forEach(function(a){b.push(a)})}),b},nc.isPointInside=function(a,b){var c=!1;return this.forEach(function(d){return d.isPointInside(a,b)?(c=!0,!1):void 0}),c},c.registerFont=function(a){if(!a.face)return a;this.fonts=this.fonts||{};var b={w:a.w,face:{},glyphs:{}},c=a.face["font-family"];for(var d in a.face)a.face[z](d)&&(b.face[d]=a.face[d]);if(this.fonts[c]?this.fonts[c].push(b):this.fonts[c]=[b],!a.svg){b.face["units-per-em"]=ab(a.face["units-per-em"],10);for(var e in a.glyphs)if(a.glyphs[z](e)){var f=a.glyphs[e];if(b.glyphs[e]={w:f.w,k:{},d:f.d&&"M"+f.d.replace(/[mlcxtrv]/g,function(a){return{l:"L",c:"C",x:"z",t:"m",r:"l",v:"c"}[a]||"M"})+"z"},f.k)for(var g in f.k)f[z](g)&&(b.glyphs[e].k[g]=f.k[g])}}return a},v.getFont=function(a,b,d,e){if(e=e||"normal",d=d||"normal",b=+b||{normal:400,bold:700,lighter:300,bolder:800}[b]||400,c.fonts){var f=c.fonts[a];if(!f){var g=new RegExp("(^|\\s)"+a.replace(/[^\w\d\s+!~.:_-]/g,G)+"(\\s|$)","i");for(var h in c.fonts)if(c.fonts[z](h)&&g.test(h)){f=c.fonts[h];break}}var i;if(f)for(var j=0,k=f.length;k>j&&(i=f[j],i.face["font-weight"]!=b||i.face["font-style"]!=d&&i.face["font-style"]||i.face["font-stretch"]!=e);j++);return i}},v.print=function(a,b,d,e,f,g,h,i){g=g||"middle",h=O(P(h||0,1),-1),i=O(P(i||1,3),1);var j,k=I(d)[J](G),l=0,m=0,n=G;if(c.is(e,"string")&&(e=this.getFont(e)),e){j=(f||16)/e.face["units-per-em"];for(var o=e.face.bbox[J](w),p=+o[0],q=o[3]-o[1],r=0,s=+o[1]+("baseline"==g?q+ +e.face.descent:q/2),t=0,u=k.length;u>t;t++){if("\n"==k[t])l=0,x=0,m=0,r+=q*i;else{var v=m&&e.glyphs[k[t-1]]||{},x=e.glyphs[k[t]];l+=m?(v.w||e.w)+(v.k&&v.k[k[t]]||0)+e.w*h:0,m=1}x&&x.d&&(n+=c.transformPath(x.d,["t",l*j,r*j,"s",j,j,p,s,"t",(a-p)/j,(b-s)/j]))}}return this.path(n).attr({fill:"#000",stroke:"none"})},v.add=function(a){if(c.is(a,"array"))for(var b,d=this.set(),e=0,f=a.length;f>e;e++)b=a[e]||{},x[z](b.type)&&d.push(this[b.type]().attr(b));return d},c.format=function(a,b){var d=c.is(b,V)?[0][E](b):arguments;return a&&c.is(a,U)&&d.length-1&&(a=a.replace(y,function(a,b){return null==d[++b]?G:d[b]})),a||G},c.fullfill=function(){var a=/\{([^\}]+)\}/g,b=/(?:(?:^|\.)(.+?)(?=\[|\.|$|\()|\[('|")(.+?)\2\])(\(\))?/g,c=function(a,c,d){var e=d;return c.replace(b,function(a,b,c,d,f){b=b||d,e&&(b in e&&(e=e[b]),"function"==typeof e&&f&&(e=e()))}),e=(null==e||e==d?a:e)+""};return function(b,d){return String(b).replace(a,function(a,b){return c(a,b,d)})}}(),c.ninja=function(){return B.was?A.win.Raphael=B.is:delete Raphael,c},c.st=nc,b.on("raphael.DOMload",function(){u=!0}),function(a,b,d){function e(){/in/.test(a.readyState)?setTimeout(e,9):c.eve("raphael.DOMload")}null==a.readyState&&a.addEventListener&&(a.addEventListener(b,d=function(){a.removeEventListener(b,d,!1),a.readyState="complete"},!1),a.readyState="loading"),e()}(document,"DOMContentLoaded"),function(){if(c.svg){var a="hasOwnProperty",b=String,d=parseFloat,e=parseInt,f=Math,g=f.max,h=f.abs,i=f.pow,j=/[, ]+/,k=c.eve,l="",m=" ",n="http://www.w3.org/1999/xlink",o={block:"M5,0 0,2.5 5,5z",classic:"M5,0 0,2.5 5,5 3.5,3 3.5,2z",diamond:"M2.5,0 5,2.5 2.5,5 0,2.5z",open:"M6,1 1,3.5 6,6",oval:"M2.5,0A2.5,2.5,0,0,1,2.5,5 2.5,2.5,0,0,1,2.5,0z"},p={};c.toString=function(){return"Your browser supports SVG.\nYou are running Raphaël "+this.version};var q=function(d,e){if(e){"string"==typeof d&&(d=q(d));for(var f in e)e[a](f)&&("xlink:"==f.substring(0,6)?d.setAttributeNS(n,f.substring(6),b(e[f])):d.setAttribute(f,b(e[f])))}else d=c._g.doc.createElementNS("http://www.w3.org/2000/svg",d),d.style&&(d.style.webkitTapHighlightColor="rgba(0,0,0,0)");return d},r=function(a,e){var j="linear",k=a.id+e,m=.5,n=.5,o=a.node,p=a.paper,r=o.style,s=c._g.doc.getElementById(k);if(!s){if(e=b(e).replace(c._radial_gradient,function(a,b,c){if(j="radial",b&&c){m=d(b),n=d(c);var e=2*(n>.5)-1;i(m-.5,2)+i(n-.5,2)>.25&&(n=f.sqrt(.25-i(m-.5,2))*e+.5)&&.5!=n&&(n=n.toFixed(5)-1e-5*e)}return l}),e=e.split(/\s*\-\s*/),"linear"==j){var t=e.shift();if(t=-d(t),isNaN(t))return null;var u=[0,0,f.cos(c.rad(t)),f.sin(c.rad(t))],v=1/(g(h(u[2]),h(u[3]))||1);u[2]*=v,u[3]*=v,u[2]<0&&(u[0]=-u[2],u[2]=0),u[3]<0&&(u[1]=-u[3],u[3]=0)}var w=c._parseDots(e);if(!w)return null;if(k=k.replace(/[\(\)\s,\xb0#]/g,"_"),a.gradient&&k!=a.gradient.id&&(p.defs.removeChild(a.gradient),delete a.gradient),!a.gradient){s=q(j+"Gradient",{id:k}),a.gradient=s,q(s,"radial"==j?{fx:m,fy:n}:{x1:u[0],y1:u[1],x2:u[2],y2:u[3],gradientTransform:a.matrix.invert()}),p.defs.appendChild(s);for(var x=0,y=w.length;y>x;x++)s.appendChild(q("stop",{offset:w[x].offset?w[x].offset:x?"100%":"0%","stop-color":w[x].color||"#fff"}))}}return q(o,{fill:"url("+document.location+"#"+k+")",opacity:1,"fill-opacity":1}),r.fill=l,r.opacity=1,r.fillOpacity=1,1},s=function(a){var b=a.getBBox(1);q(a.pattern,{patternTransform:a.matrix.invert()+" translate("+b.x+","+b.y+")"})},t=function(d,e,f){if("path"==d.type){for(var g,h,i,j,k,m=b(e).toLowerCase().split("-"),n=d.paper,r=f?"end":"start",s=d.node,t=d.attrs,u=t["stroke-width"],v=m.length,w="classic",x=3,y=3,z=5;v--;)switch(m[v]){case"block":case"classic":case"oval":case"diamond":case"open":case"none":w=m[v];break;case"wide":y=5;break;case"narrow":y=2;break;case"long":x=5;break;case"short":x=2}if("open"==w?(x+=2,y+=2,z+=2,i=1,j=f?4:1,k={fill:"none",stroke:t.stroke}):(j=i=x/2,k={fill:t.stroke,stroke:"none"}),d._.arrows?f?(d._.arrows.endPath&&p[d._.arrows.endPath]--,d._.arrows.endMarker&&p[d._.arrows.endMarker]--):(d._.arrows.startPath&&p[d._.arrows.startPath]--,d._.arrows.startMarker&&p[d._.arrows.startMarker]--):d._.arrows={},"none"!=w){var A="raphael-marker-"+w,B="raphael-marker-"+r+w+x+y+"-obj"+d.id;c._g.doc.getElementById(A)?p[A]++:(n.defs.appendChild(q(q("path"),{"stroke-linecap":"round",d:o[w],id:A})),p[A]=1);var C,D=c._g.doc.getElementById(B);D?(p[B]++,C=D.getElementsByTagName("use")[0]):(D=q(q("marker"),{id:B,markerHeight:y,markerWidth:x,orient:"auto",refX:j,refY:y/2}),C=q(q("use"),{"xlink:href":"#"+A,transform:(f?"rotate(180 "+x/2+" "+y/2+") ":l)+"scale("+x/z+","+y/z+")","stroke-width":(1/((x/z+y/z)/2)).toFixed(4)}),D.appendChild(C),n.defs.appendChild(D),p[B]=1),q(C,k);var E=i*("diamond"!=w&&"oval"!=w);f?(g=d._.arrows.startdx*u||0,h=c.getTotalLength(t.path)-E*u):(g=E*u,h=c.getTotalLength(t.path)-(d._.arrows.enddx*u||0)),k={},k["marker-"+r]="url(#"+B+")",(h||g)&&(k.d=c.getSubpath(t.path,g,h)),q(s,k),d._.arrows[r+"Path"]=A,d._.arrows[r+"Marker"]=B,d._.arrows[r+"dx"]=E,d._.arrows[r+"Type"]=w,d._.arrows[r+"String"]=e}else f?(g=d._.arrows.startdx*u||0,h=c.getTotalLength(t.path)-g):(g=0,h=c.getTotalLength(t.path)-(d._.arrows.enddx*u||0)),d._.arrows[r+"Path"]&&q(s,{d:c.getSubpath(t.path,g,h)}),delete d._.arrows[r+"Path"],delete d._.arrows[r+"Marker"],delete d._.arrows[r+"dx"],delete d._.arrows[r+"Type"],delete d._.arrows[r+"String"];for(k in p)if(p[a](k)&&!p[k]){var F=c._g.doc.getElementById(k);F&&F.parentNode.removeChild(F)}}},u={"":[0],none:[0],"-":[3,1],".":[1,1],"-.":[3,1,1,1],"-..":[3,1,1,1,1,1],". ":[1,3],"- ":[4,3],"--":[8,3],"- .":[4,3,1,3],"--.":[8,3,1,3],"--..":[8,3,1,3,1,3]},v=function(a,c,d){if(c=u[b(c).toLowerCase()]){for(var e=a.attrs["stroke-width"]||"1",f={round:e,square:e,butt:0}[a.attrs["stroke-linecap"]||d["stroke-linecap"]]||0,g=[],h=c.length;h--;)g[h]=c[h]*e+(h%2?1:-1)*f;q(a.node,{"stroke-dasharray":g.join(",")})}},w=function(d,f){var i=d.node,k=d.attrs,m=i.style.visibility;i.style.visibility="hidden";for(var o in f)if(f[a](o)){if(!c._availableAttrs[a](o))continue;var p=f[o];switch(k[o]=p,o){case"blur":d.blur(p);break;case"title":var u=i.getElementsByTagName("title");if(u.length&&(u=u[0]))u.firstChild.nodeValue=p;else{u=q("title");var w=c._g.doc.createTextNode(p);u.appendChild(w),i.appendChild(u)}break;case"href":case"target":var x=i.parentNode;if("a"!=x.tagName.toLowerCase()){var z=q("a");x.insertBefore(z,i),z.appendChild(i),x=z}"target"==o?x.setAttributeNS(n,"show","blank"==p?"new":p):x.setAttributeNS(n,o,p);break;case"cursor":i.style.cursor=p;break;case"transform":d.transform(p);break;case"arrow-start":t(d,p);break;case"arrow-end":t(d,p,1);break;case"clip-rect":var A=b(p).split(j);if(4==A.length){d.clip&&d.clip.parentNode.parentNode.removeChild(d.clip.parentNode);var B=q("clipPath"),C=q("rect");B.id=c.createUUID(),q(C,{x:A[0],y:A[1],width:A[2],height:A[3]}),B.appendChild(C),d.paper.defs.appendChild(B),q(i,{"clip-path":"url(#"+B.id+")"}),d.clip=C}if(!p){var D=i.getAttribute("clip-path");if(D){var E=c._g.doc.getElementById(D.replace(/(^url\(#|\)$)/g,l));E&&E.parentNode.removeChild(E),q(i,{"clip-path":l}),delete d.clip}}break;case"path":"path"==d.type&&(q(i,{d:p?k.path=c._pathToAbsolute(p):"M0,0"}),d._.dirty=1,d._.arrows&&("startString"in d._.arrows&&t(d,d._.arrows.startString),"endString"in d._.arrows&&t(d,d._.arrows.endString,1)));break;case"width":if(i.setAttribute(o,p),d._.dirty=1,!k.fx)break;o="x",p=k.x;case"x":k.fx&&(p=-k.x-(k.width||0));case"rx":if("rx"==o&&"rect"==d.type)break;case"cx":i.setAttribute(o,p),d.pattern&&s(d),d._.dirty=1;break;case"height":if(i.setAttribute(o,p),d._.dirty=1,!k.fy)break;o="y",p=k.y;case"y":k.fy&&(p=-k.y-(k.height||0));case"ry":if("ry"==o&&"rect"==d.type)break;case"cy":i.setAttribute(o,p),d.pattern&&s(d),d._.dirty=1;break;case"r":"rect"==d.type?q(i,{rx:p,ry:p}):i.setAttribute(o,p),d._.dirty=1;break;case"src":"image"==d.type&&i.setAttributeNS(n,"href",p);break;case"stroke-width":(1!=d._.sx||1!=d._.sy)&&(p/=g(h(d._.sx),h(d._.sy))||1),i.setAttribute(o,p),k["stroke-dasharray"]&&v(d,k["stroke-dasharray"],f),d._.arrows&&("startString"in d._.arrows&&t(d,d._.arrows.startString),"endString"in d._.arrows&&t(d,d._.arrows.endString,1));break;case"stroke-dasharray":v(d,p,f);break;case"fill":var F=b(p).match(c._ISURL);if(F){B=q("pattern");var G=q("image");B.id=c.createUUID(),q(B,{x:0,y:0,patternUnits:"userSpaceOnUse",height:1,width:1}),q(G,{x:0,y:0,"xlink:href":F[1]}),B.appendChild(G),function(a){c._preload(F[1],function(){var b=this.offsetWidth,c=this.offsetHeight;q(a,{width:b,height:c}),q(G,{width:b,height:c}),d.paper.safari()})}(B),d.paper.defs.appendChild(B),q(i,{fill:"url(#"+B.id+")"}),d.pattern=B,d.pattern&&s(d);break}var H=c.getRGB(p);if(H.error){if(("circle"==d.type||"ellipse"==d.type||"r"!=b(p).charAt())&&r(d,p)){if("opacity"in k||"fill-opacity"in k){var I=c._g.doc.getElementById(i.getAttribute("fill").replace(/^url\(#|\)$/g,l));if(I){var J=I.getElementsByTagName("stop");q(J[J.length-1],{"stop-opacity":("opacity"in k?k.opacity:1)*("fill-opacity"in k?k["fill-opacity"]:1)})}}k.gradient=p,k.fill="none";break}}else delete f.gradient,delete k.gradient,!c.is(k.opacity,"undefined")&&c.is(f.opacity,"undefined")&&q(i,{opacity:k.opacity}),!c.is(k["fill-opacity"],"undefined")&&c.is(f["fill-opacity"],"undefined")&&q(i,{"fill-opacity":k["fill-opacity"]});H[a]("opacity")&&q(i,{"fill-opacity":H.opacity>1?H.opacity/100:H.opacity});case"stroke":H=c.getRGB(p),i.setAttribute(o,H.hex),"stroke"==o&&H[a]("opacity")&&q(i,{"stroke-opacity":H.opacity>1?H.opacity/100:H.opacity}),"stroke"==o&&d._.arrows&&("startString"in d._.arrows&&t(d,d._.arrows.startString),"endString"in d._.arrows&&t(d,d._.arrows.endString,1));break;case"gradient":("circle"==d.type||"ellipse"==d.type||"r"!=b(p).charAt())&&r(d,p);break;
case"opacity":k.gradient&&!k[a]("stroke-opacity")&&q(i,{"stroke-opacity":p>1?p/100:p});case"fill-opacity":if(k.gradient){I=c._g.doc.getElementById(i.getAttribute("fill").replace(/^url\(#|\)$/g,l)),I&&(J=I.getElementsByTagName("stop"),q(J[J.length-1],{"stop-opacity":p}));break}default:"font-size"==o&&(p=e(p,10)+"px");var K=o.replace(/(\-.)/g,function(a){return a.substring(1).toUpperCase()});i.style[K]=p,d._.dirty=1,i.setAttribute(o,p)}}y(d,f),i.style.visibility=m},x=1.2,y=function(d,f){if("text"==d.type&&(f[a]("text")||f[a]("font")||f[a]("font-size")||f[a]("x")||f[a]("y"))){var g=d.attrs,h=d.node,i=h.firstChild?e(c._g.doc.defaultView.getComputedStyle(h.firstChild,l).getPropertyValue("font-size"),10):10;if(f[a]("text")){for(g.text=f.text;h.firstChild;)h.removeChild(h.firstChild);for(var j,k=b(f.text).split("\n"),m=[],n=0,o=k.length;o>n;n++)j=q("tspan"),n&&q(j,{dy:i*x,x:g.x}),j.appendChild(c._g.doc.createTextNode(k[n])),h.appendChild(j),m[n]=j}else for(m=h.getElementsByTagName("tspan"),n=0,o=m.length;o>n;n++)n?q(m[n],{dy:i*x,x:g.x}):q(m[0],{dy:0});q(h,{x:g.x,y:g.y}),d._.dirty=1;var p=d._getBBox(),r=g.y-(p.y+p.height/2);r&&c.is(r,"finite")&&q(m[0],{dy:r})}},z=function(a){return a.parentNode&&"a"===a.parentNode.tagName.toLowerCase()?a.parentNode:a};Element=function(a,b){this[0]=this.node=a,a.raphael=!0,this.id=c._oid++,a.raphaelid=this.id,this.matrix=c.matrix(),this.realPath=null,this.paper=b,this.attrs=this.attrs||{},this._={transform:[],sx:1,sy:1,deg:0,dx:0,dy:0,dirty:1},!b.bottom&&(b.bottom=this),this.prev=b.top,b.top&&(b.top.next=this),b.top=this,this.next=null},$b=c.el,Element.prototype=$b,$b.constructor=Element,c._engine.path=function(a,b){var c=q("path");b.canvas&&b.canvas.appendChild(c);var d=new Element(c,b);return d.type="path",w(d,{fill:"none",stroke:"#000",path:a}),d},$b.rotate=function(a,c,e){if(this.removed)return this;if(a=b(a).split(j),a.length-1&&(c=d(a[1]),e=d(a[2])),a=d(a[0]),null==e&&(c=e),null==c||null==e){var f=this.getBBox(1);c=f.x+f.width/2,e=f.y+f.height/2}return this.transform(this._.transform.concat([["r",a,c,e]])),this},$b.scale=function(a,c,e,f){if(this.removed)return this;if(a=b(a).split(j),a.length-1&&(c=d(a[1]),e=d(a[2]),f=d(a[3])),a=d(a[0]),null==c&&(c=a),null==f&&(e=f),null==e||null==f)var g=this.getBBox(1);return e=null==e?g.x+g.width/2:e,f=null==f?g.y+g.height/2:f,this.transform(this._.transform.concat([["s",a,c,e,f]])),this},$b.translate=function(a,c){return this.removed?this:(a=b(a).split(j),a.length-1&&(c=d(a[1])),a=d(a[0])||0,c=+c||0,this.transform(this._.transform.concat([["t",a,c]])),this)},$b.transform=function(b){var d=this._;if(null==b)return d.transform;if(c._extractTransform(this,b),this.clip&&q(this.clip,{transform:this.matrix.invert()}),this.pattern&&s(this),this.node&&q(this.node,{transform:this.matrix}),1!=d.sx||1!=d.sy){var e=this.attrs[a]("stroke-width")?this.attrs["stroke-width"]:1;this.attr({"stroke-width":e})}return this},$b.hide=function(){return!this.removed&&this.paper.safari(this.node.style.display="none"),this},$b.show=function(){return!this.removed&&this.paper.safari(this.node.style.display=""),this},$b.remove=function(){var a=z(this.node);if(!this.removed&&a.parentNode){var b=this.paper;b.__set__&&b.__set__.exclude(this),k.unbind("raphael.*.*."+this.id),this.gradient&&b.defs.removeChild(this.gradient),c._tear(this,b),a.parentNode.removeChild(a),this.removeData();for(var d in this)this[d]="function"==typeof this[d]?c._removedFactory(d):null;this.removed=!0}},$b._getBBox=function(){if("none"==this.node.style.display){this.show();var a=!0}var b,c=!1;this.paper.canvas.parentElement?b=this.paper.canvas.parentElement.style:this.paper.canvas.parentNode&&(b=this.paper.canvas.parentNode.style),b&&"none"==b.display&&(c=!0,b.display="");var d={};try{d=this.node.getBBox()}catch(e){d={x:this.node.clientLeft,y:this.node.clientTop,width:this.node.clientWidth,height:this.node.clientHeight}}finally{d=d||{},c&&(b.display="none")}return a&&this.hide(),d},$b.attr=function(b,d){if(this.removed)return this;if(null==b){var e={};for(var f in this.attrs)this.attrs[a](f)&&(e[f]=this.attrs[f]);return e.gradient&&"none"==e.fill&&(e.fill=e.gradient)&&delete e.gradient,e.transform=this._.transform,e}if(null==d&&c.is(b,"string")){if("fill"==b&&"none"==this.attrs.fill&&this.attrs.gradient)return this.attrs.gradient;if("transform"==b)return this._.transform;for(var g=b.split(j),h={},i=0,l=g.length;l>i;i++)b=g[i],h[b]=b in this.attrs?this.attrs[b]:c.is(this.paper.customAttributes[b],"function")?this.paper.customAttributes[b].def:c._availableAttrs[b];return l-1?h:h[g[0]]}if(null==d&&c.is(b,"array")){for(h={},i=0,l=b.length;l>i;i++)h[b[i]]=this.attr(b[i]);return h}if(null!=d){var m={};m[b]=d}else null!=b&&c.is(b,"object")&&(m=b);for(var n in m)k("raphael.attr."+n+"."+this.id,this,m[n]);for(n in this.paper.customAttributes)if(this.paper.customAttributes[a](n)&&m[a](n)&&c.is(this.paper.customAttributes[n],"function")){var o=this.paper.customAttributes[n].apply(this,[].concat(m[n]));this.attrs[n]=m[n];for(var p in o)o[a](p)&&(m[p]=o[p])}return w(this,m),this},$b.toFront=function(){if(this.removed)return this;var a=z(this.node);a.parentNode.appendChild(a);var b=this.paper;return b.top!=this&&c._tofront(this,b),this},$b.toBack=function(){if(this.removed)return this;var a=z(this.node),b=a.parentNode;b.insertBefore(a,b.firstChild),c._toback(this,this.paper);this.paper;return this},$b.insertAfter=function(a){if(this.removed||!a)return this;var b=z(this.node),d=z(a.node||a[a.length-1].node);return d.nextSibling?d.parentNode.insertBefore(b,d.nextSibling):d.parentNode.appendChild(b),c._insertafter(this,a,this.paper),this},$b.insertBefore=function(a){if(this.removed||!a)return this;var b=z(this.node),d=z(a.node||a[0].node);return d.parentNode.insertBefore(b,d),c._insertbefore(this,a,this.paper),this},$b.blur=function(a){var b=this;if(0!==+a){var d=q("filter"),e=q("feGaussianBlur");b.attrs.blur=a,d.id=c.createUUID(),q(e,{stdDeviation:+a||1.5}),d.appendChild(e),b.paper.defs.appendChild(d),b._blur=d,q(b.node,{filter:"url(#"+d.id+")"})}else b._blur&&(b._blur.parentNode.removeChild(b._blur),delete b._blur,delete b.attrs.blur),b.node.removeAttribute("filter");return b},c._engine.circle=function(a,b,c,d){var e=q("circle");a.canvas&&a.canvas.appendChild(e);var f=new Element(e,a);return f.attrs={cx:b,cy:c,r:d,fill:"none",stroke:"#000"},f.type="circle",q(e,f.attrs),f},c._engine.rect=function(a,b,c,d,e,f){var g=q("rect");a.canvas&&a.canvas.appendChild(g);var h=new Element(g,a);return h.attrs={x:b,y:c,width:d,height:e,rx:f||0,ry:f||0,fill:"none",stroke:"#000"},h.type="rect",q(g,h.attrs),h},c._engine.ellipse=function(a,b,c,d,e){var f=q("ellipse");a.canvas&&a.canvas.appendChild(f);var g=new Element(f,a);return g.attrs={cx:b,cy:c,rx:d,ry:e,fill:"none",stroke:"#000"},g.type="ellipse",q(f,g.attrs),g},c._engine.image=function(a,b,c,d,e,f){var g=q("image");q(g,{x:c,y:d,width:e,height:f,preserveAspectRatio:"none"}),g.setAttributeNS(n,"href",b),a.canvas&&a.canvas.appendChild(g);var h=new Element(g,a);return h.attrs={x:c,y:d,width:e,height:f,src:b},h.type="image",h},c._engine.text=function(a,b,d,e){var f=q("text");a.canvas&&a.canvas.appendChild(f);var g=new Element(f,a);return g.attrs={x:b,y:d,"text-anchor":"middle",text:e,"font-family":c._availableAttrs["font-family"],"font-size":c._availableAttrs["font-size"],stroke:"none",fill:"#000"},g.type="text",w(g,g.attrs),g},c._engine.setSize=function(a,b){return this.width=a||this.width,this.height=b||this.height,this.canvas.setAttribute("width",this.width),this.canvas.setAttribute("height",this.height),this._viewBox&&this.setViewBox.apply(this,this._viewBox),this},c._engine.create=function(){var a=c._getContainer.apply(0,arguments),b=a&&a.container,d=a.x,e=a.y,f=a.width,g=a.height;if(!b)throw new Error("SVG container not found.");var h,i=q("svg"),j="overflow:hidden;";return d=d||0,e=e||0,f=f||512,g=g||342,q(i,{height:g,version:1.1,width:f,xmlns:"http://www.w3.org/2000/svg","xmlns:xlink":"http://www.w3.org/1999/xlink"}),1==b?(i.style.cssText=j+"position:absolute;left:"+d+"px;top:"+e+"px",c._g.doc.body.appendChild(i),h=1):(i.style.cssText=j+"position:relative",b.firstChild?b.insertBefore(i,b.firstChild):b.appendChild(i)),b=new c._Paper,b.width=f,b.height=g,b.canvas=i,b.clear(),b._left=b._top=0,h&&(b.renderfix=function(){}),b.renderfix(),b},c._engine.setViewBox=function(a,b,c,d,e){k("raphael.setViewBox",this,this._viewBox,[a,b,c,d,e]);var f,h,i=this.getSize(),j=g(c/i.width,d/i.height),l=this.top,n=e?"xMidYMid meet":"xMinYMin";for(null==a?(this._vbSize&&(j=1),delete this._vbSize,f="0 0 "+this.width+m+this.height):(this._vbSize=j,f=a+m+b+m+c+m+d),q(this.canvas,{viewBox:f,preserveAspectRatio:n});j&&l;)h="stroke-width"in l.attrs?l.attrs["stroke-width"]:1,l.attr({"stroke-width":h}),l._.dirty=1,l._.dirtyT=1,l=l.prev;return this._viewBox=[a,b,c,d,!!e],this},c.prototype.renderfix=function(){var a,b=this.canvas,c=b.style;try{a=b.getScreenCTM()||b.createSVGMatrix()}catch(d){a=b.createSVGMatrix()}var e=-a.e%1,f=-a.f%1;(e||f)&&(e&&(this._left=(this._left+e)%1,c.left=this._left+"px"),f&&(this._top=(this._top+f)%1,c.top=this._top+"px"))},c.prototype.clear=function(){c.eve("raphael.clear",this);for(var a=this.canvas;a.firstChild;)a.removeChild(a.firstChild);this.bottom=this.top=null,(this.desc=q("desc")).appendChild(c._g.doc.createTextNode("Created with Raphaël "+c.version)),a.appendChild(this.desc),a.appendChild(this.defs=q("defs"))},c.prototype.remove=function(){k("raphael.remove",this),this.canvas.parentNode&&this.canvas.parentNode.removeChild(this.canvas);for(var a in this)this[a]="function"==typeof this[a]?c._removedFactory(a):null};var A=c.st;for(var B in $b)$b[a](B)&&!A[a](B)&&(A[B]=function(a){return function(){var b=arguments;return this.forEach(function(c){c[a].apply(c,b)})}}(B))}}(),function(){if(c.vml){var a="hasOwnProperty",b=String,d=parseFloat,e=Math,f=e.round,g=e.max,h=e.min,i=e.abs,j="fill",k=/[, ]+/,l=c.eve,m=" progid:DXImageTransform.Microsoft",n=" ",o="",p={M:"m",L:"l",C:"c",Z:"x",m:"t",l:"r",c:"v",z:"x"},q=/([clmz]),?([^clmz]*)/gi,r=/ progid:\S+Blur\([^\)]+\)/g,s=/-?[^,\s-]+/g,t="position:absolute;left:0;top:0;width:1px;height:1px;behavior:url(#default#VML)",u=21600,v={path:1,rect:1,image:1},w={circle:1,ellipse:1},x=function(a){var d=/[ahqstv]/gi,e=c._pathToAbsolute;if(b(a).match(d)&&(e=c._path2curve),d=/[clmz]/g,e==c._pathToAbsolute&&!b(a).match(d)){var g=b(a).replace(q,function(a,b,c){var d=[],e="m"==b.toLowerCase(),g=p[b];return c.replace(s,function(a){e&&2==d.length&&(g+=d+p["m"==b?"l":"L"],d=[]),d.push(f(a*u))}),g+d});return g}var h,i,j=e(a);g=[];for(var k=0,l=j.length;l>k;k++){h=j[k],i=j[k][0].toLowerCase(),"z"==i&&(i="x");for(var m=1,r=h.length;r>m;m++)i+=f(h[m]*u)+(m!=r-1?",":o);g.push(i)}return g.join(n)},y=function(a,b,d){var e=c.matrix();return e.rotate(-a,.5,.5),{dx:e.x(b,d),dy:e.y(b,d)}},z=function(a,b,c,d,e,f){var g=a._,h=a.matrix,k=g.fillpos,l=a.node,m=l.style,o=1,p="",q=u/b,r=u/c;if(m.visibility="hidden",b&&c){if(l.coordsize=i(q)+n+i(r),m.rotation=f*(0>b*c?-1:1),f){var s=y(f,d,e);d=s.dx,e=s.dy}if(0>b&&(p+="x"),0>c&&(p+=" y")&&(o=-1),m.flip=p,l.coordorigin=d*-q+n+e*-r,k||g.fillsize){var t=l.getElementsByTagName(j);t=t&&t[0],l.removeChild(t),k&&(s=y(f,h.x(k[0],k[1]),h.y(k[0],k[1])),t.position=s.dx*o+n+s.dy*o),g.fillsize&&(t.size=g.fillsize[0]*i(b)+n+g.fillsize[1]*i(c)),l.appendChild(t)}m.visibility="visible"}};c.toString=function(){return"Your browser doesn’t support SVG. Falling down to VML.\nYou are running Raphaël "+this.version};var A=function(a,c,d){for(var e=b(c).toLowerCase().split("-"),f=d?"end":"start",g=e.length,h="classic",i="medium",j="medium";g--;)switch(e[g]){case"block":case"classic":case"oval":case"diamond":case"open":case"none":h=e[g];break;case"wide":case"narrow":j=e[g];break;case"long":case"short":i=e[g]}var k=a.node.getElementsByTagName("stroke")[0];k[f+"arrow"]=h,k[f+"arrowlength"]=i,k[f+"arrowwidth"]=j},B=function(e,i){e.attrs=e.attrs||{};var l=e.node,m=e.attrs,p=l.style,q=v[e.type]&&(i.x!=m.x||i.y!=m.y||i.width!=m.width||i.height!=m.height||i.cx!=m.cx||i.cy!=m.cy||i.rx!=m.rx||i.ry!=m.ry||i.r!=m.r),r=w[e.type]&&(m.cx!=i.cx||m.cy!=i.cy||m.r!=i.r||m.rx!=i.rx||m.ry!=i.ry),s=e;for(var t in i)i[a](t)&&(m[t]=i[t]);if(q&&(m.path=c._getPath[e.type](e),e._.dirty=1),i.href&&(l.href=i.href),i.title&&(l.title=i.title),i.target&&(l.target=i.target),i.cursor&&(p.cursor=i.cursor),"blur"in i&&e.blur(i.blur),(i.path&&"path"==e.type||q)&&(l.path=x(~b(m.path).toLowerCase().indexOf("r")?c._pathToAbsolute(m.path):m.path),e._.dirty=1,"image"==e.type&&(e._.fillpos=[m.x,m.y],e._.fillsize=[m.width,m.height],z(e,1,1,0,0,0))),"transform"in i&&e.transform(i.transform),r){var y=+m.cx,B=+m.cy,D=+m.rx||+m.r||0,E=+m.ry||+m.r||0;l.path=c.format("ar{0},{1},{2},{3},{4},{1},{4},{1}x",f((y-D)*u),f((B-E)*u),f((y+D)*u),f((B+E)*u),f(y*u)),e._.dirty=1}if("clip-rect"in i){var G=b(i["clip-rect"]).split(k);if(4==G.length){G[2]=+G[2]+ +G[0],G[3]=+G[3]+ +G[1];var H=l.clipRect||c._g.doc.createElement("div"),I=H.style;I.clip=c.format("rect({1}px {2}px {3}px {0}px)",G),l.clipRect||(I.position="absolute",I.top=0,I.left=0,I.width=e.paper.width+"px",I.height=e.paper.height+"px",l.parentNode.insertBefore(H,l),H.appendChild(l),l.clipRect=H)}i["clip-rect"]||l.clipRect&&(l.clipRect.style.clip="auto")}if(e.textpath){var J=e.textpath.style;i.font&&(J.font=i.font),i["font-family"]&&(J.fontFamily='"'+i["font-family"].split(",")[0].replace(/^['"]+|['"]+$/g,o)+'"'),i["font-size"]&&(J.fontSize=i["font-size"]),i["font-weight"]&&(J.fontWeight=i["font-weight"]),i["font-style"]&&(J.fontStyle=i["font-style"])}if("arrow-start"in i&&A(s,i["arrow-start"]),"arrow-end"in i&&A(s,i["arrow-end"],1),null!=i.opacity||null!=i["stroke-width"]||null!=i.fill||null!=i.src||null!=i.stroke||null!=i["stroke-width"]||null!=i["stroke-opacity"]||null!=i["fill-opacity"]||null!=i["stroke-dasharray"]||null!=i["stroke-miterlimit"]||null!=i["stroke-linejoin"]||null!=i["stroke-linecap"]){var K=l.getElementsByTagName(j),L=!1;if(K=K&&K[0],!K&&(L=K=F(j)),"image"==e.type&&i.src&&(K.src=i.src),i.fill&&(K.on=!0),(null==K.on||"none"==i.fill||null===i.fill)&&(K.on=!1),K.on&&i.fill){var M=b(i.fill).match(c._ISURL);if(M){K.parentNode==l&&l.removeChild(K),K.rotate=!0,K.src=M[1],K.type="tile";var N=e.getBBox(1);K.position=N.x+n+N.y,e._.fillpos=[N.x,N.y],c._preload(M[1],function(){e._.fillsize=[this.offsetWidth,this.offsetHeight]})}else K.color=c.getRGB(i.fill).hex,K.src=o,K.type="solid",c.getRGB(i.fill).error&&(s.type in{circle:1,ellipse:1}||"r"!=b(i.fill).charAt())&&C(s,i.fill,K)&&(m.fill="none",m.gradient=i.fill,K.rotate=!1)}if("fill-opacity"in i||"opacity"in i){var O=((+m["fill-opacity"]+1||2)-1)*((+m.opacity+1||2)-1)*((+c.getRGB(i.fill).o+1||2)-1);O=h(g(O,0),1),K.opacity=O,K.src&&(K.color="none")}l.appendChild(K);var P=l.getElementsByTagName("stroke")&&l.getElementsByTagName("stroke")[0],Q=!1;!P&&(Q=P=F("stroke")),(i.stroke&&"none"!=i.stroke||i["stroke-width"]||null!=i["stroke-opacity"]||i["stroke-dasharray"]||i["stroke-miterlimit"]||i["stroke-linejoin"]||i["stroke-linecap"])&&(P.on=!0),("none"==i.stroke||null===i.stroke||null==P.on||0==i.stroke||0==i["stroke-width"])&&(P.on=!1);var R=c.getRGB(i.stroke);P.on&&i.stroke&&(P.color=R.hex),O=((+m["stroke-opacity"]+1||2)-1)*((+m.opacity+1||2)-1)*((+R.o+1||2)-1);var S=.75*(d(i["stroke-width"])||1);if(O=h(g(O,0),1),null==i["stroke-width"]&&(S=m["stroke-width"]),i["stroke-width"]&&(P.weight=S),S&&1>S&&(O*=S)&&(P.weight=1),P.opacity=O,i["stroke-linejoin"]&&(P.joinstyle=i["stroke-linejoin"]||"miter"),P.miterlimit=i["stroke-miterlimit"]||8,i["stroke-linecap"]&&(P.endcap="butt"==i["stroke-linecap"]?"flat":"square"==i["stroke-linecap"]?"square":"round"),"stroke-dasharray"in i){var T={"-":"shortdash",".":"shortdot","-.":"shortdashdot","-..":"shortdashdotdot",". ":"dot","- ":"dash","--":"longdash","- .":"dashdot","--.":"longdashdot","--..":"longdashdotdot"};P.dashstyle=T[a](i["stroke-dasharray"])?T[i["stroke-dasharray"]]:o}Q&&l.appendChild(P)}if("text"==s.type){s.paper.canvas.style.display=o;var U=s.paper.span,V=100,W=m.font&&m.font.match(/\d+(?:\.\d*)?(?=px)/);p=U.style,m.font&&(p.font=m.font),m["font-family"]&&(p.fontFamily=m["font-family"]),m["font-weight"]&&(p.fontWeight=m["font-weight"]),m["font-style"]&&(p.fontStyle=m["font-style"]),W=d(m["font-size"]||W&&W[0])||10,p.fontSize=W*V+"px",s.textpath.string&&(U.innerHTML=b(s.textpath.string).replace(/</g,"&#60;").replace(/&/g,"&#38;").replace(/\n/g,"<br>"));var X=U.getBoundingClientRect();s.W=m.w=(X.right-X.left)/V,s.H=m.h=(X.bottom-X.top)/V,s.X=m.x,s.Y=m.y+s.H/2,("x"in i||"y"in i)&&(s.path.v=c.format("m{0},{1}l{2},{1}",f(m.x*u),f(m.y*u),f(m.x*u)+1));for(var Y=["x","y","text","font","font-family","font-weight","font-style","font-size"],Z=0,$=Y.length;$>Z;Z++)if(Y[Z]in i){s._.dirty=1;break}switch(m["text-anchor"]){case"start":s.textpath.style["v-text-align"]="left",s.bbx=s.W/2;break;case"end":s.textpath.style["v-text-align"]="right",s.bbx=-s.W/2;break;default:s.textpath.style["v-text-align"]="center",s.bbx=0}s.textpath.style["v-text-kern"]=!0}},C=function(a,f,g){a.attrs=a.attrs||{};var h=(a.attrs,Math.pow),i="linear",j=".5 .5";if(a.attrs.gradient=f,f=b(f).replace(c._radial_gradient,function(a,b,c){return i="radial",b&&c&&(b=d(b),c=d(c),h(b-.5,2)+h(c-.5,2)>.25&&(c=e.sqrt(.25-h(b-.5,2))*(2*(c>.5)-1)+.5),j=b+n+c),o}),f=f.split(/\s*\-\s*/),"linear"==i){var k=f.shift();if(k=-d(k),isNaN(k))return null}var l=c._parseDots(f);if(!l)return null;if(a=a.shape||a.node,l.length){a.removeChild(g),g.on=!0,g.method="none",g.color=l[0].color,g.color2=l[l.length-1].color;for(var m=[],p=0,q=l.length;q>p;p++)l[p].offset&&m.push(l[p].offset+n+l[p].color);g.colors=m.length?m.join():"0% "+g.color,"radial"==i?(g.type="gradientTitle",g.focus="100%",g.focussize="0 0",g.focusposition=j,g.angle=0):(g.type="gradient",g.angle=(270-k)%360),a.appendChild(g)}return 1},D=function(a,b){this[0]=this.node=a,a.raphael=!0,this.id=c._oid++,a.raphaelid=this.id,this.X=0,this.Y=0,this.attrs={},this.paper=b,this.matrix=c.matrix(),this._={transform:[],sx:1,sy:1,dx:0,dy:0,deg:0,dirty:1,dirtyT:1},!b.bottom&&(b.bottom=this),this.prev=b.top,b.top&&(b.top.next=this),b.top=this,this.next=null},E=c.el;D.prototype=E,E.constructor=D,E.transform=function(a){if(null==a)return this._.transform;var d,e=this.paper._viewBoxShift,f=e?"s"+[e.scale,e.scale]+"-1-1t"+[e.dx,e.dy]:o;e&&(d=a=b(a).replace(/\.{3}|\u2026/g,this._.transform||o)),c._extractTransform(this,f+a);var g,h=this.matrix.clone(),i=this.skew,j=this.node,k=~b(this.attrs.fill).indexOf("-"),l=!b(this.attrs.fill).indexOf("url(");if(h.translate(1,1),l||k||"image"==this.type)if(i.matrix="1 0 0 1",i.offset="0 0",g=h.split(),k&&g.noRotation||!g.isSimple){j.style.filter=h.toFilter();var m=this.getBBox(),p=this.getBBox(1),q=m.x-p.x,r=m.y-p.y;j.coordorigin=q*-u+n+r*-u,z(this,1,1,q,r,0)}else j.style.filter=o,z(this,g.scalex,g.scaley,g.dx,g.dy,g.rotate);else j.style.filter=o,i.matrix=b(h),i.offset=h.offset();return null!==d&&(this._.transform=d,c._extractTransform(this,d)),this},E.rotate=function(a,c,e){if(this.removed)return this;if(null!=a){if(a=b(a).split(k),a.length-1&&(c=d(a[1]),e=d(a[2])),a=d(a[0]),null==e&&(c=e),null==c||null==e){var f=this.getBBox(1);c=f.x+f.width/2,e=f.y+f.height/2}return this._.dirtyT=1,this.transform(this._.transform.concat([["r",a,c,e]])),this}},E.translate=function(a,c){return this.removed?this:(a=b(a).split(k),a.length-1&&(c=d(a[1])),a=d(a[0])||0,c=+c||0,this._.bbox&&(this._.bbox.x+=a,this._.bbox.y+=c),this.transform(this._.transform.concat([["t",a,c]])),this)},E.scale=function(a,c,e,f){if(this.removed)return this;if(a=b(a).split(k),a.length-1&&(c=d(a[1]),e=d(a[2]),f=d(a[3]),isNaN(e)&&(e=null),isNaN(f)&&(f=null)),a=d(a[0]),null==c&&(c=a),null==f&&(e=f),null==e||null==f)var g=this.getBBox(1);return e=null==e?g.x+g.width/2:e,f=null==f?g.y+g.height/2:f,this.transform(this._.transform.concat([["s",a,c,e,f]])),this._.dirtyT=1,this},E.hide=function(){return!this.removed&&(this.node.style.display="none"),this},E.show=function(){return!this.removed&&(this.node.style.display=o),this},E.auxGetBBox=c.el.getBBox,E.getBBox=function(){var a=this.auxGetBBox();if(this.paper&&this.paper._viewBoxShift){var b={},c=1/this.paper._viewBoxShift.scale;return b.x=a.x-this.paper._viewBoxShift.dx,b.x*=c,b.y=a.y-this.paper._viewBoxShift.dy,b.y*=c,b.width=a.width*c,b.height=a.height*c,b.x2=b.x+b.width,b.y2=b.y+b.height,b}return a},E._getBBox=function(){return this.removed?{}:{x:this.X+(this.bbx||0)-this.W/2,y:this.Y-this.H,width:this.W,height:this.H}},E.remove=function(){if(!this.removed&&this.node.parentNode){this.paper.__set__&&this.paper.__set__.exclude(this),c.eve.unbind("raphael.*.*."+this.id),c._tear(this,this.paper),this.node.parentNode.removeChild(this.node),this.shape&&this.shape.parentNode.removeChild(this.shape);for(var a in this)this[a]="function"==typeof this[a]?c._removedFactory(a):null;this.removed=!0}},E.attr=function(b,d){if(this.removed)return this;if(null==b){var e={};for(var f in this.attrs)this.attrs[a](f)&&(e[f]=this.attrs[f]);return e.gradient&&"none"==e.fill&&(e.fill=e.gradient)&&delete e.gradient,e.transform=this._.transform,e}if(null==d&&c.is(b,"string")){if(b==j&&"none"==this.attrs.fill&&this.attrs.gradient)return this.attrs.gradient;for(var g=b.split(k),h={},i=0,m=g.length;m>i;i++)b=g[i],h[b]=b in this.attrs?this.attrs[b]:c.is(this.paper.customAttributes[b],"function")?this.paper.customAttributes[b].def:c._availableAttrs[b];return m-1?h:h[g[0]]}if(this.attrs&&null==d&&c.is(b,"array")){for(h={},i=0,m=b.length;m>i;i++)h[b[i]]=this.attr(b[i]);return h}var n;null!=d&&(n={},n[b]=d),null==d&&c.is(b,"object")&&(n=b);for(var o in n)l("raphael.attr."+o+"."+this.id,this,n[o]);if(n){for(o in this.paper.customAttributes)if(this.paper.customAttributes[a](o)&&n[a](o)&&c.is(this.paper.customAttributes[o],"function")){var p=this.paper.customAttributes[o].apply(this,[].concat(n[o]));this.attrs[o]=n[o];for(var q in p)p[a](q)&&(n[q]=p[q])}n.text&&"text"==this.type&&(this.textpath.string=n.text),B(this,n)}return this},E.toFront=function(){return!this.removed&&this.node.parentNode.appendChild(this.node),this.paper&&this.paper.top!=this&&c._tofront(this,this.paper),this},E.toBack=function(){return this.removed?this:(this.node.parentNode.firstChild!=this.node&&(this.node.parentNode.insertBefore(this.node,this.node.parentNode.firstChild),c._toback(this,this.paper)),this)},E.insertAfter=function(a){return this.removed?this:(a.constructor==c.st.constructor&&(a=a[a.length-1]),a.node.nextSibling?a.node.parentNode.insertBefore(this.node,a.node.nextSibling):a.node.parentNode.appendChild(this.node),c._insertafter(this,a,this.paper),this)},E.insertBefore=function(a){return this.removed?this:(a.constructor==c.st.constructor&&(a=a[0]),a.node.parentNode.insertBefore(this.node,a.node),c._insertbefore(this,a,this.paper),this)},E.blur=function(a){var b=this.node.runtimeStyle,d=b.filter;return d=d.replace(r,o),0!==+a?(this.attrs.blur=a,b.filter=d+n+m+".Blur(pixelradius="+(+a||1.5)+")",b.margin=c.format("-{0}px 0 0 -{0}px",f(+a||1.5))):(b.filter=d,b.margin=0,delete this.attrs.blur),this},c._engine.path=function(a,b){var c=F("shape");c.style.cssText=t,c.coordsize=u+n+u,c.coordorigin=b.coordorigin;var d=new D(c,b),e={fill:"none",stroke:"#000"};a&&(e.path=a),d.type="path",d.path=[],d.Path=o,B(d,e),b.canvas.appendChild(c);var f=F("skew");return f.on=!0,c.appendChild(f),d.skew=f,d.transform(o),d},c._engine.rect=function(a,b,d,e,f,g){var h=c._rectPath(b,d,e,f,g),i=a.path(h),j=i.attrs;return i.X=j.x=b,i.Y=j.y=d,i.W=j.width=e,i.H=j.height=f,j.r=g,j.path=h,i.type="rect",i},c._engine.ellipse=function(a,b,c,d,e){{var f=a.path();f.attrs}return f.X=b-d,f.Y=c-e,f.W=2*d,f.H=2*e,f.type="ellipse",B(f,{cx:b,cy:c,rx:d,ry:e}),f},c._engine.circle=function(a,b,c,d){{var e=a.path();e.attrs}return e.X=b-d,e.Y=c-d,e.W=e.H=2*d,e.type="circle",B(e,{cx:b,cy:c,r:d}),e},c._engine.image=function(a,b,d,e,f,g){var h=c._rectPath(d,e,f,g),i=a.path(h).attr({stroke:"none"}),k=i.attrs,l=i.node,m=l.getElementsByTagName(j)[0];return k.src=b,i.X=k.x=d,i.Y=k.y=e,i.W=k.width=f,i.H=k.height=g,k.path=h,i.type="image",m.parentNode==l&&l.removeChild(m),m.rotate=!0,m.src=b,m.type="tile",i._.fillpos=[d,e],i._.fillsize=[f,g],l.appendChild(m),z(i,1,1,0,0,0),i},c._engine.text=function(a,d,e,g){var h=F("shape"),i=F("path"),j=F("textpath");d=d||0,e=e||0,g=g||"",i.v=c.format("m{0},{1}l{2},{1}",f(d*u),f(e*u),f(d*u)+1),i.textpathok=!0,j.string=b(g),j.on=!0,h.style.cssText=t,h.coordsize=u+n+u,h.coordorigin="0 0";var k=new D(h,a),l={fill:"#000",stroke:"none",font:c._availableAttrs.font,text:g};k.shape=h,k.path=i,k.textpath=j,k.type="text",k.attrs.text=b(g),k.attrs.x=d,k.attrs.y=e,k.attrs.w=1,k.attrs.h=1,B(k,l),h.appendChild(j),h.appendChild(i),a.canvas.appendChild(h);var m=F("skew");return m.on=!0,h.appendChild(m),k.skew=m,k.transform(o),k},c._engine.setSize=function(a,b){var d=this.canvas.style;return this.width=a,this.height=b,a==+a&&(a+="px"),b==+b&&(b+="px"),d.width=a,d.height=b,d.clip="rect(0 "+a+" "+b+" 0)",this._viewBox&&c._engine.setViewBox.apply(this,this._viewBox),this},c._engine.setViewBox=function(a,b,d,e,f){c.eve("raphael.setViewBox",this,this._viewBox,[a,b,d,e,f]);var g,h,i=this.getSize(),j=i.width,k=i.height;return f&&(g=k/e,h=j/d,j>d*g&&(a-=(j-d*g)/2/g),k>e*h&&(b-=(k-e*h)/2/h)),this._viewBox=[a,b,d,e,!!f],this._viewBoxShift={dx:-a,dy:-b,scale:size},this.forEach(function(a){a.transform("...")}),this};var F;c._engine.initWin=function(a){var b=a.document;b.styleSheets.length<31?b.createStyleSheet().addRule(".rvml","behavior:url(#default#VML)"):b.styleSheets[0].addRule(".rvml","behavior:url(#default#VML)");try{!b.namespaces.rvml&&b.namespaces.add("rvml","urn:schemas-microsoft-com:vml"),F=function(a){return b.createElement("<rvml:"+a+' class="rvml">')}}catch(c){F=function(a){return b.createElement("<"+a+' xmlns="urn:schemas-microsoft.com:vml" class="rvml">')}}},c._engine.initWin(c._g.win),c._engine.create=function(){var a=c._getContainer.apply(0,arguments),b=a.container,d=a.height,e=a.width,f=a.x,g=a.y;if(!b)throw new Error("VML container not found.");var h=new c._Paper,i=h.canvas=c._g.doc.createElement("div"),j=i.style;return f=f||0,g=g||0,e=e||512,d=d||342,h.width=e,h.height=d,e==+e&&(e+="px"),d==+d&&(d+="px"),h.coordsize=1e3*u+n+1e3*u,h.coordorigin="0 0",h.span=c._g.doc.createElement("span"),h.span.style.cssText="position:absolute;left:-9999em;top:-9999em;padding:0;margin:0;line-height:1;",i.appendChild(h.span),j.cssText=c.format("top:0;left:0;width:{0};height:{1};display:inline-block;position:relative;clip:rect(0 {0} {1} 0);overflow:hidden",e,d),1==b?(c._g.doc.body.appendChild(i),j.left=f+"px",j.top=g+"px",j.position="absolute"):b.firstChild?b.insertBefore(i,b.firstChild):b.appendChild(i),h.renderfix=function(){},h},c.prototype.clear=function(){c.eve("raphael.clear",this),this.canvas.innerHTML=o,this.span=c._g.doc.createElement("span"),this.span.style.cssText="position:absolute;left:-9999em;top:-9999em;padding:0;margin:0;line-height:1;display:inline;",this.canvas.appendChild(this.span),this.bottom=this.top=null},c.prototype.remove=function(){c.eve("raphael.remove",this),this.canvas.parentNode.removeChild(this.canvas);for(var a in this)this[a]="function"==typeof this[a]?c._removedFactory(a):null;return!0};var G=c.st;for(var H in E)E[a](H)&&!G[a](H)&&(G[H]=function(a){return function(){var b=arguments;return this.forEach(function(c){c[a].apply(c,b)})}}(H))}}(),B.was?A.win.Raphael=c:Raphael=c,"object"==typeof exports&&(module.exports=c),c});;
// 4.1.7 (2014-11-27)
!function(e,t){"use strict";function n(e,t){for(var n,r=[],i=0;i<e.length;++i){if(n=s[e[i]]||o(e[i]),!n)throw"module definition dependecy not found: "+e[i];r.push(n)}t.apply(null,r)}function r(e,r,i){if("string"!=typeof e)throw"invalid module definition, module id must be defined and be a string";if(r===t)throw"invalid module definition, dependencies must be specified";if(i===t)throw"invalid module definition, definition function must be specified";n(r,function(){s[e]=i.apply(null,arguments)})}function i(e){return!!s[e]}function o(t){for(var n=e,r=t.split(/[.\/]/),i=0;i<r.length;++i){if(!n[r[i]])return;n=n[r[i]]}return n}function a(n){for(var r=0;r<n.length;r++){for(var i=e,o=n[r],a=o.split(/[.\/]/),l=0;l<a.length-1;++l)i[a[l]]===t&&(i[a[l]]={}),i=i[a[l]];i[a[a.length-1]]=s[o]}}var s={},l="tinymce/dom/EventUtils",c="tinymce/dom/Sizzle",u="tinymce/Env",d="tinymce/util/Tools",f="tinymce/dom/DomQuery",p="tinymce/html/Styles",h="tinymce/dom/TreeWalker",m="tinymce/dom/Range",g="tinymce/html/Entities",v="tinymce/dom/StyleSheetLoader",y="tinymce/dom/DOMUtils",b="tinymce/dom/ScriptLoader",C="tinymce/AddOnManager",x="tinymce/dom/RangeUtils",w="tinymce/NodeChange",_="tinymce/html/Node",E="tinymce/html/Schema",N="tinymce/html/SaxParser",k="tinymce/html/DomParser",S="tinymce/html/Writer",T="tinymce/html/Serializer",R="tinymce/dom/Serializer",A="tinymce/dom/TridentSelection",B="tinymce/util/VK",D="tinymce/dom/ControlSelection",L="tinymce/dom/BookmarkManager",H="tinymce/dom/Selection",M="tinymce/dom/ElementUtils",P="tinymce/fmt/Preview",O="tinymce/Formatter",I="tinymce/UndoManager",F="tinymce/EnterKey",z="tinymce/ForceBlocks",W="tinymce/EditorCommands",V="tinymce/util/URI",U="tinymce/util/Class",$="tinymce/util/EventDispatcher",q="tinymce/ui/Selector",j="tinymce/ui/Collection",Y="tinymce/ui/DomUtils",K="tinymce/ui/Control",G="tinymce/ui/Factory",X="tinymce/ui/KeyboardNavigation",J="tinymce/ui/Container",Q="tinymce/ui/DragHelper",Z="tinymce/ui/Scrollable",et="tinymce/ui/Panel",tt="tinymce/ui/Movable",nt="tinymce/ui/Resizable",rt="tinymce/ui/FloatPanel",it="tinymce/ui/Window",ot="tinymce/ui/MessageBox",at="tinymce/WindowManager",st="tinymce/util/Quirks",lt="tinymce/util/Observable",ct="tinymce/EditorObservable",ut="tinymce/Shortcuts",dt="tinymce/Editor",ft="tinymce/util/I18n",pt="tinymce/FocusManager",ht="tinymce/EditorManager",mt="tinymce/LegacyInput",gt="tinymce/util/XHR",vt="tinymce/util/JSON",yt="tinymce/util/JSONRequest",bt="tinymce/util/JSONP",Ct="tinymce/util/LocalStorage",xt="tinymce/Compat",wt="tinymce/ui/Layout",_t="tinymce/ui/AbsoluteLayout",Et="tinymce/ui/Tooltip",Nt="tinymce/ui/Widget",kt="tinymce/ui/Button",St="tinymce/ui/ButtonGroup",Tt="tinymce/ui/Checkbox",Rt="tinymce/ui/ComboBox",At="tinymce/ui/ColorBox",Bt="tinymce/ui/PanelButton",Dt="tinymce/ui/ColorButton",Lt="tinymce/util/Color",Ht="tinymce/ui/ColorPicker",Mt="tinymce/ui/Path",Pt="tinymce/ui/ElementPath",Ot="tinymce/ui/FormItem",It="tinymce/ui/Form",Ft="tinymce/ui/FieldSet",zt="tinymce/ui/FilePicker",Wt="tinymce/ui/FitLayout",Vt="tinymce/ui/FlexLayout",Ut="tinymce/ui/FlowLayout",$t="tinymce/ui/FormatControls",qt="tinymce/ui/GridLayout",jt="tinymce/ui/Iframe",Yt="tinymce/ui/Label",Kt="tinymce/ui/Toolbar",Gt="tinymce/ui/MenuBar",Xt="tinymce/ui/MenuButton",Jt="tinymce/ui/ListBox",Qt="tinymce/ui/MenuItem",Zt="tinymce/ui/Menu",en="tinymce/ui/Radio",tn="tinymce/ui/ResizeHandle",nn="tinymce/ui/Spacer",rn="tinymce/ui/SplitButton",on="tinymce/ui/StackLayout",an="tinymce/ui/TabPanel",sn="tinymce/ui/TextBox",ln="tinymce/ui/Throbber";r(l,[],function(){function e(e,t,n,r){e.addEventListener?e.addEventListener(t,n,r||!1):e.attachEvent&&e.attachEvent("on"+t,n)}function t(e,t,n,r){e.removeEventListener?e.removeEventListener(t,n,r||!1):e.detachEvent&&e.detachEvent("on"+t,n)}function n(e,t){function n(){return!1}function r(){return!0}var i,o=t||{},l;for(i in e)s[i]||(o[i]=e[i]);if(o.target||(o.target=o.srcElement||document),e&&a.test(e.type)&&e.pageX===l&&e.clientX!==l){var c=o.target.ownerDocument||document,u=c.documentElement,d=c.body;o.pageX=e.clientX+(u&&u.scrollLeft||d&&d.scrollLeft||0)-(u&&u.clientLeft||d&&d.clientLeft||0),o.pageY=e.clientY+(u&&u.scrollTop||d&&d.scrollTop||0)-(u&&u.clientTop||d&&d.clientTop||0)}return o.preventDefault=function(){o.isDefaultPrevented=r,e&&(e.preventDefault?e.preventDefault():e.returnValue=!1)},o.stopPropagation=function(){o.isPropagationStopped=r,e&&(e.stopPropagation?e.stopPropagation():e.cancelBubble=!0)},o.stopImmediatePropagation=function(){o.isImmediatePropagationStopped=r,o.stopPropagation()},o.isDefaultPrevented||(o.isDefaultPrevented=n,o.isPropagationStopped=n,o.isImmediatePropagationStopped=n),o}function r(n,r,i){function o(){i.domLoaded||(i.domLoaded=!0,r(c))}function a(){("complete"===l.readyState||"interactive"===l.readyState&&l.body)&&(t(l,"readystatechange",a),o())}function s(){try{l.documentElement.doScroll("left")}catch(e){return void setTimeout(s,0)}o()}var l=n.document,c={type:"ready"};return i.domLoaded?void r(c):(l.addEventListener?"complete"===l.readyState?o():e(n,"DOMContentLoaded",o):(e(l,"readystatechange",a),l.documentElement.doScroll&&n.self===n.top&&s()),void e(n,"load",o))}function i(){function i(e,t){var n,r,i,o,a=s[t];if(n=a&&a[e.type])for(r=0,i=n.length;i>r;r++)if(o=n[r],o&&o.func.call(o.scope,e)===!1&&e.preventDefault(),e.isImmediatePropagationStopped())return}var a=this,s={},l,c,u,d,f;c=o+(+new Date).toString(32),d="onmouseenter"in document.documentElement,u="onfocusin"in document.documentElement,f={mouseenter:"mouseover",mouseleave:"mouseout"},l=1,a.domLoaded=!1,a.events=s,a.bind=function(t,o,p,h){function m(e){i(n(e||_.event),g)}var g,v,y,b,C,x,w,_=window;if(t&&3!==t.nodeType&&8!==t.nodeType){for(t[c]?g=t[c]:(g=l++,t[c]=g,s[g]={}),h=h||t,o=o.split(" "),y=o.length;y--;)b=o[y],x=m,C=w=!1,"DOMContentLoaded"===b&&(b="ready"),a.domLoaded&&"ready"===b&&"complete"==t.readyState?p.call(h,n({type:b})):(d||(C=f[b],C&&(x=function(e){var t,r;if(t=e.currentTarget,r=e.relatedTarget,r&&t.contains)r=t.contains(r);else for(;r&&r!==t;)r=r.parentNode;r||(e=n(e||_.event),e.type="mouseout"===e.type?"mouseleave":"mouseenter",e.target=t,i(e,g))})),u||"focusin"!==b&&"focusout"!==b||(w=!0,C="focusin"===b?"focus":"blur",x=function(e){e=n(e||_.event),e.type="focus"===e.type?"focusin":"focusout",i(e,g)}),v=s[g][b],v?"ready"===b&&a.domLoaded?p({type:b}):v.push({func:p,scope:h}):(s[g][b]=v=[{func:p,scope:h}],v.fakeName=C,v.capture=w,v.nativeHandler=x,"ready"===b?r(t,x,a):e(t,C||b,x,w)));return t=v=0,p}},a.unbind=function(e,n,r){var i,o,l,u,d,f;if(!e||3===e.nodeType||8===e.nodeType)return a;if(i=e[c]){if(f=s[i],n){for(n=n.split(" "),l=n.length;l--;)if(d=n[l],o=f[d]){if(r)for(u=o.length;u--;)if(o[u].func===r){var p=o.nativeHandler,h=o.fakeName,m=o.capture;o=o.slice(0,u).concat(o.slice(u+1)),o.nativeHandler=p,o.fakeName=h,o.capture=m,f[d]=o}r&&0!==o.length||(delete f[d],t(e,o.fakeName||d,o.nativeHandler,o.capture))}}else{for(d in f)o=f[d],t(e,o.fakeName||d,o.nativeHandler,o.capture);f={}}for(d in f)return a;delete s[i];try{delete e[c]}catch(g){e[c]=null}}return a},a.fire=function(e,t,r){var o;if(!e||3===e.nodeType||8===e.nodeType)return a;r=n(null,r),r.type=t,r.target=e;do o=e[c],o&&i(r,o),e=e.parentNode||e.ownerDocument||e.defaultView||e.parentWindow;while(e&&!r.isPropagationStopped());return a},a.clean=function(e){var t,n,r=a.unbind;if(!e||3===e.nodeType||8===e.nodeType)return a;if(e[c]&&r(e),e.getElementsByTagName||(e=e.document),e&&e.getElementsByTagName)for(r(e),n=e.getElementsByTagName("*"),t=n.length;t--;)e=n[t],e[c]&&r(e);return a},a.destroy=function(){s={}},a.cancel=function(e){return e&&(e.preventDefault(),e.stopImmediatePropagation()),!1}}var o="mce-data-",a=/^(?:mouse|contextmenu)|click/,s={keyLocation:1,layerX:1,layerY:1,returnValue:1};return i.Event=new i,i.Event.bind(window,"ready",function(){}),i}),r(c,[],function(){function e(e,t,n,r){var i,o,a,s,l,c,d,p,h,m;if((t?t.ownerDocument||t:z)!==D&&B(t),t=t||D,n=n||[],!e||"string"!=typeof e)return n;if(1!==(s=t.nodeType)&&9!==s)return[];if(H&&!r){if(i=vt.exec(e))if(a=i[1]){if(9===s){if(o=t.getElementById(a),!o||!o.parentNode)return n;if(o.id===a)return n.push(o),n}else if(t.ownerDocument&&(o=t.ownerDocument.getElementById(a))&&I(t,o)&&o.id===a)return n.push(o),n}else{if(i[2])return Z.apply(n,t.getElementsByTagName(e)),n;if((a=i[3])&&x.getElementsByClassName)return Z.apply(n,t.getElementsByClassName(a)),n}if(x.qsa&&(!M||!M.test(e))){if(p=d=F,h=t,m=9===s&&e,1===s&&"object"!==t.nodeName.toLowerCase()){for(c=N(e),(d=t.getAttribute("id"))?p=d.replace(bt,"\\$&"):t.setAttribute("id",p),p="[id='"+p+"'] ",l=c.length;l--;)c[l]=p+f(c[l]);h=yt.test(e)&&u(t.parentNode)||t,m=c.join(",")}if(m)try{return Z.apply(n,h.querySelectorAll(m)),n}catch(g){}finally{d||t.removeAttribute("id")}}}return S(e.replace(st,"$1"),t,n,r)}function n(){function e(n,r){return t.push(n+" ")>w.cacheLength&&delete e[t.shift()],e[n+" "]=r}var t=[];return e}function r(e){return e[F]=!0,e}function i(e){var t=D.createElement("div");try{return!!e(t)}catch(n){return!1}finally{t.parentNode&&t.parentNode.removeChild(t),t=null}}function o(e,t){for(var n=e.split("|"),r=e.length;r--;)w.attrHandle[n[r]]=t}function a(e,t){var n=t&&e,r=n&&1===e.nodeType&&1===t.nodeType&&(~t.sourceIndex||K)-(~e.sourceIndex||K);if(r)return r;if(n)for(;n=n.nextSibling;)if(n===t)return-1;return e?1:-1}function s(e){return function(t){var n=t.nodeName.toLowerCase();return"input"===n&&t.type===e}}function l(e){return function(t){var n=t.nodeName.toLowerCase();return("input"===n||"button"===n)&&t.type===e}}function c(e){return r(function(t){return t=+t,r(function(n,r){for(var i,o=e([],n.length,t),a=o.length;a--;)n[i=o[a]]&&(n[i]=!(r[i]=n[i]))})})}function u(e){return e&&typeof e.getElementsByTagName!==Y&&e}function d(){}function f(e){for(var t=0,n=e.length,r="";n>t;t++)r+=e[t].value;return r}function p(e,t,n){var r=t.dir,i=n&&"parentNode"===r,o=V++;return t.first?function(t,n,o){for(;t=t[r];)if(1===t.nodeType||i)return e(t,n,o)}:function(t,n,a){var s,l,c=[W,o];if(a){for(;t=t[r];)if((1===t.nodeType||i)&&e(t,n,a))return!0}else for(;t=t[r];)if(1===t.nodeType||i){if(l=t[F]||(t[F]={}),(s=l[r])&&s[0]===W&&s[1]===o)return c[2]=s[2];if(l[r]=c,c[2]=e(t,n,a))return!0}}}function h(e){return e.length>1?function(t,n,r){for(var i=e.length;i--;)if(!e[i](t,n,r))return!1;return!0}:e[0]}function m(t,n,r){for(var i=0,o=n.length;o>i;i++)e(t,n[i],r);return r}function g(e,t,n,r,i){for(var o,a=[],s=0,l=e.length,c=null!=t;l>s;s++)(o=e[s])&&(!n||n(o,r,i))&&(a.push(o),c&&t.push(s));return a}function v(e,t,n,i,o,a){return i&&!i[F]&&(i=v(i)),o&&!o[F]&&(o=v(o,a)),r(function(r,a,s,l){var c,u,d,f=[],p=[],h=a.length,v=r||m(t||"*",s.nodeType?[s]:s,[]),y=!e||!r&&t?v:g(v,f,e,s,l),b=n?o||(r?e:h||i)?[]:a:y;if(n&&n(y,b,s,l),i)for(c=g(b,p),i(c,[],s,l),u=c.length;u--;)(d=c[u])&&(b[p[u]]=!(y[p[u]]=d));if(r){if(o||e){if(o){for(c=[],u=b.length;u--;)(d=b[u])&&c.push(y[u]=d);o(null,b=[],c,l)}for(u=b.length;u--;)(d=b[u])&&(c=o?tt.call(r,d):f[u])>-1&&(r[c]=!(a[c]=d))}}else b=g(b===a?b.splice(h,b.length):b),o?o(null,a,b,l):Z.apply(a,b)})}function y(e){for(var t,n,r,i=e.length,o=w.relative[e[0].type],a=o||w.relative[" "],s=o?1:0,l=p(function(e){return e===t},a,!0),c=p(function(e){return tt.call(t,e)>-1},a,!0),u=[function(e,n,r){return!o&&(r||n!==T)||((t=n).nodeType?l(e,n,r):c(e,n,r))}];i>s;s++)if(n=w.relative[e[s].type])u=[p(h(u),n)];else{if(n=w.filter[e[s].type].apply(null,e[s].matches),n[F]){for(r=++s;i>r&&!w.relative[e[r].type];r++);return v(s>1&&h(u),s>1&&f(e.slice(0,s-1).concat({value:" "===e[s-2].type?"*":""})).replace(st,"$1"),n,r>s&&y(e.slice(s,r)),i>r&&y(e=e.slice(r)),i>r&&f(e))}u.push(n)}return h(u)}function b(t,n){var i=n.length>0,o=t.length>0,a=function(r,a,s,l,c){var u,d,f,p=0,h="0",m=r&&[],v=[],y=T,b=r||o&&w.find.TAG("*",c),C=W+=null==y?1:Math.random()||.1,x=b.length;for(c&&(T=a!==D&&a);h!==x&&null!=(u=b[h]);h++){if(o&&u){for(d=0;f=t[d++];)if(f(u,a,s)){l.push(u);break}c&&(W=C)}i&&((u=!f&&u)&&p--,r&&m.push(u))}if(p+=h,i&&h!==p){for(d=0;f=n[d++];)f(m,v,a,s);if(r){if(p>0)for(;h--;)m[h]||v[h]||(v[h]=J.call(l));v=g(v)}Z.apply(l,v),c&&!r&&v.length>0&&p+n.length>1&&e.uniqueSort(l)}return c&&(W=C,T=y),m};return i?r(a):a}var C,x,w,_,E,N,k,S,T,R,A,B,D,L,H,M,P,O,I,F="sizzle"+-new Date,z=window.document,W=0,V=0,U=n(),$=n(),q=n(),j=function(e,t){return e===t&&(A=!0),0},Y=typeof t,K=1<<31,G={}.hasOwnProperty,X=[],J=X.pop,Q=X.push,Z=X.push,et=X.slice,tt=X.indexOf||function(e){for(var t=0,n=this.length;n>t;t++)if(this[t]===e)return t;return-1},nt="checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",rt="[\\x20\\t\\r\\n\\f]",it="(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+",ot="\\["+rt+"*("+it+")(?:"+rt+"*([*^$|!~]?=)"+rt+"*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|("+it+"))|)"+rt+"*\\]",at=":("+it+")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|"+ot+")*)|.*)\\)|)",st=new RegExp("^"+rt+"+|((?:^|[^\\\\])(?:\\\\.)*)"+rt+"+$","g"),lt=new RegExp("^"+rt+"*,"+rt+"*"),ct=new RegExp("^"+rt+"*([>+~]|"+rt+")"+rt+"*"),ut=new RegExp("="+rt+"*([^\\]'\"]*?)"+rt+"*\\]","g"),dt=new RegExp(at),ft=new RegExp("^"+it+"$"),pt={ID:new RegExp("^#("+it+")"),CLASS:new RegExp("^\\.("+it+")"),TAG:new RegExp("^("+it+"|[*])"),ATTR:new RegExp("^"+ot),PSEUDO:new RegExp("^"+at),CHILD:new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\("+rt+"*(even|odd|(([+-]|)(\\d*)n|)"+rt+"*(?:([+-]|)"+rt+"*(\\d+)|))"+rt+"*\\)|)","i"),bool:new RegExp("^(?:"+nt+")$","i"),needsContext:new RegExp("^"+rt+"*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\("+rt+"*((?:-\\d)?\\d*)"+rt+"*\\)|)(?=[^-]|$)","i")},ht=/^(?:input|select|textarea|button)$/i,mt=/^h\d$/i,gt=/^[^{]+\{\s*\[native \w/,vt=/^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,yt=/[+~]/,bt=/'|\\/g,Ct=new RegExp("\\\\([\\da-f]{1,6}"+rt+"?|("+rt+")|.)","ig"),xt=function(e,t,n){var r="0x"+t-65536;return r!==r||n?t:0>r?String.fromCharCode(r+65536):String.fromCharCode(r>>10|55296,1023&r|56320)};try{Z.apply(X=et.call(z.childNodes),z.childNodes),X[z.childNodes.length].nodeType}catch(wt){Z={apply:X.length?function(e,t){Q.apply(e,et.call(t))}:function(e,t){for(var n=e.length,r=0;e[n++]=t[r++];);e.length=n-1}}}x=e.support={},E=e.isXML=function(e){var t=e&&(e.ownerDocument||e).documentElement;return t?"HTML"!==t.nodeName:!1},B=e.setDocument=function(e){var t,n=e?e.ownerDocument||e:z,r=n.defaultView;return n!==D&&9===n.nodeType&&n.documentElement?(D=n,L=n.documentElement,H=!E(n),r&&r!==r.top&&(r.addEventListener?r.addEventListener("unload",function(){B()},!1):r.attachEvent&&r.attachEvent("onunload",function(){B()})),x.attributes=i(function(e){return e.className="i",!e.getAttribute("className")}),x.getElementsByTagName=i(function(e){return e.appendChild(n.createComment("")),!e.getElementsByTagName("*").length}),x.getElementsByClassName=gt.test(n.getElementsByClassName),x.getById=i(function(e){return L.appendChild(e).id=F,!n.getElementsByName||!n.getElementsByName(F).length}),x.getById?(w.find.ID=function(e,t){if(typeof t.getElementById!==Y&&H){var n=t.getElementById(e);return n&&n.parentNode?[n]:[]}},w.filter.ID=function(e){var t=e.replace(Ct,xt);return function(e){return e.getAttribute("id")===t}}):(delete w.find.ID,w.filter.ID=function(e){var t=e.replace(Ct,xt);return function(e){var n=typeof e.getAttributeNode!==Y&&e.getAttributeNode("id");return n&&n.value===t}}),w.find.TAG=x.getElementsByTagName?function(e,t){return typeof t.getElementsByTagName!==Y?t.getElementsByTagName(e):void 0}:function(e,t){var n,r=[],i=0,o=t.getElementsByTagName(e);if("*"===e){for(;n=o[i++];)1===n.nodeType&&r.push(n);return r}return o},w.find.CLASS=x.getElementsByClassName&&function(e,t){return H?t.getElementsByClassName(e):void 0},P=[],M=[],(x.qsa=gt.test(n.querySelectorAll))&&(i(function(e){e.innerHTML="<select msallowcapture=''><option selected=''></option></select>",e.querySelectorAll("[msallowcapture^='']").length&&M.push("[*^$]="+rt+"*(?:''|\"\")"),e.querySelectorAll("[selected]").length||M.push("\\["+rt+"*(?:value|"+nt+")"),e.querySelectorAll(":checked").length||M.push(":checked")}),i(function(e){var t=n.createElement("input");t.setAttribute("type","hidden"),e.appendChild(t).setAttribute("name","D"),e.querySelectorAll("[name=d]").length&&M.push("name"+rt+"*[*^$|!~]?="),e.querySelectorAll(":enabled").length||M.push(":enabled",":disabled"),e.querySelectorAll("*,:x"),M.push(",.*:")})),(x.matchesSelector=gt.test(O=L.matches||L.webkitMatchesSelector||L.mozMatchesSelector||L.oMatchesSelector||L.msMatchesSelector))&&i(function(e){x.disconnectedMatch=O.call(e,"div"),O.call(e,"[s!='']:x"),P.push("!=",at)}),M=M.length&&new RegExp(M.join("|")),P=P.length&&new RegExp(P.join("|")),t=gt.test(L.compareDocumentPosition),I=t||gt.test(L.contains)?function(e,t){var n=9===e.nodeType?e.documentElement:e,r=t&&t.parentNode;return e===r||!(!r||1!==r.nodeType||!(n.contains?n.contains(r):e.compareDocumentPosition&&16&e.compareDocumentPosition(r)))}:function(e,t){if(t)for(;t=t.parentNode;)if(t===e)return!0;return!1},j=t?function(e,t){if(e===t)return A=!0,0;var r=!e.compareDocumentPosition-!t.compareDocumentPosition;return r?r:(r=(e.ownerDocument||e)===(t.ownerDocument||t)?e.compareDocumentPosition(t):1,1&r||!x.sortDetached&&t.compareDocumentPosition(e)===r?e===n||e.ownerDocument===z&&I(z,e)?-1:t===n||t.ownerDocument===z&&I(z,t)?1:R?tt.call(R,e)-tt.call(R,t):0:4&r?-1:1)}:function(e,t){if(e===t)return A=!0,0;var r,i=0,o=e.parentNode,s=t.parentNode,l=[e],c=[t];if(!o||!s)return e===n?-1:t===n?1:o?-1:s?1:R?tt.call(R,e)-tt.call(R,t):0;if(o===s)return a(e,t);for(r=e;r=r.parentNode;)l.unshift(r);for(r=t;r=r.parentNode;)c.unshift(r);for(;l[i]===c[i];)i++;return i?a(l[i],c[i]):l[i]===z?-1:c[i]===z?1:0},n):D},e.matches=function(t,n){return e(t,null,null,n)},e.matchesSelector=function(t,n){if((t.ownerDocument||t)!==D&&B(t),n=n.replace(ut,"='$1']"),!(!x.matchesSelector||!H||P&&P.test(n)||M&&M.test(n)))try{var r=O.call(t,n);if(r||x.disconnectedMatch||t.document&&11!==t.document.nodeType)return r}catch(i){}return e(n,D,null,[t]).length>0},e.contains=function(e,t){return(e.ownerDocument||e)!==D&&B(e),I(e,t)},e.attr=function(e,n){(e.ownerDocument||e)!==D&&B(e);var r=w.attrHandle[n.toLowerCase()],i=r&&G.call(w.attrHandle,n.toLowerCase())?r(e,n,!H):t;return i!==t?i:x.attributes||!H?e.getAttribute(n):(i=e.getAttributeNode(n))&&i.specified?i.value:null},e.error=function(e){throw new Error("Syntax error, unrecognized expression: "+e)},e.uniqueSort=function(e){var t,n=[],r=0,i=0;if(A=!x.detectDuplicates,R=!x.sortStable&&e.slice(0),e.sort(j),A){for(;t=e[i++];)t===e[i]&&(r=n.push(i));for(;r--;)e.splice(n[r],1)}return R=null,e},_=e.getText=function(e){var t,n="",r=0,i=e.nodeType;if(i){if(1===i||9===i||11===i){if("string"==typeof e.textContent)return e.textContent;for(e=e.firstChild;e;e=e.nextSibling)n+=_(e)}else if(3===i||4===i)return e.nodeValue}else for(;t=e[r++];)n+=_(t);return n},w=e.selectors={cacheLength:50,createPseudo:r,match:pt,attrHandle:{},find:{},relative:{">":{dir:"parentNode",first:!0}," ":{dir:"parentNode"},"+":{dir:"previousSibling",first:!0},"~":{dir:"previousSibling"}},preFilter:{ATTR:function(e){return e[1]=e[1].replace(Ct,xt),e[3]=(e[3]||e[4]||e[5]||"").replace(Ct,xt),"~="===e[2]&&(e[3]=" "+e[3]+" "),e.slice(0,4)},CHILD:function(t){return t[1]=t[1].toLowerCase(),"nth"===t[1].slice(0,3)?(t[3]||e.error(t[0]),t[4]=+(t[4]?t[5]+(t[6]||1):2*("even"===t[3]||"odd"===t[3])),t[5]=+(t[7]+t[8]||"odd"===t[3])):t[3]&&e.error(t[0]),t},PSEUDO:function(e){var t,n=!e[6]&&e[2];return pt.CHILD.test(e[0])?null:(e[3]?e[2]=e[4]||e[5]||"":n&&dt.test(n)&&(t=N(n,!0))&&(t=n.indexOf(")",n.length-t)-n.length)&&(e[0]=e[0].slice(0,t),e[2]=n.slice(0,t)),e.slice(0,3))}},filter:{TAG:function(e){var t=e.replace(Ct,xt).toLowerCase();return"*"===e?function(){return!0}:function(e){return e.nodeName&&e.nodeName.toLowerCase()===t}},CLASS:function(e){var t=U[e+" "];return t||(t=new RegExp("(^|"+rt+")"+e+"("+rt+"|$)"))&&U(e,function(e){return t.test("string"==typeof e.className&&e.className||typeof e.getAttribute!==Y&&e.getAttribute("class")||"")})},ATTR:function(t,n,r){return function(i){var o=e.attr(i,t);return null==o?"!="===n:n?(o+="","="===n?o===r:"!="===n?o!==r:"^="===n?r&&0===o.indexOf(r):"*="===n?r&&o.indexOf(r)>-1:"$="===n?r&&o.slice(-r.length)===r:"~="===n?(" "+o+" ").indexOf(r)>-1:"|="===n?o===r||o.slice(0,r.length+1)===r+"-":!1):!0}},CHILD:function(e,t,n,r,i){var o="nth"!==e.slice(0,3),a="last"!==e.slice(-4),s="of-type"===t;return 1===r&&0===i?function(e){return!!e.parentNode}:function(t,n,l){var c,u,d,f,p,h,m=o!==a?"nextSibling":"previousSibling",g=t.parentNode,v=s&&t.nodeName.toLowerCase(),y=!l&&!s;if(g){if(o){for(;m;){for(d=t;d=d[m];)if(s?d.nodeName.toLowerCase()===v:1===d.nodeType)return!1;h=m="only"===e&&!h&&"nextSibling"}return!0}if(h=[a?g.firstChild:g.lastChild],a&&y){for(u=g[F]||(g[F]={}),c=u[e]||[],p=c[0]===W&&c[1],f=c[0]===W&&c[2],d=p&&g.childNodes[p];d=++p&&d&&d[m]||(f=p=0)||h.pop();)if(1===d.nodeType&&++f&&d===t){u[e]=[W,p,f];break}}else if(y&&(c=(t[F]||(t[F]={}))[e])&&c[0]===W)f=c[1];else for(;(d=++p&&d&&d[m]||(f=p=0)||h.pop())&&((s?d.nodeName.toLowerCase()!==v:1!==d.nodeType)||!++f||(y&&((d[F]||(d[F]={}))[e]=[W,f]),d!==t)););return f-=i,f===r||f%r===0&&f/r>=0}}},PSEUDO:function(t,n){var i,o=w.pseudos[t]||w.setFilters[t.toLowerCase()]||e.error("unsupported pseudo: "+t);return o[F]?o(n):o.length>1?(i=[t,t,"",n],w.setFilters.hasOwnProperty(t.toLowerCase())?r(function(e,t){for(var r,i=o(e,n),a=i.length;a--;)r=tt.call(e,i[a]),e[r]=!(t[r]=i[a])}):function(e){return o(e,0,i)}):o}},pseudos:{not:r(function(e){var t=[],n=[],i=k(e.replace(st,"$1"));return i[F]?r(function(e,t,n,r){for(var o,a=i(e,null,r,[]),s=e.length;s--;)(o=a[s])&&(e[s]=!(t[s]=o))}):function(e,r,o){return t[0]=e,i(t,null,o,n),!n.pop()}}),has:r(function(t){return function(n){return e(t,n).length>0}}),contains:r(function(e){return e=e.replace(Ct,xt),function(t){return(t.textContent||t.innerText||_(t)).indexOf(e)>-1}}),lang:r(function(t){return ft.test(t||"")||e.error("unsupported lang: "+t),t=t.replace(Ct,xt).toLowerCase(),function(e){var n;do if(n=H?e.lang:e.getAttribute("xml:lang")||e.getAttribute("lang"))return n=n.toLowerCase(),n===t||0===n.indexOf(t+"-");while((e=e.parentNode)&&1===e.nodeType);return!1}}),target:function(e){var t=window.location&&window.location.hash;return t&&t.slice(1)===e.id},root:function(e){return e===L},focus:function(e){return e===D.activeElement&&(!D.hasFocus||D.hasFocus())&&!!(e.type||e.href||~e.tabIndex)},enabled:function(e){return e.disabled===!1},disabled:function(e){return e.disabled===!0},checked:function(e){var t=e.nodeName.toLowerCase();return"input"===t&&!!e.checked||"option"===t&&!!e.selected},selected:function(e){return e.parentNode&&e.parentNode.selectedIndex,e.selected===!0},empty:function(e){for(e=e.firstChild;e;e=e.nextSibling)if(e.nodeType<6)return!1;return!0},parent:function(e){return!w.pseudos.empty(e)},header:function(e){return mt.test(e.nodeName)},input:function(e){return ht.test(e.nodeName)},button:function(e){var t=e.nodeName.toLowerCase();return"input"===t&&"button"===e.type||"button"===t},text:function(e){var t;return"input"===e.nodeName.toLowerCase()&&"text"===e.type&&(null==(t=e.getAttribute("type"))||"text"===t.toLowerCase())},first:c(function(){return[0]}),last:c(function(e,t){return[t-1]}),eq:c(function(e,t,n){return[0>n?n+t:n]}),even:c(function(e,t){for(var n=0;t>n;n+=2)e.push(n);return e}),odd:c(function(e,t){for(var n=1;t>n;n+=2)e.push(n);return e}),lt:c(function(e,t,n){for(var r=0>n?n+t:n;--r>=0;)e.push(r);return e}),gt:c(function(e,t,n){for(var r=0>n?n+t:n;++r<t;)e.push(r);return e})}},w.pseudos.nth=w.pseudos.eq;for(C in{radio:!0,checkbox:!0,file:!0,password:!0,image:!0})w.pseudos[C]=s(C);for(C in{submit:!0,reset:!0})w.pseudos[C]=l(C);return d.prototype=w.filters=w.pseudos,w.setFilters=new d,N=e.tokenize=function(t,n){var r,i,o,a,s,l,c,u=$[t+" "];if(u)return n?0:u.slice(0);for(s=t,l=[],c=w.preFilter;s;){(!r||(i=lt.exec(s)))&&(i&&(s=s.slice(i[0].length)||s),l.push(o=[])),r=!1,(i=ct.exec(s))&&(r=i.shift(),o.push({value:r,type:i[0].replace(st," ")}),s=s.slice(r.length));for(a in w.filter)!(i=pt[a].exec(s))||c[a]&&!(i=c[a](i))||(r=i.shift(),o.push({value:r,type:a,matches:i}),s=s.slice(r.length));if(!r)break}return n?s.length:s?e.error(t):$(t,l).slice(0)},k=e.compile=function(e,t){var n,r=[],i=[],o=q[e+" "];if(!o){for(t||(t=N(e)),n=t.length;n--;)o=y(t[n]),o[F]?r.push(o):i.push(o);o=q(e,b(i,r)),o.selector=e}return o},S=e.select=function(e,t,n,r){var i,o,a,s,l,c="function"==typeof e&&e,d=!r&&N(e=c.selector||e);if(n=n||[],1===d.length){if(o=d[0]=d[0].slice(0),o.length>2&&"ID"===(a=o[0]).type&&x.getById&&9===t.nodeType&&H&&w.relative[o[1].type]){if(t=(w.find.ID(a.matches[0].replace(Ct,xt),t)||[])[0],!t)return n;c&&(t=t.parentNode),e=e.slice(o.shift().value.length)}for(i=pt.needsContext.test(e)?0:o.length;i--&&(a=o[i],!w.relative[s=a.type]);)if((l=w.find[s])&&(r=l(a.matches[0].replace(Ct,xt),yt.test(o[0].type)&&u(t.parentNode)||t))){if(o.splice(i,1),e=r.length&&f(o),!e)return Z.apply(n,r),n;break}}return(c||k(e,d))(r,t,!H,n,yt.test(e)&&u(t.parentNode)||t),n},x.sortStable=F.split("").sort(j).join("")===F,x.detectDuplicates=!!A,B(),x.sortDetached=i(function(e){return 1&e.compareDocumentPosition(D.createElement("div"))}),i(function(e){return e.innerHTML="<a href='#'></a>","#"===e.firstChild.getAttribute("href")})||o("type|href|height|width",function(e,t,n){return n?void 0:e.getAttribute(t,"type"===t.toLowerCase()?1:2)}),x.attributes&&i(function(e){return e.innerHTML="<input/>",e.firstChild.setAttribute("value",""),""===e.firstChild.getAttribute("value")})||o("value",function(e,t,n){return n||"input"!==e.nodeName.toLowerCase()?void 0:e.defaultValue}),i(function(e){return null==e.getAttribute("disabled")})||o(nt,function(e,t,n){var r;return n?void 0:e[t]===!0?t.toLowerCase():(r=e.getAttributeNode(t))&&r.specified?r.value:null}),e}),r(u,[],function(){var e=navigator,t=e.userAgent,n,r,i,o,a,s,l;n=window.opera&&window.opera.buildNumber,r=/WebKit/.test(t),i=!r&&!n&&/MSIE/gi.test(t)&&/Explorer/gi.test(e.appName),i=i&&/MSIE (\w+)\./.exec(t)[1],o=-1==t.indexOf("Trident/")||-1==t.indexOf("rv:")&&-1==e.appName.indexOf("Netscape")?!1:11,i=i||o,a=!r&&!o&&/Gecko/.test(t),s=-1!=t.indexOf("Mac"),l=/(iPad|iPhone)/.test(t);var c=!l||t.match(/AppleWebKit\/(\d*)/)[1]>=534;return{opera:n,webkit:r,ie:i,gecko:a,mac:s,iOS:l,contentEditable:c,transparentSrc:"data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7",caretAfter:8!=i,range:window.getSelection&&"Range"in window,documentMode:i?document.documentMode||7:10}}),r(d,[u],function(e){function n(e){return null===e||e===t?"":(""+e).replace(v,"")}function r(e,n){return n?"array"==n&&y(e)?!0:typeof e==n:e!==t}function i(e){var t=e,n,r;if(!y(e))for(t=[],n=0,r=e.length;r>n;n++)t[n]=e[n];return t}function o(e,t,n){var r;for(e=e||[],t=t||",","string"==typeof e&&(e=e.split(t)),n=n||{},r=e.length;r--;)n[e[r]]={};return n}function a(e,n,r){var i,o;if(!e)return 0;if(r=r||e,e.length!==t){for(i=0,o=e.length;o>i;i++)if(n.call(r,e[i],i,e)===!1)return 0}else for(i in e)if(e.hasOwnProperty(i)&&n.call(r,e[i],i,e)===!1)return 0;return 1}function s(e,t){var n=[];return a(e,function(e){n.push(t(e))}),n}function l(e,t){var n=[];return a(e,function(e){(!t||t(e))&&n.push(e)}),n}function c(e,t,n){var r=this,i,o,a,s,l,c=0;if(e=/^((static) )?([\w.]+)(:([\w.]+))?/.exec(e),a=e[3].match(/(^|\.)(\w+)$/i)[2],o=r.createNS(e[3].replace(/\.\w+$/,""),n),!o[a]){if("static"==e[2])return o[a]=t,void(this.onCreate&&this.onCreate(e[2],e[3],o[a]));t[a]||(t[a]=function(){},c=1),o[a]=t[a],r.extend(o[a].prototype,t),e[5]&&(i=r.resolve(e[5]).prototype,s=e[5].match(/\.(\w+)$/i)[1],l=o[a],o[a]=c?function(){return i[s].apply(this,arguments)}:function(){return this.parent=i[s],l.apply(this,arguments)},o[a].prototype[a]=o[a],r.each(i,function(e,t){o[a].prototype[t]=i[t]}),r.each(t,function(e,t){i[t]?o[a].prototype[t]=function(){return this.parent=i[t],e.apply(this,arguments)}:t!=a&&(o[a].prototype[t]=e)})),r.each(t["static"],function(e,t){o[a][t]=e})}}function u(e,t){var n,r;if(e)for(n=0,r=e.length;r>n;n++)if(e[n]===t)return n;return-1}function d(e,n){var r,i,o,a=arguments,s;for(r=1,i=a.length;i>r;r++){n=a[r];for(o in n)n.hasOwnProperty(o)&&(s=n[o],s!==t&&(e[o]=s))}return e}function f(e,t,n,r){r=r||this,e&&(n&&(e=e[n]),a(e,function(e,i){return t.call(r,e,i,n)===!1?!1:void f(e,t,n,r)}))}function p(e,t){var n,r;for(t=t||window,e=e.split("."),n=0;n<e.length;n++)r=e[n],t[r]||(t[r]={}),t=t[r];return t}function h(e,t){var n,r;for(t=t||window,e=e.split("."),n=0,r=e.length;r>n&&(t=t[e[n]],t);n++);return t}function m(e,t){return!e||r(e,"array")?e:s(e.split(t||","),n)}function g(t){var n=e.cacheSuffix;return n&&(t+=(-1===t.indexOf("?")?"?":"&")+n),t}var v=/^\s*|\s*$/g,y=Array.isArray||function(e){return"[object Array]"===Object.prototype.toString.call(e)};return{trim:n,isArray:y,is:r,toArray:i,makeMap:o,each:a,map:s,grep:l,inArray:u,extend:d,create:c,walk:f,createNS:p,resolve:h,explode:m,_addCacheSuffix:g}}),r(f,[l,c,d,u],function(e,n,r,i){function o(e){return"undefined"!=typeof e}function a(e){return"string"==typeof e}function s(e){return e&&e==e.window}function l(e,t){var n,r,i;for(t=t||w,i=t.createElement("div"),n=t.createDocumentFragment(),i.innerHTML=e;r=i.firstChild;)n.appendChild(r);return n}function c(e,t,n,r){var i;if(a(t))t=l(t,v(e[0]));else if(t.length&&!t.nodeType){if(t=f.makeArray(t),r)for(i=t.length-1;i>=0;i--)c(e,t[i],n,r);else for(i=0;i<t.length;i++)c(e,t[i],n,r);return e}if(t.nodeType)for(i=e.length;i--;)n.call(e[i],t);return e}function u(e,t){return e&&t&&-1!==(" "+e.className+" ").indexOf(" "+t+" ")}function d(e,t,n){var r,i;return t=f(t)[0],e.each(function(){var e=this;n&&r==e.parentNode?i.appendChild(e):(r=e.parentNode,i=t.cloneNode(!1),e.parentNode.insertBefore(i,e),i.appendChild(e))}),e}function f(e,t){return new f.fn.init(e,t)}function p(e,t){var n;if(t.indexOf)return t.indexOf(e);for(n=t.length;n--;)if(t[n]===e)return n;return-1}function h(e){return null===e||e===S?"":(""+e).replace(H,"")}function m(e,t){var n,r,i,o,a;if(e)if(n=e.length,n===o){for(r in e)if(e.hasOwnProperty(r)&&(a=e[r],t.call(a,r,a)===!1))break}else for(i=0;n>i&&(a=e[i],t.call(a,i,a)!==!1);i++);return e}function g(e,t){var n=[];return m(e,function(e,r){t(r,e)&&n.push(r)}),n}function v(e){return e?9==e.nodeType?e:e.ownerDocument:w}function y(e,n,r){var i=[],o=e[n];for("string"!=typeof r&&r instanceof f&&(r=r[0]);o&&9!==o.nodeType;){if(r!==t){if(o===r)break;if("string"==typeof r&&f(o).is(r))break}1===o.nodeType&&i.push(o),o=o[n]}return i}function b(e,n,r,i){var o=[];for(i instanceof f&&(i=i[0]);e;e=e[n])if(!r||e.nodeType===r){if(i!==t){if(e===i)break;if("string"==typeof i&&f(e).is(i))break}o.push(e)}return o}function C(e,t,n){for(e=e[t];e;e=e[t])if(e.nodeType==n)return e;return null}function x(e,t,n){m(n,function(n,r){e[n]=e[n]||{},e[n][t]=r})}var w=document,_=Array.prototype.push,E=Array.prototype.slice,N=/^(?:[^#<]*(<[\w\W]+>)[^>]*$|#([\w\-]*)$)/,k=e.Event,S,T=r.makeMap("fillOpacity fontWeight lineHeight opacity orphans widows zIndex zoom"," "),R=r.makeMap("checked compact declare defer disabled ismap multiple nohref noshade nowrap readonly selected"," "),A={"for":"htmlFor","class":"className",readonly:"readOnly"},B={"float":"cssFloat"},D={},L={},H=/^\s*|\s*$/g;return f.fn=f.prototype={constructor:f,selector:"",context:null,length:0,init:function(e,t){var n=this,r,i;if(!e)return n;if(e.nodeType)return n.context=n[0]=e,n.length=1,n;if(t&&t.nodeType)n.context=t;else{if(t)return f(e).attr(t);n.context=t=document}if(a(e)){if(n.selector=e,r="<"===e.charAt(0)&&">"===e.charAt(e.length-1)&&e.length>=3?[null,e,null]:N.exec(e),!r)return f(t).find(e);if(r[1])for(i=l(e,v(t)).firstChild;i;)_.call(n,i),i=i.nextSibling;else{if(i=v(t).getElementById(r[2]),!i)return n;if(i.id!==r[2])return n.find(e);n.length=1,n[0]=i}}else this.add(e,!1);return n},toArray:function(){return r.toArray(this)},add:function(e,t){var n=this,r,i;if(a(e))return n.add(f(e));if(t!==!1)for(r=f.unique(n.toArray().concat(f.makeArray(e))),n.length=r.length,i=0;i<r.length;i++)n[i]=r[i];
else _.apply(n,f.makeArray(e));return n},attr:function(e,t){var n=this,r;if("object"==typeof e)m(e,function(e,t){n.attr(e,t)});else{if(!o(t)){if(n[0]&&1===n[0].nodeType){if(r=D[e],r&&r.get)return r.get(n[0],e);if(R[e])return n.prop(e)?e:S;t=n[0].getAttribute(e,2),null===t&&(t=S)}return t}this.each(function(){var n;if(1===this.nodeType){if(n=D[e],n&&n.set)return void n.set(this,t);null===t?this.removeAttribute(e,2):this.setAttribute(e,t,2)}})}return n},removeAttr:function(e){return this.attr(e,null)},prop:function(e,t){var n=this;if(e=A[e]||e,"object"==typeof e)m(e,function(e,t){n.prop(e,t)});else{if(!o(t))return n[0]&&n[0].nodeType&&e in n[0]?n[0][e]:t;this.each(function(){1==this.nodeType&&(this[e]=t)})}return n},css:function(e,t){function n(e){return e.replace(/-(\D)/g,function(e,t){return t.toUpperCase()})}function r(e){return e.replace(/[A-Z]/g,function(e){return"-"+e})}var i=this,a,s;if("object"==typeof e)m(e,function(e,t){i.css(e,t)});else if(o(t))e=n(e),"number"!=typeof t||T[e]||(t+="px"),i.each(function(){var n=this.style;if(s=L[e],s&&s.set)return void s.set(this,t);try{this.style[B[e]||e]=t}catch(i){}(null===t||""===t)&&(n.removeProperty?n.removeProperty(r(e)):n.removeAttribute(e))});else{if(a=i[0],s=L[e],s&&s.get)return s.get(a);if(a.ownerDocument.defaultView)try{return a.ownerDocument.defaultView.getComputedStyle(a,null).getPropertyValue(r(e))}catch(l){return S}else if(a.currentStyle)return a.currentStyle[n(e)]}return i},remove:function(){for(var e=this,t,n=this.length;n--;)t=e[n],k.clean(t),t.parentNode&&t.parentNode.removeChild(t);return this},empty:function(){for(var e=this,t,n=this.length;n--;)for(t=e[n];t.firstChild;)t.removeChild(t.firstChild);return this},html:function(e){var t=this,n;if(o(e)){n=t.length;try{for(;n--;)t[n].innerHTML=e}catch(r){f(t[n]).empty().append(e)}return t}return t[0]?t[0].innerHTML:""},text:function(e){var t=this,n;if(o(e)){for(n=t.length;n--;)"innerText"in t[n]?t[n].innerText=e:t[0].textContent=e;return t}return t[0]?t[0].innerText||t[0].textContent:""},append:function(){return c(this,arguments,function(e){1===this.nodeType&&this.appendChild(e)})},prepend:function(){return c(this,arguments,function(e){1===this.nodeType&&this.insertBefore(e,this.firstChild)},!0)},before:function(){var e=this;return e[0]&&e[0].parentNode?c(e,arguments,function(e){this.parentNode.insertBefore(e,this)}):e},after:function(){var e=this;return e[0]&&e[0].parentNode?c(e,arguments,function(e){this.parentNode.insertBefore(e,this.nextSibling)},!0):e},appendTo:function(e){return f(e).append(this),this},prependTo:function(e){return f(e).prepend(this),this},replaceWith:function(e){return this.before(e).remove()},wrap:function(e){return d(this,e)},wrapAll:function(e){return d(this,e,!0)},wrapInner:function(e){return this.each(function(){f(this).contents().wrapAll(e)}),this},unwrap:function(){return this.parent().each(function(){f(this).replaceWith(this.childNodes)})},clone:function(){var e=[];return this.each(function(){e.push(this.cloneNode(!0))}),f(e)},addClass:function(e){return this.toggleClass(e,!0)},removeClass:function(e){return this.toggleClass(e,!1)},toggleClass:function(e,t){var n=this;return"string"!=typeof e?n:(-1!==e.indexOf(" ")?m(e.split(" "),function(){n.toggleClass(this,t)}):n.each(function(n,r){var i,o;o=u(r,e),o!==t&&(i=r.className,o?r.className=h((" "+i+" ").replace(" "+e+" "," ")):r.className+=i?" "+e:e)}),n)},hasClass:function(e){return u(this[0],e)},each:function(e){return m(this,e)},on:function(e,t){return this.each(function(){k.bind(this,e,t)})},off:function(e,t){return this.each(function(){k.unbind(this,e,t)})},trigger:function(e){return this.each(function(){"object"==typeof e?k.fire(this,e.type,e):k.fire(this,e)})},show:function(){return this.css("display","")},hide:function(){return this.css("display","none")},slice:function(){return new f(E.apply(this,arguments))},eq:function(e){return-1===e?this.slice(e):this.slice(e,+e+1)},first:function(){return this.eq(0)},last:function(){return this.eq(-1)},find:function(e){var t,n,r=[];for(t=0,n=this.length;n>t;t++)f.find(e,this[t],r);return f(r)},filter:function(e){return f("function"==typeof e?g(this.toArray(),function(t,n){return e(n,t)}):f.filter(e,this.toArray()))},closest:function(e){var t=[];return e instanceof f&&(e=e[0]),this.each(function(n,r){for(;r;){if("string"==typeof e&&f(r).is(e)){t.push(r);break}if(r==e){t.push(r);break}r=r.parentNode}}),f(t)},offset:function(e){var t,n,r,i=0,o=0,a;return e?this.css(e):(t=this[0],t&&(n=t.ownerDocument,r=n.documentElement,t.getBoundingClientRect&&(a=t.getBoundingClientRect(),i=a.left+(r.scrollLeft||n.body.scrollLeft)-r.clientLeft,o=a.top+(r.scrollTop||n.body.scrollTop)-r.clientTop)),{left:i,top:o})},push:_,sort:[].sort,splice:[].splice},r.extend(f,{extend:r.extend,makeArray:function(e){return s(e)||e.nodeType?[e]:r.toArray(e)},inArray:p,isArray:r.isArray,each:m,trim:h,grep:g,find:n,expr:n.selectors,unique:n.uniqueSort,text:n.getText,contains:n.contains,filter:function(e,t,n){var r=t.length;for(n&&(e=":not("+e+")");r--;)1!=t[r].nodeType&&t.splice(r,1);return t=1===t.length?f.find.matchesSelector(t[0],e)?[t[0]]:[]:f.find.matches(e,t)}}),m({parent:function(e){var t=e.parentNode;return t&&11!==t.nodeType?t:null},parents:function(e){return y(e,"parentNode")},next:function(e){return C(e,"nextSibling",1)},prev:function(e){return C(e,"previousSibling",1)},children:function(e){return b(e.firstChild,"nextSibling",1)},contents:function(e){return r.toArray(("iframe"===e.nodeName?e.contentDocument||e.contentWindow.document:e).childNodes)}},function(e,t){f.fn[e]=function(n){var r=this,i=[];return r.each(function(){var e=t.call(i,this,n,i);e&&(f.isArray(e)?i.push.apply(i,e):i.push(e))}),this.length>1&&(i=f.unique(i),0===e.indexOf("parents")&&(i=i.reverse())),i=f(i),n?i.filter(n):i}}),m({parentsUntil:function(e,t){return y(e,"parentNode",t)},nextUntil:function(e,t){return b(e,"nextSibling",1,t).slice(1)},prevUntil:function(e,t){return b(e,"previousSibling",1,t).slice(1)}},function(e,t){f.fn[e]=function(n,r){var i=this,o=[];return i.each(function(){var e=t.call(o,this,n,o);e&&(f.isArray(e)?o.push.apply(o,e):o.push(e))}),this.length>1&&(o=f.unique(o),(0===e.indexOf("parents")||"prevUntil"===e)&&(o=o.reverse())),o=f(o),r?o.filter(r):o}}),f.fn.is=function(e){return!!e&&this.filter(e).length>0},f.fn.init.prototype=f.fn,f.overrideDefaults=function(e){function t(r,i){return n=n||e(),0===arguments.length&&(r=n.element),i||(i=n.context),new t.fn.init(r,i)}var n;return f.extend(t,this),t},i.ie&&i.ie<8&&(x(D,"get",{maxlength:function(e){var t=e.maxLength;return 2147483647===t?S:t},size:function(e){var t=e.size;return 20===t?S:t},"class":function(e){return e.className},style:function(e){var t=e.style.cssText;return 0===t.length?S:t}}),x(D,"set",{"class":function(e,t){e.className=t},style:function(e,t){e.style.cssText=t}})),i.ie&&i.ie<9&&(B["float"]="styleFloat",x(L,"set",{opacity:function(e,t){var n=e.style;null===t||""===t?n.removeAttribute("filter"):(n.zoom=1,n.filter="alpha(opacity="+100*t+")")}})),f.attrHooks=D,f.cssHooks=L,f}),r(p,[],function(){return function(e,t){function n(e,t,n,r){function i(e){return e=parseInt(e,10).toString(16),e.length>1?e:"0"+e}return"#"+i(t)+i(n)+i(r)}var r=/rgb\s*\(\s*([0-9]+)\s*,\s*([0-9]+)\s*,\s*([0-9]+)\s*\)/gi,i=/(?:url(?:(?:\(\s*\"([^\"]+)\"\s*\))|(?:\(\s*\'([^\']+)\'\s*\))|(?:\(\s*([^)\s]+)\s*\))))|(?:\'([^\']+)\')|(?:\"([^\"]+)\")/gi,o=/\s*([^:]+):\s*([^;]+);?/g,a=/\s+$/,s,l,c={},u,d,f,p="\ufeff";for(e=e||{},t&&(d=t.getValidStyles(),f=t.getInvalidStyles()),u=("\\\" \\' \\; \\: ; : "+p).split(" "),l=0;l<u.length;l++)c[u[l]]=p+l,c[p+l]=u[l];return{toHex:function(e){return e.replace(r,n)},parse:function(t){function s(e,t,n){var r,i,o,a;if(r=m[e+"-top"+t],r&&(i=m[e+"-right"+t],i&&(o=m[e+"-bottom"+t],o&&(a=m[e+"-left"+t])))){var s=[r,i,o,a];for(l=s.length-1;l--&&s[l]===s[l+1];);l>-1&&n||(m[e+t]=-1==l?s[0]:s.join(" "),delete m[e+"-top"+t],delete m[e+"-right"+t],delete m[e+"-bottom"+t],delete m[e+"-left"+t])}}function u(e){var t=m[e],n;if(t){for(t=t.split(" "),n=t.length;n--;)if(t[n]!==t[0])return!1;return m[e]=t[0],!0}}function d(e,t,n,r){u(t)&&u(n)&&u(r)&&(m[e]=m[t]+" "+m[n]+" "+m[r],delete m[t],delete m[n],delete m[r])}function f(e){return b=!0,c[e]}function p(e,t){return b&&(e=e.replace(/\uFEFF[0-9]/g,function(e){return c[e]})),t||(e=e.replace(/\\([\'\";:])/g,"$1")),e}function h(t,n,r,i,o,a){if(o=o||a)return o=p(o),"'"+o.replace(/\'/g,"\\'")+"'";if(n=p(n||r||i),!e.allow_script_urls){var s=n.replace(/[\s\r\n]+/,"");if(/(java|vb)script:/i.test(s))return"";if(!e.allow_svg_data_urls&&/^data:image\/svg/i.test(s))return""}return C&&(n=C.call(x,n,"style")),"url('"+n.replace(/\'/g,"\\'")+"')"}var m={},g,v,y,b,C=e.url_converter,x=e.url_converter_scope||this;if(t){for(t=t.replace(/[\u0000-\u001F]/g,""),t=t.replace(/\\[\"\';:\uFEFF]/g,f).replace(/\"[^\"]+\"|\'[^\']+\'/g,function(e){return e.replace(/[;:]/g,f)});g=o.exec(t);){if(v=g[1].replace(a,"").toLowerCase(),y=g[2].replace(a,""),y=y.replace(/\\[0-9a-f]+/g,function(e){return String.fromCharCode(parseInt(e.substr(1),16))}),v&&y.length>0){if(!e.allow_script_urls&&("behavior"==v||/expression\s*\(|\/\*|\*\//.test(y)))continue;"font-weight"===v&&"700"===y?y="bold":("color"===v||"background-color"===v)&&(y=y.toLowerCase()),y=y.replace(r,n),y=y.replace(i,h),m[v]=b?p(y,!0):y}o.lastIndex=g.index+g[0].length}s("border","",!0),s("border","-width"),s("border","-color"),s("border","-style"),s("padding",""),s("margin",""),d("border","border-width","border-style","border-color"),"medium none"===m.border&&delete m.border,"none"===m["border-image"]&&delete m["border-image"]}return m},serialize:function(e,t){function n(t){var n,r,o,a;if(n=d[t])for(r=0,o=n.length;o>r;r++)t=n[r],a=e[t],a!==s&&a.length>0&&(i+=(i.length>0?" ":"")+t+": "+a+";")}function r(e,t){var n;return n=f["*"],n&&n[e]?!1:(n=f[t],n&&n[e]?!1:!0)}var i="",o,a;if(t&&d)n("*"),n(t);else for(o in e)a=e[o],a!==s&&a.length>0&&(!f||r(o,t))&&(i+=(i.length>0?" ":"")+o+": "+a+";");return i}}}}),r(h,[],function(){return function(e,t){function n(e,n,r,i){var o,a;if(e){if(!i&&e[n])return e[n];if(e!=t){if(o=e[r])return o;for(a=e.parentNode;a&&a!=t;a=a.parentNode)if(o=a[r])return o}}}var r=e;this.current=function(){return r},this.next=function(e){return r=n(r,"firstChild","nextSibling",e)},this.prev=function(e){return r=n(r,"lastChild","previousSibling",e)}}}),r(m,[d],function(e){function t(n){function r(){return M.createDocumentFragment()}function i(e,t){_(F,e,t)}function o(e,t){_(z,e,t)}function a(e){i(e.parentNode,j(e))}function s(e){i(e.parentNode,j(e)+1)}function l(e){o(e.parentNode,j(e))}function c(e){o(e.parentNode,j(e)+1)}function u(e){e?(H[U]=H[V],H[$]=H[W]):(H[V]=H[U],H[W]=H[$]),H.collapsed=F}function d(e){a(e),c(e)}function f(e){i(e,0),o(e,1===e.nodeType?e.childNodes.length:e.nodeValue.length)}function p(e,t){var n=H[V],r=H[W],i=H[U],o=H[$],a=t.startContainer,s=t.startOffset,l=t.endContainer,c=t.endOffset;return 0===e?w(n,r,a,s):1===e?w(i,o,a,s):2===e?w(i,o,l,c):3===e?w(n,r,l,c):void 0}function h(){E(I)}function m(){return E(P)}function g(){return E(O)}function v(e){var t=this[V],r=this[W],i,o;3!==t.nodeType&&4!==t.nodeType||!t.nodeValue?(t.childNodes.length>0&&(o=t.childNodes[r]),o?t.insertBefore(e,o):3==t.nodeType?n.insertAfter(e,t):t.appendChild(e)):r?r>=t.nodeValue.length?n.insertAfter(e,t):(i=t.splitText(r),t.parentNode.insertBefore(e,i)):t.parentNode.insertBefore(e,t)}function y(e){var t=H.extractContents();H.insertNode(e),e.appendChild(t),H.selectNode(e)}function b(){return q(new t(n),{startContainer:H[V],startOffset:H[W],endContainer:H[U],endOffset:H[$],collapsed:H.collapsed,commonAncestorContainer:H.commonAncestorContainer})}function C(e,t){var n;if(3==e.nodeType)return e;if(0>t)return e;for(n=e.firstChild;n&&t>0;)--t,n=n.nextSibling;return n?n:e}function x(){return H[V]==H[U]&&H[W]==H[$]}function w(e,t,r,i){var o,a,s,l,c,u;if(e==r)return t==i?0:i>t?-1:1;for(o=r;o&&o.parentNode!=e;)o=o.parentNode;if(o){for(a=0,s=e.firstChild;s!=o&&t>a;)a++,s=s.nextSibling;return a>=t?-1:1}for(o=e;o&&o.parentNode!=r;)o=o.parentNode;if(o){for(a=0,s=r.firstChild;s!=o&&i>a;)a++,s=s.nextSibling;return i>a?-1:1}for(l=n.findCommonAncestor(e,r),c=e;c&&c.parentNode!=l;)c=c.parentNode;for(c||(c=l),u=r;u&&u.parentNode!=l;)u=u.parentNode;if(u||(u=l),c==u)return 0;for(s=l.firstChild;s;){if(s==c)return-1;if(s==u)return 1;s=s.nextSibling}}function _(e,t,r){var i,o;for(e?(H[V]=t,H[W]=r):(H[U]=t,H[$]=r),i=H[U];i.parentNode;)i=i.parentNode;for(o=H[V];o.parentNode;)o=o.parentNode;o==i?w(H[V],H[W],H[U],H[$])>0&&H.collapse(e):H.collapse(e),H.collapsed=x(),H.commonAncestorContainer=n.findCommonAncestor(H[V],H[U])}function E(e){var t,n=0,r=0,i,o,a,s,l,c;if(H[V]==H[U])return N(e);for(t=H[U],i=t.parentNode;i;t=i,i=i.parentNode){if(i==H[V])return k(t,e);++n}for(t=H[V],i=t.parentNode;i;t=i,i=i.parentNode){if(i==H[U])return S(t,e);++r}for(o=r-n,a=H[V];o>0;)a=a.parentNode,o--;for(s=H[U];0>o;)s=s.parentNode,o++;for(l=a.parentNode,c=s.parentNode;l!=c;l=l.parentNode,c=c.parentNode)a=l,s=c;return T(a,s,e)}function N(e){var t,n,i,o,a,s,l,c,u;if(e!=I&&(t=r()),H[W]==H[$])return t;if(3==H[V].nodeType){if(n=H[V].nodeValue,i=n.substring(H[W],H[$]),e!=O&&(o=H[V],c=H[W],u=H[$]-H[W],0===c&&u>=o.nodeValue.length-1?o.parentNode.removeChild(o):o.deleteData(c,u),H.collapse(F)),e==I)return;return i.length>0&&t.appendChild(M.createTextNode(i)),t}for(o=C(H[V],H[W]),a=H[$]-H[W];o&&a>0;)s=o.nextSibling,l=D(o,e),t&&t.appendChild(l),--a,o=s;return e!=O&&H.collapse(F),t}function k(e,t){var n,i,o,a,s,l;if(t!=I&&(n=r()),i=R(e,t),n&&n.appendChild(i),o=j(e),a=o-H[W],0>=a)return t!=O&&(H.setEndBefore(e),H.collapse(z)),n;for(i=e.previousSibling;a>0;)s=i.previousSibling,l=D(i,t),n&&n.insertBefore(l,n.firstChild),--a,i=s;return t!=O&&(H.setEndBefore(e),H.collapse(z)),n}function S(e,t){var n,i,o,a,s,l;for(t!=I&&(n=r()),o=A(e,t),n&&n.appendChild(o),i=j(e),++i,a=H[$]-i,o=e.nextSibling;o&&a>0;)s=o.nextSibling,l=D(o,t),n&&n.appendChild(l),--a,o=s;return t!=O&&(H.setStartAfter(e),H.collapse(F)),n}function T(e,t,n){var i,o,a,s,l,c,u;for(n!=I&&(o=r()),i=A(e,n),o&&o.appendChild(i),a=j(e),s=j(t),++a,l=s-a,c=e.nextSibling;l>0;)u=c.nextSibling,i=D(c,n),o&&o.appendChild(i),c=u,--l;return i=R(t,n),o&&o.appendChild(i),n!=O&&(H.setStartAfter(e),H.collapse(F)),o}function R(e,t){var n=C(H[U],H[$]-1),r,i,o,a,s,l=n!=H[U];if(n==e)return B(n,l,z,t);for(r=n.parentNode,i=B(r,z,z,t);r;){for(;n;)o=n.previousSibling,a=B(n,l,z,t),t!=I&&i.insertBefore(a,i.firstChild),l=F,n=o;if(r==e)return i;n=r.previousSibling,r=r.parentNode,s=B(r,z,z,t),t!=I&&s.appendChild(i),i=s}}function A(e,t){var n=C(H[V],H[W]),r=n!=H[V],i,o,a,s,l;if(n==e)return B(n,r,F,t);for(i=n.parentNode,o=B(i,z,F,t);i;){for(;n;)a=n.nextSibling,s=B(n,r,F,t),t!=I&&o.appendChild(s),r=F,n=a;if(i==e)return o;n=i.nextSibling,i=i.parentNode,l=B(i,z,F,t),t!=I&&l.appendChild(o),o=l}}function B(e,t,r,i){var o,a,s,l,c;if(t)return D(e,i);if(3==e.nodeType){if(o=e.nodeValue,r?(l=H[W],a=o.substring(l),s=o.substring(0,l)):(l=H[$],a=o.substring(0,l),s=o.substring(l)),i!=O&&(e.nodeValue=s),i==I)return;return c=n.clone(e,z),c.nodeValue=a,c}if(i!=I)return n.clone(e,z)}function D(e,t){return t!=I?t==O?n.clone(e,F):e:void e.parentNode.removeChild(e)}function L(){return n.create("body",null,g()).outerText}var H=this,M=n.doc,P=0,O=1,I=2,F=!0,z=!1,W="startOffset",V="startContainer",U="endContainer",$="endOffset",q=e.extend,j=n.nodeIndex;return q(H,{startContainer:M,startOffset:0,endContainer:M,endOffset:0,collapsed:F,commonAncestorContainer:M,START_TO_START:0,START_TO_END:1,END_TO_END:2,END_TO_START:3,setStart:i,setEnd:o,setStartBefore:a,setStartAfter:s,setEndBefore:l,setEndAfter:c,collapse:u,selectNode:d,selectNodeContents:f,compareBoundaryPoints:p,deleteContents:h,extractContents:m,cloneContents:g,insertNode:v,surroundContents:y,cloneRange:b,toStringIE:L}),H}return t.prototype.toString=function(){return this.toStringIE()},t}),r(g,[d],function(e){function t(e){var t;return t=document.createElement("div"),t.innerHTML=e,t.textContent||t.innerText||e}function n(e,t){var n,r,i,a={};if(e){for(e=e.split(","),t=t||10,n=0;n<e.length;n+=2)r=String.fromCharCode(parseInt(e[n],t)),o[r]||(i="&"+e[n+1]+";",a[r]=i,a[i]=r);return a}}var r=e.makeMap,i,o,a,s=/[&<>\"\u0060\u007E-\uD7FF\uE000-\uFFEF]|[\uD800-\uDBFF][\uDC00-\uDFFF]/g,l=/[<>&\u007E-\uD7FF\uE000-\uFFEF]|[\uD800-\uDBFF][\uDC00-\uDFFF]/g,c=/[<>&\"\']/g,u=/&(#x|#)?([\w]+);/g,d={128:"\u20ac",130:"\u201a",131:"\u0192",132:"\u201e",133:"\u2026",134:"\u2020",135:"\u2021",136:"\u02c6",137:"\u2030",138:"\u0160",139:"\u2039",140:"\u0152",142:"\u017d",145:"\u2018",146:"\u2019",147:"\u201c",148:"\u201d",149:"\u2022",150:"\u2013",151:"\u2014",152:"\u02dc",153:"\u2122",154:"\u0161",155:"\u203a",156:"\u0153",158:"\u017e",159:"\u0178"};o={'"':"&quot;","'":"&#39;","<":"&lt;",">":"&gt;","&":"&amp;","`":"&#96;"},a={"&lt;":"<","&gt;":">","&amp;":"&","&quot;":'"',"&apos;":"'"},i=n("50,nbsp,51,iexcl,52,cent,53,pound,54,curren,55,yen,56,brvbar,57,sect,58,uml,59,copy,5a,ordf,5b,laquo,5c,not,5d,shy,5e,reg,5f,macr,5g,deg,5h,plusmn,5i,sup2,5j,sup3,5k,acute,5l,micro,5m,para,5n,middot,5o,cedil,5p,sup1,5q,ordm,5r,raquo,5s,frac14,5t,frac12,5u,frac34,5v,iquest,60,Agrave,61,Aacute,62,Acirc,63,Atilde,64,Auml,65,Aring,66,AElig,67,Ccedil,68,Egrave,69,Eacute,6a,Ecirc,6b,Euml,6c,Igrave,6d,Iacute,6e,Icirc,6f,Iuml,6g,ETH,6h,Ntilde,6i,Ograve,6j,Oacute,6k,Ocirc,6l,Otilde,6m,Ouml,6n,times,6o,Oslash,6p,Ugrave,6q,Uacute,6r,Ucirc,6s,Uuml,6t,Yacute,6u,THORN,6v,szlig,70,agrave,71,aacute,72,acirc,73,atilde,74,auml,75,aring,76,aelig,77,ccedil,78,egrave,79,eacute,7a,ecirc,7b,euml,7c,igrave,7d,iacute,7e,icirc,7f,iuml,7g,eth,7h,ntilde,7i,ograve,7j,oacute,7k,ocirc,7l,otilde,7m,ouml,7n,divide,7o,oslash,7p,ugrave,7q,uacute,7r,ucirc,7s,uuml,7t,yacute,7u,thorn,7v,yuml,ci,fnof,sh,Alpha,si,Beta,sj,Gamma,sk,Delta,sl,Epsilon,sm,Zeta,sn,Eta,so,Theta,sp,Iota,sq,Kappa,sr,Lambda,ss,Mu,st,Nu,su,Xi,sv,Omicron,t0,Pi,t1,Rho,t3,Sigma,t4,Tau,t5,Upsilon,t6,Phi,t7,Chi,t8,Psi,t9,Omega,th,alpha,ti,beta,tj,gamma,tk,delta,tl,epsilon,tm,zeta,tn,eta,to,theta,tp,iota,tq,kappa,tr,lambda,ts,mu,tt,nu,tu,xi,tv,omicron,u0,pi,u1,rho,u2,sigmaf,u3,sigma,u4,tau,u5,upsilon,u6,phi,u7,chi,u8,psi,u9,omega,uh,thetasym,ui,upsih,um,piv,812,bull,816,hellip,81i,prime,81j,Prime,81u,oline,824,frasl,88o,weierp,88h,image,88s,real,892,trade,89l,alefsym,8cg,larr,8ch,uarr,8ci,rarr,8cj,darr,8ck,harr,8dl,crarr,8eg,lArr,8eh,uArr,8ei,rArr,8ej,dArr,8ek,hArr,8g0,forall,8g2,part,8g3,exist,8g5,empty,8g7,nabla,8g8,isin,8g9,notin,8gb,ni,8gf,prod,8gh,sum,8gi,minus,8gn,lowast,8gq,radic,8gt,prop,8gu,infin,8h0,ang,8h7,and,8h8,or,8h9,cap,8ha,cup,8hb,int,8hk,there4,8hs,sim,8i5,cong,8i8,asymp,8j0,ne,8j1,equiv,8j4,le,8j5,ge,8k2,sub,8k3,sup,8k4,nsub,8k6,sube,8k7,supe,8kl,oplus,8kn,otimes,8l5,perp,8m5,sdot,8o8,lceil,8o9,rceil,8oa,lfloor,8ob,rfloor,8p9,lang,8pa,rang,9ea,loz,9j0,spades,9j3,clubs,9j5,hearts,9j6,diams,ai,OElig,aj,oelig,b0,Scaron,b1,scaron,bo,Yuml,m6,circ,ms,tilde,802,ensp,803,emsp,809,thinsp,80c,zwnj,80d,zwj,80e,lrm,80f,rlm,80j,ndash,80k,mdash,80o,lsquo,80p,rsquo,80q,sbquo,80s,ldquo,80t,rdquo,80u,bdquo,810,dagger,811,Dagger,81g,permil,81p,lsaquo,81q,rsaquo,85c,euro",32);var f={encodeRaw:function(e,t){return e.replace(t?s:l,function(e){return o[e]||e})},encodeAllRaw:function(e){return(""+e).replace(c,function(e){return o[e]||e})},encodeNumeric:function(e,t){return e.replace(t?s:l,function(e){return e.length>1?"&#"+(1024*(e.charCodeAt(0)-55296)+(e.charCodeAt(1)-56320)+65536)+";":o[e]||"&#"+e.charCodeAt(0)+";"})},encodeNamed:function(e,t,n){return n=n||i,e.replace(t?s:l,function(e){return o[e]||n[e]||e})},getEncodeFunc:function(e,t){function a(e,n){return e.replace(n?s:l,function(e){return o[e]||t[e]||"&#"+e.charCodeAt(0)+";"||e})}function c(e,n){return f.encodeNamed(e,n,t)}return t=n(t)||i,e=r(e.replace(/\+/g,",")),e.named&&e.numeric?a:e.named?t?c:f.encodeNamed:e.numeric?f.encodeNumeric:f.encodeRaw},decode:function(e){return e.replace(u,function(e,n,r){return n?(r=parseInt(r,2===n.length?16:10),r>65535?(r-=65536,String.fromCharCode(55296+(r>>10),56320+(1023&r))):d[r]||String.fromCharCode(r)):a[e]||i[e]||t(e)})}};return f}),r(v,[d],function(e){return function(t,n){function r(e){t.getElementsByTagName("head")[0].appendChild(e)}function i(n,i,l){function c(){for(var e=y.passed,t=e.length;t--;)e[t]();y.status=2,y.passed=[],y.failed=[]}function u(){for(var e=y.failed,t=e.length;t--;)e[t]();y.status=3,y.passed=[],y.failed=[]}function d(){var e=navigator.userAgent.match(/WebKit\/(\d*)/);return!!(e&&e[1]<536)}function f(e,t){e()||((new Date).getTime()-v<s?window.setTimeout(t,0):u())}function p(){f(function(){for(var e=t.styleSheets,n,r=e.length,i;r--;)if(n=e[r],i=n.ownerNode?n.ownerNode:n.owningElement,i&&i.id===m.id)return c(),!0},p)}function h(){f(function(){try{var e=g.sheet.cssRules;return c(),!!e}catch(t){}},h)}var m,g,v,y;if(n=e._addCacheSuffix(n),a[n]?y=a[n]:(y={passed:[],failed:[]},a[n]=y),i&&y.passed.push(i),l&&y.failed.push(l),1!=y.status){if(2==y.status)return void c();if(3==y.status)return void u();if(y.status=1,m=t.createElement("link"),m.rel="stylesheet",m.type="text/css",m.id="u"+o++,m.async=!1,m.defer=!1,v=(new Date).getTime(),"onload"in m&&!d())m.onload=p,m.onerror=u;else{if(navigator.userAgent.indexOf("Firefox")>0)return g=t.createElement("style"),g.textContent='@import "'+n+'"',h(),void r(g);p()}r(m),m.href=n}}var o=0,a={},s;n=n||{},s=n.maxLoadTime||5e3,this.load=i}}),r(y,[c,f,p,l,h,m,g,u,d,v],function(e,n,r,i,o,a,s,l,c,u){function d(e,t){var n={},r=t.keep_values,i;return i={set:function(n,r,i){t.url_converter&&(r=t.url_converter.call(t.url_converter_scope||e,r,i,n[0])),n.attr("data-mce-"+i,r).attr(i,r)},get:function(e,t){return e.attr("data-mce-"+t)||e.attr(t)}},n={style:{set:function(e,t){return null!==t&&"object"==typeof t?void e.css(t):(r&&e.attr("data-mce-style",t),void e.attr("style",t))},get:function(t){var n=t.attr("data-mce-style")||t.attr("style");return n=e.serializeStyle(e.parseStyle(n),t[0].nodeName)}}},r&&(n.href=n.src=i),n}function f(e,t){var o=this,a;o.doc=e,o.win=window,o.files={},o.counter=0,o.stdMode=!v||e.documentMode>=8,o.boxModel=!v||"CSS1Compat"==e.compatMode||o.stdMode,o.styleSheetLoader=new u(e),o.boundEvents=[],o.settings=t=t||{},o.schema=t.schema,o.styles=new r({url_converter:t.url_converter,url_converter_scope:t.url_converter_scope},t.schema),o.fixDoc(e),o.events=t.ownEvents?new i(t.proxy):i.Event,o.attrHooks=d(o,t),a=t.schema?t.schema.getBlockElements():{},o.$=n.overrideDefaults(function(){return{context:e,element:o.getRoot()}}),o.isBlock=function(e){if(!e)return!1;var t=e.nodeType;return t?!(1!==t||!a[e.nodeName]):!!a[e]}}var p=c.each,h=c.is,m=c.grep,g=c.trim,v=l.ie,y=/^([a-z0-9],?)+$/i,b=/^[ \t\r\n]*$/;return f.prototype={$$:function(e){return"string"==typeof e&&(e=this.get(e)),this.$(e)},root:null,fixDoc:function(e){var t=this.settings,n;if(v&&t.schema){"abbr article aside audio canvas details figcaption figure footer header hgroup mark menu meter nav output progress section summary time video".replace(/\w+/g,function(t){e.createElement(t)});for(n in t.schema.getCustomElements())e.createElement(n)}},clone:function(e,t){var n=this,r,i;return!v||1!==e.nodeType||t?e.cloneNode(t):(i=n.doc,t?r.firstChild:(r=i.createElement(e.nodeName),p(n.getAttribs(e),function(t){n.setAttrib(r,t.nodeName,n.getAttrib(e,t.nodeName))}),r))},getRoot:function(){var e=this;return e.settings.root_element||e.doc.body},getViewPort:function(e){var t,n;return e=e?e:this.win,t=e.document,n=this.boxModel?t.documentElement:t.body,{x:e.pageXOffset||n.scrollLeft,y:e.pageYOffset||n.scrollTop,w:e.innerWidth||n.clientWidth,h:e.innerHeight||n.clientHeight}},getRect:function(e){var t=this,n,r;return e=t.get(e),n=t.getPos(e),r=t.getSize(e),{x:n.x,y:n.y,w:r.w,h:r.h}},getSize:function(e){var t=this,n,r;return e=t.get(e),n=t.getStyle(e,"width"),r=t.getStyle(e,"height"),-1===n.indexOf("px")&&(n=0),-1===r.indexOf("px")&&(r=0),{w:parseInt(n,10)||e.offsetWidth||e.clientWidth,h:parseInt(r,10)||e.offsetHeight||e.clientHeight}},getParent:function(e,t,n){return this.getParents(e,t,n,!1)},getParents:function(e,n,r,i){var o=this,a,s=[];for(e=o.get(e),i=i===t,r=r||("BODY"!=o.getRoot().nodeName?o.getRoot().parentNode:null),h(n,"string")&&(a=n,n="*"===n?function(e){return 1==e.nodeType}:function(e){return o.is(e,a)});e&&e!=r&&e.nodeType&&9!==e.nodeType;){if(!n||n(e)){if(!i)return e;s.push(e)}e=e.parentNode}return i?s:null},get:function(e){var t;return e&&this.doc&&"string"==typeof e&&(t=e,e=this.doc.getElementById(e),e&&e.id!==t)?this.doc.getElementsByName(t)[1]:e},getNext:function(e,t){return this._findSib(e,t,"nextSibling")},getPrev:function(e,t){return this._findSib(e,t,"previousSibling")},select:function(t,n){var r=this;return e(t,r.get(n)||r.settings.root_element||r.doc,[])},is:function(n,r){var i;if(n.length===t){if("*"===r)return 1==n.nodeType;if(y.test(r)){for(r=r.toLowerCase().split(/,/),n=n.nodeName.toLowerCase(),i=r.length-1;i>=0;i--)if(r[i]==n)return!0;return!1}}if(n.nodeType&&1!=n.nodeType)return!1;var o=n.nodeType?[n]:n;return e(r,o[0].ownerDocument||o[0],null,o).length>0},add:function(e,t,n,r,i){var o=this;return this.run(e,function(e){var a;return a=h(t,"string")?o.doc.createElement(t):t,o.setAttribs(a,n),r&&(r.nodeType?a.appendChild(r):o.setHTML(a,r)),i?a:e.appendChild(a)})},create:function(e,t,n){return this.add(this.doc.createElement(e),e,t,n,1)},createHTML:function(e,t,n){var r="",i;r+="<"+e;for(i in t)t.hasOwnProperty(i)&&null!==t[i]&&"undefined"!=typeof t[i]&&(r+=" "+i+'="'+this.encode(t[i])+'"');return"undefined"!=typeof n?r+">"+n+"</"+e+">":r+" />"},createFragment:function(e){var t,n,r=this.doc,i;for(i=r.createElement("div"),t=r.createDocumentFragment(),e&&(i.innerHTML=e);n=i.firstChild;)t.appendChild(n);return t},remove:function(e,t){return e=this.$$(e),t?e.each(function(){for(var e;e=this.firstChild;)3==e.nodeType&&0===e.data.length?this.removeChild(e):this.parentNode.insertBefore(e,this)}).remove():e.remove(),e.length>1?e.toArray():e[0]},setStyle:function(e,t,n){e=this.$$(e).css(t,n),this.settings.update_styles&&e.attr("data-mce-style",null)},getStyle:function(e,n,r){return e=this.$$(e),r?e.css(n):(n=n.replace(/-(\D)/g,function(e,t){return t.toUpperCase()}),"float"==n&&(n=v?"styleFloat":"cssFloat"),e[0]&&e[0].style?e[0].style[n]:t)},setStyles:function(e,t){e=this.$$(e).css(t),this.settings.update_styles&&e.attr("data-mce-style",null)},removeAllAttribs:function(e){return this.run(e,function(e){var t,n=e.attributes;for(t=n.length-1;t>=0;t--)e.removeAttributeNode(n.item(t))})},setAttrib:function(e,t,n){var r=this,i,o,a=r.settings;""===n&&(n=null),e=r.$$(e),i=e.attr(t),e.length&&(o=r.attrHooks[t],o&&o.set?o.set(e,n,t):e.attr(t,n),i!=n&&a.onSetAttrib&&a.onSetAttrib({attrElm:e,attrName:t,attrValue:n}))},setAttribs:function(e,t){var n=this;n.$$(e).each(function(e,r){p(t,function(e,t){n.setAttrib(r,t,e)})})},getAttrib:function(e,t,n){var r=this,i,o;return e=r.$$(e),e.length&&(i=r.attrHooks[t],o=i&&i.get?i.get(e,t):e.attr(t)),"undefined"==typeof o&&(o=n||""),o},getPos:function(e,t){var r=this,i=0,o=0,a,s=r.doc,l=s.body,c;if(e=r.get(e),t=t||l,e){if(t===l&&e.getBoundingClientRect&&"static"===n(l).css("position"))return c=e.getBoundingClientRect(),t=r.boxModel?s.documentElement:l,i=c.left+(s.documentElement.scrollLeft||l.scrollLeft)-t.clientLeft,o=c.top+(s.documentElement.scrollTop||l.scrollTop)-t.clientTop,{x:i,y:o};for(a=e;a&&a!=t&&a.nodeType;)i+=a.offsetLeft||0,o+=a.offsetTop||0,a=a.offsetParent;for(a=e.parentNode;a&&a!=t&&a.nodeType;)i-=a.scrollLeft||0,o-=a.scrollTop||0,a=a.parentNode}return{x:i,y:o}},parseStyle:function(e){return this.styles.parse(e)},serializeStyle:function(e,t){return this.styles.serialize(e,t)},addStyle:function(e){var t=this,n=t.doc,r,i;if(t!==f.DOM&&n===document){var o=f.DOM.addedStyles;if(o=o||[],o[e])return;o[e]=!0,f.DOM.addedStyles=o}i=n.getElementById("mceDefaultStyles"),i||(i=n.createElement("style"),i.id="mceDefaultStyles",i.type="text/css",r=n.getElementsByTagName("head")[0],r.firstChild?r.insertBefore(i,r.firstChild):r.appendChild(i)),i.styleSheet?i.styleSheet.cssText+=e:i.appendChild(n.createTextNode(e))},loadCSS:function(e){var t=this,n=t.doc,r;return t!==f.DOM&&n===document?void f.DOM.loadCSS(e):(e||(e=""),r=n.getElementsByTagName("head")[0],void p(e.split(","),function(e){var i;e=c._addCacheSuffix(e),t.files[e]||(t.files[e]=!0,i=t.create("link",{rel:"stylesheet",href:e}),v&&n.documentMode&&n.recalc&&(i.onload=function(){n.recalc&&n.recalc(),i.onload=null}),r.appendChild(i))}))},addClass:function(e,t){this.$$(e).addClass(t)},removeClass:function(e,t){this.toggleClass(e,t,!1)},hasClass:function(e,t){return this.$$(e).hasClass(t)},toggleClass:function(e,t,r){this.$$(e).toggleClass(t,r).each(function(){""===this.className&&n(this).attr("class",null)})},show:function(e){this.$$(e).show()},hide:function(e){this.$$(e).hide()},isHidden:function(e){return"none"==this.$$(e).css("display")},uniqueId:function(e){return(e?e:"mce_")+this.counter++},setHTML:function(e,t){e=this.$$(e),v?e.each(function(e,r){if(r.canHaveHTML!==!1){for(;r.firstChild;)r.removeChild(r.firstChild);try{r.innerHTML="<br>"+t,r.removeChild(r.firstChild)}catch(i){n("<div>").html("<br>"+t).contents().slice(1).appendTo(r)}return t}}):e.html(t)},getOuterHTML:function(e){return e=this.get(e),1==e.nodeType?e.outerHTML:n("<div>").append(n(e).clone()).html()},setOuterHTML:function(e,t){var r=this;r.$$(e).each(function(){try{this.outerHTML=t}catch(e){r.remove(n(this).html(t),!0)}})},decode:s.decode,encode:s.encodeAllRaw,insertAfter:function(e,t){return t=this.get(t),this.run(e,function(e){var n,r;return n=t.parentNode,r=t.nextSibling,r?n.insertBefore(e,r):n.appendChild(e),e})},replace:function(e,t,n){var r=this;return r.run(t,function(t){return h(t,"array")&&(e=e.cloneNode(!0)),n&&p(m(t.childNodes),function(t){e.appendChild(t)}),t.parentNode.replaceChild(e,t)})},rename:function(e,t){var n=this,r;return e.nodeName!=t.toUpperCase()&&(r=n.create(t),p(n.getAttribs(e),function(t){n.setAttrib(r,t.nodeName,n.getAttrib(e,t.nodeName))}),n.replace(r,e,1)),r||e},findCommonAncestor:function(e,t){for(var n=e,r;n;){for(r=t;r&&n!=r;)r=r.parentNode;if(n==r)break;n=n.parentNode}return!n&&e.ownerDocument?e.ownerDocument.documentElement:n},toHex:function(e){return this.styles.toHex(c.trim(e))},run:function(e,t,n){var r=this,i;return"string"==typeof e&&(e=r.get(e)),e?(n=n||this,e.nodeType||!e.length&&0!==e.length?t.call(n,e):(i=[],p(e,function(e,o){e&&("string"==typeof e&&(e=r.get(e)),i.push(t.call(n,e,o)))}),i)):!1},getAttribs:function(e){var t;if(e=this.get(e),!e)return[];if(v){if(t=[],"OBJECT"==e.nodeName)return e.attributes;"OPTION"===e.nodeName&&this.getAttrib(e,"selected")&&t.push({specified:1,nodeName:"selected"});var n=/<\/?[\w:\-]+ ?|=[\"][^\"]+\"|=\'[^\']+\'|=[\w\-]+|>/gi;return e.cloneNode(!1).outerHTML.replace(n,"").replace(/[\w:\-]+/gi,function(e){t.push({specified:1,nodeName:e})}),t}return e.attributes},isEmpty:function(e,t){var n=this,r,i,a,s,l,c=0;if(e=e.firstChild){s=new o(e,e.parentNode),t=t||(n.schema?n.schema.getNonEmptyElements():null);do{if(a=e.nodeType,1===a){if(e.getAttribute("data-mce-bogus"))continue;if(l=e.nodeName.toLowerCase(),t&&t[l]){if("br"===l){c++;continue}return!1}for(i=n.getAttribs(e),r=i.length;r--;)if(l=i[r].nodeName,"name"===l||"data-mce-bookmark"===l)return!1}if(8==a)return!1;if(3===a&&!b.test(e.nodeValue))return!1}while(e=s.next())}return 1>=c},createRng:function(){var e=this.doc;return e.createRange?e.createRange():new a(this)},nodeIndex:function(e,t){var n=0,r,i;if(e)for(r=e.nodeType,e=e.previousSibling;e;e=e.previousSibling)i=e.nodeType,(!t||3!=i||i!=r&&e.nodeValue.length)&&(n++,r=i);return n},split:function(e,t,n){function r(e){function t(e){var t=e.previousSibling&&"SPAN"==e.previousSibling.nodeName,n=e.nextSibling&&"SPAN"==e.nextSibling.nodeName;return t&&n}var n,o=e.childNodes,a=e.nodeType;if(1!=a||"bookmark"!=e.getAttribute("data-mce-type")){for(n=o.length-1;n>=0;n--)r(o[n]);if(9!=a){if(3==a&&e.nodeValue.length>0){var s=g(e.nodeValue).length;if(!i.isBlock(e.parentNode)||s>0||0===s&&t(e))return
}else if(1==a&&(o=e.childNodes,1==o.length&&o[0]&&1==o[0].nodeType&&"bookmark"==o[0].getAttribute("data-mce-type")&&e.parentNode.insertBefore(o[0],e),o.length||/^(br|hr|input|img)$/i.test(e.nodeName)))return;i.remove(e)}return e}}var i=this,o=i.createRng(),a,s,l;return e&&t?(o.setStart(e.parentNode,i.nodeIndex(e)),o.setEnd(t.parentNode,i.nodeIndex(t)),a=o.extractContents(),o=i.createRng(),o.setStart(t.parentNode,i.nodeIndex(t)+1),o.setEnd(e.parentNode,i.nodeIndex(e)+1),s=o.extractContents(),l=e.parentNode,l.insertBefore(r(a),e),n?l.replaceChild(n,t):l.insertBefore(t,e),l.insertBefore(r(s),e),i.remove(e),n||t):void 0},bind:function(e,t,n,r){var i=this;if(c.isArray(e)){for(var o=e.length;o--;)e[o]=i.bind(e[o],t,n,r);return e}return!i.settings.collect||e!==i.doc&&e!==i.win||i.boundEvents.push([e,t,n,r]),i.events.bind(e,t,n,r||i)},unbind:function(e,t,n){var r=this,i;if(c.isArray(e)){for(i=e.length;i--;)e[i]=r.unbind(e[i],t,n);return e}if(r.boundEvents&&(e===r.doc||e===r.win))for(i=r.boundEvents.length;i--;){var o=r.boundEvents[i];e!=o[0]||t&&t!=o[1]||n&&n!=o[2]||this.events.unbind(o[0],o[1],o[2])}return this.events.unbind(e,t,n)},fire:function(e,t,n){return this.events.fire(e,t,n)},getContentEditable:function(e){var t;return e&&1==e.nodeType?(t=e.getAttribute("data-mce-contenteditable"),t&&"inherit"!==t?t:"inherit"!==e.contentEditable?e.contentEditable:null):null},getContentEditableParent:function(e){for(var t=this.getRoot(),n=null;e&&e!==t&&(n=this.getContentEditable(e),null===n);e=e.parentNode);return n},destroy:function(){var t=this;if(t.boundEvents){for(var n=t.boundEvents.length;n--;){var r=t.boundEvents[n];this.events.unbind(r[0],r[1],r[2])}t.boundEvents=null}e.setDocument&&e.setDocument(),t.win=t.doc=t.root=t.events=t.frag=null},isChildOf:function(e,t){for(;e;){if(t===e)return!0;e=e.parentNode}return!1},dumpRng:function(e){return"startContainer: "+e.startContainer.nodeName+", startOffset: "+e.startOffset+", endContainer: "+e.endContainer.nodeName+", endOffset: "+e.endOffset},_findSib:function(e,t,n){var r=this,i=t;if(e)for("string"==typeof i&&(i=function(e){return r.is(e,t)}),e=e[n];e;e=e[n])if(i(e))return e;return null}},f.DOM=new f(document),f}),r(b,[y,d],function(e,t){function n(){function e(e,n){function i(){a.remove(l),s&&(s.onreadystatechange=s.onload=s=null),n()}function o(){"undefined"!=typeof console&&console.log&&console.log("Failed to load: "+e)}var a=r,s,l;l=a.uniqueId(),s=document.createElement("script"),s.id=l,s.type="text/javascript",s.src=t._addCacheSuffix(e),"onreadystatechange"in s?s.onreadystatechange=function(){/loaded|complete/.test(s.readyState)&&i()}:s.onload=i,s.onerror=o,(document.getElementsByTagName("head")[0]||document.body).appendChild(s)}var n=0,a=1,s=2,l={},c=[],u={},d=[],f=0,p;this.isDone=function(e){return l[e]==s},this.markDone=function(e){l[e]=s},this.add=this.load=function(e,t,r){var i=l[e];i==p&&(c.push(e),l[e]=n),t&&(u[e]||(u[e]=[]),u[e].push({func:t,scope:r||this}))},this.loadQueue=function(e,t){this.loadScripts(c,e,t)},this.loadScripts=function(t,n,r){function c(e){i(u[e],function(e){e.func.call(e.scope)}),u[e]=p}var h;d.push({func:n,scope:r||this}),(h=function(){var n=o(t);t.length=0,i(n,function(t){return l[t]==s?void c(t):void(l[t]!=a&&(l[t]=a,f++,e(t,function(){l[t]=s,f--,c(t),h()})))}),f||(i(d,function(e){e.func.call(e.scope)}),d.length=0)})()}}var r=e.DOM,i=t.each,o=t.grep;return n.ScriptLoader=new n,n}),r(C,[b,d],function(e,n){function r(){var e=this;e.items=[],e.urls={},e.lookup={}}var i=n.each;return r.prototype={get:function(e){return this.lookup[e]?this.lookup[e].instance:t},dependencies:function(e){var t;return this.lookup[e]&&(t=this.lookup[e].dependencies),t||[]},requireLangPack:function(t,n){var i=r.language;if(i&&r.languageLoad!==!1){if(n)if(n=","+n+",",-1!=n.indexOf(","+i.substr(0,2)+","))i=i.substr(0,2);else if(-1==n.indexOf(","+i+","))return;e.ScriptLoader.add(this.urls[t]+"/langs/"+i+".js")}},add:function(e,t,n){return this.items.push(t),this.lookup[e]={instance:t,dependencies:n},t},createUrl:function(e,t){return"object"==typeof t?t:{prefix:e.prefix,resource:t,suffix:e.suffix}},addComponents:function(t,n){var r=this.urls[t];i(n,function(t){e.ScriptLoader.add(r+"/"+t)})},load:function(n,o,a,s){function l(){var r=c.dependencies(n);i(r,function(e){var n=c.createUrl(o,e);c.load(n.resource,n,t,t)}),a&&a.call(s?s:e)}var c=this,u=o;c.urls[n]||("object"==typeof o&&(u=o.prefix+o.resource+o.suffix),0!==u.indexOf("/")&&-1==u.indexOf("://")&&(u=r.baseURL+"/"+u),c.urls[n]=u.substring(0,u.lastIndexOf("/")),c.lookup[n]?l():e.ScriptLoader.add(u,l,s))}},r.PluginManager=new r,r.ThemeManager=new r,r}),r(x,[d,h],function(e,t){function n(e,t){var n=e.childNodes;return t--,t>n.length-1?t=n.length-1:0>t&&(t=0),n[t]||e}function r(e){this.walk=function(t,r){function o(e){var t;return t=e[0],3===t.nodeType&&t===c&&u>=t.nodeValue.length&&e.splice(0,1),t=e[e.length-1],0===f&&e.length>0&&t===d&&3===t.nodeType&&e.splice(e.length-1,1),e}function a(e,t,n){for(var r=[];e&&e!=n;e=e[t])r.push(e);return r}function s(e,t){do{if(e.parentNode==t)return e;e=e.parentNode}while(e)}function l(e,t,n){var i=n?"nextSibling":"previousSibling";for(g=e,v=g.parentNode;g&&g!=t;g=v)v=g.parentNode,y=a(g==e?g:g[i],i),y.length&&(n||y.reverse(),r(o(y)))}var c=t.startContainer,u=t.startOffset,d=t.endContainer,f=t.endOffset,p,h,m,g,v,y,b;if(b=e.select("td.mce-item-selected,th.mce-item-selected"),b.length>0)return void i(b,function(e){r([e])});if(1==c.nodeType&&c.hasChildNodes()&&(c=c.childNodes[u]),1==d.nodeType&&d.hasChildNodes()&&(d=n(d,f)),c==d)return r(o([c]));for(p=e.findCommonAncestor(c,d),g=c;g;g=g.parentNode){if(g===d)return l(c,p,!0);if(g===p)break}for(g=d;g;g=g.parentNode){if(g===c)return l(d,p);if(g===p)break}h=s(c,p)||c,m=s(d,p)||d,l(c,h,!0),y=a(h==c?h:h.nextSibling,"nextSibling",m==d?m.nextSibling:m),y.length&&r(o(y)),l(d,m)},this.split=function(e){function t(e,t){return e.splitText(t)}var n=e.startContainer,r=e.startOffset,i=e.endContainer,o=e.endOffset;return n==i&&3==n.nodeType?r>0&&r<n.nodeValue.length&&(i=t(n,r),n=i.previousSibling,o>r?(o-=r,n=i=t(i,o).previousSibling,o=i.nodeValue.length,r=0):o=0):(3==n.nodeType&&r>0&&r<n.nodeValue.length&&(n=t(n,r),r=0),3==i.nodeType&&o>0&&o<i.nodeValue.length&&(i=t(i,o).previousSibling,o=i.nodeValue.length)),{startContainer:n,startOffset:r,endContainer:i,endOffset:o}},this.normalize=function(n){function r(r){function a(n,r){for(var i=new t(n,e.getParent(n.parentNode,e.isBlock)||f);n=i[r?"prev":"next"]();)if("BR"===n.nodeName)return!0}function s(e,t){return e.previousSibling&&e.previousSibling.nodeName==t}function l(n,r){var a,s,l;if(r=r||c,l=e.getParent(r.parentNode,e.isBlock)||f,n&&"BR"==r.nodeName&&g&&e.isEmpty(l))return c=r.parentNode,u=e.nodeIndex(r),void(i=!0);for(a=new t(r,l);p=a[n?"prev":"next"]();){if("false"===e.getContentEditableParent(p))return;if(3===p.nodeType&&p.nodeValue.length>0)return c=p,u=n?p.nodeValue.length:0,void(i=!0);if(e.isBlock(p)||h[p.nodeName.toLowerCase()])return;s=p}o&&s&&(c=s,i=!0,u=0)}var c,u,d,f=e.getRoot(),p,h,m,g;if(c=n[(r?"start":"end")+"Container"],u=n[(r?"start":"end")+"Offset"],g=1==c.nodeType&&u===c.childNodes.length,h=e.schema.getNonEmptyElements(),m=r,1==c.nodeType&&u>c.childNodes.length-1&&(m=!1),9===c.nodeType&&(c=e.getRoot(),u=0),c===f){if(m&&(p=c.childNodes[u>0?u-1:0],p&&(h[p.nodeName]||"TABLE"==p.nodeName)))return;if(c.hasChildNodes()&&(u=Math.min(!m&&u>0?u-1:u,c.childNodes.length-1),c=c.childNodes[u],u=0,c.hasChildNodes()&&!/TABLE/.test(c.nodeName))){p=c,d=new t(c,f);do{if(3===p.nodeType&&p.nodeValue.length>0){u=m?0:p.nodeValue.length,c=p,i=!0;break}if(h[p.nodeName.toLowerCase()]){u=e.nodeIndex(p),c=p.parentNode,"IMG"!=p.nodeName||m||u++,i=!0;break}}while(p=m?d.next():d.prev())}}o&&(3===c.nodeType&&0===u&&l(!0),1===c.nodeType&&(p=c.childNodes[u],p||(p=c.childNodes[u-1]),!p||"BR"!==p.nodeName||s(p,"A")||a(p)||a(p,!0)||l(!0,p))),m&&!o&&3===c.nodeType&&u===c.nodeValue.length&&l(!1),i&&n["set"+(r?"Start":"End")](c,u)}var i,o;return o=n.collapsed,r(!0),o||r(),i&&o&&n.collapse(!0),i}}var i=e.each;return r.compareRanges=function(e,t){if(e&&t){if(!e.item&&!e.duplicate)return e.startContainer==t.startContainer&&e.startOffset==t.startOffset;if(e.item&&t.item&&e.item(0)===t.item(0))return!0;if(e.isEqual&&t.isEqual&&t.isEqual(e))return!0}return!1},r}),r(w,[x],function(e){return function(t){function n(e){var n,r;if(r=t.$(e).parentsUntil(t.getBody()).add(e),r.length===i.length){for(n=r.length;n>=0&&r[n]===i[n];n--);if(-1===n)return i=r,!0}return i=r,!1}var r,i=[];"onselectionchange"in t.getDoc()||t.on("NodeChange Click MouseUp KeyUp Focus",function(n){var i,o;i=t.selection.getRng(),o={startContainer:i.startContainer,startOffset:i.startOffset,endContainer:i.endContainer,endOffset:i.endOffset},"nodechange"!=n.type&&e.compareRanges(o,r)||t.fire("SelectionChange"),r=o}),t.on("contextmenu",function(){t.fire("SelectionChange")}),t.on("SelectionChange",function(){var e=t.selection.getStart(!0);t.selection.isCollapsed()||n(e)||!t.dom.isChildOf(e,t.getBody())||t.nodeChanged({selectionChange:!0})}),t.on("MouseUp",function(e){e.isDefaultPrevented()||setTimeout(function(){t.nodeChanged()},0)}),this.nodeChanged=function(e){var n=t.selection,r,i,o;t.initialized&&n&&!t.settings.disable_nodechange&&!t.settings.readonly&&(o=t.getBody(),r=n.getStart()||o,r=r.ownerDocument!=t.getDoc()?t.getBody():r,"IMG"==r.nodeName&&n.isCollapsed()&&(r=r.parentNode),i=[],t.dom.getParent(r,function(e){return e===o?!0:void i.push(e)}),e=e||{},e.element=r,e.parents=i,t.fire("NodeChange",e))}}}),r(_,[],function(){function e(e,t,n){var r,i,o=n?"lastChild":"firstChild",a=n?"prev":"next";if(e[o])return e[o];if(e!==t){if(r=e[a])return r;for(i=e.parent;i&&i!==t;i=i.parent)if(r=i[a])return r}}function t(e,t){this.name=e,this.type=t,1===t&&(this.attributes=[],this.attributes.map={})}var n=/^[ \t\r\n]*$/,r={"#text":3,"#comment":8,"#cdata":4,"#pi":7,"#doctype":10,"#document-fragment":11};return t.prototype={replace:function(e){var t=this;return e.parent&&e.remove(),t.insert(e,t),t.remove(),t},attr:function(e,t){var n=this,r,i,o;if("string"!=typeof e){for(i in e)n.attr(i,e[i]);return n}if(r=n.attributes){if(t!==o){if(null===t){if(e in r.map)for(delete r.map[e],i=r.length;i--;)if(r[i].name===e)return r=r.splice(i,1),n;return n}if(e in r.map){for(i=r.length;i--;)if(r[i].name===e){r[i].value=t;break}}else r.push({name:e,value:t});return r.map[e]=t,n}return r.map[e]}},clone:function(){var e=this,n=new t(e.name,e.type),r,i,o,a,s;if(o=e.attributes){for(s=[],s.map={},r=0,i=o.length;i>r;r++)a=o[r],"id"!==a.name&&(s[s.length]={name:a.name,value:a.value},s.map[a.name]=a.value);n.attributes=s}return n.value=e.value,n.shortEnded=e.shortEnded,n},wrap:function(e){var t=this;return t.parent.insert(e,t),e.append(t),t},unwrap:function(){var e=this,t,n;for(t=e.firstChild;t;)n=t.next,e.insert(t,e,!0),t=n;e.remove()},remove:function(){var e=this,t=e.parent,n=e.next,r=e.prev;return t&&(t.firstChild===e?(t.firstChild=n,n&&(n.prev=null)):r.next=n,t.lastChild===e?(t.lastChild=r,r&&(r.next=null)):n.prev=r,e.parent=e.next=e.prev=null),e},append:function(e){var t=this,n;return e.parent&&e.remove(),n=t.lastChild,n?(n.next=e,e.prev=n,t.lastChild=e):t.lastChild=t.firstChild=e,e.parent=t,e},insert:function(e,t,n){var r;return e.parent&&e.remove(),r=t.parent||this,n?(t===r.firstChild?r.firstChild=e:t.prev.next=e,e.prev=t.prev,e.next=t,t.prev=e):(t===r.lastChild?r.lastChild=e:t.next.prev=e,e.next=t.next,e.prev=t,t.next=e),e.parent=r,e},getAll:function(t){var n=this,r,i=[];for(r=n.firstChild;r;r=e(r,n))r.name===t&&i.push(r);return i},empty:function(){var t=this,n,r,i;if(t.firstChild){for(n=[],i=t.firstChild;i;i=e(i,t))n.push(i);for(r=n.length;r--;)i=n[r],i.parent=i.firstChild=i.lastChild=i.next=i.prev=null}return t.firstChild=t.lastChild=null,t},isEmpty:function(t){var r=this,i=r.firstChild,o,a;if(i)do{if(1===i.type){if(i.attributes.map["data-mce-bogus"])continue;if(t[i.name])return!1;for(o=i.attributes.length;o--;)if(a=i.attributes[o].name,"name"===a||0===a.indexOf("data-mce-bookmark"))return!1}if(8===i.type)return!1;if(3===i.type&&!n.test(i.value))return!1}while(i=e(i,r));return!0},walk:function(t){return e(this,null,t)}},t.create=function(e,n){var i,o;if(i=new t(e,r[e]||1),n)for(o in n)i.attr(o,n[o]);return i},t}),r(E,[d],function(e){function t(e,t){return e?e.split(t||" "):[]}function n(e){function n(e,n,r){function i(e,t){var n={},r,i;for(r=0,i=e.length;i>r;r++)n[e[r]]=t||{};return n}var s,c,u,d=arguments;for(r=r||[],n=n||"","string"==typeof r&&(r=t(r)),c=3;c<d.length;c++)"string"==typeof d[c]&&(d[c]=t(d[c])),r.push.apply(r,d[c]);for(e=t(e),s=e.length;s--;)u=[].concat(l,t(n)),a[e[s]]={attributes:i(u),attributesOrder:u,children:i(r,o)}}function r(e,n){var r,i,o,s;for(e=t(e),r=e.length,n=t(n);r--;)for(i=a[e[r]],o=0,s=n.length;s>o;o++)i.attributes[n[o]]={},i.attributesOrder.push(n[o])}var a={},l,c,u,d,f,p;return i[e]?i[e]:(l=t("id accesskey class dir lang style tabindex title"),c=t("address blockquote div dl fieldset form h1 h2 h3 h4 h5 h6 hr menu ol p pre table ul"),u=t("a abbr b bdo br button cite code del dfn em embed i iframe img input ins kbd label map noscript object q s samp script select small span strong sub sup textarea u var #text #comment"),"html4"!=e&&(l.push.apply(l,t("contenteditable contextmenu draggable dropzone hidden spellcheck translate")),c.push.apply(c,t("article aside details dialog figure header footer hgroup section nav")),u.push.apply(u,t("audio canvas command datalist mark meter output progress time wbr video ruby bdi keygen"))),"html5-strict"!=e&&(l.push("xml:lang"),p=t("acronym applet basefont big font strike tt"),u.push.apply(u,p),s(p,function(e){n(e,"",u)}),f=t("center dir isindex noframes"),c.push.apply(c,f),d=[].concat(c,u),s(f,function(e){n(e,"",d)})),d=d||[].concat(c,u),n("html","manifest","head body"),n("head","","base command link meta noscript script style title"),n("title hr noscript br"),n("base","href target"),n("link","href rel media hreflang type sizes hreflang"),n("meta","name http-equiv content charset"),n("style","media type scoped"),n("script","src async defer type charset"),n("body","onafterprint onbeforeprint onbeforeunload onblur onerror onfocus onhashchange onload onmessage onoffline ononline onpagehide onpageshow onpopstate onresize onscroll onstorage onunload",d),n("address dt dd div caption","",d),n("h1 h2 h3 h4 h5 h6 pre p abbr code var samp kbd sub sup i b u bdo span legend em strong small s cite dfn","",u),n("blockquote","cite",d),n("ol","reversed start type","li"),n("ul","","li"),n("li","value",d),n("dl","","dt dd"),n("a","href target rel media hreflang type",u),n("q","cite",u),n("ins del","cite datetime",d),n("img","src srcset alt usemap ismap width height"),n("iframe","src name width height",d),n("embed","src type width height"),n("object","data type typemustmatch name usemap form width height",d,"param"),n("param","name value"),n("map","name",d,"area"),n("area","alt coords shape href target rel media hreflang type"),n("table","border","caption colgroup thead tfoot tbody tr"+("html4"==e?" col":"")),n("colgroup","span","col"),n("col","span"),n("tbody thead tfoot","","tr"),n("tr","","td th"),n("td","colspan rowspan headers",d),n("th","colspan rowspan headers scope abbr",d),n("form","accept-charset action autocomplete enctype method name novalidate target",d),n("fieldset","disabled form name",d,"legend"),n("label","form for",u),n("input","accept alt autocomplete checked dirname disabled form formaction formenctype formmethod formnovalidate formtarget height list max maxlength min multiple name pattern readonly required size src step type value width"),n("button","disabled form formaction formenctype formmethod formnovalidate formtarget name type value","html4"==e?d:u),n("select","disabled form multiple name required size","option optgroup"),n("optgroup","disabled label","option"),n("option","disabled label selected value"),n("textarea","cols dirname disabled form maxlength name readonly required rows wrap"),n("menu","type label",d,"li"),n("noscript","",d),"html4"!=e&&(n("wbr"),n("ruby","",u,"rt rp"),n("figcaption","",d),n("mark rt rp summary bdi","",u),n("canvas","width height",d),n("video","src crossorigin poster preload autoplay mediagroup loop muted controls width height buffered",d,"track source"),n("audio","src crossorigin preload autoplay mediagroup loop muted controls buffered volume",d,"track source"),n("picture","","img source"),n("source","src srcset type media sizes"),n("track","kind src srclang label default"),n("datalist","",u,"option"),n("article section nav aside header footer","",d),n("hgroup","","h1 h2 h3 h4 h5 h6"),n("figure","",d,"figcaption"),n("time","datetime",u),n("dialog","open",d),n("command","type label icon disabled checked radiogroup command"),n("output","for form name",u),n("progress","value max",u),n("meter","value min max low high optimum",u),n("details","open",d,"summary"),n("keygen","autofocus challenge disabled form keytype name")),"html5-strict"!=e&&(r("script","language xml:space"),r("style","xml:space"),r("object","declare classid code codebase codetype archive standby align border hspace vspace"),r("embed","align name hspace vspace"),r("param","valuetype type"),r("a","charset name rev shape coords"),r("br","clear"),r("applet","codebase archive code object alt name width height align hspace vspace"),r("img","name longdesc align border hspace vspace"),r("iframe","longdesc frameborder marginwidth marginheight scrolling align"),r("font basefont","size color face"),r("input","usemap align"),r("select","onchange"),r("textarea"),r("h1 h2 h3 h4 h5 h6 div p legend caption","align"),r("ul","type compact"),r("li","type"),r("ol dl menu dir","compact"),r("pre","width xml:space"),r("hr","align noshade size width"),r("isindex","prompt"),r("table","summary width frame rules cellspacing cellpadding align bgcolor"),r("col","width align char charoff valign"),r("colgroup","width align char charoff valign"),r("thead","align char charoff valign"),r("tr","align char charoff valign bgcolor"),r("th","axis align char charoff valign nowrap bgcolor width height"),r("form","accept"),r("td","abbr axis scope align char charoff valign nowrap bgcolor width height"),r("tfoot","align char charoff valign"),r("tbody","align char charoff valign"),r("area","nohref"),r("body","background bgcolor text link vlink alink")),"html4"!=e&&(r("input button select textarea","autofocus"),r("input textarea","placeholder"),r("a","download"),r("link script img","crossorigin"),r("iframe","sandbox seamless allowfullscreen")),s(t("a form meter progress dfn"),function(e){a[e]&&delete a[e].children[e]}),delete a.caption.children.table,i[e]=a,a)}function r(e,t){var n;return e&&(n={},"string"==typeof e&&(e={"*":e}),s(e,function(e,r){n[r]="map"==t?a(e,/[, ]/):c(e,/[, ]/)})),n}var i={},o={},a=e.makeMap,s=e.each,l=e.extend,c=e.explode,u=e.inArray;return function(e){function o(t,n,r){var o=e[t];return o?o=a(o,/[, ]/,a(o.toUpperCase(),/[, ]/)):(o=i[t],o||(o=a(n," ",a(n.toUpperCase()," ")),o=l(o,r),i[t]=o)),o}function d(e){return new RegExp("^"+e.replace(/([?+*])/g,".$1")+"$")}function f(e){var n,r,i,o,s,l,c,f,p,h,m,g,v,b,x,w,_,E,N,k=/^([#+\-])?([^\[!\/]+)(?:\/([^\[!]+))?(?:(!?)\[([^\]]+)\])?$/,S=/^([!\-])?(\w+::\w+|[^=:<]+)?(?:([=:<])(.*))?$/,T=/[*?+]/;if(e)for(e=t(e,","),y["@"]&&(w=y["@"].attributes,_=y["@"].attributesOrder),n=0,r=e.length;r>n;n++)if(s=k.exec(e[n])){if(b=s[1],p=s[2],x=s[3],f=s[5],g={},v=[],l={attributes:g,attributesOrder:v},"#"===b&&(l.paddEmpty=!0),"-"===b&&(l.removeEmpty=!0),"!"===s[4]&&(l.removeEmptyAttrs=!0),w){for(E in w)g[E]=w[E];v.push.apply(v,_)}if(f)for(f=t(f,"|"),i=0,o=f.length;o>i;i++)if(s=S.exec(f[i])){if(c={},m=s[1],h=s[2].replace(/::/g,":"),b=s[3],N=s[4],"!"===m&&(l.attributesRequired=l.attributesRequired||[],l.attributesRequired.push(h),c.required=!0),"-"===m){delete g[h],v.splice(u(v,h),1);continue}b&&("="===b&&(l.attributesDefault=l.attributesDefault||[],l.attributesDefault.push({name:h,value:N}),c.defaultValue=N),":"===b&&(l.attributesForced=l.attributesForced||[],l.attributesForced.push({name:h,value:N}),c.forcedValue=N),"<"===b&&(c.validValues=a(N,"?"))),T.test(h)?(l.attributePatterns=l.attributePatterns||[],c.pattern=d(h),l.attributePatterns.push(c)):(g[h]||v.push(h),g[h]=c)}w||"@"!=p||(w=g,_=v),x&&(l.outputName=p,y[x]=l),T.test(p)?(l.pattern=d(p),C.push(l)):y[p]=l}}function p(e){y={},C=[],f(e),s(_,function(e,t){b[t]=e.children})}function h(e){var n=/^(~)?(.+)$/;e&&(i.text_block_elements=i.block_elements=null,s(t(e,","),function(e){var t=n.exec(e),r="~"===t[1],i=r?"span":"div",o=t[2];if(b[o]=b[i],L[o]=i,r||(R[o.toUpperCase()]={},R[o]={}),!y[o]){var a=y[i];a=l({},a),delete a.removeEmptyAttrs,delete a.removeEmpty,y[o]=a}s(b,function(e,t){e[i]&&(b[t]=e=l({},b[t]),e[o]=e[i])})}))}function m(e){var n=/^([+\-]?)(\w+)\[([^\]]+)\]$/;e&&s(t(e,","),function(e){var r=n.exec(e),i,o;r&&(o=r[1],i=o?b[r[2]]:b[r[2]]={"#comment":{}},i=b[r[2]],s(t(r[3],"|"),function(e){"-"===o?(b[r[2]]=i=l({},b[r[2]]),delete i[e]):i[e]={}}))})}function g(e){var t=y[e],n;if(t)return t;for(n=C.length;n--;)if(t=C[n],t.pattern.test(e))return t}var v=this,y={},b={},C=[],x,w,_,E,N,k,S,T,R,A,B,D,L={},H={};e=e||{},_=n(e.schema),e.verify_html===!1&&(e.valid_elements="*[*]"),x=r(e.valid_styles),w=r(e.invalid_styles,"map"),T=r(e.valid_classes,"map"),E=o("whitespace_elements","pre script noscript style textarea video audio iframe object"),N=o("self_closing_elements","colgroup dd dt li option p td tfoot th thead tr"),k=o("short_ended_elements","area base basefont br col frame hr img input isindex link meta param embed source wbr track"),S=o("boolean_attributes","checked compact declare defer disabled ismap multiple nohref noresize noshade nowrap readonly selected autoplay loop controls"),A=o("non_empty_elements","td th iframe video audio object script",k),B=o("text_block_elements","h1 h2 h3 h4 h5 h6 p div address pre form blockquote center dir fieldset header footer article section hgroup aside nav figure"),R=o("block_elements","hr table tbody thead tfoot th tr td li ol ul caption dl dt dd noscript menu isindex option datalist select optgroup",B),D=o("text_inline_elements","span strong b em i font strike u var cite dfn code mark q sup sub samp"),s((e.special||"script noscript style textarea").split(" "),function(e){H[e]=new RegExp("</"+e+"[^>]*>","gi")}),e.valid_elements?p(e.valid_elements):(s(_,function(e,t){y[t]={attributes:e.attributes,attributesOrder:e.attributesOrder},b[t]=e.children}),"html5"!=e.schema&&s(t("strong/b em/i"),function(e){e=t(e,"/"),y[e[1]].outputName=e[0]}),y.img.attributesDefault=[{name:"alt",value:""}],s(t("ol ul sub sup blockquote span font a table tbody tr strong em b i"),function(e){y[e]&&(y[e].removeEmpty=!0)}),s(t("p h1 h2 h3 h4 h5 h6 th td pre div address caption"),function(e){y[e].paddEmpty=!0}),s(t("span"),function(e){y[e].removeEmptyAttrs=!0})),h(e.custom_elements),m(e.valid_children),f(e.extended_valid_elements),m("+ol[ul|ol],+ul[ul|ol]"),e.invalid_elements&&s(c(e.invalid_elements),function(e){y[e]&&delete y[e]}),g("span")||f("span[!data-mce-type|*]"),v.children=b,v.getValidStyles=function(){return x},v.getInvalidStyles=function(){return w},v.getValidClasses=function(){return T},v.getBoolAttrs=function(){return S},v.getBlockElements=function(){return R},v.getTextBlockElements=function(){return B},v.getTextInlineElements=function(){return D},v.getShortEndedElements=function(){return k},v.getSelfClosingElements=function(){return N},v.getNonEmptyElements=function(){return A},v.getWhiteSpaceElements=function(){return E},v.getSpecialElements=function(){return H},v.isValidChild=function(e,t){var n=b[e];return!(!n||!n[t])},v.isValid=function(e,t){var n,r,i=g(e);if(i){if(!t)return!0;if(i.attributes[t])return!0;if(n=i.attributePatterns)for(r=n.length;r--;)if(n[r].pattern.test(e))return!0}return!1},v.getElementRule=g,v.getCustomElements=function(){return L},v.addValidElements=f,v.setValidElements=p,v.addCustomElements=h,v.addValidChildren=m,v.elements=y}}),r(N,[E,g,d],function(e,t,n){function r(e,t,n){var r=1,i,o,a,s;for(s=e.getShortEndedElements(),a=/<([!?\/])?([A-Za-z0-9\-_\:\.]+)((?:\s+[^"\'>]+(?:(?:"[^"]*")|(?:\'[^\']*\')|[^>]*))*|\/|\s+)>/g,a.lastIndex=i=n;o=a.exec(t);){if(i=a.lastIndex,"/"===o[1])r--;else if(!o[1]){if(o[2]in s)continue;r++}if(0===r)break}return i}function i(i,a){function s(){}var l=this;i=i||{},l.schema=a=a||new e,i.fix_self_closing!==!1&&(i.fix_self_closing=!0),o("comment cdata text start end pi doctype".split(" "),function(e){e&&(l[e]=i[e]||s)}),l.parse=function(e){function o(e){var t,n;for(t=p.length;t--&&p[t].name!==e;);if(t>=0){for(n=p.length-1;n>=t;n--)e=p[n],e.valid&&l.end(e.name);p.length=t}}function s(e,t,n,r,o){var a,s,l=/[\s\u0000-\u001F]+/g;if(t=t.toLowerCase(),n=t in x?t:z(n||r||o||""),_&&!y&&0!==t.indexOf("data-")){if(a=T[t],!a&&R){for(s=R.length;s--&&(a=R[s],!a.pattern.test(t)););-1===s&&(a=null)}if(!a)return;if(a.validValues&&!(n in a.validValues))return}if(V[t]&&!i.allow_script_urls){var c=n.replace(l,"");try{c=decodeURIComponent(c)}catch(u){c=unescape(c)}if(U.test(c))return;if(!i.allow_html_data_urls&&$.test(c)&&!/^data:image\//i.test(c))return}h.map[t]=n,h.push({name:t,value:n})}var l=this,c,u=0,d,f,p=[],h,m,g,v,y,b,C,x,w,_,E,N,k,S,T,R,A,B,D,L,H,M,P,O,I,F=0,z=t.decode,W,V=n.makeMap("src,href,data,background,formaction,poster"),U=/((java|vb)script|mhtml):/i,$=/^data:/i;for(M=new RegExp("<(?:(?:!--([\\w\\W]*?)-->)|(?:!\\[CDATA\\[([\\w\\W]*?)\\]\\]>)|(?:!DOCTYPE([\\w\\W]*?)>)|(?:\\?([^\\s\\/<>]+) ?([\\w\\W]*?)[?/]>)|(?:\\/([^>]+)>)|(?:([A-Za-z0-9\\-_\\:\\.]+)((?:\\s+[^\"'>]+(?:(?:\"[^\"]*\")|(?:'[^']*')|[^>]*))*|\\/|\\s+)>))","g"),P=/([\w:\-]+)(?:\s*=\s*(?:(?:\"((?:[^\"])*)\")|(?:\'((?:[^\'])*)\')|([^>\s]+)))?/g,C=a.getShortEndedElements(),H=i.self_closing_elements||a.getSelfClosingElements(),x=a.getBoolAttrs(),_=i.validate,b=i.remove_internals,W=i.fix_self_closing,O=a.getSpecialElements();c=M.exec(e);){if(u<c.index&&l.text(z(e.substr(u,c.index-u))),d=c[6])d=d.toLowerCase(),":"===d.charAt(0)&&(d=d.substr(1)),o(d);else if(d=c[7]){if(d=d.toLowerCase(),":"===d.charAt(0)&&(d=d.substr(1)),w=d in C,W&&H[d]&&p.length>0&&p[p.length-1].name===d&&o(d),!_||(E=a.getElementRule(d))){if(N=!0,_&&(T=E.attributes,R=E.attributePatterns),(S=c[8])?(y=-1!==S.indexOf("data-mce-type"),y&&b&&(N=!1),h=[],h.map={},S.replace(P,s)):(h=[],h.map={}),_&&!y){if(A=E.attributesRequired,B=E.attributesDefault,D=E.attributesForced,L=E.removeEmptyAttrs,L&&!h.length&&(N=!1),D)for(m=D.length;m--;)k=D[m],v=k.name,I=k.value,"{$uid}"===I&&(I="mce_"+F++),h.map[v]=I,h.push({name:v,value:I});if(B)for(m=B.length;m--;)k=B[m],v=k.name,v in h.map||(I=k.value,"{$uid}"===I&&(I="mce_"+F++),h.map[v]=I,h.push({name:v,value:I}));if(A){for(m=A.length;m--&&!(A[m]in h.map););-1===m&&(N=!1)}if(k=h.map["data-mce-bogus"]){if("all"===k){u=r(a,e,M.lastIndex),M.lastIndex=u;continue}N=!1}}N&&l.start(d,h,w)}else N=!1;if(f=O[d]){f.lastIndex=u=c.index+c[0].length,(c=f.exec(e))?(N&&(g=e.substr(u,c.index-u)),u=c.index+c[0].length):(g=e.substr(u),u=e.length),N&&(g.length>0&&l.text(g,!0),l.end(d)),M.lastIndex=u;continue}w||(S&&S.indexOf("/")==S.length-1?N&&l.end(d):p.push({name:d,valid:N}))}else(d=c[1])?(">"===d.charAt(0)&&(d=" "+d),i.allow_conditional_comments||"[if"!==d.substr(0,3)||(d=" "+d),l.comment(d)):(d=c[2])?l.cdata(d):(d=c[3])?l.doctype(d):(d=c[4])&&l.pi(d,c[5]);u=c.index+c[0].length}for(u<e.length&&l.text(z(e.substr(u))),m=p.length-1;m>=0;m--)d=p[m],d.valid&&l.end(d.name)}}var o=n.each;return i.findEndTag=r,i}),r(k,[_,E,N,d],function(e,t,n,r){var i=r.makeMap,o=r.each,a=r.explode,s=r.extend;return function(r,l){function c(t){var n,r,o,a,s,c,d,f,p,h,m,g,v,y;for(m=i("tr,td,th,tbody,thead,tfoot,table"),h=l.getNonEmptyElements(),g=l.getTextBlockElements(),n=0;n<t.length;n++)if(r=t[n],r.parent&&!r.fixed)if(g[r.name]&&"li"==r.parent.name){for(v=r.next;v&&g[v.name];)v.name="li",v.fixed=!0,r.parent.insert(v,r.parent),v=v.next;r.unwrap(r)}else{for(a=[r],o=r.parent;o&&!l.isValidChild(o.name,r.name)&&!m[o.name];o=o.parent)a.push(o);if(o&&a.length>1){for(a.reverse(),s=c=u.filterNode(a[0].clone()),p=0;p<a.length-1;p++){for(l.isValidChild(c.name,a[p].name)?(d=u.filterNode(a[p].clone()),c.append(d)):d=c,f=a[p].firstChild;f&&f!=a[p+1];)y=f.next,d.append(f),f=y;c=d}s.isEmpty(h)?o.insert(r,a[0],!0):(o.insert(s,a[0],!0),o.insert(r,s)),o=a[0],(o.isEmpty(h)||o.firstChild===o.lastChild&&"br"===o.firstChild.name)&&o.empty().remove()}else if(r.parent){if("li"===r.name){if(v=r.prev,v&&("ul"===v.name||"ul"===v.name)){v.append(r);continue}if(v=r.next,v&&("ul"===v.name||"ul"===v.name)){v.insert(r,v.firstChild,!0);continue}r.wrap(u.filterNode(new e("ul",1)));continue}l.isValidChild(r.parent.name,"div")&&l.isValidChild("div",r.name)?r.wrap(u.filterNode(new e("div",1))):"style"===r.name||"script"===r.name?r.empty().remove():r.unwrap()}}}var u=this,d={},f=[],p={},h={};r=r||{},r.validate="validate"in r?r.validate:!0,r.root_name=r.root_name||"body",u.schema=l=l||new t,u.filterNode=function(e){var t,n,r;n in d&&(r=p[n],r?r.push(e):p[n]=[e]),t=f.length;for(;t--;)n=f[t].name,n in e.attributes.map&&(r=h[n],r?r.push(e):h[n]=[e]);return e},u.addNodeFilter=function(e,t){o(a(e),function(e){var n=d[e];n||(d[e]=n=[]),n.push(t)})},u.addAttributeFilter=function(e,t){o(a(e),function(e){var n;for(n=0;n<f.length;n++)if(f[n].name===e)return void f[n].callbacks.push(t);f.push({name:e,callbacks:[t]})})},u.parse=function(t,o){function a(){function e(e){e&&(t=e.firstChild,t&&3==t.type&&(t.value=t.value.replace(R,"")),t=e.lastChild,t&&3==t.type&&(t.value=t.value.replace(D,"")))}var t=y.firstChild,n,i;if(l.isValidChild(y.name,I.toLowerCase())){for(;t;)n=t.next,3==t.type||1==t.type&&"p"!==t.name&&!T[t.name]&&!t.attr("data-mce-type")?i?i.append(t):(i=u(I,1),i.attr(r.forced_root_block_attrs),y.insert(i,t),i.append(t)):(e(i),i=null),t=n;e(i)}}function u(t,n){var r=new e(t,n),i;return t in d&&(i=p[t],i?i.push(r):p[t]=[r]),r}function m(e){var t,n,r;for(t=e.prev;t&&3===t.type;)n=t.value.replace(D,""),n.length>0?(t.value=n,t=t.prev):(r=t.prev,t.remove(),t=r)}function g(e){var t,n={};for(t in e)"li"!==t&&"p"!=t&&(n[t]=e[t]);return n}var v,y,b,C,x,w,_,E,N,k,S,T,R,A=[],B,D,L,H,M,P,O,I;if(o=o||{},p={},h={},T=s(i("script,style,head,html,body,title,meta,param"),l.getBlockElements()),O=l.getNonEmptyElements(),P=l.children,S=r.validate,I="forced_root_block"in o?o.forced_root_block:r.forced_root_block,M=l.getWhiteSpaceElements(),R=/^[ \t\r\n]+/,D=/[ \t\r\n]+$/,L=/[ \t\r\n]+/g,H=/^[ \t\r\n]+$/,v=new n({validate:S,allow_script_urls:r.allow_script_urls,allow_conditional_comments:r.allow_conditional_comments,self_closing_elements:g(l.getSelfClosingElements()),cdata:function(e){b.append(u("#cdata",4)).value=e},text:function(e,t){var n;B||(e=e.replace(L," "),b.lastChild&&T[b.lastChild.name]&&(e=e.replace(R,""))),0!==e.length&&(n=u("#text",3),n.raw=!!t,b.append(n).value=e)},comment:function(e){b.append(u("#comment",8)).value=e},pi:function(e,t){b.append(u(e,7)).value=t,m(b)},doctype:function(e){var t;t=b.append(u("#doctype",10)),t.value=e,m(b)},start:function(e,t,n){var r,i,o,a,s;if(o=S?l.getElementRule(e):{}){for(r=u(o.outputName||e,1),r.attributes=t,r.shortEnded=n,b.append(r),s=P[b.name],s&&P[r.name]&&!s[r.name]&&A.push(r),i=f.length;i--;)a=f[i].name,a in t.map&&(N=h[a],N?N.push(r):h[a]=[r]);T[e]&&m(r),n||(b=r),!B&&M[e]&&(B=!0)}},end:function(t){var n,r,i,o,a;if(r=S?l.getElementRule(t):{}){if(T[t]&&!B){if(n=b.firstChild,n&&3===n.type)if(i=n.value.replace(R,""),i.length>0)n.value=i,n=n.next;else for(o=n.next,n.remove(),n=o;n&&3===n.type;)i=n.value,o=n.next,(0===i.length||H.test(i))&&(n.remove(),n=o),n=o;if(n=b.lastChild,n&&3===n.type)if(i=n.value.replace(D,""),i.length>0)n.value=i,n=n.prev;else for(o=n.prev,n.remove(),n=o;n&&3===n.type;)i=n.value,o=n.prev,(0===i.length||H.test(i))&&(n.remove(),n=o),n=o}if(B&&M[t]&&(B=!1),(r.removeEmpty||r.paddEmpty)&&b.isEmpty(O))if(r.paddEmpty)b.empty().append(new e("#text","3")).value="\xa0";else if(!b.attributes.map.name&&!b.attributes.map.id)return a=b.parent,T[b.name]?b.empty().remove():b.unwrap(),void(b=a);
b=b.parent}}},l),y=b=new e(o.context||r.root_name,11),v.parse(t),S&&A.length&&(o.context?o.invalid=!0:c(A)),I&&("body"==y.name||o.isRootContent)&&a(),!o.invalid){for(k in p){for(N=d[k],C=p[k],_=C.length;_--;)C[_].parent||C.splice(_,1);for(x=0,w=N.length;w>x;x++)N[x](C,k,o)}for(x=0,w=f.length;w>x;x++)if(N=f[x],N.name in h){for(C=h[N.name],_=C.length;_--;)C[_].parent||C.splice(_,1);for(_=0,E=N.callbacks.length;E>_;_++)N.callbacks[_](C,N.name,o)}}return y},r.remove_trailing_brs&&u.addNodeFilter("br",function(t){var n,r=t.length,i,o=s({},l.getBlockElements()),a=l.getNonEmptyElements(),c,u,d,f,p,h;for(o.body=1,n=0;r>n;n++)if(i=t[n],c=i.parent,o[i.parent.name]&&i===c.lastChild){for(d=i.prev;d;){if(f=d.name,"span"!==f||"bookmark"!==d.attr("data-mce-type")){if("br"!==f)break;if("br"===f){i=null;break}}d=d.prev}i&&(i.remove(),c.isEmpty(a)&&(p=l.getElementRule(c.name),p&&(p.removeEmpty?c.remove():p.paddEmpty&&(c.empty().append(new e("#text",3)).value="\xa0"))))}else{for(u=i;c&&c.firstChild===u&&c.lastChild===u&&(u=c,!o[c.name]);)c=c.parent;u===c&&(h=new e("#text",3),h.value="\xa0",i.replace(h))}}),r.allow_html_in_named_anchor||u.addAttributeFilter("id,name",function(e){for(var t=e.length,n,r,i,o;t--;)if(o=e[t],"a"===o.name&&o.firstChild&&!o.attr("href")){i=o.parent,n=o.lastChild;do r=n.prev,i.insert(n,o),n=r;while(n)}}),r.validate&&l.getValidClasses()&&u.addAttributeFilter("class",function(e){for(var t=e.length,n,r,i,o,a,s=l.getValidClasses(),c,u;t--;){for(n=e[t],r=n.attr("class").split(" "),a="",i=0;i<r.length;i++)o=r[i],u=!1,c=s["*"],c&&c[o]&&(u=!0),c=s[n.name],u||!c||c[o]||(u=!0),u&&(a&&(a+=" "),a+=o);a.length||(a=null),n.attr("class",a)}})}}),r(S,[g,d],function(e,t){var n=t.makeMap;return function(t){var r=[],i,o,a,s,l;return t=t||{},i=t.indent,o=n(t.indent_before||""),a=n(t.indent_after||""),s=e.getEncodeFunc(t.entity_encoding||"raw",t.entities),l="html"==t.element_format,{start:function(e,t,n){var c,u,d,f;if(i&&o[e]&&r.length>0&&(f=r[r.length-1],f.length>0&&"\n"!==f&&r.push("\n")),r.push("<",e),t)for(c=0,u=t.length;u>c;c++)d=t[c],r.push(" ",d.name,'="',s(d.value,!0),'"');r[r.length]=!n||l?">":" />",n&&i&&a[e]&&r.length>0&&(f=r[r.length-1],f.length>0&&"\n"!==f&&r.push("\n"))},end:function(e){var t;r.push("</",e,">"),i&&a[e]&&r.length>0&&(t=r[r.length-1],t.length>0&&"\n"!==t&&r.push("\n"))},text:function(e,t){e.length>0&&(r[r.length]=t?e:s(e))},cdata:function(e){r.push("<![CDATA[",e,"]]>")},comment:function(e){r.push("<!--",e,"-->")},pi:function(e,t){t?r.push("<?",e," ",t,"?>"):r.push("<?",e,"?>"),i&&r.push("\n")},doctype:function(e){r.push("<!DOCTYPE",e,">",i?"\n":"")},reset:function(){r.length=0},getContent:function(){return r.join("").replace(/\n$/,"")}}}}),r(T,[S,E],function(e,t){return function(n,r){var i=this,o=new e(n);n=n||{},n.validate="validate"in n?n.validate:!0,i.schema=r=r||new t,i.writer=o,i.serialize=function(e){function t(e){var n=i[e.type],s,l,c,u,d,f,p,h,m;if(n)n(e);else{if(s=e.name,l=e.shortEnded,c=e.attributes,a&&c&&c.length>1){for(f=[],f.map={},m=r.getElementRule(e.name),p=0,h=m.attributesOrder.length;h>p;p++)u=m.attributesOrder[p],u in c.map&&(d=c.map[u],f.map[u]=d,f.push({name:u,value:d}));for(p=0,h=c.length;h>p;p++)u=c[p].name,u in f.map||(d=c.map[u],f.map[u]=d,f.push({name:u,value:d}));c=f}if(o.start(e.name,c,l),!l){if(e=e.firstChild)do t(e);while(e=e.next);o.end(s)}}}var i,a;return a=n.validate,i={3:function(e){o.text(e.value,e.raw)},8:function(e){o.comment(e.value)},7:function(e){o.pi(e.name,e.value)},10:function(e){o.doctype(e.value)},4:function(e){o.cdata(e.value)},11:function(e){if(e=e.firstChild)do t(e);while(e=e.next)}},o.reset(),1!=e.type||n.inner?i[11](e):t(e),o.getContent()}}}),r(R,[y,k,g,T,_,E,u,d],function(e,t,n,r,i,o,a,s){var l=s.each,c=s.trim,u=e.DOM;return function(e,i){var s,d,f;return i&&(s=i.dom,d=i.schema),s=s||u,d=d||new o(e),e.entity_encoding=e.entity_encoding||"named",e.remove_trailing_brs="remove_trailing_brs"in e?e.remove_trailing_brs:!0,f=new t(e,d),f.addAttributeFilter("data-mce-tabindex",function(e,t){for(var n=e.length,r;n--;)r=e[n],r.attr("tabindex",r.attributes.map["data-mce-tabindex"]),r.attr(t,null)}),f.addAttributeFilter("src,href,style",function(t,n){for(var r=t.length,i,o,a="data-mce-"+n,l=e.url_converter,c=e.url_converter_scope,u;r--;)i=t[r],o=i.attributes.map[a],o!==u?(i.attr(n,o.length>0?o:null),i.attr(a,null)):(o=i.attributes.map[n],"style"===n?o=s.serializeStyle(s.parseStyle(o),i.name):l&&(o=l.call(c,o,n,i.name)),i.attr(n,o.length>0?o:null))}),f.addAttributeFilter("class",function(e){for(var t=e.length,n,r;t--;)n=e[t],r=n.attr("class"),r&&(r=n.attr("class").replace(/(?:^|\s)mce-item-\w+(?!\S)/g,""),n.attr("class",r.length>0?r:null))}),f.addAttributeFilter("data-mce-type",function(e,t,n){for(var r=e.length,i;r--;)i=e[r],"bookmark"!==i.attributes.map["data-mce-type"]||n.cleanup||i.remove()}),f.addNodeFilter("noscript",function(e){for(var t=e.length,r;t--;)r=e[t].firstChild,r&&(r.value=n.decode(r.value))}),f.addNodeFilter("script,style",function(e,t){function n(e){return e.replace(/(<!--\[CDATA\[|\]\]-->)/g,"\n").replace(/^[\r\n]*|[\r\n]*$/g,"").replace(/^\s*((<!--)?(\s*\/\/)?\s*<!\[CDATA\[|(<!--\s*)?\/\*\s*<!\[CDATA\[\s*\*\/|(\/\/)?\s*<!--|\/\*\s*<!--\s*\*\/)\s*[\r\n]*/gi,"").replace(/\s*(\/\*\s*\]\]>\s*\*\/(-->)?|\s*\/\/\s*\]\]>(-->)?|\/\/\s*(-->)?|\]\]>|\/\*\s*-->\s*\*\/|\s*-->\s*)\s*$/g,"")}for(var r=e.length,i,o,a;r--;)i=e[r],o=i.firstChild?i.firstChild.value:"","script"===t?(a=i.attr("type"),a&&i.attr("type","mce-no/type"==a?null:a.replace(/^mce\-/,"")),o.length>0&&(i.firstChild.value="// <![CDATA[\n"+n(o)+"\n// ]]>")):o.length>0&&(i.firstChild.value="<!--\n"+n(o)+"\n-->")}),f.addNodeFilter("#comment",function(e){for(var t=e.length,n;t--;)n=e[t],0===n.value.indexOf("[CDATA[")?(n.name="#cdata",n.type=4,n.value=n.value.replace(/^\[CDATA\[|\]\]$/g,"")):0===n.value.indexOf("mce:protected ")&&(n.name="#text",n.type=3,n.raw=!0,n.value=unescape(n.value).substr(14))}),f.addNodeFilter("xml:namespace,input",function(e,t){for(var n=e.length,r;n--;)r=e[n],7===r.type?r.remove():1===r.type&&("input"!==t||"type"in r.attributes.map||r.attr("type","text"))}),e.fix_list_elements&&f.addNodeFilter("ul,ol",function(e){for(var t=e.length,n,r;t--;)n=e[t],r=n.parent,("ul"===r.name||"ol"===r.name)&&n.prev&&"li"===n.prev.name&&n.prev.append(n)}),f.addAttributeFilter("data-mce-src,data-mce-href,data-mce-style,data-mce-selected,data-mce-expando,data-mce-type,data-mce-resize",function(e,t){for(var n=e.length;n--;)e[n].attr(t,null)}),{schema:d,addNodeFilter:f.addNodeFilter,addAttributeFilter:f.addAttributeFilter,serialize:function(t,n){var i=this,o,u,p,h,m;return a.ie&&s.select("script,style,select,map").length>0?(m=t.innerHTML,t=t.cloneNode(!1),s.setHTML(t,m)):t=t.cloneNode(!0),o=t.ownerDocument.implementation,o.createHTMLDocument&&(u=o.createHTMLDocument(""),l("BODY"==t.nodeName?t.childNodes:[t],function(e){u.body.appendChild(u.importNode(e,!0))}),t="BODY"!=t.nodeName?u.body.firstChild:u.body,p=s.doc,s.doc=u),n=n||{},n.format=n.format||"html",n.selection&&(n.forced_root_block=""),n.no_events||(n.node=t,i.onPreProcess(n)),h=new r(e,d),n.content=h.serialize(f.parse(c(n.getInner?t.innerHTML:s.getOuterHTML(t)),n)),n.cleanup||(n.content=n.content.replace(/\uFEFF/g,"")),n.no_events||i.onPostProcess(n),p&&(s.doc=p),n.node=null,n.content},addRules:function(e){d.addValidElements(e)},setRules:function(e){d.setValidElements(e)},onPreProcess:function(e){i&&i.fire("PreProcess",e)},onPostProcess:function(e){i&&i.fire("PostProcess",e)}}}}),r(A,[],function(){function e(e){function t(t,n){var r,i=0,o,a,s,l,c,u,d=-1,f;if(r=t.duplicate(),r.collapse(n),f=r.parentElement(),f.ownerDocument===e.dom.doc){for(;"false"===f.contentEditable;)f=f.parentNode;if(!f.hasChildNodes())return{node:f,inside:1};for(s=f.children,o=s.length-1;o>=i;)if(u=Math.floor((i+o)/2),l=s[u],r.moveToElementText(l),d=r.compareEndPoints(n?"StartToStart":"EndToEnd",t),d>0)o=u-1;else{if(!(0>d))return{node:l};i=u+1}if(0>d)for(l?r.collapse(!1):(r.moveToElementText(f),r.collapse(!0),l=f,a=!0),c=0;0!==r.compareEndPoints(n?"StartToStart":"StartToEnd",t)&&0!==r.move("character",1)&&f==r.parentElement();)c++;else for(r.collapse(!0),c=0;0!==r.compareEndPoints(n?"StartToStart":"StartToEnd",t)&&0!==r.move("character",-1)&&f==r.parentElement();)c++;return{node:l,position:d,offset:c,inside:a}}}function n(){function n(e){var n=t(o,e),r,i,s=0,l,c,u;if(r=n.node,i=n.offset,n.inside&&!r.hasChildNodes())return void a[e?"setStart":"setEnd"](r,0);if(i===c)return void a[e?"setStartBefore":"setEndAfter"](r);if(n.position<0){if(l=n.inside?r.firstChild:r.nextSibling,!l)return void a[e?"setStartAfter":"setEndAfter"](r);if(!i)return void(3==l.nodeType?a[e?"setStart":"setEnd"](l,0):a[e?"setStartBefore":"setEndBefore"](l));for(;l;){if(3==l.nodeType&&(u=l.nodeValue,s+=u.length,s>=i)){r=l,s-=i,s=u.length-s;break}l=l.nextSibling}}else{if(l=r.previousSibling,!l)return a[e?"setStartBefore":"setEndBefore"](r);if(!i)return void(3==r.nodeType?a[e?"setStart":"setEnd"](l,r.nodeValue.length):a[e?"setStartAfter":"setEndAfter"](l));for(;l;){if(3==l.nodeType&&(s+=l.nodeValue.length,s>=i)){r=l,s-=i;break}l=l.previousSibling}}a[e?"setStart":"setEnd"](r,s)}var o=e.getRng(),a=i.createRng(),s,l,c,u,d;if(s=o.item?o.item(0):o.parentElement(),s.ownerDocument!=i.doc)return a;if(l=e.isCollapsed(),o.item)return a.setStart(s.parentNode,i.nodeIndex(s)),a.setEnd(a.startContainer,a.startOffset+1),a;try{n(!0),l||n()}catch(f){if(-2147024809!=f.number)throw f;d=r.getBookmark(2),c=o.duplicate(),c.collapse(!0),s=c.parentElement(),l||(c=o.duplicate(),c.collapse(!1),u=c.parentElement(),u.innerHTML=u.innerHTML),s.innerHTML=s.innerHTML,r.moveToBookmark(d),o=e.getRng(),n(!0),l||n()}return a}var r=this,i=e.dom,o=!1;this.getBookmark=function(n){function r(e){var t,n,r,o,a=[];for(t=e.parentNode,n=i.getRoot().parentNode;t!=n&&9!==t.nodeType;){for(r=t.children,o=r.length;o--;)if(e===r[o]){a.push(o);break}e=t,t=t.parentNode}return a}function o(e){var n;return n=t(a,e),n?{position:n.position,offset:n.offset,indexes:r(n.node),inside:n.inside}:void 0}var a=e.getRng(),s={};return 2===n&&(a.item?s.start={ctrl:!0,indexes:r(a.item(0))}:(s.start=o(!0),e.isCollapsed()||(s.end=o()))),s},this.moveToBookmark=function(e){function t(e){var t,n,r,o;for(t=i.getRoot(),n=e.length-1;n>=0;n--)o=t.children,r=e[n],r<=o.length-1&&(t=o[r]);return t}function n(n){var i=e[n?"start":"end"],a,s,l,c;i&&(a=i.position>0,s=o.createTextRange(),s.moveToElementText(t(i.indexes)),c=i.offset,c!==l?(s.collapse(i.inside||a),s.moveStart("character",a?-c:c)):s.collapse(n),r.setEndPoint(n?"StartToStart":"EndToStart",s),n&&r.collapse(!0))}var r,o=i.doc.body;e.start&&(e.start.ctrl?(r=o.createControlRange(),r.addElement(t(e.start.indexes)),r.select()):(r=o.createTextRange(),n(!0),n(),r.select()))},this.addRange=function(t){function n(e){var t,n,a,d,h;a=i.create("a"),t=e?s:c,n=e?l:u,d=r.duplicate(),(t==f||t==f.documentElement)&&(t=p,n=0),3==t.nodeType?(t.parentNode.insertBefore(a,t),d.moveToElementText(a),d.moveStart("character",n),i.remove(a),r.setEndPoint(e?"StartToStart":"EndToEnd",d)):(h=t.childNodes,h.length?(n>=h.length?i.insertAfter(a,h[h.length-1]):t.insertBefore(a,h[n]),d.moveToElementText(a)):t.canHaveHTML&&(t.innerHTML="<span>&#xFEFF;</span>",a=t.firstChild,d.moveToElementText(a),d.collapse(o)),r.setEndPoint(e?"StartToStart":"EndToEnd",d),i.remove(a))}var r,a,s,l,c,u,d,f=e.dom.doc,p=f.body,h,m;if(s=t.startContainer,l=t.startOffset,c=t.endContainer,u=t.endOffset,r=p.createTextRange(),s==c&&1==s.nodeType){if(l==u&&!s.hasChildNodes()){if(s.canHaveHTML)return d=s.previousSibling,d&&!d.hasChildNodes()&&i.isBlock(d)?d.innerHTML="&#xFEFF;":d=null,s.innerHTML="<span>&#xFEFF;</span><span>&#xFEFF;</span>",r.moveToElementText(s.lastChild),r.select(),i.doc.selection.clear(),s.innerHTML="",void(d&&(d.innerHTML=""));l=i.nodeIndex(s),s=s.parentNode}if(l==u-1)try{if(m=s.childNodes[l],a=p.createControlRange(),a.addElement(m),a.select(),h=e.getRng(),h.item&&m===h.item(0))return}catch(g){}}n(!0),n(),r.select()},this.getRangeAt=n}return e}),r(B,[u],function(e){return{BACKSPACE:8,DELETE:46,DOWN:40,ENTER:13,LEFT:37,RIGHT:39,SPACEBAR:32,TAB:9,UP:38,modifierPressed:function(e){return e.shiftKey||e.ctrlKey||e.altKey||this.metaKeyPressed(e)},metaKeyPressed:function(t){return e.mac?t.metaKey:t.ctrlKey&&!t.altKey}}}),r(D,[B,d,u],function(e,t,n){return function(r,i){function o(e){var t=i.settings.object_resizing;return t===!1||n.iOS?!1:("string"!=typeof t&&(t="table,img,div"),"false"===e.getAttribute("data-mce-resize")?!1:i.dom.is(e,t))}function a(t){var n,r,o,a,s;n=t.screenX-T,r=t.screenY-R,P=n*k[2]+D,O=r*k[3]+L,P=5>P?5:P,O=5>O?5:O,o="IMG"==w.nodeName&&i.settings.resize_img_proportional!==!1?!e.modifierPressed(t):e.modifierPressed(t)||"IMG"==w.nodeName&&k[2]*k[3]!==0,o&&(W(n)>W(r)?(O=V(P*H),P=V(O/H)):(P=V(O/H),O=V(P*H))),C.setStyles(_,{width:P,height:O}),a=k.startPos.x+n,s=k.startPos.y+r,a=a>0?a:0,s=s>0?s:0,C.setStyles(E,{left:a,top:s,display:"block"}),E.innerHTML=P+" &times; "+O,k[2]<0&&_.clientWidth<=P&&C.setStyle(_,"left",A+(D-P)),k[3]<0&&_.clientHeight<=O&&C.setStyle(_,"top",B+(L-O)),n=U.scrollWidth-$,r=U.scrollHeight-q,n+r!==0&&C.setStyles(E,{left:a-n,top:s-r}),M||(i.fire("ObjectResizeStart",{target:w,width:D,height:L}),M=!0)}function s(){function e(e,t){t&&(w.style[e]||!i.schema.isValid(w.nodeName.toLowerCase(),e)?C.setStyle(w,e,t):C.setAttrib(w,e,t))}M=!1,e("width",P),e("height",O),C.unbind(I,"mousemove",a),C.unbind(I,"mouseup",s),F!=I&&(C.unbind(F,"mousemove",a),C.unbind(F,"mouseup",s)),C.remove(_),C.remove(E),z&&"TABLE"!=w.nodeName||l(w),i.fire("ObjectResized",{target:w,width:P,height:O}),C.setAttrib(w,"style",C.getAttrib(w,"style")),i.nodeChanged()}function l(e,t,r){var l,u,d,f,p;g(),l=C.getPos(e,U),A=l.x,B=l.y,p=e.getBoundingClientRect(),u=p.width||p.right-p.left,d=p.height||p.bottom-p.top,w!=e&&(m(),w=e,P=O=0),f=i.fire("ObjectSelected",{target:e}),o(e)&&!f.isDefaultPrevented()?x(N,function(e,i){function o(t){T=t.screenX,R=t.screenY,D=w.clientWidth,L=w.clientHeight,H=L/D,k=e,e.startPos={x:u*e[0]+A,y:d*e[1]+B},$=U.scrollWidth,q=U.scrollHeight,_=w.cloneNode(!0),C.addClass(_,"mce-clonedresizable"),C.setAttrib(_,"data-mce-bogus","all"),_.contentEditable=!1,_.unSelectabe=!0,C.setStyles(_,{left:A,top:B,margin:0}),_.removeAttribute("data-mce-selected"),U.appendChild(_),C.bind(I,"mousemove",a),C.bind(I,"mouseup",s),F!=I&&(C.bind(F,"mousemove",a),C.bind(F,"mouseup",s)),E=C.add(U,"div",{"class":"mce-resize-helper","data-mce-bogus":"all"},D+" &times; "+L)}var l,c;return t?void(i==t&&o(r)):(l=C.get("mceResizeHandle"+i),l?C.show(l):(c=U,l=C.add(c,"div",{id:"mceResizeHandle"+i,"data-mce-bogus":"all","class":"mce-resizehandle",unselectable:!0,style:"cursor:"+i+"-resize; margin:0; padding:0"}),n.ie&&(l.contentEditable=!1)),e.elm||(C.bind(l,"mousedown",function(e){e.stopImmediatePropagation(),e.preventDefault(),o(e)}),e.elm=l),void C.setStyles(l,{left:u*e[0]+A-l.offsetWidth/2,top:d*e[1]+B-l.offsetHeight/2}))}):c(),w.setAttribute("data-mce-selected","1")}function c(){var e,t;g(),w&&w.removeAttribute("data-mce-selected");for(e in N)t=C.get("mceResizeHandle"+e),t&&(C.unbind(t),C.remove(t))}function u(e){function t(e,t){if(e)do if(e===t)return!0;while(e=e.parentNode)}var n,i;if(!M)return x(C.select("img[data-mce-selected],hr[data-mce-selected]"),function(e){e.removeAttribute("data-mce-selected")}),i="mousedown"==e.type?e.target:r.getNode(),i=C.$(i).closest(z?"table":"table,img,hr")[0],t(i,U)&&(v(),n=r.getStart(!0),t(n,i)&&t(r.getEnd(!0),i)&&(!z||i!=n&&"IMG"!==n.nodeName))?void l(i):void c()}function d(e,t,n){e&&e.attachEvent&&e.attachEvent("on"+t,n)}function f(e,t,n){e&&e.detachEvent&&e.detachEvent("on"+t,n)}function p(e){var t=e.srcElement,n,r,o,a,s,c,u;n=t.getBoundingClientRect(),c=S.clientX-n.left,u=S.clientY-n.top;for(r in N)if(o=N[r],a=t.offsetWidth*o[0],s=t.offsetHeight*o[1],W(a-c)<8&&W(s-u)<8){k=o;break}M=!0,i.fire("ObjectResizeStart",{target:w,width:w.clientWidth,height:w.clientHeight}),i.getDoc().selection.empty(),l(t,r,S)}function h(e){var t=e.srcElement;if(t!=w){if(i.fire("ObjectSelected",{target:t}),m(),0===t.id.indexOf("mceResizeHandle"))return void(e.returnValue=!1);("IMG"==t.nodeName||"TABLE"==t.nodeName)&&(c(),w=t,d(t,"resizestart",p))}}function m(){f(w,"resizestart",p)}function g(){for(var e in N){var t=N[e];t.elm&&(C.unbind(t.elm),delete t.elm)}}function v(){try{i.getDoc().execCommand("enableObjectResizing",!1,!1)}catch(e){}}function y(e){var t;if(z){t=I.body.createControlRange();try{return t.addElement(e),t.select(),!0}catch(n){}}}function b(){w=_=null,z&&(m(),f(U,"controlselect",h))}var C=i.dom,x=t.each,w,_,E,N,k,S,T,R,A,B,D,L,H,M,P,O,I=i.getDoc(),F=document,z=n.ie&&n.ie<11,W=Math.abs,V=Math.round,U=i.getBody(),$,q;N={n:[.5,0,0,-1],e:[1,.5,1,0],s:[.5,1,0,1],w:[0,.5,-1,0],nw:[0,0,-1,-1],ne:[1,0,1,-1],se:[1,1,1,1],sw:[0,1,-1,1]};var j=".mce-content-body";return i.contentStyles.push(j+" div.mce-resizehandle {position: absolute;border: 1px solid black;background: #FFF;width: 5px;height: 5px;z-index: 10000}"+j+" .mce-resizehandle:hover {background: #000}"+j+" img[data-mce-selected], hr[data-mce-selected] {outline: 1px solid black;resize: none}"+j+" .mce-clonedresizable {position: absolute;"+(n.gecko?"":"outline: 1px dashed black;")+"opacity: .5;filter: alpha(opacity=50);z-index: 10000}"+j+" .mce-resize-helper {background: #555;background: rgba(0,0,0,0.75);border-radius: 3px;border: 1px;color: white;display: none;font-family: sans-serif;font-size: 12px;white-space: nowrap;line-height: 14px;margin: 5px 10px;padding: 5px;position: absolute;z-index: 10001}"),i.on("init",function(){z?(i.on("ObjectResized",function(e){"TABLE"!=e.target.nodeName&&(c(),y(e.target))}),d(U,"controlselect",h),i.on("mousedown",function(e){S=e})):(v(),n.ie>=11&&(i.on("mouseup",function(e){var t=e.target.nodeName;!M&&/^(TABLE|IMG|HR)$/.test(t)&&(i.selection.select(e.target,"TABLE"==t),i.nodeChanged())}),i.dom.bind(U,"mscontrolselect",function(e){/^(TABLE|IMG|HR)$/.test(e.target.nodeName)&&(e.preventDefault(),"IMG"==e.target.tagName&&window.setTimeout(function(){i.selection.select(e.target)},0))}))),i.on("nodechange ResizeEditor",u),i.on("keydown keyup",function(e){w&&"TABLE"==w.nodeName&&u(e)}),i.on("hide",c)}),i.on("remove",g),{isResizable:o,showResizeRect:l,hideResizeRect:c,updateResizeRect:u,controlSelect:y,destroy:b}}}),r(L,[u,d],function(e,t){function n(n){var r=n.dom;this.getBookmark=function(e,i){function o(e,n){var i=0;return t.each(r.select(e),function(e,t){e==n&&(i=t)}),i}function a(e){function t(t){var n,r,i,o=t?"start":"end";n=e[o+"Container"],r=e[o+"Offset"],1==n.nodeType&&"TR"==n.nodeName&&(i=n.childNodes,n=i[Math.min(t?r:r-1,i.length-1)],n&&(r=t?0:n.childNodes.length,e["set"+(t?"Start":"End")](n,r)))}return t(!0),t(),e}function s(){function e(e,t){var n=e[t?"startContainer":"endContainer"],a=e[t?"startOffset":"endOffset"],s=[],l,c,u=0;if(3==n.nodeType){if(i)for(l=n.previousSibling;l&&3==l.nodeType;l=l.previousSibling)a+=l.nodeValue.length;s.push(a)}else c=n.childNodes,a>=c.length&&c.length&&(u=1,a=Math.max(0,c.length-1)),s.push(r.nodeIndex(c[a],i)+u);for(;n&&n!=o;n=n.parentNode)s.push(r.nodeIndex(n,i));return s}var t=n.getRng(!0),o=r.getRoot(),a={};return a.start=e(t,!0),n.isCollapsed()||(a.end=e(t)),a}var l,c,u,d,f,p,h="&#xFEFF;",m;if(2==e)return p=n.getNode(),f=p?p.nodeName:null,"IMG"==f?{name:f,index:o(f,p)}:n.tridentSel?n.tridentSel.getBookmark(e):s();if(e)return{rng:n.getRng()};if(l=n.getRng(),u=r.uniqueId(),d=n.isCollapsed(),m="overflow:hidden;line-height:0px",l.duplicate||l.item){if(l.item)return p=l.item(0),f=p.nodeName,{name:f,index:o(f,p)};c=l.duplicate();try{l.collapse(),l.pasteHTML('<span data-mce-type="bookmark" id="'+u+'_start" style="'+m+'">'+h+"</span>"),d||(c.collapse(!1),l.moveToElementText(c.parentElement()),0===l.compareEndPoints("StartToEnd",c)&&c.move("character",-1),c.pasteHTML('<span data-mce-type="bookmark" id="'+u+'_end" style="'+m+'">'+h+"</span>"))}catch(g){return null}}else{if(p=n.getNode(),f=p.nodeName,"IMG"==f)return{name:f,index:o(f,p)};c=a(l.cloneRange()),d||(c.collapse(!1),c.insertNode(r.create("span",{"data-mce-type":"bookmark",id:u+"_end",style:m},h))),l=a(l),l.collapse(!0),l.insertNode(r.create("span",{"data-mce-type":"bookmark",id:u+"_start",style:m},h))}return n.moveToBookmark({id:u,keep:1}),{id:u}},this.moveToBookmark=function(i){function o(e){var t=i[e?"start":"end"],n,r,o,a;if(t){for(o=t[0],r=c,n=t.length-1;n>=1;n--){if(a=r.childNodes,t[n]>a.length-1)return;r=a[t[n]]}3===r.nodeType&&(o=Math.min(t[0],r.nodeValue.length)),1===r.nodeType&&(o=Math.min(t[0],r.childNodes.length)),e?l.setStart(r,o):l.setEnd(r,o)}return!0}function a(n){var o=r.get(i.id+"_"+n),a,s,l,c,h=i.keep;if(o&&(a=o.parentNode,"start"==n?(h?(a=o.firstChild,s=1):s=r.nodeIndex(o),u=d=a,f=p=s):(h?(a=o.firstChild,s=1):s=r.nodeIndex(o),d=a,p=s),!h)){for(c=o.previousSibling,l=o.nextSibling,t.each(t.grep(o.childNodes),function(e){3==e.nodeType&&(e.nodeValue=e.nodeValue.replace(/\uFEFF/g,""))});o=r.get(i.id+"_"+n);)r.remove(o,1);c&&l&&c.nodeType==l.nodeType&&3==c.nodeType&&!e.opera&&(s=c.nodeValue.length,c.appendData(l.nodeValue),r.remove(l),"start"==n?(u=d=c,f=p=s):(d=c,p=s))}}function s(t){return!r.isBlock(t)||t.innerHTML||e.ie||(t.innerHTML='<br data-mce-bogus="1" />'),t}var l,c,u,d,f,p;if(i)if(i.start){if(l=r.createRng(),c=r.getRoot(),n.tridentSel)return n.tridentSel.moveToBookmark(i);o(!0)&&o()&&n.setRng(l)}else i.id?(a("start"),a("end"),u&&(l=r.createRng(),l.setStart(s(u),f),l.setEnd(s(d),p),n.setRng(l))):i.name?n.select(r.select(i.name)[i.index]):i.rng&&n.setRng(i.rng)}}return n.isBookmarkNode=function(e){return e&&"SPAN"===e.tagName&&"bookmark"===e.getAttribute("data-mce-type")},n}),r(H,[h,A,D,x,L,u,d],function(e,n,r,i,o,a,s){function l(e,t,i,a){var s=this;s.dom=e,s.win=t,s.serializer=i,s.editor=a,s.bookmarkManager=new o(s),s.controlSelection=new r(s,a),s.win.getSelection||(s.tridentSel=new n(s))}var c=s.each,u=s.trim,d=a.ie;return l.prototype={setCursorLocation:function(e,t){var n=this,r=n.dom.createRng();e?(r.setStart(e,t),r.setEnd(e,t),n.setRng(r),n.collapse(!1)):(n._moveEndPoint(r,n.editor.getBody(),!0),n.setRng(r))},getContent:function(e){var n=this,r=n.getRng(),i=n.dom.create("body"),o=n.getSel(),a,s,l;return e=e||{},a=s="",e.get=!0,e.format=e.format||"html",e.selection=!0,n.editor.fire("BeforeGetContent",e),"text"==e.format?n.isCollapsed()?"":r.text||(o.toString?o.toString():""):(r.cloneContents?(l=r.cloneContents(),l&&i.appendChild(l)):r.item!==t||r.htmlText!==t?(i.innerHTML="<br>"+(r.item?r.item(0).outerHTML:r.htmlText),i.removeChild(i.firstChild)):i.innerHTML=r.toString(),/^\s/.test(i.innerHTML)&&(a=" "),/\s+$/.test(i.innerHTML)&&(s=" "),e.getInner=!0,e.content=n.isCollapsed()?"":a+n.serializer.serialize(i,e)+s,n.editor.fire("GetContent",e),e.content)},setContent:function(e,t){var n=this,r=n.getRng(),i,o=n.win.document,a,s;if(t=t||{format:"html"},t.set=!0,t.selection=!0,e=t.content=e,t.no_events||n.editor.fire("BeforeSetContent",t),e=t.content,r.insertNode){e+='<span id="__caret">_</span>',r.startContainer==o&&r.endContainer==o?o.body.innerHTML=e:(r.deleteContents(),0===o.body.childNodes.length?o.body.innerHTML=e:r.createContextualFragment?r.insertNode(r.createContextualFragment(e)):(a=o.createDocumentFragment(),s=o.createElement("div"),a.appendChild(s),s.outerHTML=e,r.insertNode(a))),i=n.dom.get("__caret"),r=o.createRange(),r.setStartBefore(i),r.setEndBefore(i),n.setRng(r),n.dom.remove("__caret");try{n.setRng(r)}catch(l){}}else r.item&&(o.execCommand("Delete",!1,null),r=n.getRng()),/^\s+/.test(e)?(r.pasteHTML('<span id="__mce_tmp">_</span>'+e),n.dom.remove("__mce_tmp")):r.pasteHTML(e);t.no_events||n.editor.fire("SetContent",t)},getStart:function(e){var t=this,n=t.getRng(),r,i,o,a;if(n.duplicate||n.item){if(n.item)return n.item(0);for(o=n.duplicate(),o.collapse(1),r=o.parentElement(),r.ownerDocument!==t.dom.doc&&(r=t.dom.getRoot()),i=a=n.parentElement();a=a.parentNode;)if(a==r){r=i;break}return r}return r=n.startContainer,1==r.nodeType&&r.hasChildNodes()&&(e&&n.collapsed||(r=r.childNodes[Math.min(r.childNodes.length-1,n.startOffset)])),r&&3==r.nodeType?r.parentNode:r},getEnd:function(e){var t=this,n=t.getRng(),r,i;return n.duplicate||n.item?n.item?n.item(0):(n=n.duplicate(),n.collapse(0),r=n.parentElement(),r.ownerDocument!==t.dom.doc&&(r=t.dom.getRoot()),r&&"BODY"==r.nodeName?r.lastChild||r:r):(r=n.endContainer,i=n.endOffset,1==r.nodeType&&r.hasChildNodes()&&(e&&n.collapsed||(r=r.childNodes[i>0?i-1:i])),r&&3==r.nodeType?r.parentNode:r)},getBookmark:function(e,t){return this.bookmarkManager.getBookmark(e,t)},moveToBookmark:function(e){return this.bookmarkManager.moveToBookmark(e)},select:function(e,t){var n=this,r=n.dom,i=r.createRng(),o;if(n.lastFocusBookmark=null,e){if(!t&&n.controlSelection.controlSelect(e))return;o=r.nodeIndex(e),i.setStart(e.parentNode,o),i.setEnd(e.parentNode,o+1),t&&(n._moveEndPoint(i,e,!0),n._moveEndPoint(i,e)),n.setRng(i)}return e},isCollapsed:function(){var e=this,t=e.getRng(),n=e.getSel();return!t||t.item?!1:t.compareEndPoints?0===t.compareEndPoints("StartToEnd",t):!n||t.collapsed},collapse:function(e){var t=this,n=t.getRng(),r;n.item&&(r=n.item(0),n=t.win.document.body.createTextRange(),n.moveToElementText(r)),n.collapse(!!e),t.setRng(n)},getSel:function(){var e=this.win;return e.getSelection?e.getSelection():e.document.selection},getRng:function(e){function t(e,t,n){try{return t.compareBoundaryPoints(e,n)}catch(r){return-1}}var n=this,r,i,o,a=n.win.document,s;if(!e&&n.lastFocusBookmark){var l=n.lastFocusBookmark;return l.startContainer?(i=a.createRange(),i.setStart(l.startContainer,l.startOffset),i.setEnd(l.endContainer,l.endOffset)):i=l,i}if(e&&n.tridentSel)return n.tridentSel.getRangeAt(0);try{(r=n.getSel())&&(i=r.rangeCount>0?r.getRangeAt(0):r.createRange?r.createRange():a.createRange())}catch(c){}if(d&&i&&i.setStart&&a.selection){try{s=a.selection.createRange()}catch(c){}s&&s.item&&(o=s.item(0),i=a.createRange(),i.setStartBefore(o),i.setEndAfter(o))}return i||(i=a.createRange?a.createRange():a.body.createTextRange()),i.setStart&&9===i.startContainer.nodeType&&i.collapsed&&(o=n.dom.getRoot(),i.setStart(o,0),i.setEnd(o,0)),n.selectedRange&&n.explicitRange&&(0===t(i.START_TO_START,i,n.selectedRange)&&0===t(i.END_TO_END,i,n.selectedRange)?i=n.explicitRange:(n.selectedRange=null,n.explicitRange=null)),i},setRng:function(e,t){var n=this,r;if(e)if(e.select)try{e.select()}catch(i){}else if(n.tridentSel){if(e.cloneRange)try{return void n.tridentSel.addRange(e)}catch(i){}}else if(r=n.getSel()){n.explicitRange=e;try{r.removeAllRanges(),r.addRange(e)}catch(i){}t===!1&&r.extend&&(r.collapse(e.endContainer,e.endOffset),r.extend(e.startContainer,e.startOffset)),n.selectedRange=r.rangeCount>0?r.getRangeAt(0):null}},setNode:function(e){var t=this;return t.setContent(t.dom.getOuterHTML(e)),e},getNode:function(){function e(e,t){for(var n=e;e&&3===e.nodeType&&0===e.length;)e=t?e.nextSibling:e.previousSibling;return e||n}var t=this,n=t.getRng(),r,i=n.startContainer,o=n.endContainer,a=n.startOffset,s=n.endOffset,l=t.dom.getRoot();return n?n.setStart?(r=n.commonAncestorContainer,!n.collapsed&&(i==o&&2>s-a&&i.hasChildNodes()&&(r=i.childNodes[a]),3===i.nodeType&&3===o.nodeType&&(i=i.length===a?e(i.nextSibling,!0):i.parentNode,o=0===s?e(o.previousSibling,!1):o.parentNode,i&&i===o))?i:r&&3==r.nodeType?r.parentNode:r):(r=n.item?n.item(0):n.parentElement(),r.ownerDocument!==t.win.document&&(r=l),r):l},getSelectedBlocks:function(t,n){var r=this,i=r.dom,o,a,s=[];if(a=i.getRoot(),t=i.getParent(t||r.getStart(),i.isBlock),n=i.getParent(n||r.getEnd(),i.isBlock),t&&t!=a&&s.push(t),t&&n&&t!=n){o=t;for(var l=new e(t,a);(o=l.next())&&o!=n;)i.isBlock(o)&&s.push(o)}return n&&t!=n&&n!=a&&s.push(n),s},isForward:function(){var e=this.dom,t=this.getSel(),n,r;return t&&t.anchorNode&&t.focusNode?(n=e.createRng(),n.setStart(t.anchorNode,t.anchorOffset),n.collapse(!0),r=e.createRng(),r.setStart(t.focusNode,t.focusOffset),r.collapse(!0),n.compareBoundaryPoints(n.START_TO_START,r)<=0):!0},normalize:function(){var e=this,t=e.getRng();return!d&&new i(e.dom).normalize(t)&&e.setRng(t,e.isForward()),t},selectorChanged:function(e,t){var n=this,r;return n.selectorChangedData||(n.selectorChangedData={},r={},n.editor.on("NodeChange",function(e){var t=e.element,i=n.dom,o=i.getParents(t,null,i.getRoot()),a={};c(n.selectorChangedData,function(e,t){c(o,function(n){return i.is(n,t)?(r[t]||(c(e,function(e){e(!0,{node:n,selector:t,parents:o})}),r[t]=e),a[t]=e,!1):void 0})}),c(r,function(e,n){a[n]||(delete r[n],c(e,function(e){e(!1,{node:t,selector:n,parents:o})}))})})),n.selectorChangedData[e]||(n.selectorChangedData[e]=[]),n.selectorChangedData[e].push(t),n},getScrollContainer:function(){for(var e,t=this.dom.getRoot();t&&"BODY"!=t.nodeName;){if(t.scrollHeight>t.clientHeight){e=t;break}t=t.parentNode}return e},scrollIntoView:function(e){function t(e){for(var t=0,n=0,r=e;r&&r.nodeType;)t+=r.offsetLeft||0,n+=r.offsetTop||0,r=r.offsetParent;return{x:t,y:n}}var n,r,i=this,o=i.dom,a=o.getRoot(),s,l;if("BODY"!=a.nodeName){var c=i.getScrollContainer();if(c)return n=t(e).y-t(c).y,l=c.clientHeight,s=c.scrollTop,void((s>n||n+25>s+l)&&(c.scrollTop=s>n?n:n-l+25))}r=o.getViewPort(i.editor.getWin()),n=o.getPos(e).y,s=r.y,l=r.h,(n<r.y||n+25>s+l)&&i.editor.getWin().scrollTo(0,s>n?n:n-l+25)},placeCaretAt:function(e,t){var n=this.editor.getDoc(),r,i;if(n.caretPositionFromPoint)i=n.caretPositionFromPoint(e,t),r=n.createRange(),r.setStart(i.offsetNode,i.offset),r.collapse(!0);else if(n.caretRangeFromPoint)r=n.caretRangeFromPoint(e,t);else if(n.body.createTextRange){r=n.body.createTextRange();try{r.moveToPoint(e,t),r.collapse(!0)}catch(o){r.collapse(t<n.body.clientHeight)}}this.setRng(r)},_moveEndPoint:function(t,n,r){var i=n,o=new e(n,i),s=this.dom.schema.getNonEmptyElements();do{if(3==n.nodeType&&0!==u(n.nodeValue).length)return void(r?t.setStart(n,0):t.setEnd(n,n.nodeValue.length));if(s[n.nodeName]&&!/^(TD|TH)$/.test(n.nodeName))return void(r?t.setStartBefore(n):"BR"==n.nodeName?t.setEndBefore(n):t.setEndAfter(n));if(a.ie&&a.ie<11&&this.dom.isBlock(n)&&this.dom.isEmpty(n))return void(r?t.setStart(n,0):t.setEnd(n,0))}while(n=r?o.next():o.prev());"BODY"==i.nodeName&&(r?t.setStart(i,0):t.setEnd(i,i.childNodes.length))},destroy:function(){this.win=null,this.controlSelection.destroy()}},l}),r(M,[L,d],function(e,t){function n(t){this.compare=function(n,i){function o(e){var n={};return r(t.getAttribs(e),function(r){var i=r.nodeName.toLowerCase();0!==i.indexOf("_")&&"style"!==i&&"data-mce-style"!==i&&(n[i]=t.getAttrib(e,i))}),n}function a(e,t){var n,r;for(r in e)if(e.hasOwnProperty(r)){if(n=t[r],"undefined"==typeof n)return!1;if(e[r]!=n)return!1;delete t[r]}for(r in t)if(t.hasOwnProperty(r))return!1;return!0}return n.nodeName!=i.nodeName?!1:a(o(n),o(i))&&a(t.parseStyle(t.getAttrib(n,"style")),t.parseStyle(t.getAttrib(i,"style")))?!e.isBookmarkNode(n)&&!e.isBookmarkNode(i):!1}}var r=t.each;return n}),r(P,[d],function(e){function t(e,t){function r(e){return e.replace(/%(\w+)/g,"")}var i,o,a=e.dom,s="",l,c;if(c=e.settings.preview_styles,c===!1)return"";if(c||(c="font-family font-size font-weight font-style text-decoration text-transform color background-color border border-radius outline text-shadow"),"string"==typeof t){if(t=e.formatter.get(t),!t)return;t=t[0]}return i=t.block||t.inline||"span",o=a.create(i),n(t.styles,function(e,t){e=r(e),e&&a.setStyle(o,t,e)}),n(t.attributes,function(e,t){e=r(e),e&&a.setAttrib(o,t,e)}),n(t.classes,function(e){e=r(e),a.hasClass(o,e)||a.addClass(o,e)}),e.fire("PreviewFormats"),a.setStyles(o,{position:"absolute",left:-65535}),e.getBody().appendChild(o),l=a.getStyle(e.getBody(),"fontSize",!0),l=/px$/.test(l)?parseInt(l,10):0,n(c.split(" "),function(t){var n=a.getStyle(o,t,!0);if(!("background-color"==t&&/transparent|rgba\s*\([^)]+,\s*0\)/.test(n)&&(n=a.getStyle(e.getBody(),t,!0),"#ffffff"==a.toHex(n).toLowerCase())||"color"==t&&"#000000"==a.toHex(n).toLowerCase())){if("font-size"==t&&/em|%$/.test(n)){if(0===l)return;n=parseFloat(n,10)/(/%$/.test(n)?100:1),n=n*l+"px"
}"border"==t&&n&&(s+="padding:0 2px;"),s+=t+":"+n+";"}}),e.fire("AfterPreviewFormats"),a.remove(o),s}var n=e.each;return{getCssText:t}}),r(O,[h,x,L,M,d,P],function(e,t,n,r,i,o){return function(a){function s(e){return e.nodeType&&(e=e.nodeName),!!a.schema.getTextBlockElements()[e.toLowerCase()]}function l(e,t){return U.getParents(e,t,U.getRoot())}function c(e){return 1===e.nodeType&&"_mce_caret"===e.id}function u(){p({valigntop:[{selector:"td,th",styles:{verticalAlign:"top"}}],valignmiddle:[{selector:"td,th",styles:{verticalAlign:"middle"}}],valignbottom:[{selector:"td,th",styles:{verticalAlign:"bottom"}}],alignleft:[{selector:"figure,p,h1,h2,h3,h4,h5,h6,td,th,tr,div,ul,ol,li",styles:{textAlign:"left"},defaultBlock:"div"},{selector:"img,table",collapsed:!1,styles:{"float":"left"}}],aligncenter:[{selector:"figure,p,h1,h2,h3,h4,h5,h6,td,th,tr,div,ul,ol,li",styles:{textAlign:"center"},defaultBlock:"div"},{selector:"img",collapsed:!1,styles:{display:"block",marginLeft:"auto",marginRight:"auto"}},{selector:"table",collapsed:!1,styles:{marginLeft:"auto",marginRight:"auto"}}],alignright:[{selector:"figure,p,h1,h2,h3,h4,h5,h6,td,th,tr,div,ul,ol,li",styles:{textAlign:"right"},defaultBlock:"div"},{selector:"img,table",collapsed:!1,styles:{"float":"right"}}],alignjustify:[{selector:"figure,p,h1,h2,h3,h4,h5,h6,td,th,tr,div,ul,ol,li",styles:{textAlign:"justify"},defaultBlock:"div"}],bold:[{inline:"strong",remove:"all"},{inline:"span",styles:{fontWeight:"bold"}},{inline:"b",remove:"all"}],italic:[{inline:"em",remove:"all"},{inline:"span",styles:{fontStyle:"italic"}},{inline:"i",remove:"all"}],underline:[{inline:"span",styles:{textDecoration:"underline"},exact:!0},{inline:"u",remove:"all"}],strikethrough:[{inline:"span",styles:{textDecoration:"line-through"},exact:!0},{inline:"strike",remove:"all"}],forecolor:{inline:"span",styles:{color:"%value"},links:!0,remove_similar:!0},hilitecolor:{inline:"span",styles:{backgroundColor:"%value"},links:!0,remove_similar:!0},fontname:{inline:"span",styles:{fontFamily:"%value"}},fontsize:{inline:"span",styles:{fontSize:"%value"}},fontsize_class:{inline:"span",attributes:{"class":"%value"}},blockquote:{block:"blockquote",wrapper:1,remove:"all"},subscript:{inline:"sub"},superscript:{inline:"sup"},code:{inline:"code"},link:{inline:"a",selector:"a",remove:"all",split:!0,deep:!0,onmatch:function(){return!0},onformat:function(e,t,n){at(n,function(t,n){U.setAttrib(e,n,t)})}},removeformat:[{selector:"b,strong,em,i,font,u,strike,sub,sup,dfn,code,samp,kbd,var,cite,mark,q",remove:"all",split:!0,expand:!1,block_expand:!0,deep:!0},{selector:"span",attributes:["style","class"],remove:"empty",split:!0,expand:!1,deep:!0},{selector:"*",attributes:["style","class"],split:!1,expand:!1,deep:!0}]}),at("p h1 h2 h3 h4 h5 h6 div address pre div dt dd samp".split(/\s/),function(e){p(e,{block:e,remove:"all"})}),p(a.settings.formats)}function d(){a.addShortcut("ctrl+b","bold_desc","Bold"),a.addShortcut("ctrl+i","italic_desc","Italic"),a.addShortcut("ctrl+u","underline_desc","Underline");for(var e=1;6>=e;e++)a.addShortcut("ctrl+"+e,"",["FormatBlock",!1,"h"+e]);a.addShortcut("ctrl+7","",["FormatBlock",!1,"p"]),a.addShortcut("ctrl+8","",["FormatBlock",!1,"div"]),a.addShortcut("ctrl+9","",["FormatBlock",!1,"address"])}function f(e){return e?V[e]:V}function p(e,t){e&&("string"!=typeof e?at(e,function(e,t){p(t,e)}):(t=t.length?t:[t],at(t,function(e){e.deep===tt&&(e.deep=!e.selector),e.split===tt&&(e.split=!e.selector||e.inline),e.remove===tt&&e.selector&&!e.inline&&(e.remove="none"),e.selector&&e.inline&&(e.mixed=!0,e.block_expand=!0),"string"==typeof e.classes&&(e.classes=e.classes.split(/\s+/))}),V[e]=t))}function h(e){return e&&V[e]&&delete V[e],V}function m(e){var t;return a.dom.getParent(e,function(e){return t=a.dom.getStyle(e,"text-decoration"),t&&"none"!==t}),t}function g(e){var t;1===e.nodeType&&e.parentNode&&1===e.parentNode.nodeType&&(t=m(e.parentNode),a.dom.getStyle(e,"color")&&t?a.dom.setStyle(e,"text-decoration",t):a.dom.getStyle(e,"textdecoration")===t&&a.dom.setStyle(e,"text-decoration",null))}function v(t,n,r){function i(e,t){if(t=t||d,e){if(t.onformat&&t.onformat(e,t,n,r),at(t.styles,function(t,r){U.setStyle(e,r,A(t,n))}),t.styles){var i=U.getAttrib(e,"style");i&&e.setAttribute("data-mce-style",i)}at(t.attributes,function(t,r){U.setAttrib(e,r,A(t,n))}),at(t.classes,function(t){t=A(t,n),U.hasClass(e,t)||U.addClass(e,t)})}}function o(){function t(t,n){var i=new e(n);for(r=i.current();r;r=i.prev())if(r.childNodes.length>1||r==t||"BR"==r.tagName)return r}var n=a.selection.getRng(),i=n.startContainer,o=n.endContainer;if(i!=o&&0===n.endOffset){var s=t(i,o),l=3==s.nodeType?s.length:s.childNodes.length;n.setEnd(s,l)}return n}function l(e,r,o){var a=[],l,f,p=!0;l=d.inline||d.block,f=U.create(l),i(f),q.walk(e,function(e){function r(e){var g,v,y,b,x;return x=p,g=e.nodeName.toLowerCase(),v=e.parentNode.nodeName.toLowerCase(),1===e.nodeType&&nt(e)&&(x=p,p="true"===nt(e),b=!0),S(g,"br")?(h=0,void(d.block&&U.remove(e))):d.wrapper&&C(e,t,n)?void(h=0):p&&!b&&d.block&&!d.wrapper&&s(g)&&j(v,l)?(e=U.rename(e,l),i(e),a.push(e),void(h=0)):d.selector&&(at(u,function(t){"collapsed"in t&&t.collapsed!==m||U.is(e,t.selector)&&!c(e)&&(i(e,t),y=!0)}),!d.inline||y)?void(h=0):void(!p||b||!j(l,g)||!j(v,l)||!o&&3===e.nodeType&&1===e.nodeValue.length&&65279===e.nodeValue.charCodeAt(0)||c(e)||d.inline&&Y(e)?(h=0,at(st(e.childNodes),r),b&&(p=x),h=0):(h||(h=U.clone(f,Q),e.parentNode.insertBefore(h,e),a.push(h)),h.appendChild(e)))}var h;at(e,r)}),d.links===!0&&at(a,function(e){function t(e){"A"===e.nodeName&&i(e,d),at(st(e.childNodes),t)}t(e)}),at(a,function(e){function r(e){var t=0;return at(e.childNodes,function(e){B(e)||ot(e)||t++}),t}function o(e){var t,n;return at(e.childNodes,function(e){return 1!=e.nodeType||ot(e)||c(e)?void 0:(t=e,Q)}),t&&!ot(t)&&k(t,d)&&(n=U.clone(t,Q),i(n),U.replace(n,e,Z),U.remove(t,1)),n||e}var s;if(s=r(e),(a.length>1||!Y(e))&&0===s)return void U.remove(e,1);if(d.inline||d.wrapper){if(d.exact||1!==s||(e=o(e)),at(u,function(t){at(U.select(t.inline,e),function(e){ot(e)||M(t,n,e,t.exact?e:null)})}),C(e.parentNode,t,n))return U.remove(e,1),e=0,Z;d.merge_with_parents&&U.getParent(e.parentNode,function(r){return C(r,t,n)?(U.remove(e,1),e=0,Z):void 0}),e&&d.merge_siblings!==!1&&(e=I(O(e),e),e=I(e,O(e,Z)))}})}var u=f(t),d=u[0],p,h,m=!r&&$.isCollapsed();if(d)if(r)r.nodeType?(h=U.createRng(),h.setStartBefore(r),h.setEndAfter(r),l(L(h,u),null,!0)):l(r,null,!0);else if(m&&d.inline&&!U.select("td.mce-item-selected,th.mce-item-selected").length)z("apply",t,n);else{var y=a.selection.getNode();K||!u[0].defaultBlock||U.getParent(y,U.isBlock)||v(u[0].defaultBlock),a.selection.setRng(o()),p=$.getBookmark(),l(L($.getRng(Z),u),p),d.styles&&(d.styles.color||d.styles.textDecoration)&&(lt(y,g,"childNodes"),g(y)),$.moveToBookmark(p),W($.getRng(Z)),a.nodeChanged()}}function y(e,t,n,r){function i(e){var n,r,o,a,s;if(1===e.nodeType&&nt(e)&&(a=y,y="true"===nt(e),s=!0),n=st(e.childNodes),y&&!s)for(r=0,o=p.length;o>r&&!M(p[r],t,e,e);r++);if(h.deep&&n.length){for(r=0,o=n.length;o>r;r++)i(n[r]);s&&(y=a)}}function o(n){var i;return at(l(n.parentNode).reverse(),function(n){var o;i||"_start"==n.id||"_end"==n.id||(o=C(n,e,t,r),o&&o.split!==!1&&(i=n))}),i}function s(e,n,r,i){var o,a,s,l,c,u;if(e){for(u=e.parentNode,o=n.parentNode;o&&o!=u;o=o.parentNode){for(a=U.clone(o,Q),c=0;c<p.length;c++)if(M(p[c],t,a,a)){a=0;break}a&&(s&&a.appendChild(s),l||(l=a),s=a)}!i||h.mixed&&Y(e)||(n=U.split(e,n)),s&&(r.parentNode.insertBefore(s,r),l.appendChild(r))}return n}function c(e){return s(o(e),e,e,!0)}function u(e){var t=U.get(e?"_start":"_end"),n=t[e?"firstChild":"lastChild"];return ot(n)&&(n=n[e?"firstChild":"lastChild"]),U.remove(t,!0),n}function d(e){var t,n,r=e.commonAncestorContainer;e=L(e,p,Z),h.split&&(t=F(e,Z),n=F(e),t!=n?(/^(TR|TH|TD)$/.test(t.nodeName)&&t.firstChild&&(t="TR"==t.nodeName?t.firstChild.firstChild||t:t.firstChild||t),r&&/^T(HEAD|BODY|FOOT|R)$/.test(r.nodeName)&&/^(TH|TD)$/.test(n.nodeName)&&n.firstChild&&(n=n.firstChild||n),t=D(t,"span",{id:"_start","data-mce-type":"bookmark"}),n=D(n,"span",{id:"_end","data-mce-type":"bookmark"}),c(t),c(n),t=u(Z),n=u()):t=n=c(t),e.startContainer=t.parentNode,e.startOffset=G(t),e.endContainer=n.parentNode,e.endOffset=G(n)+1),q.walk(e,function(e){at(e,function(e){i(e),1===e.nodeType&&"underline"===a.dom.getStyle(e,"text-decoration")&&e.parentNode&&"underline"===m(e.parentNode)&&M({deep:!1,exact:!0,inline:"span",styles:{textDecoration:"underline"}},null,e)})})}var p=f(e),h=p[0],g,v,y=!0;return n?void(n.nodeType?(v=U.createRng(),v.setStartBefore(n),v.setEndAfter(n),d(v)):d(n)):void($.isCollapsed()&&h.inline&&!U.select("td.mce-item-selected,th.mce-item-selected").length?z("remove",e,t,r):(g=$.getBookmark(),d($.getRng(Z)),$.moveToBookmark(g),h.inline&&x(e,t,$.getStart())&&W($.getRng(!0)),a.nodeChanged()))}function b(e,t,n){var r=f(e);!x(e,t,n)||"toggle"in r[0]&&!r[0].toggle?v(e,t,n):y(e,t,n)}function C(e,t,n,r){function i(e,t,i){var o,a,s=t[i],l;if(t.onmatch)return t.onmatch(e,t,i);if(s)if(s.length===tt){for(o in s)if(s.hasOwnProperty(o)){if(a="attributes"===i?U.getAttrib(e,o):T(e,o),r&&!a&&!t.exact)return;if((!r||t.exact)&&!S(a,R(A(s[o],n),o)))return}}else for(l=0;l<s.length;l++)if("attributes"===i?U.getAttrib(e,s[l]):T(e,s[l]))return t;return t}var o=f(t),a,s,l;if(o&&e)for(s=0;s<o.length;s++)if(a=o[s],k(e,a)&&i(e,a,"attributes")&&i(e,a,"styles")){if(l=a.classes)for(s=0;s<l.length;s++)if(!U.hasClass(e,l[s]))return;return a}}function x(e,t,n){function r(n){var r=U.getRoot();return n===r?!1:(n=U.getParent(n,function(n){return n.parentNode===r||!!C(n,e,t,!0)}),C(n,e,t))}var i;return n?r(n):(n=$.getNode(),r(n)?Z:(i=$.getStart(),i!=n&&r(i)?Z:Q))}function w(e,t){var n,r=[],i={};return n=$.getStart(),U.getParent(n,function(n){var o,a;for(o=0;o<e.length;o++)a=e[o],!i[a]&&C(n,a,t)&&(i[a]=!0,r.push(a))},U.getRoot()),r}function _(e){var t=f(e),n,r,i,o,a;if(t)for(n=$.getStart(),r=l(n),o=t.length-1;o>=0;o--){if(a=t[o].selector,!a||t[o].defaultBlock)return Z;for(i=r.length-1;i>=0;i--)if(U.is(r[i],a))return Z}return Q}function E(e,t,n){var r;return et||(et={},r={},a.on("NodeChange",function(e){var t=l(e.element),n={};t=i.grep(t,function(e){return 1==e.nodeType&&!e.getAttribute("data-mce-bogus")}),at(et,function(e,i){at(t,function(o){return C(o,i,{},e.similar)?(r[i]||(at(e,function(e){e(!0,{node:o,format:i,parents:t})}),r[i]=e),n[i]=e,!1):void 0})}),at(r,function(i,o){n[o]||(delete r[o],at(i,function(n){n(!1,{node:e.element,format:o,parents:t})}))})})),at(e.split(","),function(e){et[e]||(et[e]=[],et[e].similar=n),et[e].push(t)}),this}function N(e){return o.getCssText(a,e)}function k(e,t){return S(e,t.inline)?Z:S(e,t.block)?Z:t.selector?1==e.nodeType&&U.is(e,t.selector):void 0}function S(e,t){return e=e||"",t=t||"",e=""+(e.nodeName||e),t=""+(t.nodeName||t),e.toLowerCase()==t.toLowerCase()}function T(e,t){return R(U.getStyle(e,t),t)}function R(e,t){return("color"==t||"backgroundColor"==t)&&(e=U.toHex(e)),"fontWeight"==t&&700==e&&(e="bold"),"fontFamily"==t&&(e=e.replace(/[\'\"]/g,"").replace(/,\s+/g,",")),""+e}function A(e,t){return"string"!=typeof e?e=e(t):t&&(e=e.replace(/%(\w+)/g,function(e,n){return t[n]||e})),e}function B(e){return e&&3===e.nodeType&&/^([\t \r\n]+|)$/.test(e.nodeValue)}function D(e,t,n){var r=U.create(t,n);return e.parentNode.insertBefore(r,e),r.appendChild(e),r}function L(t,n,r){function i(e){function t(e){return"BR"==e.nodeName&&e.getAttribute("data-mce-bogus")&&!e.nextSibling}var r,i,o,a,s;if(r=i=e?g:y,a=e?"previousSibling":"nextSibling",s=U.getRoot(),3==r.nodeType&&!B(r)&&(e?v>0:b<r.nodeValue.length))return r;for(;;){if(!n[0].block_expand&&Y(i))return i;for(o=i[a];o;o=o[a])if(!ot(o)&&!B(o)&&!t(o))return i;if(i.parentNode==s){r=i;break}i=i.parentNode}return r}function o(e,t){for(t===tt&&(t=3===e.nodeType?e.length:e.childNodes.length);e&&e.hasChildNodes();)e=e.childNodes[t],e&&(t=3===e.nodeType?e.length:e.childNodes.length);return{node:e,offset:t}}function c(e){for(var t=e;t;){if(1===t.nodeType&&nt(t))return"false"===nt(t)?t:e;t=t.parentNode}return e}function u(t,n,i){function o(e,t){var n,o,a=e.nodeValue;return"undefined"==typeof t&&(t=i?a.length:0),i?(n=a.lastIndexOf(" ",t),o=a.lastIndexOf("\xa0",t),n=n>o?n:o,-1===n||r||n++):(n=a.indexOf(" ",t),o=a.indexOf("\xa0",t),n=-1!==n&&(-1===o||o>n)?n:o),n}var s,l,c,u;if(3===t.nodeType){if(c=o(t,n),-1!==c)return{container:t,offset:c};u=t}for(s=new e(t,U.getParent(t,Y)||a.getBody());l=s[i?"prev":"next"]();)if(3===l.nodeType){if(u=l,c=o(l),-1!==c)return{container:l,offset:c}}else if(Y(l))break;return u?(n=i?0:u.length,{container:u,offset:n}):void 0}function d(e,r){var i,o,a,s;for(3==e.nodeType&&0===e.nodeValue.length&&e[r]&&(e=e[r]),i=l(e),o=0;o<i.length;o++)for(a=0;a<n.length;a++)if(s=n[a],!("collapsed"in s&&s.collapsed!==t.collapsed)&&U.is(i[o],s.selector))return i[o];return e}function f(e,t){var r,i=U.getRoot();if(n[0].wrapper||(r=U.getParent(e,n[0].block,i)),r||(r=U.getParent(3==e.nodeType?e.parentNode:e,function(e){return e!=i&&s(e)})),r&&n[0].wrapper&&(r=l(r,"ul,ol").reverse()[0]||r),!r)for(r=e;r[t]&&!Y(r[t])&&(r=r[t],!S(r,"br")););return r||e}var p,h,m,g=t.startContainer,v=t.startOffset,y=t.endContainer,b=t.endOffset;if(1==g.nodeType&&g.hasChildNodes()&&(p=g.childNodes.length-1,g=g.childNodes[v>p?p:v],3==g.nodeType&&(v=0)),1==y.nodeType&&y.hasChildNodes()&&(p=y.childNodes.length-1,y=y.childNodes[b>p?p:b-1],3==y.nodeType&&(b=y.nodeValue.length)),g=c(g),y=c(y),(ot(g.parentNode)||ot(g))&&(g=ot(g)?g:g.parentNode,g=g.nextSibling||g,3==g.nodeType&&(v=0)),(ot(y.parentNode)||ot(y))&&(y=ot(y)?y:y.parentNode,y=y.previousSibling||y,3==y.nodeType&&(b=y.length)),n[0].inline&&(t.collapsed&&(m=u(g,v,!0),m&&(g=m.container,v=m.offset),m=u(y,b),m&&(y=m.container,b=m.offset)),h=o(y,b),h.node)){for(;h.node&&0===h.offset&&h.node.previousSibling;)h=o(h.node.previousSibling);h.node&&h.offset>0&&3===h.node.nodeType&&" "===h.node.nodeValue.charAt(h.offset-1)&&h.offset>1&&(y=h.node,y.splitText(h.offset-1))}return(n[0].inline||n[0].block_expand)&&(n[0].inline&&3==g.nodeType&&0!==v||(g=i(!0)),n[0].inline&&3==y.nodeType&&b!==y.nodeValue.length||(y=i())),n[0].selector&&n[0].expand!==Q&&!n[0].inline&&(g=d(g,"previousSibling"),y=d(y,"nextSibling")),(n[0].block||n[0].selector)&&(g=f(g,"previousSibling"),y=f(y,"nextSibling"),n[0].block&&(Y(g)||(g=i(!0)),Y(y)||(y=i()))),1==g.nodeType&&(v=G(g),g=g.parentNode),1==y.nodeType&&(b=G(y)+1,y=y.parentNode),{startContainer:g,startOffset:v,endContainer:y,endOffset:b}}function H(e,t){return t.links&&"A"==e.tagName}function M(e,t,n,r){var i,o,a;if(!k(n,e)&&!H(n,e))return Q;if("all"!=e.remove)for(at(e.styles,function(i,o){i=R(A(i,t),o),"number"==typeof o&&(o=i,r=0),(e.remove_similar||!r||S(T(r,o),i))&&U.setStyle(n,o,""),a=1}),a&&""===U.getAttrib(n,"style")&&(n.removeAttribute("style"),n.removeAttribute("data-mce-style")),at(e.attributes,function(e,i){var o;if(e=A(e,t),"number"==typeof i&&(i=e,r=0),!r||S(U.getAttrib(r,i),e)){if("class"==i&&(e=U.getAttrib(n,i),e&&(o="",at(e.split(/\s+/),function(e){/mce\w+/.test(e)&&(o+=(o?" ":"")+e)}),o)))return void U.setAttrib(n,i,o);"class"==i&&n.removeAttribute("className"),J.test(i)&&n.removeAttribute("data-mce-"+i),n.removeAttribute(i)}}),at(e.classes,function(e){e=A(e,t),(!r||U.hasClass(r,e))&&U.removeClass(n,e)}),o=U.getAttribs(n),i=0;i<o.length;i++)if(0!==o[i].nodeName.indexOf("_"))return Q;return"none"!=e.remove?(P(n,e),Z):void 0}function P(e,t){function n(e,t,n){return e=O(e,t,n),!e||"BR"==e.nodeName||Y(e)}var r=e.parentNode,i;t.block&&(K?r==U.getRoot()&&(t.list_block&&S(e,t.list_block)||at(st(e.childNodes),function(e){j(K,e.nodeName.toLowerCase())?i?i.appendChild(e):(i=D(e,K),U.setAttribs(i,a.settings.forced_root_block_attrs)):i=0})):Y(e)&&!Y(r)&&(n(e,Q)||n(e.firstChild,Z,1)||e.insertBefore(U.create("br"),e.firstChild),n(e,Z)||n(e.lastChild,Q,1)||e.appendChild(U.create("br")))),t.selector&&t.inline&&!S(t.inline,e)||U.remove(e,1)}function O(e,t,n){if(e)for(t=t?"nextSibling":"previousSibling",e=n?e:e[t];e;e=e[t])if(1==e.nodeType||!B(e))return e}function I(e,t){function n(e,t){for(i=e;i;i=i[t]){if(3==i.nodeType&&0!==i.nodeValue.length)return e;if(1==i.nodeType&&!ot(i))return i}return e}var i,o,a=new r(U);if(e&&t&&(e=n(e,"previousSibling"),t=n(t,"nextSibling"),a.compare(e,t))){for(i=e.nextSibling;i&&i!=t;)o=i,i=i.nextSibling,e.appendChild(o);return U.remove(t),at(st(t.childNodes),function(t){e.appendChild(t)}),e}return t}function F(t,n){var r,i,o;return r=t[n?"startContainer":"endContainer"],i=t[n?"startOffset":"endOffset"],1==r.nodeType&&(o=r.childNodes.length-1,!n&&i&&i--,r=r.childNodes[i>o?o:i]),3===r.nodeType&&n&&i>=r.nodeValue.length&&(r=new e(r,a.getBody()).next()||r),3!==r.nodeType||n||0!==i||(r=new e(r,a.getBody()).prev()||r),r}function z(t,n,r,i){function o(e){var t=U.create("span",{id:g,"data-mce-bogus":!0,style:b?"color:red":""});return e&&t.appendChild(a.getDoc().createTextNode(X)),t}function l(e,t){for(;e;){if(3===e.nodeType&&e.nodeValue!==X||e.childNodes.length>1)return!1;t&&1===e.nodeType&&t.push(e),e=e.firstChild}return!0}function c(e){for(;e;){if(e.id===g)return e;e=e.parentNode}}function u(t){var n;if(t)for(n=new e(t,t),t=n.current();t;t=n.next())if(3===t.nodeType)return t}function d(e,t){var n,r;if(e)r=$.getRng(!0),l(e)?(t!==!1&&(r.setStartBefore(e),r.setEndBefore(e)),U.remove(e)):(n=u(e),n.nodeValue.charAt(0)===X&&(n.deleteData(0,1),r.startContainer==n&&r.startOffset>0&&r.setStart(n,r.startOffset-1),r.endContainer==n&&r.endOffset>0&&r.setEnd(n,r.endOffset-1)),U.remove(e,1)),$.setRng(r);else if(e=c($.getStart()),!e)for(;e=U.get(g);)d(e,!1)}function p(){var e,t,i,a,s,l,d;e=$.getRng(!0),a=e.startOffset,l=e.startContainer,d=l.nodeValue,t=c($.getStart()),t&&(i=u(t)),d&&a>0&&a<d.length&&/\w/.test(d.charAt(a))&&/\w/.test(d.charAt(a-1))?(s=$.getBookmark(),e.collapse(!0),e=L(e,f(n)),e=q.split(e),v(n,r,e),$.moveToBookmark(s)):(t&&i.nodeValue===X?v(n,r,t):(t=o(!0),i=t.firstChild,e.insertNode(t),a=1,v(n,r,t)),$.setCursorLocation(i,a))}function h(){var e=$.getRng(!0),t,a,l,c,u,d,p=[],h,m;for(t=e.startContainer,a=e.startOffset,u=t,3==t.nodeType&&(a!=t.nodeValue.length&&(c=!0),u=u.parentNode);u;){if(C(u,n,r,i)){d=u;break}u.nextSibling&&(c=!0),p.push(u),u=u.parentNode}if(d)if(c)l=$.getBookmark(),e.collapse(!0),e=L(e,f(n),!0),e=q.split(e),y(n,r,e),$.moveToBookmark(l);else{for(m=o(),u=m,h=p.length-1;h>=0;h--)u.appendChild(U.clone(p[h],!1)),u=u.firstChild;u.appendChild(U.doc.createTextNode(X)),u=u.firstChild;var g=U.getParent(d,s);g&&U.isEmpty(g)?d.parentNode.replaceChild(m,d):U.insertAfter(m,d),$.setCursorLocation(u,1),U.isEmpty(d)&&U.remove(d)}}function m(){var e;e=c($.getStart()),e&&!U.isEmpty(e)&&lt(e,function(e){1!=e.nodeType||e.id===g||U.isEmpty(e)||U.setAttrib(e,"data-mce-bogus",null)},"childNodes")}var g="_mce_caret",b=a.settings.caret_debug;a._hasCaretEvents||(it=function(){var e=[],t;if(l(c($.getStart()),e))for(t=e.length;t--;)U.setAttrib(e[t],"data-mce-bogus","1")},rt=function(e){var t=e.keyCode;d(),(8==t||37==t||39==t)&&d(c($.getStart())),m()},a.on("SetContent",function(e){e.selection&&m()}),a._hasCaretEvents=!0),"apply"==t?p():h()}function W(t){var n=t.startContainer,r=t.startOffset,i,o,a,s,l;if(3==n.nodeType&&r>=n.nodeValue.length&&(r=G(n),n=n.parentNode,i=!0),1==n.nodeType)for(s=n.childNodes,n=s[Math.min(r,s.length-1)],o=new e(n,U.getParent(n,U.isBlock)),(r>s.length-1||i)&&o.next(),a=o.current();a;a=o.next())if(3==a.nodeType&&!B(a))return l=U.create("a",{"data-mce-bogus":"all"},X),a.parentNode.insertBefore(l,a),t.setStart(a,0),$.setRng(t),void U.remove(l)}var V={},U=a.dom,$=a.selection,q=new t(U),j=a.schema.isValidChild,Y=U.isBlock,K=a.settings.forced_root_block,G=U.nodeIndex,X="\ufeff",J=/^(src|href|style)$/,Q=!1,Z=!0,et,tt,nt=U.getContentEditable,rt,it,ot=n.isBookmarkNode,at=i.each,st=i.grep,lt=i.walk,ct=i.extend;ct(this,{get:f,register:p,unregister:h,apply:v,remove:y,toggle:b,match:x,matchAll:w,matchNode:C,canApply:_,formatChanged:E,getCssText:N}),u(),d(),a.on("BeforeGetContent",function(e){it&&"raw"!=e.format&&it()}),a.on("mouseup keydown",function(e){rt&&rt(e)})}}),r(I,[B,u,d,N],function(e,t,n,r){var i=n.trim,o;return o=new RegExp(["<span[^>]+data-mce-bogus[^>]+>[\u200b\ufeff]+<\\/span>",'\\s?data-mce-selected="[^"]+"'].join("|"),"gi"),function(n){function a(){var e=n.getContent({format:"raw",no_events:1}),t=/<(\w+) [^>]*data-mce-bogus="all"[^>]*>/g,a,s,l,c,u,d=n.schema;for(e=e.replace(o,""),u=d.getShortEndedElements();c=t.exec(e);)s=t.lastIndex,l=c[0].length,a=u[c[1]]?s:r.findEndTag(d,e,s),e=e.substring(0,s-l)+e.substring(a),t.lastIndex=s-l;return i(e)}function s(e){l.typing=!1,l.add({},e)}var l=this,c=0,u=[],d,f,p=0;return n.on("init",function(){l.add()}),n.on("BeforeExecCommand",function(e){var t=e.command;"Undo"!=t&&"Redo"!=t&&"mceRepaint"!=t&&l.beforeChange()}),n.on("ExecCommand",function(e){var t=e.command;"Undo"!=t&&"Redo"!=t&&"mceRepaint"!=t&&s(e)}),n.on("ObjectResizeStart",function(){l.beforeChange()}),n.on("SaveContent ObjectResized blur",s),n.on("DragEnd",s),n.on("KeyUp",function(e){var r=e.keyCode;(r>=33&&36>=r||r>=37&&40>=r||45==r||13==r||e.ctrlKey)&&(s(),n.nodeChanged()),(46==r||8==r||t.mac&&(91==r||93==r))&&n.nodeChanged(),f&&l.typing&&(n.isDirty()||(n.isNotDirty=!u[0]||a()==u[0].content,n.isNotDirty||n.fire("change",{level:u[0],lastLevel:null})),n.fire("TypingUndo"),f=!1,n.nodeChanged())}),n.on("KeyDown",function(t){var n=t.keyCode;if(n>=33&&36>=n||n>=37&&40>=n||45==n)return void(l.typing&&s(t));var r=e.modifierPressed(t);!(16>n||n>20)||224==n||91==n||l.typing||r||(l.beforeChange(),l.typing=!0,l.add({},t),f=!0)}),n.on("MouseDown",function(e){l.typing&&s(e)}),n.addShortcut("ctrl+z","","Undo"),n.addShortcut("ctrl+y,ctrl+shift+z","","Redo"),n.on("AddUndo Undo Redo ClearUndos",function(e){e.isDefaultPrevented()||n.nodeChanged()}),l={data:u,typing:!1,beforeChange:function(){p||(d=n.selection.getBookmark(2,!0))},add:function(e,t){var r,i=n.settings,o;if(e=e||{},e.content=a(),p||n.removed)return null;if(o=u[c],n.fire("BeforeAddUndo",{level:e,lastLevel:o,originalEvent:t}).isDefaultPrevented())return null;if(o&&o.content==e.content)return null;if(u[c]&&(u[c].beforeBookmark=d),i.custom_undo_redo_levels&&u.length>i.custom_undo_redo_levels){for(r=0;r<u.length-1;r++)u[r]=u[r+1];u.length--,c=u.length}e.bookmark=n.selection.getBookmark(2,!0),c<u.length-1&&(u.length=c+1),u.push(e),c=u.length-1;var s={level:e,lastLevel:o,originalEvent:t};return n.fire("AddUndo",s),c>0&&(n.isNotDirty=!1,n.fire("change",s)),e},undo:function(){var e;return l.typing&&(l.add(),l.typing=!1),c>0&&(e=u[--c],0===c&&(n.isNotDirty=!0),n.setContent(e.content,{format:"raw"}),n.selection.moveToBookmark(e.beforeBookmark),n.fire("undo",{level:e})),e},redo:function(){var e;return c<u.length-1&&(e=u[++c],n.setContent(e.content,{format:"raw"}),n.selection.moveToBookmark(e.bookmark),n.fire("redo",{level:e})),e},clear:function(){u=[],c=0,l.typing=!1,n.fire("ClearUndos")},hasUndo:function(){return c>0||l.typing&&u[0]&&a()!=u[0].content},hasRedo:function(){return c<u.length-1&&!this.typing},transact:function(e){l.beforeChange();try{p++,e()}finally{p--}l.add()}}}}),r(F,[h,x,u],function(e,t,n){var r=n.ie&&n.ie<11;return function(i){function o(o){function f(e){return e&&a.isBlock(e)&&!/^(TD|TH|CAPTION|FORM)$/.test(e.nodeName)&&!/^(fixed|absolute)/i.test(e.style.position)&&"true"!==a.getContentEditable(e)}function p(e){var t;a.isBlock(e)&&(t=s.getRng(),e.appendChild(a.create("span",null,"\xa0")),s.select(e),e.lastChild.outerHTML="",s.setRng(t))}function h(e){var t=e,n=[],r;if(t){for(;t=t.firstChild;){if(a.isBlock(t))return;1!=t.nodeType||d[t.nodeName.toLowerCase()]||n.push(t)}for(r=n.length;r--;)t=n[r],!t.hasChildNodes()||t.firstChild==t.lastChild&&""===t.firstChild.nodeValue?a.remove(t):"A"==t.nodeName&&" "===(t.innerText||t.textContent)&&a.remove(t)}}function m(t){function r(e){for(;e;){if(1==e.nodeType||3==e.nodeType&&e.data&&/[\r\n\s]/.test(e.data))return e;e=e.nextSibling}}var i,o,l,c=t,u;if(t){if(n.ie&&n.ie<9&&A&&A.firstChild&&A.firstChild==A.lastChild&&"BR"==A.firstChild.tagName&&a.remove(A.firstChild),/^(LI|DT|DD)$/.test(t.nodeName)){var f=r(t.firstChild);f&&/^(UL|OL|DL)$/.test(f.nodeName)&&t.insertBefore(a.doc.createTextNode("\xa0"),t.firstChild)}if(l=a.createRng(),n.ie||t.normalize(),t.hasChildNodes()){for(i=new e(t,t);o=i.current();){if(3==o.nodeType){l.setStart(o,0),l.setEnd(o,0);break}if(d[o.nodeName.toLowerCase()]){l.setStartBefore(o),l.setEndBefore(o);break}c=o,o=i.next()}o||(l.setStart(c,0),l.setEnd(c,0))}else"BR"==t.nodeName?t.nextSibling&&a.isBlock(t.nextSibling)?((!B||9>B)&&(u=a.create("br"),t.parentNode.insertBefore(u,t)),l.setStartBefore(t),l.setEndBefore(t)):(l.setStartAfter(t),l.setEndAfter(t)):(l.setStart(t,0),l.setEnd(t,0));s.setRng(l),a.remove(u),s.scrollIntoView(t)}}function g(e){var t=l.forced_root_block;t&&t.toLowerCase()===e.tagName.toLowerCase()&&a.setAttribs(e,l.forced_root_block_attrs)}function v(e){var t=T,n,i,o,s=u.getTextInlineElements();if(e||"TABLE"==P?(n=a.create(e||I),g(n)):n=A.cloneNode(!1),o=n,l.keep_styles!==!1)do if(s[t.nodeName]){if("_mce_caret"==t.id)continue;i=t.cloneNode(!1),a.setAttrib(i,"id",""),n.hasChildNodes()?(i.appendChild(n.firstChild),n.appendChild(i)):(o=i,n.appendChild(i))}while(t=t.parentNode);return r||(o.innerHTML='<br data-mce-bogus="1">'),n}function y(t){var n,r,i;if(3==T.nodeType&&(t?R>0:R<T.nodeValue.length))return!1;if(T.parentNode==A&&F&&!t)return!0;if(t&&1==T.nodeType&&T==A.firstChild)return!0;if("TABLE"===T.nodeName||T.previousSibling&&"TABLE"==T.previousSibling.nodeName)return F&&!t||!F&&t;for(n=new e(T,A),3==T.nodeType&&(t&&0===R?n.prev():t||R!=T.nodeValue.length||n.next());r=n.current();){if(1===r.nodeType){if(!r.getAttribute("data-mce-bogus")&&(i=r.nodeName.toLowerCase(),d[i]&&"br"!==i))return!1}else if(3===r.nodeType&&!/^[ \t\r\n]*$/.test(r.nodeValue))return!1;t?n.prev():n.next()}return!0}function b(e,t){var n,r,o,s,l,c,d=I||"P";if(r=a.getParent(e,a.isBlock),c=i.getBody().nodeName.toLowerCase(),!r||!f(r)){if(r=r||S,!r.hasChildNodes())return n=a.create(d),g(n),r.appendChild(n),N.setStart(n,0),N.setEnd(n,0),n;for(s=e;s.parentNode!=r;)s=s.parentNode;for(;s&&!a.isBlock(s);)o=s,s=s.previousSibling;if(o&&u.isValidChild(c,d.toLowerCase())){for(n=a.create(d),g(n),o.parentNode.insertBefore(n,o),s=o;s&&!a.isBlock(s);)l=s.nextSibling,n.appendChild(s),s=l;N.setStart(e,t),N.setEnd(e,t)}}return e}function C(){function e(e){for(var t=M[e?"firstChild":"lastChild"];t&&1!=t.nodeType;)t=t[e?"nextSibling":"previousSibling"];return t===A}function t(){var e=M.parentNode;return/^(LI|DT|DD)$/.test(e.nodeName)?e:M}var n=M.parentNode.nodeName;/^(OL|UL|LI)$/.test(n)&&(I="LI"),L=I?v(I):a.create("BR"),e(!0)&&e()?"LI"==n?a.insertAfter(L,t()):a.replace(L,M):e(!0)?"LI"==n?(a.insertAfter(L,t()),L.appendChild(a.doc.createTextNode(" ")),L.appendChild(M)):M.parentNode.insertBefore(L,M):e()?(a.insertAfter(L,t()),p(L)):(M=t(),k=N.cloneRange(),k.setStartAfter(A),k.setEndAfter(M),H=k.extractContents(),"LI"==I&&"LI"==H.firstChild.nodeName?(L=H.firstChild,a.insertAfter(H,M)):(a.insertAfter(H,M),a.insertAfter(L,M))),a.remove(A),m(L),c.add()}function x(){i.execCommand("InsertLineBreak",!1,o)}function w(e){do 3===e.nodeType&&(e.nodeValue=e.nodeValue.replace(/^[\r\n]+/,"")),e=e.firstChild;while(e)}function _(e){var t=a.getRoot(),n,r;for(n=e;n!==t&&"false"!==a.getContentEditable(n);)"true"===a.getContentEditable(n)&&(r=n),n=n.parentNode;return n!==t?r:t}function E(e){var t;r||(e.normalize(),t=e.lastChild,(!t||/^(left|right)$/gi.test(a.getStyle(t,"float",!0)))&&a.add(e,"br"))}var N,k,S,T,R,A,B,D,L,H,M,P,O,I,F;if(N=s.getRng(!0),!o.isDefaultPrevented()){if(!N.collapsed)return void i.execCommand("Delete");if(new t(a).normalize(N),T=N.startContainer,R=N.startOffset,I=(l.force_p_newlines?"p":"")||l.forced_root_block,I=I?I.toUpperCase():"",B=a.doc.documentMode,D=o.shiftKey,1==T.nodeType&&T.hasChildNodes()&&(F=R>T.childNodes.length-1,T=T.childNodes[Math.min(R,T.childNodes.length-1)]||T,R=F&&3==T.nodeType?T.nodeValue.length:0),S=_(T)){if(c.beforeChange(),!a.isBlock(S)&&S!=a.getRoot())return void((!I||D)&&x());if((I&&!D||!I&&D)&&(T=b(T,R)),A=a.getParent(T,a.isBlock),M=A?a.getParent(A.parentNode,a.isBlock):null,P=A?A.nodeName.toUpperCase():"",O=M?M.nodeName.toUpperCase():"","LI"!=O||o.ctrlKey||(A=M,P=O),/^(LI|DT|DD)$/.test(P)){if(!I&&D)return void x();if(a.isEmpty(A))return void C()}if("PRE"==P&&l.br_in_pre!==!1){if(!D)return void x()}else if(!I&&!D&&"LI"!=P||I&&D)return void x();I&&A===i.getBody()||(I=I||"P",y()?(L=/^(H[1-6]|PRE|FIGURE)$/.test(P)&&"HGROUP"!=O?v(I):v(),l.end_container_on_empty_block&&f(M)&&a.isEmpty(A)?L=a.split(M,A):a.insertAfter(L,A),m(L)):y(!0)?(L=A.parentNode.insertBefore(v(),A),p(L),m(A)):(k=N.cloneRange(),k.setEndAfter(A),H=k.extractContents(),w(H),L=H.firstChild,a.insertAfter(H,A),h(L),E(A),m(L)),a.setAttrib(L,"id",""),i.fire("NewBlock",{newBlock:L}),c.add())}}}var a=i.dom,s=i.selection,l=i.settings,c=i.undoManager,u=i.schema,d=u.getNonEmptyElements();i.on("keydown",function(e){13==e.keyCode&&o(e)!==!1&&e.preventDefault()})}}),r(z,[],function(){return function(e){function t(){var t=i.getStart(),s=e.getBody(),l,c,u,d,f,p,h,m=-16777215,g,v,y,b,C;if(C=n.forced_root_block,t&&1===t.nodeType&&C){for(;t&&t!=s;){if(a[t.nodeName])return;t=t.parentNode}if(l=i.getRng(),l.setStart){c=l.startContainer,u=l.startOffset,d=l.endContainer,f=l.endOffset;try{v=e.getDoc().activeElement===s}catch(x){}}else l.item&&(t=l.item(0),l=e.getDoc().body.createTextRange(),l.moveToElementText(t)),v=l.parentElement().ownerDocument===e.getDoc(),y=l.duplicate(),y.collapse(!0),u=-1*y.move("character",m),y.collapsed||(y=l.duplicate(),y.collapse(!1),f=-1*y.move("character",m)-u);for(t=s.firstChild,b=s.nodeName.toLowerCase();t;)if((3===t.nodeType||1==t.nodeType&&!a[t.nodeName])&&o.isValidChild(b,C.toLowerCase())){if(3===t.nodeType&&0===t.nodeValue.length){h=t,t=t.nextSibling,r.remove(h);continue}p||(p=r.create(C,e.settings.forced_root_block_attrs),t.parentNode.insertBefore(p,t),g=!0),h=t,t=t.nextSibling,p.appendChild(h)}else p=null,t=t.nextSibling;if(g&&v){if(l.setStart)l.setStart(c,u),l.setEnd(d,f),i.setRng(l);else try{l=e.getDoc().body.createTextRange(),l.moveToElementText(s),l.collapse(!0),l.moveStart("character",u),f>0&&l.moveEnd("character",f),l.select()}catch(x){}e.nodeChanged()}}}var n=e.settings,r=e.dom,i=e.selection,o=e.schema,a=o.getBlockElements();n.forced_root_block&&e.on("NodeChange",t)}}),r(W,[T,u,d,M,x,h],function(e,n,r,i,o,a){var s=r.each,l=r.extend,c=r.map,u=r.inArray,d=r.explode,f=n.gecko,p=n.ie,h=n.ie&&n.ie<11,m=!0,g=!1;return function(r){function v(e,t,n){var r;return e=e.toLowerCase(),(r=T.exec[e])?(r(e,t,n),m):g}function y(e){var t;return e=e.toLowerCase(),(t=T.state[e])?t(e):-1}function b(e){var t;return e=e.toLowerCase(),(t=T.value[e])?t(e):g}function C(e,t){t=t||"exec",s(e,function(e,n){s(n.toLowerCase().split(","),function(n){T[t][n]=e})})}function x(e,n,i){return n===t&&(n=g),i===t&&(i=null),r.getDoc().execCommand(e,n,i)}function w(e){return A.match(e)}function _(e,n){A.toggle(e,n?{value:n}:t),r.nodeChanged()}function E(e){B=S.getBookmark(e)}function N(){S.moveToBookmark(B)}var k=r.dom,S=r.selection,T={state:{},exec:{},value:{}},R=r.settings,A=r.formatter,B;l(this,{execCommand:v,queryCommandState:y,queryCommandValue:b,addCommands:C}),C({"mceResetDesignMode,mceBeginUndoLevel":function(){},"mceEndUndoLevel,mceAddUndoLevel":function(){r.undoManager.add()},"Cut,Copy,Paste":function(e){var t=r.getDoc(),i;try{x(e)}catch(o){i=m}if(i||!t.queryCommandSupported(e)){var a=r.translate("Your browser doesn't support direct access to the clipboard. Please use the Ctrl+X/C/V keyboard shortcuts instead.");n.mac&&(a=a.replace(/Ctrl\+/g,"\u2318+")),r.windowManager.alert(a)}},unlink:function(){if(S.isCollapsed()){var e=S.getNode();return void("A"==e.tagName&&r.dom.remove(e,!0))}A.remove("link")},"JustifyLeft,JustifyCenter,JustifyRight,JustifyFull":function(e){var t=e.substring(7);"full"==t&&(t="justify"),s("left,center,right,justify".split(","),function(e){t!=e&&A.remove("align"+e)}),_("align"+t),v("mceRepaint")
},"InsertUnorderedList,InsertOrderedList":function(e){var t,n;x(e),t=k.getParent(S.getNode(),"ol,ul"),t&&(n=t.parentNode,/^(H[1-6]|P|ADDRESS|PRE)$/.test(n.nodeName)&&(E(),k.split(n,t),N()))},"Bold,Italic,Underline,Strikethrough,Superscript,Subscript":function(e){_(e)},"ForeColor,HiliteColor,FontName":function(e,t,n){_(e,n)},FontSize:function(e,t,n){var r,i;n>=1&&7>=n&&(i=d(R.font_size_style_values),r=d(R.font_size_classes),n=r?r[n-1]||n:i[n-1]||n),_(e,n)},RemoveFormat:function(e){A.remove(e)},mceBlockQuote:function(){_("blockquote")},FormatBlock:function(e,t,n){return _(n||"p")},mceCleanup:function(){var e=S.getBookmark();r.setContent(r.getContent({cleanup:m}),{cleanup:m}),S.moveToBookmark(e)},mceRemoveNode:function(e,t,n){var i=n||S.getNode();i!=r.getBody()&&(E(),r.dom.remove(i,m),N())},mceSelectNodeDepth:function(e,t,n){var i=0;k.getParent(S.getNode(),function(e){return 1==e.nodeType&&i++==n?(S.select(e),g):void 0},r.getBody())},mceSelectNode:function(e,t,n){S.select(n)},mceInsertContent:function(t,n,o){function a(e){function t(e){return r[e]&&3==r[e].nodeType}var n,r,i;return n=S.getRng(!0),r=n.startContainer,i=n.startOffset,3==r.nodeType&&(i>0?e=e.replace(/^&nbsp;/," "):t("previousSibling")||(e=e.replace(/^ /,"&nbsp;")),i<r.length?e=e.replace(/&nbsp;(<br>|)$/," "):t("nextSibling")||(e=e.replace(/(&nbsp;| )(<br>|)$/,"&nbsp;"))),e}function l(e){if(w)for(b=e.firstChild;b;b=b.walk(!0))_[b.name]&&b.attr("data-mce-new","true")}function c(){if(w){var e=r.getBody(),t=new i(k);s(k.select("*[data-mce-new]"),function(n){n.removeAttribute("data-mce-new");for(var r=n.parentNode;r&&r!=e;r=r.parentNode)t.compare(r,n)&&k.remove(n,!0)})}}var u,d,f,h,m,g,v,y,b,C,x,w,_=r.schema.getTextInlineElements();"string"!=typeof o&&(w=o.merge,o=o.content),/^ | $/.test(o)&&(o=a(o)),u=r.parser,d=new e({},r.schema),x='<span id="mce_marker" data-mce-type="bookmark">&#xFEFF;&#x200B;</span>',g={content:o,format:"html",selection:!0},r.fire("BeforeSetContent",g),o=g.content,-1==o.indexOf("{$caret}")&&(o+="{$caret}"),o=o.replace(/\{\$caret\}/,x),y=S.getRng();var E=y.startContainer||(y.parentElement?y.parentElement():null),N=r.getBody();E===N&&S.isCollapsed()&&k.isBlock(N.firstChild)&&k.isEmpty(N.firstChild)&&(y=k.createRng(),y.setStart(N.firstChild,0),y.setEnd(N.firstChild,0),S.setRng(y)),S.isCollapsed()||r.getDoc().execCommand("Delete",!1,null),f=S.getNode();var T={context:f.nodeName.toLowerCase()};if(m=u.parse(o,T),l(m),b=m.lastChild,"mce_marker"==b.attr("id"))for(v=b,b=b.prev;b;b=b.walk(!0))if(3==b.type||!k.isBlock(b.name)){r.schema.isValidChild(b.parent.name,"span")&&b.parent.insert(v,b,"br"===b.name);break}if(T.invalid){for(S.setContent(x),f=S.getNode(),h=r.getBody(),9==f.nodeType?f=b=h:b=f;b!==h;)f=b,b=b.parentNode;o=f==h?h.innerHTML:k.getOuterHTML(f),o=d.serialize(u.parse(o.replace(/<span (id="mce_marker"|id=mce_marker).+?<\/span>/i,function(){return d.serialize(m)}))),f==h?k.setHTML(h,o):k.setOuterHTML(f,o)}else o=d.serialize(m),b=f.firstChild,C=f.lastChild,!b||b===C&&"BR"===b.nodeName?k.setHTML(f,o):S.setContent(o);c(),v=k.get("mce_marker"),S.scrollIntoView(v),y=k.createRng(),b=v.previousSibling,b&&3==b.nodeType?(y.setStart(b,b.nodeValue.length),p||(C=v.nextSibling,C&&3==C.nodeType&&(b.appendData(C.data),C.parentNode.removeChild(C)))):(y.setStartBefore(v),y.setEndBefore(v)),k.remove(v),S.setRng(y),r.fire("SetContent",g),r.addVisual()},mceInsertRawHTML:function(e,t,n){S.setContent("tiny_mce_marker"),r.setContent(r.getContent().replace(/tiny_mce_marker/g,function(){return n}))},mceToggleFormat:function(e,t,n){_(n)},mceSetContent:function(e,t,n){r.setContent(n)},"Indent,Outdent":function(e){var t,n,i;t=R.indentation,n=/[a-z%]+$/i.exec(t),t=parseInt(t,10),y("InsertUnorderedList")||y("InsertOrderedList")?x(e):(R.forced_root_block||k.getParent(S.getNode(),k.isBlock)||A.apply("div"),s(S.getSelectedBlocks(),function(o){if("LI"!=o.nodeName){var a=r.getParam("indent_use_margin",!1)?"margin":"padding";a+="rtl"==k.getStyle(o,"direction",!0)?"Right":"Left","outdent"==e?(i=Math.max(0,parseInt(o.style[a]||0,10)-t),k.setStyle(o,a,i?i+n:"")):(i=parseInt(o.style[a]||0,10)+t+n,k.setStyle(o,a,i))}}))},mceRepaint:function(){if(f)try{E(m),S.getSel()&&S.getSel().selectAllChildren(r.getBody()),S.collapse(m),N()}catch(e){}},InsertHorizontalRule:function(){r.execCommand("mceInsertContent",!1,"<hr />")},mceToggleVisualAid:function(){r.hasVisual=!r.hasVisual,r.addVisual()},mceReplaceContent:function(e,t,n){r.execCommand("mceInsertContent",!1,n.replace(/\{\$selection\}/g,S.getContent({format:"text"})))},mceInsertLink:function(e,t,n){var r;"string"==typeof n&&(n={href:n}),r=k.getParent(S.getNode(),"a"),n.href=n.href.replace(" ","%20"),r&&n.href||A.remove("link"),n.href&&A.apply("link",n,r)},selectAll:function(){var e=k.getRoot(),t;S.getRng().setStart?(t=k.createRng(),t.setStart(e,0),t.setEnd(e,e.childNodes.length),S.setRng(t)):(t=S.getRng(),t.item||(t.moveToElementText(e),t.select()))},"delete":function(){x("Delete");var e=r.getBody();k.isEmpty(e)&&(r.setContent(""),e.firstChild&&k.isBlock(e.firstChild)?r.selection.setCursorLocation(e.firstChild,0):r.selection.setCursorLocation(e,0))},mceNewDocument:function(){r.setContent("")},InsertLineBreak:function(e,t,n){function i(){for(var e=new a(p,v),t,n=r.schema.getNonEmptyElements();t=e.next();)if(n[t.nodeName.toLowerCase()]||t.length>0)return!0}var s=n,l,c,u,d=S.getRng(!0);new o(k).normalize(d);var f=d.startOffset,p=d.startContainer;if(1==p.nodeType&&p.hasChildNodes()){var g=f>p.childNodes.length-1;p=p.childNodes[Math.min(f,p.childNodes.length-1)]||p,f=g&&3==p.nodeType?p.nodeValue.length:0}var v=k.getParent(p,k.isBlock),y=v?v.nodeName.toUpperCase():"",b=v?k.getParent(v.parentNode,k.isBlock):null,C=b?b.nodeName.toUpperCase():"",x=s&&s.ctrlKey;"LI"!=C||x||(v=b,y=C),p&&3==p.nodeType&&f>=p.nodeValue.length&&(h||i()||(l=k.create("br"),d.insertNode(l),d.setStartAfter(l),d.setEndAfter(l),c=!0)),l=k.create("br"),d.insertNode(l);var w=k.doc.documentMode;return h&&"PRE"==y&&(!w||8>w)&&l.parentNode.insertBefore(k.doc.createTextNode("\r"),l),u=k.create("span",{},"&nbsp;"),l.parentNode.insertBefore(u,l),S.scrollIntoView(u),k.remove(u),c?(d.setStartBefore(l),d.setEndBefore(l)):(d.setStartAfter(l),d.setEndAfter(l)),S.setRng(d),r.undoManager.add(),m}}),C({"JustifyLeft,JustifyCenter,JustifyRight,JustifyFull":function(e){var t="align"+e.substring(7),n=S.isCollapsed()?[k.getParent(S.getNode(),k.isBlock)]:S.getSelectedBlocks(),r=c(n,function(e){return!!A.matchNode(e,t)});return-1!==u(r,m)},"Bold,Italic,Underline,Strikethrough,Superscript,Subscript":function(e){return w(e)},mceBlockQuote:function(){return w("blockquote")},Outdent:function(){var e;if(R.inline_styles){if((e=k.getParent(S.getStart(),k.isBlock))&&parseInt(e.style.paddingLeft,10)>0)return m;if((e=k.getParent(S.getEnd(),k.isBlock))&&parseInt(e.style.paddingLeft,10)>0)return m}return y("InsertUnorderedList")||y("InsertOrderedList")||!R.inline_styles&&!!k.getParent(S.getNode(),"BLOCKQUOTE")},"InsertUnorderedList,InsertOrderedList":function(e){var t=k.getParent(S.getNode(),"ul,ol");return t&&("insertunorderedlist"===e&&"UL"===t.tagName||"insertorderedlist"===e&&"OL"===t.tagName)}},"state"),C({"FontSize,FontName":function(e){var t=0,n;return(n=k.getParent(S.getNode(),"span"))&&(t="fontsize"==e?n.style.fontSize:n.style.fontFamily.replace(/, /g,",").replace(/[\'\"]/g,"").toLowerCase()),t}},"value"),C({Undo:function(){r.undoManager.undo()},Redo:function(){r.undoManager.redo()}})}}),r(V,[d],function(e){function t(e,o){var a=this,s,l;if(e=r(e),o=a.settings=o||{},s=o.base_uri,/^([\w\-]+):([^\/]{2})/i.test(e)||/^\s*#/.test(e))return void(a.source=e);var c=0===e.indexOf("//");0!==e.indexOf("/")||c||(e=(s?s.protocol||"http":"http")+"://mce_host"+e),/^[\w\-]*:?\/\//.test(e)||(l=o.base_uri?o.base_uri.path:new t(location.href).directory,""===o.base_uri.protocol?e="//mce_host"+a.toAbsPath(l,e):(e=/([^#?]*)([#?]?.*)/.exec(e),e=(s&&s.protocol||"http")+"://mce_host"+a.toAbsPath(l,e[1])+e[2])),e=e.replace(/@@/g,"(mce_at)"),e=/^(?:(?![^:@]+:[^:@\/]*@)([^:\/?#.]+):)?(?:\/\/)?((?:(([^:@\/]*):?([^:@\/]*))?@)?([^:\/?#]*)(?::(\d*))?)(((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[?#]|$)))*\/?)?([^?#\/]*))(?:\?([^#]*))?(?:#(.*))?)/.exec(e),n(i,function(t,n){var r=e[n];r&&(r=r.replace(/\(mce_at\)/g,"@@")),a[t]=r}),s&&(a.protocol||(a.protocol=s.protocol),a.userInfo||(a.userInfo=s.userInfo),a.port||"mce_host"!==a.host||(a.port=s.port),a.host&&"mce_host"!==a.host||(a.host=s.host),a.source=""),c&&(a.protocol="")}var n=e.each,r=e.trim,i="source protocol authority userInfo user password host port relative path directory file query anchor".split(" "),o={ftp:21,http:80,https:443,mailto:25};return t.prototype={setPath:function(e){var t=this;e=/^(.*?)\/?(\w+)?$/.exec(e),t.path=e[0],t.directory=e[1],t.file=e[2],t.source="",t.getURI()},toRelative:function(e){var n=this,r;if("./"===e)return e;if(e=new t(e,{base_uri:n}),"mce_host"!=e.host&&n.host!=e.host&&e.host||n.port!=e.port||n.protocol!=e.protocol&&""!==e.protocol)return e.getURI();var i=n.getURI(),o=e.getURI();return i==o||"/"==i.charAt(i.length-1)&&i.substr(0,i.length-1)==o?i:(r=n.toRelPath(n.path,e.path),e.query&&(r+="?"+e.query),e.anchor&&(r+="#"+e.anchor),r)},toAbsolute:function(e,n){return e=new t(e,{base_uri:this}),e.getURI(n&&this.isSameOrigin(e))},isSameOrigin:function(e){if(this.host==e.host&&this.protocol==e.protocol){if(this.port==e.port)return!0;var t=o[this.protocol];if(t&&(this.port||t)==(e.port||t))return!0}return!1},toRelPath:function(e,t){var n,r=0,i="",o,a;if(e=e.substring(0,e.lastIndexOf("/")),e=e.split("/"),n=t.split("/"),e.length>=n.length)for(o=0,a=e.length;a>o;o++)if(o>=n.length||e[o]!=n[o]){r=o+1;break}if(e.length<n.length)for(o=0,a=n.length;a>o;o++)if(o>=e.length||e[o]!=n[o]){r=o+1;break}if(1===r)return t;for(o=0,a=e.length-(r-1);a>o;o++)i+="../";for(o=r-1,a=n.length;a>o;o++)i+=o!=r-1?"/"+n[o]:n[o];return i},toAbsPath:function(e,t){var r,i=0,o=[],a,s;for(a=/\/$/.test(t)?"/":"",e=e.split("/"),t=t.split("/"),n(e,function(e){e&&o.push(e)}),e=o,r=t.length-1,o=[];r>=0;r--)0!==t[r].length&&"."!==t[r]&&(".."!==t[r]?i>0?i--:o.push(t[r]):i++);return r=e.length-i,s=0>=r?o.reverse().join("/"):e.slice(0,r).join("/")+"/"+o.reverse().join("/"),0!==s.indexOf("/")&&(s="/"+s),a&&s.lastIndexOf("/")!==s.length-1&&(s+=a),s},getURI:function(e){var t,n=this;return(!n.source||e)&&(t="",e||(t+=n.protocol?n.protocol+"://":"//",n.userInfo&&(t+=n.userInfo+"@"),n.host&&(t+=n.host),n.port&&(t+=":"+n.port)),n.path&&(t+=n.path),n.query&&(t+="?"+n.query),n.anchor&&(t+="#"+n.anchor),n.source=t),n.source}},t}),r(U,[d],function(e){function t(){}var n=e.each,r=e.extend,i,o;return t.extend=i=function(e){function t(){var e,t,n,r=this;if(!o&&(r.init&&r.init.apply(r,arguments),t=r.Mixins))for(e=t.length;e--;)n=t[e],n.init&&n.init.apply(r,arguments)}function a(){return this}function s(e,t){return function(){var n=this,r=n._super,i;return n._super=c[e],i=t.apply(n,arguments),n._super=r,i}}var l=this,c=l.prototype,u,d,f;o=!0,u=new l,o=!1,e.Mixins&&(n(e.Mixins,function(t){t=t;for(var n in t)"init"!==n&&(e[n]=t[n])}),c.Mixins&&(e.Mixins=c.Mixins.concat(e.Mixins))),e.Methods&&n(e.Methods.split(","),function(t){e[t]=a}),e.Properties&&n(e.Properties.split(","),function(t){var n="_"+t;e[t]=function(e){var t=this,r;return e!==r?(t[n]=e,t):t[n]}}),e.Statics&&n(e.Statics,function(e,n){t[n]=e}),e.Defaults&&c.Defaults&&(e.Defaults=r({},c.Defaults,e.Defaults));for(d in e)f=e[d],u[d]="function"==typeof f&&c[d]?s(d,f):f;return t.prototype=u,t.constructor=t,t.extend=i,t},t}),r($,[d],function(e){function t(t){function n(){return!1}function r(){return!0}function i(e,i){var o,s,l,c;if(e=e.toLowerCase(),i=i||{},i.type=e,i.target||(i.target=u),i.preventDefault||(i.preventDefault=function(){i.isDefaultPrevented=r},i.stopPropagation=function(){i.isPropagationStopped=r},i.stopImmediatePropagation=function(){i.isImmediatePropagationStopped=r},i.isDefaultPrevented=n,i.isPropagationStopped=n,i.isImmediatePropagationStopped=n),t.beforeFire&&t.beforeFire(i),o=d[e])for(s=0,l=o.length;l>s;s++){if(c=o[s],c.once&&a(e,c.func),i.isImmediatePropagationStopped())return i.stopPropagation(),i;if(c.func.call(u,i)===!1)return i.preventDefault(),i}return i}function o(t,r,i,o){var a,s,l;if(r===!1&&(r=n),r)for(r={func:r},o&&e.extend(r,o),s=t.toLowerCase().split(" "),l=s.length;l--;)t=s[l],a=d[t],a||(a=d[t]=[],f(t,!0)),i?a.unshift(r):a.push(r);return c}function a(e,t){var n,r,i,o,a;if(e)for(o=e.toLowerCase().split(" "),n=o.length;n--;){if(e=o[n],r=d[e],!e){for(i in d)f(i,!1),delete d[i];return c}if(r){if(t)for(a=r.length;a--;)r[a].func===t&&(r=r.slice(0,a).concat(r.slice(a+1)),d[e]=r);else r.length=0;r.length||(f(e,!1),delete d[e])}}else{for(e in d)f(e,!1);d={}}return c}function s(e,t,n){return o(e,t,n,{once:!0})}function l(e){return e=e.toLowerCase(),!(!d[e]||0===d[e].length)}var c=this,u,d={},f;t=t||{},u=t.scope||c,f=t.toggleEvent||n,c.fire=i,c.on=o,c.off=a,c.once=s,c.has=l}var n=e.makeMap("focus blur focusin focusout click dblclick mousedown mouseup mousemove mouseover beforepaste paste cut copy selectionchange mouseout mouseenter mouseleave wheel keydown keypress keyup input contextmenu dragstart dragend dragover draggesture dragdrop drop drag submit compositionstart compositionend compositionupdate touchstart touchend"," ");return t.isNative=function(e){return!!n[e.toLowerCase()]},t}),r(q,[U],function(e){function t(e){for(var t=[],n=e.length,r;n--;)r=e[n],r.__checked||(t.push(r),r.__checked=1);for(n=t.length;n--;)delete t[n].__checked;return t}var n=/^([\w\\*]+)?(?:#([\w\\]+))?(?:\.([\w\\\.]+))?(?:\[\@?([\w\\]+)([\^\$\*!~]?=)([\w\\]+)\])?(?:\:(.+))?/i,r=/((?:\((?:\([^()]+\)|[^()]+)+\)|\[(?:\[[^\[\]]*\]|['"][^'"]*['"]|[^\[\]'"]+)+\]|\\.|[^ >+~,(\[\\]+)+|[>+~])(\s*,\s*)?((?:.|\r|\n)*)/g,i=/^\s*|\s*$/g,o,a=e.extend({init:function(e){function t(e){return e?(e=e.toLowerCase(),function(t){return"*"===e||t.type===e}):void 0}function o(e){return e?function(t){return t._name===e}:void 0}function a(e){return e?(e=e.split("."),function(t){for(var n=e.length;n--;)if(!t.hasClass(e[n]))return!1;return!0}):void 0}function s(e,t,n){return e?function(r){var i=r[e]?r[e]():"";return t?"="===t?i===n:"*="===t?i.indexOf(n)>=0:"~="===t?(" "+i+" ").indexOf(" "+n+" ")>=0:"!="===t?i!=n:"^="===t?0===i.indexOf(n):"$="===t?i.substr(i.length-n.length)===n:!1:!!n}:void 0}function l(e){var t;return e?(e=/(?:not\((.+)\))|(.+)/i.exec(e),e[1]?(t=u(e[1],[]),function(e){return!d(e,t)}):(e=e[2],function(t,n,r){return"first"===e?0===n:"last"===e?n===r-1:"even"===e?n%2===0:"odd"===e?n%2===1:t[e]?t[e]():!1})):void 0}function c(e,r,c){function u(e){e&&r.push(e)}var d;return d=n.exec(e.replace(i,"")),u(t(d[1])),u(o(d[2])),u(a(d[3])),u(s(d[4],d[5],d[6])),u(l(d[7])),r.psuedo=!!d[7],r.direct=c,r}function u(e,t){var n=[],i,o,a;do if(r.exec(""),o=r.exec(e),o&&(e=o[3],n.push(o[1]),o[2])){i=o[3];break}while(o);for(i&&u(i,t),e=[],a=0;a<n.length;a++)">"!=n[a]&&e.push(c(n[a],[],">"===n[a-1]));return t.push(e),t}var d=this.match;this._selectors=u(e,[])},match:function(e,t){var n,r,i,o,a,s,l,c,u,d,f,p,h;for(t=t||this._selectors,n=0,r=t.length;r>n;n++){for(a=t[n],o=a.length,h=e,p=0,i=o-1;i>=0;i--)for(c=a[i];h;){if(c.psuedo)for(f=h.parent().items(),u=d=f.length;u--&&f[u]!==h;);for(s=0,l=c.length;l>s;s++)if(!c[s](h,u,d)){s=l+1;break}if(s===l){p++;break}if(i===o-1)break;h=h.parent()}if(p===o)return!0}return!1},find:function(e){function n(e,t,i){var o,a,s,l,c,u=t[i];for(o=0,a=e.length;a>o;o++){for(c=e[o],s=0,l=u.length;l>s;s++)if(!u[s](c,o,a)){s=l+1;break}if(s===l)i==t.length-1?r.push(c):c.items&&n(c.items(),t,i+1);else if(u.direct)return;c.items&&n(c.items(),t,i)}}var r=[],i,s,l=this._selectors;if(e.items){for(i=0,s=l.length;s>i;i++)n(e.items(),l[i],0);s>1&&(r=t(r))}return o||(o=a.Collection),new o(r)}});return a}),r(j,[d,q,U],function(e,t,n){var r,i,o=Array.prototype.push,a=Array.prototype.slice;return i={length:0,init:function(e){e&&this.add(e)},add:function(t){var n=this;return e.isArray(t)?o.apply(n,t):t instanceof r?n.add(t.toArray()):o.call(n,t),n},set:function(e){var t=this,n=t.length,r;for(t.length=0,t.add(e),r=t.length;n>r;r++)delete t[r];return t},filter:function(e){var n=this,i,o,a=[],s,l;for("string"==typeof e?(e=new t(e),l=function(t){return e.match(t)}):l=e,i=0,o=n.length;o>i;i++)s=n[i],l(s)&&a.push(s);return new r(a)},slice:function(){return new r(a.apply(this,arguments))},eq:function(e){return-1===e?this.slice(e):this.slice(e,+e+1)},each:function(t){return e.each(this,t),this},toArray:function(){return e.toArray(this)},indexOf:function(e){for(var t=this,n=t.length;n--&&t[n]!==e;);return n},reverse:function(){return new r(e.toArray(this).reverse())},hasClass:function(e){return this[0]?this[0].hasClass(e):!1},prop:function(e,t){var n=this,r,i;return t!==r?(n.each(function(n){n[e]&&n[e](t)}),n):(i=n[0],i&&i[e]?i[e]():void 0)},exec:function(t){var n=this,r=e.toArray(arguments).slice(1);return n.each(function(e){e[t]&&e[t].apply(e,r)}),n},remove:function(){for(var e=this.length;e--;)this[e].remove();return this}},e.each("fire on off show hide addClass removeClass append prepend before after reflow".split(" "),function(t){i[t]=function(){var n=e.toArray(arguments);return this.each(function(e){t in e&&e[t].apply(e,n)}),this}}),e.each("text name disabled active selected checked visible parent value data".split(" "),function(e){i[e]=function(t){return this.prop(e,t)}}),r=n.extend(i),t.Collection=r,r}),r(Y,[d,y],function(e,t){var n=0;return{id:function(){return"mceu_"+n++},createFragment:function(e){return t.DOM.createFragment(e)},getWindowSize:function(){return t.DOM.getViewPort()},getSize:function(e){var t,n;if(e.getBoundingClientRect){var r=e.getBoundingClientRect();t=Math.max(r.width||r.right-r.left,e.offsetWidth),n=Math.max(r.height||r.bottom-r.bottom,e.offsetHeight)}else t=e.offsetWidth,n=e.offsetHeight;return{width:t,height:n}},getPos:function(e,n){return t.DOM.getPos(e,n)},getViewPort:function(e){return t.DOM.getViewPort(e)},get:function(e){return document.getElementById(e)},addClass:function(e,n){return t.DOM.addClass(e,n)},removeClass:function(e,n){return t.DOM.removeClass(e,n)},hasClass:function(e,n){return t.DOM.hasClass(e,n)},toggleClass:function(e,n,r){return t.DOM.toggleClass(e,n,r)},css:function(e,n,r){return t.DOM.setStyle(e,n,r)},getRuntimeStyle:function(e,n){return t.DOM.getStyle(e,n,!0)},on:function(e,n,r,i){return t.DOM.bind(e,n,r,i)},off:function(e,n,r){return t.DOM.unbind(e,n,r)},fire:function(e,n,r){return t.DOM.fire(e,n,r)},innerHtml:function(e,n){t.DOM.setHTML(e,n)}}}),r(K,[U,d,$,j,Y],function(e,t,n,r,i){function o(e){return e._eventDispatcher||(e._eventDispatcher=new n({scope:e,toggleEvent:function(t,r){r&&n.isNative(t)&&(e._nativeEvents||(e._nativeEvents={}),e._nativeEvents[t]=!0,e._rendered&&e.bindPendingEvents())}})),e._eventDispatcher}var a="onmousewheel"in document,s=!1,l="mce-",c=e.extend({Statics:{classPrefix:l},isRtl:function(){return c.rtl},classPrefix:l,init:function(e){var n=this,r,o;if(n.settings=e=t.extend({},n.Defaults,e),n._id=e.id||i.id(),n._text=n._name="",n._width=n._height=0,n._aria={role:e.role},this._elmCache={},r=e.classes)for(r=r.split(" "),r.map={},o=r.length;o--;)r.map[r[o]]=!0;n._classes=r||[],n.visible(!0),t.each("title text width height name classes visible disabled active value".split(" "),function(t){var r=e[t],i;r!==i?n[t](r):n["_"+t]===i&&(n["_"+t]=!1)}),n.on("click",function(){return n.disabled()?!1:void 0}),e.classes&&t.each(e.classes.split(" "),function(e){n.addClass(e)}),n.settings=e,n._borderBox=n.parseBox(e.border),n._paddingBox=n.parseBox(e.padding),n._marginBox=n.parseBox(e.margin),e.hidden&&n.hide()},Properties:"parent,title,text,width,height,disabled,active,name,value",Methods:"renderHtml",getContainerElm:function(){return document.body},getParentCtrl:function(e){for(var t,n=this.getRoot().controlIdLookup;e&&n&&!(t=n[e.id]);)e=e.parentNode;return t},parseBox:function(e){var t,n=10;if(e)return"number"==typeof e?(e=e||0,{top:e,left:e,bottom:e,right:e}):(e=e.split(" "),t=e.length,1===t?e[1]=e[2]=e[3]=e[0]:2===t?(e[2]=e[0],e[3]=e[1]):3===t&&(e[3]=e[1]),{top:parseInt(e[0],n)||0,right:parseInt(e[1],n)||0,bottom:parseInt(e[2],n)||0,left:parseInt(e[3],n)||0})},borderBox:function(){return this._borderBox},paddingBox:function(){return this._paddingBox},marginBox:function(){return this._marginBox},measureBox:function(e,t){function n(t){var n=document.defaultView;return n?(t=t.replace(/[A-Z]/g,function(e){return"-"+e}),n.getComputedStyle(e,null).getPropertyValue(t)):e.currentStyle[t]}function r(e){var t=parseFloat(n(e),10);return isNaN(t)?0:t}return{top:r(t+"TopWidth"),right:r(t+"RightWidth"),bottom:r(t+"BottomWidth"),left:r(t+"LeftWidth")}},initLayoutRect:function(){var e=this,t=e.settings,n,r,o=e.getEl(),a,s,l,c,u,d,f,p;n=e._borderBox=e._borderBox||e.measureBox(o,"border"),e._paddingBox=e._paddingBox||e.measureBox(o,"padding"),e._marginBox=e._marginBox||e.measureBox(o,"margin"),p=i.getSize(o),d=t.minWidth,f=t.minHeight,l=d||p.width,c=f||p.height,a=t.width,s=t.height,u=t.autoResize,u="undefined"!=typeof u?u:!a&&!s,a=a||l,s=s||c;var h=n.left+n.right,m=n.top+n.bottom,g=t.maxWidth||65535,v=t.maxHeight||65535;return e._layoutRect=r={x:t.x||0,y:t.y||0,w:a,h:s,deltaW:h,deltaH:m,contentW:a-h,contentH:s-m,innerW:a-h,innerH:s-m,startMinWidth:d||0,startMinHeight:f||0,minW:Math.min(l,g),minH:Math.min(c,v),maxW:g,maxH:v,autoResize:u,scrollW:0},e._lastLayoutRect={},r},layoutRect:function(e){var t=this,n=t._layoutRect,r,i,o,a,s,l;return n||(n=t.initLayoutRect()),e?(o=n.deltaW,a=n.deltaH,e.x!==s&&(n.x=e.x),e.y!==s&&(n.y=e.y),e.minW!==s&&(n.minW=e.minW),e.minH!==s&&(n.minH=e.minH),i=e.w,i!==s&&(i=i<n.minW?n.minW:i,i=i>n.maxW?n.maxW:i,n.w=i,n.innerW=i-o),i=e.h,i!==s&&(i=i<n.minH?n.minH:i,i=i>n.maxH?n.maxH:i,n.h=i,n.innerH=i-a),i=e.innerW,i!==s&&(i=i<n.minW-o?n.minW-o:i,i=i>n.maxW-o?n.maxW-o:i,n.innerW=i,n.w=i+o),i=e.innerH,i!==s&&(i=i<n.minH-a?n.minH-a:i,i=i>n.maxH-a?n.maxH-a:i,n.innerH=i,n.h=i+a),e.contentW!==s&&(n.contentW=e.contentW),e.contentH!==s&&(n.contentH=e.contentH),r=t._lastLayoutRect,(r.x!==n.x||r.y!==n.y||r.w!==n.w||r.h!==n.h)&&(l=c.repaintControls,l&&l.map&&!l.map[t._id]&&(l.push(t),l.map[t._id]=!0),r.x=n.x,r.y=n.y,r.w=n.w,r.h=n.h),t):n},repaint:function(){var e=this,t,n,r,i,o=0,a=0,s,l;l=document.createRange?function(e){return e}:Math.round,t=e.getEl().style,r=e._layoutRect,s=e._lastRepaintRect||{},i=e._borderBox,o=i.left+i.right,a=i.top+i.bottom,r.x!==s.x&&(t.left=l(r.x)+"px",s.x=r.x),r.y!==s.y&&(t.top=l(r.y)+"px",s.y=r.y),r.w!==s.w&&(t.width=l(r.w-o)+"px",s.w=r.w),r.h!==s.h&&(t.height=l(r.h-a)+"px",s.h=r.h),e._hasBody&&r.innerW!==s.innerW&&(n=e.getEl("body").style,n.width=l(r.innerW)+"px",s.innerW=r.innerW),e._hasBody&&r.innerH!==s.innerH&&(n=n||e.getEl("body").style,n.height=l(r.innerH)+"px",s.innerH=r.innerH),e._lastRepaintRect=s,e.fire("repaint",{},!1)},on:function(e,t){function n(e){var t,n;return"string"!=typeof e?e:function(i){return t||r.parentsAndSelf().each(function(r){var i=r.settings.callbacks;return i&&(t=i[e])?(n=r,!1):void 0}),t.call(n,i)}}var r=this;return o(r).on(e,n(t)),r},off:function(e,t){return o(this).off(e,t),this},fire:function(e,t,n){var r=this;if(t=t||{},t.control||(t.control=r),t=o(r).fire(e,t),n!==!1&&r.parent)for(var i=r.parent();i&&!t.isPropagationStopped();)i.fire(e,t,!1),i=i.parent();return t},hasEventListeners:function(e){return o(this).has(e)},parents:function(e){var t=this,n,i=new r;for(n=t.parent();n;n=n.parent())i.add(n);return e&&(i=i.filter(e)),i},parentsAndSelf:function(e){return new r(this).add(this.parents(e))},next:function(){var e=this.parent().items();return e[e.indexOf(this)+1]},prev:function(){var e=this.parent().items();return e[e.indexOf(this)-1]},findCommonAncestor:function(e,t){for(var n;e;){for(n=t;n&&e!=n;)n=n.parent();if(e==n)break;e=e.parent()}return e},hasClass:function(e,t){var n=this._classes[t||"control"];return e=this.classPrefix+e,n&&!!n.map[e]},addClass:function(e,t){var n=this,r,i;return e=this.classPrefix+e,r=n._classes[t||"control"],r||(r=[],r.map={},n._classes[t||"control"]=r),r.map[e]||(r.map[e]=e,r.push(e),n._rendered&&(i=n.getEl(t),i&&(i.className=r.join(" ")))),n},removeClass:function(e,t){var n=this,r,i,o;if(e=this.classPrefix+e,r=n._classes[t||"control"],r&&r.map[e])for(delete r.map[e],i=r.length;i--;)r[i]===e&&r.splice(i,1);return n._rendered&&(o=n.getEl(t),o&&(o.className=r.join(" "))),n},toggleClass:function(e,t,n){var r=this;return t?r.addClass(e,n):r.removeClass(e,n),r},classes:function(e){var t=this._classes[e||"control"];return t?t.join(" "):""},innerHtml:function(e){return i.innerHtml(this.getEl(),e),this},getEl:function(e){var t=e?this._id+"-"+e:this._id;return this._elmCache[t]||(this._elmCache[t]=i.get(t)),this._elmCache[t]},visible:function(e){var t=this,n;return"undefined"!=typeof e?(t._visible!==e&&(t._rendered&&(t.getEl().style.display=e?"":"none"),t._visible=e,n=t.parent(),n&&(n._lastRect=null),t.fire(e?"show":"hide")),t):t._visible},show:function(){return this.visible(!0)},hide:function(){return this.visible(!1)},focus:function(){try{this.getEl().focus()}catch(e){}return this},blur:function(){return this.getEl().blur(),this},aria:function(e,t){var n=this,r=n.getEl(n.ariaTarget);return"undefined"==typeof t?n._aria[e]:(n._aria[e]=t,n._rendered&&r.setAttribute("role"==e?e:"aria-"+e,t),n)},encode:function(e,t){return t!==!1&&(e=this.translate(e)),(e||"").replace(/[&<>"]/g,function(e){return"&#"+e.charCodeAt(0)+";"})},translate:function(e){return c.translate?c.translate(e):e},before:function(e){var t=this,n=t.parent();return n&&n.insert(e,n.items().indexOf(t),!0),t},after:function(e){var t=this,n=t.parent();return n&&n.insert(e,n.items().indexOf(t)),t},remove:function(){var e=this,t=e.getEl(),n=e.parent(),r,o;if(e.items){var a=e.items().toArray();for(o=a.length;o--;)a[o].remove()}n&&n.items&&(r=[],n.items().each(function(t){t!==e&&r.push(t)}),n.items().set(r),n._lastRect=null),e._eventsRoot&&e._eventsRoot==e&&i.off(t);var s=e.getRoot().controlIdLookup;return s&&delete s[e._id],t&&t.parentNode&&t.parentNode.removeChild(t),e._rendered=!1,e},renderBefore:function(e){var t=this;return e.parentNode.insertBefore(i.createFragment(t.renderHtml()),e),t.postRender(),t},renderTo:function(e){var t=this;return e=e||t.getContainerElm(),e.appendChild(i.createFragment(t.renderHtml())),t.postRender(),t},postRender:function(){var e=this,t=e.settings,n,r,o,a,s;for(a in t)0===a.indexOf("on")&&e.on(a.substr(2),t[a]);if(e._eventsRoot){for(o=e.parent();!s&&o;o=o.parent())s=o._eventsRoot;if(s)for(a in s._nativeEvents)e._nativeEvents[a]=!0}e.bindPendingEvents(),t.style&&(n=e.getEl(),n&&(n.setAttribute("style",t.style),n.style.cssText=t.style)),e._visible||i.css(e.getEl(),"display","none"),e.settings.border&&(r=e.borderBox(),i.css(e.getEl(),{"border-top-width":r.top,"border-right-width":r.right,"border-bottom-width":r.bottom,"border-left-width":r.left}));var l=e.getRoot();l.controlIdLookup||(l.controlIdLookup={}),l.controlIdLookup[e._id]=e;for(var c in e._aria)e.aria(c,e._aria[c]);e.fire("postrender",{},!1)},scrollIntoView:function(e){function t(e,t){var n,r,i=e;for(n=r=0;i&&i!=t&&i.nodeType;)n+=i.offsetLeft||0,r+=i.offsetTop||0,i=i.offsetParent;return{x:n,y:r}}var n=this.getEl(),r=n.parentNode,i,o,a,s,l,c,u=t(n,r);return i=u.x,o=u.y,a=n.offsetWidth,s=n.offsetHeight,l=r.clientWidth,c=r.clientHeight,"end"==e?(i-=l-a,o-=c-s):"center"==e&&(i-=l/2-a/2,o-=c/2-s/2),r.scrollLeft=i,r.scrollTop=o,this},bindPendingEvents:function(){function e(e){var t=o.getParentCtrl(e.target);t&&t.fire(e.type,e)}function t(){var e=d._lastHoverCtrl;e&&(e.fire("mouseleave",{target:e.getEl()}),e.parents().each(function(e){e.fire("mouseleave",{target:e.getEl()})}),d._lastHoverCtrl=null)}function n(e){var t=o.getParentCtrl(e.target),n=d._lastHoverCtrl,r=0,i,a,s;if(t!==n){if(d._lastHoverCtrl=t,a=t.parents().toArray().reverse(),a.push(t),n){for(s=n.parents().toArray().reverse(),s.push(n),r=0;r<s.length&&a[r]===s[r];r++);for(i=s.length-1;i>=r;i--)n=s[i],n.fire("mouseleave",{target:n.getEl()})}for(i=r;i<a.length;i++)t=a[i],t.fire("mouseenter",{target:t.getEl()})}}function r(e){e.preventDefault(),"mousewheel"==e.type?(e.deltaY=-1/40*e.wheelDelta,e.wheelDeltaX&&(e.deltaX=-1/40*e.wheelDeltaX)):(e.deltaX=0,e.deltaY=e.detail),e=o.fire("wheel",e)}var o=this,l,c,u,d,f,p;if(o._rendered=!0,f=o._nativeEvents){for(u=o.parents().toArray(),u.unshift(o),l=0,c=u.length;!d&&c>l;l++)d=u[l]._eventsRoot;for(d||(d=u[u.length-1]||o),o._eventsRoot=d,c=l,l=0;c>l;l++)u[l]._eventsRoot=d;var h=d._delegates;h||(h=d._delegates={});for(p in f){if(!f)return!1;"wheel"!==p||s?("mouseenter"===p||"mouseleave"===p?d._hasMouseEnter||(i.on(d.getEl(),"mouseleave",t),i.on(d.getEl(),"mouseover",n),d._hasMouseEnter=1):h[p]||(i.on(d.getEl(),p,e),h[p]=!0),f[p]=!1):a?i.on(o.getEl(),"mousewheel",r):i.on(o.getEl(),"DOMMouseScroll",r)}}},getRoot:function(){for(var e=this,t,n=[];e;){if(e.rootControl){t=e.rootControl;break}n.push(e),t=e,e=e.parent()}t||(t=this);for(var r=n.length;r--;)n[r].rootControl=t;return t},reflow:function(){return this.repaint(),this}});return c}),r(G,[],function(){var e={},t;return{add:function(t,n){e[t.toLowerCase()]=n},has:function(t){return!!e[t.toLowerCase()]},create:function(n,r){var i,o,a;if(!t){a=tinymce.ui;for(o in a)e[o.toLowerCase()]=a[o];t=!0}if("string"==typeof n?(r=r||{},r.type=n):(r=n,n=r.type),n=n.toLowerCase(),i=e[n],!i)throw new Error("Could not find control by type: "+n);return i=new i(r),i.type=n,i}}}),r(X,[],function(){return function(e){function t(e){return e=e||b,e&&e.getAttribute("role")}function n(e){for(var n,r=e||b;r=r.parentNode;)if(n=t(r))return n}function r(e){var t=b;return t?t.getAttribute("aria-"+e):void 0}function i(e){var t=e.tagName.toUpperCase();return"INPUT"==t||"TEXTAREA"==t}function o(e){return i(e)&&!e.hidden?!0:/^(button|menuitem|checkbox|tab|menuitemcheckbox|option|gridcell)$/.test(t(e))?!0:!1}function a(e){function t(e){if(1==e.nodeType&&"none"!=e.style.display){o(e)&&n.push(e);for(var r=0;r<e.childNodes.length;r++)t(e.childNodes[r])}}var n=[];return t(e||y.getEl()),n}function s(e){var t,n;e=e||C,n=e.parents().toArray(),n.unshift(e);for(var r=0;r<n.length&&(t=n[r],!t.settings.ariaRoot);r++);return t}function l(e){var t=s(e),n=a(t.getEl());t.settings.ariaRemember&&"lastAriaIndex"in t?c(t.lastAriaIndex,n):c(0,n)}function c(e,t){return 0>e?e=t.length-1:e>=t.length&&(e=0),t[e]&&t[e].focus(),e}function u(e,t){var n=-1,r=s();t=t||a(r.getEl());for(var i=0;i<t.length;i++)t[i]===b&&(n=i);n+=e,r.lastAriaIndex=c(n,t)}function d(){var e=n();"tablist"==e?u(-1,a(b.parentNode)):C.parent().submenu?g():u(-1)}function f(){var e=t(),i=n();"tablist"==i?u(1,a(b.parentNode)):"menuitem"==e&&"menu"==i&&r("haspopup")?v():u(1)}function p(){u(-1)}function h(){var e=t(),i=n();"menuitem"==e&&"menubar"==i?v():"button"==e&&r("haspopup")?v({key:"down"}):u(1)}function m(e){var t=n();if("tablist"==t){var r=a(C.getEl("body"))[0];r&&r.focus()}else u(e.shiftKey?-1:1)}function g(){C.fire("cancel")}function v(e){e=e||{},C.fire("click",{target:b,aria:e})}var y=e.root,b,C;try{b=document.activeElement}catch(x){b=document.body}return C=y.getParentCtrl(b),y.on("keydown",function(e){function t(e,t){i(b)||t(e)!==!1&&e.preventDefault()}if(!e.isDefaultPrevented())switch(e.keyCode){case 37:t(e,d);break;case 39:t(e,f);break;case 38:t(e,p);break;case 40:t(e,h);break;case 27:g();break;case 14:case 13:case 32:t(e,v);break;case 9:m(e)!==!1&&e.preventDefault()}}),y.on("focusin",function(e){b=e.target,C=e.control}),{focusFirst:l}}}),r(J,[K,j,q,G,X,d,Y],function(e,t,n,r,i,o,a){var s={};return e.extend({layout:"",innerClass:"container-inner",init:function(e){var n=this;n._super(e),e=n.settings,n._fixed=e.fixed,n._items=new t,n.isRtl()&&n.addClass("rtl"),n.addClass("container"),n.addClass("container-body","body"),e.containerCls&&n.addClass(e.containerCls),n._layout=r.create((e.layout||n.layout)+"layout"),n.settings.items&&n.add(n.settings.items),n._hasBody=!0},items:function(){return this._items},find:function(e){return e=s[e]=s[e]||new n(e),e.find(this)},add:function(e){var t=this;return t.items().add(t.create(e)).parent(t),t
},focus:function(e){var t=this,n,r,i;return e&&(r=t.keyboardNav||t.parents().eq(-1)[0].keyboardNav)?void r.focusFirst(t):(i=t.find("*"),t.statusbar&&i.add(t.statusbar.items()),i.each(function(e){return e.settings.autofocus?(n=null,!1):void(e.canFocus&&(n=n||e))}),n&&n.focus(),t)},replace:function(e,t){for(var n,r=this.items(),i=r.length;i--;)if(r[i]===e){r[i]=t;break}i>=0&&(n=t.getEl(),n&&n.parentNode.removeChild(n),n=e.getEl(),n&&n.parentNode.removeChild(n)),t.parent(this)},create:function(t){var n=this,i,a=[];return o.isArray(t)||(t=[t]),o.each(t,function(t){t&&(t instanceof e||("string"==typeof t&&(t={type:t}),i=o.extend({},n.settings.defaults,t),t.type=i.type=i.type||t.type||n.settings.defaultType||(i.defaults?i.defaults.type:null),t=r.create(i)),a.push(t))}),a},renderNew:function(){var e=this;return e.items().each(function(t,n){var r,i;t.parent(e),t._rendered||(r=e.getEl("body"),i=a.createFragment(t.renderHtml()),r.hasChildNodes()&&n<=r.childNodes.length-1?r.insertBefore(i,r.childNodes[n]):r.appendChild(i),t.postRender())}),e._layout.applyClasses(e),e._lastRect=null,e},append:function(e){return this.add(e).renderNew()},prepend:function(e){var t=this;return t.items().set(t.create(e).concat(t.items().toArray())),t.renderNew()},insert:function(e,t,n){var r=this,i,o,a;return e=r.create(e),i=r.items(),!n&&t<i.length-1&&(t+=1),t>=0&&t<i.length&&(o=i.slice(0,t).toArray(),a=i.slice(t).toArray(),i.set(o.concat(e,a))),r.renderNew()},fromJSON:function(e){var t=this;for(var n in e)t.find("#"+n).value(e[n]);return t},toJSON:function(){var e=this,t={};return e.find("*").each(function(e){var n=e.name(),r=e.value();n&&"undefined"!=typeof r&&(t[n]=r)}),t},preRender:function(){},renderHtml:function(){var e=this,t=e._layout,n=this.settings.role;return e.preRender(),t.preRender(e),'<div id="'+e._id+'" class="'+e.classes()+'"'+(n?' role="'+this.settings.role+'"':"")+'><div id="'+e._id+'-body" class="'+e.classes("body")+'">'+(e.settings.html||"")+t.renderHtml(e)+"</div></div>"},postRender:function(){var e=this,t;return e.items().exec("postRender"),e._super(),e._layout.postRender(e),e._rendered=!0,e.settings.style&&a.css(e.getEl(),e.settings.style),e.settings.border&&(t=e.borderBox(),a.css(e.getEl(),{"border-top-width":t.top,"border-right-width":t.right,"border-bottom-width":t.bottom,"border-left-width":t.left})),e.parent()||(e.keyboardNav=new i({root:e})),e},initLayoutRect:function(){var e=this,t=e._super();return e._layout.recalc(e),t},recalc:function(){var e=this,t=e._layoutRect,n=e._lastRect;return n&&n.w==t.w&&n.h==t.h?void 0:(e._layout.recalc(e),t=e.layoutRect(),e._lastRect={x:t.x,y:t.y,w:t.w,h:t.h},!0)},reflow:function(){var t;if(this.visible()){for(e.repaintControls=[],e.repaintControls.map={},this.recalc(),t=e.repaintControls.length;t--;)e.repaintControls[t].repaint();"flow"!==this.settings.layout&&"stack"!==this.settings.layout&&this.repaint(),e.repaintControls=[]}return this}})}),r(Q,[Y],function(e){function t(){var e=document,t,n,r,i,o,a,s,l,c=Math.max;return t=e.documentElement,n=e.body,r=c(t.scrollWidth,n.scrollWidth),i=c(t.clientWidth,n.clientWidth),o=c(t.offsetWidth,n.offsetWidth),a=c(t.scrollHeight,n.scrollHeight),s=c(t.clientHeight,n.clientHeight),l=c(t.offsetHeight,n.offsetHeight),{width:o>r?i:r,height:l>a?s:a}}return function(n,r){function i(){return a.getElementById(r.handle||n)}var o,a=document,s,l,c,u,d,f;r=r||{},l=function(n){var l=t(),p,h;n.preventDefault(),s=n.button,p=i(),d=n.screenX,f=n.screenY,h=window.getComputedStyle?window.getComputedStyle(p,null).getPropertyValue("cursor"):p.runtimeStyle.cursor,o=a.createElement("div"),e.css(o,{position:"absolute",top:0,left:0,width:l.width,height:l.height,zIndex:2147483647,opacity:1e-4,cursor:h}),a.body.appendChild(o),e.on(a,"mousemove",u),e.on(a,"mouseup",c),r.start(n)},u=function(e){return e.button!==s?c(e):(e.deltaX=e.screenX-d,e.deltaY=e.screenY-f,e.preventDefault(),void r.drag(e))},c=function(t){e.off(a,"mousemove",u),e.off(a,"mouseup",c),o.parentNode.removeChild(o),r.stop&&r.stop(t)},this.destroy=function(){e.off(i())},e.on(i(),"mousedown",l)}}),r(Z,[Y,Q],function(e,t){return{init:function(){var e=this;e.on("repaint",e.renderScroll)},renderScroll:function(){function n(){function t(t,a,s,l,c,u){var d,f,p,h,m,g,v,y,b;if(f=i.getEl("scroll"+t)){if(y=a.toLowerCase(),b=s.toLowerCase(),i.getEl("absend")&&e.css(i.getEl("absend"),y,i.layoutRect()[l]-1),!c)return void e.css(f,"display","none");e.css(f,"display","block"),d=i.getEl("body"),p=i.getEl("scroll"+t+"t"),h=d["client"+s]-2*o,h-=n&&r?f["client"+u]:0,m=d["scroll"+s],g=h/m,v={},v[y]=d["offset"+a]+o,v[b]=h,e.css(f,v),v={},v[y]=d["scroll"+a]*g,v[b]=h*g,e.css(p,v)}}var n,r,a;a=i.getEl("body"),n=a.scrollWidth>a.clientWidth,r=a.scrollHeight>a.clientHeight,t("h","Left","Width","contentW",n,"Height"),t("v","Top","Height","contentH",r,"Width")}function r(){function n(n,r,a,s,l){var c,u=i._id+"-scroll"+n,d=i.classPrefix;i.getEl().appendChild(e.createFragment('<div id="'+u+'" class="'+d+"scrollbar "+d+"scrollbar-"+n+'"><div id="'+u+'t" class="'+d+'scrollbar-thumb"></div></div>')),i.draghelper=new t(u+"t",{start:function(){c=i.getEl("body")["scroll"+r],e.addClass(e.get(u),d+"active")},drag:function(e){var t,u,d,f,p=i.layoutRect();u=p.contentW>p.innerW,d=p.contentH>p.innerH,f=i.getEl("body")["client"+a]-2*o,f-=u&&d?i.getEl("scroll"+n)["client"+l]:0,t=f/i.getEl("body")["scroll"+a],i.getEl("body")["scroll"+r]=c+e["delta"+s]/t},stop:function(){e.removeClass(e.get(u),d+"active")}})}i.addClass("scroll"),n("v","Top","Height","Y","Width"),n("h","Left","Width","X","Height")}var i=this,o=2;i.settings.autoScroll&&(i._hasScroll||(i._hasScroll=!0,r(),i.on("wheel",function(e){var t=i.getEl("body");t.scrollLeft+=10*(e.deltaX||0),t.scrollTop+=10*e.deltaY,n()}),e.on(i.getEl("body"),"scroll",n)),n())}}}),r(et,[J,Z],function(e,t){return e.extend({Defaults:{layout:"fit",containerCls:"panel"},Mixins:[t],renderHtml:function(){var e=this,t=e._layout,n=e.settings.html;return e.preRender(),t.preRender(e),"undefined"==typeof n?n='<div id="'+e._id+'-body" class="'+e.classes("body")+'">'+t.renderHtml(e)+"</div>":("function"==typeof n&&(n=n.call(e)),e._hasBody=!1),'<div id="'+e._id+'" class="'+e.classes()+'" hidefocus="1" tabindex="-1" role="group">'+(e._preBodyHtml||"")+n+"</div>"}})}),r(tt,[Y],function(e){function t(t,n,r){var i,o,a,s,l,c,u,d,f,p;return f=e.getViewPort(),o=e.getPos(n),a=o.x,s=o.y,t._fixed&&"static"==e.getRuntimeStyle(document.body,"position")&&(a-=f.x,s-=f.y),i=t.getEl(),p=e.getSize(i),l=p.width,c=p.height,p=e.getSize(n),u=p.width,d=p.height,r=(r||"").split(""),"b"===r[0]&&(s+=d),"r"===r[1]&&(a+=u),"c"===r[0]&&(s+=Math.round(d/2)),"c"===r[1]&&(a+=Math.round(u/2)),"b"===r[3]&&(s-=c),"r"===r[4]&&(a-=l),"c"===r[3]&&(s-=Math.round(c/2)),"c"===r[4]&&(a-=Math.round(l/2)),{x:a,y:s,w:l,h:c}}return{testMoveRel:function(n,r){for(var i=e.getViewPort(),o=0;o<r.length;o++){var a=t(this,n,r[o]);if(this._fixed){if(a.x>0&&a.x+a.w<i.w&&a.y>0&&a.y+a.h<i.h)return r[o]}else if(a.x>i.x&&a.x+a.w<i.w+i.x&&a.y>i.y&&a.y+a.h<i.h+i.y)return r[o]}return r[0]},moveRel:function(e,n){"string"!=typeof n&&(n=this.testMoveRel(e,n));var r=t(this,e,n);return this.moveTo(r.x,r.y)},moveBy:function(e,t){var n=this,r=n.layoutRect();return n.moveTo(r.x+e,r.y+t),n},moveTo:function(t,n){function r(e,t,n){return 0>e?0:e+n>t?(e=t-n,0>e?0:e):e}var i=this;if(i.settings.constrainToViewport){var o=e.getViewPort(window),a=i.layoutRect();t=r(t,o.w+o.x,a.w),n=r(n,o.h+o.y,a.h)}return i._rendered?i.layoutRect({x:t,y:n}).repaint():(i.settings.x=t,i.settings.y=n),i.fire("move",{x:t,y:n}),i}}}),r(nt,[Y],function(e){return{resizeToContent:function(){this._layoutRect.autoResize=!0,this._lastRect=null,this.reflow()},resizeTo:function(t,n){if(1>=t||1>=n){var r=e.getWindowSize();t=1>=t?t*r.w:t,n=1>=n?n*r.h:n}return this._layoutRect.autoResize=!1,this.layoutRect({minW:t,minH:n,w:t,h:n}).reflow()},resizeBy:function(e,t){var n=this,r=n.layoutRect();return n.resizeTo(r.w+e,r.h+t)}}}),r(rt,[et,tt,nt,Y],function(e,t,n,r){function i(){function e(e,t){for(;e;){if(e==t)return!0;e=e.parent()}}u||(u=function(t){if(2!=t.button)for(var n=p.length;n--;){var r=p[n],i=r.getParentCtrl(t.target);if(r.settings.autohide){if(i&&(e(i,r)||r.parent()===i))continue;t=r.fire("autohide",{target:t.target}),t.isDefaultPrevented()||r.hide()}}},r.on(document,"click",u))}function o(){d||(d=function(){var e;for(e=p.length;e--;)s(p[e])},r.on(window,"scroll",d))}function a(){if(!f){var e=document.documentElement,t=e.clientWidth,n=e.clientHeight;f=function(){document.all&&t==e.clientWidth&&n==e.clientHeight||(t=e.clientWidth,n=e.clientHeight,g.hideAll())},r.on(window,"resize",f)}}function s(e){function t(t,n){for(var r,i=0;i<p.length;i++)if(p[i]!=e)for(r=p[i].parent();r&&(r=r.parent());)r==e&&p[i].fixed(t).moveBy(0,n).repaint()}var n=r.getViewPort().y;e.settings.autofix&&(e._fixed?e._autoFixY>n&&(e.fixed(!1).layoutRect({y:e._autoFixY}).repaint(),t(!1,e._autoFixY-n)):(e._autoFixY=e.layoutRect().y,e._autoFixY<n&&(e.fixed(!0).layoutRect({y:0}).repaint(),t(!0,n-e._autoFixY))))}function l(e,t){var n,i=g.zIndex||65535,o;if(e)h.push(t);else for(n=h.length;n--;)h[n]===t&&h.splice(n,1);if(h.length)for(n=0;n<h.length;n++)h[n].modal&&(i++,o=h[n]),h[n].getEl().style.zIndex=i,h[n].zIndex=i,i++;var a=document.getElementById(t.classPrefix+"modal-block");o?r.css(a,"z-index",o.zIndex-1):a&&(a.parentNode.removeChild(a),m=!1),g.currentZIndex=i}function c(e){var t;for(t=p.length;t--;)p[t]===e&&p.splice(t,1);for(t=h.length;t--;)h[t]===e&&h.splice(t,1)}var u,d,f,p=[],h=[],m,g=e.extend({Mixins:[t,n],init:function(e){var t=this;t._super(e),t._eventsRoot=t,t.addClass("floatpanel"),e.autohide&&(i(),a(),p.push(t)),e.autofix&&(o(),t.on("move",function(){s(this)})),t.on("postrender show",function(e){if(e.control==t){var n,i=t.classPrefix;t.modal&&!m&&(n=r.createFragment('<div id="'+i+'modal-block" class="'+i+"reset "+i+'fade"></div>'),n=n.firstChild,t.getContainerElm().appendChild(n),setTimeout(function(){r.addClass(n,i+"in"),r.addClass(t.getEl(),i+"in")},0),m=!0),l(!0,t)}}),t.on("show",function(){t.parents().each(function(e){return e._fixed?(t.fixed(!0),!1):void 0})}),e.popover&&(t._preBodyHtml='<div class="'+t.classPrefix+'arrow"></div>',t.addClass("popover").addClass("bottom").addClass(t.isRtl()?"end":"start"))},fixed:function(e){var t=this;if(t._fixed!=e){if(t._rendered){var n=r.getViewPort();e?t.layoutRect().y-=n.y:t.layoutRect().y+=n.y}t.toggleClass("fixed",e),t._fixed=e}return t},show:function(){var e=this,t,n=e._super();for(t=p.length;t--&&p[t]!==e;);return-1===t&&p.push(e),n},hide:function(){return c(this),l(!1,this),this._super()},hideAll:function(){g.hideAll()},close:function(){var e=this;return e.fire("close").isDefaultPrevented()||(e.remove(),l(!1,e)),e},remove:function(){c(this),this._super()},postRender:function(){var e=this;return e.settings.bodyRole&&this.getEl("body").setAttribute("role",e.settings.bodyRole),e._super()}});return g.hideAll=function(){for(var e=p.length;e--;){var t=p[e];t&&t.settings.autohide&&(t.hide(),p.splice(e,1))}},g}),r(it,[rt,et,Y,Q],function(e,t,n,r){var i=e.extend({modal:!0,Defaults:{border:1,layout:"flex",containerCls:"panel",role:"dialog",callbacks:{submit:function(){this.fire("submit",{data:this.toJSON()})},close:function(){this.close()}}},init:function(e){var n=this;n._super(e),n.isRtl()&&n.addClass("rtl"),n.addClass("window"),n._fixed=!0,e.buttons&&(n.statusbar=new t({layout:"flex",border:"1 0 0 0",spacing:3,padding:10,align:"center",pack:n.isRtl()?"start":"end",defaults:{type:"button"},items:e.buttons}),n.statusbar.addClass("foot"),n.statusbar.parent(n)),n.on("click",function(e){-1!=e.target.className.indexOf(n.classPrefix+"close")&&n.close()}),n.on("cancel",function(){n.close()}),n.aria("describedby",n.describedBy||n._id+"-none"),n.aria("label",e.title),n._fullscreen=!1},recalc:function(){var e=this,t=e.statusbar,r,i,o,a;e._fullscreen&&(e.layoutRect(n.getWindowSize()),e.layoutRect().contentH=e.layoutRect().innerH),e._super(),r=e.layoutRect(),e.settings.title&&!e._fullscreen&&(i=r.headerW,i>r.w&&(o=r.x-Math.max(0,i/2),e.layoutRect({w:i,x:o}),a=!0)),t&&(t.layoutRect({w:e.layoutRect().innerW}).recalc(),i=t.layoutRect().minW+r.deltaW,i>r.w&&(o=r.x-Math.max(0,i-r.w),e.layoutRect({w:i,x:o}),a=!0)),a&&e.recalc()},initLayoutRect:function(){var e=this,t=e._super(),r=0,i;if(e.settings.title&&!e._fullscreen){i=e.getEl("head");var o=n.getSize(i);t.headerW=o.width,t.headerH=o.height,r+=t.headerH}e.statusbar&&(r+=e.statusbar.layoutRect().h),t.deltaH+=r,t.minH+=r,t.h+=r;var a=n.getWindowSize();return t.x=Math.max(0,a.w/2-t.w/2),t.y=Math.max(0,a.h/2-t.h/2),t},renderHtml:function(){var e=this,t=e._layout,n=e._id,r=e.classPrefix,i=e.settings,o="",a="",s=i.html;return e.preRender(),t.preRender(e),i.title&&(o='<div id="'+n+'-head" class="'+r+'window-head"><div id="'+n+'-title" class="'+r+'title">'+e.encode(i.title)+'</div><button type="button" class="'+r+'close" aria-hidden="true">\xd7</button><div id="'+n+'-dragh" class="'+r+'dragh"></div></div>'),i.url&&(s='<iframe src="'+i.url+'" tabindex="-1"></iframe>'),"undefined"==typeof s&&(s=t.renderHtml(e)),e.statusbar&&(a=e.statusbar.renderHtml()),'<div id="'+n+'" class="'+e.classes()+'" hidefocus="1"><div class="'+e.classPrefix+'reset" role="application">'+o+'<div id="'+n+'-body" class="'+e.classes("body")+'">'+s+"</div>"+a+"</div></div>"},fullscreen:function(e){var t=this,r=document.documentElement,i,o=t.classPrefix,a;if(e!=t._fullscreen)if(n.on(window,"resize",function(){var e;if(t._fullscreen)if(i)t._timer||(t._timer=setTimeout(function(){var e=n.getWindowSize();t.moveTo(0,0).resizeTo(e.w,e.h),t._timer=0},50));else{e=(new Date).getTime();var r=n.getWindowSize();t.moveTo(0,0).resizeTo(r.w,r.h),(new Date).getTime()-e>50&&(i=!0)}}),a=t.layoutRect(),t._fullscreen=e,e){t._initial={x:a.x,y:a.y,w:a.w,h:a.h},t._borderBox=t.parseBox("0"),t.getEl("head").style.display="none",a.deltaH-=a.headerH+2,n.addClass(r,o+"fullscreen"),n.addClass(document.body,o+"fullscreen"),t.addClass("fullscreen");var s=n.getWindowSize();t.moveTo(0,0).resizeTo(s.w,s.h)}else t._borderBox=t.parseBox(t.settings.border),t.getEl("head").style.display="",a.deltaH+=a.headerH,n.removeClass(r,o+"fullscreen"),n.removeClass(document.body,o+"fullscreen"),t.removeClass("fullscreen"),t.moveTo(t._initial.x,t._initial.y).resizeTo(t._initial.w,t._initial.h);return t.reflow()},postRender:function(){var e=this,t;setTimeout(function(){e.addClass("in")},0),e._super(),e.statusbar&&e.statusbar.postRender(),e.focus(),this.dragHelper=new r(e._id+"-dragh",{start:function(){t={x:e.layoutRect().x,y:e.layoutRect().y}},drag:function(n){e.moveTo(t.x+n.deltaX,t.y+n.deltaY)}}),e.on("submit",function(t){t.isDefaultPrevented()||e.close()})},submit:function(){return this.fire("submit",{data:this.toJSON()})},remove:function(){var e=this,t=e.classPrefix;e.dragHelper.destroy(),e._super(),e.statusbar&&this.statusbar.remove(),e._fullscreen&&(n.removeClass(document.documentElement,t+"fullscreen"),n.removeClass(document.body,t+"fullscreen"))},getContentWindow:function(){var e=this.getEl().getElementsByTagName("iframe")[0];return e?e.contentWindow:null}});return i}),r(ot,[it],function(e){var t=e.extend({init:function(e){e={border:1,padding:20,layout:"flex",pack:"center",align:"center",containerCls:"panel",autoScroll:!0,buttons:{type:"button",text:"Ok",action:"ok"},items:{type:"label",multiline:!0,maxWidth:500,maxHeight:200}},this._super(e)},Statics:{OK:1,OK_CANCEL:2,YES_NO:3,YES_NO_CANCEL:4,msgBox:function(n){function r(e,t,n){return{type:"button",text:e,subtype:n?"primary":"",onClick:function(e){e.control.parents()[1].close(),o(t)}}}var i,o=n.callback||function(){};switch(n.buttons){case t.OK_CANCEL:i=[r("Ok",!0,!0),r("Cancel",!1)];break;case t.YES_NO:case t.YES_NO_CANCEL:i=[r("Yes",1,!0),r("No",0)],n.buttons==t.YES_NO_CANCEL&&i.push(r("Cancel",-1));break;default:i=[r("Ok",!0,!0)]}return new e({padding:20,x:n.x,y:n.y,minWidth:300,minHeight:100,layout:"flex",pack:"center",align:"center",buttons:i,title:n.title,role:"alertdialog",items:{type:"label",multiline:!0,maxWidth:500,maxHeight:200,text:n.text},onPostRender:function(){this.aria("describedby",this.items()[0]._id)},onClose:n.onClose,onCancel:function(){o(!1)}}).renderTo(document.body).reflow()},alert:function(e,n){return"string"==typeof e&&(e={text:e}),e.callback=n,t.msgBox(e)},confirm:function(e,n){return"string"==typeof e&&(e={text:e}),e.callback=n,e.buttons=t.OK_CANCEL,t.msgBox(e)}}});return t}),r(at,[it,ot],function(e,t){return function(n){function r(){return o.length?o[o.length-1]:void 0}var i=this,o=[];i.windows=o,n.on("remove",function(){for(var e=o.length;e--;)o[e].close()}),i.open=function(t,r){var i;return n.editorManager.setActive(n),t.title=t.title||" ",t.url=t.url||t.file,t.url&&(t.width=parseInt(t.width||320,10),t.height=parseInt(t.height||240,10)),t.body&&(t.items={defaults:t.defaults,type:t.bodyType||"form",items:t.body}),t.url||t.buttons||(t.buttons=[{text:"Ok",subtype:"primary",onclick:function(){i.find("form")[0].submit()}},{text:"Cancel",onclick:function(){i.close()}}]),i=new e(t),o.push(i),i.on("close",function(){for(var e=o.length;e--;)o[e]===i&&o.splice(e,1);o.length||n.focus()}),t.data&&i.on("postRender",function(){this.find("*").each(function(e){var n=e.name();n in t.data&&e.value(t.data[n])})}),i.features=t||{},i.params=r||{},1===o.length&&n.nodeChanged(),i.renderTo().reflow()},i.alert=function(e,r,i){t.alert(e,function(){r?r.call(i||this):n.focus()})},i.confirm=function(e,n,r){t.confirm(e,function(e){n.call(r||this,e)})},i.close=function(){r()&&r().close()},i.getParams=function(){return r()?r().params:null},i.setParams=function(e){r()&&(r().params=e)},i.getWindows=function(){return o}}}),r(st,[B,x,_,g,u,d],function(e,t,n,r,i,o){return function(a){function s(e,t){try{a.getDoc().execCommand(e,!1,t)}catch(n){}}function l(){var e=a.getDoc().documentMode;return e?e:6}function c(e){return e.isDefaultPrevented()}function u(){function t(e){var t=new i(function(){});o.each(a.getBody().getElementsByTagName("*"),function(e){"SPAN"==e.tagName&&e.setAttribute("mce-data-marked",1),!e.hasAttribute("data-mce-style")&&e.hasAttribute("style")&&a.dom.setAttrib(e,"style",a.dom.getAttrib(e,"style"))}),t.observe(a.getDoc(),{childList:!0,attributes:!0,subtree:!0,attributeFilter:["style"]}),a.getDoc().execCommand(e?"ForwardDelete":"Delete",!1,null);var n=a.selection.getRng(),r=n.startContainer.parentNode;o.each(t.takeRecords(),function(e){if(q.isChildOf(e.target,a.getBody())){if("style"==e.attributeName){var t=e.target.getAttribute("data-mce-style");t?e.target.setAttribute("style",t):e.target.removeAttribute("style")}o.each(e.addedNodes,function(e){if("SPAN"==e.nodeName&&!e.getAttribute("mce-data-marked")){var t,i;e==r&&(t=n.startOffset,i=e.firstChild),q.remove(e,!0),i&&(n.setStart(i,t),n.setEnd(i,t),a.selection.setRng(n))}})}}),t.disconnect(),o.each(a.dom.select("span[mce-data-marked]"),function(e){e.removeAttribute("mce-data-marked")})}var n=a.getDoc(),r="data:text/mce-internal,",i=window.MutationObserver,s,l;i||(s=!0,i=function(){function e(e){var t=e.relatedNode||e.target;n.push({target:t,addedNodes:[t]})}function t(e){var t=e.relatedNode||e.target;n.push({target:t,attributeName:e.attrName})}var n=[],r;this.observe=function(n){r=n,r.addEventListener("DOMSubtreeModified",e,!1),r.addEventListener("DOMNodeInsertedIntoDocument",e,!1),r.addEventListener("DOMNodeInserted",e,!1),r.addEventListener("DOMAttrModified",t,!1)},this.disconnect=function(){r.removeEventListener("DOMSubtreeModified",e,!1),r.removeEventListener("DOMNodeInsertedIntoDocument",e,!1),r.removeEventListener("DOMNodeInserted",e,!1),r.removeEventListener("DOMAttrModified",t,!1)},this.takeRecords=function(){return n}}),a.on("keydown",function(n){var r=n.keyCode==$,i=e.metaKeyPressed(n);if(!c(n)&&(r||n.keyCode==U)){var o=a.selection.getRng(),s=o.startContainer,l=o.startOffset;if(!i&&o.collapsed&&3==s.nodeType&&(r?l<s.data.length:l>0))return;n.preventDefault(),i&&a.selection.getSel().modify("extend",r?"forward":"backward","word"),t(r)}}),a.on("keypress",function(n){c(n)||j.isCollapsed()||!n.charCode||e.metaKeyPressed(n)||(n.preventDefault(),t(!0),a.selection.setContent(String.fromCharCode(n.charCode)))}),a.addCommand("Delete",function(){t()}),a.addCommand("ForwardDelete",function(){t(!0)}),s||(a.on("dragstart",function(e){var t;a.selection.isCollapsed()&&"IMG"==e.target.tagName&&j.select(e.target),l=j.getRng(),t=a.selection.getContent(),t.length>0&&e.dataTransfer.setData("URL","data:text/mce-internal,"+escape(t))}),a.on("drop",function(e){if(!c(e)){var i=e.dataTransfer.getData("URL");if(!i||-1==i.indexOf(r)||!n.caretRangeFromPoint)return;i=unescape(i.substr(r.length)),n.caretRangeFromPoint&&(e.preventDefault(),window.setTimeout(function(){var r=n.caretRangeFromPoint(e.x,e.y);l&&(j.setRng(l),l=null),t(),j.setRng(r),a.insertContent(i)},0))}}),a.on("cut",function(e){!c(e)&&e.clipboardData&&(e.preventDefault(),e.clipboardData.clearData(),e.clipboardData.setData("text/html",a.selection.getContent()),e.clipboardData.setData("text/plain",a.selection.getContent({format:"text"})),t(!0))}))}function d(){function e(e){var t=q.create("body"),n=e.cloneContents();return t.appendChild(n),j.serializer.serialize(t,{format:"html"})}function n(n){if(!n.setStart){if(n.item)return!1;var r=n.duplicate();return r.moveToElementText(a.getBody()),t.compareRanges(n,r)}var i=e(n),o=q.createRng();o.selectNode(a.getBody());var s=e(o);return i===s}a.on("keydown",function(e){var t=e.keyCode,r,i;if(!c(e)&&(t==$||t==U)){if(r=a.selection.isCollapsed(),i=a.getBody(),r&&!q.isEmpty(i))return;if(!r&&!n(a.selection.getRng()))return;e.preventDefault(),a.setContent(""),i.firstChild&&q.isBlock(i.firstChild)?a.selection.setCursorLocation(i.firstChild,0):a.selection.setCursorLocation(i,0),a.nodeChanged()}})}function f(){a.shortcuts.add("ctrl+a",null,"SelectAll")}function p(){a.settings.content_editable||(q.bind(a.getDoc(),"focusin",function(){j.setRng(j.getRng())}),q.bind(a.getDoc(),"mousedown mouseup",function(e){e.target==a.getDoc().documentElement&&(a.getBody().focus(),"mousedown"==e.type?j.placeCaretAt(e.clientX,e.clientY):j.setRng(j.getRng()))}))}function h(){a.on("keydown",function(e){if(!c(e)&&e.keyCode===U){if(!a.getBody().getElementsByTagName("hr").length)return;if(j.isCollapsed()&&0===j.getRng(!0).startOffset){var t=j.getNode(),n=t.previousSibling;if("HR"==t.nodeName)return q.remove(t),void e.preventDefault();n&&n.nodeName&&"hr"===n.nodeName.toLowerCase()&&(q.remove(n),e.preventDefault())}}})}function m(){window.Range.prototype.getClientRects||a.on("mousedown",function(e){if(!c(e)&&"HTML"===e.target.nodeName){var t=a.getBody();t.blur(),setTimeout(function(){t.focus()},0)}})}function g(){a.on("click",function(e){var t=e.target;/^(IMG|HR)$/.test(t.nodeName)&&(e.preventDefault(),j.getSel().setBaseAndExtent(t,0,t,1),a.nodeChanged()),"A"==t.nodeName&&q.hasClass(t,"mce-item-anchor")&&(e.preventDefault(),j.select(t))})}function v(){function e(){var e=q.getAttribs(j.getStart().cloneNode(!1));return function(){var t=j.getStart();t!==a.getBody()&&(q.setAttrib(t,"style",null),V(e,function(e){t.setAttributeNode(e.cloneNode(!0))}))}}function t(){return!j.isCollapsed()&&q.getParent(j.getStart(),q.isBlock)!=q.getParent(j.getEnd(),q.isBlock)}a.on("keypress",function(n){var r;return c(n)||8!=n.keyCode&&46!=n.keyCode||!t()?void 0:(r=e(),a.getDoc().execCommand("delete",!1,null),r(),n.preventDefault(),!1)}),q.bind(a.getDoc(),"cut",function(n){var r;!c(n)&&t()&&(r=e(),setTimeout(function(){r()},0))})}function y(){document.body.setAttribute("role","application")}function b(){a.on("keydown",function(e){if(!c(e)&&e.keyCode===U&&j.isCollapsed()&&0===j.getRng(!0).startOffset){var t=j.getNode().previousSibling;if(t&&t.nodeName&&"table"===t.nodeName.toLowerCase())return e.preventDefault(),!1}})}function C(){l()>7||(s("RespectVisibilityInDesign",!0),a.contentStyles.push(".mceHideBrInPre pre br {display: none}"),q.addClass(a.getBody(),"mceHideBrInPre"),K.addNodeFilter("pre",function(e){for(var t=e.length,r,i,o,a;t--;)for(r=e[t].getAll("br"),i=r.length;i--;)o=r[i],a=o.prev,a&&3===a.type&&"\n"!=a.value.charAt(a.value-1)?a.value+="\n":o.parent.insert(new n("#text",3),o,!0).value="\n"}),G.addNodeFilter("pre",function(e){for(var t=e.length,n,r,i,o;t--;)for(n=e[t].getAll("br"),r=n.length;r--;)i=n[r],o=i.prev,o&&3==o.type&&(o.value=o.value.replace(/\r?\n$/,""))}))}function x(){q.bind(a.getBody(),"mouseup",function(){var e,t=j.getNode();"IMG"==t.nodeName&&((e=q.getStyle(t,"width"))&&(q.setAttrib(t,"width",e.replace(/[^0-9%]+/g,"")),q.setStyle(t,"width","")),(e=q.getStyle(t,"height"))&&(q.setAttrib(t,"height",e.replace(/[^0-9%]+/g,"")),q.setStyle(t,"height","")))})}function w(){a.on("keydown",function(t){var n,r,i,o,s;if(!c(t)&&t.keyCode==e.BACKSPACE&&(n=j.getRng(),r=n.startContainer,i=n.startOffset,o=q.getRoot(),s=r,n.collapsed&&0===i)){for(;s&&s.parentNode&&s.parentNode.firstChild==s&&s.parentNode!=o;)s=s.parentNode;"BLOCKQUOTE"===s.tagName&&(a.formatter.toggle("blockquote",null,s),n=q.createRng(),n.setStart(r,0),n.setEnd(r,0),j.setRng(n))}})}function _(){function e(){a._refreshContentEditable(),s("StyleWithCSS",!1),s("enableInlineTableEditing",!1),Y.object_resizing||s("enableObjectResizing",!1)}Y.readonly||a.on("BeforeExecCommand MouseDown",e)}function E(){function e(){V(q.select("a"),function(e){var t=e.parentNode,n=q.getRoot();if(t.lastChild===e){for(;t&&!q.isBlock(t);){if(t.parentNode.lastChild!==t||t===n)return;t=t.parentNode}q.add(t,"br",{"data-mce-bogus":1})}})}a.on("SetContent ExecCommand",function(t){("setcontent"==t.type||"mceInsertLink"===t.command)&&e()})}function N(){Y.forced_root_block&&a.on("init",function(){s("DefaultParagraphSeparator",Y.forced_root_block)})}function k(){a.on("Undo Redo SetContent",function(e){e.initial||a.execCommand("mceRepaint")})}function S(){a.on("keydown",function(e){var t;c(e)||e.keyCode!=U||(t=a.getDoc().selection.createRange(),t&&t.item&&(e.preventDefault(),a.undoManager.beforeChange(),q.remove(t.item(0)),a.undoManager.add()))})}function T(){var e;l()>=10&&(e="",V("p div h1 h2 h3 h4 h5 h6".split(" "),function(t,n){e+=(n>0?",":"")+t+":empty"}),a.contentStyles.push(e+"{padding-right: 1px !important}"))}function R(){l()<9&&(K.addNodeFilter("noscript",function(e){for(var t=e.length,n,r;t--;)n=e[t],r=n.firstChild,r&&n.attr("data-mce-innertext",r.value)}),G.addNodeFilter("noscript",function(e){for(var t=e.length,i,o,a;t--;)i=e[t],o=e[t].firstChild,o?o.value=r.decode(o.value):(a=i.attributes.map["data-mce-innertext"],a&&(i.attr("data-mce-innertext",null),o=new n("#text",3),o.value=a,o.raw=!0,i.append(o)))}))}function A(){function e(e,t){var n=i.createTextRange();try{n.moveToPoint(e,t)}catch(r){n=null}return n}function t(t){var r;t.button?(r=e(t.x,t.y),r&&(r.compareEndPoints("StartToStart",a)>0?r.setEndPoint("StartToStart",a):r.setEndPoint("EndToEnd",a),r.select())):n()}function n(){var e=r.selection.createRange();a&&!e.item&&0===e.compareEndPoints("StartToEnd",e)&&a.select(),q.unbind(r,"mouseup",n),q.unbind(r,"mousemove",t),a=o=0}var r=q.doc,i=r.body,o,a,s;r.documentElement.unselectable=!0,q.bind(r,"mousedown contextmenu",function(i){if("HTML"===i.target.nodeName){if(o&&n(),s=r.documentElement,s.scrollHeight>s.clientHeight)return;o=1,a=e(i.x,i.y),a&&(q.bind(r,"mouseup",n),q.bind(r,"mousemove",t),q.getRoot().focus(),a.select())}})}function B(){a.on("keyup focusin mouseup",function(t){65==t.keyCode&&e.metaKeyPressed(t)||j.normalize()},!0)}function D(){a.contentStyles.push("img:-moz-broken {-moz-force-broken-image-icon:1;min-width:24px;min-height:24px}")}function L(){a.inline||a.on("keydown",function(){document.activeElement==document.body&&a.getWin().focus()})}function H(){a.inline||(a.contentStyles.push("body {min-height: 150px}"),a.on("click",function(e){"HTML"==e.target.nodeName&&(a.getBody().focus(),a.selection.normalize(),a.nodeChanged())}))}function M(){i.mac&&a.on("keydown",function(t){!e.metaKeyPressed(t)||37!=t.keyCode&&39!=t.keyCode||(t.preventDefault(),a.selection.getSel().modify("move",37==t.keyCode?"backward":"forward","word"))})}function P(){s("AutoUrlDetect",!1)}function O(){a.inline||a.on("focus blur beforegetcontent",function(){var e=a.dom.create("br");a.getBody().appendChild(e),e.parentNode.removeChild(e)},!0)}function I(){a.on("click",function(e){var t=e.target;do if("A"===t.tagName)return void e.preventDefault();while(t=t.parentNode)}),a.contentStyles.push(".mce-content-body {-webkit-touch-callout: none}")}function F(){a.on("touchstart",function(e){var t,n,r,i;t=e.target,n=(new Date).getTime(),i=e.changedTouches,!i||i.length>1||(r=i[0],a.once("touchend",function(e){var i=e.changedTouches[0],o;(new Date).getTime()-n>500||Math.abs(r.clientX-i.clientX)>5||Math.abs(r.clientY-i.clientY)>5||(o={target:t},V("pageX pageY clientX clientY screenX screenY".split(" "),function(e){o[e]=i[e]}),o=a.fire("click",o),o.isDefaultPrevented()||(a.selection.placeCaretAt(i.clientX,i.clientY),a.nodeChanged()))}))})}function z(){a.on("init",function(){a.dom.bind(a.getBody(),"submit",function(e){e.preventDefault()})})}function W(){K.addNodeFilter("br",function(e){for(var t=e.length;t--;)"Apple-interchange-newline"==e[t].attr("class")&&e[t].remove()})}var V=o.each,U=e.BACKSPACE,$=e.DELETE,q=a.dom,j=a.selection,Y=a.settings,K=a.parser,G=a.serializer,X=i.gecko,J=i.ie,Q=i.webkit;w(),d(),B(),Q&&(u(),p(),g(),N(),z(),b(),W(),F(),i.iOS?(L(),H(),I()):f()),J&&i.ie<11&&(h(),y(),C(),x(),S(),T(),R(),A()),i.ie>=11&&(H(),O(),b()),i.ie&&(f(),P()),X&&(h(),m(),v(),_(),E(),k(),D(),M(),b())}}),r(lt,[$],function(e){function t(t){return t._eventDispatcher||(t._eventDispatcher=new e({scope:t,toggleEvent:function(n,r){e.isNative(n)&&t.toggleNativeEvent&&t.toggleNativeEvent(n,r)}})),t._eventDispatcher}return{fire:function(e,n,r){var i=this;if(i.removed&&"remove"!==e)return n;if(n=t(i).fire(e,n,r),r!==!1&&i.parent)for(var o=i.parent();o&&!n.isPropagationStopped();)o.fire(e,n,!1),o=o.parent();return n},on:function(e,n,r){return t(this).on(e,n,r)},off:function(e,n){return t(this).off(e,n)},once:function(e,n){return t(this).once(e,n)},hasEventListeners:function(e){return t(this).has(e)}}}),r(ct,[lt,y,d],function(e,t,n){function r(e,t){return"selectionchange"==t?e.getDoc():!e.inline&&/^mouse|click|contextmenu|drop|dragover|dragend/.test(t)?e.getDoc().documentElement:e.settings.event_root?(e.eventRoot||(e.eventRoot=o.select(e.settings.event_root)[0]),e.eventRoot):e.getBody()}function i(e,t){var n=r(e,t),i;if(e.delegates||(e.delegates={}),!e.delegates[t])if(e.settings.event_root){if(a||(a={},e.editorManager.on("removeEditor",function(){var t;if(!e.editorManager.activeEditor&&a){for(t in a)e.dom.unbind(r(e,t));a=null}})),a[t])return;i=function(n){for(var r=n.target,i=e.editorManager.editors,a=i.length;a--;){var s=i[a].getBody();(s===r||o.isChildOf(r,s))&&(i[a].hidden||i[a].fire(t,n))}},a[t]=i,o.bind(n,t,i)}else i=function(n){e.hidden||e.fire(t,n)},o.bind(n,t,i),e.delegates[t]=i}var o=t.DOM,a,s={bindPendingEventDelegates:function(){var e=this;n.each(e._pendingNativeEvents,function(t){i(e,t)})},toggleNativeEvent:function(e,t){var n=this;n.settings.readonly||"focus"!=e&&"blur"!=e&&(t?n.initialized?i(n,e):n._pendingNativeEvents?n._pendingNativeEvents.push(e):n._pendingNativeEvents=[e]:n.initialized&&(n.dom.unbind(r(n,e),e,n.delegates[e]),delete n.delegates[e]))},unbindAllNativeEvents:function(){var e=this,t;if(e.delegates){for(t in e.delegates)e.dom.unbind(r(e,t),t,e.delegates[t]);delete e.delegates}e.inline||(e.getBody().onload=null,e.dom.unbind(e.getWin()),e.dom.unbind(e.getDoc())),e.dom.unbind(e.getBody()),e.dom.unbind(e.getContainer())}};return s=n.extend({},e,s)}),r(ut,[d,u],function(e,t){var n=e.each,r=e.explode,i={f9:120,f10:121,f11:122};return function(o){var a=this,s={};o.on("keyup keypress keydown",function(e){(e.altKey||e.ctrlKey||e.metaKey)&&!e.isDefaultPrevented()&&n(s,function(n){var r=t.mac?e.metaKey:e.ctrlKey;if(n.ctrl==r&&n.alt==e.altKey&&n.shift==e.shiftKey)return e.keyCode==n.keyCode||e.charCode&&e.charCode==n.charCode?(e.preventDefault(),"keydown"==e.type&&n.func.call(n.scope),!0):void 0
})}),a.add=function(t,a,l,c){var u;return u=l,"string"==typeof l?l=function(){o.execCommand(u,!1,null)}:e.isArray(u)&&(l=function(){o.execCommand(u[0],u[1],u[2])}),n(r(t.toLowerCase()),function(e){var t={func:l,scope:c||o,desc:o.translate(a),alt:!1,ctrl:!1,shift:!1};n(r(e,"+"),function(e){switch(e){case"alt":case"ctrl":case"shift":t[e]=!0;break;default:/^[0-9]{2,}$/.test(e)?t.keyCode=parseInt(e,10):(t.charCode=e.charCodeAt(0),t.keyCode=i[e]||e.toUpperCase().charCodeAt(0))}}),s[(t.ctrl?"ctrl":"")+","+(t.alt?"alt":"")+","+(t.shift?"shift":"")+","+t.keyCode]=t}),!0}}}),r(dt,[y,f,C,w,_,R,T,H,O,I,F,z,W,V,b,l,at,E,k,st,u,d,ct,ut],function(e,n,r,i,o,a,s,l,c,u,d,f,p,h,m,g,v,y,b,C,x,w,_,E){function N(e,t,i){var o=this,a,s;a=o.documentBaseUrl=i.documentBaseURL,s=i.baseURI,o.settings=t=R({id:e,theme:"modern",delta_width:0,delta_height:0,popup_css:"",plugins:"",document_base_url:a,add_form_submit_trigger:!0,submit_patch:!0,add_unload_trigger:!0,convert_urls:!0,relative_urls:!0,remove_script_host:!0,object_resizing:!0,doctype:"<!DOCTYPE html>",visual:!0,font_size_style_values:"xx-small,x-small,small,medium,large,x-large,xx-large",font_size_legacy_values:"xx-small,small,medium,large,x-large,xx-large,300%",forced_root_block:"p",hidden_input:!0,padd_empty_editor:!0,render_ui:!0,indentation:"30px",inline_styles:!0,convert_fonts_to_spans:!0,indent:"simple",indent_before:"p,h1,h2,h3,h4,h5,h6,blockquote,div,title,style,pre,script,td,ul,ol,li,dl,dt,dd,area,table,thead,tfoot,tbody,tr,section,article,hgroup,aside,figure,option,optgroup,datalist",indent_after:"p,h1,h2,h3,h4,h5,h6,blockquote,div,title,style,pre,script,td,ul,ol,li,dl,dt,dd,area,table,thead,tfoot,tbody,tr,section,article,hgroup,aside,figure,option,optgroup,datalist",validate:!0,entity_encoding:"named",url_converter:o.convertURL,url_converter_scope:o,ie7_compat:!0},t),r.language=t.language||"en",r.languageLoad=t.language_load,r.baseURL=i.baseURL,o.id=t.id=e,o.isNotDirty=!0,o.plugins={},o.documentBaseURI=new h(t.document_base_url||a,{base_uri:s}),o.baseURI=s,o.contentCSS=[],o.contentStyles=[],o.shortcuts=new E(o),o.execCommands={},o.queryStateCommands={},o.queryValueCommands={},o.loadedCSS={},t.target&&(o.targetElm=t.target),o.suffix=i.suffix,o.editorManager=i,o.inline=t.inline,t.cache_suffix&&(x.cacheSuffix=t.cache_suffix.replace(/^[\?\&]+/,"")),i.fire("SetupEditor",o),o.execCallback("setup",o),o.$=n.overrideDefaults(function(){return{context:o.inline?o.getBody():o.getDoc(),element:o.getBody()}})}var k=e.DOM,S=r.ThemeManager,T=r.PluginManager,R=w.extend,A=w.each,B=w.explode,D=w.inArray,L=w.trim,H=w.resolve,M=g.Event,P=x.gecko,O=x.ie;return N.prototype={render:function(){function e(){k.unbind(window,"ready",e),n.render()}function t(){var e=m.ScriptLoader;if(r.language&&"en"!=r.language&&!r.language_url&&(r.language_url=n.editorManager.baseURL+"/langs/"+r.language+".js"),r.language_url&&e.add(r.language_url),r.theme&&"function"!=typeof r.theme&&"-"!=r.theme.charAt(0)&&!S.urls[r.theme]){var t=r.theme_url;t=t?n.documentBaseURI.toAbsolute(t):"themes/"+r.theme+"/theme"+o+".js",S.load(r.theme,t)}w.isArray(r.plugins)&&(r.plugins=r.plugins.join(" ")),A(r.external_plugins,function(e,t){T.load(t,e),r.plugins+=" "+t}),A(r.plugins.split(/[ ,]/),function(e){if(e=L(e),e&&!T.urls[e])if("-"==e.charAt(0)){e=e.substr(1,e.length);var t=T.dependencies(e);A(t,function(e){var t={prefix:"plugins/",resource:e,suffix:"/plugin"+o+".js"};e=T.createUrl(t,e),T.load(e.resource,e)})}else T.load(e,{prefix:"plugins/",resource:e,suffix:"/plugin"+o+".js"})}),e.loadQueue(function(){n.removed||n.init()})}var n=this,r=n.settings,i=n.id,o=n.suffix;if(!M.domLoaded)return void k.bind(window,"ready",e);if(n.getElement()&&x.contentEditable){r.inline?n.inline=!0:(n.orgVisibility=n.getElement().style.visibility,n.getElement().style.visibility="hidden");var a=n.getElement().form||k.getParent(i,"form");a&&(n.formElement=a,r.hidden_input&&!/TEXTAREA|INPUT/i.test(n.getElement().nodeName)&&(k.insertAfter(k.create("input",{type:"hidden",name:i}),i),n.hasHiddenInput=!0),n.formEventDelegate=function(e){n.fire(e.type,e)},k.bind(a,"submit reset",n.formEventDelegate),n.on("reset",function(){n.setContent(n.startContent,{format:"raw"})}),!r.submit_patch||a.submit.nodeType||a.submit.length||a._mceOldSubmit||(a._mceOldSubmit=a.submit,a.submit=function(){return n.editorManager.triggerSave(),n.isNotDirty=!0,a._mceOldSubmit(a)})),n.windowManager=new v(n),"xml"==r.encoding&&n.on("GetContent",function(e){e.save&&(e.content=k.encode(e.content))}),r.add_form_submit_trigger&&n.on("submit",function(){n.initialized&&n.save()}),r.add_unload_trigger&&(n._beforeUnload=function(){!n.initialized||n.destroyed||n.isHidden()||n.save({format:"raw",no_events:!0,set_dirty:!1})},n.editorManager.on("BeforeUnload",n._beforeUnload)),t()}},init:function(){function e(n){var r=T.get(n),i,o;i=T.urls[n]||t.documentBaseUrl.replace(/\/$/,""),n=L(n),r&&-1===D(m,n)&&(A(T.dependencies(n),function(t){e(t)}),o=new r(t,i,t.$),t.plugins[n]=o,o.init&&(o.init(t,i),m.push(n)))}var t=this,n=t.settings,r=t.getElement(),i,o,a,s,l,c,u,d,f,p,h,m=[];if(t.rtl=this.editorManager.i18n.rtl,t.editorManager.add(t),n.aria_label=n.aria_label||k.getAttrib(r,"aria-label",t.getLang("aria.rich_text_area")),n.theme&&("function"!=typeof n.theme?(n.theme=n.theme.replace(/-/,""),c=S.get(n.theme),t.theme=new c(t,S.urls[n.theme]),t.theme.init&&t.theme.init(t,S.urls[n.theme]||t.documentBaseUrl.replace(/\/$/,""),t.$)):t.theme=n.theme),A(n.plugins.replace(/\-/g,"").split(/[ ,]/),e),n.render_ui&&t.theme&&(t.orgDisplay=r.style.display,"function"!=typeof n.theme?(i=n.width||r.style.width||r.offsetWidth,o=n.height||r.style.height||r.offsetHeight,a=n.min_height||100,p=/^[0-9\.]+(|px)$/i,p.test(""+i)&&(i=Math.max(parseInt(i,10),100)),p.test(""+o)&&(o=Math.max(parseInt(o,10),a)),l=t.theme.renderUI({targetNode:r,width:i,height:o,deltaWidth:n.delta_width,deltaHeight:n.delta_height}),n.content_editable||(o=(l.iframeHeight||o)+("number"==typeof o?l.deltaHeight||0:""),a>o&&(o=a))):(l=n.theme(t,r),l.editorContainer.nodeType&&(l.editorContainer=l.editorContainer.id=l.editorContainer.id||t.id+"_parent"),l.iframeContainer.nodeType&&(l.iframeContainer=l.iframeContainer.id=l.iframeContainer.id||t.id+"_iframecontainer"),o=l.iframeHeight||r.offsetHeight),t.editorContainer=l.editorContainer),n.content_css&&A(B(n.content_css),function(e){t.contentCSS.push(t.documentBaseURI.toAbsolute(e))}),n.content_style&&t.contentStyles.push(n.content_style),n.content_editable)return r=s=l=null,t.initContentBody();for(t.iframeHTML=n.doctype+"<html><head>",n.document_base_url!=t.documentBaseUrl&&(t.iframeHTML+='<base href="'+t.documentBaseURI.getURI()+'" />'),!x.caretAfter&&n.ie7_compat&&(t.iframeHTML+='<meta http-equiv="X-UA-Compatible" content="IE=7" />'),t.iframeHTML+='<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />',h=0;h<t.contentCSS.length;h++){var g=t.contentCSS[h];t.iframeHTML+='<link type="text/css" rel="stylesheet" href="'+w._addCacheSuffix(g)+'" />',t.loadedCSS[g]=!0}d=n.body_id||"tinymce",-1!=d.indexOf("=")&&(d=t.getParam("body_id","","hash"),d=d[t.id]||d),f=n.body_class||"",-1!=f.indexOf("=")&&(f=t.getParam("body_class","","hash"),f=f[t.id]||""),n.content_security_policy&&(t.iframeHTML+='<meta http-equiv="Content-Security-Policy" content="'+n.content_security_policy+'" />'),t.iframeHTML+='</head><body id="'+d+'" class="mce-content-body '+f+'" data-id="'+t.id+'"><br></body></html>';var v='javascript:(function(){document.open();document.domain="'+document.domain+'";var ed = window.parent.tinymce.get("'+t.id+'");document.write(ed.iframeHTML);document.close();ed.initContentBody(true);})()';document.domain!=location.hostname&&(u=v);var y=k.create("iframe",{id:t.id+"_ifr",frameBorder:"0",allowTransparency:"true",title:t.editorManager.translate("Rich Text Area. Press ALT-F9 for menu. Press ALT-F10 for toolbar. Press ALT-0 for help"),style:{width:"100%",height:o,display:"block"}});if(y.onload=function(){y.onload=null,t.fire("load")},k.setAttrib(y,"src",u||'javascript:""'),t.contentAreaContainer=l.iframeContainer,t.iframeElement=y,s=k.add(l.iframeContainer,y),O)try{t.getDoc()}catch(b){s.src=u=v}l.editorContainer&&(k.get(l.editorContainer).style.display=t.orgDisplay,t.hidden=k.isHidden(l.editorContainer)),t.getElement().style.display="none",k.setAttrib(t.id,"aria-hidden",!0),u||t.initContentBody(),r=s=l=null},initContentBody:function(t){var n=this,r=n.settings,s=n.getElement(),h=n.getDoc(),m,g;r.inline||(n.getElement().style.visibility=n.orgVisibility),t||r.content_editable||(h.open(),h.write(n.iframeHTML),h.close()),r.content_editable&&(n.on("remove",function(){var e=this.getBody();k.removeClass(e,"mce-content-body"),k.removeClass(e,"mce-edit-focus"),k.setAttrib(e,"contentEditable",null)}),k.addClass(s,"mce-content-body"),n.contentDocument=h=r.content_document||document,n.contentWindow=r.content_window||window,n.bodyElement=s,r.content_document=r.content_window=null,r.root_name=s.nodeName.toLowerCase()),m=n.getBody(),m.disabled=!0,r.readonly||(n.inline&&"static"==k.getStyle(m,"position",!0)&&(m.style.position="relative"),m.contentEditable=n.getParam("content_editable_state",!0)),m.disabled=!1,n.schema=new y(r),n.dom=new e(h,{keep_values:!0,url_converter:n.convertURL,url_converter_scope:n,hex_colors:r.force_hex_style_colors,class_filter:r.class_filter,update_styles:!0,root_element:n.inline?n.getBody():null,collect:r.content_editable,schema:n.schema,onSetAttrib:function(e){n.fire("SetAttrib",e)}}),n.parser=new b(r,n.schema),n.parser.addAttributeFilter("src,href,style,tabindex",function(e,t){for(var r=e.length,i,o=n.dom,a,s;r--;)i=e[r],a=i.attr(t),s="data-mce-"+t,i.attributes.map[s]||("style"===t?(a=o.serializeStyle(o.parseStyle(a),i.name),a.length||(a=null),i.attr(s,a),i.attr(t,a)):"tabindex"===t?(i.attr(s,a),i.attr(t,null)):i.attr(s,n.convertURL(a,t,i.name)))}),n.parser.addNodeFilter("script",function(e){for(var t=e.length,n;t--;)n=e[t],n.attr("type","mce-"+(n.attr("type")||"no/type"))}),n.parser.addNodeFilter("#cdata",function(e){for(var t=e.length,n;t--;)n=e[t],n.type=8,n.name="#comment",n.value="[CDATA["+n.value+"]]"}),n.parser.addNodeFilter("p,h1,h2,h3,h4,h5,h6,div",function(e){for(var t=e.length,r,i=n.schema.getNonEmptyElements();t--;)r=e[t],r.isEmpty(i)&&(r.append(new o("br",1)).shortEnded=!0)}),n.serializer=new a(r,n),n.selection=new l(n.dom,n.getWin(),n.serializer,n),n.formatter=new c(n),n.undoManager=new u(n),n.forceBlocks=new f(n),n.enterKey=new d(n),n.editorCommands=new p(n),n._nodeChangeDispatcher=new i(n),n.fire("PreInit"),r.browser_spellcheck||r.gecko_spellcheck||(h.body.spellcheck=!1,k.setAttrib(m,"spellcheck","false")),n.fire("PostRender"),n.quirks=new C(n),r.directionality&&(m.dir=r.directionality),r.nowrap&&(m.style.whiteSpace="nowrap"),r.protect&&n.on("BeforeSetContent",function(e){A(r.protect,function(t){e.content=e.content.replace(t,function(e){return"<!--mce:protected "+escape(e)+"-->"})})}),n.on("SetContent",function(){n.addVisual(n.getBody())}),r.padd_empty_editor&&n.on("PostProcess",function(e){e.content=e.content.replace(/^(<p[^>]*>(&nbsp;|&#160;|\s|\u00a0|)<\/p>[\r\n]*|<br \/>[\r\n]*)$/,"")}),n.load({initial:!0,format:"html"}),n.startContent=n.getContent({format:"raw"}),n.initialized=!0,n.bindPendingEventDelegates(),n.fire("init"),n.focus(!0),n.nodeChanged({initial:!0}),n.execCallback("init_instance_callback",n),n.contentStyles.length>0&&(g="",A(n.contentStyles,function(e){g+=e+"\r\n"}),n.dom.addStyle(g)),A(n.contentCSS,function(e){n.loadedCSS[e]||(n.dom.loadCSS(e),n.loadedCSS[e]=!0)}),r.auto_focus&&setTimeout(function(){var e;e=r.auto_focus===!0?n:n.editorManager.get(r.auto_focus),e.focus()},100),s=h=m=null},focus:function(e){var t=this,n=t.selection,r=t.settings.content_editable,i,o,a=t.getDoc(),s;if(!e){if(i=n.getRng(),i.item&&(o=i.item(0)),t._refreshContentEditable(),r||(x.opera||t.getBody().focus(),t.getWin().focus()),P||r){if(s=t.getBody(),s.setActive)try{s.setActive()}catch(l){s.focus()}else s.focus();r&&n.normalize()}o&&o.ownerDocument==a&&(i=a.body.createControlRange(),i.addElement(o),i.select())}t.editorManager.setActive(t)},execCallback:function(e){var t=this,n=t.settings[e],r;if(n)return t.callbackLookup&&(r=t.callbackLookup[e])&&(n=r.func,r=r.scope),"string"==typeof n&&(r=n.replace(/\.\w+$/,""),r=r?H(r):0,n=H(n),t.callbackLookup=t.callbackLookup||{},t.callbackLookup[e]={func:n,scope:r}),n.apply(r||t,Array.prototype.slice.call(arguments,1))},translate:function(e){var t=this.settings.language||"en",n=this.editorManager.i18n;return e?n.data[t+"."+e]||e.replace(/\{\#([^\}]+)\}/g,function(e,r){return n.data[t+"."+r]||"{#"+r+"}"}):""},getLang:function(e,n){return this.editorManager.i18n.data[(this.settings.language||"en")+"."+e]||(n!==t?n:"{#"+e+"}")},getParam:function(e,t,n){var r=e in this.settings?this.settings[e]:t,i;return"hash"===n?(i={},"string"==typeof r?A(r.split(r.indexOf("=")>0?/[;,](?![^=;,]*(?:[;,]|$))/:","),function(e){e=e.split("="),i[L(e[0])]=L(e.length>1?e[1]:e)}):i=r,i):r},nodeChanged:function(e){this._nodeChangeDispatcher.nodeChanged(e)},addButton:function(e,t){var n=this;t.cmd&&(t.onclick=function(){n.execCommand(t.cmd)}),t.text||t.icon||(t.icon=e),n.buttons=n.buttons||{},t.tooltip=t.tooltip||t.title,n.buttons[e]=t},addMenuItem:function(e,t){var n=this;t.cmd&&(t.onclick=function(){n.execCommand(t.cmd)}),n.menuItems=n.menuItems||{},n.menuItems[e]=t},addCommand:function(e,t,n){this.execCommands[e]={func:t,scope:n||this}},addQueryStateHandler:function(e,t,n){this.queryStateCommands[e]={func:t,scope:n||this}},addQueryValueHandler:function(e,t,n){this.queryValueCommands[e]={func:t,scope:n||this}},addShortcut:function(e,t,n,r){this.shortcuts.add(e,t,n,r)},execCommand:function(e,t,n,r){var i=this,o=0,a;if(/^(mceAddUndoLevel|mceEndUndoLevel|mceBeginUndoLevel|mceRepaint)$/.test(e)||r&&r.skip_focus||i.focus(),r=R({},r),r=i.fire("BeforeExecCommand",{command:e,ui:t,value:n}),r.isDefaultPrevented())return!1;if((a=i.execCommands[e])&&a.func.call(a.scope,t,n)!==!0)return i.fire("ExecCommand",{command:e,ui:t,value:n}),!0;if(A(i.plugins,function(r){return r.execCommand&&r.execCommand(e,t,n)?(i.fire("ExecCommand",{command:e,ui:t,value:n}),o=!0,!1):void 0}),o)return o;if(i.theme&&i.theme.execCommand&&i.theme.execCommand(e,t,n))return i.fire("ExecCommand",{command:e,ui:t,value:n}),!0;if(i.editorCommands.execCommand(e,t,n))return i.fire("ExecCommand",{command:e,ui:t,value:n}),!0;try{o=i.getDoc().execCommand(e,t,n)}catch(s){}return o?(i.fire("ExecCommand",{command:e,ui:t,value:n}),!0):!1},queryCommandState:function(e){var t=this,n,r;if(!t._isHidden()){if((n=t.queryStateCommands[e])&&(r=n.func.call(n.scope),r===!0||r===!1))return r;if(r=t.editorCommands.queryCommandState(e),-1!==r)return r;try{return t.getDoc().queryCommandState(e)}catch(i){}}},queryCommandValue:function(e){var n=this,r,i;if(!n._isHidden()){if((r=n.queryValueCommands[e])&&(i=r.func.call(r.scope),i!==!0))return i;if(i=n.editorCommands.queryCommandValue(e),i!==t)return i;try{return n.getDoc().queryCommandValue(e)}catch(o){}}},show:function(){var e=this;e.hidden&&(e.hidden=!1,e.inline?e.getBody().contentEditable=!0:(k.show(e.getContainer()),k.hide(e.id)),e.load(),e.fire("show"))},hide:function(){var e=this,t=e.getDoc();e.hidden||(O&&t&&!e.inline&&t.execCommand("SelectAll"),e.save(),e.inline?(e.getBody().contentEditable=!1,e==e.editorManager.focusedEditor&&(e.editorManager.focusedEditor=null)):(k.hide(e.getContainer()),k.setStyle(e.id,"display",e.orgDisplay)),e.hidden=!0,e.fire("hide"))},isHidden:function(){return!!this.hidden},setProgressState:function(e,t){this.fire("ProgressState",{state:e,time:t})},load:function(e){var n=this,r=n.getElement(),i;return r?(e=e||{},e.load=!0,i=n.setContent(r.value!==t?r.value:r.innerHTML,e),e.element=r,e.no_events||n.fire("LoadContent",e),e.element=r=null,i):void 0},save:function(e){var t=this,n=t.getElement(),r,i;if(n&&t.initialized)return e=e||{},e.save=!0,e.element=n,r=e.content=t.getContent(e),e.no_events||t.fire("SaveContent",e),r=e.content,/TEXTAREA|INPUT/i.test(n.nodeName)?n.value=r:(t.inline||(n.innerHTML=r),(i=k.getParent(t.id,"form"))&&A(i.elements,function(e){return e.name==t.id?(e.value=r,!1):void 0})),e.element=n=null,e.set_dirty!==!1&&(t.isNotDirty=!0),r},setContent:function(e,t){var n=this,r=n.getBody(),i;return t=t||{},t.format=t.format||"html",t.set=!0,t.content=e,t.no_events||n.fire("BeforeSetContent",t),e=t.content,0===e.length||/^\s+$/.test(e)?(i=n.settings.forced_root_block,i&&n.schema.isValidChild(r.nodeName.toLowerCase(),i.toLowerCase())?(e=O&&11>O?"":'<br data-mce-bogus="1">',e=n.dom.createHTML(i,n.settings.forced_root_block_attrs,e)):O||(e='<br data-mce-bogus="1">'),n.dom.setHTML(r,e),n.fire("SetContent",t)):("raw"!==t.format&&(e=new s({},n.schema).serialize(n.parser.parse(e,{isRootContent:!0}))),t.content=L(e),n.dom.setHTML(r,t.content),t.no_events||n.fire("SetContent",t)),t.content},getContent:function(e){var t=this,n,r=t.getBody();return e=e||{},e.format=e.format||"html",e.get=!0,e.getInner=!0,e.no_events||t.fire("BeforeGetContent",e),n="raw"==e.format?r.innerHTML:"text"==e.format?r.innerText||r.textContent:t.serializer.serialize(r,e),e.content="text"!=e.format?L(n):n,e.no_events||t.fire("GetContent",e),e.content},insertContent:function(e,t){t&&(e=R({content:e},t)),this.execCommand("mceInsertContent",!1,e)},isDirty:function(){return!this.isNotDirty},getContainer:function(){var e=this;return e.container||(e.container=k.get(e.editorContainer||e.id+"_parent")),e.container},getContentAreaContainer:function(){return this.contentAreaContainer},getElement:function(){return this.targetElm||(this.targetElm=k.get(this.id)),this.targetElm},getWin:function(){var e=this,t;return e.contentWindow||(t=e.iframeElement,t&&(e.contentWindow=t.contentWindow)),e.contentWindow},getDoc:function(){var e=this,t;return e.contentDocument||(t=e.getWin(),t&&(e.contentDocument=t.document)),e.contentDocument},getBody:function(){return this.bodyElement||this.getDoc().body},convertURL:function(e,t,n){var r=this,i=r.settings;return i.urlconverter_callback?r.execCallback("urlconverter_callback",e,n,!0,t):!i.convert_urls||n&&"LINK"==n.nodeName||0===e.indexOf("file:")||0===e.length?e:i.relative_urls?r.documentBaseURI.toRelative(e):e=r.documentBaseURI.toAbsolute(e,i.remove_script_host)},addVisual:function(e){var n=this,r=n.settings,i=n.dom,o;e=e||n.getBody(),n.hasVisual===t&&(n.hasVisual=r.visual),A(i.select("table,a",e),function(e){var t;switch(e.nodeName){case"TABLE":return o=r.visual_table_class||"mce-item-table",t=i.getAttrib(e,"border"),void(t&&"0"!=t||!n.hasVisual?i.removeClass(e,o):i.addClass(e,o));case"A":return void(i.getAttrib(e,"href",!1)||(t=i.getAttrib(e,"name")||e.id,o=r.visual_anchor_class||"mce-item-anchor",t&&n.hasVisual?i.addClass(e,o):i.removeClass(e,o)))}}),n.fire("VisualAid",{element:e,hasVisual:n.hasVisual})},remove:function(){var e=this;e.removed||(e.save(),e.removed=1,e.unbindAllNativeEvents(),e.hasHiddenInput&&k.remove(e.getElement().nextSibling),e.inline||(O&&10>O&&e.getDoc().execCommand("SelectAll",!1,null),k.setStyle(e.id,"display",e.orgDisplay),e.getBody().onload=null),e.fire("remove"),e.editorManager.remove(e),k.remove(e.getContainer()),e.destroy())},destroy:function(e){var t=this,n;if(!t.destroyed){if(!e&&!t.removed)return void t.remove();e||(t.editorManager.off("beforeunload",t._beforeUnload),t.theme&&t.theme.destroy&&t.theme.destroy(),t.selection.destroy(),t.dom.destroy()),n=t.formElement,n&&(n._mceOldSubmit&&(n.submit=n._mceOldSubmit,n._mceOldSubmit=null),k.unbind(n,"submit reset",t.formEventDelegate)),t.contentAreaContainer=t.formElement=t.container=t.editorContainer=null,t.bodyElement=t.contentDocument=t.contentWindow=null,t.iframeElement=t.targetElm=null,t.selection&&(t.selection=t.selection.win=t.selection.dom=t.selection.dom.doc=null),t.destroyed=1}},_refreshContentEditable:function(){var e=this,t,n;e._isHidden()&&(t=e.getBody(),n=t.parentNode,n.removeChild(t),n.appendChild(t),t.focus())},_isHidden:function(){var e;return P?(e=this.selection.getSel(),!e||!e.rangeCount||0===e.rangeCount):0}},R(N.prototype,_),N}),r(ft,[],function(){var e={};return{rtl:!1,add:function(t,n){for(var r in n)e[r]=n[r];this.rtl=this.rtl||"rtl"===e._dir},translate:function(t){if("undefined"==typeof t)return t;if("string"!=typeof t&&t.raw)return t.raw;if(t.push){var n=t.slice(1);t=(e[t[0]]||t[0]).replace(/\{([^\}]+)\}/g,function(e,t){return n[t]})}return e[t]||t},data:e}}),r(pt,[y,u],function(e,t){function n(e){function s(){try{return document.activeElement}catch(e){return document.body}}function l(e,t){if(t&&t.startContainer){if(!e.isChildOf(t.startContainer,e.getRoot())||!e.isChildOf(t.endContainer,e.getRoot()))return;return{startContainer:t.startContainer,startOffset:t.startOffset,endContainer:t.endContainer,endOffset:t.endOffset}}return t}function c(e,t){var n;return t.startContainer?(n=e.getDoc().createRange(),n.setStart(t.startContainer,t.startOffset),n.setEnd(t.endContainer,t.endOffset)):n=t,n}function u(e){return!!a.getParent(e,n.isEditorUIElement)}function d(n){var d=n.editor;d.on("init",function(){(d.inline||t.ie)&&("onbeforedeactivate"in document&&t.ie<9?d.dom.bind(d.getBody(),"beforedeactivate",function(e){if(e.target==d.getBody())try{d.lastRng=d.selection.getRng()}catch(t){}}):d.on("nodechange mouseup keyup",function(e){var t=s();"nodechange"==e.type&&e.selectionChange||(t&&t.id==d.id+"_ifr"&&(t=d.getBody()),d.dom.isChildOf(t,d.getBody())&&(d.lastRng=d.selection.getRng()))}),t.webkit&&!r&&(r=function(){var t=e.activeEditor;if(t&&t.selection){var n=t.selection.getRng();n&&!n.collapsed&&(d.lastRng=n)}},a.bind(document,"selectionchange",r)))}),d.on("setcontent",function(){d.lastRng=null}),d.on("mousedown",function(){d.selection.lastFocusBookmark=null}),d.on("focusin",function(){var t=e.focusedEditor;d.selection.lastFocusBookmark&&(d.selection.setRng(c(d,d.selection.lastFocusBookmark)),d.selection.lastFocusBookmark=null),t!=d&&(t&&t.fire("blur",{focusedEditor:d}),e.setActive(d),e.focusedEditor=d,d.fire("focus",{blurredEditor:t}),d.focus(!0)),d.lastRng=null}),d.on("focusout",function(){window.setTimeout(function(){var t=e.focusedEditor;u(s())||t!=d||(d.fire("blur",{focusedEditor:null}),e.focusedEditor=null,d.selection&&(d.selection.lastFocusBookmark=null))},0)}),i||(i=function(t){var n=e.activeEditor;n&&t.target.ownerDocument==document&&(n.selection&&t.target!=n.getBody()&&(n.selection.lastFocusBookmark=l(n.dom,n.lastRng)),t.target==document.body||u(t.target)||e.focusedEditor!=n||(n.fire("blur",{focusedEditor:null}),e.focusedEditor=null))},a.bind(document,"focusin",i)),d.inline&&!o&&(o=function(t){var n=e.activeEditor;if(n.inline&&!n.dom.isChildOf(t.target,n.getBody())){var r=n.selection.getRng();r.collapsed||(n.lastRng=r)}},a.bind(document,"mouseup",o))}function f(t){e.focusedEditor==t.editor&&(e.focusedEditor=null),e.activeEditor||(a.unbind(document,"selectionchange",r),a.unbind(document,"focusin",i),a.unbind(document,"mouseup",o),r=i=o=null)}e.on("AddEditor",d),e.on("RemoveEditor",f)}var r,i,o,a=e.DOM;return n.isEditorUIElement=function(e){return-1!==e.className.toString().indexOf("mce-")},n}),r(ht,[dt,f,y,V,u,d,lt,ft,pt],function(e,t,n,r,i,o,a,s,l){function c(e){var t=v.editors,n;delete t[e.id];for(var r=0;r<t.length;r++)if(t[r]==e){t.splice(r,1),n=!0;break}return v.activeEditor==e&&(v.activeEditor=t[0]),v.focusedEditor==e&&(v.focusedEditor=null),n}function u(e){return e&&!(e.getContainer()||e.getBody()).parentNode&&(c(e),e.unbindAllNativeEvents(),e.destroy(!0),e=null),e}var d=n.DOM,f=o.explode,p=o.each,h=o.extend,m=0,g,v;return v={$:t,majorVersion:"4",minorVersion:"1.7",releaseDate:"2014-11-27",editors:[],i18n:s,activeEditor:null,setup:function(){var e=this,t,n,i="",o,a;if(n=document.location.href,/^[^:]+:\/\/\/?[^\/]+\//.test(n)&&(n=n.replace(/[\?#].*$/,"").replace(/[\/\\][^\/]+$/,""),/[\/\\]$/.test(n)||(n+="/")),o=window.tinymce||window.tinyMCEPreInit)t=o.base||o.baseURL,i=o.suffix;else{for(var s=document.getElementsByTagName("script"),c=0;c<s.length;c++)if(a=s[c].src,/tinymce(\.full|\.jquery|)(\.min|\.dev|)\.js/.test(a)){-1!=a.indexOf(".min")&&(i=".min"),t=a.substring(0,a.lastIndexOf("/"));break}!t&&document.currentScript&&(a=document.currentScript.src,-1!=a.indexOf(".min")&&(i=".min"),t=a.substring(0,a.lastIndexOf("/")))}e.baseURL=new r(n).toAbsolute(t),e.documentBaseURL=n,e.baseURI=new r(e.baseURL),e.suffix=i,e.focusManager=new l(e)},init:function(t){function n(e){var t=e.id;return t||(t=e.name,t=t&&!d.get(t)?e.name:d.uniqueId(),e.setAttribute("id",t)),t}function r(t,n,r){if(!u(s.get(t))){var i=new e(t,n,s);i.targetElm=i.targetElm||r,l.push(i),i.render()}}function i(e){var n=t[e];if(n)return n.apply(s,Array.prototype.slice.call(arguments,2))}function o(e,t){return t.constructor===RegExp?t.test(e.className):d.hasClass(e,t)}function a(){var e,s;if(d.unbind(window,"ready",a),i("onpageload"),t.types)return void p(t.types,function(e){p(d.select(e.selector),function(i){r(n(i),h({},t,e),i)})});if(t.selector)return void p(d.select(t.selector),function(e){r(n(e),t,e)});switch(t.target&&r(n(t.target),t),t.mode){case"exact":e=t.elements||"",e.length>0&&p(f(e),function(e){var n;(n=d.get(e))?r(e,t,n):p(document.forms,function(n){p(n.elements,function(n){n.name===e&&(e="mce_editor_"+m++,d.setAttrib(n,"id",e),r(e,t,n))})})});break;case"textareas":case"specific_textareas":p(d.select("textarea"),function(e){t.editor_deselector&&o(e,t.editor_deselector)||(!t.editor_selector||o(e,t.editor_selector))&&r(n(e),t,e)})}t.oninit&&(e=s=0,p(l,function(t){s++,t.initialized?e++:t.on("init",function(){e++,e==s&&i("oninit")}),e==s&&i("oninit")}))}var s=this,l=[];s.settings=t,d.bind(window,"ready",a)},get:function(e){return arguments.length?e in this.editors?this.editors[e]:null:this.editors},add:function(e){var t=this,n=t.editors;return n[e.id]=e,n.push(e),t.activeEditor=e,t.fire("AddEditor",{editor:e}),g||(g=function(){t.fire("BeforeUnload")},d.bind(window,"beforeunload",g)),e},createEditor:function(t,n){return this.add(new e(t,n,this))},remove:function(e){var t=this,n,r=t.editors,i;{if(e)return"string"==typeof e?(e=e.selector||e,void p(d.select(e),function(e){i=r[e.id],i&&t.remove(i)})):(i=e,r[i.id]?(c(i)&&t.fire("RemoveEditor",{editor:i}),r.length||d.unbind(window,"beforeunload",g),i.remove(),i):null);for(n=r.length-1;n>=0;n--)t.remove(r[n])}},execCommand:function(t,n,r){var i=this,o=i.get(r);switch(t){case"mceAddEditor":return i.get(r)||new e(r,i.settings,i).render(),!0;case"mceRemoveEditor":return o&&o.remove(),!0;case"mceToggleEditor":return o?(o.isHidden()?o.show():o.hide(),!0):(i.execCommand("mceAddEditor",0,r),!0)}return i.activeEditor?i.activeEditor.execCommand(t,n,r):!1},triggerSave:function(){p(this.editors,function(e){e.save()})},addI18n:function(e,t){s.add(e,t)},translate:function(e){return s.translate(e)},setActive:function(e){var t=this.activeEditor;this.activeEditor!=e&&(t&&t.fire("deactivate",{relatedTarget:e}),e.fire("activate",{relatedTarget:t})),this.activeEditor=e}},h(v,a),v.setup(),window.tinymce=window.tinyMCE=v,v}),r(mt,[ht,d],function(e,t){var n=t.each,r=t.explode;e.on("AddEditor",function(e){var t=e.editor;t.on("preInit",function(){function e(e,t){n(t,function(t,n){t&&s.setStyle(e,n,t)}),s.rename(e,"span")}function i(e){s=t.dom,l.convert_fonts_to_spans&&n(s.select("font,u,strike",e.node),function(e){o[e.nodeName.toLowerCase()](s,e)})}var o,a,s,l=t.settings;l.inline_styles&&(a=r(l.font_size_legacy_values),o={font:function(t,n){e(n,{backgroundColor:n.style.backgroundColor,color:n.color,fontFamily:n.face,fontSize:a[parseInt(n.size,10)-1]})},u:function(t,n){e(n,{textDecoration:"underline"})},strike:function(t,n){e(n,{textDecoration:"line-through"})}},t.on("PreProcess SetContent",i))})})}),r(gt,[lt,d],function(e,t){var n={send:function(e){function t(){!e.async||4==r.readyState||i++>1e4?(e.success&&1e4>i&&200==r.status?e.success.call(e.success_scope,""+r.responseText,r,e):e.error&&e.error.call(e.error_scope,i>1e4?"TIMED_OUT":"GENERAL",r,e),r=null):setTimeout(t,10)}var r,i=0;if(e.scope=e.scope||this,e.success_scope=e.success_scope||e.scope,e.error_scope=e.error_scope||e.scope,e.async=e.async===!1?!1:!0,e.data=e.data||"",r=new XMLHttpRequest){if(r.overrideMimeType&&r.overrideMimeType(e.content_type),r.open(e.type||(e.data?"POST":"GET"),e.url,e.async),e.crossDomain&&(r.withCredentials=!0),e.content_type&&r.setRequestHeader("Content-Type",e.content_type),r.setRequestHeader("X-Requested-With","XMLHttpRequest"),r=n.fire("beforeSend",{xhr:r,settings:e}).xhr,r.send(e.data),!e.async)return t();setTimeout(t,10)}}};return t.extend(n,e),n}),r(vt,[],function(){function e(t,n){var r,i,o,a;if(n=n||'"',null===t)return"null";if(o=typeof t,"string"==o)return i="\bb	t\nn\ff\rr\"\"''\\\\",n+t.replace(/([\u0080-\uFFFF\x00-\x1f\"\'\\])/g,function(e,t){return'"'===n&&"'"===e?e:(r=i.indexOf(t),r+1?"\\"+i.charAt(r+1):(e=t.charCodeAt().toString(16),"\\u"+"0000".substring(e.length)+e))})+n;if("object"==o){if(t.hasOwnProperty&&"[object Array]"===Object.prototype.toString.call(t)){for(r=0,i="[";r<t.length;r++)i+=(r>0?",":"")+e(t[r],n);return i+"]"}i="{";for(a in t)t.hasOwnProperty(a)&&(i+="function"!=typeof t[a]?(i.length>1?","+n:n)+a+n+":"+e(t[a],n):"");return i+"}"}return""+t}return{serialize:e,parse:function(e){try{return window[String.fromCharCode(101)+"val"]("("+e+")")}catch(t){}}}}),r(yt,[vt,gt,d],function(e,t,n){function r(e){this.settings=i({},e),this.count=0}var i=n.extend;return r.sendRPC=function(e){return(new r).send(e)},r.prototype={send:function(n){var r=n.error,o=n.success;n=i(this.settings,n),n.success=function(t,i){t=e.parse(t),"undefined"==typeof t&&(t={error:"JSON Parse error."}),t.error?r.call(n.error_scope||n.scope,t.error,i):o.call(n.success_scope||n.scope,t.result)},n.error=function(e,t){r&&r.call(n.error_scope||n.scope,e,t)},n.data=e.serialize({id:n.id||"c"+this.count++,method:n.method,params:n.params}),n.content_type="application/json",t.send(n)}},r}),r(bt,[y],function(e){return{callbacks:{},count:0,send:function(n){var r=this,i=e.DOM,o=n.count!==t?n.count:r.count,a="tinymce_jsonp_"+o;r.callbacks[o]=function(e){i.remove(a),delete r.callbacks[o],n.callback(e)},i.add(i.doc.body,"script",{id:a,src:n.url,type:"text/javascript"}),r.count++}}}),r(Ct,[],function(){function e(){s=[];for(var e in a)s.push(e);i.length=s.length}function n(){function n(e){var n,r;return r=e!==t?u+e:i.indexOf(",",u),-1===r||r>i.length?null:(n=i.substring(u,r),u=r+1,n)}var r,i,s,u=0;if(a={},c){o.load(l),i=o.getAttribute(l)||"";do{var d=n();if(null===d)break;if(r=n(parseInt(d,32)||0),null!==r){if(d=n(),null===d)break;s=n(parseInt(d,32)||0),r&&(a[r]=s)}}while(null!==r);e()}}function r(){var t,n="";if(c){for(var r in a)t=a[r],n+=(n?",":"")+r.length.toString(32)+","+r+","+t.length.toString(32)+","+t;o.setAttribute(l,n);try{o.save(l)}catch(i){}e()}}var i,o,a,s,l,c;try{if(window.localStorage)return localStorage}catch(u){}return l="tinymce",o=document.documentElement,c=!!o.addBehavior,c&&o.addBehavior("#default#userData"),i={key:function(e){return s[e]},getItem:function(e){return e in a?a[e]:null},setItem:function(e,t){a[e]=""+t,r()},removeItem:function(e){delete a[e],r()},clear:function(){a={},r()}},n(),i}),r(xt,[y,l,b,C,d,u],function(e,t,n,r,i,o){var a=window.tinymce;return a.DOM=e.DOM,a.ScriptLoader=n.ScriptLoader,a.PluginManager=r.PluginManager,a.ThemeManager=r.ThemeManager,a.dom=a.dom||{},a.dom.Event=t.Event,i.each(i,function(e,t){a[t]=e}),i.each("isOpera isWebKit isIE isGecko isMac".split(" "),function(e){a[e]=o[e.substr(2).toLowerCase()]}),{}}),r(wt,[U,d],function(e,t){return e.extend({Defaults:{firstControlClass:"first",lastControlClass:"last"},init:function(e){this.settings=t.extend({},this.Defaults,e)},preRender:function(e){e.addClass(this.settings.containerClass,"body")},applyClasses:function(e){var t=this,n=t.settings,r,i,o;r=e.items().filter(":visible"),i=n.firstControlClass,o=n.lastControlClass,r.each(function(e){e.removeClass(i).removeClass(o),n.controlClass&&e.addClass(n.controlClass)}),r.eq(0).addClass(i),r.eq(-1).addClass(o)},renderHtml:function(e){var t=this,n=t.settings,r,i="";
return r=e.items(),r.eq(0).addClass(n.firstControlClass),r.eq(-1).addClass(n.lastControlClass),r.each(function(e){n.controlClass&&e.addClass(n.controlClass),i+=e.renderHtml()}),i},recalc:function(){},postRender:function(){}})}),r(_t,[wt],function(e){return e.extend({Defaults:{containerClass:"abs-layout",controlClass:"abs-layout-item"},recalc:function(e){e.items().filter(":visible").each(function(e){var t=e.settings;e.layoutRect({x:t.x,y:t.y,w:t.w,h:t.h}),e.recalc&&e.recalc()})},renderHtml:function(e){return'<div id="'+e._id+'-absend" class="'+e.classPrefix+'abs-end"></div>'+this._super(e)}})}),r(Et,[K,tt],function(e,t){return e.extend({Mixins:[t],Defaults:{classes:"widget tooltip tooltip-n"},text:function(e){var t=this;return"undefined"!=typeof e?(t._value=e,t._rendered&&(t.getEl().lastChild.innerHTML=t.encode(e)),t):t._value},renderHtml:function(){var e=this,t=e.classPrefix;return'<div id="'+e._id+'" class="'+e.classes()+'" role="presentation"><div class="'+t+'tooltip-arrow"></div><div class="'+t+'tooltip-inner">'+e.encode(e._text)+"</div></div>"},repaint:function(){var e=this,t,n;t=e.getEl().style,n=e._layoutRect,t.left=n.x+"px",t.top=n.y+"px",t.zIndex=131070}})}),r(Nt,[K,Et],function(e,t){var n,r=e.extend({init:function(e){var t=this;t._super(e),e=t.settings,t.canFocus=!0,e.tooltip&&r.tooltips!==!1&&(t.on("mouseenter",function(n){var r=t.tooltip().moveTo(-65535);if(n.control==t){var i=r.text(e.tooltip).show().testMoveRel(t.getEl(),["bc-tc","bc-tl","bc-tr"]);r.toggleClass("tooltip-n","bc-tc"==i),r.toggleClass("tooltip-nw","bc-tl"==i),r.toggleClass("tooltip-ne","bc-tr"==i),r.moveRel(t.getEl(),i)}else r.hide()}),t.on("mouseleave mousedown click",function(){t.tooltip().hide()})),t.aria("label",e.ariaLabel||e.tooltip)},tooltip:function(){return n||(n=new t({type:"tooltip"}),n.renderTo()),n},active:function(e){var t=this,n;return e!==n&&(t.aria("pressed",e),t.toggleClass("active",e)),t._super(e)},disabled:function(e){var t=this,n;return e!==n&&(t.aria("disabled",e),t.toggleClass("disabled",e)),t._super(e)},postRender:function(){var e=this,t=e.settings;e._rendered=!0,e._super(),e.parent()||!t.width&&!t.height||(e.initLayoutRect(),e.repaint()),t.autofocus&&e.focus()},remove:function(){this._super(),n&&(n.remove(),n=null)}});return r}),r(kt,[Nt],function(e){return e.extend({Defaults:{classes:"widget btn",role:"button"},init:function(e){var t=this,n;t.on("click mousedown",function(e){e.preventDefault()}),t._super(e),n=e.size,e.subtype&&t.addClass(e.subtype),n&&t.addClass("btn-"+n)},icon:function(e){var t=this,n=t.classPrefix;if("undefined"==typeof e)return t.settings.icon;if(t.settings.icon=e,e=e?n+"ico "+n+"i-"+t.settings.icon:"",t._rendered){var r=t.getEl().firstChild,i=r.getElementsByTagName("i")[0];e?(i&&i==r.firstChild||(i=document.createElement("i"),r.insertBefore(i,r.firstChild)),i.className=e):i&&r.removeChild(i),t.text(t._text)}return t},repaint:function(){var e=this.getEl().firstChild.style;e.width=e.height="100%",this._super()},text:function(e){var t=this;if(t._rendered){var n=t.getEl().lastChild.lastChild;n&&(n.data=t.translate(e))}return t._super(e)},renderHtml:function(){var e=this,t=e._id,n=e.classPrefix,r=e.settings.icon,i;return i=e.settings.image,i?(r="none","string"!=typeof i&&(i=window.getSelection?i[0]:i[1]),i=" style=\"background-image: url('"+i+"')\""):i="",r=e.settings.icon?n+"ico "+n+"i-"+r:"",'<div id="'+t+'" class="'+e.classes()+'" tabindex="-1" aria-labelledby="'+t+'"><button role="presentation" type="button" tabindex="-1">'+(r?'<i class="'+r+'"'+i+"></i>":"")+(e._text?(r?"\xa0":"")+e.encode(e._text):"")+"</button></div>"}})}),r(St,[J],function(e){return e.extend({Defaults:{defaultType:"button",role:"group"},renderHtml:function(){var e=this,t=e._layout;return e.addClass("btn-group"),e.preRender(),t.preRender(e),'<div id="'+e._id+'" class="'+e.classes()+'"><div id="'+e._id+'-body">'+(e.settings.html||"")+t.renderHtml(e)+"</div></div>"}})}),r(Tt,[Nt],function(e){return e.extend({Defaults:{classes:"checkbox",role:"checkbox",checked:!1},init:function(e){var t=this;t._super(e),t.on("click mousedown",function(e){e.preventDefault()}),t.on("click",function(e){e.preventDefault(),t.disabled()||t.checked(!t.checked())}),t.checked(t.settings.checked)},checked:function(e){var t=this;return"undefined"!=typeof e?(e?t.addClass("checked"):t.removeClass("checked"),t._checked=e,t.aria("checked",e),t):t._checked},value:function(e){return this.checked(e)},renderHtml:function(){var e=this,t=e._id,n=e.classPrefix;return'<div id="'+t+'" class="'+e.classes()+'" unselectable="on" aria-labelledby="'+t+'-al" tabindex="-1"><i class="'+n+"ico "+n+'i-checkbox"></i><span id="'+t+'-al" class="'+n+'label">'+e.encode(e._text)+"</span></div>"}})}),r(Rt,[Nt,G,Y],function(e,t,n){return e.extend({init:function(e){var t=this;t._super(e),t.addClass("combobox"),t.subinput=!0,t.ariaTarget="inp",e=t.settings,e.menu=e.menu||e.values,e.menu&&(e.icon="caret"),t.on("click",function(n){for(var r=n.target,i=t.getEl();r&&r!=i;)r.id&&-1!=r.id.indexOf("-open")&&(t.fire("action"),e.menu&&(t.showMenu(),n.aria&&t.menu.items()[0].focus())),r=r.parentNode}),t.on("keydown",function(e){"INPUT"==e.target.nodeName&&13==e.keyCode&&t.parents().reverse().each(function(n){return e.preventDefault(),t.fire("change"),n.hasEventListeners("submit")&&n.toJSON?(n.fire("submit",{data:n.toJSON()}),!1):void 0})}),e.placeholder&&(t.addClass("placeholder"),t.on("focusin",function(){t._hasOnChange||(n.on(t.getEl("inp"),"change",function(){t.fire("change")}),t._hasOnChange=!0),t.hasClass("placeholder")&&(t.getEl("inp").value="",t.removeClass("placeholder"))}),t.on("focusout",function(){0===t.value().length&&(t.getEl("inp").value=e.placeholder,t.addClass("placeholder"))}))},showMenu:function(){var e=this,n=e.settings,r;e.menu||(r=n.menu||[],r.length?r={type:"menu",items:r}:r.type=r.type||"menu",e.menu=t.create(r).parent(e).renderTo(e.getContainerElm()),e.fire("createmenu"),e.menu.reflow(),e.menu.on("cancel",function(t){t.control===e.menu&&e.focus()}),e.menu.on("show hide",function(t){t.control.items().each(function(t){t.active(t.value()==e.value())})}).fire("show"),e.menu.on("select",function(t){e.value(t.control.value())}),e.on("focusin",function(t){"INPUT"==t.target.tagName.toUpperCase()&&e.menu.hide()}),e.aria("expanded",!0)),e.menu.show(),e.menu.layoutRect({w:e.layoutRect().w}),e.menu.moveRel(e.getEl(),e.isRtl()?["br-tr","tr-br"]:["bl-tl","tl-bl"])},value:function(e){var t=this;return"undefined"!=typeof e?(t._value=e,t.removeClass("placeholder"),t._rendered&&(t.getEl("inp").value=e),t):t._rendered?(e=t.getEl("inp").value,e!=t.settings.placeholder?e:""):t._value},disabled:function(e){var t=this;return t._rendered&&"undefined"!=typeof e&&(t.getEl("inp").disabled=e),t._super(e)},focus:function(){this.getEl("inp").focus()},repaint:function(){var e=this,t=e.getEl(),r=e.getEl("open"),i=e.layoutRect(),o,a;o=r?i.w-n.getSize(r).width-10:i.w-10;var s=document;return s.all&&(!s.documentMode||s.documentMode<=8)&&(a=e.layoutRect().h-2+"px"),n.css(t.firstChild,{width:o,lineHeight:a}),e._super(),e},postRender:function(){var e=this;return n.on(this.getEl("inp"),"change",function(){e.fire("change")}),e._super()},remove:function(){n.off(this.getEl("inp")),this._super()},renderHtml:function(){var e=this,t=e._id,n=e.settings,r=e.classPrefix,i=n.value||n.placeholder||"",o,a,s="",l="";return"spellcheck"in n&&(l+=' spellcheck="'+n.spellcheck+'"'),n.maxLength&&(l+=' maxlength="'+n.maxLength+'"'),n.size&&(l+=' size="'+n.size+'"'),n.subtype&&(l+=' type="'+n.subtype+'"'),e.disabled()&&(l+=' disabled="disabled"'),o=n.icon,o&&"caret"!=o&&(o=r+"ico "+r+"i-"+n.icon),a=e._text,(o||a)&&(s='<div id="'+t+'-open" class="'+r+"btn "+r+'open" tabIndex="-1" role="button"><button id="'+t+'-action" type="button" hidefocus="1" tabindex="-1">'+("caret"!=o?'<i class="'+o+'"></i>':'<i class="'+r+'caret"></i>')+(a?(o?" ":"")+a:"")+"</button></div>",e.addClass("has-open")),'<div id="'+t+'" class="'+e.classes()+'"><input id="'+t+'-inp" class="'+r+"textbox "+r+'placeholder" value="'+i+'" hidefocus="1"'+l+" />"+s+"</div>"}})}),r(At,[Rt],function(e){return e.extend({init:function(e){var t=this;e.spellcheck=!1,e.onaction&&(e.icon="none"),t._super(e),t.addClass("colorbox"),t.on("change keyup postrender",function(){t.repaintColor(t.value())})},repaintColor:function(e){var t=this.getEl().getElementsByTagName("i")[0];if(t)try{t.style.background=e}catch(n){}},value:function(e){var t=this;return"undefined"!=typeof e&&t._rendered&&t.repaintColor(e),t._super(e)}})}),r(Bt,[kt,rt],function(e,t){return e.extend({showPanel:function(){var e=this,n=e.settings;if(e.active(!0),e.panel)e.panel.show();else{var r=n.panel;r.type&&(r={layout:"grid",items:r}),r.role=r.role||"dialog",r.popover=!0,r.autohide=!0,r.ariaRoot=!0,e.panel=new t(r).on("hide",function(){e.active(!1)}).on("cancel",function(t){t.stopPropagation(),e.focus(),e.hidePanel()}).parent(e).renderTo(e.getContainerElm()),e.panel.fire("show"),e.panel.reflow()}e.panel.moveRel(e.getEl(),n.popoverAlign||(e.isRtl()?["bc-tr","bc-tc"]:["bc-tl","bc-tc"]))},hidePanel:function(){var e=this;e.panel&&e.panel.hide()},postRender:function(){var e=this;return e.aria("haspopup",!0),e.on("click",function(t){t.control===e&&(e.panel&&e.panel.visible()?e.hidePanel():(e.showPanel(),e.panel.focus(!!t.aria)))}),e._super()},remove:function(){return this.panel&&(this.panel.remove(),this.panel=null),this._super()}})}),r(Dt,[Bt,y],function(e,t){var n=t.DOM;return e.extend({init:function(e){this._super(e),this.addClass("colorbutton")},color:function(e){return e?(this._color=e,this.getEl("preview").style.backgroundColor=e,this):this._color},renderHtml:function(){var e=this,t=e._id,n=e.classPrefix,r=e.settings.icon?n+"ico "+n+"i-"+e.settings.icon:"",i=e.settings.image?" style=\"background-image: url('"+e.settings.image+"')\"":"";return'<div id="'+t+'" class="'+e.classes()+'" role="button" tabindex="-1" aria-haspopup="true"><button role="presentation" hidefocus="1" type="button" tabindex="-1">'+(r?'<i class="'+r+'"'+i+"></i>":"")+'<span id="'+t+'-preview" class="'+n+'preview"></span>'+(e._text?(r?" ":"")+e._text:"")+'</button><button type="button" class="'+n+'open" hidefocus="1" tabindex="-1"> <i class="'+n+'caret"></i></button></div>'},postRender:function(){var e=this,t=e.settings.onclick;return e.on("click",function(r){r.aria&&"down"==r.aria.key||r.control!=e||n.getParent(r.target,"."+e.classPrefix+"open")||(r.stopImmediatePropagation(),t.call(e,r))}),delete e.settings.onclick,e._super()}})}),r(Lt,[],function(){function e(e){function i(e,i,o){var a,s,l,c,u,d;return a=0,s=0,l=0,e/=255,i/=255,o/=255,u=t(e,t(i,o)),d=n(e,n(i,o)),u==d?(l=u,{h:0,s:0,v:100*l}):(c=e==u?i-o:o==u?e-i:o-e,a=e==u?3:o==u?1:5,a=60*(a-c/(d-u)),s=(d-u)/d,l=d,{h:r(a),s:r(100*s),v:r(100*l)})}function o(e,i,o){var a,s,l,c;if(e=(parseInt(e,10)||0)%360,i=parseInt(i,10)/100,o=parseInt(o,10)/100,i=n(0,t(i,1)),o=n(0,t(o,1)),0===i)return void(d=f=p=r(255*o));switch(a=e/60,s=o*i,l=s*(1-Math.abs(a%2-1)),c=o-s,Math.floor(a)){case 0:d=s,f=l,p=0;break;case 1:d=l,f=s,p=0;break;case 2:d=0,f=s,p=l;break;case 3:d=0,f=l,p=s;break;case 4:d=l,f=0,p=s;break;case 5:d=s,f=0,p=l;break;default:d=f=p=0}d=r(255*(d+c)),f=r(255*(f+c)),p=r(255*(p+c))}function a(){function e(e){return e=parseInt(e,10).toString(16),e.length>1?e:"0"+e}return"#"+e(d)+e(f)+e(p)}function s(){return{r:d,g:f,b:p}}function l(){return i(d,f,p)}function c(e){var t;return"object"==typeof e?"r"in e?(d=e.r,f=e.g,p=e.b):"v"in e&&o(e.h,e.s,e.v):(t=/rgb\s*\(\s*([0-9]+)\s*,\s*([0-9]+)\s*,\s*([0-9]+)[^\)]*\)/gi.exec(e))?(d=parseInt(t[1],10),f=parseInt(t[2],10),p=parseInt(t[3],10)):(t=/#([0-F]{2})([0-F]{2})([0-F]{2})/gi.exec(e))?(d=parseInt(t[1],16),f=parseInt(t[2],16),p=parseInt(t[3],16)):(t=/#([0-F])([0-F])([0-F])/gi.exec(e))&&(d=parseInt(t[1]+t[1],16),f=parseInt(t[2]+t[2],16),p=parseInt(t[3]+t[3],16)),d=0>d?0:d>255?255:d,f=0>f?0:f>255?255:f,p=0>p?0:p>255?255:p,u}var u=this,d=0,f=0,p=0;e&&c(e),u.toRgb=s,u.toHsv=l,u.toHex=a,u.parse=c}var t=Math.min,n=Math.max,r=Math.round;return e}),r(Ht,[Nt,Q,Y,Lt],function(e,t,n,r){return e.extend({Defaults:{classes:"widget colorpicker"},init:function(e){this._super(e)},postRender:function(){function e(e,t){var r=n.getPos(e),i,o;return i=t.pageX-r.x,o=t.pageY-r.y,i=Math.max(0,Math.min(i/e.clientWidth,1)),o=Math.max(0,Math.min(o/e.clientHeight,1)),{x:i,y:o}}function i(e,t){var i=(360-e.h)/360;n.css(d,{top:100*i+"%"}),t||n.css(p,{left:e.s+"%",top:100-e.v+"%"}),f.style.background=new r({s:100,v:100,h:e.h}).toHex(),s.color().parse({s:e.s,v:e.v,h:e.h})}function o(t){var n;n=e(f,t),c.s=100*n.x,c.v=100*(1-n.y),i(c),s.fire("change")}function a(t){var n;n=e(u,t),c=l.toHsv(),c.h=360*(1-n.y),i(c,!0),s.fire("change")}var s=this,l=s.color(),c,u,d,f,p;u=s.getEl("h"),d=s.getEl("hp"),f=s.getEl("sv"),p=s.getEl("svp"),s._repaint=function(){c=l.toHsv(),i(c)},s._super(),s._svdraghelper=new t(s._id+"-sv",{start:o,drag:o}),s._hdraghelper=new t(s._id+"-h",{start:a,drag:a}),s._repaint()},rgb:function(){return this.color().toRgb()},value:function(e){var t=this;return arguments.length?(t.color().parse(e),void(t._rendered&&t._repaint())):t.color().toHex()},color:function(){return this._color||(this._color=new r),this._color},renderHtml:function(){function e(){var e,t,n="",i,a;for(i="filter:progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr=",a=o.split(","),e=0,t=a.length-1;t>e;e++)n+='<div class="'+r+'colorpicker-h-chunk" style="height:'+100/t+"%;"+i+a[e]+",endColorstr="+a[e+1]+");-ms-"+i+a[e]+",endColorstr="+a[e+1]+')"></div>';return n}var t=this,n=t._id,r=t.classPrefix,i,o="#ff0000,#ff0080,#ff00ff,#8000ff,#0000ff,#0080ff,#00ffff,#00ff80,#00ff00,#80ff00,#ffff00,#ff8000,#ff0000",a="background: -ms-linear-gradient(top,"+o+");background: linear-gradient(to bottom,"+o+");";return i='<div id="'+n+'-h" class="'+r+'colorpicker-h" style="'+a+'">'+e()+'<div id="'+n+'-hp" class="'+r+'colorpicker-h-marker"></div></div>','<div id="'+n+'" class="'+t.classes()+'"><div id="'+n+'-sv" class="'+r+'colorpicker-sv"><div class="'+r+'colorpicker-overlay1"><div class="'+r+'colorpicker-overlay2"><div id="'+n+'-svp" class="'+r+'colorpicker-selector1"><div class="'+r+'colorpicker-selector2"></div></div></div></div></div>'+i+"</div>"}})}),r(Mt,[Nt],function(e){return e.extend({init:function(e){var t=this;e.delimiter||(e.delimiter="\xbb"),t._super(e),t.addClass("path"),t.canFocus=!0,t.on("click",function(e){var n,r=e.target;(n=r.getAttribute("data-index"))&&t.fire("select",{value:t.data()[n],index:n})})},focus:function(){var e=this;return e.getEl().firstChild.focus(),e},data:function(e){var t=this;return"undefined"!=typeof e?(t._data=e,t.update(),t):t._data},update:function(){this.innerHtml(this._getPathHtml())},postRender:function(){var e=this;e._super(),e.data(e.settings.data)},renderHtml:function(){var e=this;return'<div id="'+e._id+'" class="'+e.classes()+'">'+e._getPathHtml()+"</div>"},_getPathHtml:function(){var e=this,t=e._data||[],n,r,i="",o=e.classPrefix;for(n=0,r=t.length;r>n;n++)i+=(n>0?'<div class="'+o+'divider" aria-hidden="true"> '+e.settings.delimiter+" </div>":"")+'<div role="button" class="'+o+"path-item"+(n==r-1?" "+o+"last":"")+'" data-index="'+n+'" tabindex="-1" id="'+e._id+"-"+n+'" aria-level="'+n+'">'+t[n].name+"</div>";return i||(i='<div class="'+o+'path-item">\xa0</div>'),i}})}),r(Pt,[Mt,ht],function(e,t){return e.extend({postRender:function(){function e(e){if(1===e.nodeType){if("BR"==e.nodeName||e.getAttribute("data-mce-bogus"))return!0;if("bookmark"===e.getAttribute("data-mce-type"))return!0}return!1}var n=this,r=t.activeEditor;return n.on("select",function(e){r.focus(),r.selection.select(this.data()[e.index].element),r.nodeChanged()}),r.on("nodeChange",function(t){for(var i=[],o=t.parents,a=o.length;a--;)if(1==o[a].nodeType&&!e(o[a])){var s=r.fire("ResolveName",{name:o[a].nodeName.toLowerCase(),target:o[a]});if(s.isDefaultPrevented()||i.push({name:s.name,element:o[a]}),s.isPropagationStopped())break}n.data(i)}),n._super()}})}),r(Ot,[J],function(e){return e.extend({Defaults:{layout:"flex",align:"center",defaults:{flex:1}},renderHtml:function(){var e=this,t=e._layout,n=e.classPrefix;return e.addClass("formitem"),t.preRender(e),'<div id="'+e._id+'" class="'+e.classes()+'" hidefocus="1" tabindex="-1">'+(e.settings.title?'<div id="'+e._id+'-title" class="'+n+'title">'+e.settings.title+"</div>":"")+'<div id="'+e._id+'-body" class="'+e.classes("body")+'">'+(e.settings.html||"")+t.renderHtml(e)+"</div></div>"}})}),r(It,[J,Ot,d],function(e,t,n){return e.extend({Defaults:{containerCls:"form",layout:"flex",direction:"column",align:"stretch",flex:1,padding:20,labelGap:30,spacing:10,callbacks:{submit:function(){this.submit()}}},preRender:function(){var e=this,r=e.items();e.settings.formItemDefaults||(e.settings.formItemDefaults={layout:"flex",autoResize:"overflow",defaults:{flex:1}}),r.each(function(r){var i,o=r.settings.label;o&&(i=new t(n.extend({items:{type:"label",id:r._id+"-l",text:o,flex:0,forId:r._id,disabled:r.disabled()}},e.settings.formItemDefaults)),i.type="formitem",r.aria("labelledby",r._id+"-l"),"undefined"==typeof r.settings.flex&&(r.settings.flex=1),e.replace(r,i),i.add(r))})},recalcLabels:function(){var e=this,t=0,n=[],r,i,o;if(e.settings.labelGapCalc!==!1)for(o="children"==e.settings.labelGapCalc?e.find("formitem"):e.items(),o.filter("formitem").each(function(e){var r=e.items()[0],i=r.getEl().clientWidth;t=i>t?i:t,n.push(r)}),i=e.settings.labelGap||0,r=n.length;r--;)n[r].settings.minWidth=t+i},visible:function(e){var t=this._super(e);return e===!0&&this._rendered&&this.recalcLabels(),t},submit:function(){return this.fire("submit",{data:this.toJSON()})},postRender:function(){var e=this;e._super(),e.recalcLabels(),e.fromJSON(e.settings.data)}})}),r(Ft,[It],function(e){return e.extend({Defaults:{containerCls:"fieldset",layout:"flex",direction:"column",align:"stretch",flex:1,padding:"25 15 5 15",labelGap:30,spacing:10,border:1},renderHtml:function(){var e=this,t=e._layout,n=e.classPrefix;return e.preRender(),t.preRender(e),'<fieldset id="'+e._id+'" class="'+e.classes()+'" hidefocus="1" tabindex="-1">'+(e.settings.title?'<legend id="'+e._id+'-title" class="'+n+'fieldset-title">'+e.settings.title+"</legend>":"")+'<div id="'+e._id+'-body" class="'+e.classes("body")+'">'+(e.settings.html||"")+t.renderHtml(e)+"</div></fieldset>"}})}),r(zt,[Rt,d],function(e,t){return e.extend({init:function(e){var n=this,r=tinymce.activeEditor,i=r.settings,o,a,s;e.spellcheck=!1,s=i.file_picker_types||i.file_browser_callback_types,s&&(s=t.makeMap(s,/[, ]/)),(!s||s[e.filetype])&&(a=i.file_picker_callback,!a||s&&!s[e.filetype]?(a=i.file_browser_callback,!a||s&&!s[e.filetype]||(o=function(){a(n.getEl("inp").id,n.value(),e.filetype,window)})):o=function(){var i=n.fire("beforecall").meta;i=t.extend({filetype:e.filetype},i),a.call(r,function(e,t){n.value(e).fire("change",{meta:t})},n.value(),i)}),o&&(e.icon="browse",e.onaction=o),n._super(e)}})}),r(Wt,[_t],function(e){return e.extend({recalc:function(e){var t=e.layoutRect(),n=e.paddingBox();e.items().filter(":visible").each(function(e){e.layoutRect({x:n.left,y:n.top,w:t.innerW-n.right-n.left,h:t.innerH-n.top-n.bottom}),e.recalc&&e.recalc()})}})}),r(Vt,[_t],function(e){return e.extend({recalc:function(e){var t,n,r,i,o,a,s,l,c,u,d,f,p,h,m,g,v=[],y,b,C,x,w,_,E,N,k,S,T,R,A,B,D,L,H,M,P,O,I,F,z=Math.max,W=Math.min;for(r=e.items().filter(":visible"),i=e.layoutRect(),o=e._paddingBox,a=e.settings,f=e.isRtl()?a.direction||"row-reversed":a.direction,s=a.align,l=e.isRtl()?a.pack||"end":a.pack,c=a.spacing||0,("row-reversed"==f||"column-reverse"==f)&&(r=r.set(r.toArray().reverse()),f=f.split("-")[0]),"column"==f?(k="y",E="h",N="minH",S="maxH",R="innerH",T="top",A="deltaH",B="contentH",P="left",H="w",D="x",L="innerW",M="minW",O="right",I="deltaW",F="contentW"):(k="x",E="w",N="minW",S="maxW",R="innerW",T="left",A="deltaW",B="contentW",P="top",H="h",D="y",L="innerH",M="minH",O="bottom",I="deltaH",F="contentH"),d=i[R]-o[T]-o[T],_=u=0,t=0,n=r.length;n>t;t++)p=r[t],h=p.layoutRect(),m=p.settings,g=m.flex,d-=n-1>t?c:0,g>0&&(u+=g,h[S]&&v.push(p),h.flex=g),d-=h[N],y=o[P]+h[M]+o[O],y>_&&(_=y);if(x={},x[N]=0>d?i[N]-d+i[A]:i[R]-d+i[A],x[M]=_+i[I],x[B]=i[R]-d,x[F]=_,x.minW=W(x.minW,i.maxW),x.minH=W(x.minH,i.maxH),x.minW=z(x.minW,i.startMinWidth),x.minH=z(x.minH,i.startMinHeight),!i.autoResize||x.minW==i.minW&&x.minH==i.minH){for(C=d/u,t=0,n=v.length;n>t;t++)p=v[t],h=p.layoutRect(),b=h[S],y=h[N]+h.flex*C,y>b?(d-=h[S]-h[N],u-=h.flex,h.flex=0,h.maxFlexSize=b):h.maxFlexSize=0;for(C=d/u,w=o[T],x={},0===u&&("end"==l?w=d+o[T]:"center"==l?(w=Math.round(i[R]/2-(i[R]-d)/2)+o[T],0>w&&(w=o[T])):"justify"==l&&(w=o[T],c=Math.floor(d/(r.length-1)))),x[D]=o[P],t=0,n=r.length;n>t;t++)p=r[t],h=p.layoutRect(),y=h.maxFlexSize||h[N],"center"===s?x[D]=Math.round(i[L]/2-h[H]/2):"stretch"===s?(x[H]=z(h[M]||0,i[L]-o[P]-o[O]),x[D]=o[P]):"end"===s&&(x[D]=i[L]-h[H]-o.top),h.flex>0&&(y+=h.flex*C),x[E]=y,x[k]=w,p.layoutRect(x),p.recalc&&p.recalc(),w+=y+c}else if(x.w=x.minW,x.h=x.minH,e.layoutRect(x),this.recalc(e),null===e._lastRect){var V=e.parent();V&&(V._lastRect=null,V.recalc())}}})}),r(Ut,[wt],function(e){return e.extend({Defaults:{containerClass:"flow-layout",controlClass:"flow-layout-item",endClass:"break"},recalc:function(e){e.items().filter(":visible").each(function(e){e.recalc&&e.recalc()})}})}),r($t,[K,Nt,rt,d,ht,u],function(e,t,n,r,i,o){function a(e){function t(t,n){return function(){var r=this;e.on("nodeChange",function(i){var o=e.formatter,a=null;s(i.parents,function(e){return s(t,function(t){return n?o.matchNode(e,n,{value:t.value})&&(a=t.value):o.matchNode(e,t.value)&&(a=t.value),a?!1:void 0}),a?!1:void 0}),r.value(a)})}}function r(e){e=e.replace(/;$/,"").split(";");for(var t=e.length;t--;)e[t]=e[t].split("=");return e}function i(){function t(e){var n=[];if(e)return s(e,function(e){var o={text:e.title,icon:e.icon};if(e.items)o.menu=t(e.items);else{var a=e.format||"custom"+r++;e.format||(e.name=a,i.push(e)),o.format=a,o.cmd=e.cmd}n.push(o)}),n}function n(){var n;return n=t(e.settings.style_formats_merge?e.settings.style_formats?o.concat(e.settings.style_formats):o:e.settings.style_formats||o)}var r=0,i=[],o=[{title:"Headings",items:[{title:"Heading 1",format:"h1"},{title:"Heading 2",format:"h2"},{title:"Heading 3",format:"h3"},{title:"Heading 4",format:"h4"},{title:"Heading 5",format:"h5"},{title:"Heading 6",format:"h6"}]},{title:"Inline",items:[{title:"Bold",icon:"bold",format:"bold"},{title:"Italic",icon:"italic",format:"italic"},{title:"Underline",icon:"underline",format:"underline"},{title:"Strikethrough",icon:"strikethrough",format:"strikethrough"},{title:"Superscript",icon:"superscript",format:"superscript"},{title:"Subscript",icon:"subscript",format:"subscript"},{title:"Code",icon:"code",format:"code"}]},{title:"Blocks",items:[{title:"Paragraph",format:"p"},{title:"Blockquote",format:"blockquote"},{title:"Div",format:"div"},{title:"Pre",format:"pre"}]},{title:"Alignment",items:[{title:"Left",icon:"alignleft",format:"alignleft"},{title:"Center",icon:"aligncenter",format:"aligncenter"},{title:"Right",icon:"alignright",format:"alignright"},{title:"Justify",icon:"alignjustify",format:"alignjustify"}]}];return e.on("init",function(){s(i,function(t){e.formatter.register(t.name,t)})}),{type:"menu",items:n(),onPostRender:function(t){e.fire("renderFormatsMenu",{control:t.control})},itemDefaults:{preview:!0,textStyle:function(){return this.settings.format?e.formatter.getCssText(this.settings.format):void 0},onPostRender:function(){var t=this;t.parent().on("show",function(){var n,r;n=t.settings.format,n&&(t.disabled(!e.formatter.canApply(n)),t.active(e.formatter.match(n))),r=t.settings.cmd,r&&t.active(e.queryCommandState(r))})},onclick:function(){this.settings.format&&l(this.settings.format),this.settings.cmd&&e.execCommand(this.settings.cmd)}}}}function o(t){return function(){function n(){return e.undoManager?e.undoManager[t]():!1}var r=this;t="redo"==t?"hasRedo":"hasUndo",r.disabled(!n()),e.on("Undo Redo AddUndo TypingUndo ClearUndos",function(){r.disabled(!n())})}}function a(){var t=this;e.on("VisualAid",function(e){t.active(e.hasVisual)}),t.active(e.hasVisual)}function l(t){t.control&&(t=t.control.value()),t&&e.execCommand("mceToggleFormat",!1,t)}var c;c=i(),s({bold:"Bold",italic:"Italic",underline:"Underline",strikethrough:"Strikethrough",subscript:"Subscript",superscript:"Superscript"},function(t,n){e.addButton(n,{tooltip:t,onPostRender:function(){var t=this;e.formatter?e.formatter.formatChanged(n,function(e){t.active(e)}):e.on("init",function(){e.formatter.formatChanged(n,function(e){t.active(e)})})},onclick:function(){l(n)}})}),s({outdent:["Decrease indent","Outdent"],indent:["Increase indent","Indent"],cut:["Cut","Cut"],copy:["Copy","Copy"],paste:["Paste","Paste"],help:["Help","mceHelp"],selectall:["Select all","SelectAll"],removeformat:["Clear formatting","RemoveFormat"],visualaid:["Visual aids","mceToggleVisualAid"],newdocument:["New document","mceNewDocument"]},function(t,n){e.addButton(n,{tooltip:t[0],cmd:t[1]})}),s({blockquote:["Blockquote","mceBlockQuote"],numlist:["Numbered list","InsertOrderedList"],bullist:["Bullet list","InsertUnorderedList"],subscript:["Subscript","Subscript"],superscript:["Superscript","Superscript"],alignleft:["Align left","JustifyLeft"],aligncenter:["Align center","JustifyCenter"],alignright:["Align right","JustifyRight"],alignjustify:["Justify","JustifyFull"]},function(t,n){e.addButton(n,{tooltip:t[0],cmd:t[1],onPostRender:function(){var t=this;e.formatter?e.formatter.formatChanged(n,function(e){t.active(e)}):e.on("init",function(){e.formatter.formatChanged(n,function(e){t.active(e)})})}})}),e.addButton("undo",{tooltip:"Undo",onPostRender:o("undo"),cmd:"undo"}),e.addButton("redo",{tooltip:"Redo",onPostRender:o("redo"),cmd:"redo"}),e.addMenuItem("newdocument",{text:"New document",shortcut:"Ctrl+N",icon:"newdocument",cmd:"mceNewDocument"}),e.addMenuItem("undo",{text:"Undo",icon:"undo",shortcut:"Ctrl+Z",onPostRender:o("undo"),cmd:"undo"}),e.addMenuItem("redo",{text:"Redo",icon:"redo",shortcut:"Ctrl+Y",onPostRender:o("redo"),cmd:"redo"}),e.addMenuItem("visualaid",{text:"Visual aids",selectable:!0,onPostRender:a,cmd:"mceToggleVisualAid"}),s({cut:["Cut","Cut","Ctrl+X"],copy:["Copy","Copy","Ctrl+C"],paste:["Paste","Paste","Ctrl+V"],selectall:["Select all","SelectAll","Ctrl+A"],bold:["Bold","Bold","Ctrl+B"],italic:["Italic","Italic","Ctrl+I"],underline:["Underline","Underline"],strikethrough:["Strikethrough","Strikethrough"],subscript:["Subscript","Subscript"],superscript:["Superscript","Superscript"],removeformat:["Clear formatting","RemoveFormat"]},function(t,n){e.addMenuItem(n,{text:t[0],icon:n,shortcut:t[2],cmd:t[1]})}),e.on("mousedown",function(){n.hideAll()}),e.addButton("styleselect",{type:"menubutton",text:"Formats",menu:c}),e.addButton("formatselect",function(){var n=[],i=r(e.settings.block_formats||"Paragraph=p;Address=address;Pre=pre;Heading 1=h1;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6");return s(i,function(t){n.push({text:t[0],value:t[1],textStyle:function(){return e.formatter.getCssText(t[1])}})}),{type:"listbox",text:i[0][0],values:n,fixedWidth:!0,onselect:l,onPostRender:t(n)}}),e.addButton("fontselect",function(){var n="Andale Mono=andale mono,times;Arial=arial,helvetica,sans-serif;Arial Black=arial black,avant garde;Book Antiqua=book antiqua,palatino;Comic Sans MS=comic sans ms,sans-serif;Courier New=courier new,courier;Georgia=georgia,palatino;Helvetica=helvetica;Impact=impact,chicago;Symbol=symbol;Tahoma=tahoma,arial,helvetica,sans-serif;Terminal=terminal,monaco;Times New Roman=times new roman,times;Trebuchet MS=trebuchet ms,geneva;Verdana=verdana,geneva;Webdings=webdings;Wingdings=wingdings,zapf dingbats",i=[],o=r(e.settings.font_formats||n);return s(o,function(e){i.push({text:{raw:e[0]},value:e[1],textStyle:-1==e[1].indexOf("dings")?"font-family:"+e[1]:""})}),{type:"listbox",text:"Font Family",tooltip:"Font Family",values:i,fixedWidth:!0,onPostRender:t(i,"fontname"),onselect:function(t){t.control.settings.value&&e.execCommand("FontName",!1,t.control.settings.value)}}}),e.addButton("fontsizeselect",function(){var n=[],r="8pt 10pt 12pt 14pt 18pt 24pt 36pt",i=e.settings.fontsize_formats||r;return s(i.split(" "),function(e){var t=e,r=e,i=e.split("=");i.length>1&&(t=i[0],r=i[1]),n.push({text:t,value:r})}),{type:"listbox",text:"Font Sizes",tooltip:"Font Sizes",values:n,fixedWidth:!0,onPostRender:t(n,"fontsize"),onclick:function(t){t.control.settings.value&&e.execCommand("FontSize",!1,t.control.settings.value)}}}),e.addMenuItem("formats",{text:"Formats",menu:c})}var s=r.each;i.on("AddEditor",function(t){t.editor.rtl&&(e.rtl=!0),a(t.editor)}),e.translate=function(e){return i.translate(e)},t.tooltips=!o.iOS}),r(qt,[_t],function(e){return e.extend({recalc:function(e){var t=e.settings,n,r,i,o,a,s,l,c,u,d,f,p,h,m,g,v,y,b,C,x,w,_,E=[],N=[],k,S,T,R,A,B;t=e.settings,i=e.items().filter(":visible"),o=e.layoutRect(),r=t.columns||Math.ceil(Math.sqrt(i.length)),n=Math.ceil(i.length/r),y=t.spacingH||t.spacing||0,b=t.spacingV||t.spacing||0,C=t.alignH||t.align,x=t.alignV||t.align,g=e._paddingBox,A="reverseRows"in t?t.reverseRows:e.isRtl(),C&&"string"==typeof C&&(C=[C]),x&&"string"==typeof x&&(x=[x]);for(d=0;r>d;d++)E.push(0);for(f=0;n>f;f++)N.push(0);for(f=0;n>f;f++)for(d=0;r>d&&(u=i[f*r+d],u);d++)c=u.layoutRect(),k=c.minW,S=c.minH,E[d]=k>E[d]?k:E[d],N[f]=S>N[f]?S:N[f];for(T=o.innerW-g.left-g.right,w=0,d=0;r>d;d++)w+=E[d]+(d>0?y:0),T-=(d>0?y:0)+E[d];for(R=o.innerH-g.top-g.bottom,_=0,f=0;n>f;f++)_+=N[f]+(f>0?b:0),R-=(f>0?b:0)+N[f];if(w+=g.left+g.right,_+=g.top+g.bottom,l={},l.minW=w+(o.w-o.innerW),l.minH=_+(o.h-o.innerH),l.contentW=l.minW-o.deltaW,l.contentH=l.minH-o.deltaH,l.minW=Math.min(l.minW,o.maxW),l.minH=Math.min(l.minH,o.maxH),l.minW=Math.max(l.minW,o.startMinWidth),l.minH=Math.max(l.minH,o.startMinHeight),!o.autoResize||l.minW==o.minW&&l.minH==o.minH){o.autoResize&&(l=e.layoutRect(l),l.contentW=l.minW-o.deltaW,l.contentH=l.minH-o.deltaH);var D;D="start"==t.packV?0:R>0?Math.floor(R/n):0;var L=0,H=t.flexWidths;if(H)for(d=0;d<H.length;d++)L+=H[d];else L=r;var M=T/L;for(d=0;r>d;d++)E[d]+=H?H[d]*M:M;for(h=g.top,f=0;n>f;f++){for(p=g.left,s=N[f]+D,d=0;r>d&&(B=A?f*r+r-1-d:f*r+d,u=i[B],u);d++)m=u.settings,c=u.layoutRect(),a=Math.max(E[d],c.startMinWidth),c.x=p,c.y=h,v=m.alignH||(C?C[d]||C[0]:null),"center"==v?c.x=p+a/2-c.w/2:"right"==v?c.x=p+a-c.w:"stretch"==v&&(c.w=a),v=m.alignV||(x?x[d]||x[0]:null),"center"==v?c.y=h+s/2-c.h/2:"bottom"==v?c.y=h+s-c.h:"stretch"==v&&(c.h=s),u.layoutRect(c),p+=a+y,u.recalc&&u.recalc();h+=s+b}}else if(l.w=l.minW,l.h=l.minH,e.layoutRect(l),this.recalc(e),null===e._lastRect){var P=e.parent();P&&(P._lastRect=null,P.recalc())}}})}),r(jt,[Nt],function(e){return e.extend({renderHtml:function(){var e=this;return e.addClass("iframe"),e.canFocus=!1,'<iframe id="'+e._id+'" class="'+e.classes()+'" tabindex="-1" src="'+(e.settings.url||"javascript:''")+'" frameborder="0"></iframe>'},src:function(e){this.getEl().src=e},html:function(e,t){var n=this,r=this.getEl().contentWindow.document.body;return r?(r.innerHTML=e,t&&t()):setTimeout(function(){n.html(e)},0),this}})}),r(Yt,[Nt,Y],function(e,t){return e.extend({init:function(e){var t=this;t._super(e),t.addClass("widget"),t.addClass("label"),t.canFocus=!1,e.multiline&&t.addClass("autoscroll"),e.strong&&t.addClass("strong")},initLayoutRect:function(){var e=this,n=e._super();if(e.settings.multiline){var r=t.getSize(e.getEl());r.width>n.maxW&&(n.minW=n.maxW,e.addClass("multiline")),e.getEl().style.width=n.minW+"px",n.startMinH=n.h=n.minH=Math.min(n.maxH,t.getSize(e.getEl()).height)}return n},repaint:function(){var e=this;return e.settings.multiline||(e.getEl().style.lineHeight=e.layoutRect().h+"px"),e._super()},text:function(e){var t=this;return t._rendered&&e&&this.innerHtml(t.encode(e)),t._super(e)},renderHtml:function(){var e=this,t=e.settings.forId;return'<label id="'+e._id+'" class="'+e.classes()+'"'+(t?' for="'+t+'"':"")+">"+e.encode(e._text)+"</label>"
}})}),r(Kt,[J],function(e){return e.extend({Defaults:{role:"toolbar",layout:"flow"},init:function(e){var t=this;t._super(e),t.addClass("toolbar")},postRender:function(){var e=this;return e.items().addClass("toolbar-item"),e._super()}})}),r(Gt,[Kt],function(e){return e.extend({Defaults:{role:"menubar",containerCls:"menubar",ariaRoot:!0,defaults:{type:"menubutton"}}})}),r(Xt,[kt,G,Gt],function(e,t,n){function r(e,t){for(;e;){if(t===e)return!0;e=e.parentNode}return!1}var i=e.extend({init:function(e){var t=this;t._renderOpen=!0,t._super(e),t.addClass("menubtn"),e.fixedWidth&&t.addClass("fixed-width"),t.aria("haspopup",!0),t.hasPopup=!0},showMenu:function(){var e=this,n=e.settings,r;return e.menu&&e.menu.visible()?e.hideMenu():(e.menu||(r=n.menu||[],r.length?r={type:"menu",items:r}:r.type=r.type||"menu",e.menu=t.create(r).parent(e).renderTo(),e.fire("createmenu"),e.menu.reflow(),e.menu.on("cancel",function(t){t.control.parent()===e.menu&&(t.stopPropagation(),e.focus(),e.hideMenu())}),e.menu.on("select",function(){e.focus()}),e.menu.on("show hide",function(t){t.control==e.menu&&e.activeMenu("show"==t.type),e.aria("expanded","show"==t.type)}).fire("show")),e.menu.show(),e.menu.layoutRect({w:e.layoutRect().w}),void e.menu.moveRel(e.getEl(),e.isRtl()?["br-tr","tr-br"]:["bl-tl","tl-bl"]))},hideMenu:function(){var e=this;e.menu&&(e.menu.items().each(function(e){e.hideMenu&&e.hideMenu()}),e.menu.hide())},activeMenu:function(e){this.toggleClass("active",e)},renderHtml:function(){var e=this,t=e._id,r=e.classPrefix,i=e.settings.icon,o;return o=e.settings.image,o?(i="none","string"!=typeof o&&(o=window.getSelection?o[0]:o[1]),o=" style=\"background-image: url('"+o+"')\""):o="",i=e.settings.icon?r+"ico "+r+"i-"+i:"",e.aria("role",e.parent()instanceof n?"menuitem":"button"),'<div id="'+t+'" class="'+e.classes()+'" tabindex="-1" aria-labelledby="'+t+'"><button id="'+t+'-open" role="presentation" type="button" tabindex="-1">'+(i?'<i class="'+i+'"'+o+"></i>":"")+"<span>"+(e._text?(i?"\xa0":"")+e.encode(e._text):"")+'</span> <i class="'+r+'caret"></i></button></div>'},postRender:function(){var e=this;return e.on("click",function(t){t.control===e&&r(t.target,e.getEl())&&(e.showMenu(),t.aria&&e.menu.items()[0].focus())}),e.on("mouseenter",function(t){var n=t.control,r=e.parent(),o;n&&r&&n instanceof i&&n.parent()==r&&(r.items().filter("MenuButton").each(function(e){e.hideMenu&&e!=n&&(e.menu&&e.menu.visible()&&(o=!0),e.hideMenu())}),o&&(n.focus(),n.showMenu()))}),e._super()},text:function(e){var t=this,n,r;if(t._rendered)for(r=t.getEl("open").getElementsByTagName("span"),n=0;n<r.length;n++)r[n].innerHTML=(t.settings.icon&&e?"\xa0":"")+t.encode(e);return this._super(e)},remove:function(){this._super(),this.menu&&this.menu.remove()}});return i}),r(Jt,[Xt],function(e){return e.extend({init:function(e){function t(r){for(var a=0;a<r.length;a++){if(i=r[a].selected||e.value===r[a].value){o=o||r[a].text,n._value=r[a].value;break}r[a].menu&&t(r[a].menu)}}var n=this,r,i,o,a;n._values=r=e.values,r&&("undefined"!=typeof e.value&&t(r),!i&&r.length>0&&(o=r[0].text,n._value=r[0].value),e.menu=r),e.text=e.text||o||r[0].text,n._super(e),n.addClass("listbox"),n.on("select",function(t){var r=t.control;a&&(t.lastControl=a),e.multiple?r.active(!r.active()):n.value(t.control.settings.value),a=r})},value:function(e){function t(e,n){e.items().each(function(e){i=e.value()===n,i&&(o=o||e.text()),e.active(i),e.menu&&t(e.menu,n)})}function n(t){for(var r=0;r<t.length;r++)i=t[r].value==e,i&&(o=o||t[r].text),t[r].active=i,t[r].menu&&n(t[r].menu)}var r=this,i,o,a;return"undefined"!=typeof e&&(r.menu?t(r.menu,e):(a=r.settings.menu,n(a)),r.text(o||this.settings.text)),r._super(e)}})}),r(Qt,[Nt,G,u],function(e,t,n){return e.extend({Defaults:{border:0,role:"menuitem"},init:function(e){var t=this;t.hasPopup=!0,t._super(e),e=t.settings,t.addClass("menu-item"),e.menu&&t.addClass("menu-item-expand"),e.preview&&t.addClass("menu-item-preview"),("-"===t._text||"|"===t._text)&&(t.addClass("menu-item-sep"),t.aria("role","separator"),t._text="-"),e.selectable&&(t.aria("role","menuitemcheckbox"),t.addClass("menu-item-checkbox"),e.icon="selected"),e.preview||e.selectable||t.addClass("menu-item-normal"),t.on("mousedown",function(e){e.preventDefault()}),e.menu&&!e.ariaHideMenu&&t.aria("haspopup",!0)},hasMenus:function(){return!!this.settings.menu},showMenu:function(){var e=this,n=e.settings,r,i=e.parent();if(i.items().each(function(t){t!==e&&t.hideMenu()}),n.menu){r=e.menu,r?r.show():(r=n.menu,r.length?r={type:"menu",items:r}:r.type=r.type||"menu",i.settings.itemDefaults&&(r.itemDefaults=i.settings.itemDefaults),r=e.menu=t.create(r).parent(e).renderTo(),r.reflow(),r.on("cancel",function(t){t.stopPropagation(),e.focus(),r.hide()}),r.on("show hide",function(e){e.control.items().each(function(e){e.active(e.settings.selected)})}).fire("show"),r.on("hide",function(t){t.control===r&&e.removeClass("selected")}),r.submenu=!0),r._parentMenu=i,r.addClass("menu-sub");var o=r.testMoveRel(e.getEl(),e.isRtl()?["tl-tr","bl-br","tr-tl","br-bl"]:["tr-tl","br-bl","tl-tr","bl-br"]);r.moveRel(e.getEl(),o),r.rel=o,o="menu-sub-"+o,r.removeClass(r._lastRel),r.addClass(o),r._lastRel=o,e.addClass("selected"),e.aria("expanded",!0)}},hideMenu:function(){var e=this;return e.menu&&(e.menu.items().each(function(e){e.hideMenu&&e.hideMenu()}),e.menu.hide(),e.aria("expanded",!1)),e},renderHtml:function(){var e=this,t=e._id,r=e.settings,i=e.classPrefix,o=e.encode(e._text),a=e.settings.icon,s="",l=r.shortcut;return a&&e.parent().addClass("menu-has-icons"),r.image&&(a="none",s=" style=\"background-image: url('"+r.image+"')\""),l&&n.mac&&(l=l.replace(/ctrl\+alt\+/i,"&#x2325;&#x2318;"),l=l.replace(/ctrl\+/i,"&#x2318;"),l=l.replace(/alt\+/i,"&#x2325;"),l=l.replace(/shift\+/i,"&#x21E7;")),a=i+"ico "+i+"i-"+(e.settings.icon||"none"),'<div id="'+t+'" class="'+e.classes()+'" tabindex="-1">'+("-"!==o?'<i class="'+a+'"'+s+"></i>\xa0":"")+("-"!==o?'<span id="'+t+'-text" class="'+i+'text">'+o+"</span>":"")+(l?'<div id="'+t+'-shortcut" class="'+i+'menu-shortcut">'+l+"</div>":"")+(r.menu?'<div class="'+i+'caret"></div>':"")+"</div>"},postRender:function(){var e=this,t=e.settings,n=t.textStyle;if("function"==typeof n&&(n=n.call(this)),n){var r=e.getEl("text");r&&r.setAttribute("style",n)}return e.on("mouseenter click",function(n){n.control===e&&(t.menu||"click"!==n.type?(e.showMenu(),n.aria&&e.menu.focus(!0)):(e.fire("select"),e.parent().hideAll()))}),e._super(),e},active:function(e){return"undefined"!=typeof e&&this.aria("checked",e),this._super(e)},remove:function(){this._super(),this.menu&&this.menu.remove()}})}),r(Zt,[rt,Qt,d],function(e,t,n){var r=e.extend({Defaults:{defaultType:"menuitem",border:1,layout:"stack",role:"application",bodyRole:"menu",ariaRoot:!0},init:function(e){var t=this;if(e.autohide=!0,e.constrainToViewport=!0,e.itemDefaults)for(var r=e.items,i=r.length;i--;)r[i]=n.extend({},e.itemDefaults,r[i]);t._super(e),t.addClass("menu")},repaint:function(){return this.toggleClass("menu-align",!0),this._super(),this.getEl().style.height="",this.getEl("body").style.height="",this},cancel:function(){var e=this;e.hideAll(),e.fire("select")},hideAll:function(){var e=this;return this.find("menuitem").exec("hideMenu"),e._super()},preRender:function(){var e=this;return e.items().each(function(t){var n=t.settings;return n.icon||n.selectable?(e._hasIcons=!0,!1):void 0}),e._super()}});return r}),r(en,[Tt],function(e){return e.extend({Defaults:{classes:"radio",role:"radio"}})}),r(tn,[Nt,Q],function(e,t){return e.extend({renderHtml:function(){var e=this,t=e.classPrefix;return e.addClass("resizehandle"),"both"==e.settings.direction&&e.addClass("resizehandle-both"),e.canFocus=!1,'<div id="'+e._id+'" class="'+e.classes()+'"><i class="'+t+"ico "+t+'i-resize"></i></div>'},postRender:function(){var e=this;e._super(),e.resizeDragHelper=new t(this._id,{start:function(){e.fire("ResizeStart")},drag:function(t){"both"!=e.settings.direction&&(t.deltaX=0),e.fire("Resize",t)},stop:function(){e.fire("ResizeEnd")}})},remove:function(){return this.resizeDragHelper&&this.resizeDragHelper.destroy(),this._super()}})}),r(nn,[Nt],function(e){return e.extend({renderHtml:function(){var e=this;return e.addClass("spacer"),e.canFocus=!1,'<div id="'+e._id+'" class="'+e.classes()+'"></div>'}})}),r(rn,[Xt,Y],function(e,t){return e.extend({Defaults:{classes:"widget btn splitbtn",role:"button"},repaint:function(){var e=this,n=e.getEl(),r=e.layoutRect(),i,o;return e._super(),i=n.firstChild,o=n.lastChild,t.css(i,{width:r.w-t.getSize(o).width,height:r.h-2}),t.css(o,{height:r.h-2}),e},activeMenu:function(e){var n=this;t.toggleClass(n.getEl().lastChild,n.classPrefix+"active",e)},renderHtml:function(){var e=this,t=e._id,n=e.classPrefix,r,i=e.settings.icon;return r=e.settings.image,r?(i="none","string"!=typeof r&&(r=window.getSelection?r[0]:r[1]),r=" style=\"background-image: url('"+r+"')\""):r="",i=e.settings.icon?n+"ico "+n+"i-"+i:"",'<div id="'+t+'" class="'+e.classes()+'" role="button" tabindex="-1"><button type="button" hidefocus="1" tabindex="-1">'+(i?'<i class="'+i+'"'+r+"></i>":"")+(e._text?(i?" ":"")+e._text:"")+'</button><button type="button" class="'+n+'open" hidefocus="1" tabindex="-1">'+(e._menuBtnText?(i?"\xa0":"")+e._menuBtnText:"")+' <i class="'+n+'caret"></i></button></div>'},postRender:function(){var e=this,t=e.settings.onclick;return e.on("click",function(e){var n=e.target;if(e.control==this)for(;n;){if(e.aria&&"down"!=e.aria.key||"BUTTON"==n.nodeName&&-1==n.className.indexOf("open"))return e.stopImmediatePropagation(),void t.call(this,e);n=n.parentNode}}),delete e.settings.onclick,e._super()}})}),r(on,[Ut],function(e){return e.extend({Defaults:{containerClass:"stack-layout",controlClass:"stack-layout-item",endClass:"break"}})}),r(an,[et,Y],function(e,t){return e.extend({Defaults:{layout:"absolute",defaults:{type:"panel"}},activateTab:function(e){var n;this.activeTabId&&(n=this.getEl(this.activeTabId),t.removeClass(n,this.classPrefix+"active"),n.setAttribute("aria-selected","false")),this.activeTabId="t"+e,n=this.getEl("t"+e),n.setAttribute("aria-selected","true"),t.addClass(n,this.classPrefix+"active"),this.items()[e].show().fire("showtab"),this.reflow(),this.items().each(function(t,n){e!=n&&t.hide()})},renderHtml:function(){var e=this,t=e._layout,n="",r=e.classPrefix;return e.preRender(),t.preRender(e),e.items().each(function(t,i){var o=e._id+"-t"+i;t.aria("role","tabpanel"),t.aria("labelledby",o),n+='<div id="'+o+'" class="'+r+'tab" unselectable="on" role="tab" aria-controls="'+t._id+'" aria-selected="false" tabIndex="-1">'+e.encode(t.settings.title)+"</div>"}),'<div id="'+e._id+'" class="'+e.classes()+'" hidefocus="1" tabindex="-1"><div id="'+e._id+'-head" class="'+r+'tabs" role="tablist">'+n+'</div><div id="'+e._id+'-body" class="'+e.classes("body")+'">'+t.renderHtml(e)+"</div></div>"},postRender:function(){var e=this;e._super(),e.settings.activeTab=e.settings.activeTab||0,e.activateTab(e.settings.activeTab),this.on("click",function(t){var n=t.target.parentNode;if(t.target.parentNode.id==e._id+"-head")for(var r=n.childNodes.length;r--;)n.childNodes[r]==t.target&&e.activateTab(r)})},initLayoutRect:function(){var e=this,n,r,i;r=t.getSize(e.getEl("head")).width,r=0>r?0:r,i=0,e.items().each(function(e){r=Math.max(r,e.layoutRect().minW),i=Math.max(i,e.layoutRect().minH)}),e.items().each(function(e){e.settings.x=0,e.settings.y=0,e.settings.w=r,e.settings.h=i,e.layoutRect({x:0,y:0,w:r,h:i})});var o=t.getSize(e.getEl("head")).height;return e.settings.minWidth=r,e.settings.minHeight=i+o,n=e._super(),n.deltaH+=o,n.innerH=n.h-n.deltaH,n}})}),r(sn,[Nt,Y],function(e,t){return e.extend({init:function(e){var t=this;t._super(e),t._value=e.value||"",t.addClass("textbox"),e.multiline?t.addClass("multiline"):t.on("keydown",function(e){13==e.keyCode&&t.parents().reverse().each(function(t){return e.preventDefault(),t.hasEventListeners("submit")&&t.toJSON?(t.fire("submit",{data:t.toJSON()}),!1):void 0})})},disabled:function(e){var t=this;return t._rendered&&"undefined"!=typeof e&&(t.getEl().disabled=e),t._super(e)},value:function(e){var t=this;return"undefined"!=typeof e?(t._value=e,t._rendered&&(t.getEl().value=e),t):t._rendered?t.getEl().value:t._value},repaint:function(){var e=this,t,n,r,i=0,o=0,a;t=e.getEl().style,n=e._layoutRect,a=e._lastRepaintRect||{};var s=document;return!e.settings.multiline&&s.all&&(!s.documentMode||s.documentMode<=8)&&(t.lineHeight=n.h-o+"px"),r=e._borderBox,i=r.left+r.right+8,o=r.top+r.bottom+(e.settings.multiline?8:0),n.x!==a.x&&(t.left=n.x+"px",a.x=n.x),n.y!==a.y&&(t.top=n.y+"px",a.y=n.y),n.w!==a.w&&(t.width=n.w-i+"px",a.w=n.w),n.h!==a.h&&(t.height=n.h-o+"px",a.h=n.h),e._lastRepaintRect=a,e.fire("repaint",{},!1),e},renderHtml:function(){var e=this,t=e._id,n=e.settings,r=e.encode(e._value,!1),i="";return"spellcheck"in n&&(i+=' spellcheck="'+n.spellcheck+'"'),n.maxLength&&(i+=' maxlength="'+n.maxLength+'"'),n.size&&(i+=' size="'+n.size+'"'),n.subtype&&(i+=' type="'+n.subtype+'"'),e.disabled()&&(i+=' disabled="disabled"'),n.multiline?'<textarea id="'+t+'" class="'+e.classes()+'" '+(n.rows?' rows="'+n.rows+'"':"")+' hidefocus="1"'+i+">"+r+"</textarea>":'<input id="'+t+'" class="'+e.classes()+'" value="'+r+'" hidefocus="1"'+i+" />"},postRender:function(){var e=this;return t.on(e.getEl(),"change",function(t){e.fire("change",t)}),e._super()},remove:function(){t.off(this.getEl()),this._super()}})}),r(ln,[Y,K],function(e,t){return function(n,r){var i=this,o,a=t.classPrefix;i.show=function(t){return i.hide(),o=!0,window.setTimeout(function(){o&&n.appendChild(e.createFragment('<div class="'+a+"throbber"+(r?" "+a+"throbber-inline":"")+'"></div>'))},t||0),i},i.hide=function(){var e=n.lastChild;return e&&-1!=e.className.indexOf("throbber")&&e.parentNode.removeChild(e),o=!1,i}}}),a([l,c,u,d,f,p,h,m,g,y,b,C,_,E,N,k,S,T,R,A,B,D,L,H,M,O,I,F,z,W,V,U,$,q,j,Y,K,G,X,J,Q,Z,et,tt,nt,rt,it,ot,at,st,lt,ct,ut,dt,ft,pt,ht,mt,gt,vt,yt,bt,Ct,xt,wt,_t,Et,Nt,kt,St,Tt,Rt,At,Bt,Dt,Lt,Ht,Mt,Pt,Ot,It,Ft,zt,Wt,Vt,Ut,$t,qt,jt,Yt,Kt,Gt,Xt,Jt,Qt,Zt,en,tn,nn,rn,on,an,sn,ln])}(this);;
/* @license
morris.js v0.5.0
Copyright 2014 Olly Smith All rights reserved.
Licensed under the BSD-2-Clause License.
*/
(function(){var a,b,c,d,e=[].slice,f=function(a,b){return function(){return a.apply(b,arguments)}},g={}.hasOwnProperty,h=function(a,b){function c(){this.constructor=a}for(var d in b)g.call(b,d)&&(a[d]=b[d]);return c.prototype=b.prototype,a.prototype=new c,a.__super__=b.prototype,a},i=[].indexOf||function(a){for(var b=0,c=this.length;c>b;b++)if(b in this&&this[b]===a)return b;return-1};b=window.Morris={},a=jQuery,b.EventEmitter=function(){function a(){}return a.prototype.on=function(a,b){return null==this.handlers&&(this.handlers={}),null==this.handlers[a]&&(this.handlers[a]=[]),this.handlers[a].push(b),this},a.prototype.fire=function(){var a,b,c,d,f,g,h;if(c=arguments[0],a=2<=arguments.length?e.call(arguments,1):[],null!=this.handlers&&null!=this.handlers[c]){for(g=this.handlers[c],h=[],d=0,f=g.length;f>d;d++)b=g[d],h.push(b.apply(null,a));return h}},a}(),b.commas=function(a){var b,c,d,e;return null!=a?(d=0>a?"-":"",b=Math.abs(a),c=Math.floor(b).toFixed(0),d+=c.replace(/(?=(?:\d{3})+$)(?!^)/g,","),e=b.toString(),e.length>c.length&&(d+=e.slice(c.length)),d):"-"},b.pad2=function(a){return(10>a?"0":"")+a},b.Grid=function(c){function d(b){this.resizeHandler=f(this.resizeHandler,this);var c=this;if(this.el="string"==typeof b.element?a(document.getElementById(b.element)):a(b.element),null==this.el||0===this.el.length)throw new Error("Graph container element not found");"static"===this.el.css("position")&&this.el.css("position","relative"),this.options=a.extend({},this.gridDefaults,this.defaults||{},b),"string"==typeof this.options.units&&(this.options.postUnits=b.units),this.raphael=new Raphael(this.el[0]),this.elementWidth=null,this.elementHeight=null,this.dirty=!1,this.selectFrom=null,this.init&&this.init(),this.setData(this.options.data),this.el.bind("mousemove",function(a){var b,d,e,f,g;return d=c.el.offset(),g=a.pageX-d.left,c.selectFrom?(b=c.data[c.hitTest(Math.min(g,c.selectFrom))]._x,e=c.data[c.hitTest(Math.max(g,c.selectFrom))]._x,f=e-b,c.selectionRect.attr({x:b,width:f})):c.fire("hovermove",g,a.pageY-d.top)}),this.el.bind("mouseleave",function(){return c.selectFrom&&(c.selectionRect.hide(),c.selectFrom=null),c.fire("hoverout")}),this.el.bind("touchstart touchmove touchend",function(a){var b,d;return d=a.originalEvent.touches[0]||a.originalEvent.changedTouches[0],b=c.el.offset(),c.fire("hovermove",d.pageX-b.left,d.pageY-b.top)}),this.el.bind("click",function(a){var b;return b=c.el.offset(),c.fire("gridclick",a.pageX-b.left,a.pageY-b.top)}),this.options.rangeSelect&&(this.selectionRect=this.raphael.rect(0,0,0,this.el.innerHeight()).attr({fill:this.options.rangeSelectColor,stroke:!1}).toBack().hide(),this.el.bind("mousedown",function(a){var b;return b=c.el.offset(),c.startRange(a.pageX-b.left)}),this.el.bind("mouseup",function(a){var b;return b=c.el.offset(),c.endRange(a.pageX-b.left),c.fire("hovermove",a.pageX-b.left,a.pageY-b.top)})),this.options.resize&&a(window).bind("resize",function(){return null!=c.timeoutId&&window.clearTimeout(c.timeoutId),c.timeoutId=window.setTimeout(c.resizeHandler,100)}),this.el.css("-webkit-tap-highlight-color","rgba(0,0,0,0)"),this.postInit&&this.postInit()}return h(d,c),d.prototype.gridDefaults={dateFormat:null,axes:!0,grid:!0,gridLineColor:"#aaa",gridStrokeWidth:.5,gridTextColor:"#888",gridTextSize:12,gridTextFamily:"sans-serif",gridTextWeight:"normal",hideHover:!1,yLabelFormat:null,xLabelAngle:0,numLines:5,padding:25,parseTime:!0,postUnits:"",preUnits:"",ymax:"auto",ymin:"auto 0",goals:[],goalStrokeWidth:1,goalLineColors:["#666633","#999966","#cc6666","#663333"],events:[],eventStrokeWidth:1,eventLineColors:["#005a04","#ccffbb","#3a5f0b","#005502"],rangeSelect:null,rangeSelectColor:"#eef",resize:!1},d.prototype.setData=function(a,c){var d,e,f,g,h,i,j,k,l,m,n,o,p,q,r;return null==c&&(c=!0),this.options.data=a,null==a||0===a.length?(this.data=[],this.raphael.clear(),null!=this.hover&&this.hover.hide(),void 0):(o=this.cumulative?0:null,p=this.cumulative?0:null,this.options.goals.length>0&&(h=Math.min.apply(Math,this.options.goals),g=Math.max.apply(Math,this.options.goals),p=null!=p?Math.min(p,h):h,o=null!=o?Math.max(o,g):g),this.data=function(){var c,d,g;for(g=[],f=c=0,d=a.length;d>c;f=++c)j=a[f],i={src:j},i.label=j[this.options.xkey],this.options.parseTime?(i.x=b.parseDate(i.label),this.options.dateFormat?i.label=this.options.dateFormat(i.x):"number"==typeof i.label&&(i.label=new Date(i.label).toString())):(i.x=f,this.options.xLabelFormat&&(i.label=this.options.xLabelFormat(i))),l=0,i.y=function(){var a,b,c,d;for(c=this.options.ykeys,d=[],e=a=0,b=c.length;b>a;e=++a)n=c[e],q=j[n],"string"==typeof q&&(q=parseFloat(q)),null!=q&&"number"!=typeof q&&(q=null),null!=q&&(this.cumulative?l+=q:null!=o?(o=Math.max(q,o),p=Math.min(q,p)):o=p=q),this.cumulative&&null!=l&&(o=Math.max(l,o),p=Math.min(l,p)),d.push(q);return d}.call(this),g.push(i);return g}.call(this),this.options.parseTime&&(this.data=this.data.sort(function(a,b){return(a.x>b.x)-(b.x>a.x)})),this.xmin=this.data[0].x,this.xmax=this.data[this.data.length-1].x,this.events=[],this.options.events.length>0&&(this.events=this.options.parseTime?function(){var a,c,e,f;for(e=this.options.events,f=[],a=0,c=e.length;c>a;a++)d=e[a],f.push(b.parseDate(d));return f}.call(this):this.options.events,this.xmax=Math.max(this.xmax,Math.max.apply(Math,this.events)),this.xmin=Math.min(this.xmin,Math.min.apply(Math,this.events))),this.xmin===this.xmax&&(this.xmin-=1,this.xmax+=1),this.ymin=this.yboundary("min",p),this.ymax=this.yboundary("max",o),this.ymin===this.ymax&&(p&&(this.ymin-=1),this.ymax+=1),((r=this.options.axes)===!0||"both"===r||"y"===r||this.options.grid===!0)&&(this.options.ymax===this.gridDefaults.ymax&&this.options.ymin===this.gridDefaults.ymin?(this.grid=this.autoGridLines(this.ymin,this.ymax,this.options.numLines),this.ymin=Math.min(this.ymin,this.grid[0]),this.ymax=Math.max(this.ymax,this.grid[this.grid.length-1])):(k=(this.ymax-this.ymin)/(this.options.numLines-1),this.grid=function(){var a,b,c,d;for(d=[],m=a=b=this.ymin,c=this.ymax;k>0?c>=a:a>=c;m=a+=k)d.push(m);return d}.call(this))),this.dirty=!0,c?this.redraw():void 0)},d.prototype.yboundary=function(a,b){var c,d;return c=this.options["y"+a],"string"==typeof c?"auto"===c.slice(0,4)?c.length>5?(d=parseInt(c.slice(5),10),null==b?d:Math[a](b,d)):null!=b?b:0:parseInt(c,10):c},d.prototype.autoGridLines=function(a,b,c){var d,e,f,g,h,i,j,k,l;return h=b-a,l=Math.floor(Math.log(h)/Math.log(10)),j=Math.pow(10,l),e=Math.floor(a/j)*j,d=Math.ceil(b/j)*j,i=(d-e)/(c-1),1===j&&i>1&&Math.ceil(i)!==i&&(i=Math.ceil(i),d=e+i*(c-1)),0>e&&d>0&&(e=Math.floor(a/i)*i,d=Math.ceil(b/i)*i),1>i?(g=Math.floor(Math.log(i)/Math.log(10)),f=function(){var a,b;for(b=[],k=a=e;i>0?d>=a:a>=d;k=a+=i)b.push(parseFloat(k.toFixed(1-g)));return b}()):f=function(){var a,b;for(b=[],k=a=e;i>0?d>=a:a>=d;k=a+=i)b.push(k);return b}(),f},d.prototype._calc=function(){var a,b,c,d,e,f,g,h;return e=this.el.width(),c=this.el.height(),(this.elementWidth!==e||this.elementHeight!==c||this.dirty)&&(this.elementWidth=e,this.elementHeight=c,this.dirty=!1,this.left=this.options.padding,this.right=this.elementWidth-this.options.padding,this.top=this.options.padding,this.bottom=this.elementHeight-this.options.padding,((g=this.options.axes)===!0||"both"===g||"y"===g)&&(f=function(){var a,c,d,e;for(d=this.grid,e=[],a=0,c=d.length;c>a;a++)b=d[a],e.push(this.measureText(this.yAxisFormat(b)).width);return e}.call(this),this.left+=Math.max.apply(Math,f)),((h=this.options.axes)===!0||"both"===h||"x"===h)&&(a=function(){var a,b,c;for(c=[],d=a=0,b=this.data.length;b>=0?b>a:a>b;d=b>=0?++a:--a)c.push(this.measureText(this.data[d].text,-this.options.xLabelAngle).height);return c}.call(this),this.bottom-=Math.max.apply(Math,a)),this.width=Math.max(1,this.right-this.left),this.height=Math.max(1,this.bottom-this.top),this.dx=this.width/(this.xmax-this.xmin),this.dy=this.height/(this.ymax-this.ymin),this.calc)?this.calc():void 0},d.prototype.transY=function(a){return this.bottom-(a-this.ymin)*this.dy},d.prototype.transX=function(a){return 1===this.data.length?(this.left+this.right)/2:this.left+(a-this.xmin)*this.dx},d.prototype.redraw=function(){return this.raphael.clear(),this._calc(),this.drawGrid(),this.drawGoals(),this.drawEvents(),this.draw?this.draw():void 0},d.prototype.measureText=function(a,b){var c,d;return null==b&&(b=0),d=this.raphael.text(100,100,a).attr("font-size",this.options.gridTextSize).attr("font-family",this.options.gridTextFamily).attr("font-weight",this.options.gridTextWeight).rotate(b),c=d.getBBox(),d.remove(),c},d.prototype.yAxisFormat=function(a){return this.yLabelFormat(a)},d.prototype.yLabelFormat=function(a){return"function"==typeof this.options.yLabelFormat?this.options.yLabelFormat(a):""+this.options.preUnits+b.commas(a)+this.options.postUnits},d.prototype.drawGrid=function(){var a,b,c,d,e,f,g,h;if(this.options.grid!==!1||(e=this.options.axes)===!0||"both"===e||"y"===e){for(f=this.grid,h=[],c=0,d=f.length;d>c;c++)a=f[c],b=this.transY(a),((g=this.options.axes)===!0||"both"===g||"y"===g)&&this.drawYAxisLabel(this.left-this.options.padding/2,b,this.yAxisFormat(a)),this.options.grid?h.push(this.drawGridLine("M"+this.left+","+b+"H"+(this.left+this.width))):h.push(void 0);return h}},d.prototype.drawGoals=function(){var a,b,c,d,e,f,g;for(f=this.options.goals,g=[],c=d=0,e=f.length;e>d;c=++d)b=f[c],a=this.options.goalLineColors[c%this.options.goalLineColors.length],g.push(this.drawGoal(b,a));return g},d.prototype.drawEvents=function(){var a,b,c,d,e,f,g;for(f=this.events,g=[],c=d=0,e=f.length;e>d;c=++d)b=f[c],a=this.options.eventLineColors[c%this.options.eventLineColors.length],g.push(this.drawEvent(b,a));return g},d.prototype.drawGoal=function(a,b){return this.raphael.path("M"+this.left+","+this.transY(a)+"H"+this.right).attr("stroke",b).attr("stroke-width",this.options.goalStrokeWidth)},d.prototype.drawEvent=function(a,b){return this.raphael.path("M"+this.transX(a)+","+this.bottom+"V"+this.top).attr("stroke",b).attr("stroke-width",this.options.eventStrokeWidth)},d.prototype.drawYAxisLabel=function(a,b,c){return this.raphael.text(a,b,c).attr("font-size",this.options.gridTextSize).attr("font-family",this.options.gridTextFamily).attr("font-weight",this.options.gridTextWeight).attr("fill",this.options.gridTextColor).attr("text-anchor","end")},d.prototype.drawGridLine=function(a){return this.raphael.path(a).attr("stroke",this.options.gridLineColor).attr("stroke-width",this.options.gridStrokeWidth)},d.prototype.startRange=function(a){return this.hover.hide(),this.selectFrom=a,this.selectionRect.attr({x:a,width:0}).show()},d.prototype.endRange=function(a){var b,c;return this.selectFrom?(c=Math.min(this.selectFrom,a),b=Math.max(this.selectFrom,a),this.options.rangeSelect.call(this.el,{start:this.data[this.hitTest(c)].x,end:this.data[this.hitTest(b)].x}),this.selectFrom=null):void 0},d.prototype.resizeHandler=function(){return this.timeoutId=null,this.raphael.setSize(this.el.width(),this.el.height()),this.redraw()},d}(b.EventEmitter),b.parseDate=function(a){var b,c,d,e,f,g,h,i,j,k,l;return"number"==typeof a?a:(c=a.match(/^(\d+) Q(\d)$/),e=a.match(/^(\d+)-(\d+)$/),f=a.match(/^(\d+)-(\d+)-(\d+)$/),h=a.match(/^(\d+) W(\d+)$/),i=a.match(/^(\d+)-(\d+)-(\d+)[ T](\d+):(\d+)(Z|([+-])(\d\d):?(\d\d))?$/),j=a.match(/^(\d+)-(\d+)-(\d+)[ T](\d+):(\d+):(\d+(\.\d+)?)(Z|([+-])(\d\d):?(\d\d))?$/),c?new Date(parseInt(c[1],10),3*parseInt(c[2],10)-1,1).getTime():e?new Date(parseInt(e[1],10),parseInt(e[2],10)-1,1).getTime():f?new Date(parseInt(f[1],10),parseInt(f[2],10)-1,parseInt(f[3],10)).getTime():h?(k=new Date(parseInt(h[1],10),0,1),4!==k.getDay()&&k.setMonth(0,1+(4-k.getDay()+7)%7),k.getTime()+6048e5*parseInt(h[2],10)):i?i[6]?(g=0,"Z"!==i[6]&&(g=60*parseInt(i[8],10)+parseInt(i[9],10),"+"===i[7]&&(g=0-g)),Date.UTC(parseInt(i[1],10),parseInt(i[2],10)-1,parseInt(i[3],10),parseInt(i[4],10),parseInt(i[5],10)+g)):new Date(parseInt(i[1],10),parseInt(i[2],10)-1,parseInt(i[3],10),parseInt(i[4],10),parseInt(i[5],10)).getTime():j?(l=parseFloat(j[6]),b=Math.floor(l),d=Math.round(1e3*(l-b)),j[8]?(g=0,"Z"!==j[8]&&(g=60*parseInt(j[10],10)+parseInt(j[11],10),"+"===j[9]&&(g=0-g)),Date.UTC(parseInt(j[1],10),parseInt(j[2],10)-1,parseInt(j[3],10),parseInt(j[4],10),parseInt(j[5],10)+g,b,d)):new Date(parseInt(j[1],10),parseInt(j[2],10)-1,parseInt(j[3],10),parseInt(j[4],10),parseInt(j[5],10),b,d).getTime()):new Date(parseInt(a,10),0,1).getTime())},b.Hover=function(){function c(c){null==c&&(c={}),this.options=a.extend({},b.Hover.defaults,c),this.el=a("<div class='"+this.options["class"]+"'></div>"),this.el.hide(),this.options.parent.append(this.el)}return c.defaults={"class":"morris-hover morris-default-style"},c.prototype.update=function(a,b,c){return a?(this.html(a),this.show(),this.moveTo(b,c)):this.hide()},c.prototype.html=function(a){return this.el.html(a)},c.prototype.moveTo=function(a,b){var c,d,e,f,g,h;return g=this.options.parent.innerWidth(),f=this.options.parent.innerHeight(),d=this.el.outerWidth(),c=this.el.outerHeight(),e=Math.min(Math.max(0,a-d/2),g-d),null!=b?(h=b-c-10,0>h&&(h=b+10,h+c>f&&(h=f/2-c/2))):h=f/2-c/2,this.el.css({left:e+"px",top:parseInt(h)+"px"})},c.prototype.show=function(){return this.el.show()},c.prototype.hide=function(){return this.el.hide()},c}(),b.Line=function(a){function c(a){return this.hilight=f(this.hilight,this),this.onHoverOut=f(this.onHoverOut,this),this.onHoverMove=f(this.onHoverMove,this),this.onGridClick=f(this.onGridClick,this),this instanceof b.Line?(c.__super__.constructor.call(this,a),void 0):new b.Line(a)}return h(c,a),c.prototype.init=function(){return"always"!==this.options.hideHover?(this.hover=new b.Hover({parent:this.el}),this.on("hovermove",this.onHoverMove),this.on("hoverout",this.onHoverOut),this.on("gridclick",this.onGridClick)):void 0},c.prototype.defaults={lineWidth:3,pointSize:4,lineColors:["#0b62a4","#7A92A3","#4da74d","#afd8f8","#edc240","#cb4b4b","#9440ed"],pointStrokeWidths:[1],pointStrokeColors:["#ffffff"],pointFillColors:[],smooth:!0,xLabels:"auto",xLabelFormat:null,xLabelMargin:24,hideHover:!1},c.prototype.calc=function(){return this.calcPoints(),this.generatePaths()},c.prototype.calcPoints=function(){var a,b,c,d,e,f;for(e=this.data,f=[],c=0,d=e.length;d>c;c++)a=e[c],a._x=this.transX(a.x),a._y=function(){var c,d,e,f;for(e=a.y,f=[],c=0,d=e.length;d>c;c++)b=e[c],null!=b?f.push(this.transY(b)):f.push(b);return f}.call(this),f.push(a._ymax=Math.min.apply(Math,[this.bottom].concat(function(){var c,d,e,f;for(e=a._y,f=[],c=0,d=e.length;d>c;c++)b=e[c],null!=b&&f.push(b);return f}())));return f},c.prototype.hitTest=function(a){var b,c,d,e,f;if(0===this.data.length)return null;for(f=this.data.slice(1),b=d=0,e=f.length;e>d&&(c=f[b],!(a<(c._x+this.data[b]._x)/2));b=++d);return b},c.prototype.onGridClick=function(a,b){var c;return c=this.hitTest(a),this.fire("click",c,this.data[c].src,a,b)},c.prototype.onHoverMove=function(a){var b;return b=this.hitTest(a),this.displayHoverForRow(b)},c.prototype.onHoverOut=function(){return this.options.hideHover!==!1?this.displayHoverForRow(null):void 0},c.prototype.displayHoverForRow=function(a){var b;return null!=a?((b=this.hover).update.apply(b,this.hoverContentForRow(a)),this.hilight(a)):(this.hover.hide(),this.hilight())},c.prototype.hoverContentForRow=function(a){var b,c,d,e,f,g,h;for(d=this.data[a],b="<div class='morris-hover-row-label'>"+d.label+"</div>",h=d.y,c=f=0,g=h.length;g>f;c=++f)e=h[c],b+="<div class='morris-hover-point' style='color: "+this.colorFor(d,c,"label")+"'>\n  "+this.options.labels[c]+":\n  "+this.yLabelFormat(e)+"\n</div>";return"function"==typeof this.options.hoverCallback&&(b=this.options.hoverCallback(a,this.options,b,d.src)),[b,d._x,d._ymax]},c.prototype.generatePaths=function(){var a,c,d,e;return this.paths=function(){var f,g,h,j;for(j=[],c=f=0,g=this.options.ykeys.length;g>=0?g>f:f>g;c=g>=0?++f:--f)e="boolean"==typeof this.options.smooth?this.options.smooth:(h=this.options.ykeys[c],i.call(this.options.smooth,h)>=0),a=function(){var a,b,e,f;for(e=this.data,f=[],a=0,b=e.length;b>a;a++)d=e[a],void 0!==d._y[c]&&f.push({x:d._x,y:d._y[c]});return f}.call(this),a.length>1?j.push(b.Line.createPath(a,e,this.bottom)):j.push(null);return j}.call(this)},c.prototype.draw=function(){var a;return((a=this.options.axes)===!0||"both"===a||"x"===a)&&this.drawXAxis(),this.drawSeries(),this.options.hideHover===!1?this.displayHoverForRow(this.data.length-1):void 0},c.prototype.drawXAxis=function(){var a,c,d,e,f,g,h,i,j,k,l=this;for(h=this.bottom+this.options.padding/2,f=null,e=null,a=function(a,b){var c,d,g,i,j;return c=l.drawXAxisLabel(l.transX(b),h,a),j=c.getBBox(),c.transform("r"+-l.options.xLabelAngle),d=c.getBBox(),c.transform("t0,"+d.height/2+"..."),0!==l.options.xLabelAngle&&(i=-.5*j.width*Math.cos(l.options.xLabelAngle*Math.PI/180),c.transform("t"+i+",0...")),d=c.getBBox(),(null==f||f>=d.x+d.width||null!=e&&e>=d.x)&&d.x>=0&&d.x+d.width<l.el.width()?(0!==l.options.xLabelAngle&&(g=1.25*l.options.gridTextSize/Math.sin(l.options.xLabelAngle*Math.PI/180),e=d.x-g),f=d.x-l.options.xLabelMargin):c.remove()},d=this.options.parseTime?1===this.data.length&&"auto"===this.options.xLabels?[[this.data[0].label,this.data[0].x]]:b.labelSeries(this.xmin,this.xmax,this.width,this.options.xLabels,this.options.xLabelFormat):function(){var a,b,c,d;for(c=this.data,d=[],a=0,b=c.length;b>a;a++)g=c[a],d.push([g.label,g.x]);return d}.call(this),d.reverse(),k=[],i=0,j=d.length;j>i;i++)c=d[i],k.push(a(c[0],c[1]));return k},c.prototype.drawSeries=function(){var a,b,c,d,e,f;for(this.seriesPoints=[],a=b=d=this.options.ykeys.length-1;0>=d?0>=b:b>=0;a=0>=d?++b:--b)this._drawLineFor(a);for(f=[],a=c=e=this.options.ykeys.length-1;0>=e?0>=c:c>=0;a=0>=e?++c:--c)f.push(this._drawPointFor(a));return f},c.prototype._drawPointFor=function(a){var b,c,d,e,f,g;for(this.seriesPoints[a]=[],f=this.data,g=[],d=0,e=f.length;e>d;d++)c=f[d],b=null,null!=c._y[a]&&(b=this.drawLinePoint(c._x,c._y[a],this.colorFor(c,a,"point"),a)),g.push(this.seriesPoints[a].push(b));return g},c.prototype._drawLineFor=function(a){var b;return b=this.paths[a],null!==b?this.drawLinePath(b,this.colorFor(null,a,"line"),a):void 0},c.createPath=function(a,c,d){var e,f,g,h,i,j,k,l,m,n,o,p,q,r;for(k="",c&&(g=b.Line.gradients(a)),l={y:null},h=q=0,r=a.length;r>q;h=++q)e=a[h],null!=e.y&&(null!=l.y?c?(f=g[h],j=g[h-1],i=(e.x-l.x)/4,m=l.x+i,o=Math.min(d,l.y+i*j),n=e.x-i,p=Math.min(d,e.y-i*f),k+="C"+m+","+o+","+n+","+p+","+e.x+","+e.y):k+="L"+e.x+","+e.y:c&&null==g[h]||(k+="M"+e.x+","+e.y)),l=e;return k},c.gradients=function(a){var b,c,d,e,f,g,h,i;for(c=function(a,b){return(a.y-b.y)/(a.x-b.x)},i=[],d=g=0,h=a.length;h>g;d=++g)b=a[d],null!=b.y?(e=a[d+1]||{y:null},f=a[d-1]||{y:null},null!=f.y&&null!=e.y?i.push(c(f,e)):null!=f.y?i.push(c(f,b)):null!=e.y?i.push(c(b,e)):i.push(null)):i.push(null);return i},c.prototype.hilight=function(a){var b,c,d,e,f;if(null!==this.prevHilight&&this.prevHilight!==a)for(b=c=0,e=this.seriesPoints.length-1;e>=0?e>=c:c>=e;b=e>=0?++c:--c)this.seriesPoints[b][this.prevHilight]&&this.seriesPoints[b][this.prevHilight].animate(this.pointShrinkSeries(b));if(null!==a&&this.prevHilight!==a)for(b=d=0,f=this.seriesPoints.length-1;f>=0?f>=d:d>=f;b=f>=0?++d:--d)this.seriesPoints[b][a]&&this.seriesPoints[b][a].animate(this.pointGrowSeries(b));return this.prevHilight=a},c.prototype.colorFor=function(a,b,c){return"function"==typeof this.options.lineColors?this.options.lineColors.call(this,a,b,c):"point"===c?this.options.pointFillColors[b%this.options.pointFillColors.length]||this.options.lineColors[b%this.options.lineColors.length]:this.options.lineColors[b%this.options.lineColors.length]},c.prototype.drawXAxisLabel=function(a,b,c){return this.raphael.text(a,b,c).attr("font-size",this.options.gridTextSize).attr("font-family",this.options.gridTextFamily).attr("font-weight",this.options.gridTextWeight).attr("fill",this.options.gridTextColor)},c.prototype.drawLinePath=function(a,b,c){return this.raphael.path(a).attr("stroke",b).attr("stroke-width",this.lineWidthForSeries(c))},c.prototype.drawLinePoint=function(a,b,c,d){return this.raphael.circle(a,b,this.pointSizeForSeries(d)).attr("fill",c).attr("stroke-width",this.pointStrokeWidthForSeries(d)).attr("stroke",this.pointStrokeColorForSeries(d))},c.prototype.pointStrokeWidthForSeries=function(a){return this.options.pointStrokeWidths[a%this.options.pointStrokeWidths.length]},c.prototype.pointStrokeColorForSeries=function(a){return this.options.pointStrokeColors[a%this.options.pointStrokeColors.length]},c.prototype.lineWidthForSeries=function(a){return this.options.lineWidth instanceof Array?this.options.lineWidth[a%this.options.lineWidth.length]:this.options.lineWidth},c.prototype.pointSizeForSeries=function(a){return this.options.pointSize instanceof Array?this.options.pointSize[a%this.options.pointSize.length]:this.options.pointSize},c.prototype.pointGrowSeries=function(a){return Raphael.animation({r:this.pointSizeForSeries(a)+3},25,"linear")},c.prototype.pointShrinkSeries=function(a){return Raphael.animation({r:this.pointSizeForSeries(a)},25,"linear")},c}(b.Grid),b.labelSeries=function(c,d,e,f,g){var h,i,j,k,l,m,n,o,p,q,r;if(j=200*(d-c)/e,i=new Date(c),n=b.LABEL_SPECS[f],void 0===n)for(r=b.AUTO_LABEL_ORDER,p=0,q=r.length;q>p;p++)if(k=r[p],m=b.LABEL_SPECS[k],j>=m.span){n=m;break}for(void 0===n&&(n=b.LABEL_SPECS.second),g&&(n=a.extend({},n,{fmt:g})),h=n.start(i),l=[];(o=h.getTime())<=d;)o>=c&&l.push([n.fmt(h),o]),n.incr(h);return l},c=function(a){return{span:60*a*1e3,start:function(a){return new Date(a.getFullYear(),a.getMonth(),a.getDate(),a.getHours())},fmt:function(a){return""+b.pad2(a.getHours())+":"+b.pad2(a.getMinutes())},incr:function(b){return b.setUTCMinutes(b.getUTCMinutes()+a)}}},d=function(a){return{span:1e3*a,start:function(a){return new Date(a.getFullYear(),a.getMonth(),a.getDate(),a.getHours(),a.getMinutes())},fmt:function(a){return""+b.pad2(a.getHours())+":"+b.pad2(a.getMinutes())+":"+b.pad2(a.getSeconds())},incr:function(b){return b.setUTCSeconds(b.getUTCSeconds()+a)}}},b.LABEL_SPECS={decade:{span:1728e8,start:function(a){return new Date(a.getFullYear()-a.getFullYear()%10,0,1)},fmt:function(a){return""+a.getFullYear()},incr:function(a){return a.setFullYear(a.getFullYear()+10)}},year:{span:1728e7,start:function(a){return new Date(a.getFullYear(),0,1)},fmt:function(a){return""+a.getFullYear()},incr:function(a){return a.setFullYear(a.getFullYear()+1)}},month:{span:24192e5,start:function(a){return new Date(a.getFullYear(),a.getMonth(),1)},fmt:function(a){return""+a.getFullYear()+"-"+b.pad2(a.getMonth()+1)},incr:function(a){return a.setMonth(a.getMonth()+1)}},week:{span:6048e5,start:function(a){return new Date(a.getFullYear(),a.getMonth(),a.getDate())},fmt:function(a){return""+a.getFullYear()+"-"+b.pad2(a.getMonth()+1)+"-"+b.pad2(a.getDate())},incr:function(a){return a.setDate(a.getDate()+7)}},day:{span:864e5,start:function(a){return new Date(a.getFullYear(),a.getMonth(),a.getDate())},fmt:function(a){return""+a.getFullYear()+"-"+b.pad2(a.getMonth()+1)+"-"+b.pad2(a.getDate())},incr:function(a){return a.setDate(a.getDate()+1)}},hour:c(60),"30min":c(30),"15min":c(15),"10min":c(10),"5min":c(5),minute:c(1),"30sec":d(30),"15sec":d(15),"10sec":d(10),"5sec":d(5),second:d(1)},b.AUTO_LABEL_ORDER=["decade","year","month","week","day","hour","30min","15min","10min","5min","minute","30sec","15sec","10sec","5sec","second"],b.Area=function(c){function d(c){var f;return this instanceof b.Area?(f=a.extend({},e,c),this.cumulative=!f.behaveLikeLine,"auto"===f.fillOpacity&&(f.fillOpacity=f.behaveLikeLine?.8:1),d.__super__.constructor.call(this,f),void 0):new b.Area(c)}var e;return h(d,c),e={fillOpacity:"auto",behaveLikeLine:!1},d.prototype.calcPoints=function(){var a,b,c,d,e,f,g;for(f=this.data,g=[],d=0,e=f.length;e>d;d++)a=f[d],a._x=this.transX(a.x),b=0,a._y=function(){var d,e,f,g;for(f=a.y,g=[],d=0,e=f.length;e>d;d++)c=f[d],this.options.behaveLikeLine?g.push(this.transY(c)):(b+=c||0,g.push(this.transY(b)));return g}.call(this),g.push(a._ymax=Math.max.apply(Math,a._y));return g},d.prototype.drawSeries=function(){var a,b,c,d,e,f,g,h;for(this.seriesPoints=[],b=this.options.behaveLikeLine?function(){f=[];for(var a=0,b=this.options.ykeys.length-1;b>=0?b>=a:a>=b;b>=0?a++:a--)f.push(a);return f}.apply(this):function(){g=[];for(var a=e=this.options.ykeys.length-1;0>=e?0>=a:a>=0;0>=e?a++:a--)g.push(a);return g}.apply(this),h=[],c=0,d=b.length;d>c;c++)a=b[c],this._drawFillFor(a),this._drawLineFor(a),h.push(this._drawPointFor(a));return h},d.prototype._drawFillFor=function(a){var b;return b=this.paths[a],null!==b?(b+="L"+this.transX(this.xmax)+","+this.bottom+"L"+this.transX(this.xmin)+","+this.bottom+"Z",this.drawFilledPath(b,this.fillForSeries(a))):void 0},d.prototype.fillForSeries=function(a){var b;return b=Raphael.rgb2hsl(this.colorFor(this.data[a],a,"line")),Raphael.hsl(b.h,this.options.behaveLikeLine?.9*b.s:.75*b.s,Math.min(.98,this.options.behaveLikeLine?1.2*b.l:1.25*b.l))},d.prototype.drawFilledPath=function(a,b){return this.raphael.path(a).attr("fill",b).attr("fill-opacity",this.options.fillOpacity).attr("stroke","none")},d}(b.Line),b.Bar=function(c){function d(c){return this.onHoverOut=f(this.onHoverOut,this),this.onHoverMove=f(this.onHoverMove,this),this.onGridClick=f(this.onGridClick,this),this instanceof b.Bar?(d.__super__.constructor.call(this,a.extend({},c,{parseTime:!1})),void 0):new b.Bar(c)}return h(d,c),d.prototype.init=function(){return this.cumulative=this.options.stacked,"always"!==this.options.hideHover?(this.hover=new b.Hover({parent:this.el}),this.on("hovermove",this.onHoverMove),this.on("hoverout",this.onHoverOut),this.on("gridclick",this.onGridClick)):void 0},d.prototype.defaults={barSizeRatio:.75,barGap:3,barColors:["#0b62a4","#7a92a3","#4da74d","#afd8f8","#edc240","#cb4b4b","#9440ed"],barOpacity:1,barRadius:[0,0,0,0],xLabelMargin:50},d.prototype.calc=function(){var a;return this.calcBars(),this.options.hideHover===!1?(a=this.hover).update.apply(a,this.hoverContentForRow(this.data.length-1)):void 0},d.prototype.calcBars=function(){var a,b,c,d,e,f,g;for(f=this.data,g=[],a=d=0,e=f.length;e>d;a=++d)b=f[a],b._x=this.left+this.width*(a+.5)/this.data.length,g.push(b._y=function(){var a,d,e,f;for(e=b.y,f=[],a=0,d=e.length;d>a;a++)c=e[a],null!=c?f.push(this.transY(c)):f.push(null);return f}.call(this));return g},d.prototype.draw=function(){var a;return((a=this.options.axes)===!0||"both"===a||"x"===a)&&this.drawXAxis(),this.drawSeries()},d.prototype.drawXAxis=function(){var a,b,c,d,e,f,g,h,i,j,k,l,m;for(j=this.bottom+(this.options.xAxisLabelTopPadding||this.options.padding/2),g=null,f=null,m=[],a=k=0,l=this.data.length;l>=0?l>k:k>l;a=l>=0?++k:--k)h=this.data[this.data.length-1-a],b=this.drawXAxisLabel(h._x,j,h.label),i=b.getBBox(),b.transform("r"+-this.options.xLabelAngle),c=b.getBBox(),b.transform("t0,"+c.height/2+"..."),0!==this.options.xLabelAngle&&(e=-.5*i.width*Math.cos(this.options.xLabelAngle*Math.PI/180),b.transform("t"+e+",0...")),(null==g||g>=c.x+c.width||null!=f&&f>=c.x)&&c.x>=0&&c.x+c.width<this.el.width()?(0!==this.options.xLabelAngle&&(d=1.25*this.options.gridTextSize/Math.sin(this.options.xLabelAngle*Math.PI/180),f=c.x-d),m.push(g=c.x-this.options.xLabelMargin)):m.push(b.remove());return m},d.prototype.drawSeries=function(){var a,b,c,d,e,f,g,h,i,j,k,l,m,n,o;return c=this.width/this.options.data.length,h=this.options.stacked?1:this.options.ykeys.length,a=(c*this.options.barSizeRatio-this.options.barGap*(h-1))/h,this.options.barSize&&(a=Math.min(a,this.options.barSize)),l=c-a*h-this.options.barGap*(h-1),g=l/2,o=this.ymin<=0&&this.ymax>=0?this.transY(0):null,this.bars=function(){var h,l,p,q;for(p=this.data,q=[],d=h=0,l=p.length;l>h;d=++h)i=p[d],e=0,q.push(function(){var h,l,p,q;for(p=i._y,q=[],j=h=0,l=p.length;l>h;j=++h)n=p[j],null!==n?(o?(m=Math.min(n,o),b=Math.max(n,o)):(m=n,b=this.bottom),f=this.left+d*c+g,this.options.stacked||(f+=j*(a+this.options.barGap)),k=b-m,this.options.verticalGridCondition&&this.options.verticalGridCondition(i.x)&&this.drawBar(this.left+d*c,this.top,c,Math.abs(this.top-this.bottom),this.options.verticalGridColor,this.options.verticalGridOpacity,this.options.barRadius),this.options.stacked&&(m-=e),this.drawBar(f,m,a,k,this.colorFor(i,j,"bar"),this.options.barOpacity,this.options.barRadius),q.push(e+=k)):q.push(null);return q}.call(this));return q}.call(this)},d.prototype.colorFor=function(a,b,c){var d,e;return"function"==typeof this.options.barColors?(d={x:a.x,y:a.y[b],label:a.label},e={index:b,key:this.options.ykeys[b],label:this.options.labels[b]},this.options.barColors.call(this,d,e,c)):this.options.barColors[b%this.options.barColors.length]},d.prototype.hitTest=function(a){return 0===this.data.length?null:(a=Math.max(Math.min(a,this.right),this.left),Math.min(this.data.length-1,Math.floor((a-this.left)/(this.width/this.data.length))))},d.prototype.onGridClick=function(a,b){var c;return c=this.hitTest(a),this.fire("click",c,this.data[c].src,a,b)},d.prototype.onHoverMove=function(a){var b,c;return b=this.hitTest(a),(c=this.hover).update.apply(c,this.hoverContentForRow(b))},d.prototype.onHoverOut=function(){return this.options.hideHover!==!1?this.hover.hide():void 0},d.prototype.hoverContentForRow=function(a){var b,c,d,e,f,g,h,i;for(d=this.data[a],b="<div class='morris-hover-row-label'>"+d.label+"</div>",i=d.y,c=g=0,h=i.length;h>g;c=++g)f=i[c],b+="<div class='morris-hover-point' style='color: "+this.colorFor(d,c,"label")+"'>\n  "+this.options.labels[c]+":\n  "+this.yLabelFormat(f)+"\n</div>";return"function"==typeof this.options.hoverCallback&&(b=this.options.hoverCallback(a,this.options,b,d.src)),e=this.left+(a+.5)*this.width/this.data.length,[b,e]},d.prototype.drawXAxisLabel=function(a,b,c){var d;return d=this.raphael.text(a,b,c).attr("font-size",this.options.gridTextSize).attr("font-family",this.options.gridTextFamily).attr("font-weight",this.options.gridTextWeight).attr("fill",this.options.gridTextColor)},d.prototype.drawBar=function(a,b,c,d,e,f,g){var h,i;return h=Math.max.apply(Math,g),i=0===h||h>d?this.raphael.rect(a,b,c,d):this.raphael.path(this.roundedRect(a,b,c,d,g)),i.attr("fill",e).attr("fill-opacity",f).attr("stroke","none")},d.prototype.roundedRect=function(a,b,c,d,e){return null==e&&(e=[0,0,0,0]),["M",a,e[0]+b,"Q",a,b,a+e[0],b,"L",a+c-e[1],b,"Q",a+c,b,a+c,b+e[1],"L",a+c,b+d-e[2],"Q",a+c,b+d,a+c-e[2],b+d,"L",a+e[3],b+d,"Q",a,b+d,a,b+d-e[3],"Z"]},d}(b.Grid),b.Donut=function(c){function d(c){this.resizeHandler=f(this.resizeHandler,this),this.select=f(this.select,this),this.click=f(this.click,this);var d=this;if(!(this instanceof b.Donut))return new b.Donut(c);if(this.options=a.extend({},this.defaults,c),this.el="string"==typeof c.element?a(document.getElementById(c.element)):a(c.element),null===this.el||0===this.el.length)throw new Error("Graph placeholder not found.");void 0!==c.data&&0!==c.data.length&&(this.raphael=new Raphael(this.el[0]),this.options.resize&&a(window).bind("resize",function(){return null!=d.timeoutId&&window.clearTimeout(d.timeoutId),d.timeoutId=window.setTimeout(d.resizeHandler,100)}),this.setData(c.data))}return h(d,c),d.prototype.defaults={colors:["#0B62A4","#3980B5","#679DC6","#95BBD7","#B0CCE1","#095791","#095085","#083E67","#052C48","#042135"],backgroundColor:"#FFFFFF",labelColor:"#000000",formatter:b.commas,resize:!1},d.prototype.redraw=function(){var a,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x;for(this.raphael.clear(),c=this.el.width()/2,d=this.el.height()/2,n=(Math.min(c,d)-10)/3,l=0,u=this.values,o=0,r=u.length;r>o;o++)m=u[o],l+=m;for(i=5/(2*n),a=1.9999*Math.PI-i*this.data.length,g=0,f=0,this.segments=[],v=this.values,e=p=0,s=v.length;s>p;e=++p)m=v[e],j=g+i+a*(m/l),k=new b.DonutSegment(c,d,2*n,n,g,j,this.data[e].color||this.options.colors[f%this.options.colors.length],this.options.backgroundColor,f,this.raphael),k.render(),this.segments.push(k),k.on("hover",this.select),k.on("click",this.click),g=j,f+=1;for(this.text1=this.drawEmptyDonutLabel(c,d-10,this.options.labelColor,15,800),this.text2=this.drawEmptyDonutLabel(c,d+10,this.options.labelColor,14),h=Math.max.apply(Math,this.values),f=0,w=this.values,x=[],q=0,t=w.length;t>q;q++){if(m=w[q],m===h){this.select(f);
break}x.push(f+=1)}return x},d.prototype.setData=function(a){var b;return this.data=a,this.values=function(){var a,c,d,e;for(d=this.data,e=[],a=0,c=d.length;c>a;a++)b=d[a],e.push(parseFloat(b.value));return e}.call(this),this.redraw()},d.prototype.click=function(a){return this.fire("click",a,this.data[a])},d.prototype.select=function(a){var b,c,d,e,f,g;for(g=this.segments,e=0,f=g.length;f>e;e++)c=g[e],c.deselect();return d=this.segments[a],d.select(),b=this.data[a],this.setLabels(b.label,this.options.formatter(b.value,b))},d.prototype.setLabels=function(a,b){var c,d,e,f,g,h,i,j;return c=2*(Math.min(this.el.width()/2,this.el.height()/2)-10)/3,f=1.8*c,e=c/2,d=c/3,this.text1.attr({text:a,transform:""}),g=this.text1.getBBox(),h=Math.min(f/g.width,e/g.height),this.text1.attr({transform:"S"+h+","+h+","+(g.x+g.width/2)+","+(g.y+g.height)}),this.text2.attr({text:b,transform:""}),i=this.text2.getBBox(),j=Math.min(f/i.width,d/i.height),this.text2.attr({transform:"S"+j+","+j+","+(i.x+i.width/2)+","+i.y})},d.prototype.drawEmptyDonutLabel=function(a,b,c,d,e){var f;return f=this.raphael.text(a,b,"").attr("font-size",d).attr("fill",c),null!=e&&f.attr("font-weight",e),f},d.prototype.resizeHandler=function(){return this.timeoutId=null,this.raphael.setSize(this.el.width(),this.el.height()),this.redraw()},d}(b.EventEmitter),b.DonutSegment=function(a){function b(a,b,c,d,e,g,h,i,j,k){this.cx=a,this.cy=b,this.inner=c,this.outer=d,this.color=h,this.backgroundColor=i,this.index=j,this.raphael=k,this.deselect=f(this.deselect,this),this.select=f(this.select,this),this.sin_p0=Math.sin(e),this.cos_p0=Math.cos(e),this.sin_p1=Math.sin(g),this.cos_p1=Math.cos(g),this.is_long=g-e>Math.PI?1:0,this.path=this.calcSegment(this.inner+3,this.inner+this.outer-5),this.selectedPath=this.calcSegment(this.inner+3,this.inner+this.outer),this.hilight=this.calcArc(this.inner)}return h(b,a),b.prototype.calcArcPoints=function(a){return[this.cx+a*this.sin_p0,this.cy+a*this.cos_p0,this.cx+a*this.sin_p1,this.cy+a*this.cos_p1]},b.prototype.calcSegment=function(a,b){var c,d,e,f,g,h,i,j,k,l;return k=this.calcArcPoints(a),c=k[0],e=k[1],d=k[2],f=k[3],l=this.calcArcPoints(b),g=l[0],i=l[1],h=l[2],j=l[3],"M"+c+","+e+("A"+a+","+a+",0,"+this.is_long+",0,"+d+","+f)+("L"+h+","+j)+("A"+b+","+b+",0,"+this.is_long+",1,"+g+","+i)+"Z"},b.prototype.calcArc=function(a){var b,c,d,e,f;return f=this.calcArcPoints(a),b=f[0],d=f[1],c=f[2],e=f[3],"M"+b+","+d+("A"+a+","+a+",0,"+this.is_long+",0,"+c+","+e)},b.prototype.render=function(){var a=this;return this.arc=this.drawDonutArc(this.hilight,this.color),this.seg=this.drawDonutSegment(this.path,this.color,this.backgroundColor,function(){return a.fire("hover",a.index)},function(){return a.fire("click",a.index)})},b.prototype.drawDonutArc=function(a,b){return this.raphael.path(a).attr({stroke:b,"stroke-width":2,opacity:0})},b.prototype.drawDonutSegment=function(a,b,c,d,e){return this.raphael.path(a).attr({fill:b,stroke:c,"stroke-width":3}).hover(d).click(e)},b.prototype.select=function(){return this.selected?void 0:(this.seg.animate({path:this.selectedPath},150,"<>"),this.arc.animate({opacity:1},150,"<>"),this.selected=!0)},b.prototype.deselect=function(){return this.selected?(this.seg.animate({path:this.path},150,"<>"),this.arc.animate({opacity:0},150,"<>"),this.selected=!1):void 0},b}(b.EventEmitter)}).call(this);;
$(function() {

    $('#side-menu').metisMenu();

});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function() {
    $(window).bind("load resize", function() {
        topOffset = 50;
        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse')
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse')
        }

        height = (this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    })
})
;
//Pager dynamic
var PagerAdminMaster = function (){
  //Attibuts

  //Methods
  this.start = function () {
    initListeners();
  }

  var initListeners = function () {

    //Add blocks
    $('body').on('click', '.block-template', function (e) {
      e.preventDefault();
      var me    = $(e.target);
          href  = me.attr('href');
      $.post(href, {}, function (data) {
        $('#page-template').append(data);
      });
    });

    //Remove line of blocks
    $('body').on('click', '.page-lineblock-remove-btn', function (e) {  
      var me = $(e.target);
      if (me.parent().hasClass('show-line')) {
        me.parent().removeClass('show-line');
      } else {
        me.parent().addClass('show-line');        
      }
    });
    $('body').on('click', '.page-lineblock-confirm-remove-btn', function (e) {
      $(e.target).closest('.page-block-remove').slideUp('slow', function (e) {
        $(this).remove();
      });
    });
    
    //Récupération de tous les formulaires de la pages /page/create
    $('body').on('click', '.btn-submit-page', function (e) {
      var forms = $('#section-content form');

      //Calculate order of blocks
      calculBlocksOrder();

      //check validation of selects
      $.post('/admin/page', {}, function (data) {
        //use the page_id
        if (data.page_id == 'error') {
          alert('error');
        }
        //console.log(forms);
        var formsOnly = [];
        $('#section-content form.page-block').each( function (e) {
          formsOnly.push($(this));
          console.log($(this).serialize());
        });
        
        for (var o in formsOnly) {
          postBlockForm(formsOnly[o], data.page_id);
        }
      });
    });

    var calculBlocksOrder = function () {
      var i = 1;
      $('#section-content form.page-block').each( function (e) {
        $(this).find('input[name=order]').val(i);
        i++;
      });
    }

    //Soumition d'un formulaire d'un block
    var postBlockForm = function (form, page_id) {
      $.post('/admin/page-block', form.serialize() + '&page_id=' + page_id, function (data) {
        console.log(data);
      });
      
    }
  }



};

var SpeedNavigationAdminMaster = function (){
  this.start = function () {
    //Ajax loading page of admin ui
    $('body').on('click','#side-menu a', function (e) {
      //Disable native comportment
      e.preventDefault();
      //Show loader (pure css)
      $('.loader').fadeIn('fast');
      //post to get content
      $.get($(this).attr('href'), function (data) {
        //reset dom
        document.getElementById('section-filemanager').style.height = "0px";
        document.getElementById('section-page-header').innerHTML = '';
        document.getElementById('section-content').innerHTML = '';

        for( var o in data ) {
          //Only load text content
          switch(o) {
            case 'meta_title':
              document.title = data[o];
              break;
            case 'page-header':
              document.getElementById('section-page-header').innerHTML = data[o];
              break;
            case 'content':
              document.getElementById('section-content').innerHTML = data[o];
              break;
            case 'filemanager':
              document.getElementById('section-filemanager').style.height = "100%";
              document.getElementById('section-filemanager').innerHTML = data[o];
              break;
          }
        }
        //after replace part in dom, fadeout loader and getback menu !
        $('.loader').fadeOut('fast', function () {
          for( var o in data ) {
            switch(o) {
              case 'script':
                eval(data[o]);
                break;
              case 'scriptOnReady':
                eval(data[o]);
                break;
            }
          }
          $('#wrapper').removeClass('st-menu-open');

        });
      });

    });
  }
};



var NavigationAdminMaster = function (){
  this.start = function () {
    //Navigation admin (nav-left)
    $('body').on('click','.btn-nav-left', function (e) {
      var wrapper = $('#wrapper');
      if (wrapper.hasClass('st-menu-open') ) {
        wrapper.removeClass('st-menu-open');
      } else {
        wrapper.addClass('st-menu-open');
      }
    });
    $('body').on('click','#wrapper.st-menu-open #page-wrapper', function (e) {
      var wrapper = $('#wrapper');
      if (wrapper.hasClass('st-menu-open') ) {
        wrapper.removeClass('st-menu-open');
      }
    });
  }

};


//Object MasterAdmin
var MasterAdmin = function (){
  this.start = function (){
    var pagerService = new PagerAdminMaster();
    pagerService.start();

    var navigationAdminService = new NavigationAdminMaster();
    navigationAdminService.start();

    var speedNavigationAdminService = new SpeedNavigationAdminMaster();
    //speedNavigationAdminService.start();

    initListeners();
  }
  
  var initListeners = function () {
    $('body').on('click', 'button.remove', function (e) {
      e.preventDefault();

      var form = $(e.target).closest('form');
      $('#modal-confirm-delete').modal();
      $('body').on('click', '#modal-confirm-delete .confirm', function (e){
        form.submit();
      });
    });
  };

  this.checboxButtonListener = function () {
    //checkbox button states
    $('body').on('click', '.checkbox.checkbox-button .enable', function () 
    {
      if ($(this).hasClass('disabled')) {
        $(this).removeClass('disabled');  
      } else {
        $(this).addClass('disabled');
      }
    });
    
    $('body').on('click', '.checkbox.checkbox-button .disable', function () 
    {
      if ($(this).hasClass('enabled')) {
        $(this).removeClass('enabled');  
      } else {
        $(this).addClass('enabled');
      }
    });
  }

  this.switchCheckboxInitializr = function () {
    // JS is only used to add the <div>s
    var switches = document.querySelectorAll('input[type="checkbox"].ios-switch');

    for (var i=0, sw; sw = switches[i++]; ) {
      var div = document.createElement('div');
      div.className = 'switch';
      sw.parentNode.insertBefore(div, sw.nextSibling);
    }
  }

  this.switchRadioInitializr = function () {
    // JS is only used to add the <div>s
    var switches = document.querySelectorAll('input[type="radio"].ios-switch');

    for (var i=0, sw; sw = switches[i++]; ) {
      var div = document.createElement('div');
      div.className = 'switch';
      sw.parentNode.insertBefore(div, sw.nextSibling);
    }
  }

  this.watchMenuObjects = function () {
    var width = 0,
        o = 0,
        margin = 4;
    //console.log($('#navigation').children('.menu-objects'));
    $('#navigation .menu-objects').each( function (index) {
      width=width + $(this).width() + margin;
    });

      //width = width + $('#navigation').children('.menu-objects')[o].width();
      console.log(width + 1);
    

    $('#navigation').width(width + 1);
  }
}
var masterAdminClass = new MasterAdmin();








//Pager dynamic
/*var PagerAdminMaster = function (){
  //Attibuts
  var draw = false,
      area = null,
      pc_col_1_width = 8.3333,
      count_col = 12,
      offsetXBootstrap = 0,
      cssOffsetXBootstrap = 0,
      btnBlockTypeCreate = $('.block-presenter-call-to-create').html(),
      indexBlock = 1,
      locale_id_class = '.block-locale-id-';
  
  this.start = function (e) {
    area = $('.page-block-drawing-area');
    area.on("mousemove mousedown mouseup", draw_block );

    //!!!TODO!!!//
    //ici on va mettre les meme écouteurs que pour la création d'un block
    //sauf qu'on prend que l'axe X
    //Et on va transvaser (à gauche) dans le offsetboostrap et moins la taille, et à droite on ajoute ou réduit
    //area.on("mousemove mousedown mouseup", draw_block );
    
    //Resfull DELETE
    $('body').on('click', '.drawn-block-show .remove', function (e) {
      var className = locale_id_class + $(this).parent('.drawn-block').data('index');
      $(className).remove();
    });

    $('body').on('click', '.action-in-block a', function (e) {
      //les 'block' contienent un index dans $.data('index')
      e.preventDefault();

      var me = $(this),
          href = me.attr('href'),
          block = me.closest('.action-in-block');

      block.parent().addClass('drawn-block-type-chosen');
      href += '?index='+block.parent().data('index')+'&current_locale='+$('.tab-pane.active').attr('data-locale-id');
      $.get(href, function (data) {
        putContent(locale_id_class, block, data, makeJs);
      });
    });

    //for dom
    var putContent = function (locale_id_class, block, data, callback) {
      $(locale_id_class + block.parent().data("index")).html(data.form);
      callback(data);
    }
    //for js
    var makeJs = function (data) {
      for( var o in data ) {
        switch(o) {
          case 'script':
            console.log(data[o]);
            eval(data[o]);
            break;
        }
      }
    }
  }

  var draw_block = function (e) {
    //console.log(e);
    var offsetX = e.offsetX,
        offsetY = e.offsetY,
        block = area.find('.drawn-block.current'),
        block_data = block.data();
    
    if ( e.type === 'mousemove' ) { 
      // If ".drawnBox.current" doesn't exist, create it.
      if ( block.length < 1 ) {
        $('<div class="drawn-block current block-locale-id-' + indexBlock + '"></div><div class="clearfix"></div>')
          .data("index",indexBlock)
          .appendTo( area );
        indexBlock++;
      }
      
      var drawCSS = {};
      // If drawing is initiated.
      if ( draw ) {
          // Determine the direction.
          // xLeft
          if ( block_data.offsetX > offsetX ) {
              drawCSS['right'] = area.width() - block_data.offsetX,
              drawCSS['left'] = 'auto',
              drawCSS['width'] = block_data.offsetX - offsetX;
          }
          // xRight
          else if ( block_data.offsetX < offsetX ) {
              drawCSS['left'] = block_data.offsetX,
              drawCSS['right'] = 'auto',
              drawCSS['width'] = offsetX - block_data.offsetX;
          }
          // yUp
          if ( block_data.offsetY > offsetY ) {
              drawCSS['bottom'] = area.height() - block_data.offsetY,
              drawCSS['top'] = 'auto',
              drawCSS['height'] = block_data.offsetY - offsetY;
          }
          // yDown
          else if ( block_data.offsetY < offsetY ) {
              drawCSS['top'] = block_data.offsetY,
              drawCSS['bottom'] = 'auto',
              drawCSS['height'] = offsetY - block_data.offsetY;
          }
      }

      if ( !draw && block.length > 0 ) {
          block.css({
              top: offsetY,
              left: offsetX
          });
      }
      
      if ( draw ) {
          block.css( drawCSS );
      }
    }

    if ( e.type === 'mousedown' ) {
        e.preventDefault();
        draw = true;
        block.css('display','block');
        block.data({ "offsetX": offsetX, "offsetY": offsetY }); 
        //
        //with or without offsetbootstrap
        offsetXBootstrap = offsetBootstrap(block, offsetX);
        cssOffsetXBootstrap = offsetXBootstrap;
        
        if (block.prev().length != 0) {
          if (e.clientY < block.prev().offset().top+100) {
            cssOffsetXBootstrap = 0;
            console.log('created under line');
          }
        }
        
    } else if ( e.type === 'mouseup' ) {
      console.log('--------------');
      console.log(offsetBootstrap(block, offsetX));
      console.log(offsetXBootstrap);
        var block_width = offsetBootstrap(block, offsetX) - offsetXBootstrap;
        draw = false;
        if (block_width >= 0) {
          area.find('.clearfix').remove();     
          block.prev().removeClass('last');
          block
              .addClass('drawn-block-show last col-sm-'+(block_width)+(offsetXBootstrap != 0?' col-sm-offset-'+cssOffsetXBootstrap:''))
              .removeClass('current')
              .removeAttr('style');

          block.removeData('offsetX offsetY');
          block.data({ 
            "responsive_width":block_width,
            "responsive_trigger":"sm",
            "responsive_offset":(offsetXBootstrap != 0?cssOffsetXBootstrap:null)
          });


          block.append(btnBlockTypeCreate);
          block.prepend('<div class="remove"><span class="glyphicon glyphicon-remove"></span></div>');
        }

        if (block_width == 0) {
          block.remove();
        }
    }
  }

  var magnet = function (block, offsetX) {
    var area_width = area.width();
        pc_offsetX = offsetX*100/area_width,
        ratio_count_col = count_col*pc_offsetX/100,
        floor_ratio_count_col = Math.floor(ratio_count_col);

    //si on a 6.4/12 on doit aller vvers 6 si on a 6.6 vers 7...
    if (ratio_count_col-floor_ratio_count_col < 0.5) {
      return pc_offsetX = floor_ratio_count_col*pc_col_1_width;
    }
    return pc_offsetX = (floor_ratio_count_col+1)*pc_col_1_width;
  }

  var offsetBootstrap = function (block, offsetX) {
    var area_width = area.width();
        pc_offsetX = offsetX*100/area_width,
        ratio_count_col = count_col*pc_offsetX/100,
        floor_ratio_count_col = Math.floor(ratio_count_col);

    //si on a 6.4/12 on doit aller vvers 6 si on a 6.6 vers 7...
    if (ratio_count_col-floor_ratio_count_col < 0.5) {
      return floor_ratio_count_col;
    }
    return floor_ratio_count_col+1;
  }
};*/
;
/**
 * 
 * Javascript to display on admin pages
 *
 */;
/**
 * 
 * Javascript to display on admin pages
 *
 */
 
//listen click on add btn
$('body').on('click', '.lauch-modal-gallery-video', function (e) {
	var where = $(e.target).closest('form').find('input[name=where]').val();
	$('#modal-gallery-video').data('target', where).modal();
});

$('body').on('click', '#modal-gallery-video button.submit', function (e) {
 	var code = $('#modal-gallery-video #code_video_modal').val();
 	$('#form-cdp-video-' + $('#modal-gallery-video').data('target')).find('input[name=code_video]').val(code);
 	$('#form-cdp-video-' + $('#modal-gallery-video').data('target')).submit();
});