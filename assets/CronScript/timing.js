// Time last working day of the month or day before the weekend the month
export const workingDay = (type => {

    let today = new Date();
    let day = new Date(today.getFullYear(), today.getMonth(), 15);

    if (type === 'bonus') {
        if (day.getDay() === 6) {
            day.setDate(day.getDate() + 4,)
        } else if(day.getDay() === 0) {
            day.setDate(day.getDate() + 3)
        }
    } else {
        day = new Date(today.getFullYear(), today.getMonth()+1, 0);
        if (day.getDay() === 6) {
            day.setDate(day.getDate() - 1)
        } else if(day.getDay() === 0) {
            day.setDate(day.getDate() - 2)
        }
    }

    return day.getDate()
})

