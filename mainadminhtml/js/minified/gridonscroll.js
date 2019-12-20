
website(document).ready(function()
{new ScrollFlow();});website.fn.ScrollFlow=function(options)
{new ScrollFlow(options);}
ScrollFlow=function(options)
{this.init(options);}
website.extend(ScrollFlow.prototype,{init:function(options)
{this.options=website.extend({useMobileTimeouts:true,mobileTimeout:100,durationOnLoad:0,durationOnResize:250,durationOnScroll:500},options);this.lastScrollTop=0;this.bindScroll();this.bindResize();this.update(this.options.durationOnLoad);},bindScroll:function()
{var $this=this;website(window).scroll(function()
{$this.update();});website(window).bind("gesturechange",function()
{$this.update();});},bindResize:function()
{var $this=this;website(window).resize(function()
{$this.update($this.options.durationOnResize);});},update:function(forcedDuration)
{var $this=this;winHeight=website(window).height();scrollTop=website(window).scrollTop();website(".scrollflow").each(function(key,obj)
{objOffset=website(obj).offset();objOffsetTop=parseInt(objOffset.top);effectDuration=$this.options.durationOnScroll;effectDuration=typeof(forcedDuration)!="undefined"?forcedDuration:effectDuration;effectiveFromPercentage=(!isNaN(parseInt(website(obj).attr("data-scrollflow-start")/100))?parseInt(website(obj).attr("data-scrollflow-start"))/100:-0.25);scrollDistancePercentage=(!isNaN(parseInt(website(obj).attr("data-scrollflow-distance")/100))?parseInt(website(obj).attr("data-scrollflow-distance"))/100:0.5);effectiveFrom=objOffsetTop-winHeight*(1-effectiveFromPercentage);effectiveTo=objOffsetTop-winHeight*(1-scrollDistancePercentage);parallaxScale=0.8;parallaxOpacity=0;parallaxOffset=-100;factor=0;if(scrollTop>effectiveFrom)
{factor=(scrollTop-effectiveFrom)/(effectiveTo-effectiveFrom);factor=(factor>1?1:factor);}
options={opacity:1,scale:1,translateX:0,translateY:0};if(website(obj).hasClass("-opacity"))
{options.opacity=0+factor;}
if(website(obj).hasClass("-pop"))
{options.scale=0.8+factor*0.2;}
if(website(obj).hasClass("-slide-left"))
{options.translateX=(-100+factor*100)* -1;}
if(website(obj).hasClass("-slide-right"))
{options.translateX=(-100+factor*100);}
if(website(obj).hasClass("-slide-top"))
{options.translateY=(-100+factor*100)* -1;}
if(website(obj).hasClass("-slide-bottom"))
{options.translateY=(-100+factor*100);}
website(obj).css({webkitFilter:"opacity("+options.opacity+")",mozFilter:"opacity("+options.opacity+")",oFilter:"opacity("+options.opacity+")",msFilter:"opacity("+options.opacity+")",filter:"opacity("+options.opacity+")",webkitTransform:"translate3d( "+parseInt(options.translateX)+"px, "+parseInt(options.translateY)+"px, 0px ) scale("+options.scale+")",mozTransform:"translate3d( "+parseInt(options.translateX)+"px, "+parseInt(options.translateY)+"px, 0px ) scale("+options.scale+")",oTransform:"translate3d( "+parseInt(options.translateX)+"px, "+parseInt(options.translateY)+"px, 0px ) scale("+options.scale+")",msTransform:"translate3d( "+parseInt(options.translateX)+"px, "+parseInt(options.translateY)+"px, 0px ) scale("+options.scale+")",transform:"translate3d( "+parseInt(options.translateX)+"px, "+parseInt(options.translateY)+"px, 0px ) scale("+options.scale+")",transition:"all "+effectDuration+"ms ease-out"});});return;if(this.options.useMobileTimeouts&&this.lastScrollTop!=scrollTop)
{this.lastScrollTop=scrollTop;website("body").stop();website("body").animate({float:"none"},this.options.mobileTimeout,function()
{websitethis.update();});}}});;
website(function(){website("#letter-container h2 a").lettering();});(function(website){function injector(t,splitter,klass,after){var a=t.text().split(splitter),inject='';if(a.length){website(a).each(function(i,item){inject+='<span class="'+klass+(i+1)+'">'+item+'</span>'+after;});t.empty().append(inject);}}
var methods={init:function(){return this.each(function(){injector(website(this),'','char','');});},words:function(){return this.each(function(){injector(website(this),' ','word',' ');});},lines:function(){return this.each(function(){var r="eefec303079ad17405c889e092e105b0";injector(website(this).children("br").replaceWith(r).end(),r,'line','');});}};website.fn.lettering=function(method){if(method&&methods[method]){return methods[method].apply(this,[].slice.call(arguments,1));}else if(method==='letters'||!method){return methods.init.apply(this,[].slice.call(arguments,0));}
website.error('Method '+method+' does not exist on jQuery.lettering');return this;};})(jQuery);;