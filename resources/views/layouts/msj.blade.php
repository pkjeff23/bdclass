<div class="row" style="margin-top:1em;">
    @if (session()->has('msj'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {!!session('msj')!!}
    </div>
    @elseif (session()->has('msjError'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {!!session('msjError')!!}
    </div>
    @endif
</div>