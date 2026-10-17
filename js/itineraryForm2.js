$(document).ready(function () {
    function isMobileView() {
        return window.innerWidth <= 985;
    }

    // Add Field
    $('.add-field-btn').on('click', function () {
        const fieldHTML_1 = `
        <div class="input-row-div design-1 new-rows" style="margin-top:20px">
            <div class="input-field-div"><input type="date" name="itinActDate[]" required></div>
            <div class="input-field-div day"><input type="number" name="itinActDay[]" placeholder="E.g. 1" min="1" required></div>
            <div class="input-field-div"><input type="time" name="itinActTime[]" required></div>
            <div class="input-field-div activity"><input type="text" name="itinActivity[]" placeholder="E.g. Arrive at the airport" required></div>
            <div class="input-field-div"><button type="button" class="delete-field-btn"><i class="ri-subtract-fill"></i> Delete Field</button></div>
        </div>`;

        const fieldHTML_2 = `
        <div class="combine-row-div design-2 new-rows" style="margin-top:20px">
            <div class="combine-field-div"><label><span>*</span> Date:</label><input type="date" name="itinActDate[]" required></div>
            <div class="combine-field-div"><label><span>*</span> Day:</label><input type="number" name="itinActDay[]" placeholder="E.g. 1" min="1" required></div>
            <div class="combine-field-div"><label><span>*</span> Time:</label><input type="time" name="itinActTime[]" placeholder="E.g. 10:00am" required></div>
            <div class="combine-field-div"><label><span>*</span> Activity:</label><input type="text" name="itinActivity[]" placeholder="E.g. Arrive at the airport" required></div>
            <div class="combine-field-div"><label><span>*</span> Action:</label><button type="button" class="delete-field-btn"><i class="ri-subtract-fill"></i> Delete Field</button></div>
        </div>`;

        if (isMobileView()) {
            $('.combine-row-div.design-2').last().after(fieldHTML_2);
        } else {
            $('.input-row-div.design-1').last().after(fieldHTML_1);
        }
    });

    // Delete one row
    $(document).on('click', '.delete-field-btn', function () {
        $(this).closest('.new-rows').remove();
    });

    // Delete all new rows
    $('.delete-all-btn').on('click', function () {
        $('.new-rows').remove();
    });
});
