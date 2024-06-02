
//reinitialize htmx , because its not working on datatables pagination
document.getElementById('example').addEventListener('mouseover', () => {
    htmx.process(document.getElementById('example'))
})

document.addEventListener('htmx:afterOnLoad', function (event) {
    // Check errors if any
    let response = event.detail.xhr.response;
    // FOR DEBUGGING !!!!!
    // console.log(response)
    // htmx.logAll();
    // check which button send the request
    const initiator = event.target;
    // console.log(initiator)

    const xhr = event.detail.xhr;
    // Check for a successful response
    if (xhr.status === 200) {

        //  after success clear form
        if(initiator.id === 'newappsubmit'){
            const form = document.getElementById('htmxstore');
            document.getElementById('carsselect').value='';
            form.reset();
        }

        document.getElementById('errors').innerHTML = "";


        //clear search inputs
        // if(initiator.id === 'appsearch'){
        //     document.getElementById('closesearchmodal').addEventListener('click',()=>{
        //         document.getElementById('appsearch').value='';
        //         document.getElementById('searchclear').click()
        //
        //     })
        // }
        // if(initiator.id === 'potentialsearch'){
        //     document.getElementById('closesearchmodal').addEventListener('click',()=>{
        //         document.getElementById('potentialsearch').value='';
        //         document.getElementById('searchclear2').click()
        //     })
        // }

        // CREATING NEW APP
        if (initiator.id === 'newappsubmit') {
            document.getElementById('closecreatemodal').click();

            // issue notification
            document.getElementById('toggleButton').addEventListener('click', function () {
                let element = document.getElementById('successtoast');
                document.getElementById('successtoasttext').innerHTML='განაცხადი წარმატებით დაემატა';
                element.classList.remove('hiddensuccesstoast');
                element.classList.add('showtoast');

                setTimeout(function () {
                    element.classList.remove('showtoast');
                    element.classList.add('hiddensuccesstoast');

                }, 2700); // Small delay to ensure the transition is triggered
            });
            document.getElementById('toggleButton').click();

        }

        // Close edit modal
        if (initiator.id === 'editappsubmit') {
            document.getElementById('closeeditmodal').click();

            document.getElementById('toggleButton').addEventListener('click', function () {
                let element = document.getElementById('successtoast');
                document.getElementById('successtoasttext').innerHTML='განაცხადი წარმატებით დარედაქტირდა';
                element.classList.remove('hiddensuccesstoast');
                element.classList.add('showtoast');

                setTimeout(function () {
                    element.classList.remove('showtoast');
                    element.classList.add('hiddensuccesstoast');

                }, 3000); // Small delay to ensure the transition is triggered
            });
            document.getElementById('toggleButton').click();

        }

        // Create Potential
        // if (initiator.id === 'createpotential') {
        //     setTimeout(function () {
        //         document.getElementById('closecreatepotential').click();
        //
        //     }, 1000); // Small delay to ensure the transition is tri
        //
        // }
    }




    // Clear Date Range inputs
    if(initiator.id === 'daterangebtn'){
        document.getElementById('daterange').value = '';
    }

    if(initiator.id === 'daterangebtn2'){
        document.getElementById('daterange2').value = '';
    }


    if(initiator.id === 'controlpanelpage'){
        document.getElementById('mainpageheader').style.display = 'none';
    }

    if(initiator.id === 'userspage'){
        document.getElementById('mainpageheader').style.display = 'none';
    }

    if(initiator.id === 'potentialclientsbtn'){
        document.getElementById('mainpageheader').style.display = 'none';
        document.getElementById('potentialclientheader').style.display = 'flex';
    }

    if(initiator.id === 'mainpagelink1'){
        document.getElementById('mainpageheader').style.display = 'flex';
        document.getElementById('potentialclientheader').style.display = 'none';

    }

});

