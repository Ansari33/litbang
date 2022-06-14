(function (root, factory) {
	var plugin = 'infiniteTabs';

	if (typeof define === 'function' && define.amd) {
		define([], factory(plugin));
	} else if (typeof exports === 'object') {
		module.exports = factory(plugin);
	} else {
		root[plugin] = factory(plugin);
	}
}(this, function tabs_unlimited(plugin) {
	'use strict';

	var defaults = {

	};

	/**
	 * Merge defaults with user options
	 * @param {Object} source Default settings
	 * @param {Object} options User options
	 */
	var extend = function (source, options) {
		for ( var key in options ) {
			if ( typeof options[key] === 'object') {
				for ( var i in options[key] ) {
					source[key][i] = options[key][i];
				}
			} else {
				if (Object.prototype.hasOwnProperty.call(options, key)) {
					source[key] = options[key];
				}
			}
		}
		return source;
	};

	/**
	 * Create element helper. Create an element and assign given attributes.
	 * @param  {NodeType} type 	Type of element to create.
	 * @param  {Object} attrs 	The attributes to assign to the element.
	 * @return {HTMLElement}
	 */
	var createElement = function(type, attrs) {
		var attr, elem = document.createElement(type);
		if ( attrs && typeof attrs == 'object' ) {
			for (attr in attrs) {
				if ( attr in elem ) {
					if ( attr == 'innerHTML' ) {
						elem.innerHTML = attrs[attr];
					} else {
						elem[attr] = attrs[attr];
					}
				} else {
					elem.setAttribute(attr, attrs[attr]);
				}
			}
		}
		return elem;
	};

	/**
	 * Get the max width of an element.
	 * @param  {Node} elem The element to get the height of
	 * @return {Number}    The element's height in pixels
	 */
	var getMaxWidth = function ( elem ) {
		return Math.max( elem.scrollWidth, elem.offsetWidth, elem.clientWidth );
	};


	/**
	 * Check var is an integer
	 * @param  {mixed} value
	 * @return {Boolean}
	 */
	var isInt = function( value ) {
		var x;
		if (isNaN(value)) return false;
		x = parseFloat(value);
		return (x | 0) === x;
	}

	var vendorPrefix = function () {
		var ua = navigator.userAgent.toLowerCase(),
			match = /opera/.exec(ua) || /msie/.exec(ua) || /firefox/.exec(ua) || /(chrome|safari)/.exec(ua) || /trident/.exec(ua),
			vendors = {
				opera: '-o-',
				chrome: '-webkit-',
				safari: '-webkit-',
				firefox: '-moz-',
				trident: '-ms-',
				msie: '-ms-',
			};

		return vendors[match[0]];
	};

	/**
	 * Plugin Object
	 * @param element The html element to initialize
	 * @param {Object} options User options
	 * @constructor
	 */
	function Plugin(element, options) {
		this.tabs = element;

		var defaults = {
			prevText: '<i class="flaticon2-left-arrow text-primary"></i>',
			nextText: '<i class="flaticon2-right-arrow text-primary"></i>',
			scrollAmount: null,
			scrollDuration: 500,
			draggable: true
		}

		this.vendorPrefix = vendorPrefix();
		this.options = extend(defaults, options);
		this.resizeTimeout 	= null;
		this.direction = null;
		this.dragging = false;

		this.initialize();
	}


	// Plugin prototype
	Plugin.prototype = {

		initialize: function()
		{
			this.parentElement = this.tabs.parentElement;

			var docFrag = document.createDocumentFragment(),
				wrapper = createElement('div', { class: 'infinteTabs' });

			this.prevButton = createElement('button', { type: 'button', class: 'infinteTabs-nav prev', innerHTML: this.options.prevText }),
				this.nextButton = createElement('button', { type: 'button', class: 'infinteTabs-nav next active', innerHTML:  this.options.nextText }),

				docFrag.appendChild(wrapper);

			wrapper.appendChild(this.prevButton);
			wrapper.appendChild(this.nextButton);

			this.parentElement.insertBefore(docFrag, this.tabs);
			wrapper.appendChild(this.tabs);

			this.wrapper = wrapper;


			this.setDimensions();

			this.initEventListeners();
		},

		setDimensions: function()
		{
			this.parentElement = this.wrapper.parentElement;

			this.boundingRect = this.parentElement.getBoundingClientRect();

			this.translateX = 0;
			this.transX = 0;
			this.parentWidth = this.boundingRect.width;
			this.tabsWidth = getMaxWidth(this.tabs);
			this.overflowAmount = this.tabsWidth - this.parentWidth;

			this.setStyle(this.wrapper, {
				width: this.parentWidth + 'px'
			});

			if ( isInt(this.options.scrollAmount) ) {
				this.scrollAmount = this.options.scrollAmount;
			} else {
				this.scrollAmount = this.overflowAmount;
			}

			this.setStyle(this.tabs, {
				transform: 'translate3d(-'+this.translateX+'px, 0,0)'
			});

			this.setButtonState();
		},

		initEventListeners: function()
		{
			var that = this;

			window.addEventListener('resize', that.resize.bind(that), false);

			if ( this.options.draggable ) {
				this.wrapper.addEventListener('mousedown', function(event) {
					that.drag(event);
				}, false);

				document.addEventListener('mouseup', function(event) {
					that.dragging = false;

					that.translateX += (event.clientX - that.originX);

					if ( that.translateX >= 0 ) {
						that.translateX = 0;
					} else if ( that.translateX <= -that.overflowAmount ) {
						that.translateX = -that.overflowAmount;
					}

					that.setButtonState();
				}, false);
			}

			that.prevButton.addEventListener('click', function(event) {

				if ( that.translateX >= 0 ) {
					return
				}

				that.direction = 'prev';

				that.animFrame = requestAnimationFrame(function(timestamp){
					that.starttime = timestamp || new Date().getTime();
					that.slide(timestamp);
				});

			}, false);

			that.nextButton.addEventListener('click', function(event) {

				if ( that.translateX <= -that.overflowAmount ) {
					return
				}

				that.direction = 'next';

				that.animFrame = requestAnimationFrame(function(timestamp){
					that.starttime = timestamp || new Date().getTime();
					that.slide(timestamp);
				});
			}, false);
		},

		drag: function(event)
		{
			var that = this;

			that.dragging = true;
			that.originX = event.clientX;

			event.preventDefault();

			document.onmousemove = function(e) {

				if ( !that.dragging ) return;

				var clientX = e.clientX, transX = that.translateX + (clientX - that.originX);

				if ( transX >= 0 ) {
					transX = 0;
				} else if ( transX <= -that.overflowAmount ) {
					transX = -that.overflowAmount;
				}

				that.setStyle(that.tabs, {
					transform: 'translate3d('+transX+'px, 0, 0)'
				});
			}
		},

		resize: function(event)
		{
			var that = this;

			clearTimeout(this.resizeTimeout);

			this.resizeTimeout = setTimeout(function() {
				that.setDimensions();
			}, 100);
		},

		slide: function(timestamp)
		{
			var that = this, timestamp = timestamp || new Date().getTime(),
				runtime = timestamp - that.starttime,
				progress = runtime / that.options.scrollDuration;

			progress = Math.min(progress, 1);

			var transX = (this.direction == 'next') ? (this.translateX - (this.scrollAmount * progress)) : (this.translateX + (this.scrollAmount * progress));

			if ( that.direction == 'next' && transX <= -that.overflowAmount ) {
				transX = -that.overflowAmount;
			}

			if ( that.direction == 'prev' && transX >= 0 ) {
				transX = 0;
			}

			that.setStyle(that.tabs, {
				transform: 'translate3d('+transX+'px, 0, 0)'
			});

			if ( runtime < that.options.scrollDuration ) {
				that.animFrame = requestAnimationFrame(function(timestamp) {
					that.slide(timestamp);
				});
			} else {
				switch ( that.direction ) {
					case 'next':
						that.translateX -= that.scrollAmount;
						break;
					case 'prev':
						that.translateX += that.scrollAmount;
						break;
				}

				that.setButtonState();
			}
		},

		setButtonState: function(transX)
		{
			transX = transX || this.translateX;
			if ( transX < 0 ) {
				this.prevButton.classList.add('active');
			} else {
				this.prevButton.classList.remove('active');
			}

			if ( transX > -this.overflowAmount ) {
				this.nextButton.classList.add('active');
			} else if ( transX <= -this.overflowAmount ) {
				this.nextButton.classList.remove('active');
			}
		},

		setStyle: function(element, properties)
		{
			var property, css = '';

			for (property in properties) {
				css += property + ': ' + properties[property] + ';';
				css += this.vendorPrefix + property + ': ' + properties[property] + ';';
			}

			element.style.cssText += css;
		}

	};

	return Plugin;
}));

var navtabs = document.getElementsByClassName('tabs-unlimited')[0];

var a = new infiniteTabs(navtabs, {
	scrollAmount: 100,
	scrollDuration: 250,
	draggable: true
});
