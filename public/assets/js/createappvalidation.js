
const createmodal = document.getElementById('hs-large-modal');
createmodal.addEventListener('mouseover', () => {
    let customerpid = document.getElementById('storepid');
    let customername = document.getElementById('storename');
    let customermobile = document.getElementById('storemobile');
    let newappsubmit = document.getElementById('newappsubmit');
    let sourceSelectPref=document.getElementById('sourceSelectPref');
    const statusSelectPref=document.getElementById('statusSelectPref');
    const productSelectPref=document.getElementById('productSelectPref');
    const companySelectPref=document.getElementById('companySelectPref');

    // All three is a must parameter
    if (customerpid.value == "") {
        customerpid.style.border = "1px solid red";
    } else {
        customerpid.style.border = "1px solid green";
    }
    if (customername.value == "") {
        customername.style.border = "1px solid red";
    } else {
        customername.style.border = "1px solid green";
    }
    if (customermobile.value == "") {
        customermobile.style.border = "1px solid red";
    } else {
        customermobile.style.border = "1px solid green";
    }
    if(sourceSelectPref.value=="არ არის არჩეული"){
        sourceSelectPref.style.border = "1px solid red";
    }else {
        sourceSelectPref.style.border = "1px solid green";
    }
    if(statusSelectPref.value=="არ არის არჩეული"){
        statusSelectPref.style.border = "1px solid red";
    }else{
        statusSelectPref.style.border = "1px solid green";
    }
    if(productSelectPref.value=="არ არის არჩეული"){
        productSelectPref.style.border = "1px solid red";
    }else{
        productSelectPref.style.border = "1px solid green";
    }
    if(companySelectPref.value=="არ არის არჩეული"){
        companySelectPref.style.border = "1px solid red";
    }else{
        companySelectPref.style.border = "1px solid green";
    }

    // if all three are OK then show button
    if (customerpid.value == "" || customername.value == "" || customermobile.value == ""||companySelectPref.value=="არ არის არჩეული"
        || productSelectPref.value=="არ არის არჩეული"||statusSelectPref.value=="არ არის არჩეული"||sourceSelectPref.value=="არ არის არჩეული"
    ) {
        newappsubmit.style.display = 'none';
    } else {
        newappsubmit.style.display = 'block';
    }




    const errorMessage = document.getElementById('errorMessage');
    // const errorMessage2 = document.getElementById('errorMessage2');

    // PID must be numbers and 11 digits
    customerpid.addEventListener('input', function () {
        // Remove non-numeric characters
        this.value = this.value.replace(/\D/g, '');

        // Display error message if input length is not 11
        if (this.value.length !== 11) {
            errorMessage.style.display = 'block';
        } else {
            errorMessage.style.display = 'none';
        }

    })

    // mobile must be numbers and 9 digits
    // customermobile.addEventListener('input', function () {
    //     // Remove non-numeric characters
    //     this.value = this.value.replace(/\D/g, '');
    //
    //     // Display error message if input length is not 11
    //     if (this.value.length !== 9) {
    //         errorMessage2.style.display = 'block';
    //     } else {
    //         errorMessage2.style.display = 'none';
    //     }
    // })


})