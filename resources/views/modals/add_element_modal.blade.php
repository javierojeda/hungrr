<!-- Modal -->
<div id="newElement" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Añadir un elemento</h4>
      </div>
        {!! Form::open(['route' => 'element.store','class' => 'form','files' => true]) !!}
        <div class="modal-body row">
          <div class="col-md-6">
            {!! Form::hidden('id', '', ['id' => 'section-id','class' => 'section-id']) !!}
            {!! Form::text('name', '', ['id' => 'name','class' => 'form-control name',  'placeholder'=>'Nombre', 'style'=>'width:100%; margin-bottom:10px']) !!}
            {!! Form::text('price', '', ['id' => 'price','class' => 'form-control price',  'placeholder'=>'Precio p.e: 100, 230, etc.', 'style'=>'width:100%;margin-bottom:10px']) !!}
            {!! Form::textarea('description', '', ['id' => 'description','size' => '30x4','maxlength'=>'50','class' => 'form-control description',  'placeholder'=>'Descripción', 'style'=>'width:100%;margin-bottom:10px']) !!}
            {!! Form::file('image', array('required','id'=>'imgInp_menu')) !!}
          </div>
          <div class="col-md-6">
            <img id="img_preview_menu"  src="../../images/placeholder3.png" alt="Preview" style="width: 250px;max-height: 187.5px; "/>
          </div>
        </div>
        <div class="modal-footer">
          {{ Form::submit('Guardar', array('class' => 'btn btn-primary')) }}
          <button type="button" class="btn btn-default btn-danger" data-dismiss="modal">Cancelar</button>
        </div>
        {!! Form::close() !!}
    </div>
  </div>
</div>