
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

function genkeywords(){
    var wow = document.getElementById("title");
    var title = wow.value;
    title = title.replace(/[ ]/g, ", ");
    var wow1 = document.getElementById("authors");
    var wow2 = document.getElementById("translator");
    var wow3 = document.getElementById("tags");
    var wowz = document.getElementById("keywords");
    var str = title + ", " + wow1.value + ", " + wow2.value + ", " + wow3.value;
    str = str.replace(", ,", ",");
    str = str.replace(", ,", ",");
    wowz.value = str;
    
}