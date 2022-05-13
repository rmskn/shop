function sort_products() {
    const categories = document.querySelectorAll('#category')
    const products = document.querySelectorAll('#product')

    function getActiveCategories(categories) {
        let activeCategories = []
        categories.forEach((category) => {
            if (category.checked) {
                activeCategories.push(category)
            }
        })
        return activeCategories
    }

    function getCategoriesCodes(categories) {
        let codes = []
        categories.forEach((category) => {
            codes.push(category.dataset.filter)
        })
        return codes
    }

    function getCategoriesOfProduct(product) {
        const categoriesOfProduct = JSON.parse(product.dataset.cat)
        let codes = []
        categoriesOfProduct.forEach((categoryOfProduct) => {
            codes.push(categoryOfProduct['code'])
        })
        return codes
    }

    function filter(categoriesCodes, products) {
        products.forEach((product) => {
            const productCategories = getCategoriesOfProduct(product)

            for (let i = 0; i < productCategories.length; i++) {
                if (categoriesCodes.includes(productCategories[i].toString())) {
                    product.style.display = ""
                    break;
                } else {
                    product.style.display = "none"
                }
            }

        })
    }

    categories.forEach((category) => {
        category.addEventListener('change', () => {
            let categoriesCodes

            if (category.dataset.filter === '0') {
                if (category.checked) {
                    categoriesCodes = getCategoriesCodes(categories)
                    categories.forEach((category) => {
                        if (category.dataset.filter !== '0')
                            category.checked = false
                    })
                } else {
                    categoriesCodes = []
                    categories.forEach((category) => {
                        category.checked = false
                    })
                }
            } else {
                categories.forEach((category) => {
                    if (category.dataset.filter === '0')
                        category.checked = false
                })
                const activeCategories = getActiveCategories(categories)
                categoriesCodes = getCategoriesCodes(activeCategories)
            }

            filter(categoriesCodes, products)
        })
    })
}

sort_products()
