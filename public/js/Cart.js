class Cart {
    constructor() {
    }

    getMapByLocalStorageJson(key) {
        return new Map(Object.entries(JSON.parse(localStorage[key])))
    }

    setMapToLocalStorageJson(map, key) {
        let obj = Object.fromEntries(map)
        localStorage.setItem(key, JSON.stringify(obj))
        //this.updateConfirmOrderForm()
    }

    updateConfirmOrderForm() {
        document.getElementById('postCart').setAttribute('value', localStorage['cart'])
    }

    getObjectProductByCatalog(button) {
        return {
            title: button.parentElement
                .parentElement
                .getElementsByClassName('productTitle')[0]
                .getAttribute('id'),
            price: button.parentElement
                .parentElement
                .getElementsByClassName('productPrice')[0]
                .getAttribute('id'),
            count: 1,
            image: button.parentElement
                .parentElement.getElementsByClassName('productImage')[0]
                .getElementsByTagName('img')[0]
                .getAttribute('value'),
        }
    }

    updateCartQuantity() {
        let spanCartQuantity = document.getElementById('cartQuantity');
        if ((typeof localStorage['cartQuantity'] !== 'undefined') && (!isNaN(localStorage['cartQuantity']))) {
            spanCartQuantity.innerHTML = localStorage['cartQuantity']
        } else {
            spanCartQuantity.innerHTML = '0'
        }
        if (isNaN(localStorage['cartQuantity']) || (localStorage['cartQuantity'] < 0)) {
            localStorage['cartQuantity'] = 0
        }
    }

    addToCartInCatalog(buttonsAddToCart) {
        buttonsAddToCart.forEach((button) => {
            button.addEventListener('click', () => {
                let itemId = button.getAttribute('value')

                if (typeof localStorage['cart'] !== 'undefined') {
                    let cart = this.getMapByLocalStorageJson('cart')

                    if (cart.has(itemId)) {
                        cart.set(itemId, {...cart.get(itemId), count: cart.get(itemId).count + 1})
                    } else {
                        cart.set(itemId, this.getObjectProductByCatalog(button))
                    }

                    this.setMapToLocalStorageJson(cart, 'cart')
                    localStorage.setItem('cartQuantity', parseInt(localStorage.getItem('cartQuantity')) + 1)
                } else {
                    let cart = new Map([
                        [itemId, this.getObjectProductByCatalog(button)]
                    ])

                    this.setMapToLocalStorageJson(cart, 'cart')
                    localStorage.setItem('cartQuantity', '1')
                }

                this.updateCartQuantity()

                //console.log(localStorage)

            })
        })

        //localStorage.clear()
    }

    generateEmptyCartPage() {
        let parentContainerProducts = document.getElementById('productsList')
        let parentContainerOrderParam = document.getElementById('orderParam')
        parentContainerProducts.innerHTML = "<div class=\"d-flex justify-content-between align-items-center mb-5\">" +
            "<h1 class=\"fw-bold mb-0 text-black\">Shopping Cart</h1>" +
            "<h6 class=\"mb-0 text-muted\">0 items</h6>" +
            "</div>"
        parentContainerProducts.innerHTML += "<hr class=\"my-4\">" +
            "<div class=\"pt-5\">" +
            "<h6 class=\"mb-0\"><a href=\"catalog\" class=\"text-body\">" +
            "<i class=\"fas fa-long-arrow-alt-left me-2\"></i>Back to catalog</a></h6>" +
            "</div>"

        parentContainerOrderParam.innerHTML = "<h3 class=\"fw-bold mb-5 mt-2 pt-1\">Summary</h3>" +
            "<hr class=\"my-4\">" +
            "<div class=\"d-flex justify-content-between mb-4\">" +
            `    <h5 class=\"text-uppercase\" id=\"orderSectionHeaderCounter\">items 0</h5>` +
            `    <h5 id=\"orderSectionTotalPrice\">₽ 0</h5>` +
            "</div>"
    }

    generateCartPage() {
        try {
            let cart = this.getMapByLocalStorageJson('cart')
            let cartQuantity = localStorage['cartQuantity']
        } catch (e) {
            this.generateEmptyCartPage()
            return null
        }

        let cart = this.getMapByLocalStorageJson('cart')
        let cartQuantity = localStorage['cartQuantity']

        let parentContainerProducts = document.getElementById('productsList')
        let parentContainerOrderParam = document.getElementById('orderParam')

        if (cart.size === 0) {
            this.generateEmptyCartPage()
            return null
        } else {
            parentContainerProducts.innerHTML = "<div class=\"d-flex justify-content-between align-items-center mb-5\"'>" +
                "<h1 class=\"fw-bold mb-0 text-black\">Shopping Cart</h1>" +
                `<h6 class=\"mb-0 text-muted\" id=\"productsSectionHeaderCounter\">${cartQuantity} items</h6>` +
                "</div>"
        }

        let totalPrice = 0

        cart.forEach((product, productId) => {
            parentContainerProducts.innerHTML += "<div class=\"row mb-4 d-flex justify-content-between align-items-center\">" +
                `    <div class=\"col-md-2 col-lg-2 col-xl-1\" id=\"productId\" value=\"${productId}\">` +
                `        <h6 class=\"text-black mb-0\">${productId}</h6>` +
                "    </div>" +
                "    <div class=\"col-md-2 col-lg-2 col-xl-2\">" +
                `        <img src=\"images/Products/${productId}/${product.image}" class=\"img-fluid rounded-3\" alt=\"Cotton T-shirt\">` +
                "    </div>" +
                "    <div class=\"col-md-3 col-lg-3 col-xl-3\">" +
                `        <h6 class=\"text-black mb-0\">${product.title}</h6>` +
                "    </div>" +
                `    <div class=\"col-md-3 col-lg-3 col-xl-2 d-flex\">` +
                "        <button class=\"btn btn-link px-2\" id=\"decreaseCountButton\">" +
                "            <i class=\"fas fa-minus\" aria-hidden=\"true\"></i>" +
                "        </button>" +
                `        <input id=\"form1\" min=\"1\" name=\"quantity\" value=\"${product.count}\" type=\"number\" class=\"form-control form-control-sm\" readonly>` +
                "        <button class=\"btn btn-link px-2\" id=\"increaseCountButton\">" +
                "            <i class=\"fas fa-plus\" aria-hidden=\"true\"></i>" +
                "        </button>" +
                "    </div>" +
                "    <div class=\"col-md-3 col-lg-2 col-xl-2 offset-lg-1\" id=\"productPrice\"'>" +
                `        <h6 class=\"mb-0\">₽ ${product.price * product.count}</h6>` +
                "    </div>" +
                "    <div class=\"col-md-1 col-lg-1 col-xl-1 text-end\">" +
                "        <a role=\"button\" id=\"removeProductFromCart\" class=\"text-muted\"><i class=\"fas fa-times\" aria-hidden=\"true\"></i></a>" +
                "    </div>" +
                "</div>"
            totalPrice += parseInt(product.price) * parseInt(product.count)
        })

        parentContainerProducts.innerHTML += "<hr class=\"my-4\">" +
            "<div class=\"pt-5\">" +
            "<h6 class=\"mb-0\"><a href=\"catalog\" class=\"text-body\">" +
            "<i class=\"fas fa-long-arrow-alt-left me-2\"></i>Back to catalog</a></h6>" +
            "</div>"

        parentContainerOrderParam.innerHTML = "<h3 class=\"fw-bold mb-5 mt-2 pt-1\">Summary</h3>" +
            "<hr class=\"my-4\">" +
            "<div class=\"d-flex justify-content-between mb-4\">" +
            `    <h5 class=\"text-uppercase\" id=\"orderSectionHeaderCounter\">items ${cartQuantity}</h5>` +
            `    <h5 id=\"orderSectionTotalPrice\">₽ ${totalPrice}</h5>` +
            "</div>"

        let cartToPost = localStorage['cart']
        let token = document.querySelector('meta[name="csrf-token"]').content

        parentContainerOrderParam.innerHTML += "<form method='post' action='create-order'>" +
            `<input id='postCart' name='cart' value='${cartToPost}' hidden>` +
            `<input type="hidden" name="_token" value="${token}">` +
            "<button type=\"submit\" class=\"btn btn-dark btn-block btn-lg\"" +
            "        data-mdb-ripple-color=\"dark\" id=\"confirmOrder\"'>Confirm" +
            "</button></form>"

        localStorage['totalPrice'] = totalPrice
    }

    updateCountInCart(productId, newCountDif) {
        let cart = this.getMapByLocalStorageJson('cart')

        cart.set(productId, {...cart.get(productId), count: cart.get(productId).count + newCountDif})

        this.setMapToLocalStorageJson(cart, 'cart')
        localStorage.setItem('cartQuantity', parseInt(localStorage.getItem('cartQuantity')) + newCountDif)

        this.updateCartQuantity()
    }

    updateProductBlock(button, productId) {
        let cart = this.getMapByLocalStorageJson('cart')
        let cost = parseInt(cart.get(productId).count) * parseInt(cart.get(productId).price)

        button.parentNode.parentElement.querySelector('#productPrice').innerHTML = `<h6 class=\"mb-0\">₽ ${cost}</h6>`;
    }

    removeProductBlock(button) {
        button.parentElement.parentElement.style.setProperty('display', 'none', 'important')
    }

    removeConfirmButton() {
        document.getElementById('confirmOrder').style.setProperty('display', 'none', 'important')
    }

    updateProductsSectionHeader() {
        let cartQuantity = localStorage['cartQuantity']
        document.getElementById('productsSectionHeaderCounter').innerHTML = `${cartQuantity} items`;
    }

    updateOrderSectionHeader() {
        let cartQuantity = localStorage['cartQuantity']

        document.getElementById('orderSectionHeaderCounter').innerHTML = `items ${cartQuantity}`;

        let totalPrice = this.calculateTotalPrice()

        localStorage['totalPrice'] = totalPrice
        document.getElementById('orderSectionTotalPrice').innerHTML = `₽ ${totalPrice}`;
    }

    calculateTotalPrice() {
        let cart = this.getMapByLocalStorageJson('cart')
        let totalPrice = 0

        cart.forEach((product) => {
            totalPrice += parseInt(product.price) * parseInt(product.count)
        })

        return totalPrice
    }

    increaseCountProduct(button) {
        button.parentNode.querySelector('input[type=number]').stepUp()
        let productId = button.parentNode.parentElement.querySelector('#productId').getAttribute('value')

        this.updateCountInCart(productId, 1)
        this.updateProductBlock(button, productId)
        this.updateProductsSectionHeader()
        this.updateOrderSectionHeader()
    }

    decreaseCountProduct(button) {
        if (button.parentNode.querySelector('input').valueAsNumber === 1) {
            return null
        }
        button.parentNode.querySelector('input[type=number]').stepDown()
        let productId = button.parentNode.parentElement.querySelector('#productId').getAttribute('value')

        this.updateCountInCart(productId, -1)
        this.updateProductBlock(button, productId)
        this.updateProductsSectionHeader()
        this.updateOrderSectionHeader()
    }

    removeProductFromCart(button) {
        let productId = button.parentNode.parentElement.querySelector('#productId').getAttribute('value')

        let cart = this.getMapByLocalStorageJson('cart')
        let product = cart.get(productId)

        this.updateCountInCart(productId, -parseInt(product.count))

        cart.delete(productId)

        this.setMapToLocalStorageJson(cart, 'cart')

        this.updateProductsSectionHeader()
        this.updateOrderSectionHeader()

        this.removeProductBlock(button)

        if (cart.size === 0) {
            this.removeConfirmButton()
        }
    }

    confirmOrder() {
        // let xhr = new XMLHttpRequest();
        //
        // let body = 'cart'//localStorage['cart']
        //
        // xhr.open("POST", '/create-order', true);
        // xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        // xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content)
        //
        // xhr.send(body);
        //
        // xhr.onload = function() {
        //
        //     console.log(`Загружено: ${xhr.status} ${xhr.response}`);
        // };
    }

    clear() {
        localStorage.clear()
    }

    convertObjectToMap(obj) {
        let entries = Object.entries(obj)
        let map = new Map()
        entries.forEach((value) => {
            map.set(value[0], value[1])
        })
        return map
    }

    addToCartReorder(products, cartQuantity) {
        this.clear()
        let cart = new Map()
        products.forEach((product, productId) => {
            cart.set(productId, Object.fromEntries(this.convertObjectToMap(product)))
        })

        this.setMapToLocalStorageJson(cart, 'cart')
        localStorage.setItem('cartQuantity', cartQuantity)

        window.location.replace("cart");
    }
}
