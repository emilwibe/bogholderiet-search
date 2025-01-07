{
    let typeSelect = document.getElementById("ew-filter-type");
    let brewerySelect = document.getElementById("ew-filter-type-brewery");
    let countrySelect = document.getElementById("ew-filter-type-country");

    if(typeSelect) {
        typeSelect.addEventListener("change", function(e){
            this.form.submit();
        });
    }

    if(brewerySelect) {
        brewerySelect.addEventListener("change", function(e){
            this.form.submit();
        });
    }

    if(countrySelect) {
        countrySelect.addEventListener("change", function(e){
            this.form.submit();
        });
    }
}