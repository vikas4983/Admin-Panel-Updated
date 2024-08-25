document.addEventListener("DOMContentLoaded", function () {
    // Get all checkboxes with class 'selectCheckbox'
    var checkboxes = document.querySelectorAll(".selectCheckbox");
    var selectAllCheckbox = document.getElementById("selectAllCheckbox");
    var deleteBtn = document.getElementById("deleteBtn");
    // For CMS
    var activeBtn = document.getElementById("activeBtn");
    var inActiveBtn = document.getElementById("inActiveBtn");
    // For User
    var activeBtnUser = document.getElementById("activeBtnUser");
    var inActiveBtnUser = document.getElementById("inActiveBtnUser");

    // Function to get selected checkbox IDs
    function getSelectedIds() {
        var selectedIds = [];

        // Loop through each checkbox to get the selected IDs
        checkboxes.forEach(function (checkbox) {
            if (checkbox.checked) {
                selectedIds.push(checkbox.value);
            }
        });

        return selectedIds;
    }

    // Event listener for select all checkbox
    selectAllCheckbox.addEventListener("change", function () {
        checkboxes.forEach(function (checkbox) {
            checkbox.checked = selectAllCheckbox.checked;
        });
    });

    // Event listener for delete button click
    deleteBtn.addEventListener("click", function () {
        var confirmDelete = confirm(
            "Are you sure you want to delete the selected items?"
        );
        if (confirmDelete) {
            deleteSelectedItems();
        }
    });

    // For Delete CMS
    function deleteSelectedItems() {
        var selectedIds = getSelectedIds();
        console.log(selectedIds);
        // Set the selected IDs to the hidden input field
        document.getElementById("cmsDeleteSelectedIds").value =
            selectedIds.join(",");

        // Submit the form
        document.getElementById("deleteForm").submit();
    }

    // CMS
    // For Active CMS
    function activeSelectedItems() {
        var selectedIds = getSelectedIds();
        console.log(selectedIds);

        document.getElementById("cmsActiveSelectedIds").value =
            selectedIds.join(",");
        document.getElementById("activeBtnForm").submit();
    }
    activeBtn.addEventListener("click", function () {
        var confirmActive = confirm(
            "Are you sure you want to Active the selected items?"
        );
        if (confirmActive) {
            activeSelectedItems();
        }
    });

    // For InActive CMS
    function inActiveSelectedItems() {
        var selectedIds = getSelectedIds();
        console.log(selectedIds);

        // Set the selected IDs to the hidden input field
        document.getElementById("cmsInActiveSelectedIds").value =
            selectedIds.join(",");
        // Submit the form
        document.getElementById("inActiveBtnForm").submit();
    }
    inActiveBtn.addEventListener("click", function () {
        var confirmInactive = confirm(
            "Are you sure you want to Inactive the selected items?"
        );
        if (confirmInactive) {
            inActiveSelectedItems();
        }
    });

    // USER
    // For Delete User
    function deleteSelectedItems() {
        // For CMS
        var selectedDeleteCMSIds = getSelectedIds();
        // For Admin
        var selectedDeleteAdminIds = getSelectedIds();
        // For Country
        var selectedDeleteCountryIds = getSelectedIds();
        // For State
        var selectedDeleteStateIds = getSelectedIds();
        // For City
        var selectedDeleteCityIds = getSelectedIds();
        // For Religion
        var selectedDeleteReligionIds = getSelectedIds();
        // For Caste
        var selectedDeleteCasteIds = getSelectedIds();
        // For Employee
        var selectedDeleteEmployeeIds = getSelectedIds();
        // For Education
        var selectedDeleteEducationIds = getSelectedIds();
        // For Occupation
        var selectedDeleteOccupationIds = getSelectedIds();
        // For Income
        var selectedDeleteIncomeIds = getSelectedIds();
        // For Plan
        var selectedDeletePlanIds = getSelectedIds();
        // For Logo
        var selectedDeleteLogoIds = getSelectedIds();
        // For Favicon
        var selectedDeleteFaviconIds = getSelectedIds();

        // For CMS Hidden Input Field
        document.getElementById("selectedDeleteCMSIds").value =
            selectedDeleteCMSIds.join(",");
        // For Admin Hidden Input Field
        document.getElementById("selectedDeleteAdminIds").value =
            selectedDeleteAdminIds.join(",");
        // For Country Hidden Input Field
        document.getElementById("selectedDeleteCountryIds").value =
            selectedDeleteCountryIds.join(",");
        // For State Hidden Input Field
        document.getElementById("selectedDeleteStateIds").value =
            selectedDeleteStateIds.join(",");
        // For City Hidden Input Field
        document.getElementById("selectedDeleteCityIds").value =
            selectedDeleteCityIds.join(",");
        // For Religion Hidden Input Field
        document.getElementById("selectedDeleteReligionIds").value =
            selectedDeleteReligionIds.join(",");
        // For Caste Hidden Input Field
        document.getElementById("selectedDeleteCasteIds").value =
            selectedDeleteCasteIds.join(",");
        // For Employee Hidden Input Field
        document.getElementById("selectedDeleteEmployeeIds").value =
            selectedDeleteEmployeeIds.join(",");
        // For Education Hidden Input Field
        document.getElementById("selectedDeleteEducationIds").value =
            selectedDeleteEducationIds.join(",");
        // For Occupation Hidden Input Field
        document.getElementById("selectedDeleteOccupationIds").value =
            selectedDeleteOccupationIds.join(",");
        // For Income Hidden Input Field
        document.getElementById("selectedDeleteIncomeIds").value =
            selectedDeleteIncomeIds.join(",");
        // For Plan Hidden Input Field
        document.getElementById("selectedDeletePlanIds").value =
            selectedDeletePlanIds.join(",");
        // For Logo Hidden Input Field
        document.getElementById("selectedDeleteLogoIds").value =
            selectedDeleteLogoIds.join(",");
        // For Favicon Hidden Input Field
        document.getElementById("selectedDeleteFaviconIds").value =
            selectedDeleteFaviconIds.join(",");

        document.getElementById("deleteForm").submit();
    }

    // For Active User
    function activeSelectedItems() {
        // For CMS
        var selectedActiveCMSIds = getSelectedIds();
        // For Admin
        var selectedActiveAdminIds = getSelectedIds();
        // For Country
        var selectedActiveCountryIds = getSelectedIds();
        // For State
        var selectedActiveStateIds = getSelectedIds();
        // For City
        var selectedActiveCityIds = getSelectedIds();
        // For Religion
        var selectedActiveReligionIds = getSelectedIds();
        // For Caste
        var selectedActiveCasteIds = getSelectedIds();
        // For Employee
        var selectedActiveEmployeeIds = getSelectedIds();
        // For Education
        var selectedActiveEducationIds = getSelectedIds();
        // For Occupation
        var selectedActiveOccupationIds = getSelectedIds();
        // For Income
        var selectedActiveIncomeIds = getSelectedIds();
        // For Plan
        var selectedActivePlanIds = getSelectedIds();
        // For Logo
        var selectedActiveLogoIds = getSelectedIds();
        // For Favicon
        var selectedActiveFaviconIds = getSelectedIds();

        console.log(selectedActiveAdminIds);
        // Set the selected IDs to the hidden input field
        // For CMS
        document.getElementById("selectedActiveCMSIds").value =
            selectedActiveCMSIds.join(",");
        // For Admin
        document.getElementById("selectedActiveAdminIds").value =
            selectedActiveAdminIds.join(",");
        // For Country
        document.getElementById("selectedActiveCountryIds").value =
            selectedActiveCountryIds.join(",");
        // For State
        document.getElementById("selectedActiveStateIds").value =
            selectedActiveStateIds.join(",");
        // For City
        document.getElementById("selectedActiveCityIds").value =
            selectedActiveCityIds.join(",");
        // For Religion
        document.getElementById("selectedActiveReligionIds").value =
            selectedActiveReligionIds.join(",");
        // For Caste
        document.getElementById("selectedActiveCasteIds").value =
            selectedActiveCasteIds.join(",");
        // For Employee
        document.getElementById("selectedActiveEmployeeIds").value =
            selectedActiveEmployeeIds.join(",");
        // For Education
        document.getElementById("selectedActiveEducationIds").value =
            selectedActiveEducationIds.join(",");
        // For Occupation
        document.getElementById("selectedActiveOccupationIds").value =
            selectedActiveOccupationIds.join(",");
        // For Income
        document.getElementById("selectedActiveIncomeIds").value =
            selectedActiveIncomeIds.join(",");
        // For Plan
        document.getElementById("selectedActivePlanIds").value =
            selectedActivePlanIds.join(",");
        // For Logo
        document.getElementById("selectedActiveLogoIds").value =
            selectedActiveLogoIds.join(",");
        // For Favicon
        document.getElementById("selectedActiveFaviconIds").value =
            selectedActiveFaviconIds.join(",");

        // Submit the form
        document.getElementById("activeBtnForm").submit();
    }
    activeBtnUser.addEventListener("click", function () {
        var confirmActive = confirm(
            "Are you sure you want to Active the selected items?"
        );
        if (confirmActive) {
            activeSelectedItems();
        }
    });

    // For InActive User
    function inActiveSelectedItems() {
        // For CMS
        var selectedInactiveCMSIds = getSelectedIds();
        // For Admin
        var selectedInactiveAdminIds = getSelectedIds();
        // For Country
        var selectedInactiveCountryIds = getSelectedIds();
        // For State
        var selectedInactiveStateIds = getSelectedIds();
        // For City
        var selectedInactiveCityIds = getSelectedIds();
        // For Religion
        var selectedInactiveReligionIds = getSelectedIds();
        // For Caste
        var selectedInactiveCasteIds = getSelectedIds();
        // For Employee
        var selectedInactiveEmployeeIds = getSelectedIds();
        // For Education
        var selectedInactiveEducationIds = getSelectedIds();
        // For Occupation
        var selectedInactiveOccupationIds = getSelectedIds();
        // For Income
        var selectedInactiveIncomeIds = getSelectedIds();
        // For Plan
        var selectedInactivePlanIds = getSelectedIds();
        // For Logo
        var selectedInactiveLogoIds = getSelectedIds();
        // For Favicon
        var selectedInactiveFaviconIds = getSelectedIds();


        // For Console
        console.log(selectedInactiveCountryIds);

        // Set the selected IDs to the hidden input field
        // For CMS Hidden Input Field
        document.getElementById("selectedInactiveCMSIds").value =
            selectedInactiveCMSIds.join(",");
        // For Admin Hidden Input Field
        document.getElementById("selectedInactiveAdminIds").value =
            selectedInactiveAdminIds.join(",");
        // For Country Hidden Input Field
        document.getElementById("InactiveCountryIds").value =
            selectedInactiveCountryIds.join(",");
        // For State Hidden Input Field
        document.getElementById("selectedInactiveStateIds").value =
            selectedInactiveStateIds.join(",");
        // For City Hidden Input Field
        document.getElementById("selectedInactiveCityIds").value =
            selectedInactiveCityIds.join(",");
        // For Religion Hidden Input Field
        document.getElementById("selectedInactiveReligionIds").value =
            selectedInactiveReligionIds.join(",");
        // For Caste Hidden Input Field
        document.getElementById("selectedInactiveCasteIds").value =
            selectedInactiveCasteIds.join(",");
        // For Employee Hidden Input Field
        document.getElementById("selectedInactiveEmployeeIds").value =
            selectedInactiveEmployeeIds.join(",");
        // For Education Hidden Input Field
        document.getElementById("selectedInactiveEducationIds").value =
            selectedInactiveEducationIds.join(",");
        // For Occupation Hidden Input Field
        document.getElementById("selectedInactiveOccupationIds").value =
            selectedInactiveOccupationIds.join(",");
        // For Income Hidden Input Field
        document.getElementById("selectedInactiveIncomeIds").value =
            selectedInactiveIncomeIds.join(",");
        // For Plan Hidden Input Field
        document.getElementById("selectedInactivePlanIds").value =
            selectedInactivePlanIds.join(",");
        // For Logo Hidden Input Field
        document.getElementById("selectedInactiveLogoIds").value =
            selectedInactiveLogoIds.join(",");
        // For Favicon Hidden Input Field
        document.getElementById("selectedInactiveFaviconIds").value =
            selectedInactiveFaviconIds.join(",");

        // Submit the form
        document.getElementById("inActiveBtnForm").submit();
    }
    inActiveBtnUser.addEventListener("click", function () {
        var confirmInactive = confirm(
            "Are you sure you want to Inactive the selected items?"
        );
        if (confirmInactive) {
            inActiveSelectedItems();
        }
    });
});
