let full_nutrition = document.querySelector(".full-nutrition");
let span = document.getElementsByClassName("close")[0];

full_nutrition.addEventListener("click", function() {
    let all_list_nutrition = document.querySelector(".nutrition_modal");
    all_list_nutrition.style.display = 'block'
    span.onclick = function() {
        all_list_nutrition.style.display = "none";
    }
    window.onclick = function(event) {
        if (event.target == all_list_nutrition) {
            all_list_nutrition.style.display = "none";
        }
    }
})

