var ban = document.querySelector("header");
window.onscroll = function() {
    if (document.body.scrollTop > 10 || document.documentElement.scrollTop > 10)
        ban.style.backgroundPosition = "bottom";
    else
        ban.style.backgroundPosition = "top";
};