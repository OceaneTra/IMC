var options = {
    series: [{
        name: 'Plan basic',
        data: [2400, 2100, 2700, 2800, 2300, 2900, 2600, 2400, 2800, 2700, 2500, 2900]
    }, {
        name: 'plan business',
        data: [4500, 4800, 5100, 5300, 4900, 5400, 5200, 5100, 5300, 5000, 5200, 5500]
    }, {
        name: 'Plan entreprise',
        data: [6800, 7200, 7500, 7800, 7100, 8000, 7600, 7400, 7900, 7500, 7700, 8200]
    }],
    chart: {
        type: 'bar',
        height: 450,
        stacked: false,
        toolbar: {
            show: true
        },
    },
    plotOptions: {
        bar: {
            horizontal: false,
            borderRadius: 5,
            columnWidth: '70%',
        },
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        show: true,
        width: 2,
        colors: ['transparent']
    },
    xaxis: {
        title: {
            text: 'Mois',
            style:{
                fontSize: '18px',
            }
        },
        categories: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin',
            'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
    },
    yaxis: {
        title: {
            text: 'Revenus (fcfa)',
            style: {
                fontSize: '18px'
            }
        },
    },
    fill: {
        opacity: 1
    },
    tooltip: {
        y: {
            formatter: function (val) {
                return val + " XOF"
            }
        }
    },
    title: {
        text: 'Revenus par type de forfait en fonction du mois',
        align: 'center',
        style: {
            fontSize: '18px'
        }
    },
    colors: ['#008FFB', '#00E396', '#FEB019'],
    legend: {
        position: 'top',
        horizontalAlign: 'right'
    }
};

var chart = new ApexCharts(document.querySelector("#myChart"), options);
chart.render();