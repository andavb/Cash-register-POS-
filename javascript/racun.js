function nWin() {
var w = window.open();
var html = document.getElementById("toNewWindow").innerHTML;


w.document.body.innerHTML = html;
w.print();

}
