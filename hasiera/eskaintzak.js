document.addEventListener("DOMContentLoaded", () => {

    const apiUrl = "http://localhost/Erronka_01/api/eskaintzak/";
    const container = document.getElementById("eskaintzak-container");

    fetch(apiUrl)
        .then(response => response.json())
        .then(data => {

            container.innerHTML = "";

            if (!Array.isArray(data) || data.length === 0) {
                container.innerHTML = "<p>Ez dago eskaintzarik momentuz.</p>";
                return;
            }

            data.forEach(t => {
                const div = document.createElement("div");
                div.classList.add("featured-item");

                div.innerHTML = `
                    <a href="../katalogoa/taldea_erakutsi.php?id=${t.id}">
                        <img src="img/taldeak/${t.talde_izena}.png" 
                             alt="${t.talde_izena}">
                        <p>${t.talde_izena}</p>
                    </a>
                `;

                container.appendChild(div);
            });

        })
        .catch(err => {
            container.innerHTML = "<p>Errorea eskaintzak kargatzean.</p>";
            console.error("API error:", err);
        });

});
