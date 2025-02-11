$(document).ready(function() {
    $(".btn-add").click(function() {
        let btn = $(this);
        let billetId = btn.data("id");
        let billetName = btn.data("name");
        let billetPrice = btn.data("price");

        $.post("index.php?page=add_to_cart", { id: billetId, name: billetName, price: billetPrice }, function(response) {
            let res = JSON.parse(response);
            if (res.status === "success") {
                btn.text("Ajouté ✅").removeClass("btn-primary").addClass("btn-success");
                setTimeout(() => {
                    btn.text("Ajouter au panier 🛒").removeClass("btn-success").addClass("btn-primary");
                }, 2000);
            } else {
                alert("Erreur : " + res.message);
            }
        });
    });
});