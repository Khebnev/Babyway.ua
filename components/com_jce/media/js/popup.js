/* jce - 2.7.3 | 2019-03-14 | https://www.joomlacontenteditor.net | Copyright (C) 2006 - 2019 Ryan Demmer. All rights reserved | GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html */
!function(win){function ready(){"loading"!=doc.readyState?self.preinit():doc.addEventListener?doc.addEventListener("DOMContentLoaded",self.preinit):doc.attachEvent("onreadystatechange",function(){"loading"!=doc.readyState&&self.preinit()})}function resize(width,height){var x,oh=0,vw=win.innerWidth||doc.documentElement.clientWidth||body.clientWidth||0,vh=win.innerHeight||doc.documentElement.clientHeight||body.clientHeight||0,divs=doc.getElementsByTagName("div");for(x=0;x<divs.length;x++)"contentheading"==divs[x].className&&(oh=divs[x].offsetHeight);win.resizeBy(vw-width,vh-(height+oh)),center()}function center(){var vw=win.innerWidth||doc.documentElement.clientWidth||body.clientWidth||0,vh=win.innerHeight||doc.documentElement.clientHeight||body.clientHeight||0,x=(screen.width-vw)/2,y=(screen.height-vh)/2;win.moveTo(x,y)}var doc=win.document,body=doc.body,domLoaded=!1,self={preinit:function(width,height,click){if(this.width=parseInt(width),this.height=parseInt(height),this.click=!!click,this.width||this.height)return domLoaded?void this.init():ready()},init:function(){resize(),this.click&&(doc.onmousedown=function(e){return win.close()})}};win.WfWindowPopup={init:self.preinit}}(window);