let today = new Date().getTime();
let lastDay = lastWorkingDayOfMonth(1).getTime();
let interval = lastDay - today;

// run http request for the salary payment controller
function salaryPaymentRequest() {
    const Http = new XMLHttpRequest();
    const url='/pay/salary/salary';
    Http.open("GET", url, true);
    Http.send(null);

    interval = lastWorkingDayOfMonth(2).getTime() - new Date().getTime();

    clearTimeout();
    setTimeout(salaryPaymentRequest, interval)
}


function lastWorkingDayOfMonth(month) {

    let today = new Date();
    // get the last day of the month
    let lastDayOfMonth =  new Date(today.getFullYear(), today.getMonth()+month, -0);

    // check if it is weekends, if yes change the payment day to the friday before weekends
    if (lastDayOfMonth.getDay() === 6 ) {
        return new Date(today.getFullYear(), today.getMonth()+month, -1);
    } else if (lastDayOfMonth.getDay() === 7) {
        return new Date(today.getFullYear(), today.getMonth()+month, -2);
    }
    return lastDayOfMonth;
}

setTimeout(salaryPaymentRequest, interval);
