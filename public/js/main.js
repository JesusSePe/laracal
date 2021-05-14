function imgError(image) {
    image.onerror = "";
    image.src = "https://discord.com/assets/f8389ca1a741a115313bede9ac02e2c0.svg";
    return true;
}
function calendarName(user) {
    let url = window.location.href;
    let site = url.split("/");
    let guild = (site[site.length - 1]);
    let title = document.getElementById("title");
    if (guild == 'dm') {
        title.innerHTML = "Mostrando eventos privados de " + user;
    } else {
        let servers = JSON.parse(localStorage.getItem("servers"));
        for (i = 0; i<servers.length; i++){if (servers[i]['id'] == guild) { var name = servers[i]['name']}}
        title.innerHTML = "Mostrando eventos del servidor " + name;
    }
}
