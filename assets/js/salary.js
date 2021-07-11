let interval = (checkIfWeekends().getTime() - new Date().getTime());

// run http request for the salary payment controller
function runPaymentRequest() {
    interval = (checkIfWeekends().getTime() - new Date().getTime());

    const Http = new XMLHttpRequest();
    const url='/pay/salary/salary';
    Http.open("GET", url, true);
    Http.send(null);
}


function checkIfWeekends() {
    let today = new Date();
    // get the last day of the month
    let lastDayOfMonth = new Date(today.getFullYear(), today.getMonth()+1, 0);

    // check if it is weekends, if yes change the payment day to the friday before weekends
    if (lastDayOfMonth.getDay() === 6 ) {
        return new Date(today.getFullYear(), today.getMonth()+1, -1);
    } else if (lastDayOfMonth.getDay() === 7) {
        return new Date(today.getFullYear(), today.getMonth()+1, -2);
    }
    return new Date(today.getFullYear(), today.getMonth()+1, -0);
}

console.log('working')

setInterval(runPaymentRequest, interval);



