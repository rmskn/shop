let cart = new Cart()

cart.generateCartPage()

let buttonsIncreaseCount = document.querySelectorAll('#increaseCountButton')
let buttonsDecreaseCount = document.querySelectorAll('#decreaseCountButton')
let buttonsRemoveProductFromCart = document.querySelectorAll('#removeProductFromCart')
let buttonConfirmOrder = document.getElementById('confirmOrder')

cart.updateCartQuantity()

buttonsIncreaseCount.forEach((button) => {
    button.addEventListener('click', () => {
        cart.increaseCountProduct(button)
        cart.updateConfirmOrderForm()
    })
})

buttonsDecreaseCount.forEach((button) => {
    button.addEventListener('click', () => {
        cart.decreaseCountProduct(button)
        cart.updateConfirmOrderForm()
    })
})

buttonsRemoveProductFromCart.forEach((button) => {
    button.addEventListener('click', () => {
        cart.removeProductFromCart(button)
        cart.updateConfirmOrderForm()
    })
})

// buttonConfirmOrder.addEventListener('click', () => {
//     //cart.confirmOrder()
// })
