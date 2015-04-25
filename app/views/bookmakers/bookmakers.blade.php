@include('bookmaker_edit_modal')
@include('bookmaker_add_modal')

<div class="portlet light">
    <div class="portlet-title">
        <div class="caption caption-md">
            <i class="fa fa-cogs font-red-sunglo"></i>
            <span class="caption-subject font-red-sunglo bold uppercase">Bookmakers</span>
            <span class="caption-helper">Configuration</span>
        </div>
    </div>
    <div class="portlet-body">
        <div class="note note-danger">
            <p>
                Seul le nom sera modifiable après creation.
            </p>
        </div>
        <button type="button" id="addBookmakerButton" class="btn red" data-toggle="modal" data-target="#bookmakerAddModal"><span class="icon-book-open"></span> Ajouter un compte </button>
        <div class="table-scrollable table-scrollable-borderless">

        </div>
        <div id="bookmakers-pagination">
        </div>
    </div>
</div>