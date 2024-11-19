document.addEventListener('DOMContentLoaded', function() {
    // Fetch submission trends data via AJAX
    fetch('../actions/get_submission_trends.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            console.log('Received data:', data); // Log the received data

            const ctx = document.getElementById('submissionTrendsChart').getContext('2d');
            
            // Check if we have data
            if (!data.labels || !data.values || data.labels.length === 0) {
                console.warn('No chart data available');
                ctx.fillText('No data available', 50, 100);
                return;
            }

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Number of Recipes',
                        data: data.values,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgb(75, 192, 192)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Monthly Recipe Submissions'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Number of Recipes'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Month'
                            }
                        }
                    }
                }
            });
        })
        .catch(error => {
            console.error('Error fetching or rendering chart:', error);
            const chartContainer = document.getElementById('submissionTrendsChart');
            chartContainer.innerHTML = 'Unable to load chart: ' + error.message;
        });
});