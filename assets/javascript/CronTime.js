// Time last working day of the month or day before the weekend the month
function lastWorkingDayOfMonth(month, minute) {
    let today = new Date();
    let lastDay = new Date(today.getFullYear(), today.getMonth() + month, 15, 18, minute, 0, 0);
    if (lastDay.getDay() === 6) {
        lastDay.setDate(lastDay.getDate() - 1)
    } else if(lastDay.getDay() === 0) {
        lastDay.setDate(lastDay.getDate() - 2)
    }
    return lastDay
}

// Time for every working day in 15 of the month or Wednesday after the weekend in 15th of the month
function workingDayHalfOfMonth(month) {
    let today = new Date();
    let halfOfMonth = new Date(today.getFullYear(), today.getMonth()+month, 15, 9, 0, 0, 0);
    if (halfOfMonth.getDay() === 6) {
        halfOfMonth.setDate(halfOfMonth.getDate() + 4,)
    } else if(halfOfMonth.getDay() === 0) {
        halfOfMonth.setDate(halfOfMonth.getDate() + 3)
    }
    return halfOfMonth
}

export const frequencies = {
    salary : {
        endOne : '0 9 31 * *',
        endTwo : '0 9 30 * *',
        endThree : '0 9 29 * *',
        endFour : '0 9 28 * *',
    },
    bonus : {
        midOne : '0 9 15 * *',
        midTwo : '0 9 18 * *',
        midThree : '0 9 19 * *',
    }
}

export { lastWorkingDayOfMonth, workingDayHalfOfMonth }