let reorderButtons = document.querySelectorAll('#reorder')

reorderButtons.forEach((button) => {
    button.addEventListener('click', () => {
        let orderId = button.getAttribute('value')
        let orderProducts = JSON.parse(document.getElementById(`orderProducts${orderId}`).getAttribute('value'))

        let productsToCart = []
        let cartQuantity = 0
        orderProducts.forEach((product) => {
            let productToCart = []
            productToCart['title'] = product['title']
            productToCart['price'] = product['priceInDb']
            productToCart['count'] = product['count']
            productToCart['image'] = JSON.parse(product['pictures'])[0]
            productsToCart[product['id']] = productToCart
            cartQuantity += product['count']
        })

        cart.addToCartReorder(productsToCart, cartQuantity)


    })
})
