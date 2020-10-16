//************GLOAD SCROLL VIEW**************//

function disableScroll() {
    var x = window.scrollX;
    var y = window.scrollY;
    window.onscroll = function() { window.scrollTo(x, y) };
}

function loadPageView() {
    let obj = document.getElementById("loadPage");
    obj.style.display = "block";
    let divObj = '<div class="containerBlock">';
    let arrayText = ["D", "E", "N", "D", "R", "I", "T", "E"];
    for (let i = 0; i < arrayText.length; i++) {
        divObj += '<div class="block">' + arrayText[i] + '</div>';
    }
    divObj += "</div>";
    obj.innerHTML = divObj;
    disableScroll();
}

function enableScroll() {
    window.onscroll = null;
    document.getElementById("loadPage").style.display = "none";
}