document.addEventListener('DOMContentLoaded', function() {
    fetch('../actions/get_submission_trends.php')
        .then(response => {
            console.log('Full response:', response);
            return response.json();
        })
        .then(data => {
            console.log('Received data:', data);

            // Log debug information
            if (data.debug) {
                console.log('Debug Info:', data.debug);
            }

            const ctx = document.getElementById('submissionTrendsChart').getContext('2d');
            
            // Ensure we have data
            if (!data.labels || data.labels.length === 0) {
                console.warn('No data available for chart');
                ctx.fillText('No recipe data available', 50, 100);
                return;
            }

            // Simple chart with basic configuration
            new Chart(ctx, {
                type: 'bar', // Changed to bar for easier visibility
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Monthly Recipes',
                        data: data.values,
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                        borderColor: 'rgb(75, 192, 192)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Number of Recipes'
                            }
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Monthly Recipe Submissions'
                        }
                    }
                }
            });
        })
        .catch(error => {
            console.error('Complete Chart Error:', error);
            const chartContainer = document.getElementById('submissionTrendsChart');
            chartContainer.innerHTML = 'Chart Loading Error: ' + error.message;
        });
});