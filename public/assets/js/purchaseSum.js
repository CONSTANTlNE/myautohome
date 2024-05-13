const purchaseModal = document.getElementById('purchaseModal')

// PURCHASE
purchaseModal.addEventListener('mousemove', function () {
    const purchase_ex_rate = document.getElementById('purchase_ex_rate')
    const purchasePrice = document.querySelectorAll('.purchasePrice')
    const purchaseGEL = document.querySelectorAll('.purchaseGel')
    const totalGEL = document.getElementById('totalGEL')
    const totalCurrency = document.getElementById('totalCurrency')

    if (purchase_ex_rate.value != 0) {

        // Book Price
        for (let i = 0; i < purchasePrice.length; i++) {
            purchaseGEL[i].value = (purchasePrice[i].value * purchase_ex_rate.value).toFixed(2)

            totalGEL.innerHTML += purchaseGEL[i].value
        }


        // Invoice Subtotals
        let subtotalCurrency = 0;
        purchasePrice.forEach(function (element) {
            subtotalCurrency += parseFloat(element.value) || 0;
        });

        totalCurrency.innerHTML = Number(subtotalCurrency.toFixed(2));

        let subtotalGel = 0;
        purchaseGEL.forEach(function (element) {
            subtotalGel += parseFloat(element.value) || 0;
        });
        totalGEL.innerHTML = Number(subtotalGel.toFixed(2));

    }

})

purchaseModal.addEventListener('keyup', function () {
    const purchase_ex_rate = document.getElementById('purchase_ex_rate')
    const purchasePrice = document.querySelectorAll('.purchasePrice')
    const purchaseGEL = document.querySelectorAll('.purchaseGel')
    const totalGEL = document.getElementById('totalGEL')
    const totalCurrency = document.getElementById('totalCurrency')

    if (purchase_ex_rate.value != 0) {

        // Book Price
        for (let i = 0; i < purchasePrice.length; i++) {
            purchaseGEL[i].value = (purchasePrice[i].value * purchase_ex_rate.value).toFixed(2)

            totalGEL.innerHTML += purchaseGEL[i].value
        }


        // Invoice Subtotals
        let subtotalCurrency = 0;
        purchasePrice.forEach(function (element) {
            subtotalCurrency += parseFloat(element.value) || 0;
        });

        totalCurrency.innerHTML = Number(subtotalCurrency.toFixed(2));

        let subtotalGel = 0;
        purchaseGEL.forEach(function (element) {
            subtotalGel += parseFloat(element.value) || 0;
        });
        totalGEL.innerHTML = Number(subtotalGel.toFixed(2));

    }

})
