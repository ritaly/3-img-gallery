
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>My Gallery</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <link rel="stylesheet" href="./style.css">
        <script type="text/javascript">
            var p = 0;
            var iPP = 3;
            var xmlhttp;
            

            function getImages(page, itemsPerPage) {
                var url = "http://wzoryikolory.pl/studia/AJAX/images.php";              
                var vars = "page="+page+'&itemsPerPage='+itemsPerPage;
               
                p=page;
                iPP=itemsPerPage;
                next=p+1;
                prev=p-1;
                
                if (page == 0) {
                    document.getElementById("navigation").innerHTML = "<span class='btn default prev'>Prev</span> - <a href='javascript:getImages(next,iPP);'><span class='btn activ next'>Next</span></a>"
                } else if (page == 4) {
                    document.getElementById("navigation").innerHTML = "<a href='javascript:getImages(prev,iPP);'><span class='btn activ prev'>Prev</span></a> - <span class='btn default next'>Next</span>"
                }
                else {
                    document.getElementById("navigation").innerHTML = "<a href='javascript:getImages(prev,iPP);'><span class='btn activ prev'>Prev</span></a> - <a href='javascript:getImages(next,iPP);'><span class='btn activ next'>Next</span></a>"
                }
                xmlhttp=null;
                
                // The code below makes XMLHttpRequest work in Internet Explorer 5.0, 5.5, and 6.0 as well.
                // Note: Since it already works in Firefox, Safari, Opera, and Internet Explorer 7.0, this means it works everywhere now.
                if (!window.XMLHttpRequest && window.ActiveXObject) {
                    window.XMLHttpRequest = function () {
                        xmlhttp=new ActiveXObject(navigator.userAgent.indexOf("MSIE 5") != -1 ? "Microsoft.XMLHTTP" : "MSXML2.XMLHTTP");
                    };
                } else {
                    xmlhttp=new XMLHttpRequest();
                }
                //end for IE
                
                if (xmlhttp!=null) {
                    url = url+'?'+vars;
                    xmlhttp.onreadystatechange=onStateChange;
                    //document.getElementById("test").innerHTML = url;
                    xmlhttp.open("GET", url, true);
                    xmlhttp.overrideMimeType('text/xml');
                    xmlhttp.send();                 

                } else {
                    alert("The XMLHttpRequest not supported");
                }
            }
            

            function onStateChange() {
                if (xmlhttp.readyState==4) {    // 4 => loaded complete
                    if (xmlhttp.status==200) {    // HTTP status code  ( 200 => OK )

                        var xmlDoc=xmlhttp.responseXML;

                        var myContent = "<div class='row'>";
                        for (i = 0; i < xmlDoc.getElementsByTagName('Image').length; i++) {

                            imageXML=xmlDoc.getElementsByTagName('Image')[i];

//                          alert(imageXML.getElementsByTagName("Image")[0].firstChild.nodeValue);
                            myContent += "<div class='col-xs-4'><img src='"+imageXML.childNodes[0].nodeValue+"' class='img-responsive' /></div>";

                        }
                        myContent += "</div>";
                        document.getElementById("imageContainer").innerHTML = myContent;
                        
                       // var node1=xmlDoc.getElementsByTagName('data')[0].firstChild.nodeValue;

                    }
                } else {
                    //alert("statusText: " + xmlhttp.statusText + "\nHTTP status code: " + xmlhttp.status);
        }  // End of:   if (xmlhttp.status==200)
            }
        </script>
    </head>
    <body>
        <div class="container">
            <h1>My gallery</h1>
            <input type="button" class="btn btn-info" value="Let's do it!" onClick="javascript:getImages(0,3);">

<?php

    // TODO: Interface to show images.
    // Note: Design doesn't matter, your code does.

?>

        <div id="imageContainer">
        </div>
        <div id="navigation"></div>
    </div>

    <div id="test"></div>
    </body>
</html>

