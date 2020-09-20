<div id="StatusDiversity" class="card-block diversityChart">
    <canvas id="statusDiversityChart" ></canvas>
</div>
<script>
    var options = {
        legend: {
            display: false
        },
        scales:{
                yAxes:[{
                    ticks:{
                        beginAtZero:true
                    }
                }]
            },
        plugins: {
            datalabels: {
                formatter: (value, context) => {
                    var sum = context.dataset.data.reduce((a, b) => a + b);
                    let percentage = (value * 100 / sum).toFixed(1) + "%";
                    return percentage;
                },
                color: '#fff',
                // rotation: '90',
            }
        }
    };
    var ctx = document.getElementById('statusDiversityChart');
    var myPieChart = new Chart(ctx, {
        type: 'bar',
        data: {
                datasets: [{
                    label:"Leads",
                    data: {!! $status_diversity->pluck('total') !!},
                    fill:false,
                    backgroundColor: {!! $status_diversity->pluck('color') !!}
                }],
                // These labels appear in the legend and in the tooltips when hovering different arcs
                labels: {!! $status_diversity->pluck('status') !!}
            },
        options: options
    });
</script>