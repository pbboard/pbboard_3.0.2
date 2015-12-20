function ResizeIt(what,max_Width,max_Height){var imgHeight;var imgWidth;var imgResize=lang_Resize;maxHeight=max_Height;maxWidth=max_Width;imgWidth=what.width;imgHeight=what.height;resize=0;if(maxWidth<1||maxHeight<1){return false;}
widthorig=what.width;heightorig=what.height;if(parseInt(what.width)>maxWidth){what.height=(maxHeight/what.width)*what.height;what.width=maxWidth;resize=1;}
if(parseInt(what.height)>maxHeight){what.height=(maxHeight/what.width)*what.height;what.height=maxHeight;resize=1;}
if(resize==0){document.getElementById(what.alt).style.display='none';}}