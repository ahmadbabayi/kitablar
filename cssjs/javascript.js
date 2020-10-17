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
    xmlhttp.open("GET", "http://kitablar.org/book/libraryadd/" + str, true);
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
    xmlhttp.open("GET", "http://kitablar.org/book/libraryremove/" + str, true);
    xmlhttp.send();
}

function windowsize()
{
    document.getElementById("demo").innerHTML = "Screen Width: " + document.body.clientWidth;
}
function showuploadgif()
{
    var wow = document.getElementById("loadergif");
    wow.style.display = "block";
}


function submitform() {
    document.getElementById("form1").submit();
}

function interfocus(event, number)
{
    if (event.keyCode == 13)
    {
        var wow = document.getElementById(number);
        wow.focus();
        wow.select();
    }
}

function ajaxwordadd(str) {
    var latin = document.getElementById("hin1").value;
    var arab = document.getElementById("hin2").value;
    var res1 = encodeURI(latin);
    var res2 = encodeURI(arab);

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200 && latin != '' && arab != '') {
            document.getElementById("txthint").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", str + "main/wordadd/" + res1 + "/" + res2, true);
    xhttp.send();
    var wow = document.getElementById("hiddenform");
    wow.style.display = "none";
}

function openmenu() {
        var wow = document.getElementById("hiddenform");
        var wow2 = document.getElementById("hin1");
        wow.style.display = "block";
        wow2.focus();
        wow2.select();
}

function closeform() {
        var wow = document.getElementById("hiddenform");
        wow.style.display = "none";
}

function selecttext(tagid) {
        var wow = document.getElementById(tagid);
        wow.select();
        document.execCommand('copy');
}