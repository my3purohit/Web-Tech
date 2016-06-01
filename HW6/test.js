

var sunsetTime = "1445217433";
var myDate = new Date(sunsetTime * 1000);
document.write(myDate.toGMTString() + "<br>" + myDate.toLocaleString());
