function libraryadd(str)
{
    var xmlhttp;
    if (str == "")
    {
        document.getElementById("txthint").innerHTML = "";
        return;
    }
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else
    {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function ()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            document.getElementById("txthint").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "http://localweb/codeIgniter/index.php/book/libraryadd/" + str, true);
    xmlhttp.send();
}
function libraryremove(str)
{
    var xmlhttp;
    if (str == "")
    {
        document.getElementById("txthint").innerHTML = "";
        return;
    }
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else
    {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function ()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            document.getElementById("txthint").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "http://localweb/codeIgniter/index.php/book/libraryremove/" + str, true);
    xmlhttp.send();
}

function windowsize()
{
    document.getElementById("demo").innerHTML = "Screen Width: " + document.body.clientWidth;
}