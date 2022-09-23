
let $chosenProducts = document.getElementsByClassName("delete-checkbox");
let $productsTodelete = [];
for (var $i = 0; $i < $chosenProducts.length; $i++) {
    if ($chosenProducts[$i].checked) {
        $productsTodelete.push($chosenProducts[$i].value);
    }
}

$massDeleteButt = document.getElementById("delete-ptoduct-btn");
$form = document.getElementById("products_form");
$massDeleteButt.onclick = function (event) {
    event.preventDefault();
    $form.submit();
}
