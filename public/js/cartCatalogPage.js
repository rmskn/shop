let cart = new Cart()

cart.updateCartQuantity()

const buttonsAddToCart = document.querySelectorAll('#addToCart')
cart.addToCartInCatalog(buttonsAddToCart)
