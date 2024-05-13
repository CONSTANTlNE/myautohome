
const salesModal = document.getElementById('salesModal')

salesModal.addEventListener('mousemove', function () {
    const sales_ex_rate = document.getElementById('purchase_ex_rate2')
    const salesPrice = document.querySelectorAll('.salesPrice')
    const salesGEL = document.querySelectorAll('.salesGel')
    const totalGEL = document.getElementById('totalGEL2')
    const totalCurrency = document.getElementById('totalCurrency2')

    if (sales_ex_rate.value != 0) {

        // Book Price
        for (let i = 0; i < salesPrice.length; i++) {
            salesGEL[i].value = (salesPrice[i].value * sales_ex_rate.value).toFixed(2)

            totalGEL.innerHTML += salesGEL[i].value
        }


        // Invoice Subtotals
        let subtotalCurrency = 0;
        salesPrice.forEach(function (element) {
            subtotalCurrency += parseFloat(element.value) || 0;
        });

        totalCurrency.innerHTML = Number(subtotalCurrency.toFixed(2));

        let subtotalGel = 0;
        salesGEL.forEach(function (element) {
            subtotalGel += parseFloat(element.value) || 0;
        });
        totalGEL.innerHTML = Number(subtotalGel.toFixed(2));

    }

})


salesModal.addEventListener('keyup', function () {
    const sales_ex_rate = document.getElementById('purchase_ex_rate2')
    const salesPrice = document.querySelectorAll('.salesPrice')
    const salesGEL = document.querySelectorAll('.salesGel')
    const totalGEL = document.getElementById('totalGEL2')
    const totalCurrency = document.getElementById('totalCurrency2')

    if (sales_ex_rate.value != 0) {

        // Book Price
        for (let i = 0; i < salesPrice.length; i++) {
            salesGEL[i].value = (salesPrice[i].value * sales_ex_rate.value).toFixed(2)

            totalGEL.innerHTML += salesGEL[i].value
        }


        // Invoice Subtotals
        let subtotalCurrency = 0;
        salesPrice.forEach(function (element) {
            subtotalCurrency += parseFloat(element.value) || 0;
        });

        totalCurrency.innerHTML = Number(subtotalCurrency.toFixed(2));

        let subtotalGel = 0;
        salesGEL.forEach(function (element) {
            subtotalGel += parseFloat(element.value) || 0;
        });
        totalGEL.innerHTML = Number(subtotalGel.toFixed(2));

    }

})
