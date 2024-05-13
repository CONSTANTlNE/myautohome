
new TomSelect("#customer", {
    create: true,
    sortField: {
        field: "text",
        direction: "asc"
    }
});




// Tomselect for update Sales Invoice old books
const oldbooks=document.querySelectorAll('.oldbooks')

oldbooks.forEach((book,index)=>{
    new TomSelect("#book"+index, {
        create: true,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });

})