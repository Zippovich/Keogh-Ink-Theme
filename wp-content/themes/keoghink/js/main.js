// background resize init
function initBackgroundResize() {
	var holder = document.getElementById('bg');
	if(holder) {
		var images = holder.getElementsByTagName('img');
		for(var i = 0; i < images.length; i++) {
			BackgroundStretcher.stretchImage(images[i]);
		}
		BackgroundStretcher.setBgHolder(holder);
	}
}

if (window.addEventListener) window.addEventListener("load", initBackgroundResize, false);
else if (window.attachEvent) window.attachEvent("onload", initBackgroundResize);

// image stretch module
BackgroundStretcher = {
	images: [],
	holders: [],
	viewWidth: 0,
	viewHeight: 0,
	ieFastMode: true,
	stretchBy: 'window', // "window", "page", "block-id", or block
	init: function(){
		this.addHandlers();
		this.resizeAll();
		return this;
	},
	stretchImage: function(origImg) {
		// wrap image and apply smoothing
		var obj = this.prepareImage(origImg);
		
		// handle onload
		var img = new Image();
		img.onload = this.bind(function(){
			obj.iRatio = img.width / img.height;
			this.resizeImage(obj);
		});
		img.src = origImg.src;
		this.images.push(obj);
	},
	prepareImage: function(img) {
		var wrapper = document.createElement('span');
		img.parentNode.insertBefore(wrapper, img);
		wrapper.appendChild(img);
	
		if(/MSIE (6|7|8)/.test(navigator.userAgent) && img.tagName.toLowerCase() === 'img') {
			wrapper.style.position = 'absolute';
			wrapper.style.display = 'block';
			wrapper.style.zoom = 1;
			if(this.ieFastMode) {
				img.style.display = 'none';
				wrapper.style.filter = 'progid:DXImageTransform.Microsoft.AlphaImageLoader(src="'+img.src+'", sizingMethod="scale")'; // enable smoothing in IE6
				return wrapper;
			} else {
				img.style.msInterpolationMode = 'bicubic'; // IE7 smooth fix
				return img;
			}
		} else {
			return img;
		}
	},
	setBgHolder: function(obj) {
		this.holders.push(obj);
		this.resizeAll();
	},
	resizeImage: function(obj) {
		if(obj.iRatio) {
			// calculate dimensions
			var dimensions = this.getProportion({
				ratio: obj.iRatio,
				maskWidth: this.viewWidth,
				maskHeight: this.viewHeight
			});
			// apply new styles
			obj.style.width = dimensions.width + 'px';
			obj.style.height = dimensions.height + 'px';
			obj.style.top = dimensions.top + 'px';
			obj.style.left = dimensions.left +'px';
		}
	},
	resizeHolder: function(obj) {
		obj.style.width = this.viewWidth+'px';
		obj.style.height = this.viewHeight+'px';
	},
	getProportion: function(data) {
		// calculate element coords to fit in mask
		var ratio = data.ratio || (data.elementWidth / data.elementHeight);
		var slideWidth = data.maskWidth, slideHeight = slideWidth / ratio;
		if(slideHeight < data.maskHeight) {
			slideHeight = data.maskHeight;
			slideWidth = slideHeight * ratio;
		}
		return {
			width: slideWidth,
			height: slideHeight,
			top: (data.maskHeight - slideHeight) / 2,
			left: (data.maskWidth - slideWidth) / 2
		}
	},
	resizeAll: function() {
		// crop holder width by window size
		for(var i = 0; i < this.holders.length; i++) {
			this.holders[i].style.width = '100%'; 
		}
		
		// delay required for IE to handle resize
		clearTimeout(this.resizeTimer);
		this.resizeTimer = setTimeout(this.bind(function(){
			// hide background holders
			for(var i = 0; i < this.holders.length; i++) {
				this.holders[i].style.display = 'none';
			}
			
			// calculate real page dimensions with hidden background blocks
			if(typeof this.stretchBy === 'string') {
				// resize by window or page dimensions
				if(this.stretchBy === 'window' || this.stretchBy === 'page') {
					this.viewWidth = this.stretchFunctions[this.stretchBy].width();
					this.viewHeight = this.stretchFunctions[this.stretchBy].height();
				}
				// resize by element dimensions (by id)
				else {
					var maskObject = document.getElementById(this.stretchBy);
					this.viewWidth = maskObject ? maskObject.offsetWidth : 0;
					this.viewHeight = maskObject ? maskObject.offsetHeight : 0;
				}
			} else {
				this.viewWidth = this.stretchBy.offsetWidth;
				this.viewHeight = this.stretchBy.offsetHeight;
			}
			
			// show and resize all background holders
			for(i = 0; i < this.holders.length; i++) {
				this.holders[i].style.display = 'block';
				this.resizeHolder(this.holders[i]);
			}
			for(i = 0; i < this.images.length; i++) {
				this.resizeImage(this.images[i]);
			}
		}),10);
	},
	addHandlers: function() {
		if (window.addEventListener) {
			window.addEventListener('resize', this.bind(this.resizeAll), false);
			window.addEventListener('orientationchange', this.bind(this.resizeAll), false);
		} else if (window.attachEvent) {
			window.attachEvent('onresize', this.bind(this.resizeAll));
		}
	},
	stretchFunctions: {
		window: {
			width: function() {
				return typeof window.innerWidth === 'number' ? window.innerWidth : document.documentElement.clientWidth;
			},
			height: function() {
				return typeof window.innerHeight === 'number' ? window.innerHeight : document.documentElement.clientHeight;
			}
		},
		page: {
			width: function() {
				return !document.body ? 0 : Math.max(
					Math.max(document.body.clientWidth, document.documentElement.clientWidth),
					Math.max(document.body.offsetWidth, document.body.scrollWidth)
				);
			},
			height: function() {
				return !document.body ? 0 : Math.max(
					Math.max(document.body.clientHeight, document.documentElement.clientHeight),
					Math.max(document.body.offsetHeight, document.body.scrollHeight)
				);
			}
		}
	},
	bind: function(fn, scope, args) {
		var newScope = scope || this;
		return function() {
			return fn.apply(newScope, args || arguments);
		}
	}
}.init();

$(function() {
    // Gallery
    var thumbs = $('.ngg-thumbs a');
    var lis = $('.gallery-images-table li');
    $(lis[0]).addClass('curent');
    thumbs.each(function(index, item) {
        $(item).click(function(e) {
            e.preventDefault();
            if (!$(lis[index]).hasClass('curent')) {
                var rand = Math.floor((Math.random()*4)+1);
                switch (rand) {
                    case 2:
                        $(lis[index]).css({
                            'left': 0,
                            'top': -440
                        });
                        break;
                    case 3:
                        $(lis[index]).css({
                            'left': 550,
                            'top': 0
                        });
                        break;
                    case 4:
                        $(lis[index]).css({
                            'left': 0,
                            'top': 440
                        });
                        break;
                    default:
                        $(lis[index]).css({
                            'left': -550,
                            'top': 0
                        });
                }
                $('.gallery-images-table li.curent').css('z-index', 1).stop().fadeOut(300, function() {
                    $(this).css({
                        'left': -500,
                        'top': 0
                    }).fadeIn(0);
                });
                $(lis[index]).css('z-index', 2);
                $(lis[index]).stop().animate({
                    'top': 0,
                    'left': 0
                }, 300, function() {
                    $('.gallery-images-table li.curent').removeClass('curent');
                    $(this).addClass('curent');
                });
            }
        });
    });
});