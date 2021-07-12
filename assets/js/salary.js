// Run http request for the salary payment controller
function salaryPaymentRequest(type) {
    const Http = new XMLHttpRequest();
    const url="/pay/salary/" + type;
    Http.open("GET", url, true);
    Http.send(null);

    clearTimeout()

    // setTimeout(salaryPaymentRequest, intervalToLastWorkingDayOfMonth(1),'Salary')
    // setTimeout(salaryPaymentRequest, intervalToWorkingDayHalfOfMonth(1),'Bonus')
}


// Time interval to the last working day of the month

function intervalToLastWorkingDayOfMonth(month) {
    let today = new Date();
    let lastDay = new Date(today.getFullYear(), today.getMonth() + month, 0, 9, 0, 0, 0);
    if (lastDay.getDay() === 6) {
        lastDay.setDate(lastDay.getDate() - 1)
    } else if(lastDay.getDay() === 0) {
        lastDay.setDate(lastDay.getDate() - 2)
    }
    return lastDay.getTime() - today.getTime()
}

// Time interval to the working day half of the month

function intervalToWorkingDayHalfOfMonth(month) {
    let today = new Date();
    let halfOfMonth = new Date(today.getFullYear(), today.getMonth()+month, 15, 9, 0, 0, 0);
    if (halfOfMonth.getDay() === 6) {
        halfOfMonth.setDate(halfOfMonth.getDate() + 4,)
    } else if(halfOfMonth.getDay() === 0) {
        halfOfMonth.setDate(halfOfMonth.getDate() + 3)
    }
    return halfOfMonth.getTime() - today.getTime()
}

// setTimeout(salaryPaymentRequest, intervalToLastWorkingDayOfMonth(1),'Salary')
// setTimeout(salaryPaymentRequest, intervalToWorkingDayHalfOfMonth(0),'Bonus')
