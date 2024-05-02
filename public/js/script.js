/**
 * Initializes the script when the document is ready.
 */
$(document).ready(function() {
    /***** LABOUR *****/ 

    /***** TRUCK *****/ 
    /**
     * Calculates the total cost of the truck item based on the quantity and rate.
     */
    function calculateTruckItemTotal() {
        console.log("calculateTruckItemTotal() called", $("#truck-quantity").val(), $("#truck-rate").val());
        if ($("#truck-quantity").val() && $("#truck-rate").val()) {
            console.log($("calcing total", "#truck-quantity").val(), $("#truck-rate").val());
            var quantity = $("#truck-quantity").val();
            var rate = $("#truck-rate").val();
            var total = (quantity * rate).toFixed(2);
            $("#truck-total").val(total);
        } else {
            $("#truck-total").val("");
        }
    }

    /**
     * Get the rate of the selected truck & uom when the dropdown selections change.
     */ 
    $(document).on("change", "#truck-label-dropdown, #truck-uom-dropdown", function() {
        if ($("#truck-label-dropdown").val() && $("#truck-uom-dropdown").val()) {
            $.ajax({
                url: "assets/truck_handler_proxy.php",
                type: "POST",
                data: {
                    truck_id: $("#truck-label-dropdown").val(),
                    uom: $("#truck-uom-dropdown").val()
                },
                success: function(data) {
                    console.log(data);
                    $("#truck-rate").val(data);
                    calculateTruckItemTotal();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("AJAX request failed: ", jqXHR, textStatus, errorThrown);
                }
            });
        } else {
            $("#truck-rate").val("");
            $("#truck-total").val("");
        }
    });

    /***** MISCELLANEOUS *****/ 
    /**
     * Calculates the total cost of the miscellaneous item based on the price and quantity.
     */
    $("#misc-price, #misc-quantity").on("input", function() {
        if ($("#misc-price").val() && $("#misc-quantity").val()) {
            var price = $("#misc-price").val();
            var quantity = $("#misc-quantity").val();
            var total = (price * quantity).toFixed(2);
            $("#misc-total").val(total);
        } else {
            $("#misc-total").val("");
        }
    });
});