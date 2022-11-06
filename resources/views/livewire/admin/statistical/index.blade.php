$.ajax({
url: "{{ route('api.datachart') }}",
type: 'GET',
data: {
typechart: $('#typechart').val(),
year: parseInt($('#year').val()),
mounth: $('#mounth').val()
},
success: function(response) {
console.log('get data chart', response)
},
error: function(response) {
Swal.fire({
icon: 'error',
title: 'Thất bại',
showConfirmButton: false,
timer: 1500
})
}
});
const chart = new Highcharts.Chart({
chart: {
renderTo: 'container',
type: 'column',
options3d: {
enabled: true,
alpha: 15,
beta: 15,
depth: 50,
viewDistance: 25
}
},
xAxis: {
categories: ['Toyota', 'BMW', 'Volvo', 'Audi', 'Peugeot', 'Mercedes-Benz',
'Volkswagen', 'Polestar', 'Kia', 'Nissan'
]
},
yAxis: {
title: {
enabled: false
}
},
tooltip: {
headerFormat: '<b>{point.key}</b><br>',
pointFormat: 'Cars sold: {point.y}'
},
title: {
text: 'Sold passenger cars in Norway by brand, January 2021'
},
subtitle: {
text: 'Source: ' +
'<a href="https://ofv.no/registreringsstatistikk"' + 'target="_blank">OFV</a>' }, legend: { enabled: false }, plotOptions:
    { column: { depth: 25 } }, series: [{ data: [1318, 1073, 1060, 813, 775, 745, 537, 444, 416, 395], colorByPoint:
    true }] });
