@if($quarantine_area_name!=null)
    {{$team_government_name }}/{{$team_zone_name}}/{{$quarantine_area_name}}

@elseif($check_point_name!=null)
    {{$point_government_name }}/{{$point_zone_name}}/{{$check_point_name}}
@else
    @if(Auth::user()->can('manage worksTeams'))
        <button class="btn btn-primary addToAssignList" data-id="{{$id}}"
                data-name="{{$name}}"> {{trans('dataTable.addTotTeam')}}</button>
    @endif

@endif
