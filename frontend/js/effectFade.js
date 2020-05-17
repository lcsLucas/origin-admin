export function fadeOut(id, time=0, callback=null) {
    fade(id, time, 100, 0, callback);
}

export function fadeIn(id, time=0, callback=null) {
    fade(id, time, 0, 100, callback);
}

function fade(id, time, ini, fin, callback) {
    var target = document.querySelector(id);
    var alpha = ini;
    var inc;
    if (fin >= ini) {
        inc = 2;
    } else {
        inc = -2;
    }
    let timer = (time * 1000) / 50;
    var i = setInterval(
        function() {
            if ((inc > 0 && alpha >= fin) || (inc < 0 && alpha <= fin)) {
                clearInterval(i);
                callback();
            }
            setAlpha(target, alpha);
            alpha += inc;
        }, timer);
}

function setAlpha(target, alpha) {
    target.style.filter = "alpha(opacity="+ alpha +")";
    target.style.opacity = alpha/100;
}