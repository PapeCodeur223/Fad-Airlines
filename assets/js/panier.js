document.addEventListener("DOMContentLoaded", function() {
    let boutonsAcheter = document.querySelectorAll(".acheter");

    boutonsAcheter.forEach(button => {
        button.addEventListener("click", function() {
            let billet = this.closest(".billet");
            let idBillet = this.getAttribute("data-id");

            // Animation d'ajout au panier
            let clone = billet.cloneNode(true);
            clone.style.position = "absolute";
            clone.style.opacity = "0.5";
            clone.style.transition = "all 0.8s ease-in-out";
            document.body.appendChild(clone);

            let rect = billet.getBoundingClientRect();
            clone.style.top = `${rect.top}px`;
            clone.style.left = `${rect.left}px`;

            setTimeout(() => {
                clone.style.top = "10px";
                clone.style.left = "90%";
                clone.style.opacity = "0";
            }, 100);

            setTimeout(() => {
                document.body.removeChild(clone);
            }, 900);

            // AJAX pour ajouter au panier
            fetch("index.php?page=cart")
                .then(response => response.text())
                .then(data => {
                    document.getElementById("panier-count").textContent = `Panier (${data})`;
                })
                .catch(error => console.error("Erreur:", error));
        });
    });
});
