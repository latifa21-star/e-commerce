<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- resources/views/partials/add_to_cart_modal.blade.php -->
    <div class="modal fade" id="addToCartModal" tabindex="-1" aria-labelledby="addToCartModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addToCartModalLabel">Ajouter au Panier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulaire et fonctionnalités comme dans la photo -->
                    <form>
                        <!-- Champ de quantité -->
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantité</label>
                            <input type="number" class="form-control" id="quantity" min="1" value="1">
                        </div>
                        <!-- Bouton pour ajouter au panier -->
                        <button type="button" class="btn btn-primary" onclick="addToCart()">Ajouter au panier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript pour gérer le modal -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Sélectionne tous les boutons "Ajouter au Panier"
            const addToCartButtons = document.querySelectorAll(".add-to-cart");

            addToCartButtons.forEach(button => {
                button.addEventListener("click", function() {
                    // Mettre à jour le contenu du modal avec le nom du produit, si nécessaire
                    const modalTitle = document.querySelector("#addToCartModalLabel");
                    const productName = this.getAttribute("data-product-name");

                    // Mettre à jour le titre du modal avec le nom du produit
                    if (productName && modalTitle) {
                        modalTitle.textContent = `Ajouter ${productName} au Panier`;
                    }

                    // Réinitialiser la quantité dans le modal
                    const quantityInput = document.querySelector("#quantity");
                    if (quantityInput) {
                        quantityInput.value = 1;
                    }

                    // Ouvre le modal manuellement
                    const addToCartModal = new bootstrap.Modal(document.getElementById("addToCartModal"));
                    addToCartModal.show();
                });
            });
        });

        // Fonction à exécuter quand on clique sur "Ajouter au panier" dans le modal
        function addToCart() {
            const quantity = document.getElementById("quantity").value;
            alert(`Produit ajouté au panier avec une quantité de ${quantity}`);
        }
    </script>
</body>
</html>
