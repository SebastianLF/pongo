<script src="{{asset('js/pages/stats/stats.js')}}" type="text/javascript"></script>
<script src="{{asset('js/pages/dashboard/loadRecaps.js')}}" type="text/javascript"></script>
<script src="{{asset('js/pages/dashboard/paris/loadParisEnCours.js')}}" type="text/javascript"></script>
<script src="{{asset('js/pages/dashboard/paris/loadParisLongTerme.js')}}" type="text/javascript"></script>
<script src="{{asset('js/pages/dashboard/paris/loadParisABCD.js')}}" type="text/javascript"></script>
<script src="{{asset('js/pages/dashboard/paris/parisEnCoursDelete.js')}}" type="text/javascript"></script>
<script src="{{asset('js/pages/dashboard/paris/parisEnCoursEnclose.js')}}" type="text/javascript"></script>
<script src="{{asset('js/pages/dashboard/paris/parisEnCoursCalculateStatus.js')}}" type="text/javascript"></script>
<script src="{{asset('js/pages/dashboard/paris/parisTermineDelete.js')}}" type="text/javascript"></script>
<script src="{{asset('js/pages/dashboard/loadBookmakersOnDashboard.js')}}" type="text/javascript"></script>
<script src="{{asset('js/pages/dashboard/paris/automaticBetForm.js')}}" type="text/javascript"></script>
<script src="{{asset('js/pages/dashboard/paris/manualBetForm.js')}}" type="text/javascript"></script>
<script src="{{asset('js/pages/dashboard/paris/generalBetForm.js')}}" type="text/javascript"></script>
<script src="{{asset('js/pages/dashboard/modal_welcome.js')}}" type="text/javascript"></script>


<script src="{{asset('js/plugin/sweet-alert.min.js')}}" type="text/javascript"></script>
<script>
    jQuery(document).ready(function () {

        //paris
        parisEnCoursDelete();
        getBookmakersForSelection();
        loadParisEnCours();
        loadParisLongTerme();
        loadParisABCD();
        loadParisTermine();

        // dashboard
        loadRecapsOnDashboard();
        loadBookmakersOnDashboard();

        // formulaire d'ajout de pari
        automaticBetForm();
        //generalBetForm('#manubetform-add');
    });
</script>