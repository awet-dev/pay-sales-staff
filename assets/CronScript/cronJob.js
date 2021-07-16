const CronJob = require('cron').CronJob;
import { paymentRequest } from './paymentRequest'
import { scheduler } from './config/scheduler'

Object.keys(scheduler).forEach(type => {

    Object.keys(scheduler[type]).forEach(frequency => {

        const job = new CronJob(scheduler[type][frequency], () => {
            paymentRequest(type);
        }, null, true, 'CET');

        job.start();

    });
})
