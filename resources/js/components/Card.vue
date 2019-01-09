<template>
    <card class="flex flex-col items-center justify-center">
        <div class="px-3 py-3">
            <div id="chart"></div>
        </div>
    </card>
</template>

<script>
    import moment from 'moment';

    const recaptchaScript = document.createElement('script');
    recaptchaScript.setAttribute('src', 'https://www.gstatic.com/charts/loader.js');
    document.head.appendChild(recaptchaScript);

    export default {
        props: [
            'card',
        ],

        data() {
            return {
                showCard: false,
                options: {
                    height: 400,
                    width: 900,
                    gantt: {
                        criticalPathEnabled: false,
                        arrow: {
                            angle: 100,
                            width: 1,
                            color: 'green',
                            radius: 0
                        }
                    }
                }
            }
        },

        methods: {
            drawChart() {
                const data = new google.visualization.DataTable();

                const columnKeys = Object.keys(this.card.columns);
                const columnValues = Object.values(this.card.columns);
                columnKeys.forEach((c, i) => {
                    data.addColumn(columnValues[i], c);
                });

                data.addRows(this.card.rows.map(item => {
                    return item.map((value, i) => {
                        if (i === 0) {
                            i = i.toString();
                        }
                        
                        if (columnValues[i] === 'date') {
                            console.log(value);
                            value = moment(value).toDate();
                            //console.log(value);
                        }
                        return value;
                    });
                }));

                const chart = new google.visualization.Gantt(document.getElementById('chart'));
                chart.draw(data, this.options);
            },
        },

        mounted() {
            google.charts.load('current', {'packages': ['gantt']});
            google.charts.setOnLoadCallback(this.drawChart);
        }
    }
</script>
