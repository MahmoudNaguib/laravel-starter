@include('form.input',['name'=>'title','type'=>'text','attributes'=>['class'=>'form-control','label'=>trans('app.Title'),'placeholder'=>trans('app.Title'),'autocomplete'=>"off",'required'=>1]])
@include('form.textArea',['name'=>'content','attributes'=>['class'=>'form-control','label'=>trans('app.Content'),
'placeholder'=>trans('app.Content'),'required'=>1, 'rows' => 10]])
@include('form.boolean',['name'=>'is_approved','attributes'=>['label'=>trans('app.Is approved')]])


