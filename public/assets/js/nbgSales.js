document.addEventListener("DOMContentLoaded", () => {

    // ===================SALES INVOICE================
    const dateInput2 = document.getElementById("salesDate");
    const output2 = document.getElementById("purchase_ex_rate2");
    const currencyInput2 = document.getElementById("currency2");

    function fetchEX2(handle) {
        const apiUrl = `https://nbg.gov.ge/gw/api/ct/monetarypolicy/currencies/ka/json/?date=${dateInput2.value}`;

        fetch(apiUrl)
            .then((response) => response.json())
            .then((data) => {
                // if RUB is selected recalculate currency
                if (currencyInput2.value === "RUB") {
                    output2.value = data[0]["currencies"].find(
                        (currency) => currency.code === currencyInput2.value
                    ).rateFormated / 100;
                } else {

                    output2.value = data[0]["currencies"].find(
                        (currency) => currency.code === currencyInput2.value
                    ).rateFormated;
                }
                // Call the callback function if provided
                if (typeof handle === 'function') {
                    handle();
                }
            })
            .catch((error) => {
                output2.value = "An error occurred while fetching data.";
                console.error(error);
            });
    }

    dateInput2.addEventListener("change", fetchEX2);
    currencyInput2.addEventListener("change", fetchEX2);


});

