<<<<<<< HEAD
/*
 * Galleria Classic Theme v. 1.5 2010-10-28
 * http://galleria.aino.se
 *
 * Copyright (c) 2010, Aino
 * Licensed under the MIT license.
 */
=======
/**
 * @preserve Galleria Classic Theme 2011-02-14
 * http://galleria.aino.se
 *
 * Copyright (c) 2011, Aino
 * Licensed under the MIT license.
 */
 
/*global jQuery, Galleria */
>>>>>>> 35c5c655cc18e3740580345c3e138092eb06e20d

(function($) {

Galleria.addTheme({
    name: 'classic',
    author: 'Galleria',
<<<<<<< HEAD
    version: '1.5',
    css: 'galleria.classic.css',
    defaults: {
        transition: 'slide',
        thumb_crop: 'height',
        
		// set this to false if you want to show the caption all the time:
        _toggle_info: true
=======
    css: 'galleria.classic.css',
    defaults: {
        transition: 'slide',
        thumbCrop:  'height',
        
		// set this to false if you want to show the caption all the time:
        _toggleInfo: true
>>>>>>> 35c5c655cc18e3740580345c3e138092eb06e20d
    },
    init: function(options) {
        
        // add some elements
        this.addElement('info-link','info-close');
        this.append({
            'info' : ['info-link','info-close']
        });
        
        // cache some stuff
<<<<<<< HEAD
        var toggle   = this.$('image-nav-left,image-nav-right,counter'),
            info     = this.$('info-link,info-close,info-text'),
            click    = Galleria.TOUCH ? 'touchstart' : 'click';
        
        // show loader & counter with opacity
        this.$('loader,counter').show().css('opacity',.4)

        // some stuff for non-touch browsers
        if (! Galleria.TOUCH ) {
            
            // fade thumbnails
            this.$('thumbnails').children().hover(function() {
                $(this).not('.active').children().stop().fadeTo(100, 1);
            }, function() {
                $(this).not('.active').children().stop().fadeTo(400, .6);
            });
            
=======
        var info = this.$('info-link,info-close,info-text'),
            touch = Galleria.TOUCH,
            click = touch ? 'touchstart' : 'click';
        
        // show loader & counter with opacity
        this.$('loader,counter').show().css('opacity', 0.4);

        // some stuff for non-touch browsers
        if (! touch ) {
>>>>>>> 35c5c655cc18e3740580345c3e138092eb06e20d
            this.addIdleState( this.get('image-nav-left'), { left:-50 });
            this.addIdleState( this.get('image-nav-right'), { right:-50 });
            this.addIdleState( this.get('counter'), { opacity:0 });
        }
        
        // toggle info
<<<<<<< HEAD
        if ( options._toggle_info ) {
            info.bind( click, function() {
                info.toggle();
            });
        }
        
        // bind some stuff
        this.bind(Galleria.THUMBNAIL, function(e) {
            $(e.thumbTarget).parent(':not(.active)').children().css('opacity',.6)
        });
        
        this.bind(Galleria.LOADSTART, function(e) {
            if (!e.cached) {
                this.$('loader').show().fadeTo(200, .4);
=======
        if ( options._toggleInfo === true ) {
            info.bind( click, function() {
                info.toggle();
            });
        } else {
			info.show();
			this.$('info-link, info-close').hide();
		}
        
        // bind some stuff
        this.bind('thumbnail', function(e) {
            
            if (! touch ) {
                // fade thumbnails
                $(e.thumbTarget).css('opacity', 0.6).parent().hover(function() {
                    $(this).not('.active').children().stop().fadeTo(100, 1);
                }, function() {
                    $(this).not('.active').children().stop().fadeTo(400, 0.6);
                });
                
                if ( e.index === options.show ) {
                    $(e.thumbTarget).css('opacity',1);
                }
            }
        });
        
        this.bind('loadstart', function(e) {
            if (!e.cached) {
                this.$('loader').show().fadeTo(200, 0.4);
>>>>>>> 35c5c655cc18e3740580345c3e138092eb06e20d
            }
            
            this.$('info').toggle( this.hasInfo() );
            
<<<<<<< HEAD
            $(e.thumbTarget).css('opacity',1).parent().siblings().children().css('opacity',.6);
        });
        
        this.bind(Galleria.LOADFINISH, function(e) {
=======
            $(e.thumbTarget).css('opacity',1).parent().siblings().children().css('opacity', 0.6);
        });
        
        this.bind('loadfinish', function(e) {
>>>>>>> 35c5c655cc18e3740580345c3e138092eb06e20d
            this.$('loader').fadeOut(200);
        });
    }
});

<<<<<<< HEAD
})(jQuery);
=======
}(jQuery));
>>>>>>> 35c5c655cc18e3740580345c3e138092eb06e20d
