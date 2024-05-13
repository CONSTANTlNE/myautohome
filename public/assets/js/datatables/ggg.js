
let table;

table = new DataTable('#example', {
    //Generall SETTINGS
    lengthMenu: [10, 100, 150, {label: 'All', value: -1}],
    // lengthMenu: [{label: 'All', value: -1}],
    language: {
        url: 'https://cdn.datatables.net/plug-ins/2.0.5/i18n/ka.json',
    },
    scrollX: true,
    scrollY: 700,

    layout: {

        topStart: {
            buttons: ['pageLength', 'colvis', 'excel'],
            // pageLength: {
            //   menu: [ 10, 25, 50, 100,5000 ]
            // }
        },

        topEnd: {
            search: '',
        }
    },

    // TOTALS
    footerCallback: function (row, data, start, end, display) {
        let api = this.api();

        let intVal = function (i) {
            return typeof i === 'string'
                ? i.replace(/[\$,]/g, '') * 1
                : typeof i === 'number'
                    ? i
                    : 0;
        };

        // Purchase currency Totals
        let total = api
            .column(7)
            .data()
            .reduce((a, b) => intVal(a) + intVal(b), 0);


        let pageTotal = api
            .column(7, {page: 'current'})
            .data()
            .reduce((a, b) => intVal(a) + intVal(b), 0);

        const formatPageTotal = new Intl.NumberFormat('en-US', {
            maximumFractionDigits: 2,
        }).format(pageTotal);

        const formattotal = new Intl.NumberFormat('en-US', {
            maximumFractionDigits: 2,
        }).format(total);
        // Update footer

        api.column(7).footer().innerHTML =
            // '$' + pageTotal + ' ( $' + total + ' total)';
            // formatPageTotal +' '+ '('+ formattotal +' ' + ' total)';
            formatPageTotal;


        // Purchase GEL Totals

        // Total over this page
        let pageTotal2 = api
            .column(9, {page: 'current'})
            .data()
            .reduce((a, b) => intVal(a) + intVal(b), 0);

        const formatPageTotal2 = new Intl.NumberFormat('en-US', {
            maximumFractionDigits: 2,
        }).format(pageTotal2);


        api.column(9).footer().innerHTML =
            // '$' + pageTotal + ' ( $' + total + ' total)';
            // formatPageTotal +' '+ '('+ formattotal +' ' + ' total)';
            formatPageTotal2;


        // Sales currency Totals

        // Total over this page
        let pageTotal3 = api
            .column(15, {page: 'current'})
            .data()
            .reduce((a, b) => intVal(a) + intVal(b), 0);

        const formatPageTotal3 = new Intl.NumberFormat('en-US', {
            maximumFractionDigits: 2,
        }).format(pageTotal3);


        api.column(15).footer().innerHTML =
            // '$' + pageTotal + ' ( $' + total + ' total)';
            // formatPageTotal +' '+ '('+ formattotal +' ' + ' total)';
            formatPageTotal3;


        // Sales GEL Totals

        let pageTotal4 = api
            .column(16, {page: 'current'})
            .data()
            .reduce((a, b) => intVal(a) + intVal(b), 0);

        const formatPageTotal4 = new Intl.NumberFormat('en-US', {
            maximumFractionDigits: 2,
        }).format(pageTotal4);


        api.column(16).footer().innerHTML =
            // '$' + pageTotal + ' ( $' + total + ' total)';
            // formatPageTotal +' '+ '('+ formattotal +' ' + ' total)';
            formatPageTotal4;


    },


});


$('#col0').on('keyup', function () {
    table
        .columns(1)
        .search(this.value)
        .draw();
});


$('#col1').on('keyup', function () {
    console.log(table
        .columns(2).search(this.value))
    table
        .columns(2)
        .search(this.value)
        .draw();
});


$('#col2').on('keyup', function () {
    table
        .columns(3)
        .search(this.value)
        .draw();
});

$('#col3').on('keyup', function () {
    table
        .columns(4)
        .search(this.value)
        .draw();
});
$('#col4').on('keyup', function () {
    table
        .columns(5)
        .search(this.value)
        .draw();
});


// Sales
$('#col9').on('keyup', function () {
    table
        .columns(10)
        .search(this.value)
        .draw();
});
$('#col10').on('keyup', function () {
    table
        .columns(11)
        .search(this.value)
        .draw();
});
$('#col11').on('keyup', function () {
    table
        .columns(12)
        .search(this.value)
        .draw();
});


let customerTable = new DataTable('#customerTable', {
    //Generall SETTINGS
    // lengthMenu: [10, 25, 50, {label: 'All', value: -1}],
    lengthMenu: [{label: 'All', value: -1}],
    language: {
        url: 'https://cdn.datatables.net/plug-ins/2.0.5/i18n/ka.json',
    },
    scrollX: true,
    scrollY: 700,

    layout: {

        topStart: {
            buttons: ['pageLength', 'excel'],

        },

    }
});
let changesTable = new DataTable('#changes', {
    //Generall SETTINGS
    lengthMenu: [{label: 'All', value: -1}],
    language: {
        url: 'https://cdn.datatables.net/plug-ins/2.0.5/i18n/ka.json',
    },
    scrollX: true,
    scrollY: 700,

    layout: {

        topStart: {
            buttons: ['pageLength', 'excel'],

        },

    }
});
let supplierTable = new DataTable('#supplierTable', {
    //Generall SETTINGS
    lengthMenu: [{label: 'All', value: -1}],
    language: {
        url: 'https://cdn.datatables.net/plug-ins/2.0.5/i18n/ka.json',
    },
    scrollX: true,
    scrollY: 700,

    layout: {

        topStart: {
            buttons: ['pageLength', 'excel'],

        },

    }
});
export default table