const CronJob = require('cron').CronJob;
const salary = new CronJob('* * * * * *', function() {
    console.log(new Date());
}, null, true, 'CET');


salary.stop();