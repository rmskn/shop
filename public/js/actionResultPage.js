let lastAction = document.getElementById('lastAction').getAttribute('value')
let status = document.getElementById('status').getAttribute('value')
let actionsToDo = JSON.parse(document.getElementById('actionsToDo').getAttribute('value'))

switch (lastAction) {
    case 'createOrder' :
        actionsToDo.forEach((action) => {
            window[action]()
        })
        break;
}

function clearCart() {
    let cart = new Cart()
    cart.clear()
}
