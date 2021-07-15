const CronJob = require('cron').CronJob;
import { lastWorkingDayOfMonth, workingDayHalfOfMonth, frequencies } from './CronTime';

Object.keys(frequencies).forEach(type => {
    Object.keys(frequencies[type]).forEach(key => {
        const job = new CronJob(frequencies[type][key], function() {
            console.log(frequencies[type][key]);
            if (type === 'salary' && lastWorkingDayOfMonth(1).getDate() === new Date().getDate()) {
                const Http = new XMLHttpRequest();
                const url="https://localhost:8000/payment/request/salary" + type;
                Http.open("GET", url, true);
                Http.send(null);
            } else if (type === 'bonus' && workingDayHalfOfMonth(0).getDate() === new Date().getDate()) {
                const Http = new XMLHttpRequest();
                const url="https://localhost:8000/payment/request/bonus" + type;
                Http.open("GET", url, true);
                Http.send(null);
            }
        }, null, true, 'CET');
        job.start();
    });
})
