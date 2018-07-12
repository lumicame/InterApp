@section('StyleNav')
<link rel="stylesheet" href="{{asset('Trumbowyg/dist/ui/trumbowyg.min.css')}}"/>
  <script type="text/javascript" src="{{asset('Trumbowyg/dist/trumbowyg.min.js')}}"></script> 
<link rel="stylesheet" href="{{asset('Trumbowyg/dist/plugins/colors/ui/trumbowyg.colors.css')}}"/>
            <script src="{{asset('Trumbowyg/dist/plugins/colors/trumbowyg.colors.min.js')}}"></script>
            <script src="{{asset('Trumbowyg/dist/plugins/fontfamily/trumbowyg.fontfamily.min.js')}}"></script>
            <script src="{{asset('Trumbowyg/dist/plugins/fontsize/trumbowyg.fontsize.min.js')}}"></script>
@endsection
<div class="ui stacked segments container" style="min-width: 700px;">
    <input type="hidden" id="profile_id" value="{{auth()->user()->profile->id}}">
    <input type="hidden" id="profile_description" value="{{auth()->user()->profile->description}}">
  <div class="ui segment" style="min-width: 700px;" id="segment_top">

    <div class="ui grid" id="portada" style="background-image: url('{{ auth()->user()->profile->getPortadaUrl().'?'.uniqid() }}');background-position: center;background-repeat: no-repeat;">
      <form method="post" style="display: none" id="portadaForm">
    <input type="file" id="portadaInput" name="photo" accept="image/*">
</form>
      <div class="three wide column" >
        <form method="post" style="display: none" id="avatarForm">
    <input type="file" id="avatarInput" name="photo" accept="image/*">
</form>
        <img class="ui small circular image  floated left" id="logo" src="{{auth()->user()->profile->getLogoUrl().'?'.uniqid() }}" style="margin: 0px">
        <button class="circular ui mini icon button" id="cargar_foto" style="position:  absolute;bottom: 20px;margin-left: -40px">
          <i class="camera icon"></i>
      </button>
      </div>
      <div class="twelve wide column">
          <h1 id="title_school" style="bottom:  5px;position:  absolute;background: #00000024;color:  #fff;margin-left: -30px">{{auth()->user()->name}}</h1>       
      </div>
      <div class="one wide column">
        <button class="circular ui icon button" id="cargar_portada" style="position:  absolute;right: 3px;bottom: 3px">
          <i class="image outline icon"></i>
      </button>
    </div>
    </div>
    
  </div>
  <div class="ui segment">
    <form method="post" id="edit_name_user">
      <div class="ui right action left icon input" style="width: 50%;min-width: 600px">
        <i class="edit icon"></i>
        <input type="text" id="first_name_edit" name="first_name_edit" value="{{auth()->user()->first_name}}" placeholder="Primer nombre">
        <input type="text" id="second_name_edit" name="second_name_edit" value="{{auth()->user()->second_name}}" style="border-radius: 0px" placeholder="Segundo nombre">
        <button class="ui blue button" id="button_name" style="cursor: pointer;">Editar</button>
          
      </div>
    </form>
          
  </div>
  <div class="ui segment">
    <form method="post" id="edit_number_user">
      <div class="ui right action left icon input" style="width: 50%;min-width: 600px">
        <i class="phone icon"></i>
        <input type="number" id="number_edit" name="number_edit" value="{{auth()->user()->profile->phone}}" maxlength="10" placeholder="Numero de telefono">
        <button class="ui blue button" id="button_number" style="cursor: pointer;">Editar</button>
          
      </div>
      </form>   
    
  </div>
  <div class="ui segment">
    <form method="post" id="edit_direction_user">
      <div class="ui right action left icon input" style="width: 50%;min-width: 600px">
        <i class="map marker alternate icon"></i>
        <input type="text" id="direction_edit" name="direction_edit" value="{{auth()->user()->profile->direction}}" placeholder="Dirección">
        <button class="ui blue button" id="button_direction" style="cursor: pointer;">Editar</button>
          
      </div>
      </form>

  </div>
    <div class="ui segment">
    <form method="post" id="edit_password_user">
      <div class="ui right action left icon input" style="width: 50%;min-width: 600px">
        <i class="lock alternate icon"></i>
        <input type="password" id="password_edit" name="password_edit"  placeholder="Nueva Contraseña">
        <button class="ui blue button" id="button_password" style="cursor: pointer;">Cambiar contraseña</button>
          
      </div>
      </form>

  </div>
    
 
  <div class="ui segment" style="padding-bottom: 50px">
    <form method="post" id="edit_description_user">
      <label>Agrega alguna descripción</label>
           <textarea id="description_edit" name="description_edit" value="{{auth()->user()->profile->description}}" placeholder="Agrega alguna descripción"> </textarea>
           <button class="ui icon blue button" id="button_description" style="float: right;">
  <i class="save icon"></i>
</button>
    </form>
    
  </div>
</div>
                   
<meta name="_token" content="{{ csrf_token() }}"/>
@section('script')
<script type="text/javascript">

  $('#description_edit').trumbowyg({
    btns: [
        ['undo', 'redo'], // Only supported in Blink browsers
        ['formatting'],
        ['strong', 'em', 'del'],
        ['fontfamily'],
        ['fontsize'],
        ['foreColor', 'backColor'],
        ['link'],
        ['insertImage'],
        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
        ['unorderedList', 'orderedList'],
        ['horizontalRule'],
        ['removeformat'],
        ['fullscreen']]
      });

</script>
<script src="{{asset('js/profile.js')}}"></script>
@endsection