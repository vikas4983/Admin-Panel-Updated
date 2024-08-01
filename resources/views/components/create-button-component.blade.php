 <div style="padding: 0.56rem 1.5rem;
             margin-top: -9px;
             margin-bottom: 6px ">
     <!-- Nothing worth having comes easy. - Theodore Roosevelt -->

     {{-- For Create Route --}}
     <a href="{{ url($createRoute) }}" class="btn btn-primary btn-sm"><i class=" fa fa-add"></i> <b>Create</b></a>

     {{-- List --}}
     <button class="btn btn-info btn-sm"><i class=" mdi mdi-format-list-bulleted"></i> <b>List</b><span
             class="badge text-bg-secondary">{{ $countAll }}</span>
     </button>










     {{-- For Delete All Route --}}
     <button>
         <form action="{{ url($deleteAllRoute) }}" method="post" id="deleteForm">
             @csrf
             <!-- Hidden input field to hold the selected IDs -->
             <!-- For CMS -->
             <input type="hidden" name="selectedDeleteCMSIds[]" id="selectedDeleteCMSIds">
             <!-- For USER -->
             <input type="hidden" name="selectedDeleteAdminIds[]" id="selectedDeleteAdminIds">
             <!-- For COUNTRY -->
             <input type="hidden" name="selectedDeleteCountryIds[]" id="selectedDeleteCountryIds">
             <!-- For STATE -->
             <input type="hidden" name="selectedDeleteStateIds[]" id="selectedDeleteStateIds">
             <!-- For CITY -->
             <input type="hidden" name="selectedDeleteCityIds[]" id="selectedDeleteCityIds">
             <!-- For Religion -->
             <input type="hidden" name="selectedDeleteReligionIds[]" id="selectedDeleteReligionIds">
             <!-- For Caste -->
             <input type="hidden" name="selectedDeleteCasteIds[]" id="selectedDeleteCasteIds">
             <!-- For Employee -->
             <input type="hidden" name="selectedDeleteEmployeeIds[]" id="selectedDeleteEmployeeIds">
             <!-- For Education -->
             <input type="hidden" name="selectedDeleteEducationIds[]" id="selectedDeleteEducationIds">
             <!-- For Occupation -->
             <input type="hidden" name="selectedDeleteOccupationIds[]" id="selectedDeleteOccupationIds">
             <!-- For Income -->
             <input type="hidden" name="selectedDeleteIncomeIds[]" id="selectedDeleteIncomeIds">
             <!-- For Plan -->
             <input type="hidden" name="selectedDeletePlanIds[]" id="selectedDeletePlanIds">
             <!-- For Logo -->
             <input type="hidden" name="selectedDeleteLogoIds[]" id="selectedDeleteLogoIds">
             <!-- For Favicon -->
             <input type="hidden" name="selectedDeleteFaviconIds[]" id="selectedDeleteFaviconIds">
             
             <button type="button" class="btn btn-danger btn-sm" id="deleteBtn"><i class=" mdi mdi-delete"></i> <b>
                     All</b></button>
         </form>
     </button>












     {{-- For Active Route --}}
     <button>
         <form action="{{ url($activeRoute) }}" id="activeBtnForm" method="post">
             <!-- For CMS -->
             <input type="hidden" name="selectedActiveCMSIds[]" id="selectedActiveCMSIds">
             <!-- For USER -->
             <input type="hidden" name="selectedActiveAdminIds[]" id="selectedActiveAdminIds">
             <!-- For Country -->
             <input type="hidden" name="selectedActiveCountryIds[]" id="selectedActiveCountryIds">
             <!-- For STATE -->
             <input type="hidden" name="selectedActiveStateIds[]" id="selectedActiveStateIds">
             <!-- For CITY -->
             <input type="hidden" name="selectedActiveCityIds[]" id="selectedActiveCityIds">
             <!-- For Religion -->
             <input type="hidden" name="selectedActiveReligionIds[]" id="selectedActiveReligionIds">
             <!-- For Caste -->
             <input type="hidden" name="selectedActiveCasteIds[]" id="selectedActiveCasteIds">
             <!-- For Employee -->
             <input type="hidden" name="selectedActiveEmployeeIds[]" id="selectedActiveEmployeeIds">
             <!-- For Education -->
             <input type="hidden" name="selectedActiveEducationIds[]" id="selectedActiveEducationIds">
             <!-- For Occupation -->
             <input type="hidden" name="selectedActiveOccupationIds[]" id="selectedActiveOccupationIds">
             <!-- For Income -->
             <input type="hidden" name="selectedActiveIncomeIds[]" id="selectedActiveIncomeIds">
             <!-- For Plan -->
             <input type="hidden" name="selectedActivePlanIds[]" id="selectedActivePlanIds">
             <!-- For Logo -->
             <input type="hidden" name="selectedActiveLogoIds[]" id="selectedActiveLogoIds">
             <!-- For Favicon -->
             <input type="hidden" name="selectedActiveFaviconIds[]" id="selectedActiveFaviconIds">
            
            
             @csrf
             <button class="btn btn-success btn-sm" id="activeBtn"><i class=" mdi mdi-check-decagram"></i>
                 <b>Active</b><span class="badge text-bg-secondary"><b>{{ $active }}</b></span></button>
         </form>
     </button>















     {{-- For InActive Route --}}
     <button>
         <form action="{{ url($inActiveRoute) }}" id="inActiveBtnForm" method="post">
             <!-- For CMS -->
             <input type="hidden" name="selectedInactiveCMSIds[]" id="selectedInactiveCMSIds">
             <!-- For USER -->
             <input type="hidden" name="selectedInactiveAdminIds[]" id="selectedInactiveAdminIds">
            <!-- For COUNTRY -->
             <input type="hidden" name="selectedInactiveCountryIds[]" id="InactiveCountryIds">
            <!-- For STATE -->
             <input type="hidden" name="selectedInactiveStateIds[]" id="selectedInactiveStateIds">
            <!-- For CITY -->
             <input type="hidden" name="selectedInactiveCityIds[]" id="selectedInactiveCityIds">
            <!-- For Religion -->
             <input type="hidden" name="selectedInactiveReligionIds[]" id="selectedInactiveReligionIds">
            <!-- For Caste -->
             <input type="hidden" name="selectedInactiveCasteIds[]" id="selectedInactiveCasteIds">
            <!-- For Employee -->
             <input type="hidden" name="selectedInactiveEmployeeIds[]" id="selectedInactiveEmployeeIds">
            <!-- For Education -->
             <input type="hidden" name="selectedInactiveEducationIds[]" id="selectedInactiveEducationIds">
            <!-- For Occupation -->
             <input type="hidden" name="selectedInactiveOccupationIds[]" id="selectedInactiveOccupationIds">
            <!-- For Income -->
             <input type="hidden" name="selectedInactiveIncomeIds[]" id="selectedInactiveIncomeIds">
            <!-- For Plan -->
             <input type="hidden" name="selectedInactivePlanIds[]" id="selectedInactivePlanIds">
            <!-- For Logo -->
             <input type="hidden" name="selectedInactiveLogoIds[]" id="selectedInactiveLogoIds">
            <!-- For Favicon -->
             <input type="hidden" name="selectedInactiveFaviconIds[]" id="selectedInactiveFaviconIds">
            
             @csrf
             <button class="btn btn-secondary btn-sm" id="inActiveBtn"><i class=" mdi mdi-close-octagon"></i>
                 <b>InActive</b><span class="badge text-bg-secondary"><b>{{ $inActive }}</b></span></button>
         </form>
     </button>
 </div>
