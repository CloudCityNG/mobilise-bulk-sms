<div id="new-group-modal" class="uk-modal">
    <div class="uk-modal-dialog">

        <div class="uk-modal-header">New Contact</div>
            {!! Form::open(['url'=>'', 'class'=>'uk-form uk-form-horizontal newGroupForm']) !!}
            <div class="errors" style="display:none;">
                <div class="uk-alert uk-alert-danger" data-uk-alert>
                    <ul id="error-ul"></ul>
                </div>
            </div>

            <div class="uk-form-row">
                {!! Form::label('group_name', 'Group Name', ['class'=>'uk-form-label']) !!}
                <div class="uk-form-controls">
                    {!! Form::text('group_name', Input::old('group_name'), ['placeholder'=>'Group Name']) !!}
                </div>
            </div>
            <div class="uk-form-row">
                {!! Form::label('group_description', 'Group Description', ['class'=>'uk-form-label']) !!}
                <div class="uk-form-controls">
                    {!! Form::text('group_description', Input::old('group_description'), ['placeholder'=>'Group Description']) !!}
                </div>
            </div>

            {!! Form::close() !!}
        <div class="uk-modal-footer uk-text-right">
            <button type="button" class="uk-button uk-button-small" id="newGroupCancel">Cancel</button>
            <button type="button" class="uk-button uk-button-primary uk-button-small" id="newGroupSave">Save</button>
        </div>
    </div>
</div>
