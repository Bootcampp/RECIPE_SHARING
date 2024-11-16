document.addEventListener("DOMContentLoaded", () => {
    // Mock data (replace with real data from your backend/API)
    const submissionTrendsData = {
        labels: ["January", "February", "March", "April", "May", "June"],
        data: [3, 5, 8, 6, 10, 4] // Recipe submissions per month
    };

    const categoryDistributionData = {
        labels: ["Desserts", "Main Course", "Appetizers", "Beverages"],
        data: [10, 20, 15, 5] // Distribution of recipes by category
    };

    // Submission Trends Chart
    const submissionTrendsCtx = document.getElementById("submissionTrendsChart").getContext("2d");
    new Chart(submissionTrendsCtx, {
        type: "line",
        data: {
            labels: submissionTrendsData.labels,
            datasets: [{
                label: "Recipes Created",
                data: submissionTrendsData.data,
                borderColor: "#4CAF50",
                backgroundColor: "rgba(76, 175, 80, 0.2)",
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: true, position: "top" }
            }
        }
    });

    // Category Distribution Chart
    const categoryDistributionCtx = document.getElementById("categoryDistributionChart").getContext("2d");
    new Chart(categoryDistributionCtx, {
        type: "pie",
        data: {
            labels: categoryDistributionData.labels,
            datasets: [{
                data: categoryDistributionData.data,
                backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56", "#4CAF50"]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: true, position: "top" }
            }
        }
    });
});
