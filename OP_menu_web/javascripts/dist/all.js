var referralUrl = Cookies.get("original_landing_page_url");
referralUrl || Cookies.set("original_landing_page_url", window.location.href, {
    expires: 365
}), window.onload = function() {
    var e = document.querySelectorAll(".browse li"),
        r = [];
    removeActiveClasses = function(e) {
        for (var r in e) e[r].className = e[r].className.replace(/(?:^|\s)active(?!\S)/g, "")
    };
    for (var a in e) e.hasOwnProperty(a) && (e[a].addEventListener("click", function() {
        event.preventDefault()
    }), e[a].addEventListener("mouseover", function() {
        r = [document.querySelector(".browse__menu .active"), document.querySelector(".browse__gallery .active")], removeActiveClasses(r), galleryToChange = document.querySelector(".browse__gallery ." + this.className), galleryToChange.className += " active", this.className += " active"
    }))
};