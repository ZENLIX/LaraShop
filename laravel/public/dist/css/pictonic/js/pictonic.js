
/*
 * domready
 * https://github.com/alanclarke/domready.js
 * logic stripped from https://github.com/jquery/
 * Copyright (c) 2012 Alan Clarke
 * Licensed under the GPL license.
 */

function domready(callback){
		var self = this;
		self.readyWait = 1;

		// The ready event handler and self cleanup method
		self.DOMContentLoaded = function() {
			if ( document.addEventListener ) {
				document.removeEventListener( "DOMContentLoaded", self.DOMContentLoaded, false );
				self.ready();
			} else if ( document.readyState === "complete" ) {
			// we're here because readyState === "complete" in oldIE
			// which is good enough for us to call the dom ready!
				document.detachEvent( "onreadystatechange", self.DOMContentLoaded );
				self.ready();
			}
		};

		// Handle when the DOM is ready
		self.ready = function(wait){
			
			// Abort if there are pending holds or we're already ready
			if ( wait === true ? --self.readyWait : self.isReady ) { return; }
			
			// Make sure body exists, at least, in case IE gets a little overzealous (ticket #5443).
			if ( !document.body ) {
				return setTimeout( self.ready, 1 );
			}

			// Remember that the DOM is ready
			self.isReady = true;

			// If a normal DOM Ready event fired, decrement, and wait if need be
			if ( wait !== true && --self.readyWait > 0 ) {
				return;
			}
			// trigger callback
			return !callback||callback();
		};



		// Catch cases where $(document).ready() is called after the browser event has already occurred.
		// we once tried to use readyState "interactive" here, but it caused issues like the one
		// discovered by ChrisS here: http://bugs.jquery.com/ticket/12282#comment:15
		if ( document.readyState === "complete" ) {
			setTimeout( self.ready, 1 );
		
		// Standards-based browsers support DOMContentLoaded
		} else if ( document.addEventListener ) {

			// Use the handy event callback
			document.addEventListener( "DOMContentLoaded", self.DOMContentLoaded, false );

			// A fallback to window.onload, that will always work
			window.addEventListener( "load", self.ready, false );

		} else {
			// Ensure firing before onload, maybe late but safe also for iframes
			document.attachEvent( "onreadystatechange", self.DOMContentLoaded );

			// A fallback to window.onload, that will always work
			window.attachEvent( "onload", self.ready );

			// If IE and not a frame
			// continually check to see if the document is ready
			var top = false;
			try {
				top = !window.frameElement && document.documentElement;
			} catch(e) {}
			if ( top && top.doScroll ) {
				(function doScrollCheck() {
					if ( !self.isReady ) {
						try {
							// Use the trick by Diego Perini
							// http://javascript.nwbox.com/IEContentLoaded/
							top.doScroll("left");
						} catch(e) {
							return setTimeout( doScrollCheck, 50 );
						}
						// and execute waiting functions
						self.ready();
					}
				})();
			}
		}
};


