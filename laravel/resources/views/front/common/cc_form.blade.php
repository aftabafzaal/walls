<div class="fom col-sm-6 pul-cntr">
    <div class="form-group" id="cc-name">
        {!! Form::label('Name on Card') !!}
        {!! Form::text('name', null , array('class' => 'form-control', 'required' => 'required') ) !!}
    </div>
    <div class="form-group" id="cc-group">
        <!--
        Aftab Khan
        
        378282246310005
        4685
        -->
        {!! Form::label('cc', 'Credit card number') !!}

        {!! Form::text('cc',null , [

        'class'                         => 'form-control',
        'required'                      => 'required',
        'data-stripe'                   => 'number',
        'data-parsley-type'             => 'number',
        'maxlength'                     => '16',
        'data-parsley-trigger'          => 'change focusout',
        'data-parsley-class-handler'    => '#cc-group'

        ]) !!}
    </div>
    <div class="form-group row">
        <div class="form-group col-sm-4" id="ccv-group">
            {!! Form::label('CVC', 'CVC') !!}
            {!! Form::text('cvc', null, ['class'=> 'form-control','required'=> 'required','data-stripe'=> 'cvc','data-parsley-type'=> 'number','data-parsley-trigger'=>'change focusout','maxlength'=> '4','data-parsley-class-handler'=> '#ccv-group']) !!}
        </div>


        <div class="col-sm-4">
            <div class="form-group" id="exp-m-group">
                {!! Form::label('expMonth', 'Ex. Month') !!}
                {!! Form::selectMonth('expMonth',01, ['class'=> 'form-control','required' => 'required','data-stripe'=> 'exp-month'],'%m') !!}
            </div>
        </div>

        <div class="col-sm-4">

            <div class="form-group" id="exp-y-group">
                {!! Form::label('expYear', 'Ex. Year') !!}
                {!! Form::selectYear('expYear', date('Y'), date('Y') + 10, null, ['class'=>'form-control','required' => 'required','data-stripe'=>'exp-year']) !!}
            </div>
        </div>
    </div>
</div>
