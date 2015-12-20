if(!window.SyntaxHighlighter)var SyntaxHighlighter=function(){var sh={defaults:{'class-name':'','first-line':1,'pad-line-numbers':true,'highlight':null,'smart-tabs':true,'tab-size':4,'gutter':true,'toolbar':true,'collapse':false,'auto-links':false,'light':true,'wrap-lines':true,'html-script':false},config:{useScriptTags:true,clipboardSwf:null,toolbarItemWidth:16,toolbarItemHeight:16,bloggerMode:false,stripBrs:false,tagName:'pre',strings:{expandSource:'show source',viewSource:'view source',copyToClipboard:'copy to clipboard',copyToClipboardConfirmation:'The code is in your clipboard now',alert:'SyntaxHighlighter\n\n',noBrush:'Can\'t find brush for: ',brushNotHtmlScript:'Brush wasn\'t configured for html-script option: ',},debug:false},vars:{discoveredBrushes:null,spaceWidth:null,printFrame:null,highlighters:{}},brushes:{},regexLib:{multiLineCComments:/\/\*[\s\S]*?\*\//gm,singleLineCComments:/\/\/.*$/gm,singleLinePerlComments:/#.*$/gm,doubleQuotedString:/"([^\\"\n]|\\.)*"/g,singleQuotedString:/'([^\\'\n]|\\.)*'/g,multiLineDoubleQuotedString:/"([^\\"]|\\.)*"/g,multiLineSingleQuotedString:/'([^\\']|\\.)*'/g,xmlComments:/(&lt;|<)!--[\s\S]*?--(&gt;|>)/gm,url:/&lt;\w+:\/\/[\w-.\/?%&=@:;]*&gt;|\w+:\/\/[\w-.\/?%&=@:;]*/g,phpScriptTags:{left:/(&lt;|<)\?=?/g,right:/\?(&gt;|>)/g},aspScriptTags:{left:/(&lt;|<)%=?/g,right:/%(&gt;|>)/g},scriptScriptTags:{left:/(&lt;|<)\s*script.*?(&gt;|>)/gi,right:/(&lt;|<)\/\s*script\s*(&gt;|>)/gi}},toolbar:{create:function(highlighter)
{var div=document.createElement('DIV'),items=sh.toolbar.items;div.className='toolbar';for(var name in items)
{var constructor=items[name],command=new constructor(highlighter),element=command.create();highlighter.toolbarCommands[name]=command;if(element==null)
continue;if(typeof(element)=='string')
element=sh.toolbar.createButton(element,highlighter.id,name);element.className+='item '+name;div.appendChild(element);}
return div;},createButton:function(label,highlighterId,commandName)
{var a=document.createElement('a'),style=a.style,config=sh.config,width=config.toolbarItemWidth,height=config.toolbarItemHeight;a.href='#'+commandName;a.title=label;a.highlighterId=highlighterId;a.commandName=commandName;a.innerHTML=label;if(isNaN(width)==false)
style.width=width+'px';if(isNaN(height)==false)
style.height=height+'px';a.onclick=function(e)
{try
{sh.toolbar.executeCommand(this,e||window.event,this.highlighterId,this.commandName);}
catch(e)
{sh.utils.alert(e.message);}
return false;};return a;},executeCommand:function(sender,event,highlighterId,commandName,args)
{var highlighter=sh.vars.highlighters[highlighterId],command;if(highlighter==null||(command=highlighter.toolbarCommands[commandName])==null)
return null;return command.execute(sender,event,args);},items:{expandSource:function(highlighter)
{this.create=function()
{if(highlighter.getParam('collapse')!=true)
return;return sh.config.strings.expandSource;};this.execute=function(sender,event,args)
{var div=highlighter.div;sender.parentNode.removeChild(sender);div.className=div.className.replace('collapsed','');};},viewSource:function(highlighter)
{this.create=function()
{return sh.config.strings.viewSource;};this.execute=function(sender,event,args)
{var code=sh.utils.fixInputString(highlighter.originalCode).replace(/</g,'&lt;'),wnd=sh.utils.popup('','_blank',750,400,'location=0, resizable=1, menubar=0, scrollbars=1');code=sh.utils.unindent(code);wnd.document.write('<pre>'+code+'</pre>');wnd.document.close();};},copyToClipboard:function(highlighter)
{var flashDiv,flashSwf,highlighterId=highlighter.id;this.create=function()
{var config=sh.config;if(config.clipboardSwf==null)
return null;function params(list)
{var result='';for(var name in list)
result+="<param name='"+name+"' value='"+list[name]+"'/>";return result;};function attributes(list)
{var result='';for(var name in list)
result+=" "+name+"='"+list[name]+"'";return result;};var args1={width:config.toolbarItemWidth,height:config.toolbarItemHeight,id:highlighterId+'_clipboard',type:'application/x-shockwave-flash',title:sh.config.strings.copyToClipboard},args2={allowScriptAccess:'always',wmode:'transparent',flashVars:'highlighterId='+highlighterId,menu:'false'},swf=config.clipboardSwf,html;if(/msie/i.test(navigator.userAgent))
{html='<object'+attributes({classid:'clsid:d27cdb6e-ae6d-11cf-96b8-444553540000',codebase:'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0'})+attributes(args1)+'>'+params(args2)+params({movie:swf})+'</object>';}
else
{html='<embed'+attributes(args1)+attributes(args2)+attributes({src:swf})+'/>';}
flashDiv=document.createElement('div');flashDiv.innerHTML=html;return flashDiv;};this.execute=function(sender,event,args)
{var command=args.command;switch(command)
{case'get':var code=sh.utils.unindent(sh.utils.fixInputString(highlighter.originalCode).replace(/&amp;/g,'&'));if(window.clipboardData)
window.clipboardData.setData('text',code);else
return sh.utils.unindent(code);case'ok':sh.utils.alert(sh.config.strings.copyToClipboardConfirmation);break;case'error':sh.utils.alert(args.message);break;}};},printSource:function(highlighter)
{this.create=function()
{return sh.config.strings.print;};this.execute=function(sender,event,args)
{var iframe=document.createElement('IFRAME'),doc=null;if(sh.vars.printFrame!=null)
document.body.removeChild(sh.vars.printFrame);sh.vars.printFrame=iframe;iframe.style.cssText='position:absolute;width:0px;height:0px;left:-500px;top:-500px;';document.body.appendChild(iframe);doc=iframe.contentWindow.document;copyStyles(doc,window.document);doc.write('<div class="'+highlighter.div.className.replace('collapsed','')+' printing">'+highlighter.div.innerHTML+'</div>');doc.close();iframe.contentWindow.focus();iframe.contentWindow.print();function copyStyles(destDoc,sourceDoc)
{var links=sourceDoc.getElementsByTagName('link');for(var i=0;i<links.length;i++)
if(links[i].rel.toLowerCase()=='stylesheet'&&/shCore\.css$/.test(links[i].href))
destDoc.write('<link type="text/css" rel="stylesheet" href="'+links[i].href+'"></link>');};};},about:function(highlighter)
{this.create=function()
{return sh.config.strings.help;};this.execute=function(sender,event)
{var wnd=sh.utils.popup('','_blank',500,250,'scrollbars=0'),doc=wnd.document;doc.write(sh.config.strings.aboutDialog);doc.close();wnd.focus();};}}},utils:{indexOf:function(array,searchElement,fromIndex)
{fromIndex=Math.max(fromIndex||0,0);for(var i=fromIndex;i<array.length;i++)
if(array[i]==searchElement)
return i;return-1;},guid:function(prefix)
{return prefix+Math.round(Math.random()*1000000).toString();},merge:function(obj1,obj2)
{var result={},name;for(name in obj1)
result[name]=obj1[name];for(name in obj2)
result[name]=obj2[name];return result;},toBoolean:function(value)
{switch(value)
{case"true":return true;case"false":return false;}
return value;},popup:function(url,name,width,height,options)
{var x=(screen.width-width)/2,y=(screen.height-height)/2;options+=', left='+x+', top='+y+', width='+width+', height='+height;options=options.replace(/^,/,'');var win=window.open(url,name,options);win.focus();return win;},addEvent:function(obj,type,func)
{if(obj.attachEvent)
{obj['e'+type+func]=func;obj[type+func]=function()
{obj['e'+type+func](window.event);}
obj.attachEvent('on'+type,obj[type+func]);}
else
{obj.addEventListener(type,func,false);}},alert:function(str)
{alert(sh.config.strings.alert+str)},findBrush:function(alias,alert)
{var brushes=sh.vars.discoveredBrushes,result=null;if(brushes==null)
{brushes={};for(var brush in sh.brushes)
{var aliases=sh.brushes[brush].aliases;if(aliases==null)
continue;sh.brushes[brush].name=brush.toLowerCase();for(var i=0;i<aliases.length;i++)
brushes[aliases[i]]=brush;}
sh.vars.discoveredBrushes=brushes;}
result=sh.brushes[brushes[alias]];if(result==null&&alert!=false)
sh.utils.alert(sh.config.strings.noBrush+alias);return result;},eachLine:function(str,callback)
{var lines=str.split('\n');for(var i=0;i<lines.length;i++)
lines[i]=callback(lines[i]);return lines.join('\n');},trimFirstAndLastLines:function(str)
{return str.replace(/^[ ]*[\n]+|[\n]*[ ]*$/g,'');},parseParams:function(str)
{var match,result={},arrayRegex=new XRegExp("^\\[(?<values>(.*?))\\]$"),regex=new XRegExp("(?<name>[\\w-]+)"+"\\s*:\\s*"+"(?<value>"+"[\\w-%#]+|"+"\\[.*?\\]|"+'".*?"|'+"'.*?'"+")\\s*;?","g");while((match=regex.exec(str))!=null)
{var value=match.value.replace(/^['"]|['"]$/g,'');if(value!=null&&arrayRegex.test(value))
{var m=arrayRegex.exec(value);value=m.values.length>0?m.values.split(/\s*,\s*/):[];}
result[match.name]=value;}
return result;},decorate:function(str,css)
{if(str==null||str.length==0||str=='\n')
return str;str=str.replace(/ {2,}/g,function(m)
{var spaces='';for(var i=0;i<m.length-1;i++)
spaces+='&nbsp;';return spaces+' ';});if(css!=null)
str=sh.utils.eachLine(str,function(line)
{if(line.length==0)
return'';var spaces='';line=line.replace(/^(&nbsp;| )+/,function(s)
{spaces=s;return'';});if(line.length==0)
return spaces;return spaces+'<code class="'+css+'">'+line+'</code>';});return str;},padNumber:function(number,length)
{var result=number.toString();while(result.length<length)
result='0'+result;return result;},measureSpace:function()
{var container=document.createElement('div'),span,result=0,body=document.body,id=sh.utils.guid('measureSpace'),divOpen='<div class="',closeDiv='</div>',closeSpan='</span>';container.innerHTML=divOpen+'syntaxhighlighter">'+divOpen+'lines">'+divOpen+'line">'+divOpen+'content'+'"><span class="block"><span id="'+id+'">&nbsp;'+closeSpan+closeSpan+closeDiv+closeDiv+closeDiv+closeDiv;body.appendChild(container);span=document.getElementById(id);if(/opera/i.test(navigator.userAgent))
{var style=window.getComputedStyle(span,null);result=parseInt(style.getPropertyValue("width"));}
else
{result=span.offsetWidth;}
body.removeChild(container);return result;},processTabs:function(code,tabSize)
{var tab='';for(var i=0;i<tabSize;i++)
tab+=' ';return code.replace(/\t/g,tab);},processSmartTabs:function(code,tabSize)
{var lines=code.split('\n'),tab='\t',spaces='';for(var i=0;i<50;i++)
spaces+='                    ';function insertSpaces(line,pos,count)
{return line.substr(0,pos)+spaces.substr(0,count)+line.substr(pos+1,line.length);};code=sh.utils.eachLine(code,function(line)
{if(line.indexOf(tab)==-1)
return line;var pos=0;while((pos=line.indexOf(tab))!=-1)
{var spaces=tabSize-pos%tabSize;line=insertSpaces(line,pos,spaces);}
return line;});return code;},fixInputString:function(str)
{return str;},trim:function(str)
{return str.replace(/^\s+|\s+$/g,'');},unindent:function(str)
{var lines=sh.utils.fixInputString(str).split('\n'),indents=new Array(),regex=/^\s*/,min=1000;for(var i=0;i<lines.length&&min>0;i++)
{var line=lines[i];if(sh.utils.trim(line).length==0)
continue;var matches=regex.exec(line);if(matches==null)
return str;min=Math.min(matches[0].length,min);}
if(min>0)
for(var i=0;i<lines.length;i++)
lines[i]=lines[i].substr(min);return lines.join('\n');},matchesSortCallback:function(m1,m2)
{if(m1.index<m2.index)
return-1;else if(m1.index>m2.index)
return 1;else
{if(m1.length<m2.length)
return-1;else if(m1.length>m2.length)
return 1;}
return 0;},getMatches:function(code,regexInfo)
{function defaultAdd(match,regexInfo)
{return[new sh.Match(match[0],match.index,regexInfo.css)];};var index=0,match=null,result=[],func=regexInfo.func?regexInfo.func:defaultAdd;while((match=regexInfo.regex.exec(code))!=null)
result=result.concat(func(match,regexInfo));return result;},processUrls:function(code)
{var lt='&lt;',gt='&gt;';return code.replace(sh.regexLib.url,function(m)
{var suffix='',prefix='';if(m.indexOf(lt)==0)
{prefix=lt;m=m.substring(lt.length);}
if(m.indexOf(gt)==m.length-gt.length)
{m=m.substring(0,m.length-gt.length);suffix=gt;}
return prefix+'<a href="'+m+'">'+m+'</a>'+suffix;});},getSyntaxHighlighterScriptTags:function()
{var tags=document.getElementsByTagName('script'),result=[];for(var i=0;i<tags.length;i++)
if(tags[i].type=='syntaxhighlighter')
result.push(tags[i]);return result;},stripCData:function(original)
{var left='<![CDATA[',right=']]>',copy=sh.utils.trim(original),changed=false;if(copy.indexOf(left)==0)
{copy=copy.substring(left.length);changed=true;}
if(copy.indexOf(right)==copy.length-right.length)
{copy=copy.substring(0,copy.length-right.length);changed=true;}
return changed?copy:original;}},highlight:function(globalParams,element)
{function toArray(source)
{var result=[];for(var i=0;i<source.length;i++)
result.push(source[i]);return result;};var elements=element?[element]:toArray(document.getElementsByTagName(sh.config.tagName)),propertyName='innerHTML',highlighter=null,conf=sh.config;if(conf.useScriptTags)
elements=elements.concat(sh.utils.getSyntaxHighlighterScriptTags());if(elements.length===0)
return;for(var i=0;i<elements.length;i++)
{var target=elements[i],params=sh.utils.parseParams(target.className),brushName,code,result;params=sh.utils.merge(globalParams,params);brushName=params['brush'];if(brushName==null)
continue;if(params['html-script']=='true'||sh.defaults['html-script']==true)
{highlighter=new sh.HtmlScript(brushName);brushName='htmlscript';}
else
{var brush=sh.utils.findBrush(brushName);if(brush)
{brushName=brush.name;highlighter=new brush();}
else
{continue;}}
code=target[propertyName];if(conf.useScriptTags)
code=sh.utils.stripCData(code);params['brush-name']=brushName;highlighter.highlight(code,params);result=highlighter.div;if(sh.config.debug)
{result=document.createElement('textarea');result.value=highlighter.div.innerHTML;result.style.width='70em';result.style.height='30em';}
target.parentNode.replaceChild(result,target);}},all:function(params)
{sh.utils.addEvent(window,'load',function(){sh.highlight(params);});}};sh.Match=function(value,index,css)
{this.value=value;this.index=index;this.length=value.length;this.css=css;this.brushName=null;};sh.Match.prototype.toString=function()
{return this.value;};sh.HtmlScript=function(scriptBrushName)
{var brushClass=sh.utils.findBrush(scriptBrushName),scriptBrush,xmlBrush=new sh.brushes.Xml(),bracketsRegex=null;if(brushClass==null)
return;scriptBrush=new brushClass();this.xmlBrush=xmlBrush;if(scriptBrush.htmlScript==null)
{sh.utils.alert(sh.config.strings.brushNotHtmlScript+scriptBrushName);return;}
xmlBrush.regexList.push({regex:scriptBrush.htmlScript.code,func:process});function offsetMatches(matches,offset)
{for(var j=0;j<matches.length;j++)
matches[j].index+=offset;}
function process(match,info)
{var code=match.code,matches=[],regexList=scriptBrush.regexList,offset=match.index+match.left.length,htmlScript=scriptBrush.htmlScript,result;for(var i=0;i<regexList.length;i++)
{result=sh.utils.getMatches(code,regexList[i]);offsetMatches(result,offset);matches=matches.concat(result);}
if(htmlScript.left!=null&&match.left!=null)
{result=sh.utils.getMatches(match.left,htmlScript.left);offsetMatches(result,match.index);matches=matches.concat(result);}
if(htmlScript.right!=null&&match.right!=null)
{result=sh.utils.getMatches(match.right,htmlScript.right);offsetMatches(result,match.index+match[0].lastIndexOf(match.right));matches=matches.concat(result);}
for(var j=0;j<matches.length;j++)
matches[j].brushName=brushClass.name;return matches;}};sh.HtmlScript.prototype.highlight=function(code,params)
{this.xmlBrush.highlight(code,params);this.div=this.xmlBrush.div;}
sh.Highlighter=function()
{};sh.Highlighter.prototype={getParam:function(name,defaultValue)
{var result=this.params[name];return sh.utils.toBoolean(result==null?defaultValue:result);},create:function(name)
{return document.createElement(name);},findMatches:function(regexList,code)
{var result=[];if(regexList!=null)
for(var i=0;i<regexList.length;i++)
if(typeof(regexList[i])=="object")
result=result.concat(sh.utils.getMatches(code,regexList[i]));return result.sort(sh.utils.matchesSortCallback);},removeNestedMatches:function()
{var matches=this.matches;for(var i=0;i<matches.length;i++)
{if(matches[i]===null)
continue;var itemI=matches[i],itemIEndPos=itemI.index+itemI.length;for(var j=i+1;j<matches.length&&matches[i]!==null;j++)
{var itemJ=matches[j];if(itemJ===null)
continue;else if(itemJ.index>itemIEndPos)
break;else if(itemJ.index==itemI.index&&itemJ.length>itemI.length)
this.matches[i]=null;else if(itemJ.index>=itemI.index&&itemJ.index<itemIEndPos)
this.matches[j]=null;}}},createDisplayLines:function(code)
{var lines=code.split('\n'),firstLine=parseInt(this.getParam('first-line')),padLength=this.getParam('pad-line-numbers'),highlightedLines=this.getParam('highlight',[]),hasGutter=this.getParam('gutter');code='';if(padLength==true)
padLength=(firstLine+lines.length-1).toString().length;else if(isNaN(padLength)==true)
padLength=0;for(var i=0;i<lines.length;i++)
{var line=lines[i],indent=/^(&nbsp;|\s)+/.exec(line),lineClass='alt'+(i%2==0?1:2),lineNumber=sh.utils.padNumber(firstLine+i,padLength),highlighted=sh.utils.indexOf(highlightedLines,(firstLine+i).toString())!=-1,spaces=null;if(indent!=null)
{spaces=indent[0].toString();line=line.substr(spaces.length);}
line=sh.utils.trim(line);if(line.length==0)
line=' ';if(highlighted)
lineClass+=' highlighted';code+='<div>'+(spaces!=null?'<code class="spaces">'+spaces.replace(' ','&nbsp;')+'</code>':'')+line+'</div>';}
return code;},processMatches:function(code,matches)
{var pos=0,result='',decorate=sh.utils.decorate,brushName=this.getParam('brush-name','');function getBrushNameCss(match)
{var result=match?(match.brushName||brushName):brushName;return result?result+' ':'';};for(var i=0;i<matches.length;i++)
{var match=matches[i],matchBrushName;if(match===null||match.length===0)
continue;matchBrushName=getBrushNameCss(match);result+=decorate(code.substr(pos,match.index-pos),matchBrushName+'plain')+decorate(match.value,matchBrushName+match.css);pos=match.index+match.length;}
result+=decorate(code.substr(pos),getBrushNameCss()+'plain');return result;},highlight:function(code,params)
{var conf=sh.config,vars=sh.vars,div,divClassName,tabSize,important='important';this.params={};this.div=null;this.lines=null;this.code=null;this.bar=null;this.toolbarCommands={};this.id=sh.utils.guid('highlighter_');vars.highlighters[this.id]=this;if(code===null)
code='';this.params=sh.utils.merge(sh.defaults,params||{});if(this.getParam('light')==true)
this.params.toolbar=this.params.gutter=false;this.div=div=this.create('DIV');this.lines=this.create('DIV');this.lines.className='lines';className='syntaxhighlighter';div.id=this.id;if(this.getParam('collapse'))
className+=' collapsed';if(this.getParam('gutter')==false)
className+=' nogutter';if(this.getParam('wrap-lines')==false)
this.lines.className+=' no-wrap';className+=' '+this.getParam('class-name');className+=' '+this.getParam('brush-name');div.className=className;this.originalCode=code;this.code=sh.utils.trimFirstAndLastLines(code).replace(/\r/g,' ');tabSize=this.getParam('tab-size');this.code=this.getParam('smart-tabs')==true?sh.utils.processSmartTabs(this.code,tabSize):sh.utils.processTabs(this.code,tabSize);this.code=sh.utils.unindent(this.code);if(this.getParam('toolbar'))
{this.bar=this.create('DIV');this.bar.className='bar';this.bar.appendChild(sh.toolbar.create(this));div.appendChild(this.bar);var bar=this.bar;function hide(){bar.className=bar.className.replace('show','');}
div.onmouseover=function(){hide();bar.className+=' show';};div.onmouseout=function(){hide();}}
div.appendChild(this.lines);this.matches=this.findMatches(this.regexList,this.code);this.removeNestedMatches();code=this.processMatches(this.code,this.matches);code=this.createDisplayLines(sh.utils.trim(code));if(this.getParam('auto-links'))
code=sh.utils.processUrls(code);this.lines.innerHTML=code;},getKeywords:function(str)
{str=str.replace(/^\s+|\s+$/g,'').replace(/\s+/g,'|');return'\\b(?:'+str+')\\b';},forHtmlScript:function(regexGroup)
{this.htmlScript={left:{regex:regexGroup.left,css:'script'},right:{regex:regexGroup.right,css:'script'},code:new XRegExp("(?<left>"+regexGroup.left.source+")"+"(?<code>.*?)"+"(?<right>"+regexGroup.right.source+")","sgi")};}};return sh;}();if(!window.XRegExp){(function(){var real={exec:RegExp.prototype.exec,match:String.prototype.match,replace:String.prototype.replace,split:String.prototype.split},lib={part:/(?:[^\\([#\s.]+|\\(?!k<[\w$]+>|[pP]{[^}]+})[\S\s]?|\((?=\?(?!#|<[\w$]+>)))+|(\()(?:\?(?:(#)[^)]*\)|<([$\w]+)>))?|\\(?:k<([\w$]+)>|[pP]{([^}]+)})|(\[\^?)|([\S\s])/g,replaceVar:/(?:[^$]+|\$(?![1-9$&`']|{[$\w]+}))+|\$(?:([1-9]\d*|[$&`'])|{([$\w]+)})/g,extended:/^(?:\s+|#.*)+/,quantifier:/^(?:[?*+]|{\d+(?:,\d*)?})/,classLeft:/&&\[\^?/g,classRight:/]/g},indexOf=function(array,item,from){for(var i=from||0;i<array.length;i++)
if(array[i]===item)return i;return-1;},brokenExecUndef=/()??/.exec("")[1]!==undefined,plugins={};XRegExp=function(pattern,flags){if(pattern instanceof RegExp){if(flags!==undefined)
throw TypeError("can't supply flags when constructing one RegExp from another");return pattern.addFlags();}
var flags=flags||"",singleline=flags.indexOf("s")>-1,extended=flags.indexOf("x")>-1,hasNamedCapture=false,captureNames=[],output=[],part=lib.part,match,cc,len,index,regex;part.lastIndex=0;while(match=real.exec.call(part,pattern)){if(match[2]){if(!lib.quantifier.test(pattern.slice(part.lastIndex)))
output.push("(?:)");}else if(match[1]){captureNames.push(match[3]||null);if(match[3])
hasNamedCapture=true;output.push("(");}else if(match[4]){index=indexOf(captureNames,match[4]);output.push(index>-1?"\\"+(index+1)+(isNaN(pattern.charAt(part.lastIndex))?"":"(?:)"):match[0]);}else if(match[5]){output.push(plugins.unicode?plugins.unicode.get(match[5],match[0].charAt(1)==="P"):match[0]);}else if(match[6]){if(pattern.charAt(part.lastIndex)==="]"){output.push(match[6]==="["?"(?!)":"[\\S\\s]");part.lastIndex++;}else{cc=XRegExp.matchRecursive("&&"+pattern.slice(match.index),lib.classLeft,lib.classRight,"",{escapeChar:"\\"})[0];output.push(match[6]+cc+"]");part.lastIndex+=cc.length+1;}}else if(match[7]){if(singleline&&match[7]==="."){output.push("[\\S\\s]");}else if(extended&&lib.extended.test(match[7])){len=real.exec.call(lib.extended,pattern.slice(part.lastIndex-1))[0].length;if(!lib.quantifier.test(pattern.slice(part.lastIndex-1+len)))
output.push("(?:)");part.lastIndex+=len-1;}else{output.push(match[7]);}}else{output.push(match[0]);}}
regex=RegExp(output.join(""),real.replace.call(flags,/[sx]+/g,""));regex._x={source:pattern,captureNames:hasNamedCapture?captureNames:null};return regex;};XRegExp.addPlugin=function(name,o){plugins[name]=o;};RegExp.prototype.exec=function(str){var match=real.exec.call(this,str),name,i,r2;if(match){if(brokenExecUndef&&match.length>1){r2=new RegExp("^"+this.source+"$(?!\\s)",this.getNativeFlags());real.replace.call(match[0],r2,function(){for(i=1;i<arguments.length-2;i++){if(arguments[i]===undefined)match[i]=undefined;}});}
if(this._x&&this._x.captureNames){for(i=1;i<match.length;i++){name=this._x.captureNames[i-1];if(name)match[name]=match[i];}}
if(this.global&&this.lastIndex>(match.index+match[0].length))
this.lastIndex--;}
return match;};})();}
RegExp.prototype.getNativeFlags=function(){return(this.global?"g":"")+(this.ignoreCase?"i":"")+(this.multiline?"m":"")+(this.extended?"x":"")+(this.sticky?"y":"");};RegExp.prototype.addFlags=function(flags){var regex=new XRegExp(this.source,(flags||"")+this.getNativeFlags());if(this._x){regex._x={source:this._x.source,captureNames:this._x.captureNames?this._x.captureNames.slice(0):null};}
return regex;};RegExp.prototype.call=function(context,str){return this.exec(str);};RegExp.prototype.apply=function(context,args){return this.exec(args[0]);};XRegExp.cache=function(pattern,flags){var key="/"+pattern+"/"+(flags||"");return XRegExp.cache[key]||(XRegExp.cache[key]=new XRegExp(pattern,flags));};XRegExp.escape=function(str){return str.replace(/[-[\]{}()*+?.\\^$|,#\s]/g,"\\$&");};XRegExp.matchRecursive=function(str,left,right,flags,options){var options=options||{},escapeChar=options.escapeChar,vN=options.valueNames,flags=flags||"",global=flags.indexOf("g")>-1,ignoreCase=flags.indexOf("i")>-1,multiline=flags.indexOf("m")>-1,sticky=flags.indexOf("y")>-1,flags=flags.replace(/y/g,""),left=left instanceof RegExp?(left.global?left:left.addFlags("g")):new XRegExp(left,"g"+flags),right=right instanceof RegExp?(right.global?right:right.addFlags("g")):new XRegExp(right,"g"+flags),output=[],openTokens=0,delimStart=0,delimEnd=0,lastOuterEnd=0,outerStart,innerStart,leftMatch,rightMatch,escaped,esc;if(escapeChar){if(escapeChar.length>1)throw SyntaxError("can't supply more than one escape character");if(multiline)throw TypeError("can't supply escape character when using the multiline flag");escaped=XRegExp.escape(escapeChar);esc=new RegExp("^(?:"+escaped+"[\\S\\s]|(?:(?!"+left.source+"|"+right.source+")[^"+escaped+"])+)+",ignoreCase?"i":"");}
while(true){left.lastIndex=right.lastIndex=delimEnd+(escapeChar?(esc.exec(str.slice(delimEnd))||[""])[0].length:0);leftMatch=left.exec(str);rightMatch=right.exec(str);if(leftMatch&&rightMatch){if(leftMatch.index<=rightMatch.index)
rightMatch=null;else leftMatch=null;}
if(leftMatch||rightMatch){delimStart=(leftMatch||rightMatch).index;delimEnd=(leftMatch?left:right).lastIndex;}else if(!openTokens){break;}
if(sticky&&!openTokens&&delimStart>lastOuterEnd)
break;if(leftMatch){if(!openTokens++){outerStart=delimStart;innerStart=delimEnd;}}else if(rightMatch&&openTokens){if(!--openTokens){if(vN){if(vN[0]&&outerStart>lastOuterEnd)
output.push([vN[0],str.slice(lastOuterEnd,outerStart),lastOuterEnd,outerStart]);if(vN[1])output.push([vN[1],str.slice(outerStart,innerStart),outerStart,innerStart]);if(vN[2])output.push([vN[2],str.slice(innerStart,delimStart),innerStart,delimStart]);if(vN[3])output.push([vN[3],str.slice(delimStart,delimEnd),delimStart,delimEnd]);}else{output.push(str.slice(innerStart,delimStart));}
lastOuterEnd=delimEnd;if(!global)
break;}}else{left.lastIndex=right.lastIndex=0;throw Error("subject data contains unbalanced delimiters");}
if(delimStart===delimEnd)
delimEnd++;}
if(global&&!sticky&&vN&&vN[0]&&str.length>lastOuterEnd)
output.push([vN[0],str.slice(lastOuterEnd),lastOuterEnd,str.length]);left.lastIndex=right.lastIndex=0;return output;};