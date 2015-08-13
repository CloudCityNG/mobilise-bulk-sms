<table class="uk-table uk-table-hover uk-table-condensed uk-margin-large-top">
    <tbody>
        <tr>
            <th>ID</th>
            <th>Lower Range</th>
            <th>Upper Range</th>
            <th>Price</th>
            <th></th>
        </tr>
        @foreach($data as $row)
        <tr id="{{$row->id}}" class="row">
            <td id="id">{{$row->idn}}</td>
            <td class="uk-table-middle" id="lower">{{number_format($row->lower_range,0)}}</td>
            <td class="uk-table-middle" id="upper">{{number_format($row->upper_range,0)}}</td>
            <td class="uk-table-middle" id="price">₦{{ money_format($row->unit_price,2)}}</td>
            <td class="uk-table-middle">
                <div class="uk-button-group">
                    <button class="uk-button">Actions</button>
                    <div data-uk-dropdown="{mode:'click'}">
                        <a href="#" class="uk-button"><i class="uk-icon-caret-down"></i></a>
                        <div class="uk-dropdown uk-dropdown-small">
                            <ul class="uk-nav uk-nav-dropdown">
                                <li><a href="#" class="" id="edit" data-edit-id="{{$row->id}}">Edit Row</a></li>
                                <li><a href="#" class="" id="delete" data-delete-id="{{$row->id}}">Delete Row</a></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>