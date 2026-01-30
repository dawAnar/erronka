function eskariaBidali() {
    let izena = document.getElementById('izena').value.trim();
    let abizena = document.getElementById('abizena').value.trim();
    let helbidea = document.getElementById('helbidea').value.trim();
    let herria = document.getElementById('herria').value.trim();
    let postaKodea = document.getElementById('postaKodea').value.trim();
    let probintzia = document.getElementById('probintzia').value.trim();
    let emaila = document.getElementById('emaila').value.trim();

    if (izena === "" || abizena === "" || helbidea === "" || herria === "" || postaKodea === "" || probintzia === "" || emaila === "") {
        alert("Eremu guztiak bete behar dira");
        return false;
    }

    let httpRequest = new XMLHttpRequest();
    httpRequest.open("POST", "index.php", true);
    httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    httpRequest.onreadystatechange = function () {
        if (httpRequest.readyState === 4) {
            if (httpRequest.status === 200) {
                document.getElementById('eskaria').innerHTML = this.responseText;
            } else {
                alert("Falla komunikazioa: " + this.statusText);
            }
        }
    };

    httpRequest.send(
        "confirm=1" +
        "&izena=" + encodeURIComponent(izena) +
        "&abizena=" + encodeURIComponent(abizena) +
        "&helbidea=" + encodeURIComponent(helbidea) +
        "&herria=" + encodeURIComponent(herria) +
        "&postaKodea=" + encodeURIComponent(postaKodea) +
        "&probintzia=" + encodeURIComponent(probintzia) +
        "&emaila=" + encodeURIComponent(emaila)
    );

    return false;
}
