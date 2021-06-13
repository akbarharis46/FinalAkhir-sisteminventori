
function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    var u = ev.target.id;
    var i = u.substr(0,1);
    if (i!="g") {
     ev.target.appendChild(document.getElementById(data));
    };
}