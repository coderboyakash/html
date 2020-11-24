  <div class="row">
    @foreach($brand->itemtypes as $itemtype)
      <div class="col-sm-3">
        <h6>{{  $brand->name }}</h6>
        <ul>
            <li><a href="{{ route('show.products', ucfirst($itemtype->id)) }}"> {{ $itemtype->item_type }} </a></li>
        </ul>
      </div>
    @endforeach
  </div>