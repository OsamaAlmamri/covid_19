<div class="accordion-panel">
    <div class="accordion-heading" role="tab" id="headingOne">
        <h3 class="card-title accordion-title">
            <a class="accordion-msg" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                {{trans('menu.printSetting')}} <i class="fa fa-print"></i>
            </a>
        </h3>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
        <div class="row">
            <div class="input-group col-md-12">
                <span class="input-group-addon">{{trans('menu.centerTitleText')}}</span>
                {!!Form ::text('centerTitleText','centerTitleText',['class' => 'form-control', 'id' => 'centerTitleText'])!!}
            </div>
            <div class="input-group col-md-12">
                <span class="input-group-addon">{{trans('menu.centerTitleText')}}</span>
                {!!Form ::text('titleText','titleText',['class' => 'form-control', 'id' => 'titleText'])!!}
            </div>



            <div class="input-group col-md-3">
                <span class="input-group-addon">{{trans('menu.pageSize')}}</span>
                {{--                        A3 , A5 , A6 , legal , letter--}}
                {!!Form ::select('pageSize', ['A3'=>'A3','A4'=>'A4','A5'=>'A5','A6'=>'A6','legal'=>'legal','letter'=>'letter'],'A4',['class' => 'select2 form-control', 'id' => 'pageSize'])!!}
            </div>



            <div class="input-group col-md-3">
                <span class="input-group-addon">{{trans('menu.pageOrientation')}}</span>
                {{--                        A3 , A5 , A6 , legal , letter--}}
                {!!Form ::select('pageOrientation', ['portrait'=>'portrait','landscape'=>'landscape'],'landscape',['class' => 'select2 form-control', 'id' => 'pageOrientation'])!!}
            </div>

            <div class="input-group col-md-3">
                <span class="input-group-addon">{{trans('menu.pageName')}}</span>
                {{--                        A3 , A5 , A6 , legal , letter--}}
                {!!Form ::text('pageName','المحجورين',['class' => 'form-control', 'id' => 'pageName'])!!}
            </div>

        </div>

    </div>
</div>


