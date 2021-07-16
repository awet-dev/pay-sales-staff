import { workingDay } from "./timing";

export const paymentRequest = (type) => {

    let date = new Date().getDate();
    const Http = new XMLHttpRequest();
    const url = "https://localhost:8000/payment/request/";

    if (workingDay(type) === date) {
        // isFirst time make check if this is his first working month. by check the date of the first bonus given
        Http.open("GET", url + type);
        Http.send(null);
    }

}