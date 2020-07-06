// cria um novo elemento html com os atributos passados no segundo parametro
const createElementHTML = (el_name, obj_attr, content = '') => {
    const el_new = document.createElement(el_name);

    if (null !== obj_attr && obj_attr instanceof Object && !(obj_attr instanceof Array)) {

        Object.getOwnPropertyNames(obj_attr).forEach((a) => {

            const attr_new = document.createAttribute(a);
            attr_new.value = obj_attr[a];
            el_new.setAttributeNode(attr_new);

        });

    }

    el_new.innerHTML = content;

    return el_new;
};

const scrollTo = (pointerTop) => {
    window.scroll({
        top: pointerTop,
        left: 0,
        behavior: 'smooth'
    });
}

function collectionHas(a, b) { //helper function (see below)
    for (var i = 0, len = a.length; i < len; i++) {
        if (a[i] == b) return true;
    }
    return false;
}

function getParent(elm, selector) {
    var all = document.querySelectorAll(selector);
    var cur = elm.parentNode;
    while (cur && !collectionHas(all, cur)) { //keep going up until you find a match
        cur = cur.parentNode; //go up
    }
    return cur; //will return null if not found
}

function convertToSlug(text) {
    const a = 'àáäâãèéëêìíïîòóöôùúüûñçßÿœæŕśńṕẃǵǹḿǘẍźḧ·/_,:;'
    const b = 'aaaaaeeeeiiiioooouuuuncsyoarsnpwgnmuxzh------'
    const p = new RegExp(a.split('').join('|'), 'g')
    return text.toString().toLowerCase().trim()
        .replace(p, c => b.charAt(a.indexOf(c))) // Replace special chars
        .replace(/&/g, '-e-') // Replace & with '-e-'
        .replace(/\+/g, '-e-') // Replace + with '-e-'
        .replace(/(\sde\s)/g, '-') // Replace 'de' with '-'
        .replace(/[\s\W-]+/g, '-') // Replace spaces, non-word characters and dashes with a single dash (-)
}

function serialize(form) {
    if (!form || form.nodeName !== "FORM") {
        return
    }
    var i, j, q = [];
    for (i = form.elements.length - 1; i >= 0; i = i - 1) {
        if (form.elements[i].name === "") {
            continue
        }
        switch (form.elements[i].nodeName) {
            case "INPUT":
                switch (form.elements[i].type) {
                    case "text":
                    case "hidden":
                    case "password":
                    case "button":
                    case "reset":
                    case "submit":
                        q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].value));
                        break;
                    case "checkbox":
                    case "radio":
                        if (form.elements[i].checked) {
                            q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].value))
                        }
                        break;
                    case "file":
                        break
                }
                break;
            case "TEXTAREA":
                q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].value));
                break;
            case "SELECT":
                switch (form.elements[i].type) {
                    case "select-one":
                        q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].value));
                        break;
                    case "select-multiple":
                        for (j = form.elements[i].options.length - 1; j >= 0; j = j - 1) {
                            if (form.elements[i].options[j].selected) {
                                q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].options[j].value))
                            }
                        }
                        break
                }
                break;
            case "BUTTON":
                switch (form.elements[i].type) {
                    case "reset":
                    case "submit":
                    case "button":
                        q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].value));
                        break
                }
                break
        }
    }
    return q.join("&")
};


/** Fade effect
 *
*/

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
        function () {
            if ((inc > 0 && alpha >= fin) || (inc < 0 && alpha <= fin)) {
                clearInterval(i);
                callback();
            }
            setAlpha(target, alpha);
            alpha += inc;
        }, timer);
}

function setAlpha(target, alpha) {
    target.style.filter = "alpha(opacity=" + alpha + ")";
    target.style.opacity = alpha / 100;
}

function fadeOut(id, time = 0, callback = null) {
    fade(id, time, 100, 0, callback);
}

function fadeIn(id, time = 0, callback = null) {
    fade(id, time, 0, 100, callback);
}

/** Fade effect
 *
 */

export {
    createElementHTML,
    scrollTo,
    convertToSlug,
    getParent,
    fadeOut,
    fadeIn,
    serialize
};