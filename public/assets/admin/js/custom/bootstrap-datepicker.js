$(document).ready(function () {
    $('#agendamento').datetimepicker({
        format: 'DD/MM/YYYY HH:m:ss',
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down",
            next: "fa fa-arrow-right",
            previous: "fa fa-arrow-left",
        },
    });
})