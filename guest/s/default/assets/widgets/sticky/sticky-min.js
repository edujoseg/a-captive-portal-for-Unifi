(function(g,h,c){var f=function(j){console.log(j)};var b=g(h),i=h.document,e=g(i);var a=(function(){var l,j=3,m=i.createElement("div"),k=m.getElementsByTagName("i");while(m.innerHTML="<!--[if gt IE "+(++j)+"]><i></i><![endif]-->",k[0]){}return j>4?j:l})();var d=function(){var l=h.pageXOffset!==c?h.pageXOffset:(i.compatMode=="CSS1Compat"?h.document.documentElement.scrollLeft:h.document.body.scrollLeft),m=h.pageYOffset!==c?h.pageYOffset:(i.compatMode=="CSS1Compat"?h.document.documentElement.scrollTop:h.document.body.scrollTop);if(typeof d.x=="undefined"){d.x=l;d.y=m}if(typeof d.distanceX=="undefined"){d.distanceX=l;d.distanceY=m}else{d.distanceX=l-d.x;d.distanceY=m-d.y}var k=d.x-l,j=d.y-m;d.direction=k<0?"right":k>0?"left":j<=0?"down":j>0?"up":"first";d.x=l;d.y=m};b.on("scroll",d);g.fn.style=function(k){if(!k){return null}var n=g(this),m;var l=n.clone().css("display","none");l.find("input:radio").attr("name","copy-"+Math.floor((Math.random()*100)+1));n.after(l);var j=function(p,o){var q;if(p.currentStyle){q=p.currentStyle[o.replace(/-\w/g,function(r){return r.toUpperCase().replace("-","")})]}else{if(h.getComputedStyle){q=i.defaultView.getComputedStyle(p,null).getPropertyValue(o)}}q=(/margin/g.test(o))?((parseInt(q)===n[0].offsetLeft)?q:"auto"):q;return q};if(typeof k=="string"){m=j(l[0],k)}else{m={};g.each(k,function(o,p){m[p]=j(l[0],p)})}l.remove();return m||null};g.fn.extend({hcSticky:function(j){if(this.length==0){return this}this.pluginOptions("hcSticky",{top:0,bottom:0,bottomEnd:0,innerTop:0,innerSticker:null,className:"sticky",wrapperClassName:"wrapper-sticky",stickTo:null,responsive:true,followScroll:true,offResolutions:null,onStart:g.noop,onStop:g.noop,on:true,fn:null},j||{},{reinit:function(){g(this).hcSticky()},stop:function(){g(this).pluginOptions("hcSticky",{on:false}).each(function(){var n=g(this),k=n.pluginOptions("hcSticky"),l=n.parent("."+k.wrapperClassName);var m=n.offset().top-l.offset().top;n.css({position:"absolute",top:m,bottom:"auto",left:"auto",right:"auto"}).removeClass(k.className)})},off:function(){g(this).pluginOptions("hcSticky",{on:false}).each(function(){var m=g(this),k=m.pluginOptions("hcSticky"),l=m.parent("."+k.wrapperClassName);m.css({position:"relative",top:"auto",bottom:"auto",left:"auto",right:"auto"}).removeClass(k.className);l.css("height","auto")})},on:function(){g(this).each(function(){g(this).pluginOptions("hcSticky",{on:true,remember:{offsetTop:b.scrollTop()}}).hcSticky()})},destroy:function(){var m=g(this),k=m.pluginOptions("hcSticky"),l=m.parent("."+k.wrapperClassName);m.removeData("hcStickyInit").css({position:l.css("position"),top:l.css("top"),bottom:l.css("bottom"),left:l.css("left"),right:l.css("right")}).removeClass(k.className);b.off("resize",k.fn.resize).off("scroll",k.fn.scroll);m.unwrap()}});if(j&&typeof j.on!="undefined"){if(j.on){this.hcSticky("on")}else{this.hcSticky("off")}}if(typeof j=="string"){return this}return this.each(function(){var q=g(this),w=q.pluginOptions("hcSticky");var m=(function(){var x=q.parent("."+w.wrapperClassName);if(x.length>0){x.css({height:q.outerHeight(true),width:(function(){var y=x.style("width");if(y.indexOf("%")>=0||y=="auto"){if(q.css("box-sizing")=="border-box"||q.css("-moz-box-sizing")=="border-box"){q.css("width",x.width())}else{q.css("width",x.width()-parseInt(q.css("padding-left")-parseInt(q.css("padding-right"))))}return y}else{return q.outerWidth(true)}})()});return x}else{return false}})()||(function(){var y=q.style(["width","margin-left","left","right","top","bottom","float","display"]);var z=q.css("display");var x=g("<div>",{"class":w.wrapperClassName}).css({display:z,height:q.outerHeight(true),width:(function(){if(y.width.indexOf("%")>=0||(y.width=="auto"&&z!="inline-block"&&z!="inline")){q.css("width",parseFloat(q.css("width")));return y.width}else{if(y.width=="auto"&&(z=="inline-block"||z=="inline")){return q.width()}else{return(y["margin-left"]=="auto")?q.outerWidth():q.outerWidth(true)}}})(),margin:(y["margin-left"])?"auto":null,position:(function(){var A=q.css("position");return A=="static"?"relative":A})(),"float":y["float"]||null,left:y.left,right:y.right,top:y.top,bottom:y.bottom,"vertical-align":"top"});q.wrap(x);if(a===7){if(g("head").find("style#hcsticky-iefix").length===0){g('<style id="hcsticky-iefix">.'+w.wrapperClassName+" {zoom: 1;}</style>").appendTo("head")}}return q.parent()})();if(q.data("hcStickyInit")){return}q.data("hcStickyInit",true);var v=w.stickTo&&(w.stickTo=="document"||(w.stickTo.nodeType&&w.stickTo.nodeType==9)||(typeof w.stickTo=="object"&&w.stickTo instanceof (typeof HTMLDocument!="undefined"?HTMLDocument:Document)))?true:false;var u=w.stickTo?v?e:typeof w.stickTo=="string"?g(w.stickTo):w.stickTo:m.parent();q.css({top:"auto",bottom:"auto",left:"auto",right:"auto"});b.load(function(){if(q.outerHeight(true)>u.height()){m.css("height",q.outerHeight(true));q.hcSticky("reinit")}});var t=function(x){if(q.hasClass(w.className)){return}x=x||{};q.css({position:"fixed",top:x.top||0,left:x.left||m.offset().left}).addClass(w.className);w.onStart.apply(q[0]);m.addClass("sticky-active")},r=function(x){x=x||{};x.position=x.position||"absolute";x.top=x.top||0;x.left=x.left||0;if(q.css("position")!="fixed"&&parseInt(q.css("top"))==x.top){return}q.css({position:x.position,top:x.top,left:x.left}).removeClass(w.className);w.onStop.apply(q[0]);m.removeClass("sticky-active")};var p=function(G){if(!w.on||q.outerHeight(true)>=u.height()){return}var x=(w.innerSticker)?g(w.innerSticker).position().top:((w.innerTop)?w.innerTop:0),A=m.offset().top,B=u.height()-w.bottomEnd+(v?0:A),D=m.offset().top-w.top+x,F=q.outerHeight(true)+w.bottom,H=b.height(),E=b.scrollTop(),z=q.offset().top,y=z-E,I;if(typeof w.remember!="undefined"&&w.remember){var C=z-w.top-x;if(F-x>H&&w.followScroll){if(C<E&&E+H<=C+q.height()){w.remember=false}}else{if(w.remember.offsetTop>C){if(E<=C){t({top:w.top-x});w.remember=false}}else{if(E>=C){t({top:w.top-x});w.remember=false}}}return}if(E>D){if(B+w.bottom-(w.followScroll&&H<F?0:w.top)<=E+F-x-((F-x>H-(D-x)&&w.followScroll)?(((I=F-H-x)>0)?I:0):0)){r({top:B-F+w.bottom-A})}else{if(F-x>H&&w.followScroll){if(y+F<=H){if(d.direction=="down"){t({top:H-F})}else{if(y<0&&q.css("position")=="fixed"){r({top:z-(D+w.top-x)-d.distanceY})}}}else{if(d.direction=="up"&&z>=E+w.top-x){t({top:w.top-x})}else{if(d.direction=="down"&&z+F>H&&q.css("position")=="fixed"){r({top:z-(D+w.top-x)-d.distanceY})}}}}else{t({top:w.top-x})}}}else{r()}};var o=false,s=false;var k=function(){n();l();if(!w.on){return}var y=function(){if(q.css("position")=="fixed"){q.css("left",m.offset().left)}else{q.css("left",0)}};if(w.responsive){if(!s){s=q.clone().attr("style","").css({visibility:"hidden",height:0,overflow:"hidden",paddingTop:0,paddingBottom:0,marginTop:0,marginBottom:0});m.after(s)}var x=m.style("width");var A=s.style("width");if(A=="auto"&&x!="auto"){A=parseInt(q.css("width"))}if(A!=x){m.width(A)}if(o){clearTimeout(o)}o=setTimeout(function(){o=false;s.remove();s=false},250)}y();if(q.outerWidth(true)!=m.width()){var z=(q.css("box-sizing")=="border-box"||q.css("-moz-box-sizing")=="border-box")?m.width():m.width()-parseInt(q.css("padding-left"))-parseInt(q.css("padding-right"));z=z-parseInt(q.css("margin-left"))-parseInt(q.css("margin-right"));q.css("width",z)}};q.pluginOptions("hcSticky",{fn:{scroll:p,resize:k}});var l=function(){if(w.offResolutions){if(!g.isArray(w.offResolutions)){w.offResolutions=[w.offResolutions]}var x=true;g.each(w.offResolutions,function(y,z){if(z<0){if(b.width()<z*-1){x=false;q.hcSticky("off")}}else{if(b.width()>z){x=false;q.hcSticky("off")}}});if(x&&!w.on){q.hcSticky("on")}}};l();b.on("resize",k);var n=function(){if(q.outerHeight(true)<u.height()){var x=false;if(g._data(h,"events").scroll!=c){g.each(g._data(h,"events").scroll,function(y,z){if(z.handler==w.fn.scroll){x=true}})}if(!x){w.fn.scroll(true);b.on("scroll",w.fn.scroll)}}};n()})}})})(jQuery,this);(function(a,b){a.fn.extend({pluginOptions:function(e,d,f,c){if(!this.data(e)){this.data(e,{})}if(e&&typeof d=="undefined"){return this.data(e).options}f=f||(d||{});if(typeof f=="object"||f===b){return this.each(function(){var g=a(this);if(!g.data(e).options){g.data(e,{options:a.extend(d,f||{})});if(c){g.data(e).commands=c}}else{g.data(e,a.extend(g.data(e),{options:a.extend(g.data(e).options,f||{})}))}})}else{if(typeof f=="string"){return this.each(function(){a(this).data(e).commands[f].call(this)})}else{return this}}}})})(jQuery);