if (typeof define === 'function' && define.amd) {
    // AMD. Register as an anonymous module.
    define('src/domready/domready',[],domready);
};
 /*
  * getElements
  * tiny dom selector engine function adapted from
  * http://www.kirupa.com/forum/showthread.php?253289-JS-Document-getElements
  * linted and now includes wildcard * selector
  * original code by https://github.com/icio http://www.paul-scott.com/
  */


 function getElements(e, elem) {
     if(!e || !e.length || e.length === 0) {
         return [];
     }
     var store = [elem || document.body];
     var store_t = [];
     e = e.split(" ");
     for(var i = 0; i < e.length; i++) {
         var r = {
             id: "",
             tag: "*",
             clas: []
         };
         var c, s, t = e[i];
         while(t.length > 0) {
             s = t.search(/.[#\.]/) + 1 || t.length;
             c = t.substr(0, s);

             if(c.substr(0, 1) === "#") {
                 r.id = c.substr(1);
             } else if(c.substr(0, 1) === ".") {
                 r.clas.push(c.substr(1));
             } else {
                 r.tag = c;
             }
             t = t.substr(s);
         }
         while(store.length > 0) {
             var curr = [],
                 temp = store.shift().getElementsByTagName(r.tag);
             for(var j = 0; j < temp.length; j++) {
                 curr.push(temp[j]);
             }
             while(curr.length > 0) {
                 var ok = true,
                     ce = curr.shift();
                 if(r.id && ce.id !== r.id) {
                     ok = false;
                 }
                 for(j = 0; j < r.clas.length; j++) {
                     var clasName = r.clas[j];
                     if(clasName.charAt(clasName.length - 1) === '*') {
                         var pattern = '\\s' + clasName.substr(0, clasName.length - 1) + '\\S*\\s';
                         if(!new RegExp(pattern).test(" " + ce.className + " ")) {
                             ok = false;
                             break;
                         }
                     } else if((" " + ce.className + " ").indexOf(" " + clasName + " ") === -1) {
                         ok = false;
                         break;
                     }
                 }
                 if(ok) {
                     store_t.push(ce);
                 }
             }
         }
         store = store_t;
         store_t = [];
     }
     return store;
 }



(function(){
     if(typeof define === 'function' && define.amd) {
         // AMD. Register as an anonymous module.
         define('src/getElements',[],getElements);
     }
})();
/*
 *  after
 *  https://github.com/alanclarke/after.js
 *
 *  Copyright (c) 2012 Alan Clarke
 *  Licensed under the GPL license.
 *
 *  structure and logic largely taken from http://jquery.lukelutman.com/plugins/pseudo/
 *  but uses a different technique to scan and apply rules which avoids the requirement for special syntax
 *  and refactored to remove jquery dependency
 */

var afterjs;

(function() {

  if(typeof jQuery === 'undefined') {
    var jQuery;
  }

  (function($) {

    function fn_after(getElements) {

      return function(opts) {

        getElements = opts.no_jquery ? getElements : ($ || getElements);

        var patterns = {
          text: /^['"]?(.+?)["']?$/,
          url: /^url\(["']?(.+?)['"]?\)$/
        };

        function clean(content) {
          if(content && content.length) {
            var text = content.match(patterns.text)[1],
              url = text.match(patterns.url);
            return url ? '<img src="' + url[1] + '" />' : text;
          }
        }

        function inject(prop, els, rule) {
          var style = rule.style;
          for(var i = 0; i < els.length; i++) {
            var elem = els[i];
            var pseudoel = getElements('.pseudo-after', els[i]);
            if(!pseudoel.length) {
              pseudoel = document.createElement('span');
              elem.appendChild(pseudoel);
            }
            pseudoel.className = 'pseudo-after';
            pseudoel.innerHTML = clean(rule.style.content);

            //copy any style information
            for(var cssprop in style) {
              if(style[cssprop]) {
                //only apply supported props
                try {
                  pseudoel.style[cssprop] = style[cssprop];
                } catch(e) {}
              }
            }
          }
        }

        //give pictonic class to all icons
        var els = getElements('.icon-*');
        for(var i =0;i<els.length;i++){
          if(!/(^|\s)pictonic(\s|$)/.test(els[i].className)){
            els[i].className+=' pictonic';
          }
        }

        //search stylesheets
        for(var i = 0; i < document.styleSheets.length; i++) {
          //if it doesn't work, it probably shouldn't
          try {
            var cssrules;
            if(document.styleSheets[i].cssRules) {
              cssrules = document.styleSheets[i].cssRules;
            } else if(document.styleSheets[i].rules) {
              cssrules = document.styleSheets[i].rules;
            } else {
              cssrules = [];
            }

            for(var j = 0; j < cssrules.length; j++) {
              try {
                var rule = cssrules[j],
                  selector = rule.selectorText.replace(/:+\w+/gi, '');

                //before or after rules are unknown in versions of ie that don't support it
                if(opts.force || (/:+unknown/gi.test(rule.selectorText))) {
                  if(rule.style.content) {
                    var els = getElements(selector.toString());
                    if(els.length) {
                      inject('before', els, rule);
                    }
                  }
                }
              } catch(e) {}
            }
          } catch(e) {}
        }

        return !opts.callback || opts.callback();
      };
    }

    if(typeof define === 'function' && define.amd) {
      // AMD. Register as an anonymous module.
      define('src/after',['src/getElements'], fn_after);
    } else if(getElements) {
      afterjs = fn_after(getElements);
    }

  })(jQuery);

})();

(function(){
	afterjs_opts = window.afterjs_opts;
	if(typeof afterjs_opts!== 'undefined'){
		if(afterjs_opts.manual_run){

			return;
		}
	} else {
		var afterjs_opts = {};
	}

	/* runs after.js when the dom is ready */
	if(typeof define === 'function' && define.amd) {
		// AMD. Register as an anonymous module.
		define('src/after.run.js',['src/domready/domready', 'src/after'], function(domready, afterjs) {
			return domready(function(){
				afterjs(afterjs_opts);
			});
		});
	} else if(domready && afterjs) {
		domready(function(){
			afterjs(afterjs_opts);
		});
	}

})();