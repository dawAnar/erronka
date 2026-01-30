function mezuaBidali() {
    let izena = document.getElementById('izena').value.trim();
    let email = document.getElementById('email').value.trim();
    let mezua = document.getElementById('mezua_testua').value.trim();

    if (izena === "" || email === "" || mezua === "") {
        alert("Eremu guztiak bete behar dira");
        return;
    }

    // XMLHttpRequest sortu
    let httpRequest = new XMLHttpRequest();

    // konfiguratu
    httpRequest.open("POST", "index.php", true);
    httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    // zerbitzariaren erantzuna jaso
    httpRequest.onreadystatechange = function () {
        if (httpRequest.readyState === 4) {

            if (httpRequest.status === 200) {
                // formulua ordezkatu zerbitzariaren erantzunarekin
                document.getElementById('mezua').innerHTML = this.responseText;

            } else {
                alert("Falla komunikazioa: " + this.statusText);
            }
        }
    };

    // bidali datuak
    httpRequest.send(
        "izena=" + encodeURIComponent(izena) +
        "&email=" + encodeURIComponent(email) +
        "&mezua=" + encodeURIComponent(mezua)
    );
}
