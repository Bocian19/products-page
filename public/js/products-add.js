
let $selectedVariant = 0;
let $filledVariants = 0;

function required(event) {
   let $required = document.querySelectorAll("input.required");
   let $baseInputs = 3;
   for (var $i = 0; $i < $required.length; $i++) {
      if ($required[$i].value.length == 0 || $required[$i].value == 0 || $required[$i].validity.patternMismatch) {
         $required[$i].setCustomValidity("Please, provide the data of indicated type");
         $required[$i].reportValidity();
         $required[$i].nextElementSibling.innerHTML = "Please, submit required data";
         $baseInputs--;
      } else {
         $required[$i].nextElementSibling.innerHTML = "";
      }
   }

   if ($baseInputs == 3 && $selectedVariant != 0) {
      document.getElementById("type-message").innerHTML = "";
      event.preventDefault();
      document.getElementById('product_form').submit();
      document.getElementById('product_form').submit();
   } else if ($selectedVariant == 0) {
      document.getElementById("type-message").innerHTML = "Please select type";
      event.preventDefault();
   } else if ($baseInputs !== 3 && $selectedVariant != 0) {
      document.getElementById("type-message").innerHTML = "";
      event.preventDefault();
   }
}

function myfunction($selected_option) {
   if (document.getElementsByClassName("collapse show")[0]) {
      $showed = document.getElementsByClassName("collapse show")[0];
      $showed.classList.remove("show");
      $showedInputs = $showed.getElementsByTagName("input");
      for (var $i = 0; $i < $showedInputs.length; $i++) {
         $showedInputs[$i].classList.remove("required");
      }
   }
   let $y = document.getElementById($selected_option);
   $y.classList.add("show");
   $selectedVariant++;
   $inputs = $y.getElementsByTagName("input");
   for (var $i = 0; $i < $inputs.length; $i++) {
      $inputs[$i].classList.add("required");
   }
} 