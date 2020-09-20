<div id="SourceDiversity" class="card-block diversityChart">
    <canvas id="sourceDiversityChart" ></canvas>
</div>
<script>
    var options = {
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
    var ctx = document.getElementById('sourceDiversityChart');
    var myPieChart = new Chart(ctx, {
        type: 'bar',
        data: {
                datasets: [{
                    label:"Leads",
                    data: {!! $source_diversity->pluck('total') !!},
                    fill:false,
                    backgroundColor:"#38a169",
                }],
                // These labels appear in the legend and in the tooltips when hovering different arcs
                labels: {!! $source_diversity->pluck('source') !!}
            },
        options: options
    });
</script>