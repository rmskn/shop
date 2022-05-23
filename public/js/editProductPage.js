let categoriesElements = document.querySelectorAll('#category')
let categoriesOfProduct = JSON.parse(document.getElementById('oldCategoriesOfProduct').getAttribute('value'))

let categories = []
categoriesElements.forEach((cat) => {
    categoriesOfProduct.forEach((catProduct) => {
        if (catProduct['code'] == cat.dataset.cat) {
            cat.checked = true
        }
    })
})

let removeImageButtons = document.querySelectorAll('#removeImage')
removeImageButtons.forEach((button) => {
    button.addEventListener('click', () => {
        button.parentElement.style.display = 'none'
    })
})

let newCategoriesOfProduct = document.getElementById('newCategoriesOfProduct')
newCategoriesOfProduct.setAttribute('value', categoriesOfProduct)

let submitButton = document.getElementById('submitButton')

submitButton.addEventListener('click', () => {
    let newCat = []
    categoriesElements.forEach((cat) => {
        if (cat.checked) {
            newCat.push(cat.dataset.cat)
        }
    })
    newCategoriesOfProduct.setAttribute('value', JSON.stringify(newCat))

    let oldImages = []

    removeImageButtons.forEach((button) => {
        if (button.parentElement.style.display !== 'none') {
            oldImages.push(button.getAttribute('value'))
        }
    })

    document.getElementById('oldImagesOfProduct').setAttribute('value', JSON.stringify(oldImages))
})
