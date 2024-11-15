<!-- productDetailsModal.blade.php -->
<div class="modal fade" id="productDetailsModal{{ $product->id }}" tabindex="-1" aria-labelledby="productDetailsModalLabel{{ $product->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productDetailsModalLabel{{ $product->id }}">{{ $product->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded">
                    </div>
                    <div class="col-md-6">
                        <h4>Détails du produit</h4>
                        <p class="product-description">{{ $product->description }}</p>
                        <div class="product-info">
                            <p><strong>Prix:</strong> {{ $product->price }} MAD</p>
                            <p><strong>Catégorie:</strong> {{ $product->category->name }}</p>
                            <!-- Ajoutez d'autres détails du produit ici -->
                        </div>
                        <button class="btn btn-primary add-to-cart-btn" data-bs-toggle="modal" data-bs-target="#addToCartModal">
                            <i class="fas fa-shopping-bag"></i> Ajouter au panier
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.modal-content {
    border-radius: 15px;
}

.modal-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
}

.product-description {
    margin: 20px 0;
    line-height: 1.6;
    color: #666;
}

.product-info {
    margin: 20px 0;
}

.add-to-cart-btn {
    width: 100%;
    padding: 12px;
    margin-top: 20px;
}

.modal-body img {
    max-height: 400px;
    width: 100%;
    object-fit: cover;
}
</style>