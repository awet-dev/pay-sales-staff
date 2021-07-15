import { workingDay } from "./timing";

export const paymentRequest = (type) => {

    let date = new Date().getDate();
    const Http = new XMLHttpRequest();
    const url = "https://localhost:8000/payment/request/";

    if (workingDay(type) === date) {
        Http.open("GET", url + type);
        Http.send(null);
    }

}