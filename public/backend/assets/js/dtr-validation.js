// public/backend/assets/js/dtr-validation.js
document.addEventListener("DOMContentLoaded", function () {
    const timeInAM = document.getElementById("time_in_am");
    const timeOutAM = document.getElementById("time_out_am");
    const timeInPM = document.getElementById("time_in_pm");

    if (timeInAM) {
        timeInAM.addEventListener("change", function () {
            if (this.value < "08:00") {
                this.value = "08:00";
            }
        });
    }

    if (timeOutAM) {
        timeOutAM.addEventListener("change", function () {
            if (this.value > "12:00") {
                this.value = "12:00";
            }
        });
    }

    if (timeInPM) {
        timeInPM.addEventListener("change", function () {
            if (this.value < "13:00") {
                this.value = "13:00";
            }
        });
    }

    // No validation for time_out_pm since overtime is allowed
});